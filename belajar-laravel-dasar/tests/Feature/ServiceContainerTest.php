<?php

namespace Tests\Feature;
use App\Data\Foo;
use App\Data\Bar;
use App\Services\{HelloService,HelloServiceIndonesia};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function test_service_container() {
        $this->app->bind(Bar::class,function() {
            $foo = $this->app->make(Foo::class);
            return new Bar($foo);
        });
        $bar = $this->app->make(Bar::class);
        self::assertEquals("foo and bar",$bar->bar());
    }

    public function test_service_singleton() {
        $this->app->singleton(Bar::class,function($app){
            $foo = $app->make(Foo::class);
            return new Bar($foo);
        });
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);
        self::assertEquals("foo and bar",$bar1->bar());
        self::assertSame($bar1,$bar2);
    }

    public function test_service_instance() {
        $foo = $this->app->make(Foo::class);
        $bar = new Bar($foo);
        $this->app->instance(Bar::class,$bar);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);
        self::assertSame($bar,$bar1);
        self::assertSame($bar,$bar2);
        self::assertSame($bar1,$bar2);
    }

    public function test_dev_inject(){
        $this->app->singleton(Foo::class,function ($app) {
            return new Foo;
        });
        $this->app->singleton(Bar::class,function($app) {
            return new Bar($app->make(Foo::class));
        });
        $foo = $this->app->make(Foo::class);
        $bar1=$this->app->make(Bar::class);
        $bar2=$this->app->make(Bar::class);
        self::assertSame($foo,$bar1->foo);
        self::assertSame($bar1,$bar2);
    }

    public function test_interface_container(){
        $this->app->singleton(HelloService::class,HelloServiceIndonesia::class);
        $hello=$this->app->make(HelloService::class);
        self::assertEquals("Hello Aji",$hello->Hello("Aji"));
    }
}
