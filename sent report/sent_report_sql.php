<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	include("../lib/function.php");
	connect();

	if($click=='add')
	{
		$sql=" SELECT amccode FROM SentReportHeader ";
		$sql.=" WHERE amccode='".$code_online."' AND sent_month='".$month."' AND sent_year='".$year."' ";
		if(num_rows(query($sql))>0)
		{
			print '<script> alert(" �������ö������������͹������͡��   ���ͧ�ҡ�բ���������������� "); </script>';
			print '<script>javascript:history.back(1);</script>';
		}
	}

	query("BEGIN TRAN");
	if($click=='edit')
	{
		// ź����觢�����
		$sql=" DELETE FROM SentReportHeader ";
		$sql.=" WHERE amccode='".$code_online."' AND sent_month='".$month."' AND sent_year='".$year."' ";
		query($sql);
		// ź�����ŷ����
		$sql = " DELETE FROM ReportGroup1 WHERE amccode='".$code_online."' AND report_year='".$year."' AND report_month='".$month."'  ";
		query($sql);
		// ź��������Ť�Ҹ�áԨ�Ѵ���Թ����Ҩ�˹��� 
		$sql = " DELETE FROM ReportGroup2 WHERE amccode='".$code_online."' AND report_year='".$year."' AND report_month='".$month."'  ";
		query($sql);
		// ��Ť�Ҹ�áԨ�Ǻ�����Ե�� 
		$sql = " DELETE FROM ReportGroup3 WHERE amccode='".$code_online."' AND report_year='".$year."' AND report_month='".$month."'  ";
		query($sql);
		// ��Ť�Ҹ�áԨ����ԡ����������������ɵ� 
		$sql = " DELETE FROM ReportGroup4 WHERE amccode='".$code_online."' AND report_year='".$year."' AND report_month='".$month."'  ";
		query($sql);
		// �����Թ��� (˹���:�ѹ�ҷ)
		$sql = " DELETE FROM ReportGroup5 WHERE amccode='".$code_online."' AND report_year='".$year."' AND report_month='".$month."'  ";
		query($sql);
		// �ӹǹ��Ҫԡ���Ӹ�áԨ�Ѻ ʡ�.(˹��� : ���)
		$sql = " DELETE FROM ReportGroup6 WHERE amccode='".$code_online."' AND report_year='".$year."' AND report_month='".$month."'  ";
		query($sql);
		// ��áԨ���ٻ
		$sql = " DELETE FROM ReportGroup8 WHERE amccode='".$code_online."' AND report_year='".$year."' AND report_month='".$month."'  ";
		query($sql);
		// ���˵ء�âҴ�ع
		$sql = " DELETE FROM ReportComment WHERE amccode='".$code_online."' AND report_year='".$year."' AND report_month='".$month."'  ";
		query($sql);
	}

// �纤������Ǩ�ͺ
	$data2 = false;
	$data3 = false;
	$data8 = false;

