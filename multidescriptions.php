<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class MultiDescriptions extends Module
{
    public function __construct()
    {
        $this->name = 'multidescriptions';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Łukasz Janeczko';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Aktualizacja Opisów Kombinacji');
        $this->description = $this->l('Aktualizuje długie i krótkie opisy na podstawie wybranej kombinacji.');

        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        return parent::install() &&
               $this->registerHook('header') &&
               $this->registerHook('displayCustomCombinationDescriptions');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function hookHeader()
    {
        if ($this->context->controller->php_self == 'product') {
            $this->context->controller->addJS($this->_path.'views/js/combination_desc.js');
            $this->context->controller->addJS(_PS_JS_DIR_.'jquery/jquery-1.11.0.min.js');
            $this->context->controller->addJS(_PS_JS_DIR_.'tools.js'); // Dodano załadowanie biblioteki JavaScript PrestaShop
        }
    }

    public function hookDisplayCustomCombinationDescriptions($params)
    {
        return '<div id="combination-descriptions" data-product-id="'.$params['product']->id.'"></div>';
    }
}
