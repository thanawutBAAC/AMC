SELECT userlogin.userdetail,
Temp01.report_value, Temp02.member_value,
Temp03.report_value, Temp04.product_sell_sum,
Temp04.product_buy_sum, Temp04.product_buy_tabco,
Temp05.data3, Temp06.service_value,
Temp07.report_value , TempYear1.SumYear01,
TempYear2.SumYear02

FROM userlogin

/* สมาชิก สกต. */
LEFT JOIN (
SELECT SUM(ReportGroup1.report_value)AS report_value,
ReportGroup1.amccode
FROM ReportGroup1
WHERE ReportGroup1.report_year = '2552'
AND ReportGroup1.report_month = '11'
AND ReportGroup1.report_detail_code = '3'
GROUP BY ReportGroup1.amccode)AS Temp01
ON Temp01.amccode = userlogin.amccode

/*  สมาชิกทำธุรกิจ */
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

/* กำไรขาดทุน */
LEFT JOIN (
SELECT SUM(ReportGroup1.report_value)AS report_value,
ReportGroup1.amccode
FROM ReportGroup1
WHERE ReportGroup1.report_year = '2552'
AND ReportGroup1.report_month = '11'
AND ReportGroup1.report_detail_code = '6'
GROUP BY ReportGroup1.amccode ) AS Temp07
ON Temp07.amccode = userlogin.amccode

/************ ผลการดำเนินธุรกิจรวม ย้อนหลัง 1 ปี  *****************/
LEFT JOIN (
SELECT 
(Temp101.product_sell_sum+Temp101.product_buy_tabco+
 Temp102.data3+Temp103.service_value)AS SumYear01,
userlogin.amccode
FROM userlogin
/* ธุรกิจซื้อ ธุรกิจ Tabco */
LEFT JOIN(
SELECT SUM(ReportGroup2.product_sell_sum) AS product_sell_sum,
SUM(ReportGroup2.product_buy_tabco) AS product_buy_tabco,
ReportGroup2.amccode
FROM ReportGroup2
WHERE ReportGroup2.report_year = '2552'
AND ReportGroup2.report_month = '12'
GROUP BY ReportGroup2.amccode) AS Temp101
ON Temp101.amccode = userlogin.amccode
/* ธุรกิจขาย */
LEFT JOIN(
SELECT SUM(ReportGroup3.data3) AS data3,
ReportGroup3.amccode
FROM ReportGroup3
WHERE ReportGroup3.report_year = '2552'
AND ReportGroup3.report_month = '12'
GROUP BY ReportGroup3.amccode ) AS Temp102
ON Temp102.amccode = userlogin.amccode
/* ธุรกิจบริการ */
LEFT JOIN(
SELECT SUM(ReportGroup4.service_value) AS service_value,
ReportGroup4.amccode
FROM ReportGroup4
WHERE ReportGroup4.report_year = '2552'
AND ReportGroup4.report_month = '12'
GROUP BY ReportGroup4.amccode ) AS Temp103
ON Temp103.amccode = userlogin.amccode
WHERE userlogin.status='N'
) AS TempYear1 ON TempYear1.amccode = userlogin.amccode
/* ************************************************ */


/************ ผลการดำเนินธุรกิจรวม ย้อนหลัง 2 ปี  *****************/
LEFT JOIN (
SELECT 
(Temp201.product_sell_sum+Temp201.product_buy_tabco+
 Temp202.data3+Temp203.service_value)AS SumYear02,
userlogin.amccode
FROM userlogin
/* ธุรกิจซื้อ ธุรกิจ Tabco */
LEFT JOIN(
SELECT SUM(ReportGroup2.product_sell_sum) AS product_sell_sum,
SUM(ReportGroup2.product_buy_tabco) AS product_buy_tabco,
ReportGroup2.amccode
FROM ReportGroup2
WHERE ReportGroup2.report_year = '2553'
AND ReportGroup2.report_month = '12'
GROUP BY ReportGroup2.amccode) AS Temp201
ON Temp201.amccode = userlogin.amccode
/* ธุรกิจขาย */
LEFT JOIN(
SELECT SUM(ReportGroup3.data3) AS data3,
ReportGroup3.amccode
FROM ReportGroup3
WHERE ReportGroup3.report_year = '2553'
AND ReportGroup3.report_month = '12'
GROUP BY ReportGroup3.amccode ) AS Temp202
ON Temp202.amccode = userlogin.amccode
/* ธุรกิจบริการ */
LEFT JOIN(
SELECT SUM(ReportGroup4.service_value) AS service_value,
ReportGroup4.amccode
FROM ReportGroup4
WHERE ReportGroup4.report_year = '2553'
AND ReportGroup4.report_month = '12'
GROUP BY ReportGroup4.amccode ) AS Temp203
ON Temp203.amccode = userlogin.amccode
WHERE userlogin.status='N'
) AS TempYear2 ON TempYear2.amccode = userlogin.amccode
/* ************************************************ */

WHERE userlogin.br_code = '3'
ORDER BY userlogin.userdetail