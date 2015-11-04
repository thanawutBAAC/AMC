<?php session_start();
  include("../../check_login.php");
  include("../../lib/config.inc.php");
  include("../class_ann.php");
  include("../../lib/database.php");
  connect();
?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../../js/javascript.js"></script>
<script language="JavaScript" src="FusionCharts.js"></script> 
</head>
<body>
<?
	include("../manu_bar.php");
?>
<br>
<?
	// ******************* ��˹���� parameter  ������� **********************
	$epochs = $_GET['epochs'];                                    // �ӹǹ�ͺ㹡�����¹���
	$learn_rate = $_GET['learn_rate'];                          // �ӹǹ��ҵ���ش�ͧ �ѵ�ҡ�����¹���  
	$weight_min = $_GET['weight_min'];                     // ��� weight ����ش�������ö������
	$weight_max = $_GET['weight_max'];                  // ��� weight �٧�ش�������ö�����
	$neuron_hidden = $_GET['neuron_hidden'];     // �ӹǹ neuron 㹪�鹫�͹
	$fn_hidden = $_GET['fn_hidden'];                         // Activation  function 㹪�鹫�͹
	$fn_output = $_GET['fn_output'];                             // Activation  function 㹪�鹼��Ѿ��
	$bias_min = $_GET['bias_min'];                           // ��ҵ���ش�ͧ bias 
	$bias_max = $_GET['bias_max'];                         // ����٧�ش�ͧ bias
	$error_threshold = $_GET['error_threshold'];    // ��� error ����ش�������Ѻ�� 
	$year_start = $_GET['year_start'];							// �շ����������繪ش Train
	$year_stop = $_GET['year_stop'];							// ���ش�������繪ش Train
	$month_start = $_GET['month_start'];						// ��͹�����������繪ش Train
	$month_stop = $_GET['month_stop'];					// ��͹�ش�������繪ش Train
	$p = $_GET['p'];																// �ż�Ե�ͧ�Թ��ҷ���ͧ��äӹǳ ��� P = 1 ���� 2 ����⾴ 3 �ѹ� 4  ���� 5 �ҧ 
	// ***********************************************************************
	/*
	$m = 0;
	for($p=1;$m=3;$x++)
	{
		$m++;
		if($m==1)
		{	$neuron_hidden = 5;  }
		elseif($m==2)
		{	$neuron_hidden = 8; }
		elseif($m==3)
		{	$neuron_hidden = 11;    }
	*/
	$xml_category = "";   // ���ҧ�ش������ xml �������ҧ ��ҿ
	$xml_dataset = "";     // ���ҧ�ش������ xml �������ҧ ��ҿ
	$xml_error = "";          // ���ҧ�ش������ xml �������ҧ ��ҿ
	$weightsH_result = array();		// ��� weight  hidden ���ӹǳ�����ش
	$weightsO_result = array();		// ��� weight  output  ���ӹǳ�����ش
	$biasH_result = array();			  // ��� bias  hidden ���ӹǳ�����ش
	$biasO_result = array();			  // ��� bias  output  ���ӹǳ�����ش
	$total_rows_result = 0;					// �ӹǹ���駷�����¹������ش����
	$mse_min = 10;			// �纤�ҷ�� error ���·���ش
	$num_rows = 0;            // ��ǹѺ�ӹǹ�ͺ����ͧ���¹��� 
	$total_rows = 1;			 // �ӹǹ�ͺ �������º��º�Ѻ��� epochs
	$sum_error = 0;           // ������������Դ��Ҵ������
	$temp_div_epochs = $epochs/20;   // ��ҵ�� label �������ʴ�㹡�ҿ
	// ��˹���� weight ��Ẻ array   �������¡�� �ѧ����㹡��������ҹ��˹ѡ  
	$weightsH = array();    // ��� Hidden
	$weightsO = array();    // ��� Output
	 initWeights();

	// ��˹���� bias ��Ẻ array �������¡�� �ѧ����㹡��������ҹ��˹ѡ  
	$biasH = array();    // ��� Hidden
	$biasO = array();    // ��� Output
	 initBias();
		
	$hiddenVal = array();  // �纤�Ң����ŷ����ҡ��鹫�͹  Hidden
	$outputVal = 0;              // �纤�Ң����ŷ����ҡ��鹼��Ѿ��  Output

	$product_list = array("1"=>'����',"2"=>'����⾴',"3"=>'�ѹ�ӻ���ѧ',"4"=>'����',"5"=>'�ҧ����');
	$function_list = array("1"=>' Log-Sigmoid',"2"=>'Tan-Sigmoid',"3"=>'Linear');
	$month_list = array("1"=>'����¹',"2"=>'����Ҥ�',"3"=>'�Զع�¹',"4"=>'�á�Ҥ�',"5"=>'�ԧ�Ҥ�',"6"=>'�ѹ��¹',"7"=>'���Ҥ�',"8"=>'��Ȩԡ�¹',"9"=>'�ѹ�Ҥ�',"10"=>'���Ҥ�',"11"=>'����Ҿѹ��',"12"=>'�չҤ�');

	//  ������鹡�кǹ��� ����Ҥ�� MAX , MIN �ͧ���������м�Ե�ѳ�� ���ͷӡ�� Normalization
	$sql =" SELECT max(AnnSkt.skt_branch) AS max_branch, max(AnnSkt.skt_member) AS max_member, max(AnnSkt.skt_baac) AS max_baac,  max(AnnSkt.skt_shop) AS max_shop, max(AnnSkt.skt_share) AS max_share, max(AnnProduction.Planted) AS max_planted, max(AnnProduction.Harvested) AS max_harvested, max(AnnProduction.Production) AS max_production, max(AnnProduction.Yield) AS max_yield, max(AnnProduction.Farm_price) AS max_price, ";
	$sql.=" min(AnnSkt.skt_branch) AS min_branch, min(AnnSkt.skt_member) AS min_member, min(AnnSkt.skt_baac) AS min_baac, min(AnnSkt.skt_shop) AS min_shop, min(AnnSkt.skt_share) AS min_share, min(AnnProduction.Planted) AS min_planted, min(AnnProduction.Harvested) AS min_harvested, min(AnnProduction.Production) AS min_production, min(AnnProduction.Yield) AS min_yield, min(AnnProduction.Farm_price) AS min_price, ";
	if($p==1){	
		$sql.=" max(AnnWorks.rice_plan) AS max_plan, max(AnnWorks.rice_value)AS max_value, ";
		$sql.=" min(AnnWorks.rice_plan) AS min_plan, min(AnnWorks.rice_value)AS min_value ";
	}
	elseif($p==2){
		$sql.=" max(AnnWorks.maize_plan)AS max_plan, max(AnnWorks.maize_value) AS max_value, ";
		$sql.=" min(AnnWorks.maize_plan)AS min_plan, min(AnnWorks.maize_value) AS min_value ";
	}
	elseif($p==3){
		$sql.=" max(AnnWorks.cassava_plan)AS max_plan, max(AnnWorks.cassava_value) AS max_value, ";
		$sql.=" min(AnnWorks.cassava_plan)AS min_plan, min(AnnWorks.cassava_value) AS min_value ";
	}
	elseif($p==4){
		$sql.=" max(AnnWorks.sugarcane_plan)AS max_plan, max(AnnWorks.sugarcane_value) AS max_value, ";
		$sql.=" min(AnnWorks.sugarcane_plan)AS min_plan, min(AnnWorks.sugarcane_value) AS min_value ";
	}
	elseif($p==5){
		$sql.=" max(AnnWorks.para_plan)AS max_plan, max(AnnWorks.para_value)AS max_value, ";
		$sql.=" min(AnnWorks.para_plan)AS min_plan, min(AnnWorks.para_value)AS min_value ";
	}
	$sql.=" FROM AnnProduction, AnnSkt, AnnWorks ";
	$sql.=" WHERE AnnProduction.Product_code='".$p."' ";
	$sql.=" AND AnnSkt.skt_year = AnnProduction.Product_year ";
	$sql.=" AND AnnWorks.works_year = AnnSkt.skt_year ";
	$sql.=" AND AnnWorks.works_month = AnnSkt.skt_month ";
	$sql.=" AND (AnnSkt.skt_year >='".$year_start."' AND AnnSkt.skt_year <='".$year_stop."') ";
	$sql.=" AND (AnnSkt.skt_month_list >='".$month_start."' AND AnnSkt.skt_month_list <='".$month_stop."') ";
	$sql.=" AND (AnnProduction.Product_year >= '".$year_start."' AND AnnProduction.Product_year <= '".$year_stop."') ";
	$sql.=" AND (AnnWorks.works_year >='".$year_start."' AND AnnWorks.works_year <='".$year_stop."') ";
	$sql.=" AND (AnnWorks.works_month_list >='".$month_start."' AND AnnWorks.works_month_list <='".$month_stop."') ";

	$result_maxmin =  query($sql);
	$temp_max = array();  // �纤���ҡ����ش�ͧ�Ѩ������ max
	$temp_min = array();   // �纤�ҹ��·���ش�ͧ�Ѩ������ min
	$temp_max[0] =	number_format(result($result_maxmin,0,"max_branch"),0,'','');
	$temp_max[1] =	number_format(result($result_maxmin,0,"max_member"),0,'','');
	$temp_max[2] =	number_format(result($result_maxmin,0,"max_baac"),0,'','');
	$temp_max[3] =	number_format(result($result_maxmin,0,"max_shop"),0,'','');
	$temp_max[4] =	number_format(result($result_maxmin,0,"max_share"),0,'','');
	$temp_max[5] =	number_format(result($result_maxmin,0,"max_planted"),0,'','');
	$temp_max[6] =	number_format(result($result_maxmin,0,"max_harvested"),0,'','');
	$temp_max[7] =	number_format(result($result_maxmin,0,"max_production"),0,'','');
	$temp_max[8] =	number_format(result($result_maxmin,0,"max_yield"),0,'','');
	$temp_max[9] =	number_format(result($result_maxmin,0,"max_price"),0,'','');
	$temp_max[10] = number_format(result($result_maxmin,0,"max_plan"),0,'','');
	$temp_max[11] = 12;
	$temp_max[12] = number_format(result($result_maxmin,0,"max_value"),0,'','');   // ���������·���ͧ������º��º
	$temp_min[0] =	number_format(result($result_maxmin,0,"min_branch"),0,'','');
	$temp_min[1] =	number_format(result($result_maxmin,0,"min_member"),0,'','');
	$temp_min[2] =	number_format(result($result_maxmin,0,"min_baac"),0,'','');
	$temp_min[3] =	number_format(result($result_maxmin,0,"min_shop"),0,'','');
	$temp_min[4] =	number_format(result($result_maxmin,0,"min_share"),0,'','');
	$temp_min[5]=	number_format(result($result_maxmin,0,"min_planted"),0,'','');
	$temp_min[6] =	number_format(result($result_maxmin,0,"min_harvested"),0,'','');
	$temp_min[7] =	number_format(result($result_maxmin,0,"min_production"),0,'','');
	$temp_min[8] =	number_format(result($result_maxmin,0,"min_yield"),0,'','');
	$temp_min[9] =	number_format(result($result_maxmin,0,"min_price"),0,'','');
	$temp_min[10] =  number_format(result($result_maxmin,0,"min_plan"),0,'','');
	$temp_min[11] = 1;
	$temp_min[12] =  number_format(result($result_maxmin,0,"min_value"),0,'','');   // ���������·���ͧ������º��º
	free_result($result_maxmin);			// �׹��Ң�����
	// ******************* ����ش����Ҥ�� min max ******************************************************

	// �ʴ������� Input ����繻Ѩ��·���������л������ż�Ե�������ҧ������㹡�� train �ç����
	$sql = " SELECT AnnSkt.skt_branch, AnnSkt.skt_member, AnnSkt.skt_baac , ";
	$sql.=" AnnSkt.skt_shop, AnnSkt.skt_share, AnnProduction.Planted, ";
	$sql.=" AnnProduction.Harvested, AnnProduction.Production, AnnProduction.Yield, ";
	$sql.=" AnnProduction.Farm_price, ";
	if($p==1)
		$sql.=" AnnWorks.rice_plan AS works_plan, AnnSkt.skt_month_list, AnnWorks.rice_value AS works_value ";
	elseif($p==2)
		$sql.=" AnnWorks.maize_plan AS works_plan, AnnSkt.skt_month_list, AnnWorks.maize_value AS works_value ";
	elseif($p==3)
		$sql.=" AnnWorks.cassava_plan AS works_plan, AnnSkt.skt_month_list, AnnWorks.cassava_value AS works_value ";
	elseif($p==4)
		$sql.=" AnnWorks.sugarcane_plan AS works_plan, AnnSkt.skt_month_list, AnnWorks.sugarcane_value AS works_value ";
	elseif($p==5)
		$sql.=" AnnWorks.para_plan AS works_plan, AnnSkt.skt_month_list, AnnWorks.para_value AS works_value ";
	$sql.=" , AnnSkt.skt_year,  AnnSkt.skt_month ";
	$sql.=" FROM AnnProduction, AnnSkt, AnnWorks ";
	$sql.=" WHERE AnnProduction.Product_code='".$p."'  ";
	$sql.=" AND AnnSkt.skt_year = AnnProduction.Product_year ";
	$sql.=" AND AnnWorks.works_year = AnnSkt.skt_year ";
	$sql.=" AND AnnWorks.works_month = AnnSkt.skt_month ";
	$sql.=" AND (AnnSkt.skt_year >='".$year_start."' AND AnnSkt.skt_year <='".$year_stop."') ";
	$sql.=" AND (AnnSkt.skt_month_list >='".$month_start."' AND AnnSkt.skt_month_list <='".$month_stop."') ";
	$sql.=" AND (AnnProduction.Product_year >= '".$year_start."' AND AnnProduction.Product_year <= '".$year_stop."') ";
	$sql.=" AND (AnnWorks.works_year >='".$year_start."' AND AnnWorks.works_year <='".$year_stop."') ";
	$sql.=" AND (AnnWorks.works_month_list >='".$month_start."' AND AnnWorks.works_month_list <='".$month_stop."') ";
	$sql.=" ORDER BY AnnSkt.skt_year, AnnSkt.skt_month_list  ";
	
	$result_report =	query($sql);
	WHILE($fetch_report = fetch_row($result_report)) {
	// ��кǹ��÷��  1 �����żŢ�����㹪�鹫�͹  Hidden  
	for($i=0;$i<$neuron_hidden;$i++){
		$temp_hidden = 0;
		$temp_num = 0;
		for($j=0;$j<=11;$j++){
			// �ӡ���ŧ��ҵ���Ţ����繾ԡѹ���ǡѹ �� 0 - 1
			if($temp_max[$j]==$temp_min[$j])
					$temp_div = 1;
			else
					$temp_div = $temp_max[$j]-$temp_min[$j];
			$temp_num =	(number_format($fetch_report[$j],0,'','')-$temp_min[$j])/$temp_div;  
			$temp_hidden = $temp_hidden + ($temp_num * $weightsH[$j][$i]);   // �Ӥ�ҷ������ �ٳ �Ѻ weight 
		}
		//  ��ҷ��ӹǳ��������Һǡ�Ѻ��� ����㹪�鹫�͹ Hidden
		$temp_num =	$temp_hidden + $biasH[$i];
		// �Ӥ�ҷ���������� Activation Function
		if($fn_hidden==1)
			$hiddenVal[$i] =log_sigmoid($temp_num);
		elseif($fn_hidden==2)
			$hiddenVal[$i]= tan_sigmoid($temp_num);
		elseif($fn_hidden==3)
			$hiddenVal[$i] = linear($temp_num);
	}  // end for 
	// ����ش��û����ż�㹪�� Hidden 

	// ��кǹ��÷�� 2   �����ż�㹪�� Output  ���� 1 Neuron����ͧ���
	$outputVal = 0;
	$temp_num = 0;
	for($i=0;$i<$neuron_hidden;$i++){
		$temp_num = $temp_num + ($hiddenVal[$i]*$weightsO[$i]);
	}
	//  ��ҷ��ӹǳ��������Һǡ�Ѻ��� ����㹪�鹼��Ѿ�� Output
	$temp_num = $temp_num + $biasO[0];
	// �Ӥ�ҷ���������� Activation Function
	if($fn_output==1)
		$outputVal =log_sigmoid($temp_num);
	elseif($fn_output==2)
		$outputVal= tan_sigmoid($temp_num);
	elseif($fn_output==3)
		$outputVal = linear($temp_num);
	// ����ش��û����ż�㹪�� output 

 // ��кǹ��÷�� 3  ��Ǩ�ͺ��ҷ������ż���Ѻ������·���ͧ��� 
 	$temp_num = 0;
	$temp_num =	(number_format($fetch_report[12],0,'','')-$temp_min[12])/($temp_max[12]-$temp_min[12]);   // �ӡ���ŧ��ҵ���Ţ���Ѿ������繾ԡѴ���ǡѹ 

	$temp_error = $temp_num - $outputVal;  // �ӹǳ��Ҥ����Դ��Ҵ�����   e = t - a 

// ��кǹ��÷�� 4.1   ��Ѻ��ҹ��˹ѡ���������͹��Ѻ�ҡ��� output 
// �ӹǳ��Ҥ����Ҵ�ѹ�ͧ��ҼԴ��Ҵ 
	if($fn_output==1)
		$g2 = (1-$outputVal) * $outputVal;
	elseif($fn_output==2)
		$g2 = 1-pow($outputVal,2);   // ¡���ѧ 2 
	elseif($fn_output==3)
		$g2 = 1;

	$g2 = -2 * ($g2* $temp_error);    // ��Ҥ����Ҵ���㹪���ش����  g = -2 (F2N2) e1
	// �ӹǳ��û�Ѻ��ҹ��˹ѡ��� output 
	for($i=0;$i<$neuron_hidden;$i++){
		 $weightsO[$i] = $weightsO[$i] - ($learn_rate*$g2*$hiddenVal[$i]);
	}
	// �ӹǳ��û�Ѻ������ʪ�� output 
	$biasO[0] = $biasO[0]-($learn_rate*$g2);

// ��кǹ��÷�� 4.2 ��Ѻ��ҹ��˹ѡ���������͹��Ѻ�ҡ��� hidden 
	$g1 = array();   // ��Ҥ����Ҵ���㹪���á
	// ��û�Ѻ��Ҥ����Ҵ���㹪�鹫�͹
	for($i=0;$i<$neuron_hidden;$i++)	{	
		if($fn_hidden==1)
			$g1[$i] = (1-$hiddenVal[$i] ) * $hiddenVal[$i];
		elseif($fn_hidden==2)
			$g1[$i] = 1-pow($hiddevVal[$i],2);   // ¡���ѧ 2 
		elseif($fn_hidden==3)
			$g1[$i] = 1;

		$g1[$i] =  ($g1[$i]*$weightsO[$i])*$g2;
	}  // end for g1

	//  ��û�Ѻ���˹ѡ�ٵ� W1 = W1-n g1*input
	for($i = 0;$i<$neuron_hidden;$i++){
		for($j = 0;$j<=11;$j++){
			if($temp_max[$j]==$temp_min[$j])
					$temp_div = 1;
			else
					$temp_div = $temp_max[$j]-$temp_min[$j];
			 $temp_report =  (number_format($fetch_report[$j],0,'','')-$temp_min[$j])/$temp_div;  // ��Ѻ��Ң����ŷ�� input ���������繾ԡѴ���ǡѹ
			 $weightsH[$j][$i] = $weightsH[$j][$i] - (($learn_rate*$g1[$i]) * $temp_report);
		 }
	}  // end for 
	// ��û�Ѻ�������  b1 = b1 -ng1
	for($i=0;$i<$neuron_hidden;$i++){	
		 $biasH[$i]  =  $biasH[$i] - ($learn_rate*$g1[$i]);
	}
	
	$num_rows++;   // �����ӴѺ�ͧ�ش������
	// 㹡óշ�����¹�������Ťú��駪ش�������ӡ�äӹǳ�Ҽŷ���� 
	if(num_rows($result_report)==$num_rows)
	{
		 $mse =  (1/$num_rows) * $sum_error;     // �ӹǳ�Ҥ�� MSE		
		if((($total_rows%10)==0) OR ($total_rows==1))
		{
			$temp_mse = number_format($mse,4,'.','');     // �Ѵ�ٻẺ�ȹ�������Թ 4 ���
			if(($total_rows%$temp_div_epochs)==0 OR ($total_rows==1) )
				$xml_category.="<category label='".$total_rows."'/>";
			else
				$xml_category.="<category label=''/>";
			$xml_dataset.="<set value='".$temp_mse."'/>";
			$xml_error.="<set value='".$error_threshold."'/>";
		}  // end if % 10
		// ��Ǩ�ͺ�Ҥ�ҷ���� mse �����·���ش
		if($mse<$mse_min){
			$mse_min = $mse;
			for($i=0;$i<$neuron_hidden;$i++){
				for($j=0;$j<=11;$j++){
					$weightsH_result[$j][$i]=$weightsH[$j][$i];
				}
			}  // end for
			for($i=0;$i<$neuron_hidden;$i++){
					$weightsO_result[$i] = $weightsO[$i];
					$biasH_result[$i] =$biasH[$i];
			}
			$biasO_result[0] = $biasO[0];
			$total_rows_result = $total_rows;  // �ӹǹ�ͺ����ش�����
		}  // end if mse  ��äӹǳ����ҷ��շ���ش

		 if(($mse_min>$error_threshold) && ($total_rows<$epochs)){    // 㹡óշ���� mse �ҡ���ҷ������� ��Шӹǹ�ͺ���¡��ҷ������������������¹�������
			 $total_rows++;     // ��ǹѺ�ӹǹ���駷�����¹���ش������
			 $num_rows = 0;   // �ӴѺ�ͧ�ش������
			 $sum_error = 0;   // ��� error ��������� 
			 data_seek($result_report);    // ���������¹��������ա���� 
			}
		elseif(($mse_min<=$error_threshold) && ($total_rows>=$epochs)){
		// 㹡óշ���Ҥ����Դ��Ҵ���¡��Ҥ�ҷ������� ��� ��ǹѺ�ͺ total �ҡ���� epochs ������騺��÷ӧҹ
			break;
		 }
	}   // end if  num_rows

		$temp_error =  pow(abs($temp_error),2); 
		$sum_error = $sum_error + $temp_error;   // �ӹǳ��ҼԴ��Ҵ�������   
	}  // end while 

	// ��ѧ�ҡ������ҷ���������  ��仺ѹ�֡���㹰ҹ������  
	update_data($weightsH_result,$weightsO_result,$biasH_result,$biasO_result ,$total_rows_result,$mse_min);		

