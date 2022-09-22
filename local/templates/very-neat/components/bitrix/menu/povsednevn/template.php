<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)):

   // echo "<pre>";
   // print_r($arResult);
    //echo "</pre>";
    ?>
    <ul class="subcategories-list show" data-category="category1">


        <?


        if (!empty($arResult)):?>
            <? function getItems($a)
            {
                foreach ($a as $arItem):?>

                <?
                    if ($arItem["TEXT"]=="Одежда для дома"){continue;}
                    ?>

                    <li class="subcategories-list__item submenu">
                    <a href="<?=$arItem["LINK"]?>" class="subcategories-list__link <?=$arItem["SELECTED"] ? ' active' : '' ?>"><?= $arItem["TEXT"] ?></a>

                    <? if ($arItem["IS_PARENT"]): ?>
                        <div class="submenu-wrapper">
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

            getItems($arResult); ?>
        <? endif ?>


    </ul>
<? endif ?>


<!--<ul class="subcategories-list show" data-category="category1">-->
<!--    <li class="subcategories-list__item submenu">-->
<!--        <a href="#" class="subcategories-list__link active">Новинки</a>-->
<!--        <div class="submenu-wrapper show">-->
<!--            <ul class="submenu-list">-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Базовый гардероб</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Вся одежда</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Куртки и жилеты</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Платья и комбинезоны</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link active">Брюки и шорты</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Джинсы</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Топы и боди</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Футболки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Жакеты</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Рубашки и блузы</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Толстовки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Юбки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Шапки, шарфы, перчатки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Белье</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Купальники</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </li>-->
<!--    <li class="subcategories-list__item submenu">-->
<!--        <a href="#" class="subcategories-list__link">Одежда</a>-->
<!--        <div class="submenu-wrapper">-->
<!--            <ul class="submenu-list">-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Новинки list</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Базовый гардероб</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Вся одежда</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Куртки и жилеты</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </li>-->
<!--    <li class="subcategories-list__item submenu">-->
<!--        <a href="#" class="subcategories-list__link">Аксессуары</a>-->
<!--        <div class="submenu-wrapper">-->
<!--            <ul class="submenu-list">-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Новинки list</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Базовый гардероб</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Вся одежда</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Куртки и жилеты</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Платья и комбинезоны</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Брюки и шорты</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Джинсы</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Топы и боди</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Футболки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Жакеты</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Рубашки и блузы</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Толстовки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Юбки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Шапки, шарфы, перчатки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Белье</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Купальники</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </li>-->
<!--    <li class="subcategories-list__item submenu">-->
<!--        <a href="#" class="subcategories-list__link">Дисконт</a>-->
<!--        <div class="submenu-wrapper">-->
<!--            <ul class="submenu-list">-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Новинки list</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Базовый гардероб</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Вся одежда</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Куртки и жилеты</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Платья и комбинезоны</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Брюки и шорты</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Джинсы</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Топы и боди</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Футболки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Жакеты</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Рубашки и блузы</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Толстовки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Юбки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Шапки, шарфы, перчатки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Белье</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Купальники</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </li>-->
<!--    <li class="subcategories-list__item submenu">-->
<!--        <a href="#" class="subcategories-list__link">Коллекции</a>-->
<!--        <div class="submenu-wrapper">-->
<!--            <ul class="submenu-list">-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Новинки list</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Базовый гардероб</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Вся одежда</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Куртки и жилеты</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Платья и комбинезоны</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Брюки и шорты</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Джинсы</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Топы и боди</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Футболки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Жакеты</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Рубашки и блузы</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Толстовки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Юбки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Шапки, шарфы, перчатки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Белье</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Купальники</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </li>-->
<!--    <li class="subcategories-list__item submenu">-->
<!--        <a href="#" class="subcategories-list__link">Вдохновение</a>-->
<!--        <div class="submenu-wrapper">-->
<!--            <ul class="submenu-list">-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Новинки list</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Базовый гардероб</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Вся одежда</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Куртки и жилеты</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Платья и комбинезоны</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Брюки и шорты</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Джинсы</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Топы и боди</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Футболки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Жакеты</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Рубашки и блузы</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Толстовки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Юбки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Шапки, шарфы, перчатки</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Белье</a></li>-->
<!--                <li class="submenu-list__item"><a href="#" class="submenu-list__link">Купальники</a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </li>-->
<!--</ul>-->
