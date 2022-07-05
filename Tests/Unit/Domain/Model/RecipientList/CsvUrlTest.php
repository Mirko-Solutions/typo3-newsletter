<?php

namespace Mirko\Typo3Newsletter\Tests\Unit\Domain\Model\RecipientList;

use Mirko\Typo3Newsletter\Domain\Model\RecipientList\CsvUrl;

/**
 * Test case for class \Mirko\Typo3Newsletter\Domain\Model\RecipientList\CsvUrl.
 */
class CsvUrlTest extends CsvFileTest
{
    protected function setUp()
    {
        $this->subject = new CsvUrl();
    }

    /**
     * @test
     */
    public function getCsvUrlReturnsInitialValueForString()
    {
        $this->assertSame('', $this->subject->getCsvUrl());
    }

    /**
     * @test
     */
    public function setCsvUrlForStringSetsCsvUrl()
    {
        $this->subject->setCsvUrl('Conceived at T3CON10');
        $this->assertAttributeSame('Conceived at T3CON10', 'csvUrl', $this->subject);
    }

    protected function prepareDataForEnumeration()
    {
        $this->subject->setCsvUrl(__DIR__ . '/data.csv');
    }
}
