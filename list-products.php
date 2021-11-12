<?php 
    require_once './database/database.php';
    
    $db = Database::getInstance();
    $con = $db->connectDB;
    //lấy loai hàng hóa
    $result = $con->query('SELECT * FROM `hanghoa`as hh JOIN hinhhanghoa as hhh ON hh.MSHH = hhh.MSHH');// 
    $products =$result->fetch_all(MYSQLI_ASSOC);

    session_start();
?>
<!-- head -->
<?php 
    $title = "Danh sách sản phẩm";
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
                

                <!-- Begin:Main content -->
                <div class="main-content">
                    <span class="title-list-product">Danh sách sản phẩm</span>
                    <!--  List product -->
                    <div class="list-products">
                    <div class="row">
                        <?php foreach($products as $product) { ?>
                        <div class="col-4">
                            <div  class="product-card">
                                <a href="./detail-product.php?id=<?php echo $product['MSHH']?>">
                                    <img class="product-card__img" src="./products-img/<?php echo $product['TenHinh'] ?>" alt="<?php echo $product['TenHH'] ?>" >
                                </a>
                                <p class="product-card__name"><?php echo $product['TenHH']?></p>
                                <div class="product-card__option">
                                    <span class="product-card__price"><?php echo number_format($product['Gia'])?></span>
                                    <button class="btn btn-sm btn-danger" onclick="addToCart('<?php echo $product['MSHH']?>')" >Thêm vào giỏ</button>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <hr>
            </div>
        </main>
        <!-- Footer -->
        <?php include_once('./partials/footer.php')?>
    </div>
   <!-- script -->
   <?php include_once('./partials/scriptLink.php')?>
   
    <!-- <script type="text/javascript">
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
    </script> -->
</body>
</html>