<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\CheckIndex;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\URL;
use Livewire\Livewire;
use Tests\TestCase;

class CheckIndexTest extends TestCase
{
    /** @test */
    public function test_render()
    {
        $component = Livewire::test(CheckIndex::class);

        $component->assertStatus(200);
    }

    public function test_url_is_required()
    {
        Livewire::test(CheckIndex::class)
            ->set('urls', '')
            ->call('startCheck')
            ->assertHasErrors(['urls' => 'required']);
    }

    function test_check_index_page_contains_livewire_component()
    {
        $this->get('/en/check-index')->assertSeeLivewire(CheckIndex::class);
    }


    public function test_url_explode()
    {
        URL::defaults(['lang' => 'en']);
        Livewire::test(CheckIndex::class)
            ->set('urls', 'http://seotools.local/check-index')
            ->call('startCheck')
            ->call('checking')
            ->assertSee('q=site:seotools.local/check-index');
    }
}
