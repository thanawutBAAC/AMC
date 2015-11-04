<? //include ("checkuser.php");?>
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
    <td align="center" valign="top"><form name="form1" method="get" action="asset_admin_updatedata.php">
        <table width="80%" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td align="center" valign="top"><table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="80%" border="0" class=font1 bgcolor=white>
                <tr bgcolor="#92AED1" align=center class=font1 style="color:#333333;"> 
                  <td height="19" colspan=10 align=left>
				  <?
								include ("images/lib/ms_database.php");
								$assetname="SELECT * FROM ASSETCODE WHERE ASSETTYPE='$type' AND AssetCategory='00'" ;
								$exassetname=mssql_query($assetname);
								$data=mssql_fetch_array($exassetname);
								  echo '<b>&nbsp;&nbsp;แก้ไขรายการ'.$data[2].'</b>';
								
								$sql=" select * from assetcode ";
								$sql.=" where assettype='$type' and assetcategory ='$category' ";									 
								$exsql=mssql_query($sql);
								$datasql=mssql_fetch_array($exsql);

				  ?>
				  </td>
                </tr>
                <tr class=font1 align="center" bgcolor="#C8D7E3" style="color:#333333"> 
                  <td width=10%>ลำดับ</td>
                  <td width="70%"><br>
                    ชื่อทรัพย์สิน<br> <br> </td>
                </tr>
                <tr bgcolor="#F0F0F0" align=center class=font1 style="color:#666666;"> 
                  <td height="35" align=center>&nbsp;&nbsp;&nbsp; 
                    <?$a=$a+1; echo"$a. ";?>
                    <input type="hidden" name="assettype" value="<?echo $datasql[0]?>">
                    <input type="hidden" name="assettcategory" value="<?echo $datasql[1]?>">
                    <b> </b> <b> </b> </td>
                  <td align="left" class="boxleft10" style="border:1px solid #F0F0F0;">
                    <input name="assetname" type="text" class="Assetsize" style="text-align: left;" value="<? echo $datasql[2] ;?>" ></td>
                </tr>
                <tr bgcolor="#F0F0F0" align=center class=font1 style="color:#666666;"> 
                  <td colspan="4" align=left class="boxleft10" <? echo 'height="3" '?>colspan="6"> </td>
                </tr>
              </table>
              <br>
              <input name="Submit2" type="submit" class="formButton" value="Submit" onClick="javascript: if(confirm('บันทึกข้อมูล')){ window.location='asset_admin_updatedata.php';}"> 
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
