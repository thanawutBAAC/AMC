<?php session_start(); 
   include("lib/config.inc.php");
   include("check_login.php");
?>
<html>
<head>
	<title> ����������èѴ��� ʡ�. </title>
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
		
// ----------------- ����������èѴ��� ʡ�. ------------------//
	d.add(0,-1,'<B> ����������� ʡ�. </B>','','����������èѴ��� ʡ�.');
		d.add(1,0,'�к������ž�鹰ҹ','','Introduction & Installation','','','',true);
	<?php if($user_type=='skt') { ?>
			d.add(101,1,' �����ŷ����','general/amc_general_edit.php','�ѹ�֡�����ŷ����','','TreeImages/house.gif');
			d.add(102,1,' �����Ť�С������','general/committee.php','�ѹ�֡�����Ť�С������','','TreeImages/user_suit.gif');
			d.add(103,1,' ���������˹�ҷ��','general/personnel.php','�ѹ�֡���������˹�ҷ��','','TreeImages/profile.gif');
			d.add(104,1,' ����ѵԡ�ý֡ͺ����С������','general/testing.php?type=committee','����ѵԡ�ý֡ͺ����С������','','TreeImages/vcard_edit.png');
			d.add(105,1,' ����ѵԡ�ý֡ͺ�����˹�ҷ��','general/testing.php?type=personnel','����ѵԡ�ý֡ͺ�����˹�ҷ��','','TreeImages/vcard_edit.png');
			d.add(106,1,' �����ŷ�Ѿ���Թ','general/asset.php','�ѹ�֡�����ŷ�Ѿ���Թ','','TreeImages/lorry.gif');
			d.add(107,1,' ���������͢�����Ҫԡ','general/networkmember.php?SendYear=<?php echo $year; ?>','�ѹ�֡���������͢�����Ҫԡ','','TreeImages/group.gif');
		//	d.add(108,1,' ���������͢����Ң�','general/networkbranch.php','�ѹ�֡���������͢����Ң�','','TreeImages/building_link.gif');		


//------------------  ��§ҹ���͡�ú�����  ------------------------//
			d.add(110,1,'','',' ��§ҹ���͡�ú�����','','TreeImages/line2.gif');
	<?php } ?> // end if 
			d.add(111,1,' ��§ҹ��ҹ����� ','general/rpt_location.php',' ��§ҹ��ҹ����� ','','TreeImages/base-old.gif');
			d.add(112,1,' ��§ҹ��ҹ�ؤ��ҡ�  ','general/rpt_personnel.php',' ��§ҹ��ҹ�ؤ��ҡ� ','','TreeImages/base-old.gif');
			d.add(113,1,' ��§ҹ��ҹ��ý֡ͺ���ؤ��ҡ�  ','general/rpt_testing.php?type=search',' ��§ҹ��ҹ��ý֡ͺ���ؤ��ҡ� ','','TreeImages/base-old.gif');
			d.add(114,1,' ��§ҹ��ҹ���������͢�����Ҫԡ ','general/rpt_networkmember.php',' ��§ҹ��ҹ���������͢�����Ҫԡ ','','TreeImages/base-old.gif');
			d.add(115,1,' ��§ҹ��ҹ��Ѿ���Թ ','general/rpt_asset.php',' ��§ҹ��ҹ��Ѿ���Թ ','','TreeImages/base-old.gif');

