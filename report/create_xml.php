<?php
	header( "Content-Type: text/html; charset=windows-874" ); 
	header( "Expires: Sat, 1 Jan 1979 00:00:00 GMT" );
	header( "Last-Modified: ".gmdate( "D, d M Y H:i:s" )."GMT" );
	header( "Cache-Control: no-cache, must-revalidate" );
	header( "Pragma: no-cache" );
// สร้างข้อมูล XML ทั้งหมดในเฉพาะปีบัญชีที่เลือก
// เริ่มรายงานที่ 1
	$sql = " SELECT BaseProduct.pro_code, BaseProduct.pro_name, Temp01.sum01 ";
	$sql.=" FROM TargetProduct, BaseProduct ";
	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT  ";
	$sql.=" ReportGroup3.report_detail_code, ";
	$sql.=" SUM(ReportGroup3.data2+ReportGroup3.data5+ReportGroup3.data7)AS sum01  ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE ReportGroup3.report_year = '".$year."' ";
	$sql.=" AND ReportGroup3.report_month = '".$month."' ";
	$sql.=" GROUP BY ReportGroup3.report_detail_code ";
	$sql.=" )AS Temp01 ON Temp01.report_detail_code = BaseProduct.pro_code ";
	$sql.=" WHERE BaseProduct.pro_code = TargetProduct.report_detail_code ";
	$sql.=" AND TargetProduct.target_kpi = '1' ";
	$sql.=" ORDER BY BaseProduct.pro_code ";
	$result_report = query($sql);
	$xml = "<chart caption='' xAxisName='' yAxisName='value' showValues='0' decimals='0' formatNumberScale='0'>";
	WHILE($fetch_report = fetch_row($result_report)) { 
		$xml.="<set label='".trim($fetch_report[1])."' value='".number_format($fetch_report[2],0,'','')."' /> ";
	} // end while 
	$xml.="</chart> ";
 // รายงานที่ 1
	$file = fopen( "../data/".$year.$month."data1.xml","w+");
		fputs($file,$xml);
	fclose($file);

