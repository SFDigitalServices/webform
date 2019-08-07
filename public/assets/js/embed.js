if (typeof libphonenumber === "object") SFDSWFB.postRenderScripts.shift();
if (typeof jQuery === "function") {
	if (typeof jQuery().validator === "function") SFDSWFB.preRenderScripts.splice(1, 1);
	SFDSWFB.preRenderScripts.shift();
}

SFDSWFB.loadRemainingScripts = function() {
	if (SFDSWFB.preRenderScripts.length) {
		SFDSWFB.loadScript('pre', SFDSWFB.loadRemainingScripts);
	} else {
		if (SFDSWFB.postRenderScripts.length) {
			SFDSWFB.loadScript('post', SFDSWFB.loadRemainingScripts);
		} else {
			SFDSWFB.lastScript();
		}
	}
}

SFDSWFB.loadScript = function(type, callback) {
	var scriptArray;
	if (type == "pre") {
		scriptArray = SFDSWFB.preRenderScripts;
	} else if (type == "post") {
		scriptArray = SFDSWFB.postRenderScripts;
	}
	var path = scriptArray[0];
	var script = document.createElement('script');
	script.onload = function () {
		scriptArray.shift();
		if (type == "pre" && !scriptArray.length) {
			SFDSWFB.formRender();
		}
		callback();
	};
	script.src = path;
	document.head.appendChild(script);
}

SFDSWFB.loadRemainingScripts();
SFDSWFB.lastCalled = {};

function callWebhook(populateField, endPoint, ids, responseIndex, method, optionsArray, delimiter, responseOptionsIndex) {
	//validate endPoint and populateField
	if (endPoint == "" || populateField == "") {
		alert('Error, missing endPoint and/or populateField arguments.');
		return;
	}
	var data = '';
	
	if (ids.length) {
		data += '{ ';
		for (var fieldId of ids) {
			data += '"' + fieldId + '"' + ' : ' + '"' + jQuery('#'+fieldId).val() + '"' + ', ';
		}
		data = data.substring(0, data.length - 2) + ' }';
		if (method == "text") {
			data = JSON.parse(data);
		}
	}
	
	//only call if it's a new endpoint and post combination
	if (typeof SFDSWFB.lastCalled[endPoint] == "undefined" || SFDSWFB.lastCalled[endPoint] != data) {
		jQuery.post(endPoint, data, function(response) {
			SFDSWFB.lastCalled[endPoint] = data;
			if (optionsArray) {
				var options = [];
				if (delimiter != null && delimiter != "") {
					options = options.split(delimiter);
				} else {
					if (responseOptionsIndex != null && responseOptionsIndex != "") {
						options = getDataInPath(response, responseOptionsIndex);
					} else {
						options = response;
					}
				}
				var parsedData = [];
				if (responseIndex != null && responseIndex != "") {
					for (var option of options) {
						parsedData.push(getDataInPath(option, responseIndex));
					}
				} else {
					parsedData = options;
				}
				//todo stringify parsed data options if they're still objects
				//put options into populateField
				if (jQuery("[data-id="+populateField+"] select").eq(0).length) {
					jQuery('#' + populateField).html('');
					for (var option of parsedData) {
						jQuery('#' + populateField).append(jQuery('<option>'+option+'</option>').attr("value", option).text(option));
					}
				} else if (jQuery("[data-id="+populateField+"] input").eq(0).length) {
					if (jQuery("[data-id="+populateField+"] input").eq(0).attr("type") == "checkbox") {
						var checkboxName = jQuery("[data-id="+populateField+"] input").eq(0).attr('name');
						jQuery("[data-id="+populateField+"] .field-legend").html('');
						for (var option of parsedData) {
							jQuery("[data-id="+populateField+"] .field-legend").append('<div class="cb-input-group"><input type="checkbox" id="'+populateField+'_'+option+'" value="'+option+'" formtype="s06" name="'+checkboxName+'[]"/><label for="'+populateField+'_'+option+'" class="checkbox">'+option+'</label></div>');
						
						
							jQuery('#' + populateField).after('<input type="checkbox" name="'+option+'" value="'+option+'"/>');
						}
					} else if (jQuery("[data-id="+populateField+"] input").eq(0).attr("type") == "radio") {
						var radioName = jQuery("[data-id="+populateField+"] input").eq(0).attr('name');
						jQuery("[data-id="+populateField+"] .field-wrapper").html('');
						for (var option of parsedData) {
							jQuery("[data-id="+populateField+"] .field-wrapper").append('<div class="rb-input-group"><input type="radio" id="'+populateField+'_'+option+'" formtype="s08" name="'+radioName+'" value="'+option+'" required/><label for="'+populateField+'_'+option+'" class="radio">'+option+'</label></div>');
						}
					}
				}
			} else {
				var parsedData = "";
				if (responseIndex != null && responseIndex != "") {
					parsedData = getDataInPath(response, responseIndex);
				} else {
					parsedData = response;
				}
				//todo stringify objects
				//if (typeof parsedData == "object") 
				jQuery('#'+populateField).val(parsedData);
			}
		}, method);
	}
}
		
