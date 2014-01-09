<?php
/**
 * Facetly API PHP
 * by Rizqinofa Putra M <rizqi@facetly.com>
 * https://github.com/facetly/facetly_api_php
 *
 * Create Facetly library API with PHP
 */
class facetly_api
{
    /**
     * Set key and consumer as provided by your Facetly account
     * @param string $key
     * @param string $secret
     */
    function setConsumer($key, $secret)
    {
        $this->key    = $key;
        $this->secret = $secret;
    }
    
    /**
     * Set target server as provided by your Facetly account
     * @param string  $server
     * @param boolean $async
     */
    function setServer($server, $async = FALSE)
    {
        $this->server = $server;
        $this->async = $async;
    }

    /**
     * Base url is the URL search page on your site/domain
     * @param string $baseurl : Baseurl search page on your site/domain
     */
    function setBaseUrl($baseurl)
    {
        $this->baseurl = $baseurl;
    }
    
    /**
     * API templateUpdate : update template search and facet result
     * @param  string $tplsearch
     * @param  string $tplfacet
     * @param  string $tplpage
     * @return array
     */
    function templateUpdate($tplsearch, $tplfacet, $tplpage = '')
    {
        $key    = $this->key;
        $secret = $this->secret;
        $data   = array(
            "key" => $key,
            "secret" => $secret,
            "tplsearch" => $tplsearch,
            "tplfacet" => $tplfacet,
            "tplpage" => $tplpage
        );
        $path   = "template/update";

        return json_decode($this->call($path, $data, 'POST'));
    }
    
    /**
     * API templateSelect : retrieve current template search and facet result
     * @return array
     */
    function templateSelect()
    {
        $key    = $this->key;
        $secret = $this->secret;
        $data   = array(
            "key" => $key,
            "secret" => $secret
        );
        $path   = "template/select";
        return json_decode($this->call($path, $data, 'POST'));
    }
    
    /**
     * API productDelete : delete single product
     * @param  string $id
     * @return array
     */
    function productDelete($id)
    {
        $key    = $this->key;
        $secret = $this->secret;
        $data   = array(
            "key" => $key,
            "secret" => $secret,
            "id" => $id
        );
        $path   = "product/delete";
        return $this->call($path, $data, 'POST');
    }
    
    /**
     * API productTruncate : delete all product
     * @return array
     */
    function productTruncate()
    {
        $key    = $this->key;
        $secret = $this->secret;
        $data   = array(
            "key" => $key,
            "secret" => $secret
        );
        $path   = "product/truncate";
        return $this->call($path, $data, 'POST');
    }
    
    /**
     * API productUpdate : update single product
     * @param  array $items
     * @param  string $id
     * @return array
     */
    function productUpdate($items, $id = '')
    {
        $key    = $this->key;
        $secret = $this->secret;
        $data   = array(
            "id" => $id,
            "key" => $key,
            "secret" => $secret
        );
        $data   = array_merge($data, $items);
        $path   = "product/update";
        return $this->call($path, $data, 'POST');
    }

    /**
     * API productInsert : insert single product
     * @param  array $items
     * @return array
     */
    function productInsert($items)
    {
        $key    = $this->key;
        $secret = $this->secret;
        $data   = array(
            "key" => $key,
            "secret" => $secret
        );
        $data   = array_merge($data, $items);
        $path   = "product/insert";
        return $this->call($path, $data, 'POST');
    }
    
    /**
     * API productSelect : retrieve single product
     * @param  string $id
     * @return array
     */
    function productSelect($id)
    {
        $key    = $this->key;
        $secret = $this->secret;
        $data   = array(
            "key" => $key,
            "secret" => $secret,
            "id" => $id
        );
        $path   = "product/select";
        return $this->call($path, $data, 'POST');
    }
    
