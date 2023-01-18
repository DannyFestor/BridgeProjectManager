<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

//    /** @test */
//    public function dashboard_contains_products()
//    {
//        $user = \App\Models\User::factory()->create();
//        $project = \App\Models\Project::factory()->create(['user_id' => $user]);
//
//        $this
//            ->actingAs($user)
//            ->get(route('dashboard'))
//            ->assertStatus(200)
//            ->assertInertia(fn (Assert $page) => $page
//                ->component('Dashboard')
//                ->has('projects', 1, fn (Assert $page) => $page
//                    ->where('uuid', (string) $project->uuid)
//                    ->where('title', $project->title)
//            ));
//    }

    /** @test */
    public function the_product_create_page_can_be_viewed()
    {
        $user = \App\Models\User::factory()->create();

        $this
            ->actingAs($user)
            ->get(route('projects.create'))
            ->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page
                ->component('Project/Create')
            );
    }
}
