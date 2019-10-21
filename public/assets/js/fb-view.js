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

	this.listForms()
	this.bindInsertItems()
	this.bindSystemButtons()
}

/**
 * Bind click events to all the system buttons
 */
FbView.prototype.bindSystemButtons = function() {
	var self = this

	$('.clone-button').on('click', function() {
		self.formsCollection.forms[fb.formId].clone()
	})

	$('.delete-button').on('click', function() {
		self.formsCollection.forms[fb.formId].confirmDelete()
	})

	$('.preview-window').on('click', function() {
		fb.openPreviewWindow()
	})
	$('.embed-toggle').on('click', function() {
		self.switchMiddlePanel('SFDSWFB-embed')
		self.genSource()
	})

	$('.settings-toggle').on('click', function() {
		self.switchMiddlePanel('SFDSWFB-settings')
	})

	$('#SFDSWFB-settings select[name=backend]').on('change', function() {
    self.toggleConfirmPage(this)
	})

	$('#SFDSWFB-settings .apply-button').on('click', function() {
		self.formsCollection.forms[fb.formId].saveSettings()
		self.disableTimer()
	})

	$('#SFDSWFB-settings .revert-button').on('click', function() {
		self.populateSettings()
	})

	$('#SFDSWFB-names').on('change', function() {
		fb.loadNames(this)
	})

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
 * Bind a click event to each insert button
 */
FbView.prototype.bindInsertItems = function() {
	var self = this

	$('#SFDSWFB-insert button').on('click', function() {
		var index = $('#SFDSWFB-list .spacer.selected').eq(0).data('index') - 1
		self.formsCollection.forms[fb.formId].insertItem($(this).data('formtype'))
		self.populateList()
		self.editItem($('#SFDSWFB-list .field').eq(index), true)
	})
}

/**
 * List all the forms on the welcome page and bind the buttons
 */
FbView.prototype.listForms = function() {
	var self = this

	$('.forms').html('')

	for (i in this.formsCollection.forms) {
		$('.forms').append(fb.view.formLink(this.formsCollection.forms[i]))
	}

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
		fb.startModal()
	} else {
		this.formsCollection.forms[id].loadExistingForm(id)
		fb.addBrowserState(id, '/home?id=' + id)
		// do additional call to get authors
		fb.callAPI('/form/authors', { 'id': id }, fb.shareResponse)
		this.populateList()
		this.loadPreview()
		$('.editorContainer').show()
	}
	$('body > div.content').hide()
}

/**
 * Called when deleting a form
 *
 * @param {Integer} id
 */
FbView.prototype.deleteForm = function(id) {
	$('.forms a[data-id=' + id + ']').remove()
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
 * Clears the Navigation window list of selected or moving modifiers
 */
FbView.prototype.unselectList = function() {
	$('#SFDSWFB-list').removeClass('moving')
	$('#SFDSWFB-list .item').removeClass('selected')
	$('#SFDSWFB-list .item').removeClass('moving')
	$('#SFDSWFB-list .fa-sort').removeClass('moving')
}

/**
 * Loads the form preview in an iframe, will highlight the item in the iframe if an item is highlighted in the list
 */
FbView.prototype.loadPreview = function(sectionId) {
	var scrollTo = $('#SFDSWFB-list .item.selected').length != "undefined" ? '&sectionId=' + $('#SFDSWFB-list .item.selected').eq(0).data('id') : ''
	$('#SFDSWFB-preview').html(fb.view.previewIframe(fb.formId,scrollTo))
}

/**
 * Expands the middle panel, shows a specific panel and optionally highlight an item for editing
 *
 * @param {String} panelId
 */
FbView.prototype.switchMiddlePanel = function(panelId) {
	if (typeof panelId !== "undefined") {
		$('.middlePanel > div').hide()
		$('#'+panelId).show()
		if (panelId === "SFDSWFB-attributes") this.showAttributes()
	}
}

/**
 * Fills the settings form with the settings data
 */
FbView.prototype.populateSettings = function() {
	for (i in this.formsCollection.forms[fb.formId].content.settings) {
		if (typeof this.formsCollection.forms[fb.formId].content.settings[i] !== "function") {
			$('#SFDSWFB-settings [name=' + i + ']').val(this.formsCollection.forms[fb.formId].content.settings[i])
		}
	}
  this.toggleConfirmPage($('#SFDSWFB-settings select[name=backend]'))
}

/**
 * Shows the confirmation field depending on backend type
 *
 * @param {JQuery DOM Object} obj
 */
FbView.prototype.toggleConfirmPage = function(obj) {
  if ($(obj).val() == "csv") {
    $('.confirmPage').show()
  } else if ($(obj).val() == "db") {
    $('.confirmPage').hide()
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
		self.disableTimer()
	})

	$('#SFDSWFB-attributes .revert-button').on('click', function() {
		self.switchMiddlePanel('SFDSWFB-attributes')
	})

	self.populateWebhooks(self.formsCollection.forms[fb.formId].content.data[itemIndex])
	self.populateCalculations(self.formsCollection.forms[fb.formId].content.data[itemIndex])
	self.populateConditionals(self.formsCollection.forms[fb.formId].content.data[itemIndex])
	self.populateValidation(self.formsCollection.forms[fb.formId].content.data[itemIndex])
	self.populateAttributes(self.formsCollection.forms[fb.formId].content.data[itemIndex])
	self.initAutofillNames()
}

