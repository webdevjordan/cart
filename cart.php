<?php 
session_start();
require './header.php';
require './classes/products.php';
$products = new Products();
if(isset($_POST['item'])) {
    $products->removeFromCart($_POST['item']);
}
?>


<body>
    <div class="container">
    <nav class="navbar navbar-expand-lg">
        <a href="index.php" class="navbar-brand text-center">Home</a>
    </nav>
    </div>
    <div class="container">
        <div class="cart mt-4">
            <?php   if(!empty($products->getCartItems())){;  ?>
            <table class="table table-striped table-bordered caption-top">
                <caption class="text-center" style="margin: 30px 0px;"><strong style="font-size: 30px;">Cart</strong></caption>
                <thead>
                    <th class="text-center">#</th>
                    <th class="text-center">Item</th>
                    <th class="text-center">Stock</th>
                    <th class="text-center">Price</th>
                    <td></td>
                </thead>
                <tbody class="table table-striped" style="border-radius: 10px;">
                    <?php 
                    $sum = 0;
                    $id = 0;
                        $data = $products->getCartItems();
                        foreach($data as $items) {
                            $sum += $items['price'];
                            $id++;
                    ?>
                        <tr scope="row">
                            <th class="align-middle text-center"><?php print($id); ?></th>
                            <td class="align-middle text-center"><?php print($items['name']); ?></td>
                            <td class="align-middle text-center"><?php print($items['stock']); ?></td>
                            <td class="align-middle text-center"><?php print($items['price']); ?></td>
                            <td>
                                <form action="cart.php" method="POST" class="bg-white" style="display: flex; justify-content: center;">
                                    <input type="hidden" name="item" value="<?php print($items['name']); ?>">
                                    <button type="submit" class="btn btn-outline-danger">X</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>    
                </tr>
                <tr>
                    <th colspan="2" class="text-center">Total<th>
                    <td class="text-center table-warning"><?php print($sum); ?></td>
                </tr>
                </tbody>
            </table>
            <a href="clear.php" class="btn btn-danger"> Clear </a>
                
            <?php } else { ?>
                    <h4 class="text-center" style="margin: 300px 0px;"> no items to show</h4>
            <?php } ?>
        </div>
    </div>
</body>
