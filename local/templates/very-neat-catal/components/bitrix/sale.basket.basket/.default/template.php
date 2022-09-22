<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\UI\Extension::load("ui.fonts.ruble");

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @var string $templateName
 * @var CMain $APPLICATION
 * @var CBitrixBasketComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $giftParameters
 */
?>

    <a  href="<?=$_SERVER["REQUEST_URI"]?>">Обновить!</a>


<?php
$documentRoot = Main\Application::getDocumentRoot();

if (empty($arParams['TEMPLATE_THEME']))
{
	$arParams['TEMPLATE_THEME'] = Main\ModuleManager::isModuleInstalled('bitrix.eshop') ? 'site' : 'blue';
}

if ($arParams['TEMPLATE_THEME'] === 'site')
{
	$templateId = Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', $component->getSiteId());
	$templateId = preg_match('/^eshop_adapt/', $templateId) ? 'eshop_adapt' : $templateId;
	$arParams['TEMPLATE_THEME'] = Main\Config\Option::get('main', 'wizard_'.$templateId.'_theme_id', 'blue', $component->getSiteId());
}

if (!empty($arParams['TEMPLATE_THEME']))
{
	if (!is_file($documentRoot.'/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
	{
		$arParams['TEMPLATE_THEME'] = 'blue';
	}
}

if (!isset($arParams['DISPLAY_MODE']) || !in_array($arParams['DISPLAY_MODE'], array('extended', 'compact')))
{
	$arParams['DISPLAY_MODE'] = 'extended';
}

$arParams['USE_DYNAMIC_SCROLL'] = isset($arParams['USE_DYNAMIC_SCROLL']) && $arParams['USE_DYNAMIC_SCROLL'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_FILTER'] = isset($arParams['SHOW_FILTER']) && $arParams['SHOW_FILTER'] === 'N' ? 'N' : 'Y';

$arParams['PRICE_DISPLAY_MODE'] = isset($arParams['PRICE_DISPLAY_MODE']) && $arParams['PRICE_DISPLAY_MODE'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['TOTAL_BLOCK_DISPLAY']) || !is_array($arParams['TOTAL_BLOCK_DISPLAY']))
{
	$arParams['TOTAL_BLOCK_DISPLAY'] = array('top');
}

if (empty($arParams['PRODUCT_BLOCKS_ORDER']))
{
	$arParams['PRODUCT_BLOCKS_ORDER'] = 'props,sku,columns';
}

if (is_string($arParams['PRODUCT_BLOCKS_ORDER']))
{
	$arParams['PRODUCT_BLOCKS_ORDER'] = explode(',', $arParams['PRODUCT_BLOCKS_ORDER']);
}

$arParams['USE_PRICE_ANIMATION'] = isset($arParams['USE_PRICE_ANIMATION']) && $arParams['USE_PRICE_ANIMATION'] === 'N' ? 'N' : 'Y';
$arParams['EMPTY_BASKET_HINT_PATH'] = isset($arParams['EMPTY_BASKET_HINT_PATH']) ? (string)$arParams['EMPTY_BASKET_HINT_PATH'] : '/';
$arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
$arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
$arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';

if ($arParams['USE_GIFTS'] === 'Y')
{
	$arParams['GIFTS_BLOCK_TITLE'] = isset($arParams['GIFTS_BLOCK_TITLE']) ? trim((string)$arParams['GIFTS_BLOCK_TITLE']) : Loc::getMessage('SBB_GIFTS_BLOCK_TITLE');

	CBitrixComponent::includeComponentClass('bitrix:sale.products.gift.basket');

	$giftParameters = array(
		'SHOW_PRICE_COUNT' => 1,
		'PRODUCT_SUBSCRIPTION' => 'N',
		'PRODUCT_ID_VARIABLE' => 'id',
		'USE_PRODUCT_QUANTITY' => 'N',
		'ACTION_VARIABLE' => 'actionGift',
		'ADD_PROPERTIES_TO_BASKET' => 'Y',
		'PARTIAL_PRODUCT_PROPERTIES' => 'Y',

		'BASKET_URL' => $APPLICATION->GetCurPage(),
		'APPLIED_DISCOUNT_LIST' => $arResult['APPLIED_DISCOUNT_LIST'],
		'FULL_DISCOUNT_LIST' => $arResult['FULL_DISCOUNT_LIST'],

		'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
		'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_SHOW_VALUE'],
		'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],

		'BLOCK_TITLE' => $arParams['GIFTS_BLOCK_TITLE'],
		'HIDE_BLOCK_TITLE' => $arParams['GIFTS_HIDE_BLOCK_TITLE'],
		'TEXT_LABEL_GIFT' => $arParams['GIFTS_TEXT_LABEL_GIFT'],

		'DETAIL_URL' => isset($arParams['GIFTS_DETAIL_URL']) ? $arParams['GIFTS_DETAIL_URL'] : null,
		'PRODUCT_QUANTITY_VARIABLE' => $arParams['GIFTS_PRODUCT_QUANTITY_VARIABLE'],
		'PRODUCT_PROPS_VARIABLE' => $arParams['GIFTS_PRODUCT_PROPS_VARIABLE'],
		'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
		'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
		'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
		'MESS_BTN_BUY' => $arParams['GIFTS_MESS_BTN_BUY'],
		'MESS_BTN_DETAIL' => $arParams['GIFTS_MESS_BTN_DETAIL'],
		'CONVERT_CURRENCY' => $arParams['GIFTS_CONVERT_CURRENCY'],
		'HIDE_NOT_AVAILABLE' => $arParams['GIFTS_HIDE_NOT_AVAILABLE'],

		'PRODUCT_ROW_VARIANTS' => '',
		'PAGE_ELEMENT_COUNT' => 0,
		'DEFERRED_PRODUCT_ROW_VARIANTS' => \Bitrix\Main\Web\Json::encode(
			SaleProductsGiftBasketComponent::predictRowVariants(
				$arParams['GIFTS_PAGE_ELEMENT_COUNT'],
				$arParams['GIFTS_PAGE_ELEMENT_COUNT']
			)
		),
		'DEFERRED_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],

		'ADD_TO_BASKET_ACTION' => 'BUY',
		'PRODUCT_DISPLAY_MODE' => 'Y',
		'PRODUCT_BLOCKS_ORDER' => isset($arParams['GIFTS_PRODUCT_BLOCKS_ORDER']) ? $arParams['GIFTS_PRODUCT_BLOCKS_ORDER'] : '',
		'SHOW_SLIDER' => isset($arParams['GIFTS_SHOW_SLIDER']) ? $arParams['GIFTS_SHOW_SLIDER'] : '',
		'SLIDER_INTERVAL' => isset($arParams['GIFTS_SLIDER_INTERVAL']) ? $arParams['GIFTS_SLIDER_INTERVAL'] : '',
		'SLIDER_PROGRESS' => isset($arParams['GIFTS_SLIDER_PROGRESS']) ? $arParams['GIFTS_SLIDER_PROGRESS'] : '',
		'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

		'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
		'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
		'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY']
	);
}

