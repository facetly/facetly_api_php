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
  
    require_once("facetly_api.php");
    $facetly = new facetly_api;
    $key = "zuakz7ok";
    $secret = "dmzmyfsapjhknutrtunvjesnunbae6ej";
    $server = "http://sg2.facetly.com/1";
    $facetly->setConsumer($key, $secret);  
    $facetly->setServer($server);	
  
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

    print_r($facetly->productUpdate($item));//insert product with fuction from facetly library(facetly.php)
  }
  else
  {
  echo "Please input id and title";
  }
}
?>
</body>
</html>
