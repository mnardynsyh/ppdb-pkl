<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RedirectIfAuthenticatedTest extends TestCase
{
    use DatabaseTransactions;

    public function test_guest_can_access_login()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_authenticated_admin_is_redirected_to_admin_dashboard()
{
    /** @var \App\Models\User $admin */
    $admin = User::factory()->create();

    $response = $this->actingAs($admin, 'web')->get('/login');

    $response->assertRedirect(route('admin.dashboard'));
}

public function test_authenticated_siswa_is_redirected_to_siswa_dashboard()
{
    /** @var \App\Models\Siswa $siswa */
    $siswa = Siswa::factory()->create();

    $response = $this->actingAs($siswa, 'siswa')->get('/login');

    $response->assertRedirect(route('siswa.dashboard'));
}

}
