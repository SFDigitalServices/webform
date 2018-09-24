@extends('layouts.app')
@section('content')

<p>There are no tricks in the paging mode. Paging can be used with dynamic or normal data loading. </p>
<div id='grid-container'></div>
<script>

var grid = {
	view:"datatable", id:"grid", select:true,
	autoheight: true, autowidth:true, 
	editable:true,
	columns:[
		{ id:"id" },
		{ id:"name", header:["File Name", { content:"serverFilter"}], sort:"server", width: 200 }
	],
	pager:"bottom",
	url:"/grid/data-dynamic"
};

var pager = {
	view:"pager", id:"bottom"
};

webix.ui({
	type:"space",
	container:"grid-container",
	rows:[
		grid, pager
	]
});
</script>

@endsection