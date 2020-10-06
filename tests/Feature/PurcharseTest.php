<?php

namespace Tests\Feature;

use App\Purcharse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PurcharseTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_get_a_list_of_purcharse()
    {
        $this->withoutExceptionHandling();


        $users = factory(\App\User::class)->create();
        $users->roles()->save(factory(\App\Roles::class)->create());

        //$purcharses = factory(Purcharse::class, 2)->create();

        $response = $this->actingAs($users)->post('/me/purcharsed', [$users->id]);

        $response->assertOk();

        $purcharses_list = Purcharse::where('user_id', $users->id)->get();

        $response->assertViewIs('client.applicationBuyList');
        $response->assertViewHas('applicationBuyList', $purcharses_list);
    }
}
