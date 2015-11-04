// �Ѻ input 㹵���� pin   �Ф׹����繨�ԧ 㹡óշ��١��ͧ����ٻẺ

//��Ǩ�ͺ��úѹ�֡�Ţ���ѵû�ЪҪ����ç����ٻẺ
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

// �Ţ��Шӵ�Ǽ�����������ҡ� �е�ͧ��鹵鹴����Ţ 1 ���� 2 ��ҹ��
function chkDigitTin(tin) {	
	if ((tin.charAt(0) != 1) && (tin.charAt(0) != 2)) {		
		return false;		
	}
	var sum = (tin.charAt(0)*3)+(tin.charAt(1)*1)+(tin.charAt(2)*3)+
						(tin.charAt(3)*1)+(tin.charAt(4)*3)+(tin.charAt(5)*1)+
						(tin.charAt(6)*3)+(tin.charAt(7)*1)+(tin.charAt(8)*3);				
	var digit = 0;
	if (sum % 10 != 0) {
		digit = 10 - (sum % 10);
	}
	if (digit != tin.charAt(9)) {
		return false;	
	}
	return true;
}

// ��Ǩ�ͺ����Ţ
	function isNumberKey(evt) //number only
     {
         var charCode = (evt.which) ? evt.which : event.keyCode
		if(charCode!=13)
		{
			 if (charCode > 31 && (charCode < 48 || charCode > 57))
					return false;  
		}
         return true;
     }

// ��Ǩ�ͺ����Ţ ����ö��͹����Ţ�Դź��
	function isNumberKeyMinus(evt) //number only
     {
         var charCode = (evt.which) ? evt.which : event.keyCode
		if(charCode!=13)
		{
			 if (charCode==45 )
					return true;	
			 else if(charCode==46)
					return true;	
			 else if (charCode > 31 && (charCode < 48 || charCode > 57))
					return false;  
		}
         return true;
     }
	// �������͹����Ţ
function noNumbers(e)
{
	var keynum;
	var keychar;
	var numcheck;

	if(window.event) // IE
	{
	keynum = e.keyCode;
	}
	else if(e.which) // Netscape/Firefox/Opera
	{
	keynum = e.which;
	}
	keychar = String.fromCharCode(keynum);
	numcheck = /\d/;
	return !numcheck.test(keychar);
}

// ��õѴ��ͧ��ҧ��ҹ���
function RTrim(VALUE){
	var w_space = String.fromCharCode(32);
	var v_length = VALUE.length;
	var strTemp = "";

	if(v_length < 0) {
	  return"";
	}
	var iTemp = v_length -1;

	while(iTemp > -1) {
		if(VALUE.charAt(iTemp) == w_space){
		} else {
			strTemp = VALUE.substring(0,iTemp +1);
			break;
		}
		iTemp = iTemp-1;
	} //End While
   return strTemp;
} //End Function

// ��õѴ��ͧ��ҧ��ҹ����
function LTrim(VALUE){
	var w_space = String.fromCharCode(32);

	if(v_length < 1) {
		return"";
	}

	var v_length = VALUE.length;
	var strTemp = "";
	var iTemp = 0;

	while(iTemp < v_length) {
		if(VALUE.charAt(iTemp) == w_space) {
		} else {
			strTemp = VALUE.substring(iTemp,v_length);
			break;
		}
		iTemp = iTemp + 1;
	} //End While
	return strTemp;
} //End Function


function Trim(TRIM_VALUE){
	if(TRIM_VALUE.length < 1) {
		return"";
	}
	TRIM_VALUE = RTrim(TRIM_VALUE);
	TRIM_VALUE = LTrim(TRIM_VALUE);
	if(TRIM_VALUE=="") {
		return "";
	} else {
		return TRIM_VALUE;
	}
}


// ��Ǩ�ͺ���˹�ҹ������Ŵ�����
function stopclk(){
var then,now=new Date();
then=new Date();
alert('˹�ҹ��������㹡�� LOAD ������ '+((then-now)/1000)+' �Թҷ�');
}
// ������¡��
// window.onload=function(){
// stopclk();

// ��Ǩ�ͺ˹�Ҩ���ҵç����˹� 800 * 600 �������
function check_screen() {
var correctwidth=800
var correctheight=600
if (screen.width!=correctwidth||screen.height!=correctheight)
document.write(" �ǻ����á�˹�˹�Ҩ������ "+correctwidth+"*"+correctheight+". ˹�ҨͻѨ�غѹ�ͧ�س�� "+screen.width+"*"+screen.height+". ��سҡ�˹�������¤�Ѻ ")
}


/***********************************************
 ��Ǩ�ͺ�ٻẺ�ͧ ������   onClick="return checkmail(this.form.myemail)
***********************************************/
var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i

function checkmail(e){
var returnval=emailfilter.test(e.value)
if (returnval==false){
alert(" ��سһ�͹ E-mail �������١��ͧ ")
e.select()
}
return returnval
}

// �Ѵ�ٻẺ����Ţ  �觤�� this
function formatNumber (obj) {
	anynum=document.getElementById(obj);
	divider =100;
	 anynum.value = Math.abs((Math.round(anynum.value*divider)/divider))+'%';
 }

// �Ѵ�ٻẺ����Ţ �繷ȹ��� 2 ���˹� �觤�� id ��
function formatNumber2(obj){
		var anytext=document.getElementById(obj);
		var num = parseFloat(anytext.value);
		var num2 = 5000;
		anytext.value = num.toFixed(2);
}