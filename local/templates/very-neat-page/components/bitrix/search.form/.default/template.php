<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);?>
<form action="<?=$arResult["FORM_ACTION"]?>" class="search-block__form">
    <div class="input-group">
        <button name="s" type="submit"><i class="icon icon-search"></i></button>
        <input class="ajax-search" type="text" name="q" placeholder="Поиск">
    </div>
    <a id="search-close" href="javascript:void(0);" class="close-link"><i
                class="icon icon-close"></i></a>
</form>