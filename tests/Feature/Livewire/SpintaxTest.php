<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Spintax;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SpintaxTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        Livewire::test(Spintax::class)
            ->assertStatus(200)
            ->call('process')
            ->assertHasErrors(['input' => 'required'])
            ->set('input', '{1|1|1}')
            ->call('process')
            ->assertHasNoErrors('input')
            ->assertNotSet('result', '{1|2|3}')
            ->assertSet('result', '1');
    }
}
