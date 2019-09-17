 /*
Item
-Field
--Text i02
---Name c02
---Address c08,
---City c10
---Zip c14
---Custom i02
---Match i02
--Email c04
--Phone (tel) c06
--URL d10
--Number d06
---Price d08
--Date d02
--Time d04
--Dropdown s02
---State s14
--Checkboxes s06
--Textarea i14
--Radios s08
--File m13
--Hidden m11 (no classes, validation)

--Search
--Password
--Color
--DateTime
--DateTime-Local
--Month
--Range
--Week

-Tag (no name, validation, calculations)
--H1 m02
--H2 m04
--H3 m06
--Paragraph m08
--Code m10
--Page Separator m16
--Button (not editable)
*/

/**
 * Represent an Item
 *
 * @param {Object} obj
 * contains:
 *
 * {String} id
 * {String} name
 * {String} formtype
 * {String} label
 * {String} placeholder
 * {String} help
 * {String} value
 * {String} class
 * {String} type
 * {Boolean} required
 * {String} match?
 * {String} regex?

 * special attributes
 * {String} option
 * {String} checkboxes
 * {String} radios
 * {String} textarea
 * {String} codearea

 * special functions
 * {Array} calculations
 * {Object} conditions
 * {Array?} webhooks

 * @constructor
 */
let Item = function(obj) {
	const {
		id,
		name,
		formtype,
		label,
		placeholder,
		help,
		value,
		classes,
		type,
		required,
		option,
		checkboxes,
		radios,
		textarea,
		codearea,
		calculations,
		conditions,
		webhooks
	} = obj
	
    Object.assign(this, obj)
	
	this.classes = obj.class
	
	switch (this.formtype) {
		case 'i02': //text
		case 'c02': //name
		case 'c08': //address
		case 'c10': //city
		case 'c14': //zip
		case 'c04': //email
		case 'c06': //phone
		case 'd02': //date
		case 'd04': //time
		case 'd10': //url
		case 'm13': //file
			this.removeSpecialValues()
			this.removeSpecialFunctions(['calculations'])
			break
		case 'd06': //numbers
		case 'd08': //price
			this.removeSpecialValues()
			break
		case 'i14': //textarea
			this.removeSpecialValues('textarea')
			this.removeSpecialFunctions(['calculations'])
			this.removeAttrs(['type'])
			break
		case 's02': //select
		case 's14': //state
			this.removeSpecialValues('option')
			this.removeAttrs(['placeholder','type'])
			break
		case 's06': //checkboxes
			this.removeSpecialValues('checkboxes')
			this.removeAttrs(['placeholder','type'])
			break
		case 's08': //radio
			this.removeSpecialValues('radio')
			this.removeAttrs(['placeholder','type'])
			break
		case 'm11': //hidden
			this.removeSpecialValues()
			this.removeSpecialFunctions(['validation'])
			this.removeAttrs(['label','help','placeholder'])
			this.type = 'hidden'
			break						
		case 'm08': //paragraph
			this.removeSpecialValues('textarea')
			this.removeSpecialFunctions(['validation', 'calculations'])
			this.removeAttrs(['name','label','help','placeholder','type','value'])
			break
		case 'm10': //html
			this.removeSpecialValues('codearea')
			this.removeSpecialFunctions(['validation', 'calculations'])
			this.removeAttrs(['name','label','help','placeholder','type','value'])
			break
		case 'm02': //h1
		case 'm04': //h2
		case 'm06': //h3
			this.removeSpecialValues('textarea')
			this.removeSpecialFunctions(['validation', 'calculations'])
			this.removeAttrs(['name','label','help','placeholder','type','value'])
			break
		case 'm16': //page separator
			this.removeSpecialValues()
			this.removeSpecialFunctions(['validation', 'conditionals', 'calculations', 'webhooks'])
			this.removeAttrs(['name','help','placeholder','type','value'])
			break
		//case 'm14': //button
	}
}

/**
 * Removes special attributes from Item object
 *
 * @param {String} exception
 */
Item.prototype.removeSpecialValues = function(exception) {
	if (exception !== "option") this.option = null
	if (exception !== "checkboxes") this.checkboxes = null
	if (exception !== "radios") this.radios = null
	if (exception !== "textarea") this.textarea = null
	if (exception !== "codearea") this.codearea = null
}

/**
 * Removes special functions from Item object
 *
 * @param {Array} arr
 */
Item.prototype.removeSpecialFunctions = function(arr) {
	for (i in arr) {
		switch (arr[i]) {
			case 'validation':
				this.validation = null
				this.required = false
				break
			case 'conditionals':
				this.conditionals = null
				break
			case 'calculations':
				this.calculations = null
				break
			case 'webhooks':
				this.webhooks = null
				break
		}
	}
}	

/**
 * Removes regular attributes due to item type
 *
 * @param {Array} arr
 */
Item.prototype.removeAttrs = function(arr) {
	for (i in arr) {
		this[arr[i]] = null
	}
}	
