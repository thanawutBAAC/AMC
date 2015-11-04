<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	$month_thai = array("1"=>'มกราคม',"2"=>'กุมภาพันธ์',"3"=>'มีนาคม',"4"=>'เมษายน',"5"=>'พฤษภาคม',"6"=>'มิถุนายน',"7"=>'กรกฏาคม',"8"=>'สิงหาคม',"9"=>'กันยายน',"10"=>'ตุลาคม',"11"=>'พฤศจิกายน',"12"=>'ธันวาคม');

	connect();

	//ค้นหาข้อมูลหัวรายงาน ท้ายรายงานต่าง ๆ ทั้งหมดก่อน แล้วเก็บใส่ไว้ใน array
	$sql =" SELECT  report_group_code, report_group_name, report_group_comment ";
	$sql.=" FROM  BaseReportGroup ";
	$sql.=" ORDER BY report_group_code ";
	$result_report_group = query($sql);
	$i = 1;
	WHILE($fetch_report_group = fetch_row($result_report_group))
	{
		$report_header[$i] = trim($fetch_report_group[0]);       // รหัสกลุ่มรายงาน
		$report_name[$i] = trim($fetch_report_group[1]);          // ชื่อกลุ่มรายงาน
		$report_comment[$i] = trim($fetch_report_group[2]);   // หมายเหตุท้ายตาราง
		$i++;
	}
	free_result($result_report_group);
	
	// ค้นหาข้อมูลรายงานที่ต้องการส่งเพื่อไปสร้างใน ajax
	$sql=" SELECT  BaseReportDetail.report_group_code, BaseReportDetail.report_detail_code, ";
	$sql.=" BaseReportDetail.report_detail_name ";
	$sql.=" FROM  BaseReportHeader, BaseReportDetail ";
	$sql.=" WHERE  BaseReportHeader.report_group_code = BaseReportDetail.report_group_code ";
	$sql.=" AND  BaseReportHeader.report_detail_code = BaseReportDetail.report_detail_code ";
	$sql.=" AND BaseReportHeader.amccode='".$code_online."' ";
	$sql.=" ORDER BY  BaseReportDetail.report_group_code, BaseReportDetail.report_detail_code ";
	$result_report = query($sql);
	
	if(	num_rows(query($sql))==0)
	{
			print '<script> alert(" ไม่มีข้อมูลรายละเอียดการส่งรายงานที่เลือก "); </script>';
			print '<script>javascript:history.back(1) </script>';
			exit();
	}

	// เก็บข้อมูลว่ามีการกำหนดให้แสดงรายงานหมวดนี้หรือไม่
	$report_search1 = 0;
	$report_search2 = 0;
	$report_search3 = 0;
	$report_search4 = 0;
	$report_search5 = 0;
	$report_search6 = 0;

	WHILE($fetch_javascript = fetch_row($result_report)) { 
		if($fetch_javascript[0]=='1')
		{	$temp_javascript1 = $temp_javascript1.trim($fetch_javascript[0]).trim($fetch_javascript[1])."#";	 
			$report_search1 = true;  }
		elseif($fetch_javascript[0]=='2')
		{	$temp_javascript2 = $temp_javascript2.trim($fetch_javascript[0]).trim($fetch_javascript[1])."#";
			$report_search2 = true;  }
		elseif($fetch_javascript[0]=='3')
		{	$temp_javascript3 = $temp_javascript3.trim($fetch_javascript[0]).trim($fetch_javascript[1])."#";	
			$report_search3 = true;  }
		elseif($fetch_javascript[0]=='4')
		{	$temp_javascript4 = $temp_javascript4.trim($fetch_javascript[0]).trim($fetch_javascript[1])."#";	
			$report_search4 = true;  }
		elseif($fetch_javascript[0]=='5')
		{	$temp_javascript5 = $temp_javascript5.trim($fetch_javascript[0]).trim($fetch_javascript[1])."#";	
			$report_search5 = true;  }
		elseif($fetch_javascript[0]=='6')
		{	$temp_javascript6 = $temp_javascript6.trim($fetch_javascript[0]).trim($fetch_javascript[1])."#";	
			$report_search6 = true;  }
	} // end while  javascript

	  //  ไม่เอาตัว # สุดท้ายมา   
		$temp_javascript1 = substr($temp_javascript1, 0, -1);  
		$temp_javascript2 = substr($temp_javascript2, 0, -1);  
		$temp_javascript3 = substr($temp_javascript3, 0, -1);  
		$temp_javascript4 = substr($temp_javascript4, 0, -1);  
		$temp_javascript5 = substr($temp_javascript5, 0, -1);  
		$temp_javascript6 = substr($temp_javascript6, 0, -1);  
?>
<html>
<head>
<title></title>
<?=$webSite['meta']; ?>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript" src="../js/javascript.js"></script>
<script language="JavaScript" type="text/javascript" src="../js/numberFormat154.js"></script>
<script language="JavaScript">

function doCallAjax2() {  //  ข้อมูลมูลค่าจัดหาสินค้ามาจำหน่าย  หมวดที่ 2
	HttPRequest2 = false; 
	if (window.XMLHttpRequest) { // Mozilla, Safari,... 
		HttPRequest2 = new XMLHttpRequest();
		if (HttPRequest2.overrideMimeType) { 
			HttPRequest2.overrideMimeType('text/html'); 
		}  
	} else if (window.ActiveXObject) { // IE 
	try {     
		HttPRequest2 = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) { 
			try {    
				HttPRequest2 = new ActiveXObject("Microsoft.XMLHTTP"); 
				} catch (e) {}
		} 
	}  
	if (!HttPRequest2) {    
		alert(' ไม่สามารถสร้าง XMLHTTP instance  ไม่สามารถดึงข้อมูลจากระบบได้ ');    
		return false; 
	} 
	var year = document.getElementById("year").value
	var Temp_ans;
	var Array_ans;
	var url2 = 'Ajax_procure.php?year='+year;               // ดึงข้อมูลแผนการดำเนินงานปี
	HttPRequest2.open('get',url2,true); 
	HttPRequest2.setRequestHeader('Content-Type', 'text/html; charset:windows-874');
	HttPRequest2.onreadystatechange = function() 
	{ 
		if(HttPRequest2.readyState == 3) {  // Loading Request    
			document.getElementById("mySpan").innerHTML = "Now is Loading...  ( ข้อมูลธุรกิจจัดหาสินค้ามาจำหน่าย ) ";        
		}      
		if(HttPRequest2.readyState == 4) // Return Request 
		{  	
			if(HttPRequest2.status==200){ 
				Temp_ans = HttPRequest2.responseText;   // ผลลัพธ์ที่ return กลับมา
				Array_ans=Temp_ans.split("#");
				var Data = "<?=$temp_javascript2 ?>";  //  ข้อมูลชื่อตัวแปร
				var Array_Temp=Data.split("#");
				var Array_Max=Array_Temp.length;
				for(i=0;i<Array_Max;i++)
				{
					var temp_data = Array_ans[i].split("@");
					var a = document.getElementById("21x"+Array_Temp[i]); 
					var b = document.getElementById("29x"+Array_Temp[i]);
					var c = document.getElementById("22x"+Array_Temp[i]);
					var d = document.getElementById("210x"+Array_Temp[i]);

					a.value = temp_data[0];
					b.value = temp_data[1];
					c.value = temp_data[2];
					d.value = temp_data[3];
				} // end for
				document.getElementById("mySpan").innerHTML = "";    
				Cal2();	
			}  // end if 200
		}   // end if 4
	}  // end function
   HttPRequest2.send(null);
} // end function doCallAjax2

 function Cal2()
	{
		var Data = "<?=$temp_javascript2 ?>";
		var Array_Temp=Data.split("#");
		var Array_Max=Array_Temp.length;
		var sum1=0; var sum2=0; var sum3=0;
		var sum4=0; var sum5=0; var sum6=0;
		var sum7=0; var sum8=0; var sum9=0;
		var sum10=0; var sum11=0; 
		for(i=0;i<Array_Max;i++)
		{
			var a = document.getElementById("21x"+Array_Temp[i]).value;       // เป้าหมาย พัน
			var b = document.getElementById("22x"+Array_Temp[i]).value;       // เป้าหมาย หน่วย
			var c = document.getElementById("23x"+Array_Temp[i]).value;       // จริง พัน
			var d = document.getElementById("24x"+Array_Temp[i]).value;       // จริง หน่วย
			var e = document.getElementById("25x"+Array_Temp[i]);                  // เปอร์เซนต์
			var f = document.getElementById("26x"+Array_Temp[i]).value;        // tabco พัน
			var g = document.getElementById("27x"+Array_Temp[i]).value;      // tabco หน่วย
			var h = document.getElementById("28x"+Array_Temp[i]);                  // ผลต่าง %
			var j = document.getElementById("29x"+Array_Temp[i]).value;        // เป้าหมาย พัน
			var k = document.getElementById("210x"+Array_Temp[i]).value;    // เป้าหมาย หน่วย
			var l = document.getElementById("211x"+Array_Temp[i]).value;      // จริง พัน
			var m = document.getElementById("212x"+Array_Temp[i]).value;    // จริง หน่วย
			var n = document.getElementById("213x"+Array_Temp[i]);     // ผลต่าง % 
			var o = document.getElementById("214x"+Array_Temp[i]).value;      // มูลค่าจัดหา

			sum1 = sum1+parseFloat(a);  // ผลรวมช่องที่ 1
			sum2 = sum2+parseFloat(b);  // ผลรวมช่องที่ 2
			sum3 = sum3+parseFloat(c);  // ผลรวมช่องที่ 3
			sum4 = sum4+parseFloat(d);  // ผลรวมช่องที่ 4

			if(parseInt(a)==0)
				e.value = "0%"
			else
			{	e.value = (c/(a/100)-100)    // ผลต่าง %  ช่องที่ 5
			   formatNumber( "25x"+Array_Temp[i]);  }   // จัดรูปแบบให้เป็นเปอร์เซนต 

			sum5 = sum5+parseFloat(f);  // ผลรวมช่องที่ 6
			sum6 = sum6+parseFloat(g);  // ผลรวมช่องที่ 7
			if(parseInt(c)==0)
				h.value = "0%"   // ช่องที่ 8
			else
			{	h.value = (f/c)*100;    
				formatNumber( "28x"+Array_Temp[i]);   }  // จัดรูปแบบให้เป็นเปอร์เซนต   ช่องที่ 8

			sum7 = sum7+parseFloat(j);  // ผลรวมช่องที่ 9
			sum8 = sum8+parseFloat(k);  // ผลรวมช่องที่ 10
			sum9 = sum9+parseFloat(l); // ผลรวมช่องที่ 11
			sum10 = sum10+parseFloat(m); // ผลรวมช่องที่ 12

			if(parseInt(j)==0)
				n.value = "0%"
			else
			{	n.value = (l/(j/100)-100)    // ผลต่าง %  ช่องที่ 13
				formatNumber( "213x"+Array_Temp[i]);  }  // จัดรูปแบบให้เป็นเปอร์เซนต

			sum11 = sum11+parseFloat(o);  // ผลรวมช่องที่ 14
		}  // end for

		document.getElementById("sum21").value = sum1.toFixed(2);
		document.getElementById("sum22").value = sum2.toFixed(2);
		document.getElementById("sum23").value = sum3.toFixed(2);
		document.getElementById("sum24").value = sum4.toFixed(2);
		document.getElementById("sum25").value = sum5.toFixed(2);
		document.getElementById("sum26").value = sum6.toFixed(2);
		document.getElementById("sum27").value = sum7.toFixed(2);
		document.getElementById("sum28").value = sum8.toFixed(2);
		document.getElementById("sum29").value = sum9.toFixed(2);
		document.getElementById("sum210").value = sum10.toFixed(2);
		document.getElementById("sum211").value = sum11.toFixed(2);
	} //  end function cal2

