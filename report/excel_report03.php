<?php session_start();
	ob_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="��§ҹ��Ť�Ҹ�áԨ�Ѵ���Թ����Ҩ�˹���.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$month_thai = array("1"=>'���Ҥ�',"2"=>'����Ҿѹ��',"3"=>'�չҤ�',"4"=>'����¹',"5"=>'����Ҥ�',"6"=>'�Զع�¹',"7"=>'�á�Ҥ�',"8"=>'�ԧ�Ҥ�',"9"=>'�ѹ��¹',"10"=>'���Ҥ�',"11"=>'��Ȩԡ�¹',"12"=>'�ѹ�Ҥ�');

	connect();
	$month = escapeshellcmd($_GET["month"]);
	$year = escapeshellcmd($_GET["year"]);
	$province_name = escapeshellcmd($_GET["province_name"]);
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

?>
<html  xmlns:o="urn:schemas-microsoft-com:office:office" 
xmlns:x="urn:schemas-microsoft-com:office:excel" 
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<title>��§ҹ��Ť�Ҹ�áԨ�Ѵ���Թ����Ҩ�˹���</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
<body>
<?
	$temp_report = "";  // ���Ѿ����е�ͧ�׹���
	// �����§ҹ
	$temp_report.="<strong><center>�ˡó����ɵ����͡�õ�Ҵ�١��� �.�.�. �ӡѴ </center>";
	$temp_report.="<center>AGRICULTURAL MARKETING COOPERATIVE (AMC) </center>";
	$temp_report.="<center>��§ҹ�š�ô��Թ�ҹ�����ͧ ʡ�.��Ш���͹ <font color='#76B441'><u>".$month_thai[$month]."</u></font> �� <font color='#76B441'><u>".$year."</u></font> ".$temp_header."</center></strong>";
	
	//���ҧ�����������§ҹ
	$temp_report.="<table width='1347' border='1' style='margin-top:25px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.="<tr height='25px'>  ";
	$temp_report.="	<td colspan='16' align='left'>&nbsp;<font color='#0F7FAF'><b> 2. ��Ť�Ҹ�áԨ�Ѵ���Թ����Ҩ�˹��� </b></font></td> ";
	$temp_report.="</tr> ";
   // *****************
   	$temp_report.="<tr bgcolor='#CCFFCC'> ";
	$temp_report.="	<td rowspan='3' align='center' valign='middle' width='50'> ���� </td> ";
	$temp_report.="	<td rowspan='3' align='center' valign='middle' width='200'> ʡ�. </td>";
	$temp_report.="	<td colspan='8' align='center' width='600'> �����Թ��������ҧ�� </td>";
	$temp_report.="	<td colspan='5' rowspan='2' align='center' width='375'> ����Թ��������ҧ�� </td>";
	$temp_report.="	<td rowspan='3' align='center' valign='middle' width='120'> ��Ť���Թ��ҷ��Ѵ��������ҹ<br>�ѭ�ի���-��� </td>";
	$temp_report.="</tr>";
	$temp_report.="<tr bgcolor='#CCFFCC'> ";
	$temp_report.="	<td colspan='5' align='center' width='375'> ��� </td>";
	$temp_report.="	<td colspan='3' align='center' width='225'> ੾�з����ͨҡ TABCO</td>";
	$temp_report.="</tr>";
	$temp_report.="<tr bgcolor='#CCFFCC'> ";
	$temp_report.="	<td align='center' width='75'> ������� <br>(�ѹ�ҷ)</td>";
	$temp_report.="	<td align='center' width='75'> ������� <br>(˹���)</td>";
	$temp_report.="	<td align='center' width='75'> ��ԧ <br>(�ѹ�ҷ)</td>";
	$temp_report.="	<td align='center' width='75'> ��ԧ <br>(˹���)</td>";
	$temp_report.="	<td align='center' width='75'> �ŵ�ҧ(%) </td>";
	$temp_report.="	<td align='center' width='75'> ��ԧ <br>(�ѹ�ҷ)</td>";
	$temp_report.="	<td align='center' width='75'> ��ԧ <br>(˹���)</td>";
	$temp_report.="	<td align='center' width='75'> �ӹǳ </td>";
	$temp_report.="	<td align='center' width='75'> ������� <br>(�ѹ�ҷ)</td>";
	$temp_report.="	<td align='center' width='75'> ������� <br>(˹���)</td>";
	$temp_report.="	<td align='center' width='75'> ��ԧ <br>(�ѹ�ҷ)</td>";
	$temp_report.="	<td align='center' width='75'> ��ԧ <br>(˹���)</td>";
	$temp_report.="	<td align='center' width='75'> �ŵ�ҧ(%) </td>";
	$temp_report.="</tr>";
	// ****************

