<?php

$imageList = array();
for ($i = 1; $i < 13; $i++) {
    if ($i < 10) {
        $imageId = "0" . $i;
    } else {
        $imageId = $i;
    }
    $image = array(
        "url" => "JssorSlider/img/landscape/" . $imageId . ".jpg",
        "type1" => "thumb",
        "type2" => "caption",
        "title1" => "blabla title1 " . $i,
        "title2" => "blabla title2 " . $i,
        "title3" => "blabla title3 " . $i,
    );
    $imageList[] = $image;
}
header('Content-Type: application/json');
echo json_encode($imageList);
