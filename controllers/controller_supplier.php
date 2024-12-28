<?php
include 'models/model_supplier.php';

class ControllerSupplier {
    private $modelSupplier;

    public function __construct($conn) {
        $this->modelSupplier = new ModelSupplier($conn);
    }

    public function handleRequestSupplier($fitur) {
        $supplier_id = $_GET['id'] ?? null;

        switch ($fitur) {
            case 'create':
                $this->createSupplier();
                break;

            case 'update':
                if ($supplier_id) {
                    $this->updateSupplier($supplier_id);
                } else {
                    echo "Error: Supplier ID is required for update.";
                }
                break;

            case 'delete':
                if ($supplier_id) {
                    $this->deleteSupplier($supplier_id);
                } else {
                    echo "Error: Supplier ID is required for deletion.";
                }
                break;

            case 'search':
                break;

            default:
                $this->listSupplier();
                break;
        }
    }

    public function listSupplier() {
        $searchTerm = $_GET['search'] ?? null;
        if ($searchTerm) {
            $suppliers = $this->modelSupplier->searchSupplierByName($searchTerm);
        } else {
            $suppliers = $this->modelSupplier->getSuppliers();
        }
        include './views/supplier/supplier_list.php';
    }

    public function createSupplier() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $supplier_name = $_POST['supplier_name'] ?? '';
            $supplier_address = $_POST['supplier_address'] ?? '';
            $supplier_phone = $_POST['supplier_phone'] ?? '';
            $supplier_email = $_POST['supplier_email'] ?? '';

            if ($supplier_name && $supplier_address && $supplier_phone && $supplier_email) {
                $inserted_id = $this->modelSupplier->addSupplier($supplier_name, $supplier_address, $supplier_phone, $supplier_email);
                if ($inserted_id) {
                    header('Location: index.php?modul=supplier&fitur=list');
                } else {
                    echo "Error: Failed to create supplier.";
                }
            } else {
                echo "Error: All fields are required.";
            }
        } else {
            include 'views/supplier/supplier_add.php';
        }
    }

    public function updateSupplier($supplier_id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $supplier_name = $_POST['supplier_name'] ?? '';
            $supplier_address = $_POST['supplier_address'] ?? '';
            $supplier_phone = $_POST['supplier_phone'] ?? '';
            $supplier_email = $_POST['supplier_email'] ?? '';

            if ($supplier_name && $supplier_address && $supplier_phone && $supplier_email) {
                $affected_rows = $this->modelSupplier->updateSupplier($supplier_id, $supplier_name, $supplier_address, $supplier_phone, $supplier_email);
                if ($affected_rows > 0) {
                    header('Location: index.php?modul=supplier&fitur=list');
                } else {
                    echo "Error: Failed to update supplier or no changes were made.";
                }
            } else {
                echo "Error: All fields are required.";
            }
        } else {
            $supplier = $this->modelSupplier->getSupplierById($supplier_id);
            include 'views/supplier/supplier_update.php';
        }
    }

    public function deleteSupplier($supplier_id) {
        $deleted_rows = $this->modelSupplier->deleteSupplier($supplier_id);
        if ($deleted_rows > 0) {
            header('Location: index.php?modul=supplier&fitur=list');
        } else {
            echo "Error: Failed to delete supplier.";
        }
    }
}
