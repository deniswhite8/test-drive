<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

/**
 * Dealer
 *
 * @package App
 */
class Dealer extends Model
{
    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'image'];
}
