<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<div class="fmenu-wrapper">
    <ul class="fmenu-list">

<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?if($arItem["SELECTED"]):?>
    <li class="fmenu-list__item"><a class="fmenu-list__link" href="<?=$arItem["LINK"]?>" disabled><?=$arItem["TEXT"]?></a></li>
	<?else:?>
		<li class="fmenu-list__item" ><a class="fmenu-list__link" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
	<?endif?>
	
<?endforeach?>

    </ul>
</div>
<?endif?>