function doCallAjax3() {  //  ข้อมูลมูลค่ารวบรวมผลผลิตมาจำหน่าย  หมวดที่ 3
	HttPRequest3 = false; 
	if (window.XMLHttpRequest) { // Mozilla, Safari,... 
		HttPRequest3 = new XMLHttpRequest();
		if (HttPRequest3.overrideMimeType) { 
			HttPRequest3.overrideMimeType('text/html'); 
		}  
	} else if (window.ActiveXObject) { // IE 
	try {     
		HttPRequest3 = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) { 
			try {    
				HttPRequest3 = new ActiveXObject("Microsoft.XMLHTTP"); 
				} catch (e) {}
		} 
	}  
	if (!HttPRequest3) {    
		alert(' ไม่สามารถสร้าง XMLHTTP instance  ไม่สามารถดึงข้อมูลจากระบบได้ ');    
		return false; 
	} 
	var year = document.getElementById("year").value;
	var month = document.getElementById("month").value;
	var Temp_ans;
	var Array_ans;
	var url3 = 'Ajax_collect.php?year='+year+'&month='+month;               // ดึงข้อมูลแผนการดำเนินงานปี

	HttPRequest3.open('get',url3,true); 
	HttPRequest3.setRequestHeader('Content-Type', 'text/html; charset:windows-874');
	HttPRequest3.onreadystatechange = function() 
	{ 
		if(HttPRequest3.readyState == 3) {  // Loading Request    
			document.getElementById("mySpan").innerHTML = "Now is Loading...  ( ข้อมูลรวบรวมผลิตผลทางการเกษตร ) ";        
		}      
		if(HttPRequest3.readyState == 4) // Return Request 
		{  	
			if(HttPRequest3.status==200){  	
				Temp_ans = HttPRequest3.responseText;   // ผลลัพธ์ที่ return กลับมา
				Array_ans=Temp_ans.split("#");
				var Data = "<?=$temp_javascript3 ?>";  //  ข้อมูลชื่อตัวแปร
				var Array_Temp=Data.split("#");
				var Array_Max=Array_Temp.length;
				for(i=0;i<Array_Max;i++)
				{
					var temp_data = Array_ans[i].split("@");
					var a = document.getElementById("31x"+Array_Temp[i]); 
					var b = document.getElementById("32x"+Array_Temp[i]); 
					var c = document.getElementById("33x"+Array_Temp[i]);
					var d = document.getElementById("314x"+Array_Temp[i]);
					var e = document.getElementById("315x"+Array_Temp[i]);

					a.value = temp_data[0];
					b.value = temp_data[1];
					c.value = temp_data[2];
					d.value = temp_data[3];
					e.value = temp_data[4];
				}  // end for
				document.getElementById("mySpan").innerHTML = "";    
				Cal3();	
			} // end if 200
		}   // end  if 4    
	}  // end function
   HttPRequest3.send(null);
} // end function doCallAjax3

 function Cal3()
	{
		var Data = "<?=$temp_javascript3 ?>";
		var Array_Temp=Data.split("#");
		var Array_Max=Array_Temp.length;
		var sum1=0; var sum2=0; var sum3=0;
		var sum4=0; var sum5=0; var sum6=0;
		var sum7=0; var sum8=0; var sum9=0;
		var sum10=0; var sum11=0; var sum12=0;
		var sum13=0; var sum14=0; var sum15=0;
		var sum16=0; var sum17=0; var sum18=0;
		var sum19=0; var sum20=0; var sum21=0;

		for(i=0;i<Array_Max;i++)
		{
			var y1 = document.getElementById("31x"+Array_Temp[i]).value;       // เป้าหมาย Tris
			var y2 = document.getElementById("32x"+Array_Temp[i]).value;       // เป้าหมาย สกต ( ตัน )
			var y3 = document.getElementById("33x"+Array_Temp[i]).value;       // เป้าหมาย สกต. ( พันบาท )
			var y4 = document.getElementById("34x"+Array_Temp[i]).value;       //  สมาชิก เกษตรทั่วไป ( ราย )
			var y5 = document.getElementById("35x"+Array_Temp[i]).value;       //  สมาชิก เกษตรทั่วไป ( ตัน )
			var y6 = document.getElementById("36x"+Array_Temp[i]).value;       // สมาชิก เกษตรทั่วไป ( พันบาท )
			var y7 = document.getElementById("37x"+Array_Temp[i]).value;       // ชุมชน องค์กร 
			var y8 = document.getElementById("38x"+Array_Temp[i]).value;        // ชุมชน ( ต้น )
			var y9 = document.getElementById("39x"+Array_Temp[i]).value;        // ชุมชน ( พันบาท )
			var y10 = document.getElementById("310x"+Array_Temp[i]).value;     //  สนจ สนับสนุน ( ตัน )
			var y11 = document.getElementById("311x"+Array_Temp[i]).value;    //  สนจ สนับสนุน ( พันบาท )
			var y12 = document.getElementById("312x"+Array_Temp[i]);                //  ผลการดำเนินงาน  (ปริมาณ )
			var y13 = document.getElementById("313x"+Array_Temp[i]);                //  ผลการดำเนินงาน (พันบาท)
			var y14 = document.getElementById("314x"+Array_Temp[i]).value;    //  เป้ายหมายจำหน่าย  (ตัน)
			var y15 = document.getElementById("315x"+Array_Temp[i]).value;    // เป้าหมายจำหน่าย (พันบาท)
			var y16 = document.getElementById("316x"+Array_Temp[i]).value;   // ผลการจำหน่ายระหว่างปี  รวม (ตัน)
			var y17 = document.getElementById("317x"+Array_Temp[i]).value;     // ผลการจำหน่ายระหว่างปี รวม (พันบาท)
			var y18 = document.getElementById("318x"+Array_Temp[i]).value;    // ผลการจำหน่ายระหว่างปี tabco (ตัน)
			var y19 = document.getElementById("319x"+Array_Temp[i]).value;    // ผลการจำหน่ายระหว่างปี tabco (พันบาท)
			var y20 = document.getElementById("320x"+Array_Temp[i]).value;   //  มูลค่าคงเหลือ (ราคาทุน)
			var y21 = document.getElementById("321x"+Array_Temp[i]).value;    // เป็นนายหน้า ตัวแทน (พันบาท)

			sum1 = sum1+parseInt(y1);  // ผลรวมช่องที่ 1
			sum2 = sum2+parseInt(y2);  // ผลรวมช่องที่ 2
			sum3 = sum3+parseInt(y3);  // ผลรวมช่องที่ 3
			sum4 = sum4+parseInt(y4);  // ผลรวมช่องที่ 4
			sum5 = sum5+parseInt(y5);  // ผลรวมช่องที่ 5
			sum6 = sum6+parseInt(y6);  // ผลรวมช่องที่ 6
			sum7 = sum7+parseInt(y7);  // ผลรวมช่องที่ 7
			sum8 = sum8+parseInt(y8);  // ผลรวมช่องที่ 8
			sum9 = sum9+parseInt(y9);  // ผลรวมช่องที่ 9
			sum10 = sum10+parseInt(y10);  // ผลรวมช่องที่ 10
			sum11= sum11+parseInt(y11);  // ผลรวมช่องที่ 11
			sum14 = sum14+parseInt(y14);  // ผลรวมช่องที่ 14
			sum15 = sum15+parseInt(y15);  // ผลรวมช่องที่ 15
			sum16 = sum16+parseInt(y16);  // ผลรวมช่องที่ 16
			sum17 = sum17+parseInt(y17);  // ผลรวมช่องที่ 17
			sum18 = sum18+parseInt(y18);  // ผลรวมช่องที่ 18
			sum19 = sum19+parseInt(y19);  // ผลรวมช่องที่ 19
			sum20 = sum20+parseInt(y20);  // ผลรวมช่องที่ 20
			sum21 = sum21+parseInt(y21);  // ผลรวมช่องที่ 21

		   	y12.value =  parseInt(y5)+parseInt(y8)+parseInt(y10);   // คำนวณข้อมูล
			y13.value =  parseInt(y6)+parseInt(y9)+parseInt(y11);  //  คำนวณข้อมูล
			sum12 = sum12+parseInt(y12.value);  // ผลรวมช่องที่ 12
			sum13 = sum13+parseInt(y13.value);  // ผลรวมช่องที่ 13
		}  // end for
		document.getElementById("sum31").value = sum1;
		document.getElementById("sum32").value = sum2;
		document.getElementById("sum33").value = sum3;
		document.getElementById("sum34").value = sum4;
		document.getElementById("sum35").value = sum5;
		document.getElementById("sum36").value = sum6;
		document.getElementById("sum37").value = sum7;
		document.getElementById("sum38").value = sum8;
		document.getElementById("sum39").value = sum9;
		document.getElementById("sum310").value = sum10;
		document.getElementById("sum311").value = sum11;
		document.getElementById("sum312").value = sum12;
		document.getElementById("sum313").value = sum13;
		document.getElementById("sum314").value = sum14;
		document.getElementById("sum315").value = sum15;
		document.getElementById("sum316").value = sum16;
		document.getElementById("sum317").value = sum17;
		document.getElementById("sum318").value = sum18;
		document.getElementById("sum319").value = sum19;
		document.getElementById("sum320").value = sum20;
		document.getElementById("sum321").value = sum21;
	} //  end function cal3

