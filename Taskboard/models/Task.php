<?php

class Task{
  static public function add($data){
    $stmt =DB::connect()->prepare("INSERT INTO task (taskDescription,taskDeadLine,taskStatus,userId) VALUES (:taskDescription,:taskDeadLine,:taskStatus,:userId)");
    $stmt->bindParam(':taskDescription',$data['task']);
    $stmt->bindParam(':taskDeadLine',$data['deadline']);
    $stmt->bindParam(':taskStatus',$data['status']);
    $stmt->bindParam(':userId',$data['id']);

    if($stmt->execute()){
      return 'ok';
    }else{
      return 'error';
    }
  }
  static public function get($id){
    $stmt =DB::connect()->prepare("SELECT * FROM task WHERE userId = :id ORDER BY taskDeadLine");
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  static public function edit($data){
    $stmt =DB::connect()->prepare("UPDATE task SET taskDescription=:taskDescription, taskDeadLine=:taskDeadLine, taskStatus=:taskStatus WHERE taskId = :taskId");
    $stmt->bindParam(':taskDescription',$data['task']);
    $stmt->bindParam(':taskDeadLine',$data['deadline']);
    $stmt->bindParam(':taskStatus',$data['status']);
    $stmt->bindParam(':taskId',$data['id']);
    if($stmt->execute()){
      return 'ok';
    }else{
      return 'error';
    }
  }

  static public function delete($id){
    $stmt =DB::connect()->prepare("DELETE FROM task WHERE taskId = :id");
    $stmt->bindParam(':id',$id['id']);
    if($stmt->execute()){
      return 'ok';
    }else{
      return 'error';
    }
  }

  static public function search($task){
    $search ="%".$task['task']."%";
    $stmt =DB::connect()->prepare("SELECT * FROM task WHERE taskDescription LIKE :task AND userId = :id");

    $stmt->bindParam(':id',$task['id']);
    $stmt->bindParam(':task',$search);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


}