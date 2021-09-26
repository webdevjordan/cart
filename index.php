<?php
    session_start();
    require './header.php';
    require './classes/products.php';
    $object = new Products();
    $products = $object->getProdcuts();
    if(isset($_POST['item'])) {
        $object->addToCart($_POST['item']);
    }
    $cartItemCount = $object->countCartItems();
?>
<body>
    <div class="header" style="display: flex; justify-content: space-between; padding: 30px 20px;">
        <a class="navbar-brand" style="text-decoration: none; color: #444; font-weight: 600;">Freshly Grown</a>
        <div class="d-block">
        <a href="cart.php" class="btn btn-light">
            <span style="padding: 8px;">
                <?php print($cartItemCount); ?>
            </span>Cart</a>
        </div>

    </div>
    <div class="container" style="display: flex; justify-content: center; height: 60vh; flex-direction: column;">
        <table class="table table-striped table-borderless caption-top">
        <caption class="text-center" style="margin: 30px 0px;"><strong style="font-size: 30px;">In Stock</strong></caption>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $product) { ?>
                    <tr>
                        <td><?php print($product['item']); ?></td>
                        <td><?php print($product['price']); ?></td>
                        <td><?php print($product['stock']); ?></td>
                        <td>
                            <form action="index.php" method="POST">
                                <input type="hidden" name="item" value="<?php print($product['item']); ?>">
                                <button type="submit" class="cart-btn btn btn-outline-success"> add to cart </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>    
</body>
</html>

