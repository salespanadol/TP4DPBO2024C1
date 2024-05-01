<?php

class Members extends DB
{
    // Mengambil data member kemudian join dengan data keterangan
    function getMembers()
    {
        // Operasi join
        $query = "SELECT members.id, members.name, members.email, members.phone, members.join_date, keterangan.keterangan_anggota
              FROM members
              JOIN keterangan ON members.keterangan_id = keterangan.keterangan_id
              ORDER BY members.id";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // Mengambil data member berdasarkan id
    function getMembersById($id)
    {
        $query = "SELECT * FROM members WHERE id = '$id'";
        $this->open();
        $this->execute($query);
        $result = $this->getResult();
        $this->close();

        // Mengambil result berupa id
        return $result;
    }

    // Menambah data member
    function addMembers($data)
    {
        // Data tabel members
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $join = $data['join_date'];
        $keterangan = $data['keterangan_id'];

        // Operasi add
        $query = "INSERT INTO members (`name`, `email`, `phone`,`join_date`, `keterangan_id`) VALUES ('$name', '$email', '$phone', '$join', $keterangan)";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // Mengedit data member
    function editMembers($data)
    {
        // Data tabel members
        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $join = $data['join_date'];
        $keterangan = $data['keterangan_id'];

        // Operasi edit
        $query = "UPDATE members SET name='$name', email='$email', phone='$phone', join_date='$join', keterangan_id='$keterangan'WHERE id=$id";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // Menghapus data member
    function deleteMembers($id)
    {
        // Operasi delete
        $query = "DELETE FROM members WHERE id=$id";

        // Mengeksekusi query
        return $this->execute($query);
    }

}
