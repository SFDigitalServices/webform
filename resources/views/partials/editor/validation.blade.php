<div class="hidden clonable accordion-validation">
    <div class='accordion-section validation'>
      <div class='accordion-header'>Validation</div>

      <div class='accordion' style='display:none'>
        <div class="validate-required" data-toggle="tooltip" title="Check this to indicate the user must fill out this field">
          <label class='control-label' for="required">Required</label>
          &nbsp;
          <input class='' type='checkbox' name='required' id='required'>
          <br/>
        </div>

        <div class="validate-type" data-toggle="tooltip" title="This is to make sure the user response fits the field type">
          <label class='control-label'>Type</label>
          <select class='form-control' name='type' id='type'>
            <option value='text'>Text</option>
            <option value='email'>Email</option>
            <option value='tel'>Phone</option>
            <option value='url'>URL</option><
            <option value='number'>Number</option>
            <option value='date'>Date</option>
            <option value='search'>Search</option>
            <option value='password'>Password</option>
            <option value='match'>Match</option>
            <option value='regex'>Custom</option>
          </select>
        </div>

        <div class='validate-regex' style='display:none' data-toggle="tooltip" title="For advanced users only">
          <label class='control-label'>Regular Expression</label>
          <input class='form-control' type='text' name='regex' id='regex'>
        </div>

        <div class='validate-minmax' style='display:none'>
          <div class='floatleft' data-toggle="tooltip" title="The lowest acceptable numerical value, leave blank if there is none">
            <label class='control-label'>Min Value</label>
            <input class='form-control' type='text' name='min' id='min'>
          </div>

          <div class='floatright' data-toggle="tooltip" title="The highest acceptable numerical value, leave blank if there is none">
            <label class='control-label'>Max Value</label>
            <input class='form-control' type='text' name='max' id='max'>
          </div>

          <div class='clear'></div>
        </div>

        <div class="validate-match" style="display:none" data-toggle="tooltip" title="Use this to only accept a user response if the value matches a different field that you specify">
          <label class='control-label' style='display:none'>Match Another</label>
          <select class='form-control' name='match' id='match'>
            <option value=''></option>
          </select>
        </div>

        <div class='floatleft' data-toggle="tooltip" title="The minimum amount of characters allowed, leave blank if there is none">
          <label class='control-label'>Min Length</label>
          <input class='form-control' type='text' name='minlength' id='minlength'>
        </div>

        <div class='floatright' data-toggle="tooltip" title="The maximum amount of charcaters allowed, leave blank if there is none">
          <label class='control-label'>Max Length</label>
          <input class='form-control' type='text' name='maxlength' id='maxlength'>
        </div>

        <div class='clear'></div>
      </div>
    </div>
  </div>
