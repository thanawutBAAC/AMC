<?include ("checkuser.php");?>
<html>
<head>
<title>�к������� ʡ�.</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style_calendar.css" rel="stylesheet" type="text/css">
</head>
<script language="javascript">				
function listData(id){			
	if(id!=""){		
		var objData =eval("arrData["+id+"]");
		var strOpt = "";
		
		document.forms(0).lis_province.innerHTML ="";
		//document.forms(0).branch.innerHTML ="";
		if (id==0) {			
			addOption("------�ѧ��Ѵ------",""); }
		else {	
			addOption("------�ѧ��Ѵ------","");
			for(x=0;x<objData.length;x++){
				addOption(objData[x],objData[x].substring(0,2));
			}		
		}
		//var objData =eval("arrBrn["+id+"]");
		//addOptionBrn("------�����------","");
	}
}

function addOption(text,value){
	var oOption = document.createElement("OPTION");
	document.forms(0).lis_province.options.add(oOption);
	oOption.innerText =text.substring(2,text.length);
	oOption.value = value;
}	
	
/*-----------------------------------------------------------------------*/
function listBrn(id){
	if(id!=""){	
		var objBrn =eval("arrBrn["+id+"]");
		var strOpt = "";
	
		document.forms(0).branch.innerHTML ="";
		
			addOptionBrn("------�����------","");
			for(x=0;x<objBrn.length;x++){
				addOptionBrn(objBrn[x],objBrn[x].substring(0,4));
			}
	}
	else {
		document.forms(0).branch.innerHTML ="";
		addOptionBrn("------�����------","");		
	}
}
	
function addOptionBrn(text,value){
	var oOption = document.createElement("OPTION");
	document.forms(0).branch.options.add(oOption);
	oOption.innerText =text.substring(4,text.length);
	oOption.value = value;
}	

function listDiv(id){		
var id1;
	if(id!=""){	
		id1=id;
		id = 0;		
		var objDiv =eval("arrDiv["+id+"]");
		var strOpt = "";	
		document.forms(0).div.innerHTML ="";	
		for(x=0;x<objDiv.length;x++){		 
			addOptionDiv(objDiv[x],objDiv[x].substring(0,1));
		}	
		document.forms(0).div.value= id1;
	}
}
function addOptionDiv(text,value){
	var oOption = document.createElement("OPTION");
	document.forms(0).div.options.add(oOption);
	oOption.innerText =text.substring(1,text.length);
	oOption.value = value;
}	
</script>
<script language="JavaScript" src="BaacAjax.js"></script>
<script language="JavaScript" >
function List_prov(){
	var dlb_prov = document.getElementById("lb_prov");  
//	var dshow_br = document.getElementById("show_br"); 
//	var dshow_tumbon = document.getElementById("show_tumbon"); 

if (dlb_prov.value=="0")
{
//show_br.innerHTML = "";
url="Branch_committee.php?prov="+dlb_prov.value
//alert(url)
}


	//alert(dlb_prov.value) �ʴ��ѧ��Ѵ
	url="Branch_committee.php?prov="+dlb_prov.value+"&type=prov"
	//alert(url)
	//document.write(url)
	Ajax_PostData(handleStateChange);
}
	

function handleStateChange(){	

var resultarea
 //resultarea= document.getElementById('result');

 if (xmlHttp.readyState <= 3){
  //resultarea.innerHTML = "���ѧ��Ŵ...";
 }
	 if(xmlHttp.readyState==4){ 
	//resultarea.innerHTML = "";
	 if(xmlHttp.status==200) 
	    splitData();                 
	 }
 }

function splitData()	{
var dshow_br = document.getElementById("show_br"); 
//var dshow_tumbon = document.getElementById("show_tumbon"); 

var results = xmlHttp.responseText;
//alert(results);
dshow_br.innerHTML = "";
//dshow_tumbon.innerHTML = "";

dshow_br.innerHTML =results;
}



 function toggleview(objElement)
{

 
	if(objElement.style.display == "none"){
	objElement.style.display = ""
	}else{
	objElement.style.display = "none"
	}
}
function List_pawn(){
	var dlb_pawn = document.getElementById("pawn"); 
	var dlb_datadate = document.getElementById("datadate"); 

	url="Pawn_Data.php?pawn="+dlb_pawn.value+"&datadate="+dlb_datadate.value
	//document.write(url)
	Ajax_PostData(handleStateChange11);
	
}
	

