<?php
include("conf.php");
include("models/Members.class.php");
include("models/Keterangan.class.php");
include("views/Members.view.php");

class MembersController {
  // Atribut
  private $members;
  private $keterangan;

  // Constructor
  function __construct(){
    $this->members = new Members(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
    $this->keterangan = new Keterangan(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
  }

  // Controller untuk menampilkan tampilan index atau bagian tabel data member
  public function index() {
    $this->members->open();
    $this->members->getMembers();
    
    $dataMembers = array();

    while($row = $this->members->getResult()){
      array_push($dataMembers, $row);
    }

    $this->members->close();

    $view = new MembersView();
    $view->render($dataMembers);
  }

  // Controller untuk bagian menambahkan data
  function add() {
    $view = new MembersView();
  
    // Jika menekan tombol submit
    if (isset($_POST['submit'])) {
      $dataMembers = array(
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'join_date' => $_POST['join_date'],
        'keterangan_id' => $_POST['keterangan_id']
      );
  
      $this->members->open();
      $this->members->addMembers($dataMembers);
      $this->members->close();
  
      header("location:index.php");
    } else { // Menampilkan form add member
      $dataKeterangan = $this->getKeteranganOptions();
      $view->formMembers($dataKeterangan);
    }
  }

  // Controller untuk bagian edit data
  function edit($id)
  {
    $view = new MembersView();

    // Jika menekan tombol submit
    if (isset($_POST['submit'])) {
        $dataMembers = array(
            'id' => $id,
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'join_date' => $_POST['join_date'],
            'keterangan_id' => $_POST['keterangan_id']
        );

        $this->members->open();
        $this->members->editMembers($dataMembers);
        $this->members->close();

        header("location:index.php");
    } else { //Menampilkan form edit
        $members = $this->members->getMembersById($id);
        $dataKeterangan = $this->getKeteranganOptions();
        $view->formMembersEdit($dataKeterangan, $members);
    }
  }

  // Controller untuk menghapus data
  function delete($id){
    $this->members->open();
    $this->members->deleteMembers($id);
    $this->members->close();

    header("location:index.php");
  }

  // Controller dropdown keterangan
  function getKeteranganOptions() {
    $this->keterangan->open();
    $this->keterangan->getKeterangan();
    
    $dataKeterangan = array();
  
    while($row = $this->keterangan->getResult()){
      array_push($dataKeterangan, $row);
    }
  
    $this->keterangan->close();
  
    return $dataKeterangan;
  }

}
