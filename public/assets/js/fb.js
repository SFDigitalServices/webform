// globals

//var emptyForm
var formId = 0
var csvFile = ''
var allForms // load all the forms into global?
//var isSaving = false


/*******************
app.js
*******************/

function callAPI (url, dataObj, callback) {
  var settings = {
    'async': true,
    'crossDomain': true,
    'url': url,
    'method': 'POST',
    'headers': {
      'authorization': 'Bearer ' + api_token,
      'content-type': 'application/x-www-form-urlencoded',
      'cache-control': 'no-cache'
    },
    'data': {
      'user_id': user_id,
      'api_token': api_token
    }
  }
  for (i in dataObj) {
    settings.data[i] = dataObj[i]
  }
  $.ajax(settings).done(function (response) {
    callback(response)
  })
}

function addBrowserState(id, url) {
	if (history.state == undefined) history.pushState({ formId: id }, null, url)
}


/*******************
item.js
single item logic
*******************/

/**
 * Represent an Item
 *
 * @param {String} id
 * @param {String} name
 * @param {String} formtype


 
 * @param {String} label
 * @param {String} placeholder
 * @param {String} help
 * @param {String} value
 * @param {String} class
 * @param {String} type
 * @param {String} required

 
 
 * @param {String} option
 * @param {String} checkboxes
 * @param {String} radios
 * @param {String} textarea
 * @param {String} codearea
 
 
 
 * @param {Array} calculations
 * @param {Object} conditions
 * @param {Array?} webhooks

 * @constructor
 */

 /*
let Item = function(id, name, formtype, label) {
    this.id = id;
    this.name = name;
    this.formtype = formtype;
	this.label = label || '';
}

Item
-Field
--Text
---Custom
---Match
--Email
--Phone (tel)
--URL
--Number
--Date
--Time
--File
--Hidden
--Button (not user )

--Search
--Password
--Color
--DateTime
--DateTime-Local
--Month
--Range
--Week


-Tag


let Checkboxes = (id, name, formtype, checkboxes) {
    this.id = id;
    this.name = name;
    this.formtype = formtype;
	this.checkboxes = checkboxes
}
var F = function(){};
F.prototype = Item.prototype;
Checkboxes.prototype = new F();

*/


/**
 * Get a item's data
 *
 * @returns {{id: Item.id, name: Item.name, formtype: Item.formtype}}
 */

 /*
Item.prototype.get = function () {
    const { id, name, formtype } = this;
    return { id, name, formtype };
};


*/






function getItemData(num) {
	var saved = getFormJSON()
	return saved.data[num]
}

function processSpecialProperties(data) {
	//todo data['conditionals']
	data.splice('conditionals', 1)
	//todo data['calculations']
	data.splice('calculations', 1)
	//todo data['webhooks']
	data.splice('webhooks', 1)
	return data
}

function saveAttributes() {
	
}




/*******************
items-view.js
html rendering, DOM
*******************/


/**
 * Hold the item presentation logic
 *
 * Here we add, remove and list Items
 *
 * @param {ItemsCollection} itemsCollection - where we manage our items
 * @param {Item} Item - reference to Item constructor function,
 * in order to create a new item on corresponding DOM event.
 * @constructor
 */

let ItemsView = function(itemsCollection, Item) {
    this.itemsCollection = itemsCollection;
    this.Item = Item;
};

function editItem(obj) {
	loadPreview(obj.data('id'))
	showMiddlePanel(obj.hasClass('spacer') ? 'SFDSWFB-insert' : 'SFDSWFB-attributes')
	$('#SFDSWFB-list .item').removeClass('selected')
	obj.addClass('selected')
} 

function populateAttributes(num) {
	var itemData = getItemData(num)
	flatArray = processSpecialProperties(itemData)
	for (i in flatArray) {
		$('#'+i).val(flatArray[i])
	}
	showMiddlePanel('SFDSWFB-attributes')
}

function loadDialogModal (title, body) {
  $('#modal-dialog .modal-title').text(title)
  $('#modal-dialog .modal-body p').text(body)
  $('#modal-dialog').modal()
}

function loadConfirmModal (title, body, callback) {
  $('#modal-confirm .modal-title').text(title)
  $('#modal-confirm .modal-body p').text(body)
  $('#modal-confirm .btn-primary').on('click', callback)
  $('#modal-confirm').modal()
}

function toggleMiddlePanel() {
	if ($('.middlePanel').hasClass('col-lg-4')) {
		hideMiddlePanel()
	} else {
		showMiddlePanel()
	}
}