function doCallAjax4() {  //  มูลค่าธุรกิจส่งเสริมการเกษตร หมวดที่ 4
	HttPRequest4 = false; 
	if (window.XMLHttpRequest) { // Mozilla, Safari,... 
		HttPRequest4 = new XMLHttpRequest();
		if (HttPRequest4.overrideMimeType) { 
			HttPRequest4.overrideMimeType('text/html'); 
		}  
	} else if (window.ActiveXObject) { // IE 
	try {     
		HttPRequest4 = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) { 
			try {    
				HttPRequest4 = new ActiveXObject("Microsoft.XMLHTTP"); 
				} catch (e) {}
		} 
	}  
	if (!HttPRequest4) {    
		alert(' ไม่สามารถสร้าง XMLHTTP instance  ไม่สามารถดึงข้อมูลจากระบบได้ ');    
		return false; 
	} 
	var year = document.getElementById("year").value
	var Temp_ans;
	var Array_ans;
	var url4 = 'Ajax_service.php?year='+year;               // ดึงข้อมูลแผนการดำเนินงานปี
	HttPRequest4.open('get',url4,true); 
	HttPRequest4.setRequestHeader('Content-Type', 'text/html; charset:windows-874');
	HttPRequest4.onreadystatechange = function() 
	{ 
		if(HttPRequest4.readyState == 3) {  // Loading Request    
			document.getElementById("mySpan").innerHTML = "Now is Loading...  ( ข้อมูลธุรกิจส่งเสริมการเกษตร ) ";        
		}      
		if(HttPRequest4.readyState == 4) // Return Request 
		{  
			if(HttPRequest4.status==200){ 
				Temp_ans = HttPRequest4.responseText;   // ผลลัพธ์ที่ return กลับมา
				Array_ans=Temp_ans.split("#");   // แยกข้อมูลผลลัพธ์ที่ได้
				var Data = "<?=$temp_javascript4 ?>";  //  ข้อมูลชื่อตัวแปร
				var Array_Temp=Data.split("#");
				var Array_Max=Array_Temp.length;
				for(i=0;i<Array_Max;i++)
				{
					var a = document.getElementById("41x"+Array_Temp[i]); 
					a.value = Array_ans[i];
				}  // end for
				document.getElementById("mySpan").innerHTML = "";    
				Cal4();	
			}  // end if 200
		}    // end if 4   
	}  // end function
   HttPRequest4.send(null);
} // end function doCallAjax4

	function Cal4()
	{
		var Data = "<?=$temp_javascript4 ?>";
		var Array_Temp=Data.split("#");
		var Array_Max=Array_Temp.length;
		for(i=0;i<Array_Max;i++)
		{
			var a = document.getElementById("42x"+Array_Temp[i]).value;
			var b = document.getElementById("43x"+Array_Temp[i]);
			var	num_ans = document.getElementById("41x"+Array_Temp[i]).value;  // เป้าหมาย
			if(num_ans==0)
			{	b.value = '0%'	}
			else
			{	b.value = (a/num_ans)*100;
				formatNumber( "43x"+Array_Temp[i]);   }  // จัดรูปแบบให้เป็นเปอร์เซนต์
		}  //  end for
	} //  end function cal4

function doCallAjax5() {  //  ข้อมูลหนี้วงเงินกู้ หมวดที่ 5
	HttPRequest5 = false; 
	if (window.XMLHttpRequest) { // Mozilla, Safari,... 
		HttPRequest5 = new XMLHttpRequest();
		if (HttPRequest5.overrideMimeType) { 
			HttPRequest5.overrideMimeType('text/html'); 
		}  
	} else if (window.ActiveXObject) { // IE 
	try {     
		HttPRequest5 = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) { 
			try {    
				HttPRequest5 = new ActiveXObject("Microsoft.XMLHTTP"); 
				} catch (e) {}
		} 
	}  
	if (!HttPRequest5) {    
		alert(' ไม่สามารถสร้าง XMLHTTP instance  ไม่สามารถดึงข้อมูลจากระบบได้ ');    
		return false; 
	} 
	var year = document.getElementById("year").value;
	var month = document.getElementById("month").value;
	var click = "<?=$click; ?>"; 
	var Temp_ans;
	var Array_ans;
	var url5 = 'Ajax_loan.php?year='+year+'&month='+month+'&click='+click;               // ดึงข้อมูลแผนการดำเนินงานปี
	HttPRequest5.open('get',url5,true); 
	HttPRequest5.setRequestHeader('Content-Type', 'text/html; charset:windows-874');
	HttPRequest5.onreadystatechange = function() 
	{ 
		if(HttPRequest5.readyState == 3) {  // Loading Request    
			document.getElementById("mySpan").innerHTML = "Now is Loading...  ( ข้อมูลธุรกิจส่งเสริมการเกษตร ) ";        
		}      
		if(HttPRequest5.readyState == 4) // Return Request 
		{  	
			if(HttPRequest5.status==200){
				Temp_ans = HttPRequest5.responseText;   // ผลลัพธ์ที่ return กลับมา
				Array_ans=Temp_ans.split("#");
				var Data = "<?=$temp_javascript5 ?>";  //  ข้อมูลชื่อตัวแปร
				var Array_Temp=Data.split("#");
				var Array_Max=Array_Temp.length;
				for(i=0;i<Array_Max;i++)
				{
					var a = document.getElementById("51x"+Array_Temp[i]); 
					a.value = Array_ans[i];
				}  // end for
				document.getElementById("mySpan").innerHTML = "";    
				Cal5();	
		 }   // end if 200    
	   }   // end if 4
	}  // end function
   HttPRequest5.send(null);
} // end function doCallAjax5

