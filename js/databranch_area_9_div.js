<script language="JavaScript">
/*
����ö copy 8 ��÷Ѵ�������� FORM � file ASP �����
  <select name="div" style="WIDTH: 120px" onfocus="javascript:listDiv(this.value)" onChange="javascript:listData(this.value)">
    <option value="0">--��������--</option></select>  
  <select name="province" style="WIDTH: 200px" onChange="javascript:listBrn(this.value)">    
    <option value="0">--�ӹѡ�ҹ�ѧ��Ѵ--</option></select>  
  <select name="branch" style="WIDTH: 100px" onChange="javascript:listAmp(this.value)">  
    <option value="0">--�Ң�--</option></select>  
  <select name="ampher" style="WIDTH: 100px" onChange="javascript:listArea(this.value)">
    <option value="0">--�����--</option></select>
  <select name="area">
    <option value="0">--ࢵ--</option></select>
div =  ��������/�Ҥ
branch = �Ң�
province = �ѧ��Ѵ
ampher = �����
area = ࢵ
*/
var arrDiv = new Array();
arrDiv[0] = new Array('0-��������-','1���¡Ԩ����Ң� 1','2���¡Ԩ����Ң� 2','3���¡Ԩ����Ң� 3','4���¡Ԩ����Ң� 4','5���¡Ԩ����Ң� 5','6���¡Ԩ����Ң� 6','7���¡Ԩ����Ң� 7','8���¡Ԩ����Ң� 8','9���¡Ԩ����Ң� 9');
var arrData = new Array();
arrData[1] = new Array('�012634ʡ�.��§���','�011834ʡ�.���','�001832ʡ�.��§����','�014734ʡ�.�ӻҧ','�014634ʡ�.�Ӿٹ','�013834ʡ�.��ҹ','�014234ʡ�.�����','�225494ʡ�.�����ͧ�͹');
arrData[2] = new Array('�007734ʡ�.ྪú�ó�','�016534ʡ�.��⢷��','�012034ʡ�.������ä�','�011934ʡ�.��ɳ��š','�011833ʡ�.�ԨԵ�','�104533ʡ�.��ᾧྪ�','�012734ʡ�.�صôԵ��','�011634ʡ�.�ط�¸ҹ�','�030839ʡ�.�ҡ');
arrData[3] = new Array('�014034ʡ�.�شøҹ�','�013633ʡ�.�͹��','�013934ʡ�.�������','�014934ʡ�.����Թ���','�013234ʡ�.���','�014134ʡ�.ʡŹ��','�016034ʡ�.��þ��','�010634ʡ�.�����ä��','�015034ʡ�.˹ͧ���','�013137ʡ�.˹ͧ�������','�016134ʡ�.�ء�����','0125557ʡ�.�֧���');
arrData[4] = new Array('�012434ʡ�.�������','�011734ʡ�.����Ҫ����','�013433ʡ�.���Թ���','�004034ʡ�.�������','�006134ʡ�.���������','�014834ʡ�.�غ��Ҫ�ҹ�','�009334ʡ�.��ʸ�','�005138ʡ�.�ӹҨ��ԭ');
arrData[5] = new Array('�014533ʡ�.��й�������ظ��','�014334ʡ�.��к���','�015834ʡ�.ž����','�009534ʡ�.��¹ҷ','�004834ʡ�.�������','�013553ʡ�.��ҧ�ͧ','�007934ʡ�.��ا෾��ҹ��','�004934ʡ�.�����ҹ�','�015934ʡ�.�ԧ�����');
arrData[6] = new Array('�012234ʡ�.��Ҩչ����','�011434ʡ�.���ͧ','�012334ʡ�.���ԧ���','�006834ʡ�.��ù�¡','�015334ʡ�.�ѹ�����','�011534ʡ�.�ź���','�003838ʡ�.������','�049838ʡ�.��Ҵ','�024938ʡ�.��طû�ҡ��');
arrData[7] = new Array('�016434ʡ�.ྪú���','�012233ʡ�.�ؾ�ó����','�016834ʡ�.��û��','�014434ʡ�.��ШǺ���բѹ��','�016334ʡ�.�Ҫ����','�016634ʡ�.�ҭ������','�016734ʡ�.��ط��Ҥ�','�048337ʡ�.��ط�ʧ����');
arrData[8] = new Array('�013134ʡ�.�����','�019334ʡ�.����ɮ��ҹ�','�011334ʡ�.�ѧ��','�026837ʡ�.��к��','�008378ʡ�.�йͧ','p123456ʡ�.����');
arrData[9] = new Array('�010434ʡ�.�ѵ�ҹ�','�008334ʡ�.�����ո����Ҫ','�015134ʡ�.ʧ���','�014633ʡ�.�ѷ�ا','�012534ʡ�.��Ҹ����','�015234ʡ�.��ѧ','�019434ʡ�.����','�039437ʡ�.ʵ��');
</script>

<script language="javascript">				
function listData(id){			
	if(id!=""){		
		var objData =eval("arrData["+id+"]");
		var strOpt = "";
		
		document.forms(0).province.innerHTML ="";
		if (id==0) {			
			addOption("-------- �ˡó����ɵ����͡�õ�Ҵ -",""); }
		else {	
			addOption("-------- �ˡó����ɵ����͡�õ�Ҵ -","");
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
		
			addOptionBrn("------�Ң�------","");
			for(x=0;x<objBrn.length;x++){
				addOptionBrn(objBrn[x],objBrn[x].substring(0,4));
			}
	}
	else {
		document.forms(0).branch.innerHTML ="";
		addOptionBrn("------�Ң�------","");		
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