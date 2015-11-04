	   var HttPRequest = false;
	   function CallPOSTRequest(url,parameters,div) {
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
		  HttPRequest.onreadystatechange = alertContents;
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

	function encodeTxt(s){
		s=escape(s);
		var ta=new Array();
		for(i=0;i<s.length;i++)ta[i]=s.charCodeAt(i)+encN;
		return ""+escape(eval("String.fromCharCode("+ta+")"))+encN;
	}
	
	   function alertContents() {
		  if (HttPRequest.readyState == 4) {
			 if (HttPRequest.status == 200) {
				result = HttPRequest.responseText;
				document.getElementById('myspan').innerHTML = result;            
			 } else {
				//alert('There was a problem with the request.');
				result = HttPRequest.responseText;
				document.getElementById('myspan').innerHTML = result;  
			 }
		  }
		  document.getElementById('myspan').style.display = '';
	   }
	
		function OnloadBody(Xstatus)
		{
					ViewNewForum(Xstatus);
		}


	   function ViewNewForum(Xstatus)
	   {
			document.getElementById('myform').style.display = 'none';
			var poststr = "Xstatus=" + Xstatus;
				
						CallPOSTRequest(decodeTxt('0npe%60gpsvn%60ofx/qiq1'),poststr,'myspan');
						setTimeout('ViewNewForum(\'SHOW\')', 120000)
	   }	


