<?php 

if(!isset($_POST['letter'])) {
  exit('Direct access denied');
}else {
  if(session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  include('../classes/text.class.php');
  $otx = new Text;

  if(isset($_SESSION['updatedCity'])) {
    $foundChars = $otx->findChars($_SESSION['city'], $_POST['letter']);
    $_SESSION['updatedCity'] = $otx->update($_SESSION['city'], $foundChars, $_SESSION['updatedCity']);
  }else {
    $foundChars = $otx->findChars($_SESSION['city'], $_POST['letter']);
    $_SESSION['updatedCity'] = $otx->update($_SESSION['city'], $foundChars);
  }

  unset($otx);
}