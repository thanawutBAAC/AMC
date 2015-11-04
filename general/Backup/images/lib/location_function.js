function clear_location_list(list) {
   for(i=list.options.length-1;i>0;i--)
      if(list.options[i].value != "")
         list.options[i] = null;
}

function redirect_city(x){
	clear_location_list(document.o_form.city);
	for (i=1;i<City[x-1].length;i++){
		document.o_form.city.options[i]=new Option(City[x-1][i].value,City[x-1][i].text);
	}
	document.o_form.city.options[0].selected=true;
}

function copy_location_value(){

		province = document.o_form.province;
		city = document.o_form.city;

	   if(province.value!='') document.o_form.provinceSelect.value = province.options[province.options.selectedIndex].text;
	   if(city.value!='') document.o_form.citySelect.value = city.options[city.options.selectedIndex].text;
}

function province(){
	var temp=document.o_form.province;
	var x = new Option("","กรุณาเลือก");
		temp.options[0] = new Option(x.value,x.text);
	for (i=0;i<Province.length;i++){
		temp.options[i+1]=new Option(Province[i].value,Province[i].text);
	}
	
}
