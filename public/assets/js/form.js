/**
 * Represent a Form
 *
 * @param {Object} obj
 * contains:
 *
 * {Integer} id
 * {Object} content
 * {DateTime} created_at
 * {DateTime} updated_at
 * {DateTime} deleted_at
 *
 * @constructor
 */
let Form = function(obj) {
	if (obj === undefined) {
		obj = {}
		obj.id = 0
		obj.content = {
			settings: {
				action: "",
				method: "POST",
				name: "My Form"
			},
			data: [{
				button: "Submit",
				id: "submit",
				formtype: "m14",
				color: "btn-primary"
			}]
		}
	}
	
	const {
		id,
		content,
		created_at,
		updated_at,
		deleted_at,
	} = obj
	
    Object.assign(this, obj)	
	
	for (i in this.content.data) {
		this.content.data[i] = new Item(this.content.data[i])
	}
}

/**
 * Generates a new Item object based on the item's form type parameter
 *
 * @param {String} formType
 */
Form.prototype.generateNewItem = function(formType) {
	var formTypeNameMapping = {
		'i02': 'Text',
		'c02': 'Name',
		'c08': 'Address',
		'c10': 'City',
		'c14': 'Zip',
		'c04': 'Email',
		'c06': 'Phone',
		'd02': 'Date',
		'd04': 'Time',
		'd10': 'URL',
		'm13': 'Upload File',
		'd06': 'Number',
		'd08': 'Price',
		'i14': 'Textarea',
		's02': 'Select',
		's14': 'State',
		's15': 'State',
		's16': 'State',
		's06': 'Checkboxes',
		's08': 'Radio',
		'm11': 'Hidden',
		'm08': 'Paragraph',
		'm10': 'HTML',
		'm02': 'H1',
		'm04': 'H2',
		'm06': 'H3',
		'm16': 'Page_Separator'
	}
	var formTypeTypeMapping = {
		'i02': 'text',
		'c02': 'text',
		'c08': 'text',
		'c10': 'text',
		'c14': 'text',
		'c04': 'email',
		'c06': 'tel',
		'd02': 'date',
		'd04': 'time',
		'd10': 'url',
		'm13': 'file',
		'd06': 'number',
		'd08': 'number',
		'i14': null,
		's02': null,
		's14': null,
		's15': null,
		's16': null,
		's06': 'checkbox',
		's08': 'radio',
		'm11': 'hidden',
		'm08': null,
		'm10': null,
		'm02': null,
		'm04': null,
		'm06': null,
		'm16': null
	}
	return this.nameNewItem(formType, formTypeTypeMapping[formType], formTypeNameMapping[formType])
}

/**
 * Assigns a new Item label, id, and name based on form type
 *
 * @param {String} formType
 *
 * @returns {Object}
 */
Form.prototype.nameNewItem = function(formType, inputType, str) {
	return {
		label: str,
		id: this.makeNewId(str),
		name: this.makeNewName(str),
		type: inputType,
		formtype: formType
	}
}

/**
 * Gets all the ids in the form
 *
 * @returns {Array}
 */
Form.prototype.getIds = function() {
	var ids = [];
	for (i in this.content.data) {
		if (this.content.data[i]["id"] != undefined) {
			ids.push(this.content.data[i]["id"]);
		}
	}
	return ids;
}	

/**
 * Generates a unique id based on the label string
 *
 * @param {String} label
 *
 * @returns {String}
 */
Form.prototype.makeNewId = function(label) {
	return this.createUnique(label, "id")
}

/**
 * Generates a unique form name based on the label string
 *
 * @param {String} label
 *
 * @returns {String}
 */
Form.prototype.makeNewName = function(label) {
	return this.createUnique(label, "name")
}

/**
 * Generates a unique id or name based on the label string
 *
 * @param {String} label
 * @param {String} type (id or name)
 *
 * @returns {String}
 */
Form.prototype.createUnique = function(label,type) {
	var count = 1;
	var newName = label.toLowerCase();
	newName = newName.replace(/ /g,"_");
	countName = newName;
	while (this.doesItExist(countName,type) == true) {
		countName = newName+"_"+count;
		count++;
	}
	return countName;
}

/**
 * Searches the form to see if the value of type exists in the form
 *
 * @param {String} value
 * @param {String} type (id or name)
 *
 * @returns {Boolean}
 */
Form.prototype.doesItExist = function(value, type, skipIndex) {
	for (i in this.content.data) {
		if ((skipIndex !== undefined && i != skipIndex) || skipIndex === undefined) {
			if (this.content.data[i][type] === value) return true
		}
	}
	return false
}

/**
 * Assigns form builder app current form id to zero (new and unsaved)
 */
Form.prototype.loadNewForm = function() {
	fb.formId = 0
}

/**
 * Assigns form builder app current form id from loaded form
 *
 * @param {Integer} id
 */
Form.prototype.loadExistingForm = function(id) {
	fb.formId = id
	this.populateSettings()
}

/**
 * Recreates form object without functions and strips undefined and null parameters
 *
 * @param {Object} formObj
 *
 * @returns {Object}
 */
Form.prototype.preparePostData = function(formObj) {
	var newObj = {}
	for (i in formObj) {
		if (typeof formObj[i] !== "function" && formObj[i] !== null && i !== "content") newObj[i] = formObj[i]
	}
	newObj.content = {}
	newObj.content.settings = formObj.content.settings
	newObj.content.data = []	
	for (a in formObj.content.data) {
		newObj.content.data[a] = {}
		for (b in formObj.content.data[a]) {
			if (typeof formObj.content.data[a][b] !== "function" && formObj.content.data[a][b] !== undefined && formObj.content.data[a][b] !== null) newObj.content.data[a][b] = formObj.content.data[a][b]
		}
	}
	newObj.content = JSON.stringify(newObj.content)
	newObj.user_id = fb.user_id
	return newObj
}