//  ***********************   ��Ǩ�ͺ����觢���������ش�ͧ ʡ� ���  **************************
		$current_amc = array();
		$sql = " CREATE TABLE #Temp_SentReport ( amccode varchar(30)  COLLATE THAI_CI_AS NULL, sent_month int NULL, max_month int NULL )
			 
					INSERT INTO #Temp_SentReport SELECT [amccode], [sent_month] ,
					  (CASE WHEN SentReportHeader.sent_month = '1' THEN 13 
						WHEN SentReportHeader.sent_month = '2' THEN 14 
						WHEN SentReportHeader.sent_month = '3' THEN 15 
						WHEN SentReportHeader.sent_month = '4' THEN 4 
						WHEN SentReportHeader.sent_month = '5' THEN 5 
						WHEN SentReportHeader.sent_month = '6' THEN 6 
						WHEN SentReportHeader.sent_month = '7' THEN 7 
						WHEN SentReportHeader.sent_month = '8' THEN 8 
						WHEN SentReportHeader.sent_month = '9' THEN 9 
						WHEN SentReportHeader.sent_month = '10' THEN 10 
						WHEN SentReportHeader.sent_month = '11' THEN 11 
						WHEN SentReportHeader.sent_month = '12' THEN 12 ELSE 0 END)AS max_month2 
					FROM [SentReportHeader]
					WHERE sent_year = '".$year."'

				SELECT userlogin.amccode, Temp01.max_month, userlogin.userdetail  FROM userlogin 
					LEFT JOIN ( 
					SELECT amccode, MAX(max_month) AS max_month FROM #Temp_SentReport
					WHERE max_month <= ".$month_report2[$month]."
					GROUP BY amccode
				)AS Temp01 ON Temp01.amccode = userlogin.amccode ";
		$sql.=" WHERE userlogin.status='N' ";
		if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";	}
		if($province!='0' AND trim($province)!='' )
		{	$sql.=" AND userlogin.amccode='".$province."' "; }

		$result_amc = query($sql);
		query(" DROP TABLE #Temp_SentReport ");

		$display_sql = " ( "; // �纤������� ʡ� �觢���������ش��͹�˹ 
		WHILE($fetch_amc = fetch_row($result_amc)) { 

			$current_amc[trim($fetch_amc[0])] = $month_report3[trim($fetch_amc[1])];			// �ŧ����������͹�Ѩ�غѹ
			$display_sql.=" ( amccode='".trim($fetch_amc[0])."' AND report_month='".$month_report3[number_format($fetch_amc[1],0,'','')]."' ) OR";
		} // end while 

		$display_sql = substr($display_sql, 0, -2);   //  �����ҵ�� 2 �ش������   OR
		$display_sql.=" ) ";
