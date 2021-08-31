<?php

namespace App\Orchid\Layouts;

use App\Models\Item;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;
// use App\Orchid\Layouts\component;

class ItemListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'Items';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Item $Item) {
                    return Link::make($Item->name)
                        ->route('platform.Item.edit', $Item);
                }),
            TD::make('manufacturer', 'Manufacturer')
                ->sort()
                ->filter(TD::FILTER_TEXT),
            TD::make('quantity', 'Quantity')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Item $Item) {
                    return
                    view('status', $Item);
                }),
            TD::make('expiry_date', 'Expiry date')
                ->sort()
                ->filter(TD::FILTER_TEXT),
            TD::make('img', 'Image')
                ->render(function (Item $Item) {
                    return view('imgs', $Item);
                }),
            TD::make('created_at', 'Created')
            ->sort()
            ->render(function (Item $Item) {
                return $Item->created_at->toDateTimeString();
            }),
            TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(function (Item $Item) {
                    return $Item->updated_at->toDateTimeString();
                }),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Item $Item) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.Item.edit', $Item)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the Item is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->parameters([
                                    'id' => $Item->id,
                                ]),
                        ]);
                }),
        ];
    }
}
