<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Category_addTest extends DuskTestCase
{
    private $dateTime;
    
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCategoryAddOK()
    {
        $this->dateTime = date("d-m-y H:i:s");
        
        $this->browse(function (Browser $browser) {
            $browser->visit('/catsadm/add')
                ->type('title', 'Новая категория, создана DUSK в ' . $this->dateTime)
                ->press('Сохранить')
                ->assertPathIs('/catsadm')
                ->assertSee('Новая категория, создана DUSK в ' . $this->dateTime);
        });        
    }

    public function testSecondCategoryAddOK() {
        $this->testCategoryAddOK();
    }

    public function testCategoryAddNOK()
    {
        $this->dateTime = date("d-m-y H:i:s");
        
        $this->browse(function (Browser $browser) {
            $browser->visit('/catsadm/add')
                ->type('title','')
                ->press('Сохранить')
                ->assertSee('Поле')
                ->assertSee('обязательно для заполнения');
        });        
    }

}
