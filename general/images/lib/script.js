// JavaScript Document

function doUnback(value){ 
   var Old = value.substring(0,--value.length);
   var keyvalue = value.substring(--value.length,value.length);
   if ((keyvalue==1)||(keyvalue==2)||(keyvalue==3)||(keyvalue==4)||(keyvalue==5)||(keyvalue==6)||(keyvalue==7)||(keyvalue==8)||(keyvalue==9)||(keyvalue==0)){
      document.all.txt_name.value=Old;
      alert("ป้อนข้อมูลเป็นตัวอักษร");
   }

}

function doUnback_lsname(value){ 
   var Old = value.substring(0,--value.length);
   var keyvalue = value.substring(--value.length,value.length);
   if ((keyvalue==1)||(keyvalue==2)||(keyvalue==3)||(keyvalue==4)||(keyvalue==5)||(keyvalue==6)||(keyvalue==7)||(keyvalue==8)||(keyvalue==9)||(keyvalue==0)){
      document.all.txt_lsname.value=Old;
      alert("ป้อนข้อมูลเป็นตัวอักษร");
   }

}

function doUnback_socail(value){ 
   var Old = value.substring(0,--value.length);
   var keyvalue = value.substring(--value.length,value.length);
   if ((keyvalue==1)||(keyvalue==2)||(keyvalue==3)||(keyvalue==4)||(keyvalue==5)||(keyvalue==6)||(keyvalue==7)||(keyvalue==8)||(keyvalue==9)||(keyvalue==0)){
      document.all.txt_CommitteeSocial.value=Old;
      alert("ป้อนข้อมูลเป็นตัวอักษร");
   }

}


function doUnback_id(value){ 
   var Old = value.substring(0,--value.length);
   var keyvalue = value.substring(--value.length,value.length);
   if ((keyvalue=="ก")||(keyvalue=="ข")||(keyvalue=="ฃ")||(keyvalue=="ค")||(keyvalue=="ฅ")||(keyvalue=="ฆ")||(keyvalue=="ง")||(keyvalue=="จ")||(keyvalue=="ฉ")||(keyvalue=="ช")
	  ||(keyvalue=="ซ")||(keyvalue=="ฌ")||(keyvalue=="ญ")||(keyvalue=="ฎ")||(keyvalue=="ฏ")||(keyvalue=="ฐ")||(keyvalue=="ฑ")||(keyvalue=="ฒ")||(keyvalue=="ณ")
	   ||(keyvalue=="ด")||(keyvalue=="ต")||(keyvalue=="ถ")||(keyvalue=="ท")||(keyvalue=="ธ")||(keyvalue=="น")||(keyvalue=="บ")||(keyvalue=="ป")||(keyvalue=="ผ")
	   ||(keyvalue=="ฝ")||(keyvalue=="พ")||(keyvalue=="ฟ")||(keyvalue=="ภ")||(keyvalue=="ม")||(keyvalue=="ย")||(keyvalue=="ร")||(keyvalue=="ล")||(keyvalue=="ว")
	   ||(keyvalue=="ศ")||(keyvalue=="ษ")||(keyvalue=="ส")||(keyvalue=="ห")||(keyvalue=="ฬ")||(keyvalue=="อ")||(keyvalue=="ฮ")||(keyvalue=="a")||(keyvalue=="b")
	   ||(keyvalue=="c")||(keyvalue=="d")||(keyvalue=="e")||(keyvalue=="f")||(keyvalue=="g")||(keyvalue=="h")||(keyvalue=="i")||(keyvalue=="j")||(keyvalue=="k")
	   ||(keyvalue=="l")||(keyvalue=="m")||(keyvalue=="n")||(keyvalue=="o")||(keyvalue=="p")||(keyvalue=="q")||(keyvalue=="r")||(keyvalue=="s")||(keyvalue=="t")
	   ||(keyvalue=="u")||(keyvalue=="v")||(keyvalue=="w")||(keyvalue=="x")||(keyvalue=="y")||(keyvalue=="z")||(keyvalue=="*")||(keyvalue=="/")||(keyvalue=="+")
	   ||(keyvalue=="(")||(keyvalue==")")||(keyvalue=="[")||(keyvalue=="]")||(keyvalue=="?")||(keyvalue==".")||(keyvalue=="=")||(keyvalue=="_")||(keyvalue=="-")
	   ||(keyvalue=="@")||(keyvalue=="%")||(keyvalue=="^")||(keyvalue=="&"))
   
   {
      document.all.txt_user_id.value=Old;
      alert("ป้อนข้อมูลเป็นตัวเลขเท่านั้น");
   }

}


