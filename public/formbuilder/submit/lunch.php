<?php

$postdata = explode("&", file_get_contents("php://input")); 
$data = Array();

foreach ($postdata as $params) {
  $params = explode("=", $params);
  if ($params[0] == "cuisine" || $params[0] == "burgers" || $params[0] == "chinese" || $params[0] == "fastcasual" || $params[0] == "japanese" || $params[0] == "mexican" || $params[0] == "pizza" || $params[0] == "thai" || $params[0] == "vegetarian") {
    $data[$params[0]][] = urldecode($params[1]);
  } else {
    $data[$params[0]] = urldecode($params[1]);
  }
}
//print_r($data);
//die;

$write = Array();

$write[0] = isset($data['brownbag']) ? $data['brownbag'] : '';
$write[1] = isset($data['budget']) ? $data['budget'] : '';

//cuisine
$write[2] = 0;
$write[3] = 0;
$write[4] = 0;
$write[5] = 0;
$write[6] = 0;
$write[7] = 0;
$write[8] = 0;
$write[9] = 0;

foreach ($data['cuisine'] as $cuisine) {
  switch ($cuisine) {
  case "Burgers and Sandwiches":
    $write[2] = 1;
    break;
  case "Chinese":
    $write[3] = 1;
    break;
  case "Fast Casual":
    $write[4] = 1;
    break;
  case "Japanese":
    $write[5] = 1;
    break;
  case "Mexican":
    $write[6] = 1;
    break;
  case "Pizza":
    $write[7] = 1;
    break;
  case "Thai":
    $write[8] = 1;
    break;
  case "Vegetarian":
    $write[9] = 1;
    break;
  }
}

//burgers
$write[10] = 0;
$write[11] = 0;
$write[12] = 0;
$write[13] = 0;
$write[14] = 0;
$write[15] = 0;
$write[16] = 0;
$write[17] = 0;
$write[18] = 0;
$write[19] = 0;
$write[20] = 0;
$write[21] = 0;
$write[22] = 0;
$write[23] = 0;
$write[24] = 0;

foreach ($data['burgers'] as $burgers) {
  switch ($burgers) {
  case "All Star Cafe":
    $write[10] = 1;
    break;
  case "Boston Cafe":
    $write[11] = 1;
    break;
  case "Crafty Fox":
    $write[12] = 1;
    break;
  case "Eden Cafe":
    $write[13] = 1;
    break;
  case "Grandma's Cafe":
    $write[14] = 1;
    break;
  case "It's Tops":
    $write[15] = 1;
    break;
  case "Ma'velous Coffee and Little Griddle":
    $write[16] = 1;
    break;
  case "The Market - Grill and Sandwich Bar":
    $write[17] = 1;
    break;
  case "Mission Beach Cafe":
    $write[18] = 1;
    break;
  case "Nina's Cafe":
    $write[19] = 1;
    break;
  case "Subway":
    $write[20] = 1;
    break;
  case "Ted's Market":
    $write[21] = 1;
    break;
  case "V Cafe":
    $write[22] = 1;
    break;
  case "The Willows":
    $write[23] = 1;
    break;
  case "Zeitgeist":
    $write[24] = 1;
    break;
  }
}

//chinese
$write[25] = 0;
$write[26] = 0;
$write[27] = 0;

foreach ($data['chinese'] as $chinese) {
  switch ($chinese) {
  case "Magic Wok":
    $write[25] = 1;
    break;
  case "Shanghai China":
    $write[26] = 1;
    break;
  case "Center Cafe":
    $write[27] = 1;
    break;
  }
}

//fastcasual
$write[28] = 0;
$write[29] = 0;
$write[30] = 0;
$write[31] = 0;
$write[32] = 0;
$write[33] = 0;
$write[34] = 0;
$write[35] = 0;
$write[36] = 0;
$write[37] = 0;
$write[38] = 0;
$write[39] = 0;

