<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");
	connect();

	$amc_code = trim($_GET['amc_code']);
	$year = trim($_GET['year']);

	$sql=" SELECT ";   // ข้อมูลจาก PlanMaster
	$sql.=" member_year, share_year, ";  // 0 1
	$sql.=" buy_income_first, buy_income_second, buy_income_third, buy_income_fourth, ";  //  2 3 4 5 
	$sql.=" buy_loan_first, buy_loan_second, buy_loan_third, buy_loan_fourth, ";  // 6 7 8 9
	$sql.=" buy_principal_first, buy_principal_second, buy_principal_third, buy_principal_fourth, ";  // 10 11 12 13
	$sql.=" buy_interest_first, buy_interest_second, buy_interest_third, buy_interest_fourth, ";  // 14 15 16 17
	$sql.=" sell_income_first, sell_income_second, sell_income_third, sell_income_fourth, ";  // 18 19 20 21
	$sql.=" sell_loan_first, sell_loan_second,sell_loan_third, sell_loan_fourth, ";     // 22 23 24 25
	$sql.=" sell_principal_first, sell_principal_second, sell_principal_third, sell_principal_fourth, ";    // 26 27 28 29
	$sql.=" sell_interest_first, sell_interest_second, sell_interest_third, sell_interest_fourth, ";    // 30 31 32 33
	$sql.=" transform_value_first, transform_value_second, transform_value_third, transform_value_fourth, ";   // 34 35 36 37
	$sql.=" transform_principal_first, transform_principal_second, transform_principal_third, transform_principal_fourth, ";   // 38 39 40 41
	$sql.=" transform_income_first, transform_income_second, transform_income_third, transform_income_fourth, ";   // 42 43 44 45
	$sql.=" service_capital_first, service_capital_second, service_capital_third, service_capital_fourth, ";   // 46 47 48 49	
	$sql.=" loan_income_first, loan_income_second, loan_income_third, loan_income_fourth, ";    //  50 51 52 53
	$sql.=" loan_capital_first, loan_capital_second, loan_capital_third, loan_capital_fourth, ";   // 54 55 56 57
	$sql.=" asset_61_first, asset_61_second, asset_61_third, asset_61_fourth, ";             //   58   59   60   61
	$sql.=" asset_62_first, asset_62_second, asset_62_third, asset_62_fourth, ";            //    62   63   64   65
	$sql.=" asset_63_first, asset_63_second, asset_63_third, asset_63_fourth, ";            //    66   67   68   69
	$sql.=" asset_64_first, asset_64_second, asset_64_third, asset_64_fourth, ";            //    70   71   72   73
	$sql.=" asset_65_first, asset_65_second, asset_65_third, asset_65_fourth, ";            //    74   75   76   77
	$sql.=" asset_66_first, asset_66_second, asset_66_third, asset_66_fourth, ";            //    78   79   80   81   
	$sql.=" asset_67_first, asset_67_second, asset_67_third, asset_67_fourth, ";            //    82   83   84   85
	$sql.=" asset_68_first, asset_68_second, asset_68_third, asset_68_fourth, ";            //    86   87   88   89 
	$sql.=" asset_69_first, asset_69_second, asset_69_third, asset_69_fourth, ";            //    90   91   92   93
	$sql.=" asset_610_first, asset_610_second, asset_610_third, asset_610_fourth, ";   //    94   95   96   97
	$sql.=" asset_611_first, asset_611_second, asset_611_third, asset_611_fourth, ";   //    98   99 100  101
	$sql.=" asset_612_first, asset_612_second, asset_612_third, asset_612_fourth, ";   //   102 103 104 105
	$sql.=" asset_613_first, asset_613_second, asset_613_third, asset_613_fourth, ";   //   106 107 108 109
	$sql.=" asset_614_first, asset_614_second, asset_614_third, asset_614_fourth, ";   //   110 111 112 113
	$sql.=" asset_615_first, asset_615_second, asset_615_third, asset_615_fourth, ";   //   114 115 116 117
	$sql.=" income_interest_first, income_interest_second, income_interest_third, income_interset_fourth, ";  
	$sql.=" income_other_first, income_other_second, income_other_third, income_other_fourth ";  //  122 123 124 125
	$sql.=" FROM PlanMaster ";
	$sql.=" WHERE amccode='".$amc_code."' AND Plan_year='".$year."' ";

	$result_master = query($sql);
	$fetch_master = fetch_row($result_master);
	free_result($result_master);  
?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../js/javascript.js"></script>
<script language="JavaScript">

// ปรับปรุงข้อมูลการแสดงผลปี
  function update_year() {
		var xxx=	document.getElementById("year").value
		document.getElementById("year1").innerText = 'ปี '+(xxx-1);
		document.getElementById("year2").innerText = 'ปี '+(xxx-2);
		document.getElementById("year3").innerText = 'ปี '+(xxx-3);
  }

var HttPRequest = false; 
// ทำการดึงข้อมูล Ajax ทั้ง 2 ตัว
function update_ajax()
{
	doCallAjax1();   // ข้อมูลแผนการดำเนินงานปี
	doCallAjax2();    //  เริ่มต้นดึงข้อมูลผลงานย้อนหลัง
}
// ทำการปรับปรุงข้อมูลภายในแนว colume
function update_master()
{
	update_rows();						// ปรับปรุงข้อมูล ไตรมาสเป็นรายปี
	update_buy();							// หมวดที่ 3 
	update_sell();							// หมวดที่ 4
	update_transform();				// หมวดที่ 5
	update_service();					// หมวดที่ 6
	update_busniess_loan();  // หมวดที่ 7
	update_asset();						// หมวดที่ 8
	update_loan();						// หมวดที่ 9
	update_income();					// หมวดที่ 10
	update_expenses();				// หมวดที่ 11
	update_profit();						// หมวดที่ 12
}  // end function update_master

/***********************************************************************************************/
// เริ่มต้นดึงข้อมูลแผนการดำเนินงานปี
function doCallAjax1() { 
	HttPRequest = false; 
	if (window.XMLHttpRequest) { // Mozilla, Safari,... 
		HttPRequest1 = new XMLHttpRequest();
		if (HttPRequest1.overrideMimeType) { 
			HttPRequest1.overrideMimeType('text/html'); 
		}  
	} else if (window.ActiveXObject) { // IE 
	try {     
		HttPRequest1 = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) { 
			try {    
				HttPRequest1 = new ActiveXObject("Microsoft.XMLHTTP"); 
				} catch (e) {}
		} 
	}  
        
	if (!HttPRequest1) {    
		alert(' ไม่สามารถสร้าง XMLHTTP instance  ไม่สามารถดึงข้อมูลจากระบบได้ ');    
		return false; 
	} 

	var year = document.getElementById("year").value;
	var amc_code = '<?=$amc_code?>';
	var Temp_ans;
	var Array_ans;
	var url1 = 'Ajax_Master.php?year='+year+'&amc_code='+amc_code;               // ดึงข้อมูลแผนการดำเนินงานปี
	HttPRequest1.open('get',url1,true); 
	HttPRequest1.setRequestHeader('Content-Type', 'text/html; charset:windows-874');
	HttPRequest1.onreadystatechange = function() 
	{ 
		if(HttPRequest1.readyState == 3)  // Loading Request    
		{ 
			document.getElementById("mySpan").innerHTML = "Now is Loading...  ( ข้อมูลแผนการดำเนินงานปี ) ";        
		}   // end 3
		if(HttPRequest1.readyState == 4) // Return Request 
		{  
			if(HttPRequest1.status==200){
			   Temp_ans = HttPRequest1.responseText; 
				Array_ans=Temp_ans.split("#");
				document.getElementById("1x2").value = Array_ans[0];       
				document.getElementById("1x3").value = Array_ans[1];       
				document.getElementById("1x4").value = Array_ans[2];       
				document.getElementById("1x5").value = Array_ans[3];       
				document.getElementById("3x2").value = Array_ans[4];       
				document.getElementById("3x3").value = Array_ans[5];       
				document.getElementById("3x4").value = Array_ans[6];       
				document.getElementById("3x5").value = Array_ans[7];      				

				document.getElementById("6x2").value = Array_ans[8];       
				document.getElementById("6x3").value = Array_ans[9];       
				document.getElementById("6x4").value = Array_ans[10];       
				document.getElementById("6x5").value = Array_ans[11];      
				document.getElementById("7x2").value = Array_ans[12];       
				document.getElementById("7x3").value = Array_ans[13];       
				document.getElementById("7x4").value = Array_ans[14];       
				document.getElementById("7x5").value = Array_ans[15];   
				// ต้นทุนหมวดที่ 3 ต้นปี + ระหว่างปี       	
				document.getElementById("7x1").value = parseInt(Array_ans[12])+parseInt(Array_ans[13])+parseInt(Array_ans[14])+parseInt(Array_ans[15])+parseInt(Array_ans[16]);  
	        
				document.getElementById("9x2").value = Array_ans[17];       
				document.getElementById("9x3").value = Array_ans[18];       
				document.getElementById("9x4").value = Array_ans[19];       
				document.getElementById("9x5").value = Array_ans[20];      
				document.getElementById("15x2").value = Array_ans[21];       
				document.getElementById("15x3").value = Array_ans[22];       
				document.getElementById("15x4").value = Array_ans[23];       
				document.getElementById("15x5").value = Array_ans[24];      
				document.getElementById("16x2").value = Array_ans[25];       
				document.getElementById("16x3").value = Array_ans[26];       
				document.getElementById("16x4").value = Array_ans[27];       
				document.getElementById("16x5").value = Array_ans[28];
				// ต้นทุนหมวดที่ 4 ต้นปี + ระหว่างปี        
				document.getElementById("16x1").value = parseInt(Array_ans[25])+parseInt(Array_ans[26])+parseInt(Array_ans[27])+parseInt(Array_ans[28])+parseInt(Array_ans[29]); 
				document.getElementById("18x2").value = Array_ans[30];       
				document.getElementById("18x3").value = Array_ans[31];       
				document.getElementById("18x4").value = Array_ans[32];       
				document.getElementById("18x5").value = Array_ans[33];      

				document.getElementById("27x2").value = Array_ans[34];       
				document.getElementById("27x3").value = Array_ans[35];       
				document.getElementById("27x4").value = Array_ans[36];       
				document.getElementById("27x5").value = Array_ans[37];      
				// ค่าใช้จ่ายธุรกิจบริการ
				document.getElementById("30x2").value = Array_ans[38];       
				document.getElementById("30x3").value = Array_ans[39];       
				document.getElementById("30x4").value = Array_ans[40];       
				document.getElementById("30x5").value = Array_ans[41];      
				document.getElementById("32x2").value = Array_ans[42];       
				document.getElementById("32x3").value = Array_ans[43];       
				document.getElementById("32x4").value = Array_ans[44];       
				document.getElementById("32x5").value = Array_ans[45];      
			// ค่าใช้จ่ายธุรกิจสินเชื่อ
				document.getElementById("37x2").value = Array_ans[46];       
				document.getElementById("37x3").value = Array_ans[47];       
				document.getElementById("37x4").value = Array_ans[48];       
				document.getElementById("37x5").value = Array_ans[49];      
			// ค่าใช้จ่ายในการดำเนินงาน
				document.getElementById("62x2").value = Array_ans[50];       
				document.getElementById("62x3").value = Array_ans[51];       
				document.getElementById("62x4").value = Array_ans[52];       
				document.getElementById("62x5").value = Array_ans[53];

				document.getElementById("mySpan").innerHTML = "";        
			} // end 200
		}   // end 4    
	}  // end function
   HttPRequest1.send(null);
 //  สิ้นสุดการดึงข้อมูลแผนการดำเนินงานปี
} // end function doCallAjax
/****************************************************************************************/

