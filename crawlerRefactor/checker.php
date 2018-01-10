<?php
if(isset($_GET['filename'])){
	$json=$_GET['filename'].'.json';
	$jsonfiles=file_get_contents($json);
	$jsoncount=count(json_decode($jsonfiles,true));
	var_dump($jsoncount);
	$xx=explode('\\', $_GET['filename']);
	$last = 'TXT '.$xx[count($xx)-1];
	unset($xx[count($xx)-1]);
	$y=join("\\",$xx);
	var_dump($y.'\\'.$last);
	$files1 = glob($y.'\\'.$last."\*.txt");
	$totalfiles = count($files1);
	$ff=array();
	foreach ($files1 as $key => $value) {
		$rr=explode("_", basename($value))[0];
		if(!in_array($rr, $ff))
			array_push($ff, $rr);
	}
	var_dump(count($ff));
}
?>