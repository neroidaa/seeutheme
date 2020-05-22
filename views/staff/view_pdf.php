<?php

// Get the full name of the staff member
if(!empty($model->first_name) && !empty($model->last_name))
{
	$fullName = $model->first_name.' '.$model->last_name;
}
else
{
	$fullName = $model->full_name;
}

// Get the filename for the CV
$fileName = $model->first_name.'-'.$model->last_name.'-SEEU-CV.pdf';


// Create the PDF document
$pdf = Yii::createComponent('ext.ETcPdf', 
                'P', 'cm', 'A4', true, 'UTF-8');
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($fullName);
$pdf->SetTitle(Yii::t('profile', "Profile: ").$fullName);
$pdf->SetSubject(Yii::t('profile', "Profile of {fullName} at the South East European University", array('fullName' => $fullName)));
$pdf->SetKeywords(implode(', ', array($model->first_name, $model->last_name, 'SEEU', 'CV', 'profile')));
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set auto page breaks

// $pdf->AliasNbPages();
$pdf->AddPage();
// $pdf->Image(dirname(dirname(dirname(__FILE__))).'/img/logo.png', 1.0, 1.0, 2.0, 2.0, 'PNG', 'http://www.seeu.edu.mk', '', true, 150, '', false, false, 0, false, false, false);

// Cell ($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')


// $pdf->Image(YiiBase::getPathOfAlias('webroot.images.staff').'/'.$picture, 16.0, 1.0, 4.0, 4.0, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);

$pdf->SetAutoPageBreak(TRUE, 2.0);

/**
* Create the HTML data for the current staff member
*/

$result = '
<table><tr>
	<td width="70">
		<a href="http://www.seeu.edu.mk"><img src="'.dirname(dirname(dirname(__FILE__))).'/img/logo.png" width="50" height="50" /></a>
	</td>
	<td>
		<h2>'.Yii::t('app','South East European University').'</h2>
		www.seeu.edu.mk	
	</td>
</tr></table>
';

$result .= '<h1>'.$fullName.'</h1>';

$result .= $this->renderPartial('view_pdf_basic', array('model'=>$model), true);

$educations 	= $model->educations;
$experiences 	= $model->experiences;
$publications 	= $model->publications;

$result .= '<div class="staff-records">';

if(count($educations))
{
	$result .= '<h3>'.Yii::t('profile','Education').'</h3>';
	$result .= '<ul>';
	foreach($educations as $record)
	{
		$result .= '<li>';
		$result .= $this->renderPartial('view_pdf_education', array('record'=>$record), true);
		$result .= '<br /></li>';
	}
	$result .= '</ul>';
}

if(count($publications))
{
	$result .= '<h3>'.Yii::t('profile','Publications').'</h3>';
	$result .= '<ul>';
	foreach($publications as $record)
	{
		$result .= '<li>';
		$result .= $this->renderPartial('view_pdf_publication', array('record'=>$record), true);
		$result .= '<br /></li>';
	}
	$result .= '</ul>';
}

if(count($experiences))
{
	$result .= '<h3>'.Yii::t('profile','Work Experience').'</h3>';
	$result .= '<ul>';
	foreach($experiences as $record)
	{
		$result .= '<li>';
		$result .= $this->renderPartial('view_pdf_experience', array('record'=>$record), true);
		$result .= '<br /></li>';
	}
	$result .= '</ul>';
}

$result .= '</div>';


// $pdf->SetFont('helvetica', '', 10);
$pdf->SetFont('freesans', '', 10, '', false);
// define some HTML content with style
$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	li {
		text-align: left;
	}
</style>

{$result}

EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Print the PDF
$pdf->Output($fileName, "I");