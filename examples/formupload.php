<html>
<title>Upload</title>
<head>
</head>
<body>	
  <b>Upload Data</b>
  <br/>
  
  <form action='' method='POST'>
  
  Product ID(unique,numeric) : <br/><input type='text' size='10' name='id' />
  <p/>
  
  Title : <br/><input type='text' size='10' name='title' />
  <p/>

  Category :  <br/><input type='text' size='10' name='cat' />
  <p/>			

  Price(numeric) : <br/><input type='text' size='10' name='price' />
  <p/>			

  URL : <br/><input type='text' size='15' name='url' />
  <p/>			

  ImageURL : <br/><input type='text' size='15' name='img' />
  <p/>

  Body : <br/><textarea rows='10' cols='40' name='body'></textarea>
  <p/>

  <input type='submit' value='submit' />
  </form>
		
<?php
if(!empty($_POST))
{
  if(!empty($_POST['ID']) || !empty($_POST['title'])) {
  
    require_once("../facetly_api.php");
    $facetly = new facetly_api;
    $api_key = "yiqoybfe";
    $api_secret = "rzhizcpntx7c6cxv4nqocrx7mjemcaua";
    $api_server = "http://sg2.facetly.net/1";
    $facetly->setConsumer($api_key, $api_secret);  
    $facetly->setServer($api_server);		
  
    //get input form
    $item = array( 
      'id' => $_POST['id'],
      'title' => $_POST['title'],
      'category' =>$_POST['category'],
      'price' =>$_POST['price'],    
      'url' =>$_POST['url'],
      'imageurl' =>$_POST['img'],
      'body' => $_POST['body'],
    );

    print_r($facetly->productUpdate($item));//insert product with fuction from facetly library(facetly_api.php)
  }
  else
  {
  echo "Please input id and title";
  }
}
?>
</body>
</html>
