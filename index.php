<?php 
include 'Product.php';
include 'ProductManager.php';
$product_manager = new ProductManager();
$display = 'list';

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'create') {
    $product = $product_manager->save($_POST);
}

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'update') {
    $product = $product_manager->update($_POST);
}

if(isset($_GET) && isset($_GET['pk'])) {
    $product = $product_manager->fetch($_GET['pk']);
    $display = 'one';
} else {
    $product_list = $product_manager->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <button type="button" id="btn">CLICK ME</button>
    
       <form action="index.php" method="get" id="search-form">
        <label for="pk-search">Rechercher</label>
        <input type="number" name="pk" id="pk-search">
        <input type="submit" value="Rechercher">
    </form>
    <?php
        if (isset($product) && $product == false):
    ?>
        <h3>Une erreur s'est produite, réessayez</h3>
    <?php endif; ?>
    <form action="index.php" method="post">
        <input type="hidden" name="type" value="create">
        <input type="hidden" name="pk" value="">
        <input type="text" name="name">
        <input type="number" name="price" step="0.01">
        <input type="number" name="quantity" min="0">
        <input type="submit">
    </form>
    
    <form action="index.php" method="post">
        
    </form>
    <section id="ajax-rsp">
        
    </section>
    
    <?php if($display == 'one') include 'unique_view.php'; ?>
    <?php if($display == 'list') include 'table_view.php'; ?>
    <h3><a href="users.php">Gérer les utilisateurs</a></h3>
</body>
</html>

