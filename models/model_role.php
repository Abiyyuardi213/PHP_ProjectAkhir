<?php
include './config/db_connect.php';

class ModelRole {
    public function getRoles() {
        global $conn;
        $sql = "SELECT * FROM tb_role";  // Gantilah "users" dengan nama tabel Anda
        $result = $conn->query($sql);

        $roles = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $roles[] = $row;
            }
        }
        return $roles;
    }

    public function getRoleById($role_id) {
        global $conn;
        $sql = "SELECT * FROM tb_role WHERE role_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $role_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function addRole($role_name, $role_description, $role_salary, $role_status) {
        global $conn;
        $sql = "INSERT INTO tb_role (role_name, role_description, role_salary, role_status) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $role_name, $role_description, $role_salary, $role_status);
        return $stmt->execute();
    }

    public function updateRole($role_id, $role_name, $role_description, $role_salary, $role_status) {
        global $conn;
        $sql = "UPDATE tb_role SET role_name = ?, role_description = ?, role_salary = ?, role_status = ? WHERE role_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiii", $role_name, $role_description, $role_salary, $role_status, $role_id);
        return $stmt->execute();
    }

    public function deleteRole($role_id) {
        global $conn;
        $sql = "DELETE FROM tb_role WHERE role_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $role_id);
        return $stmt->execute();
    }

    public function getAllRoles() {
        return $this->getRoles(); // Panggil fungsi getRoles yang sudah Anda buat
    }
}