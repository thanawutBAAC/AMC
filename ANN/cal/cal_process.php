<?php session_start();
  include("../../check_login.php");
  include("../../lib/config.inc.php");
  include("../class_ann.php");
  include("../../lib/database.php");
  connect();

$month_list = array("1"=>'����¹',"2"=>'����Ҥ�',"3"=>'�Զع�¹',"4"=>'�á�Ҥ�',"5"=>'�ԧ�Ҥ�',"6"=>'�ѹ��¹',"7"=>'���Ҥ�',"8"=>'��Ȩԡ�¹',"9"=>'�ѹ�Ҥ�',"10"=>'���Ҥ�',"11"=>'����Ҿѹ��',"12"=>'�չҤ�');
$month_eng_list = array("1"=>'Apr',"2"=>'May',"3"=>'Jun',"4"=>'Jul',"5"=>'Aug',"6"=>'Sep',"7"=>'Oct',"8"=>'Nov',"9"=>'Dec',"10"=>'Jan',"11"=>'Feb',"12"=>'Mar');

$product_list = array("1"=>'����',"2"=>'����⾴',"3"=>'�ѹ�ӻ���ѧ',"4"=>'����',"5"=>'�ҧ����');

?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../../js/javascript.js"></script>
</head>
<body>
<?
	include("../manu_bar.php");
?>
<br>
<?
	// ******************* ��˹���� parameter  ������� **********************
	$year_start = $_POST['year_start'];             // �շ����������繪ش Train
	$year_stop = $_POST['year_stop'];            // ���ش�������繪ش Train
	$month_start = $_POST['month_start'];       // ��͹�����������繪ش Train
	$month_stop = $_POST['month_stop'];      // ��͹�ش�������繪ش Train
	$p = $_POST['p'];													// �ż�Ե�ͧ�Թ��ҷ���ͧ��äӹǳ
	$xml1 = "";
	$xml2 = "";
	$xml3 = "";

