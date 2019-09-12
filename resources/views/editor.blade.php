@extends('layouts.app')
@section('content')

    @include ('partials.loading-js')

		@include('partials.header')

    @include('partials.welcome')
	
	
<style>
	.header-container {max-width:none;padding:0 15px}
	a:link, a:visited, a:hover, a:active {text-decoration:none}
	#SFDSWFB-list {margin-top:1em;padding:1em;border:1px solid #ddd;border-radius:5px;max-height:768px;overflow-y:scroll}
	#SFDSWFB-list a {display:inline-block}
	#SFDSWFB-list .itemCount {display:inline-block;color:#ccc;padding-right:.5em}
	#SFDSWFB-list .item {padding:.25em;width:calc(100% - 2.5em)}
	#SFDSWFB-list .item:hover, #SFDSWFB-list .item.selected {background-color: #eee}
	#SFDSWFB-list .item.spacer {height:1em;width:100%}
	#SFDSWFB-list .item.spacer:hover, #SFDSWFB-list .item.spacer.selected {margin-bottom:1em;border-bottom:2px solid blue;background-color:transparent}
	.menu-button {display:block;padding:.5em;border-radius:5px;border:1px solid #ddd;position:absolute;top:.5em}
	.embed-toggle {right:5.5em}
	.settings-toggle {right:3em}
	.horizontal-toggle {right:.5em}
	.preview-window {right:1em}
	.col-xl-1 > a.min-hidden {display:none}
	#SFDSWFB-preview iframe {height:772px;width:100%}
	.middlePanel > div {display:none}
	.field-item {padding:1em;margin:.5em;border:2px solid blue;color:blue;font-weight:bold;border-radius:5px;cursor:pointer;float:left}
	.field-item.t2 {color:purple;border-color:purple}
	.field-item.t3 {color:red;border-color:red}
	.field-item.t4 {color:orange;border-color:orange}
	.field-item:hover {color:black;border-color:black}
</style>	
<script>
$(document).ready(function () {
})
</script>	
	

    <div style="display:none" class="editorContainer">

		<div class="col-xs-12 col-sm-5 col-lg-3 col-xl-2 leftPanel">
			<h4>Navigation</h4>
			<div class="tab-pane" id="SFDSWFB-list">
			</div>
		</div>
	
		<div class="col-xs-12 col-sm-7 col-lg-1 col-xl-1 middlePanel">
			<a href="javascript:void(0)" onclick="showMiddlePanel('SFDSWFB-embed')" title="Embed" class="embed-toggle menu-button min-hidden md-hidden fa fa-share-alt"></a>
			<a href="javascript:void(0)" onclick="showMiddlePanel('SFDSWFB-settings')" title="Settings" class="settings-toggle menu-button min-hidden md-hidden fa fa-cog"></a>
			<a href="javascript:void(0)" onclick="toggleMiddlePanel()" title="Resize" class="horizontal-toggle menu-button md-hidden fa fa-angle-double-right"></a>
			<div class="tab-pane" id="SFDSWFB-insert">
				<h4>Insert Field</h4>
				<a href="javascript:void(0)" onclick="insertField('c02')" class="field-item t1">Name</a>
				<a href="javascript:void(0)" onclick="insertField('c04')" class="field-item t1">Email</a>
				<a href="javascript:void(0)" onclick="insertField('c06')" class="field-item t1">Phone</a>
				<a href="javascript:void(0)" onclick="insertField('c08')" class="field-item t1">Address</a>
				<a href="javascript:void(0)" onclick="insertField('c10')" class="field-item t1">City</a>
				<a href="javascript:void(0)" onclick="insertField('s14')" class="field-item t1">State</a>
				<a href="javascript:void(0)" onclick="insertField('c14')" class="field-item t1">Zip</a>
				<a href="javascript:void(0)" onclick="insertField('d02')" class="field-item t2">Date</a>
				<a href="javascript:void(0)" onclick="insertField('d04')" class="field-item t2">Time</a>
				<a href="javascript:void(0)" onclick="insertField('d06')" class="field-item t2">Numbers</a>
				<a href="javascript:void(0)" onclick="insertField('d08')" class="field-item t2">Price</a>
				<a href="javascript:void(0)" onclick="insertField('d10')" class="field-item t2">URL</a>
				<a href="javascript:void(0)" onclick="insertField('i02')" class="field-item t3">Text</a>
				<a href="javascript:void(0)" onclick="insertField('i14')" class="field-item t3">Textarea</a>
				<a href="javascript:void(0)" onclick="insertField('s02')" class="field-item t3">Select</a>
				<a href="javascript:void(0)" onclick="insertField('s06')" class="field-item t3">Checkboxes</a>
				<a href="javascript:void(0)" onclick="insertField('s08')" class="field-item t3">Radio</a>
				<a href="javascript:void(0)" onclick="insertField('m02')" class="field-item t4">H1</a>
				<a href="javascript:void(0)" onclick="insertField('m04')" class="field-item t4">H2</a>
				<a href="javascript:void(0)" onclick="insertField('m06')" class="field-item t4">H3</a>
				<a href="javascript:void(0)" onclick="insertField('m08')" class="field-item t4">Paragraph</a>
				<a href="javascript:void(0)" onclick="insertField('m10')" class="field-item t4">HTML</a>
				<a href="javascript:void(0)" onclick="insertField('m11')" class="field-item t4">Hidden</a>
				<a href="javascript:void(0)" onclick="insertField('m13')" class="field-item t4">File</a>
				<a href="javascript:void(0)" onclick="insertField('m16')" class="field-item t4">Page Separator</a>
			</div>
			<div class="tab-pane" id="SFDSWFB-attributes">
				<h4>Edit Attributes</h4>
			</div>
			<div class="tab-pane" id="SFDSWFB-settings">
			  @include('partials.settings')
			</div>
			<div class="tab-pane" id="SFDSWFB-embed">
			  @include('partials.embed-code')
			</div>
		</div>

		<div class="sm-hidden col-lg-8 col-xl-9 rightPanel">
			<a href="javascript:void(0)" onclick="openPreviewWindow()" title="Preview in a New Window" class="preview-window menu-button fa fa-window-restore"></a>
			<h4>Form Preview</h4>
			<div class="tab-pane" id="SFDSWFB-preview"></div>
		</div>


      </div> {{--  /.row --}}
      <div class="row clearfix">
        <div class="col-md-12"></div>
      </div>
    </div> {{--  /.container --}}
	
@endsection
