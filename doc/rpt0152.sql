SELECT BaseSubProduct.sub_pro_name,
BaseProduct.pro_name, userlogin.br_code, userlogin.userdetail,
SUM(Temp01.target_value),
SUM(Temp02.PlanCollectBuy_Unit),
SUM(Temp02.PlanCollectBuy_Sum),
SUM(Temp03.data1), SUM(Temp03.data2), SUM(Temp03.data3), 
SUM(Temp03.data4), SUM(Temp03.data5), SUM(Temp03.data6), 
SUM(Temp03.data7), SUM(Temp03.data8)

FROM userlogin, BaseSubProduct, BaseProduct, BaseReportHeader


/* เป้าหมายตามบันทึกข้อตกลง */
LEFT JOIN ( 
SELECT TargetTris.target_value,
TargetTris.report_detail_code, TargetTris.amccode 
FROM TargetTris 
WHERE target_year='2552' AND target_month='3' ) AS Temp01 
ON Temp01.report_detail_code = BaseReportHeader.report_detail_code 
AND Temp01.amccode=BaseReportHeader.amccode 

/* เป้าหมายการรวบรวม ผลิตผล ของ สกต. */
LEFT JOIN ( 
SELECT PlanCollectBuy.PlanCollectBuy_Sum, 
PlanCollectBuy.PlanCollectBuy_Unit, 
PlanCollectBuy.report_detail_code, PlanCollectBuy.amccode 
FROM PlanCollectBuy 
WHERE PlanCollectBuy.PlanCollectBuy_year='2552' ) AS Temp02 
ON Temp02.report_detail_code = BaseReportHeader.report_detail_code 
AND Temp02.amccode=BaseReportHeader.amccode 

/* ผลการรวบรวมระหว่างปี ตามบันทึกข้อตกลง  3  */
LEFT JOIN ( 
SELECT data1, data2, data3, data4, data5, 
data6, data7, data8, report_detail_code, amccode 
FROM ReportGroup3 
WHERE report_year='2552' AND report_month='12') AS Temp03 
ON Temp03.report_detail_code = BaseReportHeader.report_detail_code 
AND Temp03.amccode=BaseReportHeader.amccode 



WHERE BaseSubProduct.sub_pro_code = BaseProduct.sub_pro_code
AND BaseReportHeader.report_group_code = '3'
AND BaseReportHeader.report_detail_code =  BaseProduct.pro_code 
AND BaseReportHeader.amccode = userlogin.amccode
AND userlogin.status = 'N'


GROUP BY BaseSubProduct.sub_pro_name,
BaseProduct.pro_name, userlogin.br_code, userlogin.userdetail WITH ROLLUP

ORDER BY BaseSubProduct.sub_pro_name,BaseProduct.pro_name, userlogin.br_code