// ������ӹǳ������¹������ӴѺ ���ӹǳ������ 5 ��ǵ���ż�Ե��������͡�ҷ����� 1 ���� 2 ����⾴ 3 �ѹ� 4  ���� 5 �ҧ 
	$weightsH = array();    // ��� Hidden
	$weightsO = array();    // ��� Output
	$biasH = array();    // ��� Hidden
	$biasO = array();    // ��� Output

	// �ʴ������ŷ����ҡ������¹�������� 
	$sql = " SELECT  Fn_Output,Fn_Hidden,Hidden_Neuron,Weight_Hidden, Weight_Output, Data_Trianing_start, Data_Trianing_stop, ";
	$sql.=" Bias_Hidden,Bias_Output , MSE  FROM AnnPerceptron WHERE Product_code = '".$p."' AND Status='1' ";
	$result_perceptron = query($sql);

	$fn_output =	trim(result($result_perceptron,0,"Fn_Output"));   // function output
	$fn_hidden = trim(result($result_perceptron,0,"Fn_Hidden"));   // function hidden
	$neuron_hidden =	number_format(result($result_perceptron,0,"Hidden_Neuron"),0,'','');   // �ӹǳ neuron 㹪�鹫�͹
	$temp_biasH =	trim(result($result_perceptron,0,"Bias_Hidden"));
	$temp_biasO =	trim(result($result_perceptron,0,"Bias_Output"));
	$temp_weightH =	trim(result($result_perceptron,0,"Weight_Hidden"));
	$temp_weightO =	trim(result($result_perceptron,0,"Weight_Output"));
	$temp_train_start = trim(result($result_perceptron,0,"Data_Trianing_start"));
	$temp_train_stop = trim(result($result_perceptron,0,"Data_Trianing_stop"));
	$temp_mse = trim(result($result_perceptron,0,"MSE"));

	// ���ҧ��� weight 
	$temp_array = explode("@", $temp_weightH);
	for($i=0;$i<count($temp_array);$i++)
	{
		$temp_array2 = explode("#",$temp_array[$i]);
		for($j=0;$j<count($temp_array2);$j++)
		{
			$weightsH[$j][$i] = $temp_array2[$j];
		}
	}  // end for 
	
	$weightsO = explode("#", $temp_weightO);
	// ���ҧ��� bias 
	$biasH = explode("#", $temp_biasH);
	$biasO[0] = $temp_biasO;

	$outputVal = 0;              // �纤�Ң����ŷ����ҡ��鹼��Ѿ��  Output

	//  ������鹡�кǹ��� ����Ҥ�� MAX , MIN �ͧ���������м�Ե�ѳ�� ���ͷӡ�� Normalization
	$temp_date_start = 	explode("@", $temp_train_start);
	$temp_date_stop = 	explode("@", $temp_train_stop);

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
	$sql.=" WHERE AnnProduction.Product_code='".$p."'  ";
	$sql.=" AND AnnSkt.skt_year = AnnProduction.Product_year ";
	$sql.=" AND AnnWorks.works_year = AnnSkt.skt_year ";
	$sql.=" AND AnnWorks.works_month = AnnSkt.skt_month ";
	$sql.=" AND (AnnSkt.skt_year >='".$temp_date_start[1]."' AND AnnSkt.skt_year <='".$temp_date_stop[1]."') ";
	$sql.=" AND (AnnSkt.skt_month_list >='".$temp_date_start[0]."' AND AnnSkt.skt_month_list <='".$temp_date_stop[0]."') ";
	$sql.=" AND (AnnProduction.Product_year >= '".$temp_date_start[1]."' AND AnnProduction.Product_year <= '".$temp_date_stop[1]."') ";
	$sql.=" AND (AnnWorks.works_year >='".$temp_date_start[1]."' AND AnnWorks.works_year <='".$temp_date_stop[1]."') ";
	$sql.=" AND (AnnWorks.works_month_list >='".$temp_date_start[0]."' AND AnnWorks.works_month_list <='".$temp_date_stop[0]."') ";

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

	// �ʴ������� Input ����繻Ѩ��·���������л������ż�Ե
	$sql = " SELECT AnnSkt.skt_branch, AnnSkt.skt_member, AnnSkt.skt_baac , ";
	$sql.=" AnnSkt.skt_shop, AnnSkt.skt_share, AnnProduction.Planted, ";
	$sql.=" AnnProduction.Harvested, AnnProduction.Production, AnnProduction.Yield, ";
	$sql.=" AnnProduction.Farm_price, ";
	if($p==1)
		$sql.=" AnnWorks.rice_plan AS works_plan,  AnnSkt.skt_month_list,  AnnWorks.rice_value AS works_value ";
	elseif($p==2)
		$sql.=" AnnWorks.maize_plan AS works_plan, AnnSkt.skt_month_list, AnnWorks.maize_value AS works_value ";
	elseif($p==3)
		$sql.=" AnnWorks.cassava_plan AS works_plan, AnnSkt.skt_month_list, AnnWorks.cassava_value AS works_value ";
	elseif($p==4)
		$sql.=" AnnWorks.sugarcane_plan AS works_plan, AnnSkt.skt_month_list, AnnWorks.sugarcane_value AS works_value ";
	elseif($p==5)
		$sql.=" AnnWorks.para_plan AS works_plan, AnnSkt.skt_month_list, AnnWorks.para_value AS works_value ";
	$sql.=" , AnnSkt.skt_year, AnnSkt.skt_month";
	$sql.=" FROM AnnProduction, AnnSkt, AnnWorks ";
	$sql.=" WHERE AnnProduction.Product_code='".$p."'  ";
	$sql.=" AND AnnSkt.skt_year = AnnProduction.Product_year ";
	$sql.=" AND AnnWorks.works_year = AnnSkt.skt_year ";
	$sql.=" AND AnnWorks.works_month = AnnSkt.skt_month ";
	$sql.=" AND (AnnSkt.skt_year >='".$year_start."' AND AnnSkt.skt_year <='".$year_stop."') ";
	$sql.=" AND (AnnSkt.skt_month_list >='".$month_start."' AND AnnSkt.skt_month_list <='".$month_stop."') ";
	$sql.=" AND (AnnProduction.Product_year >='".$year_start."' AND AnnProduction.Product_year <='".$year_stop."') ";
	$sql.=" AND (AnnWorks.works_year >='".$year_start."' AND AnnWorks.works_year <='".$year_stop."') ";
	$sql.=" AND (AnnWorks.works_month_list >='".$month_start."' AND AnnWorks.works_month_list <='".$month_stop."') ";
	$sql.=" ORDER BY AnnSkt.skt_year, AnnSkt.skt_month_list ";

	$result_report =	query($sql);
	WHILE($fetch_report = fetch_row($result_report)) {
		// ��Ǩ�ͺ�Ҥ�� MAX MIN ����
		for($j=0;$j<=11;$j++){
			if($temp_max[$i]<$fetch_report[$i])
				$temp_max[$i] = $fetch_report[$i];
			if($temp_min[$i]>$fetch_report[$i])
				$temp_min[$i] = $fetch_report[$i];
		} // end for
	} // end while 
	
	data_seek($result_report);    // ���������¹��������ա���� 
	$num_rows = 0;
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
			$temp_hidden = $temp_hidden + ($temp_num * $weightsH[$j][$i]);   // �Ӥ�ҷ������ �ٳ �Ѻ weight 
		}  // end for
	
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
		}  // end for

		//  ��ҷ��ӹǳ��������Һǡ�Ѻ��� ����㹪�鹼��Ѿ�� Output
		$temp_num =  number_format($temp_num+$biasO[0],12,'.','');

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

	$xml1.="<category label='".$month_eng_list[$fetch_report[11]]."-".$fetch_report[13]."' />";  // ��͹ �� 
	$xml2.=" <set value='".number_format($fetch_report[12],0,'','')."' /> ";   // ��Ҩ�ԧ
	$xml3.=" <set value='".number_format($temp_new,0,'','')."' /> ";   // ��Ҿ�ҡó�
	$num_rows++;
}  // end while 
	
	//  �ӹǳ��� MSE
	$mse =  (1/$num_rows) * $sum_error;     // �ӹǳ�Ҥ�� MSE		
	$xml = "<chart caption='��þ�ҡó�š���Ǻ���' shownames='1' showvalues='1' decimals='0' numberPrefix='' placeValuesInside='1' rotateValues='1' formatNumberScale='0'> ";
	$xml.=" <categories>".$xml1."</categories> ";
	$xml.=" <dataset seriesName='Actuals' color='AFD8F8' >".$xml2."</dataset> ";
	$xml.=" <dataset seriesName='Predicted' color='F6BD0F'>".$xml3."</dataset> ";
	$xml.=" </chart> ";
	$file = fopen( "Col2D2.xml","w+");
		fputs($file,$xml);
	fclose($file);
