<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KategoriModel;

class Produk extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Daftar Produk',
            'daftar_produk' => $this->ProdukModel->orderBy('id_produk','DESC')->findAll(),
        ];
        return view('produk/index', $data);
    }
    public function form_create()
    {
        $validation = \Config\Services::validation(); // Inisialisasi validasi

        $data = [
            'title' => 'Tambah Produk',
            'kategori_produk' =>$this->KategoriModel->findAll(),
            'validation' => $validation, // Pastikan ini adalah key-value yang benar
        ];
        return view('produk/create', $data);
    }
    public function create_produk()
    {
        $rules = $this->validate([
            'nama_produk' => 'required',
            'kategori_slug' => 'required',
            'deskripsi' => 'required',
            'gambar_produk' => 'uploaded[gambar_produk]|max_size[gambar_produk,2048]|is_image[gambar_produk]|mime_in[gambar_produk,image/png,image/jpeg,image/jpg]|ext_in[gambar_produk,png,jpg,jpeg]'

        ]);
        if (!$rules) {
            session()->setFlashdata('failed', 'Data produk gagal ditambahkan');
            return redirect()->to('http://localhost:8080/tambah')->withInput();
        }
        

         $slug = url_title($this->request->getPost('nama_produk'),'-',true);
         
         $gambar = $this->request->getFile('gambar_produk');
         $namaGambar = $gambar->getRandomName();
         $gambar->move(WRITEPATH. '../public/asset-admmin/img',$namaGambar);

        $this->ProdukModel->insert([
            'slug_produk'=>$slug,
            'nama_produk' => esc($this->request->getPost('nama_produk')),
            'kategori_slug' => esc($this->request->getPost('kategori_slug')),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'gambar_produk' => $namaGambar,
        ]);
        return redirect()->to('http://localhost:8080/produk')->with('success', 'Data Berhasil Ditambahkan');
    }
    public function update_produk($id_produk)
    {
        $rules = $this->validate([
            'nama_produk' => 'required',
            'kategori_slug' => 'required',
            'deskripsi' => 'required',
            'gambar_produk' => 'max_size[gambar_produk,2048]|is_image[gambar_produk]|mime_in[gambar_produk,image/png,image/jpeg,image/jpg]|ext_in[gambar_produk,png,jpg,jpeg]'

        ]);
        if (!$rules) {
            session()->setFlashdata('failed', 'Data produk gagal diubah');
            return redirect()->back()->withInput();
        }
        

         $slug = url_title($this->request->getPost('nama_produk'),'-',true);
         
         $gambar = $this->request->getFile('gambar_produk');
         if($gambar->getError()== 4){
            $namaGambar = $this->request->getPost('gambarLama');
         }else {
            $namaGambar = $gambar->getRandomName();
         $gambar->move(WRITEPATH. '../public/asset-admmin/img',$namaGambar);
         unlink(WRITEPATH. '../public/asset-admmin/img/'.$this->request->getPost('gambarLama'));
         }
         

        $this->ProdukModel->update($id_produk, [
            'slug_produk'=>$slug,
            'nama_produk' => esc($this->request->getPost('nama_produk')),
            'kategori_slug' => esc($this->request->getPost('kategori_slug')),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'gambar_produk' => $namaGambar,
        ]);
        return redirect()->to('http://localhost:8080/produk')->with('success', 'Data Berhasil Ditambahkan');
    }
    public function form_update($id_produk)
    {
        $validation = \Config\Services::validation(); // Inisialisasi validasi

        $data = [
            'title' => 'Ubah Produk',
            'data_produk' => $this->ProdukModel->find($id_produk),
            'kategori_produk' =>$this->KategoriModel->findAll(),
            'validation' => $validation, // Pastikan ini adalah key-value yang benar
        ];
        return view('produk/update', $data);
    }
    public function delete_produk($id_produk)
    {
       $produk= $this->ProdukModel->find($id_produk);
      unlink(WRITEPATH. '../public/asset-admmin/img/'. $produk->gambar_produk);
       $this->ProdukModel->delete($id_produk);

       return redirect()->to('http://localhost:8080/produk')->with('success', 'Data Berhasil hapus');
    }
    public function detail_produk($id_produk)
    {
        $data = [
            'title' => 'Detail Produk',
            'data_produk' => $this->ProdukModel->find($id_produk),
        ];
        return view('produk/detail', $data);
    }
    public function kategori()
    {
        $data = [
            'title' => 'Daftar Kategori',
            'daftar_kategori' => $this->KategoriModel->orderBy('id_kategori','DESC')->findAll(),
        ];
        return view('produk/kategori', $data);
    }
    public function store()
    {
        $slug = url_title($this->request->getPost('nama_kategori'),'-',true);

        $data =[
            'nama_kategori' => esc($this->request->getPost('nama_kategori')),
            'slug_kategori'=>$slug
        ];

        $this->KategoriModel->insert($data);
        return redirect()->back();
    }
    public function update($id_kategori)
    {
        $slug = url_title($this->request->getPost('nama_kategori'),'-',true);

        $data =[
            'nama_kategori' => esc($this->request->getPost('nama_kategori')),
            'slug_kategori'=>$slug
        ];

        $this->KategoriModel->update($id_kategori,$data);
        return redirect()->back();
    } 
    public function destroy($id_kategori)
    {
        $this->KategoriModel->where('id_kategori',$id_kategori)->delete();
        return redirect()->back();
    }
}
