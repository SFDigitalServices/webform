/**
 * Hold the formbuilder presentation logic
 *
 * Here we manipulate the DOM
 *
 * @param {FormsCollection} formsCollection - where we manage our forms
 * @constructor
 */
let FbView = function(formsCollection) {
    this.formsCollection = formsCollection
}

/**
 * Init DOM events
 */
FbView.prototype.initEvents = function() {
	var self = this
	
	self.listForms()
	self.bindInsertItems()
	self.bindSystemButtons()

	if (fb.startedEarly) self.startForm()
}

/**
 * Bind click events to all the system buttons
 */
FbView.prototype.bindSystemButtons = function() {
	var self = this

	$('a.clone-button').on('click', function() {
		self.formsCollection.forms[fb.formId].clone()
	})
	
	$('a.delete-button').on('click', function() {
		self.formsCollection.forms[fb.formId].confirmDelete()
	})
	
	$('a.preview-window').on('click', function() {
		fb.openPreviewWindow()
	})
	$('a.embed-toggle').on('click', function() {
		self.showMiddlePanel('SFDSWFB-embed')
		self.genSource()
	})
	
	$('a.settings-toggle').on('click', function() {
		self.showMiddlePanel('SFDSWFB-settings')
	})
	
	$('a.horizontal-toggle').on('click', function() {
		self.toggleMiddlePanel()
	})

	$('#SFDSWFB-settings .apply-button').on('click', function() {
		self.formsCollection.forms[fb.formId].saveSettings()
	})
	
	$('#SFDSWFB-settings .revert-button').on('click', function() {
		self.formsCollection.forms[fb.formId].populateSettings()
	})
	
	$('#SFDSWFB-names').on('change', function() {
		fb.loadNames(this)
	})
	
}

/**
 * Bind a click event to each insert button
 */
FbView.prototype.bindInsertItems = function() {
	var self = this
	
	$('#SFDSWFB-insert a').on('click', function() {
		var index = $('#SFDSWFB-list .spacer.selected').eq(0).data('index') - 1
		self.formsCollection.forms[fb.formId].insertItem($(this).data('formtype'))
		self.populateList()
		self.editItem($('#SFDSWFB-list .field').eq(index))
	})
}

/**
 * List all the forms on the welcome page
 */
FbView.prototype.listForms = function() {
	var self = this
	
	$('.forms').html('')
	
	for (i in this.formsCollection.forms) {
		$('.forms').append('<div>').append(fb.view.formLink(this.formsCollection.forms[i]))
	}
	
	$('.welcomeBox .btn-info').off()
	$('.welcomeBox .btn-info').on('click', function() {
		self.startForm()
	})

	$('a.start-form').on('click', function() {
		self.startForm($(this).data('id'))
	})
}

/**
 * Called when starting a form, new or existing
 *
 * @param {Integer} id
 */
FbView.prototype.startForm = function(id) {
	if (id == undefined) {
		this.formsCollection.forms[0] = new Form()
		this.formsCollection.forms[0].loadNewForm()
		fb.addBrowserState(0, '/home?new')
		$('#welcome').modal()
	} else {
		this.formsCollection.forms[id].loadExistingForm(id)
		fb.addBrowserState(id, '/home?id=' + id)
		// do additional call to get authors
		fb.callAPI('/form/authors', { 'id': id }, fb.shareResponse)
	}
	this.populateList()
	this.loadPreview()
	$('body > div.content').hide()
	$('.editorContainer').show()
}

/**
 * Loads the form preview in an iframe
 */
FbView.prototype.loadPreview = function(sectionId) {
	var scrollTo = $('#SFDSWFB-list .item.selected').length != "undefined" ? '&sectionId=' + $('#SFDSWFB-list .item.selected').eq(0).data('id') : ''
	$('#SFDSWFB-preview').html(fb.view.previewIframe(fb.formId,scrollTo))
}

/**
 * Recreates the Navigation window from the Form
 */
FbView.prototype.populateList = function() {	
	this.unselectList()
	var html = ''
	var count = 1
	var formData = this.formsCollection.forms[fb.formId].content.data
	for (i in formData) {
		if (i < formData.length - 1) { //do not show last item, button
			html += fb.view.listItem(formData[i].id, count, count < 10 ? "0" + count : count)
			count++
		}
	}
	html += fb.view.listSpacer(count)
	$('#SFDSWFB-list').html(html)
	this.bindListButtons()
}

/**
 * Binds click events to the Navigation list items buttons
 */
FbView.prototype.bindListButtons = function() {
	var self = this
	
	$('#SFDSWFB-list .item').on('click', function() {
		self.editItem($(this))
	})
	$('#SFDSWFB-list .fa-sort').on('click', function() {
		self.sortItem($(this))
	})
	$('#SFDSWFB-list .fa-times').on('click', function() {
		self.deleteItem($(this).data('index') - 1) //set to zero-indexed
	})
}

