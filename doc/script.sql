USE [AMC]
GO
/****** Object:  Table [dbo].[ReportGroup4]    Script Date: 07/15/2009 18:11:25 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReportGroup4](
	[amccode] [nchar](7) NOT NULL,
	[report_year] [nchar](4) NOT NULL,
	[report_month] [nchar](2) NOT NULL,
	[report_detail_code] [nchar](2) NOT NULL,
	[service_value] [numeric](18, 0) NULL,
 CONSTRAINT [PK_ReportGroup4] PRIMARY KEY CLUSTERED 
(
	[amccode] ASC,
	[report_year] ASC,
	[report_month] ASC,
	[report_detail_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReportGroup6]    Script Date: 07/15/2009 18:11:33 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReportGroup6](
	[amccode] [nchar](7) NOT NULL,
	[report_year] [nchar](4) NOT NULL,
	[report_month] [nchar](2) NOT NULL,
	[report_detail_code] [nchar](2) NOT NULL,
	[member_value] [numeric](18, 0) NULL,
 CONSTRAINT [PK_ReportGroup6] PRIMARY KEY CLUSTERED 
(
	[amccode] ASC,
	[report_year] ASC,
	[report_month] ASC,
	[report_detail_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReportGroup3]    Script Date: 07/15/2009 18:11:22 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReportGroup3](
	[amccode] [nchar](7) NOT NULL,
	[report_year] [nchar](4) NOT NULL,
	[report_month] [nchar](2) NOT NULL,
	[report_detail_code] [nchar](2) NOT NULL,
	[data1] [numeric](18, 0) NULL,
	[data2] [numeric](18, 0) NULL,
	[data3] [numeric](18, 0) NULL,
	[data4] [numeric](18, 0) NULL,
	[data5] [numeric](18, 0) NULL,
	[data6] [numeric](18, 0) NULL,
	[data7] [numeric](18, 0) NULL,
	[data8] [numeric](18, 0) NULL,
	[data9] [numeric](18, 0) NULL,
	[data10] [numeric](18, 0) NULL,
	[data11] [numeric](18, 0) NULL,
	[data12] [numeric](18, 0) NULL,
	[data13] [numeric](18, 0) NULL,
	[data14] [numeric](18, 0) NULL,
 CONSTRAINT [PK_ReportGroup3] PRIMARY KEY CLUSTERED 
(
	[amccode] ASC,
	[report_year] ASC,
	[report_month] ASC,
	[report_detail_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReportGroup5]    Script Date: 07/15/2009 18:11:30 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReportGroup5](
	[amccode] [nchar](7) NOT NULL,
	[report_year] [nchar](4) NOT NULL,
	[report_month] [nchar](2) NOT NULL,
	[report_detail_code] [nchar](2) NOT NULL,
	[loan_limit] [numeric](18, 0) NULL,
	[loan_fund] [numeric](18, 0) NULL,
	[loan_pay] [numeric](18, 0) NULL,
 CONSTRAINT [PK_ReportGroup5] PRIMARY KEY CLUSTERED 
(
	[amccode] ASC,
	[report_year] ASC,
	[report_month] ASC,
	[report_detail_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[SentReportHeader]    Script Date: 07/15/2009 18:11:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[SentReportHeader](
	[amccode] [nchar](7) NOT NULL,
	[sent_month] [nchar](2) NOT NULL,
	[sent_year] [nchar](4) NOT NULL,
	[sent_date] [nchar](30) NULL,
	[sent_time] [nchar](12) NULL,
	[sent_status] [nchar](1) NULL,
 CONSTRAINT [PK_SentReportHeader] PRIMARY KEY CLUSTERED 
(
	[amccode] ASC,
	[sent_month] ASC,
	[sent_year] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[TargetProduct]    Script Date: 07/15/2009 18:11:46 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TargetProduct](
	[report_detail_code] [nchar](2) NOT NULL,
	[target_check] [nchar](1) NULL,
	[target_kpi] [nchar](1) NULL,
 CONSTRAINT [PK_Target_product] PRIMARY KEY CLUSTERED 
(
	[report_detail_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[TargetTris]    Script Date: 07/15/2009 18:11:49 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TargetTris](
	[target_year] [nchar](4) NOT NULL,
	[report_detail_code] [nchar](2) NOT NULL,
	[amccode] [nchar](7) NOT NULL,
	[target_value] [numeric](18, 0) NULL,
 CONSTRAINT [PK_TargetTris] PRIMARY KEY CLUSTERED 
(
	[target_year] ASC,
	[report_detail_code] ASC,
	[amccode] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[TableKPI]    Script Date: 07/15/2009 18:11:44 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TableKPI](
	[a1] [nchar](3) NULL,
	[a2] [nchar](3) NULL,
	[b1] [nchar](3) NULL,
	[b2] [nchar](3) NULL,
	[c1] [nchar](3) NULL,
	[c2] [nchar](3) NULL,
	[d1] [nchar](3) NULL,
	[d2] [nchar](3) NULL,
	[e1] [nchar](3) NULL,
	[e2] [nchar](3) NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ProvinceCode]    Script Date: 07/15/2009 18:11:05 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[ProvinceCode](
	[cat_cc] [char](2) NOT NULL,
	[cat_aa] [char](2) NOT NULL,
	[cat_tt] [char](2) NOT NULL,
	[cat_mm] [char](2) NOT NULL,
	[cat_desc] [varchar](255) NULL,
	[brnch_code] [varchar](255) NULL,
	[brnch_name] [varchar](255) NULL,
	[prv_name] [varchar](255) NULL,
	[ddd] [varchar](255) NULL,
 CONSTRAINT [PK_ProvinceCode] PRIMARY KEY CLUSTERED 
(
	[cat_cc] ASC,
	[cat_aa] ASC,
	[cat_tt] ASC,
	[cat_mm] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[BaseMainProduct]    Script Date: 07/15/2009 18:08:58 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[BaseMainProduct](
	[main_pro_code] [nchar](2) NOT NULL,
	[main_pro_name] [nchar](20) NULL,
 CONSTRAINT [PK_product] PRIMARY KEY CLUSTERED 
(
	[main_pro_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[BaseSubProduct]    Script Date: 07/15/2009 18:09:09 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[BaseSubProduct](
	[sub_pro_code] [nchar](3) NOT NULL,
	[sub_pro_name] [nchar](30) NULL,
	[main_pro_code] [nchar](2) NOT NULL,
 CONSTRAINT [PK_BaseSubProduct_1] PRIMARY KEY CLUSTERED 
(
	[sub_pro_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[BaseReportGroup]    Script Date: 07/15/2009 18:09:05 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[BaseReportGroup](
	[report_group_code] [nchar](1) NOT NULL,
	[report_group_name] [nchar](100) NULL,
	[report_group_type] [nchar](1) NULL,
	[report_group_comment] [nchar](300) NULL,
 CONSTRAINT [PK_BaseReportGroup] PRIMARY KEY CLUSTERED 
(
	[report_group_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[BaseReportDetail]    Script Date: 07/15/2009 18:09:03 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[BaseReportDetail](
	[report_group_code] [nchar](1) NOT NULL,
	[report_detail_code] [nchar](2) NOT NULL,
	[report_detail_name] [nchar](100) NULL,
	[report_detail_unit] [nchar](10) NULL,
 CONSTRAINT [PK_BaseReportDetail] PRIMARY KEY CLUSTERED 
(
	[report_group_code] ASC,
	[report_detail_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[BaseReportHeader]    Script Date: 07/15/2009 18:09:07 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[BaseReportHeader](
	[amccode] [nchar](7) NOT NULL,
	[report_group_code] [nchar](1) NOT NULL,
	[report_detail_code] [nchar](2) NOT NULL,
 CONSTRAINT [PK_BaseReportHeader] PRIMARY KEY CLUSTERED 
(
	[amccode] ASC,
	[report_group_code] ASC,
	[report_detail_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReportMonth]    Script Date: 07/15/2009 18:11:35 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReportMonth](
	[report_month] [nchar](2) NOT NULL,
	[report_year] [nchar](4) NOT NULL,
	[report_sent] [nchar](10) NULL,
 CONSTRAINT [PK_ReportMonth] PRIMARY KEY CLUSTERED 
(
	[report_month] ASC,
	[report_year] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[BaseProduct]    Script Date: 07/15/2009 18:09:00 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[BaseProduct](
	[pro_code] [nchar](3) NOT NULL,
	[pro_name] [nchar](20) NULL,
	[pro_unit] [nchar](10) NULL,
	[sub_pro_code] [nchar](3) NULL,
 CONSTRAINT [PK_BaseProduct] PRIMARY KEY CLUSTERED 
(
	[pro_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[PlanProcureSell]    Script Date: 07/15/2009 18:10:49 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[PlanProcureSell](
	[amccode] [nchar](7) NOT NULL,
	[PlanProcureSell_year] [nchar](4) NOT NULL,
	[report_detail_code] [nchar](2) NOT NULL,
	[PlanProcureSell_price] [numeric](18, 0) NULL,
	[PlanProcureSell_Apr] [numeric](18, 0) NULL,
	[PlanProcureSell_May] [numeric](18, 0) NULL,
	[PlanProcureSell_Jun] [numeric](18, 0) NULL,
	[PlanProcureSell_Jul] [numeric](18, 0) NULL,
	[PlanProcureSell_Aug] [numeric](18, 0) NULL,
	[PlanProcureSell_Sep] [numeric](18, 0) NULL,
	[PlanProcureSell_Oct] [numeric](18, 0) NULL,
	[PlanProcureSell_Nov] [numeric](18, 0) NULL,
	[PlanProcureSell_Dec] [numeric](18, 0) NULL,
	[PlanProcureSell_Jan] [numeric](18, 0) NULL,
	[PlanProcureSell_Feb] [numeric](18, 0) NULL,
	[PlanProcureSell_Mar] [numeric](18, 0) NULL,
	[PlanProcureSell_Unit] [numeric](18, 0) NULL,
	[PlanProcureSell_Sum] [numeric](18, 0) NULL,
 CONSTRAINT [PK_PlanProcureSell] PRIMARY KEY CLUSTERED 
(
	[amccode] ASC,
	[PlanProcureSell_year] ASC,
	[report_detail_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[PlanProcureBuy]    Script Date: 07/15/2009 18:10:39 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[PlanProcureBuy](
	[amccode] [nchar](7) NOT NULL,
	[PlanProcureBuy_year] [nchar](4) NOT NULL,
	[report_detail_code] [nchar](2) NOT NULL,
	[Imports_unit] [numeric](18, 0) NULL,
	[Imports_price] [numeric](18, 0) NULL,
	[PlanProcureBuy_price] [numeric](18, 0) NULL,
	[PlanProcureBuy_Apr] [numeric](18, 0) NULL,
	[PlanProcureBuy_May] [numeric](18, 0) NULL,
	[PlanProcureBuy_Jun] [numeric](18, 0) NULL,
	[PlanProcureBuy_Jul] [numeric](18, 0) NULL,
	[PlanProcureBuy_Aug] [numeric](18, 0) NULL,
	[PlanProcureBuy_Sep] [numeric](18, 0) NULL,
	[PlanProcureBuy_Oct] [numeric](18, 0) NULL,
	[PlanProcureBuy_Nov] [numeric](18, 0) NULL,
	[PlanProcureBuy_Dec] [numeric](18, 0) NULL,
	[PlanProcureBuy_Jan] [numeric](18, 0) NULL,
	[PlanProcureBuy_Feb] [numeric](18, 0) NULL,
	[PlanProcureBuy_Mar] [numeric](18, 0) NULL,
	[PlanProcureBuy_Unit] [numeric](18, 0) NULL,
	[PlanProcureBuy_Sum] [numeric](18, 0) NULL,
	[PlanProcureBuy_Unit_year] [numeric](18, 0) NULL,
	[PlanProcureBuy_Sum_year] [numeric](18, 0) NULL,
 CONSTRAINT [PK_PlanProcureBuy] PRIMARY KEY CLUSTERED 
(
	[amccode] ASC,
	[PlanProcureBuy_year] ASC,
	[report_detail_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[PlanCollectSell]    Script Date: 07/15/2009 18:09:28 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[PlanCollectSell](
	[amccode] [nchar](7) NOT NULL,
	[PlanCollectSell_year] [nchar](4) NOT NULL,
	[report_detail_code] [nchar](2) NOT NULL,
	[PlanCollectSell_price] [numeric](18, 0) NULL,
	[PlanCollectSell_Apr] [numeric](18, 0) NULL,
	[PlanCollectSell_May] [numeric](18, 0) NULL,
	[PlanCollectSell_Jun] [numeric](18, 0) NULL,
	[PlanCollectSell_Jul] [numeric](18, 0) NULL,
	[PlanCollectSell_Aug] [numeric](18, 0) NULL,
	[PlanCollectSell_Sep] [numeric](18, 0) NULL,
	[PlanCollectSell_Oct] [numeric](18, 0) NULL,
	[PlanCollectSell_Nov] [numeric](18, 0) NULL,
	[PlanCollectSell_Dec] [numeric](18, 0) NULL,
	[PlanCollectSell_Jan] [numeric](18, 0) NULL,
	[PlanCollectSell_Feb] [numeric](18, 0) NULL,
	[PlanCollectSell_Mar] [numeric](18, 0) NULL,
	[PlanCollectSell_Unit] [numeric](18, 0) NULL,
	[PlanCollectSell_Sum] [numeric](18, 0) NULL,
 CONSTRAINT [PK_PlanCollectSell] PRIMARY KEY CLUSTERED 
(
	[amccode] ASC,
	[PlanCollectSell_year] ASC,
	[report_detail_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[PlanCollectBuy]    Script Date: 07/15/2009 18:09:20 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[PlanCollectBuy](
	[amccode] [nchar](7) NOT NULL,
	[PlanCollectBuy_year] [nchar](4) NOT NULL,
	[report_detail_code] [nchar](2) NOT NULL,
	[Imports_unit] [numeric](18, 0) NULL,
	[Imports_price] [numeric](18, 0) NULL,
	[PlanCollectBuy_price] [numeric](18, 0) NULL,
	[PlanCollectBuy_Apr] [numeric](18, 0) NULL,
	[PlanCollectBuy_May] [numeric](18, 0) NULL,
	[PlanCollectBuy_Jun] [numeric](18, 0) NULL,
	[PlanCollectBuy_Jul] [numeric](18, 0) NULL,
	[PlanCollectBuy_Aug] [numeric](18, 0) NULL,
	[PlanCollectBuy_Sep] [numeric](18, 0) NULL,
	[PlanCollectBuy_Oct] [numeric](18, 0) NULL,
	[PlanCollectBuy_Nov] [numeric](18, 0) NULL,
	[PlanCollectBuy_Dec] [numeric](18, 0) NULL,
	[PlanCollectBuy_Jan] [numeric](18, 0) NULL,
	[PlanCollectBuy_Feb] [numeric](18, 0) NULL,
	[PlanCollectBuy_Mar] [numeric](18, 0) NULL,
	[PlanCollectBuy_Unit] [numeric](18, 0) NULL,
	[PlanCollectBuy_Sum] [numeric](18, 0) NULL,
	[PlanCollectBuy_Unit_year] [numeric](18, 0) NULL,
	[PlanCollectBuy_Sum_year] [numeric](18, 0) NULL,
 CONSTRAINT [PK_PlanCollectBuy] PRIMARY KEY CLUSTERED 
(
	[amccode] ASC,
	[PlanCollectBuy_year] ASC,
	[report_detail_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[PlanService]    Script Date: 07/15/2009 18:10:59 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[PlanService](
	[amccode] [nchar](7) NOT NULL,
	[PlanService_year] [nchar](4) NOT NULL,
	[report_detail_code] [nchar](2) NOT NULL,
	[PlanService_Apr] [numeric](18, 0) NULL,
	[PlanService_May] [numeric](18, 0) NULL,
	[PlanService_Jun] [numeric](18, 0) NULL,
	[PlanService_Jul] [numeric](18, 0) NULL,
	[PlanService_Aug] [numeric](18, 0) NULL,
	[PlanService_Sep] [numeric](18, 0) NULL,
	[PlanService_Oct] [numeric](18, 0) NULL,
	[PlanService_Nov] [numeric](18, 0) NULL,
	[PlanService_Dec] [numeric](18, 0) NULL,
	[PlanService_Jan] [numeric](18, 0) NULL,
	[PlanService_Feb] [numeric](18, 0) NULL,
	[PlanService_Mar] [numeric](18, 0) NULL,
	[PlanService_Sum] [numeric](18, 0) NULL,
 CONSTRAINT [PK_PlanService] PRIMARY KEY CLUSTERED 
(
	[amccode] ASC,
	[PlanService_year] ASC,
	[report_detail_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[PlanExpenses]    Script Date: 07/15/2009 18:09:36 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[PlanExpenses](
	[amccode] [nchar](7) NOT NULL,
	[PlanExpenses_year] [nchar](4) NOT NULL,
	[report_detail_code] [nchar](2) NOT NULL,
	[PlanExpenses_Apr] [numeric](18, 0) NULL,
	[PlanExpenses_May] [numeric](18, 0) NULL,
	[PlanExpenses_Jun] [numeric](18, 0) NULL,
	[PlanExpenses_Jul] [numeric](18, 0) NULL,
	[PlanExpenses_Aug] [numeric](18, 0) NULL,
	[PlanExpenses_Sep] [numeric](18, 0) NULL,
	[PlanExpenses_Oct] [numeric](18, 0) NULL,
	[PlanExpenses_Nov] [numeric](18, 0) NULL,
	[PlanExpenses_Dec] [numeric](18, 0) NULL,
	[PlanExpenses_Jan] [numeric](18, 0) NULL,
	[PlanExpenses_Feb] [numeric](18, 0) NULL,
	[PlanExpenses_Mar] [numeric](18, 0) NULL,
	[PlanExpenses_Sum] [numeric](18, 0) NULL,
 CONSTRAINT [PK_PlanExpenses] PRIMARY KEY CLUSTERED 
(
	[amccode] ASC,
	[PlanExpenses_year] ASC,
	[report_detail_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[PlanMember]    Script Date: 07/15/2009 18:10:28 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[PlanMember](
	[amccode] [nchar](7) NOT NULL,
	[PlanMember_year] [nchar](4) NOT NULL,
	[MemFirstQuarter] [numeric](18, 0) NULL,
	[MemSecondQuarter] [numeric](18, 0) NULL,
	[MemThirdQuarter] [numeric](18, 0) NULL,
	[MemFourthQuarter] [numeric](18, 0) NULL,
	[MemSumYear] [numeric](18, 0) NULL,
	[ShareFirstQuarter] [numeric](18, 0) NULL,
	[ShareSecondQuarter] [numeric](18, 0) NULL,
	[ShareThirdQuarter] [numeric](18, 0) NULL,
	[ShareFourthQuarter] [numeric](18, 0) NULL,
	[ShareSumYear] [numeric](18, 0) NULL,
 CONSTRAINT [PK_PlanMember] PRIMARY KEY CLUSTERED 
(
	[PlanMember_year] ASC,
	[amccode] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[PlanMaster]    Script Date: 07/15/2009 18:10:22 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[PlanMaster](
	[amccode] [nchar](7) NOT NULL,
	[Plan_year] [nchar](4) NOT NULL,
	[member_year] [numeric](18, 0) NULL,
	[share_year] [numeric](18, 0) NULL,
	[buy_income_first] [numeric](18, 0) NULL,
	[buy_income_second] [numeric](18, 0) NULL,
	[buy_income_third] [numeric](18, 0) NULL,
	[buy_income_fourth] [numeric](18, 0) NULL,
	[buy_expenses_first] [numeric](18, 0) NULL,
	[buy_expenses_second] [numeric](18, 0) NULL,
	[buy_expenses_third] [numeric](18, 0) NULL,
	[buy_expenses_fourth] [numeric](18, 0) NULL,
	[buy_loan_first] [numeric](18, 0) NULL,
	[buy_loan_second] [numeric](18, 0) NULL,
	[buy_loan_third] [numeric](18, 0) NULL,
	[buy_loan_fourth] [numeric](18, 0) NULL,
	[buy_principal_first] [numeric](18, 0) NULL,
	[buy_principal_second] [numeric](18, 0) NULL,
	[buy_principal_third] [numeric](18, 0) NULL,
	[buy_principal_fourth] [numeric](18, 0) NULL,
	[buy_interest_first] [numeric](18, 0) NULL,
	[buy_interest_second] [numeric](18, 0) NULL,
	[buy_interest_third] [numeric](18, 0) NULL,
	[buy_interest_fourth] [numeric](18, 0) NULL,
	[sell_income_first] [numeric](18, 0) NULL,
	[sell_income_second] [numeric](18, 0) NULL,
	[sell_income_third] [numeric](18, 0) NULL,
	[sell_income_fourth] [numeric](18, 0) NULL,
	[sell_expenses_first] [numeric](18, 0) NULL,
	[sell_expenses_second] [numeric](18, 0) NULL,
	[sell_expenses_third] [numeric](18, 0) NULL,
	[sell_expenses_fourth] [numeric](18, 0) NULL,
	[sell_loan_first] [numeric](18, 0) NULL,
	[sell_loan_second] [numeric](18, 0) NULL,
	[sell_loan_third] [numeric](18, 0) NULL,
	[sell_loan_fourth] [numeric](18, 0) NULL,
	[sell_principal_first] [numeric](18, 0) NULL,
	[sell_principal_second] [numeric](18, 0) NULL,
	[sell_principal_third] [numeric](18, 0) NULL,
	[sell_principal_fourth] [numeric](18, 0) NULL,
	[sell_interest_first] [numeric](18, 0) NULL,
	[sell_interest_second] [numeric](18, 0) NULL,
	[sell_interest_third] [numeric](18, 0) NULL,
	[sell_interest_fourth] [numeric](18, 0) NULL,
	[service_capital_first] [numeric](18, 0) NULL,
	[service_capital_second] [numeric](18, 0) NULL,
	[service_capital_third] [numeric](18, 0) NULL,
	[service_capital_fourth] [numeric](18, 0) NULL,
	[service_expenses_first] [numeric](18, 0) NULL,
	[service_expenses_second] [numeric](18, 0) NULL,
	[service_expenses_third] [numeric](18, 0) NULL,
	[service_expenses_fourth] [numeric](18, 0) NULL,
	[asset_61_first] [numeric](18, 0) NULL,
	[asset_61_second] [numeric](18, 0) NULL,
	[asset_61_third] [numeric](18, 0) NULL,
	[asset_61_fourth] [numeric](18, 0) NULL,
	[asset_62_first] [numeric](18, 0) NULL,
	[asset_62_second] [numeric](18, 0) NULL,
	[asset_62_third] [numeric](18, 0) NULL,
	[asset_62_fourth] [numeric](18, 0) NULL,
	[asset_63_first] [numeric](18, 0) NULL,
	[asset_63_second] [numeric](18, 0) NULL,
	[asset_63_third] [numeric](18, 0) NULL,
	[asset_63_fourth] [numeric](18, 0) NULL,
	[asset_64_first] [numeric](18, 0) NULL,
	[asset_64_second] [numeric](18, 0) NULL,
	[asset_64_third] [numeric](18, 0) NULL,
	[asset_64_fourth] [numeric](18, 0) NULL,
	[asset_65_first] [numeric](18, 0) NULL,
	[asset_65_second] [numeric](18, 0) NULL,
	[asset_65_third] [numeric](18, 0) NULL,
	[asset_65_fourth] [numeric](18, 0) NULL,
	[asset_66_first] [numeric](18, 0) NULL,
	[asset_66_second] [numeric](18, 0) NULL,
	[asset_66_third] [numeric](18, 0) NULL,
	[asset_66_fourth] [numeric](18, 0) NULL,
	[asset_67_first] [numeric](18, 0) NULL,
	[asset_67_second] [numeric](18, 0) NULL,
	[asset_67_third] [numeric](18, 0) NULL,
	[asset_67_fourth] [numeric](18, 0) NULL,
	[asset_68_first] [numeric](18, 0) NULL,
	[asset_68_second] [numeric](18, 0) NULL,
	[asset_68_third] [numeric](18, 0) NULL,
	[asset_68_fourth] [numeric](18, 0) NULL,
	[asset_69_first] [numeric](18, 0) NULL,
	[asset_69_second] [numeric](18, 0) NULL,
	[asset_69_third] [numeric](18, 0) NULL,
	[asset_69_fourth] [numeric](18, 0) NULL,
	[asset_610_first] [numeric](18, 0) NULL,
	[asset_610_second] [numeric](18, 0) NULL,
	[asset_610_third] [numeric](18, 0) NULL,
	[asset_610_fourth] [numeric](18, 0) NULL,
	[income_interest_first] [numeric](18, 0) NULL,
	[income_interest_second] [numeric](18, 0) NULL,
	[income_interest_third] [numeric](18, 0) NULL,
	[income_interset_fourth] [numeric](18, 0) NULL,
	[income_other_first] [numeric](18, 0) NULL,
	[income_other_second] [numeric](18, 0) NULL,
	[income_other_third] [numeric](18, 0) NULL,
	[income_other_fourth] [numeric](18, 0) NULL,
 CONSTRAINT [PK_PlanMaster] PRIMARY KEY CLUSTERED 
(
	[amccode] ASC,
	[Plan_year] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReportGroup1]    Script Date: 07/15/2009 18:11:08 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReportGroup1](
	[amccode] [nchar](7) NOT NULL,
	[report_year] [nchar](4) NOT NULL,
	[report_month] [nchar](2) NOT NULL,
	[report_detail_code] [nchar](2) NOT NULL,
	[report_value] [numeric](18, 0) NULL,
 CONSTRAINT [PK_ReportGroup1] PRIMARY KEY CLUSTERED 
(
	[amccode] ASC,
	[report_year] ASC,
	[report_month] ASC,
	[report_detail_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReportGroup2]    Script Date: 07/15/2009 18:11:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReportGroup2](
	[amccode] [nchar](7) NOT NULL,
	[report_year] [nchar](4) NOT NULL,
	[report_month] [nchar](2) NOT NULL,
	[report_detail_code] [nchar](2) NOT NULL,
	[product_buy_sum] [numeric](18, 0) NULL,
	[product_buy_tabco] [numeric](18, 0) NULL,
	[product_sell_sum] [numeric](18, 0) NULL,
	[product_procure] [numeric](18, 0) NULL,
 CONSTRAINT [PK_ReportGroup2] PRIMARY KEY CLUSTERED 
(
	[amccode] ASC,
	[report_year] ASC,
	[report_month] ASC,
	[report_detail_code] ASC
) ON [PRIMARY]
) ON [PRIMARY]
GO
