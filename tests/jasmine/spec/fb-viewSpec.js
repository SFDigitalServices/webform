describe("Fb View", function() {
  var formsCollection;
  var fbView;

  beforeEach(function() {
    formsCollection = new FormsCollection([{
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
    }]);
    fbView = new FbView(formsCollection)
  });

  it("should be able to construct itself", function() {
    expect(fbView.formsCollection.forms[0].id).toEqual(0);
  });

  describe("When a nav list is created", function() {
    beforeEach(function() {
      jQuery('body').append('<div id="SFDSWFB-list"></div>')
      fbView.populateList()
    })

    it("should have a list of links", function() {
      expect(fb.fbView).toBeDefined()
      expect(jQuery('a.spacer[data-id=name]').is(':visible')).toBeTruthy()
      expect(jQuery('a.fa-sort[data-id=name]').is(':visible')).toBeTruthy()
      expect(jQuery('a.field[data-id=name]').is(':visible')).toBeTruthy()
      expect(jQuery('a.fa-times[data-id=name]').is(':visible')).toBeTruthy()
      expect(jQuery('a.spacer[data-id=email]').is(':visible')).toBeTruthy()
      expect(jQuery('a.fa-sort[data-id=email]').is(':visible')).toBeTruthy()
      expect(jQuery('a.field[data-id=email]').is(':visible')).toBeTruthy()
      expect(jQuery('a.fa-times[data-id=email]').is(':visible')).toBeTruthy()
      expect(jQuery('a.spacer[data-index=1]').is(':visible')).toBeTruthy()
      expect(jQuery('a.fa-sort[data-index=1]').is(':visible')).toBeTruthy()
      expect(jQuery('a.field[data-index=1]').is(':visible')).toBeTruthy()
      expect(jQuery('a.fa-times[data-index=1]').is(':visible')).toBeTruthy()
      expect(jQuery('a.spacer[data-index=2]').is(':visible')).toBeTruthy()
      expect(jQuery('a.fa-sort[data-index=2]').is(':visible')).toBeTruthy()
      expect(jQuery('a.field[data-index=2]').is(':visible')).toBeTruthy()
      expect(jQuery('a.fa-times[data-index=2]').is(':visible')).toBeTruthy()
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

})