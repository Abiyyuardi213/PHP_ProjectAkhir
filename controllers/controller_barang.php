<?php
include 'models/model_barang.php';
include 'models/model_supplier.php';

class ControllerBarang {
    private $modelBarang;
    private $modelSupplier;

    public function __construct($conn) {
        $this->modelBarang = new ModelBarang($conn);
        $this->modelSupplier = new ModelSupplier($conn);
    }

    public function handleRequestBarang($fitur) {
        $barang_id = $_GET['id'] ?? null;
        $order = $_GET['order'] ?? 'ASC';

        switch ($fitur) {
            case 'create':
                $this->createBarang();
                break;

            case 'detail':
                $barang_id = $_GET['id'] ?? null;
                if ($barang_id) {
                    $this->viewDetailInventory($barang_id);
                } else {
                    echo "Inventory ID not found.";
                }
                break;

            case 'update':
                if ($barang_id) {
                    $this->updateBarang($barang_id);
                } else {
                    $this->redirectToList();
                }
                break;

            case 'delete':
                if ($barang_id) {
                    $this->deleteBarang($barang_id);
                } else {
                    $this->redirectToList();
                }
                break;

            case 'search':
                $this->searchBarang();
                break;

            case 'sortByName':
                $this->sortInventory('name', $order);
                break;

            case 'sortById':
                $this->sortInventory('id', $order);
                break;

            case 'filter':
                $this->filterBarang();
                break;

            case 'exportPDF':
                $this->exportToPDF();
                break; 

            default:
                $this->listBarangs();
                break;
        }
    }

    public function listBarangs() {
        $suppliers = $this->modelSupplier->getAllSuppliers();
        $searchTerm = $_GET['search'] ?? null;
        if ($searchTerm) {
            $barangs = $this->modelBarang->searchBarangByName($searchTerm);
        } else {
            $barangs = $this->modelBarang->getBarangs();
        }
        include './views/inventory/inventory_list.php';
    }

    public function viewDetailInventory($barang_id) {
        $barang = $this->modelBarang->getBarangById($barang_id);
        if (!$barang) {
            echo "Inventory data not found.";
            return;
        }
        include './views/inventory/inventory_detail.php';
    }

    public function createBarang() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $barangs = $_POST['barangs'] ?? [];
            $validBarangs = [];
    
            foreach ($barangs as $barang) {
                $barang_name = htmlspecialchars(trim($barang['barang_name'] ?? ''));
                $supplier_id = intval($barang['supplier_id'] ?? 0);
                $supplier_phone = htmlspecialchars(trim($barang['supplier_phone'] ?? ''));
                $supplier_email = htmlspecialchars(trim($barang['supplier_email'] ?? ''));
                $barang_price = floatval($barang['barang_price'] ?? 0);
                $barang_quantity = intval($barang['barang_quantity'] ?? 0);
                $barang_penerima = htmlspecialchars(trim($barang['barang_penerima'] ?? ''));
                $invoice_id = htmlspecialchars(trim($barang['invoice_id'] ?? ''));
                $product_picture = null;

                if (isset($_FILES['product_picture']) && $_FILES['product_picture']['error'] === UPLOAD_ERR_OK) {
                    $fileTmpPath = $_FILES['product_picture']['tmp_name'];
                    $fileName = time() . '_' . basename($_FILES['product_picture']['name']);
                    $uploadDir = './uploads/product_pictures/';
                    $destPath = $uploadDir . $fileName;

                    if (!file_exists($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                    if (in_array($fileExtension, $allowedExtensions)) {
                        if (move_uploaded_file($fileTmpPath, $destPath)) {
                            $product_picture = $fileName;
                        } else {
                            echo "Failed to upload product picture.";
                            include './views/inventory/inventory_add.php';
                            return;
                        }
                    } else {
                        echo "Invalid file type.";
                        include './views/inventory/inventory_add.php';
                        return;
                    }
                }

                if (empty($barang_name) || $supplier_id <= 0 || $barang_price <= 0 || $barang_quantity <= 0) {
                    echo "Data barang tidak valid. Pastikan semua kolom diisi dengan benar.";
                    include './views/inventory/inventory_add.php';
                    return;
                }
    
                $validBarangs[] = [
                    'invoice_id' => $invoice_id,
                    'supplier_id' => $supplier_id,
                    'supplier_phone' => $supplier_phone,
                    'supplier_email' => $supplier_email,
                    'barang_name' => $barang_name,
                    'barang_price' => $barang_price,
                    'barang_quantity' => $barang_quantity,
                    'barang_penerima' => $barang_penerima,
                    'product_picture' => $product_picture
                ];
            }
    
            try {
                $this->modelBarang->addMultipleBarangs($validBarangs);
                $this->redirectToListWithMessage('Barang berhasil ditambahkan.');
            } catch (Exception $e) {
                echo "Gagal menambahkan barang: " . $e->getMessage();
            }
        }
    
        $suppliers = $this->modelSupplier->getAllSuppliers();
        include './views/inventory/inventory_add.php';
    }

