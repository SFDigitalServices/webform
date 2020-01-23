
@component('emails.partial.header')
  Resume your draft of "[[ formTitle ]]"
@endcomponent

@component('emails.partial.preview_text')
  To continue your draft of "{{ $data['formname'] }}", click the link in this email.
@endcomponent


<table border="0" cellpadding="0" cellspacing="0" width="100%">

  @include('emails.partial.logo')

  <!-- HEADER AND BODY -->
  <tr>
    <td align="center" class="padding" style="padding: 17px 17px 17px 17px;">
      <!--[if (gte mso 9)|(IE)]>
      <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
      <tr>
      <td align="center" valign="top" width="500">
      <![endif]-->
      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
        @component('emails.partial.title')
          {{ $data['formname'] }}
        @endcomponent
        <tr>
          <td align="left" style="font-size: 17px; line-height: 24px; font-family: 'Rubik', sans-serif; font-weight: 400;  color: #1C3E57; padding-top: 17px;">{{ $data['message'] }}</td>
        </tr>
      </table>
      <!--[if (gte mso 9)|(IE)]>
      </td>
      </tr>
      </table>
      <![endif]-->
    </td>
  </tr>

  @component('emails.partial.button', ['link' => {{ $data['host'] }}])
    Resume your draft
  @endcomponent

  @include('emails.partial.footer')