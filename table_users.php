<table id="product-list">
    <tr>
        <th>Nom</th>
        <th>Password</th>
    </tr>
    <?php foreach($user_list as $user): ?>
        <tr>
            <td><?= $user->__get('username'); ?></td>
            <td><?= $user->__get('password'); ?></td>
            <td><button type="button" data-id="<?=$product->__get('pk'); ?>" class="delete-btn">DELETE</button>&nbsp;<button type="button" data-id="<?=$product->__get('pk'); ?>" class="update-btn">UPDATE</button></td>
        </tr>
    <?php endforeach; ?>
</table>