// จบรายงานภาพรวมในเดือน 
// เริ่มรายงานที่ 2
	$sql =" SELECT BaseProduct.pro_code, BaseProduct.pro_name, ";
	$sql.=" Temp01.sum01,Temp02.sum01,Temp03.sum01, ";
	$sql.=" Temp04.sum01,Temp05.sum01,Temp06.sum01, ";
	$sql.=" Temp07.sum01,Temp08.sum01,Temp09.sum01, ";
	$sql.=" Temp10.sum01,Temp11.sum01,Temp12.sum01 ";
	$sql.=" FROM TargetProduct, BaseProduct ";

	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT ReportGroup3.report_detail_code, ";
	$sql.=" SUM(ReportGroup3.data2+ReportGroup3.data5+ReportGroup3.data7)AS sum01  ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE ReportGroup3.report_year = '".$year."' ";
	$sql.=" AND ReportGroup3.report_month = '4' ";
	$sql.=" GROUP BY ReportGroup3.report_detail_code ";
	$sql.=" )AS Temp01 ON Temp01.report_detail_code = BaseProduct.pro_code ";

	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT ReportGroup3.report_detail_code, ";
	$sql.=" SUM(ReportGroup3.data2+ReportGroup3.data5+ReportGroup3.data7)AS sum01 ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE ReportGroup3.report_year = '".$year."' ";
	$sql.=" AND ReportGroup3.report_month = '5' ";
	$sql.=" GROUP BY ReportGroup3.report_detail_code ";
	$sql.=" )AS Temp02 ON Temp02.report_detail_code = BaseProduct.pro_code ";

	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT ReportGroup3.report_detail_code, ";
	$sql.=" SUM(ReportGroup3.data2+ReportGroup3.data5+ReportGroup3.data7)AS sum01  ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE ReportGroup3.report_year = '".$year."' ";
	$sql.=" AND ReportGroup3.report_month = '6' ";
	$sql.=" GROUP BY ReportGroup3.report_detail_code ";
	$sql.=" )AS Temp03 ON Temp03.report_detail_code = BaseProduct.pro_code ";

	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT ReportGroup3.report_detail_code, ";
	$sql.=" SUM(ReportGroup3.data2+ReportGroup3.data5+ReportGroup3.data7)AS sum01 ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE ReportGroup3.report_year = '".$year."' ";
	$sql.=" AND ReportGroup3.report_month = '7' ";
	$sql.=" GROUP BY ReportGroup3.report_detail_code ";
	$sql.=" )AS Temp04 ON Temp04.report_detail_code = BaseProduct.pro_code ";

	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT ReportGroup3.report_detail_code, ";
	$sql.=" SUM(ReportGroup3.data2+ReportGroup3.data5+ReportGroup3.data7)AS sum01  ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE ReportGroup3.report_year = '".$year."' ";
	$sql.=" AND ReportGroup3.report_month = '8' ";
	$sql.=" GROUP BY ReportGroup3.report_detail_code ";
	$sql.=" )AS Temp05 ON Temp05.report_detail_code = BaseProduct.pro_code ";

	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT ReportGroup3.report_detail_code, ";
	$sql.=" SUM(ReportGroup3.data2+ReportGroup3.data5+ReportGroup3.data7)AS sum01 ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE ReportGroup3.report_year = '".$year."' ";
	$sql.=" AND ReportGroup3.report_month = '9' ";
	$sql.=" GROUP BY ReportGroup3.report_detail_code ";
	$sql.=" )AS Temp06 ON Temp06.report_detail_code = BaseProduct.pro_code ";

	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT ReportGroup3.report_detail_code, ";
	$sql.=" SUM(ReportGroup3.data2+ReportGroup3.data5+ReportGroup3.data7)AS sum01  ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE ReportGroup3.report_year = '".$year."' ";
	$sql.=" AND ReportGroup3.report_month = '10' ";
	$sql.=" GROUP BY ReportGroup3.report_detail_code ";
	$sql.=" )AS Temp07 ON Temp07.report_detail_code = BaseProduct.pro_code ";

	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT ReportGroup3.report_detail_code, ";
	$sql.=" SUM(ReportGroup3.data2+ReportGroup3.data5+ReportGroup3.data7)AS sum01 ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE ReportGroup3.report_year = '".$year."' ";
	$sql.=" AND ReportGroup3.report_month = '11' ";
	$sql.=" GROUP BY ReportGroup3.report_detail_code ";
	$sql.=" )AS Temp08 ON Temp08.report_detail_code = BaseProduct.pro_code ";

	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT ReportGroup3.report_detail_code, ";
	$sql.=" SUM(ReportGroup3.data2+ReportGroup3.data5+ReportGroup3.data7)AS sum01  ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE ReportGroup3.report_year = '".$year."' ";
	$sql.=" AND ReportGroup3.report_month = '12' ";
	$sql.=" GROUP BY ReportGroup3.report_detail_code ";
	$sql.=" )AS Temp09 ON Temp09.report_detail_code = BaseProduct.pro_code ";

	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT ReportGroup3.report_detail_code, ";
	$sql.=" SUM(ReportGroup3.data2+ReportGroup3.data5+ReportGroup3.data7)AS sum01 ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE ReportGroup3.report_year = '".$year."' ";
	$sql.=" AND ReportGroup3.report_month = '1' ";
	$sql.=" GROUP BY ReportGroup3.report_detail_code ";
	$sql.=" )AS Temp10 ON Temp10.report_detail_code = BaseProduct.pro_code ";

	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT ReportGroup3.report_detail_code, ";
	$sql.=" SUM(ReportGroup3.data2+ReportGroup3.data5+ReportGroup3.data7)AS sum01  ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE ReportGroup3.report_year = '".$year."' ";
	$sql.=" AND ReportGroup3.report_month = '2' ";
	$sql.=" GROUP BY ReportGroup3.report_detail_code ";
	$sql.=" )AS Temp11 ON Temp11.report_detail_code = BaseProduct.pro_code ";

	$sql.=" LEFT JOIN ( ";
	$sql.=" SELECT ReportGroup3.report_detail_code, ";
	$sql.=" SUM(ReportGroup3.data2+ReportGroup3.data5+ReportGroup3.data7)AS sum01 ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE ReportGroup3.report_year = '".$year."' ";
	$sql.=" AND ReportGroup3.report_month = '3' ";
	$sql.=" GROUP BY ReportGroup3.report_detail_code ";
	$sql.=" )AS Temp12 ON Temp12.report_detail_code = BaseProduct.pro_code ";

	$sql.=" WHERE BaseProduct.pro_code = TargetProduct.report_detail_code ";
	$sql.=" AND TargetProduct.target_kpi = '1' ";
	$sql.=" ORDER BY BaseProduct.pro_code ";

	$xml1 = "<chart caption='' xAxisName='Month' showValues='0' bgCOlor='FFFFFF' showBorder='0' FontName='sans-serif' FontSize='10'>";
	$xml1.=" <categories> ";
	$xml1.=" 		<category label='เม.ย.' /> ";
	$xml1.=" 		<category label='พ.ค.' /> ";
	$xml1.=" 		<category label='มิ.ย.' /> ";
	$xml1.=" 		<category label='ก.ค.' /> ";
	$xml1.=" 		<category label='ส.ค.' /> ";
	$xml1.=" 		<category label='ก.ย.' /> ";
	$xml1.=" 		<category label='ต.ค.' /> ";
	$xml1.=" 		<category label='พ.ย.' /> ";
	$xml1.=" 		<category label='ธ.ค.' /> ";
	$xml1.=" 		<category label='ม.ค.' /> ";
	$xml1.=" 		<category label='ก.พ.' /> ";
	$xml1.=" 		<category label='มี.ค.' /> ";
	$xml1.=" 	</categories> ";

	$result_report = query($sql);
	WHILE($fetch_report = fetch_row($result_report)) { 
		$xml1.="<dataset seriesName='".trim($fetch_report[1])."'> ";
		$xml1.="	<set value='".number_format($fetch_report[2],0,'','')."' /> ";
		$xml1.="	<set value='".number_format($fetch_report[3],0,'','')."' /> ";
		$xml1.="	<set value='".number_format($fetch_report[4],0,'','')."' /> ";
		$xml1.="	<set value='".number_format($fetch_report[5],0,'','')."' /> ";
		$xml1.="	<set value='".number_format($fetch_report[6],0,'','')."' /> ";
		$xml1.="	<set value='".number_format($fetch_report[7],0,'','')."' /> ";
		$xml1.="	<set value='".number_format($fetch_report[8],0,'','')."' /> ";
		$xml1.="	<set value='".number_format($fetch_report[9],0,'','')."' /> ";
		$xml1.="	<set value='".number_format($fetch_report[10],0,'','')."' /> ";
		$xml1.="	<set value='".number_format($fetch_report[11],0,'','')."' /> ";
		$xml1.="	<set value='".number_format($fetch_report[12],0,'','')."' /> ";
		$xml1.="	<set value='".number_format($fetch_report[13],0,'','')."' /> ";
		$xml1.="</dataset> ";
	} // end while 
	$xml1.="<styles> ";
	$xml1.="	<definition> ";
	$xml1.="		<style name='myCaptionFont' type='font' size='14' bold='1' /> ";
	$xml1.="	</definition> ";
	$xml1.="	<application> ";
	$xml1.="		<apply toObject='Caption' styles='myCaptionFont' /> ";
	$xml1.="	</application> ";
	$xml1.="</styles> ";
	$xml1.="</chart> ";
 // รายงานที่ 2 
	$file = fopen( "../data/".$year.$month."data2.xml","w+");
		fputs($file,$xml1);
	fclose($file);

