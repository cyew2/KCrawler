<?php
include 'simple_html_dom.php';
if(isset($_POST['html'])){
/*	$str='';
	$html = str_get_html($_POST['html'][0]);
	$table = $html->find('table',0);
	$el1 = $table->find('#singerMatchLyrics',0);
	$el1->innertext = $_POST['singerMatchLyrics'];
	$el2 =$table->find('#singerNoMatchLyrics',0);
	$el2->innertext = $_POST['singerNoMatchLyrics'];
	$el3 = $table->find('#singerMatchNoLyrics',0);
	$el3->innertext = $_POST['singerMatchNoLyrics'];
	$el4 =  $table->find('#singerNoMatchNoLyrics',0);
	$el4->innertext = $_POST['singerNoMatchNoLyrics'];
	$html->save();
	$str = $html;*/
	$f = explode(".", $_POST['filex'])[0];
	$filename=$f.'.html';
	file_put_contents($filename, $_POST['html']);

}
echo json_encode(array('success'=>true));

?>