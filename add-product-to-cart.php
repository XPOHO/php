<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule('sale');

use Bitrix\Sale;


header('Content-Type: application/json');
//$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

//$productId = $request->getPost("id");
//$sizeGet = $request->getPost("size");
$json = \Bitrix\Main\HttpRequest::getInput();
$arr = \Bitrix\Main\Web\Json::decode($json);



    $arSelect = array("ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PICTURE", "PROPERTY_*");
    $arFilter = array("IBLOCK_ID" => 3, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "PROPERTY_CML2_LINK" => $arr['id'], "PROPERTY_SIZES_CLOTHES_VALUE" => $arr['size']);

    $resOfferProd = CIblockElement::GetList(array("DATE_CREATE" => "DESC"), $arFilter, false, [], $arSelect);
    if ($obOfferProd = $resOfferProd->GetNextElement()) {
        $parem = $obOfferProd->GetFields();
        $productId=$parem["ID"];
    }

    $basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());


    if ($item = $basket->getExistsItem('catalog', $productId)) {
        $item->setField('QUANTITY', $item->getQuantity() + 1);
    } else {
        $item = $basket->createItem('catalog', $productId);
        $item->setFields(array(
            'QUANTITY' => 1,
            'CURRENCY' => Bitrix\Currency\CurrencyManager::getBaseCurrency(),
            'LID' => Bitrix\Main\Context::getCurrent()->getSite(),
            'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
        ));

}
$basket->save();
echo '{ "result": "Товар добавлен в корзину" }';