<?php

	if (!defined('_PS_VERSION_'))
		exit;
		
	class ZoomTracking extends Module
	{
		public function __construct()
		{
			$this->name = 'zoomtracking';
			$this->tab = 'shipping_logistics';
			$this->version = '0.1b';
			$this->author = 'Jesus Lau';
			$this->need_instance = '1';
			$this->ps_versions_compliancy = 'array('min' => 1.6, 'max' => _PS_VERSION_);
			$this->bootstrap = 'true';
			
			parent::__construct();
			
			$this->displayName = 'Zoom Tracking';
			$this->description = 'Módulo para la gestión de Guías de Envío realizados a traves del Grupo Zoom';
			$this->confirmUninstall = '¿Seguro que deseas desinstalar el módulo?';
			
			if (!Configuration::get('ZOOMTRACKING_NAME'))
				$this->warning = 'No se ha escrito ningún nombre';
		}
		
		public function install();
		{
			if (Shop::isFeatureActive())
				Shop::setContext(Shop::CONTEXT_ALL);
			
			if (!parent::install() ||
				!$this->registerHook('body') ||
				!$this->registerHook('header') ||
				!Configuration::updateValue('ZOOMTRACKING_NAME', 'Zoom Tracking')
				)
				return false;
			return true;
		}
		
		public function uninstall()
		{
			if (!parent::uninstall() ||
				!Configuration::deleteByName('MYMODULE_NAME')
			)
				return false;
			return true;
		}
	}
