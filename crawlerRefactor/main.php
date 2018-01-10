<?php
	include 'PHPExcel/IOFactory.php';
	include 'trimmify.php';
	include 'datas.php';
	include('simple_html_dom.php');
	require_once 'apis.php';
	require_once 'pattern.php';
	require __DIR__ . '/vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">	
	<style type="text/css">
		*
		{
			padding:0;
			margin:0;
		}
		.songtitle,
		.songdata
		{
			font-family: "Tahoma";
			font-size:13px;
			border-collapse: collapse;
		}
		.songsheettitle
		{
			font-family: "Tahoma";
			font-size:13px;
			margin: 2% 2% .5%;
			width: 96%;
			border-collapse: collapse;
		}			
		.songtitle
		{
			margin: 2%;
			width: 96%;
			background:#cccccc;
		}
		.songdata
		{
			margin: .5% 2% 2%;
			width: 96%;
			background:#eeeeee;
		}			
		.songtitle th,
		.songdata td
		{
			border: 2px solid #216cac;
			padding:5px;
		}	
		.songtitle td
		{
			text-align:center;
			font-weight:bold;
		}			
	</style>
    <title><?php
				if($_SERVER['REQUEST_METHOD'] == 'POST')
					echo basename( $_FILES["fileToUpload"]["name"],".xls");
				else
					echo "HOME - SONG SEARCH";
			?></title>
	<script src="jquery-3.1.1.min.js"></script>
</head>

<body>
<div>
	<div  style="align:center">
		<b> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;API used: <label id="currentApi">0</label>&nbsp;&nbsp;Successful Search :<label id="DIV1" style='color:green'>0</label> &nbsp;&nbsp;Failed Search :<label id="DIV2" style='color:red'>0</label>  &nbsp;&nbsp;Now Searching :<label id="DIV3" style='color:blue'>0</label></b>
	</div>
</div>
<div>
	<div  style="align:center">
		<table class="table table-hover table-bordered table-striped">				
			<tr>
				<th>Singer Name Matched And Has Lyric</th>
				<td id="singerMatchLyrics" style='color:#ff7200; font-family:sans-serif;font-size: large;text-align:center'>0</td>
			</tr>
			<tr>
				<th>Singer Name Not Matched But Has Lyric</th>
				<td id="singerNoMatchLyrics" style='color:#5D9A04; font-family:sans-serif;font-size: large;text-align:center'>0</td>
			</tr>
			<tr>
				<th>Singer Name Matched But No Lyric</th>
				<td id="singerMatchNoLyrics" style='color:#0a02f2; font-family:sans-serif;font-size: large;text-align:center'>0</td>
			</tr>
			<tr>
				<th>Singer Name Not Matched And No Lyric</th>
				<td id="singerNoMatchNoLyrics" style='color:#060519; font-family:sans-serif;font-size: large;text-align:center'>0</td>
			</tr>
			<tr>
				<th>Total Links</th>
				<th id="totalLyrics" style='color:#006400; font-family:sans-serif;font-size: large;text-align:center'>0</th>
			</tr>
		</table>
	</div>
