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
  @isset ($defaultvalue)
    data-defaultvalue="true"
  @endisset
  @isset ($text)
    data-textonly="true"
  @endisset
  @isset ($choose)
    data-choose="true"
  @endisset
  data-content="
    <form class='form'>
      <div class='form-group col-md-12'>

        {{-- Don't show General section for hidden fields --}}
        @if ($formtype !== "m11")
          @include('partials.editor.general')
        @endif

        {{-- Don't show Attributes section for page separators --}}
        @if ($formtype !== "m16")
          @include('partials.editor.attributes')
        @endif

        <hr/>
        <button class='btn btn-info'>OK</button>
        <button class='btn btn-danger'>Cancel</button>
      </div>
    </form>
  "
  data-html="true">
  @include($partial)
</div>