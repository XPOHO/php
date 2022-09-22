<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
    <!-- main content -->

<? $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "mainSlider",
    array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(
            0 => "ID",
            1 => "NAME",
            2 => "PREVIEW_TEXT",
            3 => "",
        ),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "4",
        "IBLOCK_TYPE" => "BANNERS",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "20",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_TITLE" => "Слайдер",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "SET_BROWSER_TITLE" => "Y",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "Y",
        "SHOW_404" => "N",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N",
        "COMPONENT_TEMPLATE" => "mainSlider"
    ),
    false
); ?>


<? $APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "MainBanners",
    array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "N",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_DATE" => "N",
        "DISPLAY_NAME" => "N",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "FILTER_NAME" => "",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "5",
        "IBLOCK_TYPE" => "BANNERS",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "INCLUDE_SUBSECTIONS" => "N",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "20",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_TITLE" => "Баннеры ",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array(
            0 => "TEXT_FORMAT",
            1 => "BIG_TEXT",
            2 => "SMOLL_TEXT",
            3 => "FORMAT_FOTO",
            4 => "COLOR_TEXT",
            5 => "",
        ),
        "SET_BROWSER_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N",
        "COMPONENT_TEMPLATE" => "MainBanners"
    ),
    false
); ?>

    <section class="mpage-catalog catalog-section">
        <h2 class="catalog-section__title section-title">Повседневная одежда</h2>
        <div class="catalog-section__content">
            <div class="catalog-slider swiper">
                <div class="swiper-wrapper">
                    <!-- if colors-slider -->


                    <?

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



                    CModule::IncludeModule("iblock");
                    CModule::IncludeModule("catalog");
                    CModule::IncludeModule('sale');
                    $IDHighload = 2;
                    $hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($IDHighload)->fetch();
                    $hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
                    $hlDataClass = $hldata["NAME"] . "Table";
                    $mainColor = "";
                    $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL", "PROPERTY_*");
                    $arFilter = array("IBLOCK_ID" => 2, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_CATAL_BLOCK1" => 58);
                    $resProdblock = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
                    while ($obProdMain = $resProdblock->GetNextElement()) {
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

                    ?>


                </div>
                <div class="swiper-navigation">
                    <div class="nav-btn btn-prev"><i class="icon icon-slider_arrow"></i></div>
                    <div class="nav-btn btn-next"><i class="icon icon-slider_arrow"></i></div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

<? $APPLICATION->IncludeComponent("bitrix:news.list", "MainBanners2", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"DISPLAY_DATE" => "N",	// Выводить дату элемента
		"DISPLAY_NAME" => "N",	// Выводить название элемента
		"DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "7",	// Код информационного блока
		"IBLOCK_TYPE" => "BANNERS",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"NEWS_COUNT" => "20",	// Количество новостей на странице
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Баннеры ",	// Название категорий
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"PROPERTY_CODE" => array(	// Свойства
			0 => "TEXT_FORMAT",
			1 => "BIG_TEXT",
			2 => "SMOLL_TEXT",
			3 => "FORMAT_FOTO",
			4 => "COLOR_TEXT",
			5 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
		"COMPONENT_TEMPLATE" => "MainBanners"
	),
	false
); ?>


<!--    <section class="mpage-banner side-banner reverse-style">-->
<!--        <div class="banner-slide">-->
<!--            <div class="container">-->
<!--                <div class="banner-slide__info">-->
<!--                    <h3 class="banner-subtitle">Новинки в каталоге</h3>-->
<!--                    <h2 class="banner-title">Black and white graphic</h2>-->
<!--                    <a href="#" class="banner-link btn-fill-style white-style">Перейти в каталог</a>-->
<!--                </div>-->
<!--                <div class="banner-slide__image lazyload"-->
<!--                     data-bgset="--><?//= DEFAULT_TEMPLATE_PATH ?><!--/images/main//main_page/banners/mobile/sidebanner_image2.jpg [(max-width: 575px)] | --><?//= DEFAULT_TEMPLATE_PATH ?><!--/images/main/main_page/banners/pad/sidebanner_image2.jpg [(max-width: 1024px)] | --><?//= DEFAULT_TEMPLATE_PATH ?><!--/images/main/main_page/banners/sidebanner_image2.jpg [(min-width: 1025px)]"></div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
    <section class="mpage-catalog catalog-section">
        <h2 class="catalog-section__title section-title">Black and white graphic</h2>
        <div class="catalog-section__content">
            <div class="catalog-slider swiper">
                <div class="swiper-wrapper">
                    <!-- if colors-slider -->

                    <?


                    $mainColor = "";
                    $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL", "PROPERTY_*");
                    $arFilter = array("IBLOCK_ID" => 2, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_CATAL_BLOCK2" => 59);
                    $resProdblock = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
                    while ($obProdMain = $resProdblock->GetNextElement()) {
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
    </section>



<? $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"MainBanners3", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "8",
		"IBLOCK_TYPE" => "BANNERS",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "Баннеры ",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "TEXT_FORMAT",
			1 => "BIG_TEXT",
			2 => "SMOLL_TEXT",
			3 => "FORMAT_FOTO",
			4 => "COLOR_TEXT",
			5 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "MainBanners3"
	),
	false
); ?>


<!--    <section class="mpage-banner full-banner center-style">-->
<!--        <div class="banner-slide lazyload"-->
<!--             data-bgset="--><?//= DEFAULT_TEMPLATE_PATH ?><!--/images/main//main_page/banners/mobile/fullbanner_image3.jpg [(max-width: 575px)] | --><?//= DEFAULT_TEMPLATE_PATH ?><!--/images/main/main_page/banners/pad/fullbanner_image3.jpg [(max-width: 1024px)] | --><?//= DEFAULT_TEMPLATE_PATH ?><!--/images/main/main_page/banners/fullbanner_image3.jpg [(min-width: 1025px)]">-->
<!--            <div class="container">-->
<!--                <h3 class="banner-subtitle">Повседневная одежда</h3>-->
<!--                <h2 class="banner-title">Dusk in the valley</h2>-->
<!--                <div class="banner-btns inline-btns">-->
<!--                    <a href="#" class="banner-link btn-fill-style white-style">Перейти в каталог</a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
    <section class="mpage-catalog catalog-section">
        <h2 class="catalog-section__title section-title">Black and white graphic</h2>
        <div class="catalog-section__content">
            <div class="catalog-slider swiper">
                <div class="swiper-wrapper">
                    <!-- if colors-slider -->




                    <?


                    $mainColor = "";
                    $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL", "PROPERTY_*");
                    $arFilter = array("IBLOCK_ID" => 2, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_CATAL_BLOCK3" => 60);
                    $resProdblock = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
                    while ($obProdMain = $resProdblock->GetNextElement()) {
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
    </section>


<? $APPLICATION->IncludeComponent("bitrix:news.list", "MainBanners4", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"DISPLAY_DATE" => "N",	// Выводить дату элемента
		"DISPLAY_NAME" => "N",	// Выводить название элемента
		"DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",	// Фильтр
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"IBLOCK_ID" => "9",	// Код информационного блока
		"IBLOCK_TYPE" => "BANNERS",	// Тип информационного блока (используется только для проверки)
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",	// Включать инфоблок в цепочку навигации
		"INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"NEWS_COUNT" => "20",	// Количество новостей на странице
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
		"PAGER_TITLE" => "Баннеры ",	// Название категорий
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"PROPERTY_CODE" => array(	// Свойства
			0 => "TEXT_FORMAT",
			1 => "BIG_TEXT",
			2 => "SMOLL_TEXT",
			3 => "FORMAT_FOTO",
			4 => "COLOR_TEXT",
			5 => "",
		),
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SHOW_404" => "N",	// Показ специальной страницы
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
		"COMPONENT_TEMPLATE" => "MainBanners"
	),
	false
); ?>


<!--    <section class="mpage-banner full-banner left-center-style">-->
<!--        <div class="banner-slide lazyload"-->
<!--             data-bgset="--><?//= DEFAULT_TEMPLATE_PATH ?><!--/images/main//main_page/banners/mobile/fullbanner_image4.jpg [(max-width: 575px)] | --><?//= DEFAULT_TEMPLATE_PATH ?><!--/images/main/main_page/banners/pad/fullbanner_image4.jpg [(max-width: 1024px)] | --><?//= DEFAULT_TEMPLATE_PATH ?><!--/images/main/main_page/banners/fullbanner_image4.jpg [(min-width: 1025px)]">-->
<!--            <div class="container">-->
<!--                <h3 class="banner-subtitle">Новый сезон</h3>-->
<!--                <h2 class="banner-title">Irses flowers</h2>-->
<!--                <div class="banner-btns inline-btns">-->
<!--                    <a href="#" class="banner-link btn-outline-style white-style">Перейти в каталог</a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
<!--    <section class="mpage-banner full-banner center-style">-->
<!--        <div class="banner-slide lazyload"-->
<!--             data-bgset="--><?//= DEFAULT_TEMPLATE_PATH ?><!--/images/main//main_page/banners/mobile/fullbanner_image5.jpg [(max-width: 575px)] | --><?//= DEFAULT_TEMPLATE_PATH ?><!--/images/main/main_page/banners/pad/fullbanner_image5.jpg [(max-width: 1024px)] | --><?//= DEFAULT_TEMPLATE_PATH ?><!--/images/main/main_page/banners/fullbanner_image5.jpg [(min-width: 1025px)]">-->
<!--            <div class="container">-->
<!--                <h3 class="banner-subtitle">Повседневная одежда</h3>-->
<!--                <h2 class="banner-title">Coffee with mint</h2>-->
<!--                <div class="banner-btns">-->
<!--                    <a href="#" class="banner-link btn-outline-style white-style">Перейти в каталог</a>-->
<!--                    <a href="#" class="banner-link btn-fill-style white-style">Перейти в каталог</a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
<!--    <section class="mpage-banner side-banner">-->
<!--        <div class="banner-slide">-->
<!--            <div class="container">-->
<!--                <div class="banner-slide__info">-->
<!--                    <h3 class="banner-subtitle">Новый сезон</h3>-->
<!--                    <h2 class="banner-title">Tropical mood</h2>-->
<!--                    <a href="#" class="banner-link btn-fill-style white-style">Перейти в каталог</a>-->
<!--                </div>-->
<!--                <div class="banner-slide__image lazyload"-->
<!--                     data-bgset="--><?//= DEFAULT_TEMPLATE_PATH ?><!--/images/main//main_page/banners/mobile/sidebanner_image3.jpg [(max-width: 575px)] | --><?//= DEFAULT_TEMPLATE_PATH ?><!--/images/main/main_page/banners/pad/sidebanner_image3.jpg [(max-width: 1024px)] | --><?//= DEFAULT_TEMPLATE_PATH ?><!--/images/main/main_page/banners/sidebanner_image3.jpg [(min-width: 1025px)]"></div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
<!--    <section class="mpage-banner side-banner reverse-style">-->
<!--        <div class="banner-slide">-->
<!--            <div class="container">-->
<!--                <div class="banner-slide__info">-->
<!--                    <h3 class="banner-subtitle">Новый сезон</h3>-->
<!--                    <h2 class="banner-title">Night garden</h2>-->
<!--                    <a href="#" class="banner-link btn-fill-style white-style">Перейти в каталог</a>-->
<!--                </div>-->
<!--                <div class="banner-slide__image lazyload"-->
<!--                     data-bgset="--><?//= DEFAULT_TEMPLATE_PATH ?><!--/images/main//main_page/banners/mobile/sidebanner_image4.jpg [(max-width: 575px)] | --><?//= DEFAULT_TEMPLATE_PATH ?><!--/images/main/main_page/banners/pad/sidebanner_image4.jpg [(max-width: 1024px)] | --><?//= DEFAULT_TEMPLATE_PATH ?><!--/images/main/main_page/banners/sidebanner_image4.jpg [(min-width: 1025px)]"></div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
    <section class="mpage-catalog catalog-section">
        <h2 class="catalog-section__title section-title">Black and white graphic</h2>
        <div class="catalog-section__content">
            <div class="catalog-slider swiper">
                <div class="swiper-wrapper">
                    <!-- if colors-slider -->
                    <?


                    $mainColor = "";
                    $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL", "PROPERTY_*");
                    $arFilter = array("IBLOCK_ID" => 2, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_CATAL_BLOCK4" => 61);
                    $resProdblock = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
                    while ($obProdMain = $resProdblock->GetNextElement()) {
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
    </section>
    <section class="mpage-subscribe subscribe-section">
        <div class="container">
            <div class="subscribe-section__content">
                <h2 class="form-title">Присоединяйтесь к нам!</h2>
                <form action="" class="subscribe-form">
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Ваш e-mail">
                    </div>
                    <div class="input-group check-group">
                        <label>
                            <input type="checkbox" name="check" required>
                            <span>СОГЛАСЕН НА ОБРАБОТКУ ПЕРСОНАЛЬНЫХ ДАННЫХ, С <a
                                        href="#">ДОГОВОРОМ ПУБЛИЧНОЙ ОФЕРТЫ</a> И <a href="#">ПОЛИТИКОЙ КОНФИДЕНЦИАЛЬНОСТИ</a> ОЗНАКОМЛЕН И ПРИНИМАЮ</span>
                        </label>
                    </div>
                    <div class="input-group btn-group">
                        <button type="submit" class="btn-fill-style black-style">Подписаться</button>
                    </div>
                </form>
            </div>
            <div class="subscribe-section__social">
                <ul class="social-list">
                    <li class="social-list__item"><a href="#" target="_blank" class="social-list__link"><i
                                    class="icon icon-youtube"></i></a></li>
                    <li class="social-list__item"><a href="#" target="_blank" class="social-list__link"><i
                                    class="icon icon-vk"></i></a></li>
                    <li class="social-list__item"><a href="#" target="_blank" class="social-list__link"><i
                                    class="icon icon-tg"></i></a></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- main end content -->
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>