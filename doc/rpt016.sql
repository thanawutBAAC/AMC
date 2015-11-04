SELECT BaseSubProduct.sub_pro_name,
BaseProduct.pro_name, userlogin.br_code, userlogin.userdetail,
SUM(Temp01.target_value) AS sum_target,

SUM(CASE WHEN userlogin.br_code='1' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END)AS unit1,
SUM(CASE WHEN userlogin.br_code='1' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END)AS sum1,
SUM(CASE WHEN userlogin.br_code='2' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END)AS unit2,
SUM(CASE WHEN userlogin.br_code='2' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END)AS sum2,
SUM(CASE WHEN userlogin.br_code='3' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END)AS unit3,
SUM(CASE WHEN userlogin.br_code='3' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END)AS sum3,
SUM(CASE WHEN userlogin.br_code='4' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END)AS unit4,
SUM(CASE WHEN userlogin.br_code='4' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END)AS sum4,
SUM(CASE WHEN userlogin.br_code='5' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END)AS unit5,
SUM(CASE WHEN userlogin.br_code='5' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END)AS sum5,
SUM(CASE WHEN userlogin.br_code='6' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END)AS unit6,
SUM(CASE WHEN userlogin.br_code='6' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END)AS sum6,
SUM(CASE WHEN userlogin.br_code='7' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END)AS unit7,
SUM(CASE WHEN userlogin.br_code='7' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END)AS sum7,
SUM(CASE WHEN userlogin.br_code='8' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END)AS unit8,
SUM(CASE WHEN userlogin.br_code='8' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END)AS sum8,
SUM(CASE WHEN userlogin.br_code='9' THEN Temp03.data2+Temp03.data5+Temp03.data7  ELSE 0 END)AS unit9,
SUM(CASE WHEN userlogin.br_code='9' THEN Temp03.data3+Temp03.data6+Temp03.data8  ELSE 0 END)AS sum9,

SUM(Temp04.target_value)

FROM userlogin, BaseSubProduct, BaseProduct, BaseReportHeader

/* เป้าหมายตามบันทึกข้อตกลง */
LEFT JOIN ( 
SELECT TargetTris.target_value,
TargetTris.report_detail_code, TargetTris.amccode 
FROM TargetTris 
WHERE target_year='2552' AND target_month='3' ) AS Temp01 
ON Temp01.report_detail_code = BaseReportHeader.report_detail_code 
AND Temp01.amccode=BaseReportHeader.amccode 

/* ผลการรวบรวมระหว่างปี ตามบันทึกข้อตกลง  3  */
LEFT JOIN ( 
SELECT data2, data3, data5, data6, 
data7, data8, report_detail_code, amccode 
FROM ReportGroup3 
WHERE report_year='2552' AND report_month='12') AS Temp03 
ON Temp03.report_detail_code = BaseReportHeader.report_detail_code 
AND Temp03.amccode=BaseReportHeader.amccode 

/* เป้าหมายตามบันทึกข้อตกลง  สะสมประจำเดือน  */
LEFT JOIN ( 
SELECT TargetTris.target_value,
TargetTris.report_detail_code, TargetTris.amccode 
FROM TargetTris 
WHERE target_year='2552' AND target_month='12' ) AS Temp04 
ON Temp04.report_detail_code = BaseReportHeader.report_detail_code 
AND Temp04.amccode=BaseReportHeader.amccode 

WHERE BaseSubProduct.sub_pro_code = BaseProduct.sub_pro_code
AND BaseReportHeader.report_group_code = '3'
AND BaseReportHeader.report_detail_code =  BaseProduct.pro_code 
AND BaseReportHeader.amccode = userlogin.amccode
AND userlogin.status = 'N'

GROUP BY BaseSubProduct.sub_pro_name,
BaseProduct.pro_name, userlogin.br_code, userlogin.userdetail WITH ROLLUP

ORDER BY BaseSubProduct.sub_pro_name,BaseProduct.pro_name, userlogin.br_code