<?php
  session_start();

  if (isset($_POST['Login'])){

      if(empty($_POST['password']) || empty($_POST['email'])){
          echo"<script>alert('Informação(s) Invalida(s)')</script>";
          echo"<script>window.location = 'Login.php'</script>";

      }

      $email = $_POST['email'];
      $password = $_POST['password'];
      
      //Estabelecendo conexão
      $con = mysqli_connect("localhost","felipe","1235");

      if(!$con){
       die("Connection Failed:" .mysqli_connect_error());
       }

       //Selecionando Database
      $db = mysqli_select_db($con, "Product_db");
      $sql = "SELECT * FROM Client_tb WHERE client_email='$email' AND client_pass ='$password'";
      $result  = mysqli_query($con, $sql);
      $rows = mysqli_num_rows($result);
      
       /*//Informações do login
      
      }*/
      
      
      if($rows == 1){
        while($rows = mysqli_fetch_assoc($result)){
          //print_r($rows['client_address']);
          $_SESSION['l_address'] = $rows['client_address'];
          $_SESSION['login_id'] = $rows['id'];
          $_SESSION['login_user'] = $rows['client_name'];
          $_SESSION['login_email'] = $rows['client_email'];
          $_SESSION['login_address'] = $rows['client_address'];
          $_SESSION['login_num'] = $rows['client_num'];
          
         

  

          //Redirecionar para o login
          if($_SESSION['login_email'] == 'admin@admin.com'){
            header("location: admin.php");
          }
          else{
            header("location: profile.php");
          }
      }
      
    }
    else{
      print_r("Email ou Senha inválido");
    }
  
    }

?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
    <title>Canetolândia</title>
  </head>
    <body class="text-center">
         <!--Barra de Navegação-->
         <?php
            require_once('php/header.php');
         ?>
              <div class="container">
                  <div class="row justify-content-md-center">
                    <form class="form-signin" name="login" method="post">
                    <img class="mb-4" src="upload/icon.png" style="background: white;" alt="icon" width="72" height="72">
                      <h1 class="h3 mb-3 font-weight-normal">Faça Login</h1>
                      
                      <label for="inputEmail" class="mt-2">Email</label>
                        <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Email" required>
                      
                        <label for="inputPass" class="mt-2">Senha</label>
                        <input type="password" name="password" id="inputPass" class="form-control" placeholder="Senha" required>
                      
                      <button class="btn btn-lg btn-primary btn-block mt-4" type="submit" name="Login">Entrar</button>
                    </form>
                </div>
            </div>

                  </body>
        <?php
            require_once("php/footer.php");
        ?>

    </body>
</html>