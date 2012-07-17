Facetly API User Guide
=================

Facetly API user guide is used for introducing Facetly API into user with couples example and simple code to know more about how to use Facetly function in their web.

Live Example
-------------
Here is a couples demo hosted online

http://drupal1.demo.facetly.com
http://drupal2.demo.facetly.com
http://drupal3.demo.facetly.com
http://sentrabelanja.com.dev.skyshi.com/find

Authentication
-------------
Authenticate your key, secret, and server to connect with Facetly API where you can get it when you create account and create store on www.facetly.com. Here is a simple code for autenticate key, secret and server.
~~~
require_once("./facetly_api.php");
$facetly_api = new facetly_api;

$api_key = 'zuakz7ok';
$api_secret = 'dmzmyfsapjhknutrtunvjesnunbae6ej';
$api_server = 'http://sg2.facetly.com/1';

$facetly_api->setConsumer($api_key,$api_secret); 
$facetly_api->setServer($api_server);
~~~

Function like search product and search autocomplete need authentication baseurl for return their search result. Here is a simple code for authenticate your store baseurl
~~~
require_once("./facetly_api.php");
$facetly_api = new facetly_api;
$api_baseurl = '/find';
$facetly_api->setBaseurl($api_baseurl);
The parameters for authentication are:
$facetly_api : initiate facetly API
$api_key : input your Facetly API key
$api_secret : input your Facetly API secret 
$api_server : input your Facetly API server
$api_baseurl : input your store baseurl~~~

The function for authentication are:
$facetly_api->setConsumer($api_key,$api_secret) : authentication key and secret
$facetly_api->setServer($api_server) : authentication server
$facetly_api->setBaseurl($api_baseurl) : authentication store baseurl
Now you can use Facetly API function for modify your data product

Facetly API Product Update
-------------

After authenticate your account, you can insert your online store product into facetly using productUpdate function
~~~
require_once("./facetly_api.php");
$facetly_api = new facetly_api;

$items = array(
 "id" => '1',
 "title" => 'Holiday',
 "body" => "Asian Tour for 4 days",
 "category" => "tour",
 "price" => 1000,
 "url" => "http://facetly.com/product/tour",
 "imageurl" => "http://facetly.com/sites/default/files/imagecache/tour/asian.jpg", 
);
$facetly_api->productUpdate($items);
The parameters for productUpdate function are :
$facetly_api : initiate facetly API (don't forget to authentication first)
$items : input your product properties

The function for productUpdate are :
$facetly_api->setConsumer($api_key,$api_secret) : authentication key and secret
$facetly_api->setServer($api_server) : authentication server
$facetly_api->productUpdate($items) : insert product into Facetly API
~~~

Facetly API Product Delete
-------------

ProductDelete function is a function to remove your store's specific product from facetly.com. Here is a simple code how to use productDelete function
~~~
require_once("./facetly_api.php");
$facetly_api = new facetly_api;

$id = '1'

$facetly_api->productDelete($id);
The parameters for productDelete function are :
$facetly_api : initiate facetly API (don't forget to authentication first)
$id : input your product id
The function for productDelete are :
$facetly_api->setConsumer($api_key,$api_secret) : authentication key and secret
$facetly_api->setServer($api_server) : authentication server
$facetly_api->productDelete($id) : delete specific product on Facetly API
~~~

Facetly API Search Product
-------------

You can use searchProduct function to find your product that have been inserted in facetly. Here is a simple code how to use searchProduct function.
~~~
require_once("./facetly_api.php");
$facetly_api = new facetly_api;

$query = 'acer'
$filter = $_GET
$searchtype = 'html' // we provide 2 type method for return of search result there are 'json' and 'html'

$facetly_api->searchProduct($query,$filter,$searchtype);
The parameters for searchProduct function are:
$facetly_api : initiate facetly API (don't forget to authentication first)
$query : input your search keyword here
$filter : get parameters in search url such as limit, category and etc
$searchtype : we provide 2 type method for return of search result there are 'json' and 'html'
The function for searchProduct are:
$facetly_api->setConsumer($api_key,$api_secret) : authentication key and secret
$facetly_api->setServer($api_server) : authentication server
$facetly_api->setBaseurl($api_baseurl) : authentication store baseurl
$facetly_api->searchProduct($query,$filter,$searchtype) : insert product into Facetly API
~~~

Facetly API Search Autocomplete
-------------

SearchAutocomplete function is a function to find a suggestion for a product in your online store while typing. Here is a simple code how to use searchAutocomplete function :
~~~
require_once("./facetly_api.php");
$facetly_api = new facetly_api;

$query = 'a' //input your search keyword here

$facetly_api->searchAutocomplete($query,$filter,$searchtype);
The parameters for SearchAutocomplete function are:
$facetly_api : initiate facetly API (don't forget to authentication first)
$query : input your search keyword here
The function for SearchAutocomplete are:
$facetly_api->setConsumer($api_key,$api_secret) : authentication key and secret
$facetly_api->setServer($api_server) : authentication server
$facetly_api->searchAutoComplete($query) : suggestion keywords product on Facetly API
~~~

Facetly API Call Function
-------------

This function is used to connect with API server using client url library (CURL). Here is a simple code how to used call function :
~~~
require_once("./facetly_api.php");
$facetly = new facetly_api;
$api_path = “search/product”;
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
$api_method = “POST”;
$api_output = $facetly->call($api_path, $api_data, $api_method);
$return = json_decode($api_output);
print_r($return)
~~~

The parameters for call function are:
~~~
$facetly_api : initiate facetly API (don't forget to authentication first)
$api_path : input API path to know more about it you can read our documentation
            in https://www.facetly.com/doc/api
$api_data : input data that needed for API like product/update need product 
properties, key and secret to insert product into Facetly
$api_method : API have GET and POST method for execute the action  
The function for call are:
$facetly_api->setConsumer($api_key,$api_secret) : authentication key and secret
$facetly_api->setServer($api_server) : authentication server
$facetly->call($api_path, $api_data, $api_method) : execute data depends on api_path and api_method
~~~
To know more about Facetly API, you can check out facetly-documentation.doc or https://www.facetly.com/doc/api


