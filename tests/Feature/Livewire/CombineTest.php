<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Combine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CombineTest extends TestCase
{
    use WithFaker;
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Combine::class);

        $component->assertStatus(200);
    }

    public function test_work_correct()
    {
        $list1 = $this->faker->word();
        $list2 = $this->faker->word();
        Livewire::test(Combine::class)
            ->set('list.1', '   ' . $list1 . '   ')
            ->set('list.2', '   ' . $list2 . '   ')
            ->call('combine')
            ->assertSet('result', "$list1 $list2")
            ->assertNotSet('result', " $list1 $list2")
            ->assertNotSet('result', $this->faker->word())
            ->assertSet('resultCount', 1);
    }
}
