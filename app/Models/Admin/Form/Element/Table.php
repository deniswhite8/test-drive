<?php

namespace App\Models\Admin\Form\Element;

use Illuminate\Support\Str;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\Columns\Column;
use SleepingOwl\Admin\Models\Form\FormItem\BaseFormItem;

/**
 * Admin form element Table
 *
 * @package App\Models\Admin\Form\Element
 */
class Table extends BaseFormItem
{
    /** @var string $modelAlias Model alias */
    protected $modelAlias = null;

    /**
     * @return string
     */
    public function render()
    {
        $modelItem = Admin::instance()->models->modelWithAlias($this->modelAlias);
        $modelClass = $modelItem->getModelClass();
        $columns = $modelItem->getColumns();
        $rows = $modelItem->isAsync() ? [] : $modelClass::all();

        $modelInstance = $this->formBuilder->getModel();
        $relationField = $modelInstance->{$this->name};
        $isMultiselect = !is_numeric($relationField) && !is_null($relationField);
        $selectedIds = [];
        if ($modelInstance->exists) {
            $selectedIds = is_numeric($relationField) || is_null($relationField) ?
                (array)$relationField : $relationField->lists('id')->toArray();
        }

        array_pop($columns); // remove control column
        array_unshift($columns,
            Column::select()->setMultiselect($isMultiselect)
                ->setGroupName($this->name)->setSelected($selectedIds)
        ); // add select column

        return view('admin.form.element.table', [
            'title'       => $this->label,
            'name'        => $this->name,
            'modelItem'   => $modelItem,
            'columns'     => $columns,
            'rows'        => $rows,
            'selected'    => $selectedIds,
            'multiselect' => $isMultiselect
        ]);
    }

    /**
     * Set model
     *
     * @param string $modelAlias Model alias
     * @return $this
     */
    public function setAlias($modelAlias)
    {
        $this->modelAlias = $modelAlias;
        return $this;
    }

    /**
     * Set name
     *
     * @param string $name Name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
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
     * Update request data
     *
     * @param array $data
     */
    public function updateRequestData(&$data)
    {
        $field = $data[$this->name];
        $value = empty($field) ? [] : explode(',', $field);
        if (!request($this->name . '_multiselect')) {
            $value = reset($value);
        }

        $data[$this->name] = $value;
    }
}
