<header id="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <a href="index.php" class="navbar-brand">
            <h3 class="px-5">
                <i class="fas fa-pen-fancy"></i> Canetolândia
            </h3>
        </a>
        <button class="navbar-toggler" type="button"
         data-toggle="collapse" 
         data-target="#navbarNavAltMarkup"
         arial-controls="navbarNavAltMarkup"
         aria-expanded="false"
         arial-label="Toggle navigation"
         >
         <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="mr-auto"></div>
            <div class="navbar-nav ml-auto">
                <ul class="navbar-nav ml-auto">
                        <a class= "nav-item nav-link active" href='index.php'>
                            <h5 class="px-2">
                                    <i class="fas fa-home"></i> Home
                            </h5>
                        </a>
                    <li class="nav-item">
                        <a class="nav-item nav-link active" href="login.php">
                        <h5 class="px-2">
                                    <i class="fa fa-sign-in"></i> Login
                            </h5>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-item nav-link active" href="cadastrar.php">
                            <h5 class="px-2">
                                    <i class="fas fa-user-plus"></i> Cadastrar
                            </h5>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-item nav-link active" href="profile.php">
                            <h5 class="px-2">
                                <i class="fas fa-user"></i> Perfil
                            </h5>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="cart.php" class="nav-item nav-link active">
                            <h5 class="px-2 cart">
                                <i class="fas fa-shopping-cart"></i> Carrinho
                                <?php
                                    if(isset($_SESSION['cart'])){
                                    $count = count($_SESSION['cart']);
                                    echo"<span id='cart_count' class='text-warning bg-light'>$count</span>";
                                    }
                                ?>
                            </h5>
                        </a>
                    </li>
                </ul>

            </div>
        </div>

    </nav>
</header>