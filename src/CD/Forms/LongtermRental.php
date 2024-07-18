<?php

namespace WebDriverHandler\CD\Forms;

use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\TimeoutException;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use WebDriverHandler\WebDriver\Capabilities;
use WebDriverHandler\WebDriver\Handler;

class LongtermRental
{
    private Handler $handler;

    public function __construct()
    {
        $capabilities = new Capabilities();
        $capabilities
            //путь до исполняемого файла браузера
            ->setOptions([
                'binary' => 'C:\Program Files\Mozilla Firefox\firefox.exe',
            ])
            //дополнительный аргумент при запуске браузера, не отображать интерфейс
            ->setArguments(['-headless'])
        ;

        $this->handler = new Handler($capabilities);

        ($this->handler->getDriver())->manage()->window()->maximize();
    }

    /**
     * @param string $url
     * @return void
     */
    public function getNewPage(string $url): void
    {
        $this->handler->getPage($url);
    }

    /**
     * @param string $selector
     * @return bool
     */
    public function checkFormPopUp(string $selector): bool
    {
        try {
            $cookieNotice = $this->handler->getElementCss('.notice-cookie__button.btn.js-close-notice-cookie');
            if ($this->handler->elementPresent($cookieNotice)) {
                $this->handler->clickElement($cookieNotice);
            }

            $this->handler->scrollToElement(
                $this->handler->getElementCss($selector)
            );
            $this->handler->clickElement(
                $this->handler->getElementCss($selector)
            );
            sleep(1);

            $baseSelector = $this->handler->getElementCss('.rent-car-form.js-rent-car-form');
            $this->formBase($baseSelector);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }

        return true;
    }

    /**
     * @param string $selector
     * @return bool
     */
    public function checkDetailForm(string $selector): bool
    {
        try {
            $this->handler->scrollToElement(
                $this->handler->getElementCss($selector)
            );
            $this->handler->clickElement(
                $this->handler->getElementCss($selector)
            );
            sleep(1);
            $baseSelector = $this->handler->getElementCss($selector);
            $this->formBase($baseSelector);

        }  catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }

        return true;
    }

    /**
     * @param $baseSelector
     * @return void
     * @throws NoSuchElementException
     * @throws TimeoutException
     */
    private function formBase($baseSelector): void
    {
        $this->handler->scrollToElement($baseSelector->findElement(
            WebDriverBy::cssSelector('input[name="FIELDS[NAME]"]')
        ));

        $this->handler->setInputValue(
            $baseSelector->findElement(WebDriverBy::cssSelector('input[name="FIELDS[NAME]"]')),
            'Test'
        );
        $this->handler->setInputValue(
            $baseSelector->findElement(WebDriverBy::cssSelector('input[name="FIELDS[PHONE]"]')),
            '+7 (111) 111-11-22'
        );

        $this->handler->scrollToElement($baseSelector->findElement(
            WebDriverBy::cssSelector('form#form--rent .rent-form__agree .form-check__icon')
        ));

        $this->handler->clickElement($baseSelector->findElement(
            WebDriverBy::cssSelector('form#form--rent .rent-form__agree .form-check__icon')
        ));

        $this->handler->scrollToElement($baseSelector->findElement(
            WebDriverBy::cssSelector('form#form--rent button.btn')
        ));

        $this->handler->clickElement($baseSelector->findElement(
            WebDriverBy::cssSelector('form#form--rent button.btn')
        ));

        ($this->handler->getDriver())->wait(10, 500)->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('.rent-car-success__wrap.js-on-success-form-send'))
        );
        $this->handler->clickElement(
            $this->handler->getElementCss('.btn.js-modal-close')
        );
    }
}