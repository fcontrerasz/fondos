<?php 


include("conexion/conecta.php"); 

error_reporting(E_ALL);
ini_set('display_errors', 1);

function httpGet($url)
{
    $ch = curl_init();  
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Host" => "someloginserver.com",
    "User-Agent" => "Mozilla/5.0 (Windows NT 6.1; rv:2.0.1) Gecko/20100101 Firefox/4.0.1",
    "Accept" => "application/json, text/javascript, */*; q=0.01",
    "Accept-Language" => "en-us,en;q=0.5",
    "Accept-Encoding" => "gzip, deflate",
    "Accept-Charset" => "ISO-8859-1,utf-8;q=0.7,*;q=0.7",
    "Keep-Alive" => "115",
    "Connection" => "keep-alive",
    "X-Requested-With" => "XMLHttpRequest",
    "Referer" => "http://someloginserver.com/sendlogin.php"
	));
     curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//  curl_setopt($ch,CURLOPT_HEADER, false); 
     $output=curl_exec($ch);
     curl_close($ch);
    return $output;
}

function get_include_contents($filename) {
    if (is_file($filename)) {
        ob_start();
        include $filename;
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }
    return false;
}

function trae($url){

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Requested-With: XMLHttpRequest",'Host: oticdelaconstruccion.cl'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_URL,$url);
$result = curl_exec ($ch);
echo "--->".$result;
if(curl_errno($ch))
{
    echo 'error:' . curl_error($ch);
}
curl_close ($ch); 

}
//echo dirname(__FILE__)."<br>";
//echo getcwd() . "\n";
?>
<?php
$result = $db->query("select IDPOSTULACION from  POSTULACIONES_WEB WHERE IDESTADOBECA = 10 limit 1,5");
if($result){  
while ($row = $result->fetch_object()){
 echo $row->IDPOSTULACION."<br>";
 //echo "-".trae('http://'.$_SERVER['SERVER_NAME'].'/fondos2015/admin00921/Pages/ponderacion_vivienda.php?i=6768')."-";
 //echo 'http://'.$_SERVER['SERVER_NAME'].'/fondos2015/admin00921/Pages/ponderacion_vivienda.php?i=6768';
 //echo get_include_contents('file://'.dirname(__FILE__).'/Pages/ponderacion_vivienda.php?i=6768');
// echo httpGet("http://www.oticdelaconstruccion.cl/fondos2015/admin00921/Pages/ponderacion_vivienda.php?i=6768");
}
     //$result->close();
     //$db->next_result();
} 
$db->close();

$response = get_web_page("http://www.oticdelaconstruccion.cl/fondos2015/admin00921/Pages/ponderacion_vivienda.php?i=6768&_=1444776649152");
echo "-->".$response."<--";
$resArr = array();
$resArr = json_decode($response);
echo "<pre>"; print_r($resArr); echo "</pre>";

function get_web_page($url) {
    $options = array(
        CURLOPT_RETURNTRANSFER => true,   // return web page
        CURLOPT_HEADER         => false,  // don't return headers
        CURLOPT_FOLLOWLOCATION => true,   // follow redirects
        CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
        CURLOPT_ENCODING       => "",     // handle compressed
        CURLOPT_USERAGENT      => "test", // name of client
        CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
        CURLOPT_TIMEOUT        => 120,    // time-out on response
    ); 

    $ch = curl_init($url);
    curl_setopt_array($ch, $options);

    $content  = curl_exec($ch);

    curl_close($ch);

    return $content;
}
//http://www.oticdelaconstruccion.cl/fondos2015/admin00921/Pages/ponderacion_vivienda.php?i=6768&_=1444776649152
?>

