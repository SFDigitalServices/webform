//globals

var emptyForm;
var formId = 0;
var csvFile = '';
var allForms; //load all the forms into global?
var isSaving = false;

$(document).ready(function(){

  emptyForm = $("#SFDSWFB-target").html();

  $("form").delegate(".component", "mousedown", function(md) {

	//remove the popup
    $(".popover").remove();

	//stage vars
    md.preventDefault();
    var tops = [];
    var mouseX = md.pageX;
    var mouseY = md.pageY;
    var $temp;
    var timeout;
		var dragExisting = false;
		var existingPos;
		var existingCount;
		var clickNow = Date.now();
    var $this = $(this);
    var delays = {
      main: 0,
      form: 300
    }
    var type = $this.parent().parent().parent().parent().attr("id") === "SFDSWFB-components" ? "main" : "form";
		var saved = $("#SFDSWFB-save").val();
		saved = JSON.parse(saved.replace(/[\x00-\x1F\x7F-\x9F]/g,"\\n"));
		var previousFormSettings = saved.data.slice();

	if (saved.settings == undefined) saved.settings = new Object();
	if (saved.data == undefined) saved.data = new Array();

	//drag and drop functionality
    var delayed = setTimeout(function(){
      if(type === "main"){
        $temp = $("<form class='form-horizontal col-md-6' id='SFDSWFB-temp'></form>").append($this.clone());
				dragExisting = false;
			 } else {
        if($this.attr("id") !== "SFDSWFB-legend"){
					existingPos = $($this).prevAll(".form-group").length;
					existingCount = $($this).siblings(".form-group").length;
					saved.data.splice(existingPos, 1);
					$temp = $("<form class='form-horizontal col-md-6' id='SFDSWFB-temp'></form>").append($this);
					dragExisting = true;
        }
      }

      $("body").append($temp);

      $temp.css({"position" : "absolute",
                 "top"      : mouseY - ($temp.height()/2) + "px",
                 "left"     : mouseX - ($temp.width()/2) + "px",
                 "opacity"  : "0.9"}).show()

      var half_box_height = ($temp.height()/2);
      var half_box_width = ($temp.width()/2);
      var $target = $("#SFDSWFB-target");
      var tar_pos = $target.position();
      var $target_component = $("#SFDSWFB-target .component");

	  var dataFormType = $($this).attr("data-formtype");
	  var dataValue = $($this).attr("data-value");
	  var dataName = $($this).attr("data-name");
	  var dataClass = $($this).attr("data-class");
	  var dataType = $($this).attr("data-type");
	  var dataRequired = $($this).attr("data-required");
	  var dataMinLength = $($this).attr("data-minlength");
	  var dataMaxLength = $($this).attr("data-maxlength");
	  var dataRegex = $($this).attr("data-regex");
	  var dataMin = $($this).attr("data-min");
	  var dataMax = $($this).attr("data-max");

      $(document).delegate("body", "mousemove", function(mm){

        var mm_mouseX = mm.pageX;
        var mm_mouseY = mm.pageY;

        $temp.css({
			"top" : mm_mouseY - half_box_height + "px",
			"left" : mm_mouseX - half_box_width  + "px"
				});

		//added 100 to center drag
		if (
			mm_mouseX > $("#SFDSWFB-build").offset().left &&
			mm_mouseX < tar_pos.left + $target.width() + $target.width() + $temp.width() &&
			mm_mouseY > tar_pos.top + 100 &&
			mm_mouseY < tar_pos.top + $target.height() + $temp.height()/2 + 100
		) {
			//effects if dragged item is within the form
            $("#SFDSWFB-target").css("background-color", "#fafdff");
            $target_component.css({"border-top" : "1px solid white", "border-bottom" : "none"});
            tops = $.grep($target_component, function(e){
				//added 150 to center drag
              return ($(e).position().top -  mm_mouseY + half_box_height + 150 > 0 && $(e).attr("id") !== "SFDSWFB-legend");
            });
            if (tops.length > 0) {
              $(tops[0]).css("border-top", "80px solid #ccddee");
            } else {
              if ($target_component.length > 0) {
                $($target_component[$target_component.length - 1]).css("border-bottom", "80px solid #ccddee");
              }
            }
        } else {
			//effects if dragged item is outside the form
            $("#SFDSWFB-target").css("background-color", "#fff");
            $target_component.css({"border-top" : "1px solid white", "border-bottom" : "none"});
            $target.css("background-color", "#fff");
        }
      });

	  //letting go of the dragged item
      $("body").delegate("#SFDSWFB-temp", "mouseup", function(mu){
        mu.preventDefault();

		function cancelDrag() {
			//populate id field, almost all fields have id
			var componentId = setComponentId($temp);
			//put them in original place
			if (existingPos < existingCount) {
			  $($temp.html()).insertBefore($($target_component[existingPos+1]));
			  saved.data.splice(existingPos ,0, addAttr($temp.html(), componentId, dataFormType, dataValue, dataName, dataClass, dataType, dataRequired, dataMinLength, dataMaxLength, dataRegex, dataMin, dataMax))
			} else {
              $("#SFDSWFB-target fieldset").append($temp.html());
			  saved.data.push(addAttr($temp.html(), componentId, dataFormType, dataValue, dataName, dataClass, dataType, dataRequired, dataMinLength, dataMaxLength, dataRegex, dataMin, dataMax))
			}
			$("#SFDSWFB-save").val(JSON.stringify(saved));

			//clean up & add popover
			$target.css("background-color", "#fff");
			$(document).undelegate("body", "mousemove");
            $target_component.css({"border-top" : "1px solid white", "border-bottom" : "none"});
			$("body").undelegate("#SFDSWFB-temp","mouseup");
			$("#SFDSWFB-target .component").popover({trigger: "manual"});
			$temp.remove();
		}

		//disallow if dragged in less than a second
		if (dragExisting && Date.now() - clickNow < 1000) {
			cancelDrag();
			return;
		}

        var mu_mouseX = mu.pageX;
        var mu_mouseY = mu.pageY;
        var tar_pos = $target.position();

        $("#SFDSWFB-target .component").css({"border-top" : "1px solid white", "border-bottom" : "none"});

        // acting only if mouse is in right place
		//added 150 and 100 to center drag
		if (
			mu_mouseX > $("#SFDSWFB-build").offset().left &&
			mu_mouseX - half_box_width < tar_pos.left + $target.width() + $target.width() + half_box_width &&
			mu_mouseY + half_box_height > tar_pos.top + 150 &&
			mu_mouseY - half_box_height < tar_pos.top + $target.height() + 100
        ) {
            $temp.attr("style", null);

			//populate id field, almost all fields have id
			var componentId = setComponentId($temp);

            // where to add
            if(tops.length > 0){
              $($temp.html()).insertBefore(tops[0]);
			  //figure out which form-group tops[0] and push new object into proper array index
			  //console.log($temp.html());
			  saved.data.splice($(tops[0]).prevAll(".form-group").length-1, 0, addAttr($temp.html(), componentId, dataFormType, dataValue, dataName, dataClass, dataType, dataRequired, dataMinLength, dataMaxLength, dataRegex, dataMin, dataMax));
            } else {
              $("#SFDSWFB-target fieldset").append($temp.append("\n\n\ \ \ \ ").html());
			  saved.data.push(addAttr($temp.html(), componentId, dataFormType, dataValue, dataName, dataClass, dataType, dataRequired, dataMinLength, dataMaxLength, dataRegex, dataMin, dataMax));
            }

			//add submit button if there is only one entry
			if (timeToAddSubmitButton(saved)) {
				saved = addSubmitButton(saved);
				$("#SFDSWFB-load").val(JSON.stringify(saved));
				loadForm();
			}

			//animation effect
			var flashIndex = $(tops[0]).prevAll(".form-group").length != 0 ? $(tops[0]).prevAll(".form-group").length : $('#SFDSWFB-target .component').length - 1;
			$('#SFDSWFB-target .component:eq('+flashIndex+')').css('opacity', 0);
			$('#SFDSWFB-target .component:eq('+flashIndex+')').animate({opacity: 1}, 500);

        } else {
			var componentId = setComponentId($temp);

			if (isReferenced(componentId)) { // check if section getting dragged out has dependencies
				loadDialogModal("Oops!", "This field cannot be removed while it is being referenced in a calculation or conditional. Remove those dependencies first before attempting to remove this field.");
				cancelDrag();
				return;

			} else if (componentId == "submit") {
				loadDialogModal("Oops!", "The submit button cannot be removed.");
				cancelDrag();
				return;
			} else {
					// do not add the component
				$("#SFDSWFB-target .component").css({"border-top" : "1px solid white", "border-bottom" : "none"});
				tops = [];
			}
		}

		resizeHeight();

		$("#SFDSWFB-save").val(JSON.stringify(saved));

        //clean up & add popover
        $target.css("background-color", "#fff");
        $(document).undelegate("body", "mousemove");
        $("body").undelegate("#SFDSWFB-temp","mouseup");
        $("#SFDSWFB-target .component").popover({trigger: "manual"});
        $temp.remove();

		bindQuickDelete();

		//auto save
		saveForm(previousFormSettings);
      });

    }, delays[type]); //end delayed

    $(document).mouseup(function () {
      clearInterval(delayed);
      return false;
    });
    $(this).mouseout(function () {
      clearInterval(delayed);
      return false;
    });
  }); //end drag

  //activate legend popover
  $("#SFDSWFB-target .component").popover({trigger: "manual"});

  //popover on click event
  $("#SFDSWFB-target").delegate(".component", "click", function(e){
    e.preventDefault();
    var $active_component = $(this);
    $active_component.popover("show");
    //hack to fix popover y position
    var posOffset = $('.popover').offset();
	if ($(window).width() < 1620) {
		$('.popover').offset({top:posOffset.top-50, left:posOffset.left-250});
	} else {
		$('.popover').offset({top:posOffset.top-50});
	}

	//copy over attributes section
	$(".popover .accordion-section.general").after($('.accordion-attributes').html());

	//populate attributes
	if (e.currentTarget.attributes['data-value']) $(".popover #value").val(e.currentTarget.attributes['data-value'].value);
	if (e.currentTarget.attributes['data-name']) $(".popover #name").val(e.currentTarget.attributes['data-name'].value);
	if (e.currentTarget.attributes['data-class']) $(".popover #class").val(e.currentTarget.attributes['data-class'].value);

	//autofill name if available
	if (autofillNames != null) {
	    $('.popover #name').typeahead({
		    minlength: 1,
			hint: false
	    }, {
		    name: 'prefill',
			source: substringMatcher(autofillNames)
	    });
	    //$('.popover #name').tagsinput();
	} else {
	    $('.popover #name').typeahead('destroy');
	}

	//populate ID
	if ($('#id')[0] != undefined && e.currentTarget.attributes['data-id'] != undefined) $('#id').val(e.currentTarget.attributes['data-id'].value);

	//if not a select, checkbox, or radio, load validation accordion section, otherwise, required field is in general
	if (!e.currentTarget.attributes['data-choose']) {

		//copy over validation section
		$(".popover .accordion-section.attributes").after($('.accordion-validation').html());
	}
	//hide value and validate type for textarea
	if ($active_component.find("textarea")[0]) {
		$(".popover .accordion-section.attributes .accordion label:first-child()").remove(); //hacky, if value gets moved this will have to change
		$(".popover #value").remove();
		$(".popover .validate-type").remove();
	}

	//get ids for validation match field
	var ids = getIds();
	$(".popover-content #match").html("<option value=''></option>");
	$.each(ids, function(i, item) {
		$(".popover-content #match").append($('<option>', {
			value: item,
			text:	item
		}));
	});

	//populate validation rules
	if (e.currentTarget.attributes['data-required']) $(".popover #required").prop("checked",true);
	if (e.currentTarget.attributes['data-type']) $(".popover #type").val(e.currentTarget.attributes['data-type'].value);
	if (e.currentTarget.attributes['data-regex']) $(".popover #regex").val(e.currentTarget.attributes['data-regex'].value);
	if (e.currentTarget.attributes['data-minlength']) $(".popover #minlength").val(e.currentTarget.attributes['data-minlength'].value);
	if (e.currentTarget.attributes['data-maxlength']) $(".popover #maxlength").val(e.currentTarget.attributes['data-maxlength'].value);
	if (e.currentTarget.attributes['data-min']) $(".popover #min").val(e.currentTarget.attributes['data-min'].value);
	if (e.currentTarget.attributes['data-max']) $(".popover #max").val(e.currentTarget.attributes['data-max'].value);
	if (e.currentTarget.attributes['data-match']) {
		$(".popover #type").val("match");
		$('.popover .validate-match').show();
		$(".popover #match").val(e.currentTarget.attributes['data-match'].value);
	}

	//add calculation
	if (e.currentTarget.dataset.formtype == "d06" || e.currentTarget.dataset.formtype == "d08") { //only show for numbers or prices
		addCalculation(e.currentTarget.dataset.id);
		if (e.currentTarget.attributes['data-calculations']) {
			var fieldCalculations = JSON.parse(e.currentTarget.attributes['data-calculations'].value);
			var calCount = 0;
			for (l in fieldCalculations) {
				if (l == 1) {
					addCalculation(e.currentTarget.dataset.id);
					$(".popover .calculationId").eq(0).val(fieldCalculations[0]);
					$(".popover .calculationId").eq(1).val(fieldCalculations[2]);
					$(".popover .calculationOperator").eq(0).val(fieldCalculations[1]);
				} else if (Math.abs(l % 2) == 1) { //every odd number after 1
					calCount++;
					addCalculation(e.currentTarget.dataset.id);
					$(".popover .calculationOperator").eq(calCount).val(fieldCalculations[l]);
					$(".popover .calculationId").eq(calCount+1).val(fieldCalculations[parseInt(l)+1]);
				}
			}
		}
	}

	//add conditional
	if (e.currentTarget.id != "SFDSWFB-legend" && e.currentTarget.dataset.formtype != "m11") { //hide for hidden inputs and form title
		$(".popover-content hr").before($('.accordion-conditionals').html());
		$(".popover .accordion-section.conditionals .accordion").append($(".addConditionalContainer").html());
		if (e.currentTarget.attributes['data-conditions']) {
			var fieldConditions = JSON.parse(e.currentTarget.attributes['data-conditions'].value);
			for (c in fieldConditions.condition) {
				addConditional();
				$(".popover .conditionalId").eq(c).val(fieldConditions.condition[c].id);
				$(".popover .conditionalOperator").eq(c).val(fieldConditions.condition[c].op);
				$(".popover .conditionalValue").eq(c).val(fieldConditions.condition[c].val);
				conditionalSelect($('.conditionalOperator').eq(c));
			}
			if (fieldConditions.showHide) $(".popover .showHide").val(fieldConditions.showHide);
			if (fieldConditions.allAny) $(".popover .allAny").val(fieldConditions.allAny);
		}
	}

    var valtypes = $active_component.find(".valtype");
    $.each(valtypes, function(i,e){
      var valID ="#" + $(e).attr("data-valtype");
      var val;

      if(valID ==="#placeholder"){
        val = $(e).attr("placeholder");
        $(".popover " + valID).val(val);
      } else if(valID ==="#href"){
        val = $(e).attr("href");
        $(".popover " + valID).val(val);
      } else if(valID ==="#src"){
        val = $(e).attr("src");
        $(".popover " + valID).val(val);
      } else if(valID==="#checkbox"){
        val = $(e).attr("checked");
        $(".popover " + valID).attr("checked",val);
      } else if(valID==="#option"){
        val = $.map($(e).find("option"), function(e,i){return $(e).text()});
        val = val.join("\n")
      $(".popover "+valID).text(val);
      } else if(valID==="#checkboxes"){
        val = $.map($(e).find("label"), function(e,i){return $(e).text().trim()});
        val = val.join("\n")
      $(".popover "+valID).text(val);
      } else if(valID==="#radios"){
        val = $.map($(e).find("label"), function(e,i){return $(e).text().trim()});
        val = val.join("\n");
        $(".popover "+valID).text(val);
	  } else if (valID==="#textarea") {
		val = $(e).text();
        $(".popover " + valID).val(val);
	  } else if (valID==="#codearea") {
		val = $(e).html();
        $(".popover " + valID).val(val);
      } else if(valID==="#button") {
        val = $(e).text();
        var type = $(e).find("button").attr("class").split(" ").filter(function(e){return e.match(/btn-.*/)});

        if(type.length === 0){
          $(".popover #color").val("btn-default");
        } else {
          $(".popover #color").val(type[0]);
        }

        val = $(e).find(".btn").text();
        $(".popover #button").val(val);
      } else {
        val = $(e).text();
        $(".popover " + valID).val(val);
      }
    });

	//popover accordion section collapse animation
	var firstTime = true;
	$('.accordion-section').click(function(){
		if (!$(this).find('.accordion').is(':visible')) {
			$(this).find('.accordion').show();
			$('.accordion').not($(this).find('.accordion')).hide();
		}
	});

	//validation extra options
	$('.popover #type').on('change',function(){
		showValidation($(this).val());
	});

	showValidation($('.popover #type').val());

	function showValidation(str) {
		if (str == "regex") {
			$('.popover .validate-regex').show('slow');
			$('.popover .validate-minmax').hide('slow');
			$('.popover .validate-match').hide('slow');
		} else if (str == "number" || str == "date") {
			$('.popover .validate-minmax').show('slow');
			$('.popover .validate-regex').hide('slow');
			$('.popover .validate-match').hide('slow');
		} else if (str == "match") {
			$('.popover .validate-match').show('slow');
			$('.popover .validate-regex').hide('slow');
			$('.popover .validate-minmax').hide('slow');
		} else {
			$('.popover .validate-regex').hide();
			$('.popover .validate-minmax').hide();
			$('.popover .validate-match').hide();
		}
	}

	//init tooltips
	$(".popover [data-toggle='tooltip']").tooltip();

	//click cancel on popover menu
    $(".popover").delegate(".btn-danger", "click", function(e){
      e.preventDefault();
      $active_component.popover("hide");
    });

	//click save on popover menu
    $(".popover").delegate(".btn-info", "click", function(e){
      e.preventDefault();

			var saved = $("#SFDSWFB-save").val();
			saved = JSON.parse(saved.replace(/[\x00-\x1F\x7F-\x9F]/g,"\\n"));
			var previousFormSettings = saved.data.slice();

			//check id if in this form
			if ($('.popover #id')[0] != undefined) {
			if (!checkId($('#id').val(),$(".popover").prevAll(".form-group").length-1)) { //check if ID is not unique
				var errorMsg = setTimeout(function() {
					loadDialogModal('Oops!', 'ID is not unique, please use a different ID');
				},100);
				return;
			}
			var curIndex = $(".popover").prevAll(".form-group").length-1;
			var oldId = saved.data[curIndex].id;
			var newId = $('#id').val();
			//if the id is changing
			if (oldId != newId) {
				saved = changeIds(oldId, newId, saved);
			}
	  }

	  var saved = $("#SFDSWFB-save").val();
		saved = JSON.parse(saved.replace(/[\x00-\x1F\x7F-\x9F]/g,"\\n"));
		//var previousFormSettings = saved;

      var inputs = $(".popover input");
			inputs.push($(".popover textarea")[0]);
			inputs.push($(".popover select"));

    $.each(inputs, function(i,e){
				var vartype = $(e).attr("id");

				var value = $active_component.find('[data-valtype="'+vartype+'"]')

				if(vartype==="placeholder"){
					$(value).attr("placeholder", $(e).val());
				}else if (vartype==="href"){
					$($active_component.find('a')).attr("href", $(e).val());
				}else if (vartype==="src"){
					$(value).attr("src", $(e).val());
				}else if (vartype==="textarea") {
					$(value).text($(e).val());
				}else if (vartype==="codearea") {
					$(value).html($(e).val());
				} else if (vartype==="checkbox"){
					if($(e).is(":checked")){
						$(value).attr("checked", true);
					}
					else{
						$(value).attr("checked", false);
					}
		  } else if (vartype==="option"){
					var options = $(e).val().split("\n");
					$(value).html("");
					$.each(options, function(i,e){
						br = i < options.length - 1 ? "\n" : ""; //add line breaks for each option but the last
						$(value).append("<option>"+e+"</option>"+br);
					});
		  } else if (vartype==="checkboxes"){
					var checkboxes = $(e).val().split("\n");
					$(value).html("<!-- Multiple Checkboxes -->");
					$.each(checkboxes, function(i,e){
						if(e.length > 0){
							br = i < checkboxes.length - 1 ? "\n" : ""; //add line breaks for each option but the last
							$(value).append('<label class="checkbox"><input type="checkbox" value="'+e+'">'+e+'</label>'+br);
						}
					});
		  } else if (vartype==="radios"){
				var group_name = $(".popover #name").val();
				var radios = $(e).val().split("\n");
				$(value).html("<!-- Multiple Radios -->");
				$.each(radios, function(i,e){
					if(e.length > 0){
					br = i < radios.length - 1 ? "\n" : ""; //add line breaks for each option but the last
					$(value).append('<label class="radio"><input type="radio" value="'+e+'" name="'+group_name+'">'+e+'</label>'+br);
					}
				});
			  $($(value).find("input")[0]).attr("checked", true)
		  } else if (vartype === "button"){
			var type =  $(".popover #color option:selected").val();
			$(value).find("button").text($(e).val()).attr("class", "btn "+type);
		  } else if (vartype === "required") {
			  if($(e).is(":checked")) {
				$active_component.attr("data-required","true");
				$(e).val("true");
			  } else {
				$active_component.removeAttr("data-required");
				$(e).val("false");
			  }
		  } else if (vartype === "value" || vartype === "name" || vartype === "id" || vartype === "class" || vartype === "regex" || vartype === "min" || vartype === "max" || vartype === "minlength" || vartype === "maxlength") {
			$active_component.attr("data-"+vartype,$(e).val());
		  } else if (vartype === ("type" || "match")) { //selects
			if (vartype == "type" && $(e).val() == "match") { //for match type validation
				$active_component.attr("data-match", $('#match').val());
			} else {
				$active_component.attr("data-"+vartype,$(e).val());
			}
		  } else {
			$(value).text($(e).val());
			//alert("not caught: "+vartype); //label, help, undefined
		  }

		  if (vartype != null) {
			  if ($(e).attr('name') == "title") {
				//save form title to json
				saved.settings.name = $(e).val();
			  } else {
			      if (vartype == "label" || vartype == "help" || vartype == "placeholder") {
				saved.data[$(".popover").prevAll(".form-group").length-1][vartype] = $(e).val();
				  } else if (vartype == "type" && $(e).val() == "match") { //for match type validation
				saved.data[$(".popover").prevAll(".form-group").length-1]["match"] = $('#match').val();
				  } else if (vartype == "value" && $(e).val() == "") {
				saved.data[$(".popover").prevAll(".form-group").length-1][vartype] = undefined;
			      } else if ($(e).val() != "") {
				saved.data[$(".popover").prevAll(".form-group").length-1][vartype] = $(e).val();
			      }
			  }
		  }
      });

	  //save calculations
	  if ($(".popover .calculation").length) {
		  var calculations = [];
		  calculations[0] = $(".popover .calculationId").eq(0).val();
		  var sc = 0;
		  $(".popover .calculation").each(function(n) {
			  sc++;
			  calculations[sc] = $(this).find(".calculationOperator").val();
			  sc++;
			  calculations[sc] = $(this).find(".calculationId").val();
		  });
		  var currentIndex = $(".popover").prevAll(".form-group").length-1;
		  saved.data[currentIndex]["calculations"] = calculations;
		  $('#SFDSWFB-target .form-group.component:eq('+currentIndex+')').attr("data-calculations", JSON.stringify(calculations));
	  }

	  //save conditionals
	  var currentIndex = $(".popover").prevAll(".form-group").length-1;
	  if ($(".popover .condition").length) {
		  var conditions = {};
		  conditions.showHide = false;
		  conditions.allAny = false;
		  conditions.condition = [];
		  $(".popover .condition").each(function(i) {
			  if (!conditions.showHide) conditions.showHide = $(this).find("select.showHide").val();
			  if (!conditions.allAny && $(this).find("select.allAny").length) conditions.allAny = $(this).find("select.allAny").val();
			  conditions.condition[i] = {};
			  conditions.condition[i].id = $(this).find(".conditionalId").val();
			  conditions.condition[i].op = $(this).find(".conditionalOperator").val();
			  conditions.condition[i].val = $(this).find(".conditionalValue").val();
		  });
		  saved.data[currentIndex]["conditions"] = conditions;
		  $('#SFDSWFB-target .form-group.component:eq('+currentIndex+')').attr("data-conditions", JSON.stringify(conditions));
	  } else {
		  if (typeof saved.data[currentIndex] != "undefined") {
			  delete saved.data[currentIndex]["conditions"];
			  $('#SFDSWFB-target .form-group.component:eq('+currentIndex+')').removeAttr("data-conditions");
		  }
	  }

	  //moved down, used to be in the loop for some reason?
	  $active_component.popover("hide");
	  $("#SFDSWFB-save").val(JSON.stringify(saved));
	  resizeHeight();
	  //auto save
		saveForm(previousFormSettings);
   });

  });  //end popover on click event

  //bind additional actions
  $("#SFDSWFB-navtab").delegate("#SFDSWFB-sourcetab", "click", function(e){
    genSource();
  });
  $("#SFDSWFB-7 input").change(function() {
	updateSettings();
  });

  /*
  $('#SFDSWFB-authors').tagsinput({
	confirmKeys: [13, 44, 32]
  });
  */

  $('[data-toggle="tooltip"]').tooltip();

  $('#SFDSWFB-7 .bootstrap-tagsinput').css('display','block');

}); //end document ready