/**
 * Clears the Navigation window list of selected or moving modifiers
 */
FbView.prototype.unselectList = function() {
	$('#SFDSWFB-list').removeClass('moving')
	$('#SFDSWFB-list .item').removeClass('selected')
	$('#SFDSWFB-list .item').removeClass('moving')
	$('#SFDSWFB-list .fa-sort').removeClass('moving')
}

/**
 * Highlights and opens the selected item for editing
 *
 * @param {JQuery DOM Object} obj
 */
FbView.prototype.editItem = function(obj) {
	if (obj.hasClass('spacer') && $('#SFDSWFB-list').hasClass('moving')) return this.moveItemHere(obj.data('index') - 1) //set to zero-indexed
	this.unselectList()
	obj.addClass('selected')
	this.loadPreview()
	this.showMiddlePanel(obj.hasClass('spacer') ? 'SFDSWFB-insert' : 'SFDSWFB-attributes') //set to zero-indexed
} 

/**
 * Deletes an item from the form in the Navigation window
 *
 * @param {Integer} index
 */
FbView.prototype.deleteItem = function(index) {
	if (this.formsCollection.forms[fb.formId].isReferenced(this.formsCollection.forms[fb.formId].content.data[index].id)) return fb.loadDialogModal('Error Removing Item', "This item is referenced by other items. Please remove all references to this item before deleting.")
	this.formsCollection.forms[fb.formId].deleteItem(index)
	this.populateList()
} 

/**
 * Highlights the item and readies it for reordering
 *
 * @param {JQuery DOM Object} handleObj
 */
FbView.prototype.sortItem = function(handleObj) {
	this.unselectList()
	handleObj.prev().addClass('selected')
	handleObj.prev().addClass('moving')
	handleObj.addClass('moving')
	$('#SFDSWFB-list').addClass('moving')
	this.showMiddlePanel('SFDSWFB-sort')
	this.loadPreview()
} 

/**
 * Moves the highlighted item to the new insertion point
 *
 * @param {Integer} index
 */
FbView.prototype.moveItemHere = function(index) {
	var itemId = $('#SFDSWFB-list .field.selected').eq(0).data('id')
	this.formsCollection.forms[fb.formId].moveItem($('#SFDSWFB-list .field.selected').eq(0).data('index') - 1, index) //adjust for zero index
	this.populateList()
	var newObj = $('#SFDSWFB-list .field[data-id=' + itemId + ']')
	newObj.addClass('selected')
	this.showMiddlePanel('SFDSWFB-attributes')
}

/**
 * Expands the middle panel, shows a specific panel and optionally highlight an item for editing
 *
 * @param {String} panelId
 */
FbView.prototype.showMiddlePanel = function(panelId) {
	$('.middlePanel').removeClass('col-lg-1')
	$('.middlePanel').removeClass('col-xl-1')
	if (!$('.middlePanel').hasClass('col-lg-4')) $('.middlePanel').addClass('col-lg-4')
	if (!$('.middlePanel').hasClass('col-xl-3')) $('.middlePanel').addClass('col-xl-3')
	$('.rightPanel').removeClass('col-lg-8')
	$('.rightPanel').removeClass('col-xl-9')
	if (!$('.rightPanel').hasClass('col-lg-5')) $('.rightPanel').addClass('col-lg-5')
	if (!$('.rightPanel').hasClass('col-xl-7')) $('.rightPanel').addClass('col-xl-7')
	if (typeof panelId !== "undefined") {
		$('.middlePanel > div').hide()
		$('#'+panelId).show()
		if (panelId === "SFDSWFB-attributes") this.showAttributes()
	}
	$('.horizontal-toggle').removeClass('fa-angle-double-right')
	if (!$('.horizontal-toggle').hasClass('fa-angle-double-left')) $('.horizontal-toggle').addClass('fa-angle-double-left')
}

/**
 * Displays the edit attributes panel for the selected item
 *
 * @param {Integer} itemIndex
 */
FbView.prototype.showAttributes = function() {
	var self = this
	var itemIndex = $('#SFDSWFB-list .item.selected').eq(0).data('index') - 1

	$('#SFDSWFB-attributes > .editContent').html(fb.view.editItem)

	$('#SFDSWFB-attributes .apply-button').on('click', function() {
		self.applyAttributes()
	})

	$('#SFDSWFB-attributes .revert-button').on('click', function() {
		self.showMiddlePanel('SFDSWFB-attributes')
	})
	
	self.delegateItems(self.formsCollection.forms[fb.formId].content.data[itemIndex])
	self.initAutofillNames()
	
	$('.accordion-section > .accordion').hide()
	$('.accordion-section.attributes > .accordion').show()
}

/**
 * Populates or strips sections from the edit attributes panel based on the item properties
 *
 * @param {Item} item
 */
