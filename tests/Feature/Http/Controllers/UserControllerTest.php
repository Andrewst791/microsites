<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testItCannotListUsersWithUserUnauthenticated(): void
    {
        $response = $this->get(route('sites.index'));
        $response->assertRedirect(route('login'));
    }
    public function testItCanListUsers(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get(route('users.index'));

        $response->assertStatus(200);
    }
}
