<?php
    session_start();
    require_once("php/CreateDb.php");
    require_once("php/component.php");

    $db = new CreateDb("Product_db","Product_tb");

    if(isset($_POST['remove'])){
        if($_GET['action'] == 'remove'){
            foreach($_SESSION['cart'] as $key=> $value){
                if($value['product_id'] == $_GET['id']){
                    unset($_SESSION['cart'][$key]);
                    //echo "<script>alert('Produto removido')</script>";
                    //echo "<script>window.location = 'cart.php'</script>";
                    //print_r($_SESSION['cart']); 
                }

            }
        }
    }

    if(isset($_POST['buy'])){
        foreach($_SESSION['cart'] as $key=>$value){
            //print_r(" Session-key ".$_SESSION['cart'][$key]);
            $id_prod = (int)$value['product_id'];
            $id_login = $_SESSION['login_id'];
            $new_db = new CreateDb("Product_db","Orders_tb");
            $con = mysqli_connect("localhost","felipe","1235");

            if(!$con){
             die("Connection Failed:" .mysqli_connect_error());
             }
            
             //Selecionando Database
            $db = mysqli_select_db($con, "Product_db");
            $sql = "UPDATE Product_tb SET product_qtd = (product_qtd -1) WHERE id = $id_prod";
            $query = mysqli_query($con, $sql);


            $sql2 = "INSERT INTO Orders_tb (client_id, product_id) VALUES 
            ($id_login, $id_prod);";
             $query2 = mysqli_query($con, $sql2);
             //Retirando os itens do carrinho
             unset($_SESSION['cart'][$key]);
             echo "<script>alert('Compra Realizada com sucesso')</script>";
             echo "<script>window.location = 'index.php'</script>";
             
        }
        mysqli_close($con);
        }

   

?>


<!doctype html>
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
    <body class="bg-light">
        <?php
            require_once('php/header.php');
        ?>
    <div class="container-fluid">
        <div class="row px-5">
            <div class="col-md-7">
                <div class="shopping-cart">
                   
                   <?php
                   $total = 0;
                    if(isset($_SESSION['cart'])){

                    $product_id = array_column($_SESSION['cart'], 'product_id');
                    $result = $db->getData();
                    while ($row = mysqli_fetch_assoc($result)){
                        foreach ($product_id as $id){
                            if ($row['id'] == $id){
                                cartElement($row['product_image'], $row['product_name'],$row['product_price'], $row['id']);
                                $total = $total + (float)$row['product_price'];
                            }
                        }
                    }
                }
                else{
                    echo"<h5>O carrinho está vazio</h5>";
                }     
                   ?>
                </div>
            </div>
            <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
                <div class="pt-4">
                    <h6>Detalhes do preço</h6>
                    <hr>
                    <div class="row price-details">
                        <div class="col-md-6">
                            <?php
                                if(isset($_SESSION['cart'])){
                                    $count = count($_SESSION['cart']);
                                    echo "<h6>Preço ($count itens)</h6>";
                                }
                                else{
                                    echo "<h6>Preço Price(0 itens)</h6>";
                                }
                            ?>
                            <h6>Taxa de entrega</h6>
                            <hr>
                            <h6>Total</h6>
                        </div>
                        <div class="col-md-6">
                                <h6>R$ <?php echo$total;?></h6>
                                <h6 class="text-success">Grátis</h6>
                                <hr>
                                <h6>R$ <?php
                                    echo $total;
                                ?>
                                <hr>
                                <form action='cart.php' method='post'>
                                    <button type='submit' name="buy" class='btn btn-success py-6'>Comprar</button>
                                    <input type='hidden' name='def' value="">
                                </form>
                        </div>

                        

                    </div>
                </div>

            </div>
        </div>
    </div>
        <?php
            require_once("php/footer.php");
        ?>                         



<script src='script.js' charset="utf-8"></script>

    </body>

</html>