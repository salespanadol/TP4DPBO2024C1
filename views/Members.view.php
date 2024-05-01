<?php
    class MembersView{
      // Untuk menampilkan bagian index tabel data member
      public function render($data){
        $no = 1;
        $dataMembers = null;
        $dataHeader = null;
        $keteranganIndex = null;
        $homeLabel = null;
        $addNew = null;
        
        // Navbar
        $homeLabel .= "index.php";
        $keteranganIndex .= "keterangan-index.php";

        // Menyimpan variabel link add
        $addNew .= "index.php?id_add=1";

        // Header tabel
        $dataHeader .= "
        <thead>
          <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>PHONE</th>
            <th>JOINING DATE</th>
            <th>KETERANGAN</th>
            <th>ACTIONS</th>
          </tr>
        </thead>";

        // Tabel data members
        foreach($data as $val){
          list($id, $name, $email, $phone, $join, $keterangan_anggota) = $val;
              $dataMembers .= "
              <tbody>
                      <tr>
                      <td>" . $no++ . "</td>
                      <td>" . $name . "</td>
                      <td>" . $email . "</td>
                      <td>" . $phone . "</td>
                      <td>" . $join . "</td>
                      <td>" . $keterangan_anggota . "</td>
                      <td>
                      <a href='index.php?id_edit=" . $id .  "' class='btn btn-warning''>Edit</a>
                      <a href='index.php?id_hapus=" . $id . "' class='btn btn-danger' onclick='return confirmDelete()'>Hapus</a>
                      </td>
                      </tr>
              </tbody>";
              
        }
  
        // Membuka template baru
        $tpl = new Template("templates/skin.html");

        // Menukar isi variabel
        $tpl->replace("HOME_LABEL", $homeLabel);
        $tpl->replace("KETERANGAN_INDEX", $keteranganIndex);
        $tpl->replace("ADD_NEW", $addNew);
        $tpl->replace("DATA_HEADER", $dataHeader);
        $tpl->replace("DATA_TABEL", $dataMembers);
        $tpl->write();
      }

      // Form add data members
      public function formMembers($dataKeterangan) {
        $dropdownOptions = '';

        $crudLabel = null;
        $homeLabel = null;
        $processLabel = null;
        $formControl = null;
        $cancelLabel = null;
        $addNew = null;

        // Navbar
        $crudLabel .= "index.php";
        $homeLabel .= "index.php";
        
        // Judul
        $processLabel .= "Create New Keterangan";

        // Menyimpan variabel link add
        $addNew .= "index.php?id_add=1";

        // Form member
        $formControl .= "
          <label> NAME: </label>
          <input type='text' name='name' class='form-control'> <br>

          <label> EMAIL: </label>
          <input type='text' name='email' class='form-control'> <br>

          <label> PHONE: </label>
          <input type='text' name='phone' class='form-control'> <br>

          <label> JOINING DATE: </label>
          <input type='date' name='join_date' class='form-control'> <br>

          <label>KETERANGAN:</label>
          <select name='keterangan_id' class='form-control'>
            DROPDOWN
          </select><br>";

        // Button cancel
        $cancelLabel .= "index.php";
        
        // Dropdown keterangan
        foreach ($dataKeterangan as $keterangan) {
          $keteranganId = $keterangan['keterangan_id'];
          $keteranganAnggota = $keterangan['keterangan_anggota'];
          
          $dropdownOptions .= "<option value=\"$keteranganId\">$keteranganAnggota</option>";
        }
      
        // Membuka template baru
        $tpl = new Template("templates/skinform.html");
        
        // Menukar isi variabel
        $tpl->replace("CRUD_LABEL", $crudLabel);
        $tpl->replace("HOME_LABEL", $homeLabel);
        $tpl->replace("ADD_NEW", $addNew);
        $tpl->replace("PROCESS_LABEL", $processLabel);
        $tpl->replace("FORM_CONTROL", $formControl);
        $tpl->replace("CANCEL_LABEL", $cancelLabel);
        $tpl->replace("DROPDOWN", $dropdownOptions);
        $tpl->write();
      }
      
      // Form edit
      public function formMembersEdit($dataKeterangan, $member)
      {
          $dropdownOptions = '';
      
          $crudLabel = null;
          $homeLabel = null;
          $processLabel = null;
          $formControl = null;
          $cancelLabel = null;
          $addNew = null;
      
          // Navbar
          $crudLabel .= "index.php";
          $homeLabel .= "index.php";

          // Judul
          $processLabel .= "Edit Members";
      
          // Menyimpan variabel link add
          $addNew .= "index.php?id_add=1";
      
          // Form edit member
          $formControl .= "
              <label> NAME: </label>
              <input type='text' name='name' class='form-control' value='" . $member['name'] . "'> <br>
      
              <label> EMAIL: </label>
              <input type='text' name='email' class='form-control' value='" . $member['email'] . "'> <br>
      
              <label> PHONE: </label>
              <input type='text' name='phone' class='form-control' value='" . $member['phone'] . "'> <br>

              <label> JOINING DATE: </label>
              <input type='date' name='join_date' class='form-control' value='" . $member['join_date'] . "'> <br>
      
              <label>KETERANGAN:</label>
              <select name='keterangan_id' class='form-control'>
                  DROPDOWN
              </select><br>";
      
              // Button cancel
          $cancelLabel .= "index.php";
      
          // Dropdown keterangan
          foreach ($dataKeterangan as $keterangan) {
              $keteranganId = $keterangan['keterangan_id'];
              $keteranganAnggota = $keterangan['keterangan_anggota'];
      
              if ($keteranganId == $member['keterangan_id']) {
                  $dropdownOptions .= "<option value=\"$keteranganId\" selected>$keteranganAnggota</option>";
              } else {
                  $dropdownOptions .= "<option value=\"$keteranganId\">$keteranganAnggota</option>";
              }
          }
      
          // Membuka template baru
          $tpl = new Template("templates/skinform.html");

          // Menukar isi variabel
          $tpl->replace("CRUD_LABEL", $crudLabel);
          $tpl->replace("HOME_LABEL", $homeLabel);
          $tpl->replace("ADD_NEW", $addNew);
          $tpl->replace("PROCESS_LABEL", $processLabel);
          $tpl->replace("FORM_CONTROL", $formControl);
          $tpl->replace("CANCEL_LABEL", $cancelLabel);
          $tpl->replace("DROPDOWN", $dropdownOptions);
          $tpl->write();
      }
    }

?>