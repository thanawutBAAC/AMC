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

	// �ʴ���§ҹ�Ǻ�����Ե�� ��������ͧ �ʢ. 1-9 
	$year1 = $year+1;	

	$temp_report = "";  // ���Ѿ����е�ͧ�׹���
	// �����§ҹ
	$temp_report.="<br><br><strong><center>�ˡó����ɵ����͡�õ�Ҵ�١��� �.�.�. �ӡѴ </center>";
	$temp_report.="<center> ��Ť�Ҹ�áԨ�Ǻ�����Ե�� (������§��áԨ��ü�Ե��õ�Ҵ�¢�ǹ����ˡó����ͧ��ê����)  </center>";
	$temp_report.="<center>�š�ô��Թ�ҹ�����ͧ ʡ�.��Ш���͹ <font color='#76B441'><u>".$month_thai[$month]."</u></font> �� <font color='#76B441'><u>".$year."</u></font> ".$temp_header."</center></strong>";
	$temp_report.="<center> ������ � �ѹ��� ".datetoday()." ���� ".date("G:i:s")."</center>";

	// ���ҧ��ǵ��ҧ��§ҹ
	$temp_report.="<table width='2000' class='gridtable' style='margin-top:15px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.="<tr> ";
	$temp_report.=" <td colspan='24' height='22'><font color='#0F7FCC'><b>&nbsp;&nbsp; ��Ť�Ҹ�áԨ�Ǻ�����Ե�� (������§��áԨ��ü�Ե�š�õ�Ҵ�¢�ǹ����ˡó����ͧ��ê����) <font color='red'> ����ͧ �ʢ.</font></b></font></td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_purple'> ";
	$temp_report.=" <td rowspan='4' colspan='2' align='center' width='320'>�ʢ/�ӹǹ<br> �Ң�/��Ե�� <br> ��������͹  </td> ";
	$temp_report.=" <td rowspan='2' align='center'>(1) �������<br>����ѹ�֡<br>��͵�ŧ</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center'> (2) ������� <br>����Ǻ��� <br>��Ե�� �ͧ ʡ�.</td> ";
	$temp_report.=" <td colspan='6'>&nbsp;&nbsp; 3. �š���Ǻ��������ҧ�� (��Ǫ���Ѵ�ͧ Tris / �ѹ�֡��͵�ŧ)</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center'> (4) ʡ�./ʹ�. ʹѺʹع <br>��á�Ш�� <br>��Ե��/��Ե�ѳ�� </td> ";
	$temp_report.=" <td colspan='3' rowspan='2' align='center'> (5) �š�ô��Թ�ҹ <br>(3.1+3.2+4) <br>(Tris/�ѹ�֡��͵�ŧ) </td> ";
	$temp_report.=" <td colspan='2' rowspan='3' align='center' valign='middle'>(6) ������¡�è�˹��¼�Ե�� �ͧʡ�</td> ";
	$temp_report.=" <td colspan='4' align='center' >(7) �š�è�˹��������ҧ��</td> ";
	$temp_report.=" <td rowspan='3' align='center' valign='middle'>(8) ��Ť�� ��Ե�Ť������</td> ";
	$temp_report.=" <td rowspan='3' align='center' valign='middle'>(9) �繹��˹��/���᷹</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_pink'> ";
	$temp_report.=" <td colspan='3' align='center'> (3.1) ʡ�.�Ǻ��� <br> ��Ե��/��Ե�ѳ�� <br>�ҡ��Ҫԡ����ɵá÷����</td> ";
	$temp_report.=" <td colspan='3' align='center'>(3.2) ʹ�. ʹѺʹع <br> ͧ��ê���� �Ǻ��� <br> ��Ե��/��Ե�ѳ���ҹ   ʡ�.</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>��˹������</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>��˹������TABCO</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_pink'> ";
	$temp_report.=" <td align='center'> ��.�.".$year1." </td> ";
	$temp_report.=" <td colspan='2' align='center'> ʡ�.�����ҷ�駻� </td> ";
	$temp_report.=" <td colspan='3' align='center'> �š���Ǻ��� �֧ 31/03/".$year1."</td> ";
	$temp_report.=" <td colspan='3' align='center'> �š��ʹѺʹع�Ǻ���</td> ";
	$temp_report.=" <td align='center'> ����ҳ </td> ";
	$temp_report.=" <td align='center'> ��Ť�� </td> ";
	$temp_report.=" <td align='center'> ������� </td> ";
	$temp_report.=" <td align='center'> ����ҳ </td> ";
	$temp_report.=" <td align='center'> ��Ť�� </td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr class='rows_green'> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ)</td> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ)</td> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ�ҷ)</td> ";
	$temp_report.=" <td align='center' width='80'>(���)</td> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ)</td> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ�ҷ)</td> ";
	$temp_report.=" <td align='center' width='80'>(ͧ���)</td> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ)</td> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ�ҷ)</td> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ)</td> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ�ҷ)</td> ";
	$temp_report.=" <td width='90' align='center'> ".$month_thai[$month]." 2552 </td> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ)</td> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ�ҷ)</td> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ)</td> ";
	$temp_report.=" <td align='center' width='85'>(�ѹ�ҷ)</td> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ)</td> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ�ҷ)</td> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ)</td> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ�ҷ)</td> ";
	$temp_report.=" <td align='center' width='80'>(�Ҥҷع)</td> ";
	$temp_report.=" <td align='center' width='80'>(�ѹ�ҷ)</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tbody> ";

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
		$display_sql2 = " ( "; // �纤������� ʡ� �������

		WHILE($fetch_amc = fetch_row($result_amc)) { 

			$current_amc[trim($fetch_amc[2])] = $month_report3[trim($fetch_amc[1])];			// �ŧ����������͹�Ѩ�غѹ
			$display_sql.=" ( amccode='".trim($fetch_amc[0])."' AND report_month='".$month_report3[number_format($fetch_amc[1],0,'','')]."' ) OR";
			$display_sql2.=" ( amccode='".trim($fetch_amc[0])."' AND target_month='".$month_report3[number_format($fetch_amc[1],0,'','')]."' ) OR";

		} // end while 

		$display_sql = substr($display_sql, 0, -2);   //  �����ҵ�� 2 �ش������   OR
		$display_sql.=" ) ";
		$display_sql2 = substr($display_sql2, 0, -2);   //  �����ҵ�� 2 �ش������   OR
		$display_sql2.=" ) ";
