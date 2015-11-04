<?php session_start(); 
   include("lib/config.inc.php");
   include("check_login.php");
?>
<html>
<head>
	<title> โปรแกรมบริหารจัดการ สกต. </title>
	<link rel="StyleSheet" href="css/dtree.css" type="text/css" />
	<script type="text/javascript" src="js/dtree.js"></script>
</head>
<? $year = date("Y")+543; ?>
<body leftMargin='20'>

<div class="dtree">
	<script type="text/javascript">
		<!--
		//id, pid, name, url, title, target, icon, iconOPne, open,
		d = new dTree('d');
		d.config.target="right";		
		d.config.folderLinks = false;
		
// ----------------- โปรแกรมบริหารจัดการ สกต. ------------------//
	d.add(0,-1,'<B> โปรแกรมบริหาร สกต. </B>','','โปรแกรมบริหารจัดการ สกต.');
		d.add(1,0,'ระบบข้อมูลพื้นฐาน','','Introduction & Installation','','','',true);
	<?php if($user_type=='skt') { ?>
			d.add(101,1,' ข้อมูลทั่วไป','general/amc_general_edit.php','บันทึกข้อมูลทั่วไป','','TreeImages/house.gif');
			d.add(102,1,' ข้อมูลคณะกรรมการ','general/committee.php','บันทึกข้อมูลคณะกรรมการ','','TreeImages/user_suit.gif');
			d.add(103,1,' ข้อมูลเจ้าหน้าที่','general/personnel.php','บันทึกข้อมูลเจ้าหน้าที่','','TreeImages/profile.gif');
			d.add(104,1,' ประวัติการฝึกอบรมคณะกรรมการ','general/testing.php?type=committee','ประวัติการฝึกอบรมคณะกรรมการ','','TreeImages/vcard_edit.png');
			d.add(105,1,' ประวัติการฝึกอบรมเจ้าหน้าที่','general/testing.php?type=personnel','ประวัติการฝึกอบรมเจ้าหน้าที่','','TreeImages/vcard_edit.png');
			d.add(106,1,' ข้อมูลทรัพย์สิน','general/asset.php','บันทึกข้อมูลทรัพย์สิน','','TreeImages/lorry.gif');
			d.add(107,1,' ข้อมูลเครือข่ายสมาชิก','general/networkmember.php?SendYear=<?php echo $year; ?>','บันทึกข้อมูลเครือข่ายสมาชิก','','TreeImages/group.gif');
		//	d.add(108,1,' ข้อมูลเครือข่ายสาขา','general/networkbranch.php','บันทึกข้อมูลเครือข่ายสาขา','','TreeImages/building_link.gif');		


//------------------  รายงานเพื่อการบริหาร  ------------------------//
			d.add(110,1,'','',' รายงานเพื่อการบริหาร','','TreeImages/line2.gif');
	<?php } ?> // end if 
			d.add(111,1,' รายงานด้านที่ตั้ง ','general/rpt_location.php',' รายงานด้านที่ตั้ง ','','TreeImages/base-old.gif');
			d.add(112,1,' รายงานด้านบุคคลากร  ','general/rpt_personnel.php',' รายงานด้านบุคคลากร ','','TreeImages/base-old.gif');
			d.add(113,1,' รายงานด้านการฝึกอบรมบุคคลากร  ','general/rpt_testing.php?type=search',' รายงานด้านการฝึกอบรมบุคคลากร ','','TreeImages/base-old.gif');
			d.add(114,1,' รายงานด้านข้อมุลเครือข่ายสมาชิก ','general/rpt_networkmember.php',' รายงานด้านข้อมูลเครือข่ายสมาชิก ','','TreeImages/base-old.gif');
			d.add(115,1,' รายงานด้านทรัพย์สิน ','general/rpt_asset.php',' รายงานด้านทรัพย์สิน ','','TreeImages/base-old.gif');

