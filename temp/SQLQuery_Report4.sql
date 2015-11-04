SELECT DISTINCT BaseReportDetail.report_detail_code,
BaseReportDetail.report_detail_name, Temp01.PlanCollectBuy_Sum,
Temp02.data368,
Temp03.PlanCollectSell_Sum,
Temp02.data10,
Temp02.data12, Temp02.data13,
Temp02.data14
FROM BaseReportHeader,BaseReportDetail
LEFT JOIN(
  SELECT SUM(PlanCollectBuy_Sum)AS PlanCollectBuy_Sum, report_detail_code
  FROM PlanCollectBuy,userlogin
  WHERE PlanCollectBuy_year='2552'
  AND PlanCollectBuy.amccode = userlogin.amccode
  GROUP BY report_detail_code
)AS Temp01 ON Temp01.report_detail_code = BaseReportDetail.report_detail_code

LEFT JOIN (
  SELECT SUM(data3+data6+data8)AS data368 ,SUM(data10)AS data10,
         SUM(data12)AS data12,SUM(data13)AS data13,
         SUM(data14)AS data14, report_detail_code
  FROM ReportGroup3,userlogin
  WHERE ReportGroup3.amccode = userlogin.amccode 
  AND report_year='2552' AND report_month='6'
  GROUP BY report_detail_code
)AS Temp02 ON Temp02.report_detail_code = BaseReportDetail.report_detail_code

LEFT JOIN(
  SELECT SUM(PlanCollectSell_Sum)AS PlanCollectSell_Sum, report_detail_code
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
