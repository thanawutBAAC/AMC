<?session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="images/lib/mainstyle.css" rel="stylesheet" type="text/css">
<link href="images/css/style.css" rel="stylesheet" type="text/css">
</head>
<script language="JavaScript">
var arrDiv = new Array();
arrDiv[0] = new Array('00-��������-','01�Ҥ�˹�͵͹��','02�Ҥ�˹�͵͹��ҧ','03�Ҥ���ѹ�͡��§�˹�͵͹��','04�Ҥ���ѹ�͡��§�˹�͵͹��ҧ','05�Ҥ��ҧ','06�Ҥ���ѹ�͡','07�Ҥ���ѹ��','08�Ҥ��͹��','09�Ҥ��͹��ҧ');
var arrData = new Array();
arrData[01] = new Array('57��§���','50��§����','55��ҹ','56�����','54���','58�����ͧ�͹','52�ӻҧ','51�Ӿٹ');
arrData[02] = new Array('53�صôԵ��','60������ä�','61�ط�¸ҹ�','62��ᾧྪ�','63�ҡ','64��⢷��','65��ɳ��š','66�ԨԵ�','67ྪú�ó�');
arrData[03] = new Array('39˹ͧ�������','40�͹��','41�شøҹ�','42���','43˹ͧ���','44�����ä��','45�������','46����Թ���','47ʡŹ��','48��þ��','49�ء�����');
arrData[04] = new Array('30����Ҫ����','31���������','32���Թ���','33�������','34�غ��Ҫ�ҹ�','35��ʸ�','36�������','37�ӹҨ��ԭ');
arrData[05] = new Array('10��ا෾��ҹ��','12�������','13�����ҹ�','14��й�������ظ��','15��ҧ�ͧ','16ž����','17�ԧ�����','18��¹ҷ','19��к���');
arrData[06] = new Array('11��طû�ҡ��','20�ź���','21���ͧ','22�ѹ�����','23��Ҵ','24���ԧ���','25��Ҩչ����','26��ù�¡','27������');
arrData[07] = new Array('70�Ҫ����','71�ҭ������','72�ؾ�ó����','73��û��','74��ط��Ҥ�','75��ط�ʧ����','76ྪú���','77��ШǺ���բѹ��');
arrData[08] = new Array('81��к��','82�ѧ��','83����','84����ɮ��ҹ�','85�йͧ','86�����');
arrData[09] = new Array('80�����ո����Ҫ','90ʧ���','91ʵ��','92��ѧ','93�ѷ�ا','94�ѵ�ҹ�','95����','96��Ҹ����');
var arrBrn = new Array();
arrBrn[10] = new Array('1001ࢵ��й��','1002ࢵ���Ե','1003ࢵ˹ͧ�͡','1004ࢵ�ҧ�ѡ','1005ࢵ�ҧࢹ','1006ࢵ�ҧ�л�','1007ࢵ�����ѹ','1008ࢵ������Һ�ѵ�پ���','1009ࢵ���⢹�','1010ࢵ�չ����','1011ࢵ�Ҵ��кѧ','1012ࢵ�ҹ����','1013ࢵ����ѹ�ǧ��','1014ࢵ����','1015ࢵ������','1016ࢵ�ҧ�͡�˭�','1017ࢵ���¢�ҧ','1018ࢵ��ͧ�ҹ','1019ࢵ���觪ѹ','1020ࢵ�ҧ�͡����','1021ࢵ�ҧ�ع��¹','1022ࢵ������ԭ','1023ࢵ˹ͧ��','1024ࢵ��ɮ���ó�','1025ࢵ�ҧ��Ѵ','1026ࢵ�Թᴧ','1027ࢵ�֧����','1028ࢵ�ҷ�','1029ࢵ�ҧ����','1030ࢵ��بѡ�','1031ࢵ�ҧ������','1032ࢵ������','1033ࢵ��ͧ��','1034ࢵ�ǹ��ǧ','1035ࢵ����ͧ','1036ࢵ�͹���ͧ','1037ࢵ�Ҫ���','1038ࢵ�Ҵ�����','1039ࢵ�Ѳ��','1040ࢵ�ҧ�','1041ࢵ��ѡ���','1042ࢵ������','1043ࢵ�ѹ�����','1044ࢵ�оҹ�٧','1045ࢵ�ѧ�ͧ��ҧ','1046ࢵ��ͧ�����','1047ࢵ�ҧ��','1048ࢵ����Ѳ��','1049ࢵ��觤��','1050ࢵ�ҧ�͹'); 
arrBrn[11] = new Array('1106�������ͺҧ��Ҹ�','1102�ҧ���','1103�ҧ���','1104��л��ᴧ','1105�����ط�਴���','1101���ͧ��طû�ҡ��');
arrBrn[12] = new Array('1205�ù���','1202�ҧ����','1204�ҧ��Ƿͧ','1203�ҧ�˭�','1206�ҡ���','1201���ͧ�������');
arrBrn[13] = new Array('1302��ͧ��ǧ','1303�ѭ����','1301���ͧ�����ҹ�','1305�Ҵ�������','1306���١��','1307���⤡','1304˹ͧ����');
arrBrn[14] = new Array('1402�������','1403�����ǧ','1413�ҧ����','1405�ҧ���','1407�ҧ���ѹ','1406�ҧ���Թ','1404�ҧ��','1416��ҹ�á','1408�ѡ���','1401��й�������ظ��','1409�Ҫ�','1415����Ҫ','1410�Ҵ�����ǧ','1411�ѧ����','1412�ʹ�','1414�ط��');
arrBrn[15] = new Array('1502���','1503������','1504⾸��ͧ','1501���ͧ��ҧ�ͧ','1506����ɪ�ªҭ','1507�����','1505��ǧ��');
arrBrn[16] = new Array('1603⤡���ç','1609⤡��ԭ','1604��ºҴ��','1605������','1607�����ǧ','1606��ҹ����','1602�Ѳ�ҹԤ�','1601���ͧž����','1610��ʹ��','1608����ʶ�','1611˹ͧ��ǧ');
arrBrn[17] = new Array('1703���ºҧ�Шѹ','1705��Ҫ�ҧ','1702�ҧ�Шѹ','1704��������','1701���ͧ�ԧ�����','1706�Թ������');
arrBrn[18] = new Array('1807��������˹ͧ�����','1808���������Թ���','1801���ͧ��¹ҷ','1802������','1803�Ѵ�ԧ��','1805��ä����','1804��þ��','1806�ѹ��');
arrBrn[19] = new Array('1902�觤��','1913����������õ�','1907�͹�ش','1906��ҹ���','1909��оط��ҷ','1911�ǡ����','1901���ͧ��к���','1912�ѧ��ǧ','1904�����ᴧ','1910������','1903˹ͧ�','1905˹ͧ᫧','1908˹ͧⴹ');
arrBrn[20] = new Array('2011����������Шѹ���','2008����ժѧ','2004�ҧ���ا','2010��ͷͧ','2002��ҹ�֧','2006���ʹԤ�','2005�ҹ�ͧ','2001���ͧ�ź���','2007����Ҫ�','2009�ѵ�պ','2003˹ͧ�˭�');
arrBrn[21] = new Array('2108�������͹Ԥ��Ѳ��','2107���������Ҫ����','2103�ŧ','2105��ҹ����','2102��ҹ�ҧ','2106��ǡᴧ','2101���ͧ���ͧ','2104�ѧ�ѹ���');
arrBrn[22] = new Array('2210���������ҤԪ��ٯ','2208���ҧ���','2202��ا','2203�������','2209��������','2204�觹����͹','2205�Т��','2201���ͧ�ѹ�����','2207��´��','2206�����ԧ��');
arrBrn[23] = new Array('2306����������Сٴ','2307����������Ъ�ҧ','2303����ԧ','2302��ͧ�˭�','2304������','2301���ͧ��Ҵ','2305�����ͺ');
arrBrn[24] = new Array('2411�������ͤ�ͧ���͹','2410��ҵ���º','2402�ҧ����','2403�ҧ���������','2404�ҧ�С�','2405��ҹ⾸��','2409�ŧ���','2406�����ä��','2401���ͧ���ԧ���','2407�Ҫ����','2408ʹ�����ࢵ');
arrBrn[25] = new Array('2502��Թ������','2503�Ҵ�','2506��ҹ���ҧ','2507��Шѹ����','2501���ͧ��Ҩչ����','2508������⾸�','2509������ʶ');
arrBrn[26] = new Array('2603��ҹ��','2602�ҡ���','2601���ͧ��ù�¡','2604ͧ��ѡ��');
arrBrn[77] = new Array('2709���������ѧ����ó�','2708��������⤡�٧','2707�ҩ��è�','2702��ͧ�Ҵ','2703�Ҿ����','2701���ͧ������','2704�ѧ������','2705�Ѳ�ҹ��','2706��ѭ�����');
arrBrn[30] = new Array('3030�������ͺ�����','3028�������;�зͧ��','3029���������ӷ�������','3031���������մ�','3026��������෾��ѡ��','3027�����������ͧ�ҧ','3023��ʹ���ҧ','3019���������','3011�������ʧ','3004��','3002�ú���','3006�ѡ�Ҫ','3032����������õ�','3017����ǧ','3007⪤���','3008��ҹ�ع��','3010⹹�٧','3024⹹ᴧ','3009⹹��','3012����˭�','3005��ҹ�������','3013��з��','3014�ѡ�����','3021�ҡ��ͧ','3015�����','3001���ͧ����Ҫ����','3025�ѧ�������','3020�դ���','3018�٧�Թ','3003��ԧ�ҧ','3022˹ͧ�ح�ҡ','3016�����ŧ');
arrBrn[31] = new Array('3103����ѧ','3121�������ͺ�ҹ��ҹ','3122��������᤹��','3102�����ͧ','3123����������õ�','3118�ӹ�','3104�ҧ�ͧ','3113��⾸��','3120⹹�Թᴧ','3117⹹����ó','3108��ҹ��Ǵ','3119��ҹ�����¾���','3107���⤹���','3112�Ф�','3115��Ѻ��Ҫ��','3109�ط�ʧ','3101���ͧ���������','3106���ҹ����','3110�ӻ������','3111ʵ֡','3105˹ͧ���','3114˹ͧ˧��','3116�����Ҫ');
arrBrn[32] = new Array('3206�Һ�ԧ','3214�������;�����ѡ','3215����������ճç��','3216������������Թ�Թ���','3217��������⹹����³�','3204������','3202����ź���','3203��ҵ��','3213���઴','3205����ҷ','3201���ͧ���Թ���','3207�ѵ�����','3211�Ӵǹ','3209�բ�����','3208ʹ�','3210�ѧ��','3212���ç�Һ');
arrBrn[33] = new Array('3304�ѹ���ѡ��','3303�ѹ�������','3322�������������Ҵ','3321��������⾸���������ó','3305�آѹ��','3308�ع�ҭ','3313⹹�ٳ','3315�������§','3311�֧��þ�','3319ອ��ѡ��','3307��ҧ����','3320�����','3306�ú֧','3317���ԧ��','3318���ͧ�ѹ���','3301���ͧ�������','3302�ҧ�������','3309�������','3316�ѧ�Թ','3314����ѵ��','3312���·Ѻ�ѹ','3310�ط���þ����');
arrBrn[34] = new Array('3412�ش���ǻ��','3405���Ұ','3404���ͧ�','3403⢧����','3424�͹��ᴧ','3407പ�ش�','3411��С�þת��','3420������','3408�Ҩ�����','3409����׹','3410�س��ԡ','3419�Ժ���ѧ�����','3421⾸����','3401���ͧ�غ��Ҫ�ҹ�','3414��ǧ����Ժ','3415���Թ���Һ','3402������ͧ����','3422���ç','3425���Թ��','3426�������ش�','3429�������͹�����','3430�������͹ҵ��','3431�������������������');
arrBrn[35] = new Array('3503�ش���','3504�����͹���','3507����ѧ','3502�������','3509����ԭ','3505��ҵ���','3506��Ҫ�Ъ��','3501���ͧ��ʸ�','3508��ԧ����');
arrBrn[36] = new Array('3616�������ͫѺ�˭�','3604�ɵ�����ó�','3612�駤���','3603�͹���ä�','3613�͹���','3606�ѵ����','3609෾ʶԵ','3615�Թʧ��','3607���˹稳ç��','3602��ҹ����','3611��ҹ��','3614�ѡ�ժ����','3610������','3601���ͧ�������','3608˹ͧ��������','3605˹ͧ���ᴧ');
arrBrn[37] = new Array('3702�ҹ��ҹ','3703�����Ҫǧ��','3704���','3701���ͧ�ӹҨ��ԭ','3707����ӹҨ','3705�ʹҧ��Ԥ�','3706��ǵоҹ');
arrBrn[39] = new Array('3902�ҡ�ҧ','3906���ѧ','3903⹹�ѧ','3901���ͧ˹ͧ�������','3904��պح���ͧ','3905����ó����');
arrBrn[40] = new Array('4009��йǹ','4021�������ͫ��٧','4024�������ͺ�ҹ�δ','4023��������˹ͧ�Ҥ�','4022��������⤡⾸����','4025��������⹹����','4019���ǹ��ҧ','4018����','4005����','4007��Ӿͧ','4002��ҹ�ҧ','4010��ҹ��','4011���¹���','4003����׹','4012���ͧ��','4020�ټ���ҹ','4016�����§','4017�ѭ�Ҥ���','4001���ͧ�͹��','4014�ǧ����','4013�ǧ�˭�','4006�ժ���','4015˹ͧ�ͧ��ͧ','4004˹ͧ����','4008�غ��ѵ��');
arrBrn[41] = new Array('4102�ش�Ѻ','4104�����һ�','4108���ҹ','4107��觽�','4105⹹���Ҵ','4118������','4111��ҹ�ا','4117��ҹ���','4119��','4101���ͧ�شøҹ�','4110�ѧ������','4109��ոҵ�','4120���ҧ���','4103˹ͧ��ǫ�','4106˹ͧ�ҹ','4121˹ͧ�ʧ','4122���٧','4123�Ժ�����ѡ��','4124�������͡�����','4125�������ͻ�Шѡ����ŻҤ�');
arrBrn[42] = new Array('4214��������˹ͧ�Թ','4213�������������ѳ','4203��§�ҹ','4205��ҹ����','4208������','4202�Ҵ�ǧ','4206������','4204�ҡ��','4212�Ң��','4210�١�д֧','4211����ǧ','4207������','4201���ͧ���','4209�ѧ�оا');
arrBrn[43] = new Array('4316���������ѵ��һ�','4314�������������','4315��������������','4317��������⾸��ҡ','4309ૡ�','4306������','4302��Һ��','4303�֧���','4311�֧⢧�ŧ','4313��觤���','4310�ҡ�Ҵ','4304����ԭ','4305⾹�����','4301���ͧ˹ͧ���','4312�������','4307�����§����','4308�ѧ��');
arrBrn[44] = new Array('4404�ѹ���Ԫ��','4412�������͡ش�ѧ','4413�������ͪ�蹪�','4402ᡴ�','4403���������','4405��§�׹','4410�Ҵٹ','4407����͡','4406�ú��','4408��Ѥ����Ծ����','4401���ͧ�����ä��','4411�ҧ�����Ҫ','4409�һջ���');
arrBrn[45] = new Array('4520�������ͷ������ǧ','4519��������˹ͧ��','4518����������§��ѭ','4502�ɵ������','4504���þѡ�þ��ҹ','4517�ѧ���','4505��Ѫ����','4503�����ѵ��','4506�����','4508⾸����','4513⾹����','4507⾹�ͧ','4515���Ǵ�','4501���ͧ�������','4512���ͧ��ǧ','4516�������','4511����ó����','4510�������','4509˹ͧ�͡','4514�Ҩ����ö');
arrBrn[46] = new Array('4603�������','4618�������ͦ�ͧ���','4617�������ʹ͹�ҹ','4616�������͹Ҥ�','4615��������������','4605�ةԹ���³�','4606��ǧ','4610����ǧ','4611��Ҥѹ�','4602����','4601���ͧ����Թ���','4607�ҧ��Ҵ','4604��ͧ��','4613����','4609���ʢѹ��','4612˹ͧ�ا���','4614���¼��','4608�������');
arrBrn[47] = new Array('4703�ش�ҡ','4702���������','4709�ӵҡ���','4715⤡����ؾ�ó','4716��ԭ��Ż�','4714��ҧ��','4707�Ԥ�����ٹ','4710��ҹ��ǧ','4704��óҹԤ�','4705�ѧ⤹','4717⾹�����','4718�پҹ','4701���ͧʡŹ��','4708�ҹù����','4706���Ԫ����','4712���ҧᴹ�Թ','4713��ͧ���','4711�ҡ���ӹ��');
arrBrn[48] = new Array('4812���������ѧ�ҧ','4803�����෹','4805�ҵؾ��','4811�ҷ�','4809������','4807���','4804��ҹᾧ','4802��һҡ','4810⾹���ä�','4801���ͧ��þ��','4806�óٹ��','4808���ʧ����');
arrBrn[49] = new Array('4905�Ӫ���','4904����ǧ','4903�͹���','4902�Ԥ��������','4901���ͧ�ء�����','4907˹ͧ�٧','4906���ҹ�˭�');
arrBrn[50] = new Array('5024�������ʹ������','5023������������͹','5002����ͧ','5004��§���','5021�»�ҡ��','5005�������','5017������','5009�ҧ','5011�����','5001���ͧ��§����','5007������','5022����ҧ','5010������','5003������','5006���ᵧ','5020���§�˧','5008����ԧ','5013�ѹ��ᾧ','5014�ѹ����','5012�ѹ��ҵͧ','5019�����','5015�ҧ��','5018������','5016�ʹ');
arrBrn[51] = new Array('5108�����������§˹ͧ��ͧ','5105�����Ǫ�ҧ','5107��ҹ��','5103��ҹ���','5106��ҫҧ','5101���ͧ�Ӿٹ','5102����','5104���');
arrBrn[52] = new Array('5203��Ф�','5205���','5206�����','5208�Թ','5213���ͧ�ҹ','5201���ͧ�ӻҧ','5210����','5209����ԡ','5202�������','5207�ѧ�˹��','5211ʺ��Һ','5204��������','5212��ҧ�ѵ�');
arrBrn[53] = new Array('5302��͹','5309�ͧ�ʹ�ѹ','5303��һ��','5304��ӻҴ','5306��ҹ⤡','5307�Ԫ��','5305�ҡ���','5301���ͧ�صôԵ��','5308�Ѻ��');
arrBrn[54] = new Array('5405�蹪��','5401���ͧ���','5402��ͧ��ҧ','5403�ͧ','5407�ѧ���','5406�ͧ','5404�٧���','5408˹ͧ��ǧ��');
arrBrn[55] = new Array('5514������������§','5515����������õ�','5509��§��ҧ','5508��觪�ҧ','5506����ѧ��','5504�ҹ���','5510������','5512�������','5503��ҹ��ǧ','5505���','5501���ͧ��ҹ','5502������','5507���§��','5513�ͧ��','5511�ѹ���آ');
arrBrn[56] = new Array('5609���������١�����','5608���������٫ҧ','5602�ع','5603��§��','5604��§��ǹ','5605�͡����','5606��','5601���ͧ�����','5607����');
arrBrn[57] = new Array('5718�������ʹ����ǧ','5717�����������§��§���','5714�ع���','5703��§�ͧ','5708��§�ʹ','5704�ԧ','5706���ᴴ','5712���������','5705�ҹ','5701���ͧ��§���','5707���ѹ','5715�������ǧ','5716������','5710�������','5709������','5702���§���','5711���§������','5713���§��');
arrBrn[58] = new Array('5802�ع���','5807�ҧ�м��','5803���','5801���ͧ�����ͧ�͹','5805����ҹ���','5804��������§','5806ʺ���');
arrBrn[60] = new Array('6015�������ͪ���Һ�','6014������������Թ','6006���������','6002�á���','6003����ʧ','6012�ҡ���','6007�Ҥ��','6008��ҵ��','6005��þ������','6010����Ф���','6009�����','6001���ͧ������ä�','6013���ǧ��','6011�Ҵ���','6004˹ͧ���');
arrBrn[61] = new Array('6102�Ѿ�ѹ','6106��ҹ���','6101���ͧ�ط�¸ҹ�','6107�ҹ�ѡ','6103���ҧ������','6105˹ͧ�����ҧ','6104˹ͧ�ҧ','6108���¤�');
arrBrn[62] = new Array('6210�������ͺ֧���Ѥ��','6211�������������չ��','6204�ҳ����ѡɺ���','6205��ͧ��ا','6203��ͧ�ҹ','6208���·ͧ�Ѳ��','6202�ç��','6209�ҧ���ҷͧ','6206��ҹ��е���','6201���ͧ��ᾧྪ�','6207�ҹ��к��');
arrBrn[63] = new Array('6309���������ѧ���','6305����ͧ�ҧ','6302��ҹ�ҡ','6307�����','6301���ͧ�ҡ','6304������Ҵ','6306����ʹ','6303�����','6308�����ҧ');
arrBrn[64] = new Array('6404�������','6403�������','6409����������','6402��ҹ��ҹ�ҹ���','6401���ͧ��⢷��','6408��չ��','6405����Ѫ�����','6406������ç','6407���ä�š');
arrBrn[65] = new Array('6503�ҵԵ�С��','6502�����','6509�Թ�л�ҧ','6505�ҧ��з���','6504�ҧ�С�','6506���������','6501���ͧ��ɳ��š','6508�ѧ�ͧ','6507�Ѵ�ʶ�');
arrBrn[66] = new Array('6611�������ʹ���ԭ','6610�������ͺ֧���ҧ','6609���������ҡ����','6604�оҹ�Թ','6608�Ѻ����','6605�ҧ��Źҡ','6606⾷���','6603⾸���зѺ��ҧ','6601���ͧ�ԨԵ�','6612Ǫ�ú����','6602�ѧ���¾ٹ','6607�������');
arrBrn[67] = new Array('6711�Ҥ��','6702��ᴹ','6709���˹��','6708�֧����ѹ','6701���ͧྪú�ó�','6710�ѧ��','6705�����ú���','6706���෾','6707˹ͧ��','6703�����ѡ','6704�������');
arrBrn[70] = new Array('7010�������ͺ�ҹ��','7002����֧','7004���Թ�дǡ','7006�ҧ�','7005��ҹ��','7008�ҡ���','7007⾸����','7001���ͧ�Ҫ����','7009�Ѵ�ŧ','7003�ǹ���');
arrBrn[71] = new Array('7111��ҹ�Т������','7107�ͧ������','7102���¤','7105����С�','7106�����ǧ','7103��;���','7109����ǹ','7101���ͧ�ҭ������','7110��Ң�ѭ','7104������ʴ��','7108�ѧ��к���','7112˹ͧ����','7113���¡����');
arrBrn[72] = new Array('7206�͹਴���','7202����ҧ�ҧ�Ǫ','7203��ҹ��ҧ','7204�ҧ������','7201���ͧ�ؾ�ó����','7205��ջ�Шѹ��','7207�ͧ����ͧ','7208����ء','7210˹ͧ˭���','7209���ͧ');
arrBrn[73] = new Array('7302��ᾧ�ʹ','7304�͹���','7303��ê�����','7305�ҧ�Ź','7307�ط�����','7301���ͧ��û��','7306�����ҹ');
arrBrn[74] = new Array('7402��з���ẹ','7403��ҹ���','7401���ͧ��ط��Ҥ�');
arrBrn[75] = new Array('7502�ҧ����','7501���ͧ��ط�ʧ����','7503������');
arrBrn[76] = new Array('7608�觡�Шҹ','7602������','7604����','7605����ҧ','7606��ҹ�Ҵ','7607��ҹ����','7601���ͧྪú���','7603˹ͧ˭�һ��ͧ');
arrBrn[77] = new Array('7708����������������ʹ','7702��º���','7703�Ѻ���','7704�ҧ�оҹ','7705�ҧ�оҹ����','7706��ҳ����','7701���ͧ��ШǺ���բѹ��','7707����Թ');
arrBrn[80] = new Array('8022�������ͪ�ҧ��ҧ','8021�������͹��Ե�','8015����','8019�����ó�','8004��ҧ','8023����������õ�','8007���Ǵ','8006�����˭�','8018��Ӿ�ó��','8009���ʧ','8011����˭�','8008�������','8010�Һ͹','8017�ҧ�ѹ','8012�ҡ��ѧ','8002��������','8020��о���','8005�Իٹ','8001���ͧ�����ո����Ҫ','8013��͹�Ժ����','8003�ҹʡ�','8014�Ԫ�','8016�����');
arrBrn[81] = new Array('8103����ѹ��','8102�Ҿ��','8104��ͧ����','8106���¾����','8101���ͧ��к��','8107�ӷѺ','8108�˹�ͤ�ͧ','8105�����֡');
arrBrn[82] = new Array('8203�л�','8202������','8206���к���','8204�С��Ƿ��','8205�С��ǻ��','8207�Ѻ�ش','8208��������ͧ','8201���ͧ�ѧ��');
arrBrn[83] = new Array('8302�з��','8303��ҧ','8301���ͧ����');
arrBrn[84] = new Array('8402�ҭ����ɰ�','8419������������Ǵ�','8405��оЧѹ','8404�������','8408�����Ѱ�Ԥ�','8414��¹��','8418��º���','8406���','8403�͹�ѡ','8411��ҩҧ','8407��Ҫ��','8409��ҹ�Ңع','8412��ҹ�����','8413��ҹ�����','8410���','8416����ʧ','8417�ع�Թ','8401���ͧ����ɮ��ҹ�','8415���§���');
arrBrn[85] = new Array('8504��к���','8503������','8505���������آ���ҭ','8501���ͧ�йͧ','8502�����');
arrBrn[86] = new Array('8608��觵��','8602�����','8603�з��','8606�����','8601���ͧ�����','8605����','8607���','8604��ѧ�ǹ');
arrBrn[90] = new Array('9008������Թ���','9016��ͧ�����','9013�ǹ��§','9003�й�','9005෾�','9004�ҷ��','9012�������','9014�ҧ����','9001���ͧʧ���','9007��⹴','9009�ѵ����','9002ʷԧ���','9006�к������','9010����','9015�ԧ˹��','9011�Ҵ�˭�');
arrBrn[91] = new Array('9107���������йѧ','9103�ǹ���ŧ','9102�ǹⴹ','9106�������','9104����','9101���ͧʵ��','9105�Ч�');
arrBrn[92] = new Array('9202�ѹ�ѧ','9210���������Ҵ���ҭ','9208���§','9204������¹','9201���ͧ��ѧ','9203��ҹ�Ң��','9209��ɮ�','9207�ѧ�����','9205����','9206�����ʹ');
arrBrn[93] = new Array('9302�����','9311����������չ��Թ���','9303�Ҫ��ʹ','9305�ǹ��ع','9304������','9309�ҧ���','9306�ҡ���ٹ','9308��Һ͹','9310��Ҿ����','9301���ͧ�ѷ�ا','9307��պ�þ�');
arrBrn[94] = new Array('9411�о��','9402⤡⾸��','9406����ҧᴧ','9404�й����','9405����','9401���ͧ�ѵ�ҹ�','9412����ҹ','9408�����','9410���ѧ','9409������','9407��º���','9403˹ͧ�ԡ');
arrBrn[95] = new Array('9507�Һѧ','9508�������͡ç�Թѧ','9504����','9503�ѹ�ѧʵ�','9502ີ�','9501���ͧ����','9505����','9506���ѹ');
arrBrn[96] = new Array('9612����','9613�������ͧ','9602�ҡ�','9603�����','9601���ͧ��Ҹ����','9604����','9605����','9606�������','9608���','9607����Ҥ�','9609�ؤ��Թ','9611���˧�Ҵ�','9610���˧�-š');
</script>