// --------------- ระบบประเมินเป้าหมาย สกต. สกก.4  -------------------- //
		d.add(2,0,'ระบบรายงานแผน สก.กก.4 ประจำปีของ สกต. ','');
	<?php if($user_type=='skt') { ?>
			d.add(201,2,' สรุป แผนการดำเนินงานประจำปี','skk4/PlanMaster.php','สรุป แผนการดำเนินงานประจำปี','','TreeImages/script.gif');
			d.add(202,2,' แผนสมาชิก และเพิ่มทุนเรือนหุ้น','skk4/PlanMember.php','แผนสมาชิก และเพิ่มทุนเรือนหุ้น (เอกสารหมายเลข 3 )','','TreeImages/page_brown.gif');
			d.add(203,2,' แผนจัดหาสินค้ามาจำหน่าย ยอดซื้อ','skk4/PlanProcureBuy.php','แผนจัดหาสินค้ามาจำหน่าย ยอดซื้อ (เอกสารหมายเลข 4 )','','TreeImages/page_red.gif');
			d.add(204,2,' แผนจัดหาสินค้ามาจำหน่าย ยอดขาย','skk4/PlanProcureSell.php','แผนจัดหาสินค้ามาจำหน่าย ยอดขาย (เอกสารหมายเลข 5 )','','TreeImages/page_red.gif');
			d.add(205,2,' แผนการรวบรวมผลิตผลการเกษตร ยอดซื้อ','skk4/PlanCollectBuy.php','แผนการรวบรวมผลิตผลการเกษตร ยอดซื้อ (เอกสารหมายเลข 6 )','','TreeImages/page_green.gif');
			d.add(206,2,' แผนการรวบรวมผลผลิตการเกษตร ยอดขาย','skk4/PlanCollectSell.php','แผนการรวบรวมผลผลิตการเกษตร ยอดขาย (เอกสารหมายเลข 7 )','','TreeImages/page_green.gif');
			d.add(209,2,' แผนการแปรรูปผลผลิตการเกษตร ยอดซื้อ','skk4/PlanTransBuy.php','แผนการแปรรูปผลผลิตการเกษตร ยอดซื้อ ','','TreeImages/page_blue.gif');
			d.add(210,2,' แผนการแปรรูปผลผลิตการเกษตร ยอดขาย','skk4/PlanTransSell.php','แผนการแปรรูปผลผลิตการเกษตร ยอดขาย ','','TreeImages/page_blue.gif');
			d.add(207,2,' แผนการให้บริการและส่งเสริมการเกษตร','skk4/PlanService.php','แผนการให้บริการและส่งเสริมการเกษตร (เอกสารหมายเลข 8 )','','TreeImages/page_yellow.gif');
			d.add(208,2,' แผนการจ่ายค่าใช้จ่าย','skk4/PlanExpenses.php','แผนการจ่ายค่าใช้จ่าย (เอกสารหมายเลข 9 )','','TreeImages/page_yellow.gif');
//------------------  รายงาน  -------------------------//
			d.add(200,2,'','',' รายงานแผน สก.กก.4 ประจำปีของ สกต.','','TreeImages/line2.gif');
	<?php } ?> // end if 
			d.add(209,2,' รายการส่งข้อมูลแผน สก.กก.4','skk4/check_report.php','รายงานการส่งข้อมูลแผน สกก.4','','TreeImages/base-old.gif');
			d.add(210,2,' รายงานรายละเอียดแผน สก.กก.4 ','skk4/rpt_01.php','รายงานการส่งข้อมูลแผน สกก.4','','TreeImages/base-old.gif');
			d.add(211,2,' รายงานภาพรวมแผน สก.กก.4 ','skk4/rpt_02.php','รายงานภาพรวมแผน สกก.4','','TreeImages/base-old.gif');

// ---------------- ระบบส่งรายงานประจำเดือน -----------------//
		d.add(3,0,'ระบบส่งรายงานประจำเดือน');
		<?php if($user_type=='skt') { ?>
			d.add(301,3,' ส่งรายงานประจำเดือน','sent report/sent_report.php',' ส่งรายงานประจำเดือน ','','TreeImages/overlays.gif');
			d.add(302,3,' กำหนดหัวข้อรายงาน','sent report/config_report.php',' กำหนดหัวข้อรายงาน ','','TreeImages/cog_edit.gif');	
		<?php } ?> // end if 
		<?php if($user_type=='admin') { ?>
			d.add(303,3,' ป้องกันแก้ไขรายงาน ','sent report/lock_report.php',' ป้องกันแก้ไขรายงาน ','','TreeImages/lock.gif');	
		<?php } ?> // end if 
			d.add(304,3,' รายงานสรุปส่งรายงานประจำเดือน ','sent report/check_report.php',' รายงานสรุปส่งรายงานประจำเดือน ','','TreeImages/base-old.gif');	
