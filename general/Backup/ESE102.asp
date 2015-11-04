<!--#include file="GLOBAL/conn.asp"-->
<!--#include file="GLOBAL/poorbranch.js"-->
<%
if  Request.Form("BUTSUBMIT") = "Add" then	
	sql=""	
	for i = 1 to Request.Form("MAX") 
		IF Request.Form("TXTVOTE"&i) = "" THEN
			VOTE="0" 
		ELSE
			VOTE=Request.Form("TXTVOTE"&i)
		END IF
		IF Request.Form("LISTMEET"&i) = "" THEN
			MEET="00"
		ELSE
			MEET=Request.Form("LISTMEET"&i)
		END IF
		IF Request.Form("LISTCOMP"&i) = "" THEN
			COMP="00"
		ELSE
			COMP=Request.Form("LISTCOMP"&i)
		END IF
		IF Request.Form("TXTBAL"&i) = "" THEN
			BAL=0
		ELSE
			BAL=Request.Form("TXTBAL"&i)
		END IF 
		IF Request.Form("TXTWANT"&i) = "" THEN
			WANT="0"
		ELSE
			WANT=Request.Form("TXTWANT"&i)
		END IF		
		'IF Request.Form ("TXTDODATE"&i) = "" then
		'	DODATE=""
		'ELSE
			DODATE=Request.Form ("TXTDODATE"&i)
		'END IF
		sql = sql & " update poor_out_new set F_VOTE = '" & VOTE & "',"
		sql = sql & " F_MEETING = '" & MEET & "',"
		sql = sql & " F_COMPOUND = '" & COMP & "',"
		sql = sql & " BAL = " & BAL & ", "
		'if  WANT="1" then
		sql = sql & " F_WANT = '" & WANT & "', "
		'end if
		sql = sql & " DODATE = '" & DODATE & "' "
		sql = sql & " WHERE PID = " & Request.Form("TXTID"&i)  & ";"
		'sql = sql & " WHERE PNAME = '" & Request.Form("TXTNAME"&i)  & "';"	
	next	
	'Response.Write SQL
	conn.execute(sql)
end if 
%>

<SCRIPT LANGUAGE="Javascript">
<!--
function ClkExit()
{
	parent.close();
}
function ClkItem(objA,objB,objTXTVOTE,objMEET,objCOMP,objBAL,objWANTA,objWANTB,objWANTT,objDODATE) {
	objTXTVOTE.value = 0;	
	if (objA.checked==true && objB.checked==true) {		
		if (objB.checked==true) {objB.checked=false}					
	}

	if (objA.name.substring(7,8)=="A" && objA.checked==true) {
		objTXTVOTE.value = 1;
		objMEET.disabled=false; }
	else { objTXTVOTE.value = 2; 		   
		   objMEET.value="00";
		   objMEET.disabled=true;
		   objCOMP.value="00";
		   objCOMP.disabled=true;
		   objBAL.value=0;
		   objBAL.disabled=true;
		   objWANTA.checked=false;
		   objWANTB.checked=false;
		   objWANTA.disabled=true;
		   objWANTB.disabled=true;
		   objWANTT.value=0;
		   objDODATE.value="";
		   objDODATE.disabled=true;	}
	if 	(objA.checked==false && objB.checked==false)
		objTXTVOTE.value = 0;
}