<script language="javascript">				
function listData(id){			
	if(id!=""){		
		var objData =eval("arrData["+id+"]");
		var strOpt = "";
		
		document.forms(0).list_province.innerHTML ="";
		//document.forms(0).branch.innerHTML ="";
		if (id==0) {			
			addOption("------�ѧ��Ѵ------",""); }
		else {	
			addOption("------�ѧ��Ѵ------","");
			for(x=0;x<objData.length;x++){
				addOption(objData[x],objData[x].substring(0,2));
			}		
		}
		//var objData =eval("arrBrn["+id+"]");
		//addOptionBrn("------�����------","");
	}
}

function addOption(text,value){
	var oOption = document.createElement("OPTION");
	document.forms(0).list_province.options.add(oOption);
	oOption.innerText =text.substring(2,text.length);
	oOption.value = value;
}	
	
/*-----------------------------------------------------------------------*/
function listBrn(id){
	if(id!=""){	
		var objBrn =eval("arrBrn["+id+"]");
		var strOpt = "";
	
		document.forms(0).branch.innerHTML ="";
		
			addOptionBrn("------�����------","");
			for(x=0;x<objBrn.length;x++){
				addOptionBrn(objBrn[x],objBrn[x].substring(0,4));
			}
	}
	else {
		document.forms(0).branch.innerHTML ="";
		addOptionBrn("------�����------","");		
	}
}
	
