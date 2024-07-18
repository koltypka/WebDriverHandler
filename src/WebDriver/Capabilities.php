<?php

namespace WebDriverHandler\WebDriver;

use Facebook\WebDriver\Firefox\FirefoxOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverCapabilities;

class Capabilities implements CapabilitiesInterface
{
    private \JsonSerializable $options;
    private array $arOptions = [];
    private array $argumentList = [];

    /**
     * @param array $arOptions
     * @return $this
     */
    public function setOptions(array $arOptions): static
    {
        $this->arOptions = $arOptions;

        return $this;
    }

    /**
     * @param array $argumentList
     * @return $this
     */
    public function setArguments(array $argumentList): static
    {
        $this->argumentList = $argumentList;

        return $this;
    }

    /**
     * @return bool
     */
    protected function prepareOptions(): bool
    {
        if (empty($this->arOptions)) {
            return false;
        }

        foreach ($this->arOptions as $name => $value) {
            if (!is_string($name)) {
                continue;
            }
            $this->options->setOption($name, $value);
        }

        return true;
    }

    /**
     * @return bool
     */
    protected function prepareArguments(): bool
    {
        if (empty($this->argumentList)) {
            return false;
        }

        $this->options->addArguments($this->argumentList);

        return true;
    }

    /**
     * @return FirefoxOptions
     */
    protected function getOptionsObject(): FirefoxOptions
    {
        return new FirefoxOptions();
    }

    /**
     * @return WebDriverCapabilities
     */
    public function getCapabilities(): WebDriverCapabilities
    {
        $this->options = $this->getOptionsObject();
        $this->prepareOptions();
        $this->prepareArguments();

        $capabilities = DesiredCapabilities::firefox();
        $capabilities->setCapability(FirefoxOptions::CAPABILITY, $this->options);

        return $capabilities;
    }
}