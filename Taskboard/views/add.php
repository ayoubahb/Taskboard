<?php
$data = json_decode(file_get_contents('php://input'), true);

//if user tap add in the url
if (!isset($data)) {
  header('location: home');
}

$add = new TaskController();
$result = $add->addTask($data);
echo $result;
