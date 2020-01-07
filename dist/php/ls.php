<?php
$output = shell_exec('ls -lart');
file_put_contents("/var/log/lighttpd/access.log", $output, FILE_APPEND | LOCK_E$
echo "<pre>$output</pre>";
?>