// เริ่มต้นดึงข้อมูลผลงานย้อนหลัง
function doCallAjax2() { 
	HttPRequest = false; 
	if (window.XMLHttpRequest) { // Mozilla, Safari,... 
		HttPRequest = new XMLHttpRequest();
		if (HttPRequest.overrideMimeType) { 
			HttPRequest.overrideMimeType('text/html'); 
		}  
	} else if (window.ActiveXObject) { // IE 
	try {     
		HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) { 
			try {    
				HttPRequest = new ActiveXObject("Microsoft.XMLHTTP"); 
				} catch (e) {}
		} 
	}  
        
	if (!HttPRequest) {    
		alert(' ไม่สามารถสร้าง XMLHTTP instance  ไม่สามารถดึงข้อมูลจากระบบได้ ');    
		return false; 
	} 

	var year = document.getElementById("year").value;
	var amc_code = '<?=$amc_code?>';
	var Temp_ans;
	var Array_ans;
	var url2 = 'Ajax_Old_Master.php?year='+year+'&amc_code'+amc_code;      // ดึงข้อมูลผลงานย้อนหลัง
	HttPRequest.open('get',url2,true); 
	HttPRequest.setRequestHeader('Content-Type', 'text/html; charset:windows-874');
	HttPRequest.onreadystatechange = function() 
	{ 
		update_year();
		if(HttPRequest.readyState == 3)  // Loading Request    
		{             
			document.getElementById("mySpan").innerHTML = "Now is Loading...  ( ข้อมูลผลงานย้อนหลัง 3 ปี ) ";        
		}      
		if(HttPRequest.readyState == 4) // Return Request 
		{  		
			if(HttPRequest.status==200){  
			   Temp_ans = HttPRequest.responseText; 
				Array_ans=Temp_ans.split("#");
				var j=0;
				for(i=1;i<=63;i++)
				{
					if( i!=5&&i!=10&&i!=14&&i!=19&&i!=23&&i!=28&&i!=29&&i!=33&&i!=34&&i!=38&&i!=39&&i!=55&&i!=56&&i!=57&&i!=58&&i!=61&&i!=63)
					{
						document.getElementById(i+"y1").value = Array_ans[j];         // ปีที่ 1
						document.getElementById(i+"y2").value = Array_ans[j+46];  // ปีที่ 2
						document.getElementById(i+"y3").value = Array_ans[j+92];  // ปีที่ 3
						j++;
					}
				}
				document.getElementById("mySpan").innerHTML = "";        
				update_master();      //  เรียกฟังก์ชั่นปรับปรุงในแต่ละ colume
			} // end 200
		}   // end 4    
	}  // end function
	HttPRequest.send(null);
} // end ajex
 //  สิ้นสุดการดึงข้อมูลแผนการดำเนินงานปี
/*****************************************************************************************************************************/
// ยืนยันก่อนปรับปรุงข้อมูล		
	function check_submit()
	{
		var temp_01, temp_02, temp_03, temp_04,temp_05;
		var temp_false = false;
		// ตรวจสอบค่าทั้งหมดก่อนว่ามีค่าว่างหรือไม่
		for(i=1;i<=63;i++)
		{
			if( i!=5&&i!=10&&i!=14&&i!=19&&i!=23&&i!=28&&i!=29&&i!=33&&i!=34&&i!=38&&i!=39&&i!=55&&i!=56&&i!=57&&i!=58&&i!=61&&i!=63)
			{
				var temp_01 = document.getElementById(i+'x1').value;
				var temp_02 = document.getElementById(i+'x2').value;
				var temp_03 = document.getElementById(i+'x3').value;
				var temp_04 = document.getElementById(i+'x4').value;
				var temp_05 = document.getElementById(i+'x5').value;
				if(temp_01.length==0 || temp_02.length==0 || temp_03.length==0 || temp_04.length==0 || temp_05.length==0){
					temp_false = true;		
				}  // end if
			} // end if 
			if(i==2 || i==4){
				var temp_01 = document.getElementById(i+'x1').value;
				if(temp_01.length==0)
				{
					temp_false = true;		
				}
			} // end if
		} // end for

		// กรณีที่มีค่าว่างไม่อนุญาตให้แสดงข้อมูล
		if(temp_false==true){
			alert(' กรุณาป้อนข้อมูลตัวเลขให้ครบทุกช่อง ');
			return false;
		}
		if (confirm(" กรุณายืนยันการปรับปรุงข้อมูล ")) {
			return true;
		}
		else{
			return false; 
		}
	} // end function 
