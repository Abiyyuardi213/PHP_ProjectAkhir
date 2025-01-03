<?php
class ControllerClient {
    public function handleRequestClient($fitur) {
        switch ($fitur) {
            case 'role_option':
                $this->roleOption();
                break;
        }
    }

    public function roleOption() {
        include './views/role_option.php';
    }
}