
// LTrim(string) : Returns a copy of a string without leading spaces.
function ltrim(str)
{
   var whitespace = new String(" \t\n\r");
   var s = new String(str);
   if (whitespace.indexOf(s.charAt(0)) != -1) {
      var j=0, i = s.length;
      while (j < i && whitespace.indexOf(s.charAt(j)) != -1)
         j++;
      s = s.substring(j, i);
   }
   return s;
   
}

//RTrim(string) : Returns a copy of a string without trailing spaces.
function rtrim(str)
{
   var whitespace = new String(" \t\n\r");
   var s = new String(str);
   if (whitespace.indexOf(s.charAt(s.length-1)) != -1) {
      var i = s.length - 1;       // Get length of string
      while (i >= 0 && whitespace.indexOf(s.charAt(i)) != -1)
         i--;
      s = s.substring(0, i+1);
   }
   return s;
}

// Trim(string) : Returns a copy of a string without leading or trailing spaces
function trim(str) {
   return rtrim(ltrim(str));
}



function CheckEmail(e) {
ok = "1234567890qwertyuiop[]asdfghjklzxcvbnm.@-_QWERTYUIOPASDFGHJKLZXCVBNM";
	for(i=0; i < e.length ;i++){
	if(ok.indexOf(e.charAt(i))<0){ 
	return (false);
	}	
	} 
	if (document.images) {
	re = /(@.*@)|(\.\.)|(^\.)|(^@)|(@$)|(\.$)|(@\.)/;
	re_two = /^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	if (!e.match(re) && e.match(re_two)) {
	return (-1);		
	} 
	}
}


function CheckURL(ch){
	var len, digit;
	if(ch == " "){ 
      		 len=0;
    	}else{
    		 len = ch.length;
	}
	for(var i=0 ; i<len ; i++)
	{
		digit = ch.charAt(i)
		if( (digit >= "a" && digit <= "z")  || (digit >="0" && digit <="9") || (digit =="-") || (digit ==".")){
			;	
		}else{
			return false;					
		}		
	}		
	return true;
}	

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

