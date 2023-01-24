<?php

class Data

{

  function __construct($host = 'localhost',
  $db_name = 'task_db',
  $user = 'root',
  $password = '')
  {
    $connection = mysqli_connect($host, $user, $password, $db_name);
  }



   if($_SERVER['REQUEST_METHOD'] == 'POST'){


     // private $login = $_POST['login'];
     // private $password = $_POST['password'];
     // private $email = $_POST['email'];
     // private $name = $_POST['name'];


     public function checkname()
     {
       if(count($_POST['name'])) < 6 || $_POST['name'] = null) echo "Слабоватенько";
     }


    }
  }



echo "Форма как-бэ отправлена";



//
//
// $query = 'select name from users;';
//
// $result = mysqli_query($connection, $query);

?>
