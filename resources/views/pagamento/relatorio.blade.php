<?php
$html = "
<h1>Relatório de Teste</h1>
<p>Este relatório é um relatório qualquer</p>
<p>Aqui irá uma tabela qualquer</p>
";
$mpdf = new mPDF();
$mpdf->setDisplayMode('fullpage');
$css = file_get_contents("../../../../css/custom.css");
echo $css;
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html);
$mpdf->Output();