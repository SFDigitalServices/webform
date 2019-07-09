  <div class='accordion-section general'>
    <div class='accordion-header'>General</div>
    <div class='accordion'>
      @if (@isset($text))
        <label class='control-label'>{{$text}} Text</label>
        <textarea class='form-control' name='textarea' id='textarea'></textarea>

        {{-- Show button type dropdown for Button input --}}
        @if ($formtype == 'm14')
          <label class='control-label' id=''>Type: </label>
          <select class='form-control input-md' id='color'>
            <option value='btn-default'>Default</option>
            <option value='btn-primary'>Primary</option>
            <option value='btn-info'>Info</option>
            <option value='btn-success'>Success</option>
            <option value='btn-warning'>Warning</option>
            <option value='btn-danger'>Danger</option>
            <option value='btn-inverse'>Inverse</option>
          </select>
        @endif

      @else
        <label class='control-label'>Label Text</label>
        <input class='form-control' type='text' name='label' id='label'>

        @isset($options)
          <label class='control-label'>Options: </label>
          <textarea class='form-control' style='min-height: 200px' id='{{$options}}'></textarea>
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
      @endif
  </div>
</div>