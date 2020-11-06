<?php

function component($productname, $productprice, $productimg, $productid){
    $element = " <div class='col-md-3 col-sm-6 my-3 my-md-0'>
    <form action='index.php' method='post'>
        <div class='card shadow'>
                <div>
                    <img src='$productimg' alt='image-1' class='img-fluid card-img-top'>
                </div>

            <div class='card-body'>
                <h5 class='card-title'>$productname</h5>
                <h6>
                    <i class='fas fa-star'></i>
                    <i class='fas fa-star'></i>
                    <i class='fas fa-star'></i>
                    <i class='fas fa-star'></i>
                    <i class='far fa-star'></i>
                </h6>
                <h5>
                    <span class='price'>R$ $productprice</span>
                <h5>

                <button type='submit' class='btn btn-warning my-3' name='add'>Adicionar ao carrinho<i class='fas fa-shopping-cart'></i></button>
                <input type='hidden' name='product_id' value='$productid'>
            </div>
        </div>
    </form>
</div>
    
    ";
    
    echo $element;
    
}


function cartElement($productimg, $productname, $productprice, $productid){
    $element="<form action='cart.php?action=remove&id=$productid' method='post' class='cart-itens'> 
    <div class='border rounded'>
        <div class='row bg-white'>
            <div class='col-md-3 pl-0'>
                <img src=$productimg alt='Image' class='img-fluid'>
            </div>
            <div class='col-md-6'>
                <h5 class='pt-2'>$productname</h5>
                <small class='text-secondary'>Vendedor: Canetolândia </small>
                <h5 class='pt-2'>R$ $productprice</h5>
                <button type='submit' class='btn btn-danger mx-2' name='remove'><i class='fas fa-trash-alt'></i> Remover</button>
            </div>
            <form action='cart.php?action=buy&id=$productid' method='post'>
            <div class='col-md-3 py-5'>
                <div>
                 <button type='button' class='btn bg-light border rounded-circle minus-btn'><i class='fas fa-minus'></i></button>
                 <input type='text' value='1' name='quantity' class='form-control w-25 d-inline' id='inp-quantity'>
                 <button type='button' class='btn bg-light border rounded-circle plus-btn'><i class='fas fa-plus'></i></button>

             </div>
             </form>
            </div>
        </div>
    </div>
</form>";

echo $element;
}

function listItems($productname, $productprice, $productqtd){
    $element = "
    <div class='col-md-4 py-2'>
         <div class='border-bottom'>
            $productname
        </div>
    </div>

    <div class='col-md-4 py-2'>
        
        <div class='border-bottom'>
            R$ $productprice
        </div>
    </div>

    <div class='col-md-4 py-2'>
        
        <div class='border-bottom'>
            $productqtd
        </div>
    </div>
    ";
    echo $element;

}

function listUsers($username, $email, $address, $number){
    $element = "
    <div class='col-md-3'>
         <div class='border-bottom'>
            $username
        </div>
    </div>

    <div class='col-md-3'>
        
        <div class='border-bottom ml-3 mr-3'>
            $email
        </div>
    </div>

    <div class='col-md-3'>
        
        <div class='border-bottom'>
            $address
        </div>
    </div>

    <div class='col-md-3'>
        
        <div class='border-bottom'>
            $number
        </div>
    </div>
    ";
    echo $element;

}





?>

