<?php
include("conf.php");
include("models/Keterangan.class.php");
include("views/Keterangan.view.php");

class KeteranganController {
  // Atribut
  private $keterangan;

  // Constructor
  function __construct(){
    $this->keterangan = new Keterangan(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
  }

  // Controller untuk menampilkan tampilan index atau bagian tabel data keterangan
  public function index() {
    $this->keterangan->open();
    $this->keterangan->getKeterangan();
    
    $dataKeterangan = array();

    while($row = $this->keterangan->getResult()){
      array_push($dataKeterangan, $row);
    }

    $this->keterangan->close();

    $view = new KeteranganView();
    $view->render($dataKeterangan);
  }

  // Controller untuk bagian menambahkan data
  function add() {
    $view = new KeteranganView();
    
    // Jika menekan tombol submit
    if (isset($_POST['submit'])) {
      $dataKeterangan = array(
        'keterangan_anggota' => $_POST['keterangan_anggota']
      );
  
      $this->keterangan->open();
      $this->keterangan->addKeterangan($dataKeterangan);
      $this->keterangan->close();
  
      header("location:keterangan-index.php");
    } else { // Menampilkan form add keterangan
      $view->formKeterangan();
    }
  }

  // Controller untuk bagian edit data
  function edit($id)
  { 
    $view = new KeteranganView();

    // Jika menekan tombol submit
    if (isset($_POST['submit'])) {
        $dataKeterangan = array(
            'keterangan_id' => $id,
            'keterangan_anggota' => $_POST['keterangan_anggota']
        );

        $this->keterangan->open();
        $this->keterangan->editKeterangan($dataKeterangan);
        $this->keterangan->close();

        header("location:keterangan-index.php");
    } else { //Menampilkan form edit
        $this->keterangan->open();
        $this->keterangan->getKeteranganById($id);
        $row = $this->keterangan->getResult();
        $this->keterangan->close();

        $data = array(
            'keterangan_id' => $row['keterangan_id'],
            'keterangan_anggota' => $row['keterangan_anggota']
        );

        $view->formKeteranganEdit($data);
    }
  }

  // Controller untuk menghapus data
  function delete($id){
    $this->keterangan->open();
    $this->keterangan->deleteKeterangan($id);
    $this->keterangan->close();

    header("location:keterangan-index.php");
  }

}