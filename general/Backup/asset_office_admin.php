<?  include ("checkuser.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<script language="JavaScript">
<!--
	function bodyOnLoad() {
		assetapplyingDisable();
		//document.form1.assetvalues7.disabled=true;
	}

	function rdoBrnOnClick() { //v3.0
		if(document.form1.rdoChoice[0].checked){
			document.form1.lstBrn.disabled=false;
			document.form1.lstProv.disabled=true;
			document.form1.lstRegion.disabled=true;
		}
		if(document.form1.rdoChoice[1].checked){
			document.form1.lstBrn.disabled=true;
			document.form1.lstProv.disabled=false;
			document.form1.lstRegion.disabled=true;
		} 
		if(document.form1.rdoChoice[2].checked){
			document.form1.lstBrn.disabled=true;
			document.form1.lstProv.disabled=true;
			document.form1.lstRegion.disabled=false;
		} 
		if(document.form1.rdoChoice[3].checked){
			document.form1.lstBrn.disabled=true;
			document.form1.lstProv.disabled=true;
			document.form1.lstRegion.disabled=true;
		} 
	}

	function assetapplyingDisable() {
		for(i=0;i<=(document.form1.length-1);i++) {
			if((document.forms[0].elements[i].name.substring(0,9)=="assetsize")&&(trim(document.forms[0].elements[i].value)=="")) {
				var y1 = i*1+1;
				var y2 = i*1+2;
				var y3 = i*1+3;
				var y4 = i*1+4;
				if((trim(document.forms[0].elements[y1].value)=="")&&(trim(document.forms[0].elements[y2].value)=="")) {
					document.forms[0].elements[y3].disabled=true;
					document.forms[0].elements[y4].disabled=true;
				}
			}
		}
	}

	function chkItem(objS, objA, objV, objP) {
		if ((trim(objS.value) != "")||(trim(objA.value) != "")||(trim(objV.value) != "")) {
			objP[0].disabled=false;
			objP[1].disabled=false;
		} else {
			objP[0].disabled=true;
			objP[1].disabled=true;
		}
	}

	function trim(str) {
		return str.replace(/^\s*|\s*$/g,"");
	}
//-->
</script>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
</head>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" OnLoad="bodyOnLoad()">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><form name="form1" method="get" action="asset_admin_insetinto.php">
        <table width="80%" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td align="center" valign="top"><table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="80%" border="0" class=font1 bgcolor=white>
                <tr bgcolor="#92AED1" align=center class=font1 style="color:#333333;"> 
                  <td height="19" colspan=10 align=left><b>&nbsp; &nbsp;4. เพิ่มข้อมูลทรัพย์สินประเภทเครื่องใช้สำนักงาน</b></td>
                </tr>
                <tr class=font1 align="center" bgcolor="#C8D7E3" style="color:#333333"> 
                  <td width=10%>ลำดับ</td>
                  <td width="70%"><br>
                    ชื่อทรัพย์สิน<br> <br> </td>
                  <td width="10%">แก้ไข</td>
                  <td width="10%">ลบข้อมูล</td>
                </tr>
                <?php
								//echo '$amc = '.$amc.'<br>';
								include ("images/lib/ms_database.php");
								
								$sql=" select * from assetcode ";
								$sql.=" where assettype='04' and assetcategory<>'00' ";									 
								$exsql=mssql_query($sql);
								$num=mssql_num_rows($exsql);
								$i=0;
							//	echo $sql;
								while($rowall=mssql_fetch_row($exsql)) 
								{
								
							?>
                <tr bgcolor="#F0F0F0" align=center class=font1 style="color:#666666;"> 
                  <td height="20" align=center>&nbsp;&nbsp;&nbsp; 
                    <?$a=$a+1; echo"$a. ";?>
                    <b> </b> <b> </b> </td>
                  <td align="left" class="boxleft10" style="border:1px solid #F0F0F0;"><?echo $rowall[2]?></td>
                  <td align="center" style="border:1px solid #F0F0F0;"><a href="asset_update_admin.php?type=04&category=<?echo $rowall[1]?>">แก้ไข</a></td>
                  <td align="center" style="border:1px solid #F0F0F0;"><a  href="javascript: if(confirm('การลบข้อมูลทรัพย์สินจะมีผลต่อข้อมูลทรัพย์สินทุกของ สกต. ต้องการลบหรือไม่ !!')){ window.location='asset_delete_admin.php?assettype=04&assetcategory=<?echo $rowall[1];?>';}">ลบข้อมูล</a></td>
                </tr>
                <?php
						$i++;			
					  
					  }
						$p=$row-$a;
						if($row>$a)
							{
								for($b=1;$b<=$p;$b++)
								{
									
				?>
                <tr bgcolor="#F8F1C7" align=center class=font1 style="color:#666666;"> 
                  <td height="20" align=center bgcolor="#F8F1C7">&nbsp; 
                    <?
							$a=$a+1; echo"<span class='txtred'>*</span>$a. ";
							
						//	$cat="0101";
				?>
                    <input type="hidden" name="assettype" value="04" > <input type="hidden" name="new[]" value="1" id="new[]2"> 
                    <b> </b> <b> </b> </td>
                  <td colspan="3" align="left" style="border:1px solid #F0F0F0;"><input name="assetname" type="text" class="Assetsize" style="text-align: left;" ></td>
                </tr>
                <?
						$i++;
								} //for
					}//if
					//echo $a;
					//echo $row;
					//echo $i;
					if($new<>"1"){$bb="20";}
					if($new=="1"){$bb="1";}
				?>
                <tr bgcolor="#F0F0F0" align=center class=font1 style="color:#666666;"> 
                  <td colspan="4" align=left class="boxleft10" <? echo 'height="'.$bb.'" '?>colspan="6"> 
                    <?
				  		if($new<>"1")
							{
				  ?>
                    <a href="asset_office_admin.php?&row=<?echo$a+1;?>&new=1">เพิ่มรายการใหม่</a> 
                    <?
							}
					?>
                    <b> 
                    <input type="hidden" name="row" value="<?=$a;?>">
					 <input type="hidden" name="assettype" value="04">
                    </b></td>
                </tr>
              </table>
              <br>
              <input type="hidden" name="asset" value="ground">
              <input name="Submit2" type="submit" class="formButton" value="Submit" onClick="javascript: if(confirm('บันทึกข้อมูล')){ window.location='asset_insetinto.php';}"> 
              &nbsp;
              <input name="Submit22" type="reset" class="formButton" value="Reset"> 
              <br> </td>
          </tr>
        </table>
      </form></td>
  </tr>
</table>
</body>
</html>
