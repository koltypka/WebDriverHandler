<?php

namespace WebDriverHandler\WebDriver;

use Facebook\WebDriver\WebDriverCapabilities;

interface CapabilitiesInterface
{
    /**
     * @return WebDriverCapabilities
     */
    public function getCapabilities(): WebDriverCapabilities;
}