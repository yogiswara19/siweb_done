<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= strtoupper($title) ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengelolaan <?= $title ?></li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>

            <div class="card-body">
                <!-- Form Tambah Buku -->
                <form action="<?= route_to('book/create') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="mb-3 row">
                        <label for="title" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= $validation->hasError('title') ? 'is-invalid' : '' ?>" id="title" name="title" value="<?= old('title') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('title') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="author" class="col-sm-2 col-form-label">Penulis</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= $validation->hasError('author') ? 'is-invalid' : '' ?>" id="author" name="author" value="<?= old('author') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('author') ?>
                            </div>
                        </div>
                    </div>
                    <div class=" mb-3 row">
                        <label for="release_year" class="col-sm-2 col-form-label">Tahun Terbit</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control <?= $validation->hasError('release_year') ? 'is-invalid' : '' ?>" id="release_year" name="release_year" value="<?= old('release_year') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('release_year') ?>
                            </div>
                        </div>
                        <label for="stock" class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control <?= $validation->hasError('stock') ? 'is-invalid' : '' ?>" id="stock" name="stock" value="<?= old('stock') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('stock') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="price" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control <?= $validation->hasError('price') ? 'is-invalid' : '' ?>" id="price" name="price" value="<?= old('price') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('price') ?>
                            </div>
                        </div>
                        <label for="discount" class="col-sm-2 col-form-label">Diskon</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control <?= $validation->hasError('discount') ? 'is-invalid' : '' ?>" id="discount" name="discount" value="<?= old('discount') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('discount') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="cover" class="col-sm-2 col-form-label">Cover</label>
                        <div class="col-sm-5">
                            <input type="file" class="form-control <?= $validation->hasError('cover') ? 'is-invalid' : '' ?>" id="cover" name="cover" value="<?= old('cover') ?>" onchange="previewImage()">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('cover') ?>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <img src="/img/default.png" alt="" class="img-thumbnail img-preview">
                            </div>
                        </div>
                        <label for="price" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-3">
                            <select type="text" class="form-control" id="book_category_id" name="book_category_id">
                                <?php foreach ($book_category as $value) : ?>
                                    <option value="<?= $value['book_category_id'] ?>">
                                        <?= $value['name_category'] ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-primary me-md-2" type="submit">Simpan</button>
                        <button class="btn btn-danger me-md-2" type="reset">Batal</button>
                        <a href="/book" class="btn btn-dark">Kembali</a>
                    </div>
                </form>
                <!--  -->
            </div>
        </div>
    </div>
</main>
<?= $this->endsection() ?>