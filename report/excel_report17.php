<?php session_start();
	ob_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="��§ҹ��ô��Թ�ҹ���Ἱ��áԨ�ͧ ʡ�. ����ʴ��������.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$month_thai = array("1"=>'���Ҥ�',"2"=>'����Ҿѹ��',"3"=>'�չҤ�',"4"=>'����¹',"5"=>'����Ҥ�',"6"=>'�Զع�¹',"7"=>'�á�Ҥ�',"8"=>'�ԧ�Ҥ�',"9"=>'�ѹ��¹',"10"=>'���Ҥ�',"11"=>'��Ȩԡ�¹',"12"=>'�ѹ�Ҥ�');

	// �ʴ���§ҹ ������ͧ�ʴ�������»�Сͺ

	connect();
	$month = trim($_GET["month"]);  //  ��͹
	$year = trim($_GET["year"]);  // ��
	$div = trim($_GET["div"]);  //  ���¡Ԩ����Ң�

	if(trim($_GET["div"])=='0')
		{ $div = '0'; 
		   $temp_header = "( �����駻���� )"; }
	else
	   { $div = trim($_GET["div"]); 
		  $temp_header = "���¡Ԩ����Ң� ".$div; }

?>
<html  xmlns:o="urn:schemas-microsoft-com:office:office" 
xmlns:x="urn:schemas-microsoft-com:office:excel" 
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<title>��§ҹ��ô��Թ�ҹ���Ἱ��áԨ�ͧ ʡ�. ����ʴ��������</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
<body>
<?
	$year1 = $year-1;   // ��͹��ѧ 1 ��
	$year2 = $year-2;  //  ��͹��ѧ 2 ��
	$temp_report = "";  // ���Ѿ����е�ͧ�׹���
	// �����§ҹ

	$temp_report.="<br><br>";
	$temp_report.="<strong><center>�ˡó����ɵ����͡�õ�Ҵ�١��� �.�.�. �ӡѴ </center>";
	$temp_report.="<center>AGRICULTURAL MARKETING COOPERATIVE (AMC) </center>";
	$temp_report.="<center> �š�ô��Թ�ҹ���Ἱ��áԨ�ͧ ʡ�. ��Шӻ� ".$year."</center>";
	$temp_report.="<center> �ʹ������͹ <font color='#76B441'><u>".$month_thai[$month]."</u></font> �� <font color='#76B441'><u>".$year."</u></font></center></strong>";
	
	//���ҧ�����������§ҹ �š�ô��Թ�ҹ���Ἱ��áԨ
	$temp_report.="<table width='1480' border='1' style='margin-top:25px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.=" <tr height='25px'>  ";
	$temp_report.="   <td colspan='16' align='left'>&nbsp;<font color='#0F7FAF'><b> �š�ô��Թ�ҹ�����áԨ�ͧ ʡ�. ��Шӻ�  ".$year."</b></font></td> ";
	$temp_report.=" </tr> ";
	$temp_report.=" <tr bgcolor='#FFCC99'>  ";
	$temp_report.="   <td  width='100' align='center' rowspan='3'> ���¡Ԩ����Ң� </td> ";
	$temp_report.="   <td  width='90' align='center' rowspan='3'> ��Ҫԡ ʡ�.<br>(���)</td> ";
	$temp_report.="   <td  width='90' align='center' rowspan='3'> ��Ҫԡ�Ӹ�áԨ <br>(���)</td> ";
	$temp_report.="   <td  width='90' align='center' rowspan='3'> % ��Ҫԡ�Ӹ�áԨ </td> ";
	$temp_report.="   <td  width='90' align='center' rowspan='3'> ��Ť����� </td> ";
	$temp_report.="   <td  width='100' align='center' rowspan='3'> �š�ô��Թ��áԨ��� �� ".$year2."</td> ";
	$temp_report.="   <td  width='100' align='center' rowspan='3'> �š�ô��Թ��áԨ��� �� ".$year1."</td> ";
	$temp_report.="   <td  width='630' align='center' colspan='8' class='rows_blue'> �š�ô��Թ�ҹ�� ".$year."</td>";
	$temp_report.="   <td  width='90' align='center' rowspan='3'> ���� <br>(�Ҵ�ع) </td>";
	$temp_report.=" </tr> ";
	$temp_report.=" <tr bgcolor='#FF99CC'>  ";
	$temp_report.="   <td align='center' width='90' rowspan='2'> ��áԨ��� </td> ";
	$temp_report.="   <td align='center' width='90' rowspan='2'> ��áԨ���� </td> ";
	$temp_report.="   <td align='center' width='90' rowspan='2'> ������������ҧ�� </td> ";
	$temp_report.="   <td align='center' colspan='2'> ���ͨҡ TABCO </td> ";
	$temp_report.="   <td align='center' width='90' rowspan='2'> ��áԨ��� </td> ";
	$temp_report.="   <td align='center' width='90' rowspan='2'> ��áԨ��ԡ�� </td> ";
	$temp_report.="   <td align='center' width='90' rowspan='2'> ��áԨ���ٻ</td> ";
	$temp_report.=" </tr> ";
	$temp_report.=" <tr bgcolor='#CCFFCC'>  ";
	$temp_report.="   <td align='center' width='90'> ��Ť�� </td> ";
	$temp_report.="   <td align='center' width='90'> ������ </td> ";
	$temp_report.=" </tr> ";
	
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
		if($province!='0' AND trim($province)!='')
		{	$sql.=" AND userlogin.amccode='".$province."' "; }

		$result_amc = query($sql);
		query(" DROP TABLE #Temp_SentReport ");

		$display_sql = " ( "; // �纤������� ʡ� �觢���������ش��͹�˹

		WHILE($fetch_amc = fetch_row($result_amc)) { 

			$current_amc[trim($fetch_amc[2])] = $month_report3[trim($fetch_amc[1])];			// �ŧ����������͹�Ѩ�غѹ
			$display_sql.=" ( amccode='".trim($fetch_amc[0])."' AND report_month='".$month_report3[number_format($fetch_amc[1],0,'','')]."' ) OR";

		} // end while 

		$display_sql = substr($display_sql, 0, -2);   //  �����ҵ�� 2 �ش������   OR
		$display_sql.=" ) ";

