
@include('emails.partial.header')

<!-- HIDDEN PREHEADER TEXT -->
<div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Rubik', sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">To continue your draft of "{{ $data['formname'] }}", click the link in this email. @include('emails.partial.preview')
</div>

<table border="0" cellpadding="0" cellspacing="0" width="100%">

  <!-- HEADER -->
  <tr>
    <td align="center" class="padding" style="padding: 17px 17px 0 17px;">
      <!--[if (gte mso 9)|(IE)]>
      <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
      <tr>
      <td align="center" valign="top" width="500">
      <![endif]-->
      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
        <tr>
          <td valign="top">
            <img alt="City and County of San Francisco" src="https://sf.gov/themes/custom/sfgovpl/src/img/sf-seal-3x.png" width="84" height="84" style="display: block; font-family: 'Rubik', sans-serif; font-weight: 400; color: #1c3e57; font-size: 17px;" border="0">
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

  <!-- HEADER AND BODY -->
  <tr>
    <td align="center" class="padding" style="padding: 17px 17px 17px 17px;">
      <!--[if (gte mso 9)|(IE)]>
      <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
      <tr>
      <td align="center" valign="top" width="500">
      <![endif]-->
      <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
        <tr>
          <td align="left" style="font-size: 30px; line-height: 42px; font-family: 'Rubik', sans-serif; font-weight: 500; color: #1C3E57;">{{ $data['formname'] }}</td>
        </tr>
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

  <!-- BULLETPROOF BUTTON -->
  <tr>
    <td align="center" class="padding" style="padding: 0px 17px 17px 17px;">
      <!--[if (gte mso 9)|(IE)]>
      <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
      <tr>
      <td align="center" valign="top" width="500">
      <![endif]-->
      <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;" class="responsive-table">
        <tr>
          <td align="left">
            <table border="0" cellspacing="0" cellpadding="0" class="mobile-button-container" role="presentation">
              <tr>
                <td align="center" style="border-radius: 8px;" bgcolor="#4F66EE">
                  <a href="{{ $data['host'] }}" target="_blank" style="font-size: 17px; font-family: 'Rubik', sans-serif; font-weight: 500; text-decoration: none; color: #ffffff; border-radius: 8px; padding: 17px 25px; border: 1px solid #4F66EE; display: inline-block; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; background-color: #4F66EE;" class="mobile-button">Resume your draft</a>
                </td>
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