function bindQuickDelete() {
	$('#SFDSWFB-target .form-group.component:not("[data-formtype=m14]")').unbind('mouseenter mouseleave');
	$('#SFDSWFB-target .form-group.component:not("[data-formtype=m14]")').on('mouseenter',function(){$(this).append('<i class="fas fa-times-circle" onclick="quickDelete(this)"></i>')});
	$('#SFDSWFB-target .form-group.component:not("[data-formtype=m14]")').on('mouseleave',function(){$(this).find('.fa-times-circle').remove()});
}

function quickDelete(obj) {
	existingPos = $(obj.parentNode).prevAll(".form-group").length;
	$('#SFDSWFB-target .form-group').eq(existingPos).remove();
	var saved = $("#SFDSWFB-save").val();
	saved = JSON.parse(saved.replace(/[\x00-\x1F\x7F-\x9F]/g,"\\n"));
	var previousFormSettings = saved.data.slice();

	saved.data.splice(existingPos, 1);
	$("#SFDSWFB-save").val(JSON.stringify(saved));
	saveForm(previousFormSettings);
	resizeHeight();
}

function genSource() {
	if (formId == 0) { //todo allow generate.php to parse json string objects
		$("#SFDSWFB-source").val("Please save your form before generating HTML.");
		return;
	}

	$("#SFDSWFB-snippet").text(embedCode(formId));

	$.get("/form/generate?id="+formId, function(data) {
		$("#SFDSWFB-source").val(data);
	});
}

