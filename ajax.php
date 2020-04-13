<?php
include 'Product.php';
include 'ProductManager.php';
$product_manager = new ProductManager();

if(isset($_GET) && isset($_GET['pk'])) {
    $product = $product_manager->fetch($_GET['pk']);
    $display = 'one';
    ?>
    <h2><?= $product->__get('name'); ?></h2>
    <?php
}

if(isset($_POST) && isset($_POST['delete'])) {
    if ($product_manager->delete($_POST['pk'])) {
        $response_array['status'] = 'success';
    } else {
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        $response_array['status'] = 'error';
    }
    echo json_encode($response_array);
}
?>