/**
 * Populates or strips sections from the edit attributes panel based on the item properties
 *
 * @param {Item} item
 */
FbView.prototype.populateAttributes = function(item) {
	for (i in item) {
		if (typeof item[i] !== "function") {
			if (item[i] === null) {
				switch (i) {
					case 'validation':
						$('#SFDSWFB-attributes .accordion-validation').remove()
						break
					case 'conditionals':
						$('#SFDSWFB-attributes .accordion-conditionals').remove()
						break
					case 'calculations':
						$('#SFDSWFB-attributes .accordion-calculations').remove()
						break
					case 'webhooks':
						$('#SFDSWFB-attributes .accordion-webhooks').remove()
						break
					default:
						$('#SFDSWFB-attributes .' + i + '-attribute').remove()
						break
				}
			} else {
				$('#SFDSWFB-attributes [name='+i+']').val(item[i])
			}
		}
	}
}

/**
 * Populates or strips sections from the validation panel based on the item properties
 *
 * @param {Item} item
 */
FbView.prototype.populateValidation = function(item) {
	switch (item.formtype) {
		case "number":
		case "date":
			$('#SFDSWFB-attributes .validation > .accordion').append(fb.view.validateMinMax())
			$('#SFDSWFB-attributes .validation > .accordion').append(fb.view.validateLength())
			break
		case "match":
			$('#SFDSWFB-attributes .validation > .accordion').append(fb.view.validateMatch())
			$('#SFDSWFB-attributes .validation > .accordion').append(fb.view.validateLength())
			break
		case "regex":
			$('#SFDSWFB-attributes .validation > .accordion').append(fb.view.validateRegex())
			$('#SFDSWFB-attributes .validation > .accordion').append(fb.view.validateLength())
			break
		case "text":
		case "email":
		case "tel":
		case "url":
		default:
			$('#SFDSWFB-attributes .validation > .accordion').append(fb.view.validateLength())
		//case "search":
		//case "password":
	}
	if (item.required == "true") $('#SFDSWFB-attributes input[name=required]').prop('checked', true)
}

/**
 * Populates or strips sections from the conditionals panel based on the item properties
 *
 * @param {Item} item
 */
