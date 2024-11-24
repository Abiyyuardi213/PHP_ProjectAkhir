<?php
include './config/db_connect.php';

class UserModel {
    public function getUsers() {
        global $conn;
        $sql = "SELECT u.user_id, u.user_name, u.username, u.password, u.user_email, u.user_phone, r.role_id, r.role_name 
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
        $sql = "SELECT u.user_id, u.user_name, u.username, u.password, u.user_email, u.user_phone, r.role_id
                FROM tb_user u
                LEFT JOIN tb_role r ON u.role_id = r.role_id
                WHERE u.user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addUser($user_name, $username, $password, $user_email, $user_phone, $role_id) {
        global $conn;

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO tb_user (user_name, username, password, user_email, user_phone, role_id) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $user_name, $username, $hashed_password, $user_email, $user_phone, $role_id);

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

    public function updateUser($user_id, $user_name, $username, $password, $user_email, $user_phone, $role_id) {
        global $conn;

        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE tb_user 
                    SET user_name = ?, username = ?, password = ?, user_email = ?, user_phone = ?, role_id = ?
                    WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssii", $user_name, $username, $hashed_password, $user_email, $user_phone, $role_id, $user_id);
        } else {
            $sql = "UPDATE tb_user 
                    SET user_name = ?, username = ?, user_email = ?, user_phone = ?, role_id = ?
                    WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $user_name, $username, $user_email, $user_phone, $role_id, $user_id);
        }

        return $stmt->execute();
    }

    public function getAllUsers() {
        return $this->getUsers();
    }
}