SELECT userlogin.br_code,userlogin.userdetail, 
Temp01.PlanCollectBuy_Unit,
Temp02.data257,
Temp03.PlanCollectSell_Unit,
Temp02.data9,
Temp02.data11,
userlogin.amccode
FROM userlogin
LEFT JOIN(
  SELECT SUM(PlanCollectBuy_Unit)AS PlanCollectBuy_Unit, amccode
  FROM PlanCollectBuy
  WHERE PlanCollectBuy_year='2552'
  GROUP BY amccode
)AS Temp01 ON Temp01.amccode = userlogin.amccode

LEFT JOIN (
  SELECT SUM(data2+data5+data7)AS data257 ,SUM(data9)AS data9,
         SUM(data11)AS data11,amccode
  FROM ReportGroup3
  WHERE  report_year='2552' AND report_month='6'
  GROUP BY amccode
)AS Temp02 ON Temp02.amccode = userlogin.amccode

LEFT JOIN(
  SELECT SUM(PlanCollectSell_Unit)AS PlanCollectSell_Unit, amccode
  FROM PlanCollectSell
  WHERE PlanCollectSell_year='2552'
  GROUP BY amccode
)AS Temp03 ON Temp03.amccode = userlogin.amccode


WHERE userlogin.status='N'
ORDER BY userlogin.br_code,userlogin.userdetail