function Cal5()
	{
		var Data = "<?=$temp_javascript5 ?>";
		var Array_Temp=Data.split("#");
		var Array_Max=Array_Temp.length;
		var sum1=0; var sum2=0; var sum3=0;
		for(i=0;i<Array_Max;i++)
		{
			var a = document.getElementById("53x"+Array_Temp[i]).value;
			var b = document.getElementById("54x"+Array_Temp[i]);
			var	num_ans = document.getElementById("52x"+Array_Temp[i]).value;  // เป้าหมาย

			b.value = (num_ans-a);
			sum1 = sum1+parseInt(document.getElementById("51x"+Array_Temp[i]).value);
			sum2 = sum2+parseInt(num_ans);
			sum3 = sum3+parseInt(a);
		}
		document.getElementById("sum51").value = sum1;
		document.getElementById("sum52").value = sum2;
		document.getElementById("sum53").value = sum3;
	} //  end function cal5

	function Cal6()    //  สมาชิกที่ทำธุรกรรมกับ สกต หมวดที่ 6
	{
		try
		{
			if(document.getElementById("1x13").value.length==0)
			{	
				  document.getElementById("member6").value = 0;  
			}
			else
			{	 
				 document.getElementById("member6").value = document.getElementById("1x13").value;
			}
		}
		catch(err)
		{  document.getElementById("member6").value = 0;  }

		var Data = "<?=$temp_javascript6 ?>";
		var Array_Temp=Data.split("#");
		var Array_Max=Array_Temp.length;
		for(i=0;i<Array_Max;i++)
		{
			var a = document.getElementById("61x"+Array_Temp[i]).value;
			var b = document.getElementById("62x"+Array_Temp[i]);
			var	total_member = document.getElementById("member6").value;  // จำนวนสมาชิกทั้งหมด 
			if(total_member==0)
			{	b.value = '0%'	}
			else
			{	b.value = (a/total_member)*100;
				formatNumber( "62x"+Array_Temp[i]);   }  // จัดรูปแบบให้เป็นเปอร์เซนต์
		}  // end for
	} //  end function cal6

function update_data()
{
	var report_search2 = <?=$report_search2 ?>;			
	var report_search3 = <?=$report_search3 ?>;			
	var report_search4 = <?=$report_search4 ?>;			
	var report_search5 = <?=$report_search5 ?>;			
	var report_search6 = <?=$report_search6 ?>;			

	if(report_search2)
	{	doCallAjax2();
		Cal2();	}
	if(report_search3)
	{	doCallAjax3();
		Cal3();	}
	if(report_search4)
	{	doCallAjax4();
		Cal4();	}
	if(report_search5)
	{	doCallAjax5();
		Cal5();	}
	if(report_search6)
	{	Cal6();	}
}

</script>

</head>
<body>
<?
	include("../manu_bar.php");
?>
<!-- ************************************************************************************************ -->
<form name="report" action="sent_report_sql.php" method="post" onsubmit=" return check_submit(); ">
&nbsp;
<?
$temp_name = "";  // เก็บข้อมูลตัวแปรใน javascript
if($click=='add')
{	?>
<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_add.png');" class="span_icon">
<img src="../icons/application_add.png" alt=" เพิ่มข้อมูล " class="images_icon" >
</span>&nbsp;เพิ่มข้อมูลรายงาน ปีบัญชี
<? }
else
{ ?>
	<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/application_edit.png');" class="span_icon">
	<img src="../icons/application_edit.png" alt=" แก้ไขข้อมูล " class="images_icon" >
	</span>&nbsp;แก้ไขข้อมูลรายงาน ปีบัญชี
<? } ?>
<!--  ถ้าเป็นการเพิ่มข้อมูลใหม่จะแสดง list ให้เลือก  ถ้าเป็นการแก้ไขจะแสดง เป็น textbox -->
<!--  แสดงข้อมูลปีที่เลือก -->
<?
if($click=='add')
{	  $temp_year =  date("Y")+535; ?>
<select name="year" onChange='update_data(); ' >
<? WHILE($i<20) { 
	  $i++; 
	  $temp_year = $temp_year+1; ?>
	<option value="<?=$temp_year; ?>" 
	<? 	if(date("n")=='1' OR date("n")=='2' OR date("n")=='3')
			{
				if($temp_year==date("Y")+542){
					echo "selected";
				}
			}
			else{
				if($temp_year==date("Y")+543){
						echo "selected";
				}
			}  // end date ?> ><?=$temp_year; ?></option>
<?    } // end while ?>
</select>
เดือน 
<select name="month" onChange='update_data(); '>
<?
	$month_now = date('n');
	foreach ($month_thai as $i => $m)
	 {
		if($i==$month_now)
		  	echo "<option value='$i' selected>$m</option>"; 
		else
		    echo "<option value='$i'>$m</option>";	
	 }
?>
</select>
<? } // end add?>
<? if($click=='edit'){  ?>
	<input  name="year" type="text" size="6" class="txt_system" value="<?=$year; ?>"  readonly>
	<input name="" type="text" size="12" class="txt_system" value="<?=$month_thai[$month]; ?>" readonly>
	<input name="month" type="hidden" value="<?=$month ?>">
<?  } ?>
<!-- สิ้นสุดการแสดงปี  เดือน -->
<span id='mySpan'></span>

<? if($report_search1) { ?>
<!-- *********************************************************** ข้อมูลรายงานกลุ่มที่ 1******************************************************** -->
<table   width="500"  class="gridtable" style="margin-top:25px; margin-left:5px">
	<tr height='25px'><td colspan="2"align="left">&nbsp;<font color="#0F7FAF"><b>1. <?=$report_name[1]; ?></b></font></td></tr>
	<tr class="rows_orange">
		<td align="center" width="380"> รายการ </td>
		<td align="center" width="130"> ข้อมูล </td>
	</tr>
	<?php 
		$i=0;   
		$sql=" SELECT  BaseReportDetail.report_group_code, BaseReportDetail.report_detail_code, ";
		$sql.="  BaseReportDetail.report_detail_name, ";
		$sql.="  Temp01.report_value ";
		$sql.="  FROM  BaseReportHeader, BaseReportDetail  ";
		$sql.="  LEFT JOIN( ";
		$sql.=" 	SELECT report_detail_code, report_value ";
		$sql.=" 	FROM ReportGroup1 ";
		$sql.=" 	WHERE amccode='".$code_online."' AND report_year='".$year."' AND report_month='".$month."' ";
		$sql.="  )AS Temp01 ON Temp01.report_detail_code=BaseReportDetail.report_detail_code ";
		$sql.="  WHERE  BaseReportHeader.report_group_code = BaseReportDetail.report_group_code  ";
		$sql.="  AND  BaseReportHeader.report_detail_code = BaseReportDetail.report_detail_code  ";
		$sql.="  AND BaseReportHeader.amccode='".$code_online."'  ";
		$sql.="  AND BaseReportDetail.report_group_code='1' ";
		$sql.="  ORDER BY  BaseReportDetail.report_group_code, BaseReportDetail.report_detail_code  ";
		$result_report1 = query($sql);
		WHILE($fetch_report1 = fetch_row($result_report1)) { 
			$i++;	
			if(($i%2)==0)
				echo "<tr class='rows_grey'>";
			else
				echo "<tr>"; ?>			
				<td align="left">&nbsp;<?=trim($fetch_report1[2]); ?></td>
				<td align="center"><input type="text" id="1x<?=trim($fetch_report1[0]).trim($fetch_report1[1]); ?>" name="1x<?=trim($fetch_report1[0]).trim($fetch_report1[1]); ?>" <? if($report_search6) { echo " onKeyUp=\" Cal6(); \" ";  } ?>onKeyPress="return isNumberKeyMinus(this);" size="8" maxlength="8" class="txt_num" value="<?=number_format($fetch_report1[3],0,'',''); ?>"></td>
				<!--  ในกรณีที่มีข้อมูลสมาชิก ที่ทำธุรกรรม จะต้องไปปรับปรุงหมวดที่ 6 ด้วย  -->
			</tr>
		<?  	$temp_name = $temp_name."1x".trim($fetch_report1[0]).trim($fetch_report1[1])."#";   // สร้างตัวแปร javascript   ?>
<? }  // end while 
	free_result($result_report1);		?>
<!--  ปรับปรุงข้อมูลในส่วนของการแสดงหมายเหตุ ในกรณีที่ขาดทุน   11 พ.ย. 2552  -->
<?
	$sql = " SELECT comment FROM ReportComment ";
	$sql.=" WHERE amccode='".$code_online."' AND report_year='".$year."' AND report_month='".$month."' ";
	if(num_rows(query($sql))==0){
		$txt_comment = "-";
	}
	else{
		$result_comment = query($sql);
		$txt_comment = trim(result($result_comment,0,'comment'));
	}
	$i++;	
	if(($i%2)==0)
		echo "<tr class='rows_grey' height='50'>";
	else
		echo "<tr height='50'>"; ?>
	<td colspan='2' valign='middle'>&nbsp;<font color='red'>อธิบายสาเหตุของการขาดทุน </font>
	&nbsp;&nbsp;<textarea name="txt_comment" cols="40" rows="3" ><?=$txt_comment; ?></textarea>
	</td>	
	</tr>
<!--  สิ้นสุดการปรับปรุงข้อมูล  -->
</table>
<p style="margin-left:5px; margin-top:5px; margin-bottom:0px;"><?=$report_comment[1] ?></p>
<!-- ********************************************* สิ้นสุดข้อมูลรายงานกลุ่มที่ 1 ************************************************************-->
<? } ?>

