<?php

function callGoogleApi($query,$api,$songName2){
	$ch = curl_init(); 
	curl_setopt($ch,CURLOPT_URL,ltrim('https://www.googleapis.com/customsearch/v1?key='.$api.'&cx=005271956808096885842:cv6vnijexra'.'&q='.urlencode(" ").'&exactTerms='.urlencode($songName2).'&orTerms='.urlencode($query).'&num=8&prettyPrint="true"'));
	// &excludeTerms="lyrics+not"
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER , false );
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($ch,CURLOPT_HEADER, false); 					
	$result=curl_exec($ch);
	curl_close($ch);

	$dt = json_decode($result);

	return $dt;
}

function checkApiKey($current=null,$apiBank){

	if(is_null($current))
		$current=0;
	if(isset($apiBank[$current]))
	return $apiBank[$current];
	else
	return false;
	//return "AIzaSyB87TDq7JFxSgW9FO4_VcWAAbBUtwarvlk";
}

function converter($t){
	$removePattern = array('/♪/u','/♬/u','/≈/u','/🎸/u','/💋/u','/📣/u',
							'/💖/u','/🎹/u','/❤/u','/☆/u','/🎶/u','/🔊/u','/🕪/u',
							'/⬇/u','/✴/u','/■/u','/□/u','/♠/u','/◆/u',
							'/◇/u','/♣/u','/█/u','/≡/u','/🌹/u','/✔/u','/①/u','/②/u','/③/u',
							'/♫/u','/♥/u','/&#xD;/u','/□/u');
	
	$t= preg_replace($removePattern,"\n",$t);
	$t= preg_replace("/&gt;/u","\n",$t);
	$t= preg_replace("/&lt;/u","\n",$t);
	$t= preg_replace("/<br>/u","\n",$t);
	$t= preg_replace("/<\\\\\/br>+/u","\n",$t);
	$t= preg_replace("/<\/br>+/u","\n",$t);
	$t= preg_replace("/<br \\\\\/>+/u","\n",$t);
	$t= preg_replace("/<br \/>+/u","\n",$t);
	$t= preg_replace("/<p>/u","\n",$t);
	$t= preg_replace("/<\\\\\/p>/u","\n",$t);
	$t= preg_replace("/<\/p>/u","\n",$t);
	$t= strtolower($t);
	//$t= preg_replace("/\/","",$t);
	$t= preg_replace("/<[\\\\!a-zA-Z0-9#;:.&%?=()+,\/' \"_\-]*>/u","",$t);
	//echo $t;
	$t= preg_replace("/ i /u"," I ",$t);
	$t= preg_replace("/ i+[\r\n]/u"," I\n",$t);
	$t= preg_replace("/ i'/u"," I'",$t);

	$t= preg_replace("/[,.;?!(){}–\[\]\/\-]/u"," ",$t);
	$t= preg_replace("/…/u"," ",$t);
	$t= preg_replace("/[|“”：\"*><\^=:_@#$%~\+\t]/u","",$t);
	$t= preg_replace("/ +/u"," ",$t);

	$t= preg_replace("/\n\t+/u","\n",$t);
	$t= preg_replace("/[\r\n]+/u","\n",$t);
	$t= preg_replace("/\n /u","\n",$t);
	$t= preg_replace("/\t+/u","\n",$t);
	$t= preg_replace("/ +\n+/u","\n",$t);
	$t= preg_replace("/ +/u"," ",$t);
	$t= preg_replace("/[\r\n]+/u","\n",$t);
	$t = shortiFy($t);
	
	/////////....need some conversion....////

/*	while($t[0]=="\n"||$t[0]==" ")
	{
	$t = substr($t,1);
	}
	while($t[strlen($t)-1]=="\n"||$t[strlen($t)-1]==" ")
	{
	$t = substr($t,0,strlen($t)-1);
	}*/
	$t= ucfirst($t);
	$t = toCapitalCase($t);
	$t = badWords($t);
	$t = punc($t);
	$t= preg_replace("/ i /u"," I ",$t);
	$t= preg_replace("/ i+[\r\n]/u"," I\n",$t);
	$t= preg_replace("/ i'/u"," I'",$t);
	
	$t= preg_replace("/\n/u","\r\n",$t);

	return $t;
}
function toCapitalCase($t)
{
	$i = 0;
	while($pos = strpos($t,"\n",$i))
	{
	$t = substr($t,0,$pos+1).strtoupper($t[$pos+1]).substr($t,$pos+2);
	$i = $pos+1;
	}	
	return $t;
}

