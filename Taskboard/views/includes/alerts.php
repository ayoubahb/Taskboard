<?php

if(isset($_COOKIE['success'])){
  echo '<div class="container position-absolute" style="top:0;left:0;"><div class="alert alert-success w-100">'.$_COOKIE['success'].'</div></div>';
}
if(isset($_COOKIE['error'])){
  echo '<div class="container position-absolute" style="top:0;left:0;"><div class="alert alert-danger w-100">'.$_COOKIE['error'].'</div></div>';

}
if(isset($_COOKIE['info'])){
  echo '<div class="container position-absolute" style="top:0;left:0;"><div class="alert alert-info w-100">'.$_COOKIE['info'].'</div></div>';

}

?>
