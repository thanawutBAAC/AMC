SELECT DISTINCT BaseReportDetail.report_detail_code,
BaseReportDetail.report_detail_name, Temp01.PlanCollectBuy_Unit,
Temp02.data257,
Temp03.PlanCollectSell_Unit,
Temp02.data9,
Temp02.data11,
Temp04.COUNT01
FROM BaseReportHeader,BaseReportDetail
LEFT JOIN(
  SELECT SUM(PlanCollectBuy_Unit)AS PlanCollectBuy_Unit, report_detail_code
  FROM PlanCollectBuy,userlogin
  WHERE PlanCollectBuy_year='2552'
  AND PlanCollectBuy.amccode = userlogin.amccode
  GROUP BY report_detail_code
)AS Temp01 ON Temp01.report_detail_code = BaseReportDetail.report_detail_code

LEFT JOIN (
  SELECT SUM(data2+data5+data7)AS data257 ,SUM(data9)AS data9,
         SUM(data11)AS data11,report_detail_code
  FROM ReportGroup3,userlogin
  WHERE ReportGroup3.amccode = userlogin.amccode 
  AND report_year='2552' AND report_month='6'
  GROUP BY report_detail_code
)AS Temp02 ON Temp02.report_detail_code = BaseReportDetail.report_detail_code

LEFT JOIN(
  SELECT SUM(PlanCollectSell_Unit)AS PlanCollectSell_Unit, report_detail_code
  FROM PlanCollectSell,userlogin
  WHERE PlanCollectSell_year='2552'
  AND PlanCollectSell.amccode = userlogin.amccode
  GROUP BY report_detail_code
)AS Temp03 ON Temp03.report_detail_code = BaseReportDetail.report_detail_code

LEFT JOIN(
  SELECT COUNT(DISTINCT BaseReportHeader.amccode)AS COUNT01,
  BaseReportHeader.report_detail_code
  FROM BaseReportHeader,userlogin
  WHERE BaseReportHeader.amccode = userlogin.amccode
  AND BaseReportHeader.report_group_code='3'
  GROUP BY BaseReportHeader.report_detail_code
)AS Temp04 ON Temp04.report_detail_code = BaseReportDetail.report_detail_code


WHERE BaseReportHeader.report_group_code='3'
AND BaseReportDetail.report_group_code=BaseReportHeader.report_group_code
AND BaseReportDetail.report_detail_code=BaseReportHeader.report_detail_code
