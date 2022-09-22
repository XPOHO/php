<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if (empty($arResult)) {
    return "";
}


$strReturn = '';

$strReturn .= '<div class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumbs__list">';
//$strReturn .= '<div class="bx-breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);


//$strReturn .= '<div style="clear:both"></div></div><ul>';


$arResult[0]["TITLE"] = "Главная";
foreach ($arResult as $item) {


    if ($item['LINK'] == "/catalog/") {
        continue;
    }

    if (!empty($item['LINK'])) {
        $strReturn .= '<li class="breadcrumbs__item"><a href="' . $item['LINK'] . '" class="breadcrumbs__link">' . $item['TITLE'] . '</a></li>';
    } else {

        $strReturn .= '<li class="breadcrumbs__item"><a class="breadcrumbs__link">' . $item['TITLE'] . '</a></li>';

    }
}

$strReturn .= '
            </ul>
        </div>
    </div>
';
?>


<?php


return $strReturn;
