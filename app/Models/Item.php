<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Item extends Model
{
    use AsSource, Attachable, Filterable;

    protected $fillable = [
        'name',
        'manufacturer',
        'quantity',
        'img',
        'expiry_date',
    ];

    protected $allowedSorts = [
        'name',
        'manufacturer',
        'expiry_date',
        'quantity',
        'created_at',
        'updated_at'
    ];

    protected $allowedFilters = [
        'name',
        'quantity',
        'manufacturer',
        'expiry_date',

    ];

    public function Unit()
    {
        return $this->hasMany(Unit::class);
    }

}
