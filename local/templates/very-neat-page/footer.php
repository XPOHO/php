<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<footer class="footer">
    <div class="container">









        <div class="footer__menu">
            <div class="footer__menu__column">
                <span class="column-title">Помощь</span>
                <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"menuFooterSectino", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "footerHelp",
		"DELAY" => "N",
		"MAX_LEVEL" => "2",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "footerHelp",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "menuFooterSectino"
	),
	false
);?>
            </div>
            <div class="footer__menu__column">
                <span class="column-title">Каталог</span>

                <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"menuFooterSectino", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "footerCatalog",
		"DELAY" => "N",
		"MAX_LEVEL" => "2",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "footerCatalog",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "menuFooterSectino"
	),
	false
);?>
            </div>
            <div class="footer__menu__column">
                <span class="column-title">Компания</span>
                <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"menuFooterSectino", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "footerCompany",
		"DELAY" => "N",
		"MAX_LEVEL" => "2",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "footerCompany",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "menuFooterSectino"
	),
	false
);?>
            </div>
        </div>
        <a id="lang-link" href="javascript:void(0);" class="lang-link">Язык: <span>Русский</span></a>
    </div>
    <div class="copyright">
        <div class="container">
            <p>© Copyright 2022 very neat. All Rights reserved. <a href="#">Условия пользования сайтом</a></p>
        </div>
    </div>
    <a href="javascript:void(0);" id="scrlBtn" class="scroll-btn" style="transform: translateY(100px)"><i class="icon icon-select_arrow"></i></a>
</footer>
<div class="modal modal-sizes-table" id="modal-sizes" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true">
            <header class="modal__header">
                <h2 class="modal__title">Таблица размеров</h2>
                <button class="modal__close" aria-label="Close modal" data-micromodal-close><i class="icon icon-size_backarrow"></i></button>
            </header>
            <main class="modal__content">
                <table class="sizes-table" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>xs</td>
                        <td>42</td>
                        <td>84/164-170</td>
                    </tr>
                    <tr>
                        <td>S</td>
                        <td>42</td>
                        <td>84/164-170</td>
                    </tr>
                    <tr>
                        <td>M</td>
                        <td>42</td>
                        <td>84/164-170</td>
                    </tr>
                    <tr>
                        <td>L</td>
                        <td>42</td>
                        <td>84/164-170</td>
                    </tr>
                    <tr>
                        <td>XL</td>
                        <td>42</td>
                        <td>84/164-170</td>
                    </tr>
                    <tr>
                        <td>2XL</td>
                        <td>42</td>
                        <td>84/164-170</td>
                    </tr>
                    <tr>
                        <td>3XL</td>
                        <td>42</td>
                        <td>84/164-170</td>
                    </tr>
                    <tr>
                        <td>4XL</td>
                        <td>42</td>
                        <td>84/164-170</td>
                    </tr>
                </table>
                <table class="sizes-parameters" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>Параметры</td>
                        <td>42</td>
                        <td>44</td>
                        <td>46</td>
                        <td>48</td>
                        <td>50</td>
                        <td>52</td>
                    </tr>
                    <tr>
                        <td>Полуобхват груди</td>
                        <td>42</td>
                        <td>44</td>
                        <td>46</td>
                        <td>48</td>
                        <td>50</td>
                        <td>52</td>
                    </tr>
                    <tr>
                        <td>Длина рукава</td>
                        <td>42</td>
                        <td>44</td>
                        <td>46</td>
                        <td>48</td>
                        <td>50</td>
                        <td>52</td>
                    </tr>
                    <tr>
                        <td>Длина по центру спинки</td>
                        <td>42</td>
                        <td>44</td>
                        <td>46</td>
                        <td>48</td>
                        <td>50</td>
                        <td>52</td>
                    </tr>
                    <tr>
                        <td>Длина плеча</td>
                        <td>42</td>
                        <td>44</td>
                        <td>46</td>
                        <td>48</td>
                        <td>50</td>
                        <td>52</td>
                    </tr>
                </table>
                <p class="info">Рукава измеряются: реглан — от воротника, втачной — от плечевого шва</p>
            </main>
        </div>
    </div>