// ��˹� time zone ����
	date_default_timezone_set('Asia/Bangkok');

	$today = datetoday();
	$time = 	date("H")-1;
	$time = $time.date(":i:s ");
	// ��Ѻ��ا�������к����������§ҹ����   1 �ѧ�����͡ lock  2 ��͡ no lock
	$sql =" INSERT INTO SentReportHeader ";
	$sql.=" (amccode,sent_month,sent_year,sent_date,sent_time,sent_status) VALUES( ";
	$sql.=" '".$code_online."','".$month."','".$year."','".$today."','".$time."','1' ) ";  // ��� lock
	query($sql);

	$sql =" SELECT  BaseReportDetail.report_group_code, BaseReportDetail.report_detail_code ";
	$sql.=" FROM BaseReportHeader, BaseReportDetail   ";
	$sql.=" WHERE BaseReportHeader.report_group_code = BaseReportDetail.report_group_code  ";
	$sql.=" AND  BaseReportHeader.report_detail_code = BaseReportDetail.report_detail_code  ";
	$sql.=" AND BaseReportHeader.amccode='".$code_online."' ";
	$sql.=" ORDER BY BaseReportDetail.report_group_code, BaseReportDetail.report_detail_code ";
	$result_update = query($sql);
	WHILE($fetch_update  = fetch_row($result_update))
	{
		if(trim($fetch_update[0])=='1')
		{
			$ans1 =  number_format($_POST['1x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$sql =" INSERT INTO ReportGroup1(amccode, report_year, report_month, report_detail_code, report_value) ";
			$sql.=" VALUES ('".$code_online."','".$year."','".$month."','".trim($fetch_update[1])."',".$ans1." ) ";
		}	// end if 1
		if(trim($fetch_update[0])=='2')
		{
			$ans1 =  number_format($_POST['23x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans2 =  number_format($_POST['24x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans3 =  number_format($_POST['26x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans4 =  number_format($_POST['27x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans5 =  number_format($_POST['211x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans6 =  number_format($_POST['212x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans7 =  number_format($_POST['214x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$sql=" INSERT INTO ReportGroup2 ";
			$sql.=" (amccode, report_year, report_month, report_detail_code, ";
			$sql.="  product_buy_sum, product_buy_unit, product_buy_tabco, product_tabco_unit, product_sell_sum,product_sell_unit,  product_procure ) ";
			$sql.=" VALUES  ('".$code_online."','".$year."','".$month."','".trim($fetch_update[1])."',$ans1,$ans2,$ans3,$ans4,$ans5,$ans6,$ans7) ";
			$data2 = true;
		}	// end if 2
		if(trim($fetch_update[0])=='3')
		{
			$ans1 =  number_format($_POST['34x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans2 =  number_format($_POST['35x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans3 =  number_format($_POST['36x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans4 =  number_format($_POST['37x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans5 =  number_format($_POST['38x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans6 =  number_format($_POST['39x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans7 =  number_format($_POST['310x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans8 =  number_format($_POST['311x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans9 =  number_format($_POST['316x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans10 =  number_format($_POST['317x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans11 =  number_format($_POST['318x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans12 =  number_format($_POST['319x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans13 =  number_format($_POST['320x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans14 =  number_format($_POST['321x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$sql = " INSERT INTO ReportGroup3 ";
			$sql.=" (amccode, report_year, report_month, report_detail_code, ";
			$sql.=" data1, data2, data3, data4, ";
			$sql.=" data5, data6, data7, data8, ";
			$sql.=" data9, data10, data11, data12, data13, data14) ";
			$sql.=" VALUES ('".$code_online."','".$year."','".$month."','".trim($fetch_update[1])."',$ans1,$ans2,$ans3,$ans4,$ans5,$ans6,$ans7,$ans8,$ans9,$ans10,$ans11,$ans12,$ans13,$ans14) ";
			$data3 = true;
		}	// end if 3
		if(trim($fetch_update[0])=='4')
		{
			$ans1 =  number_format($_POST['42x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$sql =" INSERT INTO ReportGroup4(amccode, report_year, report_month, report_detail_code, service_value) ";
			$sql.=" VALUES ('".$code_online."','".$year."','".$month."','".trim($fetch_update[1])."',".$ans1." ) ";
		}	// end if 4
		if(trim($fetch_update[0])=='5')
		{
			$ans1 =  number_format($_POST['51x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans2 =  number_format($_POST['52x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans3 =  number_format($_POST['53x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$sql=" INSERT INTO ReportGroup5 ";
			$sql.=" (amccode, report_year, report_month, report_detail_code,loan_limit,loan_fund ,loan_pay) ";
			$sql.=" VALUES ('".$code_online."','".$year."','".$month."','".trim($fetch_update[1])."',$ans1,$ans2,$ans3) ";
		}	// end if 5
		if(trim($fetch_update[0])=='6')
		{
			$ans1 =  number_format($_POST['61x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$sql = " INSERT INTO ReportGroup6 (amccode, report_year, report_month, report_detail_code,member_value ) ";
			$sql.=" VALUES ('".$code_online."','".$year."','".$month."','".trim($fetch_update[1])."',".$ans1." ) ";
		}	// end if 6
		if(trim($fetch_update[0])=='8')
		{
			$ans1 =  number_format($_POST['84x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans2 =  number_format($_POST['85x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans3 =  number_format($_POST['86x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans4 =  number_format($_POST['87x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans5 =  number_format($_POST['88x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans6 =  number_format($_POST['89x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans7 =  number_format($_POST['810x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans8 =  number_format($_POST['811x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans9 =  number_format($_POST['816x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans10 =  number_format($_POST['817x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans11 =  number_format($_POST['818x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans12 =  number_format($_POST['819x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans13 =  number_format($_POST['820x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$ans14 =  number_format($_POST['821x'.trim($fetch_update[0]).trim($fetch_update[1])] ,0,'','');  
			$sql = " INSERT INTO ReportGroup8 ";
			$sql.=" (amccode, report_year, report_month, report_detail_code, ";
			$sql.=" data1, data2, data3, data4, ";
			$sql.=" data5, data6, data7, data8, ";
			$sql.=" data9, data10, data11, data12, data13, data14) ";
			$sql.=" VALUES ('".$code_online."','".$year."','".$month."','".trim($fetch_update[1])."',$ans1,$ans2,$ans3,$ans4,$ans5,$ans6,$ans7,$ans8,$ans9,$ans10,$ans11,$ans12,$ans13,$ans14) ";
			$data8 = true;
		}	// end if 8

	// ��Ѻ��ا������
	$result_sql = query($sql);
	}

//  ��Ѻ��ا���������ǹ�ͧ����ʴ������˵� 㹡óշ��Ҵ�ع 11 �.�. 2552 
if(trim($_POST['txt_comment'])!="")
{
	// ���˵ء�âҴ�ع
	$sql = " DELETE FROM ReportComment WHERE amccode='".$code_online."' AND report_year='".$year."' AND report_month='".$month."'  ";
	query($sql);

	$sql =" INSERT INTO ReportComment(amccode, report_year, report_month, comment) ";
	$sql.=" VALUES ('".$code_online."','".$year."','".$month."','".trim($txt_comment)."') ";
	query($sql);
}
// ����ش��û�Ѻ��ا �����˵�

	// *** ��Ǩ�ͺ��Ң����ŷ�������������¡�����͹�������������� ***

	if($month<>4){
		if($month==1)// ��Ǩ�ͺ�ҡ��͹�������
			$temp_month = 12;
		else
			$temp_month = $month-1;  
		
		if($data2==true){
			$sql = " SELECT E.amccode, E.report_year, E.report_month ";
			$sql.= "  FROM ReportGroup2 E ";
			$sql.= " INNER JOIN ReportGroup2 M  ";
			$sql.= " ON M.amccode = E.amccode  ";
			$sql.= " AND M.report_year = E.report_year  ";
			$sql.= " AND M.report_month = '".$temp_month."' ";
			$sql.= " AND M.report_detail_code = E.report_detail_code ";
			$sql.= " AND (M.product_buy_sum > E.product_buy_sum  ";
			$sql.= " OR M.product_buy_tabco > E.product_buy_tabco OR M.product_sell_sum > E.product_sell_sum  ";
			$sql.= " OR M.product_procure > E.product_procure OR M.product_buy_unit > E.product_buy_unit  ";
			$sql.= " OR M.product_tabco_unit > E.product_tabco_unit OR M.product_sell_unit > E.product_sell_unit ) ";
			$sql.=" WHERE E.amccode = '".$code_online."'AND "; 
			$sql.=" E.report_year = '".$year."' AND ";
			$sql.=" E.report_month = '".$month."' ";
			$result_data = query($sql);
			if(num_rows($result_data)>0){
				print '<script>alert(" �բ����� 2. ��Ť�Ҹ�áԨ�Ѵ���Թ����Ҩ�˹��� �������¡�����͹�������  ");</script>';
				print '<script>alert(" ��سҵ�Ǩ�ͺ��������Ǵ��� 2 �ա���� ");</script>';
			} // end if 
		}	// end data2

		if($data3==true){
			$sql = " SELECT E.amccode, E.report_year, E.report_month ";
			$sql.=" FROM ReportGroup3 E ";
			$sql.=" INNER JOIN ReportGroup3 M  ";
			$sql.=" ON M.amccode = E.amccode  ";
			$sql.=" 	AND M.report_year = E.report_year  ";
			$sql.=" 	AND M.report_month = '".$temp_month."' ";
			$sql.=" 	AND M.report_detail_code = E.report_detail_code ";
			$sql.=" 	AND (M.data2 > E.data2  ";
			$sql.=" 	OR M.data3 > E.data3 OR M.data4 > E.data4  ";
			$sql.=" 	OR M.data5 > E.data5 OR M.data6 > E.data6  ";
			$sql.=" 	OR M.data7 > E.data7 OR M.data8 > E.data8  ";
			$sql.=" 	OR M.data9 > E.data9 OR M.data10 > E.data10 ";
			$sql.=" 	OR M.data11 > E.data11 OR M.data12 > E.data12 "; 
			$sql.=" 	OR M.data13 > E.data13 OR M.data14 > E.data14 ) ";
			$sql.=" WHERE E.amccode = '".$code_online."'AND ";
			$sql.=" E.report_year = '".$year."' AND ";
			$sql.=" E.report_month = '".$month."' ";
			$result_data = query($sql);
			if(num_rows($result_data)>0){
				print '<script>alert(" �բ����� 3 ��Ǵ��Ť�Ҹ�áԨ�Ǻ�����Ե�� �������¡�����͹������� ");</script>';
				print '<script>alert(" ��سҵ�Ǩ�ͺ��������Ǵ��� 3 �ա���� ");</script>';
			} // end if 
		} // end data3
		
		if($data8==true){
			$sql = " SELECT E.amccode, E.report_year, E.report_month ";
			$sql.=" FROM ReportGroup8 E ";
			$sql.=" INNER JOIN ReportGroup8 M  ";
			$sql.=" ON M.amccode = E.amccode  ";
			$sql.=" 	AND M.report_year = E.report_year  ";
			$sql.=" 	AND M.report_month = '".$temp_month."' ";
			$sql.=" 	AND M.report_detail_code = E.report_detail_code ";
			$sql.=" 	AND (M.data2 > E.data2  ";
			$sql.=" 	OR M.data3 > E.data3 OR M.data4 > E.data4  ";
			$sql.=" 	OR M.data5 > E.data5 OR M.data6 > E.data6  ";
			$sql.=" 	OR M.data7 > E.data7 OR M.data8 > E.data8  ";
			$sql.=" 	OR M.data9 > E.data9 OR M.data10 > E.data10 ";
			$sql.=" 	OR M.data11 > E.data11 OR M.data12 > E.data12 "; 
			$sql.=" 	OR M.data13 > E.data13 OR M.data14 > E.data14 ) ";
			$sql.=" WHERE E.amccode = '".$code_online."'AND ";
			$sql.=" E.report_year = '".$year."' AND ";
			$sql.=" E.report_month = '".$month."' ";
			$result_data = query($sql);
			if(num_rows($result_data)>0){
				print '<script>alert(" �բ����� 8 ��Ǵ���ٻ�ż�Ե �������¡�����͹������� ");</script>';
				print '<script>alert(" ��سҵ�Ǩ�ͺ��������Ǵ��� 8 �ա���� ");</script>';
			} // end if 
		} // end data8
	} // end if  month
	// ******************* ����ش��õ�Ǩ�ͺ ********************

	if($result_sql)
		{	query("COMMIT");
			print '<script>alert(" ��Ѻ��ا�����Ŷ١��ͧ ");</script>';		}
	else
		{	query("ROLLBACK");	
			print '<script>alert(" �բ�ͼԴ��Ҵ㹡���觢�����  �Դ���  WAN : 4471  ");</script>';		}

	close();
	print '<script>window.location.href = "sent_report.php";</script>';
?>