function CheckEmpty() {
    	if (document.o_form.common_name.value == "") {
        	alert("Please fill in your search keyword.");
        	return 0;
    	}
    	document.o_form.submit();
}	

function CheckAdmin() {
    	if ((document.o_form.loginname.value == "")&&(document.o_form.passwd.value == "")) {
    		alert("Please fill in your login name and password!");
	        return 0;
    	}
 	if (document.o_form.passwd.value == "") {  
		alert("Please fill in your password.");
                return 0;
        }
	if (document.o_form.loginname.value == "") {
		alert("Please fill in your loginname."); 
                return 0;
        }
    	document.o_form.submit();
}

function CheckSelf() {
        if (document.o_form.userpassword.value == "") {
                alert("Please fill in your password.");
                return 0;
        }
        document.o_form.submit();
}