//  **************************  ����ش��õ�Ǩ�ͺ   ****************************************

	// ����� sql 
	$sql = " SELECT userlogin.br_code, userlogin.userdetail, ";
	$sql.=" SUM(Temp01.report_value), SUM(Temp02.member_value), ";
	$sql.=" SUM(Temp03.report_value),  ";
	$sql.=" SUM(TempYear2.SumYear02), SUM(TempYear1.SumYear01), ";
	$sql.=" SUM(Temp04.product_sell_sum), SUM(Temp04.product_buy_sum),  ";
	$sql.=" SUM(Temp04.product_buy_tabco), SUM(Temp05.data3),  ";
	$sql.=" SUM(Temp06.service_value), SUM(Temp07.report_value), ";
	$sql.=" SUM(Temp08.data8) ";
	$sql.="  FROM userlogin ";

/* ��Ҫԡ ʡ�.(���) */
	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT SUM(ReportGroup1.report_value)AS report_value, ";
	$sql.=" ReportGroup1.amccode ";
	$sql.=" FROM ReportGroup1 ";
	$sql.=" WHERE ReportGroup1.report_year = '".$year."' ";
//	$sql.=" AND ReportGroup1.report_month = '".$month."' ";
	$sql.=" AND ".$display_sql;
	$sql.=" AND ReportGroup1.report_detail_code = '3' ";
	$sql.=" GROUP BY ReportGroup1.amccode)AS Temp01 ";
	$sql.=" ON Temp01.amccode = userlogin.amccode ";

/* ��Ҫԡ�Ӹ�áԨ (���) */
	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT SUM(ReportGroup6.member_value)AS member_value, ";
	$sql.=" ReportGroup6.amccode ";
	$sql.=" FROM ReportGroup6 ";
	$sql.=" WHERE ReportGroup6.report_year = '".$year."' ";
	$sql.=" AND ".$display_sql;
	//$sql.=" AND ReportGroup6.report_month = '".$month."' ";
	$sql.=" AND ReportGroup6.report_detail_code = '1' ";
	$sql.=" GROUP BY ReportGroup6.amccode) AS Temp02 ";
	$sql.=" ON Temp02.amccode = userlogin.amccode ";

/* ��Ť����鹷����� */
	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT SUM(ReportGroup1.report_value)AS report_value, ";
	$sql.=" ReportGroup1.amccode ";
	$sql.=" FROM ReportGroup1 ";
	$sql.=" WHERE ReportGroup1.report_year = '".$year."' ";
	$sql.=" AND ".$display_sql;
//	$sql.=" AND ReportGroup1.report_month = '".$month."' ";
	$sql.=" AND ReportGroup1.report_detail_code = '4' ";
	$sql.=" GROUP BY ReportGroup1.amccode ) AS Temp03 ";
	$sql.=" ON Temp03.amccode = userlogin.amccode ";

