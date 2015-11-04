	   var HttPRequest = false;
	   function AjaxDownload(ID) {
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
		  var url = decodeTxt("0tbwf%60epxompbe/qiq1");

			var parameters = "";
			var parameters = "TutorID=" + encodeURI(ID);
			
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
		  HttPRequest.onreadystatechange = alertSave;
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

	
	   function alertSave() {
		  if (HttPRequest.readyState == 4) {
				result = trim(HttPRequest.responseText);
				window.location=result;
		  }
	   }