function addOptionBrn(text,value){
	var oOption = document.createElement("OPTION");
	document.forms(0).branch.options.add(oOption);
	oOption.innerText =text.substring(4,text.length);
	oOption.value = value;
}	

function listDiv(id){		
var id1;
	if(id!=""){	
		id1=id;
		id = 0;		
		var objDiv =eval("arrDiv["+id+"]");
		var strOpt = "";	
		document.forms(0).div.innerHTML ="";	
		for(x=0;x<objDiv.length;x++){		 
			addOptionDiv(objDiv[x],objDiv[x].substring(0,1));
		}	
		document.forms(0).div.value= id1;
	}
}
function addOptionDiv(text,value){
	var oOption = document.createElement("OPTION");
	document.forms(0).div.options.add(oOption);
	oOption.innerText =text.substring(1,text.length);
	oOption.value = value;
}	

function bodyOnLoad() {
	//document.forms[0].txt_CommitteeSocial.disabled=true;
	//document.forms[0].list_degree.disabled=true;
		document.form1.list_personnel.disabled=true;
	document.form1.list_personnel.disabled=true;

}


function chkEdu(x){
	if(x<"3"){
		document.forms[0].list_degree.disabled=true;
	}else{
		document.forms[0].list_degree.disabled=false;
	}
}

 function check_number() {
e_k=event.keyCode
//if (((e_k < 48) || (e_k > 57)) && e_k != 46 ) {
if (e_k != 13 && (e_k < 48) || (e_k > 57)) {
event.returnValue = false;
alert("��ͧ�繵���Ţ��ҹ��... \n��سҵ�Ǩ�ͺ�����Ţͧ��ҹ�ա����...");
}
}

