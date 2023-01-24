
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php include("SignIn.php");
$obj = new SignIn();
    ?>
    <a href="signup.php">Регистрация</a>
    <form action="login.php" method="POST">
      <p>Логин: </p>
      <input type="text" name="login">
      <?php $obj->checkLogin();?>
      <p>Пароль: </p>
      <input type="password" name="password">
      <?php $obj->passwordCheck();?>
      <br>
      <button type="submit" name="button">Готово</button>

</form>
  </body>
</html>