function ChgLISTMEET(meetValue,objCOMP,objBAL,objWANTA,objWANTB,objWANTT,objDODATE) {
	if (meetValue == "02" ) 
		objCOMP.disabled=false;
	else {
		objCOMP.value="00";
		objCOMP.disabled=true;	 }
	if (meetValue > "00" ) {
		objBAL.value=0;
		objBAL.disabled=true;
		objWANTA.checked=false;
		objWANTB.checked=false;
		objWANTT.value=0;
		objDODATE.disabled=false;
		objDODATE.value="";
		objDODATE.focus(); }	
	if (meetValue == "02" ) {
		objBAL.value=0;
		objBAL.disabled=true;
		objWANTA.checked=false;
		objWANTB.checked=false;
		objWANTT.value=0;
		objDODATE.disabled=true;
		objDODATE.value="";	 }	
	if (meetValue == "00" ) {
		objBAL.value=0;
		objBAL.disabled=true;
		objWANTA.checked=false;
		objWANTB.checked=false;
		objWANTT.value=0;
		objDODATE.value="";
		objDODATE.disabled=true;	}	
	
}
function ChgLISTCOMP(compValue,objBAL,objWANTA,objWANTB,objWANTT,objDODATE) {	
	if (compValue=="01") {		
		objBAL.disabled=false;
		objWANTA.disabled=false;
		objWANTB.disabled=false; 	
		objWANTT.value=2;
		objDODATE.disabled=false; 
		objBAL.focus();
		//alert ("เนื่องจาก กนช.ไม่ให้มีการแก้ไขข้อมูลที่ช่องลูกหนี้ประสงค์กู้(เลือกออก ในรายที่บันทึกแล้ว) แต่สามารถเพิ่มข้อมูลในรายอื่นๆ ที่ประสงค์กู้ได้ตามปกติ ดังนั้นก่อนที่จะบันทึกข้อมูลกรุณาตรวจสอบให้ถูกต้องก่อนบันทึกทุกครั้งเนื่องจากจะไม่สามารถแก้ไขข้อมูลในช่องนี้ได้อีก กนช.2033 ");
		return;}
	else {
		objBAL.value=0;		
		objBAL.disabled=true;		
		objWANTA.checked=false;
		objWANTA.disabled=true;
		objWANTB.checked=false;
		objWANTB.disabled=true; 
		objWANTT.value=0;}
	if (compValue=="00") {		
		objDODATE.value="";
		objDODATE.disabled=true; }		
	else if (compValue!="01" ) {		
		objDODATE.disabled=false; 
		objDODATE.value="";
		objDODATE.focus(); 	}
}

function ClkWANT(objA,objB,objTXTWANT,objDODATE) {		
	objTXTWANT.value = 0;	
	if (objA.checked==true && objB.checked==true) {		
		if (objB.checked==true) {
			objB.checked=false   			
		}					
	}
	
	if (objA.name.substring(7,8)=="A" && objA.checked==true) 
		objTXTWANT.value = 1;	

	else 
		objTXTWANT.value = 2; 
	
	if 	(objA.checked==false && objB.checked==false)
		objTXTWANT.value = 2;	
			
	if (objDODATE.value=="      ") 
		objDODATE.value="";	
	
	objDODATE.disabled=false;
	objDODATE.focus();
	}
function ClkGO() {
	document.forms(0).BUTSUBMIT.value = "GO"
}
-->
</SCRIPT>
<%
'Brn=session("brn")
if Request.Form ("TXTUSER") <> "" then
	Brn=Request.Form ("TXTUSER")
end if

