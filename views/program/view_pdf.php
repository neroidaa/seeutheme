<?php

$fullName = $model->name;

// Get the filename for the CV
$fileName = $model->name.'-'.$model->id.'.pdf';


// Create the PDF document
$pdf = Yii::createComponent('ext.ETcPdf',
                'P', 'cm', 'A4', true, 'UTF-8');
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($fullName);
$pdf->SetTitle(Yii::t('profile', "Profile: ").$fullName);
$pdf->SetSubject(Yii::t('profile', "Profile of {fullName} at the South East European University", array('fullName' => $fullName)));
$pdf->SetKeywords(implode(', ', array($model->name, 'SEEU', 'programme')));
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

$result = '<a href="http://www.seeu.edu.mk" style="text-align: center;"><img src="'.dirname(dirname(dirname(__FILE__))).'/img/logo_full.png" width="349" /></a><br />';

/*
if($model->offered_te && $model->offered_sk)
{
	$offered = Yii::t('programme', 'Tetovo')
			 . " " . Yii::t('programme', 'and')
			 . " " . Yii::t('programme', 'Skopje');
}
elseif($model->offered_sk)
{
	$offered = Yii::t('programme', 'Skopje');
}
else
{
	$offered = Yii::t('programme', 'Tetovo');
}*/

if($model->lang_checked)
{
	$langs = array();
	if($model->lang_en) $langs[] = Yii::t('programme', 'English');
	if($model->lang_sq) $langs[] = Yii::t('programme', 'Albanian');
	if($model->lang_mk) $langs[] = Yii::t('programme', 'Macedonian');
	$langRow = '
	<tr>
		<td class="highlight right">'.Yii::t('programme', 'Languages').'</td>
		<td>'. implode(', ', $langs) .'</td>
	</tr>
	';
}
else
{
	$langRow = '';
}



$result .= '<div>
<table cellpadding="5">
	<tr>
		<td width="200" class="highlight right"><h2>'.Yii::t('programme', 'Study program').'</h2></td>
		<td><h2>'. $model->name .'</h2></td>
	</tr>
	<tr>
		<td class="highlight right">'.Yii::t('programme', 'Faculty').'</td>
		<td>'. $department->name .'</td>
	</tr>';
if(($model->cycle == 'Undergraduate') && (Yii::app()->language=='en')) {

	$result .= '<tr>
		<td class="highlight right">'.Yii::t('programme', 'Study Cycle').'</td>
		<td>First Cycle (Undergraduate)</td>
	</tr>';

	} elseif (($model->cycle == 'Postgraduate') && (Yii::app()->language=='en')) {
		$result .= '<tr>
		<td class="highlight right">'.Yii::t('programme', 'Study Cycle').'</td>
		<td>Second Cycle ('. Yii::t('programme',$model->cycle) .')</td>
		</tr>';
	}

	else {

		if(Yii::app()->language=='en') {
			$result .= '<tr>
				<td class="highlight right">'.Yii::t('programme', 'Study Cycle').'</td>
				<td>Third Cycle ('. Yii::t('programme',$model->cycle) .')</td>
			</tr>';
		} else {
			$result .= '<tr>
				<td class="highlight right">'.Yii::t('programme', 'Study Cycle').'</td>
				<td>'. Yii::t('programme',$model->cycle) .'</td>
			</tr>';
		}

}

if($model->ectsplus) {
	$result .= '<tr>
			<td class="highlight right">'.Yii::t('programme', 'ECTS').'</td>
			<td>'. $model->ects .' / '. $model->ectsplus .'</td>
		</tr>';
	} else {
		$result .= '<tr>
			<td class="highlight right">'.Yii::t('programme', 'ECTS').'</td>
			<td>'. $model->ects .'</td>
		</tr>';
	}
if($model->code) {
$result .='
	<tr>
		<td class="highlight right">'.Yii::t('programme', 'Code').'</td>
		<td>'. $model->code .'</td>
	</tr>';
}


if(!($model->academic_title1 && $model->academic_title2) && $model->academic_title1) {
	$result .='
	<tr>
		<td class="highlight right">'.Yii::t('programme', 'Title').'</td>
		<td>'. $model->academic_title1 .'</td>
	</tr>';
}

if($model->decision1) {
$result .='
	<tr>
		<td class="highlight right">'.Yii::t('programme', 'Archive number').' ['.$model->ects.']</td>
		<td>'. $model->decisionnr1 .'</td>
	</tr>';
}

if($model->academic_title1 && $model->academic_title2) {
$result .='
	<tr>
		<td class="highlight right">'.Yii::t('programme', 'Title').'</td>
		<td>'. $model->academic_title1 .'</td>
	</tr>';
}

if($model->decision2) {
$result .='
	<tr>
		<td class="highlight right">'.Yii::t('programme', 'Archive number').' ['.$model->ectsplus.']</td>
		<td>'. $model->decisionnr2 .'</td>
	</tr>';
}

if($model->decision3) {
    $result .= '<tr>
			<td class="highlight right">' . Yii::t('programme', 'Decision for the running of the program') . '</td>
			<td>' . $model->decisionnr3 . '</td>
		</tr>';
}

if($model->academic_title1 && $model->academic_title2) {
$result .='
	<tr>
		<td class="highlight right">'.Yii::t('programme', 'Title').'</td>
		<td>'. $model->academic_title2 .'</td>
	</tr>';
}

if($model->accreditation_date) {
$result .='
	<tr>
		<td class="highlight right">'.Yii::t('programme', 'Accreditation date').'</td>
		<td>'. date('d.m.Y',strtotime($model->accreditation_date)) .'</td>
	</tr>';
}