$xml = "<chart caption=' Feedforword Multilayer Perceptron ' showValues='0' rotateLabels='1' slantLabels='1' anchorAlpha='0' formatNumberScale='1' toolTipSepChar=': '><categories>".$xml_category."</categories><dataset seriesname='MSE' >".$xml_dataset."</dataset><dataset seriesname='Error Threshold' >".$xml_error."</dataset></chart>";  // ��˹�������ͷ������ҧ ��ҿ

$file = fopen( "Logarithmic.xml","w+");
	fputs($file,$xml);
fclose($file);

?>
<table width="98%" border="0" cellspacing="0" cellpadding="3" align="center"> 
  <tr> 
    <td valign="top" class="text" align="center"> <div id="chartdiv" align="center"> 
        Feedforword Multilayer Perceptron </div> 
      <script type="text/javascript"> 
		   var chart = new FusionCharts("LogMSLine.swf", "ChartId", "550", "350", "0", "0");
		   chart.setDataURL("Logarithmic.xml");		   
		   chart.render("chartdiv");
		</script> </td> 
  </tr> 
  <tr> 
    <td valign="top" class="text" align="center">&nbsp;</td> 
  </tr>  
</table> 
<!--  �ʴ������Ť�ҷ����������������º��º��Ҽŧҹ��ԧ�Ѻ��Ҿ�ҡó�  -->
<table class='gridtable' width='98%' style='margin-top:5px; margin-left:5px; margin-right:5px;'>
<tr class='rows_pink' align='center'>
	<td> �ӴѺ </td>
	<td> ������ </td>
	<td> Function Hidden</td>
	<td> Function Output </td>
	<td> ��� MSE ��ӷ���ش </td>
	<td> �ͺ���շ���ش </td>
	<td> ��ǧ������㹡�� Train  </td>
