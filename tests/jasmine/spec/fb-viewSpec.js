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
          label: "Number",
          id: "number",
          name: "number",
          formtype: "d06",
          required: "true",
          type: "number"
        },
        {
          label: "Number 1",
          id: "number1",
          name: "number1",
          formtype: "d06",
          required: "true",
          type: "number"
        },
        {
          label: "Number 2",
          id: "number2",
          name: "number2",
          formtype: "d06",
          required: "true",
          type: "number",
          calculations: ["number", "Plus", "number1"]
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

  it("should be able to construct itself", function() {
    expect(fb.fbView.formsCollection.forms[fb.formId].id).toEqual(0);
  });

  describe("When attributes to a field is created", function() {
    beforeEach(function() {
      jQuery('body').append("<div id='SFDSWFB-attributes'> \
        <div class='modal' id='modal' tabindex='-1' role='dialog'><div class='modal-dialog'><h5 class='modal-title'></h5><div class='modal-body'><p></p></div><button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button></div></div>\
        <div class='accordion-conditionals'> \
          <div class='accordion-section conditionals'> \
            <div class='accordion-header'>Conditionals</div> \
            <div class='accordion'> \
              <div class='clonable addConditionalContainer'> \
                <div class='addConditional' style=''> \
                  <a href='javascript:void(0)' onclick='javascript:addConditional()'>+Add A Condition</a> \
                </div> \
              </div> \
            </div> \
          </div> \
        </div> \
        <div class='accordion-calculations'> \
          <div class='accordion-section calculations'> \
            <div class='accordion-header'>Calculations</div> \
            <div class='accordion'> \
              <div class='addCalculationContainer'> \
                <div class='addCalculation'> \
                  <a class='addCalculationButton'>+Add A Calculation</a> \
                </div> \
              </div> \
            </div> \
          </div> \
        </div> \
      </div>")
    })

    it("should load calculations for fields with calculation", function() {
      fb.fbView.populateCalculations(fb.fbView.formsCollection.forms[fb.formId].content.data[4])
      expect(jQuery('.firstCalculation').is(':visible')).toBeTruthy()
      expect(jQuery('.calculationContainer').is(':visible')).toBeTruthy()
    })

    it("should not load calculations for fields without calculations", function() {
      fb.fbView.populateCalculations(fb.fbView.formsCollection.forms[fb.formId].content.data[3])
      expect(jQuery('.firstCalculation').is(':visible')).toBeFalsy()
      expect(jQuery('.calculationContainer').is(':visible')).toBeFalsy()
    })

    it("should be able to calculate numeric fields", function() {
      fb.fbView.addCalculation();
      expect(jQuery('select.allMathIds').length).toEqual(2)
      expect(jQuery('select.allMathIds').eq(0).text()).toEqual('numbernumber1number2')
    })

    it("should be able to add conditionals", function() {
      fb.fbView.addConditional();
      expect(jQuery('.firstConditional').is(':visible')).toBeTruthy()
      expect(jQuery('.conditionalId').is(':visible')).toBeTruthy()
      expect(jQuery('.conditionalOperator').is(':visible')).toBeTruthy()
      expect(jQuery('.conditionalValue').is(':visible')).toBeTruthy()
    })

    it("should be able to add conditionals", function() {
      fb.fbView.formsCollection.forms[fb.formId].content.data.splice(1,4)
      fb.fbView.addConditional();
      expect(jQuery('.modal-dialog .modal-title').text()).toEqual('Notice')
      expect(jQuery('.modal-dialog .modal-body p').text()).toEqual('You need more fields in your form before adding a conditional.')
    })

    afterEach(function() {
      jQuery('#SFDSWFB-attributes').remove()
    })
  })

  describe("When attributes to a field is created", function() {
    beforeEach(function() {
      jQuery('body').append("<div id='SFDSWFB-attributes'> \
        <div class='accordion-validation'> \
          <div class='accordion-section validation'> \
            <div class='accordion-header'>Validation</div> \
            <div class='accordion'> \
            </div> \
          </div> \
        </div> \
      </div>")
    })

    it('should load the correct validations for text type', function() {
      fb.fbView.populateValidation(fb.fbView.formsCollection.forms[fb.formId].content.data[0])
      expect(jQuery('#minlength').is(':visible')).toBeTruthy()
      expect(jQuery('#maxlength').is(':visible')).toBeTruthy()
      expect(jQuery('.validation .validate-minmax').is(':visible')).toBeFalsy()
    })

    it('should load the correct validations for number type', function() {
      fb.fbView.populateValidation(fb.fbView.formsCollection.forms[fb.formId].content.data[2])
      expect(jQuery('#minlength').is(':visible')).toBeFalsy()
      expect(jQuery('#maxlength').is(':visible')).toBeFalsy()
      expect(jQuery('.validation .validate-minmax').is(':visible')).toBeTruthy()
    })

    afterEach(function() {
      jQuery('#SFDSWFB-attributes').remove()
    })
  })
})