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
	$temp_report.="<table width='2070' class='gridtable' style='margin-top:15px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.=" <tr class='rows_pink'> ";
	$temp_report.="  <td rowspan='2'  colspan='2' align='center' width='200'> ��Ե�� </td> ";
	$temp_report.="  <td align='center'> ������� <br>��.�.".$year1." </td> ";
	$temp_report.="  <td colspan='2' align='center'> �ʢ.1 </td> ";
	$temp_report.="  <td colspan='2' align='center'> �ʢ.2 </td> ";
	$temp_report.="  <td colspan='2' align='center'> �ʢ.3 </td> ";
	$temp_report.="  <td colspan='2' align='center'> �ʢ.4 </td> ";
	$temp_report.="  <td colspan='2' align='center'> �ʢ.5 </td> ";
	$temp_report.="  <td colspan='2' align='center'> �ʢ.6 </td> ";
	$temp_report.="  <td colspan='2' align='center'> �ʢ.7 </td> ";
	$temp_report.="  <td colspan='2' align='center'> �ʢ.8 </td> ";
	$temp_report.="  <td colspan='2' align='center'> �ʢ.9 </td> ";
	$temp_report.="  <td colspan='2' align='center'> ����ż�Ե </td> ";
	$temp_report.="  <td align='center'> ������� <br> ".$month_thai[$month]."</td> ";
	$temp_report.="  <td align='center'> �ŵ�ҧ </td> ";
	$temp_report.="  <td align='center'> ��º % </td> ";
	$temp_report.=" </tr> ";
	$temp_report.=" <tr class='rows_purple'> ";
	$temp_report.="  <td width='70' align='center'> ����ҳ </td> ";
	$temp_report.="  <td width='70' align='center'> ����ҳ </td> ";
	$temp_report.="  <td width='70' align='center'> ��Ť�� </td> ";
	$temp_report.="  <td width='70' align='center'> ����ҳ </td> ";
	$temp_report.="  <td width='70' align='center'> ��Ť�� </td> ";
	$temp_report.="  <td width='70' align='center'> ����ҳ </td> ";
	$temp_report.="  <td width='70' align='center'> ��Ť�� </td> ";
	$temp_report.="  <td width='70' align='center'> ����ҳ </td> ";
	$temp_report.="  <td width='70' align='center'> ��Ť�� </td> ";
	$temp_report.="  <td width='70' align='center'> ����ҳ </td> ";
	$temp_report.="  <td width='70' align='center'> ��Ť�� </td> ";
	$temp_report.="  <td width='70' align='center'> ����ҳ </td> ";
	$temp_report.="  <td width='70' align='center'> ��Ť�� </td> ";
	$temp_report.="  <td width='70' align='center'> ����ҳ </td> ";
	$temp_report.="  <td width='70' align='center'> ��Ť�� </td> ";
	$temp_report.="  <td width='70' align='center'> ����ҳ </td> ";
	$temp_report.="  <td width='70' align='center'> ��Ť�� </td> ";
	$temp_report.="  <td width='70' align='center'> ����ҳ </td> ";
	$temp_report.="  <td width='70' align='center'> ��Ť�� </td> ";
	$temp_report.="  <td width='70' align='center'> ����ҳ </td> ";
	$temp_report.="  <td width='70' align='center'> ��Ť�� </td> ";
	$temp_report.="  <td width='70' align='center'> ����ҳ </td> ";
	$temp_report.="  <td width='70' align='center'> ����ҳ </td> ";
	$temp_report.="  <td width='70' align='center'> ����ҳ </td> ";
	$temp_report.=" </tr> ";
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
	$sql =" SELECT BaseSubProduct.sub_pro_name, ";
	$sql.=" BaseProduct.pro_name, userlogin.br_code, userlogin.userdetail, ";
	$sql.=" SUM(Temp01.target_value) AS sum_target, ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='1' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='1' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='2' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='2' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END) ,	";
	$sql.=" SUM(CASE WHEN userlogin.br_code='3' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='3' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='4' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='4' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='5' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='5' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='6' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='6' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='7' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='7' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='8' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='8' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='9' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END) , ";
	$sql.=" SUM(CASE WHEN userlogin.br_code='9' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END) , ";
	$sql.=" SUM(Temp04.target_value) ";
	$sql.=" FROM userlogin, BaseSubProduct, BaseProduct, BaseReportHeader ";

/* ������µ���ѹ�֡��͵�ŧ */
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT TargetTris.target_value, ";
	$sql.=" TargetTris.report_detail_code, TargetTris.amccode  ";
	$sql.=" FROM TargetTris  ";
	$sql.=" WHERE target_year='".$year."' AND target_month='3' ) AS Temp01  ";
	$sql.=" ON Temp01.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp01.amccode=BaseReportHeader.amccode  ";

