<?php

namespace Tests\Feature;

use App\Http\Webhooks\SEOToolsHandler;
use App\Http\Webhooks\TelegraphCmd;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TelegraphTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $h = new SEOToolsHandler();
        dd(TelegraphCmd::CheckIndex);
    }
}
