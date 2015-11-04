<? include ("checkuser.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head>
</style>


<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">

<script language="JavaScript"  type="text/javascript" src="images/lib/calendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/loadcalendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar-th.js"></script>
<body OnLoad="bodyOnLoad()">
<form name="form1" method="post" action="">
  <?
							include ("images/lib/ms_database.php");
							$sql2="SELECT CAT_CC,CAT_AA,CAT_DESC ";
							$sql2.=" FROM DBTP.DBO.CCAATTIS A ";
							$sql2.=" WHERE A.CAT_CC='$province' AND CAT_AA <> '00'AND CAT_TT='00'AND CAT_MM='00' AND CAT_DESC not like '%*%' ";
							$sql2.=" ORDER BY CAT_AA ";
							$exsql2=mssql_query($sql2);
							//echo $sql2; */
							echo '<select name="branch'.$i.'">';
							$rowall=mssql_fetch_array($exsql2);
							echo $rowall[1].$rowall[2];
							
							while($rowall2=mssql_fetch_array($exsql2))
								{
									echo '<option value="'.$rowall2[1].'">'.$rowall2[2].'</option>';
								}
							echo '</select>';
						//	echo $rowall[8];
							
						?>
  <span class=head2>ระบุ สนจ. :&nbsp;</span>&nbsp; 
  <input type="radio" name="rdo1" value="1" checked OnClick="document.form1.lstBrn.disabled=false;">
  <select name="lstBrn">
    <option value="76A">สนจ.กระบี่ (76A) 
    <option value="58A">สนจ.กรุงเทพมหานคร (58A) 
    <option value="44A">สนจ.กาญจนบุรี (44A) 
    <option value="32A">สนจ.กาฬสินธุ์ (32A) 
    <option value="36A">สนจ.กำแพงเพชร (36A) 
    <option value="06A">สนจ.ขอนแก่น (06A) 
    <option value="42A">สนจ.จันทบุรี (42A) 
    <option value="25A">สนจ.ฉะเชิงเทรา (25A) 
    <option value="53A">สนจ.ชลบุรี (53A) 
    <option value="17A">สนจ.ชัยนาท (17A) 
    <option value="12A">สนจ.ชัยภูมิ (12A) 
    <option value="19A">สนจ.ชุมพร (19A) 
    <option value="01A">สนจ.เชียงราย (01A) 
    <option value="23A">สนจ.เชียงใหม่ (23A) 
    <option value="57A">สนจ.ตรัง (57A) 
    <option value="79A">สนจ.ตราด (79A) 
    <option value="81A">สนจ.ตาก (81A) 
    <option value="41A">สนจ.นครนายก (41A) 
    <option value="24A">สนจ.นครปฐม (24A) 
    <option value="38A">สนจ.นครพนม (38A) 
    <option value="21A">สนจ.นครราชสีมา (21A) 
    <option value="15A">สนจ.นครศรีธรรมราช (15A) 
    <option value="18A">สนจ.นครสวรรค์ (18A) 
    <option value="20A">สนจ.นนทบุรี (20A) 
    <option value="55A">สนจ.นราธิวาส (55A) 
    <option value="56A">สนจ.น่าน (56A) 
    <option value="40A">สนจ.บุรีรัมย์ (40A) 
    <option value="67A">สนจ.ปทุมธานี (67A) 
    <option value="35A">สนจ.ประจวบคีรีขันธ์ (35A) 
    <option value="10A">สนจ.ปราจีนบุรี (10A) 
    <option value="11A">สนจ.ปัตตานี (11A) 
    <option value="03A">สนจ.พระนครศรีอยุธยา (03A) 
    <option value="72A">สนจ.พะเยา (72A) 
    <option value="60A">สนจ.พังงา (60A) 
    <option value="45A">สนจ.พัทลุง (45A) 
    <option value="28A">สนจ.พิจิตร (28A) 
    <option value="27A">สนจ.พิษณุโลก (27A) 
    <option value="04A">สนจ.เพชรบุรี (04A) 
    <option value="02A">สนจ.เพชรบูรณ์ (02A) 
    <option value="08A">สนจ.แพร่ (08A) 
    <option value="84A">สนจ.ภูเก็ต (84A) 
    <option value="46A">สนจ.มหาสารคาม (46A) 
    <option value="73A">สนจ.มุกดาหาร (73A) 
    <option value="82A">สนจ.แม่ฮ่องสอน (82A) 
    <option value="51A">สนจ.ยโสธร (51A) 
    <option value="61A">สนจ.ยะลา (61A) 
    <option value="22A">สนจ.ร้อยเอ็ด (22A) 
    <option value="83A">สนจ.ระนอง (83A) 
    <option value="13A">สนจ.ระยอง (13A) 
    <option value="43A">สนจ.ราชบุรี (43A) 
    <option value="16A">สนจ.ลพบุรี (16A) 
    <option value="29A">สนจ.ลำปาง (29A) 
    <option value="47A">สนจ.ลำพูน (47A) 
    <option value="33A">สนจ.เลย (33A) 
    <option value="39A">สนจ.ศรีสะเกษ (39A) 
    <option value="37A">สนจ.สกลนคร (37A) 
    <option value="34A">สนจ.สงขลา (34A) 
    <option value="75A">สนจ.สตูล (75A) 
    <option value="80A">สนจ.สมุทรปราการ (80A) 
    <option value="54A">สนจ.สมุทรสาคร (54A) 
    <option value="78A">สนจ.สระแก้ว (78A) 
    <option value="07A">สนจ.สระบุรี (07A) 
    <option value="69A">สนจ.สิงห์บุรี (69A) 
    <option value="09A">สนจ.สุโขทัย (09A) 
    <option value="14A">สนจ.สุพรรณบุรี (14A) 
    <option value="31A">สนจ.สุราษฎร์ธานี (31A) 
    <option value="26A">สนจ.สุรินทร์ (26A) 
    <option value="52A">สนจ.หนองคาย (52A) 
    <option value="71A">สนจ.หนองบัวลำภู (71A) 
    <option value="30A">สนจ.อ่างทอง (30A) 
    <option value="77A">สนจ.อำนาจเจริญ (77A) 
    <option value="05A">สนจ.อุดรธานี (05A) 
    <option value="48A">สนจ.อุตรดิตถ์ (48A) 
    <option value="49A">สนจ.อุทัยธานี (49A) 
    <option value="50A">สนจ.อุบลราชธานี (50A) 
  </select>
  <input type="radio" name="rdo1" value="2" OnClick="document.form1.lstBrn.disabled=true;">
</form>
</body>
</html>
