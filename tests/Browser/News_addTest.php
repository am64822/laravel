<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class News_addTest extends DuskTestCase
{
    private $dateTime;
    
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testNewsAddOK()
    {
        $this->dateTime = date("d-m-y H:i:s");
        
        $this->browse(function (Browser $browser) {
            $browser->visit('/newsadm/add')
                ->select('category_id', 'Категория 2')
                ->type('title', 'Новая новость в Категории 2')
                ->type('content', 'Создана DUSK в ' . $this->dateTime)
                ->select('status', 'Проект')
                ->press('Сохранить')
                ->assertPathIs('/newsadm')
                ->assertSee('Создана DUSK в ' . $this->dateTime);
        });        
    }

    public function testSecondNewsAddOK() {
        $this->testNewsAddOK();
    }


    public function testNewsAddNOK()
    {
        $this->dateTime = date("d-m-y H:i:s");
        
        $this->browse(function (Browser $browser) {
            $browser->visit('/newsadm/add')
                ->select('category_id', 'Категория 2')
                ->type('title', '')
                ->type('content', 'Новая новость в Категории 2')
                ->select('status', 'Проект')
                ->press('Сохранить')
                ->assertSee('Поле')
                ->assertSee('обязательно для заполнения');
        });        
    }

}
