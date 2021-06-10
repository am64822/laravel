<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Source;


class Source_changeTest extends DuskTestCase
{
    private $link;
    private $dateTime;
    
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testSourceChangeOK()
    {
        $this->dateTime = date("d-m-y H:i:s");
        
        // get link to change a Category with highest ID
        $sourceWithMaxID = (new Source())->orderBy('id', 'desc')->take(1)->get();
        if ($sourceWithMaxID->count() != 1) { return; } 
        
        $this->link = '/srcadm/edit/'.($sourceWithMaxID[0]->id);

        $this->browse(function (Browser $browser) {
            $browser->visit($this->link);
            $title = 'Changed by DUSK at ' . $this->dateTime;
            $browser
                ->type('descr', 'Changed by DUSK at ' .$this->dateTime)
                ->press('Сохранить')
                ->assertPathIs('/sourcadm')
                ->assertSee('Changed by DUSK at ' . $this->dateTime);
        });        
    }

    public function testSourceChangeNOK()
    {
        $this->dateTime = date("d-m-y H:i:s");
        
        // get link to change a Category with highest ID
        $sourceWithMaxID = (new Source())->orderBy('id', 'desc')->take(1)->get();
        if ($sourceWithMaxID->count() != 1) { return; } 
        
        $this->link = '/srcadm/edit/'.($sourceWithMaxID[0]->id);

        $this->browse(function (Browser $browser) {
            $browser->visit($this->link);
            $browser
                ->type('descr', '')
                ->press('Сохранить')
                ->assertSee('Поле')
                ->assertSee('обязательно для заполнения');
        });        
    }

}