/* ��áԨ����  ������������ҧ�� ���ͨҡ Tabco */
	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT SUM(ReportGroup2.product_sell_sum) AS product_sell_sum, ";
	$sql.=" SUM(ReportGroup2.product_buy_sum) AS product_buy_sum, ";
	$sql.=" SUM(ReportGroup2.product_buy_tabco) AS product_buy_tabco, ";
	$sql.=" ReportGroup2.amccode ";
	$sql.=" FROM ReportGroup2 ";
	$sql.=" WHERE ReportGroup2.report_year = '".$year."' ";
	$sql.=" AND ".$display_sql;
	//$sql.=" AND ReportGroup2.report_month = '".$month."' ";
	$sql.=" GROUP BY ReportGroup2.amccode) AS Temp04 ";
	$sql.=" ON Temp04.amccode = userlogin.amccode ";

/* ��áԨ��� */
	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT SUM(ReportGroup3.data3) AS data3, ";
	$sql.=" ReportGroup3.amccode ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE ReportGroup3.report_year = '".$year."' ";
	$sql.=" AND ".$display_sql;
//	$sql.=" AND ReportGroup3.report_month = '".$month."' ";
	$sql.=" GROUP BY ReportGroup3.amccode ) AS Temp05 ";
	$sql.=" ON Temp05.amccode = userlogin.amccode ";

/* ��áԨ��ԡ�� */
	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT SUM(ReportGroup4.service_value) AS service_value, ";
	$sql.=" ReportGroup4.amccode ";
	$sql.=" FROM ReportGroup4 ";
	$sql.=" WHERE ReportGroup4.report_year = '".$year."' ";
	$sql.=" AND ".$display_sql;
	//$sql.=" AND ReportGroup4.report_month = '".$month."' ";
	$sql.=" GROUP BY ReportGroup4.amccode ) AS Temp06 ";
	$sql.=" ON Temp06.amccode = userlogin.amccode ";

/* ��áԨ���ٻ */
	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT SUM(ReportGroup8.data3) AS data8, ";
	$sql.=" ReportGroup8.amccode ";
	$sql.=" FROM ReportGroup8 ";
	$sql.=" WHERE ReportGroup8.report_year = '".$year."' ";
	$sql.=" AND ".$display_sql;
// $sql.=" AND ReportGroup8.report_month = '".$month."' ";
	$sql.=" GROUP BY ReportGroup8.amccode ) AS Temp08 ";
	$sql.=" ON Temp08.amccode = userlogin.amccode ";

/* ���âҴ�ع */
	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT SUM(ReportGroup1.report_value)AS report_value,  ";
	$sql.=" ReportGroup1.amccode ";
	$sql.=" FROM ReportGroup1 ";
	$sql.=" WHERE ReportGroup1.report_year = '".$year."' ";
	$sql.=" AND ".$display_sql;
//	$sql.=" AND ReportGroup1.report_month = '".$month."' ";
	$sql.=" AND ReportGroup1.report_detail_code = '6' ";
	$sql.=" GROUP BY ReportGroup1.amccode ) AS Temp07 ";
	$sql.=" ON Temp07.amccode = userlogin.amccode ";

/************ �š�ô��Թ��áԨ��� ��͹��ѧ 1 ��  *****************/
	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT  ";
	$sql.=" (Temp101.product_sell_sum+Temp101.product_buy_tabco+ ";
	$sql.="  Temp102.data3+Temp103.service_value+Temp104.data8)AS SumYear01, ";
	$sql.=" userlogin.amccode ";
	$sql.=" FROM userlogin ";
/* ��áԨ���� ��áԨ Tabco */
	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT SUM(ReportGroup2.product_sell_sum) AS product_sell_sum, ";
	$sql.=" SUM(ReportGroup2.product_buy_tabco) AS product_buy_tabco, ";
	$sql.=" ReportGroup2.amccode ";
	$sql.=" FROM ReportGroup2 ";
	$sql.=" WHERE ReportGroup2.report_year = '".$year1."' ";
	$sql.=" AND ReportGroup2.report_month = '3' ";
	$sql.=" GROUP BY ReportGroup2.amccode) AS Temp101 ";
	$sql.=" ON Temp101.amccode = userlogin.amccode ";
