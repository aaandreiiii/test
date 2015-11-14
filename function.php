<?php
function writeExelFile($filename, $data, $header){
    require_once 'Classes/PHPExcel.php';
    $pExcel = new PHPExcel();
    $pExcel->setActiveSheetIndex(0);
    $aSheet = $pExcel->getActiveSheet();

    array_unshift($data, $header);

    for($i = 0; $data[$i]; $i++){
        for($j = 0; $j < count($data[$i]); $j++){
            $aSheet->setCellValueByColumnAndRow($j,$i+1,$data[$i][$j]);
        }
    }

    for($i = 0; $i < count($header); $i++){
        $aSheet->getStyleByColumnAndRow($i,1)->applyFromArray(array(
                'fill' => array(
                    'type' => PHPExcel_STYLE_FILL::FILL_SOLID,
                    'color'=>array(
                        'rgb' => 'CFCFCF'
                    )
                )
            )
        );
    }

    $objWriter = new PHPExcel_Writer_Excel5($pExcel);
    $objWriter->save($filename);
}


function iconvArray($inputArray,$newEncoding){
    $outputArray=array();
    if ($newEncoding!=''){
        if (!empty($inputArray)){
            foreach ($inputArray as $element){
                if (!is_array($element)){
                    $element=iconv(mb_detect_encoding($element), $newEncoding, $element);
                } else {
                    $element = iconvArray($element, $newEncoding);
                }
                $outputArray[] = $element;
            }
        }
    }
    return $outputArray;
}