{{-- Checkboxes, radio buttons, dropdowns --}}

<tr>
  <td align="left" bgcolor="#FFFFFF" width="100%" style="font-size: 14px; line-height: 18px; font-family: 'Rubik', sans-serif; font-weight: 400;  color: #1C3E57; padding-top: 34px;">{{ $label }}</td>
</tr>
<tr>
  <td align="left" bgcolor="#FFFFFF" width="100%">
  	<table role="presentation">

      {{-- Repeat this <tr> for every checked option --}}
      <tr>
        <td align="left" valign="top" style="padding-top: 9px;">
          <img src="{{ $formbuilderURL }}/assets/images/email-checkbox.jpg" alt="" />
        </td>
        <td align="left" valign="top" style="font-size: 17px; line-height: 24px; font-family: 'Rubik', sans-serif; font-weight: 400;  color: #1C3E57; padding: 6px 0px 6px 15px;">{{ $option_1 }}.</td>
      </tr>
      {{-- End <tr> --}}

    </table>
  </td>
</tr>