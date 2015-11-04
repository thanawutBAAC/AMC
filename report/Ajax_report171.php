<?php session_start();
	ob_start();
	header( "Content-Type: text/html; charset=windows-874" ); 
	header( "Expires: Sat, 1 Jan 1979 00:00:00 GMT" );
	header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" );
	header( "Cache-Control: no-cache, must-revalidate" );
	header( "Pragma: no-cache" );
	include("../lib/config.inc.php");
	include("../lib/database.php");
	include("../lib/function.php");

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

	$temp_report = "";  // ���Ѿ����е�ͧ�׹���
	// �����§ҹ

	$temp_report.="<br><br>";
	$temp_report.="<strong><center>�ˡó����ɵ����͡�õ�Ҵ�١��� �.�.�. �ӡѴ </center>";
	$temp_report.="<center>AGRICULTURAL MARKETING COOPERATIVE (AMC) </center>";
	$temp_report.="<center> �š�ô��Թ�ҹ���Ἱ��áԨ���º��º������¢ͧ ʡ�. ��Шӻ� ".$year."</center>";
	$temp_report.="<center> �ʹ������͹ <font color='#76B441'><u>".$month_thai[$month]."</u></font> �� <font color='#76B441'><u>".$year."</u></font></center></strong>";
	$temp_report.="<center> ������ � �ѹ��� ".datetoday()." ���� ".date("G:i:s")."</center>";

	//���ҧ�����������§ҹ �š�ô��Թ�ҹ���Ἱ��áԨ ����ʴ��������	
	$temp_report.="<table width='2150' class='gridtable' style='margin-top:25px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.=" <tr class='rows_orange'> ";
	$temp_report.="  <td width='40' rowspan='4' align='center'> �ӴѺ<br>��� </td> ";
	$temp_report.="    <td width='130' rowspan='4' align='center'> ʡ�.</td> ";
	$temp_report.="    <td width='90' rowspan='4' align='center'> ��Ҫԡ ʡ�. <br>(���) </td> ";
	$temp_report.="    <td width='90' rowspan='4' align='center'> ��Ҫԡ�Ӹ�áԨ<br>(���) </td> ";
	$temp_report.="    <td width='90' rowspan='4' align='center'> %��Ҫԡ<br>�Ӹ�áԨ </td>";
	$temp_report.="    <td width='90' rowspan='4' align='center'> ��Ť����� </td> ";
	$temp_report.="    <td colspan='18' class='rows_green'>&nbsp;&nbsp; �š�ô��Թ�ҹ � �����͹ ".$month_thai[$month]." �� ".$year."</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_pink'> ";
	$temp_report.=" <td colspan='3' align='center'> ��áԨ��� </td> ";
	$temp_report.=" <td colspan='6' align='center'> ��áԨ���� </td> ";
	$temp_report.=" <td colspan='3' align='center'> ��áԨ��� </td> ";
	$temp_report.=" <td colspan='3' align='center'> ��áԨ��ԡ�� </td> ";
	$temp_report.=" <td colspan='3' align='center'> ��áԨ���ٻ </td> ";
	$temp_report.="</tr>";
	$temp_report.="<tr class='rows_orange'> ";
	$temp_report.=" <td width='90' rowspan='2' align='center' >�������</td> ";
	$temp_report.=" <td width='90' rowspan='2' align='center'>�ŧҹ��ԧ</td> ";
	$temp_report.=" <td width='90' rowspan='2' align='center'>%������»�</td> ";
	$temp_report.=" <td width='90' rowspan='2' align='center'>�������</td> ";
	$temp_report.=" <td width='90' rowspan='2' align='center'>�ŧҹ��ԧ</td> ";
	$temp_report.=" <td width='90' rowspan='2' align='center'>%������»�</td> ";
	$temp_report.=" <td width='90' rowspan='2' align='center'>������������ҧ��</td> ";
	$temp_report.=" <td colspan='2' width='180' align='center'>���ͨҡ TABCO</td> ";
	$temp_report.=" <td width='90' rowspan='2' align='center'>�������</td> ";
	$temp_report.=" <td width='90' rowspan='2' align='center'>�ŧҹ��ԧ</td> ";
	$temp_report.=" <td width='90' rowspan='2' align='center'>%�������</td> ";
	$temp_report.="  <td width='90' rowspan='2' align='center'>�������</td> ";
	$temp_report.=" <td width='90' rowspan='2' align='center'>�ŧҹ��ԧ</td> ";
	$temp_report.="  <td width='90' rowspan='2' align='center'>%�������</td> ";
	$temp_report.="  <td width='90' rowspan='2' align='center'>�������</td> ";
	$temp_report.=" <td width='90' rowspan='2' align='center'>�ŧҹ��ԧ</td> ";
	$temp_report.="  <td width='90' rowspan='2' align='center'>%�������</td> ";
	$temp_report.=" </tr> ";
	$temp_report.="<tr class='rows_blue'> ";
	$temp_report.=" <td width='90' align='center'> ��Ť�� </td> ";
	$temp_report.=" <td width='90' align='center'> ������ </td> ";
	$temp_report.="</tr> ";


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
	$sql.=" SUM(Temp08.Plan_ProcureSell), ";
	$sql.=" SUM(Temp04.product_sell_sum), SUM(Temp04.product_buy_sum),  ";
	$sql.=" SUM(Temp04.product_buy_tabco),  ";
	$sql.=" SUM(Temp09.Plan_CollectSell), SUM(Temp05.data3), ";
	$sql.=" SUM(Temp010.PlanService), SUM(Temp06.service_value), ";
	$sql.=" SUM(Temp011.Plan_TransSell), SUM(Temp012.data8) ";
	$sql.=" FROM userlogin ";

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
//	$sql.=" AND ReportGroup6.report_month = '".$month."' ";
	$sql.=" AND ".$display_sql;
	$sql.=" AND ReportGroup6.report_detail_code = '1' ";
	$sql.=" GROUP BY ReportGroup6.amccode) AS Temp02 ";
	$sql.=" ON Temp02.amccode = userlogin.amccode ";

