<?php
error_reporting(E_ALL);
passthru('sh /var/www/html/dist/php/update.sh', $output);
echo "<pre>$output</pre>";
?>