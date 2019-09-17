@extends('layouts.app')
@section('content')

    @include ('partials.loading-js')

		@include('partials.header')

    @include('partials.welcome')
	
    <div style="display:none" class="editorContainer">

		<div class="col-xs-12 col-sm-5 col-lg-3 col-xl-2 leftPanel">
			  @include('partials.navigation')
		</div>
	
		<div class="col-xs-12 col-sm-7 col-lg-1 col-xl-1 middlePanel">
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

		<div class="sm-hidden col-lg-8 col-xl-9 rightPanel">
			  @include('partials.preview')
		</div>


      </div> {{--  /.row --}}
      <div class="row clearfix">
        <div class="col-md-12"></div>
      </div>
    </div> {{--  /.container --}}
	
@endsection
