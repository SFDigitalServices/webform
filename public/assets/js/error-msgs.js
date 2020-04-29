/* injects error messages into form dom */
var SFDSerrorMsgs = function() {
	jQuery('#SFDSWF-Container input[required]:not([type=number]), #SFDSWF-Container textarea[required]').attr('data-error','This field cannot be blank.');
	jQuery('#SFDSWF-Container input[data-formtype=c02]').attr('data-error','You need to enter a name.');
	jQuery('#SFDSWF-Container input[data-formtype=c08]').attr('data-error','You need to enter an address.');
	jQuery('#SFDSWF-Container input[data-formtype=c10]').attr('data-error','You need to enter a city.');
	jQuery('#SFDSWF-Container input[data-formtype=c14]').attr('data-error','You need to enter a zip.');
	jQuery('#SFDSWF-Container input[data-formtype=d06]').attr('data-error','You need to enter a number.');
	jQuery('#SFDSWF-Container input[data-formtype=d08]').attr('data-error','You need to enter a dollar amount.');
	jQuery('#SFDSWF-Container input[data-formtype=d04]').attr('data-error','You need to enter a time.');
	jQuery('#SFDSWF-Container select[required]').attr('data-error','You need to select an item in the list.');
	jQuery('#SFDSWF-Container input[type=tel]').attr('data-error','You need to enter a valid phone number.');
	jQuery('#SFDSWF-Container input[type=email]').attr('data-error','You need to enter a valid email address.');
	jQuery('#SFDSWF-Container input[type=date]').attr('data-error','You need to enter a valid date.');
	jQuery('#SFDSWF-Container input[type=url]').attr('data-error','You need to enter a web address.');
	jQuery('#SFDSWF-Container input[type=file]').attr('data-error','You need to upload a file.');
	jQuery('#SFDSWF-Container form').validator(); //init validator at end
}