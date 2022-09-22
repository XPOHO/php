<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule('sale');
CModule::IncludeModule('highloadblock');

use Bitrix\Sale;

\Bitrix\Main\Loader::includeModule("catalog");
//header('Content-Type: application/json');
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$productId = $request->get("prod");
$IDHighload = 2;


if(!$USER->IsAuthorized()) // Для неавторизованного
{

    $request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
    $favCookie=    $request->getCookie('favorites');

    $arFavorites=  unserialize($favCookie);
    $favoritesAr=[];
    foreach ($arFavorites as $itemFav){
        $favoritesAr[$itemFav]=true;
    }
}
else{

    $idUser = $USER->GetID();
    $rsUser = CUser::GetByID($idUser);
    $arUser = $rsUser->Fetch();
    $arFavorites = $arUser['UF_FAVORITES'];  // Достаём избранное пользователя

    $favoritesAr=[];
    foreach ($arFavorites as $itemFav){
        $favoritesAr[$itemFav]=true;
    }

}

$hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($IDHighload)->fetch();
$hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
$hlDataClass = $hldata["NAME"] . "Table";
$arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL", "PROPERTY_*");
$arFilter = array("IBLOCK_ID" => 2, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "ID" => $productId);
$resProd = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
if ($obProd = $resProd->GetNextElement()) {
    $arFieldsProd = $obProd->GetFields();
    $title=$arFieldsProd['NAME'];
    $arPropsProd = $obProd->GetProperties();
    $idProd = $arFieldsProd["ID"];
    $code = $arFieldsProd["CODE"];
    $url = $arFieldsProd["DETAIL_PAGE_URL"];
    $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PICTURE", "PROPERTY_*");
    $arFilter = array("IBLOCK_ID" => 3, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_CML2_LINK" => $arFieldsProd["ID"]);
    $resOffer = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
    $Photo = "";
    $sizesArr = [];
    while ($obOffer = $resOffer->GetNextElement()) {
        $arFieldsOffer = $obOffer->GetFields();
      //  echo "<pre>";
        // print_r($arFieldsOffer);
       $test= CFile::GetPath($arFieldsOffer["DETAIL_PICTURE"]);
      // var_dump($test);
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
        if (empty($mainColor)) {
            $resultColor = $hlDataClass::getList(array(
                "select" => array("ID", "UF_NAME", "UF_XML_ID", "UF_COLORCOD"), // Поля для выборки
                "order" => array(),
                "filter" => array("UF_XML_ID" => $arProps["COLOR_REF"]['VALUE']),
            ));
            if ($resp = $resultColor->fetch()) {
                $mainColor = $resp['UF_COLORCOD'];
                $mainColorName = $resp['UF_NAME'];
            }
        }
    }
  //  echo "<pre>";
   // print_r($favoritesAr);
    if (isset($favoritesAr[$productId])){

        $favorite=true;

    }
 else{
     $favorite=false;
 }
    $arCart[] = [
        "id" => $idProd,
        "title" => $title,
        "art" => $arPropsProd['ARTNUMBER']['VALUE'],
        "year" => $arPropsProd['YEAR']['VALUE'],
        "polotno" => $arPropsProd['POLOTNO']['VALUE'],
        "season" => $arPropsProd['SEASON']['VALUE'],
        "favorite" => $favorite,
        "country" => $arPropsProd['COUNTRY']['VALUE'],
        "code" => $code,
        "img" => "$Photo",
        "color" => [
            'name' => $mainColorName,
            'code' => $mainColor
        ],
        "sizes" => $sizesArr,
        "href" => $url
    ];
    $Json = \Bitrix\Main\Web\Json::encode($arCart);
    echo $Json;
}