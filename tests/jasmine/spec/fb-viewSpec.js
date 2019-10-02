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


})