<? 	if($report_search2) { ?>
<!-- **************************************************  ข้อมูลรายงานกลุ่มที่ 2 ************************************************************-->
<table   width="1542" class="gridtable" style="margin-top:25px; margin-left:5px; margin-right:5px;">
	<tr height='25px'> 
		<td colspan="15" align="left">&nbsp;<font color="#0F7FAF"><b> 2. <?=$report_name[2]; ?></b></font></td>
	</tr>
	<tr class="rows_green"> 
		<td rowspan="3" align="center" valign="middle" width="250"> รายการ </td>
		<td colspan="8" align="center" width="600"> ซื้อสินค้าระหว่างปี </td>
		<td colspan="5" rowspan="2" align="center" width="375"> ขายสินค้าระหว่างปี </td>
		<td rowspan="3" align="center" valign="middle" width="120"> มูลค่าสินค้าที่จัดหาโดยไม่ผ่าน<br>บัญชีซื้อ-ขาย </td>
	</tr>
	<tr class="rows_green"> 
		<td colspan="5" align="center" width="375"> รวม </td>
		<td colspan="3" align="center" width="225"> เฉพาะที่ซื้อจาก TABCO</td>
	</tr>
	<tr class="rows_green"> 
		<td align="center" width="90"> เป้าหมาย <br>(หน่วย)</td>
		<td align="center" width="90"> เป้าหมาย <br>(พันบาท)</td>
		<td align="center" width="90"> จริง <br>(หน่วย)</td>
		<td align="center" width="90"> จริง <br>(พันบาท)</td>
		<td align="center" width="90"> ผลต่าง(%) </td>
		<td align="center" width="90"> จริง <br>(หน่วย)</td>
		<td align="center" width="90"> จริง <br>(พันบาท)</td>
		<td align="center" width="90"> คำนวณ </td>
		<td align="center" width="90"> เป้าหมาย <br>(หน่วย)</td>
		<td align="center" width="90"> เป้าหมาย <br>(พันบาท)</td>
		<td align="center" width="90"> จริง <br>(หน่วย)</td>
		<td align="center" width="90"> จริง <br>(พันบาท)</td>
		<td align="center" width="90"> ผลต่าง(%) </td>
	</tr>
	<?php 
		$i=0; 
		$sql= " SELECT  BaseReportDetail.report_group_code, BaseReportDetail.report_detail_code, ";
		$sql.=" BaseReportDetail.report_detail_name, ";
		$sql.="  Temp01.product_buy_sum, Temp01.product_buy_unit, ";
		$sql.="  Temp01.product_buy_tabco, Temp01.product_tabco_unit, ";
		$sql.="  Temp01.product_sell_sum, Temp01.product_sell_unit, Temp01.product_procure, ";
		$sql.="  BaseReportDetail.report_detail_unit  ";
		$sql.="  FROM  BaseReportHeader, BaseReportDetail  ";
		$sql.="  LEFT JOIN( ";
		$sql.=" 	SELECT report_detail_code, product_buy_sum, product_buy_tabco,  ";
		$sql.=" 	product_sell_sum, product_procure, ";
		$sql.="  product_buy_unit, product_tabco_unit, product_sell_unit ";
		$sql.=" 	FROM ReportGroup2 ";
		$sql.=" 	WHERE amccode='".$code_online."' AND report_year='".$year."' AND report_month='".$month."' ";
		$sql.="  )AS Temp01 ON Temp01.report_detail_code=BaseReportDetail.report_detail_code ";
		$sql.="  WHERE  BaseReportHeader.report_group_code = BaseReportDetail.report_group_code  ";
		$sql.="  AND  BaseReportHeader.report_detail_code = BaseReportDetail.report_detail_code  ";
		$sql.="  AND BaseReportHeader.amccode='".$code_online."'  ";
		$sql.="  AND BaseReportDetail.report_group_code='2' ";
		$sql.="  ORDER BY  BaseReportDetail.report_group_code, BaseReportDetail.report_detail_code  ";
		
		$result_report2 = query($sql);
		WHILE($fetch_report2 = fetch_row($result_report2)) { 
			$i++;
			if(($i%2)==0)
				echo "<tr class='rows_grey'>";
			else
				echo "<tr>"; ?>			
				<td align="left">&nbsp;<?=trim($fetch_report2[2]); ?>&nbsp;<font color='#0033FF'><? if(!is_null($fetch_report2[10])) echo "[".trim($fetch_report2[10])."]"; ?></font> </td>
				<td align="center"><input type="text" id="22x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>" size="10" class="txt_num_system" readonly></td> <!--  2 หน่วย -->
				<td align="center"><input type="text" id="21x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>" size="10" class="txt_num_system"  readonly></td> <!--  3 พันบาท -->
				<td align="center"><input type="text" id="24x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>"  name="24x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>" onKeyPress="return isNumberKeyMinus(this);"  onKeyUp="  Cal2(); "  onChange=" formatNumber2(this.id) " size="10" maxlength="10" class="txt_num" value="<?=number_format($fetch_report2[4],2,'.',''); ?>"></td> <!-- 4 หน่วย -->
				<td align="center"><input type="text" id="23x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>"  name="23x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>" onKeyPress="return isNumberKeyMinus(this);"  onKeyUp="  Cal2(); " onChange=" formatNumber2(this.id) " size="10" maxlength="10" class="txt_num" value="<?=number_format($fetch_report2[3],2,'.',''); ?>"></td> <!-- 5 พันบาท -->
				<td align="center"><input type="text" id="25x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>" size="7" class="txt_num_system_percent" readonly></td><!-- 6 เปอร์เซ็นต์ -->
				<td align="center"><input type="text" id="27x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>"  name="27x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>" onKeyPress="return isNumberKeyMinus(this);"  onKeyUp="  Cal2(); "  onChange=" formatNumber2(this.id) " size="10" maxlength="10" class="txt_num" value="<?=number_format($fetch_report2[6],2,'.',''); ?>"></td> <!--  7 หน่วย -->
				<td align="center"><input type="text" id="26x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>" name="26x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>" onKeyPress="return isNumberKeyMinus(this);"  onKeyUp=" Cal2(); "  onChange=" formatNumber2(this.id) " size="10" maxlength="10" class="txt_num" value="<?=number_format($fetch_report2[5],2,'.',''); ?>"></td><!-- 8 พันบาท -->
				<td align="center"><input type="text" id="28x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>" size="7"  class="txt_num_system_percent" readonly></td><!--  9 คำนวณ -->
				<td align="center"><input type="text" id="210x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>" size="10" class="txt_num_system" readonly></td> <!-- 10 หน่วย  -->
				<td align="center"><input type="text" id="29x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>" size="10"  class="txt_num_system" readonly></td><!-- 11 พันบาท -->
				<td align="center"><input type="text" id="212x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>"  name="212x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>" onKeyPress="return isNumberKeyMinus(this);"  onKeyUp="  Cal2(); "  onChange=" formatNumber2(this.id) " size="10" maxlength="10" class="txt_num" value="<?=number_format($fetch_report2[8],2,'.',''); ?>"></td> <!-- 12 หน่วย -->
				<td align="center"><input type="text" id="211x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>" name="211x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>" onKeyPress="return isNumberKeyMinus(this);"  onKeyUp="  Cal2(); "  onChange=" formatNumber2(this.id) " size="10" maxlength="10" class="txt_num" value="<?=number_format($fetch_report2[7],2,'.',''); ?>"></td><!--  13 พันบาท -->
				<td align="center"><input type="text" id="213x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>" size="7"  class="txt_num_system_percent" readonly></td><!--  เปอร์เซ็นต์ -->
				<td align="center"><input type="text" id="214x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>" name="214x<?=trim($fetch_report2[0]).trim($fetch_report2[1]); ?>" onKeyPress="return isNumberKeyMinus(this);"   onKeyUp="  Cal2(); "  onChange=" formatNumber2(this.id) " size="10" maxlength="10" class="txt_num" value="<?=number_format($fetch_report2[9],2,'.',''); ?>"></td><!-- พันบาท  ซื้อ-ขาย  -->
			</tr>
	<?  	 // สร้างตัวแปร javascript   
			$temp_name = $temp_name."23x".trim($fetch_report2[0]).trim($fetch_report2[1])."#";   
			$temp_name = $temp_name."24x".trim($fetch_report2[0]).trim($fetch_report2[1])."#";  
			$temp_name = $temp_name."26x".trim($fetch_report2[0]).trim($fetch_report2[1])."#";   
			$temp_name = $temp_name."27x".trim($fetch_report2[0]).trim($fetch_report2[1])."#";   
			$temp_name = $temp_name."211x".trim($fetch_report2[0]).trim($fetch_report2[1])."#";   
			$temp_name = $temp_name."212x".trim($fetch_report2[0]).trim($fetch_report2[1])."#";   
	?>
<? } // end while
	free_result($result_report2);	?>
	 <tr class="rows_yellow">
		<td align="center"> รวม </td>
		<td align="center"><input type="text" id="sum22" size="10" class="txt_num_system" readonly></td> <!-- หน่วย -->
		<td align="center"><input type="text" id="sum21" size="10" class="txt_num_system" readonly></td><!-- พันบาท -->
		<td align="center"><input type="text" id="sum24" size="10" class="txt_num_system" readonly></td> <!-- หน่วย -->
		<td align="center"><input type="text" id="sum23" size="10" class="txt_num_system" readonly></td><!-- พันบาท -->
		<td align="center">&nbsp;</td>
		<td align="center"><input type="text" id="sum26" size="10" class="txt_num_system" readonly></td> <!-- หน่วย -->
		<td align="center"><input type="text" id="sum25" size="10" class="txt_num_system" readonly></td><!-- พันบาท -->
		<td align="center">&nbsp;</td>
		<td align="center"><input type="text" id="sum28" size="10" class="txt_num_system" readonly></td> <!-- หน่วย -->
		<td align="center"><input type="text" id="sum27" size="10" class="txt_num_system" readonly></td><!-- พันบาท -->
		<td align="center"><input type="text" id="sum210" size="10" class="txt_num_system" readonly></td> <!-- หน่วย -->
		<td align="center"><input type="text" id="sum29" size="10" class="txt_num_system" readonly></td><!-- พันบาท -->
		<td align="center">&nbsp;</td>
		<td align="center"><input type="text" id="sum211" size="10" class="txt_num_system" readonly></td><!-- พันบาท -->
	</tr>
</table>
<p style="margin-left:5px; margin-top:5px; margin-bottom:0px;"><?=$report_comment[2] ?></p>
<!--  *************************************************** สิ้นสุดข้อมูลรายงานกลุ่มที่ 2 **************************************************************-->
<? } ?>

