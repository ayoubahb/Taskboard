<?php

class User{
  static public function check($email){
    $stmt = DB::connect()->prepare('SELECT * FROM user WHERE userEmail = :userEmail');
    $stmt->execute(array(":userEmail" =>$email));
    $resultCheck;
    if ($stmt->rowCount() > 0) {
      $resultCheck = false;
    }else{
      $resultCheck = true;
    }
    return $resultCheck;
  }
  static public function register($data){
    $stmt = DB::connect()->prepare('INSERT INTO user(userName,userEmail,userPassword) VALUES (:userName,:userEmail,:userPassword)');
    $stmt->bindParam(':userName',$data['username']);
    $stmt->bindParam(':userEmail',$data['email']);
    $stmt->bindParam(':userPassword',$data['password']);
    if($stmt->execute()){
      return 'ok';
    }else{
      return 'error';
    }
  }
  static public function login($email){
    $stmt = DB::connect()->prepare('SELECT * FROM user WHERE userEmail = :userEmail');
    $stmt->bindParam(':userEmail',$email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
    
  }
}