// ---------------- ระบบรายงาน สกต  แบบเก่า -----------------//
//		d.add(4,0,'รายงานผลการดำเนินงาน สกต. แบบเก่า');
//			d.add(401,4,' รายงานผลการดำเนินงานของ สกต.ประจำเดือน','report/rpt_01.php','รายงานผลการดำเนินงานของ สกต.ประจำเดือน','','TreeImages/base-old.gif');
//			d.add(402,4,' ข้อมูลทั่วไป ณ.สิ้นเดือนรายงาน','report/rpt_02.php','ข้อมูลทั่วไป ณ.สิ้นเดือนรายงาน','','TreeImages/base-old.gif');	
//			d.add(403,4,' มูลค่าธุรกิจจัดหาสินค้ามาจำหน่าย','report/rpt_03.php','มูลค่าธุรกิจจัดหาสินค้ามาจำหน่าย','','TreeImages/base-old.gif');
//			d.add(404,4,' มูลค่าธุรกิจรวบรวมผลผลิต (มุมมองผลิตผล)','report/rpt_04.php','มูลค่าธุรกิจรวบรวมผลผลิต (มุมมองผลิตผล)','','TreeImages/base-old.gif');
//			d.add(405,4,' มูลค่าธุรกิจรวบรวมผลผลิต (มุมมอง ฝสข.,จังหวัด) หน่วย:พันบาท','report/rpt_05.php','มูลค่าธุรกิจรวบรวมผลผลิต (มุมมอง ฝสข.,จังหวัด) หน่วย:พันบาท','','TreeImages/base-old.gif');	
//			d.add(406,4,' มูลค่าธุรกิจรวบรวมผลผลิต (มุมมอง ฝสข.,จังหวัด) หน่วย:ตัน','report/rpt_06.php','มูลค่าธุรกิจรวบรวมผลผลิต (มุมมอง ฝสข.,จังหวัด) หน่วย:ตัน','','TreeImages/base-old.gif');	
//			d.add(407,4,' มูลค่าธุรกิจรวบรวมผลผลิต ธุรกิจรวบรวม+จำหน่าย ตัวชี้วัดของ (มุมมองผลิตผล)','report/rpt_07.php','มูลค่าธุรกิจรวบรวมผลผลิต ธุรกิจรวบรวม+จำหน่าย ตัวชี้วัดของ (มุมมองผลิตผล)','','TreeImages/base-old.gif');	
//		d.add(408,4,' มูลค่าธุรกิจรวบรวมผลผลิต ธุรกิจรวบรวม ตัวชี้วัดของ  (มุมมองผลิตผล)','report/rpt_08.php','มูลค่าธุรกิจรวบรวมผลผลิต ธุรกิจรวบรวม ตัวชี้วัดของ  (มุมมองผลิตผล)','','TreeImages/base-old.gif');	
//			d.add(409,4,' มูลค่าธุรกิจรวบรวมผลผลิต ธุรกิจจำหน่าย ตัวชี้วัดของ  (มุมมองผลิตผล)','report/rpt_09.php','มูลค่าธุรกิจรวบรวมผลผลิต ธุรกิจจำหน่าย ตัวชี้วัดของ  (มุมมองผลิตผล)','','TreeImages/base-old.gif');	
//		d.add(410,4,' มูลค่าธุรกิจรวบรวมผลผลิต ธุรกิจรวบรวม ตัวชี้วัดของ (มุมมองฝสข.,จังหวัด)','report/rpt_10.php','มูลค่าธุรกิจรวบรวมผลผลิต ธุรกิจรวบรวม ตัวชี้วัดของ  (มุมมองฝสข.,จังหวัด)','','TreeImages/base-old.gif');	
//			d.add(411,4,' มูลค่าธุรกิจรวบรวมผลผลิต ธุรกิจจำหน่าย ตัวชี้วัดของ  (มุมมองฝสข.,จังหวัด) ','report/rpt_11.php','มูลค่าธุรกิจรวบรวมผลผลิต ธุรกิจจำหน่าย ตัวชี้วัดของ  (มุมมองฝสข.,จังหวัด) ','','TreeImages/base-old.gif');	
//			d.add(412,4,' มูลค่าธุรกิจให้บริการและส่งเสริมการเกษตร  ','report/rpt_12.php','มูลค่าธุรกิจให้บริการและส่งเสริมการเกษตร  ','','TreeImages/base-old.gif');	
//			d.add(413,4,' รายงานแหล่งเงินกู้ ','report/rpt_13.php',' แหล่งเงินกู้ ','','TreeImages/base-old.gif');	
//			d.add(414,4,' จำนวนสมาชิกที่ทำธุรกิจกับสกต. ','report/rpt_14.php','จำนวนสมาชิกที่ทำธุรกิจกับสกต.','','TreeImages/base-old.gif');	