//  **************************  ����ش��õ�Ǩ�ͺ   ****************************************

	$sql = "	SELECT userlogin.br_code, userlogin.userdetail,";
	$sql.=" Temp01.PlanProcureBuy_Sum, Temp02.product_buy_sum, ";
	$sql.=" Temp02.product_buy_tabco,Temp03.PlanProcureSell_Sum, ";
	$sql.=" Temp02.product_sell_sum,Temp02.product_procure,userlogin.amccode, ";
	$sql.=" Temp01.PlanProcureBuy_Unit, Temp02.product_buy_unit, "; // 9 - 13 
	$sql.=" Temp02.product_tabco_unit, Temp03.PlanProcureSell_Unit,  ";
	$sql.=" Temp02.product_sell_unit ";
	$sql.="  FROM userlogin ";
	$sql.=" LEFT JOIN( ";
	$sql.=" 	SELECT amccode, SUM(PlanProcureBuy_Sum) AS PlanProcureBuy_Sum ";
	$sql.="  , SUM(PlanProcureBuy_Unit) AS PlanProcureBuy_Unit ";
	$sql.=" 	FROM PlanProcureBuy ";
	$sql.=" 	WHERE PlanProcureBuy_year='".$year."' ";
	$sql.=" 	GROUP BY amccode	 ";
	$sql.=" )AS Temp01 ON Temp01.amccode = userlogin.amccode ";
	$sql.=" LEFT JOIN( ";
	$sql.=" 	SELECT amccode, SUM(product_buy_sum) AS product_buy_sum ,  ";
	$sql.=" 	SUM(product_buy_tabco) AS product_buy_tabco, ";
	$sql.=" 	SUM(product_sell_sum) AS product_sell_sum,  ";
	$sql.=" 	SUM(product_procure) AS product_procure, ";
	$sql.=" 	SUM(product_buy_unit) AS product_buy_unit, ";
	$sql.=" 	SUM(product_tabco_unit) AS product_tabco_unit, ";
	$sql.=" 	SUM(product_sell_unit) AS product_sell_unit ";
	$sql.=" 	FROM ReportGroup2 ";
	$sql.=" 	WHERE report_year='".$year."' "; 
	// AND report_month='".$month."' ";
	$sql.=" AND ".$display_sql;
	$sql.=" 	GROUP BY amccode ";
	$sql.=" )AS Temp02 ON Temp02.amccode = userlogin.amccode ";
	$sql.=" LEFT JOIN( ";
	$sql.=" 	SELECT amccode, SUM(PlanProcureSell_Sum)AS PlanProcureSell_Sum ";
	$sql.=" , SUM(PlanProcureSell_Unit) AS PlanProcureSell_Unit ";
	$sql.=" 	FROM PlanProcureSell ";
	$sql.=" 	WHERE PlanProcureSell_year='".$year."' ";
	$sql.=" 	GROUP BY amccode ";
	$sql.=" )AS Temp03 ON Temp03.amccode = userlogin.amccode ";
	$sql.=" WHERE userlogin.status='N' ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.=" ORDER BY userlogin.br_code, userlogin.userdetail ";

	$result_report = query($sql);
	//  ���ҧ��������������§ҹ
	$i=0;
	// �Ҥ�ҽ����á����բ�����
	if($div==0)
	{	$temp_div = result($result_report,0,"br_code");
		data_seek($result_report);	}

	WHILE($fetch_report = fetch_row($result_report)) { 

				if($div==0)  //  ��ػ����������н���
				{
					if($temp_div==trim($fetch_report[0]))
					{	$sum101=$sum101+number_format($fetch_report[2],0,'','');
						$sum102=$sum102+number_format($fetch_report[3],0,'','');
						$sum103=$sum103+number_format($fetch_report[4],0,'','');
						$sum104=$sum104+number_format($fetch_report[5],0,'','');
						$sum105=$sum105+number_format($fetch_report[6],0,'','');
						$sum106=$sum106+number_format($fetch_report[7],0,'','');

						$sum107=$sum107+number_format($fetch_report[9],0,'','');
						$sum108=$sum108+number_format($fetch_report[10],0,'','');
						$sum109=$sum109+number_format($fetch_report[11],0,'','');
						$sum110=$sum110+number_format($fetch_report[12],0,'','');
						$sum111=$sum111+number_format($fetch_report[13],0,'','');

					}else
					{	$temp_report.=" <tr bgcolor='#99CCFF' height='20'>"; 
						$temp_report.="    <td align='center' colspan='2'> ��������Ž��� ".$temp_div." </td>";
						$temp_report.="		<td align='right'>".number_format($sum101,'', '.', ',')."</td>";
						$temp_report.="		<td align='right'>".number_format($sum107,'', '.', ',')."</td>";
						$temp_report.="		<td align='right'>".number_format($sum102,'', '.', ',')."</td>";
						$temp_report.="		<td align='right'>".number_format($sum108,'', '.', ',')."</td>";
						$temp_report.="		<td align='center'></td>";
						$temp_report.="		<td align='right'>".number_format($sum103,'', '.', ',')."</td>";
						$temp_report.="		<td align='right'>".number_format($sum109,'', '.', ',')."</td>";
						$temp_report.="		<td align='center'></td>";
						$temp_report.="		<td align='right'>".number_format($sum104,'', '.', ',')."</td>";
						$temp_report.="		<td align='right'>".number_format($sum110,'', '.', ',')."</td>";
						$temp_report.="		<td align='right'>".number_format($sum105,'', '.', ',')."</td>";
						$temp_report.="		<td align='right'>".number_format($sum111,'', '.', ',')."</td>";
						$temp_report.="		<td align='center'></td>";
						$temp_report.="		<td align='right'>".number_format($sum106,'', '.', ',')."</td>";
						$temp_report.="	</tr>";
						$sum101=0;    $sum102=0;    $sum103=0;
						$sum104=0;    $sum105=0;    $sum106=0;
						$sum107=0;    $sum108=0;    $sum109=0;
						$sum110=0;    $sum111=0;
						$sum101= number_format($fetch_report[2],0,'','');
						$sum102= number_format($fetch_report[3],0,'','');
						$sum103= number_format($fetch_report[4],0,'','');
						$sum104= number_format($fetch_report[5],0,'','');
						$sum105= number_format($fetch_report[6],0,'','');
						$sum106= number_format($fetch_report[7],0,'','');
						$sum107= number_format($fetch_report[9],0,'','');
						$sum108= number_format($fetch_report[10],0,'','');
						$sum109= number_format($fetch_report[11],0,'','');
						$sum110= number_format($fetch_report[12],0,'','');
						$sum111= number_format($fetch_report[13],0,'','');
						$temp_div = trim($fetch_report[0]);
					}
				} // end div=0

			$i++;	
			if(($i%2)==0)
			{	$temp_report.=" <tr bgcolor='#C0C0C0'>";  }
			else
			{  $temp_report.=" <tr>";  }

				$temp_report.="  <td align='center'>".trim($fetch_report[0])."</td>";
				$temp_report.=" <td>&nbsp;ʡ�.".trim($fetch_report[1])."  [".$current_amc[$fetch_report[8]]."]  </td>";
				$temp_report.="  <td align='right'>".number_format($fetch_report[2])."</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report[9])."</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report[3])."</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report[10])."</td> ";
				if(number_format($fetch_report[2],0,'','')==0)
				{	$temp_present = "0"; }
				else
				{	$temp_present = number_format($fetch_report[3],0,'','')/(number_format($fetch_report[2], 0,'', '')/100)-100;  }
				$temp_report.="  <td align='right'>".number_format($temp_present,2, '.', ',')."%</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report[4])."</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report[11])."</td> ";
				if(number_format($fetch_report[3],0,'','')==0)
				{	$temp_present = "0"; }
				else
				{	$temp_present = (number_format($fetch_report[4],0,'', '')/number_format($fetch_report[3],0,'', ''))*100;  }
				$temp_report.="  <td align='right'>".number_format($temp_present,2, '.', ',')."%</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report[5])."</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report[12])."</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report[6])."</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report[13])."</td> ";
				if(number_format($fetch_report[5],0,'','')==0)
				{	$temp_present = "0"; }
				else
				{	$temp_present = number_format($fetch_report[6],0,'', '')/(number_format($fetch_report[5],0,'', '')/100)-100;  } 
				$temp_report.="  <td align='right'>".number_format($temp_present,2, '.', ',')."%</td> ";
				$temp_report.="  <td align='right'>".number_format($fetch_report[7])."</td> ";
				$temp_report.="</tr> ";

				$sum01=$sum01+number_format($fetch_report[2],0,'','');
				$sum02=$sum02+number_format($fetch_report[3],0,'','');
				$sum03=$sum03+number_format($fetch_report[4],0,'','');
				$sum04=$sum04+number_format($fetch_report[5],0,'','');
				$sum05=$sum05+number_format($fetch_report[6],0,'','');
				$sum06=$sum06+number_format($fetch_report[7],0,'','');

				$sum07=$sum07+number_format($fetch_report[9],0,'','');
				$sum08=$sum08+number_format($fetch_report[10],0,'','');
				$sum09=$sum09+number_format($fetch_report[11],0,'','');
				$sum10=$sum10+number_format($fetch_report[12],0,'','');
				$sum11=$sum11+number_format($fetch_report[13],0,'','');
		
	}  // end while 
		if($div==0)
	{		$temp_report.=" <tr bgcolor='#99CCFF' height='20'>"; 
			$temp_report.="  <td align='center' colspan='2'> ��������Ž��� ".$temp_div." </td>";
			$temp_report.="		<td align='right'>".number_format($sum101,'', '.', ',')."</td>";
			$temp_report.="		<td align='right'>".number_format($sum107,'', '.', ',')."</td>";
			$temp_report.="		<td align='right'>".number_format($sum102,'', '.', ',')."</td>";
			$temp_report.="		<td align='right'>".number_format($sum108,'', '.', ',')."</td>";
			$temp_report.="		<td align='center'></td>";
			$temp_report.="		<td align='right'>".number_format($sum103,'', '.', ',')."</td>";
			$temp_report.="		<td align='right'>".number_format($sum109,'', '.', ',')."</td>";
			$temp_report.="		<td align='center'></td>";
			$temp_report.="		<td align='right'>".number_format($sum104,'', '.', ',')."</td>";
			$temp_report.="		<td align='right'>".number_format($sum110,'', '.', ',')."</td>";
			$temp_report.="		<td align='right'>".number_format($sum105,'', '.', ',')."</td>";
			$temp_report.="		<td align='right'>".number_format($sum111,'', '.', ',')."</td>";
			$temp_report.="		<td align='center'></td>";
			$temp_report.="		<td align='right'>".number_format($sum106,'', '.', ',')."</td>";
			$temp_report.="	</tr>";
	}
	// ���ҧ��������ǹ���µ��ҧ��ػ������
	$temp_report.=" <tr bgcolor='#FFFF99' height='25'>";
	$temp_report.="	<td align='center' colspan='2'> ��� </td>";
	$temp_report.="		<td align='right'>".number_format($sum01,'', '.', ',')."</td>";
	$temp_report.="		<td align='right'>".number_format($sum07,'', '.', ',')."</td>";
	$temp_report.="		<td align='right'>".number_format($sum02,'', '.', ',')."</td>";
	$temp_report.="		<td align='right'>".number_format($sum08,'', '.', ',')."</td>";
	$temp_report.="		<td align='center'></td>";
	$temp_report.="		<td align='right'>".number_format($sum03,'', '.', ',')."</td>";
	$temp_report.="		<td align='right'>".number_format($sum09,'', '.', ',')."</td>";
	$temp_report.="		<td align='center'></td>";
	$temp_report.="		<td align='right'>".number_format($sum04,'', '.', ',')."</td>";
	$temp_report.="		<td align='right'>".number_format($sum10,'', '.', ',')."</td>";
	$temp_report.="		<td align='right'>".number_format($sum05,'', '.', ',')."</td>";
	$temp_report.="		<td align='right'>".number_format($sum11,'', '.', ',')."</td>";
	$temp_report.="		<td align='center'></td>";
	$temp_report.="		<td align='right'>".number_format($sum06,'', '.', ',')."</td>";
	$temp_report.="	</tr>";
	$temp_report.="</table>";

   free_result($result_report);
   close();
   echo $temp_report;
   ob_end_flush();
?>
</body></html>