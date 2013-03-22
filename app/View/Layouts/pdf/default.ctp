<?php
require_once(APP.'Vendor'.DS.'dompdf'.DS.'dompdf_config.inc.php');
$dompdf = new DOMPDF();
$dompdf->load_html(utf8_decode(
	'<style>
		th { text-align: left; }
		.level1 .name { padding-left: 15px; } .level1 .name:before { content: "* "; }
		.level2 .name { padding-left: 30px; } .level2 .name:before { content: "+ "; }
		.level3 .name { padding-left: 45px; } .level3 .name:before { content: "- "; }
		.level4 .name { padding-left: 60px; } .level4 .name:before { content: ". "; }
		.level5 .name { padding-left: 75px; }
		th, td { padding: 2px 5px; }
		tr#total td, tr#total th { border-top: 1px solid black; }
		table { margin-top: 20px; }
	</style>'.
	$content_for_layout
), Configure::read('App.encoding'));
$dompdf->render();
echo $dompdf->output();
?>