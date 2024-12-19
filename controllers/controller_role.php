<?php
include 'models/model_role.php';

class controllerRole {
    private $model;

    public function __construct() {
        $this->model = new ModelRole();
    }

    public function handleRequestRole($fitur) {
        $role_id = $_GET['id'] ?? null;
        $searchTerm = $_GET['search'] ?? null;
        $order = $_GET['order'] ?? 'ASC';

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
            case 'sortByName':
                $this->sortRoles('name', $order);
                break;
            case 'sortById':
                $this->sortRoles('id', $order);
                break;
            default:
                $this->listRoles();
                break;
        }
    }

    public function listRoles() {
        $searchTerm = $_GET['search'] ?? null;
        if ($searchTerm) {
            $roles = $this->model->searchRoleByName($searchTerm);
        } else {
            $roles = $this->model->getRoles();
        }
        include './views/role_list.php';
    }

    public function createRole() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role_name = $_POST['role_name'] ?? '';
            $role_description = $_POST['role_description'] ?? '';
            $role_salary = $_POST['role_salary'] ?? 0;
            $role_status = $_POST['role_status'] ?? 0;
    
            $isAdded = $this->model->addRole($role_name, $role_description, (int)$role_salary, (int)$role_status);
            
            if ($isAdded) {
                header('Location: index.php?modul=role&fitur=list&message=Role successfully added');
            } else {
                header('Location: index.php?modul=role&fitur=create&error=Failed to add role');
            }
            exit;
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
    
            $isUpdated = $this->model->updateRole($role_id, $role_name, $role_description, (int)$role_salary, (int)$role_status);
    
            if ($isUpdated) {
                header('Location: index.php?modul=role&fitur=list&message=Role successfully updated');
            } else {
                header('Location: index.php?modul=role&fitur=update&id=' . $role_id . '&error=Failed to update role');
            }
            exit;
        } else {
            $role = $this->model->getRoleById($role_id);
            if (!$role) {
                header('Location: index.php?modul=role&fitur=list&error=Role not found');
                exit;
            }
            include './views/role_update.php';
        }
    }

    public function deleteRole($role_id) {
        $result = $this->model->deleteRole($role_id);
        
        if ($result['success']) {
            header('Location: index.php?modul=role&fitur=list&message=delete_success');
        } else {
            $error = $result['error'];
            header("Location: index.php?modul=role&fitur=list&error=$error");
        }
        exit;
    }

    public function sortRoles($criteria, $order) {
        if ($criteria === 'name') {
            $roles = $this->model->sortRolesByName($order);
        } elseif ($criteria === 'id') {
            $roles = $this->model->sortRolesById($order);
        } else {
            $roles = $this->model->getRoles();
        }
        include './views/role_list.php';
    }
}