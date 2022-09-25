<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList,
    'ITEM' => array(
        'ID' => $arResult['ID'],
        'IBLOCK_ID' => $arResult['IBLOCK_ID'],
        'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
        'JS_OFFERS' => $arResult['JS_OFFERS']
    )
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
    'ID' => $mainId,
    'DISCOUNT_PERCENT_ID' => $mainId . '_dsc_pict',
    'STICKER_ID' => $mainId . '_sticker',
    'BIG_SLIDER_ID' => $mainId . '_big_slider',
    'BIG_IMG_CONT_ID' => $mainId . '_bigimg_cont',
    'SLIDER_CONT_ID' => $mainId . '_slider_cont',
    'OLD_PRICE_ID' => $mainId . '_old_price',
    'PRICE_ID' => $mainId . '_price',
    'DESCRIPTION_ID' => $mainId . '_description',
    'DISCOUNT_PRICE_ID' => $mainId . '_price_discount',
    'PRICE_TOTAL' => $mainId . '_price_total',
    'SLIDER_CONT_OF_ID' => $mainId . '_slider_cont_',
    'QUANTITY_ID' => $mainId . '_quantity',
    'QUANTITY_DOWN_ID' => $mainId . '_quant_down',
    'QUANTITY_UP_ID' => $mainId . '_quant_up',
    'QUANTITY_MEASURE' => $mainId . '_quant_measure',
    'QUANTITY_LIMIT' => $mainId . '_quant_limit',
    'BUY_LINK' => $mainId . '_buy_link',
    'ADD_BASKET_LINK' => $mainId . '_add_basket_link',
    'BASKET_ACTIONS_ID' => $mainId . '_basket_actions',
    'NOT_AVAILABLE_MESS' => $mainId . '_not_avail',
    'COMPARE_LINK' => $mainId . '_compare_link',
    'TREE_ID' => $mainId . '_skudiv',
    'DISPLAY_PROP_DIV' => $mainId . '_sku_prop',
    'DISPLAY_MAIN_PROP_DIV' => $mainId . '_main_sku_prop',
    'OFFER_GROUP' => $mainId . '_set_group_',
    'BASKET_PROP_DIV' => $mainId . '_basket_prop',
    'SUBSCRIBE_LINK' => $mainId . '_subscribe',
    'TABS_ID' => $mainId . '_tabs',
    'TAB_CONTAINERS_ID' => $mainId . '_tab_containers',
    'SMALL_CARD_PANEL_ID' => $mainId . '_small_card_panel',
    'TABS_PANEL_ID' => $mainId . '_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
    : $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
    : $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
    : $arResult['NAME'];

$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers) {
    $actualItem = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']] ?? reset($arResult['OFFERS']);
    $showSliderControls = false;

    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['MORE_PHOTO_COUNT'] > 1) {
            $showSliderControls = true;
            break;
        }
    }
} else {
    $actualItem = $arResult;
    $showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

if ($arParams['SHOW_SKU_DESCRIPTION'] === 'Y') {
    $skuDescription = false;
    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['DETAIL_TEXT'] != '' || $offer['PREVIEW_TEXT'] != '') {
            $skuDescription = true;
            break;
        }
    }
    $showDescription = $skuDescription || !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
} else {
    $showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}

$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
    'left' => 'product-item-label-left',
    'center' => 'product-item-label-center',
    'right' => 'product-item-label-right',
    'bottom' => 'product-item-label-bottom',
    'middle' => 'product-item-label-middle',
    'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
    foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
        $discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
    foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
        $labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}
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
$idProd = $arResult['ID'];
?>
    <main class="product-page">
        <div class="container">
            <div class="product-page__content">
                <div class="product-page__content__left-side">
                    <a href="/" class="catalog-link"><i class="icon icon-pagination_arrow"></i></a>
                    <div id="product-slider" class="swiper product-slider">
                        <div class="swiper-wrapper">
                            <!-- max 4 items -->


                            <!--                            <div class="slide-item swiper-slide">-->
                            <!--                                <div class="video-wrapper">-->
                            <!--                                    <a href="javascript:void(0);" class="video-link">-->
                            <!--                                        <video class="video-item" preload="1" muted="muted"-->
                            <!--                                               poster="images/main/product_page/product_image2.jpg">-->
                            <!--                                            <source src="assets/videos/1.mp4" type="video/mp4">-->
                            <!--                                        </video>-->
                            <!--                                    </a>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <?