//  **************************  ����ش��õ�Ǩ�ͺ   ****************************************

// ���ҧ��������ǹ�����ҡ�ҧ���ҧ
	$sql = " SELECT userlogin.br_code,  ";
	$sql.=" userlogin.userdetail, ";
	$sql.=" BaseReportDetail.report_detail_name, ";
	$sql.=" SUM(Temp01.target_value), ";
	$sql.=" SUM(Temp02.PlanCollectBuy_Unit), ";
	$sql.=" SUM(Temp02.PlanCollectBuy_Sum), ";
	$sql.=" SUM(Temp03.data1), SUM(Temp03.data2), SUM(Temp03.data3),  ";
	$sql.=" SUM(Temp03.data4), SUM(Temp03.data5), SUM(Temp03.data6),  ";
	$sql.=" SUM(Temp03.data7), SUM(Temp03.data8), ";
	$sql.=" SUM(Temp04.target_value),  ";
	$sql.=" SUM(Temp05.PlanCollectSell_Unit), SUM(Temp05.PlanCollectSell_Sum), ";
	$sql.=" SUM(Temp03.data9), SUM(Temp03.data10),  ";
	$sql.=" SUM(Temp03.data11),SUM(Temp03.data12), ";
	$sql.=" SUM(Temp03.data13), SUM(Temp03.data14)  ";
	$sql.=" FROM userlogin,BaseReportDetail,BaseReportHeader  ";

/* ������µ���ѹ�֡��͵�ŧ  ��.�. */
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT TargetTris.target_value, ";
	$sql.=" TargetTris.report_detail_code, TargetTris.amccode  ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND target_month='3' ) AS Temp01  ";
	$sql.=" ON Temp01.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp01.amccode=BaseReportHeader.amccode  ";

/* ������¡���Ǻ��� ��Ե�� �ͧ ʡ�. */
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT PlanCollectBuy.PlanCollectBuy_Sum,  ";
	$sql.=" PlanCollectBuy.PlanCollectBuy_Unit,  ";
	$sql.=" PlanCollectBuy.report_detail_code, PlanCollectBuy.amccode  ";
	$sql.=" FROM PlanCollectBuy  ";
	$sql.=" WHERE PlanCollectBuy.PlanCollectBuy_year='".$year."' ) AS Temp02  ";
	$sql.=" ON Temp02.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp02.amccode=BaseReportHeader.amccode  ";

