<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Produk as ModelProduk;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Produk implements ToCollection, WithStartRow
{
    public function startRow(): int{
        return 2;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

       foreach ($collection as $col) {
            $kodeyangadadidatabase = ModelProduk::where('kode', $col[1])->first();
            if (!$kodeyangadadidatabase){
                $simpan = new ModelProduk();
                $simpan->kode = $col[2];
                $simpan->nama = $col[3];
                $simpan->harga= $col[4];
                $simpan->stok = 10;
                $simpan->save();
            }
       }
    }
}
