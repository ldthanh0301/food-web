<?php
    session_start();
?>
<?php 
    $title = "Chi tiết giỏ hàng";
    include_once('./partials/head.php');
?>
<body>
    <?php include_once('./partials/header.php')?>
    <h1 class="shopping-cart-title">SHOPPING CART</h1>
    <div class="container"  id="result-fetch-cart">
        <div class="row row-justify-evenly">
            <!-- lấy danh sách sản phẩm trong giỏ hàng -->
            <?php 
                include_once('./ajax/displayCarts.php')
            ?>      
        </div>
        <hr>
        <a href="./order.php?action=cart" class="btn btn-danger btn-lg float-right">Đặt hàng </a>     
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
                // chỉ lại giỏi hàng TRên header 
                showCartInHeader(carts.products)
                // hiển thị giỏi hàng chính
                displayCarts(carts.products,root);
            })
        }
        function calTotalPrice(e){
            let index = e.dataset.index;
            let quantity = parseInt(e.value);
            $.get('./ajax/cart.php',{action:'update',index:index,quantity:quantity},function(carts) {
                let root= $('#table_list_item');
                carts = JSON.parse(carts);
                displayCarts(carts.products,root);

            })
        }

    </script>
    <!-- script -->
    <?php include_once('./partials/scriptLink.php')?>
</body>
</html>