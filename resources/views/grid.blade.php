@extends('layouts.app')
@section('content')

<p>Grid and other components can load and save data through a common REST protocol </p>
<div id='grid-container'></div>
<script>

var toolbar = {
	view:"toolbar",
	cols:[
		{ view:"button", value:"Add Row", width:120, click:function(){
			$$("grid").add({})
		}},
		{ view:"button", value:"Delete Row", width:120, click:function(){
			var rows = $$("grid").getSelectedId(true);
			if (rows.length)
				$$("grid").remove(rows);

		}},
	]
};

var grid = {
	view:"datatable", id:"grid", select:true,
	autoheight:true, scroll:false,
	editable:true,
	columns:[
		{ id:"username", header:"User Name", editor:"text"},
		{ id:"name", header:"Real Name", editor:"text"},
		{ id:"email", header:"Email", width: 150, editor:"text"},
		{ id:"age", header:"Age", width: 45, editor:"text"},
		{ id:"group_id", header:"Group", options:"/form/options", width:80, editor:"richselect"},
		{ id:"birthday", header:"Birthday", map:"(date)", fillspace:1, editor:"date"}
	],
	url:"/grid/data",
	save:"rest->/grid/data"
};

webix.ui({
	width:640, type:"space",
	container:"grid-container",
	rows:[
		toolbar, grid
	]
});
</script>

@endsection