/**
 * Saves the form
 */
Form.prototype.saveForm = function() {
	if(fb.isSaving) return // keep track of form save state
	fb.isSaving = true
	//saving
	//form.previousContent = previousFormSettings;
	//form.api_token = api_token;

	var settings = {
		"async": true,
		"crossDomain": true,
		"url": "/form/save",
		"method": "POST",
		"headers": {
			"authorization": "Bearer "+fb.api_token,
			"content-type": "application/x-www-form-urlencoded",
			"cache-control": "no-cache"
		},
		"data": this.preparePostData(this)
	}
	$.ajax(settings).done(function (data) {
		//todo for new forms
		//if (fb.formId === 0) fb.fbView.startForm(data.id)
		//saved
		//fb.formId = data.id
		//handle response
		if( (typeof data.status) !== 'undefined' && data.status == 0){
			fb.loadDialogModal("Warning", data.message)
		}
		fb.isSaving = false // saveForm is done, allow save again.
		fb.fbView.loadPreview()
	})
	.fail(function() {
		//done saving
		fb.loadDialogModal("Oops!", "Error saving form. Please try again or contact SFDS.")
		fb.isSaving = false // saveForm fails, allow save again.
	});
}

/**
 * Saves changes to item attributes
 */
Form.prototype.modifyItem = function() {
	var self = this

	var oldId = self.content.data[$('#SFDSWFB-list .item.selected').eq(0).data('index') - 1].id
	var newId = $('#SFDSWFB-attributes input[name=id]').val()
	if (oldId !== newId) self.renameId(oldId, newId)
	
	$('#SFDSWFB-attributes input, #SFDSWFB-attributes textarea').each(function(){
		if ($(this).attr('name') !== '') {
			self.content.data[$('#SFDSWFB-list .item.selected').eq(0).data('index') - 1][$(this).attr('name')] = $(this).val()
		}
	})
	this.saveForm()
}

/**
 * Adds a new Item determined by the form type parameter into the form at the selected index
 *
 * @param {String} formType
 */
Form.prototype.insertItem = function(formType) {
	this.content.data.splice(this.getSelectedIndex() - 1, 0, new Item(this.generateNewItem(formType)))
	this.saveForm()
}

/**
 * Moves an Item in the form from one index to another
 *
 * @param {Integer} origin
 * @param {Integer} dest
 */
Form.prototype.moveItem = function(origin, dest) {
	if (dest > origin) dest--
	this.content.data.splice(dest, 0, this.content.data.splice(origin, 1)[0])
	this.saveForm()
}

/**
 * Deletes an Item from the form at the given index
 *
 * @param {Integer} itemIndex
 */
Form.prototype.deleteItem = function(itemIndex) {
	this.content.data.splice(itemIndex, 1)
	this.saveForm()
}

/**
 * Gets the index of the Item from the Navigation window
 *
 * @returns {Integer}
 */
Form.prototype.getSelectedIndex = function() {
	return $('#SFDSWFB-list .spacer.selected').eq(0).data('index')
}

/**
 * Clone a form
 */
Form.prototype.clone = function() {
	fb.callAPI('/form/clone', { 'id': fb.formId }, fb.goHome)
}

/**
 * Asks if you really want to delete your form
 */
Form.prototype.confirmDelete = function() {
	var msg = 'Are you sure you want to delete this form?'
	var url = '/form/delete'
	var callback = function () { fb.callAPI(url, { 'id': fb.formId }, fb.goHome) }
	fb.loadConfirmModal('Warning!', msg, callback)
}

/**
 * Checks if an id exists in the form
 *
 * @param {String} myId
 *
 * @returns {Boolean}
 */
Form.prototype.isReferenced = function(myId) {
  var arr = []
  for (i in this.content.data) {
    if (this.content.data[i].conditions != undefined) {
      for (con in this.content.data[i].conditions.condition) {
        arr.push(this.content.data[i].conditions.condition[con].id)
      }
    }
    if (this.content.data[i].calculations != undefined) {
      for (calc in this.content.data[i].calculations) {
        if (calc % 2 == 0) arr.push(this.content.data[i].calculations[calc])
      }
    }
	//todo probably check webhooks
  }
  return arr.includes(myId)
}

/**
 * Renames all references to an existing id to the new name
 *
 * @param {String} oldId
 * @param {String} newId
 */
Form.prototype.renameId = function(oldId, newId) {
  for (i in this.content.data) {
    if (this.content.data[i]['conditions'] != undefined) {
      for (con in this.content.data[i]['conditions'].condition) {
        if (this.content.data[i]['conditions'].condition[con].id == oldId) this.content.data[i]['conditions'].condition[con].id = newId
		//todo check if this affects the actual conditions
      }
    }
    if (this.content.data[i]['calculations'] != undefined) {
      for (calc in this.content.data[i].calculations) {
        if ((calc % 2 == 0) && this.content.data[i].calculations[calc] == oldId) this.content.data[i].calculations[calc] = newId
      }
    }
	//todo probably check webhooks
  }
}

















Form.prototype.populateSettings = function() {
	for (i in this.content.settings) {
		if (typeof this.content.settings[i] !== "function") $('#SFDSWFB-settings input[name='+i+']').val(this.content.settings[i])
	}
	//todo needs a little extra work for CSV stuff
}

Form.prototype.saveSettings = function() {
	var self = this

	$('#SFDSWFB-settings input').each(function(){
		if ($(this).attr('name') !== '') {
			self.content.settings[$(this).attr('name')] = $(this).val()
		}
	})
	this.saveForm()
}