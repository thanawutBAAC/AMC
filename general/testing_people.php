<?include ("checkuser.php");?>
<html>
<head>
<title>�к������� ʡ�.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
</head>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="30" valign="bottom" class="boxleft50"><br>
            <br>
          </td>
          <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"></span></td>
        </tr>
        <tr align="left"> 
          <td height="20" colspan="2" valign="middle" class="boxleft50"> 
            <?
			if($type=="personnel"){echo '<img src="images/trainning_personnel.gif" width="204" height="22">';} 
			if($type=="committee"){echo '<img src="images/trainning_committee.gif" width="238" height="20">';}
			
							include("../lib/ms_database.php");
							
						?>
          </td>
        </tr>
        <tr align="center"> 
          <td height="50" colspan="2" valign="middle"><table width="99%" border="0" cellpadding="0" cellspacing="0">
              <tr><form name="form1" method="get" action="personnel.php">
                <td align="center" valign="top" >
                    <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="85%" border="0" class=font1 bgcolor=white>
                      <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                        <td height="30" colspan=8 align=left><b>&nbsp; �ʴ������Ż���ѵԡ�ý֡ͺ�� 
                          <?if($type=="personnel"){echo "���˹�ҷ��";} if($type=="committee"){echo "��С������";}?>
                          </b> | <img src="images/add_02.gif" width="11" height="10"> 
                          <a href="testing_add.php?type=<?echo $type?>&ID=<?echo $USER_ID?>&USER_ID=<?echo $USER_ID?>&position=<?echo $positions?>&name=<?echo $name?>&lastname=<?echo $lastname?>&PositionID=<?echo $PositionID?>">��������ѵԡ�ý֡ͺ��</a> 
                        </td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="25" colspan="3" align="left" bgcolor="#F0B49F" class="boxleft10">����  : <?echo $name.' '.$lastname.' ���˹� : '.$positions;?></td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td width="80%" height="20" align="left" bgcolor="#FBDBD9" class="boxleft10"><b>��úѭ��/����Թ</b></td>
                        <td width="10%" align="center" bgcolor="#FBDBD9">���</td>
                        <td width="10%" align="center" bgcolor="#FBDBD9">ź������</td>
                      </tr>
                      <tr align="center" valign="top" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="50" colspan="3" align="left" bgcolor="#FFFFFF" class="boxleft15"><br>
                          <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                         <?
							$sql1="SELECT * FROM AMCTest
							WHERE CustomerID='$USER_ID' AND TestID ='01'";
							$exsql1=mssql_query($sql1);
						 	while($rowall=mssql_fetch_array($exsql1))
							{	
						 ?>
						    <tr> 
                              <td width="80%" height="25" class="font1"><?echo ($a=$a+1).'.';?> ��ѡ�ٵ�<?echo $rowall[5];?> �Ѵ������ : <?echo $rowall[6]?>  ������ѹ��� <?echo (substr($rowall[7],6)).'/'.(substr($rowall[7],4,2)).'/'.(substr($rowall[7],0,4));?> - <?echo (substr($rowall[8],6)).'/'.(substr($rowall[8],4,2)).'/'.(substr($rowall[8],0,4));?> �ӹǹ : <?echo $rowall[9]; ?> �ѹ
                              </td>
                              <td width="10%" align="center"><a href="testing_update.php?AMCCode=<?=$amc?>&USER_ID=<?echo $USER_ID?>&name=<?echo $name?>&lastname=<?echo $lastname?>&position=<?echo $positions?>&TestEduName=<?echo $rowall[5] ?>&TestStart=<?echo $rowall[7]?>&type=<?echo $type?>&TestID=01"><img src="images/update.gif" width="14" height="13" border="0"></a></td>
                              <td height="10%" align="center"><a class=link_bluesky  href="javascript: if(confirm('��ͧ���ź�����Եԡ�ý֡ͺ����ѡ�ٵ� : <?echo $rowall[5]?> �������')){ window.location='testing_delete.php?AMCCode=<?=$amc?>&USER_ID=<?echo $USER_ID?>&name=<?echo $name?>&lastname=<?echo $lastname?>&positions=<?echo $positions?>&TestEduName=<?echo $rowall[5] ?>&TestStart=<?echo $rowall[7]?>&type=<?echo $type?>&TestID=01'}" ><img src="images/bin.gif" width="20" height="12" border="0" alt="ź�����Ž֡ͺ��"></a></td>
                            </tr>
                            <tr bgcolor="#E5E5E5"> 
                              <td height="1" colspan="3"> </td>
                            </tr>
                            <tr> 
                              <td height="5"  colspan="3"> </td>
                            </tr>
							<?
								}
							?>
                          </table>
						  <br>
                        </td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="20" align="left" bgcolor="#FBDBD9" class="boxleft10"><b>��ú�����/��èѴ���</b></td>
                        <td height="20" align="center" bgcolor="#FBDBD9">���</td>
                        <td height="20" align="center" bgcolor="#FBDBD9">ź������</td>
                      </tr>
                      <tr align="center" valign="top" bgcolor="#FFFFFF" style="color:#333333"> 
                        <td height="50" colspan="3" align="left" class="boxleft10"><br>
                          <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                            <?
							$sql1="SELECT * FROM AMCTest
							WHERE CustomerID='$USER_ID' AND TestID ='02'";
							$exsql1=mssql_query($sql1);
						 	while($rowall=mssql_fetch_array($exsql1))
							{	
						 ?>
                            <tr> 
                              <td width="80%" height="25" class="font1"><?echo ($b=$b+1).'.';?> 
                                ��ѡ�ٵ�<?echo $rowall[5];?> �Ѵ������ : <?echo $rowall[6]?> 
                                ������ѹ��� <?echo (substr($rowall[7],6)).'/'.(substr($rowall[7],4,2)).'/'.(substr($rowall[7],0,4));?> 
                                - <?echo (substr($rowall[8],6)).'/'.(substr($rowall[8],4,2)).'/'.(substr($rowall[8],0,4));?> 
                                �ӹǹ : <?echo $rowall[9]; ?> �ѹ </td>
                              <td width="10%" align="center"><a href="testing_update.php?AMCCode=<?=$amc?>&USER_ID=<?echo $USER_ID?>&name=<?echo $name?>&lastname=<?echo $lastname?>&position=<?echo $positions?>&TestEduName=<?echo $rowall[5] ?>&TestStart=<?echo $rowall[7]?>&type=<?echo $type?>&TestID=02"><img src="images/update.gif" width="14" height="13" border="0"></a></td>
                              <td height="10%" align="center"><a class=link_bluesky  href="javascript: if(confirm('��ͧ���ź�����Եԡ�ý֡ͺ����ѡ�ٵ� : <?echo $rowall[5]?> �������')){ window.location='testing_delete.php?AMCCode=<?=$amc?>&USER_ID=<?echo $USER_ID?>&name=<?echo $name?>&lastname=<?echo $lastname?>&positions=<?echo $positions?>&TestEduName=<?echo $rowall[5] ?>&TestStart=<?echo $rowall[7]?>&type=<?echo $type?>&TestID=02'}" ><img src="images/bin.gif" width="20" height="12" border="0" alt="ź�����Ž֡ͺ��"></a></td>
                            </tr>
                            <tr bgcolor="#E5E5E5"> 
                              <td height="1" colspan="3"> </td>
                            </tr>
                            <tr> 
                              <td height="5"  colspan="3"> </td>
                            </tr>
                            <?
								}
							?>
                          </table>
                          <br>
                        </td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="20" align="left" bgcolor="#FBDBD9" class="boxleft10"><b>��õ�Ҵ</b></td>
                        <td height="20" align="center" bgcolor="#FBDBD9" >���</td>
                        <td height="20" align="center" bgcolor="#FBDBD9" >ź������</td>
                      </tr>
                      <tr align="center" valign="top" bgcolor="#FFFFFF" style="color:#333333"> 
                        <td height="50" colspan="3" align="left" class="boxleft10"><br>
                          <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                            <?
							$sql1="SELECT * FROM AMCTest
							WHERE CustomerID='$USER_ID' AND TestID ='03'";
							$exsql1=mssql_query($sql1);
						 	while($rowall=mssql_fetch_array($exsql1))
							{	
						 ?>
                            <tr> 
                              <td width="80%" height="25" class="font1"><?echo ($c=$c+1).'.';?> 
                                ��ѡ�ٵ�<?echo $rowall[5];?> �Ѵ������ : <?echo $rowall[6]?> 
                                ������ѹ��� <?echo (substr($rowall[7],6)).'/'.(substr($rowall[7],4,2)).'/'.(substr($rowall[7],0,4));?> 
                                - <?echo (substr($rowall[8],6)).'/'.(substr($rowall[8],4,2)).'/'.(substr($rowall[8],0,4));?> 
                                �ӹǹ : <?echo $rowall[9]; ?> �ѹ </td>
                              <td width="10%" align="center"><a href="testing_update.php?AMCCode=<?=$amc?>&USER_ID=<?echo $USER_ID?>&name=<?echo $name?>&lastname=<?echo $lastname?>&position=<?echo $positions?>&TestEduName=<?echo $rowall[5] ?>&TestStart=<?echo $rowall[7]?>&type=<?echo $type?>&TestID=03"><img src="images/update.gif" width="14" height="13" border="0"></a></td>
                              <td height="10%" align="center"><a class=link_bluesky  href="javascript: if(confirm('��ͧ���ź�����Եԡ�ý֡ͺ����ѡ�ٵ� : <?echo $rowall[5]?> �������')){ window.location='testing_delete.php?AMCCode=<?=$amc?>&USER_ID=<?echo $USER_ID?>&name=<?echo $name?>&lastname=<?echo $lastname?>&positions=<?echo $positions?>&TestEduName=<?echo $rowall[5] ?>&TestStart=<?echo $rowall[7]?>&type=<?echo $type?>&TestID=03'}" ><img src="images/bin.gif" width="20" height="12" border="0" alt="ź�����Ž֡ͺ��"></a></td>
                            </tr>
                            <tr bgcolor="#E5E5E5"> 
                              <td height="1" colspan="3"> </td>
                            </tr>
                            <tr> 
                              <td height="5"  colspan="3"> </td>
                            </tr>
                            <?
								}
							?>
                          </table>
                          <br>
                        </td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="20" align="left" bgcolor="#FBDBD9" class="boxleft10"><b>�ˡó�</b></td>
                        <td height="20" align="center" bgcolor="#FBDBD9"  >���</td>
                        <td height="20" align="center" bgcolor="#FBDBD9"  >ź������</td>
                      </tr>
                      <tr align="center" valign="top" bgcolor="#FFFFFF" style="color:#333333"> 
                        <td height="50" colspan="3" align="left" class="boxleft10"><br>
                          <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                            <?
							$sql1="SELECT * FROM AMCTest
							WHERE CustomerID='$USER_ID' AND TestID ='04'";
							$exsql1=mssql_query($sql1);
						 	while($rowall=mssql_fetch_array($exsql1))
							{	
						 ?>
                            <tr> 
                              <td width="80%" height="25" class="font1"><?echo ($d=$d+1).'.';?> 
                                ��ѡ�ٵ�<?echo $rowall[5];?> �Ѵ������ : <?echo $rowall[6]?> 
                                ������ѹ��� <?echo (substr($rowall[7],6)).'/'.(substr($rowall[7],4,2)).'/'.(substr($rowall[7],0,4));?> 
                                - <?echo (substr($rowall[8],6)).'/'.(substr($rowall[8],4,2)).'/'.(substr($rowall[8],0,4));?> 
                                �ӹǹ : <?echo $rowall[9]; ?> �ѹ </td>
                              <td width="10%" align="center"><a href="testing_update.php?AMCCode=<?=$amc?>&USER_ID=<?echo $USER_ID?>&name=<?echo $name?>&lastname=<?echo $lastname?>&position=<?echo $positions?>&TestEduName=<?echo $rowall[5] ?>&TestStart=<?echo $rowall[7]?>&type=<?echo $type?>&TestID=04"><img src="images/update.gif" width="14" height="13" border="0"></a></td>
                              <td height="10%" align="center"><a class=link_bluesky  href="javascript: if(confirm('��ͧ���ź�����Եԡ�ý֡ͺ����ѡ�ٵ� : <?echo $rowall[5]?> �������')){ window.location='testing_delete.php?AMCCode=<?=$amc?>&USER_ID=<?echo $USER_ID?>&name=<?echo $name?>&lastname=<?echo $lastname?>&positions=<?echo $positions?>&TestEduName=<?echo $rowall[5] ?>&TestStart=<?echo $rowall[7]?>&type=<?echo $type?>&TestID=04'}" ><img src="images/bin.gif" width="20" height="12" border="0" alt="ź�����Ž֡ͺ��"></a></td>
                            </tr>
                            <tr bgcolor="#E5E5E5"> 
                              <td height="1" colspan="3"> </td>
                            </tr>
                            <tr> 
                              <td height="5"  colspan="3"> </td>
                            </tr>
                            <?
								}
							?>
                          </table> 
                          <br>
                        </td>
                      </tr>
                      <tr align="center" bgcolor="#BBD0E1" style="color:#333333"> 
                        <td height="20" align="left" bgcolor="#FBDBD9" class="boxleft10"><b>����</b></td>
                        <td height="20" align="center" bgcolor="#FBDBD9" >���</td>
                        <td height="20" align="center" bgcolor="#FBDBD9" >ź������</td>
                      </tr>
                      <tr align="center" valign="top" bgcolor="#FFFFFF" style="color:#333333"> 
                        <td height="50" colspan="3" align="left" class="boxleft10"><br>
                          <table width="100%" border="0" cellpadding="0" cellspacing="0" >
                            <?
							$sql1="SELECT * FROM AMCTest
							WHERE CustomerID='$USER_ID' AND TestID ='05'";
							$exsql1=mssql_query($sql1);
						 	while($rowall=mssql_fetch_array($exsql1))
							{	
						 ?>
                            <tr> 
                              <td width="80%" height="25" class="font1"><?echo ($e=$e+1).'.';?> 
                                ��ѡ�ٵ�<?echo $rowall[5];?> �Ѵ������ : <?echo $rowall[6]?> 
                                ������ѹ��� <?echo (substr($rowall[7],6)).'/'.(substr($rowall[7],4,2)).'/'.(substr($rowall[7],0,4));?> 
                                - <?echo (substr($rowall[8],6)).'/'.(substr($rowall[8],4,2)).'/'.(substr($rowall[8],0,4));?> 
                                �ӹǹ : <?echo $rowall[9]; ?> �ѹ </td>
                              <td width="10%" align="center"><a href="testing_update.php?AMCCode=<?=$amc?>&USER_ID=<?echo $USER_ID?>&name=<?echo $name?>&lastname=<?echo $lastname?>&position=<?echo $positions?>&TestEduName=<?echo $rowall[5] ?>&TestStart=<?echo $rowall[7]?>&type=<?echo $type?>&TestID=05"><img src="images/update.gif" width="14" height="13" border="0"></a></td>
                              <td height="10%" align="center"><a class=link_bluesky  href="javascript: if(confirm('��ͧ���ź�����Եԡ�ý֡ͺ����ѡ�ٵ� : <?echo $rowall[5]?> �������')){ window.location='testing_delete.php?AMCCode=<?=$amc?>&USER_ID=<?echo $USER_ID?>&name=<?echo $name?>&lastname=<?echo $lastname?>&positions=<?echo $positions?>&TestEduName=<?echo $rowall[5] ?>&TestStart=<?echo $rowall[7]?>&type=<?echo $type?>&TestID=05'}" ><img src="images/bin.gif" alt="ź�����Ž֡ͺ��" width="20" height="12" border="0"></a></td>
                            </tr>
                            <tr bgcolor="#E5E5E5"> 
                              <td height="1" colspan="3"> </td>
                            </tr>
                            <tr> 
                              <td height="5"  colspan="3"> </td>
                            </tr>
                            <?
								}
							?>
                          </table> 
                          <br>
                        </td>
                      </tr>
                    </table>
                    
                  </td>
               </form></tr>
            </table>
            <br>
          </td>
        </tr>
      </table>
	  </td>
  </tr>
</table>
</body>
</html>
