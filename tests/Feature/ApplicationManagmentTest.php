<?php

namespace Tests\Feature;

use App\Application;
use App\ApplicationUserState;
use App\State;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;

class ApplicationManagmentTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function test_create_application_if_is_developer()
    {
        $this->withoutExceptionHandling();

        $users = factory(\App\User::class)->create();
        $users->role()->save(factory(\App\Role::class)->create());

        $response =  $this->actingAs($users)->post('/me/app', [
            'name' => 'TestApplication',
            'price' => rand(12, 57) / 10,
            'category_id' => 1,
            'slug'=>'Music',
            'vote' =>  10,
            'description'=>'Descripcion de la apliacion',
            //'image_src' => $faker->image(public_path('/images/applications'), $width = 240, $height = 240),
            'image_src' => '/images/applications',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);


        $this->assertCount(1, Application::all());

        $application = Application::first();

        $this->assertEquals($application->name, 'TestApplication');
        $this->assertEquals($application->category_id, 1);

        $response->assertRedirect('/me/my-list-app');
    }



    /** @test */
    public function test_an_application_can_be_updated_execept_name_and_category_if_is_developer()
    {
        $this->withoutExceptionHandling();

        $users = factory(\App\User::class)->create();
        $users->role()->save(factory(\App\Role::class)->create());

        $application = factory(Application::class)->create();

        $response =  $this->actingAs($users)->put('/me/app/' . $application->id, [
            'name' => $application->name,
            'price' => rand(12, 57) / 10,
            'id_category' => $application->category_id,
            'user_id' => 1,
            'vote' =>  1,
            'image_src' => '/images/applications',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $this->assertCount(1, Application::all());

        $application = $application->fresh();

        $this->assertEquals($application->name, $application->name);
        $this->assertEquals($application->category_id, $application->category_id);

        $response->assertRedirect('/me/my-list-app/');
    }

    /** @test */
    public function test_an_application_can_be_deleted_if_is_developer()
    {
        $this->withoutExceptionHandling();

        $users = factory(\App\User::class)->create();
        $users->role()->save(factory(\App\Role::class)->create());

        $application = factory(Application::class)->create();

        $response =  $this->actingAs($users)->delete('/me/app/' . $application->id);

        $this->assertCount(0, Application::all());

        $response->assertRedirect('/me/my-list-app');
    }


    /** @test */
    public function test_if_can_buy_a_app_if_client()
    {

        $this->withoutExceptionHandling();


        $users = factory(\App\User::class)->create();
        $users->role()->attach(factory(\App\Role::class)->create());

        $application = factory(Application::class)->create();

        $state = factory(State::class)->create();


        //$users = factory(\App\User::class)->create();

        $response = $this->actingAs($users)->post('/me/buy', ["app_id" => $application->id]);

        $response->assertOk();

        //$apps = DB::select('select * from application_user_states where user_id = ? and application_id = ?', [$users->id, $application->id]);
        $apps = ApplicationUserState::where('user_id', $users->id)->where('application_id', $application->id)->first();


        $this->assertEquals($apps->user_id, $users->id);
        $this->assertEquals($apps->application_id, $application->id);
        $this->assertEquals($apps->state_id, $state->id);



        //$response->assertRedirect('/me/buy');

        //  $response->assertViewIs('developer.applicationList');
        //  $response->assertViewHas('apps', $apps);
    }

    public function test_cancel_buy_if_is_Cliente()
    {


        $this->withoutExceptionHandling();


        $users = factory(\App\User::class)->create();
        $users->role()->attach(factory(\App\Role::class)->create());

        $application = factory(Application::class)->create();
        $state = factory(State::class)->create();

        //$users = factory(\App\User::class)->create();

        $response = $this->actingAs($users)->delete('/me/cancelbuy/' . $application->id);

        $response->assertOk();

        $this->assertCount(0, ApplicationUserState::all());
    }
}