// --------------- �к������Թ������� ʡ�. ʡ�.4  -------------------- //
		d.add(2,0,'�к���§ҹἹ ʡ.��.4 ��Шӻբͧ ʡ�. ','');
	<?php if($user_type=='skt') { ?>
			d.add(201,2,' ��ػ Ἱ��ô��Թ�ҹ��Шӻ�','skk4/PlanMaster.php','��ػ Ἱ��ô��Թ�ҹ��Шӻ�','','TreeImages/script.gif');
			d.add(202,2,' Ἱ��Ҫԡ ��������ع���͹���','skk4/PlanMember.php','Ἱ��Ҫԡ ��������ع���͹��� (�͡��������Ţ 3 )','','TreeImages/page_brown.gif');
			d.add(203,2,' Ἱ�Ѵ���Թ����Ҩ�˹��� �ʹ����','skk4/PlanProcureBuy.php','Ἱ�Ѵ���Թ����Ҩ�˹��� �ʹ���� (�͡��������Ţ 4 )','','TreeImages/page_red.gif');
			d.add(204,2,' Ἱ�Ѵ���Թ����Ҩ�˹��� �ʹ���','skk4/PlanProcureSell.php','Ἱ�Ѵ���Թ����Ҩ�˹��� �ʹ��� (�͡��������Ţ 5 )','','TreeImages/page_red.gif');
			d.add(205,2,' Ἱ����Ǻ�����Ե�š���ɵ� �ʹ����','skk4/PlanCollectBuy.php','Ἱ����Ǻ�����Ե�š���ɵ� �ʹ���� (�͡��������Ţ 6 )','','TreeImages/page_green.gif');
			d.add(206,2,' Ἱ����Ǻ����ż�Ե����ɵ� �ʹ���','skk4/PlanCollectSell.php','Ἱ����Ǻ����ż�Ե����ɵ� �ʹ��� (�͡��������Ţ 7 )','','TreeImages/page_green.gif');
			d.add(209,2,' Ἱ������ٻ�ż�Ե����ɵ� �ʹ����','skk4/PlanTransBuy.php','Ἱ������ٻ�ż�Ե����ɵ� �ʹ���� ','','TreeImages/page_blue.gif');
			d.add(210,2,' Ἱ������ٻ�ż�Ե����ɵ� �ʹ���','skk4/PlanTransSell.php','Ἱ������ٻ�ż�Ե����ɵ� �ʹ��� ','','TreeImages/page_blue.gif');
			d.add(207,2,' Ἱ�������ԡ����������������ɵ�','skk4/PlanService.php','Ἱ�������ԡ����������������ɵ� (�͡��������Ţ 8 )','','TreeImages/page_yellow.gif');
			d.add(208,2,' Ἱ��è��¤�������','skk4/PlanExpenses.php','Ἱ��è��¤������� (�͡��������Ţ 9 )','','TreeImages/page_yellow.gif');
//------------------  ��§ҹ  -------------------------//
			d.add(200,2,'','',' ��§ҹἹ ʡ.��.4 ��Шӻբͧ ʡ�.','','TreeImages/line2.gif');
	<?php } ?> // end if 
			d.add(209,2,' ��¡���觢�����Ἱ ʡ.��.4','skk4/check_report.php','��§ҹ����觢�����Ἱ ʡ�.4','','TreeImages/base-old.gif');
			d.add(210,2,' ��§ҹ��������´Ἱ ʡ.��.4 ','skk4/rpt_01.php','��§ҹ����觢�����Ἱ ʡ�.4','','TreeImages/base-old.gif');
			d.add(211,2,' ��§ҹ�Ҿ���Ἱ ʡ.��.4 ','skk4/rpt_02.php','��§ҹ�Ҿ���Ἱ ʡ�.4','','TreeImages/base-old.gif');

// ---------------- �к�����§ҹ��Ш���͹ -----------------//
		d.add(3,0,'�к�����§ҹ��Ш���͹');
		<?php if($user_type=='skt') { ?>
			d.add(301,3,' ����§ҹ��Ш���͹','sent report/sent_report.php',' ����§ҹ��Ш���͹ ','','TreeImages/overlays.gif');
			d.add(302,3,' ��˹���Ǣ����§ҹ','sent report/config_report.php',' ��˹���Ǣ����§ҹ ','','TreeImages/cog_edit.gif');	
		<?php } ?> // end if 
		<?php if($user_type=='admin') { ?>
			d.add(303,3,' ��ͧ�ѹ�����§ҹ ','sent report/lock_report.php',' ��ͧ�ѹ�����§ҹ ','','TreeImages/lock.gif');	
		<?php } ?> // end if 
			d.add(304,3,' ��§ҹ��ػ����§ҹ��Ш���͹ ','sent report/check_report.php',' ��§ҹ��ػ����§ҹ��Ш���͹ ','','TreeImages/base-old.gif');	
