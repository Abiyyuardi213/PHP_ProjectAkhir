<?php
include './models/model_user.php';

$userModel = new UserModel();
$users = $userModel->getUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
</head>
<body>
    <h1>Daftar User</h1>
    <table border="1">
        <tr>
            <th>User ID</th>
            <th>User Name</th>
            <th>Username</th>
            <th>Password</th>
            <th>Role Name</th>
            <th>Role ID</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['user_id']; ?></td>
                <td><?php echo $user['user_name']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['password']; ?></td>
                <td><?php echo $user['role_name']; ?></td>
                <td><?php echo $user['role_id']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>