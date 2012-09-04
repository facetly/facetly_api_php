<html>
<head>
  <?php $baseurl = str_replace('search-ajax.php', '', $_SERVER['SCRIPT_NAME']); ?>
  <link href="css/autocomplete.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="js/jquery.js"></script>
  <script src="js/jquery.autocomplete.js" type="text/javascript"></script>
  <script src="js/jquery.address.js" type="text/javascript"></script>
  <script type='text/javascript'>
  //declare variable that used in facetly.js
    var facetly = {
	"key" : "y37fdeti",
	"server" : "http://sg2.facetly.net/1",
	"file" : "search-ajax.php",
	"baseurl" : "<?php echo $baseurl ?>",
	 }
  </script>

<script src="js/facetly.js" type="text/javascript"></script>
</head>
<body>
<?php 
require_once("../facetly_api.php");
$facetly = new facetly_api;
$api_key = "y37fdeti";
$api_secret = "ebhqnbjrgwhqwgalhgymezpg3hq3aqsl";
$api_server = "http://sg2.facetly.net/1";

$facetly->setConsumer($api_key, $api_secret);  
$facetly->setServer($api_server);
$facetly->setbaseurl($_SERVER['SCRIPT_NAME']);	

?>
<div id='wrapper_search'>
	<div id='search' style='clear:both'>
		<form facetly_form="on" action='search-ajax.php' method='GET'>
			Search &nbsp; : <input id='edit-query' type="text" facetly="on" autocomplete="off"  name ="query" size ="15" />						 
			<input type='submit' value='submit'/>
		</form>
	</div>
	<div id='facetly_facet' style='float:left'>
	<?php
	$search = '';
	if (isset($_GET['query'])) {
	  $search = $_GET['query'];		  
	}
	$filter = $_GET;
 	
 	//search product with fuction from facetly library(facetly.php) that return facets and results 	
	$json = $facetly->searchProduct($search,$filter,"html"); 
	print_r($json->facets);
	echo "</div>";
echo "</div>";
	echo "<div id='facetly_result'>";
	print_r($json->results);
	echo "</div>";
?>
</body>
</html>
