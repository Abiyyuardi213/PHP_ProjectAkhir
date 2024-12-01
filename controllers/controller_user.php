<?php
include './models/model_user.php';
include './models/model_role.php';

class controllerUser {
    private $userModel;
    private $roleModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->roleModel = new ModelRole();
    }

    public function handleRequestUser($fitur) {
        $user_id = $_GET['id'] ?? null;
        switch ($fitur) {
            case 'create':
                $this->createUsers();
                break;
            case 'update':
                if ($user_id) {
                    $this->updateUsers($user_id);
                } else {
                    header('Location: index.php?modul=user&fitur=list');
                }
                break;
            case 'delete':
                if ($user_id) {
                    $this->deleteUsers($user_id);
                } else {
                    header('Location: index.php?modul=user&fitur=list');
                }
                break;
            default:
                $this->listUsers();
                break;
        }
    }

    public function listUsers() {
        $users = $this->userModel->getUsers();
        include './views/user_list.php';
    }

    public function viewDetails($user_id) {
        $user = $this->userModel->getUserById($user_id);
        //include view user detail
    }

    public function createUsers() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_name = $_POST['user_name'];
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user_email = $_POST['user_email'];
            $user_phone = $_POST['user_phone'];
            $role_id = $_POST['role_id'];
    
            $this->userModel->addUser($user_name, $username, $password, $user_email, $user_phone, $role_id);
            header('Location: index.php?modul=user');
            exit;
        }
        
        include_once './models/model_role.php';
        $roles = $this->roleModel->getAllRoles();
        include './views/user_add.php';
    }

    public function updateUsers($user_id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_name = $_POST['user_name'];
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $user_email = $_POST['user_email'];
            $user_phone = $_POST['user_phone'];
            $role_id = $_POST['role_id'];
    
            $this->userModel->updateUser($user_id, $user_name, $username, $password, $user_email, $user_phone, $role_id);
            header('Location: index.php?modul=user');
            exit;
        }
    
        $user = $this->userModel->getUserById($user_id);
        $roles = $this->roleModel->getAllRoles();
        include './views/user_update.php';
    }

    public function deleteUsers($user_id) {
        $this->userModel->deleteUser($user_id);
        header('Location: index.php?modul=user');
        exit;
    }
}