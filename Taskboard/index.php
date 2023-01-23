<?php

require_once './autoload.php';

$home = new HomeController();

$pages = ['dashboard','home','add','get','delete','update','search','auto-reg','logout'];

if (isset($_GET['page']) && in_array($_GET['page'],$pages)) {
  if(($_GET['page']==='dashboard') && !(isset($_SESSION['user_logged']))){
    header('location: home');
  }elseif((isset($_SESSION['user_logged'])) && ($_GET['page']==='home')){
    header('location: dashboard');
  }
  else{
    $page = $_GET['page'];
    $home->index($page);
  }
}else if (!isset($_GET['page'])){
  header('location: home');
}else {
  include('views/includes/404.php');
}


