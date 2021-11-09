<?php
    session_start();
    $count=0;
    
    if(!empty($_POST['id-productAddCart'])){
        if(isset($_SESSION['cart'])){
            $item_array_col = array_column($_SESSION['cart'],"id_product");
            if(in_array($_POST['id-productAddCart'],$item_array_col)){
                $count = count($_SESSION['cart']);
            }
            else{
                $count = count($_SESSION['cart']);
                $item = array(
                    'id_product'=>$_POST['id-productAddCart']
                );
                $_SESSION['cart'][$count] = $item;
                $count ++;
            }
         
        }
        else{
            $item = array(
                'id_product'=>$_POST['id-productAddCart']
            );
            $_SESSION['cart'][0] = $item;
            $count = 1;
        }
    }

?>


               
                    
<a href="#" class="header-option__item__link cart-nav-bar">
    <i class="header-option__item__icon fas fa-shopping-bag"></i>
    <div id="notification-add-cart">
        <p><?php echo $count ?></p>                                          
    </div>
</a>