/* ��Ť����鹷����� */
	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT SUM(ReportGroup1.report_value)AS report_value, ";
	$sql.=" ReportGroup1.amccode ";
	$sql.=" FROM ReportGroup1 ";
	$sql.=" WHERE ReportGroup1.report_year = '".$year."' ";
//	$sql.=" AND ReportGroup1.report_month = '".$month."' ";
	$sql.=" AND ".$display_sql;
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
//	$sql.=" AND ReportGroup2.report_month = '".$month."' ";
	$sql.=" AND ".$display_sql;
	$sql.=" GROUP BY ReportGroup2.amccode) AS Temp04 ";
	$sql.=" ON Temp04.amccode = userlogin.amccode ";

/* ��áԨ��� */
	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT SUM(ReportGroup3.data3) AS data3, ";
	$sql.=" ReportGroup3.amccode ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE ReportGroup3.report_year = '".$year."' ";
//	$sql.=" AND ReportGroup3.report_month = '".$month."' ";
	$sql.=" AND ".$display_sql;
	$sql.=" GROUP BY ReportGroup3.amccode ) AS Temp05 ";
	$sql.=" ON Temp05.amccode = userlogin.amccode ";

/* ��áԨ��ԡ�� */
	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT SUM(ReportGroup4.service_value) AS service_value, ";
	$sql.=" ReportGroup4.amccode ";
	$sql.=" FROM ReportGroup4 ";
	$sql.=" WHERE ReportGroup4.report_year = '".$year."' ";
//	$sql.=" AND ReportGroup4.report_month = '".$month."' ";
	$sql.=" AND ".$display_sql;
	$sql.=" GROUP BY ReportGroup4.amccode ) AS Temp06 ";
	$sql.=" ON Temp06.amccode = userlogin.amccode ";

/* ������� ��áԨ���� */
	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT SUM(PlanProcureSell.PlanProcureSell_Sum)AS Plan_ProcureSell, ";
	$sql.=" PlanProcureSell.amccode ";
	$sql.=" FROM PlanProcureSell ";
	$sql.=" WHERE PlanProcureSell.PlanProcureSell_year = '".$year."' ";
	$sql.=" GROUP BY PlanProcureSell.amccode ) AS Temp08 ";
	$sql.=" ON Temp08.amccode = userlogin.amccode ";

/* ������� ��áԨ��� */
	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT SUM(PlanCollectSell.PlanCollectSell_Sum)AS Plan_CollectSell, ";
	$sql.=" PlanCollectSell.amccode ";
	$sql.=" FROM PlanCollectSell ";
	$sql.=" WHERE PlanCollectSell.PlanCollectSell_year = '".$year."' ";
	$sql.=" GROUP BY PlanCollectSell.amccode ) AS Temp09 ";
	$sql.=" ON Temp09.amccode = userlogin.amccode ";