function doUnback_phone(value){ 
   var Old = value.substring(0,--value.length);
   var keyvalue = value.substring(--value.length,value.length);
   if ((keyvalue=="ก")||(keyvalue=="ข")||(keyvalue=="ฃ")||(keyvalue=="ค")||(keyvalue=="ฅ")||(keyvalue=="ฆ")||(keyvalue=="ง")||(keyvalue=="จ")||(keyvalue=="ฉ")||(keyvalue=="ช")
	  ||(keyvalue=="ซ")||(keyvalue=="ฌ")||(keyvalue=="ญ")||(keyvalue=="ฎ")||(keyvalue=="ฏ")||(keyvalue=="ฐ")||(keyvalue=="ฑ")||(keyvalue=="ฒ")||(keyvalue=="ณ")
	   ||(keyvalue=="ด")||(keyvalue=="ต")||(keyvalue=="ถ")||(keyvalue=="ท")||(keyvalue=="ธ")||(keyvalue=="น")||(keyvalue=="บ")||(keyvalue=="ป")||(keyvalue=="ผ")
	   ||(keyvalue=="ฝ")||(keyvalue=="พ")||(keyvalue=="ฟ")||(keyvalue=="ภ")||(keyvalue=="ม")||(keyvalue=="ย")||(keyvalue=="ร")||(keyvalue=="ล")||(keyvalue=="ว")
	   ||(keyvalue=="ศ")||(keyvalue=="ษ")||(keyvalue=="ส")||(keyvalue=="ห")||(keyvalue=="ฬ")||(keyvalue=="อ")||(keyvalue=="ฮ")||(keyvalue=="a")||(keyvalue=="b")
	   ||(keyvalue=="ไ")||(keyvalue=="โ")||(keyvalue=="เ")||(keyvalue=="แ")||(keyvalue=="ำ")||(keyvalue=="ๆ")||(keyvalue=="ๅ")||(keyvalue=="ฦ")||(keyvalue=="้")
	   ||(keyvalue=="ไ")||(keyvalue=="โ")||(keyvalue=="เ")||(keyvalue=="แ")||(keyvalue=="ำ")||(keyvalue=="ๆ")||(keyvalue=="ๅ")||(keyvalue=="ฦ")||(keyvalue=="้")
	   ||(keyvalue=="ั")||(keyvalue=="ี")||(keyvalue=="๊")||(keyvalue=="่")||(keyvalue=="๋")
	   ||(keyvalue=="l")||(keyvalue=="m")||(keyvalue=="n")||(keyvalue=="o")||(keyvalue=="p")||(keyvalue=="q")||(keyvalue=="r")||(keyvalue=="s")||(keyvalue=="t")
	   ||(keyvalue=="u")||(keyvalue=="v")||(keyvalue=="w")||(keyvalue=="x")||(keyvalue=="y")||(keyvalue=="z")||(keyvalue=="*")||(keyvalue=="/")||(keyvalue=="+")
	   ||(keyvalue=="(")||(keyvalue==")")||(keyvalue=="[")||(keyvalue=="]")||(keyvalue=="?")||(keyvalue==".")||(keyvalue=="=")||(keyvalue=="_")||(keyvalue=="-")
	   ||(keyvalue=="@")||(keyvalue=="%")||(keyvalue=="^")||(keyvalue=="&"))
   
   {
      document.all.txt_phone.value=Old;
      alert("ป้อนข้อมูลเป็นตัวเลขเท่านั้น");
   }

}

