<div class="form-group component"
  rel="popover"
  title="{{$title}}"
  trigger="manual"
  data-formtype="{{$formtype}}"
  @isset ($required)
    data-required="true"
  @endisset
  @isset ($type)
    data-type="{{$type}}"
  @endisset
  @isset ($name)
    data-name="{{$name}}"
  @endisset
  @isset ($minlength)
    data-minlength="{{$minlength}}"
  @endisset 
  @isset ($maxlength)
    data-maxlength="{{$maxlength}}"
  @endisset
  @isset ($choose)
    data-choose="true"
  @endisset
  data-content="
    <form class='form'>
      <div class='form-group col-md-12'>
        @include('partials.editor.general')
        <hr/>
        <button class='btn btn-info'>OK</button>
        <button class='btn btn-danger'>Cancel</button>
      </div>
    </form>
  "
  data-html="true">
  @include($partial)
</div>
