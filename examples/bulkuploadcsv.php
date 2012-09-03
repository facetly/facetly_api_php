<html>
<title>Upload-CSV</title>
<head>
</head>
<body>
<b>Upload-CSV</b>
<br/>
  <form action='' method='POST' enctype="multipart/form-data">
  File : <input type='file' size='10' name='files' id='files' />&nbsp;<input type='submit' value='submit' />
  </form>

<?php
if(!empty($_FILES['files'])) {

  //connecting with facetly library(facetly.php) that saved in variable facetly
  require_once("../facetly_api.php");
  $facetly = new facetly_api;
  $api_key = "yiqoybfe";
  $api_secret = "rzhizcpntx7c6cxv4nqocrx7mjemcaua";
  $server = "http://sg2.facetly.com/1";
  $facetly->setConsumer($api_key, $api_secret);  
  $facetly->setServer($api_server);	
  $i = 1;
  $flag=0;

  //get .csv file data
  if (($handle = fopen($_FILES['files']['tmp_name'], "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {				
      if ($flag == 0) {
        $flag++;
        continue;
      }
      $title = $data[0];
      $category = $data[1];
      $body = $data[2];
      $price = $data[3];
      $url = $data[4];
      $imageurl = $data[5];
      $item = array(
        'id' => $i,
        'title' => $title,
        'category' =>$category,
        'body' => $body,
        'price' =>$price,
        'url' =>$url,
        'imageurl' =>$imageurl,
      );
    print_r($facetly->productUpdate($item));//insert product with fuction from facetly library(facetly_api.php)	
    $i++;
    }
  fclose($handle);
  }
}
?>
</body>
</html>
