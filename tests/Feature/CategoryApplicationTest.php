<?php

namespace Tests\Feature;

use App\Application;
use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryApplicationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_get_all_category_from_system()
    {
        // Test

        $this->withoutExceptionHandling();

        $users = factory(\App\User::class)->create();
        $users->roles()->save(factory(\App\Roles::class)->create());

        $categories = factory(Category::class)->create();

        $response = $this->actingAs($users)->get('/me/categories');

        $response->assertOk();

        $category_list = $categories->all();

        $response->assertViewIs('client.categoryList');
        $response->assertViewHas('categories', $category_list);
    }

    /** @test */
    public function test_get_apps_from_category()
    {
        $this->withoutExceptionHandling();

        $users = factory(\App\User::class)->create();
        $users->roles()->save(factory(\App\Roles::class)->create());

        // $application = factory(Application::class, 5)->create();
        $categories = factory(Category::class)->create();


        $response = $this->actingAs($users)->get('/me/categories/' . $categories->id);

        $response->assertOk();

        //$app_list_category = Application::where('id_category', $categories->id)->get();
        $app_list_category = Application::where('id_category', $categories->id)->get();


        $response->assertViewIs('client.applicationCategory');
        $response->assertViewHas('applicationsCategory', $app_list_category);
    }

    /** @test */
    public function test_get_detail_app()
    {
        // Test

        $this->withoutExceptionHandling();

        $users = factory(\App\User::class)->create();
        $users->roles()->save(factory(\App\Roles::class)->create());
        $application = factory(Application::class)->create();

        $response = $this->actingAs($users)->get('/me/appDetail/' . $application->id);
        $response->assertOk();

        $app_detail = Application::where('id', $application->id)->get();

        $response->assertViewIs('client.appDetail');
        $response->assertViewHas('appDetail', $app_detail);
    }
}
