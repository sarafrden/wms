<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\UnitListLayout;
use App\Models\Unit;
use App\Models\Item;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;

class UnitListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Units List';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'All Units';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'Units' => Unit::filters()->defaultSort('id')->paginate()
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
                ->route('platform.Unit.edit'),

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
            UnitListLayout::class
        ];
    }

    /**
     * @param Unit $Unit
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Unit $Unit)
    {
        $Unit->delete();

        Alert::info('You have successfully deleted the Unit.');

        return redirect()->route('platform.Unit.list');
    }
}