//			d.add(415,4,' รายงานการรวบรวมผลผลิต 5 พืชหลัก','report/rpt_99.php','รายงานการรวบรวมผลผลิต 5 พืชหลัก','','TreeImages/base-old.gif');

// -------------- ข้อมูลรายงานผลการดำเนินงาน สกต. ปรับปรุงใหม่ ------------------//
		d.add(5,0,'รายงานผลการดำเนินงาน สกต.');
			d.add(501,5,' รายงานผลการดำเนินงานของ สกต.ประจำเดือน','report/rpt_01.php','รายงานผลการดำเนินงานของ สกต.ประจำเดือน','','TreeImages/base-old.gif');
			d.add(502,5,' ข้อมูลทั่วไป ณ.สิ้นเดือนรายงาน','report/rpt_02.php','ข้อมูลทั่วไป ณ.สิ้นเดือนรายงาน','','TreeImages/base-old.gif');	
			d.add(503,5,' รายงานผลการดำเนินธุรกิจจัดหาสินค้ามาจำหน่าย','report/rpt_03.php','มูลค่าธุรกิจจัดหาสินค้ามาจำหน่าย','','TreeImages/base-old.gif');
			d.add(504,5,' รายงานผลการรวบรวมผลิตผล');
				d.add(5041,504,' รายงานรวบรวมผลิตผลทั้งหมด','report/rpt_15.php','รายงานรวบรวมผลิตผลทั้งหมด','','TreeImages/base-old.gif');
				d.add(5042,504,' รายงานรวบรวมผลิตผลใช้ติดตามเป้าหมาย','report/rpt_16.php','รายงานรวบรวมผลิตผลใช้ติดตามเป้าหมาย','','TreeImages/base-old.gif');
				d.add(5043,504,'  รายงานการรวบรวมผลผลิตหลัก','report/rpt_99.php','รายงานการรวบรวมผลผลิตหลัก','','TreeImages/base-old.gif');
			d.add(509,5,' รายงานผลการดำเนินธุรกิจแปรรูปผลผลิต','report/rpt_18.php',' รายงานผลการดำเนินธุรกิจแปรรูปผลผลิต','','TreeImages/base-old.gif');
			d.add(505,5,' รายงานผลการดำเนินธุรกิจบริการ','report/rpt_12.php',' รายงานผลการดำเนินธุรกิจบริการ','','TreeImages/base-old.gif');
			d.add(506,5,' รายงานแหล่งเงินกู้ ','report/rpt_13.php',' แหล่งเงินกู้ ','','TreeImages/base-old.gif');	
			d.add(507,5,' จำนวนสมาชิกที่ทำธุรกิจกับสกต. ','report/rpt_14.php','จำนวนสมาชิกที่ทำธุรกิจกับสกต.','','TreeImages/base-old.gif');	
			d.add(508,5,' ผลการดำเนินงานตามแผนธุรกิจของ สกต. ','report/rpt_17.php','ผลการดำเนินงานตามแผนธุรกิจของ สกต. .','','TreeImages/base-old.gif');	

