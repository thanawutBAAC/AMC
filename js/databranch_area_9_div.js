<script language="JavaScript">
/*
สามารถ copy 8 บรรทัดนี้ไปไว้ใน FORM ใน file ASP ได้เลย
  <select name="div" style="WIDTH: 120px" onfocus="javascript:listDiv(this.value)" onChange="javascript:listData(this.value)">
    <option value="0">--รวมประเทศ--</option></select>  
  <select name="province" style="WIDTH: 200px" onChange="javascript:listBrn(this.value)">    
    <option value="0">--สำนักงานจังหวัด--</option></select>  
  <select name="branch" style="WIDTH: 100px" onChange="javascript:listAmp(this.value)">  
    <option value="0">--สาขา--</option></select>  
  <select name="ampher" style="WIDTH: 100px" onChange="javascript:listArea(this.value)">
    <option value="0">--อำเภอ--</option></select>
  <select name="area">
    <option value="0">--เขต--</option></select>
div =  รวมประเทศ/ภาค
branch = สาขา
province = จังหวัด
ampher = อำเภอ
area = เขต
*/
var arrDiv = new Array();
arrDiv[0] = new Array('0-รวมประเทศ-','1ฝ่ายกิจการสาขา 1','2ฝ่ายกิจการสาขา 2','3ฝ่ายกิจการสาขา 3','4ฝ่ายกิจการสาขา 4','5ฝ่ายกิจการสาขา 5','6ฝ่ายกิจการสาขา 6','7ฝ่ายกิจการสาขา 7','8ฝ่ายกิจการสาขา 8','9ฝ่ายกิจการสาขา 9');
var arrData = new Array();
arrData[1] = new Array('ก012634สกต.เชียงราย','ก011834สกต.แพร่','ร001832สกต.เชียงใหม่','ก014734สกต.ลำปาง','ก014634สกต.ลำพูน','ก013834สกต.น่าน','ก014234สกต.พะเยา','ก225494สกต.แม่ฮ่องสอน');
arrData[2] = new Array('ก007734สกต.เพชรบูรณ์','ก016534สกต.สุโขทัย','ก012034สกต.นครสวรรค์','ก011934สกต.พิษณุโลก','ก011833สกต.พิจิตร','ก104533สกต.กำแพงเพชร','ก012734สกต.อุตรดิตถ์','ก011634สกต.อุทัยธานี','ก030839สกต.ตาก');
arrData[3] = new Array('ก014034สกต.อุดรธานี','ก013633สกต.ขอนแก่น','ก013934สกต.ร้อยเอ็ด','ก014934สกต.กาฬสินธุ์','ก013234สกต.เลย','ก014134สกต.สกลนคร','ก016034สกต.นครพนม','ก010634สกต.มหาสารคาม','ก015034สกต.หนองคาย','ก013137สกต.หนองบัวลำภู','ก016134สกต.มุกดาหาร','0125557สกต.บึงกาฬ');
arrData[4] = new Array('ก012434สกต.ชัยภูมิ','ก011734สกต.นครราชสีมา','ก013433สกต.สุรินทร์','ก004034สกต.ศรีสะเกษ','ก006134สกต.บุรีรัมย์','ก014834สกต.อุบลราชธานี','ก009334สกต.ยโสธร','ก005138สกต.อำนาจเจริญ');
arrData[5] = new Array('ก014533สกต.พระนครศรีอยุธยา','ก014334สกต.สระบุรี','ก015834สกต.ลพบุรี','ก009534สกต.ชัยนาท','ก004834สกต.นนทบุรี','ก013553สกต.อ่างทอง','ก007934สกต.กรุงเทพมหานคร','ก004934สกต.ปทุมธานี','ก015934สกต.สิงห์บุรี');
arrData[6] = new Array('ก012234สกต.ปราจีนบุรี','ก011434สกต.ระยอง','ก012334สกต.ฉะเชิงเทรา','ก006834สกต.นครนายก','ก015334สกต.จันทบุรี','ก011534สกต.ชลบุรี','ก003838สกต.สระแก้ว','ก049838สกต.ตราด','ก024938สกต.สมุทรปราการ');
arrData[7] = new Array('ก016434สกต.เพชรบุรี','ก012233สกต.สุพรรณบุรี','ก016834สกต.นครปฐม','ก014434สกต.ประจวบคีรีขันธ์','ก016334สกต.ราชบุรี','ก016634สกต.กาญจนบุรี','ก016734สกต.สมุทรสาคร','ก048337สกต.สมุทรสงคราม');
arrData[8] = new Array('ก013134สกต.ชุมพร','ก019334สกต.สุราษฎร์ธานี','ก011334สกต.พังงา','ก026837สกต.กระบี่','ก008378สกต.ระนอง','p123456สกต.ภูเก็ต');
arrData[9] = new Array('ก010434สกต.ปัตตานี','ก008334สกต.นครศรีธรรมราช','ก015134สกต.สงขลา','ก014633สกต.พัทลุง','ก012534สกต.นราธิวาส','ก015234สกต.ตรัง','ก019434สกต.ยะลา','ก039437สกต.สตูล');
</script>

<script language="javascript">				
function listData(id){			
	if(id!=""){		
		var objData =eval("arrData["+id+"]");
		var strOpt = "";
		
		document.forms(0).province.innerHTML ="";
		if (id==0) {			
			addOption("-------- สหกรณ์การเกษตรเพื่อการตลาด -",""); }
		else {	
			addOption("-------- สหกรณ์การเกษตรเพื่อการตลาด -","");
			for(x=0;x<objData.length;x++){
				addOption(objData[x],objData[x].substring(0,7));
			}	 // end for	
		} // end if 
	} // end if 
}

function addOption(text,value){
	var oOption = document.createElement("OPTION");
	document.forms(0).province.options.add(oOption);
	oOption.innerText =text.substring(7,text.length);
	oOption.value = value;
}	
	
/*-----------------------------------------------------------------------*/
function listBrn(id){
	if(id!=""){	
		var objBrn =eval("arrBrn["+id+"]");
		var strOpt = "";
	
		document.forms(0).branch.innerHTML ="";
		
			addOptionBrn("------สาขา------","");
			for(x=0;x<objBrn.length;x++){
				addOptionBrn(objBrn[x],objBrn[x].substring(0,4));
			}
	}
	else {
		document.forms(0).branch.innerHTML ="";
		addOptionBrn("------สาขา------","");		
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