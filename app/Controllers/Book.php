<?php

namespace App\Controllers;

use App\Models\BookCategoryModel;
use App\Models\BookModel;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

define('_TITLE', 'Buku');

class Book extends BaseController
{
    private $_book_model, $_book_category_model;

    public function __construct()
    {
        $this->_book_model = new BookModel();
        $this->_book_category_model = new BookCategoryModel();
    }

    public function index()
    {
        $data_book = $this->_book_model->getBook();
        $data = [
            'title' => _TITLE,
            'data_book' => $data_book
        ];
        // dd($data_book); // dd = vardump
        return view('book/index', $data);
    }

    public function detail($slug)
    {
        $data_book = $this->_book_model->getBook($slug);
        $data = [
            'title' => _TITLE,
            'data_book' => $data_book
        ];
        // dd($data_book);
        return view('book/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => _TITLE,
            'book_category' => $this->_book_category_model->orderBy('name_category')->findAll(),
            'validation' => \Config\Services::validation()
        ];
        // dd($book_category_model->findAll());
        return view('book/create', $data);
    }

    public function save()
    {
        // Validasi Data
        if (!$this->validate([
            'title' => [
                'rules' => 'required|is_unique[book.title]',
                'label' => 'Judul',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            'author' => 'required',
            'release_year' => 'required|numeric',
            'price' => 'required|numeric',
            'discount' => 'permit_empty|decimal',
            'stock' => 'required|numeric',
            'cover' => [
                'rules' => 'max_size[cover,1024]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Gambar tidak boleh lebih dari 1MB!',
                    'is_image' => 'Yang Anda pilih bukan gambar',
                    'mime_in' => 'Yang Anda pilih bukan gambar'
                ]
            ]
        ])) {
            // Berisi fungsi redirect jika validasi tidak memenuhi
            // dd(\Config\Services::validation()->getErrors());
            return redirect()->to('/book-create')->withInput();
        }

        // Mengambil file sampul
        $fileCover = $this->request->getFile('cover');
        if ($fileCover->getError() == 4) {
            $namaFile = $this->defaultImage;
        } else {
            // Generate Nama File
            $namaFile = $fileCover->getRandomName();
            // Pindahkan File ke Folder img di public
            $fileCover->move('img', $namaFile);
        }

        // dd($this->request->getVar('title'));
        $slug = url_title($this->request->getVar('title'), '-', true);
        if ($this->_book_model->save([
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'author' => $this->request->getVar('author'),
            'release_year' => $this->request->getVar('release_year'),
            'price' => $this->request->getVar('price'),
            'discount' => $this->request->getVar('discount'),
            'stock' => $this->request->getVar('stock'),
            'book_category_id' => $this->request->getVar('book_category_id'),
            'cover' => $namaFile
        ])) {
            session()->setFlashdata('success', 'Data berhasil ditambahkan!');
        } else session()->setFlashdata('error', 'Data gagal ditambahkan!');
        return redirect()->to('/book');
    }

    public function edit($slug)
    {
        $data = [
            'title' => _TITLE,
            'result' => $this->_book_model->getBook($slug),
            'book_category' => $this->_book_category_model->orderBy('name_category')->findAll(),
            'validation' => \Config\Services::validation(),
        ];
        return view('book/edit', $data);
        // dd($this->_book_model->getBook($slug));
    }

    public function update($id)
    {
        $slug_lama = $this->request->getVar('slug_lama');
        $dataBookLama = $this->_book_model->getBook($slug_lama);
        if ($dataBookLama['title'] === $this->request->getVar('title')) {
            $rule_title = 'required';
        } else {
            $rule_title = 'required|is_unique[book.title]';
        }

        // Validasi Data
        if (!$this->validate([
            'title' => [
                'rules' => $rule_title,
                'label' => 'Judul',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'is_unique' => '{field} sudah digunakan!'
                ]
            ],
            'author' => 'required',
            'release_year' => 'required|numeric',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'cover' => [
                'rules' => 'max_size[cover,1024]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
                'label' => 'Cover',
                'errors' => [
                    'max_size' => '{field} tidak boleh lebih dari 1MB!',
                    'is_image' => 'Yang Anda pilih bukan gambar',
                    'mime_in' => 'Yang Anda pilih bukan gambar'
                ]
            ]
        ])) {
            // Berisi fungsi redirect jika validasi tidak memenuhi
            // dd(\Config\Services::validation()->getErrors());
            return redirect()->to('/book-edit/' . $slug_lama)->withInput();
        }

        $namaFileLama = $this->request->getVar('coverlama');
        //Mengambil File Sampul
        $fileCover = $this->request->getFile('cover');

        if ($fileCover->getError() == 4) {
            $namaFile = $namaFileLama;
        } else {
            //Generate nama File
            $namaFile = $fileCover->getRandomName();
            //Move file to img folder (public)
            $fileCover->move('img', $namaFile);
            //if sampul default
            if ($namaFileLama != $this->defaultImage && $namaFileLama != "") {
                //hapus gambar
                unlink('img/' . $namaFileLama);
            }
        }

        $slug = url_title($this->request->getVar('title'), '-', true);
        if ($this->_book_model->save([
            'book_id' => $id,
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'author' => $this->request->getVar('author'),
            'release_year' => $this->request->getVar('release_year'),
            'price' => $this->request->getVar('price'),
            'discount' => $this->request->getVar('discount'),
            'stock' => $this->request->getVar('stock'),
            'book_category_id' => $this->request->getVar('book_category_id'),
            'cover' => $namaFile
        ])) {
            session()->setFlashdata('success', 'Data berhasil diperbarui!');
        } else session()->setFlashdata('error', 'Data gagal diperbarui!');
        return redirect()->to('/book');
    }

    public function importData()
    {
        $file = $this->request->getFile("file");
        $ext = $file->getExtension();
        if ($ext == "xls")
            $reader = new Xls();
        else
            $reader = new Xlsx();

        $spreadsheet = $reader->load($file);
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        foreach ($sheet as $key => $value) {
            if ($key == 0) continue;
            $namaFile = $this->defaultImage;
            // dd($value[1]);
            $slug = url_title($value[1], '-', true);
            $dataOld = $this->_book_model->getBook($slug);
            // dd($dataOld);
            if (!$dataOld) {
                $this->_book_model->save([
                    'title' => $value[1],
                    'author' => $value[2],
                    'release_year' => $value[3],
                    'price' => $value[4],
                    'discount' => $value[5] ?? 0,
                    'stock' => $value[6],
                    'book_category_id' => $value[7],
                    'slug' => $slug,
                    'cover' => $namaFile,

                ]);
                // } else if ($dataOld['title'] != $value[1]) {
                //     $this->_book_model->save([
                //         'title' => $value[1],
                //         'author' => $value[2],
                //         'release_year' => $value[3],
                //         'price' => $value[4],
                //         'discount' => $value[5] ?? 0,
                //         'stock' => $value[6],
                //         'book_category_id' => $value[7],
                //         'slug' => $slug,
                //         'cover' => $namaFile,

                //     ]);
            }
        }

        session()->setFlashData("msg", "Data berhasil diimport!");
        return redirect()->to('/book');
    }

    public function delete($id)
    {
        $data_book = $this->_book_model->where(['book_id' => $id])->first();
        $file_cover_lama = $data_book['cover'];

        $this->_book_model->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus!');
        //if sampul default
        if ($file_cover_lama != $this->defaultImage) {
            //hapus gambar
            unlink('img/' . $file_cover_lama);
        }
        return redirect()->to('/book');
    }
}
