<?php
error_reporting(E_ALL);
system('sh /var/www/html/dist/php/update.sh', $output);
echo "<pre>$output</pre>";
?>