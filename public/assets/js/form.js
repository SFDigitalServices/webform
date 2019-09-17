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
 * Utility function to write current Form object to debug
 */
Form.prototype.writeDebug = function() {
	$('#SFDSWFB-form').val(JSON.stringify(this.content))
}


/**
 * Generates a new Item object based on the item's form type parameter
 *
 * @param {String} formType
 */
Form.prototype.generateNewItem = function(formType) {
	var formTypeMapping = {
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
	return this.nameNewItem(formType, formTypeMapping[formType])
}

/**
 * Assigns a new Item label, id, and name based on form type
 *
 * @param {String} formType
 *
 * @returns {Object}
 */
Form.prototype.nameNewItem = function(formType, str) {
	return {
		label: str,
		id: this.makeNewId(str),
		name: this.makeNewName(str),
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
 * @param {String} type
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
 * Searches the navigation list to see if the name or id exists in the form
 *
 * @param {String} label
 * @param {String} type
 *
 * @returns {String}
 */
Form.prototype.doesItExist = function(label,type) {
	var bool;
	if (type == "id") {
		bool = $('#SFDSWFB-list').find("[data-id="+label+"]")[0] ? true : false;
	} else if (type == "name") {
		bool = false
		for (i in this.content.data) {
			if (this.content.data[i].name == label) bool = true
		}
	}
	return bool;
}

/**
 * Assigns form builder app current form id to zero (new and unsaved)
 */
Form.prototype.loadNewForm = function() {
	fb.formId = 0
	this.writeDebug()
}

/**
 * Assigns form builder app current form id from loaded form
 *
 * @param {Integer} id
 */
Form.prototype.loadExistingForm = function(id) {
	fb.formId = id
	this.writeDebug()
}

/**
 * Saves the form
 */
Form.prototype.saveForm = function() {
	return alert('form saving is disabled')
	if(fb.isSaving) return // keep track of form save state
	fb.isSaving = true;
	//show saving
	//form.previousContent = previousFormSettings;
	//form.api_token = api_token;

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
		"data": this
	}
	$.ajax(settings).done(function (data) {
		//saved
		formId = data.id
		//handle response
		if( (typeof data.status) !== 'undefined' && data.status == 0){
			loadDialogModal("Warning", data.message)
		}
		fb.isSaving = false // saveForm is done, allow save again.
	})
	.fail(function() {
		//done saving
		loadDialogModal("Oops!", "Error saving form. Please try again or contact SFDS.")
		isSaving = false // saveForm fails, allow save again.
	});
	this.writeDebug()
}

/**
 * Saves changes to item attributes
 */
Form.prototype.modifyItem = function() {
	var self = this
	
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