// ---------------- �к���§ҹ ʡ�  Ẻ��� -----------------//
//		d.add(4,0,'��§ҹ�š�ô��Թ�ҹ ʡ�. Ẻ���');
//			d.add(401,4,' ��§ҹ�š�ô��Թ�ҹ�ͧ ʡ�.��Ш���͹','report/rpt_01.php','��§ҹ�š�ô��Թ�ҹ�ͧ ʡ�.��Ш���͹','','TreeImages/base-old.gif');
//			d.add(402,4,' �����ŷ���� �.�����͹��§ҹ','report/rpt_02.php','�����ŷ���� �.�����͹��§ҹ','','TreeImages/base-old.gif');	
//			d.add(403,4,' ��Ť�Ҹ�áԨ�Ѵ���Թ����Ҩ�˹���','report/rpt_03.php','��Ť�Ҹ�áԨ�Ѵ���Թ����Ҩ�˹���','','TreeImages/base-old.gif');
//			d.add(404,4,' ��Ť�Ҹ�áԨ�Ǻ����ż�Ե (����ͧ��Ե��)','report/rpt_04.php','��Ť�Ҹ�áԨ�Ǻ����ż�Ե (����ͧ��Ե��)','','TreeImages/base-old.gif');
//			d.add(405,4,' ��Ť�Ҹ�áԨ�Ǻ����ż�Ե (����ͧ �ʢ.,�ѧ��Ѵ) ˹���:�ѹ�ҷ','report/rpt_05.php','��Ť�Ҹ�áԨ�Ǻ����ż�Ե (����ͧ �ʢ.,�ѧ��Ѵ) ˹���:�ѹ�ҷ','','TreeImages/base-old.gif');	
//			d.add(406,4,' ��Ť�Ҹ�áԨ�Ǻ����ż�Ե (����ͧ �ʢ.,�ѧ��Ѵ) ˹���:�ѹ','report/rpt_06.php','��Ť�Ҹ�áԨ�Ǻ����ż�Ե (����ͧ �ʢ.,�ѧ��Ѵ) ˹���:�ѹ','','TreeImages/base-old.gif');	
//			d.add(407,4,' ��Ť�Ҹ�áԨ�Ǻ����ż�Ե ��áԨ�Ǻ���+��˹��� ��Ǫ���Ѵ�ͧ (����ͧ��Ե��)','report/rpt_07.php','��Ť�Ҹ�áԨ�Ǻ����ż�Ե ��áԨ�Ǻ���+��˹��� ��Ǫ���Ѵ�ͧ (����ͧ��Ե��)','','TreeImages/base-old.gif');	
//		d.add(408,4,' ��Ť�Ҹ�áԨ�Ǻ����ż�Ե ��áԨ�Ǻ��� ��Ǫ���Ѵ�ͧ  (����ͧ��Ե��)','report/rpt_08.php','��Ť�Ҹ�áԨ�Ǻ����ż�Ե ��áԨ�Ǻ��� ��Ǫ���Ѵ�ͧ  (����ͧ��Ե��)','','TreeImages/base-old.gif');	
//			d.add(409,4,' ��Ť�Ҹ�áԨ�Ǻ����ż�Ե ��áԨ��˹��� ��Ǫ���Ѵ�ͧ  (����ͧ��Ե��)','report/rpt_09.php','��Ť�Ҹ�áԨ�Ǻ����ż�Ե ��áԨ��˹��� ��Ǫ���Ѵ�ͧ  (����ͧ��Ե��)','','TreeImages/base-old.gif');	
//		d.add(410,4,' ��Ť�Ҹ�áԨ�Ǻ����ż�Ե ��áԨ�Ǻ��� ��Ǫ���Ѵ�ͧ (����ͧ�ʢ.,�ѧ��Ѵ)','report/rpt_10.php','��Ť�Ҹ�áԨ�Ǻ����ż�Ե ��áԨ�Ǻ��� ��Ǫ���Ѵ�ͧ  (����ͧ�ʢ.,�ѧ��Ѵ)','','TreeImages/base-old.gif');	
//			d.add(411,4,' ��Ť�Ҹ�áԨ�Ǻ����ż�Ե ��áԨ��˹��� ��Ǫ���Ѵ�ͧ  (����ͧ�ʢ.,�ѧ��Ѵ) ','report/rpt_11.php','��Ť�Ҹ�áԨ�Ǻ����ż�Ե ��áԨ��˹��� ��Ǫ���Ѵ�ͧ  (����ͧ�ʢ.,�ѧ��Ѵ) ','','TreeImages/base-old.gif');	
//			d.add(412,4,' ��Ť�Ҹ�áԨ����ԡ����������������ɵ�  ','report/rpt_12.php','��Ť�Ҹ�áԨ����ԡ����������������ɵ�  ','','TreeImages/base-old.gif');	
//			d.add(413,4,' ��§ҹ�����Թ��� ','report/rpt_13.php',' �����Թ��� ','','TreeImages/base-old.gif');	
//			d.add(414,4,' �ӹǹ��Ҫԡ���Ӹ�áԨ�Ѻʡ�. ','report/rpt_14.php','�ӹǹ��Ҫԡ���Ӹ�áԨ�Ѻʡ�.','','TreeImages/base-old.gif');	

