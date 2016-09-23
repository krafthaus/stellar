<?php

namespace KraftHaus\Stellar\Database\Eloquent\Models;

/*
 * This file is part of the Stellar package.
 *
 * (c) KraftHaus <hello@krafthaus.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Support\MessageBag;
use Illuminate\Validation\Factory;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Translation\Translator;

class Meta extends Model
{

    /**
     * Mass-assignment protection.
     * @var array
     */
    protected $fillable = [
        'metable_id', 'metable_type', 'key', 'value'
    ];

    /**
     * @var MessageBag
     */
    protected $errors;

    /**
     * Validation rules.
     * @var array
     */
    protected static $rules = [
        'metable_id' => 'required|integer',
        'metable_type' => 'required',
        'key' => 'required|max:100',
        'value' => 'required'
    ];

    /**
     * Handle the booting of the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            return $model->validate();
        });
    }

    /**
     * Validates current attribute against rules.
     *
     * @return bool
     */
    protected function validate()
    {
        $factory = new Factory(new Translator('en'), new Container);

        $validator = $factory->make($this->attributes, static::$rules);

        if ($validator->passes()) {
            return true;
        }

        $this->setErrors($validator->messages());

        return false;
    }

    /**
     * Set the errors message bag.
     *
     * @param  MessageBag  $errors
     */
    protected function setErrors(MessageBag $errors)
    {
        $this->errors = $errors;
    }
}