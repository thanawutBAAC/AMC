SELECT userlogin.amccode, Temp01.max_month
FROM userlogin

LEFT JOIN (
 SELECT  SentReportHeader.amccode,
 MAX(SentReportHeader.sent_month) AS max_month
 FROM SentReportHeader
 WHERE SentReportHeader.sent_year='2553'
 AND SentReportHeader.sent_month <= 7
 GROUP BY SentReportHeader.amccode
)AS Temp01 ON Temp01.amccode = userlogin.amccode

WHERE userlogin.status='N'