FbView.prototype.populateConditionals = function(item) {
	if (item.conditions !== undefined && item.conditions !== null) {
		for (c in item.conditions.condition) {
			addConditional()
			$('#SFDSWFB-attributes .conditionalId').eq(c).val(item.conditions.condition[c].id)
			$('#SFDSWFB-attributes .conditionalOperator').eq(c).val(item.conditions.condition[c].op)
			$('#SFDSWFB-attributes .conditionalValue').eq(c).val(item.conditions.condition[c].val)
			conditionalSelect($('.conditionalOperator').eq(c))
		}
		if (item.conditions.showHide) $('#SFDSWFB-attributes .showHide').val(item.conditions.showHide)
		if (item.conditions.allAny) $('#SFDSWFB-attributes .allAny').val(item.conditions.allAny)
	}
}

/**
 * Populates or strips sections from the calculations panel based on the item properties
 *
 * @param {Item} item
 */
FbView.prototype.populateCalculations = function(item) {
	if (item.calculations !== undefined && item.calculations !== null) {
		var calCount = 0
		for (l in item.calculations) {
			if (l == 1) {
				addCalculation(item.id)
				$('#SFDSWFB-attributes .calculationId').eq(0).val(item.calculations[0])
				$('#SFDSWFB-attributes .calculationId').eq(1).val(item.calculations[2])
				$('#SFDSWFB-attributes .calculationOperator').eq(0).val(item.calculations[1])
			} else if (Math.abs(l % 2) == 1) { // every odd number after 1
				calCount++
				addCalculation(item.id)
				$('#SFDSWFB-attributes .calculationOperator').eq(calCount).val(item.calculations[l])
				$('#SFDSWFB-attributes .calculationId').eq(calCount + 1).val(item.calculations[parseInt(l) + 1])
			}
		}
	}
}

/**
 * Populates or strips sections from the webhook panel based on the item properties
 *
 * @param {Item} item
 */
