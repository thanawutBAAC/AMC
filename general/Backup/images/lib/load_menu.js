function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_nbGroup(event, grpName) { //v6.0
var i,img,nbArr,args=MM_nbGroup.arguments;
  if (event == "init" && args.length > 2) {
    if ((img = MM_findObj(args[2])) != null && !img.MM_init) {
      img.MM_init = true; img.MM_up = args[3]; img.MM_dn = img.src;
      if ((nbArr = document[grpName]) == null) nbArr = document[grpName] = new Array();
      nbArr[nbArr.length] = img;
      for (i=4; i < args.length-1; i+=2) if ((img = MM_findObj(args[i])) != null) {
        if (!img.MM_up) img.MM_up = img.src;
        img.src = img.MM_dn = args[i+1];
        nbArr[nbArr.length] = img;
    } }
  } else if (event == "over") {
    document.MM_nbOver = nbArr = new Array();
    for (i=1; i < args.length-1; i+=3) if ((img = MM_findObj(args[i])) != null) {
      if (!img.MM_up) img.MM_up = img.src;
      img.src = (img.MM_dn && args[i+2]) ? args[i+2] : ((args[i+1])?args[i+1] : img.MM_up);
      nbArr[nbArr.length] = img;
    }
  } else if (event == "out" ) {
    for (i=0; i < document.MM_nbOver.length; i++) { img = document.MM_nbOver[i]; img.src = (img.MM_dn) ? img.MM_dn : img.MM_up; }
  } else if (event == "down") {
    nbArr = document[grpName];
    if (nbArr) for (i=0; i < nbArr.length; i++) { img=nbArr[i]; img.src = img.MM_up; img.MM_dn = 0; }
    document[grpName] = nbArr = new Array();
    for (i=2; i < args.length-1; i+=2) if ((img = MM_findObj(args[i])) != null) {
      if (!img.MM_up) img.MM_up = img.src;
      img.src = img.MM_dn = (args[i+1])? args[i+1] : img.MM_up;
      nbArr[nbArr.length] = img;
  } }
}

