<?php
error_reporting(E_ALL);
$output = shell_exec('cd /var/www/html && git pull origin master');
echo "<pre>$output</pre>";
?>