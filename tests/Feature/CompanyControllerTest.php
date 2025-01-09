<?php

namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyControllerTest extends TestCase
{
    // use RefreshDatabase; // Membersihkan database setelah setiap test

    /**
     * Test index page shows companies.
     */
    public function test_it_shows_company_list()
    {
        // Arrange: Buat data perusahaan
        $company = Company::factory()->create();

        // Act: Akses route index
        $response = $this->get(route('companies.index'));

        // Assert: Periksa respons
        $response->assertStatus(200);
        $response->assertSee($company->name);
    }

    /**
     * Test creating a company.
     */
    public function test_it_can_create_a_company()
    {
        // Arrange: Data perusahaan
        $data = [
            'name' => 'Test Company',
            'email' => 'test@example.com',
            'logo' => \Illuminate\Http\UploadedFile::fake()->image('logo.png'),
            'website' => 'https://example.com',
        ];

        // Act: Kirim data ke store route
        $response = $this->post(route('companies.store'), $data);

        // Assert: Periksa apakah data ada di database
        $response->assertRedirect(route('companies.index'));
        $this->assertDatabaseHas('companies', ['name' => 'Test Company']);
    }

    /**
     * Test updating a company.
     */
    public function test_it_can_update_a_company()
    {
        // Arrange: Buat perusahaan
        $company = Company::factory()->create();

        // Data baru untuk update
        $updatedData = [
            'name' => 'Updated Company',
            'email' => 'updated@example.com',
            'logo' => \Illuminate\Http\UploadedFile::fake()->image('logo.png'),
            'website' => 'https://updated.com',
        ];

        // Act: Update perusahaan
        $response = $this->put(route('companies.update', $company->id), $updatedData);

        // Assert: Periksa database
        $response->assertRedirect(route('companies.index'));
        $this->assertDatabaseHas('companies', ['name' => 'Updated Company']);
    }

    /**
     * Test deleting a company.
     */
    public function test_it_can_delete_a_company()
    {
        // Arrange: Buat perusahaan
        $company = Company::factory()->create();

        // Act: Hapus perusahaan
        $response = $this->delete(route('companies.destroy', $company->id));

        // Assert: Periksa database
        $response->assertRedirect(route('companies.index'));
        $this->assertDatabaseMissing('companies', ['id' => $company->id]);
    }
}
