<?php
include './config/db_connect.php';

class UserModel {
    public function getUsers() {
        global $conn;
        $sql = "SELECT * FROM tb_user";
        $result = $conn->query($sql);

        $users = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }
        return $users;
    }
}