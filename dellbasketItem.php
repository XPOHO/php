<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule('sale');

use Bitrix\Sale;


header('Content-Type: application/json');
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();


$productId = $request->getPost("prod");
$quantity = $request->getPost("quantity");
$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());


if ($item = $basket->getExistsItem('catalog', $productId)) {
    $item->setField('QUANTITY', $item->getQuantity() - 1);
}
$basket->save();