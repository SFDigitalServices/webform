# Form field variations or versions
All form fields are statically bound. That means when a field needs an alternative storage and/or presentation, it's not possible. For example, the "Name" field is a textfield for a full name, it can't distinguish firstname, middlename, and lastname. We need form field variations to allow flexibility in form building.

## Considered Alternatives
* Create additional versions of the form field, treat each version as a new form field type.
* Optional consideration: Create alternative(s) under each form field.

## Decision Outcome
* Create additional versions for each form field.
* Flat JSON object, easier to deal with.
* Versions of the form field do not depend on each other.
* Designers can deal with hard-coded templates. Don't have to rely on Engineer.

## Tasks and things to consider
* Update the HTML helper class for variations.
* Update the JSON object, I think it should be as simple as adding an extra attribute, like "version" to the JSON.
* Make sure the new JSON data structure supports easy UI development.
* No changes to the database, that's a good thing.

## See sample JSON object
* [json-form-variations.md] (json-form-variations.md)