<?php
include 'datas.php';
if(isset($_GET['filename'])){

		$rankctr=rank($_GET['filename']);
	
	//echo json_encode($rankctr);
}
?>