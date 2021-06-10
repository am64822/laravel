<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Source_addTest extends DuskTestCase
{
    private $dateTime;
    
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testSourceAddOK()
    {
        $this->dateTime = date("His");
        
        $this->browse(function (Browser $browser) {
            $browser->visit('/srcadm/add')
                ->type('link', 'https://testlink' . $this->dateTime . '.com')
                ->type('descr', 'Created by DUSK')
                ->press('Сохранить')
                ->assertPathIs('/sourcadm')
                ->assertSee('https://testlink' . $this->dateTime . '.com');
        });        
    }


    public function testSecondSourceAddOK() {
        $this->testSourceAddOK();
    }


    public function testCategoryAddNOK()
    {
        $this->dateTime = date("His");
        
        $this->browse(function (Browser $browser) {
            $browser->visit('srcadm/add')
                ->type('link', 'https://testlink' . $this->dateTime . '.com')
                ->type('descr', '')
                ->press('Сохранить')
                ->assertSee('Поле')
                ->assertSee('обязательно для заполнения');
        });        
    }

}