function handleStateChange11(){	
var resultarea
 //resultarea= document.getElementById('result');

 if (xmlHttp.readyState <= 3){
  //resultarea.innerHTML = "���ѧ��Ŵ...";
 }
	 if(xmlHttp.readyState==4){
	//resultarea.innerHTML = "";
	 if(xmlHttp.status==200) 
	    splitData11();                 
	 }
 }

function splitData11()	{
var dshow_pawn = document.getElementById("show_pawn"); 

var results = xmlHttp.responseText;
//alert(results);
dshow_pawn.innerHTML = "";
dshow_pawn.innerHTML =results;

}

function List_Subpawn(){
	var dlb_pawn = document.getElementById("pawn"); 
	var dlb_subpawn = document.getElementById("lb_subpawn"); 
	var dlb_datadate = document.getElementById("datadate"); 
	url="Subpawn_Data.php?pawn="+dlb_pawn.value+"&subpawn="+dlb_subpawn.value+"&datadate="+dlb_datadate.value
	//document.write(url)
	Ajax_PostData(handleStateChange12);
	
}
	

function handleStateChange12(){	
var resultarea
 //resultarea= document.getElementById('result');

 if (xmlHttp.readyState <= 3){
  //resultarea.innerHTML = "���ѧ��Ŵ...";
 }
	 if(xmlHttp.readyState==4){
	//resultarea.innerHTML = "";
	 if(xmlHttp.status==200) 
	    splitData12();                 
	 }
 }

function splitData12()	{
var dshow_subpawn = document.getElementById("show_subpawn"); 

var results = xmlHttp.responseText;
//alert(results);
dshow_subpawn.innerHTML = "";
dshow_subpawn.innerHTML =results;

}

function show_pawn(num,page){
	var dlb_prov = document.getElementById("lb_prov"); //�Ҥ
	var dlb_branch = document.getElementById("lb_branch"); //ʹ�.  
	var dlb_datadate = document.getElementById("datadate");
	var dlb_pawn = document.getElementById("pawn"); 
	var dlb_subpawn = document.getElementById("lb_subpawn"); 
	var dlb_subpawn1 = document.getElementById("lb_subpawn1");
	//alert(num)
	var a= 0;
	var p ="00";
	var d = ","
	var dlb_check = new Array(num);
	var check = new Array(num);
	for(var i=0;i< num;i++){ 
	a=a+1;
	dlb_check[i] = document.getElementById("check"+a);
	//alert(dlb_check[i].value)
	}
	
	for(var i=0;i< num;i++){ 
	if(dlb_check[i].checked){ check[i] = dlb_check[i].value }
	else { check[i] = "00"; }
	//alert(check[i])
	}
	
	for(var i=0;i< num;i++){ 
	p = p + d + check[i]  
	}

	
	//if(dlb_check1.checked){ check11 = dlb_check1.value }

	
	if (dlb_prov.value=="00" )
	{
	alert("��س����͡�дѺ������")
	dlb_prov.focus()
	return false
	}

	if(dlb_pawn.value == "00"){
	alert("��س����͡�ç����Ѻ�ӹ�")
	dlb_pawn.focus()
	return false
	}
	
	if(dlb_subpawn.value == "00"){
	alert("��س����͡�������ӹ�")
	dlb_subpawn.focus()
	return false
	}

	if (dlb_branch.value !="00")
	{
	var dlb_tumbon = document.getElementById("lb_tumbon"); //�Ң� 
	var q_tumbon="&tumbon="+dlb_tumbon.value
	}else
	q_tumbon="&tumbon=000"
	
url="Pawn_Cust_Showdata.php?prov="+dlb_prov.value+"&branch="+dlb_branch.value+q_tumbon+"&datadate="+dlb_datadate.value+"&pawn="+dlb_pawn.value+"&subpawn="+dlb_subpawn.value+"&subpawn1="+dlb_subpawn1.value+"&p="+p+"&num="+num+"&page="+page
//document.write(url)
//alert(url)
Ajax_PostData(handleStateChange2)
}

function handleStateChange2(){	
	var resultarea
	resultarea= document.getElementById('result');

 if (xmlHttp.readyState <= 3){
resultarea.innerHTML = "���ѧ��Ŵ...";
 }
	 if(xmlHttp.readyState==4){
	resultarea.innerHTML = "";
	 if(xmlHttp.status==200) 
		var dshow_test = document.getElementById("show_test"); 
		var results = xmlHttp.responseText;
		//alert(results);
		dshow_test.innerHTML = "";
		dshow_test.innerHTML =results;
	 }
 }
