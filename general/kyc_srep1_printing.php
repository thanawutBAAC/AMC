<? session_start();?>
<html>
<head>
<title>พิมพ์ข้อมูล</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
</head>
<SCRIPT LANGUAGE="JavaScript">
<!--
function bodyOnLoad() {
		
	var offset = (navigator.userAgent.indexOf("Mac") != -1 || 
		navigator.userAgent.indexOf("Gecko") != -1 || 
		navigator.appName.indexOf("Netscape") != -1) ? 0 : 4;
	window.moveTo(-offset, -offset);
	window.resizeTo(screen.availWidth + (2 * offset), screen.availHeight + (2 * offset));

}
//-->
</SCRIPT>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML><HEAD>
<META http-equiv=Content-Type content="text/html; charset=windows-874">
<SCRIPT language=JavaScript>
<!-- 
function MM_findObj(n, d) { //v3.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document); return x;
}
function MM_nbGroup(event, grpName) { //v3.0
  var i,img,nbArr,args=MM_nbGroup.arguments;
  if (event == "init" && args.length > 2) {
    if ((img = MM_findObj(args[2])) != null && !img.MM_init) {
      img.MM_init = true; img.MM_up = args[3]; img.MM_dn = img.src;
      if ((nbArr = document[grpName]) == null) nbArr = document[grpName] = new Array();
      nbArr[nbArr.length] = img;
      for (i=4; i < args.length-1; i+=2) if ((img = MM_findObj(args[i])) != null) {
        if (!img.MM_up) img.MM_up = img.src;
        img.src = img.MM_dn = args[i+1];
        nbArr[nbArr.length] = img;
    } }
  } else if (event == "over") {
    document.MM_nbOver = nbArr = new Array();
    for (i=1; i < args.length-1; i+=3) if ((img = MM_findObj(args[i])) != null) {
      if (!img.MM_up) img.MM_up = img.src;
      img.src = (img.MM_dn && args[i+2]) ? args[i+2] : args[i+1];
      nbArr[nbArr.length] = img;
    }
  } else if (event == "out" ) {
    for (i=0; i < document.MM_nbOver.length; i++) {
      img = document.MM_nbOver[i]; img.src = (img.MM_dn) ? img.MM_dn : img.MM_up; }
  } else if (event == "down") {
    if ((nbArr = document[grpName]) != null)
      for (i=0; i < nbArr.length; i++) { img=nbArr[i]; img.src = img.MM_up; img.MM_dn = 0; }
    document[grpName] = nbArr = new Array();
    for (i=2; i < args.length-1; i+=2) if ((img = MM_findObj(args[i])) != null) {
      if (!img.MM_up) img.MM_up = img.src;
      img.src = img.MM_dn = args[i+1];
      nbArr[nbArr.length] = img;
  } }
}

function MM_preloadImages() { //v3.0
 var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
   var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
   if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}


function check1() {
if(document.checkForm.ENG_FIRSTNAME.value=="") {
alert(" กรุณากรอกชื่อภาษาอังกฤษ ") ;
document.checkForm.ENG_FIRSTNAME.focus() ;
return false ;
}
else if(document.checkForm.ENG_LASTNAME.value=="") {
alert(" กรุณากรอกนามสกุลภาษาอังกฤษ ") ;
document.checkForm.ENG_LASTNAME.focus() ;
return false ;
}
else if(document.checkForm.POSITION.value=="") {
alert(" กรุณากรอกตำแหน่ง ") ;
document.checkForm.POSITION.focus() ;
return false ;
}
else if(document.checkForm.OFFICEPLACE.value=="") {
alert(" กรุณากรอกสถานที่ทำงาน  ") ;
document.checkForm.OFFICEPLACE.focus() ;
return false ;
}
else if(document.checkForm.CHECK_STATUS.value=="") {
alert(" กรุณาเลือกสถานะการตรวจสอบ ") ;
document.checkForm.CHECK_STATUS.focus() ;
return false ;
}
else 
return true ;
}


function startAction() {
	var pForm = document.forms[0];
	var act = pForm.hidAction.value;
	//alert("act="+act);


	if(act=="add"){
		//alert("inserttest.php?ACCOUNTNUMBER=<?echo $ACCOUNTNUMBER?>");
		pForm.action="inserttest.php?ACCOUNTNUMBER=<?echo $ACCOUNTNUMBER?>";
	}else{
		//alert("kyc_update.php?ACCOUNTNUMBER=<?echo $ACCOUNTNUMBER?>");
		pForm.action="kyc_update.php?ACCOUNTNUMBER=<?echo $ACCOUNTNUMBER?>";
	}
	return true;
}


// -->
</SCRIPT>

<SCRIPT language=JavaScript>
<!-- 
document._domino_target = "_self";
function _doClick(v, o, t, h) {
  var form = document._Main;
  if (form.onsubmit) {
     var retVal = form.onsubmit();
     if (typeof retVal == "boolean" && retVal == false)
       return false;
  }
  var target = document._domino_target;
  if (o.href != null) {
    if (o.target != null)
       target = o.target;
  } else {
    if (t != null)
      target = t;
  }
  form.target = target;
  form.__Click.value = v;
  if (h != null)
    form.action += h;
  form.submit();
  return false;
}
// -->
</SCRIPT>

<script language="javascript">
function doprint(){
window.print();}
</SCRIPT>

<META content="MSHTML 6.00.2900.2180" name=GENERATOR>
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
</HEAD>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/loadcalendar.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/calendar-th.js"></script>
<script language="JavaScript"  type="text/javascript" src="images/lib/script.js"></script>
<script language="JavaScript"  type="text/javascript" src="datepic/ts_picker.js"></script>

<?php
		include ("lib/ms_database.php");
		
		/*		$ck="SELECT count(*) AS NUMROW FROM BIZADM.TB_RELATEACCOUNT R WHERE (DepositType_Code <>'7' AND OPENDATEACCOUNT >'390000') AND (R.Sequence = '01' OR R.Sequence = ' ')   AND ACCOUNTNUMBER='$ACCOUNTNUMBER' "; 
				$exck=odbc_exec($objConnect, $ck) or die ("Error Execute [".$ck."]");
				$num=odbc_fetch_array($exck);
			//	echo $ck;
				//echo $mum['NUMROW'];
					if($num['NUMROW'] == "0") 
						{
							echo '<script>alert("หมายเลขบัญชีของท่านไม่ถูกต้อง หรือ ไม่เข้าเงื่อนไขการบันทึก KYC");window.location.href = "kyc_search.php";</script>'; 
						}*/
					
			$sql2="  Select INTERNAL_ID  ";
			$sql2.="  From BIZADM.TB_RELATEACCOUNT ";
			$sql2.="  WHERE ACCOUNTNUMBER =  '$ACCOUNTNUMBER' ";
			
	//		echo $sql2; 
				$objExec2=odbc_exec($objConnect, $sql2) or die ("Error Execute [".$sql2."]");
				$data2 = odbc_fetch_array($objExec2);
	//	echo $data2['INTERNAL_ID'];
				
				

				$sql=" select DISTINCT Dep.Internal_ID, R.Status, Dep.Branch,R.AccountNumber, R.Sequence , Dep.Type as Customer_Type, ";
				$sql.=" B.Brname, R.AccountName, DT.DepositType_Desc,R.DepositAmount, TT.Titlename, Dep.Firstname,  Dep.TELEPHONENUMBER, ";
				$sql.=" Dep.Lastname,KDEP.ENG_FIRSTNAME, KDEP.ENG_LASTNAME,  Dep.Idcard,IC.IdentityCard_Desc,  ";
				$sql.=" Dep.IdentityCard_OpenDate,Dep.IdentityCard_ExpDate, Dep.Sex,C.COUNTRY_THAINAME, Dep.Nationality, ";
				$sql.=" Dep.BirthDate, Oc.Occupation, Dep.HouseNo, Dep.MooCode, Tr.TrogName, Soi.SoiName, Tbn.TumbonName, ";
				$sql.=" Amp.AumphorName, P.ProvinceName, Dep.ContractAddress, Dep.level_Ris, RR.ReasonRis_Desc,KDEP.OFFICEPLACE ";
				$sql.=" from BIZADM.Tb_DepositCustomer DEP ";
				$sql.=" INNER JOIN BIZADM.Tb_RelateAccount R ";
				$sql.=" ON Dep.Internal_id = R.Internal_Id ";
				$sql.=" INNER JOIN INFOADM.Tb_Branch B ";
				$sql.=" ON Dep.Branch = B.Brcode ";
				$sql.=" LEFT JOIN INFOADM.Tb_DepositType  DT ";
				$sql.=" ON R.DepositType_Code = DT.DepositType_Code ";
				$sql.=" LEFT JOIN InfoADM.Tb_IdentityCard  IC ";
				$sql.=" ON Dep.IdentityCard_Code = IC.IdentityCard_Code ";
				$sql.=" LEFT JOIN INFOADM.TB_OCCUPATION Oc ";
				$sql.=" ON Dep.OccupationCode = Oc.OccupationCode ";
				$sql.=" LEFT JOIN INFOADM.Tb_TrogCode Tr  ";
				$sql.=" ON Dep.TrogCode = Tr.TrogCode ";
				$sql.=" AND Dep.AumphorCode = Tr.AumphorCode ";
				$sql.=" AND Dep.ProvinceCode = Tr.ProvinceCode ";
				$sql.="  LEFT JOIN INFOADM.TB_SoiCode Soi  ";
				$sql.=" ON Dep.SoiCode = Soi.SoiCode ";
				$sql.=" AND Dep.AumphorCode = Soi.AumphorCode ";
				$sql.=" AND Dep.ProvinceCode = Soi.ProvinceCode ";
				$sql.="  LEFT JOIN INFOADM.Tb_TumbonCode Tbn ";
				$sql.=" ON Dep.TumbonCode = Tbn.TumbonCode ";
				$sql.=" AND Dep.AumphorCode = Tbn.AumphorCode ";
				$sql.=" AND Dep.ProvinceCode = Tbn.ProvinceCode ";
				$sql.="  LEFT JOIN INFOADM.Tb_AumphorCode Amp ";
				$sql.=" ON Dep.AumphorCode = Amp.AumphorCode ";
				$sql.="  AND Dep.ProvinceCode = Amp.ProvinceCode ";
				$sql.="  LEFT JOIN INFOADM.Tb_ProvinceCode P ";
				$sql.=" ON Dep.ProvinceCode = P.ProvinceCode ";
				$sql.="  LEFT JOIN BizADM.Tb_ResonRisk RR ";
				$sql.=" ON Dep.ReasonRis_Code = RR.ReasonRis_Code ";
				$sql.=" LEFT JOIN  ";
				$sql.=" ( ";
				$sql.=" select * from ";
				$sql.=" MGTADM.KYC_DEPCUSTOMER ";
				$sql.="  ) Kdep  ";
				$sql.="  ON Dep.Internal_Id = Kdep.Internal_Id ";
				$sql.="  Left JOIN INFOADM.TB_COUNTRY C  ";
				$sql.=" ON Dep.Nationality = C.COUNTRYCODE ";
				$sql.="  Left JOIN INFOADM.TB_TITLECODE TT  ";
				$sql.="  ON DEP.TITLECODE = TT.TITLECODE  ";
			//	$sql.="  WHERE (R.DepositType_Code <>'7' AND R.OPENDATEACCOUNT >'390000') ";   // กรองมาตั้งแต่หน้า search แล้ว
				$sql.="  WHERE DEP.INTERNAL_ID ='$INTERNAL_ID'  ";
				$sql.="  AND R.AccountNumber = '$ACCOUNTNUMBER'  ";
			//	$sql.="  AND (R.Sequence = '01' OR R.Sequence = ' ')  ";
			//	$sql.="  AND (R.AccountNumber = '$ACCOUNTNUMBER'  ";
			//	$sql.="  OR DEP.INTERNAL_ID = '$INTERNAL_ID' ) ";
				


			
		echo $sql; 
				$objExec=odbc_exec($objConnect, $sql) or die ("Error Execute [".$sql."]");
				$data = odbc_fetch_array($objExec);
