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
                      Tambah Produk
                            </div>
                            <div class="card-body">
                                <?php if(session('failed')) :?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= session('failed'); ?>
                                    </div>
                                <?php endif; ?>
                                <form action="/create-produk" method="post" enctype="multipart/form-data">
                                    <?=csrf_field(); ?>
                                    <div class="row">
                                        <div class="mb-3 col-6">
                                            <label for="nama_produk">Nama Produk</label>
                                            <input type="text" name="nama_produk" id="nama_produk" class="form-control<?= $validation->hasError('nama_produk') ?'is-invalid' :null ?>"required value="<?= old('nama_produk') ?>">
                                            <?php if($validation->hasError('nama_produk')):?>
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('nama_produk');
?>
                                                </div>
                                            <?php endif;?>
                                        </div> 
                                        <div class="mb-3 col-6">
                                            <label for="kategori_slug">Kategori</label>
                                            <select name="kategori_slug" id="kategori_slug" class="form-control">
                                                <option value="" hidden>
                                                    --PILIH--
                                                </option>
                                                <?php foreach($kategori_produk as $kategori): ?>
                                                    <?php if(old('kategori_slug')== $kategori->slug_kategori) :?>
                                                    <option value="<?= $kategori->slug_kategori;?>" selected><?=$kategori->nama_kategori; ?></option>
                                                    <?php else :?>
                                                        <option value="<?= $kategori->slug_kategori;?>"><?=$kategori->nama_kategori; ?></option>
                                                    <?php endif; ?>
                                                 <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control"><?= old('deskripsi') ?></textarea>
                                        </div> 
                                    <div class="mb-3">
                                            <label for="gambar_produk">gambar produk</label>
                                            <input type="file" name="gambar_produk" id="gambar_produk"class="form-control"onchange="previewImg()">
                                        </div> 
                                        <img src="" alt="" class="preview-img mt-2" width="100px">
                                    <div class="justify-content-end d-flex">
                                        <button class="btn btn-primary btn-sm">Tambah</button>
                                    </div>                                                                      
                                    </form>
                                
                            </div>
                        </div>
                     </div>
                 </div>
                </main>
                <?=$this->endSection(); ?>
                <?= $this->Section('script'); ?>
                <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
                <script>
                        CKEDITOR.replace( 'deskripsi' );
                </script>
                <script>
                    function previewImg() {
    const gambar = document.querySelector('#gambar_produk');
    const imgPreview = document.querySelector('.preview-img');
    const fileGambar = new FileReader();

    fileGambar.readAsDataURL(gambar.files[0]);
    fileGambar.onload = function(e) {
        imgPreview.src = e.target.result;
    };
}

                </script>
                <?=$this->endSection(); ?>