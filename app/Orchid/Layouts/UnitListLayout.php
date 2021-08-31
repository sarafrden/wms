<?php

namespace App\Orchid\Layouts;

use App\Models\Unit;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;
// use App\Orchid\Layouts\component;

class UnitListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $target = 'Units';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('item_id', 'Item')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Unit $Unit) {
                    return
                    $Unit->Item->name;
                }),
            TD::make('name', 'Name')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Unit $Unit) {
                    return Link::make($Unit->name)
                        ->route('platform.Unit.edit', $Unit);
                }),
            TD::make('buy_price', 'Buy Price')
                ->sort()
                ->filter(TD::FILTER_TEXT),
            TD::make('sell_price', 'Sell Price')
                ->filter(TD::FILTER_TEXT),
            TD::make('created_at', 'Created')
                ->sort()
                ->render(function (Unit $Unit) {
                    return $Unit->created_at->toDateTimeString();
                }),
            TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(function (Unit $Unit) {
                    return $Unit->updated_at->toDateTimeString();
                }),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Unit $Unit) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.Unit.edit', $Unit)
                                ->icon('pencil'),

                            Button::make(__('Delete'))
                                ->icon('trash')
                                ->method('remove')
                                ->confirm(__('Once the Unit is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                                ->parameters([
                                    'id' => $Unit->id,
                                ]),
                        ]);
                }),
        ];
    }
}
