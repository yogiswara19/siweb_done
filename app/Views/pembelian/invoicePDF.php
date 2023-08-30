<html>

<head>
    <!-- Berisi CSS untuk desain-->
    <style>
        .title {
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
        }

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }

        .border-table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            text-align: center;
            font-size: 12px;
        }

        .border-table th {
            border: 1px solid #000;
            background-color: #e1e3e9;
            font-weight: bold;
        }

        .border-table td {
            border: 1px solid #000;
        }
    </style>
</head>

<body>
    <main>
        <div class="title">
            <h1>Invoice Pembelian</h1>
        </div>
        <div>
            <!-- Isi Laporan tabel transaksi-->
            <table class="border-table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Nota</th>
                        <th width="15%">Tanggal Transaksi</th>
                        <th width="20%">Judul Komik</th>
                        <th width="15%">Jumlah Komik</th>
                        <th width="15%">Harga</th>
                        <th width="15%">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($result as $value) : ?>
                        <tr>
                            <?php if ($no == 2) : ?>
                                <td width="5%"> </td>
                                <td width="15%"> </td>
                                <td width="15%"> </td>
                            <?php endif ?>
                            <?php if ($no == 1) : ?>
                                <td width="5%"><?= $no++ ?></td>
                                <td width="15%"><?= $value['buy_id'] ?></td>
                                <td width="15%">
                                    <?= date("d/m/y H:i:s", strtotime($value['tgl_transaksi'])) ?>
                                </td>
                            <?php endif ?>
                            <td width="20%"><?= $value['name'] ?></td>
                            <td width="15%"><?= $value['qty'] ?></td>
                            <td width="15%" class="right">
                                <?= number_to_currency($value['price'], 'IDR', 'id_ID', 2) ?>
                            </td>
                            <td width="15%" class="right">
                                <?= number_to_currency($value['total'], 'IDR', 'id_ID', 2) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!--  -->
        </div>
    </main>
</body>

</html>