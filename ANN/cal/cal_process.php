<?php session_start();
  include("../../check_login.php");
  include("../../lib/config.inc.php");
  include("../class_ann.php");
  include("../../lib/database.php");
  connect();

$month_list = array("1"=>'เมษายน',"2"=>'พฤษภาคม',"3"=>'มิถุนายน',"4"=>'กรกฏาคม',"5"=>'สิงหาคม',"6"=>'กันยายน',"7"=>'ตุลาคม',"8"=>'พฤศจิกายน',"9"=>'ธันวาคม',"10"=>'มกราคม',"11"=>'กุมภาพันธ์',"12"=>'มีนาคม');
$month_eng_list = array("1"=>'Apr',"2"=>'May',"3"=>'Jun',"4"=>'Jul',"5"=>'Aug',"6"=>'Sep',"7"=>'Oct',"8"=>'Nov',"9"=>'Dec',"10"=>'Jan',"11"=>'Feb',"12"=>'Mar');

$product_list = array("1"=>'ข้าว',"2"=>'ข้าวโพด',"3"=>'มันสำปะหลัง',"4"=>'อ้อย',"5"=>'ยางพารา');

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
	// ******************* กำหนดค่า parameter  เริ่มต้น **********************
	$year_start = $_POST['year_start'];             // ปีที่เริ่มใช้เป็นชุด Train
	$year_stop = $_POST['year_stop'];            // ปีสุดท้ายใช้เป็นชุด Train
	$month_start = $_POST['month_start'];       // เดือนที่เริ่มใช้เป็นชุด Train
	$month_stop = $_POST['month_stop'];      // เดือนสุดท้ายใช้เป็นชุด Train
	$p = $_POST['p'];													// ผลผลิตของสินค้าที่ต้องการคำนวณ
	$xml1 = "";
	$xml2 = "";
	$xml3 = "";

