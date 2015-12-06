<?php

namespace App\Models\Admin\Table\Column;
use SleepingOwl\Admin\Columns\Interfaces\ColumnInterface;

/**
 * Admin form element map
 *
 * @package App\Models\Admin\Table\Column
 */
class Select implements ColumnInterface
{
    /** @var bool $isMultiselect Is multiselect */
    protected $isMultiselect = false;

    /** @var string $groupName Group name */
    protected $groupName = null;

    /** @var array $selectedIds Selected ids */
    protected $selectedIds = [];

    /** @var \SleepingOwl\Html\HtmlBuilder $html Html builder  */
    protected $html = null;

    /**
     * Construct
     *
     * @return Select
     */
    public function __construct()
    {
        $this->html = app('SleepingOwl\Html\HtmlBuilder');
    }

    /**
     * @return string
     */
    public function renderHeader()
    {
        return $this->html->tag('th', ['style' => 'width: 10px']);
    }

    /**
     * @param $instance
     * @param int $totalCount
     * @return string
     */
    public function render($instance, $totalCount)
    {
        $params = [
            'type' => $this->isMultiselect ? 'checkbox' : 'radio',
            'name' => $this->groupName . '_tableGroup',
            'data-id' => $instance->id,
            'data-value-id' => $this->groupName . '_tableValue',
            'class' => 'js-table-input-group',
        ];

        if (in_array($instance->id, $this->selectedIds)) {
            $params['checked'] = 'checked';
        }

        return $this->html->tag('td', [], $this->html->tag('input', $params));
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        return true;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '_select-columns';
    }

    /**
     * Set is multiselect
     *
     * @param bool $value Value
     * @return $this
     */
    public function setMultiselect($value = true)
    {
        $this->isMultiselect = $value;
        return $this;
    }

    /**
     * Set group name
     *
     * @param string $groupName Group name
     * @return $this
     */
    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
        return $this;
    }

    /**
     * Set selected
     *
     * @param array $selectedIds Selected ids
     * @return $this
     */
    public function setSelected($selectedIds)
    {
        $this->selectedIds = $selectedIds;
        return $this;
    }
}
