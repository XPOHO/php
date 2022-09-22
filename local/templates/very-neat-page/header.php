<!DOCTYPE html>
<html lang="ru">
<head>
    <?php

    use Bitrix\Main\Page\Asset;

    ?>
    <!-- meta tags --> <title><? $APPLICATION->ShowTitle(); ?></title>
    <?
    Asset::getInstance()->addString('<meta charset="UTF-8">');
    Asset::getInstance()->addString(' <meta http-equiv="X-UA-Compatible" content="IE=edge">');
    Asset::getInstance()->addString('<meta name="author" content="VERY NEAT">');
    Asset::getInstance()->addString('<meta name="image" content="' . DEFAULT_TEMPLATE_PATH . '/images/preview.jpg">');
    // Asset::getInstance()->addString('<meta property="og:type" content="website">');
    // Asset::getInstance()->addString('<meta property="og:site_name" content="VERY NEAT">');
    // Asset::getInstance()->addString('<meta property="og:title" content="VERY NEAT">');

    Asset::getInstance()->addString('<link rel="shortcut icon" href="' . DEFAULT_TEMPLATE_PATH . '/favicon/favicon.ico" type="image/x-icon">');
    Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="57x57" href="' . DEFAULT_TEMPLATE_PATH . '/favicon/apple-icon-57x57.png">');
    Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="60x60" href="' . DEFAULT_TEMPLATE_PATH . '/favicon/apple-icon-60x60.png">');
    Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="72x72" href="' . DEFAULT_TEMPLATE_PATH . '/favicon/apple-icon-72x72.png">');
    Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="76x76" href="' . DEFAULT_TEMPLATE_PATH . '/favicon/apple-icon-76x76.png">');

    Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="114x114" href="' . DEFAULT_TEMPLATE_PATH . '/favicon/apple-icon-114x114.png">');
    Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="120x120" href="' . DEFAULT_TEMPLATE_PATH . '/favicon/apple-icon-120x120.png">');
    Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="144x144" href="' . DEFAULT_TEMPLATE_PATH . '/favicon/apple-icon-144x144.png">');
    Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="152x152" href="' . DEFAULT_TEMPLATE_PATH . '/favicon/apple-icon-152x152.png">');
    Asset::getInstance()->addString('<link rel="icon" type="image/png" sizes="192x192" href="' . DEFAULT_TEMPLATE_PATH . '/favicon/android-icon-192x192.png">');
    Asset::getInstance()->addString('<link rel="icon" type="image/png" sizes="32x32" href="' . DEFAULT_TEMPLATE_PATH . '/favicon/favicon-32x32.png">');
    Asset::getInstance()->addString('<link rel="icon" type="image/png" sizes="96x96" href="' . DEFAULT_TEMPLATE_PATH . '/favicon/favicon-96x96.png">');
    Asset::getInstance()->addString('<link rel="icon" type="image/png" sizes="16x16" href="' . DEFAULT_TEMPLATE_PATH . '/favicon/favicon-16x16.png">');
    Asset::getInstance()->addString('<link rel="manifest" href="' . DEFAULT_TEMPLATE_PATH . '/favicon/manifest.json">');
    Asset::getInstance()->addString('<meta name="msapplication-TileImage" content="' . DEFAULT_TEMPLATE_PATH . '/favicon/ms-icon-144x144.png">');
    Asset::getInstance()->addString('<meta name="msapplication-TileColor" content="#565656">');
    Asset::getInstance()->addString('<meta name="apple-mobile-web-app-title" content="">');
    Asset::getInstance()->addString('<meta name="apple-mobile-web-app-capable" content="yes">');
    Asset::getInstance()->addString('<meta name="format-detection" content="telephone=no">');
    Asset::getInstance()->addString('<meta name="format-detection" content="address=no">');
    Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1.0">');
    Asset::getInstance()->addString('<link rel="preload" href="' . DEFAULT_TEMPLATE_PATH . '/fonts/MontserratBold/MontserratBold.woff2" as="font" type="font/woff2" crossorigin>');
    Asset::getInstance()->addString('<link rel="preload" href="' . DEFAULT_TEMPLATE_PATH . '/fonts/MontserratLight/MontserratLight.woff2" as="font" type="font/woff2" crossorigin>');
    Asset::getInstance()->addString('<link rel="preload" href="' . DEFAULT_TEMPLATE_PATH . '/fonts/MontserratMedium/MontserratMedium.woff2" as="font" type="font/woff2" crossorigin>');
    Asset::getInstance()->addString('<link rel="preload" href="' . DEFAULT_TEMPLATE_PATH . '/fonts/MontserratRegular/MontserratRegular.woff2" as="font" type="font/woff2" crossorigin>');
    Asset::getInstance()->addString('<link rel="preload" href="' . DEFAULT_TEMPLATE_PATH . '/fonts/MontserratSemiBold/MontserratSemiBold.woff2" as="font" type="font/woff2" crossorigin>');
    Asset::getInstance()->addString('<link rel="preload" href="' . DEFAULT_TEMPLATE_PATH . '/fonts/RobotoBold/RobotoBold.woff2" as="font" type="font/woff2" crossorigin>');
    Asset::getInstance()->addString('<link rel="preload" href="' . DEFAULT_TEMPLATE_PATH . '/fonts/RobotoMedium/RobotoMedium.woff2" as="font" type="font/woff2" crossorigin>');
    Asset::getInstance()->addString('<link rel="preload" href="' . DEFAULT_TEMPLATE_PATH . '/fonts/RobotoRegular/RobotoRegular.woff2" as="font" type="font/woff2" crossorigin>');
    //Asset::getInstance()->addString('');
    ?>
    <meta property="og:description" content="VERY NEAT">
    <meta property="og:image" content="<?= DEFAULT_TEMPLATE_PATH ?>/images/preview.jpg">
    <meta property="og:url" content="https://veryneat.ru/">
    <!-- canonical -->
    <link rel="canonical" href="https://veryneat.ru/">
    <?
    $APPLICATION->ShowHead();
    Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . "/css/main.css");
    Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . "/css/styles.css");
    Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . "/js/common.js");
    CJSCore::Init(["jquery"]);




    ?>
