<?php 
    if (!isset($_GET['action'])) {
        echo "Request thiếu action";
        die();
    }
    session_start();

    require_once './models/Product.php';
    require_once './models/Customer.php';
    require_once './models/Order.php';

    $Product = new Product();
    $Customer = new Customer();
    $Order = new Order();

    $MSKH = "";
   
    // Khi đăng nhập lấy chi tiết khách hàng
    if (isset($_SESSION['MSKH'])) {
        $MSKH =$_SESSION['MSKH'];
        $customer = $Customer->detail($MSKH);
        $addresses = $Customer->getAddresses($MSKH);
    } 

    //sử lý hiển thị sản phẩm
    switch($_GET['action']) {
        case 'cart': {// Đặt hàng với giỏ hàng
            if(!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = (object) array('totalPrice'=>0, 'products'=>[]);
            }
            $carts = $_SESSION['cart'];
            // Biến khi submit
            $action = "?action=cart&MSKH=$MSKH";
            break;
        }
        case 'item': {// Đặt hàng với 1 sản phẩm
            if (isset($_GET['MSHH'])){
                
                $MSHH = $_GET['MSHH'];
                $action = "?action=item&MSHH=$MSHH";
                $product =creatNewProduct($MSHH,1); // tạo 1 sản phẩm mới
                // khởi tọa giỏ hàng
                $carts = (object)['totalPrice'=>$product['price'],'products'=>array($product)];
                $carts->products = array($product);
                $carts->totalPrice =$product['price'];
            }
            break;
        }
        default: {
            echo "Thiếu action khi gọi thanh toán";
            die();
        }
    }
    // sử lý đặt hàng
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fullname= $_POST['fullname'];
        if (isset($_POST['address'])){
            $address= $_POST['address'];
        }
        if (isset($_POST['soDC'])){
            $soDC= $_POST['soDC'];
        }
        $phoneNumber= $_POST['phone-number'];
        $email= $_POST['email'];
        // Xử lý để tạo MSKH
        if (isset($_SESSION['MSKH'])) { //Đã đăng nhập
            $MSKH = $_SESSION['MSKH'];
            if (!isset($soDC)) {
                $soDC =$Customer->insertAddress($MSKH,$address);
            }
        } else {// chưa đăng nhập
            $customer = $Customer->insert($fullname,$email,$address,$phoneNumber);
            
            // Tào thành công thì thêm vào session
            if ($customer) {
                $MSKH = $customer->mskh;
                $soDC = $customer->soDC;

                $_SESSION['MSKH'] = $MSKH ;
                $customer = $Customer->detail($MSKH);
                $addresses = $Customer->getAddresses($MSKH);
            }
        }

        // Đặt hàng
        switch ($_GET['action']) {
            case 'cart': { // Đặt hàng với giỏ hàng
                
                $carts = $_SESSION['cart'];
                // thêm vào bảng chi tiết đơn hàng
                // $SoDH = $Order->insertOrder($MSKH, $totalPrice);
                $msg = createOrder($MSKH, $carts, $soDC);
                if (!$msg) {
                    $msg = "Thành công";
                    // Thành công thì xóa giỏ hàng
                    $_SESSION['cart'] = (object) array('totalPrice'=>0, 'products'=>[]);
                    $carts = $_SESSION['cart'];
                }
                break;
            }
            case 'item': { // Thanh toán một loại hàng 
                $MSHH = $_POST['MSHH'];
                $quantity = $_POST['quantity'];

                $action = "?action=item&MSHH=$MSHH";

                $product =creatNewProduct($MSHH,$quantity); // tạo 1 sản phẩm mới
                // khởi tọa giỏ hàng
                $carts = (object)['totalPrice'=>$product['price'],'products'=>array($product)];
                $carts->products = array($product);
                $carts->totalPrice =$product['price'];

                // Tạo đơn hàng
                $msg = createOrder($MSKH,$carts,$soDC);
                if (!$msg) {
                    $msg = 'Thành công';
                    // Thành công thì xóa giỏ hàng
                    $carts = (object) array('totalPrice'=>0, 'products'=>[]);
                }
                break;
            }
            default: {
                echo "Thiếu action khi POST";
                die();
            }
        }
    }
    function createOrder($MSKH,$carts,$MaDC ) {
        $Order = new Order();
        $products = $carts->products;
        $totalPrice= $carts->totalPrice;
        $SoDH = $Order->insertOrder($MSKH, $totalPrice, $MaDC);
        $msg = '';
        if(!$SoDH ) {
            $msg = 'Lỗi khi tạo đơn hàng';
        } 
        foreach ($products as $product) {
            $result = $Order->insertDetailOrder($SoDH,$product['MSHH'],$product['quantity'],$product['totalPrice'],$MaDC);
            if (!$result) break;
        }

        if(!$result ) {
            $msg = 'Lỗi khi thêm chi tiết đơn hàng';
        } 
        return $msg;
    }
    function creatNewProduct($MSHH,$quantity = 1) {
        $Product = new Product();
        $product  = $Product->detail($MSHH);
        $productImages = $Product->getImages($MSHH);
        $images = [];
        
        foreach($productImages as $image) {
         
            array_push($images,array('MaHinh'=>$image['MaHinh'],'TenHinh'=>$image['TenHinh']));
        }
        
        // sản phẩm mới
        $product = array('MSHH'=> $product['MSHH'],'name'=>$product['TenHH'],
            'price'=>$product['Gia'], 'quantity'=>$quantity,'totalPrice'=>$product['Gia'],
            'totalQuantity'=>$product['SoLuongHang'],'images'=>$images);
        
        return $product;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/font/fontawesome-5.15.4-web/fontawesome-free-5.15.4-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/newstyles.css">
</head>
<body>
    <div id="app">
        <!-- header -->
        <?php include_once('./partitions/header.php')?>
        <!-- main -->
        <main id="main" class="my-5">
        <div class="container">
            <form method="POST" action="<?php echo $action?>" onsubmit="handleFormOrderSubmit(event)" id="order" data-mskh="<?php echo $MSKH?>" data-action="<?php echo $_GET['action']?>" >
                    <?php 
                        if (isset($msg)) {
                            echo "<h6 class='notify--success'>$msg</h6>";
                        }
                    ?>
                <div class="row">
                    <div class="col-8">
                        <div class="product-info">
                            <h3>Thông tin sản phẩm</h3>
                            <div id="cart-list-items">

                            <?php 
                                $index=0;
                                foreach($carts->products as $product){
                            ?>
                                <div class="product-info__row">
                                    
                                    <div class="row">
                                        <div class="col-1">
                                            <button type="button" onclick="handleRemoveProductFromCart(<?php echo $index?>)" class="btn btn-danger" style="border-radius: 8px;">
                                                <i style="font-size: 1.5rem;color: white;" class="far fa-times-circle"></i>
                                            </button>
                                        </div>
                                        <div class="col-2">
                                            <img style='width:100px' src="./products-img/<?php echo $product['images'][0]['TenHinh']?>" alt="Ảnh review">
                                        </div>    
                                        <div class="col-5">
                                            <div>
                                                <span>Mã sản phẩm:</span>
                                                <input style="width: 100px;" type='text' value="<?php echo $product["MSHH"]?>" name="MSHH" readonly/>
                                            </div>
                                            <span><?php echo $product["name"]?></span>
                                            
                                            <div class="div">
                                                <span>Số lượng còn lại:</span>
                                                <span><?php echo $product['totalQuantity']?></span>
                                                <span>cái</span>
                                            </div>
                                            <div>
                                                <span>Giá sản phẩm</span>
                                                <span><?php echo $product['price']?></span>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="product-info__quantity">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h6>Số lượng sản phẩm</h6>
                                                            <input class="form-control" name='quantity' data-index="<?php echo $index ?>" data-price="<?php echo $product['price']?>" onchange='handleChangeQuantity(this)' type="number" value='<?php echo $product['quantity']?>'  min='1' max="<?php echo $product['totalQuantity'] ?>">
                                                    </div>
                                                    <div class="col-6">
                                                        <h6>Thành tiền</h6>
                                                        <span class="js-price"><?php echo number_format($product['price'])?></span>
                                                        <span>Đ</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                               
                            <?php 
                                    $index++;
                                } // Close tag php
                             ?>
                            </div>
                            <hr>
                            <div class="product-info_total">
                                <span>Tổng tiền:</span>
                                <div>
                                    <span class="js-total-price"><?php echo number_format($carts->totalPrice)?></span>
                                    <span>Đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="user-info">
                            <h3 >Thông tin đặt hàng</h3>
                            <div class="form-group">
                                <label for="fullname">Họ và tên:</label>
                                <input value="<?php if(isset($customer)) echo $customer['HoTenKH'];?>" id="fullname" class="form-control" type="text" name="fullname">
                            </div>
                            <div class="form-group">
                                <label for="phone-number">Số điện thoại:</label>
                                <input value="<?php if(isset($customer)) echo $customer['SoDienThoai'];?>" id="phone-number" class="form-control" type="text" name="phone-number">
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ giao hàng</label>
                                <?php 
                                    if (!isset($addresses)){
                                        echo "<input id=\"address\" class=\"form-control\" type=\"text\" name=\"address\">";
                                    } else {
                                        echo "<select id=\"address\" name=\"soDC\" class='form-control'>";
                                        foreach($addresses as $address){
                                            echo "<option value='$address[MaDC]'>$address[DiaChi]</option>";
                                        }  
                                        echo "</select>";
                                        echo "<button type=\"button\" onclick=\"changeAddress()\" class=\"btn btn-success mt-2\">Thêm mới</button>";
                                    }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input value="<?php if(isset($customer)) echo $customer['Email'];?>" id="email" class="form-control" type="text" name="email">
                            </div>
                            <input type="button" class="btn btn-danger" value="Hủy">
                            <input type="submit" class="btn btn-primary" value="Đặt hàng">
                        </div>
                    </div>
                </div>
            </form>
          
        </div>
        </main>
        <!-- Footer -->
        <?php include_once('./partitions/footer.php')?>
    </div>
    <!-- Boostrap Script -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- main js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./assets/js/main.js"></script>
    <script src="./assets/js/order.js"></script>
   <script>
        function changeAddress(e) {
            let addressSelect = document.querySelector('#address');
            let input = `<input id="address" class="form-control" type="text" name="address">`;
            addressSelect.outerHTML = input;
        }
        function handleFormOrderSubmit(e){
        }
        
    </script>
</body>
</html>