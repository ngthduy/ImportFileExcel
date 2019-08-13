<?php

require_once("includes/libs/PHPExcel/PHPExcel.php");
require_once('includes/database.php');
function ExcelReader($filePath, $sheetName) {
	$fileType = PHPExcel_IOFactory::identify($filePath);
	$objReader = PHPExcel_IOFactory::createReader($fileType);
	$objReader->setLoadSheetsOnly($sheetName); 
	$objPHPExcel = $objReader->load($filePath);

	return $sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
}

function ExtractNumber($value, $start) {
	return intval(substr($value, $start));
}

function toannull($arr){
    $toannull = true;
    foreach ($arr as $k=>$v){
        $toannull = $toannull && empty($v);
    }
    return $toannull;
}

$sheetName = "Sheet1";
$tableName = "dangbaoche";
$file_type = $_FILES['file']['type'];
$filePath = $_FILES['file']['name'];
$file_tmp = $_FILES['file']['tmp_name'];
if($file_type=="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
{
	move_uploaded_file($file_tmp,$filePath);
}
else
{
	
	header("Location: index.php?trangthai=loi");
	Die();
}
$sheetData = ExcelReader($filePath, $sheetName);
$arrError = array();
$startRow = 2;
$sosql = 0;
$hoanthanh=0;
$checktrung=0;
for($id = $startRow; $id <= count($sheetData); $id++) {
    $sosql++;
    if ( toannull($sheetData[$id]) ) continue;
    $B=$sheetData[$id]["B"];
    $C=$sheetData[$id]["C"];
    $sql = "INSERT INTO `dangbaoche` (`id`, `ten`, `ghichu`) VALUES (NULL, '$B', '$C')";
    $rs=mysqli_query($db,$sql);
    if ( isset($rs["message"]) )
        {
            
            echo $rs["message"];
        }
        else 
        {
            $hoanthanh++;
        } 
}
echo "Quá trình nhập hoàn tất!! số dữ liệu đã nhập:". $hoanthanh;
unlink($filePath);
?>