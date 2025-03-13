<?php

namespace App\Imports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\ToModel;

class OrdersImport implements ToModel
{
    public function model(array $row)
    {
        return new Order([
            'catalog_id' => $row[0],
            'tanggal_order' => $row[1],
            'harga' => $row[2],
            'total_harga' => $row[3],
        ]);
    }
}
