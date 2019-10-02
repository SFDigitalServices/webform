describe("Forms Collection", function() {
  var formsCollection;

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
          button: "Submit",
          id: "submit",
          formtype: "m14",
          color: "btn-primary"
        }]
      }
    }]);
  });

  it("should be able to construct an id", function() {
    expect(formsCollection.forms[0].id).toEqual(0);
  });

  it("should be able to construct a method", function() {
    expect(formsCollection.forms[0].content.settings.method).toEqual("POST");
  });

  it("should be able to construct a name", function() {
    expect(formsCollection.forms[0].content.settings.name).toEqual("My Form");
  });

  it("should be able to construct a backend", function() {
    expect(formsCollection.forms[0].content.settings.backend).toEqual("db");
  });

  it("should be able to construct a submit button id", function() {
    expect(formsCollection.forms[0].content.data[0].id).toEqual("submit");
  });

  it("should be able to construct a submit button formtype", function() {
    expect(formsCollection.forms[0].content.data[0].formtype).toEqual("m14");
  });

})