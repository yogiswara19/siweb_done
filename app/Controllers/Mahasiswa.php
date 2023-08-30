<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Models\MahasiswaModel;

class Mahasiswa extends BaseController
{

    public function index()
    {
        $mahasiswa_model = new MahasiswaModel();
        $crud = new GroceryCrud();
        $crud->setTable('mahasiswa_1087'); //menghubungkan dgn table database, langsung panggil table nya

        //Pengaturan dasar Grocery Crud
        //Bahasa
        $crud->setLanguage('Indonesian');

        //Tampil dan ubah kolom
        $crud->columns(['nama', 'tempat_lahir', 'jenis_kelamin', 'hobi', 'kategori_favorit']); //tampil kolom
        // $crud->unsetColumns(['created_at', 'updated_at']); //tidak tampil kolom

        //Ubah nama kolom
        $crud->displayAs(array(
            'nama' => 'Nama',
            'tempat_lahir' => 'Tempat Lahir',
            'jenis_kelamin' => 'L/P',
            'hobi' => 'Hobi',
            'kategori_favorit' => 'Kategori Favorit'
        ));

        //Filter data
        $crud->where('deleted_at', null);

        //Pengaturan form
        $crud->unsetAddFields(['created_at', 'deleted_at', 'updated_at']);
        $crud->unsetEditFields(['created_at', 'deleted_at']);

        //Validation
        $crud->setRule('nama', 'Nama', 'required', [
            'required' => '{field} harus diisi!'
        ]);
        $crud->setRule('tempat_lahir', 'Tempat lahir', 'required', [
            'required' => '{field} harus diisi!'
        ]);
        $crud->setRule('jenis_kelamin', 'Jenis kelamin', 'required', [
            'required' => '{field} harus diisi!'
        ]);
        $crud->setRule('hobi', 'Hobi', 'required', [
            'required' => '{field} harus diisi!'
        ]);
        $crud->setRule('kategori_favorit', 'Kategori favorit', 'required', [
            'required' => '{field} harus diisi!'
        ]);


        //Button
        // $crud->unsetAdd(); //Nonaktifkan tombol Tambah Data
        // $crud->unsetEdit(); //Nonaktifkan tombol Edit Data
        // $crud->unsetDelete(); //Nonaktifkan tombol Delete Data
        // $crud->unsetExport(); //Nonaktifkan tombol Export Data
        // $crud->unsetPrint(); //Nonaktifkan tombol Print Data

        // Relasi Tabel
        $crud->setRelation('kategori_favorit', 'book_category', 'name_category');

        //Tema
        $crud->setTheme('datatables'); //flexgrid->tema lainnya, bootstrap->berbayar

        //CallBack
        $crud->callbackInsert(function ($stateParameters) use ($mahasiswa_model) {
            $mahasiswa_model->save($stateParameters->data);
            return $stateParameters;
        });

        // $crud->callbackUpdate(function ($stateParameters) use ($mahasiswa_model) {
        //     $mahasiswa_model->save($stateParameters->data);
        //     return $stateParameters;
        // }); //blm nemu caranya

        $crud->callbackDelete(function ($stateParameters) use ($mahasiswa_model) {
            $mahasiswa_model->delete($stateParameters->primaryKeyValue);
            return $stateParameters;
        });


        $output = $crud->render();

        $data = [
            'title' => 'Data Mahasiswa',
            'result' => $output
        ];

        return view('mahasiswa/index', $data);
    }
}
