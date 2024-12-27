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
            case 'viewProfilePicture':  // Case baru untuk melihat profile picture
                if ($user_id) {
                    $this->viewProfilePicture($user_id);
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

            $profile_picture = null;
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
                $fileName = time() . '_' . basename($_FILES['profile_picture']['name']);
                $uploadDir = './uploads/profile_pictures/';
                $destPath = $uploadDir . $fileName;

                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (in_array($fileExtension, $allowedExtensions)) {
                    if (move_uploaded_file($fileTmpPath, $destPath)) {
                        $profile_picture = $fileName;
                    } else {
                        header('Location: index.php?modul=user&fitur=create&error=Failed to upload profile picture');
                        exit();
                    }
                } else {
                    header('Location: index.php?modul=user&fitur=create&error=Invalid file type');
                    exit();
                }
            }

            $isAdded = $this->userModel->addUser($user_name, $username, $password, $user_email, $user_phone, $role_id, $profile_picture);

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

            $profile_picture = null;
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
                $fileName = time() . '_' . basename($_FILES['profile_picture']['name']);
                $uploadDir = './uploads/profile_pictures/';
                $destPath = $uploadDir . $fileName;

                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (in_array($fileExtension, $allowedExtensions)) {
                    if (move_uploaded_file($fileTmpPath, $destPath)) {
                        $profile_picture = $fileName;
                    } else {
                        header('Location: index.php?modul=user&fitur=update&id=' . $user_id . '&error=Failed to upload profile picture');
                        exit();
                    }
                } else {
                    header('Location: index.php?modul=user&fitur=update&id=' . $user_id . '&error=Invalid file type');
                    exit();
                }
            }

            $isUpdated = $this->userModel->updateUser($user_id, $user_name, $username, $password, $user_email, $user_phone, $role_id, $profile_picture);

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

    public function viewProfilePicture($user_id) {
        // Ambil data user berdasarkan user_id
        $user = $this->userModel->getUserById($user_id);
    
        if ($user && isset($user['profile_picture']) && !empty($user['profile_picture'])) {
            $profile_picture_path = './uploads/profile_pictures/' . $user['profile_picture'];
    
            if (file_exists($profile_picture_path)) {
                // Jika gambar ada, tampilkan gambar profile
                header('Content-Type: image/jpeg');  // Tentukan jenis konten sesuai format gambar
                readfile($profile_picture_path);
                exit();
            } else {
                // Jika file tidak ditemukan
                header('Location: index.php?modul=user&fitur=list&error=Profile picture not found');
                exit();
            }
        } else {
            // Jika user atau profile picture tidak ada
            header('Location: index.php?modul=user&fitur=list&error=User or profile picture not found');
            exit();
        }
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