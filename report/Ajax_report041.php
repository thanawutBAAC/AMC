<?php session_start();
	ob_start();
	header( "Content-Type: text/html; charset=windows-874" ); 
	header( "Expires: Sat, 1 Jan 1979 00:00:00 GMT" );
	header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" );
	header( "Cache-Control: no-cache, must-revalidate" );
	header( "Pragma: no-cache" );
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$month_thai = array("1"=>'���Ҥ�',"2"=>'����Ҿѹ��',"3"=>'�չҤ�',"4"=>'����¹',"5"=>'����Ҥ�',"6"=>'�Զع�¹',"7"=>'�á�Ҥ�',"8"=>'�ԧ�Ҥ�',"9"=>'�ѹ��¹',"10"=>'���Ҥ�',"11"=>'��Ȩԡ�¹',"12"=>'�ѹ�Ҥ�');

	connect();
	$month = escapeshellcmd($_GET["month"]);
	$year = escapeshellcmd($_GET["year"]);
	$province_name = escapeshellcmd($_GET["province_name"]);
	$report_detail_code = escapeshellcmd($_GET["report_detail_code"]);
	$report_detail_name = escapeshellcmd($_GET["report_detail_name"]);
	$minus = "-";  // 㹡óշ���բ����� -  ���ź�͡
	$province_name = str_replace($minus, "", $province_name);

	if(trim($_GET["div"])=='0')
		{ $div = '0'; 
		   $temp_header = "( �����駻���� )"; }
	else
	   { $div = trim($_GET["div"]); 
		  $temp_header = "���¡Ԩ����Ң� ".$div; }
	if(trim($_GET["province"])=='')
	   {  $province = '0'; 
		   if($div!='0')	
	          $temp_header = "���¡Ԩ����Ң� ".$div; 
	   }
	else
	  { $province = trim($_GET["province"]);
		   if($div!='0')	
			   $temp_header = $province_name;  
		}

	$temp_report = "";  // ���Ѿ����е�ͧ�׹���
	// �����§ҹ
	$temp_report.="<strong><center>�ˡó����ɵ����͡�õ�Ҵ�١��� �.�.�. �ӡѴ </center>";
	$temp_report.="<center>3.��Ť�Ҹ�áԨ�Ǻ�����Ե�� (�����§��áԨ��ü�Ե��õ�Ҵ�¢�ǹ����ˡó����ͧ��ê����)</center>";
	$temp_report.="<center>�š�ô��Թ�ҹ�ͧ ʡ�.��Ш���͹ <font color='#76B441'><u>".$month_thai[$month]."</u></font> �� <font color='#76B441'><u>".$year."</u></font> ".$temp_header."</center></strong>";

	//���ҧ�����������§ҹ �Թ��� ��Ǵ��� 3
	$temp_report.="<table width='985' class='gridtable' style='margin-top:25px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.="<tr height='25px'>  ";
    $temp_report.=" <td colspan='15' align='left'>&nbsp;<font color='#0F7FAF'><b>".trim($report_detail_code).".".trim($report_detail_name)."</b></font></td>";
	$temp_report.="</tr>";
	$temp_report.="<tr class='rows_purple'> ";
	$temp_report.=" <td align='center' width='30' rowspan='4'>����</td>";
    $temp_report.=" <td align='center' width='110' rowspan='4'>ʡ�.</td> ";
    $temp_report.=" <td align='center' rowspan='3'>������ºѹ�֡�����͵�ŧ</td> ";
    $temp_report.=" <td align='center' colspan='2' rowspan='3'>�������<br>����Ǻ���<br>��Ե�� �ͧʡ�.</td> ";
    $temp_report.=" <td align='center' colspan='6' >�š���Ǻ��������ҧ��(��Ǫ���Ѵ�ͧ Tris/�ѹ�֡��͵�ŧ)</td> ";
    $temp_report.=" <td align='center' colspan='2' rowspan='2'>ʡ�./ʹ�.<br>ʹѺʹع<br>��á�Ш��<br>��Ե��/��Ե�ѳ��</td> ";
    $temp_report.=" <td align='center' colspan='2' rowspan='2'>�š�ô��Թ�ҹ<br>(3.1)+(3.2)+(4)<br>(Tris/�ѹ�֡��͵�ŧ)</td> ";
    $temp_report.="</tr> ";
    $temp_report.="<tr class='rows_purple'>  ";
    $temp_report.="  <td align='center' colspan='3'>3.1 ʡ�.�Ǻ���<br>��Ե��/��Ե�ѳ��<br>�ҡ��Ҫԡ����ɵá÷���� </td> ";
    $temp_report.="  <td align='center' colspan='3'>3.2 ʹ�.ʹѺʹعͧ���<br>����� �Ǻ���<br>��Ե��/��Ե�ѳ���ҹʡ�. </td> ";
    $temp_report.="</tr> ";
    $temp_report.="<tr class='rows_purple'>  ";
    $temp_report.="  <td align='center' colspan='3'> �š���Ǻ��� </td> ";
    $temp_report.="  <td align='center' colspan='3'> �š��ʹѺʹع�Ǻ��� </td> ";
    $temp_report.="  <td align='center'> ����ҳ </td> ";
    $temp_report.="  <td align='center'> ��Ť�� </td> ";
    $temp_report.="  <td align='center'> ����ҳ </td> ";
	$temp_report.="  <td align='center'> ��Ť�� </td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_purple'>  ";
	$temp_report.="  <td align='center' width='65'>�ѹ</td> ";
	$temp_report.="  <td align='center' width='65'>�ѹ</td> ";
	$temp_report.="  <td align='center' width='65'>�ѹ�ҷ</td> ";
	$temp_report.="  <td align='center' width='65'>���</td> ";
	$temp_report.="  <td align='center' width='65'>�ѹ</td> ";
	$temp_report.="  <td align='center' width='65'>�ѹ�ҷ</td> ";
	$temp_report.="  <td align='center' width='65'>ͧ���</td> ";
	$temp_report.="  <td align='center' width='65'>�ѹ</td> ";
	$temp_report.="  <td align='center' width='65'>�ѹ�ҷ</td> ";
	$temp_report.="  <td align='center' width='65'>�ѹ</td> ";
	$temp_report.="  <td align='center' width='65'>�ѹ�ҷ</td> ";
	$temp_report.="  <td align='center' width='65'>�ѹ</td> ";
	$temp_report.="  <td align='center' width='65'>�ѹ�ҷ</td> ";
	$temp_report.=" </tr> ";

	$sql= " SELECT DISTINCT userlogin.br_code, userlogin.userdetail, ";
	$sql.=" Temp03.target_value, Temp01.PlanCollectBuy_Unit,  ";
	$sql.=" Temp01.PlanCollectBuy_Sum, Temp04.data1, Temp04.data2,  ";
	$sql.=" Temp04.data3, Temp04.data4, Temp04.data5, Temp04.data6,  ";
	$sql.=" Temp04.data7, Temp04.data8, userlogin.amccode ";
	$sql.=" FROM userlogin  ";
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT SUM(PlanCollectBuy.PlanCollectBuy_Sum)AS PlanCollectBuy_Sum ,  ";
	$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Unit)AS PlanCollectBuy_Unit ,  ";
	$sql.=" PlanCollectBuy.amccode "; 
	$sql.=" FROM PlanCollectBuy  ";
	$sql.=" WHERE PlanCollectBuy_year='".$year."'  ";
	$sql.=" AND PlanCollectBuy.report_detail_code='".$report_detail_code."' ";
	$sql.=" GROUP BY PlanCollectBuy.amccode) AS Temp01  ";
	$sql.=" ON Temp01.amccode = userlogin.amccode  ";
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT SUM(target_value)AS target_value, amccode  ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND target_month='".$month."'  ";
	$sql.=" AND TargetTris.report_detail_code='".$report_detail_code."' ";
	$sql.=" GROUP BY amccode) AS Temp03  ";
	$sql.=" ON Temp03.amccode = userlogin.amccode ";
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT SUM(data1)AS data1, SUM(data2)AS data2,  ";
	$sql.=" SUM(data3)AS data3, SUM(data4)AS data4, SUM(data5)AS data5,  ";
	$sql.=" SUM(data6)AS data6, SUM(data7)AS data7, SUM(data8)AS data8,  ";
	$sql.=" amccode  ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE report_year='".$year."' AND report_month='".$month."'  ";
	$sql.=" AND report_detail_code='".$report_detail_code."' ";
	$sql.=" GROUP BY amccode ) AS Temp04  ";
	$sql.=" ON Temp04.amccode = userlogin.amccode  ";

	$sql.=" WHERE userlogin.status = 'N'  ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.=" ORDER BY userlogin.br_code, userlogin.userdetail ";

	$result_report = query($sql);
	// ���ҧ��ǹ��ҧ
	$i = 0;
	// �Ҥ�ҽ����á����բ�����
	if($div==0)
	{	$temp_div = result($result_report,0,"br_code");
		data_seek($result_report);	}

	WHILE($fetch_report = fetch_row($result_report)) { 

		if($div==0)  //  ��ػ����������н���
		{
			if($temp_div==trim($fetch_report[0]))
			{	$sum131 = $sum131+number_format($fetch_report[2],0,'','');
				$sum132 = $sum132+number_format($fetch_report[3],0,'','');
				$sum133 = $sum133+number_format($fetch_report[4],0,'','');
				$sum134 = $sum134+number_format($fetch_report[5],0,'','');
				$sum135 = $sum135+number_format($fetch_report[6],0,'','');
				$sum136 = $sum136+number_format($fetch_report[7],0,'','');
				$sum137 = $sum137+number_format($fetch_report[8],0,'','');
				$sum138 = $sum138+number_format($fetch_report[9],0,'','');
				$sum139 = $sum139+number_format($fetch_report[10],0,'','');
				$sum1310 = $sum1310+number_format($fetch_report[11],0,'','');
				$sum1311 = $sum1311+number_format($fetch_report[12],0,'','');
				$temp_131 = number_format($fetch_report[6],0,'','')+number_format($fetch_report[9],0,'','')+number_format($fetch_report[11],0,'','');
				$temp_132 = number_format($fetch_report[7],0,'','')+number_format($fetch_report[10],0,'','')+number_format($fetch_report[12],0,'','');
				$sum1312 = $sum1312+$temp_131;
				$sum1313 = $sum1313+$temp_132;
			}else
			{	$temp_report.=" <tr class='rows_sky' height='20'>"; 
				$temp_report.="    <td align='center' colspan='2'> ��������Ž��� ".$temp_div." </td>";
				$temp_report.="		<td align='right'>".number_format($sum131,'', '.', ',')."&nbsp;</td>";
				$temp_report.="		<td align='right'>".number_format($sum132,'', '.', ',')."&nbsp;</td>";
				$temp_report.="		<td align='right'>".number_format($sum133,'', '.', ',')."&nbsp;</td>";
				$temp_report.="		<td align='right'>".number_format($sum134,'', '.', ',')."&nbsp;</td>";
				$temp_report.="		<td align='right'>".number_format($sum135,'', '.', ',')."&nbsp;</td>";
				$temp_report.="		<td align='right'>".number_format($sum136,'', '.', ',')."&nbsp;</td>";
				$temp_report.="		<td align='right'>".number_format($sum137,'', '.', ',')."&nbsp;</td>";
				$temp_report.="		<td align='right'>".number_format($sum138,'', '.', ',')."&nbsp;</td>";
				$temp_report.="		<td align='right'>".number_format($sum139,'', '.', ',')."&nbsp;</td>";
				$temp_report.="		<td align='right'>".number_format($sum1310,'', '.', ',')."&nbsp;</td>";
				$temp_report.="		<td align='right'>".number_format($sum1311,'', '.', ',')."&nbsp;</td>";
				$temp_report.="		<td align='right'>".number_format($sum1312,'', '.', ',')."&nbsp;</td>";
				$temp_report.="		<td align='right'>".number_format($sum1313,'', '.', ',')."&nbsp;</td>";
				$temp_report.="	</tr>";
				$sum131 = 0;
				$sum132 = 0;
				$sum133 = 0;
				$sum134 = 0; 
				$sum135 = 0;
				$sum136 = 0;
				$sum137 = 0; 
				$sum138 = 0;
				$sum139 = 0;
				$sum1310 = 0; 
				$sum1311 = 0;
				$sum1312 = 0;
				$sum1313 = 0;
				$temp_div = trim($fetch_report[0]);
			}
		} // end div=0

	$i++;
	if(($i%2)==0)
		 $temp_report.= "<tr class='rows_grey'>"; 
	else
		 $temp_report.="<tr>";  

		$temp_report.=" <td align='center'>".trim($fetch_report[0])."</td> ";
		$temp_report.=" <td><a href='#' OnClick=' doCallAjax99(\"".trim($fetch_report[13])."\",\"".trim($fetch_report[1])."\")' > &nbsp;".trim($fetch_report[1])."</a></td>";
		$temp_report.=" <td align='right'>".number_format($fetch_report[2])."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($fetch_report[3])."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($fetch_report[4])."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($fetch_report[5])."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($fetch_report[6])."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($fetch_report[7])."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($fetch_report[8])."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($fetch_report[9])."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($fetch_report[10])."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($fetch_report[11])."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($fetch_report[12])."&nbsp;</td> ";
		$temp_31 = number_format($fetch_report[6],0,'','')+number_format($fetch_report[9],0,'','')+number_format($fetch_report[11],0,'','');
		$temp_32 = number_format($fetch_report[7],0,'','')+number_format($fetch_report[10],0,'','')+number_format($fetch_report[12],0,'','');
		$temp_report.=" <td align='right'>".number_format($temp_31)."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($temp_32)."&nbsp;</td> ";
		$temp_report.=" </tr> ";

		$sum31 = $sum31+number_format($fetch_report[2],0,'','');
		$sum32 = $sum32+number_format($fetch_report[3],0,'','');
		$sum33 = $sum33+number_format($fetch_report[4],0,'','');
		$sum34 = $sum34+number_format($fetch_report[5],0,'','');
		$sum35 = $sum35+number_format($fetch_report[6],0,'','');
		$sum36 = $sum36+number_format($fetch_report[7],0,'','');
		$sum37 = $sum37+number_format($fetch_report[8],0,'','');
		$sum38 = $sum38+number_format($fetch_report[9],0,'','');
		$sum39 = $sum39+number_format($fetch_report[10],0,'','');
		$sum310 = $sum310+number_format($fetch_report[11],0,'','');
		$sum311 = $sum311+number_format($fetch_report[12],0,'','');

} // end while

	if($div==0)
	{		$temp_report.=" <tr class='rows_sky' height='20'>"; 
			$temp_report.="  <td align='center' colspan='2'> ��������Ž��� ".$temp_div." </td>";
			$temp_report.="		<td align='right'>".number_format($sum131,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum132,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum133,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum134,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum135,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum136,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum137,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum138,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum139,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum1310,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum1311,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum1312,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum1313,'', '.', ',')."&nbsp;</td>";
			$temp_report.="	</tr>";
	}
	// ���ҧ��������ǹ���� �ѹ�ҷ
	$temp_report.=" <tr class='rows_yellow' height='20'>";
	$temp_report.=" <td align='center' colspan='2'> ��� </td>";
	$temp_report.="		<td align='right'>".number_format($sum31,'', '.', ',')."&nbsp;</td>";
	$temp_report.="		<td align='right'>".number_format($sum32,'', '.', ',')."&nbsp;</td>";
	$temp_report.="		<td align='right'>".number_format($sum33,'', '.', ',')."&nbsp;</td>";
	$temp_report.="		<td align='right'>".number_format($sum34,'', '.', ',')."&nbsp;</td>";
	$temp_report.="		<td align='right'>".number_format($sum35,'', '.', ',')."&nbsp;</td>";
	$temp_report.="		<td align='right'>".number_format($sum36,'', '.', ',')."&nbsp;</td>";
	$temp_report.="		<td align='right'>".number_format($sum37,'', '.', ',')."&nbsp;</td>";
	$temp_report.="		<td align='right'>".number_format($sum38,'', '.', ',')."&nbsp;</td>";
	$temp_report.="		<td align='right'>".number_format($sum39,'', '.', ',')."&nbsp;</td>";
	$temp_report.="		<td align='right'>".number_format($sum310,'', '.', ',')."&nbsp;</td>";
	$temp_report.="		<td align='right'>".number_format($sum311,'', '.', ',')."&nbsp;</td>";
	$sum312=$sum35+$sum38+$sum310;
	$sum313=$sum37+$sum39+$sum311;
	$temp_report.="		<td align='right'>".number_format($sum312,'', '.', ',')."&nbsp;</td>";
	$temp_report.="		<td align='right'>".number_format($sum313,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" </tr></table>";
$temp_report.="<br>";
$temp_report.="<center><a href='excel_search.php?div=".$div."&province=".$province."&project=".$project."'><img src='../images/page_excel.gif' border='0'> ������ Excel </a></center>";

	free_result($result_report);
   close();

 echo $temp_report;
 ob_end_flush();