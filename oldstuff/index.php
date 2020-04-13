<?php
include 'Product.php';
include "ProductManager.php";
$product_manager = new ProductManager();

$display = 'list';

if(isset($_GET) && isset($_GET['pk'])){
    $product = $product_manager->fetch($_GET['pk']);
    $display = 'one';
} else {
    $product_list = $product_manager->fetchAll();
}

if(isset($_POST) && isset($_POST['type']) && isset($_POST['type']) == 'create') {
    var_dump($_POST);
    $product = $product_manager->save($_POST);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Titre</title>
</head>
<body>
    <button type="button" id="btn">Click me</button>
    <form action="index2.php" method="get">
        <label for="pk-search">Rechercher </label>
        <input type="number" name="pk" id="pk-search">
        <input type="submit" value="Rechercher">
    </form>

    <form action="index.php" method="post">
        <input type="hidden" name="type" value="create">
        <input type="text" name="name">
        <input type="number" name="price" min="0">
        <input type="number" name="quantity" min="0">
        <input type="submit" value="oui">
    </form>
    <?php if($display == 'one') include 'unique_view.php'; ?>
    <?php if($display == 'list') include 'table_view.php'; ?>
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>
