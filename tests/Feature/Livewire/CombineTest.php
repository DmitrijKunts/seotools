<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Combine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CombineTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Combine::class);

        $component->assertStatus(200);
    }
}