// ปรับปรุงข้อมูลในรายไตรมาสมาเป็นรายปี
	function update_rows()
	{
		var a1,a2,a3,a4,a5;
		for(i=1;i<=63;i++){
			if(i!=2 && i!=4 && i!=5 && i!=7 && i!=14 && i!=16 && i!=23 && i!=29 && i!=34){
				a1 = document.getElementById(i+'x1');
				a2 = document.getElementById(i+'x2');
				a3 = document.getElementById(i+'x3');
				a4 = document.getElementById(i+'x4');
				a5 = document.getElementById(i+'x5');
				a1.value = parseInt(a2.value)+parseInt(a3.value)+parseInt(a4.value)+parseInt(a5.value);
			} // end if 
		} // end for
	}  // end function
	// ปรับปรุงข้อมูลกำไร ในหมวดที่ 3 ธุรกิจการซื้อ
	// มูลค่าขาย-ต้นทุน+รายได้เฉพาะธุรกิจ-ค่าใช้จ่ายเฉพาะธุรกิจ
		function update_buy()
		{
			var sum1,sum2,sum3,sum4,sum5;
			sum1=0; sum2=0; sum3=0; sum4=0; sum5=0;
			sum2 = parseInt(document.getElementById('6x2').value)-parseInt(document.getElementById('7x2').value);
			sum3 = parseInt(document.getElementById('6x3').value)-parseInt(document.getElementById('7x3').value);
			sum4 = parseInt(document.getElementById('6x4').value)-parseInt(document.getElementById('7x4').value);
			sum5 = parseInt(document.getElementById('6x5').value)-parseInt(document.getElementById('7x5').value);
			sum2=sum2+parseInt(document.getElementById('8x2').value);
			sum3=sum3+parseInt(document.getElementById('8x3').value);
			sum4=sum4+parseInt(document.getElementById('8x4').value);
			sum5=sum5+parseInt(document.getElementById('8x5').value);
			sum2=sum2-parseInt(document.getElementById('9x2').value);
			sum3=sum3-parseInt(document.getElementById('9x3').value);
			sum4=sum4-parseInt(document.getElementById('9x4').value);
			sum5=sum5-parseInt(document.getElementById('9x5').value);
			document.getElementById('10x2').value=sum2;
			document.getElementById('10x3').value=sum3;
			document.getElementById('10x4').value=sum4;
			document.getElementById('10x5').value=sum5;

			sum1=0; sum2=0; sum3=0;
			sum1=parseInt(document.getElementById('6y1').value)-parseInt(document.getElementById('7y1').value);
			sum2=parseInt(document.getElementById('6y2').value)-parseInt(document.getElementById('7y2').value);
			sum3=parseInt(document.getElementById('6y3').value)-parseInt(document.getElementById('7y3').value);
			sum1=sum1+parseInt(document.getElementById('8y1').value);
			sum2=sum2+parseInt(document.getElementById('8y2').value);
			sum3=sum3+parseInt(document.getElementById('8y3').value);
			sum1=sum1-parseInt(document.getElementById('9y1').value);
			sum2=sum2-parseInt(document.getElementById('9y2').value);
			sum3=sum3-parseInt(document.getElementById('9y3').value);
			document.getElementById('10y1').value=sum1;
			document.getElementById('10y2').value=sum2;
			document.getElementById('10y3').value=sum3;
		}  // end function

		// ปรับปรุงข้อมูลกำไรในหมวดที่ 4 ธุรกิจการขาย
		// มูลค่าขาย-ต้นทุน+รายได้เฉพาะธุรกิจ-ค่าใช้จ่ายเฉพาะธุรกิจ
		function update_sell()
		{
			var sum1,sum2,sum3,sum4,sum5;
			sum1=0; sum2=0; sum3=0; sum4=0; sum5=0;
			sum2 = parseInt(document.getElementById('15x2').value)-parseInt(document.getElementById('16x2').value);
			sum3 = parseInt(document.getElementById('15x3').value)-parseInt(document.getElementById('16x3').value);
			sum4 = parseInt(document.getElementById('15x4').value)-parseInt(document.getElementById('16x4').value);
			sum5 = parseInt(document.getElementById('15x5').value)-parseInt(document.getElementById('16x5').value);
			sum2=sum2+parseInt(document.getElementById('17x2').value);
			sum3=sum3+parseInt(document.getElementById('17x3').value);
			sum4=sum4+parseInt(document.getElementById('17x4').value);
			sum5=sum5+parseInt(document.getElementById('17x5').value);
			sum2=sum2-parseInt(document.getElementById('18x2').value);
			sum3=sum3-parseInt(document.getElementById('18x3').value);
			sum4=sum4-parseInt(document.getElementById('18x4').value);
			sum5=sum5-parseInt(document.getElementById('18x5').value);
			document.getElementById('19x2').value=sum2;
			document.getElementById('19x3').value=sum3;
			document.getElementById('19x4').value=sum4;
			document.getElementById('19x5').value=sum5;

			sum1 = parseInt(document.getElementById('15y1').value)-parseInt(document.getElementById('16y1').value);
			sum2 = parseInt(document.getElementById('15y2').value)-parseInt(document.getElementById('16y2').value);
			sum3 = parseInt(document.getElementById('15y3').value)-parseInt(document.getElementById('16y3').value);
			sum1=sum1+parseInt(document.getElementById('17y1').value);
			sum2=sum2+parseInt(document.getElementById('17y2').value);
			sum3=sum3+parseInt(document.getElementById('17y3').value);
			sum1=sum1-parseInt(document.getElementById('18y1').value);
			sum2=sum2-parseInt(document.getElementById('18y2').value);
			sum3=sum3-parseInt(document.getElementById('18y3').value);
			document.getElementById('19y1').value=sum1;
			document.getElementById('19y2').value=sum2;
			document.getElementById('19y3').value=sum3;
		} // end function

		//  ปรับปรุงข้อมูล ธุรกิจแปรรูปผลผลิต หมวดที่ 5
		function update_transform()
		{
			var sum1,sum2,sum3,sum4,sum5;
			sum1=0; sum2=0; sum3=0; sum4=0; sum5=0;
			sum2 = parseInt(document.getElementById('24x2').value)-parseInt(document.getElementById('25x2').value);
			sum3 = parseInt(document.getElementById('24x3').value)-parseInt(document.getElementById('25x3').value);
			sum4 = parseInt(document.getElementById('24x4').value)-parseInt(document.getElementById('25x4').value);
			sum5 = parseInt(document.getElementById('24x5').value)-parseInt(document.getElementById('25x5').value);
			sum2=sum2+parseInt(document.getElementById('26x2').value);
			sum3=sum3+parseInt(document.getElementById('26x3').value);
			sum4=sum4+parseInt(document.getElementById('26x4').value);
			sum5=sum5+parseInt(document.getElementById('26x5').value);
			sum2=sum2-parseInt(document.getElementById('27x2').value);
			sum3=sum3-parseInt(document.getElementById('27x3').value);
			sum4=sum4-parseInt(document.getElementById('27x4').value);
			sum5=sum5-parseInt(document.getElementById('27x5').value);
			document.getElementById('28x2').value=sum2;
			document.getElementById('28x3').value=sum3;
			document.getElementById('28x4').value=sum4;
			document.getElementById('28x5').value=sum5;			

			sum1 = parseInt(document.getElementById('24y1').value)-parseInt(document.getElementById('25y1').value);
			sum2 = parseInt(document.getElementById('24y2').value)-parseInt(document.getElementById('25y2').value);
			sum3 = parseInt(document.getElementById('24y3').value)-parseInt(document.getElementById('25y3').value);
			sum1=sum1+parseInt(document.getElementById('26y1').value);
			sum2=sum2+parseInt(document.getElementById('26y2').value);
			sum3=sum3+parseInt(document.getElementById('26y3').value);
			sum1=sum1-parseInt(document.getElementById('27y1').value);
			sum2=sum2-parseInt(document.getElementById('27y2').value);
			sum3=sum3-parseInt(document.getElementById('27y3').value);
			document.getElementById('28y1').value=sum1;
			document.getElementById('28y2').value=sum2;
			document.getElementById('28y3').value=sum3;
		} // end function 

		// ปรับปรุงข้อมูลกำไร ในหมวดที่ 6  กำไรธุรกิจบริการ
		function update_service()
		{
			var sum1,sum2,sum3,sum4,sum5;
			sum1=0; sum2=0; sum3=0; sum4=0; sum5=0;
			sum2 = parseInt(document.getElementById('30x2').value)-parseInt(document.getElementById('31x2').value);
			sum3 = parseInt(document.getElementById('30x3').value)-parseInt(document.getElementById('31x3').value);
			sum4 = parseInt(document.getElementById('30x4').value)-parseInt(document.getElementById('31x4').value);
			sum5 = parseInt(document.getElementById('30x5').value)-parseInt(document.getElementById('31x5').value);
			document.getElementById('33x2').value=sum2-parseInt(document.getElementById('32x2').value);
			document.getElementById('33x3').value=sum3-parseInt(document.getElementById('32x3').value);
			document.getElementById('33x4').value=sum4-parseInt(document.getElementById('32x4').value);
			document.getElementById('33x5').value=sum5-parseInt(document.getElementById('32x5').value);

			sum1 = parseInt(document.getElementById('30y1').value)-parseInt(document.getElementById('31y1').value);
			sum2 = parseInt(document.getElementById('30y2').value)-parseInt(document.getElementById('31y2').value);
			sum3 = parseInt(document.getElementById('30y3').value)-parseInt(document.getElementById('31y3').value);
			document.getElementById('33y1').value=sum1-parseInt(document.getElementById('32y1').value);
			document.getElementById('33y2').value=sum2-parseInt(document.getElementById('32y2').value);
			document.getElementById('33y3').value=sum3-parseInt(document.getElementById('32y3').value);
		}

		// ปรับปรุงข้อมูลกำไร ในหมวดที่ 7  กำไรธุรกิจสินเชื่อ
		function update_busniess_loan()
		{
			var sum1,sum2,sum3,sum4,sum5;
			sum1=0; sum2=0; sum3=0; sum4=0; sum5=0;
			sum2 = parseInt(document.getElementById('35x2').value)-parseInt(document.getElementById('36x2').value);
			sum3 = parseInt(document.getElementById('35x3').value)-parseInt(document.getElementById('36x3').value);
			sum4 = parseInt(document.getElementById('35x4').value)-parseInt(document.getElementById('36x4').value);
			sum5 = parseInt(document.getElementById('35x5').value)-parseInt(document.getElementById('36x5').value);
			document.getElementById('38x2').value=sum2-parseInt(document.getElementById('37x2').value);
			document.getElementById('38x3').value=sum3-parseInt(document.getElementById('37x3').value);
			document.getElementById('38x4').value=sum4-parseInt(document.getElementById('37x4').value);
			document.getElementById('38x5').value=sum5-parseInt(document.getElementById('37x5').value);

			sum1 = parseInt(document.getElementById('35y1').value)-parseInt(document.getElementById('36y1').value);
			sum2 = parseInt(document.getElementById('35y2').value)-parseInt(document.getElementById('36y2').value);
			sum3 = parseInt(document.getElementById('35y3').value)-parseInt(document.getElementById('36y3').value);
			document.getElementById('38y1').value=sum1-parseInt(document.getElementById('37y1').value);
			document.getElementById('38y2').value=sum2-parseInt(document.getElementById('37y2').value);
			document.getElementById('38y3').value=sum3-parseInt(document.getElementById('37y3').value);
		}

		// ปรับปรุงข้อมูลในหมวดที่ 8  แผนลงทุนในทรัพย์สิน
		function update_asset()
		{
			var sum1,sum2,sum3,sum4,sum5,sum6,sum7,sum8,sum9,sum10,sum11,sum12,sum13,sum14,sum15;
			sum1=0; sum2=0; sum3=0; sum4=0; sum5=0; sum6=0; sum7=0; sum8=0; sum9=0; sum10=0; sum11=0; sum12=0; sum13=0; sum14=0; sum15=0;
			 for(i=40;i<=54;i++)
			{
				sum2=sum2+parseInt(document.getElementById(i+'x2').value);
				sum3=sum3+parseInt(document.getElementById(i+'x3').value);
				sum4=sum4+parseInt(document.getElementById(i+'x4').value);
				sum5=sum5+parseInt(document.getElementById(i+'x5').value);
				sum6=sum6+parseInt(document.getElementById(i+'y1').value);
				sum7=sum7+parseInt(document.getElementById(i+'y2').value);
				sum8=sum8+parseInt(document.getElementById(i+'y3').value);
			}
			document.getElementById('39x2').value=sum2;
			document.getElementById('39x3').value=sum3;
			document.getElementById('39x4').value=sum4;
			document.getElementById('39x5').value=sum5;
			document.getElementById('39y1').value=sum6;
			document.getElementById('39y2').value=sum7;
			document.getElementById('39y3').value=sum8;
		}

		// ปรับปรุงข้อมูลหมวดที่ 9  แผนการกู้เงิน
		function update_loan()
		{
			var sum1,sum2,sum3,sum4,sum5;
			sum1=0; sum2=0; sum3=0; sum4=0; sum5=0;
			// ชำระต้นเงิน 9.1
			sum2 = parseInt(document.getElementById('12x2').value)+parseInt(document.getElementById('21x2').value);
			sum3 = parseInt(document.getElementById('12x3').value)+parseInt(document.getElementById('21x3').value);
			sum4 = parseInt(document.getElementById('12x4').value)+parseInt(document.getElementById('21x4').value);
			sum5 = parseInt(document.getElementById('12x5').value)+parseInt(document.getElementById('21x5').value);
			document.getElementById('56x2').value=sum2+parseInt(document.getElementById('48x2').value);
			document.getElementById('56x3').value=sum3+parseInt(document.getElementById('48x3').value);
			document.getElementById('56x4').value=sum4+parseInt(document.getElementById('48x4').value);
			document.getElementById('56x5').value=sum5+parseInt(document.getElementById('48x5').value);
			sum1 = parseInt(document.getElementById('12y1').value)+parseInt(document.getElementById('21y1').value);
			sum2 = parseInt(document.getElementById('12y2').value)+parseInt(document.getElementById('21y2').value);
			sum3 = parseInt(document.getElementById('12y3').value)+parseInt(document.getElementById('21y3').value);
			document.getElementById('56y1').value=sum1+parseInt(document.getElementById('48y1').value);
			document.getElementById('56y2').value=sum2+parseInt(document.getElementById('48y2').value);
			document.getElementById('56y3').value=sum3+parseInt(document.getElementById('48y3').value);

			// ชำระดอกเบี้ย 9.2
			sum2 = parseInt(document.getElementById('13x2').value)+parseInt(document.getElementById('22x2').value);
			sum3 = parseInt(document.getElementById('13x3').value)+parseInt(document.getElementById('22x3').value);
			sum4 = parseInt(document.getElementById('13x4').value)+parseInt(document.getElementById('22x4').value);
			sum5 = parseInt(document.getElementById('13x5').value)+parseInt(document.getElementById('22x5').value);
			document.getElementById('57x2').value=sum2+parseInt(document.getElementById('49x2').value);
			document.getElementById('57x3').value=sum3+parseInt(document.getElementById('49x3').value);
			document.getElementById('57x4').value=sum4+parseInt(document.getElementById('49x4').value);
			document.getElementById('57x5').value=sum5+parseInt(document.getElementById('49x5').value);
			sum1 = parseInt(document.getElementById('13y1').value)+parseInt(document.getElementById('22y1').value);
			sum2 = parseInt(document.getElementById('13y2').value)+parseInt(document.getElementById('22y2').value);
			sum3 = parseInt(document.getElementById('13y3').value)+parseInt(document.getElementById('22y3').value);
			document.getElementById('57y1').value=sum1+parseInt(document.getElementById('49y1').value);
			document.getElementById('57y2').value=sum2+parseInt(document.getElementById('49y2').value);
			document.getElementById('57y3').value=sum3+parseInt(document.getElementById('49y3').value);

			// แผนรวมการกู้เงิน ข้อ 9
			sum2 = parseInt(document.getElementById('11x2').value)+parseInt(document.getElementById('20x2').value);
			sum3 = parseInt(document.getElementById('11x3').value)+parseInt(document.getElementById('20x3').value);
			sum4 = parseInt(document.getElementById('11x4').value)+parseInt(document.getElementById('20x4').value);
			sum5 = parseInt(document.getElementById('11x5').value)+parseInt(document.getElementById('20x5').value);
			document.getElementById('55x2').value=sum2+parseInt(document.getElementById('47x2').value);
			document.getElementById('55x3').value=sum3+parseInt(document.getElementById('47x3').value);
			document.getElementById('55x4').value=sum4+parseInt(document.getElementById('47x4').value);
			document.getElementById('55x5').value=sum5+parseInt(document.getElementById('47x5').value);
			sum1 = parseInt(document.getElementById('11y1').value)+parseInt(document.getElementById('20y1').value);
			sum2 = parseInt(document.getElementById('11y2').value)+parseInt(document.getElementById('20y2').value);
			sum3 = parseInt(document.getElementById('11y3').value)+parseInt(document.getElementById('20y3').value);
			document.getElementById('55y1').value=sum1+parseInt(document.getElementById('47y1').value);
			document.getElementById('55y2').value=sum2+parseInt(document.getElementById('47y2').value);
			document.getElementById('55y3').value=sum3+parseInt(document.getElementById('47y3').value);
		}

		// ปรับปรุงข้อมูลหมวดที่ 10 รายได้อื่น ๆ 
		function update_income()
		{
			var sum1,sum2,sum3,sum4,sum5;
			sum1=0; sum2=0; sum3=0; sum4=0; sum5=0;
			sum2 = parseInt(document.getElementById('59x2').value)+parseInt(document.getElementById('60x2').value);
			sum3 = parseInt(document.getElementById('59x3').value)+parseInt(document.getElementById('60x3').value);
			sum4 = parseInt(document.getElementById('59x4').value)+parseInt(document.getElementById('60x4').value);
			sum5 = parseInt(document.getElementById('59x5').value)+parseInt(document.getElementById('60x5').value);
			document.getElementById('58x2').value=sum2;
			document.getElementById('58x3').value=sum3;
			document.getElementById('58x4').value=sum4;
			document.getElementById('58x5').value=sum5;
			sum1 = parseInt(document.getElementById('59y1').value)+parseInt(document.getElementById('60y1').value);
			sum2 = parseInt(document.getElementById('59y2').value)+parseInt(document.getElementById('60y2').value);
			sum3 = parseInt(document.getElementById('59y3').value)+parseInt(document.getElementById('60y3').value);
			document.getElementById('58y1').value=sum1;
			document.getElementById('58y2').value=sum2;
			document.getElementById('58y3').value=sum3;
		} // end function 
		// ปรับปรุงข้อมูลหมวดที่ 11 ค่าใช้จ่ายดำเนินงานทั้งหมด
		function update_expenses()
		{
			var sum1,sum2,sum3,sum4,sum5,sum6,sum7,sum8;
			sum1=0; sum2=0; sum3=0; sum4=0; sum5=0; sum6=0; sum7=0; sum8=0;

			sum2 = parseInt(document.getElementById('9x2').value)+parseInt(document.getElementById('18x2').value);
			sum3 = parseInt(document.getElementById('9x3').value)+parseInt(document.getElementById('18x3').value);
			sum4 = parseInt(document.getElementById('9x4').value)+parseInt(document.getElementById('18x4').value);
			sum5 = parseInt(document.getElementById('9x5').value)+parseInt(document.getElementById('18x5').value);
			sum6 = parseInt(document.getElementById('9y1').value)+parseInt(document.getElementById('18y1').value);
			sum7 = parseInt(document.getElementById('9y2').value)+parseInt(document.getElementById('18y2').value);
			sum8 = parseInt(document.getElementById('9y3').value)+parseInt(document.getElementById('18y3').value);
			sum2 = sum2+parseInt(document.getElementById('27x2').value);
			sum3 = sum3+parseInt(document.getElementById('27x3').value);
			sum4 = sum4+parseInt(document.getElementById('27x4').value);
			sum5 = sum5+parseInt(document.getElementById('27x5').value);
			sum6 = sum6+parseInt(document.getElementById('27y1').value);
			sum7 = sum7+parseInt(document.getElementById('27y2').value);
			sum8 = sum8+parseInt(document.getElementById('27y3').value);

			sum2 = sum2+parseInt(document.getElementById('32x2').value);
			sum3 = sum3+parseInt(document.getElementById('32x3').value);
			sum4 = sum4+parseInt(document.getElementById('32x4').value);
			sum5 = sum5+parseInt(document.getElementById('32x5').value);
			sum6 = sum6+parseInt(document.getElementById('32y1').value);
			sum7 = sum7+parseInt(document.getElementById('32y2').value);
			sum8 = sum8+parseInt(document.getElementById('32y3').value);
			sum2 = sum2+parseInt(document.getElementById('37x2').value);
			sum3 = sum3+parseInt(document.getElementById('37x3').value);
			sum4 = sum4+parseInt(document.getElementById('37x4').value);
			sum5 = sum5+parseInt(document.getElementById('37x5').value);
			sum6 = sum6+parseInt(document.getElementById('37y1').value);
			sum7 = sum7+parseInt(document.getElementById('37y2').value);
			sum8 = sum8+parseInt(document.getElementById('37y3').value);

			document.getElementById('61x2').value=sum2;
			document.getElementById('61x3').value=sum3;
			document.getElementById('61x4').value=sum4;
			document.getElementById('61x5').value=sum5;
			document.getElementById('61y1').value=sum6;
			document.getElementById('61y2').value=sum7;
			document.getElementById('61y3').value=sum8;
		}
		// ปรับปรุงข้อมูลในหมวดที่ 10 กำไร ขาดทุน
		function update_profit()
		{
			var sum1,sum2,sum3,sum4,sum5,sum6,sum7,sum8;
			sum1=0; sum2=0; sum3=0; sum4=0; sum5=0; sum6=0; sum7=0; sum8=0;
		// บวก กำไรซื้อ  กำไรขาด
			sum2 = parseInt(document.getElementById('10x2').value)+parseInt(document.getElementById('19x2').value);
			sum3 = parseInt(document.getElementById('10x3').value)+parseInt(document.getElementById('19x3').value);
			sum4 = parseInt(document.getElementById('10x4').value)+parseInt(document.getElementById('19x4').value);
			sum5 = parseInt(document.getElementById('10x5').value)+parseInt(document.getElementById('19x5').value);
			sum6 = parseInt(document.getElementById('10y1').value)+parseInt(document.getElementById('19y1').value);
			sum7 = parseInt(document.getElementById('10y2').value)+parseInt(document.getElementById('19y2').value);
			sum8 = parseInt(document.getElementById('10y3').value)+parseInt(document.getElementById('19y3').value);
		// เพิ่มกำไร
			sum2= sum2+parseInt(document.getElementById('28x2').value);
			sum3= sum3+parseInt(document.getElementById('28x3').value);
			sum4= sum4+parseInt(document.getElementById('28x4').value);
			sum5= sum5+parseInt(document.getElementById('28x5').value);	
			sum6= sum6+parseInt(document.getElementById('28y1').value);
			sum7= sum7+parseInt(document.getElementById('28y2').value);
			sum8= sum8+parseInt(document.getElementById('28y3').value);	

			sum2= sum2+parseInt(document.getElementById('33x2').value);
			sum3= sum3+parseInt(document.getElementById('33x3').value);
			sum4= sum4+parseInt(document.getElementById('33x4').value);
			sum5= sum5+parseInt(document.getElementById('33x5').value);	
			sum6= sum6+parseInt(document.getElementById('33y1').value);
			sum7= sum7+parseInt(document.getElementById('33y2').value);
			sum8= sum8+parseInt(document.getElementById('33y3').value);	

			sum2= sum2+parseInt(document.getElementById('38x2').value);
			sum3= sum3+parseInt(document.getElementById('38x3').value);
			sum4= sum4+parseInt(document.getElementById('38x4').value);
			sum5= sum5+parseInt(document.getElementById('38x5').value);	
			sum6= sum6+parseInt(document.getElementById('38y1').value);
			sum7= sum7+parseInt(document.getElementById('38y2').value);
			sum8= sum8+parseInt(document.getElementById('38y3').value);	
		// หักการชำระดอกเบี้ย แผนที่ 9 แผนการกู้เงิน
			sum2= sum2-parseInt(document.getElementById('57x2').value);
			sum3= sum3-parseInt(document.getElementById('57x3').value);
			sum4= sum4-parseInt(document.getElementById('57x4').value);
			sum5= sum5-parseInt(document.getElementById('57x5').value);	
			sum6= sum6-parseInt(document.getElementById('57y1').value);
			sum7= sum7-parseInt(document.getElementById('57y2').value);
			sum8= sum8-parseInt(document.getElementById('57y3').value);	
		// เพิ่มรายได้อื่น ๆ 
			sum2= sum2+parseInt(document.getElementById('58x2').value);
			sum3= sum3+parseInt(document.getElementById('58x3').value);
			sum4= sum4+parseInt(document.getElementById('58x4').value);
			sum5= sum5+parseInt(document.getElementById('58x5').value);	
			sum6= sum6+parseInt(document.getElementById('58y1').value);
			sum7= sum7+parseInt(document.getElementById('58y2').value);
			sum8= sum8+parseInt(document.getElementById('58y3').value);	
			// หักค่าใช้จ่ายดำเนินงานทั้งหมด
			sum2= sum2-parseInt(document.getElementById('62x2').value);
			sum3= sum3-parseInt(document.getElementById('62x3').value);
			sum4= sum4-parseInt(document.getElementById('62x4').value);
			sum5= sum5-parseInt(document.getElementById('62x5').value);
			sum6= sum6-parseInt(document.getElementById('62y1').value);
			sum7= sum7-parseInt(document.getElementById('62y2').value);
			sum8= sum8-parseInt(document.getElementById('62y3').value);
			document.getElementById('63x2').value=sum2;
			document.getElementById('63x3').value=sum3;
			document.getElementById('63x4').value=sum4;
			document.getElementById('63x5').value=sum5;
			document.getElementById('63y1').value=sum6;
			document.getElementById('63y2').value=sum7;
			document.getElementById('63y3').value=sum8;

			update_rows();     // เรียกฟังก์ชั่นปรับปรุงในแต่ละ แถว
		}
