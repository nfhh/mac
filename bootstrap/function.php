<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

function readExcel($file)
{
    $sheet_data = $row_data = $key_arr = [];
    $spreadsheet = IOFactory::load($file);
    foreach ($spreadsheet->getWorksheetIterator() as $sheet) {
        foreach ($sheet->getRowIterator() as $row) {
            if ($row->getRowIndex() === 1) {
                foreach ($row->getCellIterator() as $cell) {
                    $key_arr[] = $cell->getFormattedValue();
                }
                continue;
            }
            $i = 0;
            foreach ($row->getCellIterator() as $cell) {
                $i++;
                if (!$cell->getFormattedValue()) {
                    continue;
                }
                $row_data[$key_arr[$i - 1]] = $cell->getFormattedValue();
            }
            $sheet_data[] = $row_data;
        }
    }
    return $sheet_data;
}
