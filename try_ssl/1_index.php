<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unbenanntes Dokument</title>
</head>

<body>

<?php

$w = stream_get_wrappers();
echo 'openssl: ',  extension_loaded  ('openssl') ? 'yes':'no', "\n";
echo 'http wrapper: ', in_array('http', $w) ? 'yes':'no', "\n";
echo 'https wrapper: ', in_array('https', $w) ? 'yes':'no', "\n";
echo 'wrappers: ', var_dump($w);

$jsonurl = "https://graph.facebook.com/me/friends?access_token=2227470867|2.AQD0As6XIY91fjDO.3600.1318348800.0-1164514173|jMqVuzbUbDRKJFoFuvij9vH_y3M";
$json = file_get_contents($jsonurl,0,null,null);
$json_output = json_decode($json);

foreach ( $json_output->trends as $trend )
{
    echo "{$trend->name}\n";
}


?>

</body>
</html>