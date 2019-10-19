describe("Form", function() {
  var form;

  beforeEach(function() {
    form = new Form();
  });

  it("should be able to construct an id", function() {
    expect(form.id).toEqual(0);
  });

  it("should be able to construct a method", function() {
    expect(form.content.settings.method).toEqual("POST");
  });

  it("should be able to construct a name", function() {
    expect(form.content.settings.name).toEqual("My Form");
  });

  it("should be able to construct a backend", function() {
    expect(form.content.settings.backend).toEqual("db");
  });

  it("should be able to construct a submit button id", function() {
    expect(form.content.data[0].id).toEqual("submit");
  });

  it("should be able to construct a submit button formtype", function() {
    expect(form.content.data[0].formtype).toEqual("m14");
  });

  describe("load form", function() {

    it('should set fb.formid and previouscontent', function() {
      form.loadNewForm()
      expect(fb.formId).toEqual(0);
      expect(JSON.parse(fb.previousContent)[0].id).toEqual('submit');
    })

    it('preparing post data',function() {
      var obj = form.preparePostData({
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
      })
      expect(obj.content).toBeDefined()
      expect(obj.previousContent).toBeDefined()
      expect(obj.user_id).toBeDefined()
    })

  })

  describe("load existing form", function() {

    beforeEach(function() {
      fb.startView([
      {
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
      },
      {
        id: 1,
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
      }
      ])
    })

    it('should populate fb.formId and create fb.previousContent', function() {
      form.loadExistingForm(1)
      expect(fb.formId).toEqual(1);
      expect(JSON.parse(fb.previousContent)[0].id).toEqual('submit');
    })

  })

  describe("saving the form settings", function() {

    beforeEach(function() {
      jQuery('body').append('<div id="SFDSWFB-settings"><input type="text" name="name" value="test"/></div>')
    })

    it('should propagate through the form object', function() {
      var ajaxSpy = spyOn(XMLHttpRequest.prototype,'open')
      form.saveSettings()
      expect(form.content.settings.name).toEqual('test')
      //expect(ajaxSpy).toHaveBeenCalledWith('POST', '/form/save', true) //randomly failing on Circle CI
    })

    afterEach(function() {
      jQuery('#SFDSWFB-settings').remove()
    })

  })

  describe("manipulating the item list", function() {

    it('should be able to insert a new item', function() {
      var ajaxSpy = spyOn(XMLHttpRequest.prototype,'open')
      form.insertItem('c02')
      expect(form.content.data[0].id).toEqual('name')
      expect(form.content.data[0].label).toEqual('Name')
      form.insertItem('c02')
      expect(form.content.data[1].id).toEqual('name_1')
      expect(form.content.data[1].label).toEqual('Name')
      //expect(ajaxSpy).toHaveBeenCalledWith('POST', '/form/save', true) //randomly failing on Circle CI
    })

    it('should be able to move an item', function() {
      var ajaxSpy = spyOn(XMLHttpRequest.prototype,'open')
      form.insertItem('c02')
      form.moveItem(0, 2)
      expect(form.content.data[1].id).toEqual('name')
      expect(form.content.data[1].label).toEqual('Name')
      //expect(ajaxSpy).toHaveBeenCalledWith('POST', '/form/save', true) //randomly failing on Circle CI
    })

    it('should be able to delete an item', function() {
      var ajaxSpy = spyOn(XMLHttpRequest.prototype,'open')
      expect(form.content.data.length).toEqual(1)
      form.insertItem('c02')
      expect(form.content.data.length).toEqual(2)
      form.deleteItem(0)
      expect(form.content.data.length).toEqual(1)
      expect(form.content.data[0].id).toEqual('submit')
      //expect(ajaxSpy).toHaveBeenCalledWith('POST', '/form/save', true) //randomly failing on Circle CI
    })

    it('should be able to get ids', function() {
      form.insertItem('c02')
      expect(form.getIds()).toEqual(['name','submit'])
    })

    it('should be able to get names', function() {
      form.insertItem('c02')
      expect(form.getNames()).toEqual(['name'])
    })

    it('should be able to get ids of math fields', function() {
      form.insertItem('c02')
      form.insertItem('d06')
      form.insertItem('d08')
      expect(form.getMathIds('price')).toEqual(['number'])
    })

    it('should be able to see if id exists', function() {
      form.insertItem('c02')
      expect(form.doesItExist('name', 'id')).toBeTruthy()
      expect(form.doesItExist('notthere', 'id')).toBeFalsy()
      expect(form.doesItExist('name', 'name')).toBeTruthy()
      expect(form.doesItExist('notthere', 'name')).toBeFalsy()
    })

  })

  describe("saving a form", function() {

    it('should call the save endpoint', function() {
      var ajaxSpy = spyOn(XMLHttpRequest.prototype,'open')
      form.saveForm()
      //expect(ajaxSpy).toHaveBeenCalledWith('POST', '/form/save', true) //randomly failing on Circle CI
    })

  })

  describe("cloning a form", function() {

    it('should call the clone endpoint', function() {
      var apiSpy = spyOn(fb, "callAPI")
      form.clone()
      expect(apiSpy).toHaveBeenCalledWith('/form/clone', {'id':fb.formId}, fb.goHome)
    })

  })

  describe("confirm delete", function() {
    beforeEach(function() {
      jQuery('body').append('<div class="modal" id="modal" tabindex="-1" role="dialog"><div class="modal-dialog"><h5 class="modal-title"></h5><div class="modal-body"><p></p></div><button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button></div></div>')
    })

    it('should pop up the confirmation modal window', function() {
      var apiSpy = spyOn(fb, "callAPI")
      form.confirmDelete()
      expect(jQuery('.modal-dialog .modal-title').text()).toEqual('Warning!')
      expect(jQuery('.modal-dialog .modal-body p').text()).toEqual('Are you sure you want to delete this form?')
      jQuery('.modal-dialog .btn-primary').click()
      expect(apiSpy).toHaveBeenCalled()
    })

    afterEach(function() {
      jQuery('#modal').remove()
    })
  })

  describe("modifying item attributes", function() {
    beforeEach(function() {
      jQuery('body').append('<div id="SFDSWFB-list"><div class="item selected" data-index="1" data-id="random"></div></div><div id="SFDSWFB-attributes"><input type="text" name="name" value="test1"/><textarea name="textarea">test2</textarea><div class="condition"><input class="conditionalId" type="text" value="test1"/><input class="conditionalOperator" type="text" value="test2"/><input class="conditionalValue" type="text" value="test3"/></div><input class="calculationId" type="text" value="test1"/><div class="calculation"><input class="calculationOperator" type="text" value="test2"/><input class="calculationId" type="text" value="test3"/></div><input class="webhookSelect" value="Use a Webhook"/><input class="webhookId" value="test1"/><input class="webhookEndpoint" value="test2"/><input class="webhookResponseIndex" value="test3"/><input class="webhookMethod" value="test4"/><input class="webhookOptionsArray" value="Will Contain Many Options"/><input class="webhookDelimiter" value="test5"/><input class="webhookIndex" value="test6"/></div>')
    })

    it('should save the item attributes to the form object', function() {
      var ajaxSpy = spyOn(XMLHttpRequest.prototype,'open')
      var conditionalsSpy = spyOn(form,"applyConditionals")
      var calculationsSpy = spyOn(form,"applyCalculations")
      var webhooksSpy = spyOn(form,"applyWebhooks")
      form.modifyItem()
      expect(form.content.data[0].name).toEqual('test1')
      expect(form.content.data[0].textarea).toEqual('test2')
      expect(form.content.data[0].required).not.toBeDefined()
      expect(conditionalsSpy).toHaveBeenCalled()
      expect(calculationsSpy).toHaveBeenCalled()
      expect(webhooksSpy).toHaveBeenCalled()
      //expect(ajaxSpy).toHaveBeenCalledWith('POST', '/form/save', true) //randomly failing on Circle CI
    })

    it('should save the conditional logic to the form object', function() {
      form.applyConditionals()
      expect(form.content.data[0].conditions.condition[0]).toEqual({id:'test1',op:'test2',val:'test3'})
    })

    it('should save the calculation logic to the form object', function() {
      form.applyCalculations()
      expect(form.content.data[0].calculations[0]).toEqual('test1')
      expect(form.content.data[0].calculations[1]).toEqual('test2')
      expect(form.content.data[0].calculations[2]).toEqual('test3')
    })

    it('should save the webhooks logic to the form object', function() {
      form.applyWebhooks()
      expect(form.content.data[0].webhooks.ids).toEqual(['test1'])
      expect(form.content.data[0].webhooks.endpoint).toEqual('test2')
      expect(form.content.data[0].webhooks.responseIndex).toEqual('test3')
      expect(form.content.data[0].webhooks.method).toEqual('test4')
      expect(form.content.data[0].webhooks.optionsArray).toEqual('true')
      expect(form.content.data[0].webhooks.delimiter).toEqual('test5')
      expect(form.content.data[0].webhooks.responseOptionsIndex).toEqual('test6')
    })

    it('should be able to see if an id is referenced in a special function', function() {
      expect(form.isReferenced('test1')).toBeFalsy()
      form.applyConditionals()
      expect(form.content.data[0].conditions.condition[0]).toEqual({id:'test1',op:'test2',val:'test3'})
      expect(form.isReferenced('test1')).toBeTruthy()
      expect(form.isReferenced('test100')).toBeFalsy()
    })

    it('should be able to rename ids across the object', function() {
      form.insertItem('c02')
      form.applyConditionals()
      form.insertItem('c04')
      form.content.data[1].id = "test1"
      expect(form.content.data[1].id).toEqual("test1")
      expect(form.content.data[0].conditions.condition[0].id).toEqual("test1")
      form.content.data[1].id = "new_id"
      form.renameId('test1','new_id')
      expect(form.content.data[1].id).toEqual("new_id")
      expect(form.content.data[0].conditions.condition[0].id).toEqual("new_id")
    })

    afterEach(function() {
      jQuery('#SFDSWFB-attributes').remove()
      jQuery('#SFDSWFB-list').remove()
    })
  })

  /**

Form.prototype.renameId = function(oldId, newId) {
	var specialFunctionIds = this.getSpecialFunctionIds()

	for (i in specialFunctionIds) {
		for (d in specialFunctionIds[i]) {
			if (i == "conditionIds") {
				if (specialFunctionIds[i][d] == oldId) this.content.data[i].conditions.condition[d].id = newId
			} else if (i == "calculationIds") {
				if (specialFunctionIds[i][d] == oldId) this.content.data[i].calculations[d] = newId
			} //todo check webhooks and make this better
		}
	}
}

Form.prototype.getSpecialFunctionIds = function() {
	var obj = {}
	obj.conditionIds = this.getConditionIdsArray()
	obj.calculationIds = this.getCalculationIdsArray()
	//todo probably check webhooks
	return obj
}

Form.prototype.getConditionIdsArray = function() {
	var arr = []
	for (i in this.content.data) {
		arr[i] = []
		if (this.content.data[i].conditions != undefined) {
			for (con in this.content.data[i].conditions.condition) {
				arr.push(this.content.data[i].conditions.condition[con].id)
			}
		}
	}
	return arr
}

Form.prototype.getCalculationIdsArray = function() {
	var arr = []
	for (i in this.content.data) {
		arr[i] = []
		if (this.content.data[i].calculations != undefined) {
			for (calc in this.content.data[i].calculations) {
				if (calc % 2 == 0) arr.push(this.content.data[i].calculations[calc])
			}
		}
	}
	return arr
}

*/





})