<?php
$totalfiles=[];
if(isset($_GET['foldername'])){
	$path=$_GET['foldername'];
	$files1 = glob($path."\*.xls");
	$files2 = glob($path."\*.xlsx");
	$totalfiles = array_merge($files1,$files2);

}
echo json_encode(array('names'=>$totalfiles));
?>