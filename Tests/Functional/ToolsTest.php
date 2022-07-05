<?php

namespace Mirko\Typo3Newsletter\Tests\Functional;

use Mirko\Typo3Newsletter\Domain\Repository\NewsletterRepository;
use Mirko\Typo3Newsletter\Tools;
use Mirko\Typo3Newsletter\Utility\Validator;

require_once __DIR__ . '/AbstractFunctionalTestCase.php';

/**
 * Functional test for the \Mirko\Typo3Newsletter\Tools
 */
class ToolsTest extends \Mirko\Typo3Newsletter\Tests\Functional\AbstractFunctionalTestCase
{
    public function testCreateAllSpool()
    {
        $this->importDataSet(ORIGINAL_ROOT . 'typo3/sysext/core/Tests/Functional/Fixtures/tt_content.xml');

        $db = $this->getDatabaseConnection();
        $count = $db->exec_SELECTcountRows('*', 'tx_newsletter_domain_model_newsletter', 'begin_time != 0 AND end_time != 0');
        $this->assertSame(0, $count);

        Tools::createAllSpool();

        $count = $db->exec_SELECTcountRows('*', 'tx_newsletter_domain_model_newsletter', 'begin_time != 0 AND end_time != 0');
        $this->assertSame(1, $count, 'newsletter should be marked as spooled');

        $count = $db->exec_SELECTcountRows('*', 'tx_newsletter_domain_model_email', 'newsletter = 20 AND begin_time = 0');
        $this->assertSame(2, $count, 'two emails must have been created but not sent yet');

        $lastInsertedEmail = $db->exec_SELECTgetSingleRow('*', 'tx_newsletter_domain_model_email', 'newsletter = 20 AND begin_time = 0');
        $this->assertNotSame(md5('0' . $lastInsertedEmail['recipient_address']), $lastInsertedEmail['auth_code'], 'the UID used in authCode must never be 0');
        $this->assertSame(md5($lastInsertedEmail['uid'] . $lastInsertedEmail['recipient_address']), $lastInsertedEmail['auth_code'], 'the UID used in authCode should be the real value');

        // Prepare a mock to always validate content
        /** @var Validator|\PHPUnit_Framework_MockObject_MockObject $mockValidator */
        $mockValidator = $this->getMock(Validator::class, ['validate'], [], '', false);
        $mockValidator->method('validate')->will($this->returnValue(
            [
                'content' => 'some very interesting content <a href="http://example.com/fake-content">link</a>',
                'errors' => [],
                'warnings' => [],
                'infos' => [],
            ]
        ));

        // Force email to NOT be sent
        global $TYPO3_CONF_VARS;
        $TYPO3_CONF_VARS['MAIL']['transport'] = 'Swift_NullTransport';

        /** @var NewsletterRepository $newsletterRepository */
        $newsletterRepository = $this->objectManager->get(NewsletterRepository::class);
        $newsletter = $newsletterRepository->findByUid(20);
        $newsletter->setValidator($mockValidator);
        Tools::runSpool($newsletter);

        $count = $db->exec_SELECTcountRows('*', 'tx_newsletter_domain_model_email', 'newsletter = 20 AND begin_time != 0 AND end_time != 0 AND recipient_data != ""');
        $this->assertSame(2, $count, 'should have sent two emails');
        $count = $db->exec_SELECTcountRows('*', 'tx_newsletter_domain_model_link', 'newsletter = 20');
        $this->assertSame(1, $count, 'should have on1 new link');
    }
}