    /**
     * API searchProduct : retrieve products filtered by query or selected facet
     * @param  string $query : Query that contain keyword to search products .
     * @param  array $filter : Array contain facet filter, example : Array([category] => Toys)
     * @param  string $render :  Response type that will be returned from facetly.com. There's 2 type of response: template and json. Default to json.
     * @return array
     */
    function searchProduct($query, $filter, $render = 'json')
    {
        $baseurl = (!empty($this->baseurl)) ? $this->baseurl : $filter['baseurl'];
        $key     = $this->key;
        $data    = array(
            "key" => $key,
            "limit" => 5,            
            "render" => $render,
            "baseurl" => $baseurl
        );
        
        if (!empty($query)) {
            $data['query'] = $query;
        }
        $data = array_merge($data, $filter);
        $path = "search/product";
        return json_decode($this->call($path, $data, 'GET'));
    }
    
    /**
     * API searchAutocomplete : retrieve autocomplete keyword filtered by query 
     * @param  string $query : Query that contain keyword to search products .
     * @return array
     */
    function searchAutoComplete($query)
    {
        $key    = $this->key;
        $secret = $this->secret;
        $data   = array(
            "key" => $key,
            "query" => $query
        );
        
        $path = "search/autocomplete";
        return json_decode($this->call($path, $data, 'GET'));
    }
    
    /**
     * API reportQuery : retrieve query report filtered by query and date from-to
     * @param  string $from : The first date to start taking data. Support timestamp, date format (yyyy-mm-dd), and interval (-30, or -1h)
     * @param  string $to : The last date to start taking data. Support timestamp, date format (yyyy-mm-dd), and interval (-30, or -1h)
     * @param  string $query : Query that contain keyword to search query history.
     * @param  string $interval : Time interval for report. Valid values are day, week, and month. Default to day.
     * @return array
     */
    function reportQuery($from, $to, $query = "", $interval = "day")
    {
        $key    = $this->key;
        $secret = $this->secret;
        $data   = array(
            "key" => $key,
            "secret" => $secret,
            "fromdate" => $from,
            "todate" => $to,
            "query" => "keywords_token:" . $query,
            "interval" => $interval,
        );
        $path   = "report/query";
        return json_decode($this->call($path, $data, 'POST'));
    }
    
    /**
     * API reportTrend : retrieve trend query filtered by query and date from-to
     * @param  string $from : The first date to start taking data. Support timestamp, date format (yyyy-mm-dd), and interval (-30, or -1h)
     * @param  string $to : The last date to start taking data. Support timestamp, date format (yyyy-mm-dd), and interval (-30, or -1h)
     * @param  string $query : Query that contain keyword to search query history.
     * @param  string $interval : Time interval for report. Valid values are day, week, and month. Default to day.
     * @param  string $field :  Selected field for trend. Valid values are keywords_token, query, facets, location.country, location.region, and location.city.
     * @return array
     */
    function reportTrend($from, $to, $query = "", $interval = "day", $field = "keywords_token")
    {
        $key    = $this->key;
        $secret = $this->secret;
        $data   = array(
            "key" => $key,
            "secret" => $secret,
            "fromdate" => $from,
            "todate" => $to,
            "query" => $query,
            "interval" => $interval,
            "size" => 5, // size of facets
            "field" => $field //selected field for facets            
        );
        $path   = "report/trend";
        return json_decode($this->call($path, $data, 'POST'));
    }
    
    /**
     * API statsNetwork : retrieve statistic of total network usage
     * @param  string $from : The first date to start taking data. Support timestamp, date format (yyyy-mm-dd), and interval (-30, or -1h)
     * @param  string $to : The last date to start taking data. Support timestamp, date format (yyyy-mm-dd), and interval (-30, or -1h)
     * @param  string $query : Query that contain keyword to search query history.
     * @param  string $interval : Time interval for report. Valid values are day, week, and month. Default to day.
     * @return array
     */
    function statsNetwork($from, $to, $query = "", $interval = "day")
    {
        $key    = $this->key;
        $secret = $this->secret;
        $data   = array(
            "key" => $key,
            "secret" => $secret,
            "fromdate" => $from,
            "todate" => $to,
            "query" => $query,
            "interval" => $interval,            
        );
        $path   = "stats/network";
        return json_decode($this->call($path, $data, 'POST'));
    }