$mainFoto="";
                            foreach ($arResult["OFFERS"][0]["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $itemFoto) {


                                $renderImageProd = CFile::ResizeImageGet($itemFoto, array("width" => 383, "height" => 578), BX_RESIZE_IMAGE_PROPORTIONAL);
                                $photoProd = $renderImageProd["src"];

                                if (empty($mainFoto)){

                                    $mainFoto=  $photoProd;

                                }

                                $photoProdGalery = CFile::GetPath($itemFoto);


                                ?>
                                <div class="slide-item swiper-slide">
                                    <a href="<?= $photoProdGalery ?>" data-link="gallery"
                                       class="gallery-link">
                                        <img src="<?= $photoProd ?>" alt="product-image"
                                             class="product-image">
                                    </a>
                                </div>
                                <?
                            }
                            ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="product-page__content__right-side">

                    <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumb-prod", array(
                        "PATH" => "",    // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                        "SITE_ID" => "s1",    // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                        "START_FROM" => "0",    // Номер пункта, начиная с которого будет построена навигационная цепочка
                    ),
                        false
                    ); ?>

                    <h1 class="product-page__title page-title"><?= $arResult["NAME"] ?></h1>
                    <div class="product-info">
                        <span class="article"><?= $arResult["PROPERTIES"]['ARTNUMBER']['VALUE'] ?></span>
                        <div class="tags-list">


                            <?

                            if (!empty($arResult["PROPERTIES"]['SALELEADER']['VALUE'])) {
                                ?>
                                <div class="tags-list__item sale">Лидер продаж</div>
                                <?
                            }
                            ?>

                            <?

                            if (!empty($arResult["PROPERTIES"]['NEWPRODUCT']['VALUE'])) {
                                ?>

                                <div class="tags-list__item new">NEW</div>

                                <?

                            }
                            ?>

                        </div>
                        <div class="product-price">
                            <div class="price-title">Цена</div>
                            <span class="price">1 199 ₽</span>
                            <span class="oldprice">1 749 ₽</span>
                        </div>
                        <div class="product-addcart">
                            <form action="javascript:void(0);" class="addcart-form">
                                <div class="input-group btn-group">
                                    <button type="submit" class="btn-fill-style addBasketCart">В корзину</button>
                                </div>
                                <div class="input-group count-group">
                                    <a href="javascript:void(0);" class="count-btn minus-btn"><i
                                                class="icon icon-count_arrow"></i></a>
                                    <input type="text" class="count-input" value="1" readonly>
                                    <a href="javascript:void(0);" class="count-btn plus-btn"><i
                                                class="icon icon-count_arrow"></i></a>
                                </div>
                                <a href="#" data-item="<?= $idProd ?>"
                                   class="favorite-link <? if (isset($favoritesAr[$idProd])) {
                                       echo "active";
                                   } ?> "><i class="icon icon-heart_fill"></i></a>
                            </form>
                        </div>
                    </div>
                    <div class="product-properties">

                        <?

                        if (!empty($arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"])) {


                            ?>
                            <div class="product-properties__item">
                            <span class="property-name">Производитель</span>
                            <span class="property-value"><?= $arResult["PROPERTIES"]['MANUFACTURER']["VALUE"] ?></span>
                            </div><?


                        }

                        ?>

                        <?

                        if (!empty($arResult["PROPERTIES"]["MATERIAL"]["VALUE"])) {


                            ?>
                            <div class="product-properties__item">
                                <span class="property-name">Материал</span>
                                <span class="property-value"><?= $arResult["PROPERTIES"]['MATERIAL']["VALUE"][0] ?></span>
                            </div>
                            <?


                        }

                        ?>
                        <?

                        if (!empty($arResult["PROPERTIES"]["CANVAS"]["VALUE"])) {


                            ?>

                            <div class="product-properties__item">
                                <span class="property-name">Холст</span>
                                <span class="property-value"><?= $arResult["PROPERTIES"]['CANVAS']["VALUE"] ?></span>
                            </div>


                            <?


                        }

                        if (!empty($arResult["PROPERTIES"]["COUNTRY"]["VALUE"])) {


                            ?>

                            <div class="product-properties__item">
                                <span class="property-name">Страна</span>
                                <span class="property-value"><?= $arResult["PROPERTIES"]['COUNTRY']["VALUE"] ?></span>
                            </div>


                            <?


                        }
                        if (!empty($arResult["PROPERTIES"]["SEASON"]["VALUE"])) {


                            ?>


                            <div class="product-properties__item">
                                <span class="property-name">Сезон</span>
                                <span class="property-value"><?= $arResult["PROPERTIES"]['SEASON']["VALUE"] ?></span>
                            </div>


                            <?


                        }
                        if (!empty($arResult["PROPERTIES"]["YEAR"]["VALUE"])) {
                            ?>
                            <div class="product-properties__item">
                                <span class="property-name">Год</span>
                                <span class="property-value"><?= $arResult["PROPERTIES"]['YEAR']["VALUE"] ?></span>
                            </div>
                            <?
                        }
                        if (!empty($arResult["PROPERTIES"]["POLOTNO"]["VALUE"])) {

                            ?>

                            <div class="product-properties__item">
                                <span class="property-name">Полотно</span>
                                <span class="property-value"><?= $arResult["PROPERTIES"]['POLOTNO']["VALUE"] ?></span>
                            </div>
                            <?
                        }

                        ?>
                        <div class="product-properties__item properties-size">
                            <div class="select-row">
                                <span class="property-name">Размер</span>
                                <div class="input-group select-group">
                                    <select name="size" class="choice-select">
                                        <option value="">Выбрать размер</option>

                                        <?

                                        foreach ($arResult["OFFERS"] as $itemOffer){

if (empty($itemOffer["PRODUCT"]["QUANTITY"])){
    //TO DO раскрыть при наладке цен.
   // continue;

}
                                            ?>


                                            <option data-price="" value="<?=$itemOffer["ID"]?>"><?=$itemOffer['PROPERTIES']['SIZES_CLOTHES']['VALUE_ENUM']?></option>


                                            <?



                                        }

                                        ?>
                                    </select>
                                    <a href="javascript:void(0);" data-micromodal-trigger="modal-sizes"
                                       class="size-info-link">Инфо о размере</a>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="product-add-link btn-fill-style">В корзину</a>
                        </div>
                        <div class="product-properties__item properties-color">
                            <span class="property-name">Цвет</span>


                            <?


                            CModule::IncludeModule('highloadblock');
                            $IDHighload = 2;
                            $hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($IDHighload)->fetch();
                            $hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
                            $hlDataClass = $hldata["NAME"] . "Table";


                            if (empty($mainColor)) {
                                $resultColor = $hlDataClass::getList(array(
                                    "select" => array("ID", "UF_NAME", "UF_XML_ID", "UF_COLORCOD"), // Поля для выборки
                                    "order" => array(),
                                    "filter" => array("UF_XML_ID" => $itemOffer['PROPERTIES']["COLOR_REF"]['VALUE']),
                                ));
                                if ($resp = $resultColor->fetch()) {
                                    $mainColor = $resp['UF_COLORCOD'];
                                    $mainColorName = $resp['UF_NAME'];
                                }
                            }
                            if (empty($mainColor)){
                                $mainColor="#8A8972";
                            }

                            ?>
                            <span class="property-value color-value"><span style="background-color: <?=$mainColor?>;"></span><?=$mainColorName?></span>
                        </div>
                        <div class="product-properties__item properties-color-slider">
                            <div id="product-colors" class="product-colors swiper">
                                <div class="swiper-wrapper">






                                    <?
                                    $articl = $arResult["PROPERTIES"]["ARTNUMBER"]["VALUE"];
                                    $maxCart = 5;
                                    $totalCart = 0;
                                    $plusColor = 0;
                                    $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL", "PROPERTY_*");
                                    $arFilter = array("IBLOCK_ID" => 2, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_ARTNUMBER" => $articl);
                                    $resProd = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
                                    while ($obProd = $resProd->GetNextElement()) {
                                        $totalCart++;
                                        if ($totalCart > $maxCart) {
                                            $plusColor++;
                                            continue;
                                        }
                                        $arFieldsProd = $obProd->GetFields();
//                                        if ($arFieldsProd["ID"] == $idSkeep) {
//                                            continue;
//                                        }
                                        $idProd = $arFieldsProd["ID"];
                                        $code = $arFieldsProd["CODE"];
                                        $url = $arFieldsProd["DETAIL_PAGE_URL"];
                                        $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PICTURE", "PROPERTY_*");
                                        $arFilter = array("IBLOCK_ID" => 3, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_CML2_LINK" => $arFieldsProd["ID"]);
                                        $resOffer = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
                                        if ($obOffer = $resOffer->GetNextElement()) {
                                            $arFieldsOffer = $obOffer->GetFields();
                                            /// print_r($arFieldsOffer);
                                            $renderImage = CFile::ResizeImageGet($arFieldsOffer["DETAIL_PICTURE"], array("width" => 90, "height" => 120), BX_RESIZE_IMAGE_PROPORTIONAL);
                                            $Photo = $renderImage["src"];
                                            $arProps = $obOffer->GetProperties();

                                            $resultColor = $hlDataClass::getList(array(
                                                "select" => array("ID", "UF_NAME", "UF_XML_ID", "UF_COLORCOD"), // Поля для выборки
                                                "order" => array(),
                                                "filter" => array("UF_XML_ID" => $arProps["COLOR_REF"]['VALUE']),
                                            ));





                                            if ($resp = $resultColor->fetch()) {
                                                $mainColor = $resp['UF_COLORCOD'];
                                                $mainColorName = $resp['UF_NAME'];
                                                $arCart[] = [
                                                    "id" => $idProd,
                                                    "code" => $code,
                                                    "img" => "$Photo",
                                                    "color" => "$mainColor",
                                                    "href" => $url,
                                                ];
                                                ?>

                                                <div class="swiper-slide slide-item">
<!--                                                    <a href="javascript:void(0);" class="slide-link -->
                                                    <a href="<?=$url?>" class="slide-link
                                                    <?

                                                    if ($idProd==$arResult["ID"]){

                                                        ?>active<?

                                                    }

                                                    ?>">
                                                        <img src="<?=$Photo?>" alt="color"
                                                             class="slide-image">
                                                        <span class="slide-title"><?=$mainColorName?></span>
                                                    </a>
                                                </div>


                                                <?


                                            }
                                        }
                                    }



                                    ?>

                                    <!--
                                <div class="swiper-slide slide-item">
                                    <a href="javascript:void(0);" class="slide-link disabled">
                                        <img src="images/main/product_page/color_image.jpg" alt="color" class="slide-image">
                                        <span class="slide-title">Черный</span>
                                    </a>
                                </div>
                                <div class="swiper-slide slide-item">
                                    <a href="javascript:void(0);" class="slide-link">
                                        <img src="images/main/product_page/color_image.jpg" alt="color" class="slide-image">
                                        <span class="slide-title">Зеленый</span>
                                    </a>
                                </div>
                                <div class="swiper-slide slide-item">
                                    <a href="javascript:void(0);" class="slide-link">
                                        <img src="images/main/product_page/color_image.jpg" alt="color" class="slide-image">
                                        <span class="slide-title">Синий</span>
                                    </a>
                                </div>
                                <div class="swiper-slide slide-item">
                                    <a href="javascript:void(0);" class="slide-link">
                                        <img src="images/main/product_page/color_image.jpg" alt="color" class="slide-image">
                                        <span class="slide-title">Серый</span>
                                    </a>
                                </div>
                                -->
                                </div>
                                <div class="swiper-navigation" style="display: none;">
                                    <div class="nav-btn btn-prev"><i class="icon icon-slider_arrow"></i></div>
                                    <div class="nav-btn btn-next"><i class="icon icon-slider_arrow"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-description">
                        <div class="descr-tab">
                            <h3 class="tab-title">Описание товара</h3>
                            <div class="tab-content">
                                <p>

                                    <?=$arResult["DETAIL_TEXT"]?>

                                </p>
                            </div>
                        </div>
                        <div class="descr-tab">
                            <h3 class="tab-title">Таблица размеров</h3>
                            <div class="tab-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aperiam aspernatur autem
                                    delectus deserunt doloremque doloribus, eius facilis fugiat hic ipsa magnam maiores
                                    molestias mollitia obcaecati reprehenderit tempora tenetur vero!</span><span>Distinctio doloremque esse, illo ipsa iste magnam, nostrum odit quam ratione saepe tempora tempore voluptas. Error esse in iusto molestiae natus officiis optio, quae quidem quo quos rem, repellendus voluptas.</span><span>Debitis, eaque error inventore ipsum iste natus neque nesciunt quis sed unde. Ducimus exercitationem hic impedit ipsam provident quod rem reprehenderit unde. Aperiam architecto consequuntur error reiciendis unde? Aspernatur, ea.</span><span>Aliquid autem commodi consequatur cupiditate dolorem eum numquam. Amet corporis debitis eligendi impedit molestiae officiis, suscipit. Ad eligendi esse incidunt laboriosam molestiae natus nisi omnis, quaerat quos tempore tenetur, ut.</span><span>Amet aspernatur consectetur consequuntur culpa dignissimos, dolore ea eaque esse harum hic magnam magni maxime molestias mollitia nostrum optio pariatur praesentium, quos reprehenderit tempora vel voluptas voluptate. Impedit odio, voluptas?</span><span>Asperiores aspernatur atque exercitationem fugit ipsam iusto nulla quasi recusandae, repellendus repudiandae sunt velit veniam voluptate. Accusamus deleniti modi placeat quo recusandae. Consequatur, corporis et impedit optio quisquam ratione vel!</span><span>Eos in pariatur ratione similique voluptas. Dolore incidunt maxime officiis placeat! Aliquam consectetur cupiditate deserunt dolorem eaque error fugit id iure laboriosam minus nobis perferendis possimus ratione repudiandae, unde. Laboriosam.</span><span>A commodi fugit harum hic nostrum perferendis quia? Aliquid aut deserunt eveniet explicabo id illo, perspiciatis recusandae repudiandae sed. Dolorem illo illum ipsam iste necessitatibus obcaecati quia rem similique voluptatibus.</span><span>Aut beatae cum delectus deleniti dignissimos ducimus facere impedit in itaque maiores nihil nobis nulla odit omnis optio pariatur perspiciatis quidem sequi similique vel vitae voluptas, voluptatem! Architecto, necessitatibus, tempora.</span><span>Ad, adipisci aliquid assumenda atque aut blanditiis consequatur culpa cumque debitis eaque, esse expedita fugiat ipsa minima, nihil numquam obcaecati perspiciatis quia quis quisquam reprehenderit velit veritatis voluptate. Tempore, veniam.
                                </p>
                            </div>
                        </div>
                        <div class="descr-tab">
                            <h3 class="tab-title">Параметры модели</h3>
                            <div class="tab-content">
                                <p>

                                    <?=$arResult["PROPERTIES"]["PARAM_MODEL"]["~VALUE"]['TEXT']?>

                                </p>
                            </div>
                        </div>
                        <div class="descr-tab">
                            <h3 class="tab-title">Материал и уход</h3>
                            <div class="tab-content">
                                <p>  <?=$arResult["PROPERTIES"]["UHOD"]["~VALUE"]['TEXT']?>
                                </p>
                            </div>
                        </div>
                        <div class="descr-tab active">
                            <h3 class="tab-title">Условия доставки</h3>
                            <div class="tab-content">
                                <p>Бесплатная доставка при заказе от 3 000 руб.</p>
                                <p>Вы можете выбрать подходящий для вас способ доставки товара:</p>
                                <div class="delivery-info">
                                    <div class="delivery-info__item">
                                        <div class="icon-block">
                                            <img src="<?=DEFAULT_TEMPLATE_PATH?>/images/main/svg/delivery_icon1.svg" alt="icon"
                                                 class="delivery-icon">
                                        </div>
                                        <div class="descr-block">
                                            <p>Курьерская доставка.</p>
                                            <p>Срок — от 1 дня.</p>
                                        </div>
                                    </div>
                                    <div class="delivery-info__item">
                                        <div class="icon-block">
                                            <img src="<?=DEFAULT_TEMPLATE_PATH?>/images/main/svg/delivery_icon2.svg" alt="icon"
                                                 class="delivery-icon">
                                        </div>
                                        <div class="descr-block">
                                            <p>Пункты выдачи заказов и постаматы.</p>
                                            <p>Срок — от 1 дня.</p>
                                        </div>
                                    </div>
                                    <div class="delivery-info__item">
                                        <div class="icon-block">
                                            <img src="<?=DEFAULT_TEMPLATE_PATH?>/images/main/svg/delivery_icon3.svg" alt="icon"
                                                 class="delivery-icon">
                                        </div>
                                        <div class="descr-block">
                                            <p>Самовывозом из магазина.</p>
                                            <p>Срок — от 1 дня.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?

if (!empty($arResult["PROPERTIES"]["OBRAZ"]["VALUE"])){

?>
    <section class="product-complete">
        <div class="container">
            <h2 class="product-complete__title section-title">Завершите образ</h2>
            <div class="product-complete__content">
                <div class="product-complete__content__left-side" style="display: none;">
                    <img src="<?=$mainFoto?>" alt="complete" class="main-image">
                </div>
                <div class="product-complete__content__right-side">
                    <div id="complete-slider" class="complete-list swiper">









                     <?
                     foreach ($arResult["PROPERTIES"]["OBRAZ"]["VALUE"] as $itemObraz){

                     ?>

                        <div class="swiper-wrapper">

                         <?

                            $mainColor = "";
                    $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL", "PROPERTY_*");
                    $arFilter = array("IBLOCK_ID" => 2, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "ID" => $itemObraz);
                    $resProdblock = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
                    if ($obProdMain = $resProdblock->GetNextElement()) {
                        $arCart = [];
                        $item = $obProdMain->GetFields();
                        $itemProp = $obProdMain->GetProperties();

                        $productTitle = $item["NAME"];
                        $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PICTURE", "PROPERTY_*");
                        $arFilter = array("IBLOCK_ID" => 3, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_CML2_LINK" => $item["ID"]);
                        $resOfferMain = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
                        if ($obOfferMain = $resOfferMain->GetNextElement()) {

                            $arFieldsOfferMain = $obOfferMain->GetFields();

                            $allProductPrices = \Bitrix\Catalog\PriceTable::getList([
                                "select" => ["*"],
                                "filter" => [
                                    "=PRODUCT_ID" => $arFieldsOfferMain["ID"],
                                ],
                                "order" => ["CATALOG_GROUP_ID" => "ASC"]
                            ])->fetchAll();
                            $salePrice = "";
                            $retailPrice = "";
                            foreach ($allProductPrices as $itemPrice) {
                                if ($itemPrice['CATALOG_GROUP_ID'] == 1)
                                    $salePrice = round($itemPrice['PRICE']);
                                if ($itemPrice['CATALOG_GROUP_ID'] == 2)
                                    $retailPrice = round($itemPrice['PRICE']);
                            }
                            $renderImage = CFile::ResizeImageGet($arFieldsOfferMain["DETAIL_PICTURE"], array("width" => 92, "height" => 129), BX_RESIZE_IMAGE_PROPORTIONAL);
                            $Photo = $renderImage["src"];

                            $arPropsOfferMain = $obOfferMain->GetProperties();

                            $resultColor = $hlDataClass::getList(array(
                                "select" => array("ID", "UF_NAME", "UF_XML_ID", "UF_COLORCOD"), // Поля для выборки
                                "order" => array(),
                                "filter" => array("UF_XML_ID" => $arPropsOfferMain["COLOR_REF"]['VALUE']),
                            ));

                            if ($resp = $resultColor->fetch()) {
                                $mainColor = $resp['UF_COLORCOD'];
                            }
                        }

                        $idSkeep = $item["ID"];
                        $arCart[] = [
                            "id" => $item["ID"],
                            "code" => $item["CODE"],
                            "img" => "$Photo",
                            "sale" => $salePrice,
                            "retail" => $retailPrice,
                            "color" => "$mainColor",
                            "href" => $item['DETAIL_PAGE_URL'],
                        ];

                        $articl = $itemProp["ARTNUMBER"]["VALUE"];
                        $maxCart = 5;
                        $totalCart = 0;
                        $plusColor = 0;
                        $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL", "PROPERTY_*");
                        $arFilter = array("IBLOCK_ID" => 2, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_ARTNUMBER" => $articl);
                        $resProd = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
                        while ($obProd = $resProd->GetNextElement()) {
                            $totalCart++;
                            if ($totalCart > $maxCart) {
                                $plusColor++;
                                continue;
                            }
                            $arFieldsProd = $obProd->GetFields();
                            if ($arFieldsProd["ID"] == $idSkeep) {
                                continue;
                            }
                            $idProd = $arFieldsProd["ID"];
                            $code = $arFieldsProd["CODE"];
                            $url = $arFieldsProd["DETAIL_PAGE_URL"];
                            $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PICTURE", "PROPERTY_*");
                            $arFilter = array("IBLOCK_ID" => 3, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_CML2_LINK" => $arFieldsProd["ID"]);
                            $resOffer = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
                            if ($obOffer = $resOffer->GetNextElement()) {
                                $arFieldsOffer = $obOffer->GetFields();
                                /// print_r($arFieldsOffer);
                                $renderImage = CFile::ResizeImageGet($arFieldsOffer["DETAIL_PICTURE"], array("width" => 92, "height" => 129), BX_RESIZE_IMAGE_PROPORTIONAL);
                                $Photo = $renderImage["src"];
                                $arProps = $obOffer->GetProperties();

                                $resultColor = $hlDataClass::getList(array(
                                    "select" => array("ID", "UF_NAME", "UF_XML_ID", "UF_COLORCOD"), // Поля для выборки
                                    "order" => array(),
                                    "filter" => array("UF_XML_ID" => $arProps["COLOR_REF"]['VALUE']),
                                ));


                                $allProductPrices = \Bitrix\Catalog\PriceTable::getList([
                                    "select" => ["*"],
                                    "filter" => [
                                        "=PRODUCT_ID" => $arFieldsOffer["ID"],
                                    ],
                                    "order" => ["CATALOG_GROUP_ID" => "ASC"]
                                ])->fetchAll();
                                $salePrice = "";
                                $retailPrice = "";
                                foreach ($allProductPrices as $itemPrice) {
                                    if ($itemPrice['CATALOG_GROUP_ID'] == 1)
                                        $salePrice = round($itemPrice['PRICE']);
                                    if ($itemPrice['CATALOG_GROUP_ID'] == 2)
                                        $retailPrice = round($itemPrice['PRICE']);
                                }


                                if ($resp = $resultColor->fetch()) {
                                    $mainColor = $resp['UF_COLORCOD'];

                                    $arCart[] = [
                                        "id" => $idProd,
                                        "code" => $code,
                                        "img" => "$Photo",
                                        "sale" => $salePrice,
                                        "retail" => $retailPrice,
                                        "color" => "$mainColor",
                                        "href" => $url,
                                    ];


                                }
                            }
                        }
                        ?>

                            <div class="swiper-wrapper">
                                <div class="complete-list__item swiper-slide colors-item slide-item">
                                    <div class="image-block">
                                        <div class="colors-slider swiper">
                                            <div class="swiper-wrapper">
                                                <?
                                                foreach ($arCart as $itemCart) {
                                                    ?>
                                                    <a data-idProd="<?= $itemCart['id'] ?>" data-sale="<?= $itemCart['sale'] ?>"
                                                       data-retail="<?= $itemCart['retail'] ?>" href="<?= $itemCart['href'] ?>"
                                                       class="product-link swiper-slide chengeColor"
                                                       data-color="<?
                                                       if (empty($itemCart['color'])) {
                                                           echo "#bdbdbd";
                                                       } else {
                                                           echo $itemCart['color'];
                                                       }
                                                       ?>">
                                                        <img src="<?= $itemCart['img'] ?>" alt="product"
                                                             class="product-image">
                                                    </a>
                                                    <?
                                                }
                                                ?>
<!--                                                <a href="#" class="product-link swiper-slide" data-color="#AEB9A9">-->
<!--                                                    <img src="images/main/main_page/catalogs/product_image31.jpg" alt="product" class="product-image">-->
<!--                                                </a>-->

                                            </div>
                                            <div class="colors-navigation">
                                                <div class="colors-btn color-prev"><i class="icon icon-slider_arrow"></i></div>
                                                <div class="colors-btn color-next"><i class="icon icon-slider_arrow"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="descr-block">
                                        <div class="info-block">
                                            <a href="#" class="product-name"><?=$productTitle?></a>
                                            <span class="article"><?=$articl?></span>
                                            <div class="product-colors">
                                                <div class="colors-pagination"></div>
                                                <span class="product-colors__all"><?
                                                    if (!empty($plusColor)) {
                                                        ?>
                                                        + <?
                                                            echo num_word($plusColor, ["Цвет", "Цвета", "Цветов"]);
                                                            ?>
                                                        <?
                                                    }
                                                    ?></span>
                                            </div>
                                        </div>
                                        <div class="size-block">
<!--                                            <select name="size-select" class="choice-select">-->
<!--                                                <option value="Размер">Размер</option>-->
<!--                                                <option value="Размер">Размер2</option>-->
<!--                                                <option value="Размер">Размер3</option>-->
<!--                                            </select>-->
                                        </div>
                                        <div class="price-block">
                                            <span class="price-title">Цена</span>
                                            <span class="oldprice"><?
                                                if (!empty($retailPrice)) {
                                                    echo "$retailPrice ₽";
                                                }
                                                ?></span>
                                            <span class="price"><?
                                                if (!empty($salePrice)) {

                                                    echo "$salePrice ₽";

                                                }
                                                ?></span>
                                        </div>
                                        <div class="btn-block">
                                            <a style="cursor: pointer;" data-idProd="<?= $item["ID"] ?>"
                                               onclick="window._$productModal.showProductById('<?= $item["ID"] ?>');" class="addcart-link btn-fill-style">Подробнее</a>
                                        </div>
                                    </div>
                                </div>

                        <?
                    }
                         ?></div></div><?
                     }
                          ?>

                        <div class="swiper-navigation">
                            <div class="nav-btn btn-prev"><i class="icon icon-slider_arrow"></i></div>
                            <div class="nav-btn btn-next"><i class="icon icon-slider_arrow"></i></div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<? }

if (!empty($arResult["PROPERTIES"]["DOP_PROD"]["VALUE"])){

?>
    <section class="recently-products product-similar">
        <div class="container">
            <h2 class="recently-products__title section-title">Похожие товары</h2>
            <div class="recently-products__content">
                <div class="recently-slider swiper">
                    <div class="swiper-wrapper">
                        <!-- if colors-slider -->




                        <?

                        foreach ($arResult["PROPERTIES"]["DOP_PROD"]["VALUE"] as $itemPoh){

                        ?>




                        <?


                        $mainColor = "";
                        $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL", "PROPERTY_*");
                        $arFilter = array("IBLOCK_ID" => 2, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "ID" => $itemPoh);
                        $resProdblock = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
                        if ($obProdMain = $resProdblock->GetNextElement()) {
                            $arCart = [];
                            $item = $obProdMain->GetFields();
                            $itemProp = $obProdMain->GetProperties();

                            $productTitle = $item["NAME"];
                            $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PICTURE", "PROPERTY_*");
                            $arFilter = array("IBLOCK_ID" => 3, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_CML2_LINK" => $item["ID"]);
                            $resOfferMain = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
                            if ($obOfferMain = $resOfferMain->GetNextElement()) {

                                $arFieldsOfferMain = $obOfferMain->GetFields();
                                //  print_r($arFieldsOfferMain);
                                //  $foto=CFile::GetPath($arFieldsOfferMain["DETAIL_PICTURE"]);
                                // var_dump($foto);

                                $allProductPrices = \Bitrix\Catalog\PriceTable::getList([
                                    "select" => ["*"],
                                    "filter" => [
                                        "=PRODUCT_ID" => $arFieldsOfferMain["ID"],
                                    ],
                                    "order" => ["CATALOG_GROUP_ID" => "ASC"]
                                ])->fetchAll();
                                $salePrice = "";
                                $retailPrice = "";
                                foreach ($allProductPrices as $itemPrice) {
                                    if ($itemPrice['CATALOG_GROUP_ID'] == 1)
                                        $salePrice = round($itemPrice['PRICE']);
                                    if ($itemPrice['CATALOG_GROUP_ID'] == 2)
                                        $retailPrice = round($itemPrice['PRICE']);
                                }
                                $renderImage = CFile::ResizeImageGet($arFieldsOfferMain["DETAIL_PICTURE"], array("width" => 372, "height" => 600), BX_RESIZE_IMAGE_PROPORTIONAL);
                                $Photo = $renderImage["src"];

                                $arPropsOfferMain = $obOfferMain->GetProperties();

                                $resultColor = $hlDataClass::getList(array(
                                    "select" => array("ID", "UF_NAME", "UF_XML_ID", "UF_COLORCOD"), // Поля для выборки
                                    "order" => array(),
                                    "filter" => array("UF_XML_ID" => $arPropsOfferMain["COLOR_REF"]['VALUE']),
                                ));

                                if ($resp = $resultColor->fetch()) {
                                    $mainColor = $resp['UF_COLORCOD'];
                                }
                            }

                            $idSkeep = $item["ID"];
                            $arCart[] = [
                                "id" => $item["ID"],
                                "code" => $item["CODE"],
                                "img" => "$Photo",
                                "sale" => $salePrice,
                                "retail" => $retailPrice,
                                "color" => "$mainColor",
                                "href" => $item['DETAIL_PAGE_URL'],
                            ];

                            $articl = $itemProp["ARTNUMBER"]["VALUE"];
                            $maxCart = 5;
                            $totalCart = 0;
                            $plusColor = 0;
                            $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL", "PROPERTY_*");
                            $arFilter = array("IBLOCK_ID" => 2, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_ARTNUMBER" => $articl);
                            $resProd = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
                            while ($obProd = $resProd->GetNextElement()) {
                                $totalCart++;
                                if ($totalCart > $maxCart) {
                                    $plusColor++;
                                    continue;
                                }
                                $arFieldsProd = $obProd->GetFields();
                                if ($arFieldsProd["ID"] == $idSkeep) {
                                    continue;
                                }
                                $idProd = $arFieldsProd["ID"];
                                $code = $arFieldsProd["CODE"];
                                $url = $arFieldsProd["DETAIL_PAGE_URL"];
                                $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PICTURE", "PROPERTY_*");
                                $arFilter = array("IBLOCK_ID" => 3, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_CML2_LINK" => $arFieldsProd["ID"]);
                                $resOffer = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
                                if ($obOffer = $resOffer->GetNextElement()) {
                                    $arFieldsOffer = $obOffer->GetFields();
                                    /// print_r($arFieldsOffer);
                                    $renderImage = CFile::ResizeImageGet($arFieldsOffer["DETAIL_PICTURE"], array("width" => 372, "height" => 600), BX_RESIZE_IMAGE_PROPORTIONAL);
                                    $Photo = $renderImage["src"];
                                    $arProps = $obOffer->GetProperties();

                                    $resultColor = $hlDataClass::getList(array(
                                        "select" => array("ID", "UF_NAME", "UF_XML_ID", "UF_COLORCOD"), // Поля для выборки
                                        "order" => array(),
                                        "filter" => array("UF_XML_ID" => $arProps["COLOR_REF"]['VALUE']),
                                    ));


                                    $allProductPrices = \Bitrix\Catalog\PriceTable::getList([
                                        "select" => ["*"],
                                        "filter" => [
                                            "=PRODUCT_ID" => $arFieldsOffer["ID"],
                                        ],
                                        "order" => ["CATALOG_GROUP_ID" => "ASC"]
                                    ])->fetchAll();
                                    $salePrice = "";
                                    $retailPrice = "";
                                    foreach ($allProductPrices as $itemPrice) {
                                        if ($itemPrice['CATALOG_GROUP_ID'] == 1)
                                            $salePrice = round($itemPrice['PRICE']);
                                        if ($itemPrice['CATALOG_GROUP_ID'] == 2)
                                            $retailPrice = round($itemPrice['PRICE']);
                                    }


                                    if ($resp = $resultColor->fetch()) {
                                        $mainColor = $resp['UF_COLORCOD'];

                                        $arCart[] = [
                                            "id" => $idProd,
                                            "code" => $code,
                                            "img" => "$Photo",
                                            "sale" => $salePrice,
                                            "retail" => $retailPrice,
                                            "color" => "$mainColor",
                                            "href" => $url,
                                        ];


                                    }
                                }
                            }
                            ?>
                            <div class="slide-item swiper-slide colors-item">
                                <div class="image-block">
                                    <div class="product-tags">
                                        <?

                                        if ($item['PROPERTIES']['SPECIALOFFER']['VALUE'] == "да") {

                                            ?>
                                            <div class="product-tags__item sale-item">Спец пред.!</div>
                                            <?
                                        }
                                        if ($item['PROPERTIES']['NEWPRODUCT']['VALUE'] == "да") {
                                            ?>
                                            <div class="product-tags__item new-item">New</div>
                                            <?
                                        }
                                        ?>
                                    </div>
                                    <div class="colors-slider swiper">
                                        <div class="swiper-wrapper">

                                            <?
                                            foreach ($arCart as $itemCart) {
                                                ?>
                                                <a data-idProd="<?= $itemCart['id'] ?>" data-sale="<?= $itemCart['sale'] ?>"
                                                   data-retail="<?= $itemCart['retail'] ?>" href="<?= $itemCart['href'] ?>"
                                                   class="product-link swiper-slide chengeColor"
                                                   data-color="<?
                                                   if (empty($itemCart['color'])) {
                                                       echo "#bdbdbd";
                                                   } else {
                                                       echo $itemCart['color'];
                                                   }
                                                   ?>">
                                                    <img src="<?= $itemCart['img'] ?>" alt="<?= $itemCart['code'] ?>"
                                                         class="product-image">
                                                </a>
                                                <?
                                            }
                                            ?>
                                        </div>
                                        <div class="colors-navigation">
                                            <div class="colors-btn color-prev"><i class="icon icon-slider_arrow"></i></div>
                                            <div class="colors-btn color-next"><i class="icon icon-slider_arrow"></i></div>
                                        </div>
                                    </div>
                                    <div class="product-btns">
                                        <a style="cursor: pointer; z-index: 99999;" data-item="<?= $item['ID'] ?>"
                                           class="product-btn favorite-link <?

                                           if (isset($favoritesAr[$item['ID']])) {
                                               echo "active";
                                           }

                                           ?>"><i class="icon icon-heart"></i></a>
                                        <a style="cursor: pointer;" data-idProd="<?= $item["ID"] ?>"
                                           onclick="window._$productModal.showProductById('<?= $item["ID"] ?>');"
                                           class="product-btn addcart-link"><i
                                                    class="icon icon-cart"></i><span>Подробнее</span></a>
                                    </div>
                                </div>
                                <div class="descr-block">
                                    <a href="#" class="product-name"><?= $productTitle ?></a>
                                    <span class="product-price">
                                <span class="oldprice"><?


                                    if (!empty($retailPrice)) {

                                        echo "$retailPrice ₽";

                                    }

                                    ?></span>
                            <span class="price"><?


                                if (!empty($salePrice)) {

                                    echo "$salePrice ₽";

                                }


                                ?></span>
                            </span>
                                    <div class="product-colors">
                                        <div class="colors-pagination"></div>
                                        <span class="product-colors__all"><?
                                            if (!empty($plusColor)) {
                                                ?>
                                                <span class="product-colors__all">+ <?
                                                    echo num_word($plusColor, ["Цвет", "Цвета", "Цветов"]);
                                                    ?></span>
                                                <?
                                            }
                                            ?></span>
                                    </div>
                                </div>
                            </div>

                            <?
                        }
                        }
                        ?>
                        <!-- end colors-slider -->
                    </div>
                    <div class="swiper-navigation">
                        <div class="nav-btn btn-prev"><i class="icon icon-slider_arrow"></i></div>
                        <div class="nav-btn btn-next"><i class="icon icon-slider_arrow"></i></div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
<?}?>



    <script>

        $(".addBasketCart").click(function () {

            let idProd = $(".choices__input").val();
            let ammo= $(".addcart-form .count-group .count-input").val();
            if (idProd==""){
                $(".choices__inner").css("border-color","red");
            }
            else {
                $(".choices__inner").css("border-color","#e9e9e9");
                let basketValue=Number($(".cart-value").text());
                $(".cart-value").text(basketValue+Number(ammo))
                $.ajax({
                    url: '/addbasket.php',
                    type: 'POST',
                    data: {prod: idProd,quantity:ammo},
                    success: (res) => {
                        console.log(res);
                    }
                })
            }
        })



    </script>
<!--    <pre>--><?//
//        print_r($arResult);
//        print_r($arParams);
//        ?><!--</pre>-->

<?php
unset($actualItem, $itemIds, $jsParams);
