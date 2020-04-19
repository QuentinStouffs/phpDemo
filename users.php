<?php
include 'User.php';
include 'UserManager.php';
$user_manager = new UserManager();
$display = 'list';

if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'create') {
    $user = $user_manager->save($_POST);
}
if(isset($_POST) && isset($_POST['type']) && $_POST['type'] == 'update') {
    $user = $user_manager->update($_POST);
}
if(isset($_GET) && isset($_GET['pk'])) {
    $user = $user_manager->fetch($_GET['pk']);
    $display = 'one';
} else {
    $user_list = $user_manager->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="user.js"></script>
</head>
<body>

<form action="users.php" method="post">
    <input type="hidden" name="type" value="create">
    <input type="hidden" name="pk" value="">
    <input type="text" name="name">
    <input type="text" name="password">
    <input type="hidden" name="created_at" value="">
    <input type="submit">
</form>
<section id="ajax-rsp">

</section>

<?php if($display == 'list') include 'table_users.php'; ?>
<h3><a href="users.php">Gérer les utilisateurs</a></h3>
</body>
</html>

