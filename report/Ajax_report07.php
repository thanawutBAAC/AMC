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

	// ���ҧ��ǵ��ҧ��§ҹ��ǹ��� 3
	$temp_report.="<table width='1725' class='gridtable' style='margin-top:15px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.="<tr height='25px'>  ";
    $temp_report.=" <td colspan='22' align='left'>&nbsp;<font color='#0F7FAF'><b>3.��Ť�Ҹ�áԨ�Ǻ�����Ե�� (�����§��áԨ��ü�Ե��õ�Ҵ�¢�ǹ����ˡó����ͧ��ê����) </b></font></td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_purple'>  ";
	$temp_report.=" <td rowspan='4' width='150' align='center' valign='middle'>�ż�Ե</td> ";
	$temp_report.=" <td rowspan='3' align='center' valign='middle'>������µ���ѹ�֡��͵�ŧ</td> ";
	$temp_report.=" <td colspan='2' rowspan='3' align='center' valign='middle'>������¡���Ǻ�����Ե�� �ͧʡ�.</td> ";
	$temp_report.=" <td colspan='6' align='center' >(3) �š���Ǻ��������ҧ��(��Ǫ���Ѵ�ͧ Tris/�ѹ�֡��͵�ŧ)</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>(4) ʡ�./ʹ�.ʹѺʹع��á�Ш�¼�Ե��/��Ե�ѳ��</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>(5)  �š�ô��Թ�ҹ<br>(3.1)+(3.2)+(4)<br>(Tris/�ѹ�֡��͵�ŧ)</td> ";
	$temp_report.=" <td colspan='2' rowspan='3' align='center' valign='middle'>(6) ������¡�è�˹��¼�Ե�� �ͧʡ�</td> ";
	$temp_report.=" <td colspan='4' align='center' >(7) �š�è�˹��������ҧ��</td> ";
	$temp_report.=" <td rowspan='3' align='center' valign='middle'>(8) ��Ť�� ��Ե�Ť������</td> ";
	$temp_report.=" <td rowspan='3' align='center' valign='middle'>(9) �繹��˹��/���᷹</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_purple'>  ";
	$temp_report.=" <td colspan='3' align='center' >(3.1) ʡ�.�Ǻ��� ��Ե��/��Ե�ѳ��ҡ��Ҫԡ����ɵá÷����</td> ";
	$temp_report.=" <td colspan='3' align='center' >(3.2) ʹ�.ʹѺʹعͧ��ê����<br>�Ǻ��� ��Ե��/��Ե�ѳ��</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>��˹������</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>��˹������TABCO</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_purple'>  ";
	$temp_report.=" <td colspan='3' align='center' >�š���Ǻ���</td> ";
	$temp_report.=" <td colspan='3' align='center' >�š��ʹѺʹع�Ǻ���</td> ";
	$temp_report.=" <td align='center' >����ҳ</td> ";
	$temp_report.=" <td align='center' >��Ť��</td> ";
	$temp_report.=" <td align='center' >����ҳ</td> ";
	$temp_report.=" <td align='center' >��Ť��</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_purple'>  ";
	$temp_report.=" <td align='center' width='70'>(�ѹ)</td> ";
	$temp_report.=" <td align='center' width='70'>(�ѹ)</td> ";
	$temp_report.=" <td align='center' width='70'>(�ѹ�ҷ)</td> ";
	$temp_report.=" <td align='center' width='75'>(���)</td> ";
	$temp_report.=" <td align='center' width='75'>(�ѹ)</td> ";
	$temp_report.=" <td align='center' width='75'>(�ѹ�ҷ)</td> ";
	$temp_report.=" <td align='center' width='70'>(ͧ���)</td> ";
	$temp_report.=" <td align='center' width='70'>(�ѹ)</td> ";
	$temp_report.=" <td align='center' width='70'>(�ѹ�ҷ)</td> ";
	$temp_report.=" <td align='center' width='70'>(�ѹ)</td> ";
	$temp_report.=" <td align='center' width='70'>(�ѹ�ҷ)</td> ";
	$temp_report.=" <td align='center' width='70'>(�ѹ)</td> ";
	$temp_report.=" <td align='center' width='70'>(�ѹ�ҷ)</td> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ)</td> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ�ҷ)</td> ";
	$temp_report.=" <td align='center' width='70'>(�ѹ)</td> ";
	$temp_report.=" <td align='center' width='70'>(�ѹ�ҷ)</td> ";
	$temp_report.=" <td align='center' width='70'>(�ѹ)</td> ";
	$temp_report.=" <td align='center' width='70'>(�ѹ�ҷ)</td> ";
	$temp_report.=" <td align='center' width='70'>(�Ҥҷع)</td> ";
	$temp_report.=" <td align='center' width='70'>(�ѹ�ҷ)</td> ";
	$temp_report.="</tr> ";
