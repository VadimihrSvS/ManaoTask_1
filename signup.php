<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <?php include("SignupData.php");
    $obj = new SignupData();
     ?>

    <form action="signup.php" method="POST">
      <a href="login.php">Вход</a>
      <p>Логин: </p>
      <input type="text" name="login">
      <?php $obj->checkLogin();?>
      <p>Пароль: </p>
      <input type="password" name="password">
      <?php $obj->checkPassword();?>
      <p>Подтвердите пароль: </p>
      <input type="password" name="password_confirm">
      <?php $obj->samePassword();?>
      <p>Электронная почта: </p>
      <input type="email" name="email">
      <?php $obj->checkEmail();?>
      <p>Ваше имя: </p>
      <input type="text" name="name">
      <?php $obj->checkName();?>
      <br>
      <button type="submit" name="button">Готово</button>
    </form>
  </body>
</html>
