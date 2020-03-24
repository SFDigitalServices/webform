Thank you for your submission
---

We received your submission to "{{ $data['formname'] }}" on {{ $data['date'] }}

Please save this copy of your submission for your records.

---

                  @foreach ($data['submitted']['internal'] as $k => $v)
                    @foreach ($v as $key => $value)
                     # {{ $key }}
                     {!! $value !!}
                    @endforeach
                  @endforeach

---
Sent by the City and County of San Francisco