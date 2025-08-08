<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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


$this->addExternalCss($this->GetFolder().'/bitrix/components/bitrix/news.list/templates/my_template/assets/css/common.css');
?>

<?php if (!empty($arResult["ITEMS"])): ?>
    <div id="barba-wrapper">
        <div class="article-list">
            <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                
                
                $imgSrc = !empty($arItem['PREVIEW_PICTURE']['SRC']) 
                    ? $arItem['PREVIEW_PICTURE']['SRC'] 
                    : $this->GetFolder().'/bitrix/components/bitrix/news.list/templates/my_template/assets/images/article-item-bg-1.jpg';
                
                $imgAlt = !empty($arItem['PREVIEW_PICTURE']['ALT']) 
                    ? $arItem['PREVIEW_PICTURE']['ALT'] 
                    : htmlspecialcharsbx($arItem['NAME']);
                ?>
                
                <a 
                    class="article-item article-list__item" 
                    href="<?= $arItem['DETAIL_PAGE_URL'] ?>" 
                    data-anim="anim-3"
                    id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
                >
                    <div class="article-item__background">
                        <img 
                            src="<?= $imgSrc ?>" 
                            alt="<?= $imgAlt ?>"
                        />
                    </div>
                    <div class="article-item__wrapper">
                        <div class="article-item__title"><?= $arItem['NAME'] ?></div>
                        <?php if ($arItem['PREVIEW_TEXT']): ?>
                            <div class="article-item__content">
                                <?= $arItem['PREVIEW_TEXT'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-info">Новости не найдены.</div>
<?php endif; ?>