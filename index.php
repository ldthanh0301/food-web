<?php 
    require_once './database/database.php';
   
    session_start();
    $db = Database::getInstance();
    $con = $db->connectDB;
    //lấy loai hàng hóa
    $result = $con->query('SELECT * FROM `hanghoa`as hh JOIN hinhhanghoa as hhh ON hh.MSHH = hhh.MSHH');// 
    $products =$result->fetch_all(MYSQLI_ASSOC);
    
    //cart count product
    $count=0;
    if(isset($_SESSION['cart'])){
        $count = count($_SESSION['cart']);
    }
    else{
        $count = 0;
        $_SESSION['cart']=[];
    }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YummyYummy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/font/fontawesome-5.15.4-web/fontawesome-free-5.15.4-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/slider.css">
    <link rel="stylesheet" href="./assets/css/newstyles.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- SCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div id="app">
        <!-- header -->
        <?php include_once('./partitions/header.php')?>
        <!-- main -->
        <main id="main">
            <div class="container-fluid container-fluid--max-width">
                <!-- Begin: Slider -->
                <?php include_once('./partitions/slider.php')?>
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
                <!-- socials activity -->
                <!-- <div class="main-content">
                    <a class="main-content__link mb-4" href="#"><i class="fas fa-sync-alt"></i>Xem thêm nhiều tin khác</a>
                    <img  class="main-content__img img-fluid mb-3" src="./assets/img/socials/intagram.jpg" alt="ảnh">
                    <div class="row row-sm mb-2">
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products//vuong/hinh4.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh8.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh3.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh4.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh5.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh6.jpg" alt="ảnh">
                        </div>
                    </div>
                    <div class="row row-sm mb-2">
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products//vuong/hinh4.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh8.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh3.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh4.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh5.jpg" alt="ảnh">
                        </div>
                        <div class="col-2 col-sm">
                            <img class="img-fluid" src="./assets/img/products/vuong/hinh6.jpg" alt="ảnh">
                        </div>
                    </div>
                </div> -->
                <!-- End:Main content -->
            </div>

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
        <?php include_once('./partitions/footer.php')?>
    </div>
    <!-- Boostrap Script -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js">       
    </script>
    <!-- main js -->
    <script src="./assets/js/main.js"></script>
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