function badWords($t){
	$bad=array('bitch','bitches','bullshit','damn','fuck','penis','shit');
	$badreplace=array('b*tch','b*tches','bullsh*t','d*mn','f**k','p*nis','sh*t');

	foreach ($bad as $key => $value) {
		$t=str_replace($value,$badreplace[$key],$t);
	}

	return $t;
}

function punc($t){
	$punc=array("coz","cause","cuz","em","til","ive");
	$puncreplace=array("'coz","'Cause","'cuz","'em","'til","I've");

	foreach ($punc as $key => $value) {
		$t=str_replace(" ".$value." "," ".$puncreplace[$key]." ",$t);
	}

	return $t;
}

function shortiFy($t)
{
	$len= strlen($t);
	$count = 0;
	for ($i=0; $i<$len; $i++)
	{
		if ($t[$i] == "\n")
			$count=0;
		else if ($t[$i]== " ")
			$count++;
		else{
		}

		if ($count == 10)
		{
			$t = substr($t,0,$i)."\n".substr($t,$i+1);
			$count=0;
			$i++;
		}
	}
	return $t;
}

 function saveToJson($filename,$tobesaved){
   $arr_data = array(); // create empty array
   $jsondata=null;
   $tobesaved['lyrics'] = utf8_decode($tobesaved['lyrics']);

  try
  {
    if (file_exists($filename.'.json')) {
    	
        $jsondata = file_get_contents($filename.'.json');
    } else {
        file_put_contents($filename.'.json', '');
    }
     // converts json data into array
     
     if(!is_null($jsondata))
        $arr_data = json_decode($jsondata, true);

     // Push user data to array
      if(isset($arr_data[$tobesaved['songid']])){
        array_push($arr_data[$tobesaved['songid']],$tobesaved);
      }
      else{
        $arr_data[$tobesaved['songid']]=array();
        array_push($arr_data[$tobesaved['songid']],$tobesaved);
      }
        

       //Convert updated array to JSON
     $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
     //write json data into data.json file
     file_put_contents($filename.".json", $jsondata);

  }
  catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
  }
 }

