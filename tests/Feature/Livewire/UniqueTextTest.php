<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\UniqueText;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UniqueTextTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $res = Livewire::test(UniqueText::class)
            ->assertStatus(200)
            ->set('ln', 'ru')
            ->call('process')
            ->assertHasErrors(['input' => 'required'])
            ->set('input', '1234')
            ->call('process')
            ->assertHasErrors(['input' => 'min'])
            ->set('ln', 'ruw')
            ->call('process')
            ->assertHasErrors('ln');


        $s = 'Привет';
        $ln = 'ru';
        $res = Livewire::test(UniqueText::class)
            ->assertStatus(200)
            ->set('ln', $ln)
            ->set('input', $s)
            ->call('process')
            ->assertHasNoErrors(['input', 'ln'])
            ->get('result');
        $this->assertTrue($res == $s);

        $s = 'Hello';
        $ln = 'en';
        $res = Livewire::test(UniqueText::class)
            ->assertStatus(200)
            ->set('ln', $ln)
            ->set('input', $s)
            ->call('process')
            ->assertHasNoErrors(['input', 'ln'])
            ->get('result');
        $this->assertTrue($res == $s);
    }
}
