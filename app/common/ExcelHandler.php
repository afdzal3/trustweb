<?php

namespace App\common;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer as Writer;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExcelHandler {

  const BG_WEEKEND = 'adad99';
  const BG_LEAVE = 'f283f0';  // purple pink
  const BG_LEAVE0 = '66ff66'; // light green
  const BG_PH = '34eb64';
  const BG_HEADER = '000000';
  const BG_NORMAL = 'NA';
  const BG_INFO = 'c34bfa';

  // productivity group colors
  const PD_G0 = '808080';  // > 100
  const PD_GA = 'ede907';  // < 50
  const PD_GB = '47539e';  // 50-80
  const PD_GC = '3e8f36';  // 80-100
  const PD_GD = 'e051cd';  // > 100


  private $filename = "";
  private $spreadsheet = null;

  public function __construct($fname){
    $this->spreadsheet = new Spreadsheet;
    $this->filename = $fname;
  }

  public function addSheet($sheetname, $content, $header = []){
    $cursheet = new Worksheet($this->spreadsheet, $sheetname);
    $this->spreadsheet->addSheet($cursheet);

    // first, populatae the header
    $colcount = 1;
    $rowcount = 1;
    foreach($header as $head){
      $cursheet->setCellValueByColumnAndRow($colcount, $rowcount, $head);
      $cstyle = $cursheet->getStyleByColumnAndRow($colcount, $rowcount);
      $cstyle->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
       ->getStartColor()->setARGB(self::BG_HEADER);
      $cstyle->getFont()->getColor()->setARGB('ffffff');
      $colcount++;
    }
    $rowcount++;

    // then populate the data
    foreach ($content as $value) {
      $colcount = 1;
      foreach ($value as $oncel) {
        $cursheet->setCellValueByColumnAndRow($colcount, $rowcount, $oncel['v']);

        if($oncel['t'] != self::BG_NORMAL){
          $cstyle = $cursheet->getStyleByColumnAndRow($colcount, $rowcount);
          $cstyle->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB($oncel['t']);

        }

        $colcount++;
      }
      $rowcount++;
    }
  }

  public function getBinary(){
    return base64_encode(serialize($this->spreadsheet));
  }

  public function download(){
    $writer = new Writer\Xlsx($this->spreadsheet);

    $response =  new StreamedResponse(
        function () use ($writer) {
            $writer->save('php://output');
        }
    );
    // $response->headers->set('Content-Type', 'application/vnd.ms-excel');

    $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    $response->headers->set('Content-Disposition', 'attachment;filename="'.$this->filename.'"');
    $response->headers->set('Cache-Control','max-age=0');
    return $response;
  }

  public static function DownloadFromBin($datafromdb, $fname){
    $unserialize_sp = unserialize(base64_decode($datafromdb));
    $writer = new Writer\Xlsx($unserialize_sp);

    $response =  new StreamedResponse(
        function () use ($writer) {
            $writer->save('php://output');
        }
    );
    // $response->headers->set('Content-Type', 'application/vnd.ms-excel');

    $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    $response->headers->set('Content-Disposition', 'attachment;filename="'.$fname.'"');
    $response->headers->set('Cache-Control','max-age=0');
    return $response;
  }
}