//			echo 	$data['INTERNAL_ID'];
//				$objExe COMMIT;
				
//	echo $data['INTERNAL_ID'];
//	echo $ACCOUNTNUMBER;
//	echo  $data['ACCOUNTNUMBER'];
//	echo $data['ACCOUNTNAME'];
//	echo  $data['STATUS'];
//	echo $data['BRANCH'];
//	echo  $data['BRNAME'];
//	echo $data['SEQUENCE'];	
	
   $INTERNAL_ID = $data['INTERNAL_ID'];
   $STATUS = $data['STATUS'];
   $BRANCH = $data['BRANCH']; 
   $BRNAME = $data['BRNAME'];    
   $SEQUENCE = $data['SEQUENCE']; 
//   echo  $INTERNAL_ID;

		// ดึงข้อมูลใน ralate table ไปแสดง
			$sql1="  select * from MGTADM.KYC_DEPCUSTOMER KDEP  ";
			$sql1.="  INNER JOIN MGTADM.KYC_RELATEACC KR ";
			$sql1.="  ON KDEP.INTERNAL_ID = KR.INTERNAL_ID ";
			$sql1.="  WHERE KDEP.INTERNAL_ID ='$INTERNAL_ID' ";
	//		$sql1.="  AND KR.ACCOUNTNUMBER ='$ACCOUNTNUMBER'  ";
			
		//	echo $sql1; 
				$objExec1=odbc_exec($objConnect, $sql1) or die ("Error Execute [".$sql1."]");
				$data1 = odbc_fetch_array($objExec1);
				
			// เช็คว่ามีข้อมูลใน relation table หรือยัง	
				$num2="  select  count(*) AS NUM2 from MGTADM.KYC_DEPCUSTOMER KDEP  ";
				$num2.="  INNER JOIN MGTADM.KYC_RELATEACC KR ";
				$num2.="  ON KDEP.INTERNAL_ID = KR.INTERNAL_ID ";
				$num2.="  WHERE KDEP.INTERNAL_ID ='$INTERNAL_ID' ";
				$exnum2=odbc_exec($objConnect, $num2) or die ("Error Execute [".$num2."]");
				$num22=odbc_fetch_array($exnum2);
//  echo  "Num2 is ".$num22['NUM2']."  ";
				
// เช็คว่ามี sequence 02 หรือไม่ เพื่อให้ทราบว่าจะ link ไปหน้าไหน
				$num3="  select  count(sequence) AS NUM3 from BIZADM.TB_RELATEACCOUNT  ";
				$num3.="  WHERE ACCOUNTNUMBER ='$ACCOUNTNUMBER' ";
				$exnum3=odbc_exec($objConnect, $num3) or die ("Error Execute [".$num3."]");
				$num3=odbc_fetch_array($exnum3);
//echo  "Num3 is ".$num3['NUM3'];


		// เช็คว่า level_ris เป็น 3 หรือไม่
			$lev3="  SELECT DEP.LEVEL_RIS AS RIS FROM BIZADM.TB_DEPOSITCUSTOMER DEP  ";
			$lev3.="  INNER JOIN BIZADM.TB_RELATEACCOUNT R ";
			$lev3.="  ON R.INTERNAL_ID = DEP.INTERNAL_ID ";
			$lev3.="  WHERE R.ACCOUNTNUMBER ='$ACCOUNTNUMBER' ";
			$lev3.="  AND DEP.INTERNAL_ID = '$INTERNAL_ID'   ";
			

				$objExec3=odbc_exec($objConnect, $lev3) or die ("Error Execute [".$lev3."]");
				$lev3 = odbc_fetch_array($objExec3);
//			echo " level_ris is ".$lev3['RIS']."  "; 
			

//echo  "ส่งค่ามาดังนี้  ";
//echo  " IDCARD = ".$IDCARD;
//echo  " FIRSTNAME = ".$FIRSTNAME;
//echo  " LASTNAME = ".$LASTNAME;
//echo  " ACCOUNTNUMBER = ". $ACCOUNTNUMBER;
//echo  " INTERNAL_ID = ". $INTERNAL_ID;

?>

<BODY text=#000000 bgColor=#ffffff leftMargin=0 background=Images/exbg1.gif 
topMargin=0 
>

<STYLE>TD {
	FONT-SIZE: 9pt; FONT-FAMILY: "MS Sans Serif"
}
.text {
	FONT-SIZE: 9pt; FONT-FAMILY: "MS Sans Serif"
}
.bar {
	FONT-SIZE: 9pt; COLOR: #ffffff; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif
}
</STYLE>

<TABLE class=bar cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR vAlign=top>
    <TD class=bar width="100%">
      		<TABLE borderColor=#e0e0e0 cellSpacing=0 borderColorDark=#c0c0c0 
      cellPadding=0 width=780 bgColor=#FFFFFF borderColorLight=#ffffff 
        border=0>
				<TBODY>
        		<TR>
    				 
              <td width=1024 bgcolor="#FFFFFF" ><img height=122	 alt="Head_KYC3.jpg" src="Images/Head_KYC3.jpg" width=780></td>
				</TR>
        		<TR>
                        <td height="5"></td>
				</TR>
	 			</TBODY>
			</TABLE>
		</TD>
	  </TR>
	</TBODY>
</TABLE>
 
