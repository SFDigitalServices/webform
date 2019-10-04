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
				name: "My Form",
				backend: "db"
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
 * Assigns form builder app current form id to zero (new and unsaved)
 */
Form.prototype.loadNewForm = function() {
	fb.formId = 0
	var pc = this.preparePostData(this)
	pc.content = JSON.parse(pc.content)
	fb.previousContent = JSON.stringify(pc.content.data)
}

/**
 * Assigns form builder app current form id from loaded form
 *
 * @param {Integer} id
 */
Form.prototype.loadExistingForm = function(id) {
  if (this.id === 0) this.id = id
	fb.formId = id
	var pc = this.preparePostData(this)
	pc.content = JSON.parse(pc.content)
	fb.previousContent = JSON.stringify(pc.content.data)
	fb.fbView.populateSettings()
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
		if (typeof formObj[i] !== "function" && formObj[i] !== null && i !== "content") {
      newObj[i] = formObj[i]
    }
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
	newObj.previousContent = fb.previousContent
	newObj.user_id = fb.user_id
	return newObj
}


/**
 * Saves the form
 */
Form.prototype.saveForm = function() {
	if(fb.isSaving) return // keep track of form save state
	fb.isSaving = true
	var saveData = this.preparePostData(this)
	//saving
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
		"data": saveData
	}
	$.ajax(settings).done(function (data) {
		//saved
		fb.isSaving = false // saveForm is done, allow save again.
		saveData.content = JSON.parse(saveData.content)
		fb.previousContent = JSON.stringify(saveData.content.data)
		//handle response
		if (fb.formId === 0) {
			fb.fbView.formsCollection.forms[data.id] = fb.fbView.formsCollection.forms[0]
			fb.fbView.startForm(data.id)
		} else {
			if( (typeof data.status) !== 'undefined' && data.status == 0){
				fb.loadDialogModal("Warning", data.message)
			}
			fb.fbView.loadPreview()
		}
	})
	.fail(function() {
		//done saving
		fb.loadDialogModal("Oops!", "Error saving form. Please try again or contact SFDS.")
		fb.isSaving = false // saveForm fails, allow save again.
	});
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
	var callback = function () {
    fb.callAPI(url, { 'id': fb.formId }, function() {
      delete fb.fbView.formsCollection.forms[fb.formId]
      fb.fbView.deleteForm(fb.formId)
      fb.goHome()
    })
  }
	fb.loadConfirmModal('Warning!', msg, callback)
}

/**
 * Save changes to the form settings
 */
