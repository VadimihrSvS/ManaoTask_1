<?php

$GLOBALS['loginChecked'] = false;
$GLOBALS['passwordChecked'] = false;
$GLOBALS['samePassChecked'] = false;
$GLOBALS['emailChecked'] = false;
$GLOBALS['nameChecked'] = false;


class SignupData{

  function __construct() {







    define('USER', 'root');
    define('PASSWORD', '');
    define('HOST', 'localhost');
    define('DATABASE', 'task_db');
    session_start();
    try {
      $GLOBALS['connection'] = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
  }

public function checkLogin() {

  $GLOBALS['loginChecked'] = false;

  $pattern = '/^[a-z0-9A-Z]{6,}$/';

  if(isset($_POST['button'])) {
      $login = $_POST['login'];
    if(!strcmp($_POST['login'], '')) {
      echo "Введите что-нибудь! Пустовато как-то..";
      return;
    }


   $query = $GLOBALS['connection']->prepare("SELECT * FROM users WHERE login=:login");
   $query->bindParam("login", $login, PDO::PARAM_STR);
   $query->execute();

    if ($query->rowCount() > 0) {
             echo 'Этот логин уже зарегистрирован!';
         } elseif(!preg_match($pattern, $login)){
           echo "Введите корректный логин(6 и более символов)";
         } else {
           $GLOBALS['loginChecked'] = true;
         }
  }





}

public function checkPassword(){
  $GLOBALS['passwordChecked'] = false;


  $pattern = '/^(?=.*[0-9])(?=.*[a-zA-Z])[0-9a-zA-Z]{6,}$/';

    if(isset($_POST['button'])){
$password = $_POST['password'];
if(!strcmp($password, '')) {
  echo "Введите что-нибудь! Пустовато как-то..";
  return;
}

if(!preg_match($pattern, $password)) {
echo "Введите корректный пароль (не менее 6 символов, цифры и буквы)";
} else {
$GLOBALS['passwordChecked'] = true;
}

    }

}

public function samePassword() {

  $GLOBALS['samePassChecked'] = false;

  if(isset($_POST['button'])){
      $passwordConfirm = $_POST['password_confirm'];

      if(!strcmp($passwordConfirm, '')) {
        echo "Введите что-нибудь! Пустовато как-то..";
        return;
      }

      if (strcmp($_POST['password'], $passwordConfirm) != 0) {
        echo "Пароли не совпадают.";
      } else {
        $GLOBALS['samePassChecked'] = true;
      }


}
}



public function checkEmail() {
  $GLOBALS['emailChecked'] = false;

    if(isset($_POST['button'])) {
      $email = $_POST['email'];

      if(!strcmp($email, '')) {
        echo "Введите что-нибудь! Пустовато как-то..";
        return;
      }

      $query = $GLOBALS['connection']->prepare("SELECT * FROM users WHERE email=:email");
      $query->bindParam("email", $email, PDO::PARAM_STR);
      $query->execute();

       if ($query->rowCount() > 0) {
                echo 'Этот e-mail уже зарегистрирован!';
            } else {
              $GLOBALS['emailChecked'] = true;
            }
    }

}




public function checkName() {

  $GLOBALS['nameChecked'] = false;
  $pattern = '/[a-zA-ZА-Яа-я]{2,}/';

  if(isset($_POST['button'])){
    $name = $_POST['name'];
    if(!strcmp($name, '')) {
      echo "Введите что-нибудь! Пустовато как-то..";
      return;
    }

    $GLOBALS['nameChecked'] = true;
    if(!preg_match($pattern, $name)) {
      echo "Введите корректный пароль (не менее 2 символов, только буквы)";
    } else {
      $GLOBALS['nameChecked'] = true;
    }

  }




  if($GLOBALS['loginChecked'] &&
  $GLOBALS['passwordChecked'] &&
  $GLOBALS['samePassChecked'] &&
  $GLOBALS['emailChecked'] &&
  $GLOBALS['nameChecked']) {

    $hashedPassword = 'соль' . md5($_POST['password']);

     $query = $GLOBALS['connection']->prepare("INSERT INTO users(login,password,email,name) VALUES (:login,:password,:email,:name)");
     $query->bindParam("login", $_POST['login'], PDO::PARAM_STR);
     $query->bindParam("password", $hashedPassword, PDO::PARAM_STR);
     $query->bindParam("email", $_POST['email'], PDO::PARAM_STR);
     $query->bindParam("name", $_POST['name'], PDO::PARAM_STR);
     $result = $query->execute();
       if ($result) {
           echo '<p class="success">Регистрация прошла успешно!</p>';
       } else {
           echo '<p class="error">Неверные данные!</p>';
       }

   }

}



}



 ?>
