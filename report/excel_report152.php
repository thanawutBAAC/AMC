<?php session_start();
	ob_start();
	header("Content-Type:  application/vnd.ms-excel; ");
	header('Content-Disposition: attachment; filename="��§ҹ�Ǻ����ż�Ե������ ����ͧ �ż�Ե.xls"');
	header("Expires: 0");
	header("Pragma: no-cache"); 
	include("../lib/config.inc.php");
	include("../lib/database.php");

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
?>
<html  xmlns:o="urn:schemas-microsoft-com:office:office" 
xmlns:x="urn:schemas-microsoft-com:office:excel" 
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<title>��§ҹ�Ǻ����ż�Ե������ ʡ� ����ͧ �ż�Ե</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
<body>
<?
	$temp_report = "";  // ���Ѿ����е�ͧ�׹���
	// �����§ҹ
	$temp_report.="<br><br><strong><center>�ˡó����ɵ����͡�õ�Ҵ�١��� �.�.�. �ӡѴ </center>";
	$temp_report.="<center> ��Ť�Ҹ�áԨ�Ǻ�����Ե�� (������§��áԨ��ü�Ե��õ�Ҵ�¢�ǹ����ˡó����ͧ��ê����)  </center>";
	$temp_report.="<center>�š�ô��Թ�ҹ�����ͧ ʡ�.��Ш���͹ <font color='#76B441'><u>".$month_thai[$month]."</u></font> �� <font color='#76B441'><u>".$year."</u></font> ".$temp_header."</center></strong>";

	// ���ҧ��ǵ��ҧ��§ҹ
	$temp_report.="<table border='1'> ";
	$temp_report.="<tr> ";
	$temp_report.=" <td colspan='24' height='22'><font color='#0F7FCC'><b>&nbsp;&nbsp; ��Ť�Ҹ�áԨ�Ǻ�����Ե�� (������§��áԨ��ü�Ե�š�õ�Ҵ�¢�ǹ����ˡó����ͧ��ê����) <font color='red'> ����ͧ�ż�Ե </font></b></font></td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr bgcolor='#CC99FF'> ";
	$temp_report.=" <td rowspan='4' colspan='2' align='center' width='200'>�ʢ/�ӹǹ<br> �Ң�/��Ե�� <br> ��������͹  </td> ";
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
	$temp_report.="<tr bgcolor='#FF99CC'> ";
	$temp_report.=" <td colspan='3' align='center'> (3.1) ʡ�.�Ǻ��� <br> ��Ե��/��Ե�ѳ�� <br>�ҡ��Ҫԡ����ɵá÷����</td> ";
	$temp_report.=" <td colspan='3' align='center'>(3.2) ʹ�. ʹѺʹع <br> ͧ��ê���� �Ǻ��� <br> ��Ե��/��Ե�ѳ���ҹ   ʡ�.</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>��˹������</td> ";
	$temp_report.=" <td colspan='2' rowspan='2' align='center' valign='middle'>��˹������TABCO</td> ";
	$temp_report.="</tr> ";
	$temp_report.="<tr bgcolor='#FF99CC'> ";
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
	$temp_report.="<tr bgcolor='#CCFFCC'> ";
	$temp_report.=" <td width='80' align='center'> (�ѹ) </td> ";
	$temp_report.=" <td width='80' align='center'> (�ѹ) </td> ";
	$temp_report.=" <td width='80' align='center'> (�ѹ�ҷ) </td> ";
	$temp_report.=" <td width='80' align='center'> ��� </td> ";
	$temp_report.=" <td width='80' align='center'> �ѹ </td> ";
	$temp_report.=" <td width='80' align='center'> �ѹ�ҷ </td> ";
	$temp_report.=" <td width='80' align='center'> ͧ��� </td> ";
	$temp_report.=" <td width='80' align='center'> �ѹ </td> ";
	$temp_report.=" <td width='80' align='center'> �ѹ�ҷ </td> ";
	$temp_report.=" <td width='80' align='center'> �ѹ </td> ";
	$temp_report.=" <td width='80' align='center'> �ѹ�ҷ </td> ";
	$temp_report.=" <td width='90' align='center'> ".$month_thai[$month]." 2552 </td> ";
	$temp_report.=" <td width='80' align='center'> �ѹ</td> ";
	$temp_report.=" <td width='80' align='center'> �ѹ�ҷ </td> ";
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
	$sql =" SELECT BaseSubProduct.sub_pro_name,  ";
	$sql.=" BaseProduct.pro_name, userlogin.br_code, userlogin.userdetail,  ";
	$sql.=" SUM(Temp01.target_value),  ";
	$sql.=" SUM(Temp02.PlanCollectBuy_Unit),  ";
	$sql.=" SUM(Temp02.PlanCollectBuy_Sum),  ";
	$sql.=" SUM(Temp03.data1), SUM(Temp03.data2), SUM(Temp03.data3),   ";
	$sql.=" SUM(Temp03.data4), SUM(Temp03.data5), SUM(Temp03.data6),   ";
	$sql.=" SUM(Temp03.data7), SUM(Temp03.data8), SUM(Temp04.target_value),  ";
	$sql.=" SUM(Temp05.PlanCollectSell_Unit), SUM(Temp05.PlanCollectSell_Sum), ";
	$sql.=" SUM(Temp03.data9), SUM(Temp03.data10),  ";
	$sql.=" SUM(Temp03.data11),SUM(Temp03.data12), ";
	$sql.=" SUM(Temp03.data13), SUM(Temp03.data14)  ";
	$sql.=" FROM userlogin, BaseSubProduct, BaseProduct, BaseReportHeader  ";

