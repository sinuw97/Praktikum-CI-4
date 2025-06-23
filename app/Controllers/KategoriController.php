<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use CodeIgniter\HTTP\ResponseInterface;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Exception;

class KategoriController extends BaseController
{
    protected $kategori;

    public function __construct()
    {
        $this->kategori = new KategoriModel();
    }
    public function index()
    {
        try {
            $data['kategori'] = $this->kategori->findAll();
            return view('kategori/index', $data);
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    public function add()
    {
        return view('kategori/form_baru');
    }
    // Membuat fungsi input data
    public function create()
    {
        # membuat rule validasi
        $validate = $this->validate(
            [
                'kategori' => [
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'nama kategori tidak boleh kosong',
                        'min_length' => 'nama kategori minimal 3 huruf '
                    ]
                ],
                'keterangan' => [
                    'rules' => 'required|min_length[3]',
                    'errors' => [
                        'required' => 'nama keterangan tidak boleh kosong',
                        'min_length' => 'nama keterangan minimal 3 huruf '
                    ]
                ]
            ]
        );
        # proses validasi
        if (!$validate) {
            return view('kategori/form_baru', ['validation' => $this->validator]);
        }
        # proses simpan data
        $data = $this->request->getPost();
        $this->kategori->insert($data);

        return redirect()->to('kategori')->with('success', 'Data berhasil disimpan!');
    }
    // Menampilkan data kategori berdasarkan ID nya
    public function showKategoriById($id)
    {
        try {
            $kategori = $this->kategori->find($id);

            if (!$kategori) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Kategori tidak ditemukan');
            }

            return view('kategori/edit_kategori', ['kategori' => $kategori]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    // Membuat fungsi update
    public function updateKategori($id)
    {
        try {
            $validate = $this->validate(
                [
                    'kategori' => [
                        'rules' => 'required|min_length[3]',
                        'errors' => [
                            'required' => 'nama kategori tidak boleh kosong',
                            'min_length' => 'nama kategori minimal 3 huruf '
                        ]
                    ],
                    'keterangan' => [
                        'rules' => 'required|min_length[3]',
                        'errors' => [
                            'required' => 'nama keterangan tidak boleh kosong',
                            'min_length' => 'nama keterangan minimal 3 huruf '
                        ]
                    ]
                ]
            );

            # proses validasi
            if (!$validate) {
                return view('kategori/edit_kategori', ['validation' => $this->validator]);
            }

            $data = [
                'kategori' => $this->request->getPost('kategori'),
                'keterangan' => $this->request->getPost('keterangan')
            ];
            # proses simpan data
            $this->kategori->update($id, $data);
            return redirect()->to('kategori')->with('success', 'Data berhasil diupdate!');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    // Membuat fungsi delete data
    public function deleteKategori($id)
    {
        try {
            $this->kategori->delete($id);
            return redirect()->to('/kategori')->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    public function export()
    {
        try {
            $kategori = $this->kategori->get_excel()->getResult();
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'No.');
            $sheet->setCellValue('B1', 'Kategori');
            $sheet->setCellValue('C1', 'Keterangan');
            $row = 2;
            foreach ($kategori as $key => $value) {
                $sheet->setCellValue('A' . $row, ($row - 1));
                $sheet->setCellValue('B' . $row, $value->kategori);
                $sheet->setCellValue('C' . $row, $value->keterangan);
                $row++;
            }
            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' =>
                        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ];
            $sheet->getStyle('A1:C' . ($row - 1))->applyFromArray($styleArray);
            $sheet->getStyle('A1:C1')->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FFFFFF00');
            $sheet->getStyle('A1:C1')->getFont()->setBold(true);
            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);

            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

            header('Content-Disposition: attachment;filename=DataKategori-' . date('dmy') . '.xlsx');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
            exit();
        } catch (\Throwable $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
