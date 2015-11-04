<?
// *****************************************************************************************************************
// กำหนดค่าเริ่มต้นในการสุ่มค่าน้ำหนัก
function initWeights()
 {
  global $neuron_hidden;      // จำนวน neuron ชั้นซ่อน
  global $weight_min;				// ค่าต่ำสุดของค่าน้ำหนักในการกำหนดสุ่ม
  global $weight_max;				// ค่าสูงสุดของค่าน้ำหนักในการกำหนดสุ่ม
  global	$weightsH;					// เก็บข้อมูลน้ำหนักในชั้นซ่อน array
  global $weightsO;					// เก็บข้อมูลน้ำหนักในชั้นผลลัพธ์ array

// กำหนดสุ่มค่า weight ในชั้นซ่อน
	for($i = 0;$i<$neuron_hidden;$i++)
	{
		for($j = 0;$j<=11;$j++)
		{
			$weightsH[$j][$i] =  number_format(rand($weight_min*1000,$weight_max*1000)/1000,4,'.','');   // ได้ค่าระหว่าง 0 -1 ทศนิยม 4 ตัว
		 } // end for
	} // end for

// กำหนดสุ่มค่า weight ในชั้นผลลัพธ์
	for($i=0;$i<$neuron_hidden;$i++)
	{
	  $weightsO[$i] =  number_format(rand($weight_min*1000,$weight_max*1000)/1000,4,'.','');    // ได้ค่าระหว่าง 0 -1 ทศนิยม 4 ตัว
	}
 } // end function

// กำหนดค่าสุ่มค่า bias เริ่มต้น
function initBias()
 {
    global $neuron_hidden;      // จำนวน neuron ชั้นซ่อน
    global $bias_min;				     // ค่าต่ำสุดของค่า bias ในการกำหนดสุ่ม
    global $bias_max;			     // ค่าสูงสุดของค่า bias ในการกำหนดสุ่ม
    global $biasH;					    // เก็บข้อมูล bias ในชั้นซ่อน array
    global $biasO;				  	    // เก็บข้อมูล bias ในชั้นผลลัพธ์  array

    for($i = 0;$i<$neuron_hidden;$i++)
    {
	    $biasH[$i] =  number_format(rand($bias_min*1000,$bias_max*1000)/1000,4,'.','');   // ได้ค่าระหว่าง 0 -1 ทศนิยม 4 ตัว
     } // end for

   $biasO[0] = number_format(rand($bias_min*1000,$bias_max*1000)/1000,4,'.','');   // ได้ค่าระหว่าง 0 -1 ทศนิยม 4 ตัว
  } // end function
// ****************************************************************************************************************