/*
$result .='<tr>
		<td class="highlight right">'.Yii::t('programme', 'Offered in').'</td>
		<td>'. $offered .'</td>
	</tr>
	<?php echo $langRow ?>';
	*/
$result .='
</table>
</div>';

// Cleanup some dirty texts
$model->description = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$model->description);
$model->career = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$model->career);
$model->lod_1 = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$model->lod_1);
$model->lod_2 = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$model->lod_2);
$model->lod_3 = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$model->lod_3);
$model->lod_4 = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$model->lod_4);
$model->lod_5 = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$model->lod_5);






$result .= '
	<h2>'.Yii::t('programme', 'Description of the program').'</h2>
	'.$model->description.'
';

$result .= '
	<h2>'.Yii::t('programme', 'Career').'</h2>
	'.$model->career.'
';

$result .= '
	<h2>'.Yii::t('programme', 'Learning outcomes').'</h2>
	<h4>'.Yii::t('programme', 'Knowledge and understanding').'</h4>
	'.$model->lod_1.'
	<h4>'.Yii::t('programme', 'Applying knowledge and understanding').'</h4>
	'.$model->lod_2.'
	<h4>'.Yii::t('programme', 'Making judgement').'</h4>
	'.$model->lod_3.'
	<h4>'.Yii::t('programme', 'Communication skills').'</h4>
	'.$model->lod_4.'
	<h4>'.Yii::t('programme', 'Learning skills').'</h4>
	'.$model->lod_5.'
';

$result .= '
<h2>'.Yii::t('programme', 'List of courses').'</h2>
';

$semesters = array();
for($i = 1; $i <= $model->semesters; $i++) {
	$semesters[$i] = array(
		0 => array(
			'conc' => 'Default Concentration',
			'courses'=>array(),
		),
	);
}
$conc = AcProgramConcentration::model()->localized()->findAllByAttributes(array('program_id'=>$model->id));
if(count($conc)) {
	foreach($conc as $c) {
		foreach($c->semestersArray as $s) {
			if(isset($semesters[$s]) && !isset($semesters[$s][$c->id])) {
				$semesters[$s][$c->id] = array(
					'conc' => $c->name,
					'courses'=>array(),
				);
			}
		}
	}
}
foreach($model->courses as $i => $course) {
	if($course->concentration_id != null && isset($semesters[$course->semester][$course->concentration_id])) {
		$semesters[$course->semester][$course->concentration_id]['courses'][] = $course;
	} else {
		$semesters[$course->semester][0]['courses'][] = $course;
	}
}


foreach($semesters as $i => $semesterData)
{
	$result .= '<h3>'.Yii::t('programme', 'Semester').' '.$i.'</h3>';
	foreach($semesterData as $cid => $cdata)
	{
		if($cid > 0)
			$result .= '<h4>'.Yii::t('programme', 'Concentration: ').$cdata['conc'].'</h4>';
		$result .= '<ul class="program-courses">';
		foreach($cdata['courses'] as $course)
		{

			$courseDetail = AcCourseDetail::model()->localized()->findByPK($course->course_detail_id);
			$courseDetail->description = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$courseDetail->description);

			$result .= '<li>';
			if ($course->code) { $result .= '['.$course->code.'] '; }
			if ($model->id != 74 && $model->id != 78) { $result .= '['.$course->ects.' '.Yii::t('programme', 'ECTS').']'; }
			$result .= ' <strong>'.$courseDetail->name.'</strong>';
			$result .= '</li>';

		}
		$result .= '</ul>';
	}
}

$result .= '
<h2>'.Yii::t('programme', 'Description of courses').'</h2>
';

$result .= '
<h3>'.Yii::t('programme', 'Core courses').'</h3>
';


foreach($semesters as $i => $semesterData)
{
	foreach($semesterData as $cid => $cdata)
	{
		$result .= '<ul class="program-courses">';
		foreach($cdata['courses'] as $course)
		{
			if($course->type == 'core')
			{
				$courseDetail = AcCourseDetail::model()->localized()->findByPK($course->course_detail_id);
				$courseDetail->description = preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$courseDetail->description);

				$result .= '<li><p>';
				$result .= '<strong>'.$courseDetail->name.'</strong><br>';
				$result .= $courseDetail->description;
				$result .= '</p></li>';
			}
		}
		$result .= '</ul>';
	}
}


$result .= '
<h3>'.Yii::t('programme', 'Elective courses').'</h3>
';

$included = array();

foreach($semesters as $i => $semesterData)
{
	foreach($semesterData as $cid => $cdata)
	{
		$result .= '<ul class="program-courses">';
		foreach($cdata['courses'] as $course)
		{
			if($course->type == 'elective') {

				foreach($course->children as $ecCourse)
				{
					$courseDetail = AcCourseDetail::model()->localized()->findByPK($ecCourse->course_detail_id);
					$courseDetail->description = trim(preg_replace('#<p[^>]*>(\s|&nbsp;?)*</p>#', '',$courseDetail->description));
					if(!isset($included[$courseDetail->name]) && !empty($courseDetail->description))
					{
						$included[$courseDetail->name] = true;


						$result .= '<li><p>';
						$result .= '<strong>'.$courseDetail->name.'</strong><br>';
						$result .= $courseDetail->description;
						$result .= '</p></li>';
					}
				}
			}
		}
		$result .= '</ul>';
	}
}





// $pdf->SetFont('helvetica', '', 10);
$pdf->SetFont('freesans', '', 10, '', false);
// define some HTML content with style
$html = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
	table.bordered td {
		border: 1px solid #000000;
	}
	.highlight td, td.highlight {
		background-color: rgb(219, 229, 241);
	}
	td.right {
		text-align: right;
	}
</style>

{$result}

EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Print the PDF
$pdf->Output($fileName, "I");
