describe("Fb", function() {
  var fb

	//This will be called before running each spec
	beforeEach(function() {
    fb = new Fb()
	})

	describe("When Fb is initialized", function() {

    beforeEach(function() {
      jQuery('body').append('<div id="test" class="content" style="display:none"><div class="welcomeBox"><button class="btn-info">Test</button></div></div>')
    })

		//check globals
		it("should have constructed itself", function() {
			expect(fb.formId).toEqual(0)
			expect(fb.previousContent).toBeNull()
			expect(fb.startedEarly).toBeFalsy()
			expect(fb.api_token).toBeNull()
			expect(fb.user_id).toBeNull()
			expect(fb.autofillNames).toBeNull()
		})

    it('should show content', function() {
      var apiSpy = spyOn(fb, "callAPI")
      fb.init()
      expect(apiSpy).toHaveBeenCalled()
      expect(jQuery('.content').is(':visible')).toBeTruthy()
      //needs a wait or some other mechanism
      //jQuery('.welcomeBox .btn-info').click()
      //expect(jQuery('.content').is(':visible')).toBeFalsy()
    })

    afterEach(function() {
      jQuery('#test').remove()
    })

	})

  describe("When start view is run", function() {
    beforeEach(function() {
      fb.startView([{
        id: 0,
        content: {
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
      }])
    })

    it("fbView should be created", function() {
      expect(fb.fbView).toBeDefined()
    })
  })

  describe("When actions modify the browser state", function() {
    beforeEach(function() {
      jQuery('body').append('<div id="test2" class="content" style="display:none"></div><div id="test1" class="editorContainer"><div>')
    })

    it('should hide the editor and show the welcome content', function() {
      fb.goHome()
      expect(jQuery('.content').is(':visible')).toBeTruthy()
      expect(jQuery('.editorContainer').is(':visible')).toBeFalsy()
    })

    it('should be able to add browser state', function() {
      var historySpy = spyOn(history, 'pushState')
      fb.addBrowserState(1, 'http://www.google.com')
      expect(historySpy).toHaveBeenCalledWith({formId:1}, null,'http://www.google.com')
    })

    it('should reshow content window on popstate', function() {
      jQuery(window).trigger('popstate')
      expect(jQuery('.content').is(':visible')).toBeTruthy()
      expect(jQuery('.editorContainer').is(':visible')).toBeFalsy()
    })

    afterEach(function() {
      jQuery('#test1').remove()
      jQuery('#test2').remove()
    })
  })

  describe("calling the modal", function() {
    beforeEach(function() {
      jQuery('body').append('<div class="modal" id="modal" tabindex="-1" role="dialog"><div class="modal-dialog"><h5 class="modal-title"></h5><div class="modal-body"><p></p></div><button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button></div></div><div id="test" class="editorContainer" style="display:none"><div>')
    })

    it('dialog should populate title and body', function() {
      fb.loadDialogModal('test title', 'test body')
      expect(jQuery('.modal-dialog .modal-title').text()).toEqual('test title')
      expect(jQuery('.modal-dialog .modal-body p').text()).toEqual('test body')
      expect(jQuery('.modal-dialog .btn-primary').is(':visible')).toBeFalsy()
    })

    it('confirm should populate title, body and callback', function() {
      var consoleSpy = spyOn(console, "log")
      fb.loadConfirmModal('test title', 'test body', console.log('test'))
      expect(jQuery('.modal-dialog .modal-title').text()).toEqual('test title')
      expect(jQuery('.modal-dialog .modal-body p').text()).toEqual('test body')
      jQuery('.modal-dialog .btn-primary').click()
      expect(consoleSpy).toHaveBeenCalledWith('test')
    })

    it('start should populate title, body, and ask for the form name', function() {
      var selectInsertSpy = spyOn(fb, "selectInsert")
      fb.fbView = {}
      fb.fbView.formsCollection = {}
      fb.fbView.formsCollection.forms = []
      fb.fbView.formsCollection.forms[0] = new Form()
      fb.startModal()
      expect(jQuery('.modal-dialog .modal-title').text()).toEqual('Name your form')
      expect(jQuery('.modal-dialog .modal-body p').text()).toEqual('Please enter the name of your form')
      expect(jQuery('.modal-dialog .modal-body p input#formTitle').val()).toEqual('My Form')
      expect(jQuery('.modal-dialog .btn-secondary').is(':visible')).toBeFalsy()
      jQuery('.modal-dialog .btn-primary').click()
      expect(fb.fbView.formsCollection.forms[0].content.settings.name).toEqual('My Form')
      expect(jQuery('.editorContainer').is(':visible')).toBeTruthy()
      expect(selectInsertSpy).toHaveBeenCalled()
    })

    afterEach(function() {
      jQuery('#modal').remove()
      jQuery('#test').remove()
    })
  })

  describe("opening new windows", function() {
    it('should open a preview window', function() {
      var windowSpy = spyOn(window,"open")
      fb.openPreviewWindow()
      expect(windowSpy).toHaveBeenCalledWith('/form/preview/?id=0','_blank')
    })
  })

  describe("loading a name list", function() {
    it('should retrieve a json name list via ajax', function() {
      var ajaxSpy = spyOn(XMLHttpRequest.prototype,'open')
      var el = document.createElement('input')
      el.value = 'test'
      fb.loadNames(el)
      expect(ajaxSpy).toHaveBeenCalledWith('GET', '/assets/js/test.json', true)
    })
  })

/*
functions not covered by tests

Fb.prototype.shareResponse = function(response) {
	var self = this

	if (response.status && typeof response.data !== 'undefined') {
		jQuery('#SFDSWFB-existingAuthors').html(response.data)
		if (response.data.includes(',')) self.initSSE()
	} else if (!response.status) {
		if (typeof response.message !== 'undefined') loadDialogModal('Attention', response.message)
	} else {
		loadDialogModal('Error Sharing Form', 'Please enter a valid email and try again or contact SFDS.')
	}
}

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
*/

})
