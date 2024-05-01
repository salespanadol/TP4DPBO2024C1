<?php
include("models/Template.class.php");
include("models/DB.class.php");
include("controllers/Members.controller.php");

$members = new MembersController();

// Add
if (!empty($_GET['id_add'])) {
    $members->add();
}
// Hapus
else if (!empty($_GET['id_hapus'])) {
    $id = $_GET['id_hapus'];
    $members->delete($id);
    header("location:index.php");
}
// Edit
else if (!empty($_GET['id_edit'])) {
    $id = $_GET['id_edit'];
    $members->edit($id);
}
// Tampilan data
else {
    $members->index();
}