//			d.add(415,4,' ��§ҹ����Ǻ����ż�Ե 5 �ת��ѡ','report/rpt_99.php','��§ҹ����Ǻ����ż�Ե 5 �ת��ѡ','','TreeImages/base-old.gif');

// -------------- ��������§ҹ�š�ô��Թ�ҹ ʡ�. ��Ѻ��ا���� ------------------//
		d.add(5,0,'��§ҹ�š�ô��Թ�ҹ ʡ�.');
			d.add(501,5,' ��§ҹ�š�ô��Թ�ҹ�ͧ ʡ�.��Ш���͹','report/rpt_01.php','��§ҹ�š�ô��Թ�ҹ�ͧ ʡ�.��Ш���͹','','TreeImages/base-old.gif');
			d.add(502,5,' �����ŷ���� �.�����͹��§ҹ','report/rpt_02.php','�����ŷ���� �.�����͹��§ҹ','','TreeImages/base-old.gif');	
			d.add(503,5,' ��§ҹ�š�ô��Թ��áԨ�Ѵ���Թ����Ҩ�˹���','report/rpt_03.php','��Ť�Ҹ�áԨ�Ѵ���Թ����Ҩ�˹���','','TreeImages/base-old.gif');
			d.add(504,5,' ��§ҹ�š���Ǻ�����Ե��');
				d.add(5041,504,' ��§ҹ�Ǻ�����Ե�ŷ�����','report/rpt_15.php','��§ҹ�Ǻ�����Ե�ŷ�����','','TreeImages/base-old.gif');
				d.add(5042,504,' ��§ҹ�Ǻ�����Ե����Դ����������','report/rpt_16.php','��§ҹ�Ǻ�����Ե����Դ����������','','TreeImages/base-old.gif');
				d.add(5043,504,'  ��§ҹ����Ǻ����ż�Ե��ѡ','report/rpt_99.php','��§ҹ����Ǻ����ż�Ե��ѡ','','TreeImages/base-old.gif');
			d.add(509,5,' ��§ҹ�š�ô��Թ��áԨ���ٻ�ż�Ե','report/rpt_18.php',' ��§ҹ�š�ô��Թ��áԨ���ٻ�ż�Ե','','TreeImages/base-old.gif');
			d.add(505,5,' ��§ҹ�š�ô��Թ��áԨ��ԡ��','report/rpt_12.php',' ��§ҹ�š�ô��Թ��áԨ��ԡ��','','TreeImages/base-old.gif');
			d.add(506,5,' ��§ҹ�����Թ��� ','report/rpt_13.php',' �����Թ��� ','','TreeImages/base-old.gif');	
			d.add(507,5,' �ӹǹ��Ҫԡ���Ӹ�áԨ�Ѻʡ�. ','report/rpt_14.php','�ӹǹ��Ҫԡ���Ӹ�áԨ�Ѻʡ�.','','TreeImages/base-old.gif');	
			d.add(508,5,' �š�ô��Թ�ҹ���Ἱ��áԨ�ͧ ʡ�. ','report/rpt_17.php','�š�ô��Թ�ҹ���Ἱ��áԨ�ͧ ʡ�. .','','TreeImages/base-old.gif');	

