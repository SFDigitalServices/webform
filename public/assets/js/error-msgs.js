var SFDSerrorMsgs = function() {
	jQuery('#SFDSWF-Container input[required], #SFDSWF-Container select[required] #SFDSWF-Container textarea[required]').attr('data-error','This field cannot be blank.');
	jQuery('#SFDSWF-Container input[type=tel]').attr('data-error','You need to enter a valid phone number.'); //doesn't seem to validate phone numbers
	jQuery('#SFDSWF-Container input[type=email]').attr('data-error','You need to enter a valid email address.');
	jQuery('#SFDSWF-Container input[type=number]').attr('data-error','You need to enter a number.'); //does not work as a type error
	jQuery('#SFDSWF-Container input[type=date]').attr('data-error','You need to enter a valid date.'); //does not work as a type error
	jQuery('#SFDSWF-Container input[type=url]').attr('data-error','You need to enter a web address.');
	jQuery('#SFDSWF-Container input[type=file]').attr('data-error','You need to upload a file.'); //does not work as a type error
	jQuery('#SFDSWF-Container form').validator(); //init validator at end
}