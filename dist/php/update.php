<?php
error_reporting(E_ALL);
$output = system('sh /var/www/html/dist/php/update.sh');
echo "<pre>$output</pre>";
?>