//-----------------  ��§ҹ������Թ ---------------------
		d.add(6,0,'��§ҹ������Թ (���������ҧ��þѲ��) ');
			d.add(612,6,' �觢����ŧ�����Թ (�� user ��� password ���)','http://snowdrop/branch/index.php',' �觢����ŧ�����Թ (�� user ��� password ���) ','_Blank','TreeImages/application_get.png');
			d.add(601,6,' ���鹷ع���/��ԡ��','http://spvsrv/mkcoop/rpt_serv_bal.asp',' ���鹷ع��� / ��ԡ�� ','_Blank','TreeImages/coins.gif');
			d.add(602,6,' �����','http://spvsrv/mkcoop/rpt_bal.asp',' ����� ','_Blank','TreeImages/coins.gif');
			d.add(603,6,' �����âҴ�ع','http://spvsrv/mkcoop/rpt_pro_loss_bal.asp',' �����âҴ�ع ','_Blank','TreeImages/coins.gif');		
			d.add(604,6,' �����ͧ','http://spvsrv/mkcoop/rpt_tril_bal.asp',' �����ͧ ','_Blank','TreeImages/coins.gif');
			d.add(605,6,' ��������´����(�Ҵ�ع) ੾�и�áԨ�Ѵ���Թ����Ҩ�˹��� ','http://spvsrv/mkcoop/rpt_pro_loss_good.asp',' ��������´����(�Ҵ�ع) ੾�и�áԨ�Ѵ���Թ����Ҩ�˹��� ','_Blank','TreeImages/coins.gif');
			d.add(606,6,' ��������´����(�Ҵ�ع) ੾�и�áԨ�Ǻ�����Ե�� ','http://spvsrv/mkcoop/rpt_pro_loss_product.asp',' ��������´����(�Ҵ�ع)  ੾�и�áԨ�Ǻ�����Ե�� ','_Blank','TreeImages/coins.gif');
			d.add(607,6,' ��������´ �������� ','http://spvsrv/mkcoop/rpt_oth_income.asp',' ��������´ �������� ','_Blank','TreeImages/base-old.gif');
			d.add(608,6,' ��������´ �������´��Թ�ҹ ','http://spvsrv/mkcoop/rpt_operation_exp.asp',' ��������´ �������´��Թ��� ','_Blank','TreeImages/base-old.gif');
			d.add(609,6,' ��§ҹ�����������Է���Ҿ��ú����çҹ ','http://spvsrv/mkcoop/rpt_ratio.asp',' ��§ҹ�����������Է���Ҿ��ú����çҹ ','_Blank','TreeImages/base-old.gif');
			d.add(610,6,' ��§ҹ���º��º����Է���Ҿ�ҧ����Թ�ͧ ʡ�.�¡������¡Ԩ����Ң� ','http://spvsrv/mkcoop/Chart_Compare_region.html',' ��§ҹ���º��º����Է���Ҿ�ҧ����Թ�ͧ ʡ�.�¡������¡Ԩ����Ң� ','_Blank','TreeImages/base-old.gif');
			d.add(611,6,' ��§ҹ���º��º����Է�Էҧ����Թ�ͧ ʡ�.�¡����ѧ��Ѵ ','http://spvsrv/mkcoop/Chart_Compare.html',' ��§ҹ���º��º����Է�Էҧ����Թ�ͧ ʡ�.�¡����ѧ��Ѵ ','_Blank','TreeImages/base-old.gif');