function setComponentId($temp) {
	if ($temp.find(".component").attr("data-id") == undefined) {
		var componentId = createId($temp.find(".component").attr("title"));
		$temp.find(".component").attr("data-id", componentId);
		return componentId;
	} else {
		return $temp.find(".component").attr("data-id");
	}
}

function createId(title) {
	var count = 1;
	var newName = title.toLowerCase()
	newName = newName.replace(/ /g,"_");
	countName = newName;
	while (doesIdExist(countName) == true) {
		countName = newName+"_"+count;
		count++;
	}
	return countName;
}

function doesIdExist(str) {
	return $('#SFDSWFB-build').find("[data-id="+str+"]")[0] ? true : false;
}

function addAttr(str, componentId, dataFormType, dataValue, dataName, dataClass, dataType, dataRequired, dataMinLength, dataMaxLength, dataRegex, dataMin, dataMax) { //todo cleanup form params
	var obj = getEditables(str);
	if (componentId != undefined) obj['id'] = componentId; //warning, adding as a number not a string
	obj['formtype'] = dataFormType;
	if (dataValue != "") obj['value'] = dataValue;
	if (dataName != "") obj['name'] = dataName;
	if (dataClass != "") obj['class'] = dataClass;
	if (dataType != "") obj['type'] = dataType;
	if (dataRequired != "") obj['required'] = dataRequired;
	if (dataMinLength != "") obj['minlength'] = dataMinLength;
	if (dataMaxLength != "") obj['maxlength'] = dataMaxLength;
	if (dataRegex != "") obj['regex'] = dataRegex;
	if (dataMin != "") obj['min'] = dataMin;
	if (dataMax != "") obj['max'] = dataMax;
	return obj;
}
function getEditables(str) {
	var inputs = $(str).find(".valtype");
	var obj = {};
	$.each(inputs, function(i) {
		var key = $(inputs[i]).attr('data-valtype');
		var value = $(inputs[i]).text();
		if (key == "placeholder") {
			value = $(inputs[i]).attr('placeholder');
		}
		obj[key] = value;
	});
	return obj;
}
function getAttr(obj, field) {
	return $(obj).find("#"+field).val();
}
function loadForm() {
	var saved = $("#SFDSWFB-load").val();
	$("#SFDSWFB-save").val(saved);

	saved = JSON.parse(saved.replace(/[\x00-\x1F\x7F-\x9F]/g,"\\n"));

	$("#SFDSWFB-target").html(emptyForm);

	//iterate through data
	for (i in saved.data) {
		var newSection = $.parseHTML($(".form-group[data-formtype='"+saved.data[i]['formtype']+"']")[0].outerHTML);
		for (key in saved.data[i]) {
			if (key == "placeholder") {
				$(newSection).find("input").attr('placeholder', saved.data[i][key]);
			} else if (key == "id") { //id wasn't being loaded without this
			    $(newSection).attr('data-id',saved.data[i][key]);
			} else if (key == "value") {
                            $(newSection).attr('data-value',saved.data[i][key]);
			} else if (key == "class") {
                            $(newSection).attr('data-class',saved.data[i][key]);
			} else if (key == "name") {
                            $(newSection).attr('data-name',saved.data[i][key]);
			} else if (key == "required") {
				if (saved.data[i][key] == "false") {
							$(newSection).removeAttr("data-required", );
				}
			} else if (key == "match") {
                            $(newSection).attr('data-match',saved.data[i][key]);
			} else if (key != "formtype") {
				if (key == "checkboxes") {
					var checkboxes = saved.data[i][key];
					var value = "\n<!-- Multiple Checkboxes -->";
					$.each(checkboxes, function(i,e){
					  if(e.length > 0){
						value += '\n<label class="checkbox">\n<input type="checkbox" value="'+e+'">\n'+e+'\n</label>';
					  }
					});
					value += "\n  ";
					$(newSection).find("[data-valtype='"+key+"']").html(value);
				} else if (key == "radios") {
						var radios = saved.data[i][key];
				    var value = "<!--  Multiple Radios -->";
				    $.each(radios, function(i,e) {
					    if (e.length > 0) {
						value += '<label class="radio"><input type="radio" value="'+e+'">'+e+'</label>';
					    }
					});
					$(newSection).find("[data-valtype='"+key+"']").html(value);
				} else if (key == "option") {
					//console.log(saved.data[i][key]);
				    var options = saved.data[i][key];
				    var value = "\n<!-- Select Basic -->";
				    $.each(options, function(i,e) {
					    if (e.length > 0) {
									value += '\n<option value="'+e+'">'+e+'</option>';
					    }
						});
				  value += "\n  ";
					$(newSection).find("[data-valtype='"+key+"']").html(value);
				} else if (key == "button") {
					var color = saved.data[i]['color'] != undefined ? saved.data[i]['color'] : '';
					var value = '<button class="btn '+color+'">'+saved.data[i][key]+'</button>';
					$(newSection).find("[data-valtype='"+key+"']").html(value.replace(/^\s+|\s+$/gm,''));
				} else if (key == "conditions") {
					$(newSection).attr("data-conditions", JSON.stringify(saved.data[i][key]));
				} else if (key == "calculations") {
					$(newSection).attr("data-calculations", JSON.stringify(saved.data[i][key]));
				} else {
					$(newSection).find("[data-valtype='"+key+"']").html(saved.data[i][key]);
				}
			}
		}
		$("#SFDSWFB-target fieldset").append(newSection);
	}

	//iterate through settings
	for (s in saved.settings) {
	    if (s == "method") { //radio types
			$("#SFDSWFB-7 input[name=method][value="+saved.settings[s]+"]").attr("checked", "checked");
	    } else {
			$("#SFDSWFB-7 input[name="+s+"]").val(saved.settings[s]);
	    }
	}

	$('legend').text(saved.settings.name);

    bindQuickDelete();

  // check if csv and published
	var submitUrl = new URL('/form/submit', window.location.href);
	//if ((saved.settings.action).includes(submitUrl)) {
	if(saved.settings.backend == 'csv'){
		callAPI('/form/csv-published', {id : formId}, protectPublished)
	}

  // do additional call to get authors
	callAPI("/form/authors", {"id" : formId}, shareResponse);
}
function protectPublished(response) {
	if (response == 1) {
		$('.clickMenu').hide();
		$('#SFDSWFB-target').css("padding", "20px");
        $('#SFDSWFB-target').html('<h2>Your form is currently published.</h2><p>Editing is not allowed while your form is receiving submissions.</p><a href="javascript:void(0)" onclick="openCSV(\''+csvFile+'\')" class="btn btn-info">Open CSV File</a> &nbsp;<a href="javascript:void(0)" class="btn btn-info" onclick="confirmAction(\'clone\',\'doAction.php?action=clone\')">Clone Form</a> &nbsp;<a href="javascript:void(0)" onclick="confirmAction(\'purge\',\'doAction.php?action=purge\')" class="btn btn-danger">Purge Data</a>');
	}
}
function timeToAddSubmitButton(saved) {
	return saved.data.length == 1 ? true : false;
}
function addSubmitButton(saved) {
	saved.data.push({"button":"Submit","id":"submit","formtype":"m14","color":"btn-primary"});
	return saved;
}
function isUnique(cid,index) {
	var saved = $("#SFDSWFB-save").val();
	saved = JSON.parse(saved.replace(/[\x00-\x1F\x7F-\x9F]/g,"\\n"));

	for (i in saved.data) {
		if (i != index) {
			for (key in saved.data[i]) {
				if (key == "id") {
					if (saved.data[i][key] == cid) {
						return false;
					}
				}
			}
		}
	}
	return true;
}
function checkId(cid,i) {
	if (isUnique(cid,i)) {
		return true;
	} else {
		return false;
	}
}
function changeIds(oldId, newId, saved) {
	for (ci in saved.data) {
		if (saved.data[ci]["conditions"] != undefined) {
			for (con in saved.data[ci]["conditions"].condition) {
				if (saved.data[ci]["conditions"].condition[con].id == oldId) saved.data[ci]["conditions"].condition[con].id = newId;
			}
		}
		if (saved.data[ci]["calculations"] != undefined) {
			for (calc in saved.data[ci].calculations) {
				if ((calc % 2 == 0) && saved.data[ci].calculations[calc] == oldId) saved.data[ci].calculations[calc] = newId;
			}
		}
	}
	return saved;
}
function addCalculation(str) {
	//check if first conditional or not
	if ($(".popover-content .addCalculation").length == 0) {
		$('.popover-content .accordion-section.attributes .accordion').append($(".addCalculationContainer").html());
	} else {
		if ($(".popover-content .calculationLabel").length == 0) {
			$('.popover-content .addCalculation').before($(".firstCalculation").html());
		}
		$('.popover-content .addCalculation').before($(".calculationContainer").html());
		str = str == undefined ? $('.popover #id').val() : str;
		var ids = getMathIds(str);

		$(".popover-content .allMathIds").each(function() {
			if ($(this).val() == null) {
				var thisSelect = $(this);
				$.each(ids, function(i, item) {
					thisSelect.append($('<option>', {
						value: item,
						text:	item
					}));
				});
			}
		});
	}
}
function addConditional() {
	$(".popover-content .addConditional").before($(".conditional").html());
	var ids = getIds();
	$(".popover-content .allIds").each(function() {
		if ($(this).val() == null) {
			var thisSelect = $(this);
			$.each(ids, function(i, item) {
				thisSelect.append($('<option>', {
					value: item,
					text:	item
				}));
			});
		}
	});
	//check if first conditional or not
	if ($(".popover-content .conditionalLabel").length == 1) {
		$(".popover-content .conditionalLabel").text($(".popover-content #id").val()+" if");
		$(".popover-content .conditionalLabel").before($(".firstConditional").html());
	} else if ($(".popover-content .conditionalLabel").length == 2) {
		$(".popover-content .allIds:eq(0)").before($(".multipleConditionals").html());
	}
	if ($(".popover-content .conditionalLabel").length > 1) {
		$(".popover-content .allIds:last").before('<hr class="and"/>');
	}
}
function removeCalculation(obj) {
	if ($(obj).parent().parent().find(".calculation").length > 1) {
	} else {
		$('.popover-content .calculationLabel').remove();
		$('.popover-content .calculationId').remove();
	}
	$(obj).parent().remove();
}
function removeConditional(obj) {
	if ($(obj).parent().find("select.showHide").length) {
		if ($(".popover-content .conditionalLabel").length > 1) {
			$(".popover .conditionalLabel:eq(1)").text(" "+$(obj).parent().find("span.conditionalLabel").text());
			$(obj).parent().find("select.showHide").insertBefore('.popover .conditionalLabel:eq(1)');
		}
	}
	$(obj).parent().remove();
	if ($(".popover-content .conditionalLabel").length == 1) {
		if ($('.popover .allAny').length) $('.popover .allAny').remove();
		if ($('.popover hr.and').length) $('.popover hr.and').remove();
	}
}
function conditionalSelect(obj) {
	var valueInput = $(obj).next('.conditionalValue');
	if ($(obj).val() == "contains anything" || $(obj).val() == "is blank") {
		valueInput.val('');
		if (typeof valueInput.attr('readonly') == "undefined" || typeof valueInput.attr('readonly') == false) valueInput.attr('readonly', true);
	} else {
		valueInput.removeAttr('readonly');
	}
}
function getMathIds(str) {
	var ids = [];
	var saved = $("#SFDSWFB-save").val();
        saved = JSON.parse(saved.replace(/[\x00-\x1F\x7F-\x9F]/g,"\\n"));
	//saved = JSON.parse(saved);
	for (i in saved.data) {
		if (saved.data[i]["id"] != undefined) {
			if (saved.data[i].formtype == "d06" || saved.data[i].formtype == "d08" || saved.data[i].formtype == "s02" || saved.data[i].formtype == "s06" || saved.data[i].formtype == "s08" || saved.data[i].formtype == "m11") ids.push(saved.data[i]["id"]);
		}
	}
	var index = ids.indexOf(str);
	if (index !== -1) ids.splice(index, 1);
	return ids;
}
function getIds() {
	var ids = [];
	var saved = $("#SFDSWFB-save").val();
        saved = JSON.parse(saved.replace(/[\x00-\x1F\x7F-\x9F]/g,"\\n"));
	//saved = JSON.parse(saved);
	for (i in saved.data) {
		if (saved.data[i]["id"] != undefined) {
			ids.push(saved.data[i]["id"]);
		}
	}
	return ids;
}

