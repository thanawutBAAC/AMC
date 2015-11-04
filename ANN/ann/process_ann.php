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
	// ******************* กำหนดค่า parameter  เริ่มต้น **********************
	$epochs = $_GET['epochs'];                                    // จำนวนรอบในการเรียนรู้
	$learn_rate = $_GET['learn_rate'];                          // จำนวนค่าต่ำสุดของ อัตราการเรียนรู้  
	$weight_min = $_GET['weight_min'];                     // ค่า weight ต่ำสุดที่สามารถสุ่มได้
	$weight_max = $_GET['weight_max'];                  // ค่า weight สูงสุดที่สามารถสุ่มได
	$neuron_hidden = $_GET['neuron_hidden'];     // จำนวน neuron ในชั้นซ่อน
	$fn_hidden = $_GET['fn_hidden'];                         // Activation  function ในชั้นซ่อน
	$fn_output = $_GET['fn_output'];                             // Activation  function ในชั้นผลลัพธ์
	$bias_min = $_GET['bias_min'];                           // ค่าต่ำสุดของ bias 
	$bias_max = $_GET['bias_max'];                         // ค่าสูงสุดของ bias
	$error_threshold = $_GET['error_threshold'];    // ค่า error ต่ำสุดที่ยอมรับได้ 
	$year_start = $_GET['year_start'];							// ปีที่เริ่มใช้เป็นชุด Train
	$year_stop = $_GET['year_stop'];							// ปีสุดท้ายใช้เป็นชุด Train
	$month_start = $_GET['month_start'];						// เดือนที่เริ่มใช้เป็นชุด Train
	$month_stop = $_GET['month_stop'];					// เดือนสุดท้ายใช้เป็นชุด Train
	$p = $_GET['p'];																// ผลผลิตของสินค้าที่ต้องการคำนวณ ค่า P = 1 ข้าว 2 ข้าวโพด 3 มันฯ 4  อ้อย 5 ยาง 
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
	$xml_category = "";   // สร้างชุดข้อมูล xml เพื่อสร้าง กราฟ
	$xml_dataset = "";     // สร้างชุดข้อมูล xml เพื่อสร้าง กราฟ
	$xml_error = "";          // สร้างชุดข้อมูล xml เพื่อสร้าง กราฟ
	$weightsH_result = array();		// ค่า weight  hidden ที่คำนวณได้ต่ำสุด
	$weightsO_result = array();		// ค่า weight  output  ที่คำนวณได้ต่ำสุด
	$biasH_result = array();			  // ค่า bias  hidden ที่คำนวณได้ต่ำสุด
	$biasO_result = array();			  // ค่า bias  output  ที่คำนวณได้ต่ำสุด
	$total_rows_result = 0;					// จำนวนครั้งที่เรียนรู้ต่ำสุดที่ได
	$mse_min = 10;			// เก็บค่าที่ error น้อยที่สุด
	$num_rows = 0;            // ตัวนับจำนวนรอบที่ต้องเรียนรู้ 
	$total_rows = 1;			 // จำนวนรอบ เพื่อเปรียบเทียบกับค่า epochs
	$sum_error = 0;           // ค่าสะสมความผิดพลาดทั้งหมด
	$temp_div_epochs = $epochs/20;   // ค่าตัว label ที่ให้แสดงในกราฟ
	// กำหนดค่า weight เป็นแบบ array   แล้วเรียกใช้ ฟังก์ชั่นในการสุ่มค่าน้ำหนัก  
	$weightsH = array();    // ชั้น Hidden
	$weightsO = array();    // ชั้น Output
	 initWeights();

	// กำหนดค่า bias เป็นแบบ array แล้วเรียกใช้ ฟังก์ชั่นในการสุ่มค่าน้ำหนัก  
	$biasH = array();    // ชั้น Hidden
	$biasO = array();    // ชั้น Output
	 initBias();
		
	$hiddenVal = array();  // เก็บค่าข้อมูลที่ได้จากชั้นซ่อน  Hidden
	$outputVal = 0;              // เก็บค่าข้อมูลที่ได้จากชั้นผลลัพธ์  Output

	$product_list = array("1"=>'ข้าว',"2"=>'ข้าวโพด',"3"=>'มันสำปะหลัง',"4"=>'อ้อย',"5"=>'ยางพารา');
	$function_list = array("1"=>' Log-Sigmoid',"2"=>'Tan-Sigmoid',"3"=>'Linear');
	$month_list = array("1"=>'เมษายน',"2"=>'พฤษภาคม',"3"=>'มิถุนายน',"4"=>'กรกฏาคม',"5"=>'สิงหาคม',"6"=>'กันยายน',"7"=>'ตุลาคม',"8"=>'พฤศจิกายน',"9"=>'ธันวาคม',"10"=>'มกราคม',"11"=>'กุมภาพันธ์',"12"=>'มีนาคม');

	//  เริ่มต้นกระบวนการ ให้หาค่า MAX , MIN ของข้อมูลแต่ละผลิตภัณฑ์ เพื่อทำการ Normalization
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

	// แสดงข้อมูล Input ที่เป็นปัจจัยทั้งหมดในแต่ละประเภทผลผลิตเพื่อสร้างข้อมูลในการ train โครงข่าย
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
	// กระบวนการที่  1 ประมวลผลข้อมูลในชั้นซ่อน  Hidden  
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
		}
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
	}
	//  ค่าที่คำนวณได้ทั้งหมดมาบวกกับค่า ไบแอสในชั้นผลลัพธ์ Output
	$temp_num = $temp_num + $biasO[0];
	// นำค่าที่ได้เข้าสู่ Activation Function
	if($fn_output==1)
		$outputVal =log_sigmoid($temp_num);
	elseif($fn_output==2)
		$outputVal= tan_sigmoid($temp_num);
	elseif($fn_output==3)
		$outputVal = linear($temp_num);
	// สิ้นสุดการประมวลผลในชั้น output 

 // กระบวนการที่ 3  ตรวจสอบค่าที่ประมวลผลได้กับเป้าหมายที่ต้องการ 
 	$temp_num = 0;
	$temp_num =	(number_format($fetch_report[12],0,'','')-$temp_min[12])/($temp_max[12]-$temp_min[12]);   // ทำการแปลงค่าตัวเลขผลลัพธ์ให้เป็นพิกัดเดียวกัน 

	$temp_error = $temp_num - $outputVal;  // คำนวณค่าความผิดพลาดที่ได้   e = t - a 

