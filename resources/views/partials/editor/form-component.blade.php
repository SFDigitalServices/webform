<div class="form-group component" data-formtype="{{$formtype}}" data-type="{{$type}}" data-name="{{$name}}" data-required="true" rel="popover" title="{{$title}}" trigger="manual" data-content="
  <form class='form'>
    <div class='form-group col-md-12'>
    	{{$popover}}
	<hr/>
	<button class='btn btn-info'>OK</button><button class='btn btn-danger'>Cancel</button>
	</div>
</form>" data-html="true">
	{{$slot}}
</div>