foreach ($data['fastcasual'] as $fastcasual) {
  switch ($fastcasual) {
  case "CatHead's BBQ":
    $write[28] = 1;
    break;
  case "Corridor":
    $write[29] = 1;
    break;
  case "The Grove":
    $write[30] = 1;
    break;
  case "The Market - Azalina":
    $write[31] = 1;
    break;
  case "The Market - Manila Bowl":
    $write[32] = 1;
    break;
  case "The Market - The Organic Coup":
    $write[33] = 1;
    break;
  case "The Market - Poke Bar":
    $write[34] = 1;
    break;
  case "Mina's Brazilian":
    $write[35] = 1;
    break;
  case "Mogador":
    $write[36] = 1;
    break;
  case "Proposition Chicken":
    $write[37] = 1;
    break;
  case "RT Rotisserie":
    $write[38] = 1;
    break;
  case "Souvla":
    $write[39] = 1;
    break;
  }
}

//japanese
$write[40] = 0;
$write[41] = 0;
$write[42] = 0;
$write[43] = 0;

foreach ($data['japanese'] as $japanese) {
  switch ($japanese) {
  case "Kagawa-Ya Udon":
    $write[40] = 1;
    break;
  case "Orenchi Beyond":
    $write[41] = 1;
    break;
  case "O-Toro Sushi":
    $write[42] = 1;
    break;
  case "Zaoh":
    $write[43] = 1;
    break;
  }
}

//mexican
$write[44] = 0;
$write[45] = 0;
$write[46] = 0;
$write[47] = 0;
$write[48] = 0;
$write[49] = 0;
$write[50] = 0;
$write[51] = 0;
$write[52] = 0;
$write[53] = 0;

foreach ($data['mexican'] as $mexican) {
  switch ($mexican) {
  case "Cadillac Bar and Grill":
    $write[44] = 1;
    break;
  case "Cala":
    $write[45] = 1;
    break;
  case "Don Ramon's":
    $write[46] = 1;
    break;
  case "El Picacho":
    $write[47] = 1;
    break;
  case "Pica Pica":
    $write[48] = 1;
    break;
  case "Picon":
    $write[49] = 1;
    break;
  case "Street Taco":
    $write[50] = 1;
    break;
  case "Taco Bar":
    $write[51] = 1;
    break;
  case "TacoMyFace":
    $write[52] = 1;
    break;
  case "Taqueria Cazadores":
    $write[53] = 1;
    break;
  }
}

//pizza
$write[54] = 0;
$write[55] = 0;
$write[56] = 0;

foreach ($data['pizza'] as $pizza) {
  switch ($pizza) {
  case "Baiano Pizzeria":
    $write[54] = 1;
    break;
  case "The Market - Slice House":
    $write[55] = 1;
    break;
  case "Pizza Zone and Grill":
    $write[56] = 1;
    break;
  }
}

//thai
$write[57] = 0;
$write[58] = 0;
$write[59] = 0;
$write[60] = 0;
$write[61] = 0;

foreach ($data['thai'] as $thai) {
  switch ($thai) {
  case "Bai Thong":
    $write[57] = 1;
    break;
  case "Basil Canteen":
    $write[58] = 1;
    break;
  case "Burma Love":
    $write[59] = 1;
    break;
  case "Lers Ros":
    $write[60] = 1;
    break;
  case "Manora's":
    $write[61] = 1;
    break;
  }
}

//vegetarian
$write[62] = 0;
$write[63] = 0;
$write[64] = 0;
$write[65] = 0;
$write[66] = 0;
$write[67] = 0;

foreach ($data['vegetarian'] as $vegetarian) {
  switch ($vegetarian) {
  case "Ananda Fuara":
    $write[62] = 1;
    break;
  case "Dancing Yak":
    $write[63] = 1;
    break;
  case "Indochine Vegan":
    $write[64] = 1;
    break;
  case "The Market - Bar":
    $write[65] = 1;
    break;
  case "Moya":
    $write[66] = 1;
    break;
  case "Spice of America":
    $write[67] = 1;
    break;
  }
}

$write[68] = isset($data['nextlunch']) ? $data['nextlunch'] : '';

//print_r($write);
//die;

$fp = fopen('/var/www/html/webform/submit/lunch.csv', 'a');

//foreach ($write as $fields) {
  fputcsv($fp, $write);
//}

fclose($fp);

?> 

<body>
<h1>Thank you for taking the lunch survey!</h1>
<p>Results will be shared after lunch.</p>
</body>