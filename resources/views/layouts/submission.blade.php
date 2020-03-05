<!DOCTYPE html>
<html lang="en">
<head>
<title> "[[ formTitle ]]" submission</title>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<style type="text/css">
@font-face {
  font-family: 'Rubik';
  font-style: normal;
  font-weight: 400;
  src: local('Rubik'), local('Rubik-Regular'), url(https://fonts.gstatic.com/s/rubik/v9/iJWKBXyIfDnIV7nBrXyw023e.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
  mso-generic-font-family: swiss;
}

@font-face {
  font-family: 'Rubik';
  font-style: normal;
  font-weight: 500;
  src: local('Rubik Medium'), local('Rubik-Medium'), url(https://fonts.gstatic.com/s/rubik/v9/iJWHBXyIfDnIV7Eyjmmd8WD07oB-.woff2) format('woff2');
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
  mso-generic-font-family: swiss;
}

body, table, td, a{
  -webkit-text-size-adjust: 100%;
  -ms-text-size-adjust: 100%;
} /* Prevent WebKit and Windows mobile changing default text sizes */

table, td {
  mso-table-lspace: 0pt;
  mso-table-rspace: 0pt;
} /* Remove spacing between tables in Outlook 2007 and up */

img {
  -ms-interpolation-mode: bicubic;
} /* Allow smoother rendering of resized image in Internet Explorer */

/* RESET STYLES */
img {
  border: 0;
  height: auto;
  line-height: 100%;
  outline: none;
  text-decoration: none;
}

table{
  border-collapse: collapse !important;
}

body{
  height: 100% !important;
  margin: 0 !important;
  padding: 0 !important;
  width: 100% !important;
  font-family: "Rubik", sans-serif !important;
}

/* iOS BLUE LINKS */
a[x-apple-data-detectors] {
    color: inherit !important;
    text-decoration: none !important;
    font-size: inherit !important;
    font-family: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
}

/* MOBILE STYLES */
@media screen and (max-width: 525px) {

  /* ALLOWS FOR FLUID TABLES */
  .wrapper {
    width: 100% !important;
    max-width: 100% !important;
  }

  /* ADJUSTS LAYOUT OF LOGO IMAGE */
  .logo img {
    margin: 0 !important;
  }

  /* FULL-WIDTH TABLES */
  .responsive-table {
    width: 100% !important;
  }

  /* UTILITY CLASSES FOR ADJUSTING PADDING ON MOBILE */
  .padding {
    padding: 12px 5% 12px 5% !important;
  }

  /* ADJUST BUTTONS ON MOBILE */
  .mobile-button-container {
    margin: 0;
    width: 100% !important;
  }

  .mobile-button {
    padding: 15px 12px !important;
    border: 0 !important;
    font-size: 17px !important;
    display: block !important;
  }
}

/* ANDROID CENTER FIX */
div[style*="margin: 16px 0;"] {
  margin: 0 !important;
}
</style>
</head>
<body style="margin: 0 !important; padding: 0 !important;">
<div>
<h2>Please set a Confirmation Page before trying to embed your form.</h2>
<h3>Below is a summary of what you just submitted:</h3>
  <ul>
    @foreach ($data as $k => $v)
      @foreach ($v as $key => $value)
        <li> <label> {{ $key }}: <span> {{ $value }}</span></label>  </li>
      @endforeach
    @endforeach
  </ul>
</div>
</body>
</html>