// กระบวนการที่ 4.1   ปรับค่าน้ำหนักและไบแอสย้อนกลับจากชั้น output 
// คำนวณค่าความลาดชันของค่าผิดพลาด 
	if($fn_output==1)
		$g2 = (1-$outputVal) * $outputVal;
	elseif($fn_output==2)
		$g2 = 1-pow($outputVal,2);   // ยกกำลัง 2 
	elseif($fn_output==3)
		$g2 = 1;

	$g2 = -2 * ($g2* $temp_error);    // ค่าความลาดชั้นในชั้นสุดท้าย  g = -2 (F2N2) e1
	// คำนวณการปรับค่าน้ำหนักชั้น output 
	for($i=0;$i<$neuron_hidden;$i++){
		 $weightsO[$i] = $weightsO[$i] - ($learn_rate*$g2*$hiddenVal[$i]);
	}
	// คำนวณการปรับค่าไบแอสชั้น output 
	$biasO[0] = $biasO[0]-($learn_rate*$g2);

// กระบวนการที่ 4.2 ปรับค่าน้ำหนักและไบแอสย้อนกลับจากชั้น hidden 
	$g1 = array();   // ค่าความลาดชั้นในชั้นแรก
	// การปรับค่าความลาดชั้นในชั้นซ่อน
	for($i=0;$i<$neuron_hidden;$i++)	{	
		if($fn_hidden==1)
			$g1[$i] = (1-$hiddenVal[$i] ) * $hiddenVal[$i];
		elseif($fn_hidden==2)
			$g1[$i] = 1-pow($hiddevVal[$i],2);   // ยกกำลัง 2 
		elseif($fn_hidden==3)
			$g1[$i] = 1;

		$g1[$i] =  ($g1[$i]*$weightsO[$i])*$g2;
	}  // end for g1

	//  การปรับน้ำหนักสูตร W1 = W1-n g1*input
	for($i = 0;$i<$neuron_hidden;$i++){
		for($j = 0;$j<=11;$j++){
			if($temp_max[$j]==$temp_min[$j])
					$temp_div = 1;
			else
					$temp_div = $temp_max[$j]-$temp_min[$j];
			 $temp_report =  (number_format($fetch_report[$j],0,'','')-$temp_min[$j])/$temp_div;  // ปรับค่าข้อมูลที่ input เข้ามาให้เป็นพิกัดเดียวกัน
			 $weightsH[$j][$i] = $weightsH[$j][$i] - (($learn_rate*$g1[$i]) * $temp_report);
		 }
	}  // end for 
	// การปรับค่าไบแอส  b1 = b1 -ng1
	for($i=0;$i<$neuron_hidden;$i++){	
		 $biasH[$i]  =  $biasH[$i] - ($learn_rate*$g1[$i]);
	}
	
	$num_rows++;   // เพิ่มลำดับของชุดข้อมูล
	// ในกรณีที่เรียนรู้ข้อมูลครบทั้งชุดแล้วให้ทำการคำนวณหาผลที่ได้ 
	if(num_rows($result_report)==$num_rows)
	{
		 $mse =  (1/$num_rows) * $sum_error;     // คำนวณหาค่า MSE		
		if((($total_rows%10)==0) OR ($total_rows==1))
		{
			$temp_mse = number_format($mse,4,'.','');     // จัดรูปแบบทศนิยมไม่เกิน 4 ตัว
			if(($total_rows%$temp_div_epochs)==0 OR ($total_rows==1) )
				$xml_category.="<category label='".$total_rows."'/>";
			else
				$xml_category.="<category label=''/>";
			$xml_dataset.="<set value='".$temp_mse."'/>";
			$xml_error.="<set value='".$error_threshold."'/>";
		}  // end if % 10
		// ตรวจสอบหาค่าที่ได้ mse ที่น้อยที่สุด
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
			$total_rows_result = $total_rows;  // จำนวนรอบต่ำสุดที่ได้
		}  // end if mse  การคำนวณให้ค่าที่ดีที่สุด

		 if(($mse_min>$error_threshold) && ($total_rows<$epochs)){    // ในกรณีที่ค่า mse มากกว่าที่ตั้งไว้ และจำนวนรอบน้อยกว่าที่ตั้งไว้ให้เริ่มเรียนรู้ใหม่
			 $total_rows++;     // ตัวนับจำนวนครั้งที่เรียนรู้ชุดข้อมูล
			 $num_rows = 0;   // ลำดับของชุดข้อมูล
			 $sum_error = 0;   // ค่า error สะสมที่ได้ 
			 data_seek($result_report);    // ไปเริ่มเรียนรู้ใหม่อีกครั้ง 
			}
		elseif(($mse_min<=$error_threshold) && ($total_rows>=$epochs)){
		// ในกรณีที่ค่าความผิดพลาดน้อยกว่าค่าที่ตั้งไว้ และ ตัวนับรอบ total มากกว่า epochs แล้วให้จบการทำงาน
			break;
		 }
	}   // end if  num_rows

		$temp_error =  pow(abs($temp_error),2); 
		$sum_error = $sum_error + $temp_error;   // คำนวณค่าผิดพลาดสะสมไว้   
	}  // end while 

	// หลังจากที่ได้ค่าทั้งหมดแล้ว  นำไปบันทึกค่าในฐานข้อมูล  
	update_data($weightsH_result,$weightsO_result,$biasH_result,$biasO_result ,$total_rows_result,$mse_min);		

