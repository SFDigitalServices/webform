/**
 * Represents many Forms
 *
 * @param {Array} response
 *
 * @constructor
 */
let FormsCollection = function(response) {
    // Here we store the Form objects
    this.forms = []
	for (i in response) {
		if (response[i] != null && response[i].id != undefined) {
			this.forms[response[i].id] = new Form(response[i])
		}
	}
}
