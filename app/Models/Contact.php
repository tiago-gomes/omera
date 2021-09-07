<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 *
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @mixin \Eloquent
 */
class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'firstName',
        'email',
        'phone',
        'leadSource',
        'salesforce_external_id',
    ];
}
