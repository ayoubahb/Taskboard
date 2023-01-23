<?php
$data = json_decode(file_get_contents('php://input'), true);

//if user tap delete in the url
if (!isset($data)) {
  header('location: home');
}

$delete = new TaskController();
$result = $delete->deleteTask($data);
echo $result;

