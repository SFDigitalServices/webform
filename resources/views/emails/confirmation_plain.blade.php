<?php
  $firstname = '';
  $lastname = '';
?>
@foreach ($data['submitted'] as $k => $v)
  @foreach ($v as $key => $value)
      @if( $key == 'First name')
        <?php $firstname = $value; ?>
      @elseif( $key == 'Last name')
        <?php $lastname = $value; ?>
      @endif
    @endforeach
@endforeach

---

@if( $data['source'] == 'internal')
                        The applicant below submitted "Submit plans or addenda for existing projects" on {{ $data['date'] }} {{ $data['time'] }}

                        Please use the applicant data below & download the submitted plans via the link.

                      @else
                        Dear {!! $firstname !!} {!! $lastname !!}

                        Thanks for submitting your files for:

                      @endif

---
@if( $data['source'] == 'internal')
                  @foreach ($data['submitted'] as $k => $v)
                    @foreach ($v as $key => $value)
                     # {{ $key }}
                     {!! $value !!}
                    @endforeach
                  @endforeach
@else
@foreach ($data['submitted'] as $k => $v)
                          @foreach ($v as $key => $value)
                            @if( $key == 'Upload File' || $key == 'Street address of project' || $key == 'Permit application number')
                            # {!! $key !!}
                              {!! $value !!}
                            @endif
                          @endforeach
                        @endforeach
@endif
---
Sent by the City and County of San Francisco