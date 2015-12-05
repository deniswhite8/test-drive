<?php

namespace App\Models\Admin\Form\Element;

use Illuminate\Support\Str;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\Models\Form\FormItem\BaseFormItem;

/**
 * Admin form element Table
 *
 * @package App\Models\Admin\Form\Element
 */
class Table extends BaseFormItem
{
    /** @var string $modelClass Model class */
    protected $modelClass;

    /** @var string $modelAlias Model alias */
    protected $modelAlias = null;

    /** @var bool $isMultiselect Is multiselect */
    protected $isMultiselect = false;

    /**
     * @return string
     */
    public function render()
    {
        $modelItem = Admin::instance()->models->modelWithAlias($this->modelAlias);
        $modelClass = $this->modelClass;
        $columns = $modelItem->getColumns();
        array_pop($columns); // remove control column
        $model = $this->formBuilder->getModel();
        $selectedIds = $model->{$this->name}()->get()->lists('id')->toArray();

        return view('admin.form.element.table', [
            'title'         => $this->label,
            'name'          => $this->name,
            'modelItem'     => $modelItem,
            'columns'       => $columns,
            'rows'          => $modelClass::all(),
            'selected'   => $selectedIds,
            'multiselect' => $this->isMultiselect
        ]);
    }

    /**
     * Set model
     *
     * @param string $modelClass Model class
     * @return $this
     */
    public function setModel($modelClass)
    {
        $this->modelClass = $modelClass;
        $this->modelAlias = Str::snake(Str::plural(class_basename($modelClass)));
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
     * Set is multiselect
     *
     * @return $this
     */
    public function multiselect($value = true)
    {
        $this->isMultiselect = $value;
    }
}
