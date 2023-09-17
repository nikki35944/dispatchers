<?php
use Webkit\Helper\objectsComponent;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Демонстрационная версия продукта «1С-Битрикс: Управление сайтом»");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Главная страница");

CModule::IncludeModule('webkit');
$res = new objectsComponent();
echo '<pre>';
print_r($res->var1());
echo '</pre>';
?>




<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>