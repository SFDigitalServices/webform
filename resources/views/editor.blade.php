@extends('layouts.app')
@section('content')
<script src="js/jquery.min.js"></script>

<link href="js/bootstrap.min.css" rel="stylesheet">
<link href="js/bootstrap-responsive.min.css" rel="stylesheet">

<script>
  $(document).ready(function(){
      $(".content").show(1500);

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
			<div style="background:#fff;width:232px;float:left;position:absolute;top:0px;box-shadow:0 0 10px #888"/><img src="SF_Digital_Services-logo.png"/></div>
			SAN FRANCISCO <b>DIGITAL SERVICES</b> WEBFORM BUILDER
		</div>
	</div>

	<div class="content" style="display:none">
             <div class="hidden-xs col-sm-1 col-md-2 col-lg-3">&nbsp;</div>
	     <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
               <h1 style="margin-top:15vh">Welcome back <?php print $fname; ?>,</h1>
               <div style="text-align:center;padding:4em;margin:2em;border:1px solid #ddd;border-radius:5px">
                 <div>
                     <a href="create.php" class="btn btn-info btn-lg btn-block">Create a New Form</a>
                 </div>
                 <?php if (!empty($forms)) { ?>
                     <div class="text-muted" style="padding:2em 0">or load an existing form</div>
	             <div>
	                 <?php foreach ($forms as $form) { ?>
		             <a href="create.php?id=<?php print $form['id'];?>" class="recent btn btn-default btn-md btn-block"><?php print $form['content']['settings']['name'];?></a>
		         <?php } ?>
	             </div>
		 <?php } ?>
               </div>
             </div>
	     <div class="hidden-xs col-sm-1 col-md-2 col-lg-3">&nbsp;</div> 
        </div>  

 <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/fb.js"></script>
@endsection