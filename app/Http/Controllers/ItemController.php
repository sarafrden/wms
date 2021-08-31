<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Repositories\ItemRepository;
use App\Core\Helpers\Utilities;
use App\Models\Item;
class ItemController extends Controller
{
    private $ItemRepository;
    public function __construct()
    {
        $this->ItemRepository = new ItemRepository(new Item());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'take' => 'integer',
            'skip' => 'integer',
        ]);
        if($request->has('where')) {
            $where = json_decode($request->where, true);
        } else {
            $where = null;
        }

        return $this->ItemRepository->index($request->take, $request->skip, $where);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'manufacturer' => 'required|string',
            'quantity' => 'required|integer',
            'expiry_date' => 'string',
            'img' => 'mimes:jpeg,bmp,png,jpg,svg|required'

        ]);
        if ($request->hasFile('img'))
            $data['img'] = Utilities::upload(request()->img, 'Items');


        return $this->ItemRepository->store($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\\$name  $name
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->ItemRepository->show($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\\$name  $name
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'string',
            'manufacturer' => 'string',
            'quantity' => 'integer',
            'expiry_date' => 'string',
            'img' => 'mimes:jpeg,bmp,png,jpg,svg'
        ]);

        if ($request->hasFile('img'))
            $data['img'] = Utilities::upload(request()->img, 'Items');
        return $this->ItemRepository->update($id, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\\$name  $name
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->ItemRepository->destroy($id);
    }

}
