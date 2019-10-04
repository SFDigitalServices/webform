@extends('layouts.app')
@section('content')

    @include ('partials.loading-js')

		@include('partials.header')

    @include('partials.welcome')

    <div style="display:none" class="editorContainer">

		<div class="leftPanel">
			  @include('partials.navigation')
		</div>

		<div class="middlePanel">
			  @include('partials.insert')
			<div class="tab-pane" id="SFDSWFB-attributes">
			  @include('partials.attributes')
			</div>
			<div class="tab-pane" id="SFDSWFB-sort">
			  @include('partials.sort')
			</div>
			<div class="tab-pane" id="SFDSWFB-settings">
			  @include('partials.settings')
			</div>
			<div class="tab-pane" id="SFDSWFB-embed">
			  @include('partials.embed-code')
			</div>
		</div>

		<div class="rightPanel">
      <div class="rightPanel-preview-wrapper">
  			@include('partials.preview')
      </div>
		</div>


      </div> {{--  /.row --}}
    </div> {{--  /.container --}}

  @include('modal')

@endsection