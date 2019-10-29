describe("Fb View", function() {

  beforeEach(function() {
    fb = new Fb()
    fb.fbView = new FbView(new FormsCollection([{
      id: 0,
      content: {
        settings: {
          action: "",
          method: "POST",
          name: "My Form",
          backend: "db"
        },
        data: [{
          label: "Name",
          id: "name",
          name: "name",
          formtype: "c02",
          required: "true",
          type: "text"
        },
        {
          label: "Email",
          id: "email",
          name: "email",
          formtype: "c04",
          required: "true",
          type: "email"
        },
        {
          button: "Submit",
          id: "submit",
          formtype: "m14",
          color: "btn-primary"
        }]
      }
    }]));
  });

  it("should be able to construct itself", function() {
    expect(fb.fbView.formsCollection.forms[fb.formId].id).toEqual(0);
  });

  describe("When a nav list is created", function() {
    beforeEach(function() {
      jQuery('body').append('<div id="SFDSWFB-list"></div>')
      fb.fbView.populateList()
    })

    it("should have a list of links", function() {
      expect(fb.fbView).toBeDefined()
      expect(jQuery('a.spacer[data-id=name]').is(':visible')).toBeTruthy()
      expect(jQuery('a.fa-sort[data-id=name]').length).toEqual(1)
      expect(jQuery('a.field[data-id=name]').is(':visible')).toBeTruthy()
      expect(jQuery('a.fa-times[data-id=name]').length).toEqual(1)
      expect(jQuery('a.spacer[data-id=email]').is(':visible')).toBeTruthy()
      expect(jQuery('a.fa-sort[data-id=email]').length).toEqual(1)
      expect(jQuery('a.field[data-id=email]').is(':visible')).toBeTruthy()
      expect(jQuery('a.fa-times[data-id=email]').length).toEqual(1)
      expect(jQuery('a.spacer[data-index=1]').is(':visible')).toBeTruthy()
      expect(jQuery('a.fa-sort[data-index=1]').length).toEqual(1)
      expect(jQuery('a.field[data-index=1]').is(':visible')).toBeTruthy()
      expect(jQuery('a.fa-times[data-index=1]').length).toEqual(1)
      expect(jQuery('a.spacer[data-index=2]').is(':visible')).toBeTruthy()
      expect(jQuery('a.fa-sort[data-index=2]').length).toEqual(1)
      expect(jQuery('a.field[data-index=2]').is(':visible')).toBeTruthy()
      expect(jQuery('a.fa-times[data-index=2]').length).toEqual(1)
      expect(jQuery('a.spacer[data-index=3]').is(':visible')).toBeTruthy()
    })

    it('should be able to insert a new item', function() {
      /*
      var ajaxSpy = spyOn(XMLHttpRequest.prototype,'open')
      form.insertItem('c02')
      expect(form.content.data[0].id).toEqual('name')
      expect(form.content.data[0].label).toEqual('Name')
      form.insertItem('c02')
      expect(form.content.data[1].id).toEqual('name_1')
      expect(form.content.data[1].label).toEqual('Name')
      expect(ajaxSpy).toHaveBeenCalledWith('POST', '/form/save', true)
      */
    })

    it('should be able to move an item', function() {
      jQuery('a.fa-sort[data-id=name]').click()
      jQuery('a.spacer[data-index=3]').click()
      expect(jQuery.trim(jQuery('a.field[data-index=1]').text())).toEqual('01email')
      expect(jQuery.trim(jQuery('a.field[data-index=2]').text())).toEqual('02name')
    })

    it('should be able to delete an item', function() {
      /*
      var ajaxSpy = spyOn(XMLHttpRequest.prototype,'open')
      expect(form.content.data.length).toEqual(1)
      form.insertItem('c02')
      expect(form.content.data.length).toEqual(2)
      form.deleteItem(0)
      expect(form.content.data.length).toEqual(1)
      expect(form.content.data[0].id).toEqual('submit')
      expect(ajaxSpy).toHaveBeenCalledWith('POST', '/form/save', true)
      */
    })

    afterEach(function() {
      jQuery('#SFDSWFB-list').remove()
    })
  })

  describe("When the settings tab is created", function() {
    beforeEach(function() {
      jQuery('body').append('<div id="SFDSWFB-settings"><div class="form-group"><label class="control-label" for="backend">Backend</label><select class="form-control" id="backend" name="backend"><option value="db">I have a database and submission endpoint</option><option value="csv">I want to create a Webform Buider CSV database</option></select></div><div class="form-group csvFile" style="display:none"><a href="javascript:void(0)" class="btn btn-info">Open CSV File</a></div><div class="form-group"><label class="control-label" for="action">Form Action</label><input class="form-control" type="text" id="action" name="action"/></div><div class="form-group confirmPage" style="display:none"><label class="control-label" for="confirmation">Confirmation Page</label><input class="form-control" type="text" id="confirmation" name="confirmation"/></div></div>')
    })

    it('should be able to populate form backend settings', function() {
      expect(fb.fbView.formsCollection.forms[fb.formId].content.settings.method).toEqual('POST');
      expect(fb.fbView.formsCollection.forms[fb.formId].content.settings.name).toEqual('My Form');
      expect(fb.fbView.formsCollection.forms[fb.formId].content.settings.backend).toEqual('db');
      fb.fbView.populateSettings()
      expect(jQuery('#action').val()).toEqual('')
      expect(jQuery('#backend').val()).toEqual('db')
      expect(jQuery('#confirmation').is(':visible')).toBeFalsy()
      jQuery('#backend').val('csv')
      fb.fbView.toggleConfirmPage(jQuery('#backend'))
      expect(jQuery('#action').val()).not.toEqual('')
      expect(jQuery('#backend').val()).toEqual('csv')
      expect(jQuery('#confirmation').is(':visible')).toBeTruthy()
      jQuery('#backend').val('db')
      fb.fbView.toggleConfirmPage(jQuery('#backend'))
      expect(jQuery('#action').val()).toEqual('')
      expect(jQuery('#backend').val()).toEqual('db')
      expect(jQuery('#confirmation').is(':visible')).toBeFalsy()
    })


    afterEach(function() {
      jQuery('#SFDSWFB-settings').remove()
    })
  })

})