    /**
     * API statsTime : retrieve statistic of total average time search query
     * @param  string $from : The first date to start taking data. Support timestamp, date format (yyyy-mm-dd), and interval (-30, or -1h)
     * @param  string $to : The last date to start taking data. Support timestamp, date format (yyyy-mm-dd), and interval (-30, or -1h)
     * @param  string $query : Query that contain keyword to search query history.
     * @param  string $interval : Time interval for report. Valid values are day, week, and month. Default to day.
     * @return array
     */
    function statsTime($from, $to, $query = "", $interval = "day")
    {
        $key    = $this->key;
        $secret = $this->secret;
        $data   = array(
            "key" => $key,
            "secret" => $secret,
            "fromdate" => $from,
            "todate" => $to,
            "query" => $query,
            "interval" => $interval,            
        );
        $path   = "stats/network";
        return json_decode($this->call($path, $data, 'POST'));
    }    
    
    /**
     * API fieldSelect : retrieve available field from Facetly.
     * @return array
     */
    function fieldSelect()
    {
        $key    = $this->key;
        $secret = $this->secret;
        $data   = array(
            "key" => $key,
            "secret" => $secret
        );
        $path   = "field/select";
        return json_decode($this->call($path, $data, 'POST'));
    }
    
    /**
     * [call description]
     * @param  string $path
     * @param  array $data
     * @param  string $method
     * @return string
     */
    function call($path, $data, $method)
    {
        if (!$this->key || !$this->secret || !$this->server) throw new Exception('Empty Consumer Configuration');               
            $data = http_build_query($data, '', '&');
        //replace multiple values [0]..[n] to [], thanks to http://www.php.net/manual/en/function.http-build-query.php#78603
        $data = preg_replace('/%5B(?:[0-9]|[1-9][0-9]+)%5D=/', '[]=', $data);
        $path = $this->server . "/" . $path;
        
        if ($this->async) {
          $this->curl_post_async($path, $data);
        } else {
        
        if ($method == 'POST') {
            $Curl_Session = curl_init($path);
            curl_setopt($Curl_Session, CURLOPT_POST, 1);
            curl_setopt($Curl_Session, CURLOPT_POSTFIELDS, $data);
        } else if ($method == 'GET') {
            $Curl_Session = curl_init($path . '?' . $data);
        }        
        
        curl_setopt($Curl_Session, CURLOPT_HEADER, FALSE);
        curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($Curl_Session, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($Curl_Session, CURLOPT_ENCODING, 1);
        curl_setopt($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($Curl_Session, CURLOPT_HTTPHEADER, array(
            "Accept-Encoding: gzip"
        ));
        //curl_setopt($Curl_Session, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
        $output = curl_exec($Curl_Session);
        $header = curl_getinfo($Curl_Session);
        
        if ($header['http_code'] != 200)
            throw new Exception($output);
        curl_close($Curl_Session);
        
        $this->output = $output;
        return $this->output;
        }
    }
    
    /**
     * [curl_post_async description]
     * @param  string $url
     * @param  string $post_string     
     */
    function curl_post_async($url, $post_string)
    // curl async, thanks to http://petewarden.typepad.com/searchbrowser/2008/06/how-to-post-an.html
    {    
        $parts=parse_url($url);

        $fp = fsockopen($parts['host'], 
            isset($parts['port'])?$parts['port']:80, 
            $errno, $errstr, 30);

        //pete_assert(($fp!=0), "Couldn't open a socket to ".$url." (".$errstr.")");(optional)

        $out = "POST ".$parts['path']." HTTP/1.1\r\n";
        $out.= "Host: ".$parts['host']."\r\n";
        $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
        $out.= "Content-Length: ".strlen($post_string)."\r\n";
        $out.= "Connection: Close\r\n\r\n";
        if (isset($post_string)) $out.= $post_string;

        fwrite($fp, $out);
        fclose($fp);
    }        
}

