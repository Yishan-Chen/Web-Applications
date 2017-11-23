<?php
// Content of database.php

$mysqli = new mysqli('localhost', 'Eason', '1', 'calendar');

if($mysqli->connect_errno) {
        printf("Connection Failed: %s\n", $mysqli->connect_error);
        exit;
}

?>