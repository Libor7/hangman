/** Displays a form to user, where he can choose the level of difficulty */
function displayForm() {
  jQuery('.chooseLevel').show();
}

/** Starts new game */
function startNewGame() {
  if(document.querySelector('input[name="level"]:checked')) {
    var level = document.querySelector('input[name="level"]:checked').value;
  }else{
    return;
  }
  var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
  var url = './php/newgame.php';
  var variables = 'level=' + level;

  xhr.open('POST', url, true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

  xhr.onerror = function() {
    console.log('A problem with asynchronous call to server occured.');
  };

  xhr.send(variables);
}

/** Form validation - user has to choose a game level */
function isChecked() {
  var easy = document.getElementById('easy').checked;
  var middle = document.getElementById('middle').checked;
  var hard = document.getElementById('hard').checked;

  if(easy == false && middle == false && hard == false) {
    document.getElementById('validation').innerHTML = 'Vyberte jednu z možností';
    return false;
  }else{
    return true;
  }
}