</tr>
<?
	$sql = " SELECT Product_code,Fn_Hidden,Hidden_Neuron,Fn_Output,MSE,Total_rows , ";
	$sql.=" Data_Trianing_start,Data_Trianing_stop FROM  AnnPerceptron ";
	$sql.=" ORDER BY Product_code ";
	$result_train = query($sql);
	$i = 0;
	WHILE($fetch_train = fetch_row($result_train)) { 
		$i++;						
		if(($i%2)==0) { ?>
			<tr class='rows_grey'>
		<? } else  { ?>
			<tr>
		<? } // end if  
			$date_start = explode("@",$fetch_train[6]);
			$date_stop = explode("@",$fetch_train[7]);
		?>
		<td align='center'><?=$i ?></td>
		<td align='left'>&nbsp;<?=$product_list[trim($fetch_train[0])] ?></td>
		<td align='center'><?=$function_list[trim($fetch_train[1])]."&nbsp;<font color='red'>[".trim($fetch_train[2])."]</font>" ?></td>
		<td align='center'><?=$function_list[trim($fetch_train[3])] ?></td>
		<td align='right'><?=$fetch_train[4] ?>&nbsp;</td>
		<td align='right'><?=number_format($fetch_train[5],0,'',',') ?>&nbsp;</td>
		<td align='center'><?=$month_list[$date_start[0]]." ".$date_start[1]  ?>-<?=$month_list[$date_stop[0]]." ".$date_stop[1]  ?></td>
	</tr>
<?	} // end while  ?>
</table>
<br>
<hr width="95%" style=" border: 1px solid #E6E6FA;">
<table width="600" align="center" class="gridtable" style="margin:10 15 10 15 px;">
	<tr height='25px' class='rows_brown'>
		<td colspan="4"align="left">&nbsp;<b>�����żš�ô��Թ�ҹ��ԧ���º��º�ž�ҡó� ( ੾�мż�Ե��ѡ ) �� <?=$year_start ?> - �� <?=$year_stop?> </b></td>
	</tr>
	<tr>
		<td align="center" width="140" rowspan='2' class='rows_pink'> ��͹ </td>
		<td align="center" colspan='3' class='rows_purple'><center><strong><?=trim($product_list[$p])?></strong></center></td>
	</tr>
	<tr class="rows_pink">
		<td align="center" width="120">�ŧҹ��ԧ</td>
		<td align="center" width="120">��ҡó�</td>
		<td align="center" width="120">error</td>
	</tr>