//-----------------  รายงานงบการเงิน ---------------------
		d.add(6,0,'รายงานงบการเงิน (อยู่ระหว่างการพัฒนา) ');
			d.add(612,6,' ส่งข้อมุลงบการเงิน (ใช้ user และ password เดิม)','http://snowdrop/branch/index.php',' ส่งข้อมุลงบการเงิน (ใช้ user และ password เดิม) ','_Blank','TreeImages/application_get.png');
			d.add(601,6,' งบต้นทุนขาย/บริการ','http://spvsrv/mkcoop/rpt_serv_bal.asp',' งบต้นทุนขาย / บริการ ','_Blank','TreeImages/coins.gif');
			d.add(602,6,' งบดุล','http://spvsrv/mkcoop/rpt_bal.asp',' งบดุล ','_Blank','TreeImages/coins.gif');
			d.add(603,6,' งบกำไรขาดทุน','http://spvsrv/mkcoop/rpt_pro_loss_bal.asp',' งบกำไรขาดทุน ','_Blank','TreeImages/coins.gif');		
			d.add(604,6,' งบทดลอง','http://spvsrv/mkcoop/rpt_tril_bal.asp',' งบทดลอง ','_Blank','TreeImages/coins.gif');
			d.add(605,6,' รายละเอียดกำไร(ขาดทุน) เฉพาะธุรกิจจัดหาสินค้ามาจำหน่าย ','http://spvsrv/mkcoop/rpt_pro_loss_good.asp',' รายละเอียดกำไร(ขาดทุน) เฉพาะธุรกิจจัดหาสินค้ามาจำหน่าย ','_Blank','TreeImages/coins.gif');
			d.add(606,6,' รายละเอียดกำไร(ขาดทุน) เฉพาะธุรกิจรวบรวมผลิตผล ','http://spvsrv/mkcoop/rpt_pro_loss_product.asp',' รายละเอียดกำไร(ขาดทุน)  เฉพาะธุรกิจรวบรวมผลิตผล ','_Blank','TreeImages/coins.gif');
			d.add(607,6,' รายละเอียด รายได้อื่น ','http://spvsrv/mkcoop/rpt_oth_income.asp',' รายละเอียด รายได้อื่น ','_Blank','TreeImages/base-old.gif');
			d.add(608,6,' รายละเอียด ค่าใช้จ่ายดำเนินงาน ','http://spvsrv/mkcoop/rpt_operation_exp.asp',' รายละเอียด ค่าใช้จ่ายดำเนินการ ','_Blank','TreeImages/base-old.gif');
			d.add(609,6,' รายงานวิเคราะห์ประสิทธิภาพการบริหารงาน ','http://spvsrv/mkcoop/rpt_ratio.asp',' รายงานวิเคราะห์ประสิทธิภาพการบริหารงาน ','_Blank','TreeImages/base-old.gif');
			d.add(610,6,' รายงานเปรียบเทียบประสิทธิภาพทางการเงินของ สกต.แยกตามฝ่ายกิจการสาขา ','http://spvsrv/mkcoop/Chart_Compare_region.html',' รายงานเปรียบเทียบประสิทธิภาพทางการเงินของ สกต.แยกตามฝ่ายกิจการสาขา ','_Blank','TreeImages/base-old.gif');
			d.add(611,6,' รายงานเปรียบเทียบประสิทธิทางการเงินของ สกต.แยกตามจังหวัด ','http://spvsrv/mkcoop/Chart_Compare.html',' รายงานเปรียบเทียบประสิทธิทางการเงินของ สกต.แยกตามจังหวัด ','_Blank','TreeImages/base-old.gif');

//------------------ ระบบการกระจายเป้า Tris ------------------------------//
		d.add(8,0,'ระบบเป้าหมายรวบรวมผลิตผล ',' ระบบกระจายเป้าหมายมูลค่าธุรกิจรวบรวมผลิตผล ');
	<?php if($user_type=='admin') { ?>
			d.add(801,8,' ระบบกระจายเป้าหมาย มุมมองฝ่ายกิจการสาขา','tris/target_tris.php','ระบบกระจายเป้าหมาย  มุมมองฝ่ายกิจการสาขา','','TreeImages/tag_blue.gif');
			d.add(802,8,' ระบบกระจายเป้าหมาย มุมมองผลผลิต','tris/target_tris_product.php','ระบบกระจายเป้าหมาย มุมมองผลผลิต','','TreeImages/tag_purple.gif');
			d.add(803,8,' ระบบกำหนดผลิตผลเป้าหมาย','tris/target_product.php','ระบบกำหนดผลิตผลเป้าหมาย','','TreeImages/tag_red.gif');
	<?php } ?> // endf if 
			d.add(804,8,' รายงานสรุปการกระจายเป้าหมาย','tris/report_tris.php','รายงานสรุปการกระจายเป้าหมาย','','TreeImages/base-old.gif');

