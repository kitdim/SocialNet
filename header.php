<?php 
  session_start();

echo <<<_INIT
<!DOCTYPE html> 
<html>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'> 
    <link rel='stylesheet' href='jquery/jquery.mobile-1.4.5.min.css'>
    <link rel='stylesheet' href='css/styles.css' type='text/css'>
    <script src='js/javascript.js'></script>
    <script src='jquery/jquery-2.2.4.min.js'></script>
    <script src='jquery/jquery.mobile-1.4.5.min.js'></script>

_INIT;

  require_once 'functions.php';

  $userstr = 'Привет гость';

  if (isset($_SESSION['user']))
  {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = "Зашёл как: $user";
  }
  else $loggedin = FALSE;

echo <<<_MAIN
    <title>Basyaks: $userstr</title>
  </head>
  <body>
    <div data-role='page'>
      <div data-role='header'>
        <div id='logo' class='center'>Basyaks<img id='shark' src='images/shark.gif'></div>
        <div class='username'>$userstr</div>
      </div>
      <div data-role='content'>

_MAIN;

  if ($loggedin)
  {
echo <<<_LOGGEDIN
        <div class='center'>
          <a data-role='button' data-inline='true' data-icon='home'
            data-transition="slide" href='members.php?view=$user'>Главная</a>
          <a data-role='button' data-inline='true' data-icon='user'
            data-transition="slide" href='members.php'>Участники</a>
          <a data-role='button' data-inline='true' data-icon='heart'
            data-transition="slide" href='friends.php'>Друзья</a><br>
          <a data-role='button' data-inline='true' data-icon='mail'
            data-transition="slide" href='messages.php'>Сообщения</a>
          <a data-role='button' data-inline='true' data-icon='edit'
            data-transition="slide" href='profile.php'>Изменить профиль</a>
          <a data-role='button' data-inline='true' data-icon='action'
            data-transition="slide" href='logout.php'>Выйти</a>
        </div>
        
_LOGGEDIN;
  }
  else
  {
echo <<<_GUEST
        <div class='center'>
          <a data-role='button' data-inline='true' data-icon='home'
            data-transition='slide' href='index.php'>Главная</a>
          <a data-role='button' data-inline='true' data-icon='plus'
            data-transition="slide" href='signup.php'>Регистрация</a>
          <a data-role='button' data-inline='true' data-icon='check'
            data-transition="slide" href='login.php'>Войти</a>
        </div>
        <p class='info'>(Для входа нужен аккунт, если его нет пройдите регистрацию)</p>
        
_GUEST;
  }
?>
