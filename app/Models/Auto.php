<?php

namespace App\Models;
use App\Models\Auto\BodyType;
use App\Models\Auto\GearboxType;
use App\Models\Auto\Generation;
use App\Models\Auto\Mark;
use App\Models\Auto\Model;
use SleepingOwl\Models\Interfaces\ModelWithImageFieldsInterface;
use SleepingOwl\Models\SleepingOwlModel;
use SleepingOwl\Models\Traits\ModelWithImageOrFileFieldsTrait;

/**
 * Auto model
 *
 * @package App\Models
 */
class Auto extends SleepingOwlModel implements ModelWithImageFieldsInterface
{
    use ModelWithImageOrFileFieldsTrait;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['description', 'image', 'mark_id', 'model_id',
        'generation_id', 'body_type_id', 'gearbox_type_id', 'mileage'];


    /**
     * Set generation id attribute
     *
     * @param mixed $value Value
     * @return void
     */
    public function setGenerationIdAttribute($value)
    {
        $this->attributes['generation_id'] = $value ?: null;
    }

    /**
     * Auto salons
     */
    public function salons()
    {
        return $this->belongsToMany(Salon::class, 'salon_auto');
    }

    /**
     * Get mark
     */
    public function mark()
    {
        return $this->belongsTo(Mark::class);
    }

    /**
     * Get model
     */
    public function model()
    {
        return $this->belongsTo(Model::class);
    }

    /**
     * Get generation
     */
    public function generation()
    {
        return $this->belongsTo(Generation::class);
    }

    /**
     * Get body type
     */
    public function bodyType()
    {
        return $this->belongsTo(BodyType::class);
    }

    /**
     * Get gearbox type
     */
    public function gearboxType()
    {
        return $this->belongsTo(GearboxType::class);
    }

    /**
     * Get image fields
     *
     * @return array
     */
    public function getImageFields() {
        return [
            'image' => 'autos/'
        ];
    }
}
