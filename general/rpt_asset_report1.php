<? session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
</head>
<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
		<?
					include ("../lib/ms_database.php");

					$sql="SELECT A.AMCCode, A.AssetProvince, B.br_code, B.userdetail, A.AssetType, ";
					$sql.=" A.AssetCategory,C.AssetName, A.AssetSize, A.AssetAmount, A.AssetValues, A.AssetApplying,A.AssetRemark ";
					$sql.=" FROM dbo.AssetDetail A  ";
					$sql.=" LEFT OUTER JOIN ";
					$sql.=" (SELECT * ";
					$sql.="  FROM USERLOGIN)AS B ON A.AssetProvince = B.amcprovince ";
					$sql.="LEFT OUTER JOIN ";
					$sql.=" ( ";
					$sql.="  SELECT *  ";
					$sql.="  FROM AssetCode ";
					$sql.=" )AS C ON A.AssetType=C.AssetType AND A.AssetCategory=C.AssetCategory" ;
					$sql.=" WHERE A.AMCCode <>'' AND A.AssetAmount <>'' AND A.AssetValues<>''" ;
					if($AssetType <> '')
						{ $sql.=" AND A.AssetType='$AssetType' ";}
					if($div <> '')
						{$sql.=" AND B.br_code='$div' "; }
					if($lis_province <> '')
						{ $sql.="AND A.AssetProvince ='$lis_province' " ;}
						$sql.=" ORDER BY  A.AssetProvince ";
				//echo $sql;
					$exsql=mssql_query($sql);
					$numrows=mssql_num_rows($exsql);
					
					if($numrows=="0"){echo " <div align='center'><br><br><span class='txtwhite'>!!! ��辺������㹡�ä���</span></div>";} // ��������� 
					if($search=="find" AND $numrows>=1)  // ������ա�á� ���� ����
					{
		?>

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="top"> 
      <table style="margin: 7px 0px 0px 0px" cellspacing="1" cellpadding="0" width="98%" border="0" class=font1 bgcolor=white>
        <tr align="center" bgcolor="#92AED1" class=font1 style="color:#333333"> 
          <td width=4% height="28"><b>�ӴѺ</b></td>
          <td width=13%><b>���� ʡ�.</b></td>
          <td width="20%"><b> ��������Ѿ���Թ </b></td>
          <td width=10%><b>��Ҵ</b></td>
          <td width="10%" align="center"><b>�ӹǹ</b></td>
          <td width=13%><b>��Ť�һѨ�غѹ</b></td>
          <td width="10%"><b>��������ª��</b></td>
          <td width="27%"><b>�����˵�</b></td>
        </tr>
        <?		
								$type=$org_searchtype;
								$page=30;  // ��˹��������ྨ�ʴ���¡�÷����� 40 ��¡��
								
					  			$nums=$page*$pagenum; 
								$allpage = $numrows/$page;
							  	$allpage=ceil($allpage);  // ceil �繡�ûѴ��ɷ���������繨ӹǹ���
								$number=$nums;
								//echo $nums;
								
								if($numrows>0)
									{
											mssql_data_seek($exsql,$nums); 
									}	
								
								$i=1;
								
								while($rowall=mssql_fetch_row($exsql)) 
								{
							
						?>
        <tr align=left class=font1 style="color:#666666;"> 
          <td height="20" align="center" bgcolor="#F0F0F0"><?echo $number=$number+1;?></td>
          <td height="20" align="left" bgcolor="#F0F0F0" class="boxleft15"><? echo "ʡ�. ".$rowall[3];?></td>
          <td bgcolor="#F0F0F0" class="boxleft15" style="border:1px solid #F0F0F0;"><?echo $rowall[6]?></td>
          <td height="20" bgcolor="#F0F0F0" class="boxleft15"><?echo $rowall[7]?></td>
          <td align="center" bgcolor="#F0F0F0" class="boxleft15" border:1px solid #F0F0F0;"><?echo $rowall[8];?></td>
          <td height="20" bgcolor="#F0F0F0" class="boxleft15"><?echo $rowall[9];?></td>
          <td height="20" align="center" bgcolor="#F0F0F0"  border:1px solid #F0F0F0;"> 
            <?
		  if($rowall[10]=="1")
		  		{echo "��";}
			else
				{echo '<span class="txtred">�����</span>';}
		  ?>
          </td>
          <td bgcolor="#F0F0F0" class="boxleft15"border:1px solid #F0F0F0;"> 
            <?
		 if($rowall[11]==''){echo "-";}
		 else{echo $rowall[11];}
		  ?>
          </td>
        </tr>
        <?
					if(($i>=$page) OR ( ($nums+$i) >= $numrows) ) /// �͡�ҡ�ٻ���ѵ��ѵ� ����ͤú�������˹�����ٻ
						{  break;	}
							$i++;
						}
		?>
        <tr > 
          <td height="2" colspan="8" bgcolor="#C8D7E3"></td>
        </tr>
      </table>
	  <table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="20">
          </td>
        </tr>
        <tr>
          <td align="center"> 
            <?
					 if($numrows>0)
					  	{
							$pagenum1=$pagenum+1;

								echo '<span class="font1"><span class="txtwhite">�ʴ�˹�ҷ�� <b><span class="txtred">'.$pagenum1.'</span></b> 
									�ҡ������ <b>'.$allpage.'
									</b>˹��</span></span>
									<br>';
						}
						
						  if ($allpage>1)
								 {
									for($i=1; $i<=$allpage; $i++)
									{
										$b=$i-1;
										if($pagenum+1==$i)
											{	echo "<font color='red'>";}
										else
											{	echo "<font color='black'>";}
											
										//�Ѵ�Ǣͧ�ӹǹ˹�� ���� 15 ྨ
											$d=10;
											$modpage=$i/$d;
											$modpage=ceil($modpage);
											
											$mpage=$i/$d;
											
											if($mpage==$modpage)
												{ $br="<br>";}
											if($mpage<>$modpage)
												{ $br="";}
										echo '<span class="font1">[&nbsp;<a  class="link_page" href ="rpt_asset_report1.php?pagenum='.$b.'&div='.$div.'&lis_province='.$lis_province.'&AssetType='.$AssetType.'&search='.$search.'">'.$i.'</a>&nbsp;]</font>&nbsp;</span>'.$br;
									}
								}
		  
		  ?>
            <br>
            <br>
          </td>
        </tr>
      </table>
      <input  style="width:130px"type="submit" name="Submit2" value="��ͧ��þ������ǹ���"  onClick="window.open('rpt_asset_printing.php?pagenum=<?echo $pagenum?>&search=<?echo $search?>&div=<?echo $div?>&lis_province=<?echo $lis_province?>&AssetType=<?echo $AssetType?>')"> 
      <?
	  		}  // if $search;
	  ?>
      <br>
      <br>
  </tr>
</table>
</body>
</html>
