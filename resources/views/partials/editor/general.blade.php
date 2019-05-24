<div class='accordion-section general'>
  <div class='accordion-header'>General</div>
  <div class='accordion'>
    <label class='control-label'>Label Text</label>
    <input class='form-control' type='text' name='label' id='label'>

    @isset($options)
      <label class='control-label'>Options: </label>

      <textarea class='form-control' style='min-height: 200px' id='$options'> </textarea>
    @endisset

    @isset($placeholder)
      <label class='control-label'>Placeholder</label>
      <input type='text' name='placeholder' id='placeholder' class='form-control'>
    @endisset

    <label class='control-label'>Help Text</label>
    <input type='text' name='help' id='help' class='form-control'>

    @isset($required)
      <label class='control-label' for='required'>Required</label>
      &nbsp;
      <input class='' type='checkbox' name='required' id='required'>   
    @endisset             
  </div>
</div>