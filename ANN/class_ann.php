<?
// *****************************************************************************************************************
// ��˹�����������㹡��������ҹ��˹ѡ
function initWeights()
 {
  global $neuron_hidden;      // �ӹǹ neuron ��鹫�͹
  global $weight_min;				// ��ҵ���ش�ͧ��ҹ��˹ѡ㹡�á�˹�����
  global $weight_max;				// ����٧�ش�ͧ��ҹ��˹ѡ㹡�á�˹�����
  global	$weightsH;					// �红����Ź��˹ѡ㹪�鹫�͹ array
  global $weightsO;					// �红����Ź��˹ѡ㹪�鹼��Ѿ�� array

// ��˹�������� weight 㹪�鹫�͹
	for($i = 0;$i<$neuron_hidden;$i++)
	{
		for($j = 0;$j<=11;$j++)
		{
			$weightsH[$j][$i] =  number_format(rand($weight_min*1000,$weight_max*1000)/1000,4,'.','');   // ���������ҧ 0 -1 �ȹ��� 4 ���
		 } // end for
	} // end for

// ��˹�������� weight 㹪�鹼��Ѿ��
	for($i=0;$i<$neuron_hidden;$i++)
	{
	  $weightsO[$i] =  number_format(rand($weight_min*1000,$weight_max*1000)/1000,4,'.','');    // ���������ҧ 0 -1 �ȹ��� 4 ���
	}
 } // end function

// ��˹����������� bias �������
function initBias()
 {
    global $neuron_hidden;      // �ӹǹ neuron ��鹫�͹
    global $bias_min;				     // ��ҵ���ش�ͧ��� bias 㹡�á�˹�����
    global $bias_max;			     // ����٧�ش�ͧ��� bias 㹡�á�˹�����
    global $biasH;					    // �红����� bias 㹪�鹫�͹ array
    global $biasO;				  	    // �红����� bias 㹪�鹼��Ѿ��  array

    for($i = 0;$i<$neuron_hidden;$i++)
    {
	    $biasH[$i] =  number_format(rand($bias_min*1000,$bias_max*1000)/1000,4,'.','');   // ���������ҧ 0 -1 �ȹ��� 4 ���
     } // end for

   $biasO[0] = number_format(rand($bias_min*1000,$bias_max*1000)/1000,4,'.','');   // ���������ҧ 0 -1 �ȹ��� 4 ���
  } // end function
// ****************************************************************************************************************

// ****************************************************************************************************************
// ��ǹ�ͧ Activation Function �շ����� 3 �ѧ����  1 = Log - Sigmoid | 2 = Tan - Sigmoid  | 3 = Linear
/*  function sigmoid  �Ѻ�������� Float   �׹��������ҧ ������ 0 ��Ф����� 1   */
 function log_sigmoid($floatValue)
{
  return 1 / (1 + exp(-1 * $floatValue));
}
/*  function Hyperbolic tangent �Ѻ�������� Float  �׹��������ҧ 0 ��� 1 */
// �����˵�  ��ҵ�ͧ������׹��� -1 �֧ 1 ����� tanh() 
function tan_sigmoid($floatValue)
{
	//return  (tanh($floatValue)+1)/2;
	return tanh($floatValue);
}
// funtion linear �Ѻ�������� Float ��ШФ׹������������Ѻ�ҡ
function linear($floatValue)
{
    return $floatValue;
}
// **************************************************************************************************************
// �ʴ���� weight ��� bias ������ 
function print_weight()
{
	global $neuron_hidden;      // �ӹǹ neuron ��鹫�͹
	global $weightsH;					// �红����Ź��˹ѡ㹪�鹫�͹ array
	global $weightsO;					// �红����Ź��˹ѡ㹪�鹼��Ѿ�� array
    global $biasH;					    // �红����� bias 㹪�鹫�͹ array
    global $biasO;				  	    // �红����� bias 㹪�鹼��Ѿ��  array

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
//  �ʴ���� max min ������
function display_maxmin(){
	global $temp_min;
	global $temp_max;

	for($i=0;$i<=11;$i++){
		echo " �ӴѺ��� $i  max = ".$temp_max[$i];
		echo " min = ".$temp_min[$i]."<br>";
	}
}
// **************************************************************************************************************
// �ʴ���� weight ��� bias ������ 
function temp_print_weight()
{
	global $neuron_hidden;      // �ӹǹ neuron ��鹫�͹
	global $weightsH_result;					// �红����Ź��˹ѡ㹪�鹫�͹ array
	global $weightsO_result;					// �红����Ź��˹ѡ㹪�鹼��Ѿ�� array
    global $biasH_result;					    // �红����� bias 㹪�鹫�͹ array
    global $biasO_result;				  	    // �红����� bias 㹪�鹼��Ѿ��  array

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
// �ѹ�֡�����ŷ���������
function update_data($weightsH_result,$weightsO_result,$biasH_result,$biasO_result ,$total_rows_result,$mse_min)	
{
	global $epochs;                    // �ӹǹ�ͺ㹡�����¹���
	global $learn_rate;               // �ӹǹ��ҵ���ش�ͧ �ѵ�ҡ�����¹���  
	global $weight_min;             // ��� weight ����ش�������ö������
	global $weight_max;           // ��� weight �٧�ش�������ö�����
	global $neuron_hidden;     // �ӹǹ neuron 㹪�鹫�͹
	global $fn_hidden;                // Activation  function 㹪�鹫�͹
	global $fn_output;                  // Activation  function 㹪�鹼��Ѿ��
	global $bias_min;                  // ��ҵ���ش�ͧ bias 
	global $bias_max;                // ����٧�ش�ͧ bias
	global $error_threshold;    // ��� error ����ش�������Ѻ�� 
	global $year_start;			// �շ����������繪ش Train
	global $year_stop;			// ���ش�������繪ش Train
	global $month_start;			// ��͹�����������繪ش Train
	global $month_stop;		// ��͹�ش�������繪ش Train
	global $p;								// �����Թ��ҷ��ӹǳ � �Ѩ�غѹ
	/*
	 $weight_hidden_result;		// ��� weight  hidden ���ӹǳ�����ش
	 $weight_output_result;		// ��� weight  output  ���ӹǳ�����ش
	 $bias_hidden_result;			// ��� bias  hidden ���ӹǳ�����ش
	 $bias_output_result;			// ��� bias  output  ���ӹǳ�����ش
	 $mse_min;								// ��� mse ����ӷ���ش����� 
	 $total_rows_result;				// �ӹǹ�ͺ����ش������¹����� 
*/
	$temp_weightsH = "";
	$temp_weightsO = "";
	$temp_biasH = "";
	$temp_biasO = "";
	for($i=0;$i<$neuron_hidden;$i++){
		for($j=0;$j<=11;$j++){
			$temp_weightsH = $temp_weightsH.$weightsH_result[$j][$i]."#";
		}
		$temp_weightsH = substr($temp_weightsH, 0, -1);  // �����Ң����ŵ�� # �����ش��
		$temp_weightsH = $temp_weightsH."@";
	}
	$temp_weightsH = substr($temp_weightsH, 0, -1);  // �����Ң����ŵ�� @ �����ش��

	
	for($i=0;$i<$neuron_hidden;$i++){
		$temp_weightsO = $temp_weightsO.$weightsO_result[$i]."#";
		$temp_biasH = $temp_biasH.$biasH_result[$i]."#";
	}
		$temp_weightsO = substr($temp_weightsO, 0, -1);  // �����Ң����ŵ�� # �����ش��
		$temp_biasH = substr($temp_biasH, 0, -1);  // �����Ң����ŵ�� # �����ش��
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