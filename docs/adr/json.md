# Example JSON
Below is an example of a form saved as a JSON object in the database.

{
	"settings":
				{
					"action":"",
					"method":"POST",
					"name":"Clone of First Form"
				},
	"data":
			[
				{
					"label":"Name",
					"placeholder":"placeholder",
					"help":"Supporting help text",
					"id":"name",
					"formtype":"c02",
					"name":"name",
					"type":"text",
					"required":"true",
					"value":"John",
					"class":"custom-class"
				},
				{
					"label":"Quantity",
					"placeholder":"",
					"help":"",
					"id":"quantity",
					"formtype":"d06",
					"type":"number",
					"required":"true",
					"name":"quantity"
				},
				{
					"label":"Price",
					"placeholder":"",
					"help":"",									
					"id":"price",
					"formtype":"d06",
					"type":"number",
					"required":"true",
					"name":"price"
				},
				{
					"label":"Total",
					"placeholder":"",
					"help":"","
					id":"total",
					"formtype":"d06",
					"type":"number",
					"required":"true",
					"name":"total/"/?,
					"calculations":
									[
										"quantity",
										"Multiplied by",
										"price"
									]
				},
				{
					"label":"Show hidden checkboxes?",
					"option":"Yes\nNo",
					"id":"dropdown",
					"formtype":"s02",
					"required":"true",
					"name":"dropdown"
				},
				{
					"label":"Hidden Checkboxes",
					"checkboxes":"Foo\nBar",
					"id":"checkboxes",
					"formtype":"s06",
					"required":"false",
					"class":"checkboxes"
					,"conditions":
									{
										"showHide":"Show",
										"allAny":false,
										"condition":
													[
														{
															"id":"dropdown",
															"op":"matches",
															"val":"Yes"
														}
													]
									}
				}
			]
}