<?php
    class KeteranganView{
      // Untuk menampilkan bagian index tabel data keterangan
      public function render($data){
        $no = 1;
        $dataKeterangan = null;
        $dataHeader = null;
        $keteranganIndex = null;
        $homeLabel = null;
        $addNew = null;

        // Navbar
        $homeLabel .= "index.php";
        $keteranganIndex .= "keterangan-index.php";

        // Menyimpan variabel link add
        $addNew .= "keterangan-index.php?id_add=1";

        // Header tabel
        $dataHeader .= "
        <thead>
          <tr>
            <th>ID</th>
            <th>KETERANGAN</th>
            <th>ACTIONS</th>
          </tr>
        </thead>";
        
        // Tabel data keterangan
        foreach($data as $val){
          list($id, $keteranganAnggota) = $val;
              $dataKeterangan .= "<tr>
                      <td>" . $no++ . "</td>
                      <td>" . $keteranganAnggota . "</td>
                      <td>
                      <a href='keterangan-index.php?id_edit=" . $id .  "' class='btn btn-warning''>Edit</a>
                      <a href='keterangan-index.php?id_hapus=" . $id . "' class='btn btn-danger' onclick='return confirmDelete()'>Hapus</a>
                      </td>
                      </tr>";
        }
  
        // Membuka template baru
        $tpl = new Template("templates/skin.html");

        // Menukar isi variabel
        $tpl->replace("HOME_LABEL", $homeLabel);
        $tpl->replace("KETERANGAN_INDEX", $keteranganIndex);
        $tpl->replace("ADD_NEW", $addNew);
        $tpl->replace("DATA_HEADER", $dataHeader);
        $tpl->replace("DATA_TABEL", $dataKeterangan);
        $tpl->write();
      }

      // Form add data keterangan
      public function formKeterangan(){
        $crudLabel = null;
        $homeLabel = null;
        $processLabel = null;
        $formControl = null;
        $cancelLabel = null;
        $addNew = null;

        // Navbar
        $crudLabel .= "keterangan-index.php";
        $homeLabel .= "index.php";
        
        // Judul
        $processLabel .= "Create New Keterangan";

        // Menyimpan variabel link add
        $addNew .= "keterangan-index.php?id_add=1";

        // Form keterangan
        $formControl .= "
        <label>KETERANGAN:</label>
        <input type='text' name='keterangan_anggota' class='form-control'> 
        <br>";

        // Button cancel
        $cancelLabel .= "keterangan-index.php";

        // Membuka template baru
        $tpl = new Template("templates/skinform.html");

        // Menukar isi variabel
        $tpl->replace("CRUD_LABEL", $crudLabel);
        $tpl->replace("HOME_LABEL", $homeLabel);
        $tpl->replace("ADD_NEW", $addNew);
        $tpl->replace("PROCESS_LABEL", $processLabel);
        $tpl->replace("FORM_CONTROL", $formControl);
        $tpl->replace("CANCEL_LABEL", $cancelLabel);
        $tpl->write();
      }

      // Form edit
      public function formKeteranganEdit($data = null)
      {
          $crudLabel = null;
          $homeLabel = null;
          $processLabel = null;
          $formControl = null;
          $cancelLabel = null;
          $addNew = null;

          // Navbar
          $crudLabel .= "keterangan-index.php";
          $homeLabel .= "index.php";
          
          // Judul
          $processLabel .= "Edit Keterangan";

          // Menyimpan variabel link add
          $addNew .= "keterangan-index.php?id_add=1";

          // Form edit keterangan
          $formControl .= "
          <label>KETERANGAN:</label>
          <input type='text' name='keterangan_anggota' class='form-control' value='" . ($data ? $data['keterangan_anggota'] : "") . "'> 
          <br>";

          // Button cancel
          $cancelLabel .= "keterangan-index.php";

          // Membuka template baru
          $tpl = new Template("templates/skinform.html");

          // Menukar isi variabel
          $tpl->replace("CRUD_LABEL", $crudLabel);
          $tpl->replace("HOME_LABEL", $homeLabel);
          $tpl->replace("ADD_NEW", $addNew);
          $tpl->replace("PROCESS_LABEL", $processLabel);
          $tpl->replace("FORM_CONTROL", $formControl);
          $tpl->replace("CANCEL_LABEL", $cancelLabel);
          $tpl->write();
      }
    }

?>