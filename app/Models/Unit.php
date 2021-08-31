<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Unit extends Model
{
    use AsSource, Attachable, Filterable;

    protected $fillable = [
        'name',
        'buy_price',
        'sell_price',
        'item_id',
    ];

    protected $allowedSorts = [
        'name',
        'buy_price',
        'sell_price',
        'item_id',
        'created_at',
        'updated_at'
    ];

    protected $allowedFilters = [
        'name',
        'buy_price',
        'sell_price',
        'item_id',

    ];

    public function Item()
    {
        return $this->belongsTo(Item::class);
    }

}