//------------------ �к���á�Ш����� Tris ------------------------------//
		d.add(8,0,'�к���������Ǻ�����Ե�� ',' �к���Ш�����������Ť�Ҹ�áԨ�Ǻ�����Ե�� ');
	<?php if($user_type=='admin') { ?>
			d.add(801,8,' �к���Ш��������� ����ͧ���¡Ԩ����Ң�','tris/target_tris.php','�к���Ш���������  ����ͧ���¡Ԩ����Ң�','','TreeImages/tag_blue.gif');
			d.add(802,8,' �к���Ш��������� ����ͧ�ż�Ե','tris/target_tris_product.php','�к���Ш��������� ����ͧ�ż�Ե','','TreeImages/tag_purple.gif');
			d.add(803,8,' �к���˹���Ե���������','tris/target_product.php','�к���˹���Ե���������','','TreeImages/tag_red.gif');
	<?php } ?> // endf if 
			d.add(804,8,' ��§ҹ��ػ��á�Ш���������','tris/report_tris.php','��§ҹ��ػ��á�Ш���������','','TreeImages/base-old.gif');

// -------------------- ��˹������� Admin ------------------//
<?php if($user_type=='admin') { ?>
		d.add(9,0,'�к���˹���Ҿ�鹰ҹ admin ',' ��˹���Ҿ�鹰ҹ�к� admin');
			d.add(901,9,' ��˹���ͤ���˹���á','admin/config_message.php','��˹���ͤ���˹���á','','TreeImages/note.gif');
			d.add(902,9,' ��˹������Ţ������','admin/config_news.php','��˹������Ţ������','','TreeImages/note.gif');
			d.add(903,9,' ��˹������š�����ż�Ե','admin/base_main_product.php','��˹������š�����ż�Ե','','TreeImages/css.gif');
			d.add(904,9,' ��˹������żż�Ե��ѡ','admin/base_sub_product.php','��˹������żż�Ե��ѡ','','TreeImages/css.gif');
			d.add(905,9,' ��˹���������������´�ż�Ե','admin/base_product.php','��˹���������������´�ż�Ե','','TreeImages/css.gif');
			d.add(906,9,' ��˹������Ż�������§ҹ','admin/base_report_group.php','��˹������Ż�������§ҹ','','TreeImages/css.gif');
			d.add(907,9,' ��˹���������������´��§ҹ','admin/base_report_sub.php','��˹���������������´��§ҹ','','TreeImages/css.gif');
			d.add(908,9,' ��§ҹ���������ʼ�ҹ','admin/report_password.php',' ��§ҹ���������ʼ�ҹ ʡ�. ','','TreeImages/base-old.gif');
			d.add(909,9,' ��˹������§ҹ KPI','admin/base_kpi.php',' ��˹������§ҹ KPI','','TreeImages/chart_bar_edit.gif');
<?php } ?>
//------------------ Download  ------------------------------//
		d.add(10,0,'Download',' ��ǹ���Ŵ�͡��õ�ҧ � ');
			d.add(1001,10,' �����͡����ҹ ','doc/Handbook.doc',' �����͡����ҹ ','','TreeImages/download.gif');
			d.add(1002,10,' Ẻ����������Թ�� ʡ�. ','',' Ẻ��������Թ�� ʡ�.','','TreeImages/download.gif');
			d.add(1003,10,' �����͡�úѹ�֡�к���鹰ҹ','download/amc_manual.doc',' �����͡�úѹ�֡�к��׹�ҹ.','','TreeImages/download.gif');
//------------------ link ���� baacnet  ------------------------------//
		d.add(11,0,'Link �����к���Ҥ��','Link �����к���Ҥ��');
			d.add(1101,11,' baacnet','http://baacnet/frame.php','˹���á�к� intranet ��Ҥ��','_Blank','TreeImages/link.gif');
			d.add(1102,11,' ��С��������н��¨Ѵ���','http://baacnet/bsmc/','��С��������н��¨Ѵ���','_Blank','TreeImages/link.gif');
			d.add(1103,11,' ���¾Ѳ���١�����Ъ���','http://baacnet/market/','���¾Ѳ���١�����Ъ���','_Blank','TreeImages/link.gif');
			d.add(1104,11,' �ӹѡ�Ѳ�ҵ�Ҵ��Ե�ѳ���١���','http://baacnet/cusdev/','�ӹѡ�Ѳ�ҵ�Ҵ��Ե�ѳ���١���','_Blank','TreeImages/link.gif');
			d.add(1105,11,' �ٹ���Ԩ�� �.�.�.','http://ord/','�ٹ���Ԩ�� �.�.�.','_Blank','TreeImages/link.gif');
			d.add(1106,11,' �ӹѡ��Ъ�����ѹ������������ͧ���','http://baacnet/pr/','�ӹѡ��Ъ�����ѹ������������ͧ���','_Blank','TreeImages/link.gif');