</script>
</head>
<body>
<br>
<center><div class='button_print'><a href="#" onClick="window.print();return false" alt=" พิมพ์ ">
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/printer.png');" class="span_icon">
<img src="../icons/printer.png" alt=" พิมพ์ " class="images_icon" > 
</span>&nbsp;พิมพ์รายงาน</a></div></center>
<br>
<div style="margin-left:auto; margin-right:auto;  text-align: center "><strong> สรุป แผนการดำเนินงานประจำปี </strong></div>
<!-- ******************************************************************************************************************************************** -->
&nbsp;&nbsp;ข้อมูลปี
<input  name="year" type="text" size="6" class="txt_system" value="<?=$year; ?>"  readonly>
<!-- สิ้นสุดการแสดงปี -->
<span id='mySpan'></span>
<table  width="970" class="gridtable" style="margin-left:5px; margin-right:5px; margin-top:10px;">
	<tr> 
		<td colspan="10" align="left">&nbsp;<font color="#0F7FAF"><b>รายละเอียดแผนการจัดหาสินค้ามาจำหน่ายของ สกต. ปี <?=$year; ?></b></font></td>
	</tr>
 <tr class="rows_pink"> 
    <td rowspan="2" width="20" align="center" valign="middle">ที่</td>
    <td colspan="3" align="center" valign="middle"> ผลงานย้อนหลัง </td>
    <td rowspan="2" width="330" align="center" valign="middle">รายการ</td>
    <td rowspan="2" width="90" align="center">ปริมาณ<br>งานทั้งปี</td>
    <td colspan="4" align="center" valign="middle">แผนการดำเนินงานปี (หน่วย:พันบาท)</td>
  </tr>
  <tr class="rows_pink"> 
    <td width="80" align="center"><span id='year1'></span></td>
    <td width="80" align="center"><span id='year2'></span></td>
    <td width="80" align="center"><span id='year3'></span></td>
    <td width="80" align="center">ไตรมาสที่ 1</td>
    <td width="80" align="center">ไตรมาสที่ 2</td>
    <td width="80" align="center">ไตรมาสที่ 3</td>
	<td width="80" align="center">ไตรมาสที่ 4</td>
  </tr>
  <tr>
	<td align="center">1</td>
	<td align="center"><input type="text" size="7" id="1y1" value="" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="1y2" value="" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="1y3" value="" class="txt_num_system" readonly></td>
	<td align="left">&nbsp;<font color="#0F7FAF">1 รับสมาชิกเพิ่มระหว่างปี (คน)</font></td>
	<td align="center"><input type="text" size="7" id="1x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="1x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="1x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="1x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="1x5" class="txt_num_system" readonly></td>
