<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
</head>

<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"><table width="80%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="40" valign="bottom"><img src="images/head_asset.jpg" width="236" height="23"></td>
        </tr>
        <tr> 
          <td height="40" align="center" valign="top"> <legend><br>
            <span class="fonts3">�ѹ�֡�����ŷ��Թ | �ѹ�֡��������觻�١���ҧ 
            | �ѹ�֡�������ҹ��˹� | �ѹ�֡�����Ť����ѳ��</span></legend><center>
            </CENTER>
            
          </td>
        </tr>
        <tr> 
          <td align="center" valign="top"><table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="95%" border="0" class=font1 bgcolor=white>
              <tr bgcolor="#92AED1" align=center class=font1 style="color:#333333;"> 
                <td height="19" colspan=7 align=left><b>&nbsp;1. �����ŷ�Ѿ���Թ���������Թ</b></td>
              </tr>
              <tr class=font1 align="center" bgcolor="#C8D7E3" style="color:#333333"> 
                <td width=30%>������</td>
                <td width="10%"><br>
                  ��Ҵ<br> <br> </td>
                <td width=10%>�ӹǹ</td>
                <td width="10%" align="center">��Ť�һѨ�غѹ</td>
                <td width=13%>��������ª��</td>
                <td width="27%">�����˵�</td>
              </tr>
              <?php
								include ("images/lib/ms_database.php");
								
								$sql="	SELECT p.AMCCOde, AssetCode.AssetType,AssetCode.AssetCategory, AssetCode.AssetName, p.AssetSize, p.AssetAmount, ";
								$sql.=" p.AssetValues, p.AssetApplying, p.AssetRemark ";
								$sql.=" FROM AssetCode ";
								$sql.=" LEFT JOIN (select * from Assetdetail "; 
								$sql.=" WHERE amccode='$user' )as p  ";
								$sql.=" ON AssetCode.AssetType = p.AssetType AND AssetCode.AssetCategory = p.AssetCategory ";
								$sql.=" where AssetCode.AssetType='01'and AssetCode.AssetCategory !='00' ";
									
								$exsql=mssql_query($sql);
							//	echo $sql;
								while($rowall=mssql_fetch_row($exsql)) 
								{	
							?>
              <tr bgcolor="#F0F0F0" align=center class=font1 style="color:#666666;"> 
                <td height="20" align=left>&nbsp;&nbsp;&nbsp; 
                  <?$a=$a+1; echo"$a. ";?>
                  <input name="textfield42" type="text" class="AssetType" value="<?echo $rowall[3];?>" ></td>
                <td align=center style="border:1px solid #F0F0F0;" bgcolor=white><input name="textfield2222" type="text" class="AssetSize" value="<?echo $rowall[4]?>"></td>
                <td height="20" align=center><input name="textfield22222" type="text" class="AssetAmount" value="<?echo $rowall[5]?>"></td>
                <td align=center style="color:#FF0080;border:1px solid #F0F0F0;" bgcolor=white><input name="textfield22223" type="text" class="AssetSize" value="<?echo $rowall[6]?>"></td>
                <td height="20" align=center> 
                  <?php
					  	$applying=$rowall[7];
						
						
						//echo $rowall[7];
						//echo $applying;
						//echo $check;
					  ?>
                  <input type="radio" name="radiobutton<?=$a;?>" value="radiobutton"<? if($applying=="1"){ echo "checked";}?>> 
                  <?if($applying=="1"){echo"<span class='txtgreen'>";}?>
                  �� 
                  <input type="radio" name="radiobutton<?=$a;?>" value="radiobutton" <? if($applying=="0"){echo "checked";}?>> 
                  <?if($applying=="0"){echo"<span class='txtred'>";}?>
                  �����</td>
                <td height="20" align=center bgcolor=white style="color:#FF0080;border:1px solid #F0F0F0;"><input name="textfield2222222" type="text" class="AssetRemark" value="<?echo $rowall[8]?>"></td>
              </tr>
              <?php
							}				
					?>
              <tr bgcolor="#F0F0F0" align=center class=font1 style="color:#666666;"> 
                <td height="20" colspan="6" align=left>&nbsp;&nbsp;&nbsp;������¡������</td>
              </tr>
            </table>
            <br> <input type="submit" name="Submit" value="�ѹ�֡������"> <input type="submit" name="Submit2" value="Submit"> 
            <br> </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