/* ������µ���ѹ�֡��͵�ŧ */
	$sql.=" LEFT JOIN (   ";
	$sql.=" SELECT TargetTris.target_value,  ";
	$sql.=" TargetTris.report_detail_code, TargetTris.amccode   ";
	$sql.=" FROM TargetTris   ";
	$sql.=" WHERE target_year='".$year."' AND target_month='3' ) AS Temp01   ";
	$sql.=" ON Temp01.report_detail_code = BaseReportHeader.report_detail_code   ";
	$sql.=" AND Temp01.amccode=BaseReportHeader.amccode   ";

/* ������¡���Ǻ��� ��Ե�� �ͧ ʡ�. */
	$sql.=" LEFT JOIN (   ";
	$sql.=" SELECT PlanCollectBuy.PlanCollectBuy_Sum,   ";
	$sql.=" PlanCollectBuy.PlanCollectBuy_Unit,   ";
	$sql.=" PlanCollectBuy.report_detail_code, PlanCollectBuy.amccode   ";
	$sql.=" FROM PlanCollectBuy   ";
	$sql.=" WHERE PlanCollectBuy.PlanCollectBuy_year='".$year."' ) AS Temp02   ";
	$sql.=" ON Temp02.report_detail_code = BaseReportHeader.report_detail_code   ";
	$sql.=" AND Temp02.amccode=BaseReportHeader.amccode   ";

/* �š���Ǻ��������ҧ�� ����ѹ�֡��͵�ŧ  3  */
	$sql.=" LEFT JOIN (   ";
	$sql.=" SELECT data1, data2, data3, data4, data5,   ";
	$sql.=" data6, data7, data8, data9 , ";
	$sql.=" data10, data11 , data12 , ";
	$sql.=" data13, data14, report_detail_code, amccode   ";
	$sql.=" FROM ReportGroup3   ";
	$sql.=" WHERE report_year='".$year."' AND ".$display_sql.") AS Temp03   ";
	$sql.=" ON Temp03.report_detail_code = BaseReportHeader.report_detail_code   ";
	$sql.=" AND Temp03.amccode=BaseReportHeader.amccode   ";

