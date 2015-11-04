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
	
	//���ҧ�����������§ҹ �ѹ
	$temp_report.="<table width='805' class='gridtable' style='margin-top:25px; margin-left:5px; margin-right:5px;'> ";
	$temp_report.=" <tr height='25px'>  ";
	$temp_report.="   <td colspan='22' align='left'>&nbsp;<font color='#0F7FAF'><b>".trim($report_detail_code).".".trim($report_detail_name)."</b></font></td> ";
	$temp_report.=" </tr> ";
	$temp_report.=" <tr class='rows_purple'>  ";
	$temp_report.="   <td rowspan='3' width='50' align='center' valign='middle'>����</td> ";
	$temp_report.="   <td rowspan='3' width='130' align='center' valign='middle'>ʡ�.</td> ";
	$temp_report.="   <td rowspan='2' colspan='3' align='center' valign='middle'>�Ǻ��������ҧ��</td> ";
	$temp_report.="	   <td colspan='5' align='center'  valign='middle'>��˹��������ҧ��</td> ";
	$temp_report.=" </tr> ";
	$temp_report.=" <tr class='rows_purple'>  ";
	$temp_report.="    <td colspan='3' align='center'>���</td> ";
	$temp_report.="    <td colspan='2' align='center'>��˹������ TABCO</td> ";
	$temp_report.=" </tr> ";
	$temp_report.=" <tr class='rows_purple'>  ";
	$temp_report.="  <td align='center' width='80'>�������</td> ";
	$temp_report.="  <td align='center' width='80'>��ԧ</td> ";
	$temp_report.="  <td align='center' width='75'>�ŵ�ҧ %</td> ";
	$temp_report.="  <td align='center' width='80'>�������</td> ";
	$temp_report.="  <td align='center' width='80'>��ԧ</td> ";
	$temp_report.="  <td align='center' width='75'>�ŵ�ҧ %</td> ";
	$temp_report.="  <td align='center' width='80'>��ԧ</td> ";
	$temp_report.="  <td align='center' width='75'>�Ѵ��ǹ</td> ";
	$temp_report.=" </tr> ";
	// ����� sql  �ѹ  ��¨ѧ��Ѵ
	$sql = " SELECT userlogin.br_code,userlogin.userdetail, ";
	$sql.=" Temp01.PlanCollectBuy_Unit,Temp02.data257, ";
	$sql.=" Temp03.PlanCollectSell_Unit, Temp02.data9, ";
	$sql.=" Temp02.data11, userlogin.amccode ";
	$sql.=" FROM userlogin ";
	$sql.=" LEFT JOIN( ";
	$sql.="   SELECT SUM(PlanCollectBuy_Unit)AS PlanCollectBuy_Unit, amccode ";
	$sql.="   FROM PlanCollectBuy ";
	$sql.="   WHERE PlanCollectBuy_year='".$year."' ";
	$sql.="  AND report_detail_code='".$report_detail_code."' ";
	$sql.="   GROUP BY amccode ";
	$sql.=" )AS Temp01 ON Temp01.amccode = userlogin.amccode ";
	$sql.=" LEFT JOIN ( ";
	$sql.="   SELECT SUM(data2+data5+data7)AS data257 ,SUM(data9)AS data9, ";
	$sql.="          SUM(data11)AS data11,amccode ";
	$sql.="   FROM ReportGroup3 ";
	$sql.="   WHERE  report_year='".$year."' AND report_month='".$month."' ";
	$sql.="  AND report_detail_code='".$report_detail_code."' ";
	$sql.="   GROUP BY amccode ";
	$sql.=" )AS Temp02 ON Temp02.amccode = userlogin.amccode ";
	$sql.=" LEFT JOIN( ";
	$sql.="   SELECT SUM(PlanCollectSell_Unit)AS PlanCollectSell_Unit, amccode ";
	$sql.="   FROM PlanCollectSell ";
	$sql.="   WHERE PlanCollectSell_year='".$year."' ";
	$sql.="  AND report_detail_code='".$report_detail_code."' ";
	$sql.="   GROUP BY amccode ";
	$sql.=" )AS Temp03 ON Temp03.amccode = userlogin.amccode ";
	$sql.=" WHERE userlogin.status='N' ";
	if($div!='0')
		{	$sql.=" AND userlogin.br_code='".$div."' ";  }
	if($province!='0')
		{	$sql.=" AND userlogin.amccode='".$province."' ";  }
	$sql.=" ORDER BY userlogin.br_code,userlogin.userdetail ";

	$result_report = query($sql);
	$sum01=0;
	$sum02=0;
	$sum03=0;
	$sum04=0;
	$sum05=0;
	$i=0;    
	// �Ҥ�ҽ����á����բ�����
	if($div==0)
	{	$temp_div = result($result_report,0,"br_code");
		data_seek($result_report);	}

	// ���ҧ��������ǹ������ �ѹ
	WHILE($fetch_report = fetch_row($result_report)) { 

				if($div==0)  //  ��ػ����������н���
				{
					if($temp_div==trim($fetch_report[0]))
					{	$sum101=$sum101+number_format($fetch_report[2],0,'','');
						$sum102=$sum102+number_format($fetch_report[3],0,'','');
						$sum103=$sum103+number_format($fetch_report[4],0,'','');
						$sum104=$sum104+number_format($fetch_report[5],0,'','');
						$sum105=$sum105+number_format($fetch_report[6],0,'','');
					}else
					{	$temp_report.=" <tr class='rows_sky' height='20'>"; 
						$temp_report.="  <td align='center' colspan='2'> ��������Ž��� ".$temp_div." </td>";
						$temp_report.="		<td align='right'>".number_format($sum101,'', '.', ',')."&nbsp;</td>";
						$temp_report.="		<td align='right'>".number_format($sum102,'', '.', ',')."&nbsp;</td>";
						$temp_report.="		<td align='center'>&nbsp;</td>";
						$temp_report.="		<td align='right'>".number_format($sum103,'', '.', ',')."&nbsp;</td>";
						$temp_report.="		<td align='right'>".number_format($sum104,'', '.', ',')."&nbsp;</td>";
						$temp_report.="		<td align='center'>&nbsp;</td>";
						$temp_report.="		<td align='right'>".number_format($sum105,'', '.', ',')."&nbsp;</td>";
						$temp_report.="		<td align='center'>&nbsp;</td>";
						$temp_report.="	</tr>";
						$sum101=0;
						$sum102=0;
						$sum103=0;
						$sum104=0;
						$sum105=0;
						$temp_div = trim($fetch_report[0]);
					}
				} // end div=0

		$i++;	
		if(($i%2)==0)
		{	$temp_report.=" <tr class='rows_grey'>";  }
		else
		{  $temp_report.=" <tr>";  }

		$temp_report.="  <td align='center'>".trim($fetch_report[0])."</td>";
		$temp_report.=" <td><a href='#' OnClick=' doCallAjax99(\"".trim($fetch_report[7])."\",\"".trim($fetch_report[1])."\")' > &nbsp;".trim($fetch_report[1])."</a></td>";
		$temp_report.="  <td align='right'>".number_format($fetch_report[2])."&nbsp;</td> ";
		$temp_report.="  <td align='right'>".number_format($fetch_report[3])."&nbsp;</td> ";
		if(number_format($fetch_report[2],0,'','')==0)
		{	$temp_present = "0"; }
		else
		{	$temp_present = (number_format($fetch_report[3],0,'','')/number_format($fetch_report[2], 0,'', '')*100)-100;  }
		$temp_report.="  <td align='right'>".number_format($temp_present,2,'.',',')."%&nbsp;</td> ";  // �ŵ�ҧ
		$temp_report.="  <td align='right'>".number_format($fetch_report[4])."&nbsp;</td> ";
		$temp_report.="  <td align='right'>".number_format($fetch_report[5])."&nbsp;</td> ";
		if(number_format($fetch_report[4],0,'','')==0)
		{	$temp_present = "0"; }
		else
		{	$temp_present = (number_format($fetch_report[5],0,'','')/number_format($fetch_report[4], 0,'', '')*100)-100;  }
		$temp_report.="  <td align='right'>".number_format($temp_present,2,'.',',')."%&nbsp;</td> ";  // �ŵ�ҧ
		$temp_report.="  <td align='right'>".number_format($fetch_report[6])."&nbsp;</td> ";
		if(number_format($fetch_report[5],0,'','')==0)
		{	$temp_present = "0"; }
		else
		{	$temp_present = (number_format($fetch_report[6],0,'','')/number_format($fetch_report[5], 0,'', ''))*100;  }
		$temp_report.="  <td align='right'>".number_format($temp_present,2,'.',',')."%&nbsp;</td> ";  // �ŵ�ҧ
		$temp_report.="</tr> ";

		$sum01=$sum01+number_format($fetch_report[2],0,'','');
		$sum02=$sum02+number_format($fetch_report[3],0,'','');
		$sum03=$sum03+number_format($fetch_report[4],0,'','');
		$sum04=$sum04+number_format($fetch_report[5],0,'','');
		$sum05=$sum05+number_format($fetch_report[6],0,'','');

	} // end while 

	if($div==0)
	{		$temp_report.=" <tr class='rows_sky' height='20'>"; 
			$temp_report.="  <td align='center' colspan='2'> ��������Ž��� ".$temp_div." </td>";
			$temp_report.="		<td align='right'>".number_format($sum101,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum102,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='center'>&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum103,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum104,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='center'>&nbsp;</td>";
			$temp_report.="		<td align='right'>".number_format($sum105,'', '.', ',')."&nbsp;</td>";
			$temp_report.="		<td align='center'>&nbsp;</td>";
			$temp_report.="	</tr>";
	}
	// ���ҧ��������ǹ���� �ѹ
	$temp_report.=" <tr class='rows_yellow' height='20'>";
	$temp_report.=" <td align='center' colspan='2'> ��� </td>";
	$temp_report.=" <td align='right'>".number_format($sum01,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='right'>".number_format($sum02,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='center'>&nbsp;</td>";
	$temp_report.=" <td align='right'>".number_format($sum03,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='right'>".number_format($sum04,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='center'>&nbsp;</td>";
	$temp_report.=" <td align='right'>".number_format($sum05,'', '.', ',')."&nbsp;</td>";
	$temp_report.=" <td align='right'>&nbsp;</td>";
	$temp_report.=" </tr>";
$temp_report.="<br>";
$temp_report.="<center><a href='excel_search.php?div=".$div."&province=".$province."&project=".$project."'><img src='../images/page_excel.gif' border='0'> ������ Excel </a></center>";

   free_result($result_report);
   close();

 echo $temp_report;
 ob_end_flush();