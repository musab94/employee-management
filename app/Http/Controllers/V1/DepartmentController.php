<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\DepartmentService;
use App\Services\Traits\ResponseCodeTrait;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    use ResponseCodeTrait;

    protected $department_service;

    public function __construct(DepartmentService $department_service) {
        $this->department_service = $department_service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->department_service->getAllDepartments();

        $response = self::getResponseCode(1);
        $response['data']['departments'] = $result;

        return $this->response($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request_data = $request->all();
        $rules = [
            'name' => 'required'
        ];
        $this->validate($request_data, $rules);

        $result = $this->department_service->createDepartment($request_data);

        $response = self::getResponseCode(1);
        $response['data']['department'] = $result;

        return $this->response($response);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $result = $this->department_service->getDepartmentById($id);

        $response = self::getResponseCode(1);
        $response['data']['department'] = $result;

        return $this->response($response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request_data = $request->all();
        $rules = [
            'name' => 'required'
        ];
        $this->validate($request_data, $rules);

        $result = $this->department_service->updateDepartment($request_data, $id);

        $response = self::getResponseCode(1);
        $response['data']['department'] = $result;

        return $this->response($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->department_service->deleteDepartment($id);

        $response = self::getResponseCode(1);
        $response['data']['department'] = [];

        return $this->response($response);
    }
}
