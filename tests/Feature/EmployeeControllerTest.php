<?php
namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
{
    // use RefreshDatabase; // Membersihkan database setelah setiap test

    /**
     * Test index page shows employees.
     */
    public function test_it_shows_employee_list()
    {
        // Arrange: Buat beberapa perusahaan
        $company = Company::factory()->create();

        // Buat beberapa karyawan yang terasosiasi dengan perusahaan
        $employees = Employee::factory()->count(10)->create([
            'company_id' => $company->id,
        ]);

        // Act: Akses halaman index
        $response = $this->get(route('employees.index'));

        // Assert: Periksa respons
        $response->assertStatus(200);
        foreach ($employees as $employee) {
            $response->assertSee($employee->firstname);
            $response->assertSee($employee->lastname);
        }
    }

    /**
     * Test creating an employee.
     */
    public function test_it_can_create_an_employee()
    {
        // Arrange: Buat perusahaan
        $company = Company::factory()->create();

        // Data karyawan yang akan dikirim
        $data = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'johndoe@example.com',
            'phone' => '123456789',
            'company_id' => $company->id,
        ];

        // Act: Kirim data untuk membuat karyawan
        $response = $this->post(route('employees.store'), $data);

        // Assert: Periksa apakah data ada di database
        $response->assertRedirect(route('employees.index'));
        $this->assertDatabaseHas('employees', ['firstname' => 'John']);
    }

    /**
     * Test updating an employee.
     */
    public function test_it_can_update_an_employee()
    {
        // Arrange: Buat perusahaan dan karyawan
        $company = Company::factory()->create();
        $employee = Employee::factory()->create([
            'company_id' => $company->id,
        ]);

        // Data karyawan yang akan diupdate
        $updatedData = [
            'firstname' => 'Jane',
            'lastname' => 'Doe',
            'email' => 'janedoe@example.com',
            'phone' => '987654321',
            'company_id' => $company->id,
        ];

        // Act: Update data karyawan
        $response = $this->put(route('employees.update', $employee->id), $updatedData);

        // Assert: Periksa apakah data diupdate di database
        $response->assertRedirect(route('employees.index'));
        $this->assertDatabaseHas('employees', ['firstname' => 'Jane']);
    }

    /**
     * Test deleting an employee.
     */
    public function test_it_can_delete_an_employee()
    {
        // Arrange: Buat perusahaan dan karyawan
        $company = Company::factory()->create();
        $employee = Employee::factory()->create([
            'company_id' => $company->id,
        ]);

        // Act: Hapus data karyawan
        $response = $this->delete(route('employees.destroy', $employee->id));

        // Assert: Periksa apakah data karyawan dihapus dari database
        $response->assertRedirect(route('employees.index'));
        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }

}
