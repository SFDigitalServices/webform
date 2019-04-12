# Translations
The Form Builder must be able to present itself in different languages. There must be a way to serve custom human translated content but it would be prudent to also include pre-translated content for common fields like name, phone number, address, etc. Lastly, there should be a fallback to use an API-based machine translated service.

## Considered Alternatives
* Talked with Henry about different data structures to store translation including scenarios for additional tables and columns.
* Spoke with Nicole and Anthony about SF.gov translation services and various online translation services.

## Decision Outcome
* Chosen Structure for human translated portions: would be stored as a JSON blob inside a new translations table. Each row would have a form_id and each column would represent a different language.
* Chosen Structure for pre-translated content: would be file-based and retrieved if the human translation for that field is null.
* Chosen Structure for machine translated content: would be an API-based fallback retrieved as an array of strings for every field that is neither human nor pre-translated. These could be cached in the DB.

## Tasks and things to consider
* We will need to identify every visible label and map those out within the JSON and make them replaceable
* There will be up to two new tables: human translated and cached machine translated.
* The order to fetch will be human translated -> pre-translated -> machine translated (cached) -> machine translated (API)
* Google translate looks feasible initially but other translation API services may fit better.