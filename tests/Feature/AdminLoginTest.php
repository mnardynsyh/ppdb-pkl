<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminLoginTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function guest_can_see_login_page()
    {
        $response = $this->get('/login');
        $response->assertStatus(200); // Halaman login tampil
    }

    /** @test */
    public function admin_can_login_with_correct_credentials()
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'admin123',
        ]);

        $response->assertRedirect(route('admin.dashboard')); // Setelah login redirect ke dashboard
        $this->assertAuthenticatedAs($admin, 'web');
    }

    /** @test */
    public function admin_cannot_login_with_wrong_password()
    {
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => 'admin@example.com',
            'password' => 'wrongpass',
        ]);

        $response->assertRedirect('/login'); // Tetap di login
        $this->assertGuest('web');
    }

    /** @test */
    /** @test */
public function logged_in_admin_is_redirected_when_accessing_login_page()
{
    /** @var \App\Models\User $admin */
    $admin = User::factory()->create();

    $this->actingAs($admin, 'web');

    $response = $this->get('/login');

    $response->assertRedirect(route('admin.dashboard')); // Middleware bekerja
}

}
