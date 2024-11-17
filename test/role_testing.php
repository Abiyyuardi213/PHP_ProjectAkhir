<?php
include './models/model_role.php';

$roleModel = new RoleModel();
$roles = $roleModel->getRoles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Roles</title>
</head>
<body>
    <h1>Daftar Role</h1>
    <table border="1">
        <tr>
            <th>Role ID</th>
            <th>Role Name</th>
            <th>Role Description</th>
            <th>Role Salary</th>
            <th>Role Status</th>
        </tr>
        <?php foreach ($roles as $role): ?>
        <tr>
            <td><?php echo $role['role_id']; ?></td>       <!-- Sesuaikan dengan nama kolom di tabel Anda -->
            <td><?php echo $role['role_name']; ?></td>     <!-- Sesuaikan dengan nama kolom di tabel Anda -->
            <td><?php echo $role['role_description']; ?></td>    <!-- Sesuaikan dengan nama kolom di tabel Anda -->
            <td><?php echo $role['role_salary']; ?></td>
            <td><?php echo $role['role_status']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
