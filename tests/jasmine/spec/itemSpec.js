describe("Item", function() {
  var item;

	describe("When a new c02 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'c02'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('Name');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('name');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toEqual('text');
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.calculations).toBeNull();
    });

  });

	describe("When a new i02 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'i02'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('Text');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('text');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toEqual('text');
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.calculations).toBeNull();
    });

  });

	describe("When a new c08 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'c08'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('Address');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('address');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toEqual('text');
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.calculations).toBeNull();
    });

  });

	describe("When a new c10 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'c10'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('City');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('city');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toEqual('text');
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.calculations).toBeNull();
    });

  });

	describe("When a new c14 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'c14'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('Zip');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('zip');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toEqual('text');
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.calculations).toBeNull();
    });

  });

	describe("When a new c04 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'c04'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('Email');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('email');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toEqual('email');
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.calculations).toBeNull();
    });

  });

	describe("When a new c06 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'c06'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('Phone');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('phone');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toEqual('tel');
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.calculations).toBeNull();
    });

  });

	describe("When a new d02 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'd02'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('Date');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('date');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toEqual('date');
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.calculations).toBeNull();
    });

  });

	describe("When a new d04 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'd04'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('Time');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('time');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toEqual('time');
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.calculations).toBeNull();
    });

  });

	describe("When a new d10 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'd10'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('URL');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('url');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toEqual('url');
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.calculations).toBeNull();
    });

  });

	describe("When a new m13 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'm13'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('Upload File');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('upload_file');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toEqual('file');
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.calculations).toBeNull();
    });

  });

	describe("When a new d06 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'd06','unit':'km'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('Number');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('number');
    });

    it("should have a unit attribute", function() {
      expect(item.unit).toEqual('km');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toEqual('number');
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

  });

	describe("When a new d08 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'd08'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('Price');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('price');
    });

    it("should not have a unit attribute", function() {
      expect(item.unit).toBeNull();
    });

    it("should be able to construct itself", function() {
      expect(item.type).toEqual('number');
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

  });

	describe("When a new i14 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'i14'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('Textarea');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('textarea');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toBeNull();
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.calculations).toBeNull();
    });

    it("should remove the regular attributes", function() {
      expect(item.type).toBeNull();
      expect(item.value).toBeNull();
    });

  });

	describe("When a new s02 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 's02'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('Select');
      expect(item.option).toEqual("Choice 1\nChoice 2\nChoice 3")
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('select');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toBeNull();
    });

    it("should remove all special attributes", function() {
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the regular attributes", function() {
      expect(item.placeholder).toBeNull();
      expect(item.type).toBeNull();
    });

  });

	describe("When a new s14 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 's14'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('State');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('state');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toBeNull();
    });

    it("should remove all special attributes", function() {
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the regular attributes", function() {
      expect(item.placeholder).toBeNull();
      expect(item.type).toBeNull();
    });

  });

	describe("When a new s06 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 's06'}, [], []);
      expect(item.checkboxes).toEqual("Choice 1\nChoice 2\nChoice 3")
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('Checkboxes');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('checkboxes');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toBeNull();
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the regular attributes", function() {
      expect(item.placeholder).toBeNull();
      expect(item.type).toBeNull();
    });

  });

	describe("When a new s08 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 's08'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('Radio');
      expect(item.radios).toEqual("Choice 1\nChoice 2\nChoice 3")
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('radio');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toBeNull();
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the regular attributes", function() {
      expect(item.placeholder).toBeNull();
      expect(item.type).toBeNull();
    });

  });

	describe("When a new m11 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'm11'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toBeNull();
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('hidden');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toEqual('hidden');
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.validation).toBeNull();
    });

    it("should remove the regular attributes", function() {
      expect(item.label).toBeNull();
      expect(item.help).toBeNull();
      expect(item.placeholder).toBeNull();
    });

  });

	describe("When a new m08 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'm08'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toBeNull();
      expect(item.textarea).toEqual('Paragraph');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('paragraph');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toBeNull();
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.validation).toBeNull();
      expect(item.calculations).toBeNull();
    });

    it("should remove the regular attributes", function() {
      expect(item.name).toBeNull();
      expect(item.label).toBeNull();
      expect(item.help).toBeNull();
      expect(item.placeholder).toBeNull();
      expect(item.type).toBeNull();
      expect(item.value).toBeNull();
    });

  });

	describe("When a new m10 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'm10'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toBeNull();
      expect(item.codearea).toEqual('HTML Code');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('html_code');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toBeNull();
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.validation).toBeNull();
      expect(item.calculations).toBeNull();
    });

    it("should remove the regular attributes", function() {
      expect(item.name).toBeNull();
      expect(item.label).toBeNull();
      expect(item.help).toBeNull();
      expect(item.placeholder).toBeNull();
      expect(item.type).toBeNull();
      expect(item.value).toBeNull();
    });

  });

	describe("When a new m02 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'm02'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toBeNull();
      expect(item.textarea).toEqual('Header 1');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('header_1');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toBeNull();
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.validation).toBeNull();
      expect(item.calculations).toBeNull();
    });

    it("should remove the regular attributes", function() {
      expect(item.name).toBeNull();
      expect(item.label).toBeNull();
      expect(item.help).toBeNull();
      expect(item.placeholder).toBeNull();
      expect(item.type).toBeNull();
      expect(item.value).toBeNull();
    });

  });

	describe("When a new m06 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'm04'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toBeNull();
      expect(item.textarea).toEqual('Header 2');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('header_2');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toBeNull();
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.validation).toBeNull();
      expect(item.calculations).toBeNull();
    });

    it("should remove the regular attributes", function() {
      expect(item.name).toBeNull();
      expect(item.label).toBeNull();
      expect(item.help).toBeNull();
      expect(item.placeholder).toBeNull();
      expect(item.type).toBeNull();
      expect(item.value).toBeNull();
    });

  });

	describe("When a new m04 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'm06'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toBeNull();
      expect(item.textarea).toEqual('Header 3');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('header_3');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toBeNull();
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.validation).toBeNull();
      expect(item.calculations).toBeNull();
    });

    it("should remove the regular attributes", function() {
      expect(item.name).toBeNull();
      expect(item.label).toBeNull();
      expect(item.help).toBeNull();
      expect(item.placeholder).toBeNull();
      expect(item.type).toBeNull();
      expect(item.value).toBeNull();
    });

  });

	describe("When a new m16 item is initialized", function() {

    beforeEach(function() {
      item = new Item({'formtype' : 'm16'}, [], []);
    });

    it("should be able to construct itself", function() {
      expect(item.label).toEqual('Page_Separator');
    });

    it("should be able to have a unique ID", function() {
      expect(item.id).toEqual('page_separator');
    });

    it("should be able to construct itself", function() {
      expect(item.type).toBeNull();
    });

    it("should remove all special attributes", function() {
      expect(item.option).toBeNull();
      expect(item.checkboxes).toBeNull();
      expect(item.radios).toBeNull();
      expect(item.textarea).toBeNull();
      expect(item.codearea).toBeNull();
    });

    it("should remove the calculations special functions", function() {
      expect(item.validation).toBeNull();
      expect(item.conditionals).toBeNull();
      expect(item.calculations).toBeNull();
      expect(item.webhooks).toBeNull();
    });

    it("should remove the regular attributes", function() {
      expect(item.name).toBeNull();
      expect(item.help).toBeNull();
      expect(item.placeholder).toBeNull();
      expect(item.type).toBeNull();
      expect(item.value).toBeNull();
    });

  });

})
