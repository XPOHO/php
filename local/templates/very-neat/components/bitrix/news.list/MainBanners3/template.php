<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?
foreach ($arResult["ITEMS"] as $item) {
    $whiteSlide = '';
    $this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    $srcPK = CFile::GetPath($item["PROPERTIES"]["PK_FOTO"]['VALUE']);
    $srcPlan = CFile::GetPath($item["PROPERTIES"]["PLAN_FOTO"]['VALUE']);
    $srcMob = CFile::GetPath($item["PROPERTIES"]["MOBILE_FOTO"]['VALUE']);
    switch ($item["PROPERTIES"]["TYPE_SLIDE"]['VALUE_ENUM_ID']) {
        case 83:
            $whiteSlide = "white-slide";
            break;
        case 82:
            $whiteSlide = "";
            break;
    }
    if ($item["PROPERTIES"]["FORMAT_FOTO"]['VALUE_ENUM_ID'] == 73) {
        if ($item["PROPERTIES"]["TEXT_FORMAT"]['VALUE_ENUM_ID'] == 76) {
            ?>
            <section id="<?= $this->GetEditAreaId($item['ID']); ?>" class="mpage-banner full-banner center-style">
                <div class="banner-slide lazyloaded <?=$whiteSlide?>"
                     data-bgset="<?= $srcMob ?> [(max-width: 575px)] | <?= $srcPlan ?> [(max-width: 1079px)] | <?= $srcPK ?> [(min-width: 1080px)]"
                     style="background-image: url(&quot;<?= $srcPK ?>&quot;);">
                    <div class="container">
                        <h3 class="banner-subtitle"><?= $item["PROPERTIES"]["SMOLL_TEXT"]['VALUE'] ?></h3>
                        <h2 class="banner-title"><?= $item["PROPERTIES"]["BIG_TEXT"]['VALUE'] ?></h2>
                        <div class="banner-btns inline-btns">
                            <a href="<?= $item["PROPERTIES"]["HREF"]['VALUE'] ?>" class="banner-link  <?
                            switch ($item["PROPERTIES"]["TYPE_BUTTON"]['VALUE_ENUM_ID']) {
                                case 78:
                                    echo "btn-outline-style";
                                    break;
                                case 79:
                                    echo "btn-outline-style white-style";
                                    break;
                                case 80:
                                    echo "btn-fill-style";
                                    break;
                                case 81:
                                    echo "btn-fill-style white-style";
                                    break;
                            }
                            ?>"><?= $item["PROPERTIES"]["TEXT_BUTTON"]['VALUE'] ?></a>
                        </div>
                    </div>
                    <picture style="display: none;">
                        <source data-srcset="<?= $srcMob ?>"
                                media="(max-width: 575px)"
                                srcset="<?= $srcMob ?>">
                        <source data-srcset="<?= $srcPlan ?>"
                                media="(max-width: 1079px)"
                                srcset="<?= $srcPlan ?>">
                        <source data-srcset="<?= $srcPK ?>"
                                media="(min-width: 1080px)"
                                srcset="<?= $srcPK ?>">
                        <img alt="" class="lazyloaded ls-is-cached"></picture>
                </div>
            </section>
            <?
        } else {
            ?>
            <section id="<?= $this->GetEditAreaId($item['ID']); ?>" class="mpage-banner full-banner<?
            ?>">
                <div class="banner-slide <?= $whiteSlide ?> lazyload"
                     data-bgset="<?= $srcMob ?> [(max-width: 575px)] | <?= $srcPlan ?> [(max-width: 1079px)] | <?= $srcPK ?> [(min-width: 1080px)]">
                    <div class="container">
                        <div class="banner-wrapper">
                            <h3 class="banner-subtitle"><?= $item["PROPERTIES"]["SMOLL_TEXT"]['VALUE'] ?></h3>
                            <h2 class="banner-title"><?= $item["PROPERTIES"]["BIG_TEXT"]['VALUE'] ?></h2>
                            <div class="banner-btns">
                                <a href="<?= $item["PROPERTIES"]["HREF"]['VALUE'] ?>" class="banner-link
                         <?
                                switch ($item["PROPERTIES"]["TYPE_BUTTON"]['VALUE_ENUM_ID']) {
                                    case 78:
                                        echo "btn-outline-style";
                                        break;
                                    case 79:
                                        echo "btn-outline-style white-style";
                                        break;
                                    case 80:
                                        echo "btn-fill-style";
                                        break;
                                    case 81:
                                        echo "btn-fill-style white-style";
                                        break;
                                }
                                ?>"><?= $item["PROPERTIES"]["TEXT_BUTTON"]['VALUE'] ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?
        }
    } else {
        ?>
        <section id="<?= $this->GetEditAreaId($item['ID']); ?>" class="mpage-banner side-banner  <?
        if ($item["PROPERTIES"]["FORMAT_FOTO"]['VALUE_ENUM_ID'] == 75) {
            echo "reverse-style";
        }
        ?>">
            <div class="banner-slide <?= $whiteSlide ?>">
                <div class="container">
                    <div class="banner-slide__info">
                        <h3 class="banner-subtitle"><?= $item["PROPERTIES"]["SMOLL_TEXT"]['VALUE'] ?></h3>
                        <h2 class="banner-title"><?= $item["PROPERTIES"]["BIG_TEXT"]['VALUE'] ?></h2>
                        <a href="<?= $item["PROPERTIES"]["HREF"]['VALUE'] ?>" class="banner-link <?
                        switch ($item["PROPERTIES"]["TYPE_BUTTON"]['VALUE_ENUM_ID']) {
                            case 78:
                                echo "btn-outline-style";
                                break;
                            case 79:
                                echo "btn-outline-style white-style";
                                break;
                            case 80:
                                echo "btn-fill-style";
                                break;
                            case 81:
                                echo "btn-fill-style white-style";
                                break;
                        }
                        ?>"><?= $item["PROPERTIES"]["TEXT_BUTTON"]['VALUE'] ?></a>
                    </div>
                    <div class="banner-slide__image lazyloaded"
                         data-bgset="<?= $srcMob ?> [(max-width: 575px)] | <?= $srcPlan ?> [(max-width: 1079px)] | <?= $srcPK ?> [(min-width: 1080px)]"
                         style="background-image: url(&quot;<?= $srcPK ?>&quot;);"
                    >
                        <picture style="display: none;">
                            <source data-srcset="<?= $srcMob ?>"
                                    media="(max-width: 575px)"
                                    srcset="<?= $srcMob ?>">
                            <source data-srcset="<?= $srcPlan ?>"
                                    media="(max-width: 1079px)"
                                    srcset="<?= $srcPlan ?>">
                            <source data-srcset="<?= $srcPK ?>"
                                    media="(min-width: 1080px)"
                                    srcset="<?= $srcPK ?>">
                            <img alt="" class="lazyloaded ls-is-cached"></picture>
                    </div>
                </div>
            </div>
        </section>
        <?php

    }
}
?>