/* �š���Ǻ��������ҧ�� ����ѹ�֡��͵�ŧ  3  */
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT data2, data3, data5, data6,  ";
	$sql.=" data7, data8, report_detail_code, amccode  ";
	$sql.=" FROM ReportGroup3  ";
//	$sql.=" WHERE report_year='".$year."' AND report_month='".$month."') AS Temp03  ";
	$sql.=" WHERE report_year='".$year."' AND ".$display_sql." ) AS Temp03  ";
	$sql.=" ON Temp03.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp03.amccode=BaseReportHeader.amccode  ";

/* ������µ���ѹ�֡��͵�ŧ  ������Ш���͹  */
	$sql.=" LEFT JOIN (  ";
	$sql.=" SELECT TargetTris.target_value, ";
	$sql.=" TargetTris.report_detail_code, TargetTris.amccode  ";
	$sql.=" FROM TargetTris  ";
//	$sql.=" WHERE target_year='".$year."' AND target_month='".$month."' ) AS Temp04  ";
	$sql.=" WHERE target_year='".$year."' AND ".$display_sql2." ) AS Temp04  ";
	$sql.=" ON Temp04.report_detail_code = BaseReportHeader.report_detail_code  ";
	$sql.=" AND Temp04.amccode=BaseReportHeader.amccode  ";

	$sql.=" WHERE BaseSubProduct.sub_pro_code = BaseProduct.sub_pro_code ";
	$sql.=" AND BaseReportHeader.report_group_code = '3' ";
	$sql.=" AND BaseReportHeader.report_detail_code =  BaseProduct.pro_code  ";
	$sql.=" AND BaseReportHeader.amccode = userlogin.amccode ";
	$sql.=" AND userlogin.status = 'N' ";

	if($div!=0)  // �ó����͡�繽��¡Ԩ����Ң�
	{	$sql.=" AND userlogin.br_code='".$div."' "; 	}

	$sql.=" GROUP BY BaseSubProduct.sub_pro_name, ";
	$sql.=" BaseProduct.pro_name, userlogin.br_code, userlogin.userdetail WITH ROLLUP ";

	$sql.=" ORDER BY BaseSubProduct.sub_pro_name,BaseProduct.pro_name, userlogin.br_code ";

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

	 //  ��Ǩ�ͺ����ա����ػ���  �ѡɳ���� ʡ� �������ͧ��� ������ͧ����ʴ�
		if( !is_null($fetch_report[0]) && !is_null($fetch_report[1]) && !is_null($fetch_report[2]) && is_null($fetch_report[3])){
			continue;
		} // end if 

		if( is_null($fetch_report[0]) && is_null($fetch_report[1]) && is_null($fetch_report[2]) && is_null($fetch_report[3]) )  // ��ػ�����駻����
		{
			$temp_report.="<tr class='rows_yellow'>";
			$temp_report.="<td colspan='2'>&nbsp; �����駻���� </td>";
			$i = 0;
		}
		elseif(!is_null($fetch_report[0]) && is_null($fetch_report[1]) && is_null($fetch_report[2]) && is_null($fetch_report[3]))   // ��ػ������мż�Ե��ѡ
		{
			$temp_report.="</tbody>";
			$temp_report.="<tr class='rows_sky'>"; 
			$temp_report.=" <td colspan='2'>&nbsp;<img id='pic".$j."' src='../images/icon_plus.gif' style='cursor: hand'  onclick=showhide(page".$j.",'pic".$j."') > ��� ".trim($fetch_report[0])." </td>";
			$i = 0;
		}
		elseif(!is_null($fetch_report[0]) && !is_null($fetch_report[1]) && is_null($fetch_report[2]) && is_null($fetch_report[3]))  // ��ػ���� �ż�Ե����
		{
			$temp_report.="<tr class='rows_orange'>"; 
			$temp_report.=" <td colspan='2'>&nbsp; ��� ".trim($fetch_report[1])." </td>";
			$i = 0;
		}
		else    // �ʴ�������
		{
			$i++;			
			if(($i%2)==0)
			{	$temp_report.="<tr class='rows_grey'>";  }
			else
			{  $temp_report.="<tr>";  }
			$temp_report.=" <td width='230' nowrap>&nbsp;".trim($fetch_report[1])."</td>";   // �ż�Ե����
			$temp_report.=" <td width='150' nowrap>&nbsp;".trim($fetch_report[2])."&nbsp;".trim($fetch_report[3])." [".$current_amc[trim($fetch_report[3])]."] </td>";  // ��ª��� ���� / ʡ�.
		}  // end if
		
		$temp_sum1 = 0;   // �������ҳ ���Ǥ���
		$temp_sum2 = 0;  // �����Ť�� ���Ǥ���
		$temp_report.=" <td align='right'>".number_format($fetch_report[4])."&nbsp;</td>";  // ������� tris ����ҳ
		$temp_report.=" <td align='right'>".number_format($fetch_report[5])."&nbsp;</td>";  // ����ҳ ���� 1
		$temp_report.=" <td align='right'>".number_format($fetch_report[6])."&nbsp;</td>";  // ��Ť�� ���� 1
		$temp_report.=" <td align='right'>".number_format($fetch_report[7])."&nbsp;</td>";  // ����ҳ ���� 2
		$temp_report.=" <td align='right'>".number_format($fetch_report[8])."&nbsp;</td>";  // ��Ť�� ���� 2
		$temp_report.=" <td align='right'>".number_format($fetch_report[9])."&nbsp;</td>";  // ����ҳ ���� 3
		$temp_report.=" <td align='right'>".number_format($fetch_report[10])."&nbsp;</td>";  // ��Ť�� ���� 3
		$temp_report.=" <td align='right'>".number_format($fetch_report[11])."&nbsp;</td>";  // ����ҳ ���� 4
		$temp_report.=" <td align='right'>".number_format($fetch_report[12])."&nbsp;</td>";  // ��Ť�� ���� 4
		$temp_report.=" <td align='right'>".number_format($fetch_report[13])."&nbsp;</td>";  // ����ҳ ���� 5
		$temp_report.=" <td align='right'>".number_format($fetch_report[14])."&nbsp;</td>";  // ��Ť�� ���� 5
		$temp_report.=" <td align='right'>".number_format($fetch_report[15])."&nbsp;</td>";  // ����ҳ ���� 6
		$temp_report.=" <td align='right'>".number_format($fetch_report[16])."&nbsp;</td>";  // ��Ť�� ���� 6
		$temp_report.=" <td align='right'>".number_format($fetch_report[17])."&nbsp;</td>";  // ����ҳ ���� 7
		$temp_report.=" <td align='right'>".number_format($fetch_report[18])."&nbsp;</td>";  // ��Ť�� ���� 7
		$temp_report.=" <td align='right'>".number_format($fetch_report[19])."&nbsp;</td>";  // ����ҳ ���� 8
		$temp_report.=" <td align='right'>".number_format($fetch_report[20])."&nbsp;</td>";  // ��Ť�� ���� 8
		$temp_report.=" <td align='right'>".number_format($fetch_report[21])."&nbsp;</td>";  // ����ҳ ���� 9
		$temp_report.=" <td align='right'>".number_format($fetch_report[22])."&nbsp;</td>";  // ��Ť�� ���� 9
		$temp_sum1 = number_format($fetch_report[5]+$fetch_report[7]+$fetch_report[9]+$fetch_report[11]+$fetch_report[13]+$fetch_report[15]+$fetch_report[17]+$fetch_report[19]+$fetch_report[21],0,'','');  // �������ҳ���Ǥ���
		$temp_sum2 = number_format($fetch_report[6]+$fetch_report[8]+$fetch_report[10]+$fetch_report[12]+$fetch_report[14]+$fetch_report[16]+$fetch_report[18]+$fetch_report[20]+$fetch_report[22],0,'','');  // �����Ť�Ҫ��Ǥ���
		$temp_report.=" <td align='right'>".number_format($temp_sum1)."&nbsp;</td>";  //  �������ҳ
		$temp_report.=" <td align='right'>".number_format($temp_sum2)."&nbsp;</td>";  //  ��� ��Ť��
		$temp_report.=" <td align='right'>".number_format($fetch_report[23])."&nbsp;</td>";  // ������� ���� ����ҳ � ��͹
		$temp_sum3 = number_format($temp_sum1-$fetch_report[23],0,'','');
		$temp_report.=" <td align='right'>".number_format($temp_sum3)."&nbsp;</td>";  //  �ŵ�ҧ 
		
		if( number_format($fetch_report[23],0,'','')==0){	 // �红����� ��º % ���Ǥ���
			$temp_sum3 = 100;
		}else{
			$temp_sum3 = number_format(($temp_sum1/$fetch_report[23])*100,2,'.',''); 
		}

		$temp_report.=" <td align='right'>".number_format($temp_sum3,2,'.','')."%&nbsp;</td>";// ��º�����繵�
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
	$temp_report.="<center><a href='excel_report16.php?div=".$div."&year=".$year."&month=".$month."'><img src='../images/page_excel.gif' border='0'> ������ Excel </a></center>";
	free_result($result_report);
    close();

	echo $temp_report;
	ob_end_flush();	