Form.prototype.saveSettings = function() {
	var self = this

	$('#SFDSWFB-settings input, #SFDSWFB-settings select').each(function(){
		if ($(this).attr('name') !== '' && $(this).attr('name') !== undefined) {
			self.content.settings[$(this).attr('name')] = $(this).val()
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
	this.content.data.splice($('#SFDSWFB-list .spacer.selected').eq(0).data('index') - 1, 0, new Item({'formtype' : formType}, this.getIds(), this.getNames()))
	this.saveForm()
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
		if ($(this).attr('name') !== '' && $(this).attr('name') !== undefined && $(this).val() !== "") {
			self.content.data[$('#SFDSWFB-list .item.selected').eq(0).data('index') - 1][$(this).attr('name')] = $(this).val()
		}
	})

  if ($('#required').length) self.content.data[$('#SFDSWFB-list .item.selected').eq(0).data('index') - 1].required = $('#required').checked ? 'true' : 'false';
	self.applyConditionals()
	self.applyCalculations()
	self.applyWebhooks()
	self.saveForm()
}

/**
 * Saves changes to conditionals to the form object
 */
Form.prototype.applyConditionals = function() {
	var self = this

	if ($('#SFDSWFB-attributes .condition').length) {
		var conditions = {}
		conditions.showHide = false
		conditions.allAny = false
		conditions.condition = []
		$('#SFDSWFB-attributes .condition').each(function (i) {
			if (!conditions.showHide) conditions.showHide = $(this).find('select.showHide').val()
			if (!conditions.allAny && $(this).find('select.allAny').length) conditions.allAny = $(this).find('select.allAny').val()
			conditions.condition[i] = {}
			conditions.condition[i].id = $(this).find('.conditionalId').val()
			conditions.condition[i].op = $(this).find('.conditionalOperator').val()
			conditions.condition[i].val = $(this).find('.conditionalValue').val()
		})
		self.content.data[$('#SFDSWFB-list .item.selected').eq(0).data('index') - 1].conditions = conditions
	} else {
    if (self.content.data[$('#SFDSWFB-list .item.selected').eq(0).data('index') - 1].conditions !== null) {
      delete self.content.data[$('#SFDSWFB-list .item.selected').eq(0).data('index') - 1].conditions
    }
	}
}

/**
 * Saves changes to calculations to the form object
 */
Form.prototype.applyCalculations = function() {
	var self = this

	if ($('#SFDSWFB-attributes .calculation').length) {
		var calculations = []
		calculations[0] = $('#SFDSWFB-attributes .calculationId').eq(0).val()
		var sc = 0
		$('#SFDSWFB-attributes .calculation').each(function (n) {
			sc++
			calculations[sc] = $(this).find('.calculationOperator').val()
			sc++
			calculations[sc] = $(this).find('.calculationId').val()
		})
		self.content.data[$('#SFDSWFB-list .item.selected').eq(0).data('index') - 1].calculations = calculations
	} else {
    if (self.content.data[$('#SFDSWFB-list .item.selected').eq(0).data('index') - 1].calculations !== null) {
      delete self.content.data[$('#SFDSWFB-list .item.selected').eq(0).data('index') - 1].calculations
    }
	}
}

/**
 * Saves changes to webhooks to the form object
 */
Form.prototype.applyWebhooks = function() {
	var self = this

	if ($('#SFDSWFB-attributes .webhookSelect').val() == 'Use a Webhook') {
		var webhooks = {}
		webhooks.ids = []
		$('#SFDSWFB-attributes .webhookId').each(function (i) {
			webhooks.ids.push($('#SFDSWFB-attributes .webhookId').eq(i).val())
		})
		webhooks.endpoint = $('#SFDSWFB-attributes .webhookEndpoint').val()
		webhooks.responseIndex = $('#SFDSWFB-attributes .webhookResponseIndex').val()
		webhooks.method = $('#SFDSWFB-attributes .webhookMethod').val()
		webhooks.optionsArray = $('#SFDSWFB-attributes .webhookOptionsArray').val() == 'Will Contain Many Options' ? 'true' : 'false'
		webhooks.delimiter = $('#SFDSWFB-attributes .webhookDelimiter').val()
		webhooks.responseOptionsIndex = $('#SFDSWFB-attributes .webhookIndex').val()
		self.content.data[$('#SFDSWFB-list .item.selected').eq(0).data('index') - 1].webhooks = webhooks
	} else {
    if (self.content.data[$('#SFDSWFB-list .item.selected').eq(0).data('index') - 1].webhooks !== null) {
      delete self.content.data[$('#SFDSWFB-list .item.selected').eq(0).data('index') - 1].webhooks
    }
	}
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
 * Gets all the ids in the form
 *
 * @returns {Array}
 */
Form.prototype.getIds = function() {
	var ids = [];
	for (i in this.content.data) {
		if (this.content.data[i].id != undefined) {
			ids.push(this.content.data[i].id);
		}
	}
	return ids;
}

/**
 * Gets all the names in the form
 *
 * @returns {Array}
 */
Form.prototype.getNames = function() {
	var names = [];
	for (i in this.content.data) {
		if (this.content.data[i].name != undefined) {
			names.push(this.content.data[i].name);
		}
	}
	return names;
}

/**
 * Gets all the formtypes that are number/calculation compatible
 *
 * @returns {Array}
 */
Form.prototype.getNumberTypes = function() {
	return ['d06', 'd08', 's02', 's06', 's08', 'm11']
}

/**
 * Gets all the ids that are numeric/calculation compatible that are in the form
 *
 * @param {String} fieldId
 *
 * @returns {Array}
 */
Form.prototype.getMathIds = function(fieldId) {
	var ids = []
	var numberTypes = this.getNumberTypes()
	for (i in this.content.data) {
		if (this.content.data[i].id != undefined) {
			if(numberTypes.includes(this.content.data[i].formtype)) ids.push(this.content.data[i].id)
		}
	}
	var index = ids.indexOf(fieldId)
	if (index !== -1) ids.splice(index, 1)
	return ids
}

/**
 * Searches the form to see if the value of type exists in the form
 *
 * @param {String} value
 * @param {String} type (id or name)
 * @param {Integer} skipIndex
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
 * Checks if an id exists in the form
 *
 * @param {String} myId
 *
 * @returns {Boolean}
 */
Form.prototype.isReferenced = function(myId) {
	var specialFunctionIds = this.getSpecialFunctionIds()

  for (c in specialFunctionIds) {
    for (i in specialFunctionIds[c]) {
      for (d in specialFunctionIds[c][i]) {
        if (specialFunctionIds[c][i][d].includes(myId)) return true
      }
    }
  }
	return false
}

/**
 * Renames all references to an existing id to the new name
 *
 * @param {String} oldId
 * @param {String} newId
 */
Form.prototype.renameId = function(oldId, newId) {
	var specialFunctionIds = this.getSpecialFunctionIds()

  for (c in specialFunctionIds) {
    for (i in specialFunctionIds[c]) {
      for (d in specialFunctionIds[c][i]) {
        if (c == "conditionIds") {
          if (specialFunctionIds[c][i][d] == oldId) {
            this.content.data[i].conditions.condition[d].id = newId
          }
        } else if (c == "calculationIds") {
          if (specialFunctionIds[c][i][d] == oldId) this.content.data[i].calculations[d] = newId
        } //todo check webhooks and make this better
      }
    }
  }
}

/**
 * Gather all ids from special functions: conditionals, calculations, webhooks
 *
 * @returns {Object}
 */
Form.prototype.getSpecialFunctionIds = function() {
	var obj = {}
	obj.conditionIds = this.getConditionIds()
	obj.calculationIds = this.getCalculationIds()
	//todo probably check webhooks
	return obj
}

/**
 * Gather all ids from conditionals
 *
 * @returns {Object} {itemIndex: [id, id, id]}
 */
Form.prototype.getConditionIds = function() {
	var obj = {}
	for (i in this.content.data) {
		if (this.content.data[i].conditions != undefined) {
      obj[i] = []
			for (con in this.content.data[i].conditions.condition) {
				obj[i].push(this.content.data[i].conditions.condition[con].id)
			}
		}
	}
	return obj
}

/**
 * Gather all ids from calculations
 *
 * @returns {Object} {itemIndex: [id, id, id]}
 */
Form.prototype.getCalculationIds = function() {
	var obj = {}
	for (i in this.content.data) {
		if (this.content.data[i].calculations != undefined) {
      obj[i] = []
			for (calc in this.content.data[i].calculations) {
				if (calc % 2 == 0) obj[i].push(this.content.data[i].calculations[calc])
			}
		}
	}
	return obj
}
