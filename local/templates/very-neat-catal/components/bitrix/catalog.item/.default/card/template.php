<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */


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


$IDHighload = 2;
$hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($IDHighload)->fetch();
$hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
$hlDataClass = $hldata["NAME"] . "Table";
$mainColor = "";
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
//print_r($arCart);
//print_r($morePhoto);
$articl = $item["PROPERTIES"]["ARTNUMBER"];
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
<div class="image-block">
    <div class="colors-slider-catalog swiper">
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
                    <img src="<?= $itemCart['img'] ?>" alt="<?= $itemCart['code'] ?>" class="product-image">
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
        <a style="cursor: pointer" data-item="<?= $item['ID'] ?>" class="product-btn favorite-link <?

        if (isset($favoritesAr[$item['ID']])) {
            echo "active";
        }

        ?>"><i class="icon icon-heart"></i></a>
        <a onclick="window._$productModal.showProductById('<?= $item["ID"] ?>');" style="cursor: pointer" data-idProd="<?= $item["ID"] ?>"
           class="product-btn addcart-link"><i class="icon icon-cart"></i><span>Подробнее</span></a>
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
                        <span class="price">

                            <?

                            if (!empty($salePrice)) {

                                echo "$salePrice ₽";

                            }

                            ?>
                        </span>
                        </span>
    <div class="product-colors">
        <div class="colors-pagination"></div>

        <?
        if (!empty($plusColor)) {
            ?>
            <span class="product-colors__all">+ <?
                echo num_word($plusColor, ["Цвет", "Цвета", "Цветов"]);
                ?></span>
            <?
        }
        ?>
    </div>
</div>