</head>
<body>
<? $APPLICATION->ShowPanel(); ?>
<header class="header">
    <div class="header__stock">
        <div class="container">
            <p>Lorem ipsum is placeholder text commonly used -20%</p>
        </div>
    </div>
    <div class="header__main">
        <div class="container">
            <button id="hamburger" class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                    </span>
            </button>
            <a href="/" class="logo-link">

                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/logo.php"
                    )
                );?>

            </a>
            <a href="javascript:void(0);" class="city-link" data-micromodal-trigger="modal-cities" style="display: none;">Москва</a>
            <nav class="hmain-menu" style="position: absolute; transform: translateX(-100vw);">
                <div class="hmain-menu__header">
                    <a href="#" class="b2b-link">B2B</a>
                    <a href="<?


                    if (!$USER->IsAuthorized()) // Для неавторизованного
                    {

                        echo "/favorite/";

                    } else {

                        echo "/favorite/";

                    }


                    ?>" class="favorite-link"><i class="icon icon-heart"></i></a>
                </div>
                <div class="hmain-menu__categories">
                    <ul class="categories-list">
                        <li class="categories-list__item active">
                            <a href="javascript:void(0);" data-category="category1" class="categories-list__link" style="background-image: url('<?= DEFAULT_TEMPLATE_PATH ?>/images/main/main_page/menu/category_image1.jpg')">
                                <span>Повседневная одежда</span>
                            </a>
                        </li>
                        <li class="categories-list__item">
                            <a href="javascript:void(0);" data-category="category2" class="categories-list__link" style="background-image: url('<?= DEFAULT_TEMPLATE_PATH ?>/images/main/main_page/menu/category_image2.jpg')">
                                <span>Домашняя одежда</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="hmain-menu__subcategories">

                    <? $APPLICATION->IncludeComponent("bitrix:menu", "povsednevn", array(
                        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                        "CHILD_MENU_TYPE" => "mainpov",    // Тип меню для остальных уровней
                        "DELAY" => "N",    // Откладывать выполнение шаблона меню
                        "MAX_LEVEL" => "2",    // Уровень вложенности меню
                        "MENU_CACHE_GET_VARS" => array(    // Значимые переменные запроса
                            0 => "",
                        ),
                        "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                        "MENU_CACHE_TYPE" => "N",    // Тип кеширования
                        "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                        "ROOT_MENU_TYPE" => "mainpov",    // Тип меню для первого уровня
                        "USE_EXT" => "Y",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                    ),
                        false
                    ); ?>

                    <? $APPLICATION->IncludeComponent("bitrix:menu", "domashnya", array(
                        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
                        "CHILD_MENU_TYPE" => "maindom",    // Тип меню для остальных уровней
                        "DELAY" => "N",    // Откладывать выполнение шаблона меню
                        "MAX_LEVEL" => "2",    // Уровень вложенности меню
                        "MENU_CACHE_GET_VARS" => array(    // Значимые переменные запроса
                            0 => "",
                        ),
                        "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
                        "MENU_CACHE_TYPE" => "N",    // Тип кеширования
                        "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
                        "ROOT_MENU_TYPE" => "maindom",    // Тип меню для первого уровня
                        "USE_EXT" => "Y",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
                    ),
                        false
                    ); ?>


                </div>
                <div class="hmain-menu__footer">
                    <a href="tel:88005111340" class="phone-link">  <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/telefon.php"
                            )
                        );?></a>
                    <a href="javascript:void(0);" data-micromodal-trigger="modal-cities" class="city-link">Москва</a>
                </div>
            </nav>
            <a href="tel:88005111340" class="phone-link" style="display: none;">  <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/telefon.php"
                    )
                );?></a>
            <div class="search-block">
                <a id="search-open" href="javascript:void(0);" class="search-link"><i class="icon icon-search"></i></a>
                <div id="search-result" class="search-block__result" style="transform: translateX(100vw); position: absolute;">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:search.form",
                        "",
                        Array(
                            "PAGE" => "#SITE_DIR#search/index.php",
                            "USE_SUGGEST" => "N"
                        )
                    );?>
                    <div class="result-catalog">
                    </div>
                    <div class="result-info">
                        <div class="result-info__actual">
                            <span class="info-title">Актуально сейчас</span>
                            <ul class="actual-list">
                                <li class="actual-list__item"><a href="#" class="actual-list__link">Распродажа</a></li>
                                <li class="actual-list__item"><a href="#" class="actual-list__link">Новинки</a></li>
                                <li class="actual-list__item"><a href="#" class="actual-list__link">Повседневная одежда</a></li>
                                <li class="actual-list__item"><a href="#" class="actual-list__link">Домашняя одежда</a></li>
                            </ul>
                        </div>
                        <div class="result-info__yousee">
                            <span class="info-title">Вы недавно смотрели</span>
                            <div class="products-wrapper">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:catalog.products.viewed",
                                    "",
                                    Array(
                                        "ACTION_VARIABLE" => "action_cpv",
                                        "ADDITIONAL_PICT_PROP_2" => "-",
                                        "ADDITIONAL_PICT_PROP_3" => "-",
                                        "ADD_PROPERTIES_TO_BASKET" => "Y",
                                        "ADD_TO_BASKET_ACTION" => "ADD",
                                        "BASKET_URL" => "/personal/basket.php",
                                        "CACHE_GROUPS" => "Y",
                                        "CACHE_TIME" => "3600",
                                        "CACHE_TYPE" => "A",
                                        "CONVERT_CURRENCY" => "N",
                                        "DEPTH" => "2",
                                        "DISPLAY_COMPARE" => "N",
                                        "ENLARGE_PRODUCT" => "STRICT",
                                        "HIDE_NOT_AVAILABLE" => "N",
                                        "HIDE_NOT_AVAILABLE_OFFERS" => "Y",
                                        "IBLOCK_ID" => "2",
                                        "IBLOCK_MODE" => "single",
                                        "IBLOCK_TYPE" => "catalog",
                                        "LABEL_PROP_2" => array(),
                                        "LABEL_PROP_POSITION" => "top-left",
                                        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                                        "MESS_BTN_BUY" => "Купить",
                                        "MESS_BTN_DETAIL" => "Подробнее",
                                        "MESS_BTN_SUBSCRIBE" => "Подписаться",
                                        "MESS_NOT_AVAILABLE" => "Нет в наличии",
                                        "PAGE_ELEMENT_COUNT" => "9",
                                        "PARTIAL_PRODUCT_PROPERTIES" => "N",
                                        "PRICE_CODE" => array(),
                                        "PRICE_VAT_INCLUDE" => "Y",
                                        "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                                        "PRODUCT_ID_VARIABLE" => "id",
                                        "PRODUCT_PROPS_VARIABLE" => "prop",
                                        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                                        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false},{'VARIANT':'0','BIG_DATA':false}]",
                                        "PRODUCT_SUBSCRIPTION" => "Y",
                                        "SECTION_CODE" => "",
                                        "SECTION_ELEMENT_CODE" => "",
                                        "SECTION_ELEMENT_ID" => $GLOBALS["CATALOG_CURRENT_ELEMENT_ID"],
                                        "SECTION_ID" => $GLOBALS["CATALOG_CURRENT_SECTION_ID"],
                                        "SHOW_CLOSE_POPUP" => "N",
                                        "SHOW_DISCOUNT_PERCENT" => "N",
                                        "SHOW_FROM_SECTION" => "N",
                                        "SHOW_MAX_QUANTITY" => "N",
                                        "SHOW_OLD_PRICE" => "N",
                                        "SHOW_PRICE_COUNT" => "1",
                                        "SHOW_SLIDER" => "Y",
                                        "SLIDER_INTERVAL" => "3000",
                                        "SLIDER_PROGRESS" => "N",
                                        "TEMPLATE_THEME" => "blue",
                                        "USE_ENHANCED_ECOMMERCE" => "N",
                                        "USE_PRICE_COUNT" => "N",
                                        "USE_PRODUCT_QUANTITY" => "N"
                                    )
                                );?>
                            </div>
                            <a href="#" class="see-all"><i class="icon icon-slider_arrow"></i>Смотреть все товары</a>
                        </div>
                    </div>
                    <div class="result-copyright">
                        <p>© Copyright 2022 very neat</p>
                    </div>
                </div>
            </div>
            <div class="b2b-block" style="display: none;">
                <a href="#" class="b2b-link">B2B</a>
            </div>
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




            ?>
            <ul class="profile-links">
                <li class="profile-links__item ">
                    <a id="minicart-link" href="javascript:void(0);" class="profile-links__link cart-link"><i class="icon icon-cart_fill"></i>

                        <?
                        use Bitrix\Sale;
                        Bitrix\Main\Loader::includeModule("sale");
                        Bitrix\Main\Loader::includeModule("catalog");
                        $basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());

                        $countProdBasket= count($basket->getQuantityList());
                        if (!empty($countProdBasket)){

                            ?> <span id="cart-value" class="cart-value"><?=$countProdBasket?></span><?
                        }
                        ?>

                    </a>

                    <div id="minicart" class="minicart-content" style="transform: translateX(100vw); position: absolute;">
                        <a id="minicart-close" href="javascript:void(0);" class="minicart-close-link"><i class="icon icon-close"></i></a>


                        <?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket", 
	".default", 
	array(
		"ACTION_VARIABLE" => "basketAction",
		"ADDITIONAL_PICT_PROP_2" => "-",
		"ADDITIONAL_PICT_PROP_3" => "-",
		"AUTO_CALCULATION" => "Y",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"COLUMNS_LIST_EXT" => array(
			0 => "PREVIEW_PICTURE",
			1 => "DISCOUNT",
			2 => "DELETE",
			3 => "DELAY",
			4 => "TYPE",
			5 => "SUM",
		),
		"COLUMNS_LIST_MOBILE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "DISCOUNT",
			2 => "DELETE",
			3 => "DELAY",
			4 => "TYPE",
			5 => "SUM",
		),
		"COMPATIBLE_MODE" => "Y",
		"CORRECT_RATIO" => "Y",
		"DEFERRED_REFRESH" => "N",
		"DISCOUNT_PERCENT_POSITION" => "bottom-center",
		"DISPLAY_MODE" => "extended",
		"EMPTY_BASKET_HINT_PATH" => "/",
		"GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_CONVERT_CURRENCY" => "N",
		"GIFTS_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_HIDE_NOT_AVAILABLE" => "N",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_MESS_BTN_DETAIL" => "Подробнее",
		"GIFTS_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_PLACE" => "BOTTOM",
		"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
		"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "N",
		"GIFTS_TEXT_LABEL_GIFT" => "Подарок",
		"HIDE_COUPON" => "Y",
		"LABEL_PROP" => array(
		),
		"PATH_TO_ORDER" => "/personal/order/make/",
		"PRICE_DISPLAY_MODE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_BLOCKS_ORDER" => "props,sku,columns",
		"QUANTITY_FLOAT" => "Y",
		"SET_TITLE" => "Y",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_FILTER" => "N",
		"SHOW_RESTORE" => "Y",
		"TEMPLATE_THEME" => "blue",
		"TOTAL_BLOCK_DISPLAY" => array(
			0 => "bottom",
		),
		"USE_DYNAMIC_SCROLL" => "Y",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_GIFTS" => "N",
		"USE_PREPAYMENT" => "N",
		"USE_PRICE_ANIMATION" => "Y",
		"AJAX_MODE" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>

