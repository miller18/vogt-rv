<?php

function createSeoLink($stocknum, $condition, $year, $make, $model, $type) {
	$seolink=".rv-detail.php?stocknumber=";
	$seolink .= $stocknum;
	$seolink .= "-";
	$seolink .= $condition;
	$seolink .= "-";
	$seolink .= $year;
	$seolink .= "-";
	$seolink .= ucwords(strtolower($make));
	$seolink .= "-";
	$seolink .= ucwords(strtolower($model));
	$seolink .= "-";
	$seolink .= ucwords(strtolower($type));
	$seolink .= "-";
	$seolink .= "-Vogt-RV-Dallas-Fort-Worth-Texas.rv";
	return $seoLink;
}
