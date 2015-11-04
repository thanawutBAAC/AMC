<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();
	query("BEGIN TRAN");

	if($click=='add')
	{
		$sql = " SELECT  Plan_year  FROM  PlanMaster ";
		$sql.=" WHERE amccode='".$code_online."' AND Plan_year='".$year."' ";
		if(num_rows(query($sql))>0)
		{
			print '<script> alert(" ไม่สามารถเพิ่มข้อมูลปีที่เลือกได้   เนื่องจากมีข้อมูลเดิมอยู่แล้ว "); </script>';
			print '<script>javascript:history.back(1);</script>';
		}
	}
	else if($click=='edit')
	{
		$sql=" DELETE FROM PlanMaster WHERE amccode='".$code_online."' AND Plan_year='".$year."' ";
		query($sql);
	}
	else if($click=='del')
	{
		$sql=" DELETE FROM  PlanMaster  WHERE amccode='".$code_online."' AND Plan_year='".$year."' ";
		query($sql);
		query("COMMIT");
		print '<script> alert(" ลบข้อมูลถูกต้อง "); </script>';
		print '<script>window.location.href = "PlanMaster.php";</script>';
		exit();
	}
//    x1 ไตรมาสที่1  x2  ไตรมาสที่ 2  x3 ไตรมาสที่ 3   x4 ไตรมาสที่ 4
	$a1= trim($_POST['2x1']);   //   จำนวนสมาชิกสิ้นปี
	$a2= trim($_POST['4x1']);  //  ทุนเรือนหุ้นสิ้นปี
	$a3= trim($_POST['8x2']);  //   รายได้เฉพาะธุรกิจ
	$a4= trim($_POST['8x3']);
	$a5= trim($_POST['8x4']);
	$a6= trim($_POST['8x5']);
	$a7= trim($_POST['11x2']);   // เบิกเงินกู้
	$a8= trim($_POST['11x3']);
	$a9= trim($_POST['11x4']);
	$a10= trim($_POST['11x5']);
	$a11= trim($_POST['12x2']);  //ชำระต้นเงิน
	$a12= trim($_POST['12x3']);
	$a13= trim($_POST['12x4']);
	$a14= trim($_POST['12x5']);
	$a15= trim($_POST['13x2']);  // ชำระดอกเบี้ย
	$a16= trim($_POST['13x3']);
	$a17= trim($_POST['13x4']);
	$a18= trim($_POST['13x5']);
	$a19= trim($_POST['17x2']);	// รายได้เฉพาะธุรกิจ
	$a20= trim($_POST['17x3']);	
	$a21= trim($_POST['17x4']);
	$a22= trim($_POST['17x5']);
	$a23= trim($_POST['20x2']);  // เบิกเงินกู้ ฉ.31
	$a24= trim($_POST['20x3']);
	$a25= trim($_POST['20x4']);
	$a26= trim($_POST['20x5']);
	$a27= trim($_POST['21x2']);   //  ชำระต้นเงิน
	$a28= trim($_POST['21x3']);
	$a29= trim($_POST['21x4']);
	$a30= trim($_POST['21x5']);
	$a31= trim($_POST['22x2']);   // ชำระดอกเบี้ย
	$a32= trim($_POST['22x3']);
	$a33= trim($_POST['22x4']);
	$a34= trim($_POST['22x5']);
	$a35= trim($_POST['24x2']);  //  มูลค่าขาย
	$a36= trim($_POST['24x3']);
	$a37= trim($_POST['24x4']);
	$a38= trim($_POST['24x5']);
	$a39= trim($_POST['25x2']);  //  ต้นทุน
	$a40= trim($_POST['25x3']);
	$a41= trim($_POST['25x4']);
	$a42= trim($_POST['25x5']);
	$a43= trim($_POST['26x2']);  // รายได้เฉพาะธุรกิจ
	$a44= trim($_POST['26x3']);	
	$a45= trim($_POST['26x4']);	
	$a46= trim($_POST['26x5']);
	$a47= trim($_POST['31x2']);  // ต้นทุน ธุรกิจบริการ
	$a48= trim($_POST['31x3']);	
	$a49= trim($_POST['31x4']);	
	$a50= trim($_POST['31x5']);
	$a51= trim($_POST['35x2']);  // รายได้เฉพาะธุรกิจ สินเชื่อ
	$a52= trim($_POST['35x3']);	
	$a53= trim($_POST['35x4']);	
	$a54= trim($_POST['35x5']);
	$a55= trim($_POST['36x2']);  // ต้นทุน ธุรกิจสินเชื่อ
	$a56= trim($_POST['36x3']);	
	$a57= trim($_POST['36x4']);	
	$a58= trim($_POST['36x5']);
	$a59= trim($_POST['40x2']);   // ซื้อที่ดิน
	$a60= trim($_POST['40x3']);   
	$a61= trim($_POST['40x4']);
	$a62= trim($_POST['40x5']);
	$a63= trim($_POST['41x2']);  // ซื้อรถยนต์
	$a64= trim($_POST['41x3']);
	$a65= trim($_POST['41x4']);
	$a66= trim($_POST['41x5']);
	$a67= trim($_POST['42x2']);  // เครื่องใช้สำนักงานและอื่น ๆ 
	$a68= trim($_POST['42x3']);
	$a69= trim($_POST['42x4']);
	$a70= trim($_POST['42x5']);
	$a71= trim($_POST['43x2']);  //  ซื้อรถหกล้อ
	$a72= trim($_POST['43x3']);
	$a73= trim($_POST['43x4']);
	$a74= trim($_POST['43x5']);
	$a75= trim($_POST['44x2']);  // สร้างที่เก็บสินค้า
	$a76= trim($_POST['44x3']);
	$a77= trim($_POST['44x4']);
	$a78= trim($_POST['44x5']);
	$a79= trim($_POST['45x2']);  // ซื้อรถจักรยานยนต์
	$a80= trim($_POST['45x3']);
	$a81= trim($_POST['45x4']);	
	$a82= trim($_POST['45x5']);	
	$a83= trim($_POST['46x2']);  // สร้างโรงสี
	$a84= trim($_POST['46x3']);
	$a85= trim($_POST['46x4']);
	$a86= trim($_POST['46x5']);
	$a87= trim($_POST['47x2']);  // เบิกเงินกู้ ฉ.26
	$a88= trim($_POST['47x3']);
	$a89= trim($_POST['47x4']);
	$a90= trim($_POST['47x5']);
	$a91= trim($_POST['48x2']);  // ชำระต้นเงิน
	$a92= trim($_POST['48x3']);
	$a93= trim($_POST['48x4']);
	$a94= trim($_POST['48x5']);
	$a95= trim($_POST['49x2']);  // ชำระดอกเบี้ย
	$a96= trim($_POST['49x3']);
	$a97= trim($_POST['49x4']);
	$a98= trim($_POST['49x5']);
	$a99= trim($_POST['50x2']);   // สร้างอาคารสำนักงาน
	$a100= trim($_POST['50x3']);	
	$a101= trim($_POST['50x4']);	
	$a102= trim($_POST['50x5']);
	$a103= trim($_POST['51x2']);  // สร้างยุ้งฉาง
	$a104= trim($_POST['51x3']);
	$a105= trim($_POST['51x4']);
	$a106= trim($_POST['51x5']);	
	$a107= trim($_POST['52x2']);  // สร้างลานตาก
	$a108= trim($_POST['52x3']);
	$a109= trim($_POST['52x4']);
	$a110= trim($_POST['52x5']);	
	$a111= trim($_POST['53x2']);  // ซื้อเครื่องจักรและอุปกรณ์
	$a112= trim($_POST['53x3']);
	$a113= trim($_POST['53x4']);
	$a114= trim($_POST['53x5']);	
	$a115= trim($_POST['54x2']);  // อื่นๆ 
	$a116= trim($_POST['54x3']);
	$a117= trim($_POST['54x4']);
	$a118= trim($_POST['54x5']);	
	$a119= trim($_POST['59x2']);  // รายได้ดอกเบี้ยเงินฝากธนาคาร
	$a120= trim($_POST['59x3']);
	$a121= trim($_POST['59x4']);
	$a122= trim($_POST['59x5']);	
	$a123= trim($_POST['60x2']);  // รายได้อื่น ๆ 
	$a124= trim($_POST['60x3']);
	$a125= trim($_POST['60x4']);
	$a126= trim($_POST['60x5']);	

    $sql=" INSERT INTO PlanMaster ";
	$sql.=" ( amccode, Plan_year, member_year, share_year, "; 
	$sql.=" buy_income_first, buy_income_second, buy_income_third, buy_income_fourth, ";  
	$sql.=" buy_loan_first, buy_loan_second, buy_loan_third, buy_loan_fourth, ";  
	$sql.=" buy_principal_first, buy_principal_second, buy_principal_third, buy_principal_fourth, ";  
	$sql.=" buy_interest_first, buy_interest_second, buy_interest_third, buy_interest_fourth, ";  
	$sql.=" sell_income_first, sell_income_second, sell_income_third, sell_income_fourth, ";  
	$sql.=" sell_loan_first, sell_loan_second,sell_loan_third, sell_loan_fourth, ";     
	$sql.=" sell_principal_first, sell_principal_second, sell_principal_third, sell_principal_fourth, ";    
	$sql.=" sell_interest_first, sell_interest_second, sell_interest_third, sell_interest_fourth, ";    
	$sql.=" transform_value_first, transform_value_second, transform_value_third, transform_value_fourth, ";   
	$sql.=" transform_principal_first, transform_principal_second, transform_principal_third, transform_principal_fourth, ";   
	$sql.=" transform_income_first, transform_income_second, transform_income_third, transform_income_fourth, ";   
	$sql.=" service_capital_first, service_capital_second, service_capital_third, service_capital_fourth, ";  
	$sql.=" loan_income_first, loan_income_second, loan_income_third, loan_income_fourth, ";    
	$sql.=" loan_capital_first, loan_capital_second, loan_capital_third, loan_capital_fourth, ";   
	$sql.=" asset_61_first, asset_61_second, asset_61_third, asset_61_fourth, ";             
	$sql.=" asset_62_first, asset_62_second, asset_62_third, asset_62_fourth, ";            
	$sql.=" asset_63_first, asset_63_second, asset_63_third, asset_63_fourth, ";            
	$sql.=" asset_64_first, asset_64_second, asset_64_third, asset_64_fourth, ";           
	$sql.=" asset_65_first, asset_65_second, asset_65_third, asset_65_fourth, ";            
	$sql.=" asset_66_first, asset_66_second, asset_66_third, asset_66_fourth, ";              
	$sql.=" asset_67_first, asset_67_second, asset_67_third, asset_67_fourth, ";            
	$sql.=" asset_68_first, asset_68_second, asset_68_third, asset_68_fourth, ";           
	$sql.=" asset_69_first, asset_69_second, asset_69_third, asset_69_fourth, ";            
	$sql.=" asset_610_first, asset_610_second, asset_610_third, asset_610_fourth, ";   
	$sql.=" asset_611_first, asset_611_second, asset_611_third, asset_611_fourth, ";   
	$sql.=" asset_612_first, asset_612_second, asset_612_third, asset_612_fourth, ";   
	$sql.=" asset_613_first, asset_613_second, asset_613_third, asset_613_fourth, ";   
	$sql.=" asset_614_first, asset_614_second, asset_614_third, asset_614_fourth, ";   
	$sql.=" asset_615_first, asset_615_second, asset_615_third, asset_615_fourth, ";   
	$sql.=" income_interest_first, income_interest_second, income_interest_third, income_interset_fourth, ";  
	$sql.=" income_other_first, income_other_second, income_other_third, income_other_fourth) "; 
	$sql.=" VALUES ('".$code_online."','".$year."',$a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9,$a10,$a11,$a12,$a13,$a14,$a15,$a16,$a17,$a18,$a19,$a20,$a21,$a22,$a23,$a24,$a25,$a26,$a27,$a28,$a29,$a30,$a31,$a32,$a33,$a34,$a35,$a36,$a37,$a38,$a39,$a40,$a41,$a42,$a43,$a44,$a45,$a46,$a47,$a48,$a49,$a50,$a51,$a52,$a53,$a54,$a55,$a56,$a57,$a58,$a59,$a60,$a61,$a62,$a63,$a64,$a65,$a66,$a67,$a68,$a69,$a70,$a71,$a72,$a73,$a74,$a75,$a76,$a77,$a78,$a79,$a80,$a81,$a82,$a83,$a84,$a85,$a86,$a87,$a88,$a89,$a90,$a91,$a92,$a93,$a94,$a95,$a96,$a97,$a98,$a99,$a100,$a101,$a102,$a103,$a104,$a105,$a106,$a107,$a108,$a109,$a110,$a111,$a112,$a113,$a114,$a115,$a116,$a117,$a118,$a119,$a120,$a121,$a122,$a123,$a124,$a125,$a126) ";

	$result_sql = query($sql);

	if($result_sql)
		{	query("COMMIT");
			print '<script>alert(" ปรับปรุงข้อมูลถูกต้อง ");</script>';		}
	else
		{	query("ROLLBACK");	
			print '<script>alert(" มีข้อผิดพลาดในการปรับปรุงข้อมูล ");</script>';		}

	close();
	print '<script>window.location.href = "PlanMaster.php";</script>';
?>