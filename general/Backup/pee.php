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
  <span class=head2>�к� ʹ�. :&nbsp;</span>&nbsp; 
  <input type="radio" name="rdo1" value="1" checked OnClick="document.form1.lstBrn.disabled=false;">
  <select name="lstBrn">
    <option value="76A">ʹ�.��к�� (76A) 
    <option value="58A">ʹ�.��ا෾��ҹ�� (58A) 
    <option value="44A">ʹ�.�ҭ������ (44A) 
    <option value="32A">ʹ�.����Թ��� (32A) 
    <option value="36A">ʹ�.��ᾧྪ� (36A) 
    <option value="06A">ʹ�.�͹�� (06A) 
    <option value="42A">ʹ�.�ѹ����� (42A) 
    <option value="25A">ʹ�.���ԧ��� (25A) 
    <option value="53A">ʹ�.�ź��� (53A) 
    <option value="17A">ʹ�.��¹ҷ (17A) 
    <option value="12A">ʹ�.������� (12A) 
    <option value="19A">ʹ�.����� (19A) 
    <option value="01A">ʹ�.��§��� (01A) 
    <option value="23A">ʹ�.��§���� (23A) 
    <option value="57A">ʹ�.��ѧ (57A) 
    <option value="79A">ʹ�.��Ҵ (79A) 
    <option value="81A">ʹ�.�ҡ (81A) 
    <option value="41A">ʹ�.��ù�¡ (41A) 
    <option value="24A">ʹ�.��û�� (24A) 
    <option value="38A">ʹ�.��þ�� (38A) 
    <option value="21A">ʹ�.����Ҫ���� (21A) 
    <option value="15A">ʹ�.�����ո����Ҫ (15A) 
    <option value="18A">ʹ�.������ä� (18A) 
    <option value="20A">ʹ�.������� (20A) 
    <option value="55A">ʹ�.��Ҹ���� (55A) 
    <option value="56A">ʹ�.��ҹ (56A) 
    <option value="40A">ʹ�.��������� (40A) 
    <option value="67A">ʹ�.�����ҹ� (67A) 
    <option value="35A">ʹ�.��ШǺ���բѹ�� (35A) 
    <option value="10A">ʹ�.��Ҩչ���� (10A) 
    <option value="11A">ʹ�.�ѵ�ҹ� (11A) 
    <option value="03A">ʹ�.��й�������ظ�� (03A) 
    <option value="72A">ʹ�.����� (72A) 
    <option value="60A">ʹ�.�ѧ�� (60A) 
    <option value="45A">ʹ�.�ѷ�ا (45A) 
    <option value="28A">ʹ�.�ԨԵ� (28A) 
    <option value="27A">ʹ�.��ɳ��š (27A) 
    <option value="04A">ʹ�.ྪú��� (04A) 
    <option value="02A">ʹ�.ྪú�ó� (02A) 
    <option value="08A">ʹ�.��� (08A) 
    <option value="84A">ʹ�.���� (84A) 
    <option value="46A">ʹ�.�����ä�� (46A) 
    <option value="73A">ʹ�.�ء����� (73A) 
    <option value="82A">ʹ�.�����ͧ�͹ (82A) 
    <option value="51A">ʹ�.��ʸ� (51A) 
    <option value="61A">ʹ�.���� (61A) 
    <option value="22A">ʹ�.������� (22A) 
    <option value="83A">ʹ�.�йͧ (83A) 
    <option value="13A">ʹ�.���ͧ (13A) 
    <option value="43A">ʹ�.�Ҫ���� (43A) 
    <option value="16A">ʹ�.ž���� (16A) 
    <option value="29A">ʹ�.�ӻҧ (29A) 
    <option value="47A">ʹ�.�Ӿٹ (47A) 
    <option value="33A">ʹ�.��� (33A) 
    <option value="39A">ʹ�.������� (39A) 
    <option value="37A">ʹ�.ʡŹ�� (37A) 
    <option value="34A">ʹ�.ʧ��� (34A) 
    <option value="75A">ʹ�.ʵ�� (75A) 
    <option value="80A">ʹ�.��طû�ҡ�� (80A) 
    <option value="54A">ʹ�.��ط��Ҥ� (54A) 
    <option value="78A">ʹ�.������ (78A) 
    <option value="07A">ʹ�.��к��� (07A) 
    <option value="69A">ʹ�.�ԧ����� (69A) 
    <option value="09A">ʹ�.��⢷�� (09A) 
    <option value="14A">ʹ�.�ؾ�ó���� (14A) 
    <option value="31A">ʹ�.����ɮ��ҹ� (31A) 
    <option value="26A">ʹ�.���Թ��� (26A) 
    <option value="52A">ʹ�.˹ͧ��� (52A) 
    <option value="71A">ʹ�.˹ͧ������� (71A) 
    <option value="30A">ʹ�.��ҧ�ͧ (30A) 
    <option value="77A">ʹ�.�ӹҨ��ԭ (77A) 
    <option value="05A">ʹ�.�شøҹ� (05A) 
    <option value="48A">ʹ�.�صôԵ�� (48A) 
    <option value="49A">ʹ�.�ط�¸ҹ� (49A) 
    <option value="50A">ʹ�.�غ��Ҫ�ҹ� (50A) 
  </select>
  <input type="radio" name="rdo1" value="2" OnClick="document.form1.lstBrn.disabled=true;">
</form>
</body>
</html>