// -------------------- กำหนดข้อมูล Admin ------------------//
<?php if($user_type=='admin') { ?>
		d.add(9,0,'ระบบกำหนดค่าพื้นฐาน admin ',' กำหนดค่าพื้นฐานระบบ admin');
			d.add(901,9,' กำหนดข้อความหน้าแรก','admin/config_message.php','กำหนดข้อความหน้าแรก','','TreeImages/note.gif');
			d.add(902,9,' กำหนดข้อมูลข่าวสาร','admin/config_news.php','กำหนดข้อมูลข่าวสาร','','TreeImages/note.gif');
			d.add(903,9,' กำหนดข้อมูลกลุ่มผลผลิต','admin/base_main_product.php','กำหนดข้อมูลกลุ่มผลผลิต','','TreeImages/css.gif');
			d.add(904,9,' กำหนดข้อมูลผลผลิตหลัก','admin/base_sub_product.php','กำหนดข้อมูลผลผลิตหลัก','','TreeImages/css.gif');
			d.add(905,9,' กำหนดข้อมูลรายละเอียดผลผลิต','admin/base_product.php','กำหนดข้อมูลรายละเอียดผลผลิต','','TreeImages/css.gif');
			d.add(906,9,' กำหนดข้อมูลประเภทรายงาน','admin/base_report_group.php','กำหนดข้อมูลประเภทรายงาน','','TreeImages/css.gif');
			d.add(907,9,' กำหนดข้อมูลรายละเอียดรายงาน','admin/base_report_sub.php','กำหนดข้อมูลรายละเอียดรายงาน','','TreeImages/css.gif');
			d.add(908,9,' รายงานข้อมูลรหัสผ่าน','admin/report_password.php',' รายงานข้อมูลรหัสผ่าน สกต. ','','TreeImages/base-old.gif');
			d.add(909,9,' กำหนดค่ารายงาน KPI','admin/base_kpi.php',' กำหนดค่ารายงาน KPI','','TreeImages/chart_bar_edit.gif');
<?php } ?>
//------------------ Download  ------------------------------//
		d.add(10,0,'Download',' ดาวน์โหลดเอกสารต่าง ๆ ');
			d.add(1001,10,' คู่มือการใช้งาน ','doc/Handbook.doc',' คู่มือการใช้งาน ','','TreeImages/download.gif');
			d.add(1002,10,' แบบฟอร์มประเมินผล สกต. ','',' แบบฟอร์ประเมินผล สกต.','','TreeImages/download.gif');
			d.add(1003,10,' คู่มือการบันทึกระบบพื้นฐาน','download/amc_manual.doc',' คู่มือการบันทึกระบบพืนฐาน.','','TreeImages/download.gif');
//------------------ link ภายใน baacnet  ------------------------------//
		d.add(11,0,'Link ภายในระบบธนาคาร','Link ภายในระบบธนาคาร');
			d.add(1101,11,' baacnet','http://baacnet/frame.php','หน้าแรกระบบ intranet ธนาคาร','_Blank','TreeImages/link.gif');
			d.add(1102,11,' คณะกรรมการและฝ่ายจัดการ','http://baacnet/bsmc/','คณะกรรมการและฝ่ายจัดการ','_Blank','TreeImages/link.gif');
			d.add(1103,11,' ฝ่ายพัฒนาลูกค้าและชนบท','http://baacnet/market/','ฝ่ายพัฒนาลูกค้าและชนบท','_Blank','TreeImages/link.gif');
			d.add(1104,11,' สำนักพัฒนาตลาดผลิตภัณฑ์ลูกค้า','http://baacnet/cusdev/','สำนักพัฒนาตลาดผลิตภัณฑ์ลูกค้า','_Blank','TreeImages/link.gif');
			d.add(1105,11,' ศูนย์วิจัย ธ.ก.ส.','http://ord/','ศูนย์วิจัย ธ.ก.ส.','_Blank','TreeImages/link.gif');
			d.add(1106,11,' สำนักประชาสัมพันธ์และสื่อสารองค์กร','http://baacnet/pr/','สำนักประชาสัมพันธ์และสื่อสารองค์กร','_Blank','TreeImages/link.gif');
