<?php 
// ================================================
// SPAW PHP WYSIWYG editor control
// ================================================
// English language file
// ================================================
// Developed: Alan Mendelevich, alan@solmetra.lt
// Copyright: Solmetra (c)2003 All rights reserved.
// ------------------------------------------------
//                                www.solmetra.com
// ================================================
// v.1.0, 2003-03-20
// ================================================

// charset to be used in dialogs
$spaw_lang_charset = 'utf8';

// language text data array
// first dimension - block, second - exact phrase
// alternative text for toolbar buttons and title for dropdowns - 'title'

$spaw_lang_data = array(
  'cut' => array(
    'title' => '�Ѵ'
  ),
  'copy' => array(
    'title' => '�Ѵ�͡'
  ),
  'paste' => array(
    'title' => '�ҧ'
  ),
  'undo' => array(
    'title' => '¡��ԡ'
  ),
  'redo' => array(
    'title' => '������'
  ),
  'hyperlink' => array(
    'title' => '�������� Web'
  ),
  'image_insert' => array(
    'title' => '�á�ٻ�Ҿ',
    'select' => '���͡',
    'cancel' => '¡��ԡ',
    'library' => 'Library',
    'preview' => '������ҧ',
    'images' => '�ٻ�Ҿ',
    'upload' => 'Upload �ٻ�Ҿ',
    'upload_button' => 'Upload',
    'error' => '�բ�ͼԴ��Ҵ',
    'error_no_image' => 'Please select an image',
    'error_uploading' => 'An error occured while handling file upload. Please try again later',
    'error_wrong_type' => 'Wrong image file type',
    'error_no_dir' => 'Library doesn\'t physically exist',
  ),
  'image_prop' => array(
    'title' => 'Image properties',
    'ok' => '   OK   ',
    'cancel' => 'Cancel',
    'source' => 'Source',
    'alt' => 'Alternative text',
    'align' => 'Align',
    'left' => 'left',
    'right' => 'right',
    'top' => 'top',
    'middle' => 'middle',
    'bottom' => 'bottom',
    'absmiddle' => 'absmiddle',
    'texttop' => 'texttop',
    'baseline' => 'baseline',
    'width' => 'Width',
    'height' => 'Height',
    'border' => 'Border',
    'hspace' => 'Hor. space',
    'vspace' => 'Vert. space',
    'error' => 'Error',
    'error_width_nan' => 'Width is not a number',
    'error_height_nan' => 'Height is not a number',
    'error_border_nan' => 'Border is not a number',
    'error_hspace_nan' => 'Horizontal space is not a number',
    'error_vspace_nan' => 'Vertical space is not a number',
  ),
  'hr' => array(
    'title' => 'Horizontal rule'
  ),
  'table_create' => array(
    'title' => 'Create table'
  ),
  'table_prop' => array(
    'title' => 'Table properties',
    'ok' => '   OK   ',
    'cancel' => 'Cancel',
    'rows' => 'Rows',
    'columns' => 'Columns',
    'width' => 'width',
    'height' => 'height',
    'border' => 'border',
    'pixels' => 'pixels',
    'cellpadding' => 'Cell padding',
    'cellspacing' => 'Cell spacing',
    'bg_color' => 'Background color',
    'error' => 'Error',
    'error_rows_nan' => 'Rows is not a number',
    'error_columns_nan' => 'Columns is not a number',
    'error_width_nan' => 'Width is not a number',
    'error_height_nan' => 'Height is not a number',
    'error_border_nan' => 'Border is not a number',
    'error_cellpadding_nan' => 'Cell padding is not a number',
    'error_cellspacing_nan' => 'Cell spacing is not a number',
  ),
  'table_cell_prop' => array(
    'title' => 'Cell properties',
    'horizontal_align' => 'Horizontal align',
    'vertical_align' => 'Vertical align',
    'width' => 'Width',
    'height' => 'Height',
    'css_class' => 'CSS class',
    'no_wrap' => 'No wrap',
    'bg_color' => 'Background color',
    'ok' => '   OK   ',
    'cancel' => 'Cancel',
    'left' => 'Left',
    'center' => 'Center',
    'right' => 'Right',
    'top' => 'Top',
    'middle' => 'Middle',
    'bottom' => 'Bottom',
    'baseline' => 'Baseline',
    'error' => 'Error',
    'error_width_nan' => 'Width is not a number',
    'error_height_nan' => 'Height is not a number',
  ),
  'table_row_insert' => array(
    'title' => 'Insert row'
  ),
  'table_column_insert' => array(
    'title' => 'Insert column'
  ),
  'table_row_delete' => array(
    'title' => 'Delete row'
  ),
  'table_column_delete' => array(
    'title' => 'Delete column'
  ),
  'table_cell_merge_right' => array(
    'title' => 'Merge right'
  ),
  'table_cell_merge_down' => array(
    'title' => 'Merge down'
  ),
  'table_cell_split_horizontal' => array(
    'title' => 'Split cell horizontally'
  ),
  'table_cell_split_vertical' => array(
    'title' => 'Split cell vertically'
  ),
  'style' => array(
    'title' => '�ٻẺ'
  ),
  'font' => array(
    'title' => '����ѡ��'
  ),
  'fontsize' => array(
    'title' => '��Ҵ����ѡ��'
  ),
  'paragraph' => array(
    'title' => '���˹��'
  ),
  'bold' => array(
    'title' => '���˹�'
  ),
  'italic' => array(
    'title' => '������§'
  ),
  'underline' => array(
    'title' => '��Ǣմ�����'
  ),
  'ordered_list' => array(
    'title' => '���§�������Ţ'
  ),
  'bulleted_list' => array(
    'title' => '���§����ͧ����'
  ),
  'indent' => array(
    'title' => '���˹������'
  ),
  'unindent' => array(
    'title' => '���˹���͡��'
  ),
  'left' => array(
    'title' => '�Դ����'
  ),
  'center' => array(
    'title' => '�Դ��ҧ'
  ),
  'right' => array(
    'title' => '�Դ���'
  ),
  'fore_color' => array(
    'title' => '�յ���ѡ��'
  ),
  'bg_color' => array(
    'title' => '�վ����ѧ����ѡ��'
  ),
  'design_tab' => array(
    'title' => 'Switch to WYSIWYG (design) mode'
  ),
  'html_tab' => array(
    'title' => '����¹���ٻẺ��� HTML'
  ),
  'colorpicker' => array(
    'title' => '���͡��',
    'ok' => '   OK   ',
    'cancel' => 'Cancel',
  ),
  'cleanup' => array(
    'title' => 'HTML cleanup (remove styles)',
    'confirm' => 'Performing this action will remove all styles, fonts and useless tags from the current content. Some or all your formatting may be lost.',
    'ok' => '   OK   ',
    'cancel' => 'Cancel',
  ),
  'toggle_borders' => array(
    'title' => 'Toggle borders',
  ),
  'hyperlink' => array(
    'title' => '�������͢����� Web',
    'url' => 'URL',
    'name' => 'Name',
    'target' => 'Target',
    'title_attr' => 'Title',
    'ok' => '   OK   ',
    'cancel' => 'Cancel',
  ),
  'table_row_prop' => array(
    'title' => 'Row properties',
    'horizontal_align' => 'Horizontal align',
    'vertical_align' => 'Vertical align',
    'css_class' => 'CSS class',
    'no_wrap' => 'No wrap',
    'bg_color' => 'Background color',
    'ok' => '   OK   ',
    'cancel' => 'Cancel',
    'left' => 'Left',
    'center' => 'Center',
    'right' => 'Right',
    'top' => 'Top',
    'middle' => 'Middle',
    'bottom' => 'Bottom',
    'baseline' => 'Baseline',
  ),
  'symbols' => array(
    'title' => 'Special characters',
    'ok' => '   OK   ',
    'cancel' => 'Cancel',
  ),
  'templates' => array(
    'title' => 'Templates',
  ),
  'page_prop' => array(
    'title' => '�ѡɳТͧ������ʴ�',
    'title_tag' => 'Title',
    'charset' => 'Charset',
    'background' => 'Background image',
    'bgcolor' => 'Background color',
    'text' => 'Text color',
    'link' => 'Link color',
    'vlink' => 'Visited link color',
    'alink' => 'Active link color',
    'leftmargin' => 'Left margin',
    'topmargin' => 'Top margin',
    'css_class' => 'CSS class',
    'ok' => '   OK   ',
    'cancel' => 'Cancel',
  ),
  'preview' => array(
    'title' => '������ҧ',
  ),
  'image_popup' => array(
    'title' => 'Image popup',
  ),
  'zoom' => array(
    'title' => '���',
  ),
);
?>

