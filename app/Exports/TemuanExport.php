<?php

namespace App\Exports;
use App\Viewexcel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;;


class TemuanExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function view(): View
    {
        $temuan=Viewexcel::get();
        return view('excel.excel', [
            'temuan' => $temuan
        ]);
    }
}
