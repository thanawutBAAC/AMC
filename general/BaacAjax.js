var url;

function createXMLHttpRequest()	{
	      if(window.ActiveXObject){
		      xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		 }
		 else if(window.XMLHTttpRequest)	 {
		          xmlHttpRequest();
		 } 
	}

function  Ajax_PostData(HDSC){
		var HandleStateChange=HDSC;
		createXMLHttpRequest();
		xmlHttp.onreadystatechange = HandleStateChange;
		xmlHttp.open("POST",url,true)	
		xmlHttp.send(null);
}

function IsNumeric(expression) {
	var nums = "0123456789.";
	if (expression.length==0) return(false);
	for (var n=0; n < expression.length; n++){
	if(nums.indexOf(expression.charAt(n))==-1)
	return false;
	}
 return(true);
 }

function  Clear_sslvpn(sslvpn){
		//alert(sslvpn);
		var CChack ;
		//CChack=sslvpn.replace(/sslvpn.js/i, "");
		CChack=sslvpn.replace("/sslvpn.js", "");
		CChack=CChack.replace("/script", "");
		CChack=CChack.replace("<>", "");
		CChack=CChack.replace("<script language='JavaScript' src=''>", "");
		var C_sslvpn = CChack;
		
		return C_sslvpn;

}

function txt_number_onkeypress() 
		//กรุณาอย่าแก้นะครับ
		{	
		var k_perid = document.getElementById("txt_pawn_number").value ;
		  if (k_perid.length < 14)
		    {
		         var sMask = '01234567890';
		         var KeyTyped = String.fromCharCode(window.event.keyCode);
		         var srcObject = window.event.srcElement;
		          if (sMask.indexOf(KeyTyped.toString()) == -1)
		                  {
		                          window.event.keyCode = 0;
		                          _ret = false;
		                  }
			 frigger = document.getElementById("txt_pawn_number").value ;
		     keyCount = document.getElementById("txt_pawn_number").value.length;
		      var tmpStr = '';
		      keyEntered = KeyTyped;
		      keyCount++;
		      switch (keyCount)
		      {
		      case 1:
		        tmpStr += srcObject.value;
		        srcObject.value = tmpStr;
		        break;
		      case 4:
		       srcObject.value += '-';
		       break;
		      case 10:
		       srcObject.value += '-';
		       break;
		     // case 13:
		      // srcObject.value += '-';
			  // break;		       
		      //case 16:
		       //srcObject.value += '-';
			   //break;
		       
		          }
		      } 
		      
		
}
function Mid(str, start, len)
{
// Make sure start and len are within proper bounds
    if (start < 0 || len < 0) return "";
    var iEnd, iLen = String(str).length;
    if (start + len > iLen)
          iEnd = iLen;
    else
          iEnd = start + len;
    return String(str).substring(start,iEnd);
}
