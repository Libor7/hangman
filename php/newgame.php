<?php 
if(!isset($_POST['level'])) {
  exit('Direct access denied');
}else {
  if(session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  switch($_POST['level']) {
    case 'easy':
      $_SESSION['attempts'] = 7;
      break;
    case 'middle':
      $_SESSION['attempts'] = 5;
      break;
    case 'hard':
      $_SESSION['attempts'] = 3;
      break;
  }

  include('../classes/database.class.php');
  include('../classes/text.class.php');
  include('../classes/template.class.php');

  if(isset($_SESSION['updatedCity'])) {
    unset($_SESSION['updatedCity']);
  }

  $odb = new Database;
  $usedCities = isset($_SESSION['usedCities']) ? $_SESSION['usedCities'] : array();
  $result = $odb->getCity($_SESSION['cities'], $usedCities);
  $_SESSION['city'] = $result[0];
  $_SESSION['usedCities'] = $result[1];

  $otx = new Text($_SESSION['city']);
  $hiddenname = $otx->hideCity();
  unset($otx);

  $otm = new Template;
  $_SESSION['game'] = $otm->displayNewGame($hiddenname);
  unset($otm);
  echo $_SESSION['game'];
}