// เริ่มคำนวณการเรียนรู้ตามลำดับ ให้คำนวณทั้งหมด 5 ตัวตามผลผลิตที่ได้เลือกมาทั้งหมด 1 ข้าว 2 ข้าวโพด 3 มันฯ 4  อ้อย 5 ยาง 
	$weightsH = array();    // ชั้น Hidden
	$weightsO = array();    // ชั้น Output
	$biasH = array();    // ชั้น Hidden
	$biasO = array();    // ชั้น Output

	// แสดงข้อมูลที่ได้จากการเรียนรู้ทั้งหมด 
	$sql = " SELECT  Fn_Output,Fn_Hidden,Hidden_Neuron,Weight_Hidden, Weight_Output, Data_Trianing_start, Data_Trianing_stop, ";
	$sql.=" Bias_Hidden,Bias_Output , MSE  FROM AnnPerceptron WHERE Product_code = '".$p."' AND Status='1' ";
	$result_perceptron = query($sql);

	$fn_output =	trim(result($result_perceptron,0,"Fn_Output"));   // function output
	$fn_hidden = trim(result($result_perceptron,0,"Fn_Hidden"));   // function hidden
	$neuron_hidden =	number_format(result($result_perceptron,0,"Hidden_Neuron"),0,'','');   // จำนวณ neuron ในชั้นซ่อน
	$temp_biasH =	trim(result($result_perceptron,0,"Bias_Hidden"));
	$temp_biasO =	trim(result($result_perceptron,0,"Bias_Output"));
	$temp_weightH =	trim(result($result_perceptron,0,"Weight_Hidden"));
	$temp_weightO =	trim(result($result_perceptron,0,"Weight_Output"));
	$temp_train_start = trim(result($result_perceptron,0,"Data_Trianing_start"));
	$temp_train_stop = trim(result($result_perceptron,0,"Data_Trianing_stop"));
	$temp_mse = trim(result($result_perceptron,0,"MSE"));

	// สร้างค่า weight 
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
	// สร้างค่า bias 
	$biasH = explode("#", $temp_biasH);
	$biasO[0] = $temp_biasO;

	$outputVal = 0;              // เก็บค่าข้อมูลที่ได้จากชั้นผลลัพธ์  Output

	//  เริ่มต้นกระบวนการ ให้หาค่า MAX , MIN ของข้อมูลแต่ละผลิตภัณฑ์ เพื่อทำการ Normalization
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
	$temp_max = array();  // เก็บค่ามากที่สุดของปัจจัยไว้ max
	$temp_min = array();   // เก็บค่าน้อยที่สุดของปัจจัยไว้ min
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
	$temp_max[12] = number_format(result($result_maxmin,0,"max_value"),0,'','');   // ค่าเป้าหมายที่ต้องการเปรียบเทียบ
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
	$temp_min[12] =  number_format(result($result_maxmin,0,"min_value"),0,'','');   // ค่าเป้าหมายที่ต้องการเปรียบเทียบ
	free_result($result_maxmin);			// คืนค่าข้อมูล
	// ******************* สิ้นสุดการหาค่า min max ******************************************************

	// แสดงข้อมูล Input ที่เป็นปัจจัยทั้งหมดในแต่ละประเภทผลผลิต
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
		// ตรวจสอบหาค่า MAX MIN ใหม่
		for($j=0;$j<=11;$j++){
			if($temp_max[$i]<$fetch_report[$i])
				$temp_max[$i] = $fetch_report[$i];
			if($temp_min[$i]>$fetch_report[$i])
				$temp_min[$i] = $fetch_report[$i];
		} // end for
	} // end while 
	
	data_seek($result_report);    // ไปเริ่มเรียนรู้ใหม่อีกครั้ง 
	$num_rows = 0;
	$sum_error = 0;
	WHILE($fetch_report = fetch_row($result_report)) {
	// กระบวนการที่  1   ประมวลผลข้อมูลในชั้นซ่อน  Hidden  
	for($i=0;$i<$neuron_hidden;$i++){
		$temp_hidden = 0;
		$temp_num = 0;
		for($j=0;$j<=11;$j++){
			// ทำการแปลงค่าตัวเลขให้เป็นพิกันเดียวกัน ได้ 0 - 1
			if($temp_max[$j]==$temp_min[$j])
					$temp_div = 1;
			else
					$temp_div = $temp_max[$j]-$temp_min[$j];
			$temp_num =	(number_format($fetch_report[$j],0,'','')-$temp_min[$j])/$temp_div;  
			$temp_hidden = $temp_hidden + ($temp_num * $weightsH[$j][$i]);   // นำค่าที่ได้มา คูณ กับ weight 
		}  // end for
	
		//  ค่าที่คำนวณได้ทั้งหมดมาบวกกับค่า ไบแอสในชั้นซ่อน Hidden
		$temp_num =	$temp_hidden + $biasH[$i];
		// นำค่าที่ได้เข้าสู่ Activation Function
		if($fn_hidden==1)
			$hiddenVal[$i] =log_sigmoid($temp_num);
		elseif($fn_hidden==2)
			$hiddenVal[$i]= tan_sigmoid($temp_num);
		elseif($fn_hidden==3)
			$hiddenVal[$i] = linear($temp_num);
	}  // end for
	// สิ้นสุดการประมวลผลในชั้น Hidden 

	// กระบวนการที่ 2   ประมวลผลในชั้น Output  มีแค่ 1 Neuronที่ต้องการ
		$outputVal = 0;
		$temp_num = 0;
		for($i=0;$i<$neuron_hidden;$i++){
			$temp_num = $temp_num + ($hiddenVal[$i]*$weightsO[$i]);
		}  // end for

		//  ค่าที่คำนวณได้ทั้งหมดมาบวกกับค่า ไบแอสในชั้นผลลัพธ์ Output
		$temp_num =  number_format($temp_num+$biasO[0],12,'.','');

		// นำค่าที่ได้เข้าสู่ Activation Function
		if($fn_output==1)
			$outputVal =log_sigmoid($temp_num);
		elseif($fn_output==2)
			$outputVal= tan_sigmoid($temp_num);
		elseif($fn_output==3)
			$outputVal = linear($temp_num);
		// สิ้นสุดการประมวลผลในชั้น output 
		 // กระบวนการที่ 3   Denormalization   new = old * (max - min) + min
		$temp_new =	abs($outputVal) *($temp_max[12]-$temp_min[12])+$temp_min[12];	
		$temp_new = number_format($temp_new,2,'.','');

		// กระบวนการที่ 4 เก็บค่า MSE
		if($temp_max[12]==$temp_min[12])
			$temp_div = 1;
		else
			$temp_div = $temp_max[$j]-$temp_min[$j];
		$temp_num =	(number_format($fetch_report[12],0,'','')-$temp_min[12])/$temp_div;   // ทำการแปลงค่าตัวเลขผลลัพธ์ให้เป็นพิกัดเดียวกัน 
		$temp_error = $temp_num - $outputVal;  // คำนวณค่าความผิดพลาดที่ได้   e = t - a 
		$temp_error =  pow(abs($temp_error),2); 
		$sum_error = $sum_error + $temp_error;   // คำนวณค่าผิดพลาดสะสมไว้   

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
		 query($sql);  // ปรับปรุงข้อมูล ค่าพยากรณ์ ที่ได้จากโครงข่าย

	$xml1.="<category label='".$month_eng_list[$fetch_report[11]]."-".$fetch_report[13]."' />";  // เดือน ปี 
	$xml2.=" <set value='".number_format($fetch_report[12],0,'','')."' /> ";   // ค่าจริง
	$xml3.=" <set value='".number_format($temp_new,0,'','')."' /> ";   // ค่าพยากรณ์
	$num_rows++;
}  // end while 
	
	//  คำนวณค่า MSE
	$mse =  (1/$num_rows) * $sum_error;     // คำนวณหาค่า MSE		
	$xml = "<chart caption='การพยากรณ์ผลการรวบรวม' shownames='1' showvalues='1' decimals='0' numberPrefix='' placeValuesInside='1' rotateValues='1' formatNumberScale='0'> ";
	$xml.=" <categories>".$xml1."</categories> ";
	$xml.=" <dataset seriesName='Actuals' color='AFD8F8' >".$xml2."</dataset> ";
	$xml.=" <dataset seriesName='Predicted' color='F6BD0F'>".$xml3."</dataset> ";
	$xml.=" </chart> ";
	$file = fopen( "Col2D2.xml","w+");
		fputs($file,$xml);
	fclose($file);
