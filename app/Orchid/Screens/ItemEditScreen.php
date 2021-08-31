<?php

namespace App\Orchid\Screens;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;

class ItemEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Creating a new Item';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Blog Items';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @param Item $Item
     *
     * @return array
     */
    public function query(Item $Item): array
    {
        $this->exists = $Item->exists;

        if ($this->exists) {
            $this->name = 'Edit Item';
        }

        return [
            'Item' => $Item
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
            Button::make('Create Item')
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
                Input::make('Item.name')
                    ->required()
                    ->title('Name'),

                Input::make('Item.manufacturer')
                    ->required()
                    ->title('Manufacturer'),

                Input::make('Item.quantity')
                    ->type('number')
                    ->required()
                    ->title('Quantity'),

                DateTimer::make('Item.expiry_date')
                    ->title('Expiry date')
                    ->allowInput(),

                Cropper::make('Item.img')
                    ->required()
                    ->title('Upload product Image')
                    ->width(500)
                    ->height(500)
                    ->targetRelativeUrl(),


            ])
        ];
    }

    /**
     * @param Item    $Item
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Item $Item, Request $request)
    {
        $Item->fill($request->get('Item'))->save();

        Alert::info('You have successfully created an Item.');

        return redirect()->route('platform.Item.list');
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