/* ������� ��áԨ��ԡ�� */
	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT SUM(PlanService.PlanService_Sum)AS PlanService, ";
	$sql.=" PlanService.amccode ";
	$sql.=" FROM PlanService ";
	$sql.=" WHERE PlanService.PlanService_year = '".$year."' ";
	$sql.=" GROUP BY PlanService.amccode ) AS Temp010 ";
	$sql.=" ON Temp010.amccode = userlogin.amccode ";

/* ������� ��áԨ���ٻ */
	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT SUM(PlanTransSell.PlanTransSell_Sum)AS Plan_TransSell, ";
	$sql.=" PlanTransSell.amccode ";
	$sql.=" FROM PlanTransSell ";
	$sql.=" WHERE PlanTransSell.PlanTransSell_year = '".$year."' ";
	$sql.=" GROUP BY PlanTransSell.amccode ) AS Temp011 ";
	$sql.=" ON Temp011.amccode = userlogin.amccode ";
/* ��áԨ���ٻ */
	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT SUM(ReportGroup8.data3) AS data8, ";
	$sql.=" ReportGroup8.amccode ";
	$sql.=" FROM ReportGroup8 ";
	$sql.=" WHERE ReportGroup8.report_year = '".$year."' ";
	$sql.=" AND ".$display_sql;
