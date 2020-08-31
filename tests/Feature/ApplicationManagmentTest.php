<?php

namespace Tests\Feature;

use App\Application;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\This;

class ApplicationManagmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_list_of_application_can_be_retrieved_if_is_developer()
    {

        $this->withoutExceptionHandling();


        $users = factory(\App\User::class)->create();
        $users->roles()->save(factory(\App\Roles::class)->create());

        $application = factory(Application::class, 2)->create();

        $response = $this->actingAs($users)->post('/me/listApp', [$users->id]);

        $response->assertOk();

        $applications_list = $application->where('user_id', $users->id)->all();

        $response->assertViewIs('developer.applicationList');
        //$response->assertViewHas('applicationList', $applications_list);
    }


    /** @test */
    public function test_obtain_application_deatils()
    {

        $this->withoutExceptionHandling();


        $users = factory(\App\User::class)->create();
        $users->roles()->save(factory(\App\Roles::class)->create());

        $application = factory(Application::class)->create();

        $response = $this->actingAs($users)->get('/me/app/' . $application->id);

        $response->assertOk();

        $application = Application::where('user_id', $users->id)->where('id', $application->id)->first();

        $response->assertViewIs('developer.application');
        $response->assertViewHas('application', $application);
    }


    /** @test */
    public function test_create_application_if_is_developer()
    {
        $this->withoutExceptionHandling();

        $users = factory(\App\User::class)->create();
        $users->roles()->save(factory(\App\Roles::class)->create());

        $response =  $this->actingAs($users)->post('/me/app', [
            'name' => 'TestApplication',
            'price' => rand(12, 57) / 10,
            'id_category' => 1,
            'user_id' => 1,
            'vote' =>  1,
            'image_src' => '/images/applications',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $this->assertCount(1, Application::all());

        $application = Application::first();

        $this->assertEquals($application->name, 'TestApplication');
        $this->assertEquals($application->id_category, 1);

        $response->assertRedirect('/me/app/' . $application->id);
    }



    /** @test */
    public function test_an_application_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $users = factory(\App\User::class)->create();
        $users->roles()->save(factory(\App\Roles::class)->create());

        $application = factory(Application::class)->create();

        $response =  $this->actingAs($users)->put('/me/app/' . $application->id, [
            'name' => 'UpdateApplication',
            'price' => rand(12, 57) / 10,
            'id_category' => 1,
            'user_id' => 1,
            'vote' =>  1,
            'image_src' => '/images/applications',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $this->assertCount(1, Application::all());

        $application = $application->fresh();

        $this->assertEquals($application->name, 'UpdateApplication');
        $this->assertEquals($application->id_category, 1);
        $response->assertRedirect('/me/app/' . $application->id);
    }

    /** @test */
    public function test_an_application_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $users = factory(\App\User::class)->create();
        $users->roles()->save(factory(\App\Roles::class)->create());

        $application = factory(Application::class)->create();

        $response =  $this->actingAs($users)->delete('/me/app/' . $application->id);

        $this->assertCount(0, Application::all());

        $response->assertRedirect('/me/listApp');
    }
}
