<?php

class Keterangan extends DB
{
    // Mengambil data keterangan
    function getKeterangan()
    {
        $query = "SELECT * FROM keterangan";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // Mengambil data keterangan berdasarkan id
    function getKeteranganById($id)
    {
        $query = "SELECT * FROM keterangan WHERE keterangan_id=$id";
        
        // Mengeksekusi query
        return $this->execute($query);
    }

    // Menambah data keterangan
    function addKeterangan($data)
    {
        // Data tabel keterangan
        $keterangan = $data['keterangan_anggota'];
    
        // Operasi add
        $query = "INSERT INTO keterangan (`keterangan_anggota`) VALUES ('$keterangan')";
    
        // Mengeksekusi query
        return $this->execute($query);
    }

    // Mengedit data keterangan
    function editKeterangan($data)
    {
        // Data tabel keterangan
        $id = $data['keterangan_id'];
        $keterangan_anggota = $data['keterangan_anggota'];

        // Operasi edit
        $query = "UPDATE keterangan SET keterangan_anggota = '$keterangan_anggota' WHERE keterangan_id = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // Menghapus data keterangan
    function deleteKeterangan($id)
    {
        // Operasi delete
        $query = "DELETE FROM keterangan WHERE keterangan_id=$id";

        // Mengeksekusi query
        return $this->execute($query);
    }

}
