<?php

namespace Omaicode\Enum\Contracts;

interface LocalizedEnum
{
    /**
     * Get the default localization key.
     *
     * @return string
     */
    public static function getLocalizationKey();
}
