if (typeof libphonenumber === "object") SFDSWFB.postRenderScripts.shift();
if (typeof jQuery === "function") {
  if (typeof jQuery().validator === "function") SFDSWFB.preRenderScripts.splice(1, 1);
  SFDSWFB.preRenderScripts.shift();
}

SFDSWFB.loadRemainingScripts = function() {
  if (SFDSWFB.preRenderScripts.length) {
    SFDSWFB.loadScript('pre', SFDSWFB.loadRemainingScripts)
  } else {
    if (SFDSWFB.postRenderScripts.length) {
      SFDSWFB.loadScript('post', SFDSWFB.loadRemainingScripts)
      jQuery('#SFDSWFB-admin .content').hide()
      jQuery('#SFDSWFB-admin input[type=checkbox]').prop('checked', false)
    } else {
      initUploaders();
      bindAriaValidation();
      SFDSWFB.lastScript()
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
SFDSWFB.skipToSectionId = '';
SFDSWFB.uploaders = {};

function initUploaders() {
  if (jQuery('div[data-formtype=m13]').length) {
    jQuery('div[data-formtype=m13]').each(function(){
      SFDSWFB.uploaders[jQuery(this).attr('name')] = new Dropzone(jQuery(this).get(0), {
        url: jQuery('#SFDSWF-Container form').prop('action').replace('\/submit', '\/uploadFile'),
        autoProcessQueue: true,
        uploadMultiple: true,
        params: JSON.parse( '{ "form_id" : "'+jQuery('#SFDSWF-Container input[name=form_id]').val()+'", "field_name" : "'+jQuery(this).attr('name')+'" }' ),
        parallelUploads: 1,
        maxFiles: 1,
        maxFilesize: 500,
        timeout: 3600000,
        acceptedFiles: 'image/*,application/pdf,.zip',
        addRemoveLinks: false,
        init: function() {
          this.on("addedfile", function() {
            if (this.files[1]!=null){
              this.removeFile(this.files[0]);
            }
          });
        },
        success: function (file, response) {
          var imgName = response;
          file.previewElement.classList.add("dz-success");
          jQuery('.file-custom[name='+response.field_name+']').append('<input type="hidden" name="'+response.field_name+'" value="'+response.filename+'"/>');
          fieldValid(jQuery('.file-custom[name='+response.field_name+']').attr('id'));
        },
        error: function (file, response) {
          file.previewElement.classList.add("dz-error");
        }
      } );
    });
  }
}

function callWebhook(populateField, endPoint, ids, responseIndex, method, optionsArray, delimiter, responseOptionsIndex) {
  //validate endPoint and populateField
  if (endPoint == "" || populateField == "") {
    alert('Error, missing endPoint and/or populateField arguments.');
    return;
  }
  var data = '';

  if (ids.length) {
    if (method === "get") {
      data += '?'
      for (var fieldId of ids) {
        data += fieldId + '=' + jQuery('#'+fieldId).val() + '&';
      }
      data = data.substring(0, data.length - 1);
    } else {
      data += '{ ';
      for (var fieldId of ids) {
        data += '"' + fieldId + '"' + ' : ' + '"' + jQuery('#'+fieldId).val() + '"' + ', ';
      }
      data = data.substring(0, data.length - 2) + ' }';
      if (method == "text") {
        data = JSON.parse(data);
      }
    }
  }

  //only call if it's a new endpoint and post combination
  if (typeof SFDSWFB.lastCalled[endPoint] == "undefined" || SFDSWFB.lastCalled[endPoint] != data) {
    if (method === "get") {
      jQuery.get(endPoint + data, function(response) {
        respondWebhook(response, data, populateField, endPoint, ids, responseIndex, optionsArray, delimiter, responseOptionsIndex)
      });
    } else {
      jQuery.post(endPoint, data, function(response) {
        respondWebhook(response, data, populateField, endPoint, ids, responseIndex, optionsArray, delimiter, responseOptionsIndex)
      }, method);
    }
  }
}

function respondWebhook(response, data, populateField, endPoint, ids, responseIndex, optionsArray, delimiter, responseOptionsIndex) {
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
        jQuery("[data-id="+populateField+"] .field-wrapper").html('');
        for (var option of parsedData) {
          jQuery("[data-id="+populateField+"] .field-wrapper").append('<label for="'+populateField+'_'+option+'"><input type="checkbox" id="'+populateField+'_'+option+'" value="'+option+'" data-formtype="s06" name="'+checkboxName+'[]"/><span class="inline-label">'+option+'</span></label>');

          jQuery('#' + populateField).after('<input type="checkbox" name="'+option+'" value="'+option+'"/>');
        }
      } else if (jQuery("[data-id="+populateField+"] input").eq(0).attr("type") == "radio") {
        var radioName = jQuery("[data-id="+populateField+"] input").eq(0).attr('name');
        jQuery("[data-id="+populateField+"] .field-wrapper").html('');
        for (var option of parsedData) {
          jQuery("[data-id="+populateField+"] .field-wrapper").append('<label for="'+populateField+'_'+option+'"><input type="radio" id="'+populateField+'_'+option+'" value="'+option+'" data-formtype="s08" name="'+radioName+'[]"/><span class="inline-label">'+option+'</span></label>');
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
}

function bindAriaValidation() {
  jQuery('#SFDSWF-Container form').on('invalid.bs.validator', function(e) {
    var fieldId = jQuery(e.relatedTarget).attr('id');
    jQuery(e.relatedTarget).attr('aria-invalid', true);
    jQuery(e.relatedTarget).attr('aria-describedby', 'SFDSWF-'+fieldId+'-with-errors');
  });
  jQuery('#SFDSWF-Container form').on('valid.bs.validator', function(e) {
    jQuery(e.relatedTarget).attr('aria-invalid', false);
    jQuery(e.relatedTarget).removeAttr('aria-describedby');
  });
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

//returns boolean
function validPage() {
  jQuery('#SFDSWF-Container .form-section.active').validator('destroy');
  jQuery('#SFDSWF-Container .form-section.active').validator('validate');
  if (jQuery('#SFDSWF-Container .form-section.active div[data-formtype=m13]').length) {
    jQuery('#SFDSWF-Container .form-section.active div[data-formtype=m13]').each(function(){
      if (jQuery(this).attr('required')) {
        if (SFDSWFB.uploaders[jQuery(this).attr('name')].files.length < 1) {
          fieldInvalid(jQuery(this).attr('id'));
          return false;
        } else {
          fieldValid(jQuery(this).attr('id'));
        }
      }
    });
  }
  jQuery('#SFDSWF-Container .form-section.active input[type=checkbox]:visible').each(function() {
    requireCheckboxGroup(this)
  })
  return jQuery('#SFDSWF-Container .form-section.active .has-error:visible').length === 0 ? true : false
}

//returns the current page
SFDSWFB.currentPage = function() {
  return jQuery('#SFDSWF-Container .form-section.active').prevAll('#SFDSWF-Container .form-section').length
}

//go to page by index
SFDSWFB.paginate = function(i, browserHistory) {
  browserHistory = typeof browserHistory === "undefined" ? false : true
  var forward = i > SFDSWFB.currentPage() ? true : false
  var totalPages = jQuery('#SFDSWF-Container .form-section').length

  //update page/section
  jQuery('#SFDSWF-Container .form-section').removeClass('active')
  jQuery('#SFDSWF-Container .form-section').eq(i).addClass('active')

  //check if page is not the first or last page and the one we're navigating to is empty
  if (i > 0 && i < totalPages - 1 && jQuery('#SFDSWF-Container .form-section.active .form-group:visible').length < 2) {
    //skip to next page in direction of travel
    return SFDSWFB.paginate(forward ? i+1 : i-1)
  }

  //scroll to top
  document.getElementById("SFDSWF-Container").scrollIntoView();

  //initialize validator on new page
  jQuery('#SFDSWF-Container .form-section.active').validator()

  //if not using browser buttons, make a new browser state
  if (!browserHistory) history.pushState(i, null, "#page-" + (i + 1))
}

function initSectional() {
  //bind previous button
  jQuery('#SFDSWF-Container .form-section-prev').click(function(e) {
    SFDSWFB.paginate(SFDSWFB.currentPage()-1)
    e.preventDefault()
  });

  //bind next button
  jQuery('#SFDSWF-Container .form-section-next').click(function(e) {
    if (validPage()) {
      SFDSWFB.paginate(SFDSWFB.currentPage()+1)
      e.preventDefault()
    }
  });

  //bind browser history back button
  window.addEventListener('popstate', function(e) {
    var i = e.state === null ? 0 : e.state
    SFDSWFB.paginate(i, true)
  })

  //navigate to the proper page/section for formbuilder authoring
  skipToSectionId(SFDSWFB.paginate)
}

function phoneIsValid(num) {
  if (num === '') return false;
  var phoneNumber = libphonenumber.parsePhoneNumberFromString(num, 'US');
  if (phoneNumber === undefined) return false;
  return phoneNumber.isValid() === true ? true : false;
}

function fieldInvalid(id, errorMsg) {
  if (!jQuery('.form-group[data-id=' + id + ']').hasClass('has-error')) jQuery('.form-group[data-id=' + id + ']').addClass('has-error')
  if (!jQuery('.form-group[data-id=' + id + ']').hasClass('has-danger')) jQuery('.form-group[data-id=' + id + ']').addClass('has-danger')
  if (typeof errorMsg == "undefined") {
    errorMsg = jQuery('#' + id).data('required-error') !== '' && jQuery('#' + id).data('required-error') !== undefined ? jQuery('#' + id).data('required-error') : jQuery('#' + id).data('error')
  }
  jQuery('.form-group[data-id=' + id + '] .with-errors').html('<ul class="list-unstyled"><li>' + errorMsg + '</li></ul>')
}

function fieldValid(id) {
  jQuery('.form-group[data-id=' + id + ']').removeClass('has-error has-danger');
  jQuery('.form-group[data-id=' + id + '] .with-errors').html('');
}

function skipToSectionId(callback) {
  if (!SFDSWFB.skipToSectionId) {
    var url = new URL(window.location.href)
    if (typeof url.searchParams.get("sectionId") != "undefined") SFDSWFB.skipToSectionId = url.searchParams.get("sectionId")
  }
  if (SFDSWFB.skipToSectionId) {
    var section = jQuery('div[data-id='+SFDSWFB.skipToSectionId+']')
    if (callback && section.is(":hidden")) callback(section.closest(".form-section").index('.form-section'))
    if (typeof section[0] !== "undefined") {
      section[0].scrollIntoView()
      section.addClass('is-selected-in-editor')
    }
  }
}

function submitPartial(formid, submitType = 'partial'){
  var formid = "SFDSWFB_forms_" + formid;
  var submitUrl = jQuery("#"+formid).attr('action');

  if(submitType !== 'complete' && !submitUrl.includes('submitPartial') )
    submitUrl = submitUrl.replace('\/submit', '\/submitPartial');

  var form_data = new FormData(jQuery("#"+formid)[0]);
  var settings = {
    'async': true,
    'crossDomain': true,
    'url': submitUrl,
    'method': 'POST',
    'data':  form_data,
    'processData': false,
    'contentType': false
  }
  if(submitType !== 'complete'){ //partial submit
    jQuery.ajax(settings).done(function (response) {
      jQuery("body").html(response);
    })
  }
  else{ //complete submit
    jQuery.ajax(settings).done(function (response) {
      if(response.status !== undefined ){
        if(response.status == 0){
          var errors = response['errors'];
          Object.keys(errors).forEach(function(item){
            fieldInvalid(item, errors[item][0]);
            SFDSWFB.paginate(jQuery('#SFDSWF-Container #'+item).closest('.form-section').prevAll('.form-section').length)
            document.getElementById(item).scrollIntoView()
          })
        }
        else if(response['redirect_url'] != ''){
          window.location.href = response['redirect_url'];
        }
    }
    else{ //show user their submitted data
        jQuery("body").html(response);
      }
    })
  }
}

SFDSWFB.lastScript = function() {

  skipToSectionId(false)

	jQuery('#SFDSWF-Container input[data-formtype=c06]').on('keyup blur', function() {
      if (!jQuery(this).prop('required') && jQuery(this).val() === "") {
        fieldValid(jQuery(this).attr('id'));
        return
      }
			if (phoneIsValid(jQuery(this).val())) {
				fieldValid(jQuery(this).attr('id'));
			} else {
				fieldInvalid(jQuery(this).attr('id'));
			}
		var key = event.keyCode || event.charCode;
		if (key === 8 || key === 46) {
			return;
		} else {
			jQuery(this).val(new libphonenumber.AsYouType('US').input(jQuery(this).val()));
		}
	});

  jQuery("#SFDSWF-Container input[data-formtype=m13]").change(function() {
    var file = jQuery(this).val().replace(/C:\\fakepath\\/i, '');

    jQuery(this).next('.file-custom').attr('data-filename', file);
  });

  jQuery('#SFDSWF-Container input[type=checkbox]').on('click', function() {
    requireCheckboxGroup(this)
  });

	jQuery('#SFDSWF-Container form').submit(function(e) {
    e.preventDefault(); // let ajax handles the form submit
    var form_id = jQuery(this.form_id).val();
    if( !form_id ){
      return false;
    }
    // UI validation
    var formValid = true;
    jQuery('#SFDSWF-Container input[data-formtype=c06]:visible').each(function() {
      if ((!jQuery(this).prop('required') && jQuery(this).val() === "") || (phoneIsValid(jQuery(this).val()))) {
          fieldValid(jQuery(this).attr('id'));
        } else {
          formValid = false;
          fieldInvalid(jQuery(this).attr('id'));
        }
    });
    if (jQuery('div[data-formtype=m13]').length) {
      jQuery('div[data-formtype=m13]').each(function(){
        if (jQuery(this).attr('required')) {
          if (SFDSWFB.uploaders[jQuery(this).attr('name')].files.length < 1) {
            formValid = false;
            fieldInvalid(jQuery(this).attr('id'));
          } else {
            fieldValid(jQuery(this).attr('id'));
          }
        }
      });
    }
    // If UI validation passed, perfrom back end validation
    if (formValid && validPage()) {
      if (!jQuery('#SFDSWF-Container .has-error:visible').length) submitPartial(form_id, 'complete')
    }
  });

  // bind preview page action
  jQuery('#preview_submit_page').on('click', function(){
      var form_id = jQuery("#SFDSWF-Container input[name='form_id']").val();
      loadPreviewPage(form_id);
  })

  if(window.draftData !== undefined){
    console.log(window.draftData);
    populateForm(window.draftData);
  }
}

function insertOtherTextInput(obj) {
  if (!jQuery(obj).find("input[type=text]").length) {
    var labelId = jQuery(obj).attr('for')
    jQuery(obj).append('<input type="text" onclick="jQuery(\'#'+labelId+'\').prop(\'checked\', true)" onchange="setOtherValue(this)" id="'+labelId+'_input" />');
  }
}

function requireCheckboxGroup(obj) {
  if (jQuery(obj).data('required')) {
    if (jQuery(obj).parents('.form-group').find('input[type=checkbox]:checked').length) {
      jQuery(obj).parents('.form-group').find('input[type=checkbox]').prop('required', false)
      jQuery(obj).parents('.form-group').validator('destroy')
      jQuery('#SFDSWF-Container').validator('validate')
    } else {
      jQuery(obj).parents('.form-group').find('input[type=checkbox]').prop('required', true)
      jQuery(obj).parents('.form-group').validator('destroy')
      jQuery(obj).parents('.form-group').validator('validate')
    }
  }
}

function setOtherValue(obj) {
  jQuery('#'+obj.id.substring(0, obj.id.length - 6)).prop('value',obj.value);
}

function populateForm(form){
  formData = form['data'];
  conditions = form['conditions']
  fileFields = form['fileFields']
  if(formData['formid'] === undefined) return false;
  var formid = 'SFDSWFB_forms_' + formData['formid'];

  //populate file fields into a hidden field
  fileFields.forEach(function (fld){
    if(formData[fld] && formData[fld] !== undefined && formData[fld] !== '')
      jQuery('.file-custom[name='+fld+']').append('<input type="hidden" name="'+fld+'" value="'+formData[fld]+'"/>');
      fieldValid(jQuery('.file-custom[name='+fld+']').attr('id'));
  });

  // populate all other fields
  for(element in formData){
    var formElement = document.forms[formid][element];
    if(formElement !== undefined && formData[element] !== ""){
      // mutiple checkboxes/radios
      if(formElement instanceof RadioNodeList){
        getCheckedCheckboxesFor(formElement, formData[element])
      }
      try{
        // set single checkbox/radio inputs, these special input types
        if(formElement.type !== undefined && (formElement.type === 'radio' || formElement.type === 'checkbox')){
          getSingleCheckedCheckboxesFor(formElement, formData[element])
        }
        else{
            formElement.value = formData[element];
            // inputs with conditions attached
            if(formElement.name !== undefined && conditions !== undefined && conditions.includes(formElement.name)){
              // trigger keyup event to show condition fields
              jQuery('#SFDSWF-Container input[name="'+ formElement.name + '"]').keyup();
            }
        }
      }
      catch(errors){ // catch Failed to set the 'value' property on 'HTMLInputElement'
        console.log(errors)
      }
    }
  };
   // inject hidden input for magiclink
  if(document.forms[formid]['magiclink'] === undefined){
    var input = document.createElement("input");
    input.type = "hidden";
    input.name = "magiclink";
    input.value = formData['magiclink'];
    document.forms[formid].appendChild(input);
  }
  else{
    document.forms[formid]['magiclink'].value = formData['magiclink'];
  }
}

function loadPreviewPage(formid){
  if(formid === undefined) return false;
  var form_id = "SFDSWFB_forms_" + formid;
  var previewPageURL = jQuery("#"+form_id).attr('action');

  previewPageURL = previewPageURL.replace('\/submit', '\/getPreviewPage');
  var form_data = new FormData(jQuery("#"+form_id)[0]);
  var settings = {
    'async': true,
    'crossDomain': true,
    'url': previewPageURL,
    'method': 'POST',
    'data':  form_data,
    'processData': false,
    'contentType': false
  }
  jQuery.ajax(settings).done(function (response) {
      jQuery("#preview_submitted_data").html(response);
    })
}

function getCheckedCheckboxesFor(elements, items) {
    if(!items) return;
    for (var i = 0; i < elements.length; i++) {
        if (( elements[i].type === 'checkbox' || elements[i].type === 'radio') && items.includes(elements[i].value) ){
          elements[i].click();
          elements[i].checked = true;
        }
    }
}
function getSingleCheckedCheckboxesFor(elements, items) {
      if(!items) return;
      if (( elements.type === 'checkbox' || elements.type === 'radio') && items.includes(elements.value) ){
        if(elements.type === 'radio')
          elements.click();
        elements.checked = true;
      }
}

function toggleAdminTab() {
  if (jQuery('#SFDSWFB-admin .content').is(':visible')) {
    jQuery('#SFDSWFB-admin .content').hide();
    jQuery('#SFDSWFB-admin .adminTabArrow').prop('class', 'adminTabArrow fa fa-angle-up')
  } else {
    jQuery('#SFDSWFB-admin .content').show();
    jQuery('#SFDSWFB-admin .adminTabArrow').prop('class', 'adminTabArrow fa fa-angle-down')
  }
}

function toggleShowAllFields(obj) {
  if (obj.checked) {
    jQuery('.form-content').addClass('displayOverride');
    jQuery('.form-group').addClass('displayOverride');
  } else {
    jQuery('.form-content').removeClass('displayOverride');
    jQuery('.form-group').removeClass('displayOverride');
  }
}

function toggleShowAllPages(obj) {
  if (obj.checked) {
    jQuery('.form-section').addClass('displayOverride');
  } else {
    jQuery('.form-section').removeClass('displayOverride');
  }
}