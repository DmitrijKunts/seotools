<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocalizationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_available_langs()
    {
        $this->get('/')->assertStatus(200);
        foreach (config('app.available_locales') as $ln) {
            $this->get("/$ln")->assertStatus(200);
        }
        foreach (config('app.available_locales') as $ln) {
            $this->get("/$ln/login")->assertStatus(200);
        }
        $this->get("/re")->assertStatus(404);
        $this->get("/login")->assertStatus(404);
    }

    public function test_ru_switch()
    {
        $this->get('/ru')
            ->assertStatus(200)
            ->assertSee('Войти')
            ->assertDontSee('Log in');
    }

    public function test_en_switch()
    {
        $this->get('/en')
            ->assertStatus(200)
            ->assertDontSee('Войти')
            ->assertSee('Log in');
    }

    public function test_switcher()
    {
        foreach (config('app.available_locales') as $ln) {
            $res = $this->get("/$ln/check-index");
            foreach (config('app.available_locales') as $ln2) {
                if($ln == $ln2){
                    continue;
                }
                $res->assertSee("/$ln2/check-index");
            }
        }
    }
}