<TABLE class=text cellSpacing=0 cellPadding=0 width="780" border=0>
  <TBODY>
  <TR vAlign=top>
    <TD class=text width="100%">
      <TABLE cellSpacing=0 cellPadding=0 width=780 border=0>
        <TBODY>
        <TR>
          <TD width=780> <table width="780" border="0" cellspacing="0" cellpadding="0" class="normal">
              <tr> 
                <td valign="top"> 
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                    <tr valign="top"> 
                          <td width="50%" bgcolor="B3D900"><img src="images/b_online2.gif" width="154" height="25"> 
                           </td>
						   	<td width="77%" align="right"  valign="center" bgcolor="B3D900"><font color="#FFFFFF">ยินดีต้อนรับ 
                              คุณ<strong><?echo $name.'  '.$lsname?>&nbsp;</strong>เข้าสู่ระบบ</font>&nbsp;&nbsp;<font color="#FF6633"><a href="index.php">ลงชื่อออก</a></font></td>
                      <td align="right" bgcolor="B3D900"><img src="images/c2.gif" width="6" height="6"></td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="#ECF83B">
                    <tr valign="bottom"> 
                      <td width="21">&nbsp;</td>
                      <td width="518" valign="top">&nbsp; </td>
                      <td align="right" width="19">&nbsp;</td>
                    </tr>
                    <tr valign="bottom"> 
                      <td width="21" height="27">&nbsp;</td>
                      <td width="518" valign="top"> 
                        <p class="black"><strong>ลำดับขั้นตอนการทำงาน</strong> 
                              <span class="black_b"><font color="#FF6600" face="MS Sans Serif"><strong>STEP1</strong></font></span> 
                      </td>
                      <td align="right" width="19">&nbsp;</td>
                    </tr>
                  </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="black">
                    <tr> 
                      <td valign="top"><img src="images/step1.jpg" width="552" height="55"></td>
                    </tr>
                  </table>
                </td>
              </tr>
				<form name="form1" method="post" action="" enctype="multipart/form-data" onsubmit="return startAction();" target="">
                <tr> 
                  <td valign="top"> 
                    <!------1------->
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" name="sp">
                      <tr> 
                        <td height="5"></td>
                      </tr>
                    </table>
					
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                      <tr> 
                        <td> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="B3D900">
                            <tr> 
                              <td valign="top" width="3%" align="left"><img src="images/c1.gif" width="6" height="6"></td>
                              <td valign="top" align="center" width="94%"></td>
                              <td valign="top" width="3%" align="right"><img src="images/c2.gif" width="6" height="6"></td>
                            </tr>
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="18"></td>
                              
                                  <td valign="top" width="94%" class="black_b"><strong>ค้นหา</strong></td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="E2F19E">
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                              <td valign="top" width="94%"> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                                  <tr> 
                                    <td valign="top"> 
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                                        <tr> 
                                          <td width="29%">&nbsp;</td>
                                          <td width="71%">&nbsp;</td>
                                        </tr>
                                        <tr>                      
                              <td width="29%"> <strong>&nbsp;ประเภท KYC Checklist</strong></td>
                                          <td width="71%"> 

										  <input type="text" name="Type" class="normal" value="<? if (($data['CUSTOMER_TYPE'])==P){ echo "บุคคลธรรมดา";}?><? if (($data['CUSTOMER_TYPE'])==L){ echo "นิติบุคคล";}?> " maxlength="10" disabled>     
                                          </td>
                                        </tr>
                                        <tr> 
                                          
                              <td width="29%"><strong>&nbsp;เลขที่บัญชี</strong></td>
                                          <td width="71%"> 
                                            <input type="text" name="AccNum" class="normal" value="<?echo $data['ACCOUNTNUMBER']?>" maxlength="10" disabled>
                                          </td>
                                        </tr>
                                      </table>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="18" height="1"></td>
                            </tr>
                            <tr valign="bottom"> 
                              <td width="3%"><img src="images/c3.gif" width="6" height="6"></td>
                              <td width="94%"></td>
                              <td align="right" width="3%"><img src="images/c4.gif" width="6" height="6"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
					
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" name="sp">
                      <tr> 
                        <td height="5"></td>
                      </tr>
                    </table>
					
					  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                      <tr> 
                        <td> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="B3D900">
                            <tr> 
                              <td valign="top" width="3%" align="left"><img src="images/c1.gif" width="6" height="6"></td>
                              <td valign="top" align="center" width="94%"></td>
                              <td valign="top" width="3%" align="right"><img src="images/c2.gif" width="6" height="6"></td>
                            </tr>
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="18"></td>
                              
                  <td valign="top" width="94%" class="black_b"><strong>&nbsp;ข้อมูลบัญชีเงินฝาก</strong></td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="E2F19E">
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                              <td valign="top" width="94%"> 
                                <table width="100%" height="97" border="0" cellpadding="0" cellspacing="0" class="normal">
                                  <tr> 
                                    
                                        <td height="97" valign="top"> <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                                            <tr valign="middle"> 
                                              <td width="143" height="22">&nbsp;<strong>เลขที่บัญชี 
                                                : </strong></td>
                                              <td colspan="2"><?echo $data['ACCOUNTNUMBER']?>
                                                <!--<input type="text" name="AccountNumber" class="normal" value="<?echo $AccountNumber;?>">-->
                                              </td>
                                            </tr>
                                            <tr valign="middle"> 
                                              <td width="143" height="24">&nbsp;<strong>ชื่อบัญชี 
                                                : </strong></td>
                                              <td colspan="2"><?echo $data['ACCOUNTNAME']?>
                                                <!--<input type="text" name="AccountName" class="normal" value="<?echo $AccountName;?>">-->
                                              </td>
                                            </tr>
                                            <tr> 
                                              <td width="25%" height="26"><strong>&nbsp;ประเภทบัญชี</strong></td>
                                              <td colspan="2".> <?echo $data['DEPOSITTYPE_DESC']?>
                                                <!--<select name="Deposittype_Code" size="1" class="normal">
                                  <option value="">เลือกประเภทบัญชี
                                  <option value="A1"   > ออมทรัพย์
                                  <option value="A2"   > กระแสรายวัน
                                  <option value="A4"   > ประจำ
                                  <option value="7"   > ทวีสิน
                                  <option value="A6"   > เพื่อการลงทุนทั่วไป
                                  <option value="A7"   > รักษาทรัพย์
                                  <option value="A8"   > อื่นๆ
                                  </select> -->
                                              </td>
                                            </tr>
                                            <tr> 
                                              <td width="25%">&nbsp;<strong>จำนวนเงินที่เปิดบัญชี/ทำธุรกรรม 
                                                </strong></td>
                                              <td colspan="2"> &nbsp;<?echo $data['DEPOSITAMOUNT']?>&nbsp;&nbsp;บาท
                                              </td>
                                            </tr>
                                            <tr> </table></td>
                                  </tr>
                                </table>
                              </td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="18" height="1"></td>
                            </tr>
                            <tr valign="bottom"> 
                              <td width="3%"><img src="images/c3.gif" width="6" height="6"></td>
                              <td width="94%"></td>
                              <td align="right" width="3%"><img src="images/c4.gif" width="6" height="6"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
					
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" name="sp">
                      <tr> 
                        <td height="5"></td>
                      </tr>
                    </table>
					<!--  Section A  นิติบุคคล-->
		<?
			if (($data['CUSTOMER_TYPE'])==L){
		?>
                    <table width="100%" height="413" border="0" cellpadding="0" cellspacing="0" class="normal">
                      <tr> 
                        <td> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="B3D900">
                            <tr> 
                              <td valign="top" width="3%" align="left"><img src="images/c1.gif" width="6" height="6"></td>
                              <td valign="top" align="center" width="94%"></td>
                              <td valign="top" width="3%" align="right"><img src="images/c2.gif" width="6" height="6"></td>
                            </tr>
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="18"></td>
                              
                  <td valign="top" width="94%" class="black_b"><strong>&nbsp;Section 
                    A - ข้อมูลพื้นฐานลูกค้า</strong></td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                            <td height="385" valign="top"> <table width="100%" height="388" border="0" cellpadding="0" cellspacing="0" bgcolor="E2F19E" class="normal">
                                <tr> 
                                  <td width="3%" height="378" valign="top"><img src="images/spacer.gif" width="20" height="1"></td>
                                  <td valign="top" width="94%"> <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#B3D900" class="normal">
                                      <tr> 
										 <td colspan="3"  height="22">&nbsp;<strong>KYC 
                                          Checklist สำหรับเจ้าของบัญชนิติบุคคล</strong></td>
                                      </tr>
                                      <tr> 
											<td width="184" height=27 align=left bgcolor="#f5fbc5"><strong>ชื่อนิติบุคคล</strong></td>
											<td width="133" height=27 align=middle bgcolor="#f5fbc5">ภาษาไทย</td>
											<td height=27 align=left bgcolor="#f5fbc5"  colspan="2"><?echo $data['ACCOUNTNAME']?></td>
										  </tr>
                                      <tr> 
											<td align=middle width="184" height=26>&nbsp;</td>
											<td width="133" height=26 align=middle bgcolor="#f5fbc5">ภาษาอังกฤษ</td>
											<td height=26 align=left bgcolor="#f5fbc5" colspan="2"> 
												Name : 
														<input type="text" name="ENG_FIRSTNAME"  maxlength="50" value="<?echo $data1['ENG_FIRSTNAME']?>">
												Lastname : 
														<input type="text" name="ENG_LASTNAME"  maxlength="50" value="<?echo $data1['ENG_LASTNAME']?>">
                                      </tr>
                                      <tr valign="middle" border="1"> 
											<td bordercolor="#B3D900"  height="22" colspan="2"><strong>เลขที่บัตรประจำตัวผู้เสียภาษีอากร  : </strong></td>
											<td  bordercolor="#B3D900"  height="22"><?echo $data['IDCARD']?></td>
                                      </tr>
                                      <tr> 
                                        <td valign=middle align=middle colspan="2" rowspan="6"><div align="left"><strong>การจดทะเบียน 
                                            :</strong></div></td>
                                        <td height="20" colspan="2" valign=middle> 
                                          <strong>ประเภท</strong> 
										  <?
													if(($data1['REGIST_CODE'])=='')
													{
											?>
														  <input type="checkbox" name="REGIST_CODE" value="1" >ห้างหุ้นส่วน 
														  <input type="checkbox" name="REGIST_CODE" value="2">บริษัท 
														  <input type="checkbox" name="REGIST_CODE" value="3">สมาคม 
														  <input type="checkbox" name="REGIST_CODE" value="4">มูลนิธิ 
														  <input type="checkbox" name="REGIST_CODE" value="5">วัด 
														  <input type="checkbox" name="REGIST_CODE" value="6"> อื่นๆ ระบุ 
														  <input type="text" name="REGIST_OTHER" class="normal" value="" size="15">
											<?	
												}
										  ?>
											<?
													if(($data1['REGIST_CODE'])=='1')
													{
											?>
														  <input type="checkbox" name="REGIST_CODE" value="1" checked>ห้างหุ้นส่วน 
														  <input type="checkbox" name="REGIST_CODE" value="2">บริษัท 
														  <input type="checkbox" name="REGIST_CODE" value="3">สมาคม 
														  <input type="checkbox" name="REGIST_CODE" value="4">มูลนิธิ 
														  <input type="checkbox" name="REGIST_CODE" value="5">วัด 
														  <input type="checkbox" name="REGIST_CODE" value="6"> อื่นๆ ระบุ 
														  <input type="text" name="REGIST_OTHER" class="normal" value="" size="15">
											<?	
												}
										  ?>

										  <?
													if(($data1['REGIST_CODE'])=='2')
													{
											?>
														  <input type="checkbox" name="REGIST_CODE" value="1">ห้างหุ้นส่วน 
														  <input type="checkbox" name="REGIST_CODE" value="2" checked>บริษัท 
														  <input type="checkbox" name="REGIST_CODE" value="3">สมาคม 
														  <input type="checkbox" name="REGIST_CODE" value="4">มูลนิธิ 
														  <input type="checkbox" name="REGIST_CODE" value="5">วัด 
														  <input type="checkbox" name="REGIST_CODE" value="6"> อื่นๆ ระบุ 
														  <input type="text" name="REGIST_OTHER" class="normal" value="" size="15">
											<?	
												}
										  ?>

										   <?
													if(($data1['REGIST_CODE'])=='3')
													{
											?>
														  <input type="checkbox" name="REGIST_CODE" value="1">ห้างหุ้นส่วน 
														  <input type="checkbox" name="REGIST_CODE" value="2">บริษัท 
														  <input type="checkbox" name="REGIST_CODE" value="3" checked>สมาคม 
														  <input type="checkbox" name="REGIST_CODE" value="4">มูลนิธิ 
														  <input type="checkbox" name="REGIST_CODE" value="5">วัด 
														  <input type="checkbox" name="REGIST_CODE" value="6"> อื่นๆ ระบุ 
														  <input type="text" name="REGIST_OTHER" class="normal" value="" size="15">
											<?	
												}
										  ?>

										  <?
													if(($data1['REGIST_CODE'])=='4')
													{
											?>
														  <input type="checkbox" name="REGIST_CODE" value="1">ห้างหุ้นส่วน 
														  <input type="checkbox" name="REGIST_CODE" value="2">บริษัท 
														  <input type="checkbox" name="REGIST_CODE" value="3">สมาคม 
														  <input type="checkbox" name="REGIST_CODE" value="4" checked>มูลนิธิ 
														  <input type="checkbox" name="REGIST_CODE" value="5">วัด 
														  <input type="checkbox" name="REGIST_CODE" value="6"> อื่นๆ ระบุ 
														  <input type="text" name="REGIST_OTHER" class="normal" value="" size="15">
											<?	
												}
										  ?>

										  <?
													if(($data1['REGIST_CODE'])=='5')
													{
											?>
														  <input type="checkbox" name="REGIST_CODE" value="1">ห้างหุ้นส่วน 
														  <input type="checkbox" name="REGIST_CODE" value="2">บริษัท 
														  <input type="checkbox" name="REGIST_CODE" value="3">สมาคม 
														  <input type="checkbox" name="REGIST_CODE" value="4">มูลนิธิ 
														  <input type="checkbox" name="REGIST_CODE" value="5" checked>วัด 
														  <input type="checkbox" name="REGIST_CODE" value="6"> อื่นๆ ระบุ 
														  <input type="text" name="REGIST_OTHER" class="normal" value="" size="15">
											<?	
												}
										  ?>

										  <?
													if(($data1['REGIST_CODE'])=='6')
													{
											?>
														  <input type="checkbox" name="REGIST_CODE" value="1">ห้างหุ้นส่วน 
														  <input type="checkbox" name="REGIST_CODE" value="2">บริษัท 
														  <input type="checkbox" name="REGIST_CODE" value="3">สมาคม 
														  <input type="checkbox" name="REGIST_CODE" value="4">มูลนิธิ 
														  <input type="checkbox" name="REGIST_CODE" value="5" checked>วัด 
														  <input type="checkbox" name="REGIST_CODE" value="6"> อื่นๆ ระบุ 
														  <input type="text" name="REGIST_OTHER" class="normal" value="<?echo $data['REGIST_OTHER']?>" size="15">
											<?	
												}
										  ?>

										</td>
                                      </tr>
                                      <tr> 
                                        <td height="23" colspan="2" valign=middle><strong>เอกสารสำคัญแสดงตน</strong> 
                                        </td>
                                      </tr>
                                      <tr> 
                                        <td valign=top colspan="2"> 
										<?echo $data['IDENTITYCARD_DESC']?> 
                                        </td>
                                      </tr>
                                      <tr> 
                                        <td width="678" height="22" valign=top>เลขที่ 
                                          : <?echo $data['IDCARD']?> 
                                        </td>
                                      </tr>
                                      <tr> 
                                        <td width="678" height="20">วันที่ออกบัตร &nbsp;
											<? if($data['IDENTITYCARD_OPENDATE']='      ')
												{echo"ไม่ระบุ";}else{echo $data['IDENTITYCARD_OPENDATE'];}
											?>
										</td>
                                      </tr>
                                      <tr> 
                                        <td width="678" height="19">วันที่หมดอายุ &nbsp;
											<? if($data['IDENTITYCARD_EXPDATE']='      ')
												{echo"ไม่ระบุ";}else{echo $data['IDENTITYCARD_EXPDATE'];}
											?>
										</td>
                                      </tr>
                                      <tr valign="middle" border="1"> 
                                        <td bordercolor="#B3D900"  height="22" colspan="2">
											<strong>กรณีเป็นหน่วยงานการกุศล  หรือหน่วยงานไม่แสวงหากำไร : </strong>
										</td>
                                        <td  bordercolor="#B3D900"  height="22">
										<?
										  		if(($data1['NONPROFIT_ORG'])=='')
												{
										?>
											<input type="checkbox" name="NONPROFIT_ORG" value="1">ระยะเวลาจัดตั้งไม่เกิน 10 ปี 
											<input type="checkbox" name="NONPROFIT_ORG" value="2">จัดตั้งเกิน 10 ปี 
											<input type="checkbox" name="NONPROFIT_ORG" value="3">รายได้เกิน 800 ล้าน/ปี ****
										<?	
												}
										  ?>
										 <?
										  		if(($data1['NONPROFIT_ORG'])=='1')
												{
										?>
											<input type="checkbox" name="NONPROFIT_ORG" value="1" checked >ระยะเวลาจัดตั้งไม่เกิน 10 ปี 
											<input type="checkbox" name="NONPROFIT_ORG" value="2">จัดตั้งเกิน 10 ปี 
											<input type="checkbox" name="NONPROFIT_ORG" value="3">รายได้เกิน 800 ล้าน/ปี ****
										<?	
												}
										  ?>

										 <?
										  		if(($data1['NONPROFIT_ORG'])=='2')
												{
										?>
											<input type="checkbox" name="NONPROFIT_ORG" value="1"  >ระยะเวลาจัดตั้งไม่เกิน 10 ปี 
											<input type="checkbox" name="NONPROFIT_ORG" value="2"checked>จัดตั้งเกิน 10 ปี 
											<input type="checkbox" name="NONPROFIT_ORG" value="3">รายได้เกิน 800 ล้าน/ปี ****
										<?	
												}
										  ?>

										 <?
										  		if(($data1['NONPROFIT_ORG'])=='3')
												{
										?>
											<input type="checkbox" name="NONPROFIT_ORG" value="1"  >ระยะเวลาจัดตั้งไม่เกิน 10 ปี 
											<input type="checkbox" name="NONPROFIT_ORG" value="2">จัดตั้งเกิน 10 ปี 
											<input type="checkbox" name="NONPROFIT_ORG" value="3" checked>รายได้เกิน 800 ล้าน/ปี ****
										<?	
												}
										  ?>

										</td>
                                      </tr>
                                      <!--<tr >
                                        <td height="22" colspan="3" bordercolor="#B3D900">&nbsp;<strong>เลขที่บัตรประชาชน 
                                          / หนังสือเดินทาง / ใบต่างด้าว :</strong></td>
                                      </tr> -->
                                      <tr > 
                                        <td height="29" colspan="2" bordercolor="#B3D900">
											<strong>ประเภทธุรกิจ   : </strong>
										</td>
                                        <td width="678" bordercolor="#B3D900">
												<?
														if(($data1['CHECK_STATUS'])=='1')
														{
															echo "ไม่ระบุ";
														}else{   
															echo $data['OCCUPATION'];
														}		
												?> 
                                        </td>
                                      </tr>
                                      <tr> 
                                        <td valign=top align=middle colspan="2" rowspan="2"><div align="left"><strong>สถานที่ตั้งจดทะเบียน</strong></div></td>
                                        <td valign=middle > &nbsp;เลขที่
										 <?
													if(($data['HOUSENO'])=='00' OR ($data['HOUSENO'])==''  OR ($data['HOUSENO'])=='                    ')
													{	echo "-";
													}else{		
														echo $data['HOUSENO'];
													}		
											?>
                                          &nbsp;หมู่ 
                                          <?
													if(($data['MOOCODE'])=='00' OR ($data['MOOCODE'])==''  OR ($data['MOOCODE'])=='  ')
													{	echo "-";
													}else{		
														echo $data['MOOCODE'];
													}		
											?>
                                          &nbsp;ตรอก
										   <?
													if(($data['TROGNAME'])=='00' OR ($data['TROGNAME'])==''  OR ($data['TROGNAME'])=='  ')
													{	echo "-";
													}else{		
														echo $data['TROGNAME'];
													}		
											?>
                                          &nbsp;ซอย
										  <?
													if(($data['SOINAME'])=='00' OR ($data['SOINAME'])==''  OR ($data['SOINAME'])=='  ')
													{	echo "-";
													}else{		
														echo $data['SOINAME'];
													}		
											?>
                                          &nbsp;ตำบล 
										  <?
													if(($data['TUMBONNAME'])=='00' OR ($data['TUMBONNAME'])==''  OR ($data['TUMBONNAME'])=='  ')
													{	echo "-";
													}else{		
														echo $data['TUMBONNAME'];
													}		
											?>
                                          &nbsp;อำเภอ
										  <?
													if(($data['AUMPHORNAME'])=='00' OR ($data['AUMPHORNAME'])==''  OR ($data['AUMPHORNAME'])=='  ')
													{	echo "-";
													}else{		
														echo $data['AUMPHORNAME'];
													}		
											?>
                                          &nbsp;จังหวัด
										  <?
													if(($data['PROVINCENAME'])=='00' OR ($data['PROVINCENAME'])==''  OR ($data['PROVINCENAME'])=='  ')
													{	echo "-";
													}else{		
														echo $data['PROVINCENAME'];
													}		
											?>
								<!--		  &nbsp;โทรศัพท์
										  <?
													if(($data['TELEPHONENUMBER'])=='00' OR ($data['TELEPHONENUMBER'])==''  OR ($data['TELEPHONENUMBER'])=='  ')
													{	echo "-";
													}else{		
														echo $data['TELEPHONENUMBER'];
													}		
											?>  -->
                                        </td>
                                      </tr>
                                      <tr valign=top> 
                                        <td width=678> <table class=normal cellspacing=0 cellpadding=0 
                                width="100%" border=0>
                                            <tbody>
                                              <tr valign=middle> 
                                                <!--<td width="14%" height="29">รหัสไปรษณีย์</td>
                                                <td width="33%">&nbsp; <input type="text" name="LRegstZip2"  maxlength="5"  size="3"></td> -->
                                                <!--<td align=right width="21%">โทรศัพท์ 
                                                  &nbsp;</td>
                                                <td width="32%">&nbsp; <?echo $data['TELEPHONENUMBER']?></td>  -->
                                              </tr>
                                              <tr valign=top> </tr>
                                            </tbody>
                                          </table></td>
                                      </tr>
                                      <tr> 
                                        <td height="27" colspan="2" align=middle valign=middle ><div align="left"><strong>สถานที่ตั้งทำการ</strong></div></td>
                                        <td valign=bottom colspan=5><input type="text" name="OFFICEPLACE" class="normal" value="<?echo $data['OFFICEPLACE'];?>" size="75"></td>
                                      </tr>
                                    </table></td>
                                  <td valign="top" width="3%"><img src="images/spacer.gif" width="18" height="1"></td>
                                </tr>
                                <tr valign="bottom"> 
                                  <td width="3%" height="6"><img src="images/c3.gif" width="6" height="6"></td>
                                  <td width="94%"></td>
                                  <td align="right" width="3%"><img src="images/c4.gif" width="6" height="6"></td>
                                </tr>
                              </table></td>
                      </tr>
                    </table>
			
			       <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" name="sp">
                      <tr> 
                        <td height="5"></td>
                      </tr>
                    </table>
					<?
							}
					?>
			
					<!--  Section A  บุคคลธรรมดา-->
					<?
									if (($data['CUSTOMER_TYPE'])==P){
					?>

				<table width="100%" height="407" border="0" cellpadding="0" cellspacing="0" class="normal">
                      <tr> 
                        <td> 

                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="B3D900">
                            <tr> 
                              <td valign="top" width="3%" align="left"><img src="images/c1.gif" width="6" height="6"></td>
                              <td valign="top" align="center" width="94%"></td>
                              <td valign="top" width="3%" align="right"><img src="images/c2.gif" width="6" height="6"></td>
                            </tr>
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="18"></td>
                              
                  <td valign="top" width="94%" class="black_b"><strong>&nbsp;Section 
                    A - ข้อมูลพื้นฐานลูกค้า</strong></td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                            </tr>
                          </table>

                        </td>
                      </tr>
                      <tr> 
                        <td valign="top"> 

                          <table width="100%" height="376" border="0" cellpadding="0" cellspacing="0" bgcolor="E2F19E" class="normal">
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                              <td valign="top" width="94%"> 

                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                                  <tr> 
                                    <td valign="top">


							<? if($data['BRANCH']== $branch  ){?>	
									<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#B3D900" class="normal">
                            <tr> 
                              <!--<td width="29%"> <strong>ประเภท KYC Checklist</strong></td>-->
                              <td colspan="3"  height="22">&nbsp;<strong>KYC Checklist 
                                สำหรับเจ้าของบัญชีบุคคล และเจ้าของบัญชีร่วมแต่ละคน</strong></td>
                            </tr>
                            <tr> 
                              <td width="232" height=26 align=middle bgcolor="#f5fbc5"><strong>ชื่อ-สกุล</strong></td>
                              <td width="106" height=26 align=middle bgcolor="#f5fbc5">ภาษาไทย</td>
                              <td 
                                height=26 align=left bgcolor="#f5fbc5"  colspan="2"><?echo $data['TITLENAME']?><?echo $data['FIRSTNAME']?>&nbsp;&nbsp;<?echo $data['LASTNAME']?><!--<input type="text" name="b2name">--></td>
                            </tr>
                            <tr> 
                              <td align=middle width="232" height=26>&nbsp;</td>
                              <td width="106" height=26 align=middle bgcolor="#f5fbc5">ภาษาอังกฤษ</td>
                              <td 
                                height=26 align=left bgcolor="#f5fbc5" colspan="2"> 
								         Name : <input type="text" name="ENG_FIRSTNAME"  maxlength="50" value="<?echo $data1['ENG_FIRSTNAME']?>"> 
										 Lastname : <input type="text" name="ENG_LASTNAME"  maxlength="50" value="<?echo $data1['ENG_LASTNAME']?>">
                              </td>
                            </tr>
                            <tr> 
                              <td valign=middle align=middle colspan="2" rowspan="5"><div align="left"><strong>บัตรสำคัญประจำตัว</strong></div></td>
                              <td height="19" colspan="2" valign=middle>
								</td>
                            </tr>
                            <tr> 
                              <td height="24" colspan="2" valign=top><?echo $data['IDENTITYCARD_DESC']?></td>
                            </tr>
                            <tr> 
                              <td width="657" height="22" valign=top>เลขที่ <?echo $data['IDCARD']?>
                              </td>
                            </tr>
                            <tr> 
                              <td width="657" height="20">วันที่ออกบัตร :  <?echo $data['IDENTITYCARD_OPENDATE']?>
                              </td>
                            </tr>
                            <tr> 
                              <td width="657" height="19">วันที่หมดอายุ :  <?echo $data['IDENTITYCARD_EXPDATE']?>
                              </td>
                            </tr>
                            <tr> 
                              <td height="24" colspan="2" align=middle valign=middle rowspan="3"><div align="left"><strong>เพศ/สัญชาติ/ว.ด.ป.เกิด</strong></div></td>
                              <td width="657" height="23" valign=middle><strong>เพศ</strong> 
							  		<?
											if(($data['SEX'])=='2')
											{
									?>
											<input type=radio value=gender=f checked disabled>
											หญิง 
											<input type=radio value=gender=m disabled>
											ชาย
									<?
									}
									?>
									
							  		<?
											if(($data['SEX'])=='1')
											{
									?>
											<input type=radio value=gender=f  disabled>
											หญิง 
											<input type=radio value=gender=m checked disabled>
											ชาย
									<?
									}
									?>									
									
								
								</td>
                            </tr>
                            <tr> 
                              <td width="657" height="26" valign=top><strong>สัญชาติ</strong> 
							  		<?
											if(($data['NATIONALITY'])=='0680')
											{
									?>
													<input type=radio value=thai  checked disabled>
													ไทย 
													<input type=radio value=other disabled>
													อื่นๆ ระบุ 
													<input type="text" name="other2" class="normal" value="" size="15" disabled>
									<?
											}
											else
											{
									?>
													<input type=radio value=thai  disabled>
													ไทย 
													<input type=radio value=other checked disabled>
													อื่นๆ  
													<?
															if(($data['COUNTRY_THAINAME'])=='' OR ($data['COUNTRY_THAINAME'])==' ')
															{
																echo "ไม่ระบุ";
															}
															else{
																echo "ระบุ ".$data['COUNTRY_THAINAME'];
															}
													?>								
												
									<?
											} 
									?>
									</td>
                            </tr>
                            <tr> 
                              <td width="657" height="20" valign=top><strong>วัน/เดือน/ปีเกิด 
                                (พ.ศ.) : </strong><?echo $data['ฺBIRTHDATE']?>
								  </td>
                            </tr>
                            <tr > 
                              <td height="28" colspan="2" bordercolor="#B3D900"><strong>อาชีพหรือประเภทธุรกิจ 
                                : </strong></td>
                              <td width="657" bordercolor="#B3D900"><?echo $data['OCCUPATION']?></td>
                            </tr>
                            <tr > 
                              <td bordercolor="#B3D900" colspan="2"><strong>ตำแหน่ง 
                                : </strong></td>
                              <td width="657" bordercolor="#B3D900"><input type="text" name="POSITION" class="normal" value="<?echo $data1['POSITION']?>"></td>
                            </tr>
                            <tr > 
                              <td height="32" colspan="2" bordercolor="#B3D900"><strong>สถานที่ทำงาน 
                                : </strong></td>
                              <td width="657" bordercolor="#B3D900"><input type="text" name="OFFICEPLACE" class="normal" value="<?echo $data1['OFFICEPLACE']?>"size="75"></td>
                            </tr>
                            <tr > 
                             <!-- <td height="31" colspan="2"  rowspan="2" bordercolor="#B3D900" valign="top"><strong>ที่อยู่ตามบัตรประชาชน 
                                : </strong></td>-->
								<td height="31" colspan="2" bordercolor="#B3D900" ><strong>ที่อยู่ตามบัตรประชาชน 
                                : </strong></td>
                              <td width="657" height="22" bordercolor="#B3D900">
										  เลขที่ <?echo $data['HOUSENO']?>
										  &nbsp;หมู่ 
											<?
													if(($data['MOOCODE'])=='00' OR ($data['MOOCODE'])==''  OR ($data['MOOCODE'])==' ')
													{
														echo "-";
													}
													else
													{
														echo $data['MOOCODE'];
													}
											?>
										  &nbsp;ตรอก <?echo $data['TROGNAME']?>
										  &nbsp;ซอย <?echo $data['SOINAME']?>
										  &nbsp;ตำบล <?echo $data['TUMBONNAME']?>
										  &nbsp;อำเภอ <?echo $data['AUMPHORNAME']?>
										  &nbsp;จังหวัด <?echo $data['PROVINCENAME']?>
							  <!--<input type="text" name="IdcardAddress" class="normal" value="" size="75">--></td>
                            </tr>
							<!--<tr>
									<td width="657" height="22">รหัสไปรษณีย์&nbsp; <input type="text" name="LRegstZip"  maxlength="5"  size="3"></td>
							</tr>-->
                            <tr > 
                              <td height="39" colspan="2" bordercolor="#B3D900"><strong>สถานที่สะดวกในการติดต่อ 
                                : </strong></td>
                              <td width="657" bordercolor="#B3D900"><?echo $data['CONTRACTADDRESS']?></td>
                            </tr>
                          </table>

						<?}else{?>  
							<!-- ไม่ใช่ลูกค้าสาขา -->
							<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#B3D900" class="normal">
                            <tr> 
                              <!--<td width="29%"> <strong>ประเภท KYC Checklist</strong></td>-->
                              <td colspan="3"  height="22">&nbsp;<strong>KYC Checklist 
                                สำหรับเจ้าของบัญชีบุคคล และเจ้าของบัญชีร่วมแต่ละคน</strong></td>
                            </tr>
                            <tr> 
                              <td width="232" height=26 align=middle bgcolor="#f5fbc5"><strong>ชื่อ-สกุล</strong></td>
                              <td width="106" height=26 align=middle bgcolor="#f5fbc5">ภาษาไทย</td>
                              <td 
                                height=26 align=left bgcolor="#f5fbc5"  colspan="2"><?echo $data['TITLENAME']?><?echo $data['FIRSTNAME']?>&nbsp;&nbsp;<?echo $data['LASTNAME']?><!--<input type="text" name="b2name">--></td>
                            </tr>
                            <tr> 
                              <td align=middle width="232" height=26>&nbsp;</td>
                              <td width="106" height=26 align=middle bgcolor="#f5fbc5">ภาษาอังกฤษ</td>
                              <td 
                                height=26 align=left bgcolor="#f5fbc5" colspan="2"> 
								         Name : <input type="text" name="ENG_FIRSTNAME"  maxlength="50" value="<?echo $data1['ENG_FIRSTNAME']?>" disabled> 
										 Lastname : <input type="text" name="ENG_LASTNAME"  maxlength="50" value="<?echo $data1['ENG_LASTNAME']?>" disabled>
                              </td>
                            </tr>
                            <tr> 
                              <td valign=middle align=middle colspan="2" rowspan="5"><div align="left"><strong>บัตรสำคัญประจำตัว</strong></div></td>
                              <td height="19" colspan="2" valign=middle>
								</td>
                            </tr>
                            <tr> 
                              <td height="24" colspan="2" valign=top><?echo $data['IDENTITYCARD_DESC']?></td>
                            </tr>
                            <tr> 
                              <td width="657" height="22" valign=top>เลขที่ <?echo $data['IDCARD']?>
                              </td>
                            </tr>
                            <tr> 
                              <td width="657" height="20">วันที่ออกบัตร :  <?echo $data['IDENTITYCARD_OPENDATE']?>
                              </td>
                            </tr>
                            <tr> 
                              <td width="657" height="19">วันที่หมดอายุ :  <?echo $data['IDENTITYCARD_EXPDATE']?>
                              </td>
                            </tr>
                            <tr> 
                              <td height="24" colspan="2" align=middle valign=middle rowspan="3"><div align="left"><strong>เพศ/สัญชาติ/ว.ด.ป.เกิด</strong></div></td>
                              <td width="657" height="23" valign=middle><strong>เพศ</strong> 
							  		<?
											if(($data['SEX'])=='2')
											{
									?>
											<input type=radio value=gender=f checked disabled>
											หญิง 
											<input type=radio value=gender=m disabled>
											ชาย
									<?
									}
									?>
									
							  		<?
											if(($data['SEX'])=='1')
											{
									?>
											<input type=radio value=gender=f  disabled>
											หญิง 
											<input type=radio value=gender=m checked disabled>
											ชาย
									<?
									}
									?>	
									
									<?
											if(($data['SEX'])=='' OR ($data['SEX'])==' ')
											{
									?>
											ไม่ระบุ
									<?
									}
									?>						
									
								
								</td>
                            </tr>
                            <tr> 
                              <td width="657" height="26" valign=top><strong>สัญชาติ</strong> 
							  		<?
											if(($data['NATIONALITY'])=='0680')
											{
									?>
													<input type=radio value=thai  checked disabled>
													ไทย 
													<input type=radio value=other disabled>
													อื่นๆ ระบุ 
													<input type="text" name="other2" class="normal" value="" size="15" disabled>
									<?
											}
											else
											{
									?>
													<input type=radio value=thai  disabled>
													ไทย 
													<input type=radio value=other checked disabled>
													อื่นๆ  
													<?
															if(($data['COUNTRY_THAINAME'])=='' OR ($data['COUNTRY_THAINAME'])==' ')
															{
																echo "ไม่ระบุ";
															}
															else{
																echo "ระบุ ".$data['COUNTRY_THAINAME'];
															}
													?>								
												
									<?
											} 
									?>
									</td>
                            </tr>
                            <tr> 
                              <td width="657" height="20" valign=top><strong>วัน/เดือน/ปีเกิด 
                                (พ.ศ.) : </strong><?echo $data['ฺBIRTHDATE']?>
								  </td>
                            </tr>
                            <tr > 
                              <td height="28" colspan="2" bordercolor="#B3D900"><strong>อาชีพหรือประเภทธุรกิจ 
                                : </strong></td>
                              <td width="657" bordercolor="#B3D900"><?echo $data['OCCUPATION']?></td>
                            </tr>
                            <tr > 
                              <td bordercolor="#B3D900" colspan="2"><strong>ตำแหน่ง 
                                : </strong></td>
                              <td width="657" bordercolor="#B3D900"><input type="text" name="POSITION" class="normal" value="<?echo $data1['POSITION']?>" disabled></td>
                            </tr>
                            <tr > 
                              <td height="32" colspan="2" bordercolor="#B3D900"><strong>สถานที่ทำงาน 
                                : </strong></td>
                              <td width="657" bordercolor="#B3D900"><input type="text" name="OFFICEPLACE" class="normal" value="<?echo $data1['OFFICEPLACE']?>"size="75" disabled></td>
                            </tr>
                            <tr > 
                             <!-- <td height="31" colspan="2"  rowspan="2" bordercolor="#B3D900" valign="top"><strong>ที่อยู่ตามบัตรประชาชน 
                                : </strong></td>-->
								<td height="31" colspan="2" bordercolor="#B3D900" ><strong>ที่อยู่ตามบัตรประชาชน 
                                : </strong></td>
                              <td width="657" height="22" bordercolor="#B3D900">
										  เลขที่ <?echo $data['HOUSENO']?>
										  &nbsp;หมู่ 
											<?
													if(($data['MOOCODE'])=='00' OR ($data['MOOCODE'])==''  OR ($data['MOOCODE'])==' ')
													{
														echo "-";
													}
													else
													{
														echo $data['MOOCODE'];
													}
											?>
										  &nbsp;ตรอก <?echo $data['TROGNAME']?>
										  &nbsp;ซอย <?echo $data['SOINAME']?>
										  &nbsp;ตำบล <?echo $data['TUMBONNAME']?>
										  &nbsp;อำเภอ <?echo $data['AUMPHORNAME']?>
										  &nbsp;จังหวัด <?echo $data['PROVINCENAME']?>
							  <!--<input type="text" name="IdcardAddress" class="normal" value="" size="75">--></td>
                            </tr>
							<!--<tr>
									<td width="657" height="22">รหัสไปรษณีย์&nbsp; <input type="text" name="LRegstZip"  maxlength="5"  size="3"></td>
							</tr>-->
                            <tr > 
                              <td height="39" colspan="2" bordercolor="#B3D900"><strong>สถานที่สะดวกในการติดต่อ 
                                : </strong></td>
                              <td width="657" bordercolor="#B3D900"><?echo $data['CONTRACTADDRESS']?></td>
                            </tr>
                          </table>
						  <?}?>


								</td>
                                  </tr>
                                </table>

                              </td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="18" height="1"></td>
                            </tr>
                            <tr valign="bottom"> 
                              <td width="3%"><img src="images/c3.gif" width="6" height="6"></td>
                              <td width="94%"></td>
                              <td align="right" width="3%"><img src="images/c4.gif" width="6" height="6"></td>
                            </tr>
                          </table>

                        </td>
                      </tr>
                    </table>




			
					
					
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" name="sp">
                      <tr> 
                        <td height="5"></td>
                      </tr>
                    </table>
					<?
							}
					?>				
					
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                      <tr> 
                        <td> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="B3D900">
                            <tr> 
                              <td valign="top" width="3%" align="left"><img src="images/c1.gif" width="6" height="6"></td>
                              <td valign="top" align="center" width="94%"></td>
                              <td valign="top" width="3%" align="right"><img src="images/c2.gif" width="6" height="6"></td>
                            </tr>
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="18"></td>
                              
                  <td valign="top" width="94%" class="black_b"><strong>&nbsp;Section 
                    B - ข้อมูลที่จำเป็นต้องสอบถาม</strong></td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="E2F19E">
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                              <td  width="94%"> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                                  <tr> 
                                    <td ><table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                                      <tr>
                                        <!--<td width="29%"> <strong>ประเภท KYC Checklist</strong></td>-->
                                        <td  height="25" colspan="3" bordercolor="#B3D900">&nbsp;<strong>1. สถานะการตรวจสอบ : มีการตรวจสอบชื่อและรูปพรรณสัณฐานของลูกค้าใน Sanctions และ PEP List 
 										<?
										  		if(($data1['CHECK_STATUS'])=='')
												{
										?>
										  			<input type="radio" name="CHECK_STATUS" value="1"  >มี
 													<input type="radio" name="CHECK_STATUS" value="2"  >ไม่มี										
										<?	
												}
										  ?>
										                                           
										  <?
										  		if(($data1['CHECK_STATUS'])=='1')
												{
										?>
										  			<input type="radio" name="CHECK_STATUS" value="1"  checked>มี
 													<input type="radio" name="CHECK_STATUS" value="2" >ไม่มี										
										<?	
												}
										  ?>
										  
										<?
										  		if(($data1['CHECK_STATUS'])=='2')
												{
										?>
										  			<input type="radio" name="CHECK_STATUS" value="1"  >มี
 													<input type="radio" name="CHECK_STATUS" value="2"  checked>ไม่มี										
										<?	
												}
										  ?>
										  

