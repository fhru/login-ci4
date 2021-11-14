<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;

class Barang extends BaseController
{
    protected $BarangModel;
    public function __construct()
    {
        $this->BarangModel = new BarangModel();
    }
    public function index()
    {
        $newid = $this->BarangModel->getnewid();
        foreach ($newid as $id)
            $data = [
                'data' => $this->BarangModel->findAll(),
                'new_id' => $id
            ];
        return view('pages/barang', $data);
    }

    public function save()
    {
        $this->BarangModel->insert([
            'id_barang' => $this->request->getVar('id_barang'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'spesifikasi' => $this->request->getPost('spesifikasi'),
            'lokasi' => $this->request->getPost('lokasi'),
            'kondisi' => $this->request->getPost('kondisi'),
            'jumlah_barang' => $this->request->getPost('jumlah_barang'),
            'sumber_dana' => $this->request->getPost('sumber_dana'),
        ]);
        return redirect()->to('/barang')->with('msg', 'databerhasilditambahkan');
    }

    public function barangkeluar()
    {
        $id_barang = $this->request->getVar('id_barang');
        $jml_keluar = $this->request->getVar('jml_keluar');
        $id_supplier = $this->request->getVar('id_supplier');

        $this->BarangModel->tambahBrgKeluar($id_barang, $jml_keluar, $id_supplier);
        return redirect()->to('/');
    }
}