</tr>
  <tr class='rows_grey'>
	<td align="center">2</td>
	<td align="center"><input type="text" size="7" id="2y1" value="" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="2y2" value="" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="2y3" value="" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; - จำนวนสมาชิกสิ้นปี</td>
	<td align="center"><input type="text" size="7" maxlength='7' id="2x1" name="2x1" value="<?=number_format($fetch_master[0],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" id="2x2" class="txt_num" style="background-color: #ECFFFF;" readonly></td>
	<td align="center"><input type="text" size="7" id="2x3" class="txt_num" style="background-color: #ECFFFF;" readonly></td>
	<td align="center"><input type="text" size="7" id="2x4" class="txt_num" style="background-color: #ECFFFF;" readonly></td>
	<td align="center"><input type="text" size="7" id="2x5" class="txt_num" style="background-color: #ECFFFF;" readonly></td>
</tr>
 <tr>
	<td align="center">3</td>
	<td align="center"><input type="text" size="7" id="3y1" value="" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="3y2" value="" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="3y3" value="" class="txt_num_system" readonly></td>
	<td align="left">&nbsp;<font color="#0F7FAF">2 ทุนเรือนหุ้นเพิ่มระหว่างปี</font></td>
	<td align="center"><input type="text" size="7" id="3x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="3x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="3x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="3x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="3x5" class="txt_num_system" readonly></td>
