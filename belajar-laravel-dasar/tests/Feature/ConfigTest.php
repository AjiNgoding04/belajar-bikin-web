<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigTest extends TestCase
{
    public function test_config_php(){
        $first_name = config("contoh.name.first");
        $last_name = config("contoh.name.last");
        $email = config("contoh.email");
        $ig = config("contoh.ig");
        self::assertEquals("Aji",$first_name);
        self::assertEquals("Nugroho",$last_name);
        self::assertEquals("achreajinug@gmail.com",$email);
        self::assertEquals("@Azi_Nocks",$ig);
    }
}