<? 	if($report_search3) { ?>
<!-- ข้อมูลรายงานกลุ่มที่ 3 -->
<table width="1725" class="gridtable" style="margin-top:25px; margin-left:5px; margin-right:5px;">
  <tr height='25px'> 
    <td colspan="22" align="left">&nbsp;<font color="#0F7FAF"><b> 3. <?=$report_name[3]; ?></b></font></td>
  </tr>
  <tr class="rows_purple"> 
    <td rowspan="4" width="150" align="center" valign="middle">ผลผลิต</td>
    <td rowspan="3" align="center" valign="middle">เป้าหมายตามบันทึกข้อตกลง</td>
    <td colspan="2" rowspan="3" align="center" valign="middle">เป้าหมายการรวบรวมผลิตผล ของสกต.</td>
    <td colspan="6" align="center" >(3) ผลการรวบรวมระหว่างปี(ตัวชี้วัดของ Tris/บันทึกข้อตกลง)</td>
    <td colspan="2" rowspan="2" align="center" valign="middle">(4) สกต./สนจ.สนับสนุนการกระจายผลิตผล/ผลิตภัณฑ์</td>
    <td colspan="2" rowspan="2" align="center" valign="middle">(5) ผลการดำเนินงาน<br>(3.1)+(3.2)+(4)<br>(Tris/บันทึกข้อตกลง)</td>
    <td colspan="2" rowspan="3" align="center" valign="middle">(6) เป้าหมายการจำหน่ายผลิตผล ของสกต</td>
    <td colspan="4" align="center" >(7) ผลการจำหน่ายระหว่างปี</td>
    <td rowspan="3" align="center" valign="middle">(8) มูลค่า ผลิตผลคงเหลือ</td>
    <td rowspan="3" align="center" valign="middle">(9) เป็นนายหน้า/ตัวแทน</td>
  </tr>
  <tr class="rows_purple"> 
    <td colspan="3" align="center" >(3.1) สกต.รวบรวม ผลิตผล/ผลิตภัณฑ์จากสมาชิกเละเกษตรกรทั่วไป</td>
    <td colspan="3" align="center" >(3.2) สนจ.สนับสนุนองค์กรชุมชน<br>รวบรวม ผลิตผล/ผลิตภัณฑ์</td>
    <td colspan="2" rowspan="2" align="center" valign="middle">จำหน่ายรวม</td>
    <td colspan="2" rowspan="2" align="center" valign="middle">จำหน่ายให้TABCO</td>
  </tr>
  <tr class="rows_purple"> 
    <td colspan="3" align="center" >ผลการรวบรวม</td>
    <td colspan="3" align="center" >ผลการสนับสนุนรวบรวม</td>
    <td align="center" >ปริมาณ</td>
    <td align="center" >มูลค่า</td>
    <td align="center" >ปริมาณ</td>
    <td align="center" >มูลค่า</td>
  </tr>
  <tr class="rows_purple"> 
    <td align="center" width="70">(ตัน)</td>
    <td align="center" width="70">(ตัน)</td>
    <td align="center" width="70">(พันบาท)</td>
    <td align="center" width="75">(ราย)</td>
    <td align="center" width="75">(ตัน)</td>
    <td align="center" width="75">(พันบาท)</td>
    <td align="center" width="70">(องค์กร)</td>
    <td align="center" width="70">(ตัน)</td>
    <td align="center" width="70">(พันบาท)</td>
    <td align="center" width="70">(ตัน)</td>
    <td align="center" width="70">(พันบาท)</td>
    <td align="center" width="70">(ตัน)</td>
    <td align="center" width="70">(พันบาท)</td>
    <td align="center" width="80">(ตัน)</td>
    <td align="center" width="80">(พันบาท)</td>
    <td align="center" width="70">(ตัน)</td>
    <td align="center" width="70">(พันบาท)</td>
    <td align="center" width="70">(ตัน)</td>
    <td align="center" width="70">(พันบาท)</td>
    <td align="center" width="70">(ราคาทุน)</td>
    <td align="center" width="70">(พันบาท)</td>
  </tr>
	<?php 
		$i=0; 
		$sql = " SELECT BaseReportDetail.report_group_code, ";
		$sql.=" BaseReportDetail.report_detail_code, BaseReportDetail.report_detail_name, ";
		$sql.=" Temp01.data1, Temp01.data2, Temp01.data3, Temp01.data4, ";
		$sql.=" Temp01.data5, Temp01.data6, Temp01.data7, Temp01.data8, ";
		$sql.=" Temp01.data9, Temp01.data10, Temp01.data11, Temp01.data12, ";
		$sql.=" Temp01.data13, Temp01.data14 ";
		$sql.=" FROM BaseReportHeader, BaseReportDetail  ";
		$sql.=" LEFT JOIN(  ";
		$sql.=" SELECT report_detail_code,   ";
		$sql.=" data1,data2,data3,data4, data5,data6,data7,data8, ";
		$sql.=" data9,data10,data11,data12, data13,data14 ";
		$sql.=" FROM ReportGroup3  ";
		$sql.=" WHERE amccode='".$code_online."' AND report_year='".$year."' AND report_month='".$month."' ) ";
		$sql.=" AS Temp01 ON Temp01.report_detail_code=BaseReportDetail.report_detail_code  ";
		$sql.=" WHERE BaseReportHeader.report_group_code = BaseReportDetail.report_group_code  ";
		$sql.=" AND BaseReportHeader.report_detail_code = BaseReportDetail.report_detail_code  ";
		$sql.=" AND BaseReportHeader.amccode='".$code_online."' AND BaseReportDetail.report_group_code='3'  ";
		$sql.=" ORDER BY BaseReportDetail.report_group_code, BaseReportDetail.report_detail_code ";
		$result_report3 = query($sql);
		WHILE($fetch_report3 = fetch_row($result_report3)) { 
			$i++;
			if(($i%2)==0)
				echo "<tr class='rows_grey'>";
			else
				echo "<tr>"; ?>			
				<td align="left">&nbsp;<?=trim($fetch_report3[2]); ?></td>
				<td align="center"><input type="text" id="31x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" size="7" class="txt_num_system" readonly></td>
				<td align="center"><input type="text" id="32x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" size="7" class="txt_num_system" readonly></td>
				<td align="center"><input type="text" id="33x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" size="7" class="txt_num_system" readonly></td>
				<td align="center"><input type="text" id="34x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" name="34x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp="  Cal3(); " size="7" maxlength="8" class="txt_num" value="<?=number_format($fetch_report3[3],0,'',''); ?>"></td>
				<td align="center"><input type="text" id="35x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" name="35x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp=" Cal3(); " size="7" maxlength="8" class="txt_num" value="<?=number_format($fetch_report3[4],0,'',''); ?>"></td>
				<td align="center"><input type="text" id="36x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" name="36x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp=" Cal3(); " size="7"   maxlength="8" class="txt_num" value="<?=number_format($fetch_report3[5],0,'',''); ?>"></td>
				<td align="center"><input type="text" id="37x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" name="37x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp=" Cal3(); " size="7" maxlength="8" class="txt_num" value="<?=number_format($fetch_report3[6],0,'',''); ?>"></td>
				<td align="center"><input type="text" id="38x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" name="38x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp=" Cal3(); " size="7" maxlength="8" class="txt_num" value="<?=number_format($fetch_report3[7],0,'',''); ?>"></td>
				<td align="center"><input type="text" id="39x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" name="39x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp=" Cal3(); " size="7" maxlength="8" class="txt_num" value="<?=number_format($fetch_report3[8],0,'',''); ?>"></td>
				<td align="center"><input type="text" id="310x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" name="310x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp=" Cal3(); " size="7" maxlength="8" class="txt_num" value="<?=number_format($fetch_report3[9],0,'',''); ?>"></td>
				<td align="center"><input type="text" id="311x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" name="311x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp=" Cal3(); " size="7" maxlength="8" class="txt_num" value="<?=number_format($fetch_report3[10],0,'',''); ?>"></td>
				<td align="center"><input type="text" id="312x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" size="7"  class="txt_num_system" readonly></td>
				<td align="center"><input type="text" id="313x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" size="7" class="txt_num_system" readonly></td>
				<td align="center"><input type="text" id="314x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" size="7"  class="txt_num_system" readonly></td>
				<td align="center"><input type="text" id="315x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" size="7" class="txt_num_system" readonly></td>
				<td align="center"><input type="text" id="316x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" name="316x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp=" Cal3(); " size="7" maxlength="8" class="txt_num" value="<?=number_format($fetch_report3[11],0,'',''); ?>"></td>
				<td align="center"><input type="text" id="317x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" name="317x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp=" Cal3(); " size="7" maxlength="8" class="txt_num" value="<?=number_format($fetch_report3[12],0,'',''); ?>"></td>
				<td align="center"><input type="text" id="318x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" name="318x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp=" Cal3(); " size="7" maxlength="8" class="txt_num" value="<?=number_format($fetch_report3[13],0,'',''); ?>"></td>
				<td align="center"><input type="text" id="319x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" name="319x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp=" Cal3(); " size="7" maxlength="8" class="txt_num" value="<?=number_format($fetch_report3[14],0,'',''); ?>"></td>
				<td align="center"><input type="text" id="320x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" name="320x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp=" Cal3(); " size="7" maxlength="8" class="txt_num" value="<?=number_format($fetch_report3[15],0,'',''); ?>"></td>
				<td align="center"><input type="text" id="321x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" name="321x<?=trim($fetch_report3[0]).trim($fetch_report3[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp=" Cal3(); " size="7" maxlength="8" class="txt_num" value="<?=number_format($fetch_report3[16],0,'',''); ?>"></td>
			</tr>
	<?  	 // สร้างตัวแปร javascript   
			$temp_name = $temp_name."34x".trim($fetch_report3[0]).trim($fetch_report3[1])."#";  
			$temp_name = $temp_name."35x".trim($fetch_report3[0]).trim($fetch_report3[1])."#";  
			$temp_name = $temp_name."36x".trim($fetch_report3[0]).trim($fetch_report3[1])."#";  
			$temp_name = $temp_name."37x".trim($fetch_report3[0]).trim($fetch_report3[1])."#";   
			$temp_name = $temp_name."38x".trim($fetch_report3[0]).trim($fetch_report3[1])."#";   
			$temp_name = $temp_name."39x".trim($fetch_report3[0]).trim($fetch_report3[1])."#";   
			$temp_name = $temp_name."310x".trim($fetch_report3[0]).trim($fetch_report3[1])."#";  
			$temp_name = $temp_name."311x".trim($fetch_report3[0]).trim($fetch_report3[1])."#";   
			$temp_name = $temp_name."316x".trim($fetch_report3[0]).trim($fetch_report3[1])."#";   
			$temp_name = $temp_name."317x".trim($fetch_report3[0]).trim($fetch_report3[1])."#";   
			$temp_name = $temp_name."318x".trim($fetch_report3[0]).trim($fetch_report3[1])."#";   
			$temp_name = $temp_name."319x".trim($fetch_report3[0]).trim($fetch_report3[1])."#";  
			$temp_name = $temp_name."320x".trim($fetch_report3[0]).trim($fetch_report3[1])."#";  
			$temp_name = $temp_name."321x".trim($fetch_report3[0]).trim($fetch_report3[1])."#";   
	?>
<? } // end while 
	free_result($result_report3); ?>
  	<tr class="rows_yellow">
		<td align="center"> รวม </td>
		<td align="center"><input type="text" id="sum31" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum32" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum33" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum34" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum35" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum36" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum37" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum38" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum39" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum310" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum311" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum312" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum313" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum314" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum315" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum316" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum317" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum318" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum319" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum320" size="7" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum321" size="7" class="txt_num_system" readonly></td>
	</tr>
</table>
<p style="margin-left:5px; margin-top:5px; margin-bottom:0px;"><?=$report_comment[3] ?></p>
<!--  สิ้นสุดข้อมูลรายงานกลุ่มที่ 3 -->
<? } ?>

