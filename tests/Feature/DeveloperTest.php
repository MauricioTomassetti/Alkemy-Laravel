<?php

namespace Tests\Feature;

use App\Application;
use App\ApplicationUserState;
use App\State;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeveloperTest extends TestCase
{

    use RefreshDatabase;


    /** @test */
    public function test_get_my_list_of_application_if_is_developer()
    {

        $this->withoutExceptionHandling();

        $users = factory(\App\User::class)->create();
        $users->role()->attach(factory(\App\Role::class)->create());

        $application = factory(Application::class)->create();
        $application_user =  factory(ApplicationUserState::class)->create();

        $state = factory(State::class)->create();


        $response = $this->actingAs($users)->get('/me/my-list-app/' . $users->id);

        $response->assertOk();

        $apps = Application::where('id', $application->id)
            ->select('id', 'name', 'price', 'description', 'image_src')
            ->first();

        // dd($apps);
        $this->assertEquals($apps->id, $application->id);


        $response->assertViewIs('developer.index');
        //$response->assertViewHas('myapps', $apps);
    }

    /** @test */
    public function test_obtain_application_details_if_is_developer()
    {

        $this->withoutExceptionHandling();


        $users = factory(\App\User::class)->create();
        $users->role()->save(factory(\App\Role::class)->create());

        $application = factory(Application::class)->create();

        $response = $this->actingAs($users)->get('/me/app/' . $application->id);

        $response->assertOk();

        $application = Application::where('user_id', $users->id)->where('id', $application->id)->first();

        $response->assertViewIs('developer.application');
        $response->assertViewHas('application', $application);
    }
}
