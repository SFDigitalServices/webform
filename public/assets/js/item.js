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
let Item = function(obj, idsArray, namesArray) {
	const {
		id,
		name,
		formtype,
		label,
		placeholder,
		help,
    unit,
		value,
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

	this.class = obj.class
  if (this.codearea) this.codearea = this.htmlDecode(this.htmlDecode(this.codearea))

	//for new items
	if (obj.formtype !== undefined && obj.id === undefined && obj.name === undefined && idsArray !== undefined && namesArray !== undefined) {
		this.label = this.formTypeNameMapping(this.formtype)
		this.id = this.createUnique(this.label, idsArray)
		this.name = this.createUnique(this.label, namesArray)
		this.type = this.formTypeTypeMapping(this.formtype)
	}

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
			this.removeAttrs(['unit'])
			break
		case 'd06': //numbers
			this.removeSpecialValues()
			break
		case 'd08': //price
			this.removeAttrs(['unit'])
			this.removeSpecialValues()
			break
		case 'i14': //textarea
			this.removeSpecialValues('textarea')
			this.removeSpecialFunctions(['calculations'])
			this.removeAttrs(['type','value','unit'])
			break
		case 's02': //select
		case 's14': //state
		case 's15': //state
		case 's16': //state
			this.removeSpecialValues('option')
      this.addOptions('option')
			this.removeAttrs(['placeholder','type','unit'])
			break
		case 's06': //checkboxes
			this.removeSpecialValues('checkboxes')
      this.addOptions('checkboxes')
			this.removeAttrs(['placeholder','type','unit'])
			break
		case 's08': //radios
			this.removeSpecialValues('radios')
      this.addOptions('radios')
			this.removeAttrs(['placeholder','type','unit'])
			break
		case 'm11': //hidden
			this.removeSpecialValues()
			this.removeSpecialFunctions(['validation'])
			this.removeAttrs(['label','help','placeholder','unit'])
			this.type = 'hidden'
			break
		case 'm08': //paragraph
			this.removeSpecialValues('textarea')
			this.removeSpecialFunctions(['validation', 'calculations'])
      this.swapLabel()
			this.removeAttrs(['name','label','help','placeholder','type','value','unit'])
			break
		case 'm10': //html
			this.removeSpecialValues('codearea')
			this.removeSpecialFunctions(['validation', 'calculations'])
      this.swapLabel()
			this.removeAttrs(['name','label','help','placeholder','type','value','unit'])
			break
		case 'm02': //h1
		case 'm04': //h2
		case 'm06': //h3
			this.removeSpecialValues('textarea')
			this.removeSpecialFunctions(['validation', 'calculations'])
      this.swapLabel()
			this.removeAttrs(['name','label','help','placeholder','type','value','unit'])
			break
		case 'm16': //page separator
			this.removeSpecialValues()
			this.removeSpecialFunctions(['validation', 'conditionals', 'calculations', 'webhooks'])
			this.removeAttrs(['name','help','placeholder','type','value','unit'])
			break
		//case 'm14': //button
	}
}

/**
 * Gets the proper label of an item based on its formtype
 *
 * @param {String} formtype
 *
 * @returns {String}
 */
Item.prototype.formTypeNameMapping = function(formtype) {
	var obj = {
		'i02': 'Text',
		'c02': 'Name',
		'c08': 'Address',
		'c10': 'City',
		'c14': 'Zip',
		'c04': 'Email',
		'c06': 'Phone',
		'd02': 'Date',
		'd04': 'Time',
		'd10': 'URL',
		'm13': 'Upload File',
		'd06': 'Number',
		'd08': 'Price',
		'i14': 'Textarea',
		's02': 'Select',
		's14': 'State',
		's15': 'State',
		's16': 'State',
		's06': 'Checkboxes',
		's08': 'Radio',
		'm11': 'Hidden',
		'm08': 'Paragraph',
		'm10': 'HTML Code',
		'm02': 'Header 1',
		'm04': 'Header 2',
		'm06': 'Header 3',
		'm16': 'Page_Separator'
	}
	return obj[formtype]
}

/**
 * Gets the proper type attribute of an item based on its formtype
 *
 * @param {String} formtype
 *
 * @returns {String}
 */
Item.prototype.formTypeTypeMapping = function(formtype) {
	var obj = {
		'i02': 'text',
		'c02': 'text',
		'c08': 'text',
		'c10': 'text',
		'c14': 'text',
		'c04': 'email',
		'c06': 'tel',
		'd02': 'date',
		'd04': 'time',
		'd10': 'url',
		'm13': 'file',
		'd06': 'number',
		'd08': 'number',
		'i14': null,
		's02': null,
		's14': null,
		's15': null,
		's16': null,
		's06': 'checkbox',
		's08': 'radio',
		'm11': 'hidden',
		'm08': null,
		'm10': null,
		'm02': null,
		'm04': null,
		'm06': null,
		'm11': null,
		'm16': null
	}
	return obj[formtype]
}

/**
 * Decodes encoded html
 *
 * @param {String} input
 *
 * @returns {String}
 */
Item.prototype.htmlDecode = function(input){
  var e = document.createElement('textarea');
  e.innerHTML = input;
  return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
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
				this.required = null
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
 * Swap label for textarea value
 */
Item.prototype.swapLabel = function() {
  var labelTarget = this.formtype == "m10" ? "codearea" : "textarea"
  if (typeof this.label !== "undefined" && typeof this[labelTarget] === "undefined") {
    this[labelTarget] = this.label
  }
}

/**
 * Add options if they're empty
 */
Item.prototype.addOptions = function(index) {
  if (typeof this[index] === "undefined" || typeof this[index] === "null") {
    this[index] = "Choice 1\nChoice 2\nChoice 3"
  } else {
    if (typeof this[index] == "object") {
      this[index] = this[index].join("\n")
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

/**
 * Generates a unique id or name based on the label string
 *
 * @param {String} label
 * @param {String} type (id or name)
 *
 * @returns {String}
 */
Item.prototype.createUnique = function(label, arr) {
	var count = 1;
	var newName = label.toLowerCase();
	newName = newName.replace(/ /g,"_");
	countName = newName;
  while (arr.includes(countName)) {
		countName = newName+"_"+count;
		count++;
  }
	return countName;
}
