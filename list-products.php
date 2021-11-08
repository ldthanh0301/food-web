<?php 
    require_once './database/database.php';
    
    $db = Database::getInstance();
    $con = $db->connectDB;
    //lấy loai hàng hóa
    $result = $con->query('SELECT * FROM `hanghoa`as hh JOIN hinhhanghoa as hhh ON hh.MSHH = hhh.MSHH');// 
    $products =$result->fetch_all(MYSQLI_ASSOC);

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
    <title>Yame shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/font/fontawesome-5.15.4-web/fontawesome-free-5.15.4-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/newstyles.css">

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
                    <span class="title-list-product">Danh sách sản phẩm</span>
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
                                        <button class="btn btn-sm btn-primary add-cart" id-product="<?php echo $product['MSHH'] ?>">Thêm vào giỏ</button>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <hr>
               
           
               
            </div>
        </main>
        <!-- Footer -->
        <?php include_once('./partitions/footer.php')?>
    </div>
    <!-- Boostrap Script -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).on('click','.add-cart',function(){
            var idProductAddcart = $(this).attr('id-product');
            console.log('123');
            $.ajax({
                url:'./ajax/ajaxAddCart.php',
                type:"post",
                data:{
                    'id-productAddCart' : idProductAddcart,
                },
                success:function(fetch_result){
                    $('#addcart-nav').html(fetch_result);           
                },
            })
        })
    </script>
</body>
</html>