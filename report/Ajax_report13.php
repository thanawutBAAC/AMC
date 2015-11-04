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

	$temp_report = "";  // ���Ѿ����е�ͧ�׹���
	// �����§ҹ
	$temp_report.="<strong><center>�ˡó����ɵ����͡�õ�Ҵ�١��� �.�.�. �ӡѴ </center>";
	$temp_report.="<center>AGRICULTURAL MARKETING COOPERATIVE (AMC) </center>";
	$temp_report.="<center>��§ҹ�š�ô��Թ�ҹ�ͧ ʡ�.��Ш���͹ <font color='#76B441'><u>".$month_thai[$month]."</u></font> �� <font color='#76B441'><u>".$year."</u></font> ".$temp_header."</center></strong>";
	$temp_report.="<center> ������ � �ѹ��� ".datetoday()." ���� ".date("G:i:s")."</center>";

	//���ҧ�����������§ҹ ��Ҫԡ ��áԨ �Ѻ ʡ�.
	$temp_report.="<table width='700' class='gridtable' style='margin-top:25px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.=" <tr height='25px'>  ";
	$temp_report.="   <td colspan='6' align='left'>&nbsp;<font color='#0F7FAF'><b> �����Թ��� (˹���:�ѹ�ҷ) </b></font></td> ";
	$temp_report.=" </tr> ";
	$temp_report.=" <tr class='rows_pink'>  ";
	$temp_report.="   <td  width='60' align='center'>����</td> ";
	$temp_report.="   <td  width='140' align='center'>ʡ�.</td> ";
	$temp_report.="   <td  width='100' align='center'>ǧ�Թ���</td> ";
	$temp_report.="   <td  width='100' align='center'>�ԡ�Թ���</td> ";
	$temp_report.="   <td  width='100' align='center'>�����Թ���</td> ";
	$temp_report.="   <td  width='100' align='center'>�ʹ˹�餧�����</td> ";
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

			$current_amc[trim($fetch_amc[0])] = $month_report3[trim($fetch_amc[1])];			// �ŧ����������͹�Ѩ�غѹ
			$display_sql.=" ( amccode='".trim($fetch_amc[0])."' AND report_month='".$month_report3[number_format($fetch_amc[1],0,'','')]."' ) OR";
		} // end while 

		$display_sql = substr($display_sql, 0, -2);   //  �����ҵ�� 2 �ش������   OR
		$display_sql.=" ) ";
