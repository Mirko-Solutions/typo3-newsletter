"use strict";

Ext.ns("Ext.ux.TYPO3.Newsletter.Store");

/**
 * @class Ext.ux.TYPO3.Newsletter.Store.Bootstrap
 * @namespace Ext.ux.TYPO3.Newsletter.Store
 * @extends Ext.ux.TYPO3.Newsletter.Module.AbstractBootstrap
 *
 * Bootrap store
 *
 * $Id$
 */
Ext.ux.TYPO3.Newsletter.Store.Bootstrap = Ext.apply(new Ext.ux.TYPO3.Newsletter.Module.AbstractBootstrap(), {
	initialize: function() {
		Ext.ux.TYPO3.Newsletter.Module.Application.on('Ext.ux.TYPO3.Newsletter.Module.Application.afterBootstrap', this.initStore, this);
	},
	
	initStore: function() {

		Ext.ux.TYPO3.Newsletter.Store.NewsletterList = Ext.ux.TYPO3.Newsletter.Store.initNewsletterList();
		Ext.ux.TYPO3.Newsletter.Store.Statistic = Ext.ux.TYPO3.Newsletter.Store.initStatistic();
		Ext.ux.TYPO3.Newsletter.Store.OverviewPieChart = Ext.ux.TYPO3.Newsletter.Store.initOverviewPieChart();
		
		Ext.ux.TYPO3.Newsletter.Newsletter.Store.initialize();
		Ext.ux.TYPO3.Newsletter.Email.Store.initialize();
		Ext.ux.TYPO3.Newsletter.Link.Store.initialize();
	}
});

Ext.ux.TYPO3.Newsletter.Module.Application.registerBootstrap(Ext.ux.TYPO3.Newsletter.Store.Bootstrap);