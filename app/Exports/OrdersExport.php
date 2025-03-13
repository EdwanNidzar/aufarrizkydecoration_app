<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class OrdersExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    private $startDate;
    private $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = Order::query();

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('tanggal_order', [$this->startDate, $this->endDate]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return ['Katalog', 'Tanggal Pemesanan', 'Harga', 'Total Harga'];
    }

    public function map($order): array
    {
        return [
            $order->catalog_id,
            $order->tanggal_order,
            $order->harga, 
            $order->total_harga,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $totalRow = Order::count() + 2;
                $event->sheet->setCellValue('C' . $totalRow, 'Total Keseluruhan:');
                $event->sheet->setCellValue('D' . $totalRow, '=SUM(D2:D' . ($totalRow - 1) . ')');
                $event->sheet
                    ->getStyle('C' . $totalRow . ':D' . $totalRow)
                    ->getFont()
                    ->setBold(true);
            },
        ];
    }
}
