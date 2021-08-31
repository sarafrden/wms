<?php
return [
    'resources' => [


// user options
        'user' => [
            'allowedSorts' => [
                'id',
                'first_name',
                'last_name',
                'phone',
                'email',
                'updated_at',
                'created_at',
            ],
            'allowedFilters' => [
                'id',
                'first_name',
                'last_name',
                'email',
                'permissions',
                'phone'
              ],
            'allowedIncludes' => [

            ],
        ],







// item options
        'item' => [
            'allowedSorts' => [
                'name',
                'quantity',
                'manufacturer',
                'expiry_date',
                'created_at',
                'updated_at'
            ],
            'allowedFilters' => [
                'name',
                'quantity',
                'manufacturer',
                'expiry_date',

            ],
            'allowedIncludes' => [
                'unit',
            ],
        ],



// unit options
        'unit' => [
            'allowedSorts' => [
                'name',
                'buy_price',
                'sell_price',
                'item_id',
                'created_at',
                'updated_at'
            ],
            'allowedFilters' => [
                'name',
                'buy_price',
                'sell_price',
                'item_id',
            ],
            'allowedIncludes' => [

            ],
        ],




//dont-remove-or-edit-this-line
    ]
];

?>
