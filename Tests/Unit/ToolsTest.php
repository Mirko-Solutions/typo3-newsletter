<?php

namespace Mirko\Typo3Newsletter\Tests\Unit;

use Mirko\Typo3Newsletter\Tools;

/**
 * Unit test for \Mirko\Typo3Newsletter\Tools
 */
class ToolsTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    public function testEncryption()
    {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['encryptionKey'] = 'encryptionKeyValue';
        $encrypted = Tools::encrypt('my value');
        $this->assertNotSame('my value', $encrypted, 'must be encrypted');
        $decrypted = Tools::decrypt($encrypted);
        $this->assertSame('my value', $decrypted, 'must be original value');
    }

    public function testUserAgent()
    {
        define('TYPO3_user_agent', 'User-Agent: TYPO3');
        $userAgent = Tools::getUserAgent();
        $this->assertSame(1, preg_match('~^User-Agent: TYPO3 Newsletter \(https://github.com/Ecodev/newsletter\)$~', $userAgent));
    }
}
