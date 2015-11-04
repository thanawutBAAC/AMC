	function SendToFriend(strText1,strText2)
	{
		var toemail = prompt("Please enter the email address of your friends. (More than one used , )","กรอกอีเมล์เพื่อนของคุณ กรณีมากกว่า 1 รายชื่อให้ใช้ (,) คอมมา");
		if (toemail!=null && toemail!="")
		{
			if(toemail.indexOf("@")=="-1" || toemail.indexOf(".")=="-1")
			{
				alert('Email Invalid !');
				SendToFriend();
			}
			else
			{	
				AjaxCmd('SENDTOFRIEND',toemail,strText1,strText2);
			}
		}
	}
	   
	   
	   var HttPRequest = false;
	   function AjaxCmd(strMode,strText1,strText2,strText3) {
		
		if(strMode=="CLIPBOARD")
		   {
				alert('CLIPBOARD');
		   }
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
		
		  var url = decodeTxt("0bkby%60dne/qiq1"); //ajax_cmd.php
			var parameters = "Mode=" + encodeURI(strMode) +
			"&Text1=" + strText1 +
			"&Text2=" + strText2 +
			"&Text3=" + strText3;
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }

		  if(strMode=="SENDTOFRIEND")
		   {
				 HttPRequest.onreadystatechange = redirectSendToFriend;
		   }
		   else if(strMode=="BOOKMARK")
		   {
			   HttPRequest.onreadystatechange = redirectBookmark;
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

	
	   function redirectSendToFriend() {
		  if (HttPRequest.readyState == 4) {
				result = trim(HttPRequest.responseText);
				

					alert(result);

		  }
	   }

	   function redirectBookmark() {
		  if (HttPRequest.readyState == 4) {
				result = trim(HttPRequest.responseText);
				

					alert(result);

		  }


	   }