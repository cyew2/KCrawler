<?php
include 'datas.php';
if(isset($_GET['filename'])){
	$list = $_POST['list'];
	$name=explode(".", $_GET['filename'])[0];
	$json=$name.'.json';
	$content=file_get_contents($json);
	$arrContent = json_decode($content, true);
	var_dump($arrContent);
	$rankctr='';

	$listcount=count($list);
	$ctr=0;
		foreach ($list as $key => $value) {

				if(isset($value['id'])){
					foreach($arrContent[$value['songid']] as $k => $v){
						if($v['id'] == $value['id']){
							$v['lyrics']=$value['lyrics'];
								if($v['lyrics'] !='')
									$arrContent[$value['songid']][$k]['lyrics']=$value['lyrics'];
						}
					}
				}
				$ctr++;
			
		}

		$myJSON = json_encode($arrContent,JSON_PRETTY_PRINT);
		file_put_contents($json, $myJSON);

		$rankctr=rank($_GET['filename']);
	
	echo json_encode($rankctr);
}
?>