<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container">
        <h1 class="mt-4">Dashboard</h1>
        <div class="row bg-warning" align='middle' style="height: 50vh;">

            <div class="col-4 bg-warning" style="height: 50vh;">
                <img src="img/DSC_6071-removebg-preview.png" class="rounded-circle" style="height: 50%; padding-top: 30px;">
                <h5>Biodata</h5>
                <p>Nama : Gregorius Yogiswara V W</p>
                <p>TTL : 05 Oktober 2002</p>
                <p>NPM : 211711087</p>
            </div>

            <div class="col-8 p-2">
                <div class="bg-primary h-100 d-flex flex-column align-items-center justify-content-center" style="height: 50vh;">
                    <img src="img/UAJY-LOGOGRAM_-01.png" width="200" height="200">
                    <p>UAJY</p>
                    <p>SIWEB mantab</p>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>