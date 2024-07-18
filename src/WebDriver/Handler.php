<?php

namespace WebDriverHandler\WebDriver;

use Facebook\WebDriver\Exception\ElementClickInterceptedException;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Exception\NoSuchElementException;

class Handler
{
    private RemoteWebDriver $driver;
    private \JsonSerializable $options;

    //место где хоститься driver браузера
    private string $host = 'http://localhost:4444';

    public function __construct(
        private readonly CapabilitiesInterface $capabilities,
        ?string $url = null
    ) {
        $this->init();
        if (!is_null($url)) {
            $this->getPage($url);
        }
    }

    public function __destruct()
    {
        $this->driver->quit();
    }

    /**
     * @return RemoteWebDriver
     */
    public function getDriver(): RemoteWebDriver
    {
        return $this->driver;
    }

    /**
     * @param string $link
     * @return void
     */
    public function getPage(string $link): void
    {
        $this->driver->get($link);
    }

    /**
     * @param WebDriverBy $selector
     * @return RemoteWebElement|null
     */
    public function getElementByWebDriver(WebDriverBy $selector): RemoteWebElement|null
    {
        $result = null;

        try {
            $result = $this->driver->findElement($selector);
        } catch (NoSuchElementException) {}

        return $result;
    }

    /**
     * @param RemoteWebElement|null $element
     * @return bool
     */
    public function elementPresent(RemoteWebElement|null $element): bool
    {
        $result = false;
        if (!is_null($element)) {
            $result = true;
        }

        return $result;
    }

    /**
     * @param string $selector
     * @return RemoteWebElement|null
     */
    public function getElementCss(string $selector): RemoteWebElement|null
    {
        return $this->getElementByWebDriver(WebDriverBy::cssSelector($selector));
    }

    /**
     * @param RemoteWebElement|null $element
     * @param mixed $value
     * @return bool
     */
    public function setInputValue(RemoteWebElement|null $element, mixed $value): bool
    {
        if (is_null($element)) {
            return false;
        }

        $this->driver->getMouse()->mouseMove($element->getCoordinates());
        $element->sendKeys($value);

        return true;
    }

    /**
     * @param RemoteWebElement|null $element
     * @return bool
     */
    public function clickElement(RemoteWebElement|null $element): bool
    {
        if (is_null($element)) {
            return false;
        }

        $this->driver->getMouse()->mouseMove($element->getCoordinates());

        try {
            $element->click();
        } catch (ElementClickInterceptedException) {
            return false;
        }

        return true;
    }

    /**
     * @param RemoteWebElement|null $element
     * @return bool
     */
    public function scrollToElement(RemoteWebElement|null $element): bool
    {
        if (is_null($element)) {
            return false;
        }

        $element->getLocationOnScreenOnceScrolledIntoView();

        return true;
    }

    /**
     * @return void
     */
    private function init(): void
    {
        $this->driver = RemoteWebDriver::create(
            $this->host,
            $this->capabilities->getCapabilities()
        );
    }
}