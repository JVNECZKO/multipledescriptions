<?php
class MultiDescriptionsAjaxModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
        
        $id_product_attribute = (int)Tools::getValue('id_product_attribute');
        $id_lang = $this->context->language->id;

        $sql = 'SELECT description, description_short FROM '._DB_PREFIX_.'dfc_product_attribute_lang WHERE id_product_attribute = '.(int)$id_product_attribute.' AND id_lang = '.(int)$id_lang;
        $result = Db::getInstance()->getRow($sql);

        die(Tools::jsonEncode($result));
    }
}
