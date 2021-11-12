<?php 
    require_once './database/database.php';
   
    session_start();
    $db = Database::getInstance();
    $con = $db->connectDB;
    //lấy loai hàng hóa
    $result = $con->query('SELECT * FROM `hanghoa`as hh JOIN hinhhanghoa as hhh ON hh.MSHH = hhh.MSHH');// 
    $products =$result->fetch_all(MYSQLI_ASSOC);
?>

<!-- head -->
<?php 
    $title = "Yummy Yummy";
    include_once('./partials/head.php') 
?>
<!-- head -->
<body>
    <div id="app">
        <!-- header -->
        <?php include_once('./partials/header.php')?>
        <!-- main -->
        <main id="main">
            <div class="container-fluid container-fluid--max-width">
                <!-- Begin: Slider -->
                <?php include_once('./partials/slider.php')?>
               <!-- End: Slider-->

                <!-- Begin:Main content -->
                <div class="main-content">
                    <span class=main-content__title>Top sản phẩm bán chạy</span>
                    <span class=main-content__sub-title>Đừng bỏ lỡ hãy mua ngay</span>
                    <!--  List product -->
                    <div class="list-products">
                        <div class="row">
                            <?php foreach($products as $product) { ?>
                            <div class="col-3">
                                <div  class="product-card">
                                    <a href="./detail-product.php?id=<?php echo $product['MSHH']?>">
                                        <img class="product-card__img" src="./products-img/<?php echo $product['TenHinh'] ?>" alt="<?php echo $product['TenHH'] ?>" >
                                    </a>
                                    <div class="product-card__option">
                                        <span class="product-card__price"><?php echo $product['Gia'] ?></span>
                                        <button class="btn btn-sm btn-danger" onclick="addToCart('<?php echo $product['MSHH']?>')" >Thêm vào giỏ</button>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- deal product -->
                <div class="main-content">
                    <span class=main-content__title>Các chương trình khuyến mãi</span>
                    <span class=main-content__sub-title>Đừng bỏ lỡ các chương trình khuyến mãi Hot tại Yame.vn</span>
                    <div class="list-products-sale">
                        <div class="row">
                            <div class="col-6">
                                <div class="product-sale">
                                    <img src="./assets/img/banner/banner_sale1.jpg" alt="ảnh" class="product-sale__img">
                                    <span class="product-sale__title">FLASH SALE THÁNG 11</span>
                                    <span class="product-sale__info">Time: 20 - 26/11/2021</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="product-sale">
                                    <img src="./assets/img/banner/banner_sale2.jpg" alt="ảnh" class="product-sale__img">
                                    <span class="product-sale__title">FLASH SALE THÁNG 11</span>
                                    <span class="product-sale__info">Time: 20 - 26/11/2021</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            <!-- slider move with these image -->
            <div class="new-arrival">
                <div class="new-arrival-wrapper">
                    
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
                    <button class="prev-item-arrival"><i class="fas fa-chevron-circle-left"></i></button>
                    <button class="next-item-arrival"><i class="fas fa-chevron-circle-right"></i></button>
                    <div class="arrival-title">
                        <h2>New Arrival</h2>
                    </div>
                   
                    <p>Explore the latest products in our collection</p>
                    <button class="btn-shop-now">
                        <div class="icon-btn-shopnow"><i class="fas fa-chevron-right"></i></div>
                        <span>Let's Go</span>
                    </button>
                    </div>
            </div>
        </main>
        <!-- Footer -->
        <?php include_once('./partials/footer.php')?>
    </div>
    <!-- script -->
    <?php include_once('./partials/scriptLink.php')?>
    <!-- Boostrap Script -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

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
    </script>
</body>
</html>