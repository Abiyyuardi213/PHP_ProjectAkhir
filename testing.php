<?php
require_once './models/model_role.php';

$model = new ModelRole();
$model->addRole('Manager', 'Mengelola tim', 10000000, 1);

$roles = $model->getRoles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing Role Table</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h1>Daftar Role</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Role</th>
                <th>Deskripsi</th>
                <th>Gaji</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($roles)): ?>
                <?php foreach ($roles as $role): ?>
                    <tr>
                        <td><?= htmlspecialchars($role['role_id']); ?></td>
                        <td><?= htmlspecialchars($role['role_name']); ?></td>
                        <td><?= htmlspecialchars($role['role_description']); ?></td>
                        <td><?= number_format($role['role_salary'], 0, ',', '.'); ?></td>
                        <td><?= $role['role_status'] == 1 ? 'Aktif' : 'Nonaktif'; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
