@extends('layouts.app')
@section('content')

<p>For a data loading request, the server side returns a json object which will be mapped to inputs based on the "name" property of each input.</p>
<p>To save data, just use webix.ajax and form.getValues</p>
<div id='form-container'></div>
<script>

var list = {
	view:"list", id:"mylist",
	autoheight:true, select:true,
	template:"#name# &lt;#email#&gt;",
	ready:function(){
		this.select(this.getFirstId());
	},
	on:{
		onAfterSelect:function(id){
			$$("myform").load("/form/data/"+id);
		}
	},
	url:"/grid/data"
};

var form = {
	view:"form", id:"myform",
	rows:[
		{ view:"text", name:"name", label:"Name" },
		{ view:"text", name:"email", label:"Email" },
		{ view:"richselect", name:"group_id", label:"Group", options:"/form/options" },
		{ view:"button", value:"Save", click:function(){
			var data = this.getFormView().getValues();
			//send data to server
			webix.ajax().post("/form/data", data).then(() => webix.message("Saved."));
			//update related client-side UI
			$$("mylist").updateItem(data.id, data);
		}}
	]
};

var form = webix.ui({
	width:640, type:"space",
	container:"form-container",
	cols:[ list, form ]
});

$$("myform").elements.name.focus();
</script>

@endsection