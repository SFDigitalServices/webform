<div class="content" style="display:none">
  <div class="hidden-xs col-sm-1 col-md-2 col-lg-3">
    &nbsp;
  </div>

  <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">

    <h1 class="welcomeBack">Welcome back, <?php print $name; ?>!</h1>

    <form id="jekyll_import" class="form-horizontal" action="/form/jekyllImport" method="POST"
      enctype="multipart/form-data">
      <div class="form-group form-group-field field-m13" data-id="upload_file">
        <div class="field-wrapper">
          <input type="hidden" name="user_id" id="user_id" value="">
          <input type="hidden" name="api_token" id="api_token" value="">
          <input id="upload_file" name="upload_file" type="file">
          <input type="submit" value="Import from Jekyll" id="submit" data-formtype="m14" class="btn-primary">
        </div>
      </div>
    </form>
    <div class="welcomeBox">
      <div>
        <a href="javascript:void(0)" class="btn btn-info btn-lg">Create a New Form</a>
      </div>

      <div class="welcome-alt-text">or load an existing form</div>

      <div class="forms">
        <i class="fas fa-circle-notch fa-spin"></i>
      </div> {{-- /.forms --}}
    </div> {{-- /.welcomeBox --}}
  </div> {{-- /.col-xs-12 --}}

  <div class="hidden-xs col-sm-1 col-md-2 col-lg-3">
    &nbsp;
  </div>
</div>