/* ��áԨ��� */
	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT SUM(ReportGroup3.data3) AS data3, ";
	$sql.=" ReportGroup3.amccode ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE ReportGroup3.report_year = '".$year1."' ";
	$sql.=" AND ReportGroup3.report_month = '3' ";
	$sql.=" GROUP BY ReportGroup3.amccode ) AS Temp102 ";
	$sql.=" ON Temp102.amccode = userlogin.amccode ";
/* ��áԨ��ԡ�� */
	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT SUM(ReportGroup4.service_value) AS service_value, ";
	$sql.=" ReportGroup4.amccode ";
	$sql.=" FROM ReportGroup4 ";
	$sql.=" WHERE ReportGroup4.report_year = '".$year1."' ";
	$sql.=" AND ReportGroup4.report_month = '3' ";
	$sql.=" GROUP BY ReportGroup4.amccode ) AS Temp103 ";
	$sql.=" ON Temp103.amccode = userlogin.amccode ";
/* ��áԨ���ٻ */
	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT SUM(ReportGroup8.data3) AS data8, ";
	$sql.=" ReportGroup8.amccode ";
	$sql.=" FROM ReportGroup8 ";
	$sql.=" WHERE ReportGroup8.report_year = '".$year1."' ";
	$sql.=" AND ReportGroup8.report_month = '3' ";
	$sql.=" GROUP BY ReportGroup8.amccode ) AS Temp104 ";
	$sql.=" ON Temp104.amccode = userlogin.amccode ";

	$sql.=" WHERE userlogin.status='N' ";
	$sql.=" ) AS TempYear1 ON TempYear1.amccode = userlogin.amccode ";
/* ************************************************ */

/************ �š�ô��Թ��áԨ��� ��͹��ѧ 2 ��  *****************/
	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT  ";
	$sql.=" (Temp201.product_sell_sum+Temp201.product_buy_tabco+ ";
	$sql.="  Temp202.data3+Temp203.service_value+Temp204.data8)AS SumYear02, ";
	$sql.=" userlogin.amccode ";
	$sql.=" FROM userlogin ";
/* ��áԨ���� ��áԨ Tabco */
	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT SUM(ReportGroup2.product_sell_sum) AS product_sell_sum, ";
	$sql.=" SUM(ReportGroup2.product_buy_tabco) AS product_buy_tabco, ";
	$sql.=" ReportGroup2.amccode ";
	$sql.=" FROM ReportGroup2 ";
	$sql.=" WHERE ReportGroup2.report_year = '".$year2."' ";
	$sql.=" AND ReportGroup2.report_month = '3' ";
	$sql.=" GROUP BY ReportGroup2.amccode) AS Temp201 ";
	$sql.=" ON Temp201.amccode = userlogin.amccode ";
/* ��áԨ��� */
	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT SUM(ReportGroup3.data3) AS data3, ";
	$sql.=" ReportGroup3.amccode ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE ReportGroup3.report_year = '".$year2."' ";
	$sql.=" AND ReportGroup3.report_month = '3' ";
	$sql.=" GROUP BY ReportGroup3.amccode ) AS Temp202 ";
	$sql.=" ON Temp202.amccode = userlogin.amccode ";
/* ��áԨ��ԡ�� */
	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT SUM(ReportGroup4.service_value) AS service_value, ";
	$sql.=" ReportGroup4.amccode ";
	$sql.=" FROM ReportGroup4 ";
	$sql.=" WHERE ReportGroup4.report_year = '".$year2."' ";
	$sql.=" AND ReportGroup4.report_month = '3' ";
	$sql.=" GROUP BY ReportGroup4.amccode ) AS Temp203 ";
	$sql.=" ON Temp203.amccode = userlogin.amccode ";
/* ��áԨ���ٻ */
	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT SUM(ReportGroup8.data3) AS data8, ";
	$sql.=" ReportGroup8.amccode ";
	$sql.=" FROM ReportGroup8 ";
	$sql.=" WHERE ReportGroup8.report_year = '".$year2."' ";
	$sql.=" AND ReportGroup8.report_month = '3' ";
	$sql.=" GROUP BY ReportGroup8.amccode ) AS Temp204 ";
	$sql.=" ON Temp204.amccode = userlogin.amccode ";

	$sql.=" WHERE userlogin.status='N' ";
	$sql.=" ) AS TempYear2 ON TempYear2.amccode = userlogin.amccode ";
/* ************************************************ */

	$sql.=" WHERE  userlogin.status = 'N' ";

	if($div!=0)  // �ó����͡�繽��¡Ԩ����Ң�
	{	$sql.=" AND userlogin.br_code='".$div."' "; 	}

	$sql.=" GROUP BY userlogin.br_code, userlogin.userdetail WITH ROLLUP ";
