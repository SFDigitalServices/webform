jQuery(document).ready(function(){
	fb.init()
})

let Fb = function() {
	this.formId = 0
	this.previousContent = null
	this.startedEarly = false
	this.api_token = null
	this.user_id = null
	this.autofillNames = null
	this.fbView = null
}

/**
 * init the app
 */
Fb.prototype.init = function() {
	var self = this

	jQuery(".content").show()
	jQuery('.welcomeBox .btn-info').on('click', function(){
		self.startedEarly = true
		jQuery('body > div.content').hide()
		//jQuery('.editorContainer').show()
	})
	self.callAPI("/form/getForms", {}, fb.startView)
}

/**
 * the main AJAX function to interface with the backend
 */
Fb.prototype.callAPI = function(url, dataObj, callback) {
	var self = this

  var settings = {
    'async': true,
    'crossDomain': true,
    'url': url,
    'method': 'POST',
    'headers': {
      'authorization': 'Bearer ' + self.api_token,
      'content-type': 'application/x-www-form-urlencoded',
      'cache-control': 'no-cache'
    },
    'data': {
      'user_id': self.user_id,
      'api_token': self.api_token
    }
  }
  for (i in dataObj) {
    settings.data[i] = dataObj[i]
  }
  jQuery.ajax(settings).done(function (response) {
    callback(response)
  })
}

/**
 * this is run as the callback after the first callAPI
 */
Fb.prototype.startView = function(response) {
    fb.fbView = new FbView(new FormsCollection(response))
    if (fb.startedEarly) fb.startModal()
}

/**
 * Loads a modal
 *
 * @param {String} title
 * @param {String} body
 */
Fb.prototype.loadDialogModal = function(title, body) {
  jQuery('.modal-dialog .modal-title').text(title)
  jQuery('.modal-dialog .modal-body p').text(body)
  jQuery('.modal-dialog .btn-primary').hide()
  jQuery('.modal').modal()
}

/**
 * Loads a modal with a confirmation
 *
 * @param {String} title
 * @param {String} body
 * @param {Function} callback
 */
Fb.prototype.loadConfirmModal = function(title, body, callback) {
  jQuery('.modal-dialog .modal-title').text(title)
  jQuery('.modal-dialog .modal-body p').text(body)
  jQuery('.modal-dialog .btn-primary').off()
  jQuery('.modal-dialog .btn-primary').on('click', callback)
  jQuery('.modal').modal()
}

/**
 * Loads a modal to name the form
 */
Fb.prototype.startModal = function() {
	var self = this

  jQuery('.modal-dialog .modal-title').text('Name your form')
  jQuery('.modal-dialog .modal-body p').text('Please enter the name of your form')
  jQuery('.modal-dialog .modal-body p').append('<input type="text" class="form-control" value="My Form" id="formTitle"/>')
  //jQuery('.modal-dialog .btn-primary, .modal-backdrop, .close').on('click', function(){
  jQuery('.modal-dialog .btn-secondary').hide()
  jQuery('[data-dismiss=modal]').on('click', function(){
	self.nameForm()
  })
  jQuery('.modal').modal({backdrop: 'static', keyboard: false})
}

/**
 * Will save the form if the form is new
 */
Fb.prototype.nameForm = function() {
	var self = this

	if (!self.formId) {
		self.fbView.formsCollection.forms[0].content.settings.name = jQuery('#formTitle').val()
		self.fbView.formsCollection.forms[0].saveForm()
		jQuery('.editorContainer').show()
    self.selectInsert()
	}
}

/**
 * Polls the list in one second intervals until it exists and then selects it
 */
Fb.prototype.selectInsert = function() {
  var self = this

  if (!jQuery('#SFDSWFB-list .item').length) {
		setTimeout(function() {
      self.selectInsert()
		}, 1000)
  } else {
    jQuery('#SFDSWFB-list .item').eq(0).addClass('selected')
    self.fbView.switchMiddlePanel('SFDSWFB-insert')
  }
}

/**
 * Adds a new browser state
 *
 * @param {Integer} id
 * @param {String} url
 */
Fb.prototype.addBrowserState = function(id, url) {
	if (history.state === undefined || history.state === null) history.pushState({ formId: id }, null, url)
}

/**
 * Binds the forward and back buttons
 *
 * @param {String} event
 */
window.onpopstate = function(event) {
	fb.popstate(event)
}

Fb.prototype.popstate = function(event) {
	var self = this

  jQuery('.container').hide()
  if (event.state) {
	  if (event.state.formId) {
		  self.fbView.startForm(event.state.formId)
	  } else {
		  self.fbView.startForm()
	  }
  } else {
    self.goHome()
  }
}

/**
 * Opens a preview of the form in a new window
 */
Fb.prototype.openPreviewWindow = function() {
	window.open('/form/preview/?id=' + this.formId,'_blank')
}

/**
 * Redirects the user back to the welcome screen
 */
Fb.prototype.goHome = function() {
  jQuery('.editorContainer').hide()
  jQuery('.content').show()
}

/**
 * Allows the name attribute to autofill when typing
 *
 * @param {Object} obj
 */
Fb.prototype.loadNames = function(obj) {
	var self = this

	var selected = jQuery(obj).val()
	if (selected == '0') {
		self.autofillNames = null
	} else {
		jQuery.get('/assets/js/' + selected + '.json', function (data) {
			self.autofillNames = data.fields
			// console.log(autofillNames);
		})
	}
}

/**
 * Event to handle response to getting a list of authors after loading form
 */
Fb.prototype.shareResponse = function(response) {
	if (response.status && typeof response.data !== 'undefined') {
		jQuery('#SFDSWFB-existingAuthors').html(response.data)
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
Fb.prototype.eventSource = false //probably is form level, but there should only be one going on at a time so it's app level
Fb.prototype.initSSE = function() {
	var self = this

	if (!self.eventSource) {
		self.eventSource = new EventSource('/form/push?form_id=' + self.formId)
		var listener = function (event) {
			var type = event.type
			// alert(type + ": " + (type === "message" ? event.data : es.url));
			if (event.type === 'message') {
				var newContent = JSON.parse(event.data)
				self.fbView.formsCollection.forms[self.formId] = newContent
				self.fbView.loadDialogModal('Attention', "Your form has been edited by an external source. Changes have been loaded.") //remove this to make it more like google docs
				self.fbView.populateList(self.formId)
				self.fbView.loadPreview()
				//todo retain view that user was on
			}
		}
		fb.eventSource.addEventListener('open', listener)
		fb.eventSource.addEventListener('message', listener)
		fb.eventSource.addEventListener('error', listener)
	}
}
var fb = new Fb()