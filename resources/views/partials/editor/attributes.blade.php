<div class='accordion-section attributes'>
  <div class='accordion-header'>Attributes</div>

  {{-- Show Attributes section by default
       for hidden inputs --}}
  <div class='accordion'
    @if($formtype !== "m11")
      style='display:none'
    @endif
  >
    @isset ($defaultvalue)
      <label class='control-label'>Default Value</label>
      <input data-toggle='tooltip' title='Use this to prefill this field with a value, otherwise this should be left blank' class='form-control' type='text' name='value' id='value'>
    @endisset

    @empty ($text)
      <label class='control-label'>Name Attribute</label>
      <input data-toggle='tooltip' title='You must set a unique machine name for this field' class='form-control' type='text' name='name' id='name'>
    @endempty

    <label class='control-label'>Unique ID</label>
    <input data-toggle='tooltip' title='Use this to set the unique id of this field, it is good practice to use the same value as the name' class='form-control' type='text' name='id' id='id'>

    <label class='control-label'>Class Attribute</label>
    <input data-toggle='tooltip' title='Use this to set the css identifier, it is not required unless needed for styling' class='form-control' type='text' name='class' id='class'>
  </div>
</div>