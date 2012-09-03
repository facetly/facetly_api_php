<?php
require_once("../facetly_api.php");
$facetly = new facetly_api;
$api_server = "http://sg2.facetly.net/1";
$api_key = "y37fdeti";
$api_secret = "ebhqnbjrgwhqwgalhgymezpg3hq3aqsl";
$api_path = "search/product";
$api_method = "GET";
$api_data = array(
		  "limit" => 10,
		  "searchtype" => 'html',
		  "baseurl" => $_SERVER['SCRIPT_NAME'],
		  "query" => $_GET['query'],
);
$api_filter = $_GET;
$api_data = array_merge($api_data,$api_filter); 
$facetly->setConsumer($api_key, $api_secret);
$facetly->setServer($api_server);
$api_output = $facetly->call($api_path, $api_data, $api_method);
$return = json_decode($api_output);
if(!isset($return)) {
  echo "Product not found";
}
else
{ 
  echo "<div><form method='GET'>Search : <input type='text' name='query' /><input type='submit' value='submit' /></form></div><div style='clear:both'></div><div id='facetly_facet' style='float:left'>"; 
  print_r($return->facets); 
  echo "</div><div id='facetly_result'>";
  print_r($return->results);
  echo "</div>";
}