</div>
<div class="modal modal-cities" id="modal-cities" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
                <h2 class="modal__title">Выберите ваш город</h2>
                <button class="modal__close" aria-label="Close modal" data-micromodal-close><i class="icon icon-size_backarrow"></i></button>
            </header>
            <main class="modal__content">
                <form action="" class="search-form">
                    <div class="input-group">
                        <input type="text" name="search-input" placeholder="Поиск города">
                    </div>
                </form>
                <ul class="cities-list">
                    <li class="cities-list__item"><a href="#" class="cities-list__link">Санкт-петербург</a></li>
                    <li class="cities-list__item"><a href="#" class="cities-list__link">Москва</a></li>
                    <li class="cities-list__item"><a href="#" class="cities-list__link">Екатеринбург</a></li>
                    <li class="cities-list__item"><a href="#" class="cities-list__link">Краснодар</a></li>
                    <li class="cities-list__item"><a href="#" class="cities-list__link">Сочи</a></li>
                    <li class="cities-list__item"><a href="#" class="cities-list__link">Нижний новгород</a></li>
                    <li class="cities-list__item"><a href="#" class="cities-list__link">Самара</a></li>
                    <li class="cities-list__item"><a href="#" class="cities-list__link">Казань</a></li>
                    <li class="cities-list__item"><a href="#" class="cities-list__link">Новосибирск</a></li>
                    <li class="cities-list__item"><a href="#" class="cities-list__link">Уфа</a></li>
                    <li class="cities-list__item"><a href="#" class="cities-list__link">Красноярск</a></li>
                    <li class="cities-list__item"><a href="#" class="cities-list__link">Ростов-на-дону</a></li>
                    <li class="cities-list__item"><a href="#" class="cities-list__link">Челябинск</a></li>
                    <li class="cities-list__item"><a href="#" class="cities-list__link">Пермь</a></li>
                    <li class="cities-list__item"><a href="#" class="cities-list__link">Воронеж</a></li>
                    <li class="cities-list__item"><a href="#" class="cities-list__link">Саратов</a></li>
                    <li class="cities-list__item"><a href="#" class="cities-list__link">Иркутск</a></li>
                    <li class="cities-list__item"><a href="#" class="cities-list__link">Тюмень</a></li>
                </ul>
            </main>
        </div>
    </div>
</div>
<div class="modal modal-pass" id="modal-changepass" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
                <button class="modal__close" aria-label="Close modal" data-micromodal-close><i class="icon icon-size_backarrow"></i></button>
            </header>
            <main class="modal__content">
                <form action="" class="change-pass">
                    <div class="input-group">
                        <label>
                            <span class="label-name">Новый пароль*</span>
                            <input type="password" name="pass" class="input-style required" required>
                        </label>
                    </div>
                    <div class="input-group">
                        <label>
                            <span class="label-name">Пароль еще раз*</span>
                            <input type="text" name="pass_comfirm" class="input-style required" required>
                        </label>
                    </div>
                    <div class="input-group btn-group">
                        <button type="submit" class="btn-fill-style">Сменить пароль</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
</div>
<div class="modal modal-delete-product" id="modal-delete" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
                <h2 class="modal__title">Удалить товар из корзины?</h2>
                <button class="modal__close" aria-label="Close modal" data-micromodal-close><i class="icon icon-size_backarrow"></i></button>
            </header>
            <main class="modal__content">
                <a href="#" class="favorite-link btn-fill-style">Перенести в избранное</a>
                <a href="#" class="delete-link btn-outline-style">Удалить</a>
            </main>
        </div>
    </div>
</div>
<div class="modal modal-remember-product" id="modal-remember" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true">
            <header class="modal__header">
                <button class="modal__close" aria-label="Close modal" data-micromodal-close><i class="icon icon-size_backarrow"></i></button>
            </header>
            <main class="modal__content">
                <h2 class="modal__title">ПОЖАЛУЙСТА, СООБЩИТЕ МНЕ, КОГДА БУДЕТ ДОСТУПЕН МОЙ РАЗМЕР</h2>
                <p class="modal__subtitle">Если ваш размер станет доступен, мы уведомим вас по электронной почте. К сожалению, не все стили будут доступны после распродажи.</p>
                <div class="product-price">
                    <span class="price-title">Цена</span>
                    <span class="oldprice">1 199 ₽</span>
                    <span class="price">1 199 ₽</span>
                </div>
                <form action="" class="remember-form">
                    <div class="input-group">
                        <label>
                            <span class="label-name">Выберите свой размер</span>
                            <select name="size" class="choice-select">
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                            </select>
                        </label>
                    </div>
                    <div class="input-group">
                        <label>
                            <span class="label-name">ФИО*</span>
                            <input type="text" name="name" class="input-style name-input required" required>
                        </label>
                    </div>
                    <div class="input-group">
                        <label>
                            <span class="label-name">E-mail*</span>
                            <input type="email" name="mail" class="input-style required" required>
                        </label>
                    </div>
                    <div class="input-group btn-group">
                        <button type="submit" class="btn-fill-style">Отправить</button>
                    </div>
                </form>
            </main>
        </div>
    </div>