// กำหนดค่าสีใน KPI 
	$sql = " SELECT  a1, a2, b1, b2, c1, c2, d1, d2, e1, e2 ";
	$sql.=" FROM  TableKPI ";
	$result_kpi = query($sql);
	$temp_data1 = trim(result($result_kpi,0,'a1'));
	$temp_data2 = trim(result($result_kpi,0,'a2'));
	$temp_data3 = trim(result($result_kpi,0,'b1'));
	$temp_data4 = trim(result($result_kpi,0,'b2'));
	$temp_data5 = trim(result($result_kpi,0,'c1'));
	$temp_data6 = trim(result($result_kpi,0,'c2'));
	$temp_data7 = trim(result($result_kpi,0,'d1'));
	$temp_data8 = trim(result($result_kpi,0,'d2'));
	$temp_data9 = trim(result($result_kpi,0,'e1'));
	$temp_data10 = trim(result($result_kpi,0,'e2'));

// เริ่มแสดงรายงานที่ 3
	$sql = " SELECT BaseProduct.pro_code, BaseProduct.pro_name,  ";
	$sql.=" Temp01.sum01, Temp02.target_value ";
	$sql.=" FROM TargetProduct, BaseProduct ";
	$sql.="  LEFT JOIN ( ";
	$sql.=" SELECT  ReportGroup3.report_detail_code, ";
	$sql.=" SUM(ReportGroup3.data2+ReportGroup3.data5+ReportGroup3.data7)AS sum01  ";
	$sql.=" FROM ReportGroup3 ";
	$sql.=" WHERE ReportGroup3.report_year = '".$year."' ";
	$sql.=" AND ReportGroup3.report_month = '".$month."' ";
	$sql.=" GROUP BY ReportGroup3.report_detail_code ";
	$sql.=" )AS Temp01 ON Temp01.report_detail_code = BaseProduct.pro_code ";
	$sql.=" LEFT JOIN ( ";
	$sql.="   SELECT SUM(target_value)AS target_value, report_detail_code ";
	$sql.="   FROM TargetTris ";
	$sql.="   WHERE target_year = '".$year."' ";
	$sql.="   AND target_month ='3' ";
	$sql.="   GROUP BY report_detail_code ";
	$sql.=" )AS Temp02 ON Temp02.report_detail_code = BaseProduct.pro_code ";
	$sql.=" WHERE BaseProduct.pro_code = TargetProduct.report_detail_code ";
	$sql.=" AND TargetProduct.target_kpi = '1' ";
	$sql.=" ORDER BY BaseProduct.pro_code ";
	$result_report = query($sql);
	$j = 3;
	WHILE($fetch_report = fetch_row($result_report)) { 

		$xml ="<?xml version='1.0' encoding='windos-874'?> ";
		$xml.=" <chart lowerLimit='0' upperLimit='100' lowerLimitDisplay='ต่ำ' upperLimitDisplay='เยี่ยม' gaugeStartAngle='180' gaugeEndAngle='0' palette='1' numberSuffix='%' tickValueDistance='20' showValue='1' decimals='2' dataStreamURL='CPUData.asp' refreshInterval='3'> ";
		$xml.=" <colorRange> ";
		$xml.="   <color minValue='".$temp_data1."' maxValue='".$temp_data2."' code='FF0000'/> ";
		$xml.="   <color minValue='".$temp_data3."' maxValue='".$temp_data4."' code='ff6000'/> ";
		$xml.="   <color minValue='".$temp_data5."' maxValue='".$temp_data6."' code='ffc000'/> ";
		$xml.="   <color minValue='".$temp_data7."' maxValue='".$temp_data8."' code='8BBA00'/> ";
		$xml.="   <color minValue='".$temp_data9."' maxValue='".$temp_data10."' code='0040ff'/> ";
		$xml.=" </colorRange> ";
		$xml.=" <dials> ";
	 // ค่าที่คำนวนได้
		if(number_format($fetch_report[3],0,'','')!=0)
			{	$temp_number = number_format((number_format($fetch_report[2],0,'','')/number_format($fetch_report[3],0,'',''))*100,0,'','');  }
		else
			{	$temp_number = 0;	}

		$xml.=" <dial id='CS' value='".$temp_number."' rearExtension='10'/> ";  //  ค่าที่ต้องการให้แสดง

		$xml.=" </dials> ";
		$xml.="    <annotations> ";
		$xml.="      <annotationGroup xPos='150' yPos='105' > ";
		$xml.="   	<annotation type='text' x='0' y='20' label='สถานะ' align='center' bold='1' color='666666' size='11'/> ";
		$xml.="      </annotationGroup>	 ";
		$xml.="      <annotationGroup Id='GRPRED' xPos='175' yPos='125' visible='0' > ";
		$xml.="   	<annotation type='circle' x='0' y='0' radius='10' fillPattern='radial' color='FFBFBF,FF0000' showBorder='0'/> ";
		$xml.="      </annotationGroup>	 ";
		$xml.="      <annotationGroup Id='GRPYELLOW' xPos='175' yPos='125' visible='0'> ";
		$xml.="   	<annotation type='circle' x='0' y='0' radius='10' fillPattern='radial' color='FFFF00,BBBB00' showBorder='0'/> ";
		$xml.="      </annotationGroup> ";
		$xml.="      <annotationGroup Id='GRPGREEN' xPos='175' yPos='125' visible='0'> ";
		$xml.="   	<annotation type='circle' x='0' y='0' radius='10' fillPattern='radial' color='00FF00,339933' showBorder='0'/> ";
		$xml.="      </annotationGroup> ";
		$xml.="    </annotations> ";
		$xml.="   <alerts> ";
		$xml.="       <alert minValue='0' maxValue='75' action='showAnnotation' param='GRPRED' /> ";
		$xml.="       <alert minValue='75' maxValue='90' action='showAnnotation' param='GRPYELLOW' />  ";
		$xml.="       <alert minValue='90' maxValue='100' action='showAnnotation' param='GRPGREEN' />      ";  
		$xml.="    </alerts> ";
		$xml.="   <styles> ";
		$xml.="    <definition> ";
		$xml.="       <style type='font' name='myValueFont' bgColor='F1f1f1' borderColor='999999' /> ";
		$xml.="    </definition> ";
		$xml.="    <application> ";
		$xml.="       <apply toObject='Value' styles='myValueFont' /> ";
		$xml.="    </application> ";
		$xml.="   </styles> ";
		$xml.=" </chart> ";
	
	  // สร้างรายงาน
	  //   data3 ------ ขึ้นไป
		$temp_file = $year.$month."data".$j.".xml";
		$file = fopen( "../data/".$temp_file."","w+");
			fputs($file,$xml);
		fclose($file);

	$j++;
}  // end while

// Display Data
?>