Check=Request.Form("CHOICE")
ampher=Request.Form("ampher")
tumbon=Request.Form("tumbon")
idcard=Request.Form("txtidcard")
idname=Request.Form("txtname")

	'Response.Write idname
	'Response.Write Amp
	if Request.Form("LISTPAGE") = "" then
		Gopage=1
	else
		Gopage=Request.Form("LISTPAGE")	
	end if		
	Pagesize=20
	Set rs=Server.CreateObject("ADODB.Recordset") 
	sql = "select PID,fname +' '+ lname as fNAME,BR_SEND,F_VOTE,F_MEETING,F_COMPOUND,BAL,F_WANT,CAT_CC,CAT_AA,CAT_TT,DODATE "
	sql = sql & " from poor_out_new " 
	If check="0" Then  ' อำเภอ		
		if ampher = "00" then					
			sql = sql & " where br_send = '" & Brn & "'"							
		elseif tumbon = "00" then
			sql = sql & " where br_send = '" & Brn & "'"			
			sql = sql & " and cat_aa = '" & ampher & "'"
		else
			sql = sql & " where br_send = '" & Brn & "'"			
			sql = sql & " and cat_aa = '" & ampher & "'"
			sql = sql & " and cat_tt = '" & tumbon & "'"
		end if		
	Elseif check="1" then 'เลขที่บัตรประชาชน
		if idcard <> "" then
			sql = sql & " where PID = '" & idcard & "' and br_send = '" & Brn & "'"
		end if
	Else 'รายชื่อ
		if idname <> "" then
			sql = sql & " where fNAME like '" &idname& "%'  "  & "  and br_send = '" & Brn & "'"
		end if
	End if 	
	'sql=sql & " AND F_SYS in ('2','3') "
	sql=sql & "and status_tg ='0'  order by fNAME,PID "

	'Response.Write sql
	'Response.End 
	rs.open sql,conn,1,3 
	if rs.EOF then 
		Response.Write "<div align=center><B><font face='Microsoft Sans Serif' size='3' style='BACKGROUND-COLOR: crimson' color=#FFFFFF>**** ไม่พบข้อมูล **** </font></b></div>"
		rs.Close
		set rs=nothing
		Response.End 	
	end if 	
	rs.movefirst
	rs.pagesize=pagesize	
	maxcount=cint(rs.pagecount)
	rs.absolutepage=gopage
	recs=1	
