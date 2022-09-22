<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");


$GLOBALS['APPLICATION']->RestartBuffer();


use Bitrix\Main\Application;
use Bitrix\Main\Web\Cookie;

$application = \Bitrix\Main\Application::getInstance();
$context = $application->getContext();
/* Избранное */
global $APPLICATION;


$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

if ($_GET['id']) {


    if (!$USER->IsAuthorized()) // Для неавторизованного
    {


        $cookieValue = $request->getCookie("favorites");
        $arElements = unserialize($APPLICATION->get_cookie('favorites'));
        if (!in_array($_GET['id'], $arElements)) {
            $arElements[] = $_GET['id'];
            $result = 1; // Датчик. Добавляем
        } else {
            $key = array_search($_GET['id'], $arElements); // Находим элемент, который нужно удалить из избранного
            unset($arElements[$key]);
            $result = 2; // Датчик. Удаляем
        }

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
        $arElements = $arUser['UF_FAVORITES'];  // Достаём избранное пользователя
        if (!in_array($_GET['id'], $arElements)) // Если еще нету этой позиции в избранном
        {
            $arElements[] = $_GET['id'];
            $result = 1;
        } else {
            $key = array_search($_GET['id'], $arElements); // Находим элемент, который нужно удалить из избранного
            unset($arElements[$key]);
            $result = 2;
        }
        $USER->Update($idUser, array("UF_FAVORITES" => $arElements)); // Добавляем элемент в избранное
    }
}
/* Избранное */
echo json_encode($result);
die(); ?>
<!--?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?-->