</script>

<script language="javascript">
function chkDigitPin(pin) {	
	var sum = (pin.charAt(0) * 13)+(pin.charAt(1) * 12)+(pin.charAt(2) * 11)+
						(pin.charAt(3) * 10)+(pin.charAt(4) * 9)+(pin.charAt(5) * 8)+
						(pin.charAt(6) * 7)+(pin.charAt(7) * 6)+(pin.charAt(8) * 5)+
						(pin.charAt(9) * 4)+(pin.charAt(10) * 3)+(pin.charAt(11) * 2);
	var digit = sum % 11;
	if (digit == 1) {digit = 0;}
	else if (digit == 0) {digit = 1;}
	else {digit = 11 - digit};
	if (digit != pin.charAt(12)) {
		return false;		
	}
	return true;
}

</script>
<script language="javascript" type="text/javascript">
<!--



function verify() {

	/*    if(!checkID(document.form1.txt_user_id.value))
       {
	   			alert('��Ǩ�ͺ���ʻ�ЪҪ����١��ͧ'); frm.txt_user_id.focus(); return false;
		}
	*/

		if(form1.lb_prov.value == "00" ) { alert("���͡�շ���ͧ��úѹ�֡������"); form1.lb_prov.focus(); return false; }
		 if(form1.txt_user_id.value.length <13 ) { alert("��Ǩ�ͺ�Ţ���ѵû�Шӵ�ǻ�ЪҪ����ú 13 ��ѡ"); form1.txt_user_id.focus(); return false; }
		 if(!chkDigitPin(form1.txt_user_id.value)){ alert("�Ţ�ѵû�Шӵ�ǻ�ЪҪ����١��ͧ"); form1.txt_user_id.focus(); return false;} 
		if(form1.txt_name.value == "" ) { alert("��Ǩ�ͺ�������١��ͧ"); form1.txt_name.focus(); return false;}
		if(form1.txt_lsname.value == "" ) { alert("��Ǩ�ͺ���ʡ�����١��ͧ"); form1.txt_lsname.focus(); return false; }
		if(form1.txt_birthday.value == "" ) { alert("��Ǩ�ͺ �ѹ/��͹/���Դ ���١��ͧ"); form1.txt_birthday.focus(); return false; } 
		if(form1.txt_phone.value.length < 9  ) { alert("�к����������Ţ���Ѿ�����١��ͧ"); form1.txt_phone.focus(); return false; }
		return true;
}




function chkEdu(x){
	if(x<"3"){
		document.forms[0].list_degree.disabled=true;
	}else{
		document.forms[0].list_degree.disabled=false;
	}
}
function bodyOnLoad() {
	document.forms[0].txt_CommitteeSocial.disabled=true;
	document.forms[0].list_degree.disabled=true;
}

function chkposition(x){
	if(x<"02"){
		document.forms[0].rdo_CommitteeAMC[0].disabled=false;
		document.forms[0].rdo_CommitteeAMC[1].disabled=false;
	}else{
		document.forms[0].rdo_CommitteeAMC[0].disabled=true;
		document.forms[0].rdo_CommitteeAMC[1].disabled=true;
	}
}

 function check_number() {
e_k=event.keyCode
//if (((e_k < 48) || (e_k > 57)) && e_k != 46 ) {
if (e_k != 13 && (e_k < 46) || (e_k > 57) || (e_k==47)) {
event.returnValue = false;
alert("��ͧ�繵���Ţ��ҹ��... \n��سҵ�Ǩ�ͺ�����Ţͧ��ҹ�ա����...");
}
}

 function check_text() {
e_k=event.keyCode
//if (((e_k < 48) || (e_k > 57)) && e_k != 46 ) {
if ((e_k>=33 && e_k<=64) || (e_k>=91 && e_k<=95) || (e_k >=123 && e_k<=160) || (e_k>=239 && e_k<= 251) ) {
event.returnValue = false;
alert("��͹��������������ѧ�����ҹ��... \n��سҵ�Ǩ�ͺ�����Ţͧ��ҹ�ա����...");
}
}


//-->
</script>