%>
<html>
<head>
<title>&nbsp;</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<style type="text/css">
<!--
body {  margin: 0px  0px; padding: 0px  0px}
a:link { color: #005CA2; text-decoration: none}
a:visited { color: #005CA2; text-decoration: none}
a:active { color: #0099FF; text-decoration: underline}
a:hover { color: #0099FF; text-decoration: underline}
-->
</style>

<script language="JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0  	
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");  
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

</head>
<body bgColor=White>
<form name="ESE_DBTP" method="post" action="ESE102.asp">  
	<% if Brn <> "" and not(isnull(Brn)) then %>
		<input type="hidden" name="TXTUSER" value="<%=Brn%>">
	<% end if %>	
  <table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">
    <tr> 
      <td height="2" width="6%"><font face="Microsoft Sans Serif" size="1">ESE102</font></td>
      <td height="2" width="84%"> 
        <div align="center"><font  face="Tahoma" color="#0000FF" size="2"><b>ลูกหนี้ที่มีหนี้สินนอกระบบ</b></font></div>
      </td>
      <td height="2" width="10%"> 
        <div align="right"><font face="Microsoft Sans Serif" size="1"> 
        <script language=JavaScript>
			 var now = new Date();
			var monNames = new Array("01","02","03","04","05","06","07","08","09","10","11","12");	//("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม")       
			//("January","February","March","April","May","June","July","August","September","October","November","December")
			var enyear = now.getFullYear();
			var thyear = enyear+543;
			document.write(now.getDate()+ "/" +monNames[now.getMonth()] + "/" +thyear); 
		</script>
        </font>
		</div>
    </td>
  </tr>  
  <tr> 
      <td height="2" width="6%">&nbsp;</td>
      <td height="2" width="84%"> 
        <INPUT type="hidden"  name="CHOICE" value=<%=check%>> 
         <INPUT type="hidden"  name="ampher" value=<%=ampher%>> 
         <INPUT type="hidden"  name="tumbon" value=<%=tumbon%>>         
         <INPUT type="hidden"  name="txtidcard" value=<%=idcard%>>
         <INPUT type="hidden"  name="txtname" value=<%=idname%>>
        <% 
         if check = "0" then
          if ampher <> "00" then
			Response.Write "<div align=center> <font face=Microsoft Sans Serif size=2>อำเภอ&nbsp;&nbsp;</font> "
			Response.Write "<font color=#0000FF face=Microsoft Sans Serif size=2><b> "
            Set rs6=Server.CreateObject("ADODB.Recordset")
            sql6="select mbr+sbr,cat_aa,cat_tt,cat_desc from baacmccaatt "
            sql6=sql6 & " where mbr+sbr='" & brn & "' and cat_aa = '" & ampher & "' and cat_tt = '00'"
'			response.write sql6
            rs6.Open sql6,conn,2,3 
	        Response.Write (rs6("cat_desc"))
            rs6.Close  
            set rs6 = nothing
          end if 
          if tumbon <> "00" then 
			Response.Write "</b></font><font face=Microsoft Sans Serif size=2>&nbsp;&nbsp;ตำบล&nbsp;&nbsp;</font> "
		    Response.Write "<font color=#0000FF face=Microsoft Sans Serif size=2><b> "
            Set rs6=Server.CreateObject("ADODB.Recordset")
            sql6="select mbr+sbr,cat_aa,cat_tt,cat_desc from baacmccaatt "
            sql6=sql6 & " where mbr+sbr='" & brn & "' and cat_aa = '" & ampher & "'"
            sql6=sql6 & " and cat_tt = '" & tumbon & "' "
            rs6.Open sql6,conn,2,3 
	        Response.Write (rs6("cat_desc"))
            rs6.Close  
            set rs6 = nothing
          end if 
         end if %>
      </td>
      <td height="2" ALIGN=RIGHT width="10%">&nbsp;<font color="#000000" face="Microsoft Sans Serif" size="2">หน้าที่&nbsp;<%=Gopage%>/<%=Maxcount%></FONT></td>
  </tr>
</table>

  	<div align="center">

  <table width="902" border="1" cellspacing="0" style="border-collapse: collapse">
    <tr bgcolor="#60AFAF"> 
      <td rowspan="3" bgcolor="#FF66FF" width="30"> 
        <div align="center">
	  <font face="Tahoma" style="font-size: 9pt"><B>ลำดับที่</b></font></div>
	  </td>
      <td rowspan="3" bgcolor="#FF66FF" width="88"> 
        <div align="center">
		 <font face="Tahoma" style="font-size: 9pt"><B>เลขที่บัตร<BR>ประชาชน</B></font></div>
	  </td>
      <td rowspan="3" width="10%" bgcolor="#FF66FF"> 
        <div align="center">
		<font face="Tahoma" style="font-size: 9pt"><B>ชื่อ- สกุล</B></font></div>
      </td>
      <td colspan="8" height="2" bgcolor="#FF66FF"> 
        <div align="center">
		<font face="Tahoma" style="font-size: 9pt"><B>สถานะการติดตาม</B></font></div>
      </td>
    </tr>
    <tr> 
      <td colspan="2" bgcolor="#FF99FF"> 
        <div align="center">
		<font face="Tahoma" style="font-size: 9pt"><B>ประชาคม</B></font></div>
      </td>
      <td rowspan="2" bgcolor="#FF99FF" width="217"> 
        <div align="center">
		<font face="Tahoma" style="font-size: 9pt"><B>ประชุม/พบลูกค้า</B></font></div>
      </td>
      <td colspan="5" bgcolor="#FF99FF"> 
        <div align="center">
		<font face="Tahoma" style="font-size: 9pt"><B>การเจรจาประนอมหนี้</B></font></div>
      </td>
    </tr>
    <tr> 
      <td bgcolor="#FFCCFF" height="2" width="26"> 
        <div align="center">
		<font face="Tahoma" style="font-size: 8pt"><B>ผ่าน</B></font></div>
      </td>
      <td bgcolor="#FFCCFF" height="2" width="23"> 
        <div align="center">
		<font face="Tahoma" style="font-size: 8pt"><B>ไม่<BR>ผ่าน</B></font></div>
      </td>
      <td bgcolor="#FFCCFF" height="2" width="232"> 
        <div align="center">
		<font face="Tahoma" style="font-size: 7pt"><B>ผลการเจรจา</B></font></div>
      </td>      
      <td bgcolor="#FFCCFF" height="2" width="73"> 
        <div align="center">
		<font face="Tahoma" style="font-size: 7pt"><B>จำนวนหนี้<BR>คงเหลือ</B></font></div>
      </td>
            <td bgcolor="#FFCCFF" height="2" width="43"> 
        <div align="center">
		<font face="Tahoma" style="font-size: 7pt; font-weight: 700">ลูกหนี้<BR>ประสงค์กู้</font></div>
      </td>
            <td bgcolor="#FFCCFF" height="2" width="45"> 
        <div align="center">
		<font face="Tahoma" style="font-size: 7pt"><B>ลูกหนี้ไม่ประสงค์กู้</B></font></div>
      </td>

      <td bgcolor="#FFCCFF" height="2" width="65"> 
        <div align="center">
		<font face="Tahoma" style="font-size: 7pt"><B>วันที่ทำ น.2<BR>(ววดดปป)</B></font></div>
      </td>
    </tr>
  
    <%   
	i = 0	
    Do while not rs.EOF and Recs <= rs.Pagesize 
	  i = i +1   
	  
	  %>
    <tr bgcolor="#FFFFDB"> 
      <td height="7" bgcolor="#FFCCCC" width="30"> 
        <div align="center"> <font face="Microsoft Sans Serif" size="2"><%=((gopage-1)*pagesize)+recs%></font></div>
      </td>
      <td height="7" bgcolor="#FFCCCC" width="88"> 
        <div align="left"> 
          <INPUT type="text"  name="TXTID<%=i%>" value="<%=rs("PID")%>" readonly 
        style="BORDER-LEFT: thin; BORDER-TOP-STYLE: none; BORDER-BOTTOM: medium none; BORDER-RIGHT-STYLE: none; BACKGROUND-COLOR: #FFCCCC" maxlength="14" size="14">
        </div>
      </td>
      <td height="7" bgcolor="#FFCCCC"> 
        <div align="left"> <font face="Microsoft Sans Serif" size="2">&nbsp;<%=rs("fNAME")%></font></div>
      </td>
      <td height="7" bgcolor="#FFCCCC" width="26"> 
        <div align="center"> 
          <% if rs("F_VOTE") = "0" or isnull(rs("F_vote")) then 
			CHKVOTEA=""
			CHKVOTEB=""
			FMEETING="disabled"
		   elseif rs("F_VOTE") = "1" then 
			CHKVOTEA="checked"
			CHKVOTEB=""
			FMEETING=""
		   else
			CHKVOTEA=""
			CHKVOTEB="checked"
			FMEETING=""
		end if	%>
<input type="checkbox" name="CHKVOTEA<%=i%>"  <%=CHKVOTEA%> onclick="ClkItem(this,document.forms(0).CHKVOTEB<%=i%>,document.forms(0).TXTVOTE<%=i%>,document.forms(0).LISTMEET<%=i%>,document.forms(0).LISTCOMP<%=i%>,document.forms(0).TXTBAL<%=i%>,document.forms(0).CHKWANTA<%=i%>,document.forms(0).CHKWANTB<%=i%>,document.forms(0).TXTWANT<%=i%>,document.forms(0).TXTDODATE<%=i%>)" value="ON">

        </div>
      </td>
      <td height="7" bgcolor="#FFCCCC" width="23"> 
        <div align="center"> 
          <input type="checkbox" name="CHKVOTEB<%=i%>"  <%=CHKVOTEB%> onclick="ClkItem(this,document.forms(0).CHKVOTEA<%=i%>,document.forms(0).TXTVOTE<%=i%>,document.forms(0).LISTMEET<%=i%>,document.forms(0).LISTCOMP<%=i%>,document.forms(0).TXTBAL<%=i%>,document.forms(0).CHKWANTA<%=i%>,document.forms(0).CHKWANTB<%=i%>,document.forms(0).TXTWANT<%=i%>,document.forms(0).TXTDODATE<%=i%>)">
        </div>
        <INPUT TYPE=hidden name=TXTVOTE<%=i%> VALUE=<%=rs("F_VOTE")%>>
      </td>
      <td height="7" align=center bgcolor="#FFCCCC" width="217"> 
        <% if rs("F_VOTE") = "0" or rs("F_VOTE") = "2"  then
			FMEETING="disabled"
		else
			FMEETING=""
		end if 	 %>
        <div align="center"> 
          <select name="LISTMEET<%=i%>" <%=FMEETING%> onchange="ChgLISTMEET(this.value,document.forms(0).LISTCOMP<%=i%>,document.forms(0).TXTBAL<%=i%>,document.forms(0).CHKWANTA<%=i%>,document.forms(0).CHKWANTB<%=i%>,document.forms(0).TXTWANT<%=i%>,document.forms(0).TXTDODATE<%=i%>)">
            <% 		
        if rs("F_MEETING") = "00" then %>
            <option value="00" SELECTED>ยังไม่ดำเนินการ 
            <% ELSE %>
            <option value="00" >ยังไม่ดำเนินการ 
            <% END IF 
		if rs("F_MEETING") = "01" then %>
            <option value="01" SELECTED>หนี้ที่เกิดจากเหตุสุดวิสัย 
            <% ELSE %>
            <option value="01">หนี้ที่เกิดจากเหตุสุดวิสัย 
            <% END IF 
		if rs("F_MEETING") = "02" then %>
            <option value="02" SELECTED>หนี้จากการประกอบอาชีพ 
            <% ELSE %>
            <option value="02">หนี้จากการประกอบอาชีพ 
            <% END IF 
		if rs("F_MEETING") = "03" then %>
            <option value="03" SELECTED>ไม่มีวินัยทางการเงิน 
            <% ELSE %>
            <option value="03">ไม่มีวินัยทางการเงิน 
            <% END IF           
        if rs("F_MEETING") = "04" then %>
            <option value="04" SELECTED>ไม่ต้องการความช่วยเหลือ 
            <% ELSE %>
            <option value="04">ไม่ต้องการความช่วยเหลือ 
            <% END IF            
		if rs("F_MEETING") = "05" then %>
            <option value="05" SELECTED>ไม่เข้าร่วมประชุม 
            <% ELSE %>
            <option value="05">ไม่มาประชุม 
            <% END IF  %>
          </select>
        </div>
      </td>
      <td height="7" align=center bgcolor="#FFCCCC" width="232"> 
        <%		
		IF rs("F_MEETING") = "02" THEN			
			FCOMPOUND=""		
		else			
			FCOMPOUND="disabled"
		END IF
      %>
        <div align="center"> 
          <select name="LISTCOMP<%=i%>" <%=FCOMPOUND%> onchange="ChgLISTCOMP(this.value,document.forms(0).TXTBAL<%=i%>,document.forms(0).CHKWANTA<%=i%>,document.forms(0).CHKWANTB<%=i%>,document.forms(0).TXTWANT<%=i%>,document.forms(0).TXTDODATE<%=i%>)">
            <% IF rs("F_COMPOUND") = "00" then %>
            <option value="00" SELECTED>ยังไม่ดำเนินการ 
            <% ELSE %>
            <option value="00">ยังไม่ดำเนินการ 
            <% END IF
		IF rs("F_COMPOUND") = "01" then %>
            <option value="01" SELECTED >ผลสำเร็จ 
            <% ELSE %>
            <option value="01" disabled>ผลสำเร็จ 
            <% END IF 
        IF rs("F_COMPOUND") = "02" then %>
            <option value="02" SELECTED>ลูกหนี้ไม่ดำเนินการต่อ 
            <% ELSE %>
            <option value="02">ลูกหนี้ไม่ดำเนินการต่อ 
            <% END IF
		IF rs("F_COMPOUND") = "03" then %>
            <option value="03" SELECTED>ไม่สามารถตกลงกับลูกหนี้ได้ 
            <% ELSE %>
            <option value="03">ไม่สามารถตกลงกับลูกหนี้ได้ 
            <% END IF 
        IF rs("F_COMPOUND") = "04" then %>
            <option value="04" SELECTED>ฝ่ายใดฝ่ายหนึ่งไม่มา 
            <% ELSE %>
            <option value="04">ฝ่ายใดฝ่ายหนึ่งไม่มา 
            <% END IF %>
          </select>
        </div>
      </td>
      <%
       if rs("F_WANT") = 0 then
			CHKWANTA=""
			CHKWANTB=""
		elseif rs("F_WANT") = 1 then
		 	CHKWANTA="checked"
			'CHKWANTB=""
		else
			'CHKWANTA=""
			CHKWANTB="checked"
		end if
		if rs("F_COMPOUND") = "01" THEN
			FWANT=""
			FBAL=""
		ELSE
			FWANT="disabled"
			FBAL="disabled"
		END IF
		if rs("F_COMPOUND") <> "00" OR rs("F_MEETING") <> "00" THEN
			disDODATE=""
		ELSE
			disDODATE="disabled"
		END IF		
        %>
      <td height="7" align="center" valign="middle" bgcolor="#FFCCCC" width="73"> 
        <div align="CENTER"> 
          <input type="text" name="TXTBAL<%=i%>" <%=FBAL%> value="<%=rs("bal")%>" style="WIDTH: 66;TEXT-ALIGN: right; height:22" maxlength="10" size="10" >
        </div>
      </td>
      <td height="7" align=center bgcolor="#FFCCCC" width="43"> 
          <INPUT type="hidden" id=TXTWANT<%=i%> name=TXTWANT<%=i%>  value="<%=rs("F_WANT")%>">
          
		  <input type="checkbox"  <%=FWANT%> name="CHKWANTA<%=i%>" <%=CHKWANTA%> value="1" onclick="ClkWANT(this,document.forms(0).CHKWANTB<%=i%>,document.forms(0).TXTWANT<%=i%>,document.forms(0).TXTDODATE<%=i%>)">
          </td><td align=center bgcolor="#FFCCCC" width="45">
		  <input type="checkbox"  <%=FWANT%> name="CHKWANTB<%=i%>" <%=CHKWANTB%> value="2" onClick="ClkWANT(this,document.forms(0).CHKWANTA<%=i%>,document.forms(0).TXTWANT<%=i%>,document.forms(0).TXTDODATE<%=i%>)">
      </td>
      <td height="7" bgcolor="#FFCCCC" width="65"> 
        <div align="center"> 
          <input type="TEXT"  <%=disDODATE%> name="TXTDODATE<%=i%>" value="<%=rs("DODATE")%>" style="WIDTH: 62;TEXT-ALIGN: CENTER; height:22" maxlength="6" size="6">
        </div>
      </td>
    </tr>
    <%
		recs=recs+1
		rs.movenext 
		loop
		rs.close
		Set rs=nothing
		Set conn=nothing
     %>
  </table>
 	</div>
<!--INPUT type="TEXT" name=MAX value=<%=(((gopage-1)*pagesize)+recs)-1%>-->
<INPUT type="HIDDEN" name=MAX value=<%=i%>>
<%
pad=""
scriptname=request.servervariables("script_name")
%>
  <div align="center"> <br>
    <font color="#FF0000" face="Microsoft Sans Serif" size="2"> 
    <input type="hidden" name="BUTSUBMIT" value="Add">
    <input type="submit" value="บันทึกข้อมูล">
    </font>
    <input type="reset" name="BUTEXIT"value="จบการทำงาน" onclick="ClkExit();">
	<BR><b>- - - - - - - - - - - - - - - - - - - -</b><BR>
    <font color=#000099 face="Microsoft Sans Serif" size="2">หน้าที่ 
    <select name=LISTPAGE>
      <% for n =1 to maxcount 	 
	 if n=int(gopage) then %>
      <option value="<%=n%>" selected><%=n%> 
      <% else %>
      <option value="<%=n%>"><%=n%>
      <% end if 
		 next %>
    </select>    
    จากทั้งหมด <b><%=maxcount%></b>&nbsp;หน้า</font>
    <input type="submit" value="GO" name="GO" onClick="ClkGO();"></div>
</form>
<BR>
</body>
</html>
