<?php
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {        
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        die(  );
    }
?>
<?php 
class Cart
{
    public $count;
    private  static $cart;
    public function __construct()
    {
        if (!session_id()) {
            session_start();
            $_SESSION['cart'] = [];
            $this->cart = new Cart();
        }
    }
    public static function getObjectCart()
    {
        return self::$cart ;

    }
    public function addProduct($product) {
        
        return array_push($_SESSION['cart'], $product); 
    }

    public function removeProduct($index) {
        
        return array_splice($_SESSION['cart'],$index,1); 
    }

}
?>
 