?>
<!--  ������鹡���ʴ���ҿ -->
<center>
<script language="JavaScript" src="../../js/FusionCharts.js"></script> 
<div id="chart1div"> 
	  <p>&nbsp;</p> 
	  <p>FusionCharts needs Adobe Flash Player to run. If you're unable to see the chart here, it means that your browser does not seem to have the Flash Player Installed. You can downloaded it <a href="http://www.adobe.com/products/flashplayer/" target="_blank"><u>here</u></a> for free.</p> 
</div> 
<script type="text/javascript"> 
	   var chart1 = new FusionCharts("../../Charts/MSColumn2D.swf", "sampleChart", "650", "300", "0", "1");
	   chart1.setDataURL("Col2D2.xml");	   
	   chart1.render("chart1div");
</script>  
</center>
<!--  ����ش����ʴ���ҿ -->
<br>
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
	$sum_present = 0;
	$sql = " SELECT works_year, works_month_list, "; 
	if($p==1)
		$sql.=" rice_value, rice_predic ";
	elseif($p==2)
		$sql.=" maize_value, maize_predic";
	elseif($p==3)
		$sql.=" cassava_value, cassava_predic ";
	elseif($p==4)
		$sql.=" sugarcane_value, sugarcane_predic ";
	elseif($p==5)
		$sql.=" para_value, para_predic  "; 

	$sql.=" FROM AnnWorks  WHERE ";
	$sql.=" (works_year >='".$year_start."' AND works_year <='".$year_stop."') ";
	$sql.=" AND (works_month_list >='".$month_start."' AND works_month_list <='".$month_stop."') ";
	$sql.=" ORDER BY works_year,  works_month_list ";
	$result_works = query($sql);
	$i = 0;
	WHILE($fetch_works = fetch_row($result_works)) {
		$i++;						
		if(($i%2)==0) { ?>
			<tr class='rows_grey'>
		<? } else  { ?>
			<tr>
		<? } // end if  ?>
				<td align="center"><?=$month_list[$fetch_works[1]]?> - <?=$fetch_works[0]?></td>
				<td align="right"><?=number_format($fetch_works[2],2,'.',',')?>&nbsp;</td>
				<td align="right"><?=number_format($fetch_works[3],2,'.',',')?>&nbsp;</td>
			<?
				$temp_num =	abs(($fetch_works[3]-$fetch_works[2])/$fetch_works[2]);
				$sum_present = $sum_present + $temp_num;
			?>
				<td align='center'><?=number_format($temp_num,2,'.','') ?></td>
			</tr>
	<?
		} // end while 
?>
	<tr height='27px'>
		<td align="center" colspan='3' class='rows_pink'><strong> �����żŤ������·����� </strong></td>
		<td align='center'><?=number_format($sum_present/num_rows($result_works),2,'.','') ?></td>
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