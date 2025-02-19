<?php

namespace Tests\Feature;
use App\Data\Foo;
use App\Data\Bar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DevInjectionTest extends TestCase
{
    public function test_dev_injection() {
        $foo = new Foo();
        $bar = new Bar($foo);
        self::assertEquals("foo and bar", $bar->bar()); 
    }
}
