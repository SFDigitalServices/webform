@extends('layouts.app')
@section('content')

<script>
  $(document).ready(function(){
      $(".content").show(1500);

		var settings = {
			"async": true,
			"crossDomain": true,
			"url": "/form/getForms",
			"method": "POST",
			"headers": {
				"authorization": "Bearer <?php echo $api_token;?>",
				"content-type": "application/x-www-form-urlencoded",
				"cache-control": "no-cache"
			},
			"data": {
				"user_id": <?php echo $user_id;?>,
				"api_token": <?php echo $api_token;?>,
			}
		}
		$.ajax(settings).done(function (response) {
			$.each(response, function(index, element) {
				//console.log(element);
            	addedElement = $('.forms').append('<div>').append($('<a>', {
                	text: 'Form id = ' + element.id,
					id: 'form-' + element.id,
				}));
				
        	});
		});

      $("a").on("click",function(){
	  		$(".content").hide("fast");
		});
    });

    $(window).unload(function(){});

    $(window).focus(
		function() {
		     $(".content").show(1500);      
		   }
	   );
</script>

<div class="header">
		<div style="display:block;max-width:1140px;text-align:right;margin:auto">
			<div style="background:#fff;width:232px;float:left;position:absolute;top:0px;box-shadow:0 0 10px #888"/><img src="/assets/images/SF_Digital_Services-logo.png"/></div>
			SAN FRANCISCO <b>DIGITAL SERVICES</b> WEBFORM BUILDER
		</div>
	</a>

	<div class="content" style="display:none">
             <div class="hidden-xs col-sm-1 col-md-2 col-lg-3">&nbsp;</div>
	     <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
               <h1 style="margin-top:15vh">Welcome back <?php print $name; ?>,</h1>
               <div style="text-align:center;padding:4em;margin:2em;border:1px solid #ddd;border-radius:5px">
                 <div>
                     <a href="/createView" class="btn btn-info btn-lg btn-block">Create a New Form</a>
                 </div>
                 
                     <div class="text-muted" style="padding:2em 0">or load an existing form</div>
	             <div class="forms">
				</div>
	
               </div>
             </div>
	     <div class="hidden-xs col-sm-1 col-md-2 col-lg-3">&nbsp;</div> 
        </div>  

    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/fb.js"></script>
@endsection