<? 	if($report_search4) { ?>
<!-- ข้อมูลรายงานกลุ่มที่ 4 -->
<table   width="600"  class="gridtable" style="margin-top:25px; margin-left:5px">
	<tr height='25px'><td colspan="4" align="left">&nbsp;<font color="#0F7FAF"><b> 4. <?=$report_name[4]; ?> </b></font></td></tr>
	<tr class="rows_brown">
		<td align="center" width="300"> ประเภทบริการ </td>
		<td align="center" width="100"> เป้าหมาย </td>
		<td align="center" width="100"> จริง </td>
		<td align="center" width="100"> ผลต่าง (%) </td>
	</tr>
	<?php 
		$i=0; 
		$sql = " SELECT BaseReportDetail.report_group_code, ";
		$sql.=" BaseReportDetail.report_detail_code, BaseReportDetail.report_detail_name, ";
		$sql.=" Temp01.service_value ";
		$sql.=" FROM BaseReportHeader, BaseReportDetail  ";
		$sql.=" LEFT JOIN(  ";
		$sql.=" SELECT report_detail_code, service_value ";
		$sql.=" FROM ReportGroup4 ";
		$sql.=" WHERE amccode='".$code_online."' AND report_year='".$year."' AND report_month='".$month."' ) ";
		$sql.=" AS Temp01 ON Temp01.report_detail_code=BaseReportDetail.report_detail_code  ";
		$sql.=" WHERE BaseReportHeader.report_group_code = BaseReportDetail.report_group_code  ";
		$sql.=" AND BaseReportHeader.report_detail_code = BaseReportDetail.report_detail_code  ";
		$sql.=" AND BaseReportHeader.amccode='".$code_online."' AND BaseReportDetail.report_group_code='4' "; 
		$sql.=" ORDER BY BaseReportDetail.report_group_code, BaseReportDetail.report_detail_code ";
		$result_report4=	query($sql);
		WHILE($fetch_report4 = fetch_row($result_report4)) { 
			$i++;
			if(($i%2)==0)
				echo "<tr class='rows_grey'>";
			else
				echo "<tr>"; ?>			
				<td align="left">&nbsp;<?=trim($fetch_report4[2]); ?></td>
				<td align="center"><input type="text" id="41x<?=trim($fetch_report4[0]).trim($fetch_report4[1]); ?>" size="8" class="txt_num_system" readonly></td>
				<td align="center"><input type="text" id="42x<?=trim($fetch_report4[0]).trim($fetch_report4[1]); ?>" name="42x<?=trim($fetch_report4[0]).trim($fetch_report4[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp="  Cal4(); " size="8" maxlength="8" class="txt_num" value="<?=number_format($fetch_report4[3],0,'',''); ?>"></td>
				<td align="center"><input type="text" id="43x<?=trim($fetch_report4[0]).trim($fetch_report4[1]); ?>" size="7" class="txt_num_system_percent"  readonly></td>
			</tr>
	<?  	 // สร้างตัวแปร javascript   
			$temp_name = $temp_name."42x".trim($fetch_report4[0]).trim($fetch_report4[1])."#";   
			$temp_name = $temp_name."43x".trim($fetch_report4[0]).trim($fetch_report4[1])."#";   
	?>
<? } // end while 
	free_result($result_report4); ?>
</table>
<p style="margin-left:5px; margin-top:5px; margin-bottom:0px;"><?=$report_comment[4] ?></p>
<!--  สิ้นสุดข้อมูลรายงานกลุ่มที่ 4 -->
<? } ?>

