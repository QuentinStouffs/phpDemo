<?php
include 'User.php';
include 'UserManager.php';
$user_manager = new ProductManager();
$display = 'list';

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

<form action="index.php" method="get" id="search-form">
    <label for="pk-search">Rechercher</label>
    <input type="number" name="pk" id="pk-search">
    <input type="submit" value="Rechercher">
</form>
<form action="index.php" method="post">
    <input type="hidden" name="type" value="create">
    <input type="hidden" name="pk" value="">
    <input type="text" name="name">
    <input type="number" name="price" step="0.01">
    <input type="number" name="quantity" min="0">
    <input type="submit">
</form>
<section id="ajax-rsp">

</section>

<?php if($display == 'one') include 'unique_view.php'; ?>
<?php if($display == 'list') include 'table_users.php'; ?>
<h3><a href="users.php">Gérer les utilisateurs</a></h3>
</body>
</html>

