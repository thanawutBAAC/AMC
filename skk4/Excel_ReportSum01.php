<?php session_start();
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();

	$div = trim($_GET['div']);
	$year = trim($_GET['year']);

    $sql=" SELECT ";   // ข้อมูลจาก PlanMaster
	$sql.=" SUM(member_year), SUM(share_year), ";
	$sql.=" SUM(buy_income_first), SUM(buy_income_second), SUM(buy_income_third), SUM(buy_income_fourth), ";
	$sql.=" SUM(buy_expenses_first), SUM(buy_expenses_second), SUM(buy_expenses_third), SUM(buy_expenses_fourth), ";
	$sql.=" SUM(buy_loan_first), SUM(buy_loan_second), SUM(buy_loan_third), SUM(buy_loan_fourth), ";
	$sql.=" SUM(buy_principal_first), SUM(buy_principal_second), SUM(buy_principal_third), SUM(buy_principal_fourth), ";
	$sql.=" SUM(buy_interest_first), SUM(buy_interest_second), SUM(buy_interest_third), SUM(buy_interest_fourth), ";
	$sql.=" SUM(sell_income_first), SUM(sell_income_second), SUM(sell_income_third), SUM(sell_income_fourth), ";
	$sql.=" SUM(sell_expenses_first), SUM(sell_expenses_second), SUM(sell_expenses_third), SUM(sell_expenses_fourth), ";
	$sql.=" SUM(sell_loan_first), SUM(sell_loan_second),SUM(sell_loan_third), SUM(sell_loan_fourth), ";
	$sql.=" SUM(sell_principal_first), SUM(sell_principal_second), SUM(sell_principal_third), SUM(sell_principal_fourth), ";
	$sql.=" SUM(sell_interest_first), SUM(sell_interest_second), SUM(sell_interest_third), SUM(sell_interest_fourth), ";
	$sql.=" SUM(service_capital_first), SUM(service_capital_second), SUM(service_capital_third), SUM(service_capital_fourth), ";
	$sql.=" SUM(service_expenses_first), SUM(service_expenses_second), SUM(service_expenses_third), SUM(service_expenses_fourth), ";
	$sql.=" SUM(asset_61_first), SUM(asset_61_second), SUM(asset_61_third), SUM(asset_61_fourth), ";
	$sql.=" SUM(asset_62_first), SUM(asset_62_second), SUM(asset_62_third), SUM(asset_62_fourth), ";
	$sql.=" SUM(asset_63_first), SUM(asset_63_second), SUM(asset_63_third), SUM(asset_63_fourth), ";
	$sql.=" SUM(asset_64_first), SUM(asset_64_second), SUM(asset_64_third), SUM(asset_64_fourth), ";
	$sql.=" SUM(asset_65_first), SUM(asset_65_second), SUM(asset_65_third), SUM(asset_65_fourth), ";
	$sql.=" SUM(asset_66_first), SUM(asset_66_second), SUM(asset_66_third), SUM(asset_66_fourth), ";
	$sql.=" SUM(asset_67_first), SUM(asset_67_second), SUM(asset_67_third), SUM(asset_67_fourth), ";
	$sql.=" SUM(asset_68_first), SUM(asset_68_second), SUM(asset_68_third), SUM(asset_68_fourth), ";
	$sql.=" SUM(asset_69_first), SUM(asset_69_second), SUM(asset_69_third), SUM(asset_69_fourth), ";
	$sql.=" SUM(asset_610_first), SUM(asset_610_second), SUM(asset_610_third), SUM(asset_610_fourth), ";
	$sql.=" SUM(income_interest_first), SUM(income_interest_second), SUM(income_interest_third), SUM(income_interset_fourth), ";
	$sql.=" SUM(income_other_first), SUM(income_other_second), SUM(income_other_third), SUM(income_other_fourth), ";
	$sql.="  PlanMaster.Plan_year  ";
	$sql.=" FROM PlanMaster, userlogin ";
	$sql.=" WHERE PlanMaster.Plan_year='".$year."' ";
	$sql.=" AND userlogin.amccode = PlanMaster.amccode ";
	$sql.=" AND userlogin.status='N'  ";
	if($div!=0)
	{	$sql.=" AND userlogin.br_code = '".$div."' ";	}
	$sql.=" GROUP BY  PlanMaster.Plan_year ";

	$result_master = query($sql);
	$fetch_master = fetch_row($result_master);

	free_result($result_master);  

?>
<html  xmlns:o="urn:schemas-microsoft-com:office:office" 
xmlns:x="urn:schemas-microsoft-com:office:excel" 
xmlns="http://www.w3.org/TR/REC-html40">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript">

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
	update_rows();           // ปรับปรุงข้อมูล ไตรมาสเป็นรายปี
	update_buy();                 // หมวดที่ 3 
	update_sell();                 // หมวดที่ 4
	update_service();         // หมวดที่ 5
	update_asset();            // หมวดที่ 6
	update_loan();              // หมวดที่ 7
	update_income();        // หมวดที่ 8
	update_expenses();   // หมวดที่ 9
	update_profit();             // หมวดที่ 10 
}