FbView.prototype.delegateItems = function(item) {
	for (i in item) {
		if (typeof item[i] !== "function") {
			if (item[i] === null) {
				switch (i) {
					case 'validation':
						$('.accordion-validation').remove()
						break
					case 'conditionals':
						$('.accordion-conditionals').remove()
						break
					case 'calculations':
						$('.accordion-calculations').remove()
						break
					case 'webhooks':
						$('.accordion-webhooks').remove()
						break
					default:
						$('.' + i + '-attribute').remove()
						break
				}
			} else {
				$('#SFDSWFB-attributes input[name='+i+'], #SFDSWFB-attributes textarea[name='+i+']').val(item[i])
			}
		}
	}
}

/**
 * Turns on autofill for names based on the value of the dropdown
 */
FbView.prototype.initAutofillNames = function() {
    if (fb.autofillNames != null) {
	    $('#SFDSWFB-attributes #name').typeahead({
		    minlength: 1,
			hint: false
		}, {
		    name: 'prefill',
			source: substringMatcher(fb.autofillNames)
	    })
	    // $('#SFDSWFB-attributes #name').tagsinput();
    } else {
	    $('#SFDSWFB-attributes #name').typeahead('destroy')
    }
}

/**
 * Validates and saves changes to Item
 */
FbView.prototype.applyAttributes = function() {
	var itemIndex = $('#SFDSWFB-list .item.selected').eq(0).data('index') - 1
	var itemId = $('#SFDSWFB-attributes input[name=id]').val()
	var itemName = $('#SFDSWFB-attributes input[name=name]').val()

	//validations
	if (itemId === "") return fb.loadDialogModal('Error Saving Attributes', "The ID field is required. Please enter an ID.")
	if (this.formsCollection.forms[fb.formId].doesItExist(itemId, "id", itemIndex)) return fb.loadDialogModal('Error Saving Attributes', "The ID '" + itemId + "' is already in your form. Please use a different ID.")
	if (itemName !== "" && this.formsCollection.forms[fb.formId].doesItExist(itemName, "name", itemIndex)) return fb.loadDialogModal('Error Saving Attributes', "The Name '" + itemName + "' is already in your form. Please use a different Name.")
	
	this.formsCollection.forms[fb.formId].modifyItem()
	this.populateList()
	var newObj = $('#SFDSWFB-list .field[data-id=' + itemId + ']')
	newObj.addClass('selected')
	this.showMiddlePanel('SFDSWFB-attributes')
}

/**
 * Control to expand and minimize the middle panel
 */
FbView.prototype.toggleMiddlePanel = function() {
	if ($('.middlePanel').hasClass('col-lg-4')) {
		this.hideMiddlePanel()
	} else {
		this.showMiddlePanel()
	}
}

/**
 * Minimizes the middle panel
 *
 */
FbView.prototype.hideMiddlePanel = function() {
	$('.middlePanel').removeClass('col-lg-4')
	$('.middlePanel').removeClass('col-xl-3')
	if (!$('.middlePanel').hasClass('col-lg-1')) $('.middlePanel').addClass('col-lg-1')
	if (!$('.middlePanel').hasClass('col-xl-1')) $('.middlePanel').addClass('col-xl-1')
	$('.rightPanel').removeClass('col-lg-5')
	$('.rightPanel').removeClass('col-xl-7')
	if (!$('.rightPanel').hasClass('col-lg-8')) $('.rightPanel').addClass('col-lg-8')
	if (!$('.rightPanel').hasClass('col-lg-9')) $('.rightPanel').addClass('col-xl-9')
	//$('.middlePanel > div').hide()
	$('.horizontal-toggle').removeClass('fa-angle-double-left')
	if (!$('.horizontal-toggle').hasClass('fa-angle-double-right')) $('.horizontal-toggle').addClass('fa-angle-double-right')
}

/**
 * Share the form with other users
 */
FbView.prototype.share = function() {
  $('#SFDSWFB-authors').slideUp()
  fb.callAPI('/form/share', { 'id': fb.formId, 'email': $('#SFDSWFB-authors input').val() }, fb.shareResponse)
}






/**
 * Generate the embed code
 */
 //todo make a function to parse a JSON form object
FbView.prototype.genSource = function() {
	//can't generate code for unsaved forms
	if (fb.formId == 0) {
		$('#SFDSWFB-source').val('Please save your form before generating HTML.')
		return
	}

	//do not generate code for forms without an action endpoint
	if (this.formsCollection.forms[fb.formId].content.settings.action == '') {
		$('#SFDSWFB-snippet').text('Please set the Form Action (in Settings) before embedding your form.')
		return
	}

	$('#SFDSWFB-snippet').text(this.embedCode())

	$.get('/form/generate?id=' + fb.formId, function (data) {
		$('#SFDSWFB-source').val(data)
	})
}

/**
 * Generate the embed code
 */
FbView.prototype.embedCode = function() {
	var embedUrl = new URL('/form/embed', window.location.href)
	var assetsUrl = new URL('/assets/', window.location.href)
	return fb.view.embedCode(fb.formId, embedUrl, assetsUrl)
}