/* ************************************************ */

	$result_report = 	query($sql);

	if(num_rows(query($sql))==0)
	{
		$temp_report ="<br><br><center><font color='red'> ����բ����ŷ�����͡ </font></center>";
		free_result($result_report);
		close();
		echo $temp_report;
		ob_end_flush();	
		exit();
	}

	$i=0;    // ���ҧ��������ǹ������ �ѹ

	WHILE($fetch_report = fetch_row($result_report)) { 
		if( is_null($fetch_report[0]) && is_null($fetch_report[1]))  // ��ػ���������
		{
			$temp_report.="<tr bgcolor='#FFFF99'>";
			$temp_report.="<td>&nbsp; ��������� </td>";
			$i = 0;
		}
		elseif( is_null($fetch_report[1]))
		{
			$temp_report.="<tr bgcolor='#99CCFF'>";  // ��ػ������н���
			$temp_report.="<td>&nbsp; ������� ".trim($fetch_report[0])." </td>";
			$i = 0;
		}
		else    // �ʴ�������
		{
			$i++;			
			if(($i%2)==0)
			{	$temp_report.="<tr bgcolor='#C0C0C0'>";  }
			else
			{  $temp_report.="<tr>";  }
			$temp_report.="<td>&nbsp;&nbsp;".trim($fetch_report[1])."  [".$current_amc[trim($fetch_report[1])]."] </td>";
		}  // end if
	
		$temp_report.="<td align='right'>".number_format($fetch_report[2])."</td>";  // ��Ҫԡ ʡ�. ���
		$temp_report.="<td align='right'>".number_format($fetch_report[3])."</td>";  // ��Ҫԡ �Ӹ�áԨ ���
		if(number_format($fetch_report[2],0,'.','')==0){                 // % ��Ҫԡ ��áԨ
			$temp_report.="<td align='right'>0.00</td>";			
		}
		else{
		$temp_report.="<td align='right'>".number_format((number_format($fetch_report[3],0,'','')/number_format($fetch_report[2],0,'',''))*100,2,'.','')."</td>";  
		}
		$temp_report.="<td align='right'>".number_format($fetch_report[4])."</td>";  // ��Ť�����
		$temp_report.="<td align='right'>".number_format($fetch_report[5])."</td>";  //  �š�ô��Թ��áԨ ��͹��ѧ 2 ��
		$temp_report.="<td align='right'>".number_format($fetch_report[6])."</td>";  //  �š�ô��Թ��áԨ ��͹��ѧ 1 ��
		$temp_number = number_format($fetch_report[7],0,'','')+number_format($fetch_report[10],0,'','')+number_format($fetch_report[11],0,'','');
		$temp_report.="<td align='right'>".number_format($temp_number)."</td>";  //  ��áԨ���
		$temp_report.="<td align='right'>".number_format($fetch_report[7])."</td>";  //  ��áԨ����
		$temp_report.="<td align='right'>".number_format($fetch_report[8])."</td>";  //  ��áԨ���������ҧ��
		$temp_report.="<td align='right'>".number_format($fetch_report[9])."</td>";  //  ��Ť�� tabco
		if(number_format($fetch_report[9],0,'','')==0){                 //  �������
			$temp_report.="<td align='right'>0.00</td>";			
		}
		else{
			$temp_report.="<td align='right'>".number_format((number_format($fetch_report[9],0,'','')/number_format($fetch_report[8],0,'',''))*100,2,'.','')."</td>";  
		}

		$temp_report.="<td align='right'>".number_format($fetch_report[10])."</td>";  //  ��áԨ���
		$temp_report.="<td align='right'>".number_format($fetch_report[11])."</td>";  //  ��áԨ��ԡ��
		$temp_report.="<td align='right'>".number_format($fetch_report[13])."</td>";  //  ��áԨ���ٻ

		if(number_format($fetch_report[12],0,'','') < 0){   // �óբҴ�ع
			$temp_report.="<td align='right'><font color='red'>(".number_format($fetch_report[12]).")</font></td>";  //  �ó� �Ҵ�ع		
		}
		else{
			$temp_report.="<td align='right'>".number_format($fetch_report[12])."</td>";  //  �ó� ����
		}
		$temp_report.="</tr>";
	} // end while 

	$temp_report.="</table>";
	$temp_report.="<br>";

	free_result($result_report);
	close();
	echo $temp_report;
	 ob_end_flush();
?>
</body></html>