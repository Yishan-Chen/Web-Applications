<?php
ini_set("session.cookie_httponly", 1);
session_start();
header("Content-Type: application/json");
require 'database5.php';
$deleteflag = (string)htmlentities($_POST['deleteflag']);
$eventid = (string)htmlentities($_POST['eventid']);
$username = (string)htmlentities($_SESSION['username']);
$title = (string)htmlentities($_POST['title']);
$location = (string)htmlentities($_POST['location']);
$date = htmlentities($_POST['date']);
$time = htmlentities($_POST['time']);
$description = (string)htmlentities($_POST['description']);
$group = (string)$_POST['group']
$flag = 0;
if($group!==null){
        $stmt = $mysqli->prepare("select username from users");
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
                if($group===htmlspecialchars( $row["username"] ))
                {
                        $flag = 1;
                        break;
                }
        }
        if($flag === 1){
                 $stmt = $mysqli->prepare("insert into event (username, title, location, date, time, description, groupuser) values (?, ?, ?, ?, ?, ?, ?)");
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
                $stmt->bind_param('sssssss', $username, $title, $location, $date, $time, $description, $group);
                $stmt->execute();
                $flag = 0;
        }
        else{
                echo json_encode(array(
                        "success" => false,
                        "message" => "share with invalid username"
                ));
        }
        $stmt->close();
}
else{
        $stmt = $mysqli->prepare("insert into event (username, title, location, date, time, description, groupuser) values (?, ?, ?, ?, ?, ?, ?)");
        if(!$stmt){
                echo json_encode(array(
                        "success" => false,
                        "message" => "write event error"
                        ));
        }
        else{
                echo json_encode(array(
                        "success" => true
                ));
        }
        $stmt->bind_param('sssssss', $username, $title, $location, $date, $time, $description, $group);
        $stmt->execute();
        $stmt->close();
        exit;
}
?>
