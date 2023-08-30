<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">DATA USER</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengelolaan Data User</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>
            <div class="card-body">

                <!-- Form Tambah User -->
                <form action="<?= base_url('users/create') ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 colfor m-label">Nama Depan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="firstname">
                        </div>

                        <label for="name" class="col-sm-2 colfor m-label">Nama Belakang</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="lastname">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="username" class="col-sm-2 colform-label">Username</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="user_name">
                        </div>

                        <label for="email" class="col-sm-2 col-formlabel">Email</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="user_email">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="username" class="col-sm-2 colform-label">Role</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="role">
                                <option value="Karyawan">Karyawan</option>
                                <option value="Karyawan">Manajer</option>
                                <option value="Admin">Admin</option>
                                <option value="Owner">Owner</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="inputPassword">Password</label>
                        <div class="col-sm4">
                            <input class="form-control <?php if (session('errors.password')) : ?>isinvalid<?php endif ?>" name="password" id="inputPassword" type="password" placeholder="Password" autocomplate="off" />
                        </div>

                        <label for="inputPassword">Confirm Password</label>
                        <div class="col-sm4">
                            <div class="formfloating mb-3 mb-md-0">
                                <input class="form-control <?php if (session('errors.pass_confirm')) : ?>isinvalid<?php endif ?>" name="pass_confirm" id="inputPassword" type="password" placeholder="Confirm Password" autocomplate="off" />
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justifycontent-md-end">
                        <button class="btn btn-primary me-md-2" type="submit">Simpan</button>
                        <button class="btn btn-danger" type="reset">Batal</button>
                    </div>
            </div>
            </form>
            <!-- -->
        </div>
    </div>
    </div>
</main>
<?= $this->endSection() ?>