    public function updateBarang($barang_id) {
        $barang = $this->modelBarang->getBarangById($barang_id);
        if (!$barang) {
            $this->redirectToListWithMessage('Barang tidak ditemukan.');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $barang_name = htmlspecialchars(trim($_POST['barang_name'] ?? ''));
            $supplier_id = intval($_POST['supplier_id'] ?? 0);
            $supplier_phone = htmlspecialchars(trim($_POST['supplier_phone'] ?? ''));
            $supplier_email = htmlspecialchars(trim($_POST['supplier_email'] ?? ''));
            $barang_price = floatval($_POST['barang_price'] ?? 0);
            $barang_quantity = intval($_POST['barang_quantity'] ?? 0);
            $barang_penerima = htmlspecialchars(trim($_POST['barang_penerima'] ?? ''));
            $invoice_id = htmlspecialchars(trim($_POST['invoice_id'] ?? ''));
            $product_picture = $barang['product_picture'];

            if (isset($_FILES['product_picture']) && $_FILES['product_picture']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['product_picture']['tmp_name'];
                $fileName = time() . '_' . basename($_FILES['product_picture']['name']);
                $uploadDir = './uploads/product_pictures/';
                $destPath = $uploadDir . $fileName;

                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (in_array($fileExtension, $allowedExtensions)) {
                    if (move_uploaded_file($fileTmpPath, $destPath)) {
                        $product_picture = $fileName;
                    } else {
                        echo "Failed to upload product picture.";
                        include './views/inventory/inventory_update.php';
                        return;
                    }
                } else {
                    echo "Invalid file type.";
                    include './views/inventory/inventory_update.php';
                    return;
                }
            }

            if (empty($barang_name)) {
                $errorMessage = "Nama barang wajib diisi.";
            } elseif ($supplier_id <= 0) {
                $errorMessage = "Supplier tidak valid.";
            } else {
                if ($this->modelBarang->updateBarang($barang_id, $invoice_id, $supplier_id, $supplier_phone, $supplier_email, $barang_name, $barang_price, $barang_quantity, $barang_penerima, $product_picture)) {
                    $this->redirectToListWithMessage('Barang berhasil diperbarui.');
                } else {
                    $errorMessage = "Gagal memperbarui barang.";
                }
            }
        }

        $suppliers = $this->modelSupplier->getAllSuppliers();

        include './views/inventory/inventory_update.php';
    }

    public function deleteBarang($barang_id) {
        if ($this->modelBarang->deleteBarang($barang_id)) {
            $this->redirectToListWithMessage('Barang berhasil dihapus.');
        } else {
            $this->redirectToListWithMessage('Gagal menghapus barang.');
        }
    }

    public function searchBarang() {
        $keyword = htmlspecialchars(trim($_GET['keyword'] ?? ''));
        $barangs = $this->modelBarang->searchBarangByName($keyword);
        include './views/inventory_search.php';
    }

    private function redirectToList() {
        header('Location: index.php?modul=inventory&fitur=list');
        exit();
    }

    private function redirectToListWithMessage($message) {
        header('Location: index.php?modul=inventory&fitur=list&message=' . urlencode($message));
        exit();
    }

    public function sortInventory($criteria, $order) {
        if ($criteria == 'name') {
            $barangs = $this->modelBarang->sortInventoryByName($order);
        } elseif ($criteria === 'id') {
            $barangs = $this->modelBarang->sortInventoryById($order);
        } else {
            $barangs = $this->modelBarang->getBarangs();
        }
        include './views/inventory/inventory_list.php';
    }

