<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()
$css = $APPLICATION->GetCSSArray();
if(!is_array($css) || !in_array("/bitrix/css/main/font-awesome.css", $css))
{
	$strReturn .= '<link href="'.CUtil::GetAdditionalFileURL("/bitrix/css/main/font-awesome.css").'" type="text/css" rel="stylesheet" />'."\n";
}

$strReturn .= '<div class="bx-breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
echo "<pre>";
print_r($arResult);
echo "</pre>";

$strReturn .= '<div style="clear:both"></div></div>';



?>


    <div class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumbs__list">
                <li class="breadcrumbs__item"><a href="#" class="breadcrumbs__link">…</a></li>
                <li class="breadcrumbs__item"><a href="#" class="breadcrumbs__link">ПОВСЕДНЕВНАЯ
                        ОДЕЖДА</a></li>
                <li class="breadcrumbs__item"><a href="#" class="breadcrumbs__link">МАЙКИ</a></li>
            </ul>
        </div>
    </div>


<?php


return $strReturn;
