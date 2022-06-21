<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// ========== Register BE Modules
if (TYPO3_MODE == 'BE') {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Mirko.typo3_newsletter',
        'web', // Make newsletter module a submodule of 'user'
        'tx_newsletter_m1', // Submodule key
        'before:info', // Position
        [
            'Module' => 'index',
            'Newsletter' => 'list, listPlanned, create, statistics',
            'Email' => 'list',
            'Link' => 'list',
            'BounceAccount' => 'list',
            'RecipientList' => 'list, listRecipient',
        ],
        [
            'access' => 'user,group',
            'icon' => 'EXT:typo3_newsletter/Resources/Public/Icons/tx_newsletter.svg',
            'labels' => 'LLL:EXT:typo3_newsletter/Resources/Private/Language/locallang_module.xlf',
        ]
    );
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_newsletter_domain_model_newsletter', 'EXT:typo3_newsletter/Resources/Private/Language/locallang_csh_tx_newsletter_domain_model_newsletter.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_newsletter_domain_model_newsletter');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_newsletter_domain_model_bounceaccount', 'EXT:typo3_newsletter/Resources/Private/Language/locallang_csh_tx_newsletter_domain_model_bounceaccount.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_newsletter_domain_model_bounceaccount');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_newsletter_domain_model_recipientlist', 'EXT:typo3_newsletter/Resources/Private/Language/locallang_csh_tx_newsletter_domain_model_recipientlist.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_newsletter_domain_model_recipientlist');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_newsletter_domain_model_email', 'EXT:typo3_newsletter/Resources/Private/Language/locallang_csh_tx_newsletter_domain_model_email.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_newsletter_domain_model_email');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_newsletter_domain_model_link', 'EXT:typo3_newsletter/Resources/Private/Language/locallang_csh_tx_newsletter_domain_model_link.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_newsletter_domain_model_link');
