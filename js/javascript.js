// รับ input ในตัวแปร pin   จะคืนค่าเป็นจริง ในกรณีที่ถูกต้องตามรูปแบบ

//ตรวจสอบการบันทึกเลขที่บัตรประชาชนให้ตรงตามรูปแบบ
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

// เลขประจำตัวผู้เสียภาษีอากร จะต้องขึ้นต้นด้วยเลข 1 หรือ 2 เท่านั้น
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

// ตรวจสอบตัวเลข
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

// ตรวจสอบตัวเลข สามารถป้อนตัวเลขติดลบได้
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
	// ไม่ให้ป้อนตัวเลข
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

// การตัดช่องว่างด้านขวา
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

// การตัดช่องว่างด้านซ้าย
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


// ตรวจสอบว่าหน้านี้ได้โหลดเท่าไร
function stopclk(){
var then,now=new Date();
then=new Date();
alert('หน้านี้ใช้เวลาในการ LOAD ทั้งสิ้น '+((then-now)/1000)+' วินาที');
}
// การเรียกใช้
// window.onload=function(){
// stopclk();

// ตรวจสอบหน้าจอว่าตรงที่กำหนด 800 * 600 หรือไม่
function check_screen() {
var correctwidth=800
var correctheight=600
if (screen.width!=correctwidth||screen.height!=correctheight)
document.write(" เวปนี้ควรกำหนดหน้าจอให้เป็น "+correctwidth+"*"+correctheight+". หน้าจอปัจจุบันของคุณเป็น "+screen.width+"*"+screen.height+". กรุณากำหนดใหม่ด้วยครับ ")
}


/***********************************************
 ตรวจสอบรูปแบบของ อีเมล์   onClick="return checkmail(this.form.myemail)
***********************************************/
var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i

function checkmail(e){
var returnval=emailfilter.test(e.value)
if (returnval==false){
alert(" กรุณาป้อน E-mail ใหม่ให้ถูกต้อง ")
e.select()
}
return returnval
}

// จัดรูปแบบตัวเลข  ส่งค่า this
function formatNumber (obj) {
	anynum=document.getElementById(obj);
	divider =100;
	 anynum.value = Math.abs((Math.round(anynum.value*divider)/divider))+'%';
 }

// จัดรูปแบบตัวเลข เป็นทศนิยม 2 ตำแหน่ง ส่งค่า id มา
function formatNumber2(obj){
		var anytext=document.getElementById(obj);
		var num = parseFloat(anytext.value);
		var num2 = 5000;
		anytext.value = num.toFixed(2);
}