//	$sql.=" AND ReportGroup8.report_month = '".$month."' ";
	$sql.=" GROUP BY ReportGroup8.amccode ) AS Temp012 ";
	$sql.=" ON Temp012.amccode = userlogin.amccode ";

	$sql.=" WHERE  userlogin.status = 'N' ";

	if($div!=0)  // �ó����͡�繽��¡Ԩ����Ң�
	{	$sql.=" AND userlogin.br_code='".$div."' "; 	}

	$sql.=" GROUP BY userlogin.br_code, userlogin.userdetail WITH ROLLUP ";

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
	$j=0;   // �ʴ����§�ӴѺ

	WHILE($fetch_report = fetch_row($result_report)) { 
		if( is_null($fetch_report[0]) && is_null($fetch_report[1]))  // ��ػ���������
		{
			$temp_report.="<tr class='rows_yellow'>";
			$temp_report.="<td colspan='2'>&nbsp; ��������� </td>";
			$i = 0;
		}
		elseif( is_null($fetch_report[1]))
		{
			$temp_report.="<tr class='rows_sky'>";  // ��ػ������н���
			$temp_report.="<td colspan='2'>&nbsp; ������� ".trim($fetch_report[0])." </td>";
			$i = 0;
		}
		else    // �ʴ�������
		{
			$i++;
			$j++;
			if(($i%2)==0)
			{	$temp_report.="<tr class='rows_grey'>";  }
			else
			{  $temp_report.="<tr>";  }
			$temp_report.="<td align='center'>".$j."&nbsp;</td>";
			$temp_report.="<td>&nbsp;&nbsp;".trim($fetch_report[1])."  [".$current_amc[trim($fetch_report[1])]."]  </td>";
		}  // end if
	
		$temp_report.="<td align='right'>".number_format($fetch_report[2])."&nbsp;</td>";  // ��Ҫԡ ʡ�. ���
		$temp_report.="<td align='right'>".number_format($fetch_report[3])."&nbsp;</td>";  // ��Ҫԡ �Ӹ�áԨ ���
		if(number_format($fetch_report[2],0,'.','')==0){                 // % ��Ҫԡ ��áԨ
			$temp_report.="<td align='right'>0.00&nbsp;</td>";			
		}
		else{
			$temp_report.="<td align='right'>".number_format(($fetch_report[3]/$fetch_report[2])*100,2,'.','')."&nbsp;</td>";  
		}
		$temp_report.="<td align='right'>".number_format($fetch_report[4])."&nbsp;</td>";  // ��Ť�����
		$temp_number1 = number_format($fetch_report[5]+$fetch_report[9]+$fetch_report[11],0,'','');
		$temp_report.="<td align='right'>".number_format($temp_number1)."&nbsp;</td>";  //  ������� ��áԨ���
		$temp_number2 = number_format($fetch_report[6]+$fetch_report[10]+$fetch_report[12],0,'','');
		$temp_report.="<td align='right'>".number_format($temp_number2)."&nbsp;</td>";  //  �ŧҹ��ԧ ��áԨ���
		if(number_format($temp_number1,0,'','')==0){
				$temp_num = '0.00'; }
		else{
			$temp_num = number_format(($temp_number2/$temp_number1) *100,2,'.','');
		}  // end if else
		$temp_report.="<td align='right'>".number_format($temp_num,2,'.','')."%&nbsp;</td>";		// % ������� �� ��áԨ���
		$temp_report.="<td align='right'>".number_format($fetch_report[5])."&nbsp;</td>";   // ������� ��áԨ����
		$temp_report.="<td align='right'>".number_format($fetch_report[6])."&nbsp;</td>";   // �ŧҹ��ԧ ��áԨ����

		if(number_format($fetch_report[5],0,'','')=='0'){
			$temp_num = "0.00";
		}
		else{
			$temp_num = number_format((number_format($fetch_report[6],0,'','')/number_format($fetch_report[5],0,'','')) *100,2,'.','');
		}
	
		$temp_report.="<td align='right'>".number_format($temp_num,2,'.','')."%&nbsp;</td>";	// % ������»� 
		$temp_report.="<td align='right'>".number_format($fetch_report[7])."&nbsp;</td>";  // ������������ҧ��
		$temp_report.="<td align='right'>".number_format($fetch_report[8])."&nbsp;</td>";  // ��Ť�� Tabco

		if(number_format($fetch_report[7],0,'','')=='0'){
			$temp_num = "0.00";
		}
		else{
			$temp_num = number_format((number_format($fetch_report[8],0,'','')/number_format($fetch_report[7],0,'','')) *100,2,'.','');
		}
		$temp_report.="<td align='right'>".number_format($temp_num,2,'.','')."&nbsp;</td>";	// ������ Tabco
		$temp_report.="<td align='right'>".number_format($fetch_report[9])."&nbsp;</td>";  // ������� ��áԨ���
		$temp_report.="<td align='right'>".number_format($fetch_report[10])."&nbsp;</td>";  // �ŧҹ��ԧ ��áԨ���

		if(number_format($fetch_report[9],0,'','')=='0'){
			$temp_num = "0.00";
		}
		else{
			$temp_num = number_format((number_format($fetch_report[10],0,'','')/number_format($fetch_report[9],0,'','')) *100,2,'.','');
		}
		$temp_report.="<td align='right'>".number_format($temp_num,2,'.','')."&nbsp;</td>"; // % ������� ��áԨ���
		$temp_report.="<td align='right'>".number_format($fetch_report[11])."&nbsp;</td>";  // ������� ��áԨ��ԡ��
		$temp_report.="<td align='right'>".number_format($fetch_report[12])."&nbsp;</td>";  // �ŧҹ��ԧ ��áԨ��ԡ��

		if(number_format($fetch_report[11],0,'','')=='0'){
			$temp_num = "0.00";
		}
		else{
			$temp_num = number_format((number_format($fetch_report[12],0,'','')/number_format($fetch_report[11],0,'','')) *100,2,'.','');
		}
		$temp_report.="<td align='right'>".number_format($temp_num,2,'.','')."&nbsp;</td>"; // % ������� ��áԨ��ԡ��
		$temp_report.="<td align='right'>".number_format($fetch_report[13])."&nbsp;</td>";  // ������� ��áԨ���ٻ
		$temp_report.="<td align='right'>".number_format($fetch_report[14])."&nbsp;</td>";  // �ŧҹ��ԧ ��áԨ���ٻ
	
		if(number_format($fetch_report[13],0,'','')=='0'){
			$temp_num = "0.00";
		}
		else{
			$temp_num = number_format((number_format($fetch_report[14],0,'','')/number_format($fetch_report[13],0,'','')) *100,2,'.','');
		}
		$temp_report.="<td align='right'>".number_format($temp_num,2,'.','')."&nbsp;</td>"; // % ������� ��áԨ���ٻ
		$temp_report.="</tr>";
	} // end while 

$temp_report.="</table>";
$temp_report.="<br>";
$temp_report.="<center><a href='excel_report171.php?div=".$div."&month=".$month."&year=".$year."'><img src='../images/page_excel.gif' border='0'> ������ Excel </a></center>";

   free_result($result_report);
   close();

 echo $temp_report;
 ob_end_flush();