function MM_preloadImages() { //v3.0
 var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
   var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
   if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function mmLoadMenus() {
  if (window.mm_menu_0701151423_2) return;
  window.mm_menu_0701151423_2 = new Menu("root",120,16,"MS Sans Serif, Thonburi",10,"#000000","#ffffff","#e9e7e7","#000099","left","middle",0,0,1000,-5,7,true,true,true,3,true,true);
  mm_menu_0701151423_2.addMenuItem("�������Ңͧ ʺ��.","location='http://www.gits.net.th/about/index.php'");
  mm_menu_0701151423_2.addMenuItem("��áԨ","location='http://www.gits.net.th/about/mission.php'");
  //mm_menu_0701151423_2.addMenuItem("Ἱ��ô��Թ�ҹ","location='about/plan.php'");
   mm_menu_0701151423_2.hideOnMouseOut=true;
   mm_menu_0701151423_2.menuBorder=1;
   mm_menu_0701151423_2.menuLiteBgColor='#ffffff';
   mm_menu_0701151423_2.menuBorderBgColor='#cccccc';
   mm_menu_0701151423_2.bgColor='#999999';
    window.mm_menu_0701151423_0_1 = new Menu("��ԡ�����͢����Ҥ�Ѱ",184,16,"MS Sans Serif, Thonburi",10,"#000000","#ffffff","#e9e7e7","#000099","left","middle",3,0,1000,-5,7,true,true,true,3,true,true);
    mm_menu_0701151423_0_1.addMenuItem("��ԡ����������Ẻ�ش��������","location='http://www.gits.net.th/services/gnode/index.php'");
    mm_menu_0701151423_0_1.addMenuItem("��ԡ����������Ẻ��ع���Ѿ��","location='http://www.gits.net.th/services/gdialup/'");
    //mm_menu_0701151423_0_1.addMenuItem("෤����դ�����ʹ��º����͢���","location='http://www.gits.net.th/services/networksecurity/'");
     mm_menu_0701151423_0_1.hideOnMouseOut=true;
     mm_menu_0701151423_0_1.menuBorder=1;
     mm_menu_0701151423_0_1.menuLiteBgColor='#ffffff';
     mm_menu_0701151423_0_1.menuBorderBgColor='#cccccc';
     mm_menu_0701151423_0_1.bgColor='#999999';
    window.mm_menu_0701151423_0_2 = new Menu("��ԡ���;���प���Ҥ�Ѱ",214,16,"MS Sans Serif, Thonburi",10,"#000000","#ffffff","#e9e7e7","#000099","left","middle",3,0,1000,-5,7,true,true,true,3,true,true);
    //mm_menu_0701151423_0_2.addMenuItem("�к���Ъ������硷�͹ԡ��","location='http://www.gits.net.th/services/paperlessmeeting/'");
    mm_menu_0701151423_0_2.addMenuItem("��ԡ���Ѻ�ҡ�������Ҥ�Ѱ","location='http://www.gits.net.th/services/webhosting/'");
    mm_menu_0701151423_0_2.addMenuItem("��ԡ�èѴ��è���������硷�͹ԡ���Ҥ�Ѱ","location='http://www.gits.net.th/services/mailhosting/'");
    //mm_menu_0701151423_0_2.addMenuItem("��ԡ�ðҹ�����Ţ����Ҥ�Ѱ","location='http://www.gits.net.th/services/gnews/'");
    mm_menu_0701151423_0_2.addMenuItem("��ԡ�õ�Ǩ�ͺ����ʨ���������硷�͹ԡ��","location='http://www.gits.net.th/services/mailcleaner/'");
    mm_menu_0701151423_0_2.addMenuItem("�к�����������礷�͹ԡ��Ẻ��ʹ���","location='http://www.gits.net.th/services/secureemail/'");
    //mm_menu_0701151423_0_2.addMenuItem("����������硷�͹ԡ���Ҥ�Ѱ","location='http://www.gits.net.th/services/gmail/'");
	mm_menu_0701151423_0_2.addMenuItem("��ԡ���Ѻ�ҡ����ͧ����ԡ��","location='http://www.gits.net.th/services/colocation/'");
    //mm_menu_0701151423_0_2.addMenuItem("��ԡ�õ�Ǩ�ͺ�س�Ҿ���͢���","location='services/networkmonitoring/'");
     mm_menu_0701151423_0_2.hideOnMouseOut=true;
     mm_menu_0701151423_0_2.menuBorder=1;
     mm_menu_0701151423_0_2.menuLiteBgColor='#ffffff';
     mm_menu_0701151423_0_2.menuBorderBgColor='#cccccc';
     mm_menu_0701151423_0_2.bgColor='#999999';
    window.mm_menu_0701151423_0_3 = new Menu("��ԡ����Ѻ�ͧ����硷�͹ԡ���Ҥ�Ѱ",254,16,"MS Sans Serif, Thonburi",10,"#000000","#ffffff","#e9e7e7","#000099","left","middle",3,0,1000,-5,7,true,true,true,3,true,true);
    mm_menu_0701151423_0_3.addMenuItem("��ԡ����Ѻ�ͧ����硷�͹ԡ������Ѻ�ؤ��","location='http://www.gits.net.th/services/personalcertificate/'");
    mm_menu_0701151423_0_3.addMenuItem("��ԡ����Ѻ�ͧ����硷�͹ԡ������Ѻ����ͧ����ԡ��","location='http://www.gits.net.th/services/servercertificate/'");
    mm_menu_0701151423_0_3.addMenuItem("��ԡ���Ѻ�ҡ�к���ԡ����Ѻ�ͧ����硷�͹ԡ��","location='http://www.gits.net.th/services/cahosting/'");
     mm_menu_0701151423_0_3.hideOnMouseOut=true;
     mm_menu_0701151423_0_3.menuBorder=1;
     mm_menu_0701151423_0_3.menuLiteBgColor='#ffffff';
     mm_menu_0701151423_0_3.menuBorderBgColor='#cccccc';
     mm_menu_0701151423_0_3.bgColor='#999999';
    window.mm_menu_0701151423_0_4 = new Menu("��ԡ�ë������Թ���ê���Ҥ�Ѱ",150,16,"MS Sans Serif, Thonburi",10,"#000000","#ffffff","#e9e7e7","#000099","left","middle",3,0,1000,-5,7,true,true,true,3,true,true);
    mm_menu_0701151423_0_4.addMenuItem("��ԡ�÷���֡��","location='http://www.gits.net.th/services/itconsulting/'");
    mm_menu_0701151423_0_4.addMenuItem("��ԡ�þѲ���к����ʹ��","location='http://www.gits.net.th/services/systemdevelopment/'");
	 mm_menu_0701151423_0_4.addMenuItem("�к���Ъ������硷�͹ԡ��","location='http://www.gits.net.th/services/paperlessmeeting/'");
     mm_menu_0701151423_0_4.hideOnMouseOut=true;
     mm_menu_0701151423_0_4.menuBorder=1;
     mm_menu_0701151423_0_4.menuLiteBgColor='#ffffff';
     mm_menu_0701151423_0_4.menuBorderBgColor='#cccccc';
     mm_menu_0701151423_0_4.bgColor='#999999';
    window.mm_menu_0701151423_0_5 = new Menu("��ԡ���Ҥ�Ѱ�����Ҹ�ó�",182,16,"MS Sans Serif, Thonburi",10,"#000000","#ffffff","#e9e7e7","#000099","left","middle",3,0,1000,-5,7,true,true,true,3,true,true);
    mm_menu_0701151423_0_5.addMenuItem("�ٹ���ҧ�š����¹�����͹�Ź�","location='http://www.gits.net.th/services/thaisarn/'");
    mm_menu_0701151423_0_5.addMenuItem("��е�������͢������ʹ���Ҥ�Ѱ","location='http://www.gits.net.th/services/thaigov/'");
    mm_menu_0701151423_0_5.addMenuItem("��ԡ���ͺ�����������ǹ�Ҫ�����","location='http://www.gits.net.th/services/gdirectory/'");
    mm_menu_0701151423_0_5.addMenuItem("��ԡ�ä���/����������Ҥ�Ѱ","location='http://www.gits.net.th/services/finder/'");
    mm_menu_0701151423_0_5.addMenuItem("�ٹ�����ʶԵ������","location='http://www.gits.net.th/services/truehits/'");
     mm_menu_0701151423_0_5.hideOnMouseOut=true;
     mm_menu_0701151423_0_5.menuBorder=1;
     mm_menu_0701151423_0_5.menuLiteBgColor='#ffffff';
     mm_menu_0701151423_0_5.menuBorderBgColor='#cccccc';
     mm_menu_0701151423_0_5.bgColor='#999999';
  window.mm_menu_0701151423_0 = new Menu("root",200,16,"MS Sans Serif, Thonburi",10,"#000000","#ffffff","#e9e7e7","#000099","left","middle",3,0,1000,-5,7,true,true,true,3,true,true);
  mm_menu_0701151423_0.addMenuItem(mm_menu_0701151423_0_1,"location='http://www.gits.net.th/services/govnetwork/'");
  mm_menu_0701151423_0.addMenuItem(mm_menu_0701151423_0_2,"location='http://www.gits.net.th/services/govapplication/'");
  mm_menu_0701151423_0.addMenuItem(mm_menu_0701151423_0_3,"location='http://www.gits.net.th/services/govca/'");
  mm_menu_0701151423_0.addMenuItem(mm_menu_0701151423_0_4,"location='http://www.gits.net.th/services/govsystemintegration/'");
  mm_menu_0701151423_0.addMenuItem(mm_menu_0701151423_0_5,"location='http://www.gits.net.th/services/govpublic/'");
   mm_menu_0701151423_0.hideOnMouseOut=true;
   mm_menu_0701151423_0.childMenuIcon="./images/arrows.gif";
   mm_menu_0701151423_0.menuBorder=1;
   mm_menu_0701151423_0.menuLiteBgColor='#ffffff';
   mm_menu_0701151423_0.menuBorderBgColor='#cccccc';
   mm_menu_0701151423_0.bgColor='#999999';
  window.mm_menu_0701151423_3 = new Menu("root",160,16,"MS Sans Serif, Thonburi",10,"#000000","#ffffff","#e9e7e7","#000099","left","middle",3,0,1000,-5,7,true,true,true,3,true,true);
  mm_menu_0701151423_3.addMenuItem("���ǧҹ��������Т��������","location='http://www.gits.net.th/news/index.php'");
  mm_menu_0701151423_3.addMenuItem("��ԡ������","location='http://www.gits.net.th/new_services/index.php'");
   mm_menu_0701151423_3.hideOnMouseOut=true;
   mm_menu_0701151423_3.menuBorder=1;
   mm_menu_0701151423_3.menuLiteBgColor='#ffffff';
   mm_menu_0701151423_3.menuBorderBgColor='#cccccc';
   mm_menu_0701151423_3.bgColor='#999999';
  window.mm_menu_0701151423_1 = new Menu("root",150,16,"MS Sans Serif, Thonburi",10,"#000000","#ffffff","#e9e7e7","#000099","left","middle",3,0,1000,-5,7,true,true,true,3,true,true);
   mm_menu_0701151423_1.addMenuItem("�������������� 76 �ѧ��Ѵ","location='http://www.gits.net.th/support/'");
  mm_menu_0701151423_1.addMenuItem("������ / �Ըա����ҹ","location='http://www.gits.net.th/support/'");
  mm_menu_0701151423_1.addMenuItem("����","location='http://www.gits.net.th/support/'");
   mm_menu_0701151423_1.hideOnMouseOut=true;
   mm_menu_0701151423_1.menuBorder=1;
   mm_menu_0701151423_1.menuLiteBgColor='#ffffff';
   mm_menu_0701151423_1.menuBorderBgColor='#cccccc';
   mm_menu_0701151423_1.bgColor='#999999';
  window.mm_menu_0715152034_4 = new Menu("root",73,16,"MS Sans Serif, Thonburi",10,"#000000","#ffffff","#e9e7e7","#000099","left","middle",3,0,1000,-5,7,true,true,true,3,true,true);
  mm_menu_0715152034_4.addMenuItem("������","location='http://www.gits.net.th/resources/index.php#article'");
  mm_menu_0715152034_4.addMenuItem("�͡��÷����","location='http://www.gits.net.th/resources/index.php#document'");
   mm_menu_0715152034_4.hideOnMouseOut=true;
   mm_menu_0715152034_4.menuBorder=1;
   mm_menu_0715152034_4.menuLiteBgColor='#ffffff';
   mm_menu_0715152034_4.menuBorderBgColor='#cccccc';
   mm_menu_0715152034_4.bgColor='#999999';

  mm_menu_0715152034_4.writeMenus();
}