function isReferenced(myId) {
	var arr = [];
	var saved = JSON.parse($("#SFDSWFB-save").val());
	for (i in saved.data) {
		if (saved.data[i].conditions != undefined) {
			for (c in saved.data[i].conditions.condition) {
				arr.push(saved.data[i].conditions.condition[c].id);
			}
		}
		if (saved.data[i].calculations != undefined) {
			for (d in saved.data[i].calculations) {
				if (d % 2 == 0) arr.push(saved.data[i].calculations[d]);
			}
		}
	}
	return arr.includes(myId);
}

function updateSettings() {
	var saved = $("#SFDSWFB-save").val();
	saved = JSON.parse(saved.replace(/[\x00-\x1F\x7F-\x9F]/g,"\\n"));
	var previousFormSettings = saved.data.slice();

	var newSettings = {};
	var useCSV = false;

	//iterate over inputs in settings tab
	$("#SFDSWFB-7 input").each(function(i) {
		if ($(this).attr("name") != "" && $(this).val() != "") {
		    if ($(this).attr("type") == "radio") {
				if ($(this).attr("name") == "backend") {
					var submitUrl = new URL('/form/submit', window.location.href);
					if ($(this).is(":checked") && $(this).val() == "db") {
						if ($('#SFDSWFB-7 input[name=action]').val() == submitUrl)
							$('#SFDSWFB-7 input[name=action]').val('');
						$(".csvFile").hide('fast');
						$(".confirmPage").hide('fast');
						$('#SFDSWFB-7 input[name=action]').removeAttr('readonly');
						newSettings[$(this).attr("name")] = $(this).val();
					} else if ($(this).is(":checked") && $(this).val() == "csv") {
						$('#SFDSWFB-7 input[name=action]').val(submitUrl);
						$(".confirmPage").show('fast');
						$('#SFDSWFB-7 input[name=action]').attr('readonly', true);
						newSettings[$(this).attr("name")] = $(this).val();
						useCSV = true;
					}
				} else {
						if ($(this).is(":checked")) {
							newSettings[$(this).attr("name")] = $(this).val();
						}
					}
		    } else {
					newSettings[$(this).attr("name")] = $(this).val();
		    }
		}
	});

	for (i in newSettings) {
	    saved.settings[i] = newSettings[i];
	}

	$("#SFDSWFB-save").val(JSON.stringify(saved));
	saveForm(previousFormSettings);
	if(useCSV)
		populateCSV();
}
function populateCSV() {
	if (csvFile && formId > 0) { //global
		showCSV(csvFile);
	} else if (formId) {
		callAPI('/form/getFilename', {id : formId, 'path' : true}, showCSV);
	}
}
function showCSV(response) {
	csvFile = response;
	$(".csvFile").show('fast');
	$(".csvFile > a").on('click', function(){openCSV(response)});
}
function openCSV(url) {
	window.open(url+"?sessid="+new Date().getTime(), "_blank");
}
function confirmAction(action) {
	//todo onunload logic
	var msg;
	if (action == "exit") {
		//msg = "You will lose any unsaved changes, are you sure you want to exit?";
		return goHome();
	} else if (action == "clone") {
		//msg = "You will lose any unsaved changes, are you sure you want to clone this form?";
		url = "/form/clone";
		return callAPI(url, {"id" : formId}, goHome);
	} else if (action == "delete") {
		msg = "Are you sure you want to delete this form?";
		url = "/form/delete";
	} else if (action == "purge") {
		msg = "Purging will erase all of your form submission data permanently! To make a new revision, clone your form. Only purge if you're sure it's test/junk data. Are you sure you want to purge?";
		url = "/form/purge-csv";
	}

	var callback;
	if (action == "delete" || action == "purge") {
		callback = function(){callAPI(url, {"id" : formId}, goHome)};
	}

	loadConfirmModal("Warning!", msg, callback);
}
function share() {
	$('#SFDSWFB-authors').slideUp();
	callAPI("/form/share", {"id" : formId, "email" : $('#SFDSWFB-authors input').val()}, shareResponse);
}
function shareResponse(response) {
	if (response.status && typeof response.data != "undefined") {
		$('#SFDSWFB-existingAuthors').html(response.data);
		if (response.data.includes(",")) initESS();
	} else if (!response.status) {
		if (typeof response.message != "undefined") {
			loadDialogModal("Attention",response.message);
		}
	} else {
		loadDialogModal("Error Sharing Form", "Please enter a valid email and try again or contact SFDS.");
	}
}
function goHome(back) {
	if (back != undefined) {
		window.history.back();
		return;
	}
	$('.container').hide();
	callAPI("/form/getForms", {}, loadHome);
	$('.forms').html('<i class="fas fa-circle-notch fa-spin"></i>');
    $(".content").show();
}
function saveForm(previousFormSettings) {
	if(isSaving) //global to keep track of form save state
		return; // could implement a while loop here to wait
	isSaving = true;
	//requires GLOBALS to be set
	$('.saveStatus').text('Saving...');
	$('.saveSpinner').show();
	var form = {};
	form.content = $("#SFDSWFB-save").val();
	form.previousContent = previousFormSettings;
	form.id = formId;
	form.user_id = user_id;
	form.api_token = api_token;

	var settings = {
		"async": true,
		"crossDomain": true,
		"url": "/form/save",
		"method": "POST",
		"headers": {
			"authorization": "Bearer "+api_token,
			"content-type": "application/x-www-form-urlencoded",
			"cache-control": "no-cache"
		},
		"timeout": 3000,
		"data": form
	}
	$.ajax(settings).done(function (data) {
		$('.saveStatus').text('Form Saved!');
		formId = data.id;
		$('.saveSpinner').hide();
		isSaving = false; // saveForm is done, allow save again.
	})
	.fail(function() {
		$('.saveSpinner').hide();
		loadDialogModal("Oops!", "Error saving form. Please try again or contact SFDS.");
		isSaving = false; // saveForm fails, allow save again.
	});
}
var autofillNames = null;
function loadNames(obj) {
    var selected = $(obj).val();
    if (selected == "0") {
	autofillNames = null;
    } else {
	$.get('/assets/js/'+selected+".json", function(data) {
		autofillNames = data.fields;
		//console.log(autofillNames);
	});
    }
}
var substringMatcher = function(strs) {
    return function findMatches(q, cb) {
		var matches, substringRegex;

		// an array that will be populated with substring matches
		matches = [];

		// regex used to determine if a string contains the substring `q`
		substrRegex = new RegExp(q, 'i');

		// iterate through the pool of strings and for any string that
		// contains the substring `q`, add it to the `matches` array
		$.each(strs, function(i, str) {
			if (substrRegex.test(str)) {
				matches.push(str);
			}
		});

		cb(matches);
    };
}
function embedCode(id) {

	var embedUrl = new URL('/form/embed', window.location.href);
	var assetsUrl = new URL('/assets/', window.location.href);

	var str = "<!-- If possible, place the following in your <head> tag. -->"+
	"\n"+
	"<script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js\"></script>\n"+
	"<script src=\"https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.10.1/validator.min.js\"></script>\n"+
	"<script src=\""+assetsUrl+"js/error-msgs.js\"></script>"+
	"\n"+
	"<link href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\" rel=\"stylesheet\" />\n"+
	"<link rel=\"stylesheet\" href=\""+assetsUrl+"css/form-base.css\" />\n"+
	"\n"+
	"<!-- Insert the following in the <body>, wherever\n"+
	"you would like the form to appear. -->"+
	"\n"+
	"<script src=\""+embedUrl+"?id="+id+"\"></script>\n"+
	"<div id=\"SFDSWF-Container\"></div>";
	return str;

}
function callAPI(url, dataObj, callback) {
	var settings = {
		"async": true,
		"crossDomain": true,
		"url": url,
		"method": "POST",
		"headers": {
			"authorization": "Bearer "+api_token,
			"content-type": "application/x-www-form-urlencoded",
			"cache-control": "no-cache"
		},
		"data": {
			"user_id": user_id,
			"api_token": api_token,
		}
	}
	for (i in dataObj) {
		settings.data[i] = dataObj[i];
	}
	$.ajax(settings).done(function (response) {
		callback(response);
	});
}
function loadHome(response) {
	$('.forms').html('');
	allForms = {};
	$.each(response, function(index, element) {
		allForms[element.id] = element;
		//console.log(element);
		if (element.content != undefined) addedElement = $('.forms').append('<div>').append('<a href="javascript:void(0)" onclick="loadContent('+element.id+')" class="recent btn btn-default btn-md btn-block">'+element.content.settings.name+'</a>');
	});
}
function loadContent(id) {
	$(".content").hide(0, function(){
		if (id == undefined) {
			if (history.state == undefined) history.pushState({formId : 0} , null, "/home?new");
			formId = 0;
			$('#SFDSWFB-load').html('{"settings":{"action":"","method":"POST","name":"My Form"},"data":[]}');
			$('#SFDSWFB-snippet').text('Save your form to get embed code');
			$('#SFDSWFB-source').val('');
			$('#SFDSWFB-7 input:not([type=radio])').val('');
			$("input[name=backend][value=db]").attr('checked', true);
			$("input[name=method][value=POST]").attr('checked', true);
			$("#SFDSWFB-names").val('0');
			loadForm();
			$('#welcome').modal();
		} else {
			//return content
			$('#SFDSWFB-load').html(JSON.stringify(allForms[id].content));
			formId = id;
			if (history.state == undefined) history.pushState({formId : id}, null, "/home?id="+id);
			var submitUrl = new URL('/form/submit', window.location.href);
			if (allForms[id].content.settings.action == submitUrl) {
				$("input[name=backend][value=csv]").attr('checked', true);
				$(".confirmPage").show();
				$('#SFDSWFB-7 input[name=action]').attr('readonly', true);
				populateCSV();
			}
			loadForm();
		}
		$('.container').show();
	});
}
function resizeHeight() {
	//calculate height, animation code only
	var oldHeight = $('#SFDSWFB-target').height();
	//calculate new height, animation code only
	$('#SFDSWFB-target').css('height', "auto");
	var newHeight = $('#SFDSWFB-target').height();
	$('#SFDSWFB-target').css('height', (oldHeight+12)+"px");
	setTimeout(function() {
		$('#SFDSWFB-target').css('height', (newHeight+12)+"px");
	}, 100);
}

var eventSource = false;
function initESS() {
	if (!eventSource) {
		eventSource = new EventSource("/form/push?form_id="+formId);
		var listener = function (event) {
			var type = event.type;
			//alert(type + ": " + (type === "message" ? event.data : es.url));
			if (event.type === "message") {
				var newContent = JSON.parse(event.data);
				//console.log(newContent);
				$('.saveStatus').text('Shared Updating...');
				$('.saveSpinner').show();
				$("#SFDSWFB-load").val(newContent.content);
				loadForm();
				setTimeout(function(){
					$('.saveStatus').text('');
					$('.saveSpinner').hide();
				}, 2000);
			}
		};
		eventSource.addEventListener("open", listener);
		eventSource.addEventListener("message", listener);
		eventSource.addEventListener("error", listener);
	}
}

function loadDialogModal(title, body) {
	$('#modal-dialog .modal-title').text(title);
	$('#modal-dialog .modal-body p').text(body);
	$('#modal-dialog').modal();
}

function loadConfirmModal(title, body, callback) {
	$('#modal-confirm .modal-title').text(title);
	$('#modal-confirm .modal-body p').text(body);
	$('#modal-confirm .btn-primary').on('click', callback);
	$('#modal-confirm').modal();
}