Facetly API User Guide
=================

Facetly API user guide is used for introducing Facetly API into user with couples example and simple code to know more about how to use Facetly function in their web.

API Documentation
-------------
To know more about Facetly API, you can check out facetly-documentation.doc or https://www.facetly.com/doc/api

Authentication
-------------
Authenticate your key, secret, and server to connect with Facetly API where you can get it when you create account and create store on www.facetly.com. Here is a simple code for autenticate key, secret and server.
~~~
require_once("./facetly_api.php");
$facetly_api = new facetly_api;

//input your Facetly API keys, secret and server 
$api_key = 'zuakz7ok';
$api_secret = 'dmzmyfsapjhknutrtunvjesnunbae6ej';
$api_server = 'http://sg2.facetly.com/1';

$facetly_api->setConsumer($api_key,$api_secret); 
$facetly_api->setServer($api_server);
~~~

Function like search product need authentication baseurl for return their search result. Here is a simple code for authenticate your store baseurl
~~~
require_once("./facetly_api.php");
$facetly_api = new facetly_api;

//input your Facetly API keys, secret and server 
$api_key = 'zuakz7ok';
$api_secret = 'dmzmyfsapjhknutrtunvjesnunbae6ej';
$api_server = 'http://sg2.facetly.com/1';
$api_baseurl = '/find';

//set authentication
$facetly_api->setConsumer($api_key,$api_secret); 
$facetly_api->setServer($api_server);
$facetly_api->setBaseurl($api_baseurl);
~~~

Now you can use Facetly API function for modify your data product

Facetly API Product Update
-------------

After authenticate your account, you can insert your online store product into facetly using productUpdate function
~~~
require_once("./facetly_api.php");
$facetly_api = new facetly_api;

//set authentication
$api_key = 'zuakz7ok';
$api_secret = 'dmzmyfsapjhknutrtunvjesnunbae6ej';
$api_server = 'http://sg2.facetly.com/1';

$facetly_api->setConsumer($api_key,$api_secret); 
$facetly_api->setServer($api_server);

//input your product properties
$items = array(
 "id" => '1',
 "title" => 'Holiday',
 "body" => "Asian Tour for 4 days",
 "category" => "tour",
 "price" => 1000,
 "url" => "http://facetly.com/product/tour",
 "imageurl" => "http://facetly.com/sites/default/files/imagecache/tour/asian.jpg", 
);

$api_output = $facetly_api->productUpdate($items);
$print_r($api_output);
~~~


Facetly API Product Delete
-------------

ProductDelete function is a function to remove your store's specific product from facetly.com. Here is a simple code how to use productDelete function
~~~
require_once("./facetly_api.php");
$facetly_api = new facetly_api;

//set authentication
$api_key = 'zuakz7ok';
$api_secret = 'dmzmyfsapjhknutrtunvjesnunbae6ej';
$api_server = 'http://sg2.facetly.com/1';

$facetly_api->setConsumer($api_key,$api_secret); 
$facetly_api->setServer($api_server);

$id = '1'; //input your product id

$api_output = $facetly_api->productDelete($id);
$print_r($api_output);
~~~

Facetly API Search Product
-------------

You can use searchProduct function to find your product that have been inserted in facetly. Here is a simple code how to use searchProduct function.
~~~
require_once("./facetly_api.php");
$facetly_api = new facetly_api;

//set authentication
$api_key = 'zuakz7ok';
$api_secret = 'dmzmyfsapjhknutrtunvjesnunbae6ej';
$api_server = 'http://sg2.facetly.com/1';
$api_baseurl = '/find';

$facetly_api->setConsumer($api_key,$api_secret); 
$facetly_api->setServer($api_server);
$facetly_api->setBaseurl($api_baseurl);

$query = 'acer'; //input your search keyword
$filter = $_GET; //get parameters from url such as limit, category and etc
$searchtype = 'html'; // we provide 2 type method for return of search result there are 'json' and 'html'

$api_output = $facetly_api->searchProduct($query,$filter,$searchtype);
print_r($api_output->facets);
print_r($api_output->results);
~~~


Facetly API Search Autocomplete
-------------

SearchAutocomplete function is a function to find a suggestion for a product in your online store while typing. Here is a simple code how to use searchAutocomplete function :
~~~
require_once("./facetly_api.php");
$facetly_api = new facetly_api;

//set authentication
$api_key = 'zuakz7ok';
$api_secret = 'dmzmyfsapjhknutrtunvjesnunbae6ej';
$api_server = 'http://sg2.facetly.com/1';

$facetly_api->setConsumer($api_key,$api_secret); 
$facetly_api->setServer($api_server);

$query = 'a'; //input your search keyword here

$api_output = $facetly_api->searchAutocomplete($query,$filter,$searchtype);
$print_r($api_output);
~~~


Facetly API Call Function
-------------

This function is used to connect with API server using client url library (CURL). Here is a simple code how to used call function :
~~~
require_once("./facetly_api.php");
$facetly = new facetly_api;

//set authentication
$api_key = 'zuakz7ok';
$api_secret = 'dmzmyfsapjhknutrtunvjesnunbae6ej';
$api_server = 'http://sg2.facetly.com/1';

$facetly_api->setConsumer($api_key,$api_secret); 
$facetly_api->setServer($api_server);

$api_path = “search/product”; //input API path
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
$api_method = “POST”; //API have 2 method for call function there is GET and POST
$api_output = $facetly->call($api_path, $api_data, $api_method);
$return = json_decode($api_output);
print_r($return);
~~~




