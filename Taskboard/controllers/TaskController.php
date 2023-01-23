<?php

class TaskController{
  public function addTask($data){
    foreach ($data as $array) { 
      $result = Task::add($array);
      if ($result !== 'ok') {
        return false;
      }
    }
    return true;
  }
  public function editTask($data){
    $result = Task::edit($data);
    if ($result !== 'ok') {
      return false;
    }
    return true;
  }
  public function deleteTask($data){
    $result = Task::delete($data);
    if ($result !== 'ok') {
      return false;
    }
    return true;
  }
  public function searchTasks($data){
    $result = Task::search($data);
    return $result;
  }
  public function getAllTasks($id){
    $result = Task::get($id);
    return $result;
  }
}
?>