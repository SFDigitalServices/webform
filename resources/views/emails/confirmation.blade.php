@component('emails.partial.header')
@endcomponent

@component('emails.partial.preview_text')
We've attached a copy of your submission for your records.
@endcomponent

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
        <tr>
          <td align="center" class="padding" style="padding: 0px 17px 17px 17px;">
            <!--[if (gte mso 9)|(IE)]>
      <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
      <tr>
      <td align="center" valign="top" width="500">
      <![endif]-->
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 500px;"
              class="responsive-table">
              <tr>
                <td>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left" bgcolor="#9FAEB8" height="3" width="100%"
                        style="mso-line-height-rule: exactly; height: 3px; line-height: 3px; font-size: 3px;">&nbsp;
                      </td>
                    </tr>

                    <tr>
                      <div>
                      Dear {!! $firstname !!} {!! $lastname !!} <br><br>
                      Thanks for submitting your files for:<br><br>
                      </div>
                      <div>
                        @foreach ($data['submitted'] as $k => $v)
                          @foreach ($v as $key => $value)
                            @if( $key == 'Upload File' || $key == 'Street address of project' || $key == 'Permit application number')
                            <label><b style="font-weight: 500;"> {!! $key !!}: </b><span
                                class="form-field">
                                {!! $value !!}
                              </span></label><br>
                            @endif
                          @endforeach
                        @endforeach
                      </div> <br><br>
                    </tr>
                    <tr>
                    <div>
                      Once we review your submission, we will email or call you about next steps.
                    </div><br>
                  </tr>
                  <tr><td>&nbsp; </td></tr>
                  <tr>
                    <div>
                      Thank you,<br>
                      Permit Center & Department of Building Inspection<br>
                      City & County of San Francisco
                    </div><br>
                  </tr>
                  <tr><td>&nbsp;</td></tr>
                  @if( $data['source'] != 'internal')
                    <tr>
                      <div>
                        P. S. This is a new service we are offering to keep San Francisco building during the Stay Home order. We
                        need
                        your help to make it as good as possible. <a
                          href="https://docs.google.com/forms/d/e/1FAIpQLSdemiytUI9yJL3qJCkLpW-DOoYF7LK9q8h1eQOCvg8xsicqFg/viewform">
                          Tell us what you think about this experience.</a>
                      </div> <br>
                    </tr>
                  @endif
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
      </table>
      <!--[if (gte mso 9)|(IE)]>
      </td>
      </tr>
      </table>
      <![endif]-->
    </td>
  </tr>
  <tr>
    @include('emails.partial.footer')