function rank($filename){
	$name=explode(".", $filename)[0];
	$json=$name.'.json';
	$content=file_get_contents($json);
	$arrContent = json_decode($content, true);
	$counterM = 0;
	$counterN = 0;
	$counterML = 0;
	$counterNL = 0;

	foreach ($arrContent as $key => $value) {
		$noLyricsMatch=array();
		$singerMatch=array();
		$noLyrics=array();
		$singerNotMatch=array();
		$num=0;
		$printCount = 0;
		foreach ($value as $k => $v) {
			$firstLine = $v['songname2']." – ".$v['singer'];	
			$fileName = $v['songid'];
			if($v['lyrics'] !='' && strlen($v['lyrics']) > 25){
				if(stripos($v['title'],$v['singer']) !== false)
				{	
					if(strpos($v['lyrics'],$v['songname2'])!==false){
						array_unshift($singerMatch, array(
							'filename' => $fileName,
							'fline'=> $firstLine,
							'tobeSaved'=> array('link'=>$v['link'],'lyrics'=>$v['lyrics']),
							'dirName'=> $v['directory']
						));
					}else{
						array_push($singerMatch, array(
							'filename' => $fileName,
							'fline'=> $firstLine,
							'tobeSaved'=> array('link'=>$v['link'],'lyrics'=>$v['lyrics']),
							'dirName'=>$v['directory']
						));	
					}									
				}
				else
				{
						if(strpos($v['lyrics'],$v['songname2'])!==false){
							array_unshift($singerMatch, array(
								'filename' => $fileName,
								'fline'=> $firstLine,
								'tobeSaved'=> array('link'=>$v['link'],'lyrics'=>$v['lyrics']),
								'dirName'=> $v['directory']
							));
						}else{
							array_push($singerNotMatch, array(
								'filename' => $fileName,
								'fline'=> $firstLine,
								'tobeSaved'=> array('link'=>$v['link'],'lyrics'=>$v['lyrics']),
								'dirName'=> $v['directory']
							));	
						}
						
				}
			}else{
				if(stripos($v['title'],$v['singer']) !== false){

					array_unshift($noLyrics, array(
							'filename' => $fileName,
							'fline'=> $firstLine,
							'tobeSaved'=> array('link'=>$v['link'],'lyrics'=>$v['lyrics']),
							'dirName'=> $v['directory']
						));
				}else{
						array_push($noLyrics, array(
							'filename' => $fileName,
							'fline'=> $firstLine,
							'tobeSaved'=> array('link'=>$v['link'],'lyrics'=>$v['lyrics']),
							'dirName'=> $v['directory']
						));
				}

				if(stripos($v['link'],"azlyrics.com/lyrics/") !== false){
					array_unshift($noLyrics, array(
							'filename' => $fileName,
							'fline'=> $firstLine,
							'tobeSaved'=> array('link'=>$v['link'],'lyrics'=>$v['lyrics']),
							'dirName'=> $v['directory']
						));
				}
			}
		}
		foreach($singerMatch as $k=> $s){
			if($num < 5){
			$num++;
			saveTxtfile($s['filename']."_".$num,$s['fline'],$s['tobeSaved'],$s['dirName']);
			$counterML++;
			}
		}
			foreach($singerNotMatch as $k=> $s){
				if($num < 5){
				$num++;
				saveTxtfile($s['filename']."_".$num,$s['fline'],$s['tobeSaved'],$s['dirName']);
				$counterNL++;
				}	
			}
		//if(count($singerNotMatch) < 5){
			foreach($noLyrics as $k=> $s){
				if($num < 5){
					$num++;
					saveTxtfile($s['filename']."_".$num,$s['fline'],$s['tobeSaved'],$s['dirName']);
					$counterM++;
				}
			}
		//}	

	}
	return array('singerMatchLyrics'=>$counterML,'singerNoMatchLyrics'=>$counterNL,'singerMatchNoLyrics'=>$counterM,'singerNoMatchNoLyrics'=>$counterN);



}

function saveTxtfile($filename,$fline,$tobeSaved,$dirName){
	
	$formatedData = utf8_decode($tobeSaved['lyrics']);
	$formatedData=str_replace("&#xD;", "", $formatedData);
	$fline=str_replace("?", "-", utf8_decode($fline));
	$written=str_replace("?", ":", utf8_decode("Written by："));
	$fileName = $filename.".txt";
	$filee = $dirName."\\".$fileName;
	$myfile = fopen($filee, "w+") or die("Unable to open file!");
	
	fwrite($myfile, $tobeSaved['link']);
	fwrite($myfile, "\r\n");
	fwrite($myfile, "\r\n");
	fwrite($myfile, $fline);
	fwrite($myfile, "\r\n");
	fwrite($myfile, $written);
	fwrite($myfile, "\r\n");
	
	if($formatedData!='')
		fwrite($myfile, $formatedData);
	else
		fwrite($myfile, "No lyrics found");
	fclose($myfile);
}

function saveTxtNoLyrics($filename,$dirName,$tobeSaved){
	$fileNo = $dirName."\\NO_LYRICS.txt";
	$fileNoLyrics = fopen($fileNo, "a") or die("Unable to open file!");
	fwrite($fileNoLyrics, $filename." - ");
	fwrite($fileNoLyrics, $tobeSaved['link']);
	fwrite($fileNoLyrics, "\r\n");
	fclose($fileNoLyrics);
}

?>