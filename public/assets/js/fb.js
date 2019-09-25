$(document).ready(function(){
	$(".content").show()
	$('.welcomeBox .btn-info').on('click', function(){
		fb.startedEarly = true
		$('body > div.content').hide()
		fb.startModal()
		//$('.editorContainer').show()
	})
	fb.callAPI("/form/getForms", {}, fb.init)
})

var fb = {}
fb.formId = 0
fb.previousContent
fb.startedEarly = false
fb.api_token
fb.user_id
fb.autofillNames = null

/**
 * the main AJAX function to interface with the backend
 */
fb.callAPI = function(url, dataObj, callback) {
  var settings = {
    'async': true,
    'crossDomain': true,
    'url': url,
    'method': 'POST',
    'headers': {
      'authorization': 'Bearer ' + fb.api_token,
      'content-type': 'application/x-www-form-urlencoded',
      'cache-control': 'no-cache'
    },
    'data': {
      'user_id': fb.user_id,
      'api_token': fb.api_token
    }
  }
  for (i in dataObj) {
    settings.data[i] = dataObj[i]
  }
  $.ajax(settings).done(function (response) {
    callback(response)
  })
}

/**
 * this is run as the callback after the first callAPI
 */
fb.init = function(response) {
    fb.fbView = new FbView(new FormsCollection(response))
}

/**
 * Loads a modal
 *
 * @param {String} title
 * @param {String} body
 */
fb.loadDialogModal = function(title, body) {
  $('.modal-dialog .modal-title').text(title)
  $('.modal-dialog .modal-body p').text(body)
  $('.modal-dialog .btn-primary').hide()
  $('.modal').modal()
}

/**
 * Loads a modal with a confirmation
 *
 * @param {String} title
 * @param {String} body
 * @param {Function} callback
 */
fb.loadConfirmModal = function(title, body, callback) {
  $('.modal-dialog .modal-title').text(title)
  $('.modal-dialog .modal-body p').text(body)
  $('.modal-dialog .btn-primary').off()
  $('.modal-dialog .btn-primary').on('click', callback)
  $('.modal').modal()
}

/**
 * Loads a modal to name the form
 */
fb.startModal = function() {
  $('.modal-dialog .modal-title').text('Name your form')
  $('.modal-dialog .modal-body p').text('Please enter the name of your form')
  $('.modal-dialog .modal-body p').append('<input type="text" class="form-control" value="My Form" id="formTitle"/>')
  //$('.modal-dialog .btn-primary, .modal-backdrop, .close').on('click', function(){
  $('.modal-dialog .btn-secondary').hide()
  $('[data-dismiss=modal]').on('click', function(){
	fb.nameForm()
  })
  $('.modal').modal({backdrop: 'static', keyboard: false})
}

/**
 * Will save the form if the form is new
 */
fb.nameForm = function() {
	if (!fb.formId) {
		fb.fbView.formsCollection.forms[0].content.settings.name = $('#formTitle').val()
		fb.fbView.formsCollection.forms[0].saveForm()
		$('.editorContainer').show()
	}
}

/**
 * Adds a new browser state
 *
 * @param {Integer} id
 * @param {String} url
 */
fb.addBrowserState = function(id, url) {
	if (history.state == undefined) history.pushState({ formId: id }, null, url)
}

/**
 * Binds the forward and back buttons
 *
 * @param {String} event
 */
window.onpopstate = function(event) {
	fb.popstate(event)
}

fb.popstate = function(event) {
  $('.container').hide()
  if (event.state) {
	  if (event.state.formId) {
		  fb.fbView.startForm(event.state.formId)
	  } else {
		  fb.fbView.startForm()
	  }
  } else {
		  $('.editorContainer').hide()
		  $('.content').show()
  }
}

/**
 * Opens a preview of the form in a new window
 */
fb.openPreviewWindow = function() {
	window.open('/form/preview/?id=' + fb.formId,'_blank')
}

/**
 * Redirects the user back to the welcome screen
 */
fb.goHome = function() {
	window.location.replace('/home')
}

/**
 * Allows the name attribute to autofill when typing
 *
 * @param {Object} obj
 */
fb.loadNames = function(obj) {
	var selected = $(obj).val()
	if (selected == '0') {
		fb.autofillNames = null
	} else {
		$.get('/assets/js/' + selected + '.json', function (data) {
			fb.autofillNames = data.fields
			// console.log(autofillNames);
		})
	}
}

/**
 * Event to handle response to getting a list of authors after loading form
 */
fb.shareResponse = function(response) {
	var self = this
	
	if (response.status && typeof response.data !== 'undefined') {
		$('#SFDSWFB-existingAuthors').html(response.data)
		if (response.data.includes(',')) fb.initSSE()
	} else if (!response.status) {
		if (typeof response.message !== 'undefined') loadDialogModal('Attention', response.message)
	} else {
		loadDialogModal('Error Sharing Form', 'Please enter a valid email and try again or contact SFDS.')
	}
}

/**
 * Bind event source to SSE listener
 */
fb.eventSource = false //probably is form level, but there should only be one going on at a time so it's app level
fb.initSSE = function() {
	if (!fb.eventSource) {
		fb.eventSource = new EventSource('/form/push?form_id=' + fb.formId)
		var listener = function (event) {
			var type = event.type
			// alert(type + ": " + (type === "message" ? event.data : es.url));
			if (event.type === 'message') {
				var newContent = JSON.parse(event.data)
				this.formsCollection.forms[fb.formId] = newContent
				fb.loadDialogModal('Attention', "Your form has been edited by an external source. Changes have been loaded.") //remove this to make it more like google docs
				this.populateList(fb.formId)
				this.loadPreview()
				//todo retain view that user was on
			}
		}
		fb.eventSource.addEventListener('open', listener)
		fb.eventSource.addEventListener('message', listener)
		fb.eventSource.addEventListener('error', listener)
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
    var ids = getMathIds(str)

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
function getMathIds (str) {
  var ids = []
  var saved = fb.fbView.formsCollection.forms[fb.formId].content
  for (i in saved.data) {
    if (saved.data[i]['id'] != undefined) {
      if (saved.data[i].formtype == 'd06' || saved.data[i].formtype == 'd08' || saved.data[i].formtype == 's02' || saved.data[i].formtype == 's06' || saved.data[i].formtype == 's08' || saved.data[i].formtype == 'm11') ids.push(saved.data[i]['id'])
    }
  }
  var index = ids.indexOf(str)
  if (index !== -1) ids.splice(index, 1)
  return ids
}
