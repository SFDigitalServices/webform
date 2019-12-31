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

/**
 * Save changes to the form settings
 */
FormsCollection.prototype.updateForms = function(response) {
	var self = this

  for (i in response) {
    if (response[i] != null && response[i].id != undefined) {
      this.forms[response[i].id] = new Form(response[i])
    }
  }

  if (typeof fb.fbView.formsCollection.forms[0] == "object") fb.fbView.formsCollection.forms.shift()
}
