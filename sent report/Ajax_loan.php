<?php session_start();
	header( "Content-Type: text/html; charset=windows-874" ); 
	include("../lib/config.inc.php");
	include("../lib/database.php");
	
	connect();
	$year = $_GET["year"];
	$month = $_GET["month"];
	$click = $_GET["click"];
	// �ʴ���������Ǵ��� 5 �ͧ�Թ��� ������͡������
	// 1. �31 ��� 2 (2)
	// 2. �.31 ��� 2 (3)
	// 3 ��� �26
	// 4 �����������ˡó�
    // 5 �ˡó����
    // 6 ���˹�����
	// 7 ���.�46
// �Ң�������������͡��¡��㴷���ͧ��ú�ҧ
	$sql = " SELECT BaseReportDetail.report_detail_code ";
	$sql.=" FROM BaseReportDetail, BaseReportHeader  ";
	$sql.=" WHERE BaseReportHeader.amccode='".$code_online."'  ";
	$sql.=" AND BaseReportHeader.report_group_code='5'  ";
	$sql.=" AND BaseReportDetail.report_detail_code=BaseReportHeader.report_detail_code  ";
	$sql.=" AND BaseReportDetail.report_group_code=BaseReportHeader.report_group_code  ";
	$sql.=" ORDER BY BaseReportDetail.report_detail_code  ";

	$result_numlist = query($sql);
	$num_list = num_rows($result_numlist);
	// �红����� temp_num1234567  ����Ǩ�ͺ���������������� 
	if($num_list==0){
		$temp_num1 = false;
		$temp_num2 = false;
		$temp_num3 = false;
		$temp_num4 = false;
		$temp_num5 = false;
		$temp_num6 = false;
		$temp_num7 = false;
	}
	else{
		WHILE($fetch_numlist = fetch_row($result_numlist))
		{
			if( trim($fetch_numlist[0])=='1'){	
				$temp_num1 = true;
				$temp_sql1 = " (buy_loan_first+buy_loan_second+buy_loan_third+buy_loan_fourth) AS sum01 ";
			}
			elseif( trim($fetch_numlist[0])=='2'){ 
				$temp_num2 = true;
				$temp_sql2 = " (sell_loan_first+sell_loan_second+sell_loan_third+sell_loan_fourth) AS sum01 ";
			}
			elseif( trim($fetch_numlist[0])=='3'){
				$temp_num3 = true;
				$temp_sql3 = " (asset_68_first+asset_68_second+asset_68_third+asset_68_fourth) AS sum01 ";
			}
			elseif( trim($fetch_numlist[0])=='4'){
				 $temp_num4 = true;
			}
			elseif( trim($fetch_numlist[0])=='5'){
				 $temp_num5 = true;
			}
			elseif( trim($fetch_numlist[0])=='6'){
				 $temp_num6 = true;
			}
			elseif( trim($fetch_numlist[0])=='7'){
				 $temp_num7 = true;
			}
		} // end while
	} // end if 

	$temp_ans = "";  //  �ӵͺ����ͧ���
	//   ��Ǩ�ͺ����բ�������к�Ἱ㹻շ�����͡�������
	$temp_sql = " SELECT buy_loan_first ";
	$temp_sql.=" FROM PlanMaster WHERE amccode='".$code_online."' AND Plan_year='".$year."' ";
	$result_loan = query($temp_sql);
	if(num_rows($result_loan)==0)  // 㹡óշ������բ�����Ἱ���Թ�ҹ
	{
			// �������¡�÷�����͡��������Ἱ����ʴ���� 0 ᷹
			 if($temp_num1)
					$temp_ans.="0#";
			 if($temp_num2)
					$temp_ans.="0#";
			 if($temp_num3)
					$temp_ans.="0#";
			 if($temp_num4)
					$temp_ans.="0#";
			 if($temp_num5)
					$temp_ans.="0#";
			 if($temp_num6)
					$temp_ans.="0#";
			 if($temp_num7)
					$temp_ans.="0#";

			$temp_ans = substr($temp_ans, 0, -1);   //  �����ҵ�� # �ش������
			echo $temp_ans;		
	} //  if 
	else // 㹡óշ���բ�����Ἱ���Թ�������
	{
		if($temp_num1)
		{	$temp_sql = " SELECT ".$temp_sql1;
			$temp_sql.=" FROM PlanMaster WHERE amccode='".$code_online."' AND Plan_year='".$year."' ";
			$result_loan = query($temp_sql);
			$temp_num =  result($result_loan,0,'sum01');
			$temp_ans.=number_format($temp_num,0,'','')."#";
		}
		if($temp_num2)
		{	$temp_sql = " SELECT ".$temp_sql2;
			$temp_sql.=" FROM PlanMaster WHERE amccode='".$code_online."' AND Plan_year='".$year."' ";
			$result_loan = query($temp_sql);
			$temp_num =  result($result_loan,0,'sum01');
			$temp_ans.=number_format($temp_num,0,'','')."#";
		}
		if($temp_num3)
		{	$temp_sql = " SELECT ".$temp_sql3;
			$temp_sql.=" FROM PlanMaster WHERE amccode='".$code_online."' AND Plan_year='".$year."' ";
			$result_loan = query($temp_sql);
			$temp_num =  result($result_loan,0,'sum01');
			$temp_ans.=number_format($temp_num,0,'','')."#";
		}
		if($temp_num4){	
			if($click=='add')
			{   $temp_ans.="0#";   }
			else{
				$temp_sql = "	SELECT   loan_limit  FROM  ReportGroup5 ";
				$temp_sql.=" WHERE   amccode = '".$code_online."' AND report_year = '".$year."' "; 
				$temp_sql.=" AND report_month = '".$month."' AND (report_detail_code = '4') ";
				$result_loan = query($temp_sql);
				if(num_rows($result_loan)==0){  // 㹡óշ������բ�����
					$temp_ans.="0#";
				}
				else{
					$temp_num =  result($result_loan,0,'loan_limit');
					$temp_ans.=number_format($temp_num,0,'','')."#";
				} // end if 
			} // end if 
	  } // end if 4
		if($temp_num5){	
			if($click=='add')
			{   $temp_ans.="0#";   }
			else{
				$temp_sql = "	SELECT   loan_limit  FROM  ReportGroup5 ";
				$temp_sql.=" WHERE   amccode = '".$code_online."' AND report_year = '".$year."' "; 
				$temp_sql.=" AND report_month = '".$month."' AND (report_detail_code = '5') ";
				$result_loan = query($temp_sql);
				if(num_rows($result_loan)==0){  // 㹡óշ������բ�����
					$temp_ans.="0#";
				}
				else{
					$temp_num =  result($result_loan,0,'loan_limit');
					$temp_ans.=number_format($temp_num,0,'','')."#";
				} // end if 
			} // end if 
	  } // end if 5
		if($temp_num6){	
			if($click=='add')
			{   $temp_ans.="0#";   }
			else{
				$temp_sql = "	SELECT   loan_limit  FROM  ReportGroup5 ";
				$temp_sql.=" WHERE   amccode = '".$code_online."' AND report_year = '".$year."' "; 
				$temp_sql.=" AND report_month = '".$month."' AND (report_detail_code = '6') ";
				$result_loan = query($temp_sql);
				if(num_rows($result_loan)==0){  // 㹡óշ������բ�����
					$temp_ans.="0#";
				}
				else{
					$temp_num =  result($result_loan,0,'loan_limit');
					$temp_ans.=number_format($temp_num,0,'','')."#";
				} // end if 
			} // end if 
	  } // end if 6
		if($temp_num7){	
			if($click=='add')
			{   $temp_ans.="0#";   }
			else{
				$temp_sql = "	SELECT   loan_limit  FROM  ReportGroup5 ";
				$temp_sql.=" WHERE   amccode = '".$code_online."' AND report_year = '".$year."' "; 
				$temp_sql.=" AND report_month = '".$month."' AND (report_detail_code = '7') ";
				$result_loan = query($temp_sql);
				if(num_rows($result_loan)==0){  // 㹡óշ������բ�����
					$temp_ans.="0#";
				}
				else{
					$temp_num =  result($result_loan,0,'loan_limit');
					$temp_ans.=number_format($temp_num,0,'','')."#";
				} // end if 
			} // end if 
	  } // end if 7
			$temp_ans = substr($temp_ans, 0, -1);   //  �����ҵ�� # �ش������   
			echo $temp_ans;	
	} // end if 
	free_result($result_loan);
	close();
?>