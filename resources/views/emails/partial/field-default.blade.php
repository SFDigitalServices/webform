{{-- All fields except:
     Attachment (field-attachment.blade)
     Email (field-email.blade)
     Links / URLs (field-link.blade)
     Checkboxes, radio buttons, dropdowns (field-multi.blade) -- }}

  <tr>
    <td align="left" bgcolor="#FFFFFF" width="100%" style="font-size: 14px; line-height: 18px; font-family: 'Rubik', sans-serif; font-weight: 400;  color: #1C3E57; padding-top: 34px;">{{ $label }}</td>
  </tr>
  <tr>
    <td align="left" bgcolor="#FFFFFF" width="100%" style="font-size: 17px; line-height: 24px; font-family: 'Rubik', sans-serif; font-weight: 400;  color: #1C3E57; padding-top: 6px;">{{ $answer }}</td>
  </tr>