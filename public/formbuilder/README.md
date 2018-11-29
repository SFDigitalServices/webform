# Webform Builder
> A microservice application to generate complex form HTML.

## Why would I use this?
You're looking for a form generation tool that:
- Will let users save and load their own forms.
- Is easy to use for non-coders to quickly create multi-page forms.
- Drag and drop interface to help design your own complex form logic.
- Allows users to share and collaborate on their forms.
- Outputs basic, CSS friendly semantic code that is 100% styleable.
- Robust front-end validation of common and custom fields with Bootstrap Validator.
- Create forms that can be embedded by copying a small snippet of code.
- Flexible enough to also output raw HTML for rapid prototypes or those that don't want codependencies.
- Customizable form action makes Webform Builder backend agnostic and gives you the freedom to submit to the system of your choice.

### Coming Soon
- Automatically generate component code for backend validation.
- An easy way to load and render your code with a custom pattern library.
- Optional confirmation page.
- Export to PDF or printer friendly view.
- Calculation fields for robust data handling and invoicing.
- A Generic Salesforce connector.
- A Generic Accela connector.
- A Generic Onbase connector.
- A Generic Drupal connector.
- A custom CSV solution that allows users to create forms and analyze responses without a dedicated backend system.

![](screenshot.png)

## Installation

Install your favorite LAMP stack. Create a new database 'webform'.

```
CREATE DATABASE `webform`;
CREATE TABLE `users` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
CREATE TABLE `forms` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `content` mediumtext,
  PRIMARY KEY (`id`)
);
CREATE TABLE `user_form` (
  `user_id` smallint(5) unsigned DEFAULT NULL,
  `form_id` smallint(5) unsigned DEFAULT NULL
);

## Database Configuration

In order for Webform Builder to work, you have to tell it where the database is, what the database is called, and the database credentials to access the database. This information is stored in the db.inc file.
Locate the file db.inc and configure the definitions in the header. You will probably want to keep SERVERNAME as localhost and DBNAME as webform if you followed the instructions above. Be sure to change the username and password accordingly for read and write access to your webform database.

### User Authentication

Webform Builder is currently configured to work with San Francisco's Active Directory as a single sign-on solution. To use another authentication server, open editor.php and edit the variable for $ldaphost. Non-SSO solutions like user registration and management are not supported at the moment.

## Usage example

Make sure the files are put in your Apache webroot directory and then navigate to localhost http://localhost/webform-builder/login.html
Login with your official San Francisco email and password.

## Release History

* 0.0.2
    * Documentation and cleanup
* 0.0.1
    * Dump by Henry

## Meta

Jim Brodbeck – [San Francisco Digital Services](https://digitalservices.sfgov.org/)

Distributed under the MIT license. See ``LICENSE`` for more information.