    public function filterBarang() {
        $filters = [
            'barang_name' => isset($_POST['barang_name']) ? $_POST['barang_name'] : '',
            'min_price' => isset($_POST['min_price']) ? $_POST['min_price'] : '',
            'max_price' => isset($_POST['max_price']) ? $_POST['max_price'] : '',
            'min_quantity' => isset($_POST['min_quantity']) ? $_POST['min_quantity'] : '',
            'supplier_id' => isset($_POST['supplier_id']) ? $_POST['supplier_id'] : '',
            'start_date' => isset($_POST['start_date']) ? $_POST['start_date'] : '',
            'end_date' => isset($_POST['end_date']) ? $_POST['end_date'] : '',
        ];
    
        if (!empty($filters['min_price']) && !is_numeric($filters['min_price'])) {
        }
    
        $barangs = $this->modelBarang->filterBarangs($filters);
        
        include './views/inventory/inventory_list.php';
    }

    public function exportToPDF() {
        require_once 'vendor/autoload.php';
    
        $barangs = $this->modelBarang->getBarangs();
        $user = $_SESSION['username'] ?? 'Unknown User';
        $printDate = date('d M Y, H:i');
        $uniqueCode = uniqid();
    
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Warehouse Management System');
        $pdf->SetTitle('Rekap Inventory Barang');
        $pdf->SetHeaderData('', 0, 'Rekap Inventory Barang', 'Generated by WMS');
        $pdf->setHeaderFont(['helvetica', '', 12]);
        $pdf->setFooterFont(['helvetica', '', 10]);
        $pdf->SetMargins(15, 27, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(TRUE, 25);
    
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 12);
    
        $pdf->Cell(0, 10, 'Rekap Inventory Barang', 0, 1, 'C');
        $pdf->Ln(5);
    
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 10, 'User: ' . htmlspecialchars($user), 0, 1, 'L');
        $pdf->Cell(0, 10, 'Print Date: ' . $printDate, 0, 1, 'L');
        $pdf->Cell(0, 10, 'Unique Code: ' . $uniqueCode, 0, 1, 'L');
        $pdf->Ln(5);
    
        $pdf->write1DBarcode($uniqueCode, 'C128', '', '', 50, 20, 0.4, ['position' => 'R', 'border' => false, 'padding' => 4, 'fgcolor' => [0, 0, 0], 'bgcolor' => false], 'N');
        $pdf->Ln(2);
        $pdf->Cell(0, 10, $uniqueCode, 0, 1, 'R');
        $pdf->Ln(8);
    
        $pdf->SetFillColor(200, 220, 255);
        $pdf->Cell(20, 10, 'ID', 1, 0, 'C', 1);
        $pdf->Cell(40, 10, 'Nama Barang', 1, 0, 'C', 1);
        $pdf->Cell(40, 10, 'Nama Supplier', 1, 0, 'C', 1);
        $pdf->Cell(20, 10, 'Quantity', 1, 0, 'C', 1);
        $pdf->Cell(30, 10, 'Price', 1, 0, 'C', 1);
        $pdf->Cell(30, 10, 'Tanggal', 1, 1, 'C', 1);
    
        foreach ($barangs as $barang) {
            $pdf->Cell(20, 10, htmlspecialchars($barang['barang_id']), 1, 0, 'C');
            $pdf->Cell(40, 10, htmlspecialchars($barang['barang_name']), 1, 0, 'C');
            $pdf->Cell(40, 10, htmlspecialchars($barang['supplier_name']), 1, 0, 'C');
            $pdf->Cell(20, 10, htmlspecialchars($barang['barang_quantity'] ?? 'N/A'), 1, 0, 'C');
            $pdf->Cell(30, 10, htmlspecialchars($barang['barang_price'] ?? 'N/A'), 1, 0, 'C');
            $pdf->Cell(30, 10, !empty($barang['created_at']) ? date('d M Y', strtotime($barang['created_at'])) : 'N/A', 1, 1, 'C');
        }
    
        $pdf->Output('Rekap_Inventory_Barang.pdf', 'I');
    }
}
