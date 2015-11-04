SELECT userlogin.br_code, userlogin.userdetail,
SUM(Temp01.report_value), SUM(Temp02.member_value),
SUM(Temp03.report_value), 
SUM(Temp08.Plan_ProcureSell),
SUM(Temp04.product_sell_sum), SUM(Temp04.product_buy_sum), 
SUM(Temp04.product_buy_tabco), 
SUM(Temp09.Plan_CollectSell), SUM(Temp05.data3), 
SUM(Temp010.PlanService), SUM(Temp06.service_value)

FROM userlogin

/* สมาชิก สกต.(ราย) */
LEFT JOIN (
SELECT SUM(ReportGroup1.report_value)AS report_value,
ReportGroup1.amccode
FROM ReportGroup1
WHERE ReportGroup1.report_year = '2552'
AND ReportGroup1.report_month = '11'
AND ReportGroup1.report_detail_code = '3'
GROUP BY ReportGroup1.amccode)AS Temp01
ON Temp01.amccode = userlogin.amccode

/* สมาชิกทำธุรกิจ (ราย) */
LEFT JOIN (
SELECT SUM(ReportGroup6.member_value)AS member_value,
ReportGroup6.amccode
FROM ReportGroup6
WHERE ReportGroup6.report_year = '2552'
AND ReportGroup6.report_month = '11'
AND ReportGroup6.report_detail_code = '1'
GROUP BY ReportGroup6.amccode) AS Temp02
ON Temp02.amccode = userlogin.amccode

/* มูลค่าหุ้นทั้งหมด */
LEFT JOIN (
SELECT SUM(ReportGroup1.report_value)AS report_value,
ReportGroup1.amccode
FROM ReportGroup1
WHERE ReportGroup1.report_year = '2552'
AND ReportGroup1.report_month = '11'
AND ReportGroup1.report_detail_code = '4'
GROUP BY ReportGroup1.amccode ) AS Temp03
ON Temp03.amccode = userlogin.amccode

/* ธุรกิจซื้อ  รวมซื้อระหว่างปี ซื้อจาก Tabco */
LEFT JOIN(
SELECT SUM(ReportGroup2.product_sell_sum) AS product_sell_sum,
SUM(ReportGroup2.product_buy_sum) AS product_buy_sum,
SUM(ReportGroup2.product_buy_tabco) AS product_buy_tabco,
ReportGroup2.amccode
FROM ReportGroup2
WHERE ReportGroup2.report_year = '2552'
AND ReportGroup2.report_month = '11'
GROUP BY ReportGroup2.amccode) AS Temp04
ON Temp04.amccode = userlogin.amccode

/* ธุรกิจขาย */
LEFT JOIN(
SELECT SUM(ReportGroup3.data3) AS data3,
ReportGroup3.amccode
FROM ReportGroup3
WHERE ReportGroup3.report_year = '2552'
AND ReportGroup3.report_month = '11'
GROUP BY ReportGroup3.amccode ) AS Temp05
ON Temp05.amccode = userlogin.amccode

/* ธุรกิจบริการ */
LEFT JOIN(
SELECT SUM(ReportGroup4.service_value) AS service_value,
ReportGroup4.amccode
FROM ReportGroup4
WHERE ReportGroup4.report_year = '2552'
AND ReportGroup4.report_month = '11'
GROUP BY ReportGroup4.amccode ) AS Temp06
ON Temp06.amccode = userlogin.amccode

/* เป้าหมาย ธุรกิจซื้อ */
LEFT JOIN (
SELECT SUM(PlanProcureSell.PlanProcureSell_Sum)AS Plan_ProcureSell,
PlanProcureSell.amccode
FROM PlanProcureSell
WHERE PlanProcureSell.PlanProcureSell_year = '2552'
GROUP BY PlanProcureSell.amccode ) AS Temp08
ON Temp08.amccode = userlogin.amccode

/* เป้าหมาย ธุรกิจขาย */
LEFT JOIN (
SELECT SUM(PlanCollectSell.PlanCollectSell_Sum)AS Plan_CollectSell,
PlanCollectSell.amccode
FROM PlanCollectSell
WHERE PlanCollectSell.PlanCollectSell_year = '2552'
GROUP BY PlanCollectSell.amccode ) AS Temp09
ON Temp09.amccode = userlogin.amccode

/* เป้าหมาย ธุรกิจบริการ */
LEFT JOIN (
SELECT SUM(PlanService.PlanService_Sum)AS PlanService,
PlanService.amccode
FROM PlanService
WHERE PlanService.PlanService_year = '2552'
GROUP BY PlanService.amccode ) AS Temp010
ON Temp010.amccode = userlogin.amccode

WHERE  userlogin.status = 'N'

GROUP BY userlogin.br_code, userlogin.userdetail WITH ROLLUP

/*ORDER BY userlogin.br_code, userlogin.userdetail*/