function showMiddlePanel(panelId) {
	$('.middlePanel').removeClass('col-lg-1')
	$('.middlePanel').removeClass('col-xl-1')
	if (!$('.middlePanel').hasClass('col-lg-4')) $('.middlePanel').addClass('col-lg-4')
	if (!$('.middlePanel').hasClass('col-xl-3')) $('.middlePanel').addClass('col-xl-3')
	$('.rightPanel').removeClass('col-lg-8')
	$('.rightPanel').removeClass('col-xl-9')
	if (!$('.rightPanel').hasClass('col-lg-5')) $('.rightPanel').addClass('col-lg-5')
	if (!$('.rightPanel').hasClass('col-xl-7')) $('.rightPanel').addClass('col-xl-7')
	if (typeof panelId != "undefined") {
		$('.middlePanel > div').hide()
		$('#'+panelId).show()		
	}
	$('.horizontal-toggle').removeClass('fa-angle-double-right');
	if (!$('.horizontal-toggle').hasClass('fa-angle-double-left')) $('.horizontal-toggle').addClass('fa-angle-double-left');
}
function hideMiddlePanel() {
	$('.middlePanel').removeClass('col-lg-4')
	$('.middlePanel').removeClass('col-xl-3')
	if (!$('.middlePanel').hasClass('col-lg-1')) $('.middlePanel').addClass('col-lg-1')
	if (!$('.middlePanel').hasClass('col-xl-1')) $('.middlePanel').addClass('col-xl-1')
	$('.rightPanel').removeClass('col-lg-5')
	$('.rightPanel').removeClass('col-xl-7')
	if (!$('.rightPanel').hasClass('col-lg-8')) $('.rightPanel').addClass('col-lg-8')
	if (!$('.rightPanel').hasClass('col-lg-9')) $('.rightPanel').addClass('col-xl-9')
	//$('.middlePanel > div').hide()
	$('.horizontal-toggle').removeClass('fa-angle-double-left');
	if (!$('.horizontal-toggle').hasClass('fa-angle-double-right')) $('.horizontal-toggle').addClass('fa-angle-double-right');
}



/*******************
form.js
formerly items-collection.js
more than one item logic, left panel logic, add, remove, rearrange, etc.
*******************/

function loadForm () {
  var saved = getFormJSON()
  populateList(saved)
  loadPreview()
}

function getFormJSON() {
  var saved = $('#SFDSWFB-form').val()
  saved = JSON.parse(saved.replace(/[\x00-\x1F\x7F-\x9F]/g, '\\n'))
  return saved;
}




/*******************
forms-view.js
html rendering, DOM
*******************/

// rename to loadFormsCollection, this is run as the callback after the first callAPI
function loadHome (response) {
	$('.forms').html('')
	allForms = {}
	$.each(response, function (index, element) {
		allForms[element.id] = element
		// console.log(element);
		if (element.content != undefined) addedElement = $('.forms').append('<div>').append('<a href="javascript:void(0)" onclick="startForm(' + element.id + ')" class="recent btn btn-default btn-md btn-block">' + element.content.settings.name + '</a>')
	})
}

function startForm (id) {
	$('.content').hide(0, function () {
		if (id == undefined) {
			loadNewForm()
		} else {
			loadExistingForm(id)
		}
	})
}

function loadNewForm() {
	addBrowserState(0, '/home?new')
	formId = 0
	$('#SFDSWFB-form').val('{"settings":{"action":"","method":"POST","name":"My Form"},"data":[]}')
	$('#SFDSWFB-snippet').text('Save your form to get embed code')
	$('#SFDSWFB-source').val('')
	loadForm()
	$('#welcome').modal()
    $('.editorContainer').show()
}

function loadExistingForm(id) {
	$('#SFDSWFB-form').val(JSON.stringify(allForms[id].content))
	formId = id
	addBrowserState(id, '/home?id=' + id)
	var submitUrl = new URL('/form/submit', window.location.href)
	loadForm()
	$('.editorContainer').show()
}

function populateList(saved) {
  var html = '';
  var count = 1
  for (i in saved.data) {
    for (key in saved.data[i]) {
		if (key == "id") {
			html += '<a href="javascript:void(0)" class="spacer item insert add move" data-index="' + count + '" data-id="' + saved.data[i][key] + '"></a><div class="itemCount">' + count + '</div><a href="javascript:void(0)" class="item field" data-index="' + count + '" data-id="' + saved.data[i][key] + '">' + saved.data[i][key] + '</a>';
			count++
		}
	}
  }
  html += '<a href="javascript:void(0)" class="spacer item insert add move" data-index="' + count + '"></a>';
  $('#SFDSWFB-list').html(html)
  $('#SFDSWFB-list .item').on('click', function() {editItem($(this))})
}

function openPreviewWindow() {
	window.open('/form/preview/?id=' + formId,'_blank')
}

function loadPreview(sectionId) {
	var scrollTo = typeof sectionId != "undefined" ? '&sectionId=' + sectionId : '';
	$('#SFDSWFB-preview').html('<iframe src="/form/preview/?id=' + formId + scrollTo + '">Your browser does not support iframes, <a href="/form/preview/?id=' + formId + '" target="_blank">click here</a> to a view a preview.</iframe>')
}

function insertItem(formType) {
	var index = $('#SFDSWFB-list .spacer.selected').eq(0).data('index');
	addItemToForm(formType, index)
	editItem($('#SFDSWFB-list .field[data-index=' + index + ']'))
}
function addItemToForm(formType, index) {
	var saved = getFormJSON()
	//todo modify formJSON
	//save formJSON
	populateList(saved)
}
function moveItem() {
	
}
function removeItem() {
	
}

