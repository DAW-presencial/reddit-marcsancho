<?php

namespace Tests\Feature;

use App\Models\Community;
use App\Models\User;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     *
        can fetch all communities()

        can fetch single communities()

        can create community()

        guests cannot create community

        can update community

        can delete community

        return json api error object when comunnity not found
     */
    public function test_can_fetch_all_communities()
    {

        $response = $this->getJson(route('communities.index'));
        $response->assertStatus(200);


    }

    public function test_can_fetch_single_communities()
    {

        $response = $this->getJson(route('communities.show', 1));
        $response->assertStatus(200);


    }

    public function test_can_create_community()
    {

        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson(route('communities.store'), [
            'name' => 'Test Community'
        ]);

        $response->assertStatus(201);

    }

    public function test_guests_cant_create_community()
    {

        $response = $this->postJson(route('communities.store'), [
            'name' => 'Test Community'
        ]);

        $response->assertStatus(401);

    }

    public function test_can_update_community()
    {

        Sanctum::actingAs(User::factory()->create());

        $response = $this->putJson(route('communities.update', 1), [
            'name' => 'Test Community'
        ]);

        $response->assertStatus(200);

    }

    /*
    public function test_can_delete_community()
    {

        Sanctum::actingAs(User::factory()->create());

        $response = $this->deleteJson(route('communities.destroy', 1), [
            'name' => 'Test Community'
        ]);

        $response->assertStatus(200);

    }
    */

    public function test_return_json_error_when_community_not_found()
    {

        $response = $this->getJson(route('communities.show', 76346436));
        $response -> assertJsonStructure([
            'message'
        ]);

    }
}
