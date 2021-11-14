<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table            = 'barang';
    protected $allowedFields    = ['id_barang', 'nama_barang', 'spesifikasi', 'lokasi', 'kondisi', 'jumlah_barang', 'sumber_dana'];

    public function getnewid()
    {
        $query = $this->db->query("SELECT get_newidbarang()");
        $row = $query->getRowArray();
        return $row;
    }

    public function tambahBrgKeluar($id, $keluar, $supplier)
    {
        $this->db->query("CALL tambah_barangkeluar('$id',$keluar,'$supplier')");
    }
}
