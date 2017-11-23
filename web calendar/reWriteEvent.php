<?php
session_start();
header("Content-Type: application/json");
require 'database5.php';
$id = (string)htmlentities($_POST['id']);
$username = (string)htmlentities($_SESSION['username']);
$title = (string)htmlentities($_POST['title']);
$location = (string)htmlentities($_POST['location']);
$date = htmlentities($_POST['date']);
$time = htmlentities($_POST['time']);
$description = (string)$_POST['description'];


        $stmt = $mysqli->prepare("UPDATE event set username=?, title=?, location=?, date=?, time=?, description=? where id = ?");
        if(!$stmt){
                echo json_encode(array(
                        "success" => false,
                        "message" => "write event error"
                ));

        }
        else{   echo json_encode(array(
                        "success" => true
                ));
                }

        $stmt->bind_param('sssssss', $username, $title, $location, $date, $time, $description, $id);
 $stmt->execute();
        $stmt->close();
        exit;

?>
