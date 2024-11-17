<?php
include './config/db_connect.php';

class RoleModel {
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
}