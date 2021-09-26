<?php 

class Products {

    private $products = array();
    
    public function __construct()
    {
        $this->products = array(
            array('item' => 'apple', 'price' => 2.33, 'stock' => '3'),
            array('item' => 'banana', 'price' => 5.99, 'stock' => '3'),
            array('item' => 'oranges', 'price' => 12.99, 'stock' => '3'),
            array('item' => 'grapes', 'price' => 20.00, 'stock' => '3'),
        );
    }

    public function getProdcuts()
    {
        if (!empty($this->products)) {
            return $this->products;
        } 
        return null;
    }

    public function findProduct(string $item) 
    {
        foreach ($this->getProdcuts() as $product) {
            if ($item === $product['item']) {
                return array(
                    'name' => $product['item'],
                    'price' => $product['price'],
                    'stock' => $product['stock']
                ); 
            }
        }
    }

    public function addToCart(string $item)
    {
        if (!empty($item)) {
            $product = $this->findProduct($item);
            if(!empty($product)){
                if(!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = array('items'=> $product);
                } else {
                    $current = $_SESSION['cart'];
                    array_push($_SESSION['cart'], $product);
                    array_push($current, $_SESSION['cart']);
                }
            } else {
                echo 'product does not exists';
            }
        }
    }

    public function getCartItems() 
    {
        if(isset($_SESSION['cart'])) {
            return $_SESSION['cart'];
        }
    }

    public function countCartItems()
    {
        if ($this->getCartItems() != null) {
            return count($this->getCartItems());
        }
        return 0;
    }

    public function removeFromCart(string $item)
    {
        if (!empty($item) && isset($_SESSION['cart'])) {
            $current = $_SESSION['cart'];
            foreach($current as $key => $items) {
                if($item == $items['name']){
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
        }
    }
}

?>