</script>

<body background="images/bg.jpg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="bodyOnLoad();">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="80%" height="30" valign="bottom" class="boxleft50"><img src="images/report_trainning.gif" width="226" height="21"></td>
    <td width="20%" align="right" valign="middle" class="boxright15"><span class="txtmicrosoftsan8px"><span class="txtwhite"> 
      </span></span></td>
  </tr>
  <tr>
    <td height="120" colspan="2" align="center" valign="top"><form name="form1" method="get" action="rpt_testing_report.php" target="AssetMain" >
        <table width="98%" border="0" cellpadding="0" cellspacing="1" bgcolor="E5EEF9">
          <tr> 
            <td><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#B5D5F1">
                <tr> 
                  <td bgcolor="#E5EEF9"><table border="0" cellpadding="0" cellspacing="0" bgcolor="#E5EEF9" class="font1">
                      <tr> 
                        <td width="22" height="25" align="center" valign="middle"><input type="radio" name="rdo_type" value="committee" checked   onFocus="document.form1.list_personnel.disabled=true; document.form1.list_committee.disabled=false" > 
                        </td>
                        <td width="68">��С������</td>
                        <td width="47" align="right">���˹� :&nbsp; </td>
                        <td width="124"><select name="list_committee" style="WIDTH: 120px">
                            <option value="">���͡���˹�</option>
                            <option value="01">��иҹ�������</option>
                            <option value="02">�ͧ��иҹ���ҡ��</option>
                            <option value="03">�Ţҹء��</option>
                            <option value="04">���ѭ�ԡ</option>
                            <option value="05">��С������</option>
                          </select></td>
                        <td width="1" bgcolor="#B5D5F1"> </td>
                        <td width="89" align="right" class="boxleft10">���ʻ�ЪҪ� 
                          : </td>
                        <td width="100"><input name="txt_user_id" type="text" style="WIDTH: 100px; HEIGHT:17.5px; FONT-SIZE: 7pt; MARGIN: 0px; FONT-FAMILY: " maxlength="13"tahoma""; onkeypress=check_number();> 
                        </td>
                        <td width="174" align="left">&nbsp;</td>
                        <td width="1" align="left" bgcolor="#B5D5F1"> </td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="10" align="center" valign="middle" bgcolor="#B5D5F1"> 
                        </td>
                      </tr>
                      <tr> 
                        <td height="25" align="center" valign="middle"><input type="radio" name="rdo_type" value="personnel" onFocus="document.form1.list_committee.disabled=true; document.form1.list_personnel.disabled=false" > 
                        </td>
                        <td>��ѡ�ҹ</td>
                        <td align="right">���˹� :&nbsp; </td>
                        <td><select name="list_personnel" style="WIDTH: 120px">
                            <option value="">���͡���˹�</option>
                            <option value="01">���Ѵ���</option>
                            <option value="02">�ѡ�ҡ�ü��Ѵ���</option>
                            <option value="03">�����¼��Ѵ���</option>
                            <option value="04">�ѡ�ҡ�ü����¼��Ѵ���</option>
                            <option value="05">�����ѭ��</option>
                            <option value="06">���˹�ҷ��ѭ��</option>
                            <option value="07">���˹�ҷ�����Թ</option>
                            <option value="08">���˹�ҷ���õ�Ҵ</option>
                            <option value="09">���˹�ҷ���á��</option>
                            <option value="10">�ѡ�������ç</option>
                            <option value="11">��ѡ�ҹ�Ѻö</option>
                          </select></td>
                        <td bgcolor="#B5D5F1"> </td>
                        <td align="right" class="boxleft10">���� :&nbsp;&nbsp;</td>
                        <td><input name="txt_name" type="text" style="WIDTH: 100px; HEIGHT:17.5px; FONT-SIZE: 7pt; MARGIN: 0px; FONT-FAMILY: " maxlength="30"tahoma"";> 
                        </td>
                        <td align="left">&nbsp;</td>
                        <td width="1" align="left" bgcolor="#B5D5F1"> </td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="10" align="center" valign="middle" bgcolor="#B5D5F1"> 
                        </td>
                      </tr>
                      <tr> 
                        <td height="25" align="center" valign="middle">&nbsp;</td>
                        <td colspan="2" align="right">���¡Ԩ����Ң� :&nbsp;</td>
                        <td align="left"><select  style="WIDTH: 120px"  name="div" onChange="javascript:listData(this.value)">
                            <option value="">--��������--</option>
                            <option value="1">���¡Ԩ����Ң� 1</option>
                            <option value="2">���¡Ԩ����Ң� 2</option>
                            <option value="3">���¡Ԩ����Ң� 3</option>
                            <option value="4">���¡Ԩ����Ң� 4</option>
                            <option value="5">���¡Ԩ����Ң� 5</option>
                            <option value="6">���¡Ԩ����Ң� 6</option>
                            <option value="7">���¡Ԩ����Ң� 7</option>
                            <option value="8">���¡Ԩ����Ң� 8</option>
                            <option value="9">���¡Ԩ����Ң� 9</option>
                          </select></td>
                        <td width="1" align="left" bgcolor="#B5D5F1" > </td>
                        <td align="right" class="boxleft5">���ʡ�� :&nbsp;</td>
                        <td align="left"><input name="txt_lastname" type="text" style="WIDTH: 100px; HEIGHT:17.5px; FONT-SIZE: 7pt; MARGIN: 0px; FONT-FAMILY: " maxlength="30"tahoma"";></td>
                        <td align="left">&nbsp;</td>
                        <td width="1" align="left" bgcolor="#B5D5F1"> </td>
                      </tr>
                      <tr> 
                        <td height="1" colspan="10" align="center" valign="middle" bgcolor="#B5D5F1"> 
                        </td>
                      </tr>
                      <tr> 
                        <td height="25" align="center" valign="middle"><input type="hidden" name="type" value="search"></td>
                        <td colspan="2" align="right">�ѧ��Ѵ :&nbsp;</td>
                        <td align="left"><span class=normal-navyblue> 
                          <select style="WIDTH: 120px" name="list_province">
                            <option value="">--�ӹѡ�ҹ�ѧ��Ѵ--</option>
                          </select>
                          </span></td>
                        <td width="1" align="left" bgcolor="#B5D5F1" > </td>
                        <td align="right" class="boxleft5">��Ǵ�Ԫ� : </td>
                        <td align="left"><select name="education" style="WIDTH: 120px">
                            <option value="">���͡��ѡ�ٵ�</option>
                            <option value="01">��úѭ��/����Թ</option>
                            <option value="02">��ú�����/��èѴ���</option>
                            <option value="03">��õ�Ҵ</option>
                            <option value="04">�ˡó�</option>
                            <option value="05">����</option>
                          </select> </td>
                        <td align="left">&nbsp;</td>
                        <td width="1" align="left" bgcolor="#B5D5F1"> </td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
            <td width="70" align="center" bgcolor="#FBA404"><INPUT name="submit222" TYPE="submit" class="formButton" value="Submit"></td>
          </tr>
        </table>
        <br>
      </form>
   
    </td>
  </tr>
</table>
</body>
</html>