// ���ҧ��������ǹ�����ҡ�ҧ���ҧ
	$sql = " SELECT DISTINCT ";
	$sql.=" BaseReportDetail.report_detail_code,  ";
	$sql.=" BaseReportDetail.report_detail_name,  ";
	$sql.=" Temp03.target_value, Temp01.PlanCollectBuy_Unit,  ";
	$sql.=" Temp01.PlanCollectBuy_Sum,  ";
	$sql.=" Temp04.data1, Temp04.data2,  ";
	$sql.=" Temp04.data3, Temp04.data4,  ";
	$sql.=" Temp04.data5, Temp04.data6,  ";
	$sql.=" Temp04.data7, Temp04.data8,  ";
	$sql.=" Temp02.PlanCollectSell_Unit, Temp02.PlanCollectSell_Sum, ";
	$sql.=" Temp04.data9, Temp04.data10,  ";
	$sql.=" Temp04.data11,Temp04.data12, ";
	$sql.=" Temp04.data13, Temp04.data14,  ";
	$sql.=" Temp05.COUNT01 ";
	$sql.=" FROM BaseReportHeader,userlogin, BaseReportDetail  ";
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT  ";
	$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Sum)AS PlanCollectBuy_Sum ,  ";
	$sql.=" SUM(PlanCollectBuy.PlanCollectBuy_Unit)AS PlanCollectBuy_Unit ,  ";
	$sql.=" PlanCollectBuy.report_detail_code  ";
	$sql.=" FROM PlanCollectBuy,userlogin  ";
	$sql.=" WHERE PlanCollectBuy_year='".$year."'  ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.=" AND userlogin.amccode = PlanCollectBuy.amccode ";
	$sql.=" GROUP BY PlanCollectBuy.report_detail_code) AS Temp01  ";
	$sql.=" ON Temp01.report_detail_code = BaseReportDetail.report_detail_code  ";

	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT  ";
	$sql.=" SUM(PlanCollectSell.PlanCollectSell_Sum)AS PlanCollectSell_Sum,  ";
	$sql.=" SUM(PlanCollectSell.PlanCollectSell_Unit)AS PlanCollectSell_Unit,  ";
	$sql.=" PlanCollectSell.report_detail_code  ";
	$sql.=" FROM PlanCollectSell,userlogin  ";
	$sql.=" WHERE PlanCollectSell.PlanCollectSell_year='".$year."' ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.=" AND userlogin.amccode=PlanCollectSell.amccode ";
	$sql.=" GROUP BY PlanCollectSell.report_detail_code  ) AS Temp02  ";
	$sql.=" ON Temp02.report_detail_code = BaseReportDetail.report_detail_code  ";

	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT SUM(target_value)AS target_value, report_detail_code  ";
	$sql.=" FROM TargetTris,userlogin ";
	$sql.=" WHERE target_year='".$year."' and target_month='".$month."' ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.=" AND userlogin.amccode=TargetTris.amccode  ";
	$sql.=" GROUP BY report_detail_code) AS Temp03  ";
	$sql.=" ON Temp03.report_detail_code = BaseReportDetail.report_detail_code  ";

	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT  ";
	$sql.=" SUM(data1)AS data1, SUM(data2)AS data2, SUM(data3)AS data3, ";
	$sql.=" SUM(data4)AS data4, SUM(data5)AS data5, SUM(data6)AS data6, ";
	$sql.=" SUM(data7)AS data7, SUM(data8)AS data8, SUM(data9)AS data9, ";
	$sql.=" SUM(data10)AS data10, SUM(data11)AS data11,SUM(data12)AS data12, ";
	$sql.=" SUM(data13)AS data13, SUM(data14)AS data14 ,report_detail_code ";
	$sql.=" FROM ReportGroup3,userlogin  ";
	$sql.=" WHERE report_year='".$year."' AND report_month='".$month."'  ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.=" AND userlogin.amccode=ReportGroup3.amccode ";
	$sql.=" GROUP BY report_detail_code ) ";
	$sql.=" AS Temp04 ON Temp04.report_detail_code = BaseReportDetail.report_detail_code  ";

	$sql.=" LEFT JOIN( ";
	$sql.="   SELECT COUNT(DISTINCT BaseReportHeader.amccode)AS COUNT01, ";
	$sql.="   BaseReportHeader.report_detail_code ";
	$sql.="   FROM BaseReportHeader,userlogin ";
	$sql.="   WHERE BaseReportHeader.amccode = userlogin.amccode ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.="   AND BaseReportHeader.report_group_code='3' ";
	$sql.="   GROUP BY BaseReportHeader.report_detail_code ";
	$sql.=" )AS Temp05 ON Temp05.report_detail_code = BaseReportDetail.report_detail_code ";

	$sql.=" WHERE userlogin.amccode = BaseReportHeader.amccode AND  ";
	$sql.=" BaseReportDetail.report_group_code = BaseReportHeader.report_group_code AND  ";
	$sql.=" BaseReportDetail.report_detail_code = BaseReportHeader.report_detail_code AND  ";
	$sql.=" BaseReportDetail.report_group_code='3'  ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.=" ORDER BY  ";
	$sql.=" BaseReportDetail.report_detail_code,  ";
	$sql.=" BaseReportDetail.report_detail_name ";

	$result_report3 = query($sql);
	$i = 0;
	WHILE($fetch_report3 = fetch_row($result_report3)) { 
	$i++;
	if(($i%2)==0)
		$temp_report.= "<tr class='rows_grey'>";
	else
		$temp_report.="<tr>"; 

//	$temp_report.=" <td align='left'>&nbsp;".trim($fetch_report3[0]).".".trim($fetch_report3[1])."(".$fetch_report3[21].")</td> ";
	$temp_report.="  <td align='left'>&nbsp; <a href='#' OnClick=' doCallAjax71(".$div.",".$year.",".$month.",".trim($fetch_report3[0]).",\"".trim($fetch_report3[1])."\") '>".trim($fetch_report3[1])."(".$fetch_report3[21].")</a></td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[2])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[3])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[4])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[5])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[6])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[7])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[8])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[9])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[10])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[11])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[12])."&nbsp;</td> ";
	$temp_31 = number_format($fetch_report3[6],0,'','')+number_format($fetch_report3[9],0,'','')+number_format($fetch_report3[11],0,'','');
	$temp_32 = number_format($fetch_report3[7],0,'','')+number_format($fetch_report3[10],0,'','')+number_format($fetch_report3[12],0,'','');
	$temp_report.=" <td align='right'>".number_format($temp_31)."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($temp_32)."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[13])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[14])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[15])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[16])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[17])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[18])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[19])."&nbsp;</td> ";
	$temp_report.=" <td align='right'>".number_format($fetch_report3[20])."&nbsp;</td> ";
	$temp_report.=" </tr> ";
	$sum31 = $sum31+number_format($fetch_report3[2],0,'','');
	$sum32 = $sum32+number_format($fetch_report3[3],0,'','');
	$sum33 = $sum33+number_format($fetch_report3[4],0,'','');
	$sum34 = $sum34+number_format($fetch_report3[5],0,'','');
	$sum35 = $sum35+number_format($fetch_report3[6],0,'','');
	$sum36 = $sum36+number_format($fetch_report3[7],0,'','');
	$sum37 = $sum37+number_format($fetch_report3[8],0,'','');
	$sum38 = $sum38+number_format($fetch_report3[9],0,'','');
	$sum39 = $sum39+number_format($fetch_report3[10],0,'','');
	$sum310 = $sum310+number_format($fetch_report3[11],0,'','');
	$sum311 = $sum311+number_format($fetch_report3[12],0,'','');
	$sum312 = $sum312+$temp_31;
	$sum313 = $sum313+$temp_32;
	$sum314 = $sum314+number_format($fetch_report3[13],0,'','');
	$sum315 = $sum315+number_format($fetch_report3[14],0,'','');
	$sum316 = $sum316+number_format($fetch_report3[15],0,'','');
	$sum317 = $sum317+number_format($fetch_report3[16],0,'','');
	$sum318 = $sum318+number_format($fetch_report3[17],0,'','');
	$sum319 = $sum319+number_format($fetch_report3[18],0,'','');
	$sum320 = $sum320+number_format($fetch_report3[19],0,'','');
	$sum321 = $sum321+number_format($fetch_report3[20],0,'','');
} // end while
// ���ҧ��������ǹ���µ��ҧ
  	$temp_report.="<tr class='rows_yellow'> ";
	$temp_report.="  <td align='center'> ��� </td> ";
	$temp_report.="  <td align='right'>".number_format($sum31)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum32)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum33)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum34)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum35)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum36)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum37)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum38)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum39)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum310)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum311)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum312)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum313)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum314)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum315)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum316)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum317)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum318)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum319)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum320)."&nbsp;</td> ";
	$temp_report.="  <td align='right'>".number_format($sum321)."&nbsp;</td> ";
	$temp_report.=" </tr> ";
	$temp_report.="</table> ";
$temp_report.="<br>";
$temp_report.="<center><a href='excel_search.php?div=".$div."&province=".$province."&project=".$project."'><img src='../images/page_excel.gif' border='0'> ������ Excel </a></center>";

	free_result($result_report3);
   close();

 echo $temp_report;
 ob_end_flush();