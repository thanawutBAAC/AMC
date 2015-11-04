<?
	global $neuron_hidden;
	global $get_value;

	$xml = " <chart constrength='2' arrowAtStart='0' arrowAtEnd='1' conDashed='0' conDashLen='5' conDashGap='5' conAlpha='100' conColor='FF5904' stdThickness='2' catVerticalLineDashGap='2' catVerticalLineDashLen='4' catVerticalLineDashed='0' catVerticalLineAlpha='45' catVerticalLineThickness='1' catVerticalLineColor='7B7D6D' catFontColor='60634E' catFontSize='10' catFont='Verdana' canvasBottomMargin='-1' canvasTopMargin='-1' canvasRightMargin='-1' canvasLeftMargin='-1' unescapeLinks='1' showFormBtn='0' exportDataCaptureCallback='FC_ExportDataReady' exportDialogPBColor='E2E2E2' exportDialogFontColor='666666' exportDialogBorderColor='999999' exportDialogColor='FFFFFF' exportDialogMessage='Capturing Data : ' showExportDialog='1' exportCallback='FC_Exported' exportParameters='' exportFileName='FusionCharts' exportHandler='' exportTargetWindow='_self' exportAction='download' exportAtClient='0' exportFormats='JPG=Save as JPEG Image|PNG=Save as PNG Image|PDF=Save as PDF' exportShowMenuItem='0' exportEnabled='0' showVLineLabelBorder='1' outCnvBaseFontColor='60634E' outCnvBaseFontSize='10' outCnvBaseFont='Verdana' baseFontColor='60634E' baseFontSize='10' baseFont='Verdana' seriesNameInToolTip='1' showToolTipShadow='0' toolTipSepChar=', ' toolTipBorderColor='545454' toolTipBgColor='FFFFFF' showToolTip='1' logoScale='100' logoLink='' logoAlpha='100' logoPosition='TL' logoURL='' bgSWFAlpha='100' bgSWF='' exportDataLineBreak='' exportDataFormattedVal='0' exportDataSeparator=',' exportDataMenuItemLabel='Copy data to clipboard' showExportDataMenuItem='0' showPrintMenuItem='1' aboutMenuItemLink='' aboutMenuItemLabel='About FusionCharts' showFCMenuItem='1' yAxisValueDecimals='2' forceDecimals='0' decimals='2' inThousandSeparator='' inDecimalSeparator='' thousandSeparator=',' decimalSeparator='.' numberSuffix='' numberPrefix='' numberScaleValue='1000,1000' numberScaleUnit='K,M' defaultNumberScale='' formatNumberScale='1' formatNumber='1' negativeColor='ff0000' nodeScale='1' use3DLighting='1' plotBorderAlpha='95' plotBorderThickness='1' plotBorderColor='666666' showPlotBorder='1' plotFillAlpha='100' alternateHGridAlpha='35' alternateHGridColor='D8DCC5' showAlternateHGridColor='1' zeroPlaneAlpha='45' zeroPlaneThickness='1' zeroPlaneColor='7B7D6D' showZeroPlane='1' divLineDashGap='2' divLineDashLen='4' divLineIsDashed='0' divLineAlpha='45' divLineThickness='1' divLineColor='7B7D6D' numDivLines='0' reverseLegend='0' legendScrollBtnColor='545454' legendScrollBarColor='545454' legendScrollBgColor='CCCCCC' legendAllowDrag='0' legendShadow='1' legendBgAlpha='100' legendBgColor='ffffff' legendBorderAlpha='100' legendBorderThickness='1' legendBorderColor='545454' legendMarkerCircle='0' legendCaption='' legendPosition='BOTTOM' showLegend='0' canvasBorderAlpha='100' canvasBorderThickness='2' canvasBorderColor='545454' canvasBgAngle='0' canvasBgRatio='' canvasBgAlpha='100' canvasBgColor='FFFFFF' borderAlpha='50' borderThickness='1' borderColor='545454' showBorder='1' bgAngle='270' bgRatio='0,100' bgAlpha='60,50' bgColor='CFD4BE,F3F5DD' btnTextColor='000000' btnPadding='5' enableLink='0' viewMode='0' clickURL='' yAxisNameWidth='undefined' rotateYAxisName='1' adjustDiv='1' yAxisValuesStep='1' showDivLineValues='0' showLimits='0' showYAxisValues='0' staggerLines='2' labelStep='1' slantLabels='0' rotateLabels='' labelDisplay='WRAP' showLabels='0' defaultAnimation='1' animation='1' xAxisMaxValue='100' xAxisMinValue='0' yAxisMaxValue='100' yAxisMinValue='0' setAdaptiveYMin='0' yAxisName='' xAxisName='' subCaption='' caption='Feedforword Multilayer Perceptron' chartBottomMargin='15' chartTopMargin='15' chartRightMargin='15' chartLeftMargin='15' legendPadding='6' labelPadding='3' yAxisValuesPadding='2' yAxisNamePadding='5' xAxisNamePadding='5' captionPadding='10' paletteColors='' palette='2' ><categories></categories> ";

	$xml.=" <dataSet id='1' seriesName='DS1'> ";
