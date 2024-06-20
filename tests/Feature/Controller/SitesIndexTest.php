<?php

namespace Tests\Feature\Controller;

use App\Models\Category;
use App\Models\Site;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SitesIndexTest extends TestCase
{
    public function testItCannotListSitesWithUserUnauthenticated(): void
    {
        $response = $this->get(route('sites.index'));
        $response->assertRedirect(route('login'));
    }
    public function testItCanListSites(): void
    {
        Site::factory()
            ->for(Category::factory()->create())
            ->create([
            'name' => 'Mi sitio'
        ]);
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get(route('sites.index'));
        $response->assertOk();
        $response->assertSee('Mi sitio');
    }
}
