<?php

if (isset($_POST['submit'])) {
  if ($_POST['type']==='login') {
    $data = array(
      'email'=>$_POST['email'],
      'password'=>$_POST['password']
    );
    //instantiate from controllerUser
    $user = new UserController();
    $user->auth($data);
  }
  if ($_POST['type']==='register') {
    // hash password
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

    $data = array(
      'username'=>$_POST['username'],
      'email'=>$_POST['email'],
      'password'=>$password
    );

    //instantiate from controllerUser
    $user = new UserController();
    $user->addUser($data);
  }
}