// ****************************************************************************************************************
// ส่วนของ Activation Function มีทั้งหมด 3 ฟังก์ชั่น  1 = Log - Sigmoid | 2 = Tan - Sigmoid  | 3 = Linear
/*  function sigmoid  รับข้อมูลเป็น Float   คืนค่าระหว่าง ค่าใกล้ 0 และค่าใกล้ 1   */
 function log_sigmoid($floatValue)
{
  return 1 / (1 + exp(-1 * $floatValue));
}
/*  function Hyperbolic tangent รับข้อมูลเป็น Float  คืนค่าระหว่าง 0 และ 1 */
// หมายเหตุ  ถ้าต้องการให้คืนค่า -1 ถึง 1 ให้ใช้ tanh() 
function tan_sigmoid($floatValue)
{
	//return  (tanh($floatValue)+1)/2;
	return tanh($floatValue);
}
// funtion linear รับข้อมูลเป็น Float และจะคืนค่าเดิมที่ได้รับมาก
function linear($floatValue)
{
    return $floatValue;
}
// **************************************************************************************************************
// แสดงค่า weight และ bias ทั้งหมด 
function print_weight()
{
	global $neuron_hidden;      // จำนวน neuron ชั้นซ่อน
	global $weightsH;					// เก็บข้อมูลน้ำหนักในชั้นซ่อน array
	global $weightsO;					// เก็บข้อมูลน้ำหนักในชั้นผลลัพธ์ array
    global $biasH;					    // เก็บข้อมูล bias ในชั้นซ่อน array
    global $biasO;				  	    // เก็บข้อมูล bias ในชั้นผลลัพธ์  array

	for($i = 0;$i<$neuron_hidden;$i++){
		for($j = 0;$j<=11;$j++){
			 echo " weightsH : $j $i = ".$weightsH[$j][$i]."<br>"; 
		 }
	} // end for

	for($i=0;$i<$neuron_hidden;$i++)
	{
		echo " weightsO : $i = ".$weightsO[$i]."<br>"; 
	} // end for

	for($i=0;$i<$neuron_hidden;$i++)
	{
		echo " biasH : $i = ".$biasH[$i]."<br>"; 
	} // end for

		echo " biasO = ".$biasO[0]."<br>";
		echo "<hr>";
} // end function 
// **************************************************************************************************************
//  แสดงค่า max min ทั้งหมด
function display_maxmin(){
	global $temp_min;
	global $temp_max;

	for($i=0;$i<=11;$i++){
		echo " ลำดับที่ $i  max = ".$temp_max[$i];
		echo " min = ".$temp_min[$i]."<br>";
	}
}
// **************************************************************************************************************
// แสดงค่า weight และ bias ทั้งหมด 
function temp_print_weight()
{
	global $neuron_hidden;      // จำนวน neuron ชั้นซ่อน
	global $weightsH_result;					// เก็บข้อมูลน้ำหนักในชั้นซ่อน array
	global $weightsO_result;					// เก็บข้อมูลน้ำหนักในชั้นผลลัพธ์ array
    global $biasH_result;					    // เก็บข้อมูล bias ในชั้นซ่อน array
    global $biasO_result;				  	    // เก็บข้อมูล bias ในชั้นผลลัพธ์  array

	for($i = 0;$i<$neuron_hidden;$i++){
		for($j = 0;$j<=11;$j++){
			 echo " weightsH : $j $i = ".$weightsH_result[$j][$i]."<br>"; 
		 }
	} // end for

	for($i=0;$i<$neuron_hidden;$i++)
	{
		echo " weightsO : $i = ".$weightsO_result[$i]."<br>"; 
	} // end for

	for($i=0;$i<$neuron_hidden;$i++)
	{
		echo " biasH : $i = ".$biasH_result[$i]."<br>"; 
	} // end for

		echo " biasO = ".$biasO_result[0]."<br>";
		echo "<hr>";
} // end function 
// บันทึกข้อมูลที่ได้ทั้งหมด
function update_data($weightsH_result,$weightsO_result,$biasH_result,$biasO_result ,$total_rows_result,$mse_min)	
{
	global $epochs;                    // จำนวนรอบในการเรียนรู้
	global $learn_rate;               // จำนวนค่าต่ำสุดของ อัตราการเรียนรู้  
	global $weight_min;             // ค่า weight ต่ำสุดที่สามารถสุ่มได้
	global $weight_max;           // ค่า weight สูงสุดที่สามารถสุ่มได
	global $neuron_hidden;     // จำนวน neuron ในชั้นซ่อน
	global $fn_hidden;                // Activation  function ในชั้นซ่อน
	global $fn_output;                  // Activation  function ในชั้นผลลัพธ์
	global $bias_min;                  // ค่าต่ำสุดของ bias 
	global $bias_max;                // ค่าสูงสุดของ bias
	global $error_threshold;    // ค่า error ต่ำสุดที่ยอมรับได้ 
	global $year_start;			// ปีที่เริ่มใช้เป็นชุด Train
	global $year_stop;			// ปีสุดท้ายใช้เป็นชุด Train
	global $month_start;			// เดือนที่เริ่มใช้เป็นชุด Train
	global $month_stop;		// เดือนสุดท้ายใช้เป็นชุด Train
	global $p;								// รหัสสินค้าที่คำนวณ ณ ปัจจุบัน
	/*
	 $weight_hidden_result;		// ค่า weight  hidden ที่คำนวณได้ต่ำสุด
	 $weight_output_result;		// ค่า weight  output  ที่คำนวณได้ต่ำสุด
	 $bias_hidden_result;			// ค่า bias  hidden ที่คำนวณได้ต่ำสุด
	 $bias_output_result;			// ค่า bias  output  ที่คำนวณได้ต่ำสุด
	 $mse_min;								// ค่า mse ที่ต่ำที่สุดที่ได้ 
	 $total_rows_result;				// จำนวนรอบต่ำสุดที่เรียนรู้ได้ 
*/
	$temp_weightsH = "";
	$temp_weightsO = "";
	$temp_biasH = "";
	$temp_biasO = "";
	for($i=0;$i<$neuron_hidden;$i++){
		for($j=0;$j<=11;$j++){
			$temp_weightsH = $temp_weightsH.$weightsH_result[$j][$i]."#";
		}
		$temp_weightsH = substr($temp_weightsH, 0, -1);  // ไม่เอาข้อมูลตัว # ท้ายสุดมา
		$temp_weightsH = $temp_weightsH."@";
	}
	$temp_weightsH = substr($temp_weightsH, 0, -1);  // ไม่เอาข้อมูลตัว @ ท้ายสุดมา

	
	for($i=0;$i<$neuron_hidden;$i++){
		$temp_weightsO = $temp_weightsO.$weightsO_result[$i]."#";
		$temp_biasH = $temp_biasH.$biasH_result[$i]."#";
	}
		$temp_weightsO = substr($temp_weightsO, 0, -1);  // ไม่เอาข้อมูลตัว # ท้ายสุดมา
		$temp_biasH = substr($temp_biasH, 0, -1);  // ไม่เอาข้อมูลตัว # ท้ายสุดมา
		$temp_biasO = $biasO_result[0];

		query("BEGIN TRAN");
//		$sql = " DELETE  FROM AnnPerceptron WHERE Product_code='".$p."' ";
//		query($sql);
		$sql = " INSERT INTO AnnPerceptron( Product_code,Fn_Hidden,Fn_Output,Hidden_Neuron,
	Weight_Ini,Bias_Ini,Epochs,Learning_rate, Error_threshold,Data_Trianing_start,Data_Trianing_stop,
	Weight_Hidden,Weight_Output,Bias_Hidden,Bias_Output,MSE,Total_rows ) 
	VALUES('".$p."','".$fn_hidden."','".$fn_output."','".$neuron_hidden."','".$weight_min."@".$weight_max."','".$bias_min."@".$bias_max."',".$epochs.",".$learn_rate.",".$error_threshold.",'".$month_start."@".$year_start."','".$month_stop."@".$year_stop."','".$temp_weightsH."','".$temp_weightsO."','".$temp_biasH."','".$temp_biasO."',".$mse_min.",".$total_rows_result.") ";
	
		$result_sql = query($sql);

		if($result_sql)
			query("COMMIT");
		else
			query("ROLLBACK");	

} // end function 

?>