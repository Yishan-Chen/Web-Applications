<?php
session_start();
header("Content-Type: application/json");
require 'database5.php';
$eventid = (string)$_POST['eventid'];
$stmt = $mysqli->prepare("select title, date, id, location, description, time from event where id = ?");
$stmt->bind_param('s', $eventid);
$stmt->execute();
$eventdata=[];
$result = $stmt->get_result();
$count=0;
while($row = $result->fetch_assoc()){
        $item = [];
        $item['title']= htmlentities($row["title"]);
        $item['date'] = htmlentities($row["date"]);
        $item['id'] = htmlentities($row["id"]);
        $item['location']= htmlentities($row["location"]);
        $item['description'] = htmlentities($row["description"]);
        $item['time']= htmlentities($row["time"]);
        array_push($eventdata,$item);
        $count++;
        }
        echo json_encode( array("editdata"=>$eventdata, "count"=>$count));
        $stmt->close();
        exit;
?>
