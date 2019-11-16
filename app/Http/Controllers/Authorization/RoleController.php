<?php
namespace App\Http\Controllers\Authorization;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiJsonResponse;

class RoleController extends Controller
{

    use ApiJsonResponse;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //Check if the Authenticated user is admin
        if (Auth::user()->isAdministrator()) {
            $roles = Role::all();
            return $this->successResponse($roles);
        }
        return $this->errorResponse('Unauthorized Access.', ApiJsonTransformer::HTTP_UNAUTHORIZED);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
         //Check if the Authenticated user is admin
        if (Auth::user()->isAdministrator()) {
            //The rules
            $rules = [
                'name' => 'required|max:255',
            ];
            //validate the request
        $this->validate($request, $rules);
            //instantiate the Role
            $role = new Role();
            $role->name = $request->input('name');
            //Save the role
            $role->save();
            //Return the new role
            return $this->successResponse($role, ApiJsonTransformer::HTTP_CREATED);
        }
        return $this->errorResponse('Unauthorized Access.', ApiJsonTransformer::HTTP_UNAUTHORIZED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($roleId) {
        //Check if the Authenticated user is admin
        if (Auth::user()->isAdministrator()) {
            //get role with the given roleId
            $role = Role::findOrFail($roleId);
            return $this->successResponse($role);
        }
        return $this->errorResponse('Unauthorized Access.', ApiJsonTransformer::HTTP_UNAUTHORIZED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $roleId) {
        //Check if the Authenticated user is admin
        if (Auth::user()->isAdministrator()) {
            //get role with the given roleId
            //The rules
            $rules = [
                'name'     => 'max:255',
            ];
            //validate the request
        $this->validate($request, $rules);
            //get role with the given roleId
            $role = Role::findOrFail($roleId);
            //Check if the request has name
            if ($request->has('name')) {
                $role->name    = $request->input('name');
            }
            //Check if anything changed in role
            if ($role->isClean()) {
                return $this->errorResponse('You must specify a new value to update', ApiJsonTransformer::HTTP_UNPROCESSABLE_ENTITY);
            }
            //Save the role
            $role->save();
            //Return the new role
            return $this->successResponse($role, ApiJsonTransformer::HTTP_CREATED);
        }
        return $this->errorResponse('Unauthorized Access.', ApiJsonTransformer::HTTP_UNAUTHORIZED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($roleId) {
        //Check if the Authenticated user is admin
        if (Auth::user()->isAdministrator()) {
            //get role with the given roleId
            $role = Role::findOrFail($roleId);
            $role->delete();
            //Return the new role
            return $this->successResponse($role);
        }
        return $this->errorResponse('Unauthorized Access.', ApiJsonTransformer::HTTP_UNAUTHORIZED);
    }

}
