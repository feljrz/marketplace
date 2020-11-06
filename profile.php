<?php
    session_start();
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
            
                <div class="pt-4"> <h3>Informações</h3></div>
                    <div class="row  justify-content-start mt-4">
                    <div class="col-4 ">
                        <h5 class='border-bottom py-3'>
                            Nome: <?php echo $_SESSION['login_user'];?>
                        </h5>
                        <h5 class='border-bottom py-3'>
                            Email: <?php echo $_SESSION['login_email'];?>
                        </h5 class='border-bottom py-3'>
                        <h5 class='border-bottom py-3'>
                            Endereço: <?php echo $_SESSION['login_address'];?>
                        </h5>
                        <h5 class='border-bottom py-3'>
                            Número: <?php echo $_SESSION['login_num'];?>
                        </h5>
                    </div>
        </div>
        <button class="btn btn-danger"><a href="php/logout.php">Log Out</a></button>
        <?php
            require_once("php/footer.php");
        ?>
    </body>
</html>