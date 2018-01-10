 <?php
include('simple_html_dom.php');
$html = file_get_html("http://www.albumcancionyletra.com/cristo-yo-creo-en-ti_de_cristal-lewis___271545.aspx");
         $x=$html->find('.letra',0);
         $lData=$x->innertext;
        echo $lData;

?>
