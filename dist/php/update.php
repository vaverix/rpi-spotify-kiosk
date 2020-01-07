<?phpheader('Access-Control-Allow-Origin: *');
header('Content-Type: text/html');
error_reporting(E_ALL);
$output = shell_exec('sudo sh /var/www/html/dist/php/update.sh');
echo "<pre>$output</pre>";
?>