function prefill(arr) {
	for (var name in arr) {
		jQuery('[name='+name+']').val(arr[name]);
	}
}		
		
function getDataInPath(obj, path) {
	var output = obj;
	var paths = path.split('/');
	for (var index of paths) {
		output = output[index];
	}
	return output;
}

function initSectional() {
	jQuery('#SFDSWF-Container .form-section-nav a').click(function(e){
		var i = jQuery(e.target).prevAll().length;
		SFDSWF_goto(i);
	});

	jQuery('#SFDSWF-Container .form-section-prev').click(function(e) {
		var i = jQuery('.form-section-nav a.active').prevAll('.form-section-nav a').length;
		SFDSWF_goto(i < 1 ? 0 : i-1);
	});

	jQuery('#SFDSWF-Container .form-section-next').click(function(e) {
		var i = jQuery('.form-section-nav a.active').prevAll('.form-section-nav a').length;
		SFDSWF_goto(i+1);
	});

	var SFDSWF_goto = function(i) {
		jQuery('#SFDSWF-Container .form-section-nav a').removeClass('active');
		jQuery('#SFDSWF-Container .form-section-nav a').eq(i).addClass('active');
		jQuery('#SFDSWF-Container .form-section').removeClass('active');
		jQuery('#SFDSWF-Container .form-section').eq(i).addClass('active');
		jQuery('#SFDSWF-Container .form-section-header').removeClass('active');
		jQuery('#SFDSWF-Container .form-section-header').eq(i).addClass('active');
		jQuery('html,body').animate({ scrollTop: 0 }, 'medium');
	}
}

function phoneIsValid(num) {
	if (num === '') return false;
	var phoneNumber = libphonenumber.parsePhoneNumberFromString(num, 'US');
	if (phoneNumber === undefined) return false;
	return phoneNumber.isValid() === true ? true : false;
}

function fieldInvalid(id) {
	if (!jQuery('.form-group[data-id=' + id + ']').hasClass('has-error')) jQuery('.form-group[data-id=' + id + ']').addClass('has-error');
	if (!jQuery('.form-group[data-id=' + id + ']').hasClass('has-danger')) jQuery('.form-group[data-id=' + id + ']').addClass('has-danger');
	jQuery('.form-group[data-id=' + id + '] .with-errors').html('<ul class="list-unstyled"><li>' + jQuery('#' + id).data('required-error') + '</li></ul>');
}

function fieldValid(id) {
	jQuery('.form-group[data-id=' + id + ']').removeClass('has-error has-danger');
	jQuery('.form-group[data-id=' + id + '] .with-errors').html('');
}

SFDSWFB.lastScript = function() {
	jQuery('#SFDSWF-Container input[formtype=c06]').on('keyup blur', function() {
			if (phoneIsValid($(this).val())) {
				fieldValid($(this).attr('id'));
			} else {
				fieldInvalid($(this).attr('id'));
			}
		var key = event.keyCode || event.charCode;
		if (key === 8 || key === 46) {
			return;
		} else {
			jQuery(this).val(new libphonenumber.AsYouType('US').input(jQuery(this).val()));
		}			
	});
	jQuery('#SFDSWF-Container form').submit(function(e) {
		var formValid = true;
		jQuery('#SFDSWF-Container input[formtype=c06]').each(function() {
			if (phoneIsValid($(this).val())) {
				fieldValid($(this).attr('id'));
			} else {
				formValid = false;
				fieldInvalid($(this).attr('id'));
			}
		});
		if (!formValid) {
			e.preventDefault();
		}
	});

}
