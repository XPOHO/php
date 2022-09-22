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


<main class="mpage-main">
    <div id="main-slider" class="main-slider swiper">
        <div class="swiper-wrapper">

            <? foreach ($arResult["ITEMS"] as $ITEM) {

                $pkFoto = "";
                $padFoto = "";
                $mobFoto = "";
                $video = "";
                $arSelect = array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
                $arFilter = array("IBLOCK_ID" => IntVal(4), "ACTIVE_DATE" => "Y", "ACTIVE" => "Y", "ID" => $ITEM["ID"]);
                $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 50), $arSelect);
                if ($ob = $res->GetNextElement()) {
                    $arProps = $ob->GetProperties();
                    $pkFoto=CFile::GetPath($arProps["PK_FOTO"]["VALUE"]);
                    $padFoto=CFile::GetPath($arProps["PLAN_FOTO"]["VALUE"]);
                    $mobFoto=CFile::GetPath($arProps["MOBILE_FOTO"]["VALUE"]);
                    $video=CFile::GetPath($arProps["VIDEO"]["VALUE"]);


            $this->AddEditAction($ITEM['ID'], $ITEM['EDIT_LINK'], CIBlock::GetArrayByID($ITEM["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($ITEM['ID'], $ITEM['DELETE_LINK'], CIBlock::GetArrayByID($ITEM["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?><?



            if (empty($arProps["VIDEO"]["VALUE"])){

                      ?>
                        <div id="<?=$this->GetEditAreaId($ITEM['ID']);?>" class="slide-item swiper-slide lazyload"
                             data-bgset="<?= $mobFoto ?> [(max-width: 575px)] | <?= $padFoto ?> [(max-width: 1024px)] | <?= $pkFoto ?> [(min-width: 1025px)]">
                            <div class="container">
                                <div class="slide-info">
                                    <h2 class="slide-title"><?= $ITEM["NAME"] ?></h2>
                                    <h3 class="slide-subtitle"><?= $ITEM["PREVIEW_TEXT"] ?></h3>
                                </div>
                                <div class="slide-links">
                                    <a href="#" class="slide-btn">Повседневная одежда</a>
                                    <a href="#" class="slide-btn">Домашняя одежда</a>
                                </div>
                            </div>
                        </div>
                        <?
                    }
                    else{
                        ?>
                        <div id="<?=$this->GetEditAreaId($ITEM['ID']);?>" class="slide-item swiper-slide video-slide">
                            <div class="video-wrapper">
                                <video class="video-item" autoplay="autoplay" loop="loop" muted="muted" playsinline="1" preload="1"
                                       poster="">
                                    <source src="<?= $video ?>" type="video/mp4">
                                </video>
                            </div>
                            <div class="container">
                                <div class="slide-info">
                                    <h2 class="slide-title"><?= $ITEM["NAME"] ?></h2>
                                    <h3 class="slide-subtitle"><?= $ITEM["PREVIEW_TEXT"] ?></h3>
                                </div>
                                <div class="slide-links">
                                    <a href="#" class="slide-btn">Повседневная одежда</a>
                                    <a href="#" class="slide-btn">Домашняя одежда</a>
                                </div>
                            </div>
                        </div>
                        <?
                    }
                }
                ?>
            <? } ?>

        </div>
        <div class="swiper-pagination"></div>
    </div>
</main>