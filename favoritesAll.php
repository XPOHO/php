<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");


$GLOBALS['APPLICATION']->RestartBuffer();


use Bitrix\Main\Application;
use Bitrix\Main\Web\Cookie;

$application = \Bitrix\Main\Application::getInstance();
$context = $application->getContext();
/* Избранное */
global $APPLICATION;

$strError='';
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

    if (!$USER->IsAuthorized()) // Для неавторизованного
    {


        $cookieValue = $request->getCookie("favorites");
        $arElements = "";

        $cookie = new \Bitrix\Main\Web\Cookie("favorites", serialize($arElements), time() + 86400 * 30);
        $cookie->setSpread(\Bitrix\Main\Web\Cookie::SPREAD_DOMAIN); // распространять куки на все домены

        $cookie->setSecure(false); // безопасное хранение cookie
        $cookie->setHttpOnly(false);

        \Bitrix\Main\Application::getInstance()->getContext()->getResponse()->addCookie($cookie);
        $cookieValue = $request->getCookie("favorites");
        $context->getResponse()->writeHeaders("");
    } else { // Для авторизованного
        $idUser = $USER->GetID();
        $rsUser = CUser::GetByID($idUser);
        $arUser = $rsUser->Fetch();
        $arElements = [];
        $USER->Update($idUser, array("UF_FAVORITES" => $arElements)); // Добавляем элемент в избранное
        $strError .= $USER->LAST_ERROR;
        var_dump($strError);
    }
$result=2;
/* Избранное */
echo json_encode($result);
die(); ?>
<!--?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?-->
