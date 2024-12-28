<?php
include './config/db_connect.php';

abstract class AbstractUser {
    abstract public function getUsers();
    abstract public function getUserById($user_id);
    abstract public function addUser($user_name, $username, $password, $user_email, $user_phone, $role_id);
    abstract public function deleteUser($user_id);
    abstract public function updateUser($user_id, $user_name, $username, $password, $user_email, $user_phone, $role_id);
}

class UserModel extends AbstractUser {
    public function getUsers() {
        global $conn;
        $sql = "SELECT u.user_id, u.user_name, u.username, u.user_email, u.user_phone, u.profile_picture, r.role_id, r.role_name
                FROM tb_user u
                LEFT JOIN tb_role r ON u.role_id = r.role_id";
        $result = $conn->query($sql);

        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }

    public function getUserById($user_id) {
        global $conn;
        $sql = "SELECT u.user_id, u.user_name, u.username, u.user_email, u.user_phone, u.profile_picture, r.role_id, r.role_name
                FROM tb_user u
                LEFT JOIN tb_role r ON u.role_id = r.role_id
                WHERE u.user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addUser($user_name, $username, $password, $user_email, $user_phone, $role_id, $profile_picture = null) {
        global $conn;

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO tb_user (user_name, username, password, user_email, user_phone, role_id, profile_picture) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssis", $user_name, $username, $hashed_password, $user_email, $user_phone, $role_id, $profile_picture);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUser($user_id) {
        global $conn;
        $sql = "DELETE FROM tb_user WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }

    public function updateUser($user_id, $user_name, $username, $password, $user_email, $user_phone, $role_id, $profile_picture = null) {
        global $conn;
    
        $setFields = "user_name = ?, username = ?, user_email = ?, user_phone = ?, role_id = ?";
        $params = [$user_name, $username, $user_email, $user_phone, $role_id];
    
        if (!empty($password)) {
            $setFields .= ", password = ?";
            $params[] = password_hash($password, PASSWORD_DEFAULT);
        }
    
        if (!empty($profile_picture)) {
            $setFields .= ", profile_picture = ?";
            $params[] = $profile_picture;
        }
    
        $params[] = $user_id;
    
        $sql = "UPDATE tb_user SET $setFields WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        return $stmt->execute($params);
    }

    public function searchUserByName($searchTerm) {
        global $conn;
        $sql = "SELECT u.user_id, u.user_name, u.username, u.user_email, u.user_phone, r.role_name
                FROM tb_user u
                LEFT JOIN tb_role r ON u.role_id = r.role_id
                WHERE u.user_name LIKE ?";
        $stmt = $conn->prepare($sql);
        $likeTerm = "%{$searchTerm}%";
        $stmt->bind_param("s", $likeTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    public function sortUserByName($order = 'ASC') {
        global $conn;
        $order = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';
        $sql = "SELECT * FROM tb_user ORDER BY user_name $order";
        $result = $conn->query($sql);

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    public function sortUserById($order = 'ASC') {
        global $conn;
        $order = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';
        $sql = "SELECT * FROM tb_user ORDER BY user_id $order";
        $result = $conn->query($sql);

        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }

    public function getAllUsers() {
        return $this->getUsers();
    }

    public function loginUser($username, $password) {
        global $conn;
    
        $sql = "SELECT user_id, username, password, role_id, user_name FROM tb_user WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    
        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']);
            return $user;
        }
    
        return null;
    }
}
