	   var HttPRequest = false;
	   function CallPOSTRequestUser(url,parameters) {
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
		  
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
		  HttPRequest.onreadystatechange = alertOnload;
		  HttPRequest.open('POST', url, true);
		  HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		  HttPRequest.setRequestHeader("Content-length", parameters.length);
		  HttPRequest.setRequestHeader("Connection", "close");
		  HttPRequest.send(parameters);
	   }

	   function alertOnload() {

	   }
	
		function OnloadUserOnline()
		{
					PostOnline();
		}


	   function PostOnline()
	   {
			var poststr = "";
				
						CallPOSTRequestUser('online.php',poststr);
						setTimeout('OnloadUserOnline()', 120000)
	   }	


