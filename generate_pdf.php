<?php
require_once('vendor/autoload.php');

include './config/db_connect.php';
include './model/model_barang.php';

$modelBarang = new ModelBarang($conn);
$barangs = $modelBarang->getAllBarangs();

$pdf = new \TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Rekap Inventory Barang');
$pdf->SetSubject('Inventory Report');
$pdf->SetKeywords('TCPDF, PDF, inventory');

$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Rekap Inventory Barang', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('helvetica', '', 12);
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(30, 10, 'Inventory ID', 1, 0, 'C', 1);
$pdf->Cell(50, 10, 'Inventory Name', 1, 0, 'C', 1);
$pdf->Cell(50, 10, 'Supplier Name', 1, 0, 'C', 1);
$pdf->Cell(30, 10, 'Created At', 1, 1, 'C', 1);

foreach ($barangs as $barang) {
    $pdf->Cell(30, 10, htmlspecialchars($barang['barang_id']), 1, 0, 'C');
    $pdf->Cell(50, 10, htmlspecialchars($barang['barang_name']), 1, 0, 'C');
    $pdf->Cell(50, 10, htmlspecialchars($barang['supplier_name']), 1, 0, 'C');
    $pdf->Cell(30, 10, !empty($barang['created_at']) ? date('d M Y', strtotime($barang['created_at'])) : 'N/A', 1, 1, 'C');
}

$pdf->Output('inventory_rekap.pdf', 'I');
?>
