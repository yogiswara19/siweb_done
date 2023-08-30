<?= $this->extend('auth/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header">
                        <h3 class="text-center font-weight-light my-4">Register</h3>
                    </div>
                    <div class="card-body">
                        <!-- < ?= view('Myth\Auth\Views\_message_block') ?> -->

                        <?php if (isset($validation)) : ?>
                            <div class="alert alert-danger"><?= $validation->listerrors() ?></div>
                        <?php endif ?>

                        <form action="/login/save" method="post">
                            <?= csrf_field() ?>

                            <!-- Email -->
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" placeholder="Email" value="<?= old('email') ?>">
                                <label for="inputEmail">Email</label>
                            </div>

                            <!-- Username -->
                            <div class="form-floating mb-3">
                                <input type="username" class="form-control <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="Username" value="<?= old('username') ?>">
                                <label for="inputusername">Username</label>
                            </div>

                            <!-- Password -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input type="password" name="password" class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="Password" autocomplete="off">
                                        <label for="inputPassword">Password</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating mb-3 mb-md-0">
                                        <input type="password" name="pass_confirm" class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="Repeat Password" autocomplete="off">
                                        <label for="inputPasswordConfirm">Repeat Password</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 mb-0">
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small">Sudah Punya Akun ? <a href="/login">Login</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endsection() ?>