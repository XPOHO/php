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
$idProd=$arResult['ID'];
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

                            foreach ($arResult["OFFERS"][0]["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $itemFoto){



                                $renderImageProd = CFile::ResizeImageGet($itemFoto, array("width" => 383, "height" => 578), BX_RESIZE_IMAGE_PROPORTIONAL);
                                $photoProd = $renderImageProd["src"];


                                $photoProdGalery = CFile::GetPath($itemFoto);


                                ?>
                                <div class="slide-item swiper-slide">
                                    <a href="<?=$photoProdGalery?>" data-link="gallery"
                                       class="gallery-link">
                                        <img src="<?=$photoProd?>" alt="product-image"
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

                    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumb-prod", Array(
                        "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
                        "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
                        "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
                    ),
                        false
                    );?>

                    <h1 class="product-page__title page-title"><?=$arResult["NAME"]?></h1>
                    <div class="product-info">
                        <span class="article"><?=$arResult["PROPERTIES"]['ARTNUMBER']['VALUE']?></span>
                        <div class="tags-list">


                            <?

                            if(!empty($arResult["PROPERTIES"]['SALELEADER']['VALUE'])){
                                ?>
                                <div class="tags-list__item sale">Лидер продаж</div>
                                <?
                            }
                            ?>

                            <?

                            if(!empty($arResult["PROPERTIES"]['NEWPRODUCT']['VALUE'])){
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
                                <a href="#"  data-item="<?=$idProd?>" class="favorite-link <? if (isset($favoritesAr[$idProd])){echo "active";}  ?> "><i class="icon icon-heart_fill"></i></a>
                            </form>
                        </div>
                    </div>
                    <div class="product-properties">

                        <?

                        if (!empty($arResult["PROPERTIES"]["MANUFACTURER"]["VALUE"])){


                            ?><div class="product-properties__item">
                            <span class="property-name">Производитель</span>
                            <span class="property-value"><?=$arResult["PROPERTIES"]['MANUFACTURER']["VALUE"]?></span>
                            </div><?


                        }

                        ?>

                        <?

                        if (!empty($arResult["PROPERTIES"]["MATERIAL"]["VALUE"])){


                            ?> <div class="product-properties__item">
                                <span class="property-name">Материал</span>
                                <span class="property-value"><?=$arResult["PROPERTIES"]['MATERIAL']["VALUE"][0]?></span> </div>
                            <?


                        }

                        ?>
                           <?

                        if (!empty($arResult["PROPERTIES"]["M"]["VALUE"])){


                            ?><?


                        }

                           if (!empty($arResult["PROPERTIES"]["M"]["VALUE"])){


                               ?><?


                           }

                        ?>

                        <div class="product-properties__item">
                            <span class="property-name">Стиль</span>
                            <span class="property-value">Платье</span>
                        </div>
                        <div class="product-properties__item">
                            <span class="property-name">Состав</span>
                            <span class="property-value">Шерсть</span>
                        </div>
                        <div class="product-properties__item properties-size">
                            <div class="select-row">
                                <span class="property-name">Размер</span>
                                <div class="input-group select-group">
                                    <select name="size" class="choice-select">
                                        <option value="1">Выбрать размер</option>
                                        <option value="1">Выбрать размер</option>
                                        <option value="1">Выбрать размер</option>
                                    </select>
                                    <a href="javascript:void(0);" data-micromodal-trigger="modal-sizes"
                                       class="size-info-link">Инфо о размере</a>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="product-add-link btn-fill-style">В корзину</a>
                        </div>
                        <div class="product-properties__item properties-color">
                            <span class="property-name">Цвет</span>
                            <span class="property-value color-value"><span style="background-color: #fff;"></span>Белый</span>
                        </div>
                        <div class="product-properties__item properties-color-slider">
                            <div id="product-colors" class="product-colors swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide slide-item">
                                        <a href="javascript:void(0);" class="slide-link">
                                            <img src="images/main/product_page/color_image.jpg" alt="color"
                                                 class="slide-image">
                                            <span class="slide-title">Белый</span>
                                        </a>
                                    </div>
                                    <div class="swiper-slide slide-item">
                                        <a href="javascript:void(0);" class="slide-link active">
                                            <img src="images/main/product_page/color_image.jpg" alt="color"
                                                 class="slide-image">
                                            <span class="slide-title">Розовый</span>
                                        </a>
                                    </div>
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
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad asperiores consectetur
                                    corporis deleniti dolorem doloremque enim est, et eveniet exercitationem facere
                                    labore laboriosam libero optio placeat ratione repellat repudiandae sequi!</span>
                                    <span>Aliquam asperiores cumque distinctio excepturi fugit ipsum molestias quidem voluptate. Alias, cupiditate ex facere itaque iure maiores sed similique voluptatem? Delectus ea exercitationem mollitia nostrum saepe. A blanditiis facilis molestiae!</span><span>Aspernatur consectetur maiores, placeat quam quibusdam ratione. Aperiam at consectetur dolor eaque eius, est fuga fugiat iusto neque numquam obcaecati provident quasi repudiandae sapiente soluta tempora totam velit veritatis voluptas.</span><span>Delectus deserunt earum exercitationem illum magni neque reiciendis sint voluptas. Aperiam assumenda autem ducimus eos et ex explicabo iste itaque necessitatibus neque nulla quaerat, quas quia, rerum sequi veritatis voluptatum?</span><span>Aliquam aliquid animi autem blanditiis consequatur deleniti dignissimos eos est et excepturi hic illum labore laboriosam laudantium, magnam mollitia nemo neque perferendis quis similique suscipit totam voluptate. Consequuntur, dolorum odit?</span><span>Beatae corporis deleniti eligendi excepturi, praesentium quae quibusdam quidem sapiente. Ab accusamus ad amet dolorum, esse et, fugiat labore molestias nostrum omnis qui quia quidem reiciendis rerum sed suscipit voluptas!</span><span>A amet animi delectus et exercitationem illum nam neque nobis nulla optio qui quia, quis quisquam repellat sunt veniam voluptatibus voluptatum. Aspernatur cum id provident ratione, sequi tempora ut voluptatum?</span><span>Accusamus animi aut blanditiis eaque explicabo fuga, fugiat ipsam labore laborum libero modi perspiciatis provident quis quos rem reprehenderit sint voluptas voluptates voluptatibus voluptatum. Doloremque ex labore molestiae possimus quos?</span><span>Incidunt molestias quae quas voluptas? Et fugiat ipsa necessitatibus porro reiciendis sint veniam veritatis! Accusantium alias asperiores blanditiis consequatur eos optio reprehenderit, rerum voluptates! Cupiditate dolorem similique tenetur! Libero, vero.</span><span>At eveniet itaque, libero nihil non numquam placeat quaerat, quis reiciendis, ut vitae voluptas? Accusantium aliquam at aut deserunt, dolorem excepturi nostrum nulla numquam perferendis, possimus temporibus totam voluptas voluptate?
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
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto culpa eos esse
                                    et exercitationem, in, ipsam ipsum iste magnam molestiae nihil qui quo recusandae
                                    repellat tempore tenetur voluptate. Aliquam, pariatur.</span><span>Blanditiis consequuntur corporis doloremque dolores est ex exercitationem fugiat fugit id impedit incidunt iure nisi nobis nostrum optio placeat quaerat, quidem ratione rem repellat repellendus tenetur voluptas voluptates voluptatibus, voluptatum!</span><span>Aliquam aliquid animi atque consectetur deleniti dicta dignissimos distinctio eius impedit inventore ipsa ipsum laudantium minus natus, nostrum odit provident quibusdam quisquam sed similique sit tempore temporibus ullam, veritatis voluptatum!</span><span>Accusamus ad commodi consectetur consequuntur cum debitis, deleniti doloribus eius enim esse exercitationem iste nam non nostrum nulla obcaecati, possimus praesentium reiciendis repellat sed sint soluta veritatis voluptatem. Mollitia, reprehenderit.</span><span>Accusamus ad culpa cupiditate dignissimos dolores, facere id nemo non quibusdam quo, reprehenderit rerum sapiente sunt. Beatae cumque error ipsum, natus nesciunt, nihil odit praesentium quod, reiciendis repellendus saepe suscipit!</span><span>Earum eum magni maiores quis reprehenderit! Atque commodi, dicta illum ipsam porro quae quas quidem repellat suscipit. Blanditiis eligendi esse et minima necessitatibus quibusdam reprehenderit soluta vitae? Accusamus, iure, non.</span><span>Atque consequuntur delectus deserunt dolore doloribus enim facere harum minus molestias, mollitia nisi omnis optio quidem quo repellat similique sint sit unde vero voluptate! Enim eveniet expedita maiores natus suscipit.</span><span>Cupiditate dolor nemo similique. Ad aspernatur assumenda consequuntur cumque dicta dignissimos dolore doloremque earum, excepturi ipsum laborum magni maiores minima nulla optio qui quia recusandae ullam. Animi assumenda consequuntur iste!</span><span>Deserunt earum illum labore magnam molestias temporibus ut vel vero voluptatum. Amet consectetur corporis dolor, dolorum eum exercitationem ipsam labore magnam magni maxime molestiae perspiciatis placeat reprehenderit veritatis vitae voluptas.</span><span>Alias aliquid consectetur consequatur cum delectus dignissimos distinctio ex facere illum, minus modi molestiae nobis numquam quo, reprehenderit repudiandae sequi veritatis? Consectetur consequatur culpa earum eligendi enim id quis voluptates?
                                </p>
                            </div>
                        </div>
                        <div class="descr-tab">
                            <h3 class="tab-title">Материал и уход</h3>
                            <div class="tab-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque blanditiis eum
                                    quaerat sequi sit tenetur veritatis, voluptate. Accusamus commodi, eos iste itaque
                                    magnam nisi provident repellendus repudiandae sit! Et, perspiciatis!</span><span>Aperiam deserunt dolorum eligendi impedit ipsam libero maiores minus nesciunt, obcaecati optio quae quos ratione, repudiandae sit voluptas. Architecto delectus dolor doloribus et id itaque magnam necessitatibus quam reiciendis temporibus.</span><span>Aliquam asperiores aut cum cupiditate dolorum eos error illo ipsum, iste, quaerat recusandae rerum soluta voluptas? Ad aperiam facilis fugiat incidunt iusto laboriosam minima omnis, quam quia, quis rem voluptatem!</span><span>Accusamus asperiores consequuntur cumque dicta dolorem, esse et exercitationem fuga id ipsum neque nobis nulla numquam officiis optio pariatur perspiciatis, porro quae qui, quo repellendus temporibus ullam voluptate! Ipsum, voluptatem!</span><span>Accusamus distinctio harum hic, molestiae odit temporibus voluptates? Asperiores atque aut consequuntur eaque molestiae nam, natus nemo neque praesentium quae quam quo reiciendis reprehenderit sunt suscipit, ullam vero vitae voluptatum?</span><span>Blanditiis dolorum ducimus ipsum laudantium libero obcaecati perferendis provident ratione, repudiandae sapiente, soluta veniam. Asperiores blanditiis, cumque cupiditate doloremque earum, eius eum neque nobis nulla placeat, quaerat sed ut vero?</span><span>Amet corporis cupiditate eum repellendus ullam. Aspernatur et non omnis sit temporibus ut vero! Consectetur cumque illo incidunt iste labore neque nisi non perspiciatis quas, ratione similique temporibus ut voluptas?</span><span>Accusamus adipisci assumenda at consequatur, corporis dolor doloribus eius in ipsam iure laboriosam libero non numquam perferendis perspiciatis reiciendis veniam voluptatem? Aliquam cupiditate dignissimos et quam quidem quo ratione voluptatem.</span><span>Ducimus fuga molestiae natus quisquam sapiente. Amet atque autem cupiditate dolorem, fugit minima tempore velit voluptates. Ad at dicta fuga iure molestiae optio possimus rem rerum sint ullam. Excepturi, perspiciatis!</span><span>Alias dolores ea eius ipsa laboriosam nobis officiis, quidem repellat tempora totam. Cum cumque delectus exercitationem id illum, ipsum laudantium, modi necessitatibus nobis pariatur recusandae repellat sapiente tempora totam voluptatibus.
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
                                            <img src="images/main/svg/delivery_icon1.svg" alt="icon"
                                                 class="delivery-icon">
                                        </div>
                                        <div class="descr-block">
                                            <p>Курьерская доставка.</p>
                                            <p>Срок — от 1 дня.</p>
                                        </div>
                                    </div>
                                    <div class="delivery-info__item">
                                        <div class="icon-block">
                                            <img src="images/main/svg/delivery_icon2.svg" alt="icon"
                                                 class="delivery-icon">
                                        </div>
                                        <div class="descr-block">
                                            <p>Пункты выдачи заказов и постаматы.</p>
                                            <p>Срок — от 1 дня.</p>
                                        </div>
                                    </div>
                                    <div class="delivery-info__item">
                                        <div class="icon-block">
                                            <img src="images/main/svg/delivery_icon3.svg" alt="icon"
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

    <pre><?
        print_r($arResult);
        print_r($arParams);
        ?></pre>

<?php
unset($actualItem, $itemIds, $jsParams);
