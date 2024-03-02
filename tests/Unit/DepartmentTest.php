<?php

namespace Tests\Unit;

use App\Repositories\DepartmentRepository;
use Tests\TestCase;
use App\Models\Department;
use App\Services\DepartmentService;

class DepartmentTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_get_all_department()
    {
        $department = new Department();
        $department_repo = new DepartmentRepository($department);
        $result = (new DepartmentService($department_repo))->getDepartmentById(1); //$this->employeeService->getDepartmentById(1);

        // Assertions
        $this->assertEquals(1, $result['id']);
        $this->assertEquals('IT Department', $result['name']);
    }
}