<? 	if($report_search5) { ?>
<!-- ข้อมูลรายงานกลุ่มที่ 5 -->
<table   width="650"  class="gridtable" style="margin-top:25px; margin-left:5px">
	<tr height='25px'><td colspan="5" align="left">&nbsp;<font color="#0F7FAF"><b> 5. <?=$report_name[5]; ?> </b></font></td></tr>
	<tr class="rows_pink">
		<td align="center" width="250"> ชื่อผู้ให้กู้ </td>
		<td align="center" width="100"> วงเงินกู้ </td>
		<td align="center" width="100"> เบิกเงินกู้ </td>
		<td align="center" width="100"> ชำระเงินกู้ </td>
		<td align="center" width="100"> ยอดหนี้คงเหลือ </td>
	</tr>
	<?php 
		$i=0; 
		$sql=" SELECT BaseReportDetail.report_group_code,  ";
		$sql.=" BaseReportDetail.report_detail_code, BaseReportDetail.report_detail_name,  ";
		$sql.=" Temp01.loan_limit, Temp01.loan_fund, Temp01.loan_pay  ";
		$sql.=" FROM BaseReportHeader, BaseReportDetail   ";
		$sql.=" LEFT JOIN(   ";
		$sql.=" SELECT report_detail_code, loan_limit, loan_fund, loan_pay  ";
		$sql.=" FROM ReportGroup5  ";
		$sql.=" WHERE amccode='".$code_online."' AND report_year='".$year."' AND report_month='".$month."' )  ";
		$sql.=" AS Temp01 ON Temp01.report_detail_code=BaseReportDetail.report_detail_code   ";
		$sql.=" WHERE BaseReportHeader.report_group_code = BaseReportDetail.report_group_code   ";
		$sql.=" AND BaseReportHeader.report_detail_code = BaseReportDetail.report_detail_code   ";
		$sql.=" AND BaseReportHeader.amccode='".$code_online."' AND BaseReportDetail.report_group_code='5'   ";
		$sql.=" ORDER BY BaseReportDetail.report_group_code, BaseReportDetail.report_detail_code  ";
		$result_report5 = query($sql);
		WHILE($fetch_report5 = fetch_row($result_report5)) { 
			$i++;
			if(($i%2)==0)
				echo "<tr class='rows_grey'>";
			else
				echo "<tr>"; ?>			
				<td align="left">&nbsp;<?=trim($fetch_report5[2]); ?></td>
				<td align="center"><input type="text" id="51x<?=trim($fetch_report5[0]).trim($fetch_report5[1]); ?>" name="51x<?=trim($fetch_report5[0]).trim($fetch_report5[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp=" Cal5(); " size="8" maxlength="8" <? if(trim($fetch_report5[1])==4 || trim($fetch_report5[1])==7 ) { echo "class='txt_num' "; } else { echo "class='txt_num_system' "; echo " readonly"; }?> value="<?=number_format($fetch_report5[3],0,'',''); ?>" ></td>
				<td align="center"><input type="text" id="52x<?=trim($fetch_report5[0]).trim($fetch_report5[1]); ?>" name="52x<?=trim($fetch_report5[0]).trim($fetch_report5[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp="  Cal5(); " size="8" maxlength="8" class="txt_num" value="<?=number_format($fetch_report5[4],0,'',''); ?>"></td>
				<td align="center"><input type="text" id="53x<?=trim($fetch_report5[0]).trim($fetch_report5[1]); ?>" name="53x<?=trim($fetch_report5[0]).trim($fetch_report5[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp="  Cal5(); " size="8" maxlength="8" class="txt_num" value="<?=number_format($fetch_report5[5],0,'',''); ?>"></td>
				<td align="center"><input type="text"  id="54x<?=trim($fetch_report5[0]).trim($fetch_report5[1]); ?>" size="8" class="txt_num_system_percent" readonly ></td>
			</tr>
	<?  	 // สร้างตัวแปร javascript   
			$temp_name = $temp_name."51x".trim($fetch_report5[0]).trim($fetch_report5[1])."#";  
			$temp_name = $temp_name."52x".trim($fetch_report5[0]).trim($fetch_report5[1])."#";   
			$temp_name = $temp_name."53x".trim($fetch_report5[0]).trim($fetch_report5[1])."#";   
	?>
<? } // end while 
 free_result($result_report5);  ?>
	<tr class="rows_yellow">
		<td align="center"> รวม </td>
		<td align="center"><input type="text" id="sum51" size="8" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum52" size="8" class="txt_num_system" readonly></td>
		<td align="center"><input type="text" id="sum53" size="8" class="txt_num_system" readonly></td>
		<td align="center">&nbsp;</td>
	</tr>
</table>
<p style="margin-left:5px; margin-top:5px; margin-bottom:0px;"><?=$report_comment[5] ?></p>
<? } ?>
<!--  สิ้นสุดข้อมูลรายงานกลุ่มที่ 5 -->

<? 	if($report_search6) { ?>
<!-- ข้อมูลรายงานกลุ่มที่ 6 -->
<table width="600"  class="gridtable" style="margin-top:25px; margin-left:5px">
	<tr height='25px'><td colspan="3" align="left">&nbsp;<font color="#0F7FAF"><b> 6. <?=$report_name[6]; ?> </b></font></td></tr>
	<tr class="rows_blue">
		<td align="center" width="400"> รายการ </td>
		<td align="center" width="100"> ข้อมูล </td>
		<td align="center" width="100"> เปอร์เซนต์ </td>
	</tr>
	<tr>
		<td align="left" width="400">&nbsp;จำนวนสมาชิกทั้งหมด </td>
		<td align="center" width="100"><input type="text" size="8" id="member6" class="txt_num_system" readonly></td>
		<td align="center" width="100"><input type="text" size="7" value="100%" class="txt_num_system_percent" readonly></td>
	</tr>
	<?php 
		$i=0; 
		$sql= " SELECT BaseReportDetail.report_group_code, ";
		$sql.=" BaseReportDetail.report_detail_code, BaseReportDetail.report_detail_name, ";
		$sql.=" Temp01.member_value ";
		$sql.=" FROM BaseReportHeader, BaseReportDetail  ";
		$sql.=" LEFT JOIN(  ";
		$sql.=" SELECT report_detail_code, member_value ";
		$sql.=" FROM ReportGroup6 ";
		$sql.=" WHERE amccode='".$code_online."' AND report_year='".$year."' AND report_month='".$month."' ) ";
		$sql.=" AS Temp01 ON Temp01.report_detail_code=BaseReportDetail.report_detail_code  ";
		$sql.=" WHERE BaseReportHeader.report_group_code = BaseReportDetail.report_group_code  ";
		$sql.=" AND BaseReportHeader.report_detail_code = BaseReportDetail.report_detail_code  ";
		$sql.=" AND BaseReportHeader.amccode='".$code_online."' AND BaseReportDetail.report_group_code='6' "; 
		$sql.=" ORDER BY BaseReportDetail.report_group_code, BaseReportDetail.report_detail_code ";

		$result_report6=	query($sql);
		WHILE($fetch_report6 = fetch_row($result_report6)) { 
			if(($i%2)==0)
				echo "<tr class='rows_grey'>";
			else
				echo "<tr>"; ?>			
				<td align="left">&nbsp;<?=trim($fetch_report6[2]); ?></td>
				<td align="center"><input type="text"  id="61x<?=trim($fetch_report6[0]).trim($fetch_report6[1]); ?>" name="61x<?=trim($fetch_report6[0]).trim($fetch_report6[1]); ?>" onKeyPress="return isNumberKeyMinus(this);" onKeyUp=" Cal6(); " size="8" maxlength="8" class="txt_num" value="<?=number_format($fetch_report6[3],0,'',''); ?>" ></td>
				<td align="center"><input type="text"  id="62x<?=trim($fetch_report6[0]).trim($fetch_report6[1]); ?>" size="7" value="" class="txt_num_system_percent" readonly></td>
			</tr>
	<? $i++;	 
		// สร้างตัวแปร javascript   
	$temp_name = $temp_name."61x".trim($fetch_report6[0]).trim($fetch_report6[1])."#";  
 } // end while
 free_result($result_report6);   ?>
</table>
<p style="margin-left:5px; margin-top:5px; margin-bottom:0px;"><?=$report_comment[6] ?></p>
<? } ?>
<!--  สิ้นสุดข้อมูลรายงานกลุ่มที่ 6 -->
<br>
<input type="checkbox" id='chk_confirm' value="1" ><font color="#FF3300"><strong> ยืนยันการพร้อมส่งข้อมูล </strong></font>
<br>
<center>
<input name="click" type="hidden" value="<?=$click; ?>">
<input type="submit" value=" บันทึกข้อมูล ">&nbsp;<input type="reset" value=" ยกเลิก ">
</center>
</form>
<!-- ****************************************************************************************** -->
<script language="JavaScript">
		update_data();    //  ปรับปรุงข้อมูล
</script>
<!--   สร้าง function javascript  ตรวจสอบการบันทึกข้อมูล -->
	<?  	$temp_name = substr($temp_name, 0, -1); //  ไม่เอาตัว # สุดท้ายมา    ?>
	<script language="JavaScript">
		 function check_submit()
		 {
			 	var temp_false = false;
				var temp_01;
				var Data = "<?=$temp_name ?>";
				var Array_Temp=Data.split("#");
				var Array_Max=Array_Temp.length;
				for(i=0;i<Array_Max;i++)
				{
					temp_01 = document.getElementById(Array_Temp[i]);
					if(temp_01.value.length==0)
					{
						temp_false = true;		
					}
				}
			// กรณีที่มีค่าว่างไม่อนุญาตให้แสดงข้อมูล
			if(temp_false==true) {
				alert(' กรุณาป้อนข้อมูลตัวเลขให้ครบทุกช่อง ');
				return false;
			}
			// ตรวจสอบสาเหตุการขาดทุน
			if(report.txt_comment.value.lenght==0)
			{
				alert(' กรุณาป้อนข้อมูลสาเหตุการขาดทุน  ถ้าไม่มีป้อน -  ');
				report.txt_comment.focus();
				return false;
			 }

			var  chk_confirm = document.getElementById("chk_confirm").checked;
			if(chk_confirm==0)
			{		alert('  กรุณาเลือกปุ่ม ยืนยันพร้อมการส่งข้อมูล  ');
					return false
			 }
		
			if (confirm(" กรุณายืนยันการปรับปรุงข้อมูล   ถ้าส่งข้อมูลแล้วระบบจะทำการ Lock การแก้ไขข้อมูลไว้  ")) {
				return true;
			}
			else {
				return false; 
			}
		 }
	</script>
<!-- สิ้นสุดการสร้าง function javascript  -->

</body>
</html>
<?php
	free_result($result_report);
	close();
	include("../footer.php")
?>