<?
// ***************************************************************************************************************************
// ��Ѻ��ا�����šѺ��Ҿ�ҡó�����ҡ�к� �ʴ������ŷ����ҡ������¹�������� 
$sum_present = 0;        // �纤�Ҥ�����Ҵ����͹������
$x = 0;                               // ��Ѻ��㹵��ҧ����ʴ�
data_seek($result_report);    // ���������¹��������ա���� 
$num_rows = 0;      // �纨ӹǹ�Ѻ�ӹǳ��� mse
$sum_error = 0;
  WHILE($fetch_report = fetch_row($result_report)) {
	// ��кǹ��÷��  1   �����żŢ�����㹪�鹫�͹  Hidden  
	for($i=0;$i<$neuron_hidden;$i++){
		$temp_hidden = 0;
		$temp_num = 0;
		for($j=0;$j<=11;$j++){
			// �ӡ���ŧ��ҵ���Ţ����繾ԡѹ���ǡѹ �� 0 - 1
			if($temp_max[$j]==$temp_min[$j])
					$temp_div = 1;
			else
					$temp_div = $temp_max[$j]-$temp_min[$j];
			$temp_num =	(number_format($fetch_report[$j],0,'','')-$temp_min[$j])/$temp_div;  
			$temp_hidden = $temp_hidden + ($temp_num * $weightsH_result[$j][$i]);   // �Ӥ�ҷ������ �ٳ �Ѻ weight 
		}  // end for
	
		//  ��ҷ��ӹǳ��������Һǡ�Ѻ��� ����㹪�鹫�͹ Hidden
		$temp_num =	$temp_hidden + $biasH_result[$i];
		// �Ӥ�ҷ���������� Activation Function
		if($fn_hidden==1)
			$hiddenVal[$i] =log_sigmoid($temp_num);
		elseif($fn_hidden==2)
			$hiddenVal[$i]= tan_sigmoid($temp_num);
		elseif($fn_hidden==3)
			$hiddenVal[$i] = linear($temp_num);
	}  // end for
	// ����ش��û����ż�㹪�� Hidden 

	// ��кǹ��÷�� 2   �����ż�㹪�� Output  ���� 1 Neuron����ͧ���
		$outputVal = 0;
		$temp_num = 0;
		for($i=0;$i<$neuron_hidden;$i++){
			$temp_num = $temp_num + ($hiddenVal[$i]*$weightsO_result[$i]);
		}  // end for

		//  ��ҷ��ӹǳ��������Һǡ�Ѻ��� ����㹪�鹼��Ѿ�� Output
		$temp_num =  number_format($temp_num+$biasO_result[0],12,'.','');

		// �Ӥ�ҷ���������� Activation Function
		if($fn_output==1)
			$outputVal =log_sigmoid($temp_num);
		elseif($fn_output==2)
			$outputVal= tan_sigmoid($temp_num);
		elseif($fn_output==3)
			$outputVal = linear($temp_num);
		// ����ش��û����ż�㹪�� output 
		 // ��кǹ��÷�� 3   Denormalization   new = old * (max - min) + min
		$temp_new =	abs($outputVal) *($temp_max[12]-$temp_min[12])+$temp_min[12];	
		$temp_new = number_format($temp_new,2,'.','');

		// ��кǹ��÷�� 4 �纤�� MSE
		if($temp_max[12]==$temp_min[12])
			$temp_div = 1;
		else
			$temp_div = $temp_max[$j]-$temp_min[$j];
		$temp_num =	(number_format($fetch_report[12],0,'','')-$temp_min[12])/$temp_div;   // �ӡ���ŧ��ҵ���Ţ���Ѿ������繾ԡѴ���ǡѹ 
		$temp_error = $temp_num - $outputVal;  // �ӹǳ��Ҥ����Դ��Ҵ�����   e = t - a 
		$temp_error =  pow(abs($temp_error),2); 
		$sum_error = $sum_error + $temp_error;   // �ӹǳ��ҼԴ��Ҵ�������   

		if($p==1){
			$sql = " UPDATE AnnWorks SET rice_predic=".$temp_new." WHERE works_year ='".trim($fetch_report[13])."' AND works_month ='".trim($fetch_report[14])."' ";
		}
		elseif($p==2){
			$sql = " UPDATE AnnWorks SET maize_predic=".$temp_new."  WHERE works_year ='".trim($fetch_report[13])."' AND works_month ='".trim($fetch_report[14])."' ";
		}
		elseif($p==3){
			$sql = " UPDATE AnnWorks SET cassava_predic=".$temp_new."  WHERE works_year ='".trim($fetch_report[13])."' AND works_month ='".trim($fetch_report[14])."' ";
		}
		elseif($p==4){
			$sql = " UPDATE AnnWorks SET sugarcane_predic=".$temp_new."  WHERE works_year ='".trim($fetch_report[13])."' AND works_month ='".trim($fetch_report[14])."' ";
		}
		elseif($p==5){
			$sql = " UPDATE AnnWorks SET para_predic=".$temp_new."  WHERE works_year ='".trim($fetch_report[13])."' AND works_month ='".trim($fetch_report[14])."' ";
		}
		 query($sql);  // ��Ѻ��ا������ ��Ҿ�ҡó� �����ҡ�ç����
		//*************************** ������ʴ���Ң����ŷ����ҡ��þ�ҡó�㹪ش�����ŷ��ͺ  ***************************
		$x++;						
		if(($x%2)==0) { ?>
			<tr class='rows_grey'>
		<? } else  { ?>
			<tr>
		<? } // end if  ?>
			<td align="center"><?=$month_list[trim($fetch_report[11])]?> - <?=$fetch_report[13]?></td>
			<td align="right"><?=number_format($fetch_report[12],2,'.',',')?>&nbsp;</td>
			<td align="right"><?=number_format($temp_new,2,'.',',')?>&nbsp;</td>
			<?
				$temp_num =	abs(($temp_new-$fetch_report[12])/$fetch_report[12]);
				$sum_present = $sum_present + $temp_num;
			?>
			<td align='center'><?=number_format($temp_num,2,'.','') ?></td>
		</tr>
<?	
		//********* ����ش����ʴ���Ң����ŷ����ҡ��þ�ҡó�㹪ش�����ŷ��ͺ  ***************************
		$num_rows++;
	   }  // end while  
			$mse =  (1/$num_rows) * $sum_error;     // �ӹǳ�Ҥ�� MSE
	 ?>
		<tr height='27px'>
			<td align="center" colspan='3' class='rows_pink'><strong> �����żŤ������·����� </strong></td>
			<td align='center'><?=number_format($sum_present/$num_rows,2,'.','') ?></td>
		</tr>
		<tr height='27px'>
			<td align="center" colspan='3' class='rows_pink'><strong> �����żŤ�� MSE </strong></td>
			<td align='center'><?=number_format($mse,6,'.','') ?></td>
		</tr>
</table>
</body>
</html>
<?
	close();
	include("../footer.php")
?>