	   var HttPRequest = false;
	   function AjaxSearch(strMode,strText,strUser) {
			
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
		
		  var url = decodeTxt("0npe%60bee%60tfbsdi/qiq1");
			var parameters = "Mode=" + encodeURI(strMode) +
			"&Text=" + strText +
			"&User=" + strUser;
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }

		  if(strMode=="MEMBER")
		   {
				 HttPRequest.onreadystatechange = redirectSearchMember;
		   }
		   else
		   {
			   HttPRequest.onreadystatechange = redirectSearchForum;
		   }
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

	
	   function redirectSearchMember() {
		  if (HttPRequest.readyState == 4) {
				result = trim(HttPRequest.responseText);
				
				if(result.substr(0,1)=="Y")
				{
					var imtLoading = document.getElementById("icoLoding");
					var divBoard = document.getElementById("divBoard");
					imtLoading.style.display = ''; 
					divBoard.style.display='none';

						window.location="/member-list/level/search-"+result.substr(1,7)+"/page-0001.html";
				}
				else
			  {
					alert(result);
			  }		
		  }
	   }

	   function redirectSearchForum() {
		  if (HttPRequest.readyState == 4) {
				result = trim(HttPRequest.responseText);
				
				if(result.substr(0,1)=="Y")
				{
					var imtLoading = document.getElementById("icoLoding");
					var divBoard = document.getElementById("divBoard");
					imtLoading.style.display = ''; 
					divBoard.style.display='none';

						window.location="/search-forum/result-"+result.substr(1,7)+"/page-0001.html";
				}
				else
			  {
					alert(result);
			  }		
		  }


	   }