\CJSCore::Init(array('fx', 'popup', 'ajax'));
Main\UI\Extension::load(['ui.mustache']);

$this->addExternalCss('/bitrix/css/main/bootstrap.css');
$this->addExternalCss($templateFolder.'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css');

$this->addExternalJs($templateFolder.'/js/action-pool.js');
$this->addExternalJs($templateFolder.'/js/filter.js');
$this->addExternalJs($templateFolder.'/js/component.js');

$mobileColumns = isset($arParams['COLUMNS_LIST_MOBILE'])
	? $arParams['COLUMNS_LIST_MOBILE']
	: $arParams['COLUMNS_LIST'];
$mobileColumns = array_fill_keys($mobileColumns, true);

$jsTemplates = new Main\IO\Directory($documentRoot.$templateFolder.'/js-templates');
/** @var Main\IO\File $jsTemplate */
foreach ($jsTemplates->getChildren() as $jsTemplate)
{
	include($jsTemplate->getPath());
}

$displayModeClass = $arParams['DISPLAY_MODE'] === 'compact' ? ' basket-items-list-wrapper-compact' : '';

if (empty($arResult['ERROR_MESSAGE']))
{
    $countProdBasket=count($arResult['GRID']['ROWS']);


    if (!$USER->IsAuthorized()) // Для неавторизованного
    {

        $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
        $favCookie = $request->getCookie('favorites');

        $arFavorites = unserialize($favCookie);
        $favoritesAr = [];
        foreach ($arFavorites as $itemFav) {
            $favoritesAr[$itemFav] = true;
        }
    } else {

        $idUser = $USER->GetID();
        $rsUser = CUser::GetByID($idUser);
        $arUser = $rsUser->Fetch();
        $arFavorites = $arUser['UF_FAVORITES'];  // Достаём избранное пользователя

        $favoritesAr = [];
        foreach ($arFavorites as $itemFav) {
            $favoritesAr[$itemFav] = true;
        }

    }

    ?>




    <div class="minicart-content__list">
        <div class="minicart-title">Корзина <span id="products-count"><?
                echo num_word($countProdBasket,["Товар","Товара","Товаров"]);
                ?></span></div>
        <div class="product-list">
            <?

            $IDHighload = 2;
            CModule::IncludeModule('highloadblock');
            $hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($IDHighload)->fetch();
            $hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
            $hlDataClass = $hldata["NAME"] . "Table";
            foreach ($arResult["GRID"]['ROWS'] as $basketItemId => $basketItem ){
                //echo "<pre>";print_r($arResult);
                foreach ($basketItem['PROPS'] as $itemProps){
                    switch ($itemProps["CODE"]){
                        case "SIZES_CLOTHES":

                            $sizesItem=$itemProps["VALUE"];
                            break;

                    }}
                    $idItemBasket= $basketItem['ID'];
                    $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PICTURE", "PROPERTY_*");
                    $arFilter = array("IBLOCK_ID" => 3, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "ID" => $basketItem['PRODUCT_ID']);
                    $resOffer = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
                    $Photo = "";
                    $sizesArr = [];
                    $article="";
                    $url="";
                    if  ($obOffer = $resOffer->GetNextElement()) {
                        $arFieldsOffer = $obOffer->GetFields();
                        $arProps = $obOffer->GetProperties();
                        $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL", "PROPERTY_*");
                        $arFilter = array("IBLOCK_ID" => 2, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "ID" => $arProps["CML2_LINK"]["VALUE"]);
                        $resProd = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
                        if ($obProd = $resProd->GetNextElement()) {
                            $arFieldsProd = $obProd->GetFields();
                            $arPropsProd = $obProd->GetProperties();
                            $url = $arFieldsProd["DETAIL_PAGE_URL"];
                            $article =  $arPropsProd['ARTNUMBER']['VALUE'];
                            $nameProd=$arFieldsProd['NAME'];
                            $idProd=$arFieldsProd['ID'];
                        }

                        if (empty($Photo)) {
                            $renderImage = CFile::ResizeImageGet($arFieldsOffer["DETAIL_PICTURE"], array("width" => 100, "height" => 140), BX_RESIZE_IMAGE_PROPORTIONAL);
                            $Photo = $renderImage["src"];
                        }
                        $salePrice = "";
                        $retailPrice = "";

                        $salePrice = round($basketItem['FULL_PRICE']);
                        $retailPrice = round($basketItem['FULL_PRICE']);


                        $resultColor = $hlDataClass::getList(array(
                            "select" => array("ID", "UF_NAME", "UF_XML_ID", "UF_COLORCOD"), // Поля для выборки
                            "order" => array(),
                            "filter" => array("UF_XML_ID" => $arProps["COLOR_REF"]['VALUE']),
                        ));
                        if ($resp = $resultColor->fetch()) {
                            $mainColor = $resp['UF_COLORCOD'];
                            $mainColorName = $resp['UF_NAME'];
                        }
                        if (empty($mainColor)){
                            $mainColor="#8A8972";
                        }
                        ?>
                        <div class="minicart-content__item">
                            <div class="image-block">
                                <a href="<?=$url?>" class="product-link">
                                    <img src="<?= $Photo ?>" alt="product-image" class="product-image">
                                </a>
                            </div>
                            <div class="descr-block">
                                <a href="<?=$url?>" class="product-name"><?=$nameProd?></a>
                                <span class="article"><?=$article?></span>
                                <div class="properties">
                                    <span class="properties__item"><?=$sizesItem?></span>
                                    <span class="properties__color"><span style="background-color: <?=$mainColor?>;"></span><?=$mainColorName?></span>
                                </div>
                                <div class="count-block">
                                    <div class="input-group count-group">
                                        <a href="javascript:void(0);" data-price="<?=$basketItem['PRICE']?>" data-basketid="<?=$basketItem['PRODUCT_ID']?>" class="count-btn minus-btn"><i class="icon icon-count_arrow"></i></a>
                                        <input type="text" class="count-input" readonly value="<?=$basketItem['QUANTITY']?>">
                                        <a href="javascript:void(0);" data-price="<?=$basketItem['PRICE']?>" data-basketid="<?=$basketItem['PRODUCT_ID']?>" class="count-btn plus-btn"><i class="icon icon-count_arrow"></i></a>
                                    </div>
                                    <a style="cursor: pointer"  data-item="<?=$idProd?>" class="favorite-link <? if (isset($favoritesAr[$idProd])){echo "active";}  ?>"><i class="icon icon-heart_fill"></i></a>
                                </div>
                            </div>
                            <div class="price-block">
                                <span class="oldprice"></span>
                                <span class="price"><?=$basketItem['PRICE'] ?> ₽</span>
                            </div>
                            <div class="delete-block">
                                <a style="cursor: pointer" data-idprod="<?=$idItemBasket?>" class="delete-product"><i class="icon icon-trash"></i></a>
                            </div>
                            <?
                            ?>
                        </div>
                        <?
                    }
                }
            ?>
        </div>
        <div class="minicart-content__result">
            <div class="price-group">Итого: <span id="result-total"><?=$arResult['TOTAL_RENDER_DATA']['PRICE_FORMATED']?></span></div>
            <a href="/personal/order/make/" class="order-link btn-fill-style">Оформить заказ</a>
        </div>
    </div>


<script>

    $(document).ready(function () {



        $('.favorite-link-basket').on('click', function (e) {
            let doAction
            var favorID = $(this).attr('data-item');
            if ($(this).hasClass('active')) {
                doAction = 'delete';
                $(this).removeClass('active');
            } else {
                doAction = 'add';
                $(this).addClass('active');
            }


            addFavorite(favorID, doAction);

        });

        function addFavorite(id, action) {
            var param = 'id=' + id + "&action=" + action;
            $.ajax({
                url: '/favorites.php', // URL отправки запроса
                type: "GET",
                dataType: "html",
                data: param,
                success: function (response) {
                },
                error: function (jqXHR, textStatus, errorThrown) { // Ошибка
                    console.log('Error: ' + errorThrown);
                }
            });
        }


        function format(str) {
            const s = str.length;
            const chars = str.split('');
            const strWithSpaces = chars.reduceRight((acc, char, i) => {
                const spaceOrNothing = ((((s - i) % 3) === 0) ? ' ' : '');
                return (spaceOrNothing + char + acc);
            }, '');

            return ((strWithSpaces[0] === ' ') ? strWithSpaces.slice(1) : strWithSpaces);
        }


        $('.delete-product').on('click', function (e) {
            let idProdBlock = $(this).data("idprod");
            $(this).parent().parent().hide();
            $.ajax({
                url: '/dellbasket.php',
                type: 'POST',
                data: {prod: idProdBlock},
                success: (res) => {
                    console.log(res);
                }
            })
        });

        $(".count-block .count-group .plus-btn").click(function () {
            let count = $(this).parent().find(".count-input").val();
            let countINT=Number(count);
            $(this).parent().find(".count-input").val(countINT+1);
            let addProdBasket = $(this).data("basketid");
            let newPricePlus = $(this).data("price");
            newPricePlus = Number(newPricePlus)
            let oldprice = $("#result-total").text().replace(/[^0-9]/g, "");
            oldprice = Number(oldprice)
            let newPrice = oldprice + newPricePlus;

            let newPriceString = String(newPrice);
            newPriceString=  format(newPriceString)

            $("#result-total").text(newPriceString + " ₽");
            $.ajax({
                url: '/addbasket.php',
                type: 'POST',
                data: {prod: addProdBasket},
                success: (res) => {
                    console.log(res);
                }
            })
        });


        $(".minus-btn").click(function () {
            let count = $(this).parent().find(".count-input").val();
            let countINT=Number(count);
            $(this).parent().find(".count-input").val(countINT-1);
            if (count == 1) {
                return false;
            }
            let addProdBasket = $(this).data("basketid");
            let newPriceMinus = $(this).data("price");
            newPriceMinus = Number(newPriceMinus)
            let oldprice = $("#result-total").text().replace(/[^0-9]/g, "");
            oldprice = Number(oldprice)
            let newPrice = oldprice - newPriceMinus;

            let newPriceString = String(newPrice);
            newPriceString=  format(newPriceString)


            $("#result-total").text(newPriceString + " ₽");
            $.ajax({
                url: '/dellbasketItem.php',
                type: 'POST',
                data: {prod: addProdBasket},
                success: (res) => {
                    console.log(res);
                }
            })
        });




    })


</script>

    <?php
}
elseif ($arResult['EMPTY_BASKET']){


    ?>

    <div class="minicart-content__empty">
        <p>Ваша корзина пуста</p>
    </div>

    <?php


}

//{
//	include(Main\Application::getDocumentRoot().$templateFolder.'/empty.php');
//}
//else
//{
//	ShowError($arResult['ERROR_MESSAGE']);
//}
