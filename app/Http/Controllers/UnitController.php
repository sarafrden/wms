<?php
namespace App\Http\Controllers;
use App\Core\Helpers\Utilities;
use App\Http\Repositories\UnitRepository;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    private $UnitRepository;
    public function __construct()
    {
        $this->UnitRepository = new UnitRepository(new Unit());
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

        return $this->UnitRepository->index($request->take, $request->skip, $where);
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
            'buy_price' => 'string',
            'sell_price' => 'string',
            'item_id' => 'integer',

        ]);

        return $this->UnitRepository->store($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\\$name  $name
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->UnitRepository->show($id);
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
            'buy_price' => 'string',
            'sell_price' => 'string',
            'item_id' => 'integer',
        ]);


        return $this->UnitRepository->update($id, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\\$name  $name
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->UnitRepository->destroy($id);
    }

}
