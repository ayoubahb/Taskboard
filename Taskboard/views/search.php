<?php
$data = json_decode(file_get_contents('php://input'), true);

$search = new TaskController();
$result = $search->searchTasks($data);
echo json_encode($result);

