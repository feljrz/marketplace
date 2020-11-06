<?php
//Criando um sessão com o ID do produto para o carrinho
session_start();

require_once("./php/CreateDb.php");
require_once("./php/component.php");

//Instanciando CreateDb

$database = new CreateDb("Product_db", "Product_tb");

//Pois o botão foi definido como add
if(isset($_POST['add'])){
    //print_r($_POST['product_id'])
    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "product_id");
        //print_r($item_array_id);

        if(in_array($_POST['product_id'], $item_array_id)){
            echo"<script>alert('Produto já foi adicionado')</script>";
            echo"<script>window.location = 'index.php'</script>";
        }
        else{
            //Numero de elementos no array
            $count = count($_SESSION['cart']);
            $item_array = array('product_id'=>$_POST['product_id']);

            $_SESSION['cart'][$count] = $item_array;
            //print_r($_SESSION['cart']);
        }
        
    }
    else{
        $item_array = array('product_id'=>$_POST['product_id']);

        //Criando uma nova sessão válida

        $_SESSION['cart'][0] = $item_array;
        //print_r($_SESSION['cart']);


    }
}

?>

<!doctype html>
<html lang="en">
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

    <?php
        require_once("php/header.php")
    ?>
        <div class="container">
            <div class="row text-center">
                
            <div class="col-md-5">
                    <form action='index.php' method="post">
                        <input type="radio" name='filter' class="ml-2 mr-2" value="All"> All
                        <input type="radio" name='filter' class="ml-2 mr-2" value="Fude"> Fude
                        <input type="radio" name='filter' class="ml-2 mr-2" value="Ballpoint"> Ballpoint
                        <input type="radio" name='filter' class="ml-2 mr-2" value="RollerBall"> RollerBall
                        
                        <button  name="btn-filter" class="btn btn-success ml-2" type="submit"> Filtrar</button>

                    </form>
                    


                </div>
            </div>
            
            <div class="row text-center py-5">
            <?php 
                    if(isset($_POST['btn-filter'])){
                        $filter = $_POST['filter'];
                        
                    

                    $result = $database->getData();
                    while($row = mysqli_fetch_assoc($result)){
                        if($filter != 'All' and (strpos($row["product_name"], $filter) !== false)){
                        component($row["product_name"], $row['product_price'], $row['product_image'], $row['id']);
                        }
                        elseif($filter == 'All'){
                            component($row["product_name"], $row['product_price'], $row['product_image'], $row['id']);
                        }
                    }
                }else{
                    $result = $database->getData();
                    while($row = mysqli_fetch_assoc($result)){
                        component($row["product_name"], $row['product_price'], $row['product_image'], $row['id']); 
                    }
                }
                ?>
            </div>
        </div>

    <?php
        require_once("php/footer.php");
    ?>
  </body>
</html>