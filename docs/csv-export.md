# CSV export for the MVP

This is only for the ADU permit application MVP. The idea is to run a command line to genereate a CSV file and email it out to departments.

## Setup
Assuming you already have the webform project checked out, pull in the latest from master
```
        git pull
```

## Usage
The following command can be run at your local, or on Heroku(the Scheduler add-on must be installed).
```
        php artisan email:exports [form id] [email] --fields=id --fields=name --fields=email
```

| Parameter     | description   |
| ------------- |:-------------:|
| [form id]     | Form ID |
| [email]       | Email address to email to|
| --fields      | Fields from the database|