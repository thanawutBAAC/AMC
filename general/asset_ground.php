<?include ("checkuser.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<script language="JavaScript">
<!--
/*	function bodyOnLoad() {
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

	function trim(str) {
		return str.replace(/^\s*|\s*$/g,"");
	}

	function chkItem(objS, objA, objV, objP) {
		//alert("objS="+trim(objS.value)+"//");
		if ((trim(objS.value) != "")||(trim(objA.value) != "")||(trim(objV.value) != "")) {
			objP[0].disabled=false;
			objP[1].disabled=false;
		} else {
			//alert("test2");
			objP[0].disabled=true;
			objP[1].disabled=true;
		}
	}
*/
 function check_number() {
e_k=event.keyCode
//if (((e_k < 48) || (e_k > 57)) && e_k != 46 ) {
if (e_k != 13 && (e_k < 46) || (e_k > 57) || (e_k==47)) {
event.returnValue = false;
alert("ต้องเป็นตัวเลขเท่านั้น... \nกรุณาตรวจสอบข้อมูลของท่านอีกครั้ง...");
}
}

 function check_number2() {
e_k=event.keyCode
//if (((e_k < 48) || (e_k > 57)) && e_k != 46 ) {
if ((e_k < 48) || (e_k > 51) ) {
event.returnValue = false;
alert("ต้องเป็นตัวเลขตั้งแต่ 0 - 3 เท่านั้น... \nกรุณาตรวจสอบข้อมูลของท่านอีกครั้ง...");
}
}


//-->
</script>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
</head>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" >
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><form name="form1" method="post" action="asset_insetinto.php">
        <table width="90%" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td align="center" valign="top"><table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="700" border="0" class=font1 bgcolor=white>
                <tr bgcolor="#92AED1" align=center class=font1 style="color:#333333;"> 
                  <td height="19" colspan=7 align=left><b>&nbsp; &nbsp;1. ข้อมูลทรัพย์สินประเภทที่ดิน 
                    </b></td>
                </tr>
                <tr class=font1 align="center" bgcolor="#C8D7E3" style="color:#333333"> 
                  <td width=15%>ที่ดิน</td>
                  <td width="25%"><br>
                    ขนาด<br> <br> </td>
                  <td width=10%>ประเภทที่ดิน</td>
                  <td width="15%" align="center">มูลค่าปัจจุบัน</td>
                  <td width=15%>การใช้ประโยชน์</td>
                  <td width="20%">รายละเอียด<br>
                    การใช้ประโยขน์</td>
                </tr>
                <?php
								//echo '$amc = '.$amc.'<br>';
								include ("../lib/ms_database.php");
								
								$sql="	SELECT p.AMCCOde, AssetCode.AssetType,AssetCode.AssetCategory, AssetCode.AssetName, p.AssetSize, p.Assettypeground, ";
								$sql.=" p.AssetValues, p.AssetApplying, p.AssetRemark ,AssetDetail,p.AssetSize2, p.AssetSize3";
								$sql.=" FROM AssetCode ";
								$sql.=" LEFT JOIN (select * from Assetdetail "; 
								$sql.=" WHERE amccode='$amc' )as p  ";
								$sql.=" ON AssetCode.AssetType = p.AssetType AND AssetCode.AssetCategory = p.AssetCategory ";
								$sql.=" where AssetCode.AssetType='01'and AssetCode.AssetCategory !='00' ";
								$exsql=mssql_query($sql);
								$num=mssql_num_rows($exsql);
								$i=0;
							//	echo $sql;
								while($rowall=mssql_fetch_row($exsql)) 
								{
								
							?>
						
                <tr bgcolor="#F0F0F0" align=center class=font1 style="color:#666666;">
                  <td height="20" align=left>&nbsp;&nbsp;&nbsp; 
                    <?$a=$a+1; echo"$a. ";?>
                    <b> 
                    <input type="hidden" name="amccode[]" value="<?echo $rowall[0];?>" id="amccode<?=$a;?>">
                    <input type="hidden" name="assettype[]" value="<?echo $rowall[1];?>" id="assettype<?=$a;?>">
                    <input type="hidden" name="assetcategory[]2" value="<?echo $rowall[2];?>" id="assetcategory<?=$a;?>">
                    <input type="hidden" name="assetname[]" value="0" id="assetname<?=$a;?>">
                    </b> 
                    <?
						echo $rowall[3];

					?>
                    <b> </b> </td>
                  <td style="border:1px solid #F0F0F0;"> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="20%"><input name="assetsize[]1" type="text" class="AssetSize" value="<?echo trim($rowall[4])?>" id="assetsize<?=$a;?>" style="text-align: center;" onkeypress=check_number();></td>
                        <td width="5%" class="font1"><span class="txtgreen"><b>ไร่</b></span></td>
                        <td width="20%" class="boxleft5"><input name="assetsize_ngan[]" type="text" class="AssetSize" id="assetsize_ngan<?=$a;?>" style="text-align: center;" onkeypress=check_number2(); value="<?echo trim($rowall[10])?>" maxlength="1"></td>
                        <td width="5%" class="font1"><span class="txtbluesky"><b>งาน</b></span></td>
                        <!-- ใส่ออน change ใน txtbox เพื่อเช็คค่า การใช้ประโชยน์  onChange="chkItem(this,document.getElementById('assettypeground<?=$a?>'),document.getElementById('assetvalues<?=$a?>'),document.forms[0].assetapplying<?=$i?>);" 
						-->
						<td width="20%" class="boxleft5"><input name="assetsize_wa[]" type="text" class="AssetSize" id="assetsize_wa<?=$a;?>" style="text-align: center;"  onkeypress=check_number(); value="<?echo trim($rowall[11])?>" maxlength="2"></td>
                        <td width="20%" class="font1"><span class="txtorange"><b>ตรว</b>.</span></td>
                      </tr>
                    </table></td>
                  <td height="20"><input name="assettypeground[]" type="text" class="AssetSize" id ="assettypeground[]"value="<?echo $rowall[5]?>" style="text-align: center;" ></td>
                  <td style="color:#FF0080;border:1px solid #F0F0F0;"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="font1">
                      <tr> 
                        <td width="80%"><input name="assetvalues[]" type="text" class="AssetSize" id="assetvalues[]" value="<?echo $rowall[6]?>" style="text-align: right;" onkeypress=check_number();></td>
                        <td width="20%" class="txtred">บาท</td>
                      </tr>
                    </table>
                    
                  </td>
                  <td height="20"> 
                    <?php
					  	$applying=$rowall[7];
						
						
						//echo $rowall[7];
						//echo $applying;
						//echo $check;
					  ?>
                    <input type="radio" name="assetapplying<?=$i?>"  value="1" <? if($applying=="1"){ echo "checked";}?>> 
                    <? if($applying=="1"){echo"<span class='txtgreen'>";}?>
                    <? if($applying=="1"){$green="</span>";}?>
                    มี <? echo $green;?> <input type="radio" name="assetapplying<?=$i?>"  value="0" <? if($applying=="0"){echo "checked";}?>> 
                    <? if($applying=="0"){echo"<span class='txtred'>";}?>
                    <? if($applying=="0"){$red="</span>";}?>
                    ไม่มี<?echo $red;?></td>
                  <td height="20" style="color:#FF0080;border:1px solid #F0F0F0;"><input name="assetremark[]" type="text" class="AssetRemark"  id="assetremark<?=$a;?>" value="<?echo $rowall[8];?>"></td>
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
                  <td height="20" align=left bgcolor="#F8F1C7">&nbsp; 
                    <?
							$a=$a+1; echo"<span class='txtred'>*</span>$a. ";
							
						//	$cat="0101";
				?>
                    <input type="hidden" name="assettype[]" value="01" id="assettype<?=$a;?>"> 
					 <input type="hidden" name="assetcategory[]" value="<?echo $category;?>" id="assettype<?=$a;?>">
                    <input type="hidden" name="new[]" value="1" id="new<?=$a;?>">
                    <b> 
                    <input type="hidden" name="amccode[]" value="" id="amccode[]">
                    </b> 
                    <input name="assetname[]" type="text" class="AssetType2" id="assetname<?=$a?>"></td>
                  <td style="border:1px solid #F0F0F0;"><input name="assetsize[]" type="text" class="Assetsize" id="assetsize<?=$a?>"style="text-align: right;" onChange="chkItem(this,document.getElementById('assettypeground<?=$a?>'),document.getElementById('assetvalues<?=$a?>'),document.forms[0].assetapplying<?=$i?>);"></td>
                  <td height="20"> 
                    <input name="assettypeground[]" type="text" class="Assetsize" id="assettypeground<?=$a?>" style="text-align: center;" onchange="chkItem(document.getElementById('assetsize<?=$a?>'),this,document.getElementById('assetvalues<?=$a?>'),document.forms[0].assetapplying<?=$i?>);"></td>
                  <td style="color:#FF0080;border:1px solid #F0F0F0;"><input name="assetvalues[]" type="text" class="Assetsize" id="assetvalues<?=$a;?>" style="text-align: right;" onchange="chkItem(document.getElementById('assetsize<?=$a?>'),document.getElementById('assettypeground<?=$a?>'),this,document.forms[0].assetapplying<?=$i?>);" onkeypress=check_number();></td>
                  <td height="20"><input type="radio" name="assetapplying<?=$i?>"  value="1" >
                    มี 
                    <input type="radio" name="assetapplying<?=$i;?>" value="0" >
                    ไม่มี</td>
                  <td height="20" style="color:#FF0080;border:1px solid #F0F0F0;"><input name="assetremark[]" type="text" class="AssetRemark" id="assetremark<?=$a;?>"></td>
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
                  <td align=left class="boxleft10" height="7"colspan="6"> 
                    <input type="hidden" name="row" value="<?=$a;?>">
                  </td>
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
