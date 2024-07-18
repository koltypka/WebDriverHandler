<?php

use WebDriverHandler\CD\Forms\LongtermRental;


require_once('vendor/autoload.php');

define('URL', 'https://google.com');

$forms = new LongtermRental();

echo 'open /longtermrental/' . PHP_EOL;
$forms->getNewPage(URL . '/longtermrental/');
echo 'LongtermRental list pop-up test' . PHP_EOL;
if (!$forms->checkFormPopUp(
    '.cd-header__body a[data-block="header"][data-href="rent-car-form"][data-type="longterm_form_open"]'
)) {
    echo 'FAIL pop up header' . PHP_EOL;
}

if (!$forms->checkFormPopUp(
    '.promo button[data-block="promo_banner"][data-href="rent-car-form"][data-type="longterm_form_open"]'
)) {
    echo 'FAIL pop-up promo' . PHP_EOL;
}

if (!$forms->checkFormPopUp(
    '#longtermrental-catalog button[data-block="catalog"][data-href="rent-car-form"][data-type="longterm_form_open_order_call"]'
)) {
    echo 'FAIL pop-up catalog' . PHP_EOL;
}

if (!$forms->checkFormPopUp(
    '#showroom button[data-block="contact"][data-href="rent-car-form"][data-type="longterm_form_open"]'
)) {
    echo 'FAIL pop-up contact' . PHP_EOL;
}

if (!$forms->checkFormPopUp(
    '.catalog__slider button[data-block="special"][data-href="rent-car-form"][data-type="longterm_form_open"]'
)) {
    echo 'FAIL pop-up special' . PHP_EOL;
};

echo 'open /msk/subscription/' . PHP_EOL;
$forms->getNewPage(URL . '/msk/subscription/');

echo 'LongtermRental subscription pop-up test' . PHP_EOL;
if (!$forms->checkFormPopUp(
    '.cd-header__body button[data-block="header"][data-href="rent-car-form"][data-type="longterm_form_open"]'
)) {
    echo 'FAIL pop-up header' . PHP_EOL;
}

$forms->getNewPage(URL . '/msk/subscription/');
if (!$forms->checkFormPopUp(
    '.catalog__slider button[data-block="special"][data-href="rent-car-form"][data-type="longterm_form_open"]'
)) {
    echo 'FAIL pop-up special' . PHP_EOL;
}

$forms->getNewPage(URL . '/msk/subscription/');
if (!$forms->checkFormPopUp(
    '#longtermrental-catalog button[data-href="rent-car-form"][data-type="longterm_form_open"][data-block="catalog"]'
)) {
    echo 'FAIL pop-up catalog' . PHP_EOL;
}

$forms->getNewPage(URL . '/msk/subscription/');
if (!$forms->checkFormPopUp(
    '#showroom button[data-href="rent-car-form"][data-type="longterm_form_open"][data-block="contact"]'
)) {
    echo 'FAIL pop-up contact' . PHP_EOL;
}

echo 'open /msk/longtermrental/chery-tiggo-4-pro-active/' . PHP_EOL;
$forms->getNewPage(URL . '/msk/longtermrental/chery-tiggo-4-pro-active/');
echo 'LongtermRental detail form test' . PHP_EOL;
if (!$forms->checkFormPopUp(
    '.cd-header__body a[data-block="header"][data-href="rent-car-form"][data-type="longterm_form_open"]'
)) {
    echo 'FAIL pop-up header' . PHP_EOL;
}

$forms->getNewPage(URL . '/msk/longtermrental/chery-tiggo-4-pro-active/');
if (!$forms->checkDetailForm(
    '.rent-detail__right .rent-car-form form#form--rent'
)) {
    echo 'FAIL main form' . PHP_EOL;
}

echo 'open /msk/longtermrental/review/25987/' . PHP_EOL;
$forms->getNewPage(URL . '/msk/longtermrental/review/25987/');
echo 'LongtermRental review pop-up test' . PHP_EOL;
if (!$forms->checkFormPopUp(
    '.cd-header__body a[data-block="header"][data-href="rent-car-form"][data-type="longterm_form_open"]'
)) {
    echo 'FAIL pop-up header' . PHP_EOL;
}

if (!$forms->checkFormPopUp(
    '.review-detail__button button[data-block="review"][data-href="rent-car-form"][data-type="longterm_form_open"]'
)) {
    echo 'FAIL pop-up review' . PHP_EOL;
}