FbView.prototype.populateWebhooks = function(item) {
	var self = this

	// show options only for checkboxes radios and selects
	var webhookOptionsCompatible = Array('s02', 's06', 's08')
	if (webhookOptionsCompatible.includes(item.formtype)) $('#SFDSWFB-attributes .webhookOptionsArray').show()

	// get all ids and populate select
	var ids = self.formsCollection.forms[fb.formId].getIds()
	$('#SFDSWFB-attributes .webhookId').each(function () {
		if ($(this).val() == null) {
			var thisSelect = $(this)
			$.each(ids, function (i, item) {
				thisSelect.append($('<option>', {
					value: item,
					text:	item
				}))
			})
		}
	})

	// populate values if there is already a webhook
	if (item.webhooks !== undefined && item.webhooks !== null) {
        $('#SFDSWFB-attributes .webhookSelect').val('Use a Webhook')
        $('#SFDSWFB-attributes .webhookEditor').show()

        // populate post fields
        var allIdClone = $('#SFDSWFB-attributes .webhookId')[0].outerHTML
        var counter = 0
        while (counter < item.webhooks.ids.length) {
			if (counter) {
				if (counter > 1) {
					$('#SFDSWFB-attributes .webhookEditor .fa-minus-circle').eq(counter - 2).after(allIdClone + ' <i class="fas fa-minus-circle" onclick="javascript:removeWebhook(' + counter + ')"></i>')
				} else {
					$('#SFDSWFB-attributes .webhookId').eq(counter - 1).after(allIdClone + ' <i class="fas fa-minus-circle" onclick="javascript:removeWebhook(' + counter + ')"></i>')
				}
			}
			$('#SFDSWFB-attributes .webhookId').eq(counter).val(item.webhooks.ids[counter])
			counter++
        }

        // populate endpoint
        $('#SFDSWFB-attributes .webhookEndpoint').val(item.webhooks.endpoint)

        // populate method
        $('#SFDSWFB-attributes .webhookMethod').val(item.webhooks.method)

        // populate responseIndex
        $('#SFDSWFB-attributes .webhookResponseIndex').val(item.webhooks.responseIndex)

        // set options array and display
        if (item.webhooks.optionsArray == 'true') {
			$('#SFDSWFB-attributes .webhookOptionsArray').val('Will Contain Many Options')
			$('#SFDSWFB-attributes .webhookOptionsEditor').show()

			// populate split method
			if (item.webhooks.delimiter != '') { // delimiter overrides path
				$('#SFDSWFB-attributes .webhookResponseOptionType').val('Delimiter')
				$('#SFDSWFB-attributes .webhookDelimiter').val(item.webhooks.delimiter)
				$('#SFDSWFB-attributes .webhookDelimiter').show()
			} else {
				$('#SFDSWFB-attributes .webhookResponseOptionType').val('Index/Path')
				$('#SFDSWFB-attributes .webhookIndex').val(item.webhooks.responseOptionsIndex)
				$('#SFDSWFB-attributes .webhookIndex').show()
			}
        }
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
	if (itemName !== null && itemName !== undefined && itemName !== "" && this.formsCollection.forms[fb.formId].doesItExist(itemName, "name", itemIndex)) return fb.loadDialogModal('Error Saving Attributes', "The Name '" + itemName + "' is already in your form. Please use a different Name.")

	this.formsCollection.forms[fb.formId].modifyItem()
	this.populateList()
	var newObj = $('#SFDSWFB-list .field[data-id=' + itemId + ']')
	newObj.addClass('selected')
	this.switchMiddlePanel('SFDSWFB-attributes')
}

/**
 * Disables the button for a bit
 *
 * @param {JQuery DOM Object} buttonObj
 */
FbView.prototype.disableTimer = function() {
	$('.apply-button').addClass('disabled')
	setTimeout(function() {
		$('.apply-button').removeClass('disabled')
	}, 3000)
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
	this.switchMiddlePanel('SFDSWFB-sort')
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
	this.switchMiddlePanel('SFDSWFB-attributes')
}

/**
 * Highlights and opens the selected item for editing
 *
 * @param {JQuery DOM Object} obj
 * @param overload {Boolean} skipPreview
 */
FbView.prototype.editItem = function(obj, skipPreview) {
	if (obj.hasClass('spacer') && $('#SFDSWFB-list').hasClass('moving')) return this.moveItemHere(obj.data('index') - 1) //set to zero-indexed
	this.unselectList()
	obj.addClass('selected')
	if (skipPreview === undefined || !skipPreview) this.loadPreview()
	this.switchMiddlePanel(obj.hasClass('spacer') ? 'SFDSWFB-insert' : 'SFDSWFB-attributes') //set to zero-indexed
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
  if (!$('#SFDSWFB-list .item[data-id=' + $('#SFDSWFB-attributes #id').val() + ']').length) {
    $('#SFDSWFB-attributes > .editContent').html('<p>Deleted</p>')
  }
}

/**
 * Special functions, conditionals, calculations and webhooks unrefactored
 */
function addCalculation (str) {
  // check if first calculation or not
  if ($('#SFDSWFB-attributes .addCalculation').length != 0) {
    if ($('#SFDSWFB-attributes .calculationLabel').length == 0) {
      $('#SFDSWFB-attributes .addCalculation').before(fb.view.firstCalculation())
    }
    $('#SFDSWFB-attributes .addCalculation').before(fb.view.calculationContainer())
    str = str == undefined ? $('#SFDSWFB-attributes .calculations #id').val() : str
    var ids = self.formsCollection.forms[fb.formId].getMathIds(str)

    $('#SFDSWFB-attributes .allMathIds').each(function () {
      if ($(this).val() == null) {
        var thisSelect = $(this)
        $.each(ids, function (i, item) {
          thisSelect.append($('<option>', {
            value: item,
            text:	item
          }))
        })
      }
    })
  }
}
function addConditional () {
  $('#SFDSWFB-attributes .addConditional').before(fb.view.addConditional())
  var ids = fb.fbView.formsCollection.forms[fb.formId].getIds()
  $('#SFDSWFB-attributes .allIds').each(function () {
    if ($(this).val() == null) {
      var thisSelect = $(this)
      $.each(ids, function (i, item) {
        thisSelect.append($('<option>', {
          value: item,
          text:	item
        }))
      })
    }
  })
  // check if first conditional or not
  if ($('#SFDSWFB-attributes .conditionalLabel').length == 1) {
    $('#SFDSWFB-attributes .conditionalLabel').text($('#SFDSWFB-list .item.selected').eq(0).data('id') + ' if')
    $('#SFDSWFB-attributes .conditionalLabel').before(fb.view.firstConditional())
  } else if ($('#SFDSWFB-attributes .conditionalLabel').length == 2) {
    $('#SFDSWFB-attributes .allIds:eq(0)').before(fb.view.multipleConditionals())
  }
  if ($('#SFDSWFB-attributes .conditionalLabel').length > 1) {
    $('#SFDSWFB-attributes .allIds:last').before('<hr class="and"/>')
  }
}
function removeCalculation (obj) {
  if ($('#SFDSWFB-attributes .calculation').length < 2) {
    $('#SFDSWFB-attributes .firstCalculation').remove()
  }
  $(obj).parent().parent().remove()
}
function removeConditional (obj) {
  if ($(obj).parent().find('select.showHide').length) {
    if ($('#SFDSWFB-attributes .conditionalLabel').length > 1) {
      $('#SFDSWFB-attributes .conditionalLabel:eq(1)').text(' ' + $(obj).parent().find('span.conditionalLabel').text())
      $(obj).parent().find('select.showHide').insertBefore('#SFDSWFB-attributes .conditionalLabel:eq(1)')
    }
  }
  $(obj).parent().remove()
  if ($('#SFDSWFB-attributes .conditionalLabel').length == 1) {
    if ($('#SFDSWFB-attributes .allAny').length) $('#SFDSWFB-attributes .allAny').remove()
    if ($('#SFDSWFB-attributes hr.and').length) $('#SFDSWFB-attributes hr.and').remove()
  }
}
function conditionalSelect (obj) {
  var valueInput = $(obj).next('.conditionalValue')
  if ($(obj).val() == 'contains anything' || $(obj).val() == 'is blank') {
    valueInput.val('')
    if (typeof valueInput.attr('readonly') === 'undefined' || typeof valueInput.attr('readonly') === false) valueInput.attr('readonly', true)
  } else {
    valueInput.removeAttr('readonly')
  }
}
function webhookSelect (obj) {
  if ($(obj).val() == 'Use a Webhook') {
    $('#SFDSWFB-attributes .webhookEditor').show()
  } else {
    $('#SFDSWFB-attributes .webhookEditor').hide()
  }
}
function webhookOptions (obj) {
  if ($(obj).val() == 'Will Contain Many Options') {
    $('#SFDSWFB-attributes .webhookOptionsEditor').show()
  } else {
    $('#SFDSWFB-attributes .webhookOptionsEditor').hide()
  }
}
function webhookResponseOptionType (obj) {
  $('#SFDSWFB-attributes .webhookResponseMethod').hide()
  if ($(obj).val() == 'Delimiter') {
    $('#SFDSWFB-attributes .webhookDelimiter').show()
  } else if ($(obj).val() == 'Index/Path') {
    $('#SFDSWFB-attributes .webhookIndex').show()
  }
}
function addWebhook () {
  var allIdClone = $('#SFDSWFB-attributes .webhookId')[0].outerHTML
  var numFields = $('#SFDSWFB-attributes .webhookId').length
  if ($('#SFDSWFB-attributes .webhookEditor .fa-minus-circle').length) {
    $('#SFDSWFB-attributes .webhookEditor .fa-minus-circle').eq(numFields - 2).after(allIdClone + ' <i class="fas fa-minus-circle" onclick="javascript:removeWebhook(' + numFields + ')"></i>')
  } else {
    $('#SFDSWFB-attributes .webhookId').eq(0).after(allIdClone + ' <i class="fas fa-minus-circle" onclick="javascript:removeWebhook(' + numFields + ')"></i>')
  }
}
function removeWebhook (idx) {
  $('#SFDSWFB-attributes .webhookId').eq(idx).remove()
  $('#SFDSWFB-attributes .webhookEditor .fa-minus-circle').eq(idx - 1).remove()
}