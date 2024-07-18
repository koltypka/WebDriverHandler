<?php

namespace WebDriverHandler\WebDriver;

use Facebook\WebDriver\WebDriverCapabilities;

interface CapabilitiesInterface
{
    public function getCapabilities(): WebDriverCapabilities;
}