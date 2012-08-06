<?php
require_once("../facetly_api.php");
$facetly = new facetly_api;
$api_server = "http://sg2.facetly.com/1";
$api_path = "search/product";
$api_method = "GET";
$api_data = array(
 		  "key" => "ider3nks",
		  "limit" => 3,
		  "searchtype" => 'html',
		  "baseurl" => $_SERVER['SCRIPT_NAME'],
		  "query" => "acer",
);
$api_filter = $_GET;
$api_data = array_merge($api_data,$api_filter); 
$facetly->setServer($api_server);
$api_output = $facetly->call($api_path, $api_data, $api_method);
$return = json_decode($api_output);
if(!isset($return)) {
  echo "Product not found";
}
else
{ 
  echo "<div id='facetly_facet'>"; 
  print_r($return->facets); 
  echo "</div><div id='facetly_result'>";
  print_r($return->results);
  echo "</div>";
}
