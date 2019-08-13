<?php

require_once("includes/libs/PHPExcel/PHPExcel.php");
require_once('includes/database.php');

$fileName = "dangbaoche.xls";

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $fileName . '"');
header('Cache-Control: max-age=0');

flush();

$objPHPExcel = new PHPExcel();
$objPHPExcel->getActiveSheet()->setTitle("nguyenlieu");
$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(13);

$colTT = 'A';
$colTen = 'B';
$colGhiChu = 'C';


//Write title data
$objPHPExcel->getActiveSheet()->mergeCells($colTT.'1:'.$colTT.'1')->SetCellValue($colTT.'1', 'TT');
$objPHPExcel->getActiveSheet()->mergeCells($colTen.'1:'.$colTen.'1')->SetCellValue($colTen.'1', 'Tên nguyên liệu');
$objPHPExcel->getActiveSheet()->mergeCells($colGhiChu.'1:'.$colGhiChu.'1')->SetCellValue($colGhiChu.'1', 'Ghi chú');


$sql = "SELECT ten, ghichu FROM dangbaoche";
$result = mysqli_query($db, $sql);
$rowCount = 3; 
$stt = 1;
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
       $objPHPExcel->getActiveSheet()->SetCellValue($colTT.$rowCount, $stt++);
		$objPHPExcel->getActiveSheet()->SetCellValue($colTen.$rowCount, $row['ten']);
	    $objPHPExcel->getActiveSheet()->SetCellValue($colGhiChu.$rowCount, $row['ghichu']);
		$rowCount++; 
    }
} else {
    echo "0 results";
}


//Format sheet
$objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray( array( 'font' => array( 'name' => 'Times New Roman', 'bold' => true, 'italic' => false, 'size' => 13 ), 'alignment' => array( 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true ), 'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array('rgb' => '8db4e2') ) ) );

$objPHPExcel->getActiveSheet()->getStyle("A1:C".($rowCount-1))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$objPHPExcel->getActiveSheet()->getColumnDimension($colTT)->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension($colTen)->setWidth(20);


$highestRow = $objPHPExcel->getActiveSheet()->getHighestRow();
$objPHPExcel->getActiveSheet()->getStyle($colTT.'1:'.$colTT.$highestRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle($colTen.'1:'.$colTen.$highestRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
ob_get_clean();
$objWriter->save('php://output');
ob_end_flush();

?>