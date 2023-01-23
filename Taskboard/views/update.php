<?php
$data = json_decode(file_get_contents('php://input'), true);

$edit = new TaskController();
$result = $edit->editTask($data);
echo $result;