<label></label>
                                        </strong></td>
                                      </tr>
									   <tr >
										<td  height="45" colspan="3" bordercolor="#B3D900">&nbsp;<strong>2. มีการตรวจสอบชื่อ : มีการตรวจสอบชื่อ วันเกิด และสัญชาติของลูกค้า ตามเอกสารแสดงตน จากฉบับจริง พร้อมตราประทับหน่วยงานผู้ออกเอกสาร </strong>(ถ้ามี) <br>
										  &nbsp;<strong>วันเกิด สัญชาติ : "ได้ตรวจสอบจากต้นฉบับจริง" ในสำเนาเอกสาร</strong> <label>
										  
										<?
										  		if(($data1['NAME_CHECK'])=='1')
												{
										?>
										  <input type="checkbox" name="NAME_CHECK" value="1" checked>
										  บัตรประชาชน 
										 <?
										 }
										 else
										 {
										 ?>
										  <input type="checkbox" name="NAME_CHECK" value="1">
										  บัตรประชาชน 										  										
											<?
											}
											?>
											
											
										<?
										  		if(($data1['NAME_CHECK'])=='2')
												{
										?>
										  <input type="checkbox" name="NAME_CHECK" value="2" checked>
										  หนังสือเดินทาง 
										 <?
										 }
										 else
										 {
										 ?>
										  <input type="checkbox" name="NAME_CHECK" value="2">
										  หนังสือเดินทาง 										  										
											<?
											}
											?>
											
											
										<?
										  		if(($data1['NAME_CHECK'])=='3')
												{
										?>
										  <input type="checkbox" name="NAME_CHECK" value="3" checked>
										  ใบต่างด้าว
										 <?
										 }
										 else
										 {
										 ?>
										  <input type="checkbox" name="NAME_CHECK" value="3">
										  ใบต่างด้าว										  										
											<?
											}
											?>




										  
										  </label></td>
                                      </tr>
									  <tr valign="middle">
                                        <!--<td width="29%"> <strong>ประเภท KYC Checklist</strong></td>-->
                                        <td  height="25" colspan="3" bordercolor="#B3D900">&nbsp;<strong>3. ตรวจสอบที่อยู่ : มีการตรวจสอบที่อยู่จากหลักฐานที่นำมาแสดงที่อยู่ 
                                          <label>										  
										<?
										  		if(($data1['ADDRESS_CHECK'])=='1')
												{
										?>
                                          <input type="checkbox" name="ADDRESS_CHECK" value="1" checked>
                                          บัตรประชาชน
										 <?
										 }
										 else
										 {
										 ?>
                                          <input type="checkbox" name="ADDRESS_CHECK" value="1">
                                          บัตรประชาชน										  										
											<?
											}
											?>		  
											</label>
                                          <label>
										  <?
										  		if(($data1['ADDRESS_CHECK'])=='2')
												{
										?>
                                          <input type="checkbox" name="ADDRESS_CHECK" value="2" checked>
                                          หนังสือรับรองการจดทะเบียน
										 <?
										 }
										 else
										 {
										 ?>
                                          <input type="checkbox" name="ADDRESS_CHECK" value="2">
                                          หนังสือรับรองการจดทะเบียน										  										
											<?
											}
											?>		  
										</label>
                                        </strong></td>
                                      </tr>
										<tr >
										<td  height="45" colspan="3" bordercolor="#B3D900">&nbsp;<strong>4. วัตถุประสงค์ในการเปิดบัญชี : ระบุวัตถุประสงค์ เลือกได้มากกว่า 1 ข้อ </strong><br>
										  &nbsp;<label>
										  <?
										  		if(($data1['ACCPURPOSE_CODE'])=='1')
												{
										?>
										  <input type="checkbox" name="ACCPURPOSE_CODE" value="1" checked>
										  ออมเงิน 
										 <?
										 }
										 else
										 {
										 ?>
										  <input type="checkbox" name="ACCPURPOSE_CODE" value="1">
										  ออมเงิน 										  										
											<?
											}
											?>


										  <?
										  		if(($data1['ACCPURPOSE_CODE'])=='2')
												{
										?>
										  <input type="checkbox" name="ACCPURPOSE_CODE" value="2" checked>
										  การลงทุนในธุรกิจ
										 <?
										 }
										 else
										 {
										 ?>
										  <input type="checkbox" name="ACCPURPOSE_CODE" value="2">
										  การลงทุนในธุรกิจ										  										
											<?
											}
											?>
											
											
										<?
										  		if(($data1['ACCPURPOSE_CODE'])=='3')
												{
										?>
										  <input type="checkbox" name="ACCPURPOSE_CODE" value="3" checked> 
										  รับ/ชำระเงินกู้ 
										 <?
										 }
										 else
										 {
										 ?>
										  <input type="checkbox" name="ACCPURPOSE_CODE" value="3">
										  รับ/ชำระเงินกู้ 										  										
											<?
											}
											?>
											

										<?
										  		if(($data1['ACCPURPOSE_CODE'])=='4')
												{
										?>
										  <input type="checkbox" name="ACCPURPOSE_CODE" value="4">
										  บัญชีเงินเดือน 
										 <?
										 }
										 else
										 {
										 ?>
										  <input type="checkbox" name="ACCPURPOSE_CODE" value="4">
										  บัญชีเงินเดือน 										  										
											<?
											}
											?>


										<?
										  		if(($data1['ACCPURPOSE_CODE'])=='5')
												{
										?>
										  <input type="checkbox" name="ACCPURPOSE_CODE" value="5" checked>
										  ชำระค่าสาธารณูปโภค 
										 <?
										 }
										 else
										 {
										 ?>
										  <input type="checkbox" name="ACCPURPOSE_CODE" value="5">
										  ชำระค่าสาธารณูปโภค 										  										
											<?
											}
											?>
											
											
										<?
										  		if(($data1['ACCPURPOSE_CODE'])=='6')
												{
										?>
										  <input type="checkbox" name="ACCPURPOSE_CODE" value="6" checked>
										  อื่นๆ โปรดระบุ </label><input type="text" name="ACCPURPOSE_OTH" class="normal" value="<?echo $data1['ACCPURPOSE_OTH']?>">
										 <?
										 }
										 else
										 {
										 ?>
										  <input type="checkbox" name="ACCPURPOSE_CODE" value="6">
										  อื่นๆ โปรดระบุ </label><input type="text" name="ACCPURPOSE_OTH" class="normal" value="<?echo $data1['ACCPURPOSE_OTH']?>">										  										
											<?
											}
											?>
										</td>
                                      </tr>
											<tr >
										<td  height="52" colspan="3" bordercolor="#B3D900">&nbsp;<strong>5. แหล่งที่มาของเงินฝาก : แหล่งที่มาของเงินฝาก เลือกได้มากกว่า 1 ข้อ </strong>
										<?
										  		if(($data1['DEPOSITSOURCE'])=='1')
												{
										?>
											<input type="checkbox" name="DEPOSITSOURCE" value="1"  checked>เงินออม
										 <?
										 }
										 else
										 {
										 ?>
											<input type="checkbox" name="DEPOSITSOURCE" value="1" >เงินออม										  										
											<?
											}
											?>	

										<?
										  		if(($data1['DEPOSITSOURCE'])=='2')
												{
										?>
												<input type="checkbox" name="DEPOSITSOURCE" value="2"  check>ธุรกิจส่วนตัว
										 <?
										 }
										 else
										 {
										 ?>
												<input type="checkbox" name="DEPOSITSOURCE" value="2" >ธุรกิจส่วนตัว										  										
											<?
											}
											?>
										<br>
										  &nbsp;<label>
										  
										<?
										  		if(($data1['DEPOSITSOURCE'])=='3')
												{
										?>
										  <input type="checkbox" name="DEPOSITSOURCE" value="3" checked>
										  รับจ้าง 
										 <?
										 }
										 else
										 {
										 ?>
										  <input type="checkbox" name="DEPOSITSOURCE" value="3">
										  รับจ้าง 										  										
											<?
											}
											?>										  

										<?
										  		if(($data1['DEPOSITSOURCE'])=='4')
												{
										?>
										  <input type="checkbox" name="DEPOSITSOURCE" value="4" checked>
										  มรดก/ของขวัญ
										 <?
										 }
										 else
										 {
										 ?>
										  <input type="checkbox" name="DEPOSITSOURCE" value="4">
										  มรดก/ของขวัญ										  										
											<?
											}
											?>

										<?
										  		if(($data1['DEPOSITSOURCE'])=='5')
												{
										?>
										  <input type="checkbox" name="DEPOSITSOURCE" value="5" checked>
										  ขายหลักทรัพย์/หน่วยลงทุน 
										 <?
										 }
										 else
										 {
										 ?>
										  <input type="checkbox" name="DEPOSITSOURCE" value="5">
										  ขายหลักทรัพย์/หน่วยลงทุน 										  										
											<?
											}
											?>

										<?
										  		if(($data1['DEPOSITSOURCE'])=='6')
												{
										?>
										  <input type="checkbox" name="DEPOSITSOURCE" value="6" checked>
										  ค้าขาย 
										 <?
										 }
										 else
										 {
										 ?>
										  <input type="checkbox" name="DEPOSITSOURCE" value="6">
										  ค้าขาย 										  										
											<?
											}
											?>


										<?
										  		if(($data1['DEPOSITSOURCE'])=='7')
												{
										?>
										  <input type="checkbox" name="DEPOSITSOURCE" value="7"  checked>
										  อื่นๆ โปรดระบุ </label><input type="text" name="DEPSOURCE_OTH" class="normal" value="<?echo $data1['DEPSOURCE_OTH']?>">
										 <?
										 }
										 else
										 {
										 ?>
										  <input type="checkbox" name="DEPOSITSOURCE" value="7">
										  อื่นๆ โปรดระบุ </label><input type="text" name="DEPSOURCE_OTH" class="normal" value="<?echo $data1['DEPSOURCE_OTH']?>" >										  										
											<?
											}
											?>										   
										</td>
                                      </tr>
									  
									  <?
									   		if(($data['TYPE'])=='L')
											{
									  ?>
									  <tr >		
											  <td  height="45" colspan="3" bordercolor="#B3D900">&nbsp;<strong>6. 
												<!-- เฉพาะนิติบุคคล-->
												รายได้ส่วนใหญ่ของกิจการได้มาเป็น</strong><br>
												&nbsp; <label> <strong> </strong>
												<input type="radio" name="INCOMING_CODE" value="1" >
												เงินสด 
												<input type="radio" name="INCOMING_CODE" value="2" >
												ไม่ใช่เงินสด<strong> (กรณีเป็นหน่วยงานการกุศล 
												หรือหน่วยงานไม่แสวงหากำไรไม่ต้องสอบถาม)</strong></label></td>
                                      </tr>
									  <?
											  }
									  ?>
									  		
									  <tr bordercolor="#B3D900" > 
                      <td width="246" height="22" align="center" bgcolor="#CBE64F"><strong>ประมาณการทำธุรกิจต่อเดือน</strong></td>
                      <td width="262" align="center" bgcolor="#CBE64F"><strong>จำนวนรายการต่อเดือน</strong></td>
                              <td width="232" align="center" bgcolor="#CBE64F"><strong>มูลค่าธุรกรรมโดยประมาณ 
                                (บาท) ต่อเดือน</strong></td>
                    </tr>
                    <tr bordercolor="#B3D900"> 
                      <td height="1" colspan="4" bgcolor="#E2F19E"></td>
                    </tr>
                    <tr bordercolor="#B3D900"> 
                              <td height="22" align="center" bgcolor="#E2F19E">รายการฝาก+รับโอน/เดือน</td>
                      <td align="center" bgcolor="#E2F19E">
					  <?
					    			if(($data1['DEPPERMONTH'])==''){
					  ?>					  
					  					<select name="DEPPERMONTH" id="DEPPERMONTH">
                                                  <option value=""  selected="selected">----- เลือก -----</option>
                                                  <option value="1" > 1-10</option>
                                                  <option value="2" > 11-20</option>
                                                  <option value="3" > มากกว่า 20</option>
                                         </select></td>
						<?
									}					  
					  ?>
					  
					  
					  <?
					    			if(($data1['DEPPERMONTH'])=='1'){
					  ?>					  
					  					<select name="DEPPERMONTH" id="DEPPERMONTH">
                                                  <option value="" >----- เลือก -----</option>
                                                  <option value="1" selected="selected"> 1-10</option>
                                                  <option value="2"> 11-20</option>
                                                  <option value="3"> มากกว่า 20</option>
                                         </select></td>
						<?
									}					  
					  ?>
					  
					  <?
					    			if(($data1['DEPPERMONTH'])=='2'){
					  ?>					  
					  					<select name="DEPPERMONTH" id="DEPPERMONTH">
                                                  <option value="" >----- เลือก -----</option>
                                                  <option value="1" > 1-10</option>
                                                  <option value="2" selected="selected">11-20</option>
                                                  <option value="3"> มากกว่า 20</option>
                                         </select></td>
						<?
									}					  
					  ?>
					  
					  
					  <?
					    			if(($data1['DEPPERMONTH'])=='3'){
					  ?>					  
					  					<select name="DEPPERMONTH" id="DEPPERMONTH">
                                                  <option value="" >----- เลือก -----</option>
                                                  <option value="1" > 1-10</option>
                                                  <option value="2" > 11-20</option>
                                                  <option value="3" selected="selected"> มากกว่า 20</option>
                                         </select></td>
						<?
									}					  
					  ?>	
					  



                    <td align="center" bgcolor="#E2F19E">
					<?
					    			if(($data1['DEPTRNSWORTH'])==''){
					  ?>					  
					  			<select name="DEPTRNSWORTH" id="DEPTRNSWORTH">
									  <option selected="selected" value="">----- เลือก -----</option>
									  <option value="1"> น้อยกว่า 50,000  </option>
									  <option value="2"> 50,001-100,000</option>
									  <option value="3"> 100,001-500,000</option>
									  <option value="4"> มากกว่า 500,001</option>
                        		</select></td>
						<?
									}					  
					  ?>
					  
					  
					  <?
					    			if(($data1['DEPTRNSWORTH'])=='1'){
					  ?>					  
					  			<select name="DEPTRNSWORTH" id="DEPTRNSWORTH">
									  <option  value="">----- เลือก -----</option>
									  <option value="1" selected="selected">  น้อยกว่า 50,000  </option>
									  <option value="2"> 50,001-100,000</option>
									  <option value="3"> 100,001-500,000</option>
									  <option value="4"> มากกว่า 500,001</option>
                        		</select></td>
						<?
									}					  
					  ?>
					  
					  <?
					    			if(($data1['DEPTRNSWORTH'])=='2'){
					  ?>					  
					  			<select name="DEPTRNSWORTH" id="DEPTRNSWORTH">
									  <option  value="">----- เลือก -----</option>
									  <option value="1" > น้อยกว่า 50,000  </option>
									  <option value="2" selected="selected"> 50,001-100,000</option>
									  <option value="3">100,001-500,000</option>
									  <option value="4"> มากกว่า 500,001</option>
                        		</select></td>
						<?
									}					  
					  ?>
					  
					  
					  <?
					    			if(($data1['DEPTRNSWORTH'])=='3'){
					  ?>					  
					  			<select name="DEPTRNSWORTH" id="DEPTRNSWORTH">
									  <option  value="">----- เลือก -----</option>
									  <option value="1" > น้อยกว่า 50,000  </option>
									  <option value="2" > 50,001-100,000</option>
									  <option value="3" selected="selected"> 100,001-500,000</option>
									  <option value="4"> มากกว่า 500,001</option>
                        		</select></td>
						<?
									}					  
					  ?>		

					  <?
					    			if(($data1['DEPTRNSWORTH'])=='4'){
					  ?>					  
					  			<select name="DEPTRNSWORTH" id="DEPTRNSWORTH">
									  <option  value="">----- เลือก -----</option>
									  <option value="1" >  น้อยกว่า 50,000  </option>
									  <option value="2" > 50,001-100,000</option>
									  <option value="3" > 100,001-500,000</option>
									  <option value="4" selected="selected"> มากกว่า 500,001</option>
                        		</select></td>
						<?
									}					  
					  ?>		



                    </tr>
                    <tr bordercolor="#B3D900"> 
                              <td height="22" align="center" bgcolor="#E2F19E">รายการถอน+โอนออก/เดือน</td>
                      <td align="center" bgcolor="#E2F19E">
					  <?
					    			if(($data1['WITHDRAWPERMONTH'])==''){
					  ?>					  
					  			<select name="WITHDRAWPERMONTH" id="WITHDRAWPERMONTH">
									  <option selected="selected" value="">----- เลือก -----</option>
									  <option value="1"> 1-10</option>
									  <option value="2"> 11-20</option>
									  <option value="3"> มากกว่า 20</option>
                        		</select></td>
						<?
									}					  
					  ?>
					  
					  
					  <?
					    			if(($data1['WITHDRAWPERMONTH'])=='1'){
					  ?>					  
					  			<select name="WITHDRAWPERMONTH" id="WITHDRAWPERMONTH">
									  <option  value="">----- เลือก -----</option>
									  <option value="1" selected="selected"> 1-10</option>
									  <option value="2"> 11-20</option>
									  <option value="3"> มากกว่า 20</option>
                        		</select></td>
						<?
									}					  
					  ?>
					  
					  <?
					    			if(($data1['WITHDRAWPERMONTH'])=='2'){
					  ?>					  
					  			<select name="WITHDRAWPERMONTH" id="WITHDRAWPERMONTH">
									  <option  value="">----- เลือก -----</option>
									  <option value="1" > 1-10</option>
									  <option value="2" selected="selected"> 11-20</option>
									  <option value="3"> มากกว่า 20</option>
                        		</select></td>
						<?
									}					  
					  ?>
					  
					  
					  <?
					    			if(($data1['WITHDRAWPERMONTH'])=='3'){
					  ?>					  
					  			<select name="WITHDRAWPERMONTH" id="WITHDRAWPERMONTH">
									  <option  value="">----- เลือก -----</option>
									  <option value="1" > 1-10</option>
									  <option value="2" > 11-20</option>
									  <option value="3" selected="selected"> มากกว่า 20</option>
                        		</select></td>
						<?
									}					  
					  ?>	



                   <td align="center" bordercolor="#B3D900" bgcolor="#E2F19E">
					<?
					    			if(($data1['WITHTRNDWORTH'])==''){
					  ?>					  
					  			<select name="WITHTRNDWORTH" id="WITHTRNDWORTH">
									  <option selected="selected" value="">----- เลือก -----</option>
									  <option value="1">  น้อยกว่า 50,000  </option>
									  <option value="2"> 50,001-100,000</option>
									  <option value="3"> 100,001-500,000</option>
									  <option value="4"> มากกว่า 500,001</option>
                        		</select></td>
						<?
									}					  
					  ?>
					  
					  
					  <?
					    			if(($data1['WITHTRNDWORTH'])=='1'){
					  ?>					  
					  			<select name="WITHTRNDWORTH" id="WITHTRNDWORTH">
									  <option  value="">----- เลือก -----</option>
									  <option value="1" selected="selected">  น้อยกว่า 50,000  </option>
									  <option value="2"> 50,001-100,000</option>
									  <option value="3"> 100,001-500,000</option>
									  <option value="4"> มากกว่า 500,001</option>
                       			 </select></td>
						<?
									}					  
					  ?>
					  
					  <?
					    			if(($data1['WITHTRNDWORTH'])=='2'){
					  ?>					  
					  			<select name="WITHTRNDWORTH" id="WITHTRNDWORTH">
									  <option  value="">----- เลือก -----</option>
									  <option value="1">  น้อยกว่า 50,000  </option>
									  <option value="2" selected="selected"> 50,001-100,000</option>
									  <option value="3"> 100,001-500,000</option>
									  <option value="4"> น้อยกว่า 500,001</option>
                       			 </select></td>
						<?
									}					  
					  ?>
					  
					  
					  <?
					    			if(($data1['WITHTRNDWORTH'])=='3'){
					  ?>					  
					  			<select name="WITHTRNDWORTH" id="WITHTRNDWORTH">
									  <option  value="">----- เลือก -----</option>
									  <option value="1">  น้อยกว่า 50,000  </option>
									  <option value="2" > 50,001-100,000</option>
									  <option value="3" selected="selected"> 100,001-500,000</option>
									  <option value="4"> มากกว่า 500,001</option>
                       			 </select></td>
						<?
									}					  
					  ?>		

					  <?
					    			if(($data1['WITHTRNDWORTH'])=='4'){
					  ?>					  
					  			<select name="WITHTRNDWORTH" id="WITHTRNDWORTH">
									  <option  value="">----- เลือก -----</option>
									  <option value="1">  น้อยกว่า 50,000  </option>
									  <option value="2" > 50,001-100,000</option>
									  <option value="3" > 100,001-500,000</option>
									  <option value="4" selected="selected"> มากกว่า 500,001</option>
                       			 </select></td>
						<?
									}					  
					  ?>		


                    </tr>								  								  
                                
  
                                    </table></td>
                                  </tr>
                                </table>
                              </td>
                              <td valign="top" width="3%">&nbsp;</td>
                            </tr>
                            <tr valign="bottom"> 
                              <td width="3%"><img src="images/c3.gif" width="6" height="6"></td>
                              <td width="94%"></td>
                              <td align="right" width="3%"><img src="images/c4.gif" width="6" height="6"></td>
                            </tr>
                          </table>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" name="sp">
                      <tr> 
                        <td height="5"></td>
                      </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal">
                      <tr> 
                        <td> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="B3D900">
                            <tr> 
                              <td valign="top" width="3%" align="left"><img src="images/c1.gif" width="6" height="6"></td>
                              <td valign="top" align="center" width="94%"></td>
                              <td valign="top" width="3%" align="right"><img src="images/c2.gif" width="6" height="6"></td>
                            </tr>
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="18"></td>
                              
                        <td valign="top" width="94%" class="black_b">&nbsp;</td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr> 
                        <td valign="top"> 
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="E2F19E">
                            <tr> 
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="20" height="1"></td>
                              <td valign="top" width="94%"> 
                                <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#B3D900" class="normal">
                            <tr valign="middle"  border="1" > 
                              <td  height="24" 	 colspan="2" bordercolor="#B3D900"><div align="center"><strong>บันทึกรายละเอียดโดยพนักงาน/ตัวแทน</strong></div></td>
                            <!--  <td  height="24" colspan="2"><div align="center"><strong>ตรวจสอบโดยพนักงานผู้รับมอบอำนาจ</strong></div></td> -->
                            </tr>
                            <tr valign="middle" border="1"> 
                              <td width="179"  height="22" bordercolor="#B3D900"><strong>&nbsp;ชื่อ 
                                :  <?echo $name.' '.$lsname?>
                              <!--  <input type="text" name="RECNAME" size="20" value="" disabled> -->
                                </strong></td>
                              <td width="181"  height="22" bordercolor="#B3D900"><strong>&nbsp;ตำแหน่ง 
                                : <?echo $positions?>
                                <!-- <input type="text" name="RECPOSITION" size="15" > -->
                                </strong></td>
                            <!--  <td width="181"  height="22"><strong>&nbsp;ชื่อ 
                                : </strong><input type="text" name="checkername" size="20"></td>
                              <td width="185"  height="22"><strong>&nbsp;ตำแหน่ง 
                                : </strong><input type="text" name="checkerposition" size="15"></td>  -->
                            </tr>
                            <tr valign="top" border="1"> 
                              <td  height="22" colspan="2" bordercolor="#B3D900" ><strong>&nbsp;ความเห็น 
                                :</strong> <textarea name="REASONRIS_DESC"  disabled ><?echo $data['REASONRIS_DESC']?></textarea></td>
                             <!-- <td  height="22" colspan="2"><strong>&nbsp;ความเห็น 
                                : 
                                <textarea name="textarea2"></textarea>
                                </strong> </td>  -->
                            </tr>
                            <tr valign="middle" border="1"> 
                              <td  height="22" colspan="2" bordercolor="#B3D900">&nbsp;สมควรจัดระดับความเสี่ยงเป็น 

								<?
										if(($data['LEVEL_RIS'])=='1'){
								?>
											<input type="radio" name="risk1" value="1" checked disabled>ระดับ1
											<input type="radio" name="risk1" value="2" disabled>ระดับ2 
											<input type="radio" name="risk1" value="3" disabled>ระดับ3 										
								<?
										}
								?>
								
								<?
										if(($data['LEVEL_RIS'])=='2'){
								?>
											<input type="radio" name="risk1" value="1" disabled>ระดับ1
											<input type="radio" name="risk1" value="2" disabled checked >ระดับ2 
											<input type="radio" name="risk1" value="3" disabled>ระดับ3 										
								<?
										}
								?>
								
								<?
										if(($data['LEVEL_RIS'])=='3'){
								?>
											<input type="radio" name="risk1" value="1" disabled>ระดับ1
											<input type="radio" name="risk1" value="2" disabled  >ระดับ2 
											<input type="radio" name="risk1" value="3"  checked disabled>ระดับ3 										
								<?
										}
								?>								
								
								 <?
										if(($data['LEVEL_RIS']<>'1') AND ($data['LEVEL_RIS']<>'2' ) AND ($data['LEVEL_RIS']<>'3')){
								?>
                                             : <FONT color=#ff0080>(ยังไม่มีการจัดระดับความเสี่ยง หรือจัดระดับความเสี่ยงเป็น 0)</FONT>

											<!--<input type="radio" name="risk1" value="1" checked disabled>ระดับ1
											<input type="radio" name="risk2" value="2" disabled>ระดับ2 
											<input type="radio" name="risk3" value="3" disabled>ระดับ3 		-->								
								<?
										}
								?>

								</td>
								
								
                           <!--   <td  height="22" colspan="2" bordercolor="#B3D900">&nbsp;</td>  -->
                            </tr>
                            <tr valign="middle" border="1"> 
                                              <!--<td width="179"  height="22" bordercolor="#B3D900">&nbsp;ลายเซ็นต์ 
                                                ..............................</td>-->
                                              <td width="179"  height="22" bordercolor="#B3D900">&nbsp;ผู้บันทึก 
                                                 <?echo $name.' '.$lsname?></td>												
                              <td width="181"  height="22" bordercolor="#B3D900">&nbsp;วันที่  <?echo showDate($today);?>
										<!--<input name="txt_kycupdate" type="text" id="kycupdate" size="10" maxlength="10" readonly="" style="	height: 20px; width: 70px;" > 
										<img src="Images/cal.gif" alt=".เลือกวันที่." width="16" height="16" align="absmiddle" onClick=" return showCalendar('kycupdate','dd-mm-y');" onMouseOver="this.style.cursor='hand'"; > 
										&lt;&lt;เลือกวันที่ -->

							  </td>
                         	<!--     <td width="181"  height="22">&nbsp;ลายเซ็นต์ 
                                ..........................................</td>
                              <td width="185"  height="22">&nbsp;วันที่  <?echo showDate($today);?>
							  			<input name="txt_kycAutrdate" type="text" id="kycAutrdate" size="10" maxlength="10" readonly="" style="	height: 20px; width: 70px;" > 
									<img src="Images/cal.gif" alt=".เลือกวันที่." width="16" height="16" align="absmiddle" onClick=" return showCalendar('kycAutrdate','dd-mm-y');" onMouseOver="this.style.cursor='hand'"; > 
										&lt;&lt;เลือกวันที่  
							  </td>-->
                            </tr>
                          </table>
                              </td>
                              <td valign="top" width="3%"><img src="images/spacer.gif" width="18" height="1"></td>
                            </tr>
                            <tr valign="bottom"> 
                              <td width="3%"><img src="images/c3.gif" width="6" height="6"></td>
                              <td width="94%"></td>
                              <td align="right" width="3%"><img src="images/c4.gif" width="6" height="6"></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
										  
						  
                        </td>
                      </tr>
                    </table>
        
					
                    <!------2------->
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" name="sp">
                      <tr> 
                        <td height="5"></td>
                      </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="normal" bgcolor="#ECF83B">
                      <tr> 
                        <td width="3%" valign="top"><img src="images/c1.gif" width="6" height="6"></td>
                        <td width="94%" valign="bottom" align="right"> </td>
                        <td align="right" width="3%" valign="top"><img src="images/c2.gif" width="6" height="6"></td>
                      </tr>
                                            <tr> 
                        <td width="3%" valign="bottom">&nbsp;</td>
                        <td width="94%" valign="bottom" align="right"> 

						<? if($num22['NUM2']=="0") 
									{

									$action = "add";
						?> 
						
							<!--<input type="submit" value=" บันทึก step1 &gt; " style="cursor:hand" name="submit4">-->
							<input type="button" value=" < กลับหน้าที่แล้ว " style="cursor:hand" name="submit5" onClick="self.location.href=('kyc_search.php')"	>
							<!--<input type="button" value=" < กลับหน้าที่แล้ว " style="cursor:hand" name="submit5" onclick="javascript:history.back();"> 
							<input name="btnSave" type="submit" id="save" class="formButton" value=" บันทึก step1 &gt; " onMouseOver="this.style.cursor='hand'" >&nbsp; -->
							<input name="btnSave" type="submit" id="save" class="formButton" value=" บันทึก" onMouseOver="this.style.cursor='hand'" >&nbsp; 



							<?
									}
									else
									{
									
									$action = "edit";
							?>
						  <!--<input type="button" value=" < กลับหน้าที่แล้ว " style="cursor:hand" name="submit5" onClick="self.location.href=('kyc_search.php')" >-->
							<input type="button" value=" < กลับหน้าที่แล้ว " style="cursor:hand" name="submit5" onclick="javascript:history.back();">
						

						<input name="btnEdit" type="submit" id="del" class="formButton" value="แก้ไขข้อมูล" onMouseOver="this.style.cursor='hand'">

							<?
}					//		echo $action;	
							?>

						<? if($num3['NUM3'] >"1") 
									{
						?> 
									<input type="button" value=" ต่อไป >" style="cursor:hand" name="next1" onClick="self.location.href=('kyc_step2.php?ACCOUNTNUMBER=<?echo $ACCOUNTNUMBER?>')">
						<?
									}else{
						?>

								<? if($lev3['RIS']=='3') { ?>
										<input type="button" value="ต่อไป step3 > " style="cursor:hand" name="finish" onClick="self.location.href=('kyc_step3.php?ACCOUNTNUMBER=<?echo $ACCOUNTNUMBER?>')">
										<? } else{  ?>
										<!--<input type="button" value=" เสร็จสิ้นการบันทึก KYC " style="cursor:hand" name="finish" onClick="self.location.href=('kyc_search.php')">  -->
										<input type="button" value=" เสร็จสิ้นการบันทึก KYC " style="cursor:hand" name="finish" onClick="window.close();">
										<?
								}
										?>
									<!--			<input type="button" value=" เสร็จสิ้นการบันทึก KYC " style="cursor:hand" name="finish" onClick="self.location.href=('kyc_search.php')"> -->
						<? } ?>
						
						<input name="Print" type="button" id="print" class="formButton" value="พิมพ์" onClick="javascript:doprint();">

                          <img src="images/spacer.gif" width="97" height="25" align="absmiddle"></td>
                        <td align="right" width="1%" valign="bottom">&nbsp;</td>
                      </tr>
                                            <tr> 
                        <td width="3%" valign="bottom"><img src="images/c3.gif" width="6" height="6"></td>
                        <td width="94%" valign="bottom" align="right"></td>
                        <td align="right" width="3%" valign="bottom"><img src="images/c4.gif" width="6" height="6"></td>
                      </tr>
                    </table>
                  </td>
                </tr>
				<input type="hidden" name="hidAction" value="<?=$action;?>">
				<input type="hidden" name="hidInternalid" value="<?=$INTERNAL_ID;?>">
				<input type="hidden" name="hidStatus" value="<?=$STATUS;?>">
				<input type="hidden" name="hidBranch" value="<?=$BRANCH;?>">
				<input type="hidden" name="hidSequence" value="<?=$SEQUENCE;?>">
				<input type="hidden" name="hidBrname" value="<?=$BRNAME;?>">
				<input type="hidden" name="hidIDCard" value="<?=$IDCARD;?>">
			<!--	<input type="hidden" name="hid.." value="<?=$xx;?>">
				<input type="hidden" name="hid.." value="<?=$xx;?>"> -->
              </form>
              <tr> 
                <td valign="top" align="right"><a href="#top"><img src="images/gotop.gif" width="41" height="21" border="0" vspace="3" align="absmiddle"></a> 
                </td>
              </tr>
            </table></TD>
				
              </TR>
              <TR>
                <TD colSpan=2>
                  <P align=left><FONT 
                  face="MS Sans Serif"><SMALL><SMALL>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                  <STRONG>Note:</STRONG> &nbsp; <FONT color=#0000ff>1. หน้าจอตัวอย่าง อาจมีการเปลี่ยนแปลงได้ภายหลังตามความเหมาะสม
                  <BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                  2. All denominations are for banknotes 
                  only<BR>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
      3. หากมีข้อซักถาม ติดต่อ ทีมสารสนเทศเพื่อการจัดการ กองสารสนเทศ โทร. 4474</FONT><BR>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
      <STRONG><FONT color=#000080>*****Contact Us </FONT></STRONG></SMALL></SMALL><STRONG><FONT 
                  color=#000080><SMALL><SMALL>at WAN #4474-4476 e-mail: </SMALL></SMALL></FONT><SMALL><SMALL><U><A 
                  href="mailto:150001@baac.or.th"><FONT color=#ff0080>Information System Department</FONT></A></U></SMALL></SMALL></STRONG></FONT></P></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE><BR></TD></TR></TBODY></TABLE>



<TABLE class=bar cellSpacing=0 cellPadding=0 width="101%" border=0>
  <TBODY>
  <TR vAlign=top>
    <TD class=bar width="100%">
      		<TABLE borderColor=#e0e0e0 cellSpacing=0 borderColorDark=#c0c0c0 
      cellPadding=0 width=700 bgColor=4EA612 borderColorLight=#ffffff 
        border=0>
				<TBODY>
        		<TR>
          			<TD width=623>
            			<P align=right><SPAN class=bar>Copyright &copy;2009 Bank  for Agriculture and Agricultural Cooperatives
           ..&nbsp; All Rights Reserved.</SPAN> </P>
		   			</TD>
				</TR>
        	    <TR>
                   	<TD width=623 height="22">
            			<P align=right><SPAN class=bar>
							<?echo showDate($today);?></SPAN>
					</TD>
	  			</TR>
	 			</TBODY>
			</TABLE>
		</TD>
	  </TR>
	</TBODY>
</TABLE>

<table>
	<tr>
		<td>&nbsp; </td>
 	</tr>
 </table>



</BODY></HTML>