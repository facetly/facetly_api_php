<?php
require_once("../facetly_api.php");
$facetly = new facetly_api;
$api_server = "http://sg2.facetly.net/1";
$api_path = "search/autocomplete";
$api_method = "GET";
$api_key = "y37fdeti";
$api_secret = "ebhqnbjrgwhqwgalhgymezpg3hq3aqsl";
if (isset ($_GET['query'])) $query = $_GET['query']; else $query = '';
$api_data = array(
 "query" => $query,
);

echo "<div><form method='GET'>Search : <input type='text' name='query' /><input type='submit' value='submit' /></form></div>";
$facetly->setConsumer($api_key, $api_secret); 
$facetly->setServer($api_server);
$api_output = $facetly->call($api_path, $api_data, $api_method);
$return = json_decode($api_output);
 
print_r($return->suggestions);
