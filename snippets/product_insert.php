<?php

require_once("../facetly_api.php");
$facetly = new facetly_api;
$api_server = "http://sg2.facetly.com/1";
$api_path = "product/update";
$api_method = "POST";
$api_data = array(
  "key" => "zuakz7ok",
  "secret" => "dmzmyfsapjhknutrtunvjesnunbae6ej",
  "id" => '1',
  "title" => 'Holiday',
  "body" => "Asian Tour for 4 days",
  "category" => "tour",
  "price" => 1000,
  "url" => "http://facetly.com/product/tour",
  "imageurl" => "http://facetly.com/sites/default/files/imagecache/tour/asian.jpg",
);

$facetly->setServer($api_server);
$api_output = $facetly->call($api_path, $api_data, $api_method);
$return = json_decode($api_output);

print_r($return);


