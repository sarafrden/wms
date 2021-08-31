<?php

namespace App\Orchid\Screens;

use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
// use App\Orchid\Screens\Select;

class UnitEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creating a new Unit';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Blog Units';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param Unit $Unit
     *
     * @return array
     */
    public function query(Unit $Unit): array
    {
        $this->exists = $Unit->exists;

        if ($this->exists) {
            $this->name = 'Edit Unit';
        }

        return [
            'Unit' => $Unit
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
            Button::make('Create Unit')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
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
            Layout::rows([
                Input::make('Unit.name')
                    ->required()
                    ->title('Name'),

                Input::make('Unit.buy_price')
                    ->title('Buy Price')
                    ->type('text'),

                Input::make('Unit.sell_price')
                    ->title('Sell Price')
                    ->type('text'),

                Relation::make('Unit.item_id')
                    ->title('Select Item')
                    ->fromModel(Item::class, 'name'),
            ])
        ];
    }

    /**
     * @param Unit    $Unit
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Unit $Unit, Request $request)
    {
        $Unit->fill($request->get('Unit'))->save();

        Alert::info('You have successfully created an Unit.');

        return redirect()->route('platform.Unit.list');
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