//------------------ �����ŷ���� ʡ� ------------------------------//
		d.add(12,0,'��������´�����ŷ���� ','��������´�����ŷ����. ');
			d.add(1201,12,' �����ŷ���� ʡ�.','general.html','�����ŷ���� ʡ�.','','TreeImages/star.gif');
/*			d.add(1202,12,' ��ª��ͼ���������о�ѡ�ҹ ','manager.html','��ª��ͼ���������о�ѡ�ҹ ���¾Ѳ���١�����Ъ���','','TreeImages/user_gray.gif');*/

//----------- �к���ҡó�����żš�ô��Թ�ҹ ʡ�  ANN ------//
<?php if($user_type=='thanawut') { ?>
		d.add(13,0,'�к���ҡó�š�ô��Թ�ҹ ʡ�.','',' �к���ҡó�š�ô��Թ�ҹ');
			d.add(1301,13,' �����ž�鹰ҹ�Ѩ��¾�ҡó� ');
				d.add(13011,1301,' �����ž�鹰ҹ����','ANN/base/production_list.php?code=1',' �����ž�鹰ҹ����','','TreeImages/table.gif');
				d.add(13012,1301,' �����ž�鹰ҹ����⾴','ANN/base/production_list.php?code=2',' �����ž�鹰ҹ����⾴','','TreeImages/table.gif');
				d.add(13013,1301,' �����ž�鹰ҹ�ѹ�ӻ���ѧ','ANN/base/production_list.php?code=3',' �����ž�鹰ҹ�ѹ�ӻ���ѧ','','TreeImages/table.gif');
				d.add(13014,1301,' �����ž�鹰ҹ����','ANN/base/production_list.php?code=4',' �����ž�鹰ҹ����','','TreeImages/table.gif');
				d.add(13015,1301,' �����ž�鹰ҹ�ҧ����','ANN/base/production_list.php?code=5',' �����ž�鹰ҹ�ҧ����','','TreeImages/table.gif');
				d.add(13016,1301,' �����ž�鹰ҹ ʡ�.','ANN/base/skt_list.php',' �����ž�鹰ҹ ʡ�.','','TreeImages/table.gif');
				d.add(13017,1301,' �����żš�ô��Թ�ҹ ʡ�.','ANN/works/works_list.php',' �����żš�ô��Թ�ҹ ʡ�.','','TreeImages/table.gif');
			d.add(1303,13,' ���ҧ���� �ç���»���ҷ����','ANN/ann/set_ann.php',' ���ҧ���� �ç���»���ҷ���� ','','TreeImages/chart_curve.gif');
			d.add(1304,13,' �ӹǳ ��ҡó�š�ô��Թ�ҹ','ANN/cal/set_cal.php',' �ӹǳ ��ҡó�š�ô��Թ�ҹ','','TreeImages/cog.gif');
			d.add(1305,13,' ��§ҹ������ �ç���»���ҷ����','ANN/report/report_list.php',' ��§ҹ������ �ç���»���ҷ����','','TreeImages/base-old.gif');
			d.add(1306,13,'  �����͡����ҹ','ANN/handbook/',' �����͡����ҹ','','TreeImages/download.gif');
<?php } ?>

//------------- ����¹���ʼ�ҹ ---------------//
//<?php if($status_online=='Y') { ?>
//	d.add(99,0,' ����¹���ʼ�ҹ','chang_password.php',' ����¹���ʼ�ҹ','','TreeImages/help3.gif');
//<?php }  ?> // endf if 
	document.write(d);
//-->
</script>
<p><a href="javascript: d.openAll();"> �ʴ������� </a> | <a href="javascript: d.closeAll();"> ��͹ </a></p>
</div>
</body>
</html>