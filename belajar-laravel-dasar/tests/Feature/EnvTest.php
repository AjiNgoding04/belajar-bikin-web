<?php

namespace Tests\Feature;

use Illuminate\Support\Env;
use Illuminate\Support\Facades\App;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $name = env("NAMA","Nurul");
        self::assertEquals("Aji",$name);
    }

    public function test_env(){
        $author = Env::get("AUTHOR","Riska");
        self::assertEquals("Nugroho",$author);
    }

    public function test_env_app(){
        if(App::environment(["prod","dev"])){
            self::assertTrue(True);
        }else{

            self::assertFalse(True);
        }
        
    }
}
