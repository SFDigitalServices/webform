# Inmate Locator API

This API is for Kanopi(city vendor) to get realtime data from the Sheriff's Inmate information database.

### Usage
1. Obtain a `session_token` from [user api](https://api.sfgov.org/api/v2/user/session), JS ajax example:
```
  var settings = {
  "async": true,
  "crossDomain": true,
  "url": "https://api.sfgov.org/api/v2/user/session",
  "method": "POST",
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded",
    "User-Agent": "PostmanRuntime/7.19.0",
    "Accept": "*/*",
    "Cache-Control": "no-cache",
    "Postman-Token": "b6402ef5-43bc-4381-a430-c2eb7e4caef8,cc84ebfe-526b-4979-a995-6f0fa9d08939",
    "Host": "api.sfgov.org",
    "Accept-Encoding": "gzip, deflate",
    "Content-Length": "48",
    "Connection": "keep-alive",
    "cache-control": "no-cache"
  },
    "data": {
      "email": [],
      "password": []
    }
  }

  $.ajax(settings).done(function (response) {
    console.log(response);
  });
```

2. Get Inmate Info from the [InmateLocator api](https://api.sfgov.org/api/v2/InmateLocator). JS ajax example:
```
  var settings = {
  "async": true,
  "crossDomain": true,
  "url": "https://api.sfgov.org/api/v2/InmateLocator?inmatesfnumber=591881&fullname=&bookingnumber=",
  "method": "GET",
  "headers": {
    "X-DreamFactory-Api-Key": [provided to you by SF],
    "Content-Type": "application/json",
    "X-DreamFactory-Session-Token": [session_token from user api],
    "User-Agent": "PostmanRuntime/7.19.0",
    "Accept": "*/*",
    "Cache-Control": "no-cache",
    "Postman-Token": "2984539b-4500-4970-97fa-12a2f15b6d60,0c7b6cb3-62f3-432c-9be7-73ef67a143ca",
    "Host": "api.sfgov.org",
    "Accept-Encoding": "gzip, deflate",
    "Connection": "keep-alive",
    "cache-control": "no-cache"
  }
}

$.ajax(settings).done(function (response) {
  console.log(response);
});

```

Parameters:
```
  inmatesfnumber  -- input field SFNO
  bookingnumber   -- input field Booking Number
  fullname        -- input fields Last Name + " " + First Name
```
