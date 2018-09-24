var emptyForm;
var formId = 0;
$(document).ready(function(){
  emptyForm = $("#SFDSWFB-target").html();
  $("form").delegate(".component", "mousedown", function(md){
    $(".popover").remove();

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
      form: 120
    }
    var type;
    var saved = $("#SFDSWFB-save").val();
    saved = JSON.parse(saved.replace(/[\x00-\x1F\x7F-\x9F]/g,"\\n"));

	if (saved.settings == undefined) saved.settings = new Object();
	if (saved.data == undefined) saved.data = new Array();

    if($this.parent().parent().parent().parent().attr("id") === "SFDSWFB-components"){
      type = "main";
    } else {
      type = "form";
    }

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

        $temp.css({"top"      : mm_mouseY - half_box_height + "px",
          "left"      : mm_mouseX - half_box_width  + "px"});

//        if ( mm_mouseX > tar_pos.left &&
//          mm_mouseX < tar_pos.left + $target.width() + $temp.width()/2 &&
//        if ( mm_mouseX > tar_pos.left + $target.width() + $temp.width() &&
	if ( mm_mouseX > $("#SFDSWFB-build").offset().left && 
          mm_mouseX < tar_pos.left + $target.width() + $target.width() + $temp.width() &&
          mm_mouseY > tar_pos.top &&
          mm_mouseY < tar_pos.top + $target.height() + $temp.height()/2
          ){
            $("#SFDSWFB-target").css("background-color", "#fafdff");
            $target_component.css({"border-top" : "1px solid white", "border-bottom" : "none"});
            tops = $.grep($target_component, function(e){
              return ($(e).position().top -  mm_mouseY + half_box_height > 0 && $(e).attr("id") !== "SFDSWFB-legend");
            });
            if (tops.length > 0){
              $(tops[0]).css("border-top", "1px solid #22aaff");
            } else{
              if($target_component.length > 0){
                $($target_component[$target_component.length - 1]).css("border-bottom", "1px solid #22aaff");
              }
            }
          } else{
            $("#SFDSWFB-target").css("background-color", "#fff");
            $target_component.css({"border-top" : "1px solid white", "border-bottom" : "none"});
            $target.css("background-color", "#fff");
          }
      });

      $("body").delegate("#SFDSWFB-temp", "mouseup", function(mu){
        mu.preventDefault();

		//disallow if dragged in less than a second
		if (dragExisting && Date.now() - clickNow < 1000) {
			//populate id field, almost all fields have id
			var componentId;
			if ($temp.find(".component").attr("data-id") == undefined) {
				componentId = Date.now()
				$temp.find(".component").attr("data-id", componentId);
			} else {
				componentId = $temp.find(".component").attr("data-id");
			}
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
			genSource();
			return;
		}
		
        var mu_mouseX = mu.pageX;
        var mu_mouseY = mu.pageY;
        var tar_pos = $target.position();

        $("#SFDSWFB-target .component").css({"border-top" : "1px solid white", "border-bottom" : "none"});

		//calculate height, animation code only
		var oldHeight = $('#SFDSWFB-target').height();			

        // acting only if mouse is in right place
        //if (mu_mouseX + half_box_width > tar_pos.left &&
         // mu_mouseX - half_box_width < tar_pos.left + $target.width() &&
		//        if (mu_mouseX + half_box_width > tar_pos.left + $target.width() + $temp.width() + half_box_width &&
		if (mu_mouseX > $("#SFDSWFB-build").offset().left &&
          mu_mouseX - half_box_width < tar_pos.left + $target.width() + $target.width() + half_box_width &&
          mu_mouseY + half_box_height > tar_pos.top &&
          mu_mouseY - half_box_height < tar_pos.top + $target.height()
          ){
            $temp.attr("style", null);

			//populate id field, almost all fields have id
			var componentId;
			if ($temp.find(".component").attr("data-id") == undefined) {
				componentId = Date.now()
				$temp.find(".component").attr("data-id", componentId);
			} else {
				componentId = $temp.find(".component").attr("data-id");
			}

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

			//animation effect
			var flashIndex = $(tops[0]).prevAll(".form-group").length != 0 ? $(tops[0]).prevAll(".form-group").length : $('#SFDSWFB-target .component').length - 1;
			$('#SFDSWFB-target .component:eq('+flashIndex+')').css('opacity', 0);
			$('#SFDSWFB-target .component:eq('+flashIndex+')').animate({opacity: 1}, 500);

          } else {		  
            // no add
            $("#SFDSWFB-target .component").css({"border-top" : "1px solid white", "border-bottom" : "none"});
            tops = [];
          }
		  
			//calculate new height, animation code only
			$('#SFDSWFB-target').css('height', "auto");
			var newHeight = $('#SFDSWFB-target').height();
			$('#SFDSWFB-target').css('height', (oldHeight+12)+"px");
			setTimeout(function() {
				$('#SFDSWFB-target').css('height', (newHeight+12)+"px");
			}, 100);

		  $("#SFDSWFB-save").val(JSON.stringify(saved));

        //clean up & add popover
        $target.css("background-color", "#fff");
        $(document).undelegate("body", "mousemove");
        $("body").undelegate("#SFDSWFB-temp","mouseup");
        $("#SFDSWFB-target .component").popover({trigger: "manual"});
        $temp.remove();
        genSource();
      });
    }, delays[type]);

    $(document).mouseup(function () {
      clearInterval(delayed);
      return false;
    });
    $(this).mouseout(function () {
      clearInterval(delayed);
      return false;
    });
  });

  var genSource = function(){
    var $temptxt = $("<div>").html($("#SFDSWFB-build").html());

        var saved = $("#SFDSWFB-save").val();
        saved = JSON.parse(saved.replace(/[\x00-\x1F\x7F-\x9F]/g,"\\n"));

        //iterate through data
	for (d in saved['data']) {
		for (key in saved['data'][d]) {
			if (key != "label" && key != "placeholder" && key != "help" && key != "formtype") { //values we don't need to insert
				var curIndex = parseInt(d)+1;
				
				var inputType = ''; //get input type
				if ($($temptxt).find(".component:eq("+curIndex+") textarea")[0]) {
					inputType = "textarea";
				} else if ($($temptxt).find(".component:eq("+curIndex+") select")[0]) {
					inputType = "select";
				} else if ($($temptxt).find(".component:eq("+curIndex+") input")[0]) {
					inputType = "input";
				} else if ($($temptxt).find(".component:eq("+curIndex+") p")[0]) {
				    inputType = "p";
                                } else if ($($temptxt).find(".component:eq("+curIndex+") h1")[0]) {
                                    inputType = "h1";
				} else if ($($temptxt).find(".component:eq("+curIndex+") h2")[0]) {
                                    inputType = "h2";
				} else if ($($temptxt).find(".component:eq("+curIndex+") h3")[0]) {
                                    inputType = "h3";
 				} //todo find all other dom types
				//alert(key + " " + inputType);

				if (key == "required") { //required is a different type of attribute
					if (saved['data'][d][key] == "true") {
						$($temptxt).find(".component:eq("+curIndex+") "+inputType).prop("required", true);
					} else {
					    $($temptxt).find(".component:eq("+curIndex+") "+inputType).removeAttr("required");
					}
				} else if (key == "regex") { //regex is entered as pattern
				    $($temptxt).find(".component:eq("+curIndex+") "+inputType).attr("pattern", saved['data'][d][key]);
				} else if (key == "option" && inputType == "select") { //syntax is different
				    //alert(saved['data'][d][key]);
				    $($temptxt).find(".component:eq("+curIndex+") select").html('');
				    var options = saved['data'][d][key].split("\n");
				    $.each(options, function (i, item) {
					     $($temptxt).find(".component:eq("+curIndex+") select").append($('<option>', {value : item, text : item}));
				    });
				} else if (key == "value" && inputType == "select") {
				    $($temptxt).find(".component:eq("+curIndex+") select option[value='"+saved['data'][d][key]+"']").attr("selected", true);
				} else { //everything else gets added to main inputType
				    $($temptxt).find(".component:eq("+curIndex+") "+inputType).attr(key, saved['data'][d][key]);
				}
			}
		}
	}

    //iterate through settings
    for (s in saved['settings']) {
	if (s == "action" || s == "method") {
	    $($temptxt).find("form").attr(s, saved['settings'][s]);
	}
    }

    //scrubbbbbbb
    $($temptxt).find(".component").attr({"title": null,
      "data-original-title":null,
      "data-content": null,
      "data-placeholder": null,
      "data-help": null,
      "data-formtype": null,
      "data-value": null,
      "data-name": null,
//    "data-id": null,
//	  "data-class": null,
      "data-required": null,
      "data-type": null,
	  "data-regex": null,
	  "data-minlength": null,
	  "data-maxlength": null,
	  "data-min": null,
	  "data-max": null,
      "rel": null,
      "trigger":null,
      "data-html":null,
      "style": null});
    $($temptxt).find(".valtype").attr("data-valtype", null).removeClass("valtype");
    $($temptxt).find(".component").removeClass("component");
    $($temptxt).find("form").attr({"id":  null, "style": null});
    $($temptxt).find("input").attr({"radios": null, "checkboxes": null});
    $($temptxt).find("p, h1, h2, h3, textarea").attr({"codearea": null, "textarea": null});

	//hack to render page containers, also check to see if form is sectional or paginated
	if($($temptxt).find("hr.pb")[0] != null) {
		//add nav section and name first section if defined, otherwise use form name
		var section1;
		if ($("#SFDSWFB-section1").val() != "") {
			section1 = $("#SFDSWFB-section1").val();
		} else {
			section1 = $("SFDSWFB-legend").text();
		}
		$($temptxt).prepend("<ul class='form-section-nav'><li class='active'>"+section1+"</li></ul>");
		//wrap form
		$($temptxt).find(".form-group").wrapAll("<div class='sections-container'/>");
		//parse out separators
		var pageLabels = [];
		$.each($($temptxt).find("hr.pb"), function(i, v) {
			pageLabels.push($(v).parent().siblings("label").html());
			$(v).parents(".form-group").replaceWith('<hr>');
		});
		var pageSections = $($temptxt).find(".sections-container").html();
		pageSections = pageSections.split("<hr>");
		var newContent = "<div class='form-section-header active'>"+section1+"</div>";
		for (i in pageSections) {
			//var thisPageLabel = pageLabels[i] != undefined ? "<div class='form-section-header'>"+pageLabels[i]+"</div>" : '';
			var thisPageLabel = '';
			if (pageLabels[i] != undefined) {
				thisPageLabel = "<div class='form-section-header'>"+pageLabels[i]+"</div>";
				$($temptxt).find('.form-section-nav').append("<li>"+pageLabels[i]+"</li>");
			}
			var firstSection = i == 0 ? " active" : "";
			var lastSection = i == pageSections.length - 1 ? "<button class='btn btn-lg form-section-next submit'>Submit</button>" : "<a class='btn btn-lg form-section-next' href='javascript:void(0)'>Next</a>";
			newContent += "<div class='form-section"+firstSection+"'>"+pageSections[i]+"<div class='form-group'><a class='btn btn-lg form-section-prev' href='javascript:void(0)'>Previous</a>"+lastSection+"</div></div>"+thisPageLabel;
		}
		$($temptxt).find(".sections-container").html(newContent);
	}
	
	//todo modify embeddable html with form settings
	//$($temptxt).find("form").attr('action',$("#SFDSWFB-action").val());
	//$($temptxt).find("form").attr('method',"post");
    $("#SFDSWFB-source").val($temptxt.html().replace(/\n\ \ \ \ \ \ \ \ \ \ \ \ /g,"\n"));
  }

  //activate legend popover
  $("#SFDSWFB-target .component").popover({trigger: "manual"});
  //popover on click event
  $("#SFDSWFB-target").delegate(".component", "click", function(e){
    e.preventDefault();
    $(".popover").hide();
    var $active_component = $(this);
    $active_component.popover("show");
    //hack to fix popover y position
    var posOffset = $('.popover').offset();
    $('.popover').offset({top:posOffset.top-50});
	
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

	//populate validation rules
	if (e.currentTarget.attributes['data-required']) $(".popover #required").prop("checked",true);
	if (e.currentTarget.attributes['data-type']) $(".popover #type").val(e.currentTarget.attributes['data-type'].value);
	if (e.currentTarget.attributes['data-regex']) $(".popover #regex").val(e.currentTarget.attributes['data-regex'].value);
	if (e.currentTarget.attributes['data-minlength']) $(".popover #minlength").val(e.currentTarget.attributes['data-minlength'].value);
	if (e.currentTarget.attributes['data-maxlength']) $(".popover #maxlength").val(e.currentTarget.attributes['data-maxlength'].value);
	if (e.currentTarget.attributes['data-min']) $(".popover #min").val(e.currentTarget.attributes['data-min'].value);
	if (e.currentTarget.attributes['data-max']) $(".popover #max").val(e.currentTarget.attributes['data-max'].value);
	
	//add conditional
	$(".popover-content hr").before($(".conditionals").html());

    var valtypes = $active_component.find(".valtype");
    $.each(valtypes, function(i,e){
      var valID ="#" + $(e).attr("data-valtype");
      var val;

	  //on popup, loop through valtypes (in 2nd input chunk)
	  //alert('valID: '+valID+' val: '+val);

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
        //$(".popover #name").val($(e).find("input").attr("name"));
      } else if(valID==="#inline-checkboxes"){
        val = $.map($(e).find("label"), function(e,i){return $(e).text().trim()});
        val = val.join("\n")
          $(".popover "+valID).text(val);
      } else if(valID==="#inline-radios"){
        val = $.map($(e).find("label"), function(e,i){return $(e).text().trim()});
        val = val.join("\n")
          $(".popover "+valID).text(val);
        $(".popover #name").val($(e).find("input").attr("name"));
	  } else if (valID==="#textarea") {
		val = $(e).text();
        $(".popover " + valID).val(val);
	  } else if (valID==="#codearea") {
		val = $(e).html();
        $(".popover " + valID).val(val);
      } else if(valID==="#button") {
        val = $(e).text();
        var type = $(e).find("button").attr("class").split(" ").filter(function(e){return e.match(/btn-.*/)});
        $(".popover #color option").attr("selected", null);
        if(type.length === 0){
          $(".popover #color #default").attr("selected", "selected");
        } else {
          $(".popover #color #"+type[0]).attr("selected", "selected");
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
	$('.accordion-section').hover(function(){
		if (!$(this).find('.accordion').is(':visible')) {
			$(this).find('.accordion').show('fast');
			$('.accordion').not($(this).find('.accordion')).hide('fast');
		}
	});

	//validation extra options
	$('.popover #type').on('change',function(){
		if ($(this).val() == "regex") {
			$('.popover .validate-regex').show('slow');
			$('.popover .validate-minmax').hide('slow');
			$('.popover .validate-match').hide('slow');
		} else if ($(this).val() == "number" || $(this).val() == "date") {
			$('.popover .validate-minmax').show('slow');
			$('.popover .validate-regex').hide('slow');
			$('.popover .validate-match').hide('slow');
		} else if ($(this).val() == "match") {
			$('.popover .validate-match').show('slow');
			$('.popover .validate-regex').hide('slow');
			$('.popover .validate-minmax').hide('slow');
		} else {
			$('.popover .validate-regex').hide('slow');
			$('.popover .validate-minmax').hide('slow');
			$('.popover .validate-match').hide('slow');
		}
	});

	//get ids for validation match field
	var ids = getIds();
	$(".popover-content #match").html("<option value=''></option>");
	$.each(ids, function(i, item) {
		$(".popover-content #match").append($('<option>', {
			value: item,
			text:	item
		}));
	});


    $(".popover").delegate(".btn-danger", "click", function(e){
      e.preventDefault();
      $active_component.popover("hide");
    });

    $(".popover").delegate(".btn-info", "click", function(e){
      e.preventDefault();

	  //check id if in this form
	  if ($('#id')[0] != undefined) {
		if (!checkId($('#id').val(),$(".popover").prevAll(".form-group").length-1)) {
			var errorMsg = setTimeout(function() {
				alert('ID is not unique, please use a different ID');
			},100);
			return;
		}
	  }
	  
	  var saved = $("#SFDSWFB-save").val();
	  saved = JSON.parse(saved.replace(/[\x00-\x1F\x7F-\x9F]/g,"\\n"));
	    
      var inputs = $(".popover input");
      inputs.push($(".popover textarea")[0]);
	  inputs.push($(".popover select"));
      $.each(inputs, function(i,e){
		  var vartype = $(e).attr("id");
		  var value = $active_component.find('[data-valtype="'+vartype+'"]')

		  //alert('vartype: '+vartype+' value: '+value);

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
			  $(value).append("\n      ");
			  $(value).append($("<option>").text(e));
			});
		  } else if (vartype==="checkboxes"){
			var checkboxes = $(e).val().split("\n");
			$(value).html("\n      <!-- Multiple Checkboxes -->");
			$.each(checkboxes, function(i,e){
			  if(e.length > 0){
				$(value).append('\n      <label class="checkbox">\n        <input type="checkbox" value="'+e+'">\n        '+e+'\n      </label>');
			  }
			});
			$(value).append("\n  ")
		  } else if (vartype==="radios"){
			var group_name = $(".popover #name").val();
			var radios = $(e).val().split("\n");
			$(value).html("\n      <!-- Multiple Radios -->");
			$.each(radios, function(i,e){
			  if(e.length > 0){
				$(value).append('\n      <label class="radio">\n        <input type="radio" value="'+e+'" name="'+group_name+'">\n        '+e+'\n      </label>');
			  }
			});
			$(value).append("\n  ")
			  $($(value).find("input")[0]).attr("checked", true)
		  } else if (vartype==="inline-checkboxes"){
			var checkboxes = $(e).val().split("\n");
			$(value).html("\n      <!-- Inline Checkboxes -->");
			$.each(checkboxes, function(i,e){
			  if(e.length > 0){
				$(value).append('\n      <label class="checkbox inline">\n        <input type="checkbox" value="'+e+'">\n        '+e+'\n      </label>');
			  }
			});
			$(value).append("\n  ")
		  } else if (vartype==="inline-radios"){
			var radios = $(e).val().split("\n");
			var group_name = $(".popover #name").val();
			$(value).html("\n      <!-- Inline Radios -->");
			$.each(radios, function(i,e){
			  if(e.length > 0){
				$(value).append('\n      <label class="radio inline">\n        <input type="radio" value="'+e+'" name="'+group_name+'">\n        '+e+'\n      </label>');
			  }
			});
			$(value).append("\n  ")
			  $($(value).find("input")[0]).attr("checked", true)
		  } else if (vartype === "button"){
			var type =  $(".popover #color option:selected").attr("id");
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
			$active_component.attr("data-"+vartype,$(e).val());
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
			      } else if ($(e).val() != "") {
				saved.data[$(".popover").prevAll(".form-group").length-1][vartype] = $(e).val();
			      }
			  }
		  }
      });
	  //moved down, used to be in the loop for some reason?
	  $active_component.popover("hide");
	  $("#SFDSWFB-save").val(JSON.stringify(saved));
	  setTimeout(function(){genSource()}, 150);
    });
  });
  $("#SFDSWFB-navtab").delegate("#SFDSWFB-sourcetab", "click", function(e){
    genSource();
  });
  $("#SFDSWFB-7 input").change(function() {
	updateSettings();
	genSource();
  });
  $('#SFDSWFB-authors').tagsinput({
	confirmKeys: [13, 44, 32]
  });
  $('#SFDSWFB-7 .bootstrap-tagsinput').css('display','block');
});

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
			} else if (key != "formtype") {
				if (key == "checkboxes") {
					var checkboxes = saved.data[i][key].split("\n");
					var value = "\n      <!-- Multiple Checkboxes -->";
					$.each(checkboxes, function(i,e){
					  if(e.length > 0){
						value += '\n      <label class="checkbox">\n        <input type="checkbox" value="'+e+'">\n        '+e+'\n      </label>';
					  }
					});
					value += "\n  ";
					$(newSection).find("[data-valtype='"+key+"']").html(value);
				} else if (key == "radios") {
				    var radios = saved.data[i][key].split("\n");
				    var value = "\n     <!--  Multiple Radios -->";
				    $.each(radios, function(i,e) {
					    if (e.length > 0) {
						value += '\n      <label class="radio">\n          <input type="radio" value="'+e+'">\n       '+e+'\n      </label>';
					    }
					});
				        value += "\n  ";
					$(newSection).find("[data-valtype='"+key+"']").html(value);
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
function addConditional() {
	$(".popover-content .addConditional").before($(".conditional").html());
	var ids = getIds();
	$(".popover-content .allIds").html('');
	$.each(ids, function(i, item) {
		$(".popover-content .allIds").append($('<option>', {
			value: item,
			text:	item
		}));
	});
	//check if first conditional or not
	if ($(".popover-content .conditionalLabel").length == 1) {
		$(".popover-content .conditionalLabel").text($(".popover-title").text()+" if");
		$(".popover-content .conditionalLabel").before($(".firstConditional").html());
	} else if ($(".popover-content .conditionalLabel").length == 2) {
		$(".popover-content .allIds:eq(0)").before($(".multipleConditionals").html());
	}
	if ($(".popover-content .conditionalLabel").length > 1) {
		$(".popover-content .allIds:last").before('<hr class="and"/>');
	}
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
function updateSettings() {
	var saved = $("#SFDSWFB-save").val();
	//saved = JSON.parse(saved);
        saved = JSON.parse(saved.replace(/[\x00-\x1F\x7F-\x9F]/g,"\\n"));

	var newSettings = {};

	//iterate over inputs in settings tab
	$("#SFDSWFB-7 input").each(function(i) {
		if ($(this).attr("name") != "" && $(this).val() != "") {
		    if ($(this).attr("type") == "radio") {
			if ($(this).is(":checked")) {
			    newSettings[$(this).attr("name")] = $(this).val();
			}
		    } else {
			newSettings[$(this).attr("name")] = $(this).val();
		    }
		}
	});

	for (i in newSettings) {
	    saved.settings[i] = newSettings[i];
	}
	console.log(saved);

	$("#SFDSWFB-save").val(JSON.stringify(saved));
}
function toggleClickMenu() {
	if ($('.clickMenu ul').is(":visible")) {
		$('.clickMenu ul').hide('fast');
	} else {
		$('.clickMenu ul').show('fast');
	}
}
function confirmAction(action, url) {
	//todo onunload logic
	var msg;
	if (action == "exit") {
		msg = "Warning! You have unsaved changes, are you sure you want to exit?";
	} else if (action == "clone") {
		msg = "Warning! You have unsaved changes, are you sure you want to clone this form?";
		url += "&id="+formId;
	} else if (action == "delete") {
		msg = "Warning! Are you sure you want to delete this form?";		
		url += "&id="+formId;
	}
	var go = confirm(msg);
	if (go) {
		document.location = url;
	}
}
function saveForm() {
        $('.clickMenu button:eq(0)').text('Saving...');
        $('.clickMenu button:eq(0)').addClass('disabled');
	$('.saveSpinner').show();
        var form = {};
	form.content = $("#SFDSWFB-save").val();
	form.id = formId;
	$.post("save.php", form)
	.done(function(data) {
		savedForm = JSON.parse(data);
		$('.clickMenu button:eq(0)').text('Form Saved!');
		formId = savedForm['id'];
		setTimeout(function(){
			$('.clickMenu button:eq(0)').text('Save Changes');
			$('.clickMenu button:eq(0)').removeClass('disabled');
			$('.saveSpinner').hide();
	    }, 3000);
	})
	.fail(function() {
		$('.clickMenu button:eq(0)').text('Save Changes');
		$('.clickMenu button:eq(0)').removeClass('disabled');
		$('.saveSpinner').hide();
		alert("Error saving form. Please try again or contact SFDS.")
	});	
}
var autofillNames = null;
function loadNames(obj) {
    var selected = $(obj).val();
    if (selected == "0") {
	autofillNames = null;
    } else {
	$.get('/webform/js/'+selected+".json", function(data) {
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
};