?>
<!--  เริ่มต้นการแสดงกราฟ -->
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
<!--  สิ้นสุดการแสดงกราฟ -->
<br>
<table width="600" align="center" class="gridtable" style="margin:10 15 10 15 px;">
	<tr height='25px' class='rows_brown'>
		<td colspan="4"align="left">&nbsp;<b>ข้อมูลผลการดำเนินงานจริงเปรียบเทียบผลพยากรณ์ ( เฉพาะผลผลิตหลัก ) ปี <?=$year_start ?> - ปี <?=$year_stop?> </b></td>
	</tr>
	<tr>
		<td align="center" width="140" rowspan='2' class='rows_pink'> เดือน </td>
		<td align="center" colspan='3' class='rows_purple'><center><strong><?=trim($product_list[$p])?></strong></center></td>
	</tr>
	<tr class="rows_pink">
		<td align="center" width="120">ผลงานจริง</td>
		<td align="center" width="120">พยากรณ์</td>
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
		<td align="center" colspan='3' class='rows_pink'><strong> ประมวลผลค่าเฉลี่ยทั้งหมด </strong></td>
		<td align='center'><?=number_format($sum_present/num_rows($result_works),2,'.','') ?></td>
	</tr>
	<tr height='27px'>
		<td align="center" colspan='3' class='rows_pink'><strong> ประมวลผลค่า MSE </strong></td>
		<td align='center'><?=number_format($mse,6,'.','') ?></td>
	</tr>
</table>
</body>
</html>
<?
	close();
	include("../footer.php")
?>