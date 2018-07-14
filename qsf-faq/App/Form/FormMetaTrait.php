<?php

namespace App\Form;

use Zend_Registry;

/**
 * @mixin \Qs_Form
 * @deprecated use \Qs\Form\SeoTrait
 */
trait FormMetaTrait
{
    public static $metaGroup = 'metaGroup';
    public static $metaTitle = 'metaTitle';
    public static $metaKeywords = 'metaKeywords';
    public static $metaDescription = 'metaDescription';

    public static function getMetaElementNames()
    {
        return [self::$metaTitle, self::$metaKeywords, self::$metaDescription];
    }

    protected function _initMetaElements(array $elements = null, array $options = [])
    {
        if (null === $elements) {
            $elements = self::getMetaElementNames();
        }
        if (in_array(self::$metaTitle, $elements)) {
            $this->_initMetaTitleElement(isset($options[self::$metaTitle]) ? $options[self::$metaTitle] : []);
        }
        if (in_array(self::$metaKeywords, $elements)) {
            $this->_initMetaKeywordsElement(isset($options[self::$metaKeywords]) ? $options[self::$metaKeywords] : []);
        }
        if (in_array(self::$metaDescription, $elements)) {
            $this->_initMetaDescriptionElement(isset($options[self::$metaDescription]) ? $options[self::$metaDescription] : []);
        }
        $this->addDisplayGroup($elements, self::$metaGroup, $this->_getMetaGroupOptions());

        return $this->getDisplayGroup(self::$metaGroup);
    }

    protected function _getMetaGroupOptions()
    {
        return ['legend' => 'Meta'];
    }

    protected function _initMetaTitleElement(array $options = [])
    {
        $options = array_merge($this->_getMetaTitleOptions(), $options);
        $this->addElement('text', self::$metaTitle, $options);
        $this->getElement(self::$metaTitle)->addFilter('StringTrim');
        return $this->getElement(self::$metaTitle);
    }

    protected function _getMetaTitleOptions()
    {
        return [
            'label'     => 'Page Title',
            'maxlength' => '255',
        ];
    }

    protected function _initMetaKeywordsElement(array $options = [])
    {
        $options = array_merge($this->_getMetaKeywordsOptions(), $options);
        $this->addElement('textarea', self::$metaKeywords, $options);
        return $this->getElement(self::$metaKeywords);
    }

    protected function _getMetaKeywordsOptions()
    {
        return [
            'label' => 'Meta Keywords',
            'rows'  => 3
        ];
    }

    protected function _initMetaDescriptionElement(array $options = [])
    {
        $options = array_merge($this->_getMetaDescriptionOptions(), $options);
        $this->addElement('textarea', self::$metaDescription, $options);
        return $this->getElement(self::$metaDescription);
    }

    protected function _getMetaDescriptionOptions()
    {
        return [
            'label' => 'Meta Description',
            'rows'  => 3
        ];
    }

    public static function updatePageMeta(array $data, array $elements = null, $titleField = 'title')
    {
        if (null === $elements) {
            $elements = self::getMetaElementNames();
        }
        if (in_array(self::$metaTitle, $elements)) {
            self::updateMetaTitle($data, $titleField);
        }
        if (in_array(self::$metaKeywords, $elements)) {
            self::updateMetaKeywords($data);
        }
        if (in_array(self::$metaDescription, $elements)) {
            self::updateMetaDescription($data);
        }
    }

    public static function updateMetaTitle(array $data, $titleField)
    {
        if (array_key_exists(self::$metaTitle, $data)) {
            /** @var \Qs_Doc $doc */
            $doc = Zend_Registry::get('doc');
            $metaTitle = $data[self::$metaTitle] ? $data[self::$metaTitle] : $data[$titleField];
            $doc->setTitle($metaTitle);
        }
    }

    public static function updateMetaKeywords(array $data)
    {
        if (array_key_exists(self::$metaKeywords, $data) && $data[self::$metaKeywords]) {
            /** @var \Qs_Doc $doc */
            $doc = Zend_Registry::get('doc');
            $doc->setKeywords($data[self::$metaKeywords]);
        }
    }

    public static function updateMetaDescription(array $data)
    {
        if (array_key_exists(self::$metaDescription, $data) && $data[self::$metaDescription]) {
            /** @var \Qs_Doc $doc */
            $doc = Zend_Registry::get('doc');
            $doc->setKeywords($data[self::$metaDescription]);
        }
    }
}
 