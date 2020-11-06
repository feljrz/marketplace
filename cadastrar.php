<?php

    session_start();
    require_once("./php/CreateDb.php");

    $database = new CreateDb("Product_db", "Client_tb");

    $error = '';
    if (isset($_POST['register'])){

        if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])){
            echo"<script>alert('Informação(s) Invalida(s)')</script>";
            echo"<script>window.location = 'cadastrar.php'</script>";

        }

       $username = $_POST['username'];
       $email = $_POST['email'];
       $address = $_POST['address'];
       $num = $_POST['num'];
       $password = $_POST['password'];

       //print_r("$username, $email, $address, $num, $password");

        //Estabelecendo conexão
       $con = mysqli_connect("localhost","felipe","1235");

       if(!$con){
            die("Connection Failed:" .mysqli_connect_error());
        }

        //Selecionando Database
       $db = mysqli_select_db($con, "Product_db");
       $sql = "SELECT * FROM Client_tb WHERE client_email='$email' AND client_pass ='$password'";
       
       $result = mysqli_query($con, $sql);
       $rows = mysqli_num_rows($result);

       if($rows == 1){
            echo "<script>alert('Usuário já cadastrado')</script>";
            echo "<script>window.location = 'cadastrar.php'</script>";
       }
       else{
            $sql = "INSERT INTO Client_tb (client_name, client_email, client_address, client_num, client_pass) VALUES 
            ('$username', '$email', '$address', $num, '$password');";
            if(!mysqli_query($con, $sql)){
                echo "Erro inserindo na tabela:".mysqli_error($con);
            }
            else{
                echo "<script>alert('Cadastro realizado com sucesso')</script>";
                echo "<script>window.location = 'cadastrar.php'</script>";
                }
                
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
                    <form class="form-signin" name="registration" method="post">
                        <img class="mb-4" src="upload/icon.png" style="background: white;" alt="icon" width="72" height="72">
                        <h1 class="h3 mb-3 font-weight-normal">Faça o Cadastro</h1>
                        <label for="inputName" class="mt-2">Nome</label>
                        <input type='text' name='username' id="inputName" class="form-control" placeholder="Nome Completo" required autofocus>

                        <label for="inputEmail" class="mt-2">Email</label>
                        <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Email" required>
                        
                        <label for="inputAddress" class="mt-2">Endereço</label>
                        <input type="text" name="address" id="inputAddress" class="form-control" placeholder="Endereço" required>
                        
                        <label for="inputNum" class="mt-2">Número</label>
                        <input type="number" name="num" id="inputNum" class="form-control" placeholder="Número" required>

                        <label for="inputPass" class="mt-2">Senha</label>
                        <input type="password" name="password" id="inputPass" class="form-control" placeholder="Senha" required>
                        
                        <button class="btn btn-lg btn-primary btn-block mt-4" type="submit" name="register">Cadastrar</button>
                    </div>
                    </form>
                </div>
            </div>

                  </body>
            
        <?php
            require_once("php/footer.php");
        ?>
   
    </body>
</html>