/* ������µ���ѹ�֡��͵�ŧ  ������Ш���͹  */
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT TargetTris.target_value, ";
	$sql.=" TargetTris.report_detail_code, TargetTris.amccode  ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND ".$display_sql2." ) AS Temp04  ";
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

	$sql.=" WHERE BaseSubProduct.sub_pro_code = BaseProduct.sub_pro_code  ";
	$sql.=" AND BaseReportHeader.report_group_code = '3'  ";
	$sql.=" AND BaseReportHeader.report_detail_code =  BaseProduct.pro_code   ";
	$sql.=" AND BaseReportHeader.amccode = userlogin.amccode  ";
	$sql.=" AND userlogin.status = 'N'   ";

	if($div!=0)  // �ó����͡�繽��¡Ԩ����Ң�
	{	$sql.=" AND userlogin.br_code='".$div."' "; 	}

	$sql.=" GROUP BY BaseSubProduct.sub_pro_name,  ";
	$sql.=" BaseProduct.pro_name, userlogin.br_code, userlogin.userdetail WITH ROLLUP  ";

	$sql.=" ORDER BY BaseSubProduct.sub_pro_name,BaseProduct.pro_name, userlogin.br_code  ";

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
	$j = 1;  // �Ǻ�������ʴ��ͧ page 
	//  �ʴ������ŷ�����
	WHILE($fetch_report = fetch_row($result_report)) { 

	 //  ��Ǩ�ͺ����ա����ػ���  �ѡɳ���� ʡ�. �Ѻ �ż�Ե �������ͧ��� ������ͧ����ʴ�
		if( !is_null($fetch_report[0]) && !is_null($fetch_report[1]) && !is_null($fetch_report[2]) && is_null($fetch_report[3])){
			continue;
		} // end if 

	// ��ػ�����駻����
		if( is_null($fetch_report[0]) && is_null($fetch_report[1]) && is_null($fetch_report[2]) && is_null($fetch_report[3]))  
		{
			$temp_report.="<tr bgcolor='#FFFF99'>";
			$temp_report.="<td colspan='2'>&nbsp; �����駻���� </td>";
			$i = 0;
		} // ��ػ������мż�Ե��ѡ
		elseif(!is_null($fetch_report[0]) && is_null($fetch_report[1]) && is_null($fetch_report[2]) && is_null($fetch_report[3]))  
		{
			$temp_report.="</tbody>";
			$temp_report.="<tr bgcolor='#99CCFF'>"; 
			$temp_report.=" <td colspan='2'>&nbsp; ��� ".trim($fetch_report[0])." </td>";
			$i = 0;
		}// ��ػ���� �ż�Ե ���� 
		elseif(!is_null($fetch_report[0]) && !is_null($fetch_report[1]) && is_null($fetch_report[2]) && is_null($fetch_report[3])) 
		{
			$temp_report.="<tr bgcolor='#FFCC99'>"; 
			$temp_report.=" <td colspan='2'>&nbsp; ��� ".trim($fetch_report[1])." </td>";
			$i = 0;
		}
		else    // �ʴ�������
		{
			$i++;			
			if(($i%2)==0)
			{	$temp_report.="<tr bgcolor='#C0C0C0'>";  }
			else
			{  $temp_report.="<tr>";  }
			$temp_report.=" <td width='80'>&nbsp;".trim($fetch_report[1])."</td>";   //  ��ª��ͼż�Ե
			$temp_report.=" <td width='150'>&nbsp;".trim($fetch_report[2])."&nbsp;".trim($fetch_report[3])." [".$current_amc[trim($fetch_report[3])]."] </td>";  // ��ª��� ʡ�.
		}  // end if
	
		$temp_report.=" <td align='right'>".number_format($fetch_report[4],0,'','')."</td>";  // ������� tris
		$temp_report.=" <td align='right'>".number_format($fetch_report[5],0,'','')."</td>";  // ������� ʡ� 4  �ѹ
		$temp_report.=" <td align='right'>".number_format($fetch_report[6],0,'','')."</td>";  // ������� ʡ� 4  �ѹ�ҷ
		$temp_report.=" <td align='right'>".number_format($fetch_report[7],0,'','')."</td>";  // ��� 3.1
		$temp_report.=" <td align='right'>".number_format($fetch_report[8],0,'','')."</td>";  //  �ѹ 3.1
		$temp_report.=" <td align='right'>".number_format($fetch_report[9],0,'','')."</td>";  //  �ѹ�ҷ 3.1
		$temp_report.=" <td align='right'>".number_format($fetch_report[10],0,'','')."</td>";  //  ͧ��� 3.2
		$temp_report.=" <td align='right'>".number_format($fetch_report[11],0,'','')."</td>";  //  �ѹ 3.2 
		$temp_report.=" <td align='right'>".number_format($fetch_report[12],0,'','')."</td>";  // �ѹ�ҷ 3.2 
		$temp_report.=" <td align='right'>".number_format($fetch_report[13],0,'','')."</td>";  //  �ѹ 4
		$temp_report.=" <td align='right'>".number_format($fetch_report[14],0,'','')."</td>";  //  �ѹ 4
		$temp_report.=" <td align='right'>".number_format($fetch_report[15],0,'','')."</td>";  //  ����������� ʡ�4 ��Ш���͹  5
		$temp_sum1 = number_format($fetch_report[8],0,'','')+number_format($fetch_report[11],0,'','')+number_format($fetch_report[13],0,'','');
		$temp_sum2 = number_format($fetch_report[9],0,'','')+number_format($fetch_report[12],0,'','')+number_format($fetch_report[14],0,'','');
		$temp_report.=" <td align='right'>".number_format($temp_sum1,0,'','')."</td>";  //  �ѹ 5
		$temp_report.=" <td align='right'>".number_format($temp_sum2,0,'','')."</td>";  //  �ѹ 5
		$temp_report.=" <td align='right'>".number_format($fetch_report[16],0,'','')."&nbsp;</td>";  //  6  ������¡�è�˹��¼�Ե��  �ѹ
		$temp_report.=" <td align='right'>".number_format($fetch_report[17],0,'','')."&nbsp;</td>";  //  6  ������¡�è�˹��¼�Ե��  �ѹ�ҷ
		$temp_report.=" <td align='right'>".number_format($fetch_report[18],0,'','')."&nbsp;</td>";  //  7 ��˹������ �ѹ
		$temp_report.=" <td align='right'>".number_format($fetch_report[19],0,'','')."&nbsp;</td>";  //  7 ��˹������ �ѹ�ҷ
		$temp_report.=" <td align='right'>".number_format($fetch_report[20],0,'','')."&nbsp;</td>";  //  7 ��˹������TABCO �ѹ
		$temp_report.=" <td align='right'>".number_format($fetch_report[21],0,'','')."&nbsp;</td>";  //  7 ��˹������TABCO �ѹ�ҷ
		$temp_report.=" <td align='right'>".number_format($fetch_report[22],0,'','')."&nbsp;</td>";  //  8 ��Ť�� ��Ե�Ť������
		$temp_report.=" <td align='right'>".number_format($fetch_report[23],0,'','')."&nbsp;</td>";  //  9 ���˹�ҵ��᷹
		$temp_report.="</tr>";

	//  ��͹���������㹼ż�Ե��ѡ  �������͹
		if( !is_null($fetch_report[0]) && is_null($fetch_report[1]) && is_null($fetch_report[2]) && is_null($fetch_report[3])) 
		{	
			$temp_report.="<tbody id=page".$j." style='DISPLAY: none'>";
			$j++;
		}  // end if 

	} // end while

	$temp_report.="</tbody>";
	$temp_report.="</table> ";

	$temp_report.="<br>";
	free_result($result_report);
    close();
	echo $temp_report;
	ob_end_flush();	
 ?>
 </body></html>