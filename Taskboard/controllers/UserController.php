<?php
class UserController{
  public function addUser($data){
    //filter email
    if (!filter_var($data['email'],FILTER_VALIDATE_EMAIL)) {
      Session::set('error','Invalid Email');//email invalide
      header('Location: home');
    }
    // filter username
    if (!preg_match("/^[a-zA-Z0-9]*$/",$data['username'])) {
      Session::set('error','Invalid Username');//username invalid
      header('Location: home');
    }
    //check if email already taken
    $this->checkUser($data['email']);

    
    $result = User::register($data);
    
    if ($result == 'ok') {
      Session::set('success','Account Created. Try to login now.');
    }else{
      Session::set('error','Account has not Created');
    }
    header('Location: home');
  }

  public function checkUser($email){
    $result = User::check($email);
    if(!$result){
      Session::set('error','Email already taken.');
      header('Location: home');
      die();
    };
  }

  public function auth($data){
    if (!filter_var($data['email'],FILTER_VALIDATE_EMAIL)) {
      Session::set('error','Invalid Email');//email invalide
      header('Location: home');
    }
    $result = User::login($data['email']);
    if ($result['userEmail'] === $data['email'] && password_verify($data['password'],$result['userPassword'])) {
      $_SESSION['user_logged'] = true;
      $_SESSION['userName'] = $result['userName'];
      $_SESSION['userId'] = $result['userId'];
      header('Location: dashboard');
    }else{
      Session::set('error','username or password incorrect');
      header('Location: home');
    }
  }
  static public function logout(){
    unset($_SESSION['user_logged'],$_SESSION['userName'],$_SESSION['userId']);
  }
  
}