<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Repositories\UserRepository;
use App\Core\Helpers\Utilities;
use App\Models\User;
class UserController extends Controller
{
    private $UserRepository;
    public function __construct()
    {
        $this->UserRepository = new UserRepository(new User());
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

        return $this->UserRepository->index($request->take, $request->skip, $where);
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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:4|max:10',
            'phone' => 'string|unique:users,phone',
            'permissions' => 'string',
        ]);
        // $request['password'] = bcrypt($request->password);
        return $this->UserRepository->store($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\\$name  $name
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->UserRepository->show($id);
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
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'string|email|unique:user',
            'password' => 'string|min:4|max:10',
            'phone' => 'string|unique:user',
            'permissions' => 'string',
        ]);
        if($request->has('password'))
            $data['password'] = bcrypt($request->password);
        return $this->UserRepository->update($id, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\\$name  $name
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->UserRepository->destroy($id);
    }

}
