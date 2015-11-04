<? include ("checkuser.php");?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<script language="JavaScript">
<!--
	function bodyOnLoad() {
		document.form1.assetvalues7.disabled=true;
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
    <td align="center" valign="top"><form name="form1" method="get" action="asset_insetinto.php">
        <table width="80%" border="0" cellpadding="0" cellspacing="0">
          <tr> 
            <td align="center" valign="top"><table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="95%" border="0" class=font1 bgcolor=white>
                <tr bgcolor="#92AED1" align=center class=font1 style="color:#333333;"> 
                  <td height="19" colspan=7 align=left><b>&nbsp; &nbsp;1. ข้อมูลทรัพย์สินประเภทที่ดิน 
                    </b></td>
                </tr>
                <tr class=font1 align="center" bgcolor="#C8D7E3" style="color:#333333"> 
                  <td width=30%>ประเภท</td>
                  <td width="10%"><br>
                    ขนาด<br> <br> </td>
                  <td width=10%>จำนวน</td>
                  <td width="10%" align="center">มูลค่าปัจจุบัน</td>
                  <td width=13%>การใช้ประโยชน์</td>
                  <td width="27%">หมายเหตุ</td>
                </tr>
                <?php
								//echo '$amc = '.$amc.'<br>';
								include ("images/lib/ms_database.php");
								
								$sql="	SELECT p.AMCCOde, AssetCode.AssetType,AssetCode.AssetCategory, AssetCode.AssetName, p.AssetSize, p.AssetAmount, ";
								$sql.=" p.AssetValues, p.AssetApplying, p.AssetRemark ";
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
                  <td style="border:1px solid #F0F0F0;"><input name="assetsize[]" type="text" class="AssetSize" value="<?echo $rowall[4]?>" id="assetsize<?=$a;?>" style="text-align: center;"></td>
                  <td height="20"><input name="assetamount[]" type="text" class="AssetSize" id ="assetamount<?=$a?>"value="<?echo $rowall[5]?>" style="text-align: center;"></td>
                  <td style="color:#FF0080;border:1px solid #F0F0F0;"><input name="assetvalues[]" type="text" class="AssetSize" id="assetvalue<?=$a;?>" value="<?echo $rowall[6]?>" style="text-align: right;"></td>
                  <td height="20"> 
                    <?php
					  	$applying=$rowall[7];
						
						
						//echo $rowall[7];
						//echo $applying;
						//echo $check;
					  ?>
                    <input type="radio" name="assetapplying<?=$i?>"  value="1"<? if($applying=="1"){ echo "checked";}?>> 
                    <? if($applying=="1"){echo"<span class='txtgreen'>";}?>
                    <? if($applying=="1"){$green="</span>";}?>
                    มี <? echo $green;?><input type="radio" name="assetapplying<?=$i?>"  value="0" <? if($applying=="0"){echo "checked";}?>> 
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
                  <td style="border:1px solid #F0F0F0;"><input name="assetsize[]" type="text" class="Assetsize" id="assetsize<?=$a?>"style="text-align: right;"></td>
                  <td height="20"> 
                    <input name="assetamount[]" type="text" class="Assetsize" id="assetamount<?=$a?>" style="text-align: center;"></td>
                  <td style="color:#FF0080;border:1px solid #F0F0F0;"><input name="assetvalues[]" type="text" class="Assetsize" id="assetvalues<?=$a;?>" style="text-align: right;"></td>
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
                  <td align=left class="boxleft10" <? echo 'height="'.$bb.'" '?>colspan="6">
				  <?
				  		if($new<>"1")
							{
				  ?>
								  <a href="asset_ground.php?&row=<?echo$a+1;?>&new=1">เพิ่มรายการใหม่</a>
					<?
							}
					?>  
					  <b> 
                    <input type="hidden" name="row" value="<?=$a;?>">
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
