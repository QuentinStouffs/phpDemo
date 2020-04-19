<?php
include 'User.php';
include 'UserManager.php';
$user_manager = new UserManager();

if(isset($_GET) && isset($_GET['pk'])) {
    $product = $product_manager->fetch($_GET['pk']);
    $display = 'one';
    ?>
    <h2><?= $product->__get('name'); ?></h2>
    <?php
}

if(isset($_POST) && isset($_POST['delete'])) {
    if ($user_manager->delete($_POST['pk'])) {
        $response_array['status'] = 'success';
    } else {
        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        $response_array['status'] = 'error';
    }
    echo json_encode($response_array);
}

if (isset($_POST) && isset($_POST['update'])) {
    $p = $user_manager->fetch($_POST['pk']);
    $user = ['pk'=> $p->__get('pk'),
        'name' => $p->__get('username'),
        'password' => $p->__get('password'),
        'createdAt' => $p->__get('created_at')
        ];
    echo json_encode($user);
}
?>
