<?php session_start();
	include("../check_login.php");
	include("../lib/config.inc.php");
	include("../lib/database.php");

	connect();
	$sql=" SELECT  username, password, userdetail,amccode FROM  userlogin ORDER BY br_code, amcprovince";
	$result_username = query($sql);

?>
<html>
<head>
<title></title>
<link href="../css/main.css" rel="stylesheet" type="text/css"/>
</head>
<body >
<?
	include("../manu_bar.php");
?>
<br>
<center><font color='red'> ������ password �繢����Ũҡ<b><u>�к��ҹ���</u></b>  </font></center>
<center><font color='red'>  �к��ҹ�Ѩ�غѹ�� password �ҡ<b><u>�к������äس�Ҿ ISO </u></b>㹡�������ҹ </font></center>
<br>
	<table   width="600px" align="center" class="gridtable"  >
		<tr height="25px"><td colspan="5"><font color="#0F7FAF"><center>
		<span style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='../icons/report.png');" class="span_icon">
		<img src="../icons/report.png" alt=" ��§ҹ������ " class="images_icon" > 
		</span>&nbsp;
		<b>  ��§ҹ������ username  password  ʡ�.������  </b></center></font></td></tr>
		<tr class="rows_pink">
				<td align="center" width="70px"> �ӴѺ��� </td>
				<td align="center" width="120px"> username </td>
				<td align="center" width="120px"> password </td>
				<td align="center" width="170px"> ��������´������ </td>
				<td align="center" width="120px"> ���� ʡ�.</td>
		</tr>
		<?php
			$i=0;
			WHILE($result_fetch  = fetch_row($result_username))
			{
				$i++;
				if(($i%2)==0)
					echo "<tr class='rows_grey'>";
				else
					echo "<tr>";
			?>
				<td align="right"><?=$i; ?>&nbsp;</td>
				<td align="center"><?=$result_fetch[0]; ?></td>
				<td align="center"><?=$result_fetch[1]; ?></td>
				<td align="left">&nbsp;<?=$result_fetch[2]; ?></td>
				<td align="center"><?=$result_fetch[3]; ?></td>
		</tr>
		<?php
			}
		?>
	</table>
</form>
</body>
</html>
<?php
	free_result($result_username);
	close();
	include("footer.php")
?>