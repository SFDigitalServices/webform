<li class="
  @isset($class)
    {{$class}}
  @endisset
">
  <a href="#SFDSWFB-{{$href}}" data-toggle="tab"
    @isset($id)
      id="{{$id}}"
    @endisset>
    {{$title}}
  </a>
</li>