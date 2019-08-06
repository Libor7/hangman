<?php 
header('Content-type: text/css; charset: UTF-8');
include('../classes/text.class.php');
session_start();

switch($_SESSION['char_count']) {
  case 4: 
    $width = 1.5;
    $height = 1.7;
    break;
  case 5: 
    $width = 1.4;
    $height = 1.6;
    break;
  case 6: 
    $width = 1.3;
    $height = 1.5;
    break;
  case 7: 
    $width = 1.2;
    $height = 1.4;
    break;
  case 8: 
    $width = 1.1;
    $height = 1.3;
    break;
  case 9: 
    $width = 1;
    $height = 1.2;
    break;
  case 10: 
    $width = 0.8;
    $height = 1.1;
    break;
  case 11: 
    $width = 0.7;
    $height = 1;
    break;
  case 12: 
    $width = 0.6;
    $height = 0.9;
    break;
  case 13: 
    $width = 0.5;
    $height = 0.8;
    break;
}

$otx = new Text();
$appname = $otx->getAppName();
unset($otx);
?>

/**
 *
 * Document  
 *
 */

html {
  height: 100%;
}

body {
  margin: 0;
  height: 100%;
}


/**
 *
 * Document header 
 *
 */

.mainHeader {
  background-color: #00c;
  height: 30%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.headerContainer {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr;
}

.headerItems {
  background-color: #fff;
  color: #00c;
  width:fit-content;
  height:fit-content;
  margin: 0.4em;
  padding: 0.5em;
  font-weight: bold;
  font-size: 1.5em;
}

<?php 
for($i = 1; $i <= mb_strlen($appname); $i++) {
  $angle = -15;
  if($i % 2 == 0) {
    $angle = abs($angle);
  }
?>

.headerItems:nth-child(<?php echo $i; ?>) {
  transform: rotate(<?php echo $angle.'deg'; ?>);
}

.headerItems:hover:nth-child(<?php echo $i; ?>) {
  transform: skew(<?php echo -$angle.'deg'; ?>);
}

<?php } ?>


/**
 *
 * Document body 
 *
 */

.sectionText {
  color: #06f;
}

.sectionText > h1 {
  text-align: center;
}

.sectionText > p {
  text-align: justify;
  margin: 0 auto;
  width: 75%;
}

.game {
  background-color: #cbecff;
  display: flex;
  align-items: center;
  justify-content: center;
}

.game > div {
  margin: 15px 0;
  background-color: #007de0;
  display: grid;
}

<?php 
if($_SESSION['word_count'] == 1) {
?>

.game > div > div {
  margin: 20px;
  display: grid;
  grid-template-columns: repeat(<?php echo $_SESSION['char_count']; ?>, 1fr);
}

<?php 
}elseif($_SESSION['word_count'] == 2) {
?>

.game > div > div {
  display: grid;
  grid-template-columns: repeat(<?php echo $_SESSION['char_count']; ?>, 1fr);
}

.game > div > div:first-child {
  margin: 20px 20px 10px 20px;
}

.game > div > div:last-child {
  margin: 10px 20px 20px 20px;
}

<?php 
}elseif($_SESSION['word_count'] > 2) {
?>

.game > div > div {
  display: grid;
  grid-template-columns: repeat(<?php echo $_SESSION['char_count']; ?>, 1fr);
}

.game > div > div:first-child {
  margin: 20px 20px 10px 20px;
}

.game > div > div:last-child {
  margin: 10px 20px 20px 20px;
}

<?php 
  for($i = 2; $i < $_SESSION['word_count']; $i++) {
?>

.game > div > div:nth-child(<?php echo $i; ?>) {
  margin: 10px 20px;
}

<?php 
  } 
}
?>

.game > div > div > div {
  background-color: #fff;
  color: #007de0;
  margin: 0.1em;
  padding: 0.2em;
  width: <?php echo $width; ?>em;
  height: <?php echo $height; ?>em;
  text-align: center;
}

.alphabet {
  background-color: #ebf8ff;
  display: flex;
  align-items: center;
  justify-content: center;
}

.alphabet > div {
  margin: 25px 0;
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;			// grid-template-columns: 1fr 1fr 1fr 1fr;  - ak pridám v abecede dz 
}

.alphabet > div > div {
  background-color: #4aafff;
  color: #fcfcfc;
  margin: 0.17em;
  padding: 0.4em;
  font-size: 1.5em;
  text-align: center;
}




/*
						.bg {
  							background-color: #4aafff;
						}

						.bg-used {
							background-color: #f00;
						}
*/



.chooseLevel {
  background-color: #6cf;
  color: #fff;
  display: none;
}

.chooseLevel > h3 {
  text-align: center;
  padding-top: 0.75em;
}

.chooseLevel > [type=radio] {
  cursor: pointer;
}

.chooseLevel > label {
  cursor: pointer;
  line-height: 2em;
  padding-left: 0.5em;
}

.chooseLevel > p {
  color: #0f25a1;
  text-align: center;
  font-weight: bold;
  font-size: 1.2em;
}

.chooseLevel > [type=submit] {
  background-color: #0af;
  color: #fff;
  border: none;
  width: 100%;
  padding: 0.75em 0;
  font: inherit;
  cursor: pointer;
  border: none;
  outline: none;
}

.mainSection {
  height: 40%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.sectionContainer {
  display: grid;
  grid-gap: 1em;
}

.btn {
  background-color: #06f;
  color: #fff;
  border: none;
  padding: 1em 2em;
  font: inherit;
  cursor: pointer;
  border: none;
  outline: none;
}

.btn:active {
  outline: 2px solid #fff;
  outline-offset: -2px;
}