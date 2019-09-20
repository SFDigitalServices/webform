$(document).ready(function(){
	$(".content").show()
	$('.welcomeBox .btn-info').on('click', function(){
		fb.startedEarly = true
		$('body > div.content').hide()
		$('.editorContainer').show()
	})
	fb.callAPI("/form/getForms", {}, fb.init)
})

var fb = {}

fb.formId = 0
fb.startedEarly = false
fb.api_token
fb.user_id
fb.autofillNames = null

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
    fb.fbView.initEvents()	
}

fb.loadDialogModal = function(title, body) {
  $('.modal-dialog .modal-title').text(title)
  $('.modal-dialog .modal-body p').text(body)
  $('.modal-dialog .btn-primary').hide()
  $('.modal').modal()
}

fb.loadConfirmModal = function(title, body, callback) {
  $('.modal-dialog .modal-title').text(title)
  $('.modal-dialog .modal-body p').text(body)
  $('.modal-dialog .btn-primary').on('click', callback)
  $('.modal').modal()
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












/*









function populateCSV () {
  if (csvFile && formId > 0) { // global
    showCSV(csvFile)
  } else if (formId) {
    callAPI('/form/getFilename', { id: formId, 'path': true }, showCSV)
  }
}
function showCSV (response) {
  csvFile = response
  $('.csvFile').show('fast')
  $('.csvFile > a').on('click', function () { openCSV(response) })
}
function openCSV (url) {
  window.open(url + '?sessid=' + new Date().getTime(), '_blank')
}
*/