</div>
<div class="modal modal-product" id="modal-product" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <button class="modal__close" aria-label="Close modal" data-micromodal-close><i class="icon icon-close"></i></button>
            <main class="modal__content">
                <div class="modal__content__left-side">
                    <img src="<?=DEFAULT_TEMPLATE_PATH?>/images/main/modal_image.jpg" alt="product-image" class="product-image">
                    <a href="#" class="product-btn favorite-link"><i class="icon icon-heart_fill"></i></a>
                </div>
                <div class="modal__content__right-side">
                    <h2 class="product-title">Жакет женский</h2>
                    <span class="article">АРТ 7002950M</span>
                    <div class="product-price">
                        <span class="price-title">Цена</span>
                        <span class="oldprice">1 199 ₽</span>
                        <span class="price">1 199 ₽</span>
                    </div>
                    <div class="product-properties">
                        <div class="product-properties__item properties-style">
                            <span class="property-name">Стиль</span>
                            <span class="property-value">Платье</span>
                        </div>
                        <div class="product-properties__item properties-consist">
                            <span class="property-name">Состав</span>
                            <span class="property-value">Шерсть</span>
                        </div>
                        <div class="product-properties__item properties-size">
                            <span class="property-name">Размер</span>
                            <div class="input-row">
                                <div class="input-group">
                                    <label>
                                        <input type="radio" name="size" value="M">
                                        <span>M</span>
                                    </label>
                                </div>
                                <div class="input-group">
                                    <label>
                                        <input type="radio" name="size" value="L" checked>
                                        <span>L</span>
                                    </label>
                                </div>
                                <div class="input-group">
                                    <label>
                                        <input type="radio" name="size" value="XL">
                                        <span>XL</span>
                                    </label>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="size-table-link">Таблица размеров</a>
                        </div>
                        <div class="product-properties__item properties-color">
                            <span class="property-name">Цвет</span>
                            <span class="property-value color-value"><span style="background-color: #F3DE6E;"></span>Белый</span>
                        </div>
                        <div class="product-properties__item properties-color-list">
                            <span class="property-name">Другой цвет</span>
                            <div class="input-row">
                                <div class="input-group">
                                    <label>
                                        <input type="radio" name="color" value="Желтый">
                                        <span class="color-item" style="background-color: #F3DE6E;"></span>
                                    </label>
                                </div>
                                <div class="input-group">
                                    <label>
                                        <input type="radio" name="color" value="Желтый">
                                        <span class="color-item" style="background-color: #D1A5A5;"></span>
                                    </label>
                                </div>
                                <div class="input-group">
                                    <label>
                                        <input type="radio" name="color" value="Желтый">
                                        <span class="color-item" style="background-color: #C8D1A5;"></span>
                                    </label>
                                </div>
                                <div class="input-group">
                                    <label>
                                        <input type="radio" name="color" value="Желтый">
                                        <span class="color-item" style="background-color: #A5CED1;"></span>
                                    </label>
                                </div>
                                <div class="input-group">
                                    <label>
                                        <input type="radio" name="color" value="Желтый">
                                        <span class="color-item" style="background-color: #B0A5D1;"></span>
                                    </label>
                                </div>
                                <div class="input-group">
                                    <label>
                                        <input type="radio" name="color" value="Белый" checked>
                                        <span class="color-item" style="background-color: #F3DE6E;"></span>
                                    </label>
                                </div>
                                <div class="input-group">
                                    <label>
                                        <input type="radio" name="color" value="Желтый">
                                        <span class="color-item" style="background-color: #565656;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="addform-group">
                        <div class="input-group btn-group">
                            <button type="submit" class="btn-fill-style">Добавить в корзину</button>
                            <a href="#" class="more-info btn-outline-style">Подробнее о товаре</a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
<div id="cookie-modal" class="cookie-modal" style="transform: translateX(100vw);">
    <div class="modal__content">
        <h3 class="modal-title">Этот сайт использует cookies</h3>
        <div class="modal-info">
            <p>We use cookies to personalise content and ads, to provide social media features and to analyse our traffic if you have given your consent.</p>
        </div>
        <div class="modal-btn">
            <a href="javascript:void(0);" id="cookie-close" class="cookie-close-btn btn-outline-style">Понятно</a>
        </div>
    </div>
</div>
<!-- styles -->
<!-- js -->

</body>
</html>
