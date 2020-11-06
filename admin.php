<?php
    session_start();
    require_once("./php/CreateDb.php");
    require_once("./php/component.php");
    $database = new CreateDb("Product_db", "Product_tb");
    $database2 = new CreateDb("Product_db", "Client_tb");

    

    if(isset($_POST['prod_register'])){
        $prod_name = $_POST['prod_name'];
        $prod_img = $_POST['prod_img'];
        $prod_price = $_POST['prod_price'];
        $prod_qtd = $_POST['prod_qtd'];

        $con = mysqli_connect("localhost","felipe","1235");
        
        if(!$con){
            die("Connection Failed:" .mysqli_connect_error());
        }

        $db = mysqli_select_db($con, "Product_db");
        $sql = "INSERT INTO Product_tb(product_name, product_price, product_image, product_qtd) VALUES
         ('$prod_name', $prod_price, '$prod_img', $prod_qtd);";
         
        if(!mysqli_query($con, $sql)){
            echo "Erro inserindo na tabela:".mysqli_error($con);
        }
        else{
            echo "<script>alert('Cadastro realizado com sucesso')</script>";
            echo "<script>window.location = 'admin.php'</script>";
            }
            
    }

    if (isset($_POST['register'])){

        if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])){
            echo"<script>alert('Informação(s) Invalida(s)')</script>";
            echo"<script>window.location = 'amdin.php'</script>";

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
                echo "<script>window.location = 'admin.php'</script>";
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
    <body>
        <!--Barra de Navegação-->
        <?php
            require_once('php/header.php');
        ?>
    <div class="container-fluid ">
            
        <div class="pt-4"> <h3>Administrador</h3>

                <div class="row  justify-content-center mt-4">
                        <div class="col-5 mb-3 mr-5">
                            <h5>
                                Cadastrar Produto
                            </h5>
                            <form class="form-signin" name="prod_cad" method="post">
                                <label for="inputName" class="py-2">Nome do Produto</label>
                                <input type='text' name='prod_name' id="inputName" class="form-control" placeholder="Nome do Produto" required autofocus>

                                <label for="inputImage" class="py-2">Endereço da Imagem</label>
                                <input type="text" name="prod_img" id="inputImage" class="form-control" placeholder="Endereço da Imagem" required>

                                <label for="inputPrice" class="py-2">Preço</label>
                                <input type="number" name="prod_price" id="inputPrice" class="form-control" placeholder="Preço" required>

                                <label for="inputQtd" class="py-2">Quantidade</label>
                                <input type="number" name="prod_qtd" id="inputQtd" class="form-control" placeholder="Quantidade" required>


                                <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="prod_register">Cadastrar</button>
                        </div>
                            </form>
                        
                        <div class="col-5 ">
                            <h5>Produtos cadastrados</h5>
                            <div class="row text-center">
                                <?php 
                                
                                    $result = $database->getData();
                                    while($row = mysqli_fetch_assoc($result)){
    
                                        listItems($row["product_name"], $row['product_price'], $row['product_qtd']);
                                    }
                                    
                                ?>
                            </div>
                        </div>
                </div>
            <div class="row  justify-content-center mt-2 mb-5">
                <div class="col-5 ">
                        <h5>Usuários</h5>
                        <div class="row text-center">
                            <?php 
                            
                                $result = $database2->getData();
                                while($row = mysqli_fetch_assoc($result)){
                                    listUsers($row["client_name"], $row['client_email'], $row['client_address'], $row['client_num']);
                                }
                                
                            ?>
                        </div>
                </div>

                <div class="col-5 ">
                    <h5>Cadastro (ADM)</h5>
                    <form class="form-signin" name="registration" method="post">
                            <label for="inputName">Nome</label>
                            <input type='text' name='username' id="inputName" class="form-control" placeholder="Nome Completo" required autofocus>

                            <label for="inputEmail" >Email</label>
                            <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Email" required>
                                
                            <label for="inputAddress">Endereço</label>
                            <input type="text" name="address" id="inputAddress" class="form-control" placeholder="Endereço" required>
                                
                            <label for="inputNum">Número</label>
                            <input type="number" name="num" id="inputNum" class="form-control" placeholder="Número" required>

                            <label for="inputPass">Senha</label>
                            <input type="password" name="password" id="inputPass" class="form-control" placeholder="Senha" required>
                                
                            <button class="btn btn-lg btn-primary btn-block mt-1" type="submit" name="register">Cadastrar</button>
                        
                        </form>
                    </div>
            </div>

        </div>
    </div>  

    

        <?php
            require_once("php/footer.php");
        ?>
    </body>
</html>