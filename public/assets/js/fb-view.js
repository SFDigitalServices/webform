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
	this.listForms()
	this.bindInsertItems()
	this.bindSystemButtons()

	if (fb.startedEarly === 1) {
		this.startForm()
	} else {
		$('.welcomeBox .btn-info').on('click', function(){
			this.startForm()
		})
	}
}

/**
 * Bind click events to all the system buttons
 */
FbView.prototype.bindSystemButtons = function() {
	var self = this
	
	$('a.preview-window').on('click', function() {
		fb.openPreviewWindow()
	})
	$('a.embed-toggle').on('click', function() {
		self.showMiddlePanel('SFDSWFB-embed')
	})
	
	$('a.settings-toggle').on('click', function() {
		self.showMiddlePanel('SFDSWFB-settings')
	})
	
	$('a.horizontal-toggle').on('click', function() {
		self.toggleMiddlePanel()
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
		self.populateList(fb.formId)
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
		id = 0
	} else {
		this.formsCollection.forms[id].loadExistingForm(id)
		fb.addBrowserState(id, '/home?id=' + id)
	}
	this.populateList(id)
	this.loadPreview()
	$('body > div.content').hide()
	$('.editorContainer').show()
}

/**
 * Loads the form preview in an iframe
 *
 * @param {String} sectionId
 */
FbView.prototype.loadPreview = function(sectionId) {
	var scrollTo = typeof sectionId != "undefined" ? '&sectionId=' + sectionId : ''
	$('#SFDSWFB-preview').html(fb.view.previewIframe(fb.formId,scrollTo))
}

/**
 * Recreates the Navigation window from the Form
 *
 * @param {Integer} id
 */
FbView.prototype.populateList = function(id) {
	var self = this
	
	var html = ''
	var count = 1
	var formData = this.formsCollection.forms[id].content.data
	for (i in formData) {
		if (i < formData.length - 1) { //do not show last item, button
			html += fb.view.listItem(formData[i].id, count, count < 10 ? "0" + count : count)
			count++
		}
	}
	html += fb.view.listSpacer(count)
	$('#SFDSWFB-list').html(html)
	$('#SFDSWFB-list .item').on('click', function() {
		self.editItem($(this))
	})
	$('#SFDSWFB-list .fa-sort').on('click', function() {
		self.sortItem($(this), $(this).prev())
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
 * @param {Object} obj
 */
FbView.prototype.editItem = function(obj) {
	if (obj.hasClass('spacer') && $('#SFDSWFB-list').hasClass('moving')) return this.moveItem(obj.data('index') - 1) //set to zero-indexed
	
	this.loadPreview(obj.data('id'))
	this.unselectList()
	this.showMiddlePanel(obj.hasClass('spacer') ? 'SFDSWFB-insert' : 'SFDSWFB-attributes', obj.data('index') -1) //set to zero-indexed
	obj.addClass('selected')
} 

/**
 * Deletes an item from the form in the Navigation window
 *
 * @param {Integer} index
 */
FbView.prototype.deleteItem = function(index) {
	this.formsCollection.forms[fb.formId].deleteItem(index)
	this.loadPreview()
	this.populateList(fb.formId)
} 

/**
 * Highlights the item and readies it for reordering
 *
 * @param {Object} sort
 * @param {Object} obj
 */
FbView.prototype.sortItem = function(sort, obj) {
	this.loadPreview(obj.data('id'))
	this.unselectList()
	obj.addClass('selected')
	obj.addClass('moving')
	sort.addClass('moving')
	$('#SFDSWFB-list').addClass('moving')
	this.showMiddlePanel('SFDSWFB-sort')
} 

/**
 * Moves the highlighted item to the new insertion point
 *
 * @param {Integer} index
 */
FbView.prototype.moveItem = function(index) {
	var itemId = $('#SFDSWFB-list .field.selected').eq(0).data('id')
	this.formsCollection.forms[fb.formId].moveItem($('#SFDSWFB-list .field.selected').eq(0).data('index') - 1, index) //adjust for zero index
	this.loadPreview(itemId)
	this.populateList(fb.formId)
	var newObj = $('#SFDSWFB-list .field[data-id=' + itemId + ']')
	newObj.addClass('selected')
	this.showMiddlePanel('SFDSWFB-attributes', newObj.data('index') -1)
}

/**
 * Expands the middle panel, shows a specific panel and optionally highlight an item for editing
 *
 * @param {String} panelId
 * @param {Integer} itemIndex
 */
FbView.prototype.showMiddlePanel = function(panelId, itemIndex) {
	$('.middlePanel').removeClass('col-lg-1')
	$('.middlePanel').removeClass('col-xl-1')
	if (!$('.middlePanel').hasClass('col-lg-4')) $('.middlePanel').addClass('col-lg-4')
	if (!$('.middlePanel').hasClass('col-xl-3')) $('.middlePanel').addClass('col-xl-3')
	$('.rightPanel').removeClass('col-lg-8')
	$('.rightPanel').removeClass('col-xl-9')
	if (!$('.rightPanel').hasClass('col-lg-5')) $('.rightPanel').addClass('col-lg-5')
	if (!$('.rightPanel').hasClass('col-xl-7')) $('.rightPanel').addClass('col-xl-7')
	if (typeof panelId != "undefined") {
		$('.middlePanel > div').hide()
		$('#'+panelId).show()
		if (typeof itemIndex !== "undefined") {
			this.showAttributes(itemIndex)
		}
	}
	$('.horizontal-toggle').removeClass('fa-angle-double-right')
	if (!$('.horizontal-toggle').hasClass('fa-angle-double-left')) $('.horizontal-toggle').addClass('fa-angle-double-left')
}

/**
 * Displays the edit attributes panel for the selected item
 *
 * @param {Integer} itemIndex
 */
FbView.prototype.showAttributes = function(itemIndex) {
	var self = this

	$('#SFDSWFB-attributes > .editContent').html(fb.view.editItem)

	$('#SFDSWFB-attributes .apply-button').on('click', function() {
		var itemId = $('#SFDSWFB-attributes input[name=id]').val()
		self.formsCollection.forms[fb.formId].modifyItem()
		self.loadPreview(itemId)
		self.populateList(fb.formId)
		var newObj = $('#SFDSWFB-list .field[data-id=' + itemId + ']')
		newObj.addClass('selected')
		self.showMiddlePanel('SFDSWFB-attributes', newObj.data('index') -1)
	})

	$('#SFDSWFB-attributes .revert-button').on('click', function() {
		self.showMiddlePanel('SFDSWFB-attributes', $('#SFDSWFB-list .item.selected').eq(0).data('index') - 1)
	})
	
	self.removeEditItemParts(self.formsCollection.forms[fb.formId].content.data[itemIndex])
	
	$('.accordion-section > .accordion').hide()
	$('.accordion-section.attributes > .accordion').show()
}

/**
 * Strips sections from the edit attributes panel based on the item properties
 *
 * @param {Item} item
 */
FbView.prototype.removeEditItemParts = function(item) {
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
				$('[name='+i+']').val(item[i])
			}
		}
	}
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
