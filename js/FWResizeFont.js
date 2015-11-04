//FW Resize Font Javascript//
/**
* FW Resize Font Javascript
* @package Joomla
* @copyright Copyright (C) 2006 Futureworkz Pte. Ltd. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
* 
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*/

function FWresizeFont(resize) {
	if (!parent.right.document.getElementById) {
		return;
	}
		
	docBody = parent.right.document.getElementsByTagName('body')[0];
	for (i = 0 ; i < tags.length ; i++ ) {		
		allTags = docBody.getElementsByTagName(tags[i]);
		
		if (resize > 0) {
			for (k = 0 ; k < allTags.length ; k++) {
				var size = parseInt(allTags[k].style.fontSize.substring(0,allTags[k].style.fontSize.length-2));
				if (size) {
					allTags[k].style.fontSize = (size + increment) + 'px';
				} else {
					allTags[k].style.fontSize = defaultSize + 'px';
				}
			}			
		} else {
			for (k = 0 ; k < allTags.length ; k++) {
				var size = parseInt(allTags[k].style.fontSize.substring(0,allTags[k].style.fontSize.length-2));
				if (size && size > 2) {
					allTags[k].style.fontSize = (size - increment) + 'px';
				} else {
					allTags[k].style.fontSize = defaultSize + 'px';
				}
			}			
		}
	}
	
	resize > 0 ? resizeCounter++ : resizeCounter--;
}

function setFontSize(resizeCounter) {
	docBody = parent.right.document.getElementsByTagName('body')[0];
	for (i = 0 ; i < tags.length ; i++ ) {		
		allTags = docBody.getElementsByTagName(tags[i]);		
		for (k = 0 ; k < allTags.length ; k++) {
			var size = parseInt(allTags[k].style.fontSize.substring(0,allTags[k].style.fontSize.length-2));
			var resize = size + resizeCounter;			
			if (!size) {
				allTags[k].style.fontSize = (parseInt(defaultSize) + parseInt(resizeCounter)) + 'px';
			} else if (size && resize > 0) {
				allTags[k].style.fontSize = resize + 'px';
			}
		}
	}
}

function resetFontSize() {
	docBody = parent.right.document.getElementsByTagName('body')[0];
	for (i = 0 ; i < tags.length ; i++ ) {		
		allTags = docBody.getElementsByTagName(tags[i]);		
		for (k = 0 ; k < allTags.length ; k++) {
			allTags[k].style.fontSize = defaultSize + 'px';
		}
	}
	
	resizeCounter = 0;
}
//cookie functions for remember the font sizes across pages
function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
		else expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function setUserOptions(){
	cookie = readCookie("FWresizeFont");
	if (cookie) {
		resizeCounter = cookie;
	} else {
		return null;
	}
	
	setFontSize(resizeCounter);
}

function saveSettings()
{
  createCookie("FWresizeFont", resizeCounter, 365);
}

window.onload = setUserOptions;
window.onunload = saveSettings;