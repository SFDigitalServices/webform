
@component('emails.partial.header')
  We received your submission to "[[ formTitle ]]"
@endcomponent

@component('emails.partial.preview_text')
  We've attached a copy of your submission for your records.
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
          We received your submission to "{{ $data['formname'] }}."
        @endcomponent
        <tr>
          <td align="left" style="font-size: 17px; line-height: 24px; font-family: 'Rubik', sans-serif; font-weight: 400;  color: #1C3E57; padding-top: 17px;">For your records, you can find a copy of your submission below.</td>
        </tr>
      </table>
      <!--[if (gte mso 9)|(IE)]>
      </td>
      </tr>
      </table>
      <![endif]-->
    </td>
  </tr>

    <tr>
    <td align="center" class="padding" style="padding: 0px 17px 17px 17px;">
      <!--[if (gte mso 9)|(IE)]>
      <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
      <tr>
      <td align="center" valign="top" width="500">
      <![endif]-->
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" bgcolor="#9FAEB8" height="3" width="100%" style="mso-line-height-rule: exactly; height: 3px; line-height: 3px; font-size: 3px;">&nbsp;</td>
              </tr>

            </table>
          </td>
        </tr>
      </table>
      <!--[if (gte mso 9)|(IE)]>
      </td>
      </tr>
      </table>
      <![endif]-->
    </td>
    </tr>

  @include('emails.partial.footer')