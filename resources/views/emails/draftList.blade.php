<div>
  <h2> Here is a list of your form drafts</h2>
  <ul>
    @foreach ($data['list'] as $list)
      <li> <a href="{{ $list['host'] }}?draft={{ $list['magiclink'] }}&form_id={{ $list['form_id'] }}"> {{ $list['host'] }}?draft={{ $list['magiclink'] }}&form_id={{ $list['form_id'] }}</a></li>
    @endforeach
  </ul>
</div>