//  **************************  ����ش��õ�Ǩ�ͺ   ****************************************

	// ����� sql  �����Թ���
	$sql = " SELECT  br_code,userdetail,Temp01.loan_limit, ";
	$sql.=" Temp01.loan_fund,Temp01.loan_pay,userlogin.amccode FROM userlogin ";
	$sql.=" LEFT JOIN( ";
	$sql.=" SELECT amccode,SUM(loan_limit)AS loan_limit, ";
	$sql.=" SUM(loan_fund)AS loan_fund,SUM(loan_pay)AS loan_pay ";
	$sql.=" FROM ReportGroup5 ";
	$sql.=" WHERE report_year='".$year."' "; // AND report_month='".$month."' ";
	$sql.=" AND ".$display_sql;
	$sql.=" GROUP BY amccode )AS Temp01 ";
	$sql.=" ON Temp01.amccode = userlogin.amccode ";

	$sql.=" WHERE status='N' ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.=" ORDER BY userlogin.br_code, userlogin.userdetail ";

	$result_report = query($sql);
	$i=0;    // ���ҧ��������ǹ������ �ѹ
	// �Ҥ�ҽ����á����բ�����
	if($div==0)
	{	$temp_div = result($result_report,0,"br_code");
		data_seek($result_report);	}

	WHILE($fetch_report = fetch_row($result_report)) { 

		if($div==0)  //  ��ػ����������н���
		{
			if($temp_div==trim($fetch_report[0]))
			{	
				$sum101=$sum101+number_format($fetch_report[2],0,'','');
				$sum102=$sum102+number_format($fetch_report[3],0,'','');
				$sum103=$sum103+number_format($fetch_report[4],0,'','');
				$sum104=$sum104+(number_format($fetch_report[3],0,'','')-number_format($fetch_report[4],0,'',''));
			}else
			{	$temp_report.="<tr class='rows_sky' height='20'>"; 
				$temp_report.=" <td align='center' colspan='2'> ��������Ž��� ".$temp_div." </td>";
				$temp_report.=" <td align='right'>".number_format($sum101,'', '.', ',')."&nbsp;</td>";
				$temp_report.=" <td align='right'>".number_format($sum102,'', '.', ',')."&nbsp;</td>";
				$temp_report.=" <td align='right'>".number_format($sum103,'', '.', ',')."&nbsp;</td>";
				$temp_report.=" <td align='right'>".number_format($sum104,'', '.', ',')."&nbsp;</td>";
				$temp_report.="</tr>";
				$sum101=0;	   $sum102=0;
				$sum103=0;   $sum104=0;
				$sum101= number_format($fetch_report[2],0,'','');
				$sum102= number_format($fetch_report[3],0,'','');
				$sum103= number_format($fetch_report[4],0,'','');
				$sum104= (number_format($fetch_report[3],0,'','')-number_format($fetch_report[4],0,'',''));
				$temp_div = trim($fetch_report[0]);
			}
		} // end div=0

		$i++;	
		if(($i%2)==0)
		{	$temp_report.="<tr class='rows_grey'>";  }
		else
		{  $temp_report.="<tr>";  }

		$temp_report.=" <td align='center'>".trim($fetch_report[0])."</td>";
		$temp_report.=" <td><a href='#' OnClick=' doCallAjax99(\"".trim($fetch_report[5])."\",\"".trim($fetch_report[1])."\")' > &nbsp;ʡ�.".trim($fetch_report[1])."</a>  [".$current_amc[$fetch_report[5]]."] </td>";
		$temp_report.=" <td align='right'>".number_format($fetch_report[2])."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($fetch_report[3])."&nbsp;</td> ";
		$temp_report.=" <td align='right'>".number_format($fetch_report[4])."&nbsp;</td> ";
		$temp_diff=number_format($fetch_report[3],0,'','')-number_format($fetch_report[4],0,'','');
		$temp_report.=" <td align='right'>".number_format($temp_diff)."&nbsp;</td> ";
		$temp_report.="</tr>";
		
		$sum01=$sum01+number_format($fetch_report[2],0,'','');
		$sum02=$sum02+number_format($fetch_report[3],0,'','');
		$sum03=$sum03+number_format($fetch_report[4],0,'','');
		$sum04=$sum04+(number_format($fetch_report[3],0,'','')-number_format($fetch_report[4],0,'',''));
	} // end while 

	if($div==0)
	{	
		$temp_report.=" <tr class='rows_sky' height='20'>"; 
		$temp_report.=" <td align='center' colspan='2'> ��������Ž��� ".$temp_div." </td>";
		$temp_report.=" <td align='right'>".number_format($sum101,'', '.', ',')."&nbsp;</td>";
		$temp_report.=" <td align='right'>".number_format($sum102,'', '.', ',')."&nbsp;</td>";
		$temp_report.=" <td align='right'>".number_format($sum103,'', '.', ',')."&nbsp;</td>";
		$temp_report.=" <td align='right'>".number_format($sum104,'', '.', ',')."&nbsp;</td>";
		$temp_report.="</tr>";
	}
	// ���ҧ��������ǹ���� �ѹ
	$temp_report.=" <tr class='rows_yellow' height='20'>";
	$temp_report.=" <td align='center' colspan='2'> ��� </td>";
	$temp_report.=" <td align='right'>".number_format($sum01,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='right'>".number_format($sum02,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='right'>".number_format($sum03,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='right'>".number_format($sum04,'', '.', ',')."&nbsp;</td>";
	$temp_report.="</tr></table>";
	$temp_report.="<br>";
	$temp_report.="<center><a href='excel_report13.php?year=".$year."&month=".$month."&div=".$div."&province=".$province."&province_name=".$province_name."'><img src='../images/page_excel.gif' border='0'> ������ Excel </a></center>";

   free_result($result_report);
   close();

 echo $temp_report;
 ob_end_flush();