//------------------ ข้อมูลทั่วไป สกต ------------------------------//
		d.add(12,0,'รายละเอียดข้อมูลทั่วไป ','รายละเอียดข้อมูลทั่วไป. ');
			d.add(1201,12,' ข้อมูลทั่วไป สกต.','general.html','ข้อมูลทั่วไป สกต.','','TreeImages/star.gif');
/*			d.add(1202,12,' รายชื่อผู้บริหารและพนักงาน ','manager.html','รายชื่อผู้บริหารและพนักงาน ฝ่ายพัฒนาลูกค้าและชนบท','','TreeImages/user_gray.gif');*/

//----------- ระบบพยากรณ์ข้อมูลผลการดำเนินงาน สกต  ANN ------//
<?php if($user_type=='thanawut') { ?>
		d.add(13,0,'ระบบพยากรณ์ผลการดำเนินงาน สกต.','',' ระบบพยากรณ์ผลการดำเนินงาน');
			d.add(1301,13,' ข้อมูลพื้นฐานปัจจัยพยากรณ์ ');
				d.add(13011,1301,' ข้อมูลพื้นฐานข้าว','ANN/base/production_list.php?code=1',' ข้อมูลพื้นฐานข้าว','','TreeImages/table.gif');
				d.add(13012,1301,' ข้อมูลพื้นฐานข้าวโพด','ANN/base/production_list.php?code=2',' ข้อมูลพื้นฐานข้าวโพด','','TreeImages/table.gif');
				d.add(13013,1301,' ข้อมูลพื้นฐานมันสำปะหลัง','ANN/base/production_list.php?code=3',' ข้อมูลพื้นฐานมันสำปะหลัง','','TreeImages/table.gif');
				d.add(13014,1301,' ข้อมูลพื้นฐานอ้อย','ANN/base/production_list.php?code=4',' ข้อมูลพื้นฐานอ้อย','','TreeImages/table.gif');
				d.add(13015,1301,' ข้อมูลพื้นฐานยางพารา','ANN/base/production_list.php?code=5',' ข้อมูลพื้นฐานยางพารา','','TreeImages/table.gif');
				d.add(13016,1301,' ข้อมูลพื้นฐาน สกต.','ANN/base/skt_list.php',' ข้อมูลพื้นฐาน สกต.','','TreeImages/table.gif');
				d.add(13017,1301,' ข้อมูลผลการดำเนินงาน สกต.','ANN/works/works_list.php',' ข้อมูลผลการดำเนินงาน สกต.','','TreeImages/table.gif');
			d.add(1303,13,' สร้างโมเดล โครงข่ายประสาทเทียม','ANN/ann/set_ann.php',' สร้างโมเดล โครงข่ายประสาทเทียม ','','TreeImages/chart_curve.gif');
			d.add(1304,13,' คำนวณ พยากรณ์ผลการดำเนินงาน','ANN/cal/set_cal.php',' คำนวณ พยากรณ์ผลการดำเนินงาน','','TreeImages/cog.gif');
			d.add(1305,13,' รายงานข้อมูล โครงข่ายประสาทเทียม','ANN/report/report_list.php',' รายงานข้อมูล โครงข่ายประสาทเทียม','','TreeImages/base-old.gif');
			d.add(1306,13,'  คู่มือการใช้งาน','ANN/handbook/',' คู่มือการใช้งาน','','TreeImages/download.gif');
<?php } ?>

//------------- เปลี่ยนรหัสผ่าน ---------------//
//<?php if($status_online=='Y') { ?>
//	d.add(99,0,' เปลี่ยนรหัสผ่าน','chang_password.php',' เปลี่ยนรหัสผ่าน','','TreeImages/help3.gif');
//<?php }  ?> // endf if 
	document.write(d);
//-->
</script>
<p><a href="javascript: d.openAll();"> แสดงทั้งหมด </a> | <a href="javascript: d.closeAll();"> ซ่อน </a></p>
</div>
</body>
</html>