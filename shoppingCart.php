<?php
    session_start();
    $count=0;
    if(isset($_SESSION['cart'])){
        $count = count($_SESSION['cart']);
    }
    else{
        $count = 0;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- style -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/font/fontawesome-5.15.4-web/fontawesome-free-5.15.4-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/newstyles.css">

    
    <!-- SCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
    <?php include_once('./partitions/header.php')?>
    <h1 class="shopping-cart-title">SHOPPING CART</h1>
    <div class="container"  id="result-fetch-cart">
        <div class="row row-justify-evenly">
            <!-- lấy danh sách sản phẩm trong giỏ hàng -->
            <?php 
                include_once('./ajax/displayCarts.php')
            ?>      
        </div>
        <hr>
        <button class="btn btn-danger btn-lg float-right">Đặt hàng </button>     
        <div class="clearfix mb-4"></div>     
    </div>



    <div class="follow-with-sliderImage">
                <div class="ig-follow">
                    <p class="title-ig-follow">FOLLOW US ON INSTAGRAM</p>
                    <p class="icon-ig"><a href="https://www.instagram.com/ng.hoaitan/"><i class="fab fa-instagram"></i></a></p>
                </div>
               
                <div class="slider-arrival">
                            <div class="slicker-item-arrival">
                                <img src="./assets/img/products/food1.jpg" alt="">
                            </div>
                            <div class="slicker-item-arrival">
                                <img src="./assets/img/products/food1.jpg" alt="">
                            </div>
                            <div class="slicker-item-arrival">
                                <img src="./assets/img/products/food1.jpg" alt="">
                            </div>
                            <div class="slicker-item-arrival">
                                <img src="./assets/img/products/food1.jpg" alt="">
                            </div>
                            <div class="slicker-item-arrival">
                                <img src="./assets/img/products/food1.jpg" alt="">
                            </div>
                            <div class="slicker-item-arrival">
                                <img src="./assets/img/products/food1.jpg" alt="">
                            </div>
                            <div class="slicker-item-arrival">
                                <img src="./assets/img/products/food1.jpg" alt="">
                            </div>
                            <div class="slicker-item-arrival">
                                <img src="./assets/img/products/food1.jpg" alt="">
                            </div> 
                            <div class="slicker-item-arrival">
                                <img src="./assets/img/products/food1.jpg" alt="">
                            </div>
                </div>
    </div>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js">       
    </script>
     <script type="text/javascript">
        $('.slider-arrival').slick({
            autoplay: true,
            autoplaySpeed: 3000,
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 5,
            arrows: true,
            prevArrow:$('.prev-item-arrival'),
            nextArrow:$('.next-item-arrival')
        });
        function handleRemoveProductFromCart(index) {
            // xóa sản phẩm
            $.get("./ajax/cart.php",{action:'remove',index:index},function(carts) {
                let root= $('#table_list_item');
                carts = JSON.parse(carts);
                if(carts.status ==0) {
                    alert(carts.message);
                    return 0
                }
                // chỉ lại giỏi hàng TRên header 
                addListProductToCart(carts)
                // hiển thị giỏi hàng chính
                displayCarts(carts,root);
            })
        }
        function calTotalPrice(e){
            console.log(e.dataset.index)
            let index = e.dataset.index;
            let quantity = e.value;
            
            $.get('./ajax/cart.php',{action:'update',index:index,quantity:quantity},function(data) {
                $('#result-fetch-cart').html(data);
                // location.reload();
            })
        }

    </script>
   <script src="./assets/js/main.js"></script>
</body>
</html>