<?php

namespace App\Controllers;

use App\Libraries\GroceryCrud;
use App\Models\CustomerModel;

class Customer extends BaseController
{

    public function index()
    {
        $customer_model = new CustomerModel();
        $crud = new GroceryCrud();
        $crud->setTable('customer'); //menghubungkan dgn table database, langsung panggil table nya

        //Pengaturan dasar Grocery Crud
        //Bahasa
        $crud->setLanguage('English');

        //Tampil dan ubah kolom
        $crud->columns(['name', 'no_customer', 'gender', 'address', 'email', 'phone']); //tampil kolom
        $crud->unsetColumns(['created_at', 'updated_at']); //tidak tampil kolom

        //Ubah nama kolom
        $crud->displayAs(array(
            'name' => 'Nama',
            'gender' => 'L/P',
            'address' => 'Alamat',
            'phone' => 'Telp'
        ));

        //Filter data
        $crud->where('deleted_at', null);

        //Pengaturan form
        $crud->unsetAddFields(['created_at', 'deleted_at', 'updated_at']);
        $crud->unsetEditFields(['created_at', 'deleted_at', 'updated_at']);

        //Validation
        $crud->setRule('name', 'Nama', 'required', [
            'required' => '{field} harus diisi!'
        ]);
        $crud->setRule('no_customer', 'No customer', 'required', [
            'required' => '{field} harus diisi!'
        ]);
        $crud->setRule('gender', 'Jenis kelamin', 'required', [
            'required' => '{field} harus diisi!'
        ]);
        $crud->setRule('address', 'Alamat', 'required', [
            'required' => '{field} harus diisi!'
        ]);
        $crud->setRule('email', 'Email', 'required', [
            'required' => '{field} harus diisi!'
        ]);
        $crud->setRule('phone', 'No Telp', 'required', [
            'required' => '{field} harus diisi!'
        ]);
        $crud->setRule('created_at', 'Tanggal pembuatan', 'required', [
            'required' => '{field} harus diisi!'
        ]);


        //Button
        // $crud->unsetAdd(); //Nonaktifkan tombol Tambah Data
        // $crud->unsetEdit(); //Nonaktifkan tombol Edit Data
        // $crud->unsetDelete(); //Nonaktifkan tombol Delete Data
        // $crud->unsetExport(); //Nonaktifkan tombol Export Data
        // $crud->unsetPrint(); //Nonaktifkan tombol Print Data

        //Relasi Tabel
        // $crud->setRelation('officecode', 'offices', 'city');

        //Tema
        $crud->setTheme('datatables'); //flexgrid->tema lainnya, bootstrap->berbayar

        //CallBack
        $crud->callbackInsert(function ($stateParameters) use ($customer_model) {
            $customer_model->save($stateParameters->data);
            return $stateParameters;
        });

        // $crud->callbackUpdate(function ($stateParameters) use ($customer_model) {
        //     $customer_model->save($stateParameters->data);
        //     return $stateParameters;
        // }); blm nemu caranya

        $crud->callbackDelete(function ($stateParameters) use ($customer_model) {
            $customer_model->delete($stateParameters->primaryKeyValue);
            return $stateParameters;
        });

        $output = $crud->render();

        $data = [
            'title' => 'Data Customer',
            'result' => $output
        ];

        return view('customer/index', $data);
    }
}
