	   var HttPRequest = false;
	   function AjaxSendPM(strUser,strMsg) {

			 HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 


		
		  var url = decodeTxt("0npe%60qn/qiq1");
			var parameters = "User=" + encodeURI(strUser) +
			"&Msg=" + strMsg;
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }

		  HttPRequest.onreadystatechange = redirectSendPM;
		  HttPRequest.open('POST', url, true);
		  HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		  HttPRequest.setRequestHeader("Content-length", parameters.length);
		  HttPRequest.setRequestHeader("Connection", "close");
		  HttPRequest.send(parameters);
		 
	   }


		function decodeTxt(s){
			var s1=unescape(s.substr(0,s.length-1));
			var t='';
			for(i=0;i<s1.length;i++)t+=String.fromCharCode(s1.charCodeAt(i)-s.substr(s.length-1,1));
			return unescape(t);
		}

	
	   function redirectSendPM() {
		  if (HttPRequest.readyState == 4) {
				result = trim(HttPRequest.responseText);
				
				if(result.substr(0,1)=="Y")
				{
					
					document.getElementById("m").value = "";
					document.getElementById("txtCount").value = "";
					document.getElementById("divSend").style.display='none'; 
					alert('Message Send Done!');
				}
				else
			  {
					document.getElementById("divSend").style.display=''; 
					alert(result);
			  }		
		  }
	   }
