<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSecureTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_is_unavailable_to_guests()
    {
        $response = $this->get('/admin/familie');
        $response->assertStatus(302);
    }

    public function test_import_parse_unavailable_to_simple_user()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/import_parse');

        $response->assertStatus(302);
    }

    public function test_logged_in_simple_user_cant_see_admin_familie()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/familie');

        $response->assertForbidden();
    }

    public function test_logged_in_simple_user_cant_see_admin_lebenslauf()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/lebenslauf');

        $response->assertForbidden();
    }


    public function test_logged_in_simple_user_cant_see_admin_verweise()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/verweise');

        $response->assertForbidden();
    }

    public function test_admin_user_can_see_admin_familie()
    {
        $user = User::factory()->isAdmin()->create();

        $response = $this->actingAs($user)->get('/admin/familie');

        $response->assertOk();
    }

    public function test_admin_user_can_see_admin_lebenslauf()
    {
        $user = User::factory()->isAdmin()->create();

        $response = $this->actingAs($user)->get('/admin/lebenslauf');

        $response->assertOk();
    }

    public function test_admin_user_can_see_admin_verweise()
    {
        $user = User::factory()->isAdmin()->create();

        $response = $this->actingAs($user)->get('/admin/verweise');

        $response->assertOk();
    }
}
