<?php


class Signin
{
  function __construct() {
    define('USER', 'root');
    define('PASSWORD', '');
    define('HOST', 'localhost');
    define('DATABASE', 'task_db');
    try {
      $GLOBALS['connection'] = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
    session_start();
  }

public function checkLogin()
{
  if(isset($_POST['button'])){
    $login = $_POST['login'];
    if(!strcmp($login, '')) {
      echo "Введите что-нибудь! Пустовато как-то..";
      return;
    }

    $query = $GLOBALS['connection']->prepare("SELECT * FROM users WHERE login=:login");
    $query->bindParam("login", $login, PDO::PARAM_STR);
    $query->execute();

    if ($query->rowCount() == 0) {
             echo 'Вы не зарегистрированы.';
         } else if (!isset($_POST['password'])) {
           echo "Введите пароль";
         }
}
}


public function passwordCheck() {

  if(isset($_POST['button'])){
    $password = $_POST['password'];
    if(!strcmp($password, '')) {
      echo "Введите что-нибудь! Пустовато как-то..";
      return;
    }



  $hashedPassword = "соль" . md5($password);
  $password = $hashedPassword;

  $query = $GLOBALS['connection']->prepare("SELECT * FROM users WHERE password=:password");
  $query->bindParam("password", $password, PDO::PARAM_STR);
  $query->execute();

  if ($query->rowCount() == 0) echo "Неверный пароль.";
  else {
    include 'Hello.php';
  }
}



}

}


  ?>