$xml = "<chart caption=' Feedforword Multilayer Perceptron ' showValues='0' rotateLabels='1' slantLabels='1' anchorAlpha='0' formatNumberScale='1' toolTipSepChar=': '><categories>".$xml_category."</categories><dataset seriesname='MSE' >".$xml_dataset."</dataset><dataset seriesname='Error Threshold' >".$xml_error."</dataset></chart>";  // กำหนดค่าเพื่อที่จะสร้าง กราฟ

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
<!--  แสดงข้อมูลค่าที่ได้ทั้งหมดเพื่อเปรียบเทียบค่าผลงานจริงกับค่าพยากรณ์  -->
<table class='gridtable' width='98%' style='margin-top:5px; margin-left:5px; margin-right:5px;'>
<tr class='rows_pink' align='center'>
	<td> ลำดับ </td>
	<td> ประเภท </td>
	<td> Function Hidden</td>
	<td> Function Output </td>
	<td> ค่า MSE ต่ำที่สุด </td>
	<td> รอบที่ดีที่สุด </td>
	<td> ช่วงข้อมูลในการ Train  </td>
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
// ***************************************************************************************************************************
// ปรับปรุงข้อมูลกับค่าพยากรณ์ที่ได้จากระบบ แสดงข้อมูลที่ได้จากการเรียนรู้ทั้งหมด 
$sum_present = 0;        // เก็บค่าความคลาดเคลื่อนทั้งหมด
$x = 0;                               // สลับสีในตารางที่แสดง
data_seek($result_report);    // ไปเริ่มเรียนรู้ใหม่อีกครั้ง 
$num_rows = 0;      // เก็บจำนวนนับคำนวณค่า mse
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
			$temp_hidden = $temp_hidden + ($temp_num * $weightsH_result[$j][$i]);   // นำค่าที่ได้มา คูณ กับ weight 
		}  // end for
	
		//  ค่าที่คำนวณได้ทั้งหมดมาบวกกับค่า ไบแอสในชั้นซ่อน Hidden
		$temp_num =	$temp_hidden + $biasH_result[$i];
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
			$temp_num = $temp_num + ($hiddenVal[$i]*$weightsO_result[$i]);
		}  // end for

		//  ค่าที่คำนวณได้ทั้งหมดมาบวกกับค่า ไบแอสในชั้นผลลัพธ์ Output
		$temp_num =  number_format($temp_num+$biasO_result[0],12,'.','');

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
		//*************************** เริ่มแสดงค่าข้อมูลที่ได้จากการพยากรณ์ในชุดข้อมูลทดสอบ  ***************************
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
		//********* สิ้นสุดการแสดงค่าข้อมูลที่ได้จากการพยากรณ์ในชุดข้อมูลทดสอบ  ***************************
		$num_rows++;
	   }  // end while  
			$mse =  (1/$num_rows) * $sum_error;     // คำนวณหาค่า MSE
	 ?>
		<tr height='27px'>
			<td align="center" colspan='3' class='rows_pink'><strong> ประมวลผลค่าเฉลี่ยทั้งหมด </strong></td>
			<td align='center'><?=number_format($sum_present/$num_rows,2,'.','') ?></td>
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