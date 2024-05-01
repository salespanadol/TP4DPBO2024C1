<?php
include("models/Template.class.php");
include("models/DB.class.php");
include("controllers/Keterangan.controller.php");

$keterangan = new KeteranganController();

// Add
if (!empty($_GET['id_add'])) {
    $keterangan->add();
} 
// Hapus
else if (!empty($_GET['id_hapus'])) {
    $id = $_GET['id_hapus'];
    $keterangan->delete($id);

    header("location:keterangan-index.php");
} 
// Edit
else if (!empty($_GET['id_edit'])) {
    $id = $_GET['id_edit'];
    $keterangan->edit($id);
} 
// Tampilan data
else {
    $keterangan->index();
}
