<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\ItemListLayout;
use App\Models\Item;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;

class ItemListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Items List';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All Items';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'Items' => Item::filters()->defaultSort('id')->paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new')
                ->icon('plus')
                ->route('platform.Item.edit'),

            Button::make('Export file')
                ->method('export')
                ->icon('cloud-download')
                ->rawClick()
                ->novalidate(),

            Button::make('Import file')
                ->method('export')
                ->icon('cloud-upload')
                ->rawClick()
                ->novalidate(),
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            ItemListLayout::class
        ];
    }

    /**
     * @param Item $Item
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Item $Item)
    {
        $Item->delete();

        Alert::info('You have successfully deleted the Item.');

        return redirect()->route('platform.Item.list');
    }
}
