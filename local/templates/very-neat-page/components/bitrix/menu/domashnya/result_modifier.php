<?php
$menuList = array();
$lev = 0;
$lastInd = 0;
$parents = array();
foreach ($arResult as $arItem) {

    $arItem["TEXT"] = str_replace("женский", "", $arItem["TEXT"]);
    $arItem["TEXT"] = str_replace("женская", "", $arItem["TEXT"]);
    $arItem["TEXT"] = str_replace("женские", "", $arItem["TEXT"]);
    $arItem["TEXT"] = str_replace("жен", "", $arItem["TEXT"]);

    $lev = $arItem['DEPTH_LEVEL'];

    if ($arItem['IS_PARENT']) {
        $arItem['CHILDREN'] = array();
    }

    if ($lev == 1) {
        $menuList[] = $arItem;
        $lastInd = count($menuList)-1;
        $parents[$lev] = &$menuList[$lastInd];
    } else {
        $parents[$lev-1]['CHILDREN'][] = $arItem;
        $lastInd = count($parents[$lev-1]['CHILDREN'])-1;
        $parents[$lev] = &$parents[$lev-1]['CHILDREN'][$lastInd];
    }
}
$arResult = $menuList;