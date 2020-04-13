<?php
include 'Product.php';
include "ProductManager.php";

if(isset($_GET) && isset($_GET['pk'])){
    var_dump('coucou');
}

$product_manager = new ProductManager();
$product_list = $product_manager->fetchAll();
var_dump($product_manager->fetch(1));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Titre</title>
</head>
<body>
    <form action="index2.php" method="get">
        <label for="pk-search">Rechercher </label>
        <input type="number" name="pk" id="pk-search">
        <input type="submit" value="Rechercher">
    </form>
    <?php include 'table_view.php'; ?>
</body>
</html>