</tr>
  <tr class='rows_grey'>
	<td align="center">4</td>
	<td align="center"><input type="text" size="7" id="4y1" value="" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="4y2" value="" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="4y3" value="" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; - ทุนเรือนหุ้นสิ้นปี</td>
	<td align="center"><input type="text" size="7" maxlength='7' id="4x1" name="4x1" value="<?=number_format($fetch_master[1],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" id="4x2" class="txt_num"style="background-color: #ECFFFF;" readonly></td>
	<td align="center"><input type="text" size="7" id="4x3" class="txt_num" style="background-color: #ECFFFF;" readonly></td>
	<td align="center"><input type="text" size="7" id="4x4" class="txt_num" style="background-color: #ECFFFF;" readonly></td>
	<td align="center"><input type="text" size="7" id="4x5" class="txt_num" style="background-color: #ECFFFF;" readonly></td>
</tr>
  <tr>
	<td align="center">5</td>
	<td align="center" colspan="3">&nbsp;</td>
	<td align="left">&nbsp;<font color="#0F7FAF">3 ธุรกิจการซื้อ (จัดหาสินค้ามาจำหน่าย)</font></td>
	<td align="center" colspan="5">&nbsp;</td>
</tr>
 <tr class='rows_grey'>
	<td align="center">6</td>
	<td align="center"><input type="text" size="7" id="6y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="6y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="6y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 3.1 มูลค่าขาย</td>
	<td align="center"><input type="text" size="7" id="6x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="6x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="6x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="6x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="6x5" class="txt_num_system" readonly></td>
