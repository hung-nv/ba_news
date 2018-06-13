<?php
/**
 * Created by PhpStorm.
 * User: linh
 * Date: 11/7/17
 * Time: 11:28 AM
 */

namespace App\Services\Production;

use App\Services\Interfaces\ExcelInterface;

class ExcelService implements ExcelInterface
{
    public function export($data = array(), $fileName = 'Data', $type = 'xls')
    {
        Excel::create($fileName, function($excel) use ($data) {

            $excel->sheet('New sheet', function($sheet) use ($data) {

                $sheet->fromArray($data,null, 'A1', false, false);

            });

        })->download($type);
    }
}