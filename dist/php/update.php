<?php
error_reporting(E_ALL);
$output = exec('sh /var/www/html/dist/php/update.sh');
echo "<pre>$output</pre>";
?>