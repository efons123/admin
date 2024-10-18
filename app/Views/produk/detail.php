<?=$this->extend('layout/template'); ?>

<?=$this->Section('content') ?>
<div id="layoutSidenav_content">
<main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?= $title ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active"><?= $title ?></li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                            <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                           Daftar Produk
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Nama Produk</th><td><?= $data_produk->nama_produk ?></td>
                                </tr>    
                                <tr>
                                    <th>Slug Produk</th> 
                                    <td><?= $data_produk->slug_produk ?></td>
                                </tr>
                                <tr>
                                    <th>Kategori Slug</th> <td><?= $data_produk->kategori_slug ?></td>
                                </tr>
                                <tr>
                                    <th>deskripsi</th> <td><?= $data_produk->deskripsi ?></td>
                                </tr>
                                <tr>
                                    <th>gambar Produk</th><td><img src=" <?=base_url('asset-admmin/img/'. $data_produk->gambar_produk) ?> "alt="" witdh="5%"></td>
                                </tr>
                                <tr>
                                    <th>tanggal Input</th><td><?= $data_produk->tanggal_input ?></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Ubah</th><td><?= $data_produk->tanggal_ubah ?></td>
                                    
                                </tr>

                            </table>
                            </div>
                        </div>
                     </div>
                 </div>
                </main>
  

<?=$this->endSection(); ?>