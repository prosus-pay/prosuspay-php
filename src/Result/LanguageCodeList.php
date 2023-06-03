<?php

declare(strict_types=1);

namespace ProsusPay\Result;

class LanguageCodeList extends AbstractListResult
{
    /**
     * @return \ProsusPay\Result\LanguageCode[]
     */
    public function all(): array
    {
        $languageCodes = [];
        foreach ($this->getData() as $languageCode) {
            $languageCodes[] = new \ProsusPay\Result\LanguageCode($languageCode);
        }
        return $languageCodes;
    }
}
