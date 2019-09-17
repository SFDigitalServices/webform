var fb = {}

fb.formId = 0
fb.loaded = 0
fb.startedEarly = 0

function callAPI (url, dataObj, callback) {
  var settings = {
    'async': true,
    'crossDomain': true,
    'url': url,
    'method': 'POST',
    'headers': {
      'authorization': 'Bearer ' + api_token,
      'content-type': 'application/x-www-form-urlencoded',
      'cache-control': 'no-cache'
    },
    'data': {
      'user_id': user_id,
      'api_token': api_token
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
function loadHome (response) {
    const fbView = new FbView(new FormsCollection(response))

	fb.loaded = 1
    fbView.initEvents()	
}

/**
 * old create new form binding, should clean this up
 */
function loadContent(id) {
	if (fb.loaded === 1) return
	if (id == undefined) {
		fb.startedEarly = 1
		$('body > div.content').hide()
		$('.editorContainer').show()
	}
}

/*
function loadDialogModal(title, body) {
  $('#modal-dialog .modal-title').text(title)
  $('#modal-dialog .modal-body p').text(body)
  $('#modal-dialog').modal()
}

function loadConfirmModal(title, body, callback) {
  $('#modal-confirm .modal-title').text(title)
  $('#modal-confirm .modal-body p').text(body)
  $('#modal-confirm .btn-primary').on('click', callback)
  $('#modal-confirm').modal()
}
*/

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
 * Opens a preview of the form in a new window
 */
fb.openPreviewWindow = function() {
	window.open('/form/preview/?id=' + fb.formId,'_blank')
}