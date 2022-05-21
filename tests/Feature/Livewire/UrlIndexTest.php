<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\CheckIndex;
use App\Http\Livewire\UrlIndex;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UrlIndexTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(UrlIndex::class);

        $component->assertStatus(200);
    }

    public function test_not_view_url()
    {
        $domain = $this->faker->word() . '.' . $this->faker->word();
        $this->get('/en/url-index/' . $domain)->assertNotFound();

        $domain = 'google.com';
        Livewire::test(CheckIndex::class)
        ->set('urls', $domain)
        ->call('startCheck')
        ->call('checking')
        ->assertSee("q=site:$domain");
    }

    public function test_view_url()
    {
        $domain = 'google.com';

        $this->get('/en/url-index/' . $domain)->assertOk();
    }
}
