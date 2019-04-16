var SFDSerrorMsgs = function() {
	jQuery('#SFDSWF-Container form input[required=true], #SFDSWF-Container form select[required=true] #SFDSWF-Container form textarea[required=true]').attr('data-required-error','Please fill in this field.');
	jQuery('#SFDSWF-Container form input[type=tel]').attr('data-type-error','Please enter a valid phone number.'); //doesn't seem to validate phone numbers
	jQuery('#SFDSWF-Container form input[type=email]').attr('data-type-error','Please enter a valid email address.');
	jQuery('#SFDSWF-Container form input[type=number]').attr('data-required-error','Please enter a number.'); //does not work as a type error
	jQuery('#SFDSWF-Container form input[type=date]').attr('data-required-error','Please enter a valid date.'); //does not work as a type error
	jQuery('#SFDSWF-Container form input[type=url]').attr('data-type-error','Please enter a web address.');
	jQuery('#SFDSWF-Container form input[type=file]').attr('data-required-error','Please upload a file.'); //does not work as a type error
	jQuery('#SFDSWF-Container form').validator(); //init validator at end
}