// แสดงค่าในชั้นอินพุต Input Layer
	$id = 1;
	$x = 15;   // ตำแหน่งแนวนอน
	$y =  (70 * ($neuron_hidden))+10;   // ตำแหน่งแนวตั้ง
	for($i=1;$i<=11;$i++){
		$xml.=" <set id='".$id."' x='".$x."' y='".$y."' name='x".$id."' height='15' width='25'  shape='RECTANGLE' color='AFD8F8' /> ";
		$id++;
		$y = $y-40;
	} // end for 

// แสดงค่าในชั้นซ่อน Hidden Layer
	$x = 40;   // ตำแหน่งแนวนอน
	//$y = (70 * $neuron_hidden)+10;   // ตำแหน่งแนวตั้ง
	$y = (75*$neuron_hidden);
	for($i=1;$i<=$neuron_hidden;$i++){
		$xml.=" <set id='".$id."' x='".$x."' y='".$y."' name='F".$i."' radius='19' shape='CIRCLE' color='FFB655' /> ";
		$y = $y-70;
		$id++;
	} // end for 
// แสดง bias hidden
$xml.=" <set id='bias_hidden' x='40' y='".$y."' name='bias[1- hidden Neuron]' height='25' width='150' shape='RECTANGLE' color='FFFFFF' />";

// แสดงค่าในชั้นผลลัพธ์  Output Layer 
$x = 70;   // ตำแหน่งแนวนอน
$y = ((70 * $neuron_hidden)/2)+70;   // ตำแหน่งแนวตั้ง
$xml.=" <set id='".$id."' x='".$x."' y='".$y."' name='F".$i."' radius='25' shape='CIRCLE' color='87C352' /> ";
// แสดง bias hidden
$bias_output = $y - 100;
$xml.=" <set id='bias_output' x='70' y='".$bias_output."' name='bias[output]' height='20' width='100' shape='RECTANGLE' color='FFFFFF' />";
$id++;
$x = 90;
$xml.=" <set id='".$id."' x='".$x."' y='".$y."' name='Output' height='25' width='50' shape='RECTANGLE' color='FFEE00' />";


$xml.=" </dataSet> ";
// สร้างความสัมพันธ์ของเส้นเชื่อม
$xml.="<connectors stdThickness='2' >";
for($j=1;$j<=11;$j++)
{
	$id = 12;
	for($i=1;$i<=$neuron_hidden;$i++)
	{
		$xml.="<connector from='".$j."' to='".$id."' color='e79547' strength='0.5' arrowAtStart='0' alpha='100' label='w".$i.$j."'/>";
		$id++;
	}
}

$id=12;
$output = 12+$neuron_hidden;
for($i=1;$i<=$neuron_hidden;$i++)
{
	$xml.="<connector from='".$id."' to='".$output."' color='7FC3FF' strength='0.5' arrowAtStart='0' alpha='100' label='w".$i."'/>";
	$id++;
}
$id++;
$xml.="<connector from='".$output."' to='".$id."' color='FFB900' strength='0.5' arrowAtStart='0' alpha='100' label=''/>";
$xml.="</connectors>";
$xml.="</chart>";

$file = fopen( "Neuron.xml","w+");
	fputs($file,$xml);
fclose($file);

?>