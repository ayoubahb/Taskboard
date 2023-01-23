<?php
  $data = json_decode(file_get_contents('php://input'), true);


  $get = new TaskController();
  $result = $get->getAllTasks($data['id']);
  echo json_encode($result);



