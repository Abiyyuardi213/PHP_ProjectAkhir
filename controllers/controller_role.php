<?php
include 'models/model_role.php';

class controllerRole {
    private $model;

    public function __construct() {
        $this->model = new ModelRole();
    }

    public function handleRequestRole($fitur) {
        $role_id = $_GET['id'] ?? null;
        switch ($fitur) {
            case 'create':
                $this->createRole();
                break;
            case 'update':
                if ($role_id) {
                    $this->updateRole((int)$role_id);
                } else {
                    header('Location: index.php?modul=role&fitur=list');
                }
                break;
            case 'delete':
                if ($role_id) {
                    $this->deleteRole((int)$role_id);
                } else {
                    header('Location: index.php?modul=role&fitur=list');
                }
                break;
            default:
                $this->listRoles();
                break;
        }
    }

    public function listRoles() {
        $roles = $this->model->getRoles();
        include './views/role_list.php';
    }

    public function createRole() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role_name = $_POST['role_name'] ?? '';
            $role_description = $_POST['role_description'] ?? '';
            $role_salary = $_POST['role_salary'] ?? 0;
            $role_status = $_POST['role_status'] ?? 0;

            $this->model->addRole($role_name, $role_description, (int)$role_salary, (int)$role_status);
            header('Location: index.php?modul=role&fitur=list');
        } else {
            include './views/role_add.php';
        }
    }

    public function updateRole($role_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role_name = $_POST['role_name'] ?? '';
            $role_description = $_POST['role_description'] ?? '';
            $role_salary = $_POST['role_salary'] ?? 0;
            $role_status = $_POST['role_status'] ?? 0;

            $this->model->updateRole($role_id, $role_name, $role_description, (int)$role_salary, (int)$role_status);
            header('Location: index.php?modul=role&fitur=list');
        } else {
            $role = $this->model->getRoleById($role_id);
            if (!$role) {
                header('Location: index.php?modul=role&fitur=list&error=notfound');
                exit;
            }
            include './views/role_update.php';
        }
    }

    public function deleteRole($role_id) {
        $this->model->deleteRole($role_id);
        header('Location: index.php?modul=role&fitur=list');
    }
}