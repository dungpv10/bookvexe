<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RouteAcceptanceTest extends TestCase
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
        $response = $this->actor->call('GET', 'routes');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('routes');
    }

    public function testCreate()
    {
        $response = $this->actor->call('GET', 'routes/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStore()
    {
        $response = $this->actor->call('POST', 'routes', $this->Route->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('routes/'.$this->Route->id.'/edit');
    }

    public function testEdit()
    {
        $this->actor->call('POST', 'routes', $this->Route->toArray());

        $response = $this->actor->call('GET', '/routes/'.$this->Route->id.'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('route');
    }

    public function testUpdate()
    {
        $this->actor->call('POST', 'routes', $this->Route->toArray());
        $response = $this->actor->call('PATCH', 'routes/1', $this->RouteEdited->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseHas('routes', $this->RouteEdited->toArray());
        $this->assertRedirectedTo('/');
    }

    public function testDelete()
    {
        $this->actor->call('POST', 'routes', $this->Route->toArray());

        $response = $this->call('DELETE', 'routes/'.$this->Route->id);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('routes');
    }

}