<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" OnLoad="bodyOnLoad();">
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="50" align="center" valign="middle"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="29" valign="bottom" class="boxleft50"><br>
            <br>
            <img src="images/head_committee.jpg" width="330" height="23"></td>
          <td align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"></span></td>
        </tr>
      </table>
      <table width="98%" border="0" cellpadding="0" cellspacing="0">
              <tr> 
                <td align="center" valign="top" ><form name="form1" method="get" action="committee_insertinto.php"  onsubmit=" return verify(); ">
                    
              <table style="margin: 7px 0px 0px 0px" cellSpacing="1" cellPadding="0" width="600" border="0" class=font1 bgcolor=white>
                <tr align=center bgcolor="#92AED1" class=font1 style="color:#333333;"> 
                  <td height="25" colspan=3 align=left><b>&nbsp; &nbsp;�ѹ�֡�����źؤ�ҡ� 
                    (��С������) </b></td>
                </tr>
                <tr align="left" bgcolor="#BBD0E1" style="color:#333333"> 
                  <td height="20" colspan="3" class="boxleft30"> 
                    <? 
							include ("../lib/ms_database.php");

						echo '- ʡ�. �ѧ��Ѵ '.$amcname;
						if($USER_ID<>""){
							$sql=" SELECT A.AMCCode, A.CommitteeGroup,A.Committeeoccasion,A.CommitteeYear,A.committeeID, ";
							$sql.=" A.CommitteeType,A.CommitteeCategory, C.CommitteeName,A.CommitteeStatus,B.MemberName, ";
							$sql.=" B.MemberLastname,B.MemberBirthday,B.MemberAddress,B.MemberPhone, A.CommitteeAMC, ";
							$sql.=" B.MemberEducation,B.MemberDegree,A.CommitteeSocial, B.MemberOccu,B.MemberOccuSecond, ";
							$sql.=" B.MemberRemark  ";
							$sql.=" FROM CommitteeGroup A  ";
							$sql.=" LEFT JOIN ( ";
							$sql.=" SELECT * FROM AMCCustomer ";
							$sql.=" )AS B ON A.CommitteeID=B.MemberID  ";
							$sql.=" LEFT JOIN ( ";
							$sql.=" SELECT * FROM CommitteeCode ";
							$sql.=" )AS C ON A.CommitteeType=C.CommitteeType  ";
							$sql.=" WHERE A.Committeegroup ='$committeegroup'  AND A.CommitteeID='$USER_ID' ";
							//echo $sql;
							$exsql=mssql_query($sql);
							$data=mssql_fetch_row($exsql);

						
						
						}
						
						?>
                  </td>
                </tr>
                <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                  <td height="20" align=center>1.</td>
                  <td height="20" align="left" class="boxleft5">�շ��ѹ�֡ : 
                  </td>
                  <td align="left" class="boxleft5"> <select name="lb_prov"  onchange="  List_prov();">
                      <?
							$Occu=array("","���ɵá�","�ӡ�ä�Ң��","�Ѻ�Ҫ���","����") ;/// �Ҫվ
									echo '<option value=00>���͡��</option>';
									for($a=(date(Y)+543);$a>=((date(Y)+543)-5);$a--)
									{
										echo '<option value='.$a.'>'.$a.'</option>';
									}
							
							?>
                    </select> </td>
                </tr>
                <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                  <td height="20" align=center>2.</td>
                  <td height="20" align="left" class="boxleft5">���˹� : </td>
                  <td align="left" class="boxleft5"> 
                    <input type="hidden" name="hdd_CommitteeCategory" value="00">
                    <span id="show_br">
                    <select name="select">
					<option>���͡���˹�</option>
                    </select>
                    </span> </td>
                </tr>
                <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                  <td height="20" align=center bgcolor="#F0F0F0">3. </td>
                  <td height="20" align="left" class="boxleft5">��ô�ç���˹� 
                    : </td>
                  <td align="left" class="boxleft5"><table width="200" border="0" cellpadding="0" cellspacing="0" class="font1">
                      <tr class="boxleft5" style="color:#666666;"> 
                        <td width="50" align="center">���з�� :</td>
                        <td width="37"><select name="list_Committeeoccasion" style="COLOR : #FF0000;FONT-WEIGHT: bold;">
                            <option value="1">1</option>
                            <option value="2">2</option>
                          </select></td>
                        <td width="37" align="right">�շ�� :</td>
                        <td width="66" class="boxleft5"><select name="list_CommitteeYear" style="COLOR : #FF0000;FONT-WEIGHT: bold;">
                            <option value="1">1</option>
                            <option value="2">2</option>
                          </select></td>
                      </tr>
                    </table></td>
                </tr>
                <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                  <td width="4%" height="20" align=center bgcolor="#F0F0F0">4. 
                  </td>
                  <td width="22%" height="20" align="left" class="boxleft5">�����Ţ�ѵû�Шӵ�ǻ�ЪҪ� 
                    : </td>
                  <td width="69%" align="left" class="boxleft5"><input name="txt_user_id" type="text" class="inputtypePersonnel"  onKeyPress=check_number(); value="<?echo $data[4]?>" size="13" maxlength="13"></td>
                </tr>
                <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                  <td height="20" align=center bgcolor="#F0F0F0">5. </td>
                  <td height="20" align="left" class="boxleft5">���� : </td>
                  <td align="left" class="boxleft5"><input name="txt_name" type="text" class="inputtypePersonnel"   onKeyPress=check_text(); value="<?echo $data[9]?>" ></td>
                </tr>
                <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                  <td height="21" align=center>6.</td>
                  <td height="21" align="left" class="boxleft5">���ʡ�� : </td>
                  <td align="left" class="boxleft5"><input name="txt_lsname" type="text" class="inputtypePersonnel"  onKeyPress=check_text(); value="<?echo $data[10]?>"></td>
                </tr>
                <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                  <td height="20" align=center>7.</td>
                  <td height="20" align="left" class="boxleft5">�ѹ/��͹/���Դ 
                    : </td>
                  <td align="left" class="boxleft5"> 
                    <?
						 $data[11]=trim($data[11]);
						 //echo substr($committeebrithday,2,strpos($committeebrithday,"/"));
						 //echo strpos($committeebrithday,"/");
						 substr($committeebrithday,strpos($committeebrithday,"/")+1,2);
						?>
                    �ѹ 
                    <select name="ddate" class="datetime">
                      <?
									for($i=1;$i<=31;$i++)
									{
										echo '<option value='.$i.'>'.$i.'</option>';
									}
							
							?>
                    </select> <script language=JAVAScript> 
								for(i=0;i<=(document.form1.ddate.length-1);i++) {
									if(document.form1.ddate.options[i].value=="<?echo substr($data[11],0,strpos($data[11],"/"));?>") {
										document.form1.ddate.options[i].selected = true;
										break;
									}
								}
							</script>
                    ��͹ 
                    <select name="dmonth" class="datemonth">
                      <option value="01">���Ҥ�</option>
                      <option value="02">����Ҿѹ��</option>
                      <option value="03">�չҤ�</option>
                      <option value="04">����¹</option>
                      <option value="05">����Ҥ�</option>
                      <option value="06">�Զع�¹</option>
                      <option value="07">�á�Ҥ�</option>
                      <option value="08">�ԧ�Ҥ�</option>
                      <option value="09">�ѹ��¹</option>
                      <option value="10">���Ҥ�</option>
                      <option value="11">��Ȩԡ�¹</option>
                      <option value="12">�ѹ�Ҥ�</option>
                    </select> <script language=JAVAScript> 
								for(i=0;i<=(document.form1.dmonth.length-1);i++) {
									if(document.form1.dmonth.options[i].value=="<?echo substr($data[11],strpos($data[11],"/")+1,2);?>") {
										document.form1.dmonth.options[i].selected = true;
										break;
									}
								}
							</script>
                    �.�. 
                    <select name="dyear" class="dateyear">
                      <?
									for($a=(date(Y)+543);$a>=((date(Y)+543)-80);$a--)
									{
										echo '<option value='.$a.'>'.$a.'</option>';
									}
							
							?>
                    </select> <script language=JAVAScript> 
								for(i=0;i<=(document.form1.dyear.length-1);i++) {
									if(document.form1.dyear.options[i].value=="<?echo substr($data[11],-4)?>") {
										document.form1.dyear.options[i].selected = true;
										break;
									}
								}
							</script> </td>
                </tr>
                <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                  <td height="20" align=center>8.</td>
                  <td height="20" align="left" class="boxleft5">�����Ţ���Ѿ�� 
                    : </td>
                  <td align="left" class="boxleft5"><input name="txt_phone" type="text" class="inputtypePersonnel" onKeyPress=check_number(); value="<?echo $data[13]?>" size="10" maxlength="10"></td>
                <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                  <td height="20" align=center>9.</td>
                  <td height="20" align="left" class="boxleft5">����֡�� : </td>
                  <td align="left" class="boxleft5"><select name="list_education" onChange="chkEdu(this.value);">
                      <option value="1">����Թ��ж�������º���</option>
                      <option value="2">�Ѹ���֡��</option>
                      <option value="3">͹ػ�ԭ��</option>
                      <option value="4">��ԭ�ҵ��</option>
                      <option value="5">�٧���һ�ԭ�ҵ��</option>
                    </select></td>
                </tr>
                <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                  <td height="20" align=left> &nbsp;&nbsp;&nbsp;9.1</td>
                  <td height="20" align="left" class="boxleft5">�زԡ���֡�� : 
                  </td>
                  <td align="left" class="boxleft5"> <select name="list_degree" >
                      <option value="1">��õ�Ҵ</option>
                      <option value="2">�ѭ��</option>
                      <option value="3">��������С�èѴ���</option>
                      <option value="4">�ɵ���ʵ��</option>
                      <option value="5">�ѧ����ʵ��</option>
                      <option value="6">����</option>
                    </select></td>
                </tr>
                <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                  <td height="20" align=center>10.</td>
                  <td height="20" align="left" class="boxleft5">�� ��.ʡ� ������� 
                    :</td>
                  <td align="left" class="boxleft5"><input type="radio" name="rdo_CommitteeAMC" value="1">
                    �� 
                    <input type="radio" name="rdo_CommitteeAMC" value="0"  checked> 
                    <span class="txtred">�����</span></td>
                </tr>
                <script language="javascript">
						<!--
							if("<?=$chk01?>"=="Y") {
								chkposition('01');
							}else{
								chkposition('02');
							}
						//-->
					  </script>
                <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                  <td height="20" align=center>11.</td>
                  <td height="20" align="left" class="boxleft5">ʶҹзҧ�ѧ�� 
                    : </td>
                  <td align="left" class="boxleft5"><table width="55%" border="0" cellpadding="0" cellspacing="0" class="font1">
                      <tr style="color:#666666;"> 
                        <td width="25%" height="25" align="left" valign="middle"><input type="radio" name="rdo_CommitteeSocial" Onclick="document.form1.txt_CommitteeSocial.disabled=false;" value="1">
                          �� (�к�)</td>
                        <td width="75%" height="20" align="left" valign="bottom"><input name="txt_CommitteeSocial" type="text" class="inputtypePersonnel100px" onkeyup="doUnback_socail(value)"></td>
                      </tr>
                      <tr> 
                        <td height="20" colspan="2" style="color:#666666;"><input name="rdo_CommitteeSocial" type="radio"  onClick="document.form1.txt_CommitteeSocial.disabled=true;" value="0" checked checke > 
                          <span class="txtred">�����</span></td>
                      </tr>
                    </table></td>
                </tr>
                <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                  <td height="20" align=center bgcolor="#F0F0F0">12. </td>
                  <td height="20" align="left" class="boxleft5">�Ҫվ��ѡ : </td>
                  <td align="left" class="boxleft5"> 
                    <? 
							echo '<select name="list_Occu" >';
							for($i=1; $i<=4; $i++)
									{                         
									echo   '<option value='.$i.'>'.$Occu[$i].'</option>';
									 }
                          echo '</select>';	?>
                  </td>
                </tr>
                <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                  <td height="20" align=center bgcolor="#F0F0F0">13.</td>
                  <td height="20" align="left" class="boxleft5">�Ҫվ�ͧ :</td>
                  <td align="left" class="boxleft5"> 
                    <? 
							echo '<select name="list_Occusecond" >';
							for($i=1; $i<=4; $i++)
									{                         
									echo   '<option value='.$i.'>'.$Occu[$i].'</option>';
									 }
                          echo '</select>';	?>
                  </td>
                </tr>
                <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                  <td height="20" align=center>14.</td>
                  <td height="20" align="left" class="boxleft5">������� : </td>
                  <td align="left" class="boxleft5"><textarea name="area_address" class="areabox150"><?echo $data[12]?></textarea></td>
                <tr align=center bgcolor="#F0F0F0" style="color:#666666;"> 
                  <td height="20" align=center>15.</td>
                  <td height="20" align="left" class="boxleft5">�����˵� : </td>
                  <td align="left" class="boxleft5"><textarea name="area_remark" class="areabox150"><?echo $data[20]?></textarea></td>
                <tr align=center bgcolor="#BBD0E1" class=font1 style="color:#666666;"> 
                  <td height="3" colspan="3" align=center> </td>
              </table>
                    <br>

                    <input name="Submit" type="submit" class="formButton" value="Submit" onMouseOver="this.style.cursor='hand'">
                    &nbsp; 
                    <input name="Submit22" type="reset" class="formButton" value="Reset" onMouseOver="this.style.cursor='hand'">
                  </form></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
