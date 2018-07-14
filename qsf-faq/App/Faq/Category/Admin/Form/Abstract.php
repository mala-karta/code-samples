<?php

use Qs\Form\SeoTrait;

class App_Faq_Category_Admin_Form_Abstract extends Qs_Form
{
    use SeoTrait;

    protected function _initElements()
    {
        parent::_initElements();

        $this->addElement('text', 'title', array('label' => 'Title', 'required' => true));
        $this->addSeoGroup('FaqCategory');
        $this->addElement('checkbox', 'enabled', array('label' => 'Show on user end', 'decoration' => 'simple'));

        return $this;
    }
}
