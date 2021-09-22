<?php

$port = $_SERVER['REMOTE_PORT']; // connecting port of the client. Not useful usually but can be interesting.
$agent = $_SERVER['HTTP_USER_AGENT']; // Unreliable to find a connecting client's browser, but can be useful sometimes.
$href = $_SERVER['HTTP_REFERER']; // If you're linking this to someone directly, it will usually be nothing.
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']); // Attempt to resolve hostname from IP address.

echo $port;
echo $agent;
echo $href;
echo $hostname;
echo $_SERVER['REMOTE_ADDR'];

echo "<a href='index.php'>dd</a>";

// Use JSON encoded string and converts 
// it into a PHP variable 
$ipdat = @json_decode(file_get_contents( 
    "http://www.geoplugin.net/json.gp?ip=" . $_SERVER['REMOTE_ADDR'])); 
   
echo 'Country Name: ' . $ipdat->geoplugin_countryName . "\n"; 
echo 'City Name: ' . $ipdat->geoplugin_city . "\n"; 
echo 'Continent Name: ' . $ipdat->geoplugin_continentName . "\n"; 
echo 'Latitude: ' . $ipdat->geoplugin_latitude . "\n"; 
echo 'Longitude: ' . $ipdat->geoplugin_longitude . "\n"; 
echo 'Currency Symbol: ' . $ipdat->geoplugin_currencySymbol . "\n"; 
echo 'Currency Code: ' . $ipdat->geoplugin_currencyCode . "\n"; 
echo 'Timezone: ' . $ipdat->geoplugin_timezone; 

?>