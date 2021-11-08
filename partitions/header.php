<?php if (!isset($_SESSION)) session_start() ?>
<header id="header">
            <div class="header-wrapper">
                <div class="container">
                    <div class="header-main">
                        <a href="./" class="header-brand">
                            <img class="header-brand__img" src="./assets/img/logo/yummy2.png" alt="Logo yame">
                        </a>
                        <nav class="navbar">
                            <ul class="navbar__menu">
                                <li class="navbar__menu-item">
                                    <a href="index.php" class="navbar__menu-item__link">Home</a>
                                </li>
                                
                                <li class="navbar__menu-item navbar__menu-item--dropdown">
                                    <a href="list-products.php" class="navbar__menu-item__link">
                                        Food
                                        <i class="navbar__menu-item__icon fas fa-chevron-down"></i>
                                    </a>
                                </li>
                                <li class="navbar__menu-item navbar__menu-item--dropdown">
                                    <a href="#" class="navbar__menu-item__link">
                                        Blogs
                                        <i class="navbar__menu-item__icon fas fa-chevron-down"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="header-option">
                            <ul class="header-option__list">
                                
                                <li class="header-option__item" id="addcart-nav">
                                    <a href="shoppingCart.php" class="header-option__item__link cart-nav-bar">
                                        <i class="header-option__item__icon fas fa-shopping-bag"></i>
                                        <div id="notification-add-cart">
                                            <p><?php echo $count ?></p>
                                           
                                        </div>
                                    </a>
                                </li>
                               
                                <li class="dropdown header-option__item">
                                    <button class="header-option__item__link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="header-option__item__icon far fa-user"></i>
                                        <span><?php if(isset($_SESSION['HoTenKH'])) echo $_SESSION['HoTenKH'];?></span>
                                    </button>
                                    <div class="dropdown-menu" style="transform: translate3d(-30px, 40px, 0px)" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="editprofile.php">Thông tin tài khoản</a>
                                        <hr>
                                        <?php
                                            if(isset($_SESSION['username'])) {
                                                echo "<a class='dropdown-item' href='./logout.php'>Đăng xuất</a>";
                                            } else {
                                                echo "<a class='dropdown-item' href='./login.php'>Đăng nhập</a>";
                                                echo "<a class='dropdown-item' href='./register.php'>Đăng ký</a>";
                                            }
                                        ?>
                                        
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        