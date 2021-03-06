<?php

namespace App\Models\Admin\Form\Element;

use SleepingOwl\Admin\Models\Form\FormItem\BaseFormItem;

/**
 * Admin form element map
 *
 * @package App\Models\Admin\Form\Element
 */
class Map extends BaseFormItem
{
    /** @var string $latName Latitude attribute name */
    protected $latName;

    /** @var string $longName Longitude attribute name */
    protected $longName;

    /**
     * @return string
     */
    public function render()
    {
        $elementId = "{$this->latName}_{$this->longName}";
        $html = app('SleepingOwl\Html\HtmlBuilder');

        $content = $this->formBuilder->label($elementId, $this->label) .
            $this->formBuilder->hidden($this->latName,
                $this->form->getValueForName($this->latName),
                ['id' => "{$elementId}_lat"]) .
            $this->formBuilder->hidden($this->longName,
                $this->form->getValueForName($this->longName),
                ['id' => "{$elementId}_long"]) .
            $html->tag('div', ['class' => 'js-map-input', 'id' => $elementId])
        ;

        return $html->tag('div', ['class' => 'form-group'], $content);
    }

    /**
     * Set label
     *
     * @param string $label Label
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * Set attributes
     *
     * @param string $latName  Latitude attribute name
     * @param string $longName Longitude attribute name
     *
     * @return $this
     */
    public function setAttributes($latName, $longName)
    {
        $this->latName = $latName;
        $this->longName = $longName;

        $this->name = $this->latName;

        return $this;
    }
}
