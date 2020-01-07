<?php

$volume = $_GET['percent'];

if (empty($volume)) {
    echo shell_exec('vol');
} else {
    echo shell_exec('vol '.$volume);
}