/* �š���Ǻ��������ҧ�� ����ѹ�֡��͵�ŧ  3  */
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT data1, data2, data3, data4, data5,  ";
	$sql.=" data6, data7, data8, data9 , ";
	$sql.=" data10, data11 , data12 , ";
	$sql.=" data13, data14, report_detail_code, amccode  ";
	$sql.=" FROM ReportGroup3  ";
	$sql.=" WHERE report_year='".$year."' AND ".$display_sql.") AS Temp03  ";
//	$sql.=" WHERE report_year='".$year."' AND report_month='".$month."') AS Temp03  ";
	$sql.=" ON Temp03.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp03.amccode=BaseReportHeader.amccode  ";

/* ������µ���ѹ�֡��͵�ŧ  ������Ш���͹  */
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT TargetTris.target_value, ";
	$sql.=" TargetTris.report_detail_code, TargetTris.amccode  ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND ".$display_sql2." ) AS Temp04  ";
//	$sql.=" WHERE target_year='".$year."' AND target_month='".$month."' ) AS Temp04  ";
	$sql.=" ON Temp04.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp04.amccode=BaseReportHeader.amccode  ";

/*   ������¡�è�˹��¼�Ե�� �ͧʡ� */
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT  ";
	$sql.=" PlanCollectSell.PlanCollectSell_Sum,  ";
	$sql.=" PlanCollectSell.PlanCollectSell_Unit,  ";
	$sql.=" PlanCollectSell.report_detail_code,  ";
	$sql.=" PlanCollectSell.amccode ";
	$sql.=" FROM PlanCollectSell ";
	$sql.=" WHERE PlanCollectSell.PlanCollectSell_year='".$year."') AS Temp05  ";
	$sql.=" ON Temp05.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp05.amccode = BaseReportHeader.amccode ";

	$sql.=" WHERE userlogin.amccode = BaseReportHeader.amccode ";
	$sql.=" AND BaseReportHeader.report_group_code = BaseReportDetail.report_group_code ";
	$sql.=" AND BaseReportHeader.report_detail_code = BaseReportDetail.report_detail_code ";
	$sql.=" AND BaseReportHeader.report_group_code = '3' ";
	$sql.=" AND userlogin.status = 'N' ";

	if($div!=0)  // �ó����͡�繽��¡Ԩ����Ң�
	{	$sql.=" AND userlogin.br_code='".$div."' "; 	}

	$sql.=" GROUP BY userlogin.br_code, userlogin.userdetail,  ";
	$sql.=" BaseReportDetail.report_detail_name WITH ROLLUP ";
	
	$sql.=" ORDER BY userlogin.br_code, userlogin.userdetail  ";
	
	$result_report = query($sql);
	if(num_rows(query($sql))==0)
	{
		$temp_report ="<br><br><center><font color='red'> ����բ����ŷ�����͡ </font></center>";
		free_result($result_report);
		close();
		echo $temp_report;
		ob_end_flush();	
		exit();
	}
	$i = 0;
	//  �ʴ������ŷ�����
	WHILE($fetch_report = fetch_row($result_report)) { 

		if( is_null($fetch_report[0]) && is_null($fetch_report[1]) && is_null($fetch_report[2]))  // ��ػ�����駻����
		{
			$temp_report.="<tr class='rows_yellow'>";
			$temp_report.="<td colspan='2'>&nbsp; �����駻���� </td>";
			$i = 0;
		}
		elseif( is_null($fetch_report[1]) && is_null($fetch_report[2]))   // ��ػ������н���
		{
			$temp_report.="</tbody>";
			$temp_report.="<tr class='rows_sky'>"; 
			$temp_report.=" <td colspan='2'>&nbsp;<img id='pic".trim($fetch_report[0])."' src='../images/icon_plus.gif' style='cursor: hand'  onclick=showhide(page".trim($fetch_report[0]).",'pic".trim($fetch_report[0])."') > ������� ".trim($fetch_report[0])." </td>";
			$i = 0;
		}
		elseif( is_null($fetch_report[2])) // ��ػ���� ʡ�. 
		{
			$temp_report.="<tr class='rows_orange'>"; 
			$temp_report.=" <td colspan='2'>&nbsp; ������ ʡ�.".trim($fetch_report[1])."  [".$current_amc[trim($fetch_report[1])]."] </td>";
			$i = 0;
		}
		else    // �ʴ�������
		{
			$i++;			
			if(($i%2)==0)
			{	$temp_report.="<tr class='rows_grey'>";  }
			else
			{  $temp_report.="<tr>";  }
			$temp_report.=" <td width='80' nowrap>&nbsp;".trim($fetch_report[1])."</td>";   // ʡ�
			$temp_report.=" <td width='180' nowrap>&nbsp;".trim($fetch_report[2])."</td>";  // ��ª��ͼż�Ե
		}  // end if
	
		$temp_report.=" <td align='right'>".number_format($fetch_report[3])."&nbsp;</td>";  // ������� tris
		$temp_report.=" <td align='right'>".number_format($fetch_report[4])."&nbsp;</td>";  // ������� ʡ� 4  �ѹ
		$temp_report.=" <td align='right'>".number_format($fetch_report[5])."&nbsp;</td>";  // ������� ʡ� 4  �ѹ�ҷ
		$temp_report.=" <td align='right'>".number_format($fetch_report[6])."&nbsp;</td>";  // ��� 3.1
		$temp_report.=" <td align='right'>".number_format($fetch_report[7])."&nbsp;</td>";  //  �ѹ 3.1
		$temp_report.=" <td align='right'>".number_format($fetch_report[8])."&nbsp;</td>";  //  �ѹ�ҷ 3.1
		$temp_report.=" <td align='right'>".number_format($fetch_report[9])."&nbsp;</td>";  //  ͧ��� 3.2
		$temp_report.=" <td align='right'>".number_format($fetch_report[10])."&nbsp;</td>";  //  �ѹ 3.2 
		$temp_report.=" <td align='right'>".number_format($fetch_report[11])."&nbsp;</td>";  // �ѹ�ҷ 3.2 
		$temp_report.=" <td align='right'>".number_format($fetch_report[12])."&nbsp;</td>";  //  �ѹ 4
		$temp_report.=" <td align='right'>".number_format($fetch_report[13])."&nbsp;</td>";  //  �ѹ 4
		$temp_report.=" <td align='right'>".number_format($fetch_report[14])."&nbsp;</td>";  //  ����������� ʡ�4 ��Ш���͹  5
		$temp_sum1 = number_format($fetch_report[7],0,'','')+number_format($fetch_report[10],0,'','')+number_format($fetch_report[12],0,'','');
		$temp_sum2 = number_format($fetch_report[8],0,'','')+number_format($fetch_report[11],0,'','')+number_format($fetch_report[13],0,'','');
		$temp_report.=" <td align='right'>".number_format($temp_sum1)."&nbsp;</td>";  //  �ѹ 5
		$temp_report.=" <td align='right'>".number_format($temp_sum2)."&nbsp;</td>";  //  �ѹ 5
		$temp_report.=" <td align='right'>".number_format($fetch_report[15])."&nbsp;</td>";  //  6  ������¡�è�˹��¼�Ե��  �ѹ
		$temp_report.=" <td align='right'>".number_format($fetch_report[16])."&nbsp;</td>";  //  6  ������¡�è�˹��¼�Ե��  �ѹ�ҷ
		$temp_report.=" <td align='right'>".number_format($fetch_report[17])."&nbsp;</td>";  //  7 ��˹������ �ѹ
		$temp_report.=" <td align='right'>".number_format($fetch_report[18])."&nbsp;</td>";  //  7 ��˹������ �ѹ�ҷ
		$temp_report.=" <td align='right'>".number_format($fetch_report[19])."&nbsp;</td>";  //  7 ��˹������TABCO �ѹ
		$temp_report.=" <td align='right'>".number_format($fetch_report[20])."&nbsp;</td>";  //  7 ��˹������TABCO �ѹ�ҷ
		$temp_report.=" <td align='right'>".number_format($fetch_report[21])."&nbsp;</td>";  //  8 ��Ť�� ��Ե�Ť������
		$temp_report.=" <td align='right'>".number_format($fetch_report[22])."&nbsp;</td>";  //  9 ���˹�ҵ��᷹
		$temp_report.="</tr>";

		if( !is_null($fetch_report[0]) && is_null($fetch_report[1]) && is_null($fetch_report[2]))  //  ��͹�����Ž���㹽��� �������͹
		{	
			$temp_report.="<tbody id=page".$fetch_report[0]." style='DISPLAY: none'>";
		}  // end if 

	} // end while

	$temp_report.="</tbody>";
	$temp_report.="</table> ";

	$temp_report.="<br>";
	$temp_report.="<center><a href='excel_report151.php?div=".$div."&year=".$year."&month=".$month."'><img src='../images/page_excel.gif' border='0'> ������ Excel </a></center>";
	free_result($result_report);
    close();

	echo $temp_report;
	ob_end_flush();	