/***********************************************************************************************/
// เริ่มต้นดึงข้อมูลแผนการดำเนินงานปี
function doCallAjax1() { 
	HttPRequest = false; 
	if (window.XMLHttpRequest) { // Mozilla, Safari,... 
		HttPRequest1 = new XMLHttpRequest();
		if (HttPRequest1.overrNameeMimeType) { 
			HttPRequest1.overrNameeMimeType('text/html'); 
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
	var div = "<?=$div?>";
	var Temp_ans;
	var Array_ans;
	var url1 = 'Ajax_Frame_Master.php?year='+year+'&div='+div;               // ดึงข้อมูลแผนการดำเนินงานปี
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
				document.getElementById("1x2").innerHTML = Array_ans[0];       
				document.getElementById("1x3").innerHTML = Array_ans[1];       
				document.getElementById("1x4").innerHTML = Array_ans[2];       
				document.getElementById("1x5").innerHTML = Array_ans[3];       
				document.getElementById("3x2").innerHTML = Array_ans[4];       
				document.getElementById("3x3").innerHTML = Array_ans[5];       
				document.getElementById("3x4").innerHTML = Array_ans[6];       
				document.getElementById("3x5").innerHTML = Array_ans[7];      				
				document.getElementById("6x2").innerHTML = Array_ans[8];       
				document.getElementById("6x3").innerHTML = Array_ans[9];       
				document.getElementById("6x4").innerHTML = Array_ans[10];       
				document.getElementById("6x5").innerHTML = Array_ans[11];      
				document.getElementById("7x2").innerHTML = Array_ans[12];       
				document.getElementById("7x3").innerHTML = Array_ans[13];       
				document.getElementById("7x4").innerHTML = Array_ans[14];       
				document.getElementById("7x5").innerHTML = Array_ans[15];      
				document.getElementById("15x2").innerHTML = Array_ans[16];       
				document.getElementById("15x3").innerHTML = Array_ans[17];       
				document.getElementById("15x4").innerHTML = Array_ans[18];       
				document.getElementById("15x5").innerHTML = Array_ans[19];      
				document.getElementById("16x2").innerHTML = Array_ans[20];       
				document.getElementById("16x3").innerHTML = Array_ans[21];       
				document.getElementById("16x4").innerHTML = Array_ans[22];       
				document.getElementById("16x5").innerHTML = Array_ans[23];      
				document.getElementById("24x2").innerHTML = Array_ans[24];       
				document.getElementById("24x3").innerHTML = Array_ans[25];       
				document.getElementById("24x4").innerHTML = Array_ans[26];       
				document.getElementById("24x5").innerHTML = Array_ans[27];      
				document.getElementById("46x2").innerHTML = Array_ans[28];       
				document.getElementById("46x3").innerHTML = Array_ans[29];       
				document.getElementById("46x4").innerHTML = Array_ans[30];       
				document.getElementById("46x5").innerHTML = Array_ans[31];      
				document.getElementById("47x2").innerHTML = Array_ans[32];       
				document.getElementById("47x3").innerHTML = Array_ans[33];       
				document.getElementById("47x4").innerHTML = Array_ans[34];       
				document.getElementById("47x5").innerHTML = Array_ans[35];      
				document.getElementById("48x2").innerHTML = Array_ans[36];       
				document.getElementById("48x3").innerHTML = Array_ans[37];       
				document.getElementById("48x4").innerHTML = Array_ans[38];       
				document.getElementById("48x5").innerHTML = Array_ans[39];      
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
		if (HttPRequest.overrNameeMimeType) { 
			HttPRequest.overrNameeMimeType('text/html'); 
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
	var year = document.getElementById("year").value
	var div = "<?=$div?>";
	var Temp_ans;
	var Array_ans;
	var url2 = 'Ajax_Frame_Old_Master.php?year='+year+'&div='+div;      // ดึงข้อมูลผลงานย้อนหลัง
	HttPRequest.open('get',url2,true); 
	HttPRequest.setRequestHeader('Content-Type', 'text/html; charset:windows-874');
	HttPRequest.onreadystatechange = function() 
	{ 
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
				for(i=1;i<=49;i++)
				{
					if( i!=5&&i!=10&&i!=14&&i!=19&&i!=23&& i!=27&&i!=28&&i!=39&&i!=40&&i!=41&&i!=42&&i!=45&&i!=49  )
					{
						document.getElementById(i+"y1").innerHTML = Array_ans[j];         // ปีที่ 1
						document.getElementById(i+"y2").innerHTML = Array_ans[j+36];  // ปีที่ 2
						document.getElementById(i+"y3").innerHTML = Array_ans[j+72];  // ปีที่ 3
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

// ปรับปรุงข้อมูลในรายไตรมาสมาเป็นรายปี
	function update_rows()
	{
		var a1,a2,a3,a4,a5;
		for(i=1;i<=49;i++)
		{
			if(i!=2 && i!=4 && i!=5 && i!=14 && i!=23)
			{
				a1 = document.getElementById(i+'x1');
				a2 = document.getElementById(i+'x2').firstChild.nodeValue;
				a3 = document.getElementById(i+'x3').firstChild.nodeValue;
				a4 = document.getElementById(i+'x4').firstChild.nodeValue;
				a5 = document.getElementById(i+'x5').firstChild.nodeValue;
				a1.innerHTML = parseInt(a2)+parseInt(a3)+parseInt(a4)+parseInt(a5);
			}
		}
	}
	// ปรับปรุงข้อมูลในหมวดที่ 3 ธุรกิจการซื้อ
	// มูลค่าขาย-ต้นทุน+รายได้เฉพาะธุรกิจ-ค่าใช้จ่ายเฉพาะธุรกิจ
		function update_buy()
		{
			var sum1,sum2,sum3,sum4,sum5;
			sum1=0; sum2=0; sum3=0; sum4=0; sum5=0;
			sum2 = parseInt(document.getElementById('6x2').firstChild.nodeValue)-parseInt(document.getElementById('7x2').firstChild.nodeValue);
			sum3 = parseInt(document.getElementById('6x3').firstChild.nodeValue)-parseInt(document.getElementById('7x3').firstChild.nodeValue);
			sum4 = parseInt(document.getElementById('6x4').firstChild.nodeValue)-parseInt(document.getElementById('7x4').firstChild.nodeValue);
			sum5 = parseInt(document.getElementById('6x5').firstChild.nodeValue)-parseInt(document.getElementById('7x5').firstChild.nodeValue);
			sum2=sum2+parseInt(document.getElementById('8x2').firstChild.nodeValue);
			sum3=sum3+parseInt(document.getElementById('8x3').firstChild.nodeValue);
			sum4=sum4+parseInt(document.getElementById('8x4').firstChild.nodeValue);
			sum5=sum5+parseInt(document.getElementById('8x5').firstChild.nodeValue);
			sum2=sum2-parseInt(document.getElementById('9x2').firstChild.nodeValue);
			sum3=sum3-parseInt(document.getElementById('9x3').firstChild.nodeValue);
			sum4=sum4-parseInt(document.getElementById('9x4').firstChild.nodeValue);
			sum5=sum5-parseInt(document.getElementById('9x5').firstChild.nodeValue);
			document.getElementById('10x2').firstChild.nodeValue=sum2;
			document.getElementById('10x3').firstChild.nodeValue=sum3;
			document.getElementById('10x4').firstChild.nodeValue=sum4;
			document.getElementById('10x5').firstChild.nodeValue=sum5;

			sum1=0; sum2=0; sum3=0;
			sum1=parseInt(document.getElementById('6y1').firstChild.nodeValue)-parseInt(document.getElementById('7y1').firstChild.nodeValue);
			sum2=parseInt(document.getElementById('6y2').firstChild.nodeValue)-parseInt(document.getElementById('7y2').firstChild.nodeValue);
			sum3=parseInt(document.getElementById('6y3').firstChild.nodeValue)-parseInt(document.getElementById('7y3').firstChild.nodeValue);
			sum1=sum1+parseInt(document.getElementById('8y1').firstChild.nodeValue);
			sum2=sum2+parseInt(document.getElementById('8y2').firstChild.nodeValue);
			sum3=sum3+parseInt(document.getElementById('8y3').firstChild.nodeValue);
			sum1=sum1-parseInt(document.getElementById('9y1').firstChild.nodeValue);
			sum2=sum2-parseInt(document.getElementById('9y2').firstChild.nodeValue);
			sum3=sum3-parseInt(document.getElementById('9y3').firstChild.nodeValue);
			document.getElementById('10y1').firstChild.nodeValue=sum1;
			document.getElementById('10y2').firstChild.nodeValue=sum2;
			document.getElementById('10y3').firstChild.nodeValue=sum3;
		}

		// ปรับปรุงข้อมูลในหมวดที่ 4 ธุรกิจการขาย
		// มูลค่าขาย-ต้นทุน+รายได้เฉพาะธุรกิจ-ค่าใช้จ่ายเฉพาะธุรกิจ
		function update_sell()
		{
			var sum1,sum2,sum3,sum4,sum5;
			sum1=0; sum2=0; sum3=0; sum4=0; sum5=0;
			sum2 = parseInt(document.getElementById('15x2').firstChild.nodeValue)-parseInt(document.getElementById('16x2').firstChild.nodeValue);
			sum3 = parseInt(document.getElementById('15x3').firstChild.nodeValue)-parseInt(document.getElementById('16x3').firstChild.nodeValue);
			sum4 = parseInt(document.getElementById('15x4').firstChild.nodeValue)-parseInt(document.getElementById('16x4').firstChild.nodeValue);
			sum5 = parseInt(document.getElementById('15x5').firstChild.nodeValue)-parseInt(document.getElementById('16x5').firstChild.nodeValue);
			sum2=sum2+parseInt(document.getElementById('17x2').firstChild.nodeValue);
			sum3=sum3+parseInt(document.getElementById('17x3').firstChild.nodeValue);
			sum4=sum4+parseInt(document.getElementById('17x4').firstChild.nodeValue);
			sum5=sum5+parseInt(document.getElementById('17x5').firstChild.nodeValue);
			sum2=sum2-parseInt(document.getElementById('18x2').firstChild.nodeValue);
			sum3=sum3-parseInt(document.getElementById('18x3').firstChild.nodeValue);
			sum4=sum4-parseInt(document.getElementById('18x4').firstChild.nodeValue);
			sum5=sum5-parseInt(document.getElementById('18x5').firstChild.nodeValue);
			document.getElementById('19x2').firstChild.nodeValue=sum2;
			document.getElementById('19x3').firstChild.nodeValue=sum3;
			document.getElementById('19x4').firstChild.nodeValue=sum4;
			document.getElementById('19x5').firstChild.nodeValue=sum5;

			sum1 = parseInt(document.getElementById('15y1').firstChild.nodeValue)-parseInt(document.getElementById('16y1').firstChild.nodeValue);
			sum2 = parseInt(document.getElementById('15y2').firstChild.nodeValue)-parseInt(document.getElementById('16y2').firstChild.nodeValue);
			sum3 = parseInt(document.getElementById('15y3').firstChild.nodeValue)-parseInt(document.getElementById('16y3').firstChild.nodeValue);
			sum1=sum1+parseInt(document.getElementById('17y1').firstChild.nodeValue);
			sum2=sum2+parseInt(document.getElementById('17y2').firstChild.nodeValue);
			sum3=sum3+parseInt(document.getElementById('17y3').firstChild.nodeValue);
			sum1=sum1-parseInt(document.getElementById('18y1').firstChild.nodeValue);
			sum2=sum2-parseInt(document.getElementById('18y2').firstChild.nodeValue);
			sum3=sum3-parseInt(document.getElementById('18y3').firstChild.nodeValue);
			document.getElementById('19y1').firstChild.nodeValue=sum1;
			document.getElementById('19y2').firstChild.nodeValue=sum2;
			document.getElementById('19y3').firstChild.nodeValue=sum3;
		}

		//ปรับปรุงข้อมูลในหมวดที่ 5 กำไรธุรกิจบริการ
		function update_service()
		{
			var sum1,sum2,sum3,sum4,sum5;
			sum1=0; sum2=0; sum3=0; sum4=0; sum5=0;
			sum2 = parseInt(document.getElementById('24x2').firstChild.nodeValue)-parseInt(document.getElementById('25x2').firstChild.nodeValue);
			sum3 = parseInt(document.getElementById('24x3').firstChild.nodeValue)-parseInt(document.getElementById('25x3').firstChild.nodeValue);
			sum4 = parseInt(document.getElementById('24x4').firstChild.nodeValue)-parseInt(document.getElementById('25x4').firstChild.nodeValue);
			sum5 = parseInt(document.getElementById('24x5').firstChild.nodeValue)-parseInt(document.getElementById('25x5').firstChild.nodeValue);
			document.getElementById('27x2').firstChild.nodeValue=sum2-parseInt(document.getElementById('26x2').firstChild.nodeValue);
			document.getElementById('27x3').firstChild.nodeValue=sum3-parseInt(document.getElementById('26x3').firstChild.nodeValue);
			document.getElementById('27x4').firstChild.nodeValue=sum4-parseInt(document.getElementById('26x4').firstChild.nodeValue);
			document.getElementById('27x5').firstChild.nodeValue=sum5-parseInt(document.getElementById('26x5').firstChild.nodeValue);

			sum1 = parseInt(document.getElementById('24y1').firstChild.nodeValue)-parseInt(document.getElementById('25y1').firstChild.nodeValue);
			sum2 = parseInt(document.getElementById('24y2').firstChild.nodeValue)-parseInt(document.getElementById('25y2').firstChild.nodeValue);
			sum3 = parseInt(document.getElementById('24y3').firstChild.nodeValue)-parseInt(document.getElementById('25y3').firstChild.nodeValue);
			document.getElementById('27y1').firstChild.nodeValue=sum1-parseInt(document.getElementById('26y1').firstChild.nodeValue);
			document.getElementById('27y2').firstChild.nodeValue=sum2-parseInt(document.getElementById('26y2').firstChild.nodeValue);
			document.getElementById('27y3').firstChild.nodeValue=sum3-parseInt(document.getElementById('26y3').firstChild.nodeValue);
		}

		// ปรับปรุงข้อมูลในหมวดที่ 6  แผนลงทุนในทรัพย์สิน
		function update_asset()
		{
			var sum1,sum2,sum3,sum4,sum5,sum6,sum7,sum8;
			sum1=0; sum2=0; sum3=0; sum4=0; sum5=0; sum6=0; sum7=0; sum8=0;
			 for(i=29;i<=38;i++)
			{
				sum2=sum2+parseInt(document.getElementById(i+'x2').firstChild.nodeValue);
				sum3=sum3+parseInt(document.getElementById(i+'x3').firstChild.nodeValue);
				sum4=sum4+parseInt(document.getElementById(i+'x4').firstChild.nodeValue);
				sum5=sum5+parseInt(document.getElementById(i+'x5').firstChild.nodeValue);
				sum6=sum6+parseInt(document.getElementById(i+'y1').firstChild.nodeValue);
				sum7=sum7+parseInt(document.getElementById(i+'y2').firstChild.nodeValue);
				sum8=sum8+parseInt(document.getElementById(i+'y3').firstChild.nodeValue);
			}
			document.getElementById('28x2').firstChild.nodeValue=sum2;
			document.getElementById('28x3').firstChild.nodeValue=sum3;
			document.getElementById('28x4').firstChild.nodeValue=sum4;
			document.getElementById('28x5').firstChild.nodeValue=sum5;
			document.getElementById('28y1').firstChild.nodeValue=sum6;
			document.getElementById('28y2').firstChild.nodeValue=sum7;
			document.getElementById('28y3').firstChild.nodeValue=sum8;
		}

		// ปรับปรุงข้อมูลหมวดที่ 7  แผนการกู้เงิน
		function update_loan()
		{
			var sum1,sum2,sum3,sum4,sum5;
			sum1=0; sum2=0; sum3=0; sum4=0; sum5=0;
			// ชำระต้นเงิน 7.1
			sum2 = parseInt(document.getElementById('12x2').firstChild.nodeValue)+parseInt(document.getElementById('21x2').firstChild.nodeValue);
			sum3 = parseInt(document.getElementById('12x3').firstChild.nodeValue)+parseInt(document.getElementById('21x3').firstChild.nodeValue);
			sum4 = parseInt(document.getElementById('12x4').firstChild.nodeValue)+parseInt(document.getElementById('21x4').firstChild.nodeValue);
			sum5 = parseInt(document.getElementById('12x5').firstChild.nodeValue)+parseInt(document.getElementById('21x5').firstChild.nodeValue);
			document.getElementById('40x2').firstChild.nodeValue=sum2+parseInt(document.getElementById('37x2').firstChild.nodeValue);
			document.getElementById('40x3').firstChild.nodeValue=sum3+parseInt(document.getElementById('37x3').firstChild.nodeValue);
			document.getElementById('40x4').firstChild.nodeValue=sum4+parseInt(document.getElementById('37x4').firstChild.nodeValue);
			document.getElementById('40x5').firstChild.nodeValue=sum5+parseInt(document.getElementById('37x5').firstChild.nodeValue);

			sum1 = parseInt(document.getElementById('12y1').firstChild.nodeValue)+parseInt(document.getElementById('21y1').firstChild.nodeValue);
			sum2 = parseInt(document.getElementById('12y2').firstChild.nodeValue)+parseInt(document.getElementById('21y2').firstChild.nodeValue);
			sum3 = parseInt(document.getElementById('12y3').firstChild.nodeValue)+parseInt(document.getElementById('21y3').firstChild.nodeValue);
			document.getElementById('40y1').innerHTML=sum1+parseInt(document.getElementById('37y1').firstChild.nodeValue);
			document.getElementById('40y2').innerHTML=sum2+parseInt(document.getElementById('37y2').firstChild.nodeValue);
			document.getElementById('40y3').innerHTML=sum3+parseInt(document.getElementById('37y3').firstChild.nodeValue);

			// ชำระต้นเงิน 7.2
			sum2 = parseInt(document.getElementById('13x2').firstChild.nodeValue)+parseInt(document.getElementById('22x2').firstChild.nodeValue);
			sum3 = parseInt(document.getElementById('13x3').firstChild.nodeValue)+parseInt(document.getElementById('22x3').firstChild.nodeValue);
			sum4 = parseInt(document.getElementById('13x4').firstChild.nodeValue)+parseInt(document.getElementById('22x4').firstChild.nodeValue);
			sum5 = parseInt(document.getElementById('13x5').firstChild.nodeValue)+parseInt(document.getElementById('22x5').firstChild.nodeValue);
			document.getElementById('41x2').innerHTML=sum2+parseInt(document.getElementById('38x2').firstChild.nodeValue);
			document.getElementById('41x3').innerHTML=sum3+parseInt(document.getElementById('38x3').firstChild.nodeValue);
			document.getElementById('41x4').innerHTML=sum4+parseInt(document.getElementById('38x4').firstChild.nodeValue);
			document.getElementById('41x5').innerHTML=sum5+parseInt(document.getElementById('38x5').firstChild.nodeValue);

			sum1 = parseInt(document.getElementById('13y1').firstChild.nodeValue)+parseInt(document.getElementById('22y1').firstChild.nodeValue);
			sum2 = parseInt(document.getElementById('13y2').firstChild.nodeValue)+parseInt(document.getElementById('22y2').firstChild.nodeValue);
			sum3 = parseInt(document.getElementById('13y3').firstChild.nodeValue)+parseInt(document.getElementById('22y3').firstChild.nodeValue);
			document.getElementById('41y1').innerHTML=sum1+parseInt(document.getElementById('38y1').firstChild.nodeValue);
			document.getElementById('41y2').innerHTML=sum2+parseInt(document.getElementById('38y2').firstChild.nodeValue);
			document.getElementById('41y3').innerHTML=sum3+parseInt(document.getElementById('38y3').firstChild.nodeValue);

			// แผนการกู้เงิน ข้อ 7
			sum2 = parseInt(document.getElementById('11x2').firstChild.nodeValue)+parseInt(document.getElementById('20x2').firstChild.nodeValue);
			sum3 = parseInt(document.getElementById('11x3').firstChild.nodeValue)+parseInt(document.getElementById('20x3').firstChild.nodeValue);
			sum4 = parseInt(document.getElementById('11x4').firstChild.nodeValue)+parseInt(document.getElementById('20x4').firstChild.nodeValue);
			sum5 = parseInt(document.getElementById('11x5').firstChild.nodeValue)+parseInt(document.getElementById('20x5').firstChild.nodeValue);
			document.getElementById('39x2').innerHTML=sum2+parseInt(document.getElementById('36x2').firstChild.nodeValue);
			document.getElementById('39x3').innerHTML=sum3+parseInt(document.getElementById('36x3').firstChild.nodeValue);
			document.getElementById('39x4').innerHTML=sum4+parseInt(document.getElementById('36x4').firstChild.nodeValue);
			document.getElementById('39x5').innerHTML=sum5+parseInt(document.getElementById('36x5').firstChild.nodeValue);

			sum1 = parseInt(document.getElementById('11y1').firstChild.nodeValue)+parseInt(document.getElementById('20y1').firstChild.nodeValue);
			sum2 = parseInt(document.getElementById('11y2').firstChild.nodeValue)+parseInt(document.getElementById('20y2').firstChild.nodeValue);
			sum3 = parseInt(document.getElementById('11y3').firstChild.nodeValue)+parseInt(document.getElementById('20y3').firstChild.nodeValue);
			document.getElementById('39y1').innerHTML=sum1+parseInt(document.getElementById('36y1').firstChild.nodeValue);
			document.getElementById('39y2').innerHTML=sum2+parseInt(document.getElementById('36y2').firstChild.nodeValue);
			document.getElementById('39y3').innerHTML=sum3+parseInt(document.getElementById('36y3').firstChild.nodeValue);
		}

		// ปรับปรุงข้อมูลหมวดที่ 8  รายได้อื่น ๆ 
		function update_income()
		{
			var sum1,sum2,sum3,sum4,sum5;
			sum1=0; sum2=0; sum3=0; sum4=0; sum5=0;
			sum2 = parseInt(document.getElementById('43x2').firstChild.nodeValue)+parseInt(document.getElementById('44x2').firstChild.nodeValue);
			sum3 = parseInt(document.getElementById('43x3').firstChild.nodeValue)+parseInt(document.getElementById('44x3').firstChild.nodeValue);
			sum4 = parseInt(document.getElementById('43x4').firstChild.nodeValue)+parseInt(document.getElementById('44x4').firstChild.nodeValue);
			sum5 = parseInt(document.getElementById('43x5').firstChild.nodeValue)+parseInt(document.getElementById('44x5').firstChild.nodeValue);
			document.getElementById('42x2').innerHTML=sum2;
			document.getElementById('42x3').innerHTML=sum3;
			document.getElementById('42x4').innerHTML=sum4;
			document.getElementById('42x5').innerHTML=sum5;

			sum1 = parseInt(document.getElementById('43y1').firstChild.nodeValue)+parseInt(document.getElementById('44y1').firstChild.nodeValue);
			sum2 = parseInt(document.getElementById('43y2').firstChild.nodeValue)+parseInt(document.getElementById('44y2').firstChild.nodeValue);
			sum3 = parseInt(document.getElementById('43y3').firstChild.nodeValue)+parseInt(document.getElementById('44y3').firstChild.nodeValue);
			document.getElementById('42y1').innerHTML=sum1;
			document.getElementById('42y2').innerHTML=sum2;
			document.getElementById('42y3').innerHTML=sum3;
		}
		// ปรับปรุงข้อมูลหมวดที่ 9 ค่าใช้จ่ายดำเนินงานทั้งหมด
		function update_expenses()
		{
			var sum1,sum2,sum3,sum4,sum5,sum6,sum7,sum8;
			sum1=0; sum2=0; sum3=0; sum4=0; sum5=0; sum6=0; sum7=0; sum8=0;
			 for(i=46;i<=48;i++)
			{
				sum2=sum2+parseInt(document.getElementById(i+'x2').firstChild.nodeValue);
				sum3=sum3+parseInt(document.getElementById(i+'x3').firstChild.nodeValue);
				sum4=sum4+parseInt(document.getElementById(i+'x4').firstChild.nodeValue);
				sum5=sum5+parseInt(document.getElementById(i+'x5').firstChild.nodeValue);
				sum6=sum6+parseInt(document.getElementById(i+'y1').firstChild.nodeValue);
				sum7=sum7+parseInt(document.getElementById(i+'y2').firstChild.nodeValue);
				sum8=sum8+parseInt(document.getElementById(i+'y2').firstChild.nodeValue);
			}
			document.getElementById('45x2').innerHTML=sum2;
			document.getElementById('45x3').innerHTML=sum3;
			document.getElementById('45x4').innerHTML=sum4;
			document.getElementById('45x5').innerHTML=sum5;
			document.getElementById('45y1').innerHTML=sum6;
			document.getElementById('45y2').innerHTML=sum7;
			document.getElementById('45y3').innerHTML=sum8;
		}
		// ปรับปรุงข้อมูลในหมวดที่ 10 กำไร ขาดทุน
		function update_profit()
		{
			var sum1,sum2,sum3,sum4,sum5,sum6,sum7,sum8;
			sum1=0; sum2=0; sum3=0; sum4=0; sum5=0; sum6=0; sum7=0; sum8=0;
		// บวก กำไรซื้อ  กำไรขาด
			sum2 = parseInt(document.getElementById('10x2').firstChild.nodeValue)+parseInt(document.getElementById('19x2').firstChild.nodeValue);
			sum3 = parseInt(document.getElementById('10x3').firstChild.nodeValue)+parseInt(document.getElementById('19x3').firstChild.nodeValue);
			sum4 = parseInt(document.getElementById('10x4').firstChild.nodeValue)+parseInt(document.getElementById('19x4').firstChild.nodeValue);
			sum5 = parseInt(document.getElementById('10x5').firstChild.nodeValue)+parseInt(document.getElementById('19x5').firstChild.nodeValue);
			sum6 = parseInt(document.getElementById('10y1').firstChild.nodeValue)+parseInt(document.getElementById('19y1').firstChild.nodeValue);
			sum7 = parseInt(document.getElementById('10y2').firstChild.nodeValue)+parseInt(document.getElementById('19y2').firstChild.nodeValue);
			sum8 = parseInt(document.getElementById('10y3').firstChild.nodeValue)+parseInt(document.getElementById('19y3').firstChild.nodeValue);
		// เพิ่มกำไร
			sum2= sum2+parseInt(document.getElementById('27x2').firstChild.nodeValue);
			sum3= sum3+parseInt(document.getElementById('27x3').firstChild.nodeValue);
			sum4= sum4+parseInt(document.getElementById('27x4').firstChild.nodeValue);
			sum5= sum5+parseInt(document.getElementById('27x5').firstChild.nodeValue);	
			sum6= sum6+parseInt(document.getElementById('27y1').firstChild.nodeValue);
			sum7= sum7+parseInt(document.getElementById('27y2').firstChild.nodeValue);
			sum8= sum8+parseInt(document.getElementById('27y3').firstChild.nodeValue);	
		// หักการชำระดอกเบี้ย
			sum2= sum2-parseInt(document.getElementById('41x2').firstChild.nodeValue);
			sum3= sum3-parseInt(document.getElementById('41x3').firstChild.nodeValue);
			sum4= sum4-parseInt(document.getElementById('41x4').firstChild.nodeValue);
			sum5= sum5-parseInt(document.getElementById('41x5').firstChild.nodeValue);	
			sum6= sum6-parseInt(document.getElementById('41y1').firstChild.nodeValue);
			sum7= sum7-parseInt(document.getElementById('41y2').firstChild.nodeValue);
			sum8= sum8-parseInt(document.getElementById('41y3').firstChild.nodeValue);	
		// เพิ่มรายได้อื่น ๆ 
			sum2= sum2+parseInt(document.getElementById('42x2').firstChild.nodeValue);
			sum3= sum3+parseInt(document.getElementById('42x3').firstChild.nodeValue);
			sum4= sum4+parseInt(document.getElementById('42x4').firstChild.nodeValue);
			sum5= sum5+parseInt(document.getElementById('42x5').firstChild.nodeValue);	
			sum6= sum6+parseInt(document.getElementById('42y1').firstChild.nodeValue);
			sum7= sum7+parseInt(document.getElementById('42y2').firstChild.nodeValue);
			sum8= sum8+parseInt(document.getElementById('42y3').firstChild.nodeValue);	
			// หักค่าใช้จ่ายดำเนินงานทั้งหมด
			sum2= sum2-parseInt(document.getElementById('45x2').firstChild.nodeValue);
			sum3= sum3-parseInt(document.getElementById('45x3').firstChild.nodeValue);
			sum4= sum4-parseInt(document.getElementById('45x4').firstChild.nodeValue);
			sum5= sum5-parseInt(document.getElementById('45x5').firstChild.nodeValue);
			sum6= sum6-parseInt(document.getElementById('45y1').firstChild.nodeValue);
			sum7= sum7-parseInt(document.getElementById('45y2').firstChild.nodeValue);
			sum8= sum8-parseInt(document.getElementById('45y3').firstChild.nodeValue);
			document.getElementById('49x2').innerHTML=sum2;
			document.getElementById('49x3').innerHTML=sum3;
			document.getElementById('49x4').innerHTML=sum4;
			document.getElementById('49x5').innerHTML=sum5;
			document.getElementById('49y1').innerHTML=sum6;
			document.getElementById('49y2').innerHTML=sum7;
			document.getElementById('49y3').innerHTML=sum8;

			update_rows();     // เรียกฟังก์ชั่นปรับปรุงในแต่ละ แถว
		}
</script>
</head>
<body>
<br><br>
<div style="margin-left:auto; margin-right:auto;  text-align: center "><strong> สรุป แผนการดำเนินงานประจำปี </strong></div>
<!-- ******************************************************************************************************************************************** -->
&nbsp;
<span name='year' ID='year'><?=$year; ?></span>
<!-- สิ้นสุดการแสดงปี -->
<span ID='mySpan'></span>
<table  width="970" border='1' style="margin-left:5px; margin-right:5px; margin-top:10px;">
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
    <td width="80" align="center"><span ID='year1'><?=$year-1; ?></span></td>
    <td width="80" align="center"><span ID='year2'><?=$year-2; ?></span></td>
    <td width="80" align="center"><span ID='year3'><?=$year-3; ?></span></td>
    <td width="80" align="center">ไตรมาสที่ 1</td>
    <td width="80" align="center">ไตรมาสที่ 2</td>
    <td width="80" align="center">ไตรมาสที่ 3</td>
	<td width="80" align="center">ไตรมาสที่ 4</td>
  </tr>
  <tr>
	<td align="center">1</td>
	<td align="center"><div ID="1y1">0</div></td>
	<td align="center"><div ID="1y2">0</div></td>
	<td align="center"><div ID="1y3">0</div></td>
	<td align="left">&nbsp;<font color="#0F7FAF">1.รับสมาชิกเพิ่มระหว่างปี (คน)</font></td>
	<td align="center"><div ID="1x1">0</div></td>
	<td align="center"><div ID="1x2">0</div></td>
	<td align="center"><div ID="1x3">0</div></td>
	<td align="center"><div ID="1x4">0</div></td>
	<td align="center"><div ID="1x5">0</div></td>
</tr>
  <tr class='rows_grey'>
	<td align="center">2</td>
	<td align="center"><div ID="2y1">0</div></td>
	<td align="center"><div ID="2y2">0</div></td>
	<td align="center"><div ID="2y3">0</div></td>
	<td align="left">&nbsp; - จำนวนสมาชิกสิ้นปี</td>
	<td align="center"><div ID="2x1"><?=number_format($fetch_master[0],0,'','')?></div></td>
	<td align="center"><div ID="2x2">0</div></td>
	<td align="center"><div ID="2x3">0</div></td>
	<td align="center"><div ID="2x4">0</div></td>
	<td align="center"><div ID="2x5">0</div></td>
</tr>
 <tr>
	<td align="center">3</td>
	<td align="center"><div ID="3y1">0</div></td>
	<td align="center"><div ID="3y2">0</div></td>
	<td align="center"><div ID="3y3">0</div></td>
	<td align="left">&nbsp;<font color="#0F7FAF">2 ทุนเรือนหุ้นเพิ่มระหว่างปี</font></td>
	<td align="center"><div ID="3x1">0</div></td>
	<td align="center"><div ID="3x2">0</div></td>
	<td align="center"><div ID="3x3">0</div></td>
	<td align="center"><div ID="3x4">0</div></td>
	<td align="center"><div ID="3x5">0</div></td>
</tr>
  <tr class='rows_grey'>
	<td align="center">4</td>
	<td align="center"><div ID="4y1">0</div></td>
	<td align="center"><div ID="4y2">0</div></td>
	<td align="center"><div ID="4y3">0</div></td>
	<td align="left">&nbsp; - ทุนเรือนหุ้นสิ้นปี</td>
	<td align="center"><div ID="4x1"><?=number_format($fetch_master[1],0,'','')?></div></td>
	<td align="center"><div ID="4x2">0</div></td>
	<td align="center"><div ID="4x3">0</div></td>
	<td align="center"><div ID="4x4">0</div></td>
	<td align="center"><div ID="4x5">0</div></td>
</tr>
  <tr>
	<td align="center">5</td>
	<td align="center" colspan="3">&nbsp;</td>
	<td align="left">&nbsp;<font color="#0F7FAF">3.ธุรกิจการซื้อ (จัดหาสินค้ามาจำหน่าย)</font></td>
	<td align="center" colspan="5">&nbsp;</td>
</tr>
 <tr class='rows_grey'>
	<td align="center">6</td>
	<td align="center"><div ID="6y1">0</div></td>
	<td align="center"><div ID="6y2">0</div></td>
	<td align="center"><div ID="6y3">0</div></td>
	<td align="left">&nbsp; 3.1 มูลค่าขาย</td>
	<td align="center"><div ID="6x1">0</div></td>
	<td align="center"><div ID="6x2">0</div></td>
	<td align="center"><div ID="6x3">0</div></td>
	<td align="center"><div ID="6x4">0</div></td>
	<td align="center"><div ID="6x5">0</div></td>
</tr>
 <tr>
	<td align="center">7</td>
	<td align="center"><div ID="7y1">0</div></td>
	<td align="center"><div ID="7y2">0</div></td>
	<td align="center"><div ID="7y3">0</div></td>
	<td align="left">&nbsp; 3.2 ต้นทุน</td>
	<td align="center"><div ID="7x1">0</div></td>
	<td align="center"><div ID="7x2">0</div></td>
	<td align="center"><div ID="7x3">0</div></td>
	<td align="center"><div ID="7x4">0</div></td>
	<td align="center"><div ID="7x5">0</div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">8</td>
	<td align="center"><div ID="8y1">0</div></td>
	<td align="center"><div ID="8y2">0</div></td>
	<td align="center"><div ID="8y3">0</div></td>
	<td align="left">&nbsp; 3.3 รายได้เฉพาะธุรกิจ</td>
	<td align="center"><div ID="8x1">0</div></td>
	<td align="center"><div ID="8x2"><?=number_format($fetch_master[2],0,'','')?></div></td>
	<td align="center"><div ID="8x3"><?=number_format($fetch_master[3],0,'','')?></div></td>
	<td align="center"><div ID="8x4"><?=number_format($fetch_master[4],0,'','')?></div></td>
	<td align="center"><div ID="8x5"><?=number_format($fetch_master[5],0,'','')?></div></td>
</tr>
 <tr>
	<td align="center">9</td>
	<td align="center"><div ID="9y1">0</div></td>
	<td align="center"><div ID="9y2">0</div></td>
	<td align="center"><div ID="9y3">0</div></td>
	<td align="left">&nbsp; 3.4 ค่าใช้จ่ายเฉพาะธุรกิจ</td>
	<td align="center"><div ID="9x1">0</div></td>
	<td align="center"><div ID="9x2"><?=number_format($fetch_master[6],0,'','')?></div></td>
	<td align="center"><div ID="9x3"><?=number_format($fetch_master[7],0,'','')?></div></td>
	<td align="center"><div ID="9x4"><?=number_format($fetch_master[8],0,'','')?></div></td>
	<td align="center"><div ID="9x5"><?=number_format($fetch_master[9],0,'','')?></div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">10</td>
	<td align="center"><div ID="10y1">0</div></td>
	<td align="center"><div ID="10y2">0</div></td>
	<td align="center"><div ID="10y3">0</div></td>
	<td align="left">&nbsp; 3.5 กำไร (ข้อ 3.1-3.2+3.3-3.4)</td>
	<td align="center"><div ID="10x1">0</div></td>
	<td align="center"><div ID="10x2">0</div></td>
	<td align="center"><div ID="10x3">0</div></td>
	<td align="center"><div ID="10x4">0</div></td>
	<td align="center"><div ID="10x5">0</div></td>
</tr>
 <tr>
	<td align="center">11</td>
	<td align="center"><div ID="11y1">0</div></td>
	<td align="center"><div ID="11y2">0</div></td>
	<td align="center"><div ID="11y3">0</div></td>
	<td align="left">&nbsp; 3.6 เบิกเงินกู้ ฉ.31 ข้อ 2(2)</td>
	<td align="center"><div ID="11x1">0</div></td>
	<td align="center"><div ID="11x2"><?=number_format($fetch_master[10],0,'','')?></div></td>
	<td align="center"><div ID="11x3"><?=number_format($fetch_master[11],0,'','')?></div></td>
	<td align="center"><div ID="11x4"><?=number_format($fetch_master[12],0,'','')?></div></td>
	<td align="center"><div ID="11x5"><?=number_format($fetch_master[13],0,'','')?></div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">12</td>
	<td align="center"><div ID="12y1">0</div></td>
	<td align="center"><div ID="12y2">0</div></td>
	<td align="center"><div ID="12y3">0</div></td>
	<td align="left">&nbsp; 3.7 ชำระต้นเงิน</td>
	<td align="center"><div ID="12x1">0</div></td>
	<td align="center"><div ID="12x2"><?=number_format($fetch_master[14],0,'','')?></div></td>
	<td align="center"><div ID="12x3"><?=number_format($fetch_master[15],0,'','')?></div></td>
	<td align="center"><div ID="12x4"><?=number_format($fetch_master[16],0,'','')?></div></td>
	<td align="center"><div ID="12x5"><?=number_format($fetch_master[17],0,'','')?></div></td>
</tr>
 <tr>
	<td align="center">13</td>
	<td align="center"><div ID="13y1">0</div></td>
	<td align="center"><div ID="13y2">0</div></td>
	<td align="center"><div ID="13y3">0</div></td>
	<td align="left">&nbsp; 3.8 ชำระดอกเบี้ย</td>
	<td align="center"><div ID="13x1">0</div></td>
	<td align="center"><div ID="13x2"><?=number_format($fetch_master[18],0,'','')?></div></td>
	<td align="center"><div ID="13x3"><?=number_format($fetch_master[19],0,'','')?></div></td>
	<td align="center"><div ID="13x4"><?=number_format($fetch_master[20],0,'','')?></div></td>
	<td align="center"><div ID="13x5"><?=number_format($fetch_master[21],0,'','')?></div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">14</td>
	<td align="center" colspan="3">&nbsp;</td>
	<td align="left">&nbsp;<font color="#0F7FAF">4.ธุรกิจการขาย (รวบรวมผลิตผล)</font></td>
	<td align="center" colspan="5">&nbsp;</td>
</tr>
 <tr>
	<td align="center">15</td>
	<td align="center"><div ID="15y1">0</div></td>
	<td align="center"><div ID="15y2">0</div></td>
	<td align="center"><div ID="15y3">0</div></td>
	<td align="left">&nbsp; 4.1 มูลค่าขาย</td>
	<td align="center"><div ID="15x1">0</div></td>
	<td align="center"><div ID="15x2">0</div></td>
	<td align="center"><div ID="15x3">0</div></td>
	<td align="center"><div ID="15x4">0</div></td>
	<td align="center"><div ID="15x5">0</div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">16</td>
	<td align="center"><div ID="16y1">0</div></td>
	<td align="center"><div ID="16y2">0</div></td>
	<td align="center"><div ID="16y3">0</div></td>
	<td align="left">&nbsp; 4.2 ต้นทุน</td>
	<td align="center"><div ID="16x1">0</div></td>
	<td align="center"><div ID="16x2">0</div></td>
	<td align="center"><div ID="16x3">0</div></td>
	<td align="center"><div ID="16x4">0</div></td>
	<td align="center"><div ID="16x5">0</div></td>
</tr>
 <tr>
	<td align="center">17</td>
	<td align="center"><div ID="17y1">0</div></td>
	<td align="center"><div ID="17y2">0</div></td>
	<td align="center"><div ID="17y3">0</div></td>
	<td align="left">&nbsp; 4.3 รายได้เฉพาะธุรกิจ</td>
	<td align="center"><div ID="17x1">0</div></td>
	<td align="center"><div ID="17x2"><?=number_format($fetch_master[22],0,'','')?></div></td>
	<td align="center"><div ID="17x3"><?=number_format($fetch_master[23],0,'','')?></div></td>
	<td align="center"><div ID="17x4"><?=number_format($fetch_master[24],0,'','')?></div></td>
	<td align="center"><div ID="17x5"><?=number_format($fetch_master[25],0,'','')?></div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">18</td>
	<td align="center"><div ID="18y1">0</div></td>
	<td align="center"><div ID="18y2">0</div></td>
	<td align="center"><div ID="18y3">0</div></td>
	<td align="left">&nbsp; 4.4 ค่าใช้จ่ายเฉพาะธุรกิจ</td>
	<td align="center"><div ID="18x1">0</div></td>
	<td align="center"><div ID="18x2"><?=number_format($fetch_master[26],0,'','')?></div></td>
	<td align="center"><div ID="18x3"><?=number_format($fetch_master[27],0,'','')?></div></td>
	<td align="center"><div ID="18x4"><?=number_format($fetch_master[28],0,'','')?></div></td>
	<td align="center"><div ID="18x5"><?=number_format($fetch_master[29],0,'','')?></div></td>
</tr>
 <tr>
	<td align="center">19</td>
	<td align="center"><div ID="19y1">0</div></td>
	<td align="center"><div ID="19y2">0</div></td>
	<td align="center"><div ID="19y3">0</div></td>
	<td align="left">&nbsp; 4.5 กำไร(ข้อ 4.1-4.2+4.3-4.4)</td>
	<td align="center"><div ID="19x1">0</div></td>
	<td align="center"><div ID="19x2">0</div></td>
	<td align="center"><div ID="19x3">0</div></td>
	<td align="center"><div ID="19x4">0</div></td>
	<td align="center"><div ID="19x5">0</div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">20</td>
	<td align="center"><div ID="20y1">0</div></td>
	<td align="center"><div ID="20y2">0</div></td>
	<td align="center"><div ID="20y3">0</div></td>
	<td align="left">&nbsp; 4.6 เบิกเงินกู้ ฉ.31 ข้อ 2(3)</td>
	<td align="center"><div ID="20x1">0</div></td>
	<td align="center"><div ID="20x2"><?=number_format($fetch_master[30],0,'','')?></div></td>
	<td align="center"><div ID="20x3"><?=number_format($fetch_master[31],0,'','')?></div></td>
	<td align="center"><div ID="20x4"><?=number_format($fetch_master[32],0,'','')?></div></td>
	<td align="center"><div ID="20x5"><?=number_format($fetch_master[33],0,'','')?></div></td>
</tr>
 <tr>
	<td align="center">21</td>
	<td align="center"><div ID="21y1">0</div></td>
	<td align="center"><div ID="21y2">0</div></td>
	<td align="center"><div ID="21y3">0</div></td>
	<td align="left">&nbsp; 4.7 ชำระต้นเงิน </td>
	<td align="center"><div ID="21x1">0</div></td>
	<td align="center"><div ID="21x2"><?=number_format($fetch_master[34],0,'','')?></div></td>
	<td align="center"><div ID="21x3"><?=number_format($fetch_master[35],0,'','')?></div></td>
	<td align="center"><div ID="21x4"><?=number_format($fetch_master[36],0,'','')?></div></td>
	<td align="center"><div ID="21x5"><?=number_format($fetch_master[37],0,'','')?></div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">22</td>
	<td align="center"><div ID="22y1">0</div></td>
	<td align="center"><div ID="22y2">0</div></td>
	<td align="center"><div ID="22y3">0</div></td>
	<td align="left">&nbsp; 4.8 ชำระดอกเบี้ย</td>
	<td align="center"><div ID="22x1">0</div></td>
	<td align="center"><div ID="22x2"><?=number_format($fetch_master[38],0,'','')?></div></td>
	<td align="center"><div ID="22x3"><?=number_format($fetch_master[39],0,'','')?></div></td>
	<td align="center"><div ID="22x4"><?=number_format($fetch_master[40],0,'','')?></div></td>
	<td align="center"><div ID="22x5"><?=number_format($fetch_master[41],0,'','')?></div></td>
</tr>
 <tr>
	<td align="center">23</td>
	<td align="center" colspan="3">&nbsp;</td>
	<td align="left">&nbsp;<font color="#0F7FAF">5.ธุรกิจบริการ </font></td>
	<td align="center" colspan="5">&nbsp;</td>
</tr>
 <tr class='rows_grey'>
	<td align="center">24</td>
	<td align="center"><div ID="24y1">0</div></td>
	<td align="center"><div ID="24y2">0</div></td>
	<td align="center"><div ID="24y3">0</div></td>
	<td align="left">&nbsp; 5.1 รายได้</td>
	<td align="center"><div ID="24x1">0</div></td>
	<td align="center"><div ID="24x2">0</div></td>
	<td align="center"><div ID="24x3">0</div></td>
	<td align="center"><div ID="24x4">0</div></td>
	<td align="center"><div ID="24x5">0</div></td>
</tr>
 <tr>
	<td align="center">25</td>
	<td align="center"><div ID="25y1">0</div></td>
	<td align="center"><div ID="25y2">0</div></td>
	<td align="center"><div ID="25y3">0</div></td>
	<td align="left">&nbsp; 5.2 ต้นทุน</td>
	<td align="center"><div ID="25x1">0</div></td>
	<td align="center"><div ID="25x2"><?=number_format($fetch_master[42],0,'','')?></div></td>
	<td align="center"><div ID="25x3"><?=number_format($fetch_master[43],0,'','')?></div></td>
	<td align="center"><div ID="25x4"><?=number_format($fetch_master[44],0,'','')?></div></td>
	<td align="center"><div ID="25x5"><?=number_format($fetch_master[45],0,'','')?></div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">26</td>
	<td align="center"><div ID="26y1">0</div></td>
	<td align="center"><div ID="26y2">0</div></td>
	<td align="center"><div ID="26y3">0</div></td>
	<td align="left">&nbsp; 5.3 ค่าใช้จ่ายเฉพาะธุรกิจ</td>
	<td align="center"><div ID="26x1">0</div></td>
	<td align="center"><div ID="26x2"><?=number_format($fetch_master[46],0,'','')?></div></td>
	<td align="center"><div ID="26x3"><?=number_format($fetch_master[47],0,'','')?></div></td>
	<td align="center"><div ID="26x4"><?=number_format($fetch_master[48],0,'','')?></div></td>
	<td align="center"><div ID="26x5"><?=number_format($fetch_master[49],0,'','')?></div></td>
</tr>
 <tr>
	<td align="center">27</td>
	<td align="center"><div ID="27y1">0</div></td>
	<td align="center"><div ID="27y2">0</div></td>
	<td align="center"><div ID="27y3">0</div></td>
	<td align="left">&nbsp; 5.4 กำไร (ข้อ 5.1-5.2-5.3)</td>
	<td align="center"><div ID="27x1">0</div></td>
	<td align="center"><div ID="27x2">0</div></td>
	<td align="center"><div ID="27x3">0</div></td>
	<td align="center"><div ID="27x4">0</div></td>
	<td align="center"><div ID="27x5">0</div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">28</td>
	<td align="center"><div ID="28y1">0</div></td>
	<td align="center"><div ID="28y2">0</div></td>
	<td align="center"><div ID="28y3">0</div></td>
	<td align="left">&nbsp;<font color="#0F7FAF">6.แผนลงทุนในทรัพย์สิน (ข้อ 6.1 ถึง 6.7)</font></td>
	<td align="center"><div ID="28x1">0</div></td>
	<td align="center"><div ID="28x2">0</div></td>
	<td align="center"><div ID="28x3">0</div></td>
	<td align="center"><div ID="28x4">0</div></td>
	<td align="center"><div ID="28x5">0</div></td>
</tr>
 <tr>
	<td align="center">29</td>
	<td align="center"><div ID="29y1">0</div></td>
	<td align="center"><div ID="29y2">0</div></td>
	<td align="center"><div ID="29y3">0</div></td>
	<td align="left">&nbsp; 6.1 ซื้อที่ดิน</td>
	<td align="center"><div ID="29x1">0</div></td>
	<td align="center"><div ID="29x2"><?=number_format($fetch_master[50],0,'','')?></div></td>
	<td align="center"><div ID="29x3"><?=number_format($fetch_master[51],0,'','')?></div></td>
	<td align="center"><div ID="29x4"><?=number_format($fetch_master[52],0,'','')?></div></td>
	<td align="center"><div ID="29x5"><?=number_format($fetch_master[53],0,'','')?></div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">30</td>
	<td align="center"><div ID="30y1">0</div></td>
	<td align="center"><div ID="30y2">0</div></td>
	<td align="center"><div ID="30y3">0</div></td>
	<td align="left">&nbsp; 6.2 ซื้อรถยนต์</td>
	<td align="center"><div ID="30x1">0</div></td>
	<td align="center"><div ID="30x2"><?=number_format($fetch_master[54],0,'','')?></div></td>
	<td align="center"><div ID="30x3"><?=number_format($fetch_master[55],0,'','')?></div></td>
	<td align="center"><div ID="30x4"><?=number_format($fetch_master[56],0,'','')?></div></td>
	<td align="center"><div ID="30x5"><?=number_format($fetch_master[57],0,'','')?></div></td>
</tr>
 <tr>
	<td align="center">31</td>
	<td align="center"><div ID="31y1">0</div></td>
	<td align="center"><div ID="31y2">0</div></td>
	<td align="center"><div ID="31y3">0</div></td>
	<td align="left">&nbsp; 6.3 เครื่องใช้สำนักงานและอื่น ๆ </td>
	<td align="center"><div ID="31x1">0</div></td>
	<td align="center"><div ID="31x2"><?=number_format($fetch_master[58],0,'','')?></div></td>
	<td align="center"><div ID="31x3"><?=number_format($fetch_master[59],0,'','')?></div></td>
	<td align="center"><div ID="31x4"><?=number_format($fetch_master[60],0,'','')?></div></td>
	<td align="center"><div ID="31x5"><?=number_format($fetch_master[61],0,'','')?></div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">32</td>
	<td align="center"><div ID="32y1">0</div></td>
	<td align="center"><div ID="32y2">0</div></td>
	<td align="center"><div ID="32y3">0</div></td>
	<td align="left">&nbsp; 6.4 ซื้อรถหกล้อ</td>
	<td align="center"><div ID="32x1">0</td>
	<td align="center"><div ID="32x2"><?=number_format($fetch_master[62],0,'','')?></div></td>
	<td align="center"><div ID="32x3"><?=number_format($fetch_master[63],0,'','')?></div></td>
	<td align="center"><div ID="32x4"><?=number_format($fetch_master[64],0,'','')?></div></td>
	<td align="center"><div ID="32x5"><?=number_format($fetch_master[65],0,'','')?></div></td>
</tr>
 <tr>
	<td align="center">33</td>
	<td align="center"><div ID="33y1">0</div></td>
	<td align="center"><div ID="33y2">0</div></td>
	<td align="center"><div ID="33y3">0</div></td>
	<td align="left">&nbsp; 6.5 สร้างที่เก็บสินค้า</td>
	<td align="center"><div ID="33x1">0</div></td>
	<td align="center"><div ID="33x2"><?=number_format($fetch_master[66],0,'','')?></div></td>
	<td align="center"><div ID="33x3"><?=number_format($fetch_master[67],0,'','')?></div></td>
	<td align="center"><div ID="33x4"><?=number_format($fetch_master[68],0,'','')?></div></td>
	<td align="center"><div ID="33x5"><?=number_format($fetch_master[69],0,'','')?></div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">34</td>
	<td align="center"><div ID="34y1">0</div></td>
	<td align="center"><div ID="34y2">0</div></td>
	<td align="center"><div ID="34y3">0</div></td>
	<td align="left">&nbsp; 6.6 ซื้อรถจักรยานยนต์</td>
	<td align="center"><div ID="34x1">0</div></td>
	<td align="center"><div ID="34x2"><?=number_format($fetch_master[70],0,'','')?></div></td>
	<td align="center"><div ID="34x3"><?=number_format($fetch_master[71],0,'','')?></div></td>
	<td align="center"><div ID="34x4"><?=number_format($fetch_master[72],0,'','')?></div></td>
	<td align="center"><div ID="34x5"><?=number_format($fetch_master[73],0,'','')?></div></td>
</tr>
 <tr>
	<td align="center">35</td>
	<td align="center"><div ID="35y1">0</div></td>
	<td align="center"><div ID="35y2">0</div></td>
	<td align="center"><div ID="35y3">0</div></td>
	<td align="left">&nbsp; 6.7 สร้างโรงสี </td>
	<td align="center"><div ID="35x1">0</div></td>
	<td align="center"><div ID="35x2"><?=number_format($fetch_master[74],0,'','')?></div></td>
	<td align="center"><div ID="35x3"><?=number_format($fetch_master[75],0,'','')?></div></td>
	<td align="center"><div ID="35x4"><?=number_format($fetch_master[76],0,'','')?></div></td>
	<td align="center"><div ID="35x5"><?=number_format($fetch_master[77],0,'','')?></div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">36</td>
	<td align="center"><div ID="36y1">0</div></td>
	<td align="center"><div ID="36y2">0</div></td>
	<td align="center"><div ID="36y3">0</div></td>
	<td align="left">&nbsp; 6.8 เบิกเงินกู้ ฉ.26</td>
	<td align="center"><div ID="36x1">0</div></td>
	<td align="center"><div ID="36x2"><?=number_format($fetch_master[78],0,'','')?></div></td>
	<td align="center"><div ID="36x3"><?=number_format($fetch_master[79],0,'','')?></div></td>
	<td align="center"><div ID="36x4"><?=number_format($fetch_master[80],0,'','')?></div></td>
	<td align="center"><div ID="36x5"><?=number_format($fetch_master[81],0,'','')?></div></td>
</tr>
 <tr>
	<td align="center">37</td>
	<td align="center"><div ID="37y1">0</div></td>
	<td align="center"><div ID="37y2">0</div></td>
	<td align="center"><div ID="37y3">0</div></td>
	<td align="left">&nbsp; 6.9 ชำระต้นเงิน </td>
	<td align="center"><div ID="37x1">0</div></td>
	<td align="center"><div ID="37x2"><?=number_format($fetch_master[82],0,'','')?></div></td>
	<td align="center"><div ID="37x3"><?=number_format($fetch_master[83],0,'','')?></div></td>
	<td align="center"><div ID="37x4"><?=number_format($fetch_master[84],0,'','')?></div></td>
	<td align="center"><div ID="37x5"><?=number_format($fetch_master[85],0,'','')?></div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">38</td>
	<td align="center"><div ID="38y1">0</div></td>
	<td align="center"><div ID="38y2">0</div></td>
	<td align="center"><div ID="38y3">0</div></td>
	<td align="left">&nbsp;6.10 ชำระดอกเบี้ย</td>
	<td align="center"><div ID="38x1">0</div></td>
	<td align="center"><div ID="38x2"><?=number_format($fetch_master[86],0,'','')?></div></td>
	<td align="center"><div ID="38x3"><?=number_format($fetch_master[87],0,'','')?></div></td>
	<td align="center"><div ID="38x4"><?=number_format($fetch_master[88],0,'','')?></div></td>
	<td align="center"><div ID="38x5"><?=number_format($fetch_master[89],0,'','')?></div></td>
</tr>
 <tr>
	<td align="center">39</td>
	<td align="center"><div ID="39y1">0</div></td>
	<td align="center"><div ID="39y2">0</div></td>
	<td align="center"><div ID="39y3">0</div></td>
	<td align="left">&nbsp;<font color="#0F7FAF">7.แผนการกู้เงิน (ข้อ 3.6+4.6+6.8) </font></td>
	<td align="center"><div ID="39x1">0</div></td>
	<td align="center"><div ID="39x2">0</div></td>
	<td align="center"><div ID="39x3">0</div></td>
	<td align="center"><div ID="39x4">0</div></td>
	<td align="center"><div ID="39x5">0</div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">40</td>
	<td align="center"><div ID="40y1">0</div></td>
	<td align="center"><div ID="40y2">0</div></td>
	<td align="center"><div ID="40y3">0</div></td>
	<td align="left">&nbsp; 7.1 ชำระต้นเงิน (ข้อ 3.7+4.7+6.9)</td>
	<td align="center"><div ID="40x1">0</div></td>
	<td align="center"><div ID="40x2">0</div></td>
	<td align="center"><div ID="40x3">0</div></td>
	<td align="center"><div ID="40x4">0</div></td>
	<td align="center"><div ID="40x5">0</div></td>
</tr>
 <tr>
	<td align="center">41</td>
	<td align="center"><div ID="41y1">0</div></td>
	<td align="center"><div ID="41y2">0</div></td>
	<td align="center"><div ID="41y3">0</div></td>
	<td align="left">&nbsp; 7.2 ชำระดอกเบี้ย( ข้อ3.8+4.8+6.10)</td>
	<td align="center"><div ID="41x1">0</div></td>
	<td align="center"><div ID="41x2">0</div></td>
	<td align="center"><div ID="41x3">0</div></td>
	<td align="center"><div ID="41x4">0</div></td>
	<td align="center"><div ID="41x5">0</div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">42</td>
	<td align="center"><div ID="42y1">0</div></td>
	<td align="center"><div ID="42y2">0</div></td>
	<td align="center"><div ID="42y3">0</div></td>
	<td align="left">&nbsp;<font color="#0F7FAF">8.รายได้อื่น (ข้อ 8.1+8.2 ) </font></td>
	<td align="center"><div ID="42x1">0</div></td>
	<td align="center"><div ID="42x2">0</div></td>
	<td align="center"><div ID="42x3">0</div></td>
	<td align="center"><div ID="42x4">0</div></td>
	<td align="center"><div ID="42x5">0</div></td>
</tr>
 <tr>
	<td align="center">43</td>
	<td align="center"><div ID="43y1">0</div></td>
	<td align="center"><div ID="43y2">0</div></td>
	<td align="center"><div ID="43y3">0</div></td>
	<td align="left">&nbsp; 8.1 รายได้ดอกเบี้ยเงินฝากธนาคาร</td>
	<td align="center"><div ID="43x1">0</div></td>
	<td align="center"><div ID="43x2"><?=number_format($fetch_master[90],0,'','')?></div></td>
	<td align="center"><div ID="43x3"><?=number_format($fetch_master[91],0,'','')?></div></td>
	<td align="center"><div ID="43x4"><?=number_format($fetch_master[92],0,'','')?></div></td>
	<td align="center"><div ID="43x5"><?=number_format($fetch_master[93],0,'','')?></div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">44</td>
	<td align="center"><div ID="44y1">0</div></td>
	<td align="center"><div ID="44y2">0</div></td>
	<td align="center"><div ID="44y3">0</div></td>
	<td align="left">&nbsp; 8.2 รายได้อื่น ๆ </td>
	<td align="center"><div ID="44x1">0</div></td>
	<td align="center"><div ID="44x2"><?=number_format($fetch_master[94],0,'','')?></div></td>
	<td align="center"><div ID="44x3"><?=number_format($fetch_master[95],0,'','')?></div></td>
	<td align="center"><div ID="44x4"><?=number_format($fetch_master[96],0,'','')?></div></td>
	<td align="center"><div ID="44x5"><?=number_format($fetch_master[97],0,'','')?></div></td>
</tr>
 <tr>
	<td align="center">45</td>
	<td align="center"><div ID="45y1">0</div></td>
	<td align="center"><div ID="45y2">0</div></td>
	<td align="center"><div ID="45y3">0</div></td>
	<td align="left">&nbsp;<font color="#0F7FAF">9.ค่าใช้จ่ายดำเนินงาน (ข้อ 9.1+9.2+9.3) </font></td>
	<td align="center"><div ID="45x1">0</div></td>
	<td align="center"><div ID="45x2">0</div></td>
	<td align="center"><div ID="45x3">0</div></td>
	<td align="center"><div ID="45x4">0</div></td>
	<td align="center"><div ID="45x5">0</div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">46</td>
	<td align="center"><div ID="46y1">0</div></td>
	<td align="center"><div ID="46y2">0</div></td>
	<td align="center"><div ID="46y3">0</div></td>
	<td align="left">&nbsp; 9.1 ค่าใช้จ่ายทั่วไป + อื่น ๆ </td>
	<td align="center"><div ID="46x1">0</div></td>
	<td align="center"><div ID="46x2">0</div></td>
	<td align="center"><div ID="46x3">0</div></td>
	<td align="center"><div ID="46x4">0</div></td>
	<td align="center"><div ID="46x5">0</div></td>
</tr>
 <tr>
	<td align="center">47</td>
	<td align="center"><div ID="47y1">0</div></td>
	<td align="center"><div ID="47y2">0</div></td>
	<td align="center"><div ID="47y3">0</div></td>
	<td align="left">&nbsp; 9.2 เงินเดือนค่าจ้าง </td>
	<td align="center"><div ID="47x1">0</div></td>
	<td align="center"><div ID="47x2">0</div></td>
	<td align="center"><div ID="47x3">0</div></td>
	<td align="center"><div ID="47x4">0</div></td>
	<td align="center"><div ID="47x5">0</div></td>
</tr>
 <tr class='rows_grey'>
	<td align="center">48</td>
	<td align="center"><div ID="48y1">0</div></td>
	<td align="center"><div ID="48y2">0</div></td>
	<td align="center"><div ID="48y3">0</div></td>
	<td align="left">&nbsp; 9.3 ค่าตอบแทนพิเศษ</td>
	<td align="center"><div ID="48x1">0</div></td>
	<td align="center"><div ID="48x2">0</div></td>
	<td align="center"><div ID="48x3">0</div></td>
	<td align="center"><div ID="48x4">0</div></td>
	<td align="center"><div ID="48x5">0</div></td>
</tr>
 <tr>
	<td align="center">49</td>
	<td align="center"><div ID="49y1">0</div></td>
	<td align="center"><div ID="49y2">0</div></td>
	<td align="center"><div ID="49y3">0</div></td>
	<td align="left">&nbsp;<font color="#0F7FAF">10.กำไร(ขาดทุน)สุทธิ (3.5+4.5+5.4-7.2+8-9)</font></td>
	<td align="center"><div ID="49x1">0</div></td>
	<td align="center"><div ID="49x2">0</div></td>
	<td align="center"><div ID="49x3">0</div></td>
	<td align="center"><div ID="49x4">0</div></td>
	<td align="center"><div ID="49x5">0</div></td>
</tr>
<!--  สิ้นสุดปรับปรุงข้อมูล -->
<script language="JavaScript">
		update_ajax();
		var t=setTimeout(" update_master(); ",3000);
</script>
</table>
<br><br>
</body>
</html>
<!-- *********************************************************** -->
<?php
	close();
?>