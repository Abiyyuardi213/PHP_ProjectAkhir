<?php
include './models/model_user.php';
include './models/model_role.php';

class ControllerUser {
    private $userModel;
    private $roleModel;

    public function __construct() {
        $this->userModel = new UserModel();
        $this->roleModel = new ModelRole();
    }

    public function handleRequestUser($fitur) {
        $user_id = $_GET['id'] ?? null;
        $searchTerm = $_GET['search'] ?? null;
        $order = $_GET['order'] ?? 'ASC';

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
            case 'sortByName':
                $this->sortUsers('name', $order);
                break;
            case 'sortById':
                $this->sortUsers('id', $order);
                break;
            default:
                $this->listUsers();
                break;
        }
    }

    public function listUsers() {
        $searchTerm = $_GET['search'] ?? null;
        if ($searchTerm) {
            $users = $this->userModel->searchUserByName($searchTerm);
        } else {
            $users = $this->userModel->getUsers();
        }
        include './views/user_list.php';
    }

    public function createUsers() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_name = $_POST['user_name'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user_email = $_POST['user_email'];
            $user_phone = $_POST['user_phone'];
            $role_id = $_POST['role_id'];

            $isAdded = $this->userModel->addUser($user_name, $username, $password, $user_email, $user_phone, $role_id);

            if ($isAdded) {
                header('Location: index.php?modul=user&fitur=list&message=User successfully added');
            } else {
                header('Location: index.php?modul=user&fitur=create&error=Failed to add user');
            }
            exit;
        }

        $roles = $this->roleModel->getAllRoles();
        include './views/user_add.php';
    }

    public function updateUsers($user_id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user_name = $_POST['user_name'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user_email = $_POST['user_email'];
            $user_phone = $_POST['user_phone'];
            $role_id = $_POST['role_id'];

            $isUpdated = $this->userModel->updateUser($user_id, $user_name, $username, $password, $user_email, $user_phone, $role_id);

            if ($isUpdated) {
                header('Location: index.php?modul=user&fitur=list&message=User successfully updated');
            } else {
                header('Location: index.php?modul=user&fitur=update&id=' . $user_id . '&error=Failed to update user');
            }
            exit;
        }

        $user = $this->userModel->getUserById($user_id);
        $roles = $this->roleModel->getAllRoles();
        include './views/user_update.php';
    }

    public function deleteUsers($user_id) {
        if (!is_numeric($user_id) || $user_id <= 0) {
            header('Location: index.php?modul=user&fitur=list&error=Invalid user ID');
            exit;
        }

        $isDeleted = $this->userModel->deleteUser($user_id);

        if ($isDeleted) {
            header('Location: index.php?modul=user&fitur=list&message=User successfully deleted');
        } else {
            header('Location: index.php?modul=user&fitur=list&error=Failed to delete user');
        }
        exit;
    }

    public function sortUsers($criteria, $order) {
        if ($criteria === 'name') {
            $users = $this->userModel->sortUserByName($order);
        } elseif ($criteria === 'id') {
            $users = $this->userModel->sortUserById($order);
        } else {
            $users = $this->userModel->getUsers();
        }
        include './views/user_list.php';
    }
}