<!--                        --><?//
//
//                        if (empty($countProdBasket)){
//
//                            ?>
<!---->
<!--                            <div class="minicart-content__empty">-->
<!--                                <p>Ваша корзина пуста</p>-->
<!--                            </div>-->
<!---->
<!--                            --><?//
//
//                        }
//
//                        else{
//                            ?>
<!---->
<!---->
<!---->
<!---->
<!--                            --><?//
//                        }
                        ?>
                        <!-- if cart is not empty -->

                        <!-- if added to cart
                    <div class="minicart-content__added">
                        <div class="minicart-title">Корзина <span id="products-count">5 товаров</span></div>
                            <div class="info-list">
                            <div class="minicart-content__result">
                            <div class="price-group">Итого: <span id="result-total">1 749 ₽</span></div>
                            <a href="#" class="order-link btn-fill-style">Перейти в корзину</a>
                        </div>
                            <div class="minicart-content__message">
                            <h3>Отличный выбор!</h3>
                            <p>Товар добавлен в вашу корзину.</p>
                        </div>
                            <div class="minicart-content__more">
                            <h2 class="more-title">Вам может понравится</h2>
                            <div id="minicart-slider" class="minicart-slider swiper">
                                <div class="swiper-wrapper">
                                    <div class="slide-item swiper-slide colors-item">
                                        <div class="image-block">
                                            <div class="colors-slider swiper">
                                                <div class="swiper-wrapper">
                                                    <a href="#" class="product-link swiper-slide" data-color="#AEB9A9">
                                                        <img src="<?= DEFAULT_TEMPLATE_PATH ?>/images/main/main_page/catalogs/product_image31.jpg" alt="product" class="product-image">
                                                    </a>
                                                    <a href="#" class="product-link swiper-slide" data-color="#8ACAFF">
                                                        <img src="<?= DEFAULT_TEMPLATE_PATH ?>/images/main/main_page/catalogs/product_image32.jpg" alt="product" class="product-image">
                                                    </a>
                                                    <a href="#" class="product-link swiper-slide" data-color="#252426">
                                                        <img src="<?= DEFAULT_TEMPLATE_PATH ?>/images/main/main_page/catalogs/product_image33.jpg" alt="product" class="product-image">
                                                    </a>
                                                </div>
                                                <div class="colors-navigation">
                                                    <div class="colors-btn color-prev"><i class="icon icon-slider_arrow"></i></div>
                                                    <div class="colors-btn color-next"><i class="icon icon-slider_arrow"></i></div>
                                                </div>
                                            </div>
                                            <div class="product-btns">
                                                <a href="#" class="product-btn favorite-link"><i class="icon icon-heart"></i></a>
                                                <a href="#" class="product-btn addcart-link"><i class="icon icon-cart"></i><span>В корзину</span></a>
                                            </div>
                                        </div>
                                        <div class="descr-block">
                                            <a href="#" class="product-name">Жакет женский</a>
                                            <span class="product-price">
                            <span class="oldprice">1 749 ₽</span>
                            <span class="price">1 749 ₽</span>
                        </span>
                                            <div class="product-colors">
                                                <div class="colors-pagination"></div>
                                                <span class="product-colors__all">+19 цветов</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slide-item swiper-slide colors-item">
                                        <div class="image-block">
                                            <div class="colors-slider swiper">
                                                <div class="swiper-wrapper">
                                                    <a href="#" class="product-link swiper-slide" data-color="#AEB9A9">
                                                        <img src="<?= DEFAULT_TEMPLATE_PATH ?>/images/main/main_page/catalogs/product_image31.jpg" alt="product" class="product-image">
                                                    </a>
                                                    <a href="#" class="product-link swiper-slide" data-color="#8ACAFF">
                                                        <img src="<?= DEFAULT_TEMPLATE_PATH ?>/images/main/main_page/catalogs/product_image32.jpg" alt="product" class="product-image">
                                                    </a>
                                                    <a href="#" class="product-link swiper-slide" data-color="#252426">
                                                        <img src="<?= DEFAULT_TEMPLATE_PATH ?>/images/main/main_page/catalogs/product_image33.jpg" alt="product" class="product-image">
                                                    </a>
                                                </div>
                                                <div class="colors-navigation">
                                                    <div class="colors-btn color-prev"><i class="icon icon-slider_arrow"></i></div>
                                                    <div class="colors-btn color-next"><i class="icon icon-slider_arrow"></i></div>
                                                </div>
                                            </div>
                                            <div class="product-btns">
                                                <a href="#" class="product-btn favorite-link"><i class="icon icon-heart"></i></a>
                                                <a href="#" class="product-btn addcart-link"><i class="icon icon-cart"></i><span>В корзину</span></a>
                                            </div>
                                        </div>
                                        <div class="descr-block">
                                            <a href="#" class="product-name">Жакет женский</a>
                                            <span class="product-price">
                            <span class="oldprice">1 749 ₽</span>
                            <span class="price">1 749 ₽</span>
                        </span>
                                            <div class="product-colors">
                                                <div class="colors-pagination"></div>
                                                <span class="product-colors__all">+19 цветов</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slide-item swiper-slide">
                                        <div class="image-block">
                                            <a href="#" class="product-link">
                                                <img src="<?= DEFAULT_TEMPLATE_PATH ?>/images/main/main_page/catalogs/product_image31.jpg" alt="product" class="product-image">
                                            </a>
                                            <div class="product-btns">
                                                <a href="#" class="product-btn favorite-link"><i class="icon icon-heart"></i></a>
                                                <a href="#" class="product-btn addcart-link"><i class="icon icon-cart"></i><span>В корзину</span></a>
                                            </div>
                                        </div>
                                        <div class="descr-block">
                                            <a href="#" class="product-name">Жакет женский</a>
                                            <span class="product-price">
                            <span class="oldprice">1 749 ₽</span>
                            <span class="price">1 749 ₽</span>
                        </span>
                                            <div class="product-colors"></div>
                                        </div>
                                    </div>
                                    <div class="slide-item swiper-slide">
                                        <div class="image-block">
                                            <a href="#" class="product-link">
                                                <img src="<?= DEFAULT_TEMPLATE_PATH ?>/images/main/main_page/catalogs/product_image33.jpg" alt="product" class="product-image">
                                            </a>
                                            <div class="product-btns">
                                                <a href="#" class="product-btn favorite-link"><i class="icon icon-heart"></i></a>
                                                <a href="#" class="product-btn addcart-link"><i class="icon icon-cart"></i><span>В корзину</span></a>
                                            </div>
                                        </div>
                                        <div class="descr-block">
                                            <a href="#" class="product-name">Жакет женский</a>
                                            <span class="product-price">
                            <span class="oldprice">1 749 ₽</span>
                            <span class="price">1 749 ₽</span>
                        </span>
                                            <div class="product-colors">
                                                <span class="product-colors__all">+19 цветов</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slide-item swiper-slide">
                                        <div class="image-block">
                                            <a href="#" class="product-link">
                                                <img src="<?= DEFAULT_TEMPLATE_PATH ?>/images/main/main_page/catalogs/product_image32.jpg" alt="product" class="product-image">
                                            </a>
                                            <div class="product-btns">
                                                <a href="#" class="product-btn favorite-link"><i class="icon icon-heart"></i></a>
                                                <a href="#" class="product-btn addcart-link"><i class="icon icon-cart"></i><span>В корзину</span></a>
                                            </div>
                                        </div>
                                        <div class="descr-block">
                                            <a href="#" class="product-name">Жакет женский</a>
                                            <span class="product-price">
                            <span class="oldprice">1 749 ₽</span>
                            <span class="price">1 749 ₽</span>
                        </span>
                                            <div class="product-colors"></div>
                                        </div>
                                    </div>
                                    <div class="slide-item swiper-slide">
                                        <div class="image-block">
                                            <a href="#" class="product-link">
                                                <img src="<?= DEFAULT_TEMPLATE_PATH ?>/images/main/main_page/catalogs/product_image31.jpg" alt="product" class="product-image">
                                            </a>
                                            <div class="product-btns">
                                                <a href="#" class="product-btn favorite-link"><i class="icon icon-heart"></i></a>
                                                <a href="#" class="product-btn addcart-link"><i class="icon icon-cart"></i><span>В корзину</span></a>
                                            </div>
                                        </div>
                                        <div class="descr-block">
                                            <a href="#" class="product-name">Жакет женский</a>
                                            <span class="product-price">
                            <span class="oldprice">1 749 ₽</span>
                            <span class="price">1 749 ₽</span>
                        </span>
                                            <div class="product-colors">
                                                <span class="product-colors__all">+19 цветов</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-pagination"></div>
                                <div class="swiper-navigation">
                                    <div class="nav-btn btn-prev"><i class="icon icon-slider_arrow"></i></div>
                                    <div class="nav-btn btn-next"><i class="icon icon-slider_arrow"></i></div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="minicart-content__continue">
                            <a href="javascript:void(0);" class="continue-link btn-outline-style">Продолжить покупки</a>
                        </div>
                    </div>
                    -->
                    </div>
                </li>
                <li class="profile-links__item" style="display: none;">
                    <a href="<?



                    if (!$USER->IsAuthorized()) // Для неавторизованного
                    {

                        echo "/favorite/";

                    } else {

                        echo "/favorite/";

                    }

                    ?>" class="profile-links__link"><i class="icon icon-heart"></i></a>
                </li>
                <li class="profile-links__item">
                    <a id="profile-link" href="javascript:void(0);" class="profile-links__link"><i class="icon icon-user"></i></a>
                    <ul id="profile-menu" class="profile-menu" style="transform: translateX(100vw); position: absolute;">
                        <li class="profile-menu__item"><a href="#" class="profile-menu__link active">Личные данные</a></li>
                        <li class="profile-menu__item"><a href="#" class="profile-menu__link">Заказы</a></li>
                        <li class="profile-menu__item"><a href="#" class="profile-menu__link">Избранное</a></li>
                        <li class="profile-menu__item"><a href="#" class="profile-menu__link exit-link">Выйти</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</header>

