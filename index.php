<!DOCTYPE html>
<html>
<head>
<title> - K 3 </title>
<link rel="stylesheet" type="text/css" href="css/semantic.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="js/semantic.min.js"></script>
</head>
<body>
<?php
$localIP = $_SERVER['SERVER_ADDR'];

?>
<br/>
<br/>
<br/>
<br/>
<div class="ui link card centered">
  <div class="content center aligned">
  
  
<form method="post" action="">
<div class="ui input">
<input type="text" name="ip" value="<?php echo $localIP; ?>">
</div>
<br/>
<br/>
<div class="ui input">
<input type="text" name="port" value="22003">
</div>
<br/>
<br/>
<br/>
<div class="ui input">
<input type="text" name="port2" value="22005">
</div>
<br/>
<br/>
<input type="submit" class="ui inverted secondary button" value="submit" name="submit">
</form>

<?php
if (isset($_POST['submit'])){
$ip = ($_POST['ip']);
$port = ($_POST['port']);
$port2 = ($_POST['port2']);
$curl = curl_init('https://nightly.mtasa.com/ports/?d='.$ip.'&g='.$port.'&h='.$port2.'&button=Submit&nodef=1&a=1&mslist=1');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$html23 = curl_exec($curl);
if(!empty($curl)){
 
  $thispage = new DOMDocument;
  libxml_use_internal_errors(true);
  $thispage->loadHTML($html23);
  libxml_clear_errors();
 
  $xpath = new DOMXPath($thispage);
  $infoport0 = $xpath->evaluate('string(//*[@id="a3"]/td[2])');
  $infoport = $xpath->evaluate('string(//*[@id="a4"]/td[2])');
  $infoport2 = $xpath->evaluate('string(//*[@id="a5"]/td[2])');
  echo "<br/>";
  echo "<br/>";
  echo   '<div class="ui message">
    <p>'.$infoport0.'</p>
  </div>';
    echo   '<div class="ui message">
    <p>'.$infoport.'</p>
  </div>';
    echo   '<div class="ui message">
    <p>'.$infoport2.'</p>
  </div>';
}
}
?>

</div>
</div>





</body>
</html>