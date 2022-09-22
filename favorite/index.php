<?
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");


CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule('sale');
CModule::IncludeModule('highloadblock');

use Bitrix\Sale;

\Bitrix\Main\Loader::includeModule("catalog");
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$IDHighload = 2;
$hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($IDHighload)->fetch();
$hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
$hlDataClass = $hldata["NAME"] . "Table";


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
<main class="favorite-page">
    <div class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumbs__list">
                <li class="breadcrumbs__item"><a href="#" class="breadcrumbs__link">Главная</a></li>
                <li class="breadcrumbs__item"><span class="breadcrumbs__current">FAQ</span></li>
            </ul>
        </div>
    </div>
    <div class="container">
        <h1 class="favorite-page__title page-title">Избранное</h1>
        <div class="favorite-page__content">
            <div class="favorite-list">
                <div class="favorite-list__links">
                    <span>Товар</span>
                    <a href="javascript:void(0);" class="clean-favlist">Очистить избранное</a>
                </div>


                <?

                foreach ($favoritesAr as $favItemId => $item) {


                    $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL", "PROPERTY_*");
                    $arFilter = array("IBLOCK_ID" => 2, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "ID" => $favItemId);
                    $resProd = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
                    if ($obProd = $resProd->GetNextElement()) {
                        $arFieldsProd = $obProd->GetFields();
                        $arPropsProd = $obProd->GetProperties();
                        $idProd = $arFieldsProd["ID"];
                        $nameProd = $arFieldsProd["NAME"];
                        $code = $arFieldsProd["CODE"];
                        $url = $arFieldsProd["DETAIL_PAGE_URL"];
                        $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PICTURE", "PROPERTY_*");
                        $arFilter = array("IBLOCK_ID" => 3, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_CML2_LINK" => $arFieldsProd["ID"]);
                        $resOffer = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
                        $Photo = "";
                        $sizesArr = [];
                        while ($obOffer = $resOffer->GetNextElement()) {
                            $arFieldsOffer = $obOffer->GetFields();
                            if (empty($Photo)) {
                                $renderImage = CFile::ResizeImageGet($arFieldsOffer["DETAIL_PICTURE"], array("width" => 400, "height" => 700), BX_RESIZE_IMAGE_PROPORTIONAL);
                                $Photo = $renderImage["src"];
                            }
                            $arProps = $obOffer->GetProperties();

                            $sizesArr[$arProps['SIZES_CLOTHES']['VALUE']]["id"] = $arFieldsOffer["ID"];


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
                            $sizesArr[$arProps['SIZES_CLOTHES']['VALUE']]["price"]["retail"] = $retailPrice;
                            $sizesArr[$arProps['SIZES_CLOTHES']['VALUE']]["price"]["sale"] = $salePrice;

                                $resultColor = $hlDataClass::getList(array(
                                    "select" => array("ID", "UF_NAME", "UF_XML_ID", "UF_COLORCOD"), // Поля для выборки
                                    "order" => array(),
                                    "filter" => array("UF_XML_ID" => $arProps["COLOR_REF"]['VALUE']),
                                ));
                                if ($resp = $resultColor->fetch()) {
                                //    print_r($resp);
                                    $mainColor = $resp['UF_COLORCOD'];
                                    $mainColorName = $resp['UF_NAME'];
                                }
                        }

                        if (empty($mainColor)) {
                            $mainColor = '#8A8972';
                        }
                        ?>
                        <div class="favorite-list__item">
                            <div class="image-block">
                                <a href="<?= $url ?>" class="product-link">
                                    <img src="<?= $Photo ?>" alt="product-image" class="product-image">
                                </a>
                            </div>
                            <div class="descr-block">
                                <a href="<?= $url ?>" class="product-name"><?= $nameProd ?></a>
                                <span class="article"><?= $arPropsProd['ARTNUMBER']['VALUE'] ?></span>
                                <div class="properties">
                                    <span class="properties__color"><span
                                                style="background-color: <?= $mainColor ?>;"></span><?= $mainColorName ?></span>
                                </div>
                                <div class="size-block">
                                    <select name="size-select" class="choice-select">

                                        <?
                                        foreach ($sizesArr as $itemSize => $itemSizeParams) {
                                            ?>
                                            <option value="<?= $itemSizeParams['id'] ?>"><?= $itemSize ?></option>
                                            <?
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="price-block">
                                <span style="text-align: center;" class="price-title">Цена</span>
                                <?
                                if (empty($itemSizeParams['price']["sale"])) {
                                    $itemSizeParams['price']["sale"] = $itemSizeParams['price']["retail"];
                                    $itemSizeParams['price']["retail"] = "";
                                }
                                $sale = $itemSizeParams['price']["sale"] . " ₽";
                                $retail = $itemSizeParams['price']["retail"] . " ₽";
                                if (empty($itemSizeParams['price']["retail"])) {
                                    $retail = '';
                                }
                                ?>

                                <span class="oldprice"><?= $retail ?></span>
                                <span class="price"><?= $sale ?></span>
                            </div>
                            <div class="btn-block">
                                <a style="cursor: pointer" data-item="<?=$idProd?>"  class="remove-link favorite-link"><i class="icon-close"></i></a>
                                <a style="cursor: pointer" data-item="<?=$idProd?>" class="addcart-link btn-fill-style"><i
                                            class="icon icon-cart"></i><span>Добавить в корзину</span></a>
                            </div>
                        </div>
                        <?
                    }
                }
                ?>

            </div>
        </div>
    </div>
</main>

<script>
    $('.remove-link').on('click', function (e) {
        let doAction
        var favorID = $(this).attr('data-item');
        if ($(this).hasClass('active')) {
            doAction = 'delete';
        } else {
            doAction = 'add';
        }
        $(this).parent().parent().remove()
        // addFavorite(favorID, doAction);
    });
    function addFavorite(id, action) {
        var param = 'id=' + id + "&action=" + action;
        $.ajax({
            url: '/favorites.php', // URL отправки запроса
            type: "GET",
            dataType: "html",
            data: param,
            success: function (response) { },
            error: function (jqXHR, textStatus, errorThrown) { // Ошибка
                console.log('Error: ' + errorThrown);
            }
        });
    }
    $('.addcart-link').on('click', function (e) {
        let idProdBlock = $(this).parent().parent().find('.choices__input').val();

        let addProdBasket = $(this).data("item");
        console.log(addProdBasket);
        $.ajax({
            url: '/addbasket.php',
            type: 'POST',
            data: {prod: idProdBlock, quantity: 1},
            success: (resul) => {
                console.log(resul);
                let test=$('.updateblock').text();
                console.log(test);
                $('.updateblock').click();
            }
        })
    });

</script>

<!--<section class="recently-products favorite-last">-->
<!--    <div class="container">-->
<!--        <h2 class="recently-products__title section-title">Недавно просмотренные</h2>-->
<!--        <div class="recently-products__content">-->
<!--            <div class="recently-slider swiper">-->
<!--                <div class="swiper-wrapper">-->
<!--                     if colors-slider -->
<!--                    <div class="slide-item swiper-slide colors-item">-->
<!--                        <div class="image-block">-->
<!--                            <div class="product-tags">-->
<!--                                <div class="product-tags__item sale-item">M, S — 20%</div>-->
<!--                                <div class="product-tags__item new-item">New</div>-->
<!--                            </div>-->
<!--                            <div class="colors-slider swiper">-->
<!--                                <div class="swiper-wrapper">-->
<!--                                    <a href="#" class="product-link swiper-slide" data-color="#AEB9A9">-->
<!--                                        <img src="images/main/main_page/catalogs/product_image31.jpg" alt="product" class="product-image">-->
<!--                                    </a>-->
<!--                                    <a href="#" class="product-link swiper-slide" data-color="#8ACAFF">-->
<!--                                        <img src="images/main/main_page/catalogs/product_image32.jpg" alt="product" class="product-image">-->
<!--                                    </a>-->
<!--                                    <a href="#" class="product-link swiper-slide" data-color="#252426">-->
<!--                                        <img src="images/main/main_page/catalogs/product_image33.jpg" alt="product" class="product-image">-->
<!--                                    </a>-->
<!--                                </div>-->
<!--                                <div class="colors-navigation">-->
<!--                                    <div class="colors-btn color-prev"><i class="icon icon-slider_arrow"></i></div>-->
<!--                                    <div class="colors-btn color-next"><i class="icon icon-slider_arrow"></i></div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="product-btns">-->
<!--                                <a href="#" class="product-btn favorite-link"><i class="icon icon-heart"></i></a>-->
<!--                                <a href="#" class="product-btn addcart-link"><i class="icon icon-cart"></i><span>В корзину</span></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="descr-block">-->
<!--                            <a href="#" class="product-name">Жакет женский</a>-->
<!--                            <span class="product-price">-->
<!--                                <span class="oldprice">1 749 ₽</span>-->
<!--                                <span class="price">1 749 ₽</span>-->
<!--                                </span>-->
<!--                            <div class="product-colors">-->
<!--                                <div class="colors-pagination"></div>-->
<!--                                <span class="product-colors__all">+19 цветов</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="slide-item swiper-slide colors-item">-->
<!--                        <div class="image-block">-->
<!--                            <div class="colors-slider swiper">-->
<!--                                <div class="swiper-wrapper">-->
<!--                                    <a href="#" class="product-link swiper-slide" data-color="#AEB9A9">-->
<!--                                        <img src="images/main/main_page/catalogs/product_image31.jpg" alt="product" class="product-image">-->
<!--                                    </a>-->
<!--                                    <a href="#" class="product-link swiper-slide" data-color="#8ACAFF">-->
<!--                                        <img src="images/main/main_page/catalogs/product_image32.jpg" alt="product" class="product-image">-->
<!--                                    </a>-->
<!--                                    <a href="#" class="product-link swiper-slide" data-color="#252426">-->
<!--                                        <img src="images/main/main_page/catalogs/product_image33.jpg" alt="product" class="product-image">-->
<!--                                    </a>-->
<!--                                </div>-->
<!--                                <div class="colors-navigation">-->
<!--                                    <div class="colors-btn color-prev"><i class="icon icon-slider_arrow"></i></div>-->
<!--                                    <div class="colors-btn color-next"><i class="icon icon-slider_arrow"></i></div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="product-btns">-->
<!--                                <a href="#" class="product-btn favorite-link"><i class="icon icon-heart"></i></a>-->
<!--                                <a href="#" class="product-btn addcart-link"><i class="icon icon-cart"></i><span>В корзину</span></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="descr-block">-->
<!--                            <a href="#" class="product-name">Жакет женский</a>-->
<!--                            <span class="product-price">-->
<!--                                <span class="oldprice">1 749 ₽</span>-->
<!--                                <span class="price">1 749 ₽</span>-->
<!--                                </span>-->
<!--                            <div class="product-colors">-->
<!--                                <div class="colors-pagination"></div>-->
<!--                                <span class="product-colors__all">+19 цветов</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--
<!--                    <div class="slide-item swiper-slide">-->
<!--                        <div class="image-block">-->
<!--                            <div class="product-tags">-->
<!--                                <div class="product-tags__item sale-item">M, S — 20%</div>-->
<!--                                <div class="product-tags__item new-item">New</div>-->
<!--                            </div>-->
<!--                            <a href="#" class="product-link">-->
<!--                                <img src="images/main/main_page/catalogs/product_image31.jpg" alt="product" class="product-image">-->
<!--                            </a>-->
<!--                            <div class="product-btns">-->
<!--                                <a href="#" class="product-btn favorite-link"><i class="icon icon-heart"></i></a>-->
<!--                                <a href="#" class="product-btn addcart-link"><i class="icon icon-cart"></i><span>В корзину</span></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="descr-block">-->
<!--                            <a href="#" class="product-name">Жакет женский</a>-->
<!--                            <span class="product-price">-->
<!--                                <span class="oldprice">1 749 ₽</span>-->
<!--                                <span class="price">1 749 ₽</span>-->
<!--                                </span>-->
<!--                            <div class="product-colors"></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="slide-item swiper-slide">-->
<!--                        <div class="image-block">-->
<!--                            <a href="#" class="product-link">-->
<!--                                <img src="images/main/main_page/catalogs/product_image33.jpg" alt="product" class="product-image">-->
<!--                            </a>-->
<!--                            <div class="product-btns">-->
<!--                                <a href="#" class="product-btn favorite-link"><i class="icon icon-heart"></i></a>-->
<!--                                <a href="#" class="product-btn addcart-link"><i class="icon icon-cart"></i><span>В корзину</span></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="descr-block">-->
<!--                            <a href="#" class="product-name">Жакет женский</a>-->
<!--                            <span class="product-price">-->
<!--                                <span class="oldprice">1 749 ₽</span>-->
<!--                                <span class="price">1 749 ₽</span>-->
<!--                                </span>-->
<!--                            <div class="product-colors">-->
<!--                                <span class="product-colors__all">+19 цветов</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="slide-item swiper-slide">-->
<!--                        <div class="image-block">-->
<!--                            <a href="#" class="product-link">-->
<!--                                <img src="images/main/main_page/catalogs/product_image32.jpg" alt="product" class="product-image">-->
<!--                            </a>-->
<!--                            <div class="product-btns">-->
<!--                                <a href="#" class="product-btn favorite-link"><i class="icon icon-heart"></i></a>-->
<!--                                <a href="#" class="product-btn addcart-link"><i class="icon icon-cart"></i><span>В корзину</span></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="descr-block">-->
<!--                            <a href="#" class="product-name">Жакет женский</a>-->
<!--                            <span class="product-price">-->
<!--                                <span class="oldprice">1 749 ₽</span>-->
<!--                                <span class="price">1 749 ₽</span>-->
<!--                                </span>-->
<!--                            <div class="product-colors"></div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="slide-item swiper-slide">-->
<!--                        <div class="image-block">-->
<!--                            <a href="#" class="product-link">-->
<!--                                <img src="images/main/main_page/catalogs/product_image31.jpg" alt="product" class="product-image">-->
<!--                            </a>-->
<!--                            <div class="product-btns">-->
<!--                                <a href="#" class="product-btn favorite-link"><i class="icon icon-heart"></i></a>-->
<!--                                <a href="#" class="product-btn addcart-link"><i class="icon icon-cart"></i><span>В корзину</span></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="descr-block">-->
<!--                            <a href="#" class="product-name">Жакет женский</a>-->
<!--                            <span class="product-price">-->
<!--                                <span class="oldprice">1 749 ₽</span>-->
<!--                                <span class="price">1 749 ₽</span>-->
<!--                                </span>-->
<!--                            <div class="product-colors">-->
<!--                                <span class="product-colors__all">+19 цветов</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="swiper-navigation">-->
<!--                    <div class="nav-btn btn-prev"><i class="icon icon-slider_arrow"></i></div>-->
<!--                    <div class="nav-btn btn-next"><i class="icon icon-slider_arrow"></i></div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="swiper-pagination"></div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->




<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
