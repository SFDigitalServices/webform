<div class="modal" id="$id" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title">
			@isset($title)
				{{$title}}
			@endisset
		</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>
	  <div class="modal-body">
		{{$slot}}

		@empty($slot)
			<p></p>
		@endempty
	  </div>
	  <div class="modal-footer">
	  	@isset($secondary)
			<button type="button" class="btn btn-secondary" data-dismiss="modal" $primaryAttrs>$secondary</button>
		@endisset
		@isset($primary)
			<button type="button" class="btn btn-primary" data-dismiss="modal">$primary</button>
		@endisset
	  </div>
	</div>
  </div>
</div>