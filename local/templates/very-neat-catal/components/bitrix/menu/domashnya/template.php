<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)):

  //  echo "<pre>";
  // print_r($arResult);
   // echo "</pre>";
    ?>
    <ul class="subcategories-list" data-category="category2">
        <?
        if (!empty($arResult)):?>
            <? function getItemsDom($a)
            {
                foreach ($a as $arItem):?>
                <?
                    if (trim($arItem["TEXT"])=="Повседневная одежда"){continue;}
                    ?>
                    <li class="subcategories-list__item submenu">
                    <a href="<?=$arItem["LINK"]?>" class="subcategories-list__link <?=$arItem["SELECTED"] ? ' active' : '' ?>"><?= $arItem["TEXT"] ?></a>

                    <? if ($arItem["IS_PARENT"]): ?>
                        <div class="submenu-wrapper show">
                            <ul class="submenu-list">
                                <?
                                foreach ($arItem["CHILDREN"] as $item){
                                   ?>
                                    <li class="submenu-list__item"><a href="<?=$item["LINK"]?>" class="submenu-list__link"><?= $item["TEXT"] ?></a></li>
                                    <?
                                }
                              ?>
                            </ul>
                        </div>
                    <? endif ?>
                    </li>
                <?endforeach;
            }
            getItemsDom($arResult); ?>
        <? endif ?>
    </ul>
<? endif ?>
