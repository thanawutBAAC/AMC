<!--  ������Ƿ��ͧ  ���˹�������鹷����� ��ͤ���  ��ͺ��ͤ���  ��â�鹺�÷Ѵ���� -->
<?
require('thaipdfclass.php');
$pdf=new ThaiPDF();
$pdf->SetThaiFont();
$pdf->AddPage();
$pdf->SetFont('CordiaNew','',16); 
$pdf->Cell(40,10,'CordiaNew ���ͺ',0,1);   
$pdf->SetFont('CordiaNew','B',16); 
$pdf->Cell(40,10,'CordiaNew ���ͺ 1',0,0);
$pdf->SetFont('CordiaNew','I',16); 
$pdf->Cell(40,10,'CordiaNew ���ͺ2',0,0);
$pdf->SetFont('CordiaNew','IB',16); 
$pdf->Cell(40,10,'CordiaNew ���ͺ',0,1);
$pdf->SetFont('AngsanaNew','',16); 
$pdf->Cell(40,10,'AngsanaNew ���ͺ',0,1);
$pdf->SetFont('AngsanaNew','B',16); 
$pdf->Cell(40,10,'AngsanaNew ���ͺ',0,1);
$pdf->SetFont('AngsanaNew','I',16); 
$pdf->Cell(40,10,'AngsanaNew ���ͺ',0,1);
$pdf->SetFont('AngsanaNew','IB',16); 
$pdf->Cell(40,10,'AngsanaNew ���ͺ',0,1);
$pdf->SetFont('Tahoma','',16); 
$pdf->Cell(40,10,'Tahoma ���ͺ',0,1);
$pdf->SetFont('Tahoma','B',16); 
$pdf->Cell(40,10,'Tahoma ���ͺ',0,1);
$pdf->SetFont('BrowalliaNew','',16); 
$pdf->Cell(40,10,'BrowalliaNew ���ͺ',0,1);
$pdf->SetFont('BrowalliaNew','B',16); 
$pdf->Cell(40,10,'BrowalliaNew ���ͺ',0,1);
$pdf->SetFont('BrowalliaNew','I',16); 
$pdf->Cell(40,10,'BrowalliaNew ���ͺ',0,1);
$pdf->SetFont('BrowalliaNew','IB',16); 
$pdf->Cell(40,10,'BrowalliaNew ���ͺ',0,1);
$pdf->SetFont('KoHmu','',16); 
$pdf->Cell(40,10,'KoHmu ���ͺ',0,1);
$pdf->SetFont('KoHmu2','',16); 
$pdf->Cell(40,10,'KoHmu2 ���ͺ',0,1);
$pdf->SetFont('KoHmu3','',16); 
$pdf->Cell(40,10,'KoHmu3 ���ͺ',0,1);
$pdf->SetFont('MicrosoftSansSerif','',16); 
$pdf->Cell(40,10,'MicrosoftSansSerif ���ͺ',0,1);
$pdf->SetFont('PLE_Cara','',16); 
$pdf->Cell(40,10,'PLE_Cara ���ͺ',0,1);
$pdf->SetFont('PLE_Care','',16); 
$pdf->Cell(40,10,'PLE_Care ���ͺ',0,1);
$pdf->SetFont('PLE_Care','B',16); 
$pdf->Cell(40,10,'PLE_Care ���ͺ',0,1);
$pdf->SetFont('PLE_Joy','',16); 
$pdf->Cell(40,10,'PLE_Joy ���ͺ',0,1);
$pdf->SetFont('PLE_Tom','',16); 
$pdf->Cell(40,10,'PLE_Tom ���ͺ',0,1);
$pdf->SetFont('PLE_Tom','B',16); 
$pdf->Cell(40,10,'PLE_Tom ���ͺ',0,1);
$pdf->SetFont('PLE_TomOutline','',16); 
$pdf->Cell(40,10,'PLE_TomOutline ���ͺ',0,1);
$pdf->SetFont('PLE_TomWide','',16); 
$pdf->Cell(40,10,'PLE_TomWide ���ͺ',0,1);
$pdf->SetFont('DilleniaUPC','',16); 
$pdf->Cell(40,10,'DilleniaUPC ���ͺ',0,1);
$pdf->SetFont('DilleniaUPC','B',16); 
$pdf->Cell(40,10,'DilleniaUPC ���ͺ',0,1);
$pdf->SetFont('DilleniaUPC','I',16); 
$pdf->Cell(40,10,'DilleniaUPC ���ͺ',0,1);
$pdf->SetFont('DilleniaUPC','IB',16); 
$pdf->Cell(40,10,'DilleniaUPC ���ͺ',0,1);
$pdf->SetFont('EucrosiaUPC','',16); 
$pdf->Cell(40,10,'EucrosiaUPC ���ͺ',0,1);
$pdf->SetFont('EucrosiaUPC','B',16); 
$pdf->Cell(40,10,'EucrosiaUPC ���ͺ',0,1);
$pdf->SetFont('EucrosiaUPC','I',16); 
$pdf->Cell(40,10,'EucrosiaUPC ���ͺ',0,1);
$pdf->SetFont('EucrosiaUPC','IB',16); 
$pdf->Cell(40,10,'EucrosiaUPC ���ͺ',0,1);
$pdf->SetFont('FreesiaUPC','',16); 
$pdf->Cell(40,10,'FreesiaUPC ���ͺ',0,1);
$pdf->SetFont('FreesiaUPC','B',16); 
$pdf->Cell(40,10,'FreesiaUPC ���ͺ',0,1);
$pdf->SetFont('FreesiaUPC','I',16); 
$pdf->Cell(40,10,'FreesiaUPC ���ͺ',0,1);
$pdf->SetFont('FreesiaUPC','IB',16); 
$pdf->Cell(40,10,'FreesiaUPC ���ͺ',0,1);
$pdf->SetFont('IrisUPC','',16); 
$pdf->Cell(40,10,'IrisUPC ���ͺ',0,1);
$pdf->SetFont('IrisUPC','B',16); 
$pdf->Cell(40,10,'IrisUPC ���ͺ',0,1);
$pdf->SetFont('IrisUPC','I',16); 
$pdf->Cell(40,10,'IrisUPC ���ͺ',0,1);
$pdf->SetFont('IrisUPC','IB',16); 
$pdf->Cell(40,10,'IrisUPC ���ͺ',0,1);
$pdf->SetFont('JasmineUPC','',16); 
$pdf->Cell(40,10,'JasmineUPC ���ͺ',0,1);
$pdf->SetFont('JasmineUPC','B',16); 
$pdf->Cell(40,10,'JasmineUPC ���ͺ',0,1);
$pdf->SetFont('JasmineUPC','I',16); 
$pdf->Cell(40,10,'JasmineUPC ���ͺ',0,1);
$pdf->SetFont('JasmineUPC','IB',16); 
$pdf->Cell(40,10,'JasmineUPC ���ͺ',0,1);
$pdf->SetFont('KodchiangUPC','',16); 
$pdf->Cell(40,10,'KodchiangUPC ���ͺ',0,1);
$pdf->SetFont('KodchiangUPC','B',16); 
$pdf->Cell(40,10,'KodchiangUPC ���ͺ',0,1);
$pdf->SetFont('KodchiangUPC','I',16); 
$pdf->Cell(40,10,'KodchiangUPC ���ͺ',0,1);
$pdf->SetFont('KodchiangUPC','IB',16); 
$pdf->Cell(40,10,'KodchiangUPC ���ͺ',0,1);
$pdf->SetFont('LilyUPC','',16); 
$pdf->Cell(40,10,'LilyUPC ���ͺ',0,1);
$pdf->SetFont('LilyUPC','B',16); 
$pdf->Cell(40,10,'LilyUPC ���ͺ',0,1);
$pdf->SetFont('LilyUPC','I',16); 
$pdf->Cell(40,10,'LilyUPC ���ͺ',0,1);
$pdf->SetFont('LilyUPC','IB',16); 
$pdf->Cell(40,10,'LilyUPC ���ͺ',0,1);
$pdf->Output();
?>  