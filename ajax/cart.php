<?php
    session_start();
    if (isset($_GET['action'])) {
        require_once('../models/Product.php');
        $Product = new Product();
        
       
        

        switch ($_GET['action']){
            
            case 'add': {
                if (!isset($_GET['id']) ){
                    echo json_encode(array('status'=>'0','message'=>'Không tồn tài MSHH sản phẩm'));
                    return;
                }

                $id = $_GET['id'];

                $product  = $Product->detail($id);
                $productImages = $Product->getImages($id);
                $images = [];
                
                foreach($productImages as $image) {
                 
                    array_push($images,array('MaHinh'=>$image['MaHinh'],'TenHinh'=>$image['TenHinh']));
                }
                $product = array('MSHH'=> $product['MSHH'],'name'=>$product['TenHH'],
                    'price'=>$product['Gia'], 'quantity'=>1,'totalPrice'=>$product['Gia'],'images'=>$images);
                
                if(!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }
                array_push($_SESSION['cart'],$product);
                echo json_encode($_SESSION['cart']);
                return;
            }
            case 'remove': {
                if (!isset($_GET['index']) ){
                    echo json_encode(array('status'=>'0','message'=>'Không tồn tài index sản phẩm'));
                    return;
                }
                if(!isset($_SESSION['cart']) || count($_SESSION['cart']) ==0) {
                    echo json_encode(array('status'=>'0','message'=>'Giỏ hàng rỗng'));
                    return;
                }

                $index = $_GET['index'];
                array_splice($_SESSION['cart'],$index,1); 
               
                echo json_encode($_SESSION['cart']);
                return;
            }
            // cập nhật  số lượng
            case 'update': {

                if(!isset($_GET['quantity'])|| !isset($_GET['index'])) {
                    echo json_encode(array('status'=>'0','message'=>'Không tồn tại index sản phẩm'));
                    return;
                }
                $quantity = $_GET['quantity'];
                $index = $_GET['index'];

                $_SESSION['cart'][$index]['quantity'] = $quantity;
                $_SESSION['cart'][$index]['totalPrice'] = $quantity * $_SESSION['cart'][$index]['price'];

                include('displayCarts.php');
                return;
            }
        }

    };
    
?>