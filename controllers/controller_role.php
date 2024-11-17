<?php
include 'models/model_role.php';

$roleModel = new RoleModel();
$roles = $roleModel->getRoles();