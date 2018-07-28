<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RouteAcceptanceApiTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->Route = factory(App\Models\Route::class)->make([
            // Route table data
        ]);
        $this->RouteEdited = factory(App\Models\Route::class)->make([
            // Route table data
        ]);
        $user = factory(App\Models\User::class)->make();
        $this->actor = $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->actor->call('GET', 'api/v1/routes');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'api/v1/routes', $this->Route->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['id' => 1]);
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'api/v1/routes', $this->Route->toArray());
        $response = $this->actor->call('PATCH', 'api/v1/routes/1', $this->RouteEdited->toArray());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('routes', $this->RouteEdited->toArray());
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'api/v1/routes', $this->Route->toArray());
        $response = $this->call('DELETE', 'api/v1/routes/'.$this->Route->id);
        $this->assertEquals(200, $response->getStatusCode());
        $this->seeJson(['success' => 'route was deleted']);
    }

}