</tr>
 <tr>
	<td align="center">7</td>
	<td align="center"><input type="text" size="7" id="7y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="7y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="7y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 3.2 ต้นทุน</td>
	<td align="center"><input type="text" size="7" id="7x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="7x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="7x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="7x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="7x5" class="txt_num_system" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">8</td>
	<td align="center"><input type="text" size="7" id="8y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="8y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="8y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 3.3 รายได้เฉพาะธุรกิจ</td>
	<td align="center"><input type="text" size="7" id="8x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="8x2" name="8x2" value="<?=number_format($fetch_master[2],0,'','')?>" class="txt_num"readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="8x3" name="8x3" value="<?=number_format($fetch_master[3],0,'','')?>" class="txt_num"readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="8x4" name="8x4" value="<?=number_format($fetch_master[4],0,'','')?>" class="txt_num"readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="8x5" name="8x5" value="<?=number_format($fetch_master[5],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr>
	<td align="center">9</td>
	<td align="center"><input type="text" size="7" id="9y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="9y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="9y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 3.4 ค่าใช้จ่ายเฉพาะธุรกิจ</td>
	<td align="center"><input type="text" size="7" id="9x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="9x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="9x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="9x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="9x5" class="txt_num_system" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">10</td>
	<td align="center"><input type="text" size="7" id="10y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="10y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="10y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 3.5 กำไร (ข้อ 3.1-3.2+3.3-3.4)</td>
	<td align="center"><input type="text" size="7" id="10x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="10x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="10x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="10x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="10x5" class="txt_num_system" readonly></td>
</tr>
 <tr>
	<td align="center">11</td>
	<td align="center"><input type="text" size="7" id="11y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="11y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="11y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 3.6 เบิกเงินกู้ ฉ.31 ข้อ 2(2)</td>
	<td align="center"><input type="text" size="7" id="11x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="11x2" name="11x2" value="<?=number_format($fetch_master[6],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="11x3" name="11x3" value="<?=number_format($fetch_master[7],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="11x4" name="11x4" value="<?=number_format($fetch_master[8],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="11x5" name="11x5" value="<?=number_format($fetch_master[9],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">12</td>
	<td align="center"><input type="text" size="7" id="12y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="12y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="12y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 3.7 ชำระต้นเงิน</td>
	<td align="center"><input type="text" size="7" id="12x1" value="" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="12x2" name="12x2" value="<?=number_format($fetch_master[10],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="12x3" name="12x3" value="<?=number_format($fetch_master[11],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="12x4" name="12x4" value="<?=number_format($fetch_master[12],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="12x5" name="12x5" value="<?=number_format($fetch_master[13],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr>
	<td align="center">13</td>
	<td align="center"><input type="text" size="7" id="13y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="13y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="13y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 3.8 ชำระดอกเบี้ย</td>
	<td align="center"><input type="text" size="7" id="13x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="13x2" name="13x2" value="<?=number_format($fetch_master[14],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="13x3" name="13x3" value="<?=number_format($fetch_master[15],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="13x4" name="13x4" value="<?=number_format($fetch_master[16],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="13x5" name="13x5" value="<?=number_format($fetch_master[17],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">14</td>
	<td align="center" colspan="3">&nbsp;</td>
	<td align="left">&nbsp;<font color="#0F7FAF">4 ธุรกิจการขาย (รวบรวมผลิตผล)</font></td>
	<td align="center" colspan="5">&nbsp;</td>
</tr>
 <tr>
	<td align="center">15</td>
	<td align="center"><input type="text" size="7" id="15y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="15y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="15y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 4.1 มูลค่าขาย</td>
	<td align="center"><input type="text" size="7" id="15x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="15x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="15x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="15x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="15x5" class="txt_num_system" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">16</td>
	<td align="center"><input type="text" size="7" id="16y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="16y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="16y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 4.2 ต้นทุน</td>
	<td align="center"><input type="text" size="7" id="16x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="16x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="16x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="16x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="16x5" class="txt_num_system" readonly></td>
</tr>
 <tr>
	<td align="center">17</td>
	<td align="center"><input type="text" size="7" id="17y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="17y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="17y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 4.3 รายได้เฉพาะธุรกิจ</td>
	<td align="center"><input type="text" size="7" id="17x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="17x2" name="17x2" value="<?=number_format($fetch_master[18],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="17x3" name="17x3" value="<?=number_format($fetch_master[19],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="17x4" name="17x4" value="<?=number_format($fetch_master[20],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="17x5" name="17x5" value="<?=number_format($fetch_master[21],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">18</td>
	<td align="center"><input type="text" size="7" id="18y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="18y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="18y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 4.4 ค่าใช้จ่ายเฉพาะธุรกิจ</td>
	<td align="center"><input type="text" size="7" id="18x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="18x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="18x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="18x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="18x5" class="txt_num_system" readonly></td>
</tr>
 <tr>
	<td align="center">19</td>
	<td align="center"><input type="text" size="7" id="19y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="19y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="19y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 4.5 กำไร(ข้อ 4.1-4.2+4.3-4.4)</td>
	<td align="center"><input type="text" size="7" id="19x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="19x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="19x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="19x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="19x5" class="txt_num_system" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">20</td>
	<td align="center"><input type="text" size="7" id="20y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="20y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="20y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 4.6 เบิกเงินกู้ ฉ.31 ข้อ 2(3)</td>
	<td align="center"><input type="text" size="7" id="20x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="20x2" name="20x2" value="<?=number_format($fetch_master[22],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="20x3" name="20x3" value="<?=number_format($fetch_master[23],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="20x4" name="20x4" value="<?=number_format($fetch_master[24],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="20x5" name="20x5" value="<?=number_format($fetch_master[25],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr>
	<td align="center">21</td>
	<td align="center"><input type="text" size="7" id="21y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="21y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="21y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 4.7 ชำระต้นเงิน </td>
	<td align="center"><input type="text" size="7" id="21x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="21x2" name="21x2" value="<?=number_format($fetch_master[26],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="21x3" name="21x3" value="<?=number_format($fetch_master[27],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="21x4" name="21x4" value="<?=number_format($fetch_master[28],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="21x5" name="21x5" value="<?=number_format($fetch_master[29],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">22</td>
	<td align="center"><input type="text" size="7" id="22y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="22y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="22y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 4.8 ชำระดอกเบี้ย</td>
	<td align="center"><input type="text" size="7" id="22x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="22x2" name="22x2" value="<?=number_format($fetch_master[30],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="22x3" name="22x3" value="<?=number_format($fetch_master[31],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="22x4" name="22x4" value="<?=number_format($fetch_master[32],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="22x5" name="22x5" value="<?=number_format($fetch_master[33],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr>
	<td align="center">23</td>
	<td align="center" colspan="3">&nbsp;</td>
	<td align="left">&nbsp;<font color="#0F7FAF">5 ธุรกิจแปรรูปผลผลิต และผลิตสินค้า </font></td>
	<td align="center" colspan="5">&nbsp;</td>
</tr>
 <tr class='rows_grey'>
	<td align="center">24</td>
	<td align="center"><input type="text" size="7" id="24y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="24y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="24y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 5.1 มูลค่าขาย</td>
	<td align="center"><input type="text" size="7" id="24x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="24x2" name="24x2" value="<?=number_format($fetch_master[34],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" id="24x3" name="24x3" value="<?=number_format($fetch_master[35],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" id="24x4" name="24x4" value="<?=number_format($fetch_master[36],0,'','')?>" class="txt_num" readonly ></td>
	<td align="center"><input type="text" size="7" id="24x5" name="24x5" value="<?=number_format($fetch_master[37],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">25</td>
	<td align="center"><input type="text" size="7" id="25y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="25y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="25y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 5.2 ต้นทุน</td>
	<td align="center"><input type="text" size="7" id="25x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="25x2" name="25x2" value="<?=number_format($fetch_master[38],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" id="25x3" name="25x3" value="<?=number_format($fetch_master[39],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" id="25x4" name="25x4" value="<?=number_format($fetch_master[40],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" id="25x5" name="25x5" value="<?=number_format($fetch_master[41],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">26</td>
	<td align="center"><input type="text" size="7" id="26y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="26y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="26y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 5.3 รายได้เฉพาะธุรกิจ</td>
	<td align="center"><input type="text" size="7" id="26x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="26x2" name="26x2" value="<?=number_format($fetch_master[42],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" id="26x3" name="26x3" value="<?=number_format($fetch_master[43],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" id="26x4" name="26x4" value="<?=number_format($fetch_master[44],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" id="26x5" name="26x5" value="<?=number_format($fetch_master[45],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">27</td>
	<td align="center"><input type="text" size="7" id="27y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="27y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="27y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 5.4 ค่าใช้จ่ายเฉพาะธุรกิจ</td>
	<td align="center"><input type="text" size="7" id="27x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="27x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="27x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="27x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="27x5" class="txt_num_system" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">28</td>
	<td align="center"><input type="text" size="7" id="28y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="28y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="28y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 5.5 กำไร</td>
	<td align="center"><input type="text" size="7" id="28x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="28x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="28x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="28x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="28x5" class="txt_num_system" readonly></td>
</tr>
 <tr>
	<td align="center">29</td>
	<td align="center" colspan="3">&nbsp;</td>
	<td align="left">&nbsp;<font color="#0F7FAF">6 ธุรกิจบริการ </font></td>
	<td align="center" colspan="5">&nbsp;</td>
</tr>
 <tr class='rows_grey'>
	<td align="center">30</td>
	<td align="center"><input type="text" size="7" id="30y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="30y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="30y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 6.1 รายได้</td>
	<td align="center"><input type="text" size="7" id="30x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="30x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="30x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="30x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="30x5" class="txt_num_system" readonly></td>
</tr>
 <tr>
	<td align="center">31</td>
	<td align="center"><input type="text" size="7" id="31y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="31y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="31y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 6.2 ต้นทุน</td>
	<td align="center"><input type="text" size="7" id="31x1" value="" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="31x2" name="31x2" value="<?=number_format($fetch_master[46],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="31x3" name="31x3" value="<?=number_format($fetch_master[47],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="31x4" name="31x4" value="<?=number_format($fetch_master[48],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="31x5" name="31x5" value="<?=number_format($fetch_master[49],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">32</td>
	<td align="center"><input type="text" size="7" id="32y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="32y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="32y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 6.3 ค่าใช้จ่ายเฉพาะธุรกิจ</td>
	<td align="center"><input type="text" size="7" id="32x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="32x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="32x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="32x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="32x5" class="txt_num_system" readonly></td>
</tr>
 <tr>
	<td align="center">33</td>
	<td align="center"><input type="text" size="7" id="33y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="33y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="33y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 6.4 กำไร (ข้อ 6.1-6.2-6.3)</td>
	<td align="center"><input type="text" size="7" id="33x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="33x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="33x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="33x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="33x5" class="txt_num_system" readonly></td>
</tr>
 <tr>
	<td align="center">34</td>
	<td align="center" colspan="3">&nbsp;</td>
	<td align="left">&nbsp;<font color="#0F7FAF">7 ธุรกิจสินเชื่อ </font></td>
	<td align="center" colspan="5">&nbsp;</td>
</tr>
 <tr class='rows_grey'>
	<td align="center">35</td>
	<td align="center"><input type="text" size="7" id="35y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="35y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="35y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 7.1 รายได้</td>
	<td align="center"><input type="text" size="7" id="35x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="35x2" name="35x2" value="<?=number_format($fetch_master[50],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" id="35x3" name="35x3" value="<?=number_format($fetch_master[51],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" id="35x4" name="35x4" value="<?=number_format($fetch_master[52],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" id="35x5" name="35x5" value="<?=number_format($fetch_master[53],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr>
	<td align="center">36</td>
	<td align="center"><input type="text" size="7" id="36y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="36y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="36y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 7.2 ต้นทุน</td>
	<td align="center"><input type="text" size="7" id="36x1" value="" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="36x2" name="36x2" value="<?=number_format($fetch_master[54],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="36x3" name="36x3" value="<?=number_format($fetch_master[55],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="36x4" name="36x4" value="<?=number_format($fetch_master[56],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="36x5" name="36x5" value="<?=number_format($fetch_master[57],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">37</td>
	<td align="center"><input type="text" size="7" id="37y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="37y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="37y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 7.3 ค่าใช้จ่ายเฉพาะธุรกิจ</td>
	<td align="center"><input type="text" size="7" id="37x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="37x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="37x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="37x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="37x5" class="txt_num_system" readonly></td>
</tr>
 <tr>
	<td align="center">38</td>
	<td align="center"><input type="text" size="7" id="38y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="38y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="38y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 7.4 กำไร (ข้อ 7.1-7.2-7.3)</td>
	<td align="center"><input type="text" size="7" id="38x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="38x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="38x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="38x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="38x5" class="txt_num_system" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">39</td>
	<td align="center"><input type="text" size="7" id="39y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="39y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="39y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp;<font color="#0F7FAF">8 แผนลงทุนในทรัพย์สิน (ข้อ 8.1 ถึง 8.15)</font></td>
	<td align="center"><input type="text" size="7" id="39x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="39x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="39x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="39x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="39x5" class="txt_num_system" readonly></td>
</tr>
 <tr>
	<td align="center">40</td>
	<td align="center"><input type="text" size="7" id="40y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="40y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="40y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 8.1 ซื้อที่ดิน</td>
	<td align="center"><input type="text" size="7" id="40x1" name="40x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="40x2" name="40x2" value="<?=number_format($fetch_master[58],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="40x3" name="40x3" value="<?=number_format($fetch_master[59],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="40x4" name="40x4" value="<?=number_format($fetch_master[60],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="40x5" name="40x5" value="<?=number_format($fetch_master[61],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">41</td>
	<td align="center"><input type="text" size="7" id="41y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="41y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="41y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 8.2 ซื้อรถยนต์</td>
	<td align="center"><input type="text" size="7" id="41x1"  name="41x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="41x2" name="41x2" value="<?=number_format($fetch_master[62],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="41x3" name="41x3" value="<?=number_format($fetch_master[63],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="41x4" name="41x4" value="<?=number_format($fetch_master[64],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="41x5" name="41x5" value="<?=number_format($fetch_master[65],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr>
	<td align="center">42</td>
	<td align="center"><input type="text" size="7" id="42y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="42y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="42y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 8.3 เครื่องใช้สำนักงานและอื่น ๆ </td>
	<td align="center"><input type="text" size="7" id="42x1" name="42x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="42x2" name="42x2" value="<?=number_format($fetch_master[66],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="42x3" name="42x3" value="<?=number_format($fetch_master[67],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="42x4" name="42x4" value="<?=number_format($fetch_master[68],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="42x5" name="42x5" value="<?=number_format($fetch_master[69],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">43</td>
	<td align="center"><input type="text" size="7" id="43y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="43y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="43y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 8.4 ซื้อรถหกล้อ</td>
	<td align="center"><input type="text" size="7" id="43x1" name="43x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="43x2" name="43x2" value="<?=number_format($fetch_master[70],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="43x3" name="43x3" value="<?=number_format($fetch_master[71],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="43x4" name="43x4" value="<?=number_format($fetch_master[72],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="43x5" name="43x5" value="<?=number_format($fetch_master[73],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr>
	<td align="center">44</td>
	<td align="center"><input type="text" size="7" id="44y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="44y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="44y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 8.5 สร้างที่เก็บสินค้า</td>
	<td align="center"><input type="text" size="7" id="44x1" name="44x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="44x2" name="44x2" value="<?=number_format($fetch_master[74],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="44x3" name="44x3" value="<?=number_format($fetch_master[75],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="44x4" name="44x4" value="<?=number_format($fetch_master[76],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="44x5" name="44x5" value="<?=number_format($fetch_master[77],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">45</td>
	<td align="center"><input type="text" size="7" id="45y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="45y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="45y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 8.6 ซื้อรถจักรยานยนต์</td>
	<td align="center"><input type="text" size="7" id="45x1" name="45x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="45x2" name="45x2" value="<?=number_format($fetch_master[78],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="45x3" name="45x3" value="<?=number_format($fetch_master[79],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="45x4" name="45x4" value="<?=number_format($fetch_master[80],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="45x5" name="45x5" value="<?=number_format($fetch_master[81],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr>
	<td align="center">46</td>
	<td align="center"><input type="text" size="7" id="46y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="46y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="46y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 8.7 สร้างโรงสี </td>
	<td align="center"><input type="text" size="7" id="46x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="46x2" name="46x2" value="<?=number_format($fetch_master[82],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="46x3" name="46x3" value="<?=number_format($fetch_master[83],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="46x4" name="46x4" value="<?=number_format($fetch_master[84],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="46x5" name="46x5" value="<?=number_format($fetch_master[85],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">47</td>
	<td align="center"><input type="text" size="7" id="47y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="47y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="47y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 8.8 เบิกเงินกู้ ฉ.26</td>
	<td align="center"><input type="text" size="7" id="47x1" name="47x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="47x2" name="47x2" value="<?=number_format($fetch_master[86],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="47x3" name="47x3" value="<?=number_format($fetch_master[87],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="47x4" name="47x4" value="<?=number_format($fetch_master[88],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="47x5" name="47x5" value="<?=number_format($fetch_master[89],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr>
	<td align="center">48</td>
	<td align="center"><input type="text" size="7" id="48y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="48y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="48y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 8.9 ชำระต้นเงิน </td>
	<td align="center"><input type="text" size="7" id="48x1" name="48x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="48x2" name="48x2"  value="<?=number_format($fetch_master[90],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="48x3" name="48x3"  value="<?=number_format($fetch_master[91],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="48x4" name="48x4"  value="<?=number_format($fetch_master[92],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="48x5" name="48x5"  value="<?=number_format($fetch_master[93],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">49</td>
	<td align="center"><input type="text" size="7" id="49y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="49y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="49y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 8.10 ชำระดอกเบี้ย</td>
	<td align="center"><input type="text" size="7" id="49x1" name="49x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="49x2" name="49x2"  value="<?=number_format($fetch_master[94],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="49x3" name="49x3"  value="<?=number_format($fetch_master[95],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="49x4" name="49x4"  value="<?=number_format($fetch_master[96],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="49x5" name="49x5"  value="<?=number_format($fetch_master[97],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">50</td>
	<td align="center"><input type="text" size="7" id="50y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="50y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="50y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 8.11 สร้างอาคารสำนักงาน</td>
	<td align="center"><input type="text" size="7" id="50x1" name="50x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="50x2" name="50x2"  value="<?=number_format($fetch_master[98],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="50x3" name="50x3"  value="<?=number_format($fetch_master[99],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="50x4" name="50x4"  value="<?=number_format($fetch_master[100],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="50x5" name="50x5"  value="<?=number_format($fetch_master[101],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">51</td>
	<td align="center"><input type="text" size="7" id="51y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="51y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="51y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 8.12 สร้างยุ้งฉาง </td>
	<td align="center"><input type="text" size="7" id="51x1" name="51x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="51x2" name="51x2"  value="<?=number_format($fetch_master[102],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="51x3" name="51x3"  value="<?=number_format($fetch_master[103],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="51x4" name="51x4"  value="<?=number_format($fetch_master[104],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="51x5" name="51x5"  value="<?=number_format($fetch_master[105],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">52</td>
	<td align="center"><input type="text" size="7" id="52y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="52y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="52y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 8.13 สร้างลานตาก</td>
	<td align="center"><input type="text" size="7" id="52x1" name="52x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="52x2" name="52x2"  value="<?=number_format($fetch_master[106],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="52x3" name="52x3"  value="<?=number_format($fetch_master[107],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="52x4" name="52x4"  value="<?=number_format($fetch_master[108],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="52x5" name="52x5"  value="<?=number_format($fetch_master[109],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">53</td>
	<td align="center"><input type="text" size="7" id="53y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="53y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="53y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 8.14 ซื้อเครื่องจักรและอุปกรณ์</td>
	<td align="center"><input type="text" size="7" id="53x1" name="53x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="53x2" name="53x2"  value="<?=number_format($fetch_master[110],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="53x3" name="53x3"  value="<?=number_format($fetch_master[111],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="53x4" name="53x4"  value="<?=number_format($fetch_master[112],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="53x5" name="53x5"  value="<?=number_format($fetch_master[113],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">54</td>
	<td align="center"><input type="text" size="7" id="54y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="54y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="54y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 8.15 อื่น ๆ </td>
	<td align="center"><input type="text" size="7" id="54x1" name="54x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="54x2" name="54x2"  value="<?=number_format($fetch_master[114],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="54x3" name="54x3"  value="<?=number_format($fetch_master[115],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="54x4" name="54x4"  value="<?=number_format($fetch_master[116],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="54x5" name="54x5"  value="<?=number_format($fetch_master[117],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr>
	<td align="center">55</td>
	<td align="center"><input type="text" size="7" id="55y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="55y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="55y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp;<font color="#0F7FAF">9 แผนการกู้เงิน (ข้อ 3.6+4.6+6.8) </font></td>
	<td align="center"><input type="text" size="7" id="55x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="55x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="55x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="55x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="55x5" class="txt_num_system" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">56</td>
	<td align="center"><input type="text" size="7" id="56y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="56y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="56y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 9.1 ชำระต้นเงิน (ข้อ 3.7+4.7+6.9)</td>
	<td align="center"><input type="text" size="7" id="56x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="56x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="56x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="56x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="56x5" class="txt_num_system" readonly></td>
</tr>
 <tr>
	<td align="center">57</td>
	<td align="center"><input type="text" size="7" id="57y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="57y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="57y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 9.2 ชำระดอกเบี้ย( ข้อ3.8+4.8+6.10)</td>
	<td align="center"><input type="text" size="7" id="57x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="57x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="57x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="57x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="57x5" class="txt_num_system" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">58</td>
	<td align="center"><input type="text" size="7" id="58y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="58y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="58y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp;<font color="#0F7FAF">10 รายได้อื่น (ข้อ 10.1+10.2 ) </font></td>
	<td align="center"><input type="text" size="7" id="58x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="58x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="58x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="58x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="58x5" class="txt_num_system" readonly></td>
</tr>
 <tr>
	<td align="center">59</td>
	<td align="center"><input type="text" size="7" id="59y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="59y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="59y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 10.1 รายได้ดอกเบี้ยเงินฝากธนาคาร</td>
	<td align="center"><input type="text" size="7" id="59x1" value="" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="59x2" name="59x2" value="<?=number_format($fetch_master[118],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="59x3" name="59x3" value="<?=number_format($fetch_master[119],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="59x4" name="59x4" value="<?=number_format($fetch_master[120],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="59x5" name="59x5" value="<?=number_format($fetch_master[121],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">60</td>
	<td align="center"><input type="text" size="7" id="60y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="60y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="60y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 10.2 รายได้อื่น ๆ </td>
	<td align="center"><input type="text" size="7" id="60x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="60x2" name="60x2" value="<?=number_format($fetch_master[122],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="60x3" name="60x3" value="<?=number_format($fetch_master[123],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="60x4" name="60x4" value="<?=number_format($fetch_master[124],0,'','')?>" class="txt_num" readonly></td>
	<td align="center"><input type="text" size="7" maxlength="7"  id="60x5" name="60x5" value="<?=number_format($fetch_master[125],0,'','')?>" class="txt_num" readonly></td>
</tr>
 <tr>
	<td align="center">61</td>
	<td align="center"><input type="text" size="7" id="61y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="61y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="61y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp;<font color="#0F7FAF">11 ค่าใช้จ่ายดำเนินงาน + ธุรกิจทั้งหมด </font></td>
	<td align="center"><input type="text" size="7" id="61x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="61x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="61x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="61x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="61x5" class="txt_num_system" readonly></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">62</td>
	<td align="center"><input type="text" size="7" id="62y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="62y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="62y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp; 11.1 ค่าใช้จ่ายดำเนินงาน </td>
	<td align="center"><input type="text" size="7" id="62x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="62x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="62x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="62x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="62x5" class="txt_num_system" readonly></td>
</tr>
 <tr>
	<td align="center">63</td>
	<td align="center"><input type="text" size="7" id="63y1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="63y2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="63y3" class="txt_num_system" readonly></td>
	<td align="left">&nbsp;<font color="#0F7FAF">12.กำไร(ขาดทุน)สุทธิ </font></td>
	<td align="center"><input type="text" size="7" id="63x1" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="63x2" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="63x3" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="63x4" class="txt_num_system" readonly></td>
	<td align="center"><input type="text" size="7" id="63x5" class="txt_num_system" readonly></td>
</tr>
 <tr height="30" class="rows_pink">
	<td align="left" colspan='10'>&nbsp; กำไร(ขาดทุน)สุทธิ = 3.5 + 4.5 + 5.5 + 6.4 + 7.4 - 9.2 - 10 - 11.1</td>
</tr>
<!--  สิ้นสุดปรับปรุงข้อมูล -->
<script language="JavaScript">
		update_ajax();
		var t=setTimeout(" update_master(); ",3000);
</script>
</table>
<br>
<br>
</body>
</html>
<!-- *********************************************************** -->
<?php
	close();
?>