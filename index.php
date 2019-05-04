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
function fetch_alt_ip()
    {
        $alt_ip = $_SERVER['REMOTE_ADDR'];

        if (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $alt_ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches))
        {
            // try to avoid using an internal IP address, its probably a proxy
            $ranges = array(
                '10.0.0.0/8' => array(ip2long('10.0.0.0'), ip2long('10.255.255.255')),
                '127.0.0.0/8' => array(ip2long('127.0.0.0'), ip2long('127.255.255.255')),
                '169.254.0.0/16' => array(ip2long('169.254.0.0'), ip2long('169.254.255.255')),
                '172.16.0.0/12' => array(ip2long('172.16.0.0'), ip2long('172.31.255.255')),
                '192.168.0.0/16' => array(ip2long('192.168.0.0'), ip2long('192.168.255.255')),
            );
            foreach ($matches[0] AS $ip)
            {
                $ip_long = ip2long($ip);
                if ($ip_long === false)
                {
                    continue;
                }

                $private_ip = false;
                foreach ($ranges AS $range)
                {
                    if ($ip_long >= $range[0] AND $ip_long <= $range[1])
                    {
                        $private_ip = true;
                        break;
                    }
                }

                if (!$private_ip)
                {
                    $alt_ip = $ip;
                    break;
                }
            }
        }
        else if (isset($_SERVER['HTTP_FROM']))
        {
            $alt_ip = $_SERVER['HTTP_FROM'];
        }

        return $alt_ip;
    }  
$localIP = fetch_alt_ip();


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
<br/>
<br/>
<br/>
<br/>
  <div class="right floated left aligned six wide column">

 <h5 class="ui center aligned header">By &hearts;<a href="https://facebook.com/king3bady" target="_blank"> K3 </a> </h5>
</div>
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