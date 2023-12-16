<?php

namespace App\Utils\Traits;

use Barryvdh\DomPDF\Facade\Pdf;

trait DataTableTrait
{
    protected function filename(): string
    {
        $path = explode('\\', __CLASS__);
        return array_pop($path) . '_' . date('YmdHis');
    }

    public function pdf()
    {
        $data = $this->getDataForPrint();
        $pdf = Pdf::loadView($this->printPreview, ['data' => $data])->setOption(['defaultFont' => 'sans-serif']);
        return $pdf->download($this->filename() . '.pdf');
    }
}
