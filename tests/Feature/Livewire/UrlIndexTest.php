<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\UrlIndex;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UrlIndexTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(UrlIndex::class);

        $component->assertStatus(200);
    }
}
