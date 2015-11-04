	   var HttPRequest = false;
	   function PostThankScore(T_URL,F_UID,T_UID,F_IP,T_IP) {
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

		  var url = decodeTxt("0tbwf%60tdpsf/qiq1");
			var parameters = "F_UID=" + encodeURI(F_UID) +
			"&T_URL=" + encodeURI(T_URL) +
			"&T_UID=" + encodeURI(T_UID) +
			"&F_IP=" + encodeURI(F_IP) +
			"&T_IP=" + T_IP;
	
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
		  HttPRequest.onreadystatechange = alertScore;
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

	
	   function alertScore() {
		  if (HttPRequest.readyState == 4) {
				result = trim(HttPRequest.responseText);
				alert(result);
		  }
	   }