</div>
<?php
if(isset($_GET['path'])){
	  $options = array(
	    'cluster' => 'ap1',
	    'encrypted' => true
	  );

	$pusher = new Pusher\Pusher(
    '',
    '',
    '',$options);
	  /*class MyLogger { public function log( $msg ) { print_r( $msg . "\n" ); } } 
	  $pusher->set_logger( new MyLogger() ); */

	$inputFileName = $_GET['path'];
	$startFrom=3;
	$limit=50;
	$currentApi=null;
	$success=0;
	$fail=0 ;
	$lastError = 0;
	$counterM = 0;
	$counterN = 0;
	$counterML = 0;
	$counterNL = 0;

	$baseName = substr($inputFileName,0,strrpos($inputFileName, "\\") + 1);
	$folderName = explode(".",substr($inputFileName, strrpos($inputFileName, "\\") + 1))[0];
	$dirName = $baseName."TXT ".$folderName;
	if(!file_exists($dirName)){
		
		mkdir($dirName);
	}	
	try {
	    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
	    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
	    $objPHPExcel = $objReader->load($inputFileName);

	} catch(Exception $e) {
	    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
	}

	$sheetObj = $objPHPExcel->getActiveSheet();
	$lyrics_overall = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow() - 2;
	
    foreach( $sheetObj->getRowIterator($startFrom, $limit) as $row ){
    	$itemId='';
    	$songId='';
    	$songName='';
    	$singer='';
    	$album='';
    	$linkCtr=0;
       foreach($row->getCellIterator() as $b=>$cell){
       		if($b==0) $itemId = nl2br(htmlentities($cell->getCalculatedValue()));
			if($b==1) $songId = nl2br(htmlentities($cell->getCalculatedValue()));
			if($b==2) $songName = nl2br(htmlentities($cell->getCalculatedValue()));
			if($songName == null)
				if($b==2) $songName =nl2br(htmlentities($cell->getCalculatedValue(),ENT_NOQUOTES,"ISO-8859-15"));
			if($b==3) $singer = nl2br(htmlentities($cell->getCalculatedValue()));
			if($singer == null)
				if($b==3) $singer = nl2br(htmlentities($cell->getCalculatedValue(),ENT_NOQUOTES,"ISO-8859-15"));
			if($b==4) $album = nl2br(htmlentities($cell->getCalculatedValue()));
			if($album == null)
				if($b==4) $album = nl2br(htmlentities($cell->getCalculatedValue(),ENT_NOQUOTES,"ISO-8859-15"));	
       }
   		$songName2 = songNameTrimmer($songName);
		$album2 = albumNameTrimmer($songName2,$album);
		$singer2 = albumNameTrimmer($songName2,$singer);					
		$query = $singer2." ".$album2;
		
		do{
			
			if(is_null($currentApi))
				$currentApi = 0;

			$api = checkApiKey($currentApi,$apiBank);
			if($api!==false)

			$dt=callGoogleApi($query,$api,$songName2);
			//var_dump($dt);
			if(array_key_exists('error', $dt)){
				$currentApi = $currentApi + 1;
			}
		}while(array_key_exists('error', $dt));

		?>
		<script type="text/javascript">
			$('#currentApi').html('<?php echo $currentApi; ?>');
		</script>
		<?php

		echo "<table class='songdata'><tr>";
		echo "<td style='width:5%;'>".$itemId."</td>";
		echo "<td style='width:7%;'>".$songId."</td>";
		echo "<td style='width:23%;'>".$songName."</td>";
		echo "<td style='width:10%;'>".$singer."</td>";
		echo "<td style='width:10%;'>".$album."</td>";
		echo "<td style='width:40%;'>";	

		$song_name = $dt->queries->request[0]->exactTerms; 
		$song_name = substr($song_name,0,27); 
		$song_name= preg_replace("/\(([^)]+)\)/iu","",$song_name);
		$song_name= preg_replace("/['’]/iu","",$song_name);
	if($dt->searchInformation->totalResults > 0){	
		$num = 0;
		$sm = 0;
		$nm = 0;
		$nlm = 0;
		$nln = 0;
		$printCount = 0;
		$singerMatch = array();
		$singerNotMatch = array();
		foreach($dt->items as $item)
		{
			$title = $item->title;
			$title= preg_replace("/['’]/iu","",$title);
			if (preg_match("/".$song_name."/i", $title))  
			{
				$num++;
				$firstLine = $songName." – ".$singer;
				$fileName = $songId."_".$num;
				$rawData = crawler($item->link);

				$formatedData = "";
				if($rawData != ""){
					$formatedData=nl2br($rawData);
					$formatedData=str_replace("<br />", "", $formatedData);
					$formatedData=strip_tags($formatedData,"<br>");
					
					$formatedData=str_replace("<br>", PHP_EOL,$formatedData);
				}
				
				//var_dump(file_get_contents($baseName.''.$folderName.'.json'));

				/*saveToJson($baseName.''.$folderName,array('id'=>$num,'songname'=>$song_name,'songname2'=>$songName,'title'=>$title,'singer'=>$singer2,'songid'=>$songId,'lyrics'=>$formatedData,'link'=>$item->link,'firstline'=>$firstLine,'directory'=>$dirName));*/
				saveTxtfile($songId.'_'.$num,$firstLine,array('id'=>$num,'songname'=>$song_name,'songname2'=>$songName,'title'=>$title,'singer'=>$singer2,'songid'=>$songId,'lyrics'=>$formatedData,'link'=>$item->link),$dirName);

				if($rawData == ""){
					$pusher->trigger( ['my-channel'], 'my-event', array('filename'=>$dirName."\\".$fileName.".txt",'firstline'=>$firstLine,'dirname'=>$dirName,'link'=>$item->link,'jsondata'=>array('id'=>$num,'lyrics'=>$formatedData,'songid'=>$songId,'link'=>$item->link)));
				}
				
				
				echo "<div style='color:#ff7200; font-family:sans-serif;font-size: large'><strong>TITLE : </strong>".$num.")  ".$item->title."</div><div style='color:#103d07; margin-top:1px; margin-bottom:5px;'><strong>SNIPPET : </strong>" .$item->htmlSnippet."</div><div style='margin-bottom:10px;'><strong>URL : </strong><a href=\"".$item->link."\" target=\"_blank\">".$item->link."</a></div>" ;

				

				
			}
		}
		
		if($num==0){ 
			$fail++;
			echo "Nothing found!!!";	
			echo "</td><td style='width:5%;'></td>";
		}else{
			$success++;
			echo "</td><td style='width:5%;color:	GREEN;align:center;'><strong>".$success."</strong></td>";
		}
		$pusher->trigger( ['my-channel'], 'my-count', array('success'=>$success,'fail'=>$fail,'processed'=>$fail + $success,'lyricsCount'=>$lyrics_overall));

	    }else{
			$fail++;
			$pusher->trigger( ['my-channel'], 'my-count', array('success'=>$success,'fail'=>$fail,'processed'=>$fail + $success,'lyricsCount'=>$lyrics_overall));
			echo "Nothing found!!!";	
			echo "</td><td style='width:5%;'></td>";	
		}
		echo "</td></tr></table>";
		?>
	<script>
	$("#DIV1").html('<?php echo $success; ?>');
	$("#DIV2").html('<?php echo $fail; ?>');
	$("#DIV3").html('<?php echo $success+$fail; ?>');
	</script>
	<?php
	}
}
?>