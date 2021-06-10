<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Category;


class Category_changeTest extends DuskTestCase
{
    private $link;
    private $dateTime;
    
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCategoryChangeOK()
    {
        $this->dateTime = date("d-m-y H:i:s");
        
        // get link to change a Category with highest ID
        $categoryWithMaxID = (new Category())->orderBy('id', 'desc')->take(1)->get();
        if ($categoryWithMaxID->count() != 1) { return; } 
        
        $this->link = '/catsadm/edit/'.($categoryWithMaxID[0]->id);

        $this->browse(function (Browser $browser) {
            $browser->visit($this->link);
            $title = 'Changed by DUSK at ' . $this->dateTime;
            $browser
                ->type('title', $title)
                ->press('Сохранить')
                ->assertPathIs('/catsadm')
                ->assertSee('Changed by DUSK at ' . $this->dateTime);
        });        
    }

    public function testCategoryChangeNOK()
    {
        // get link to change a Category with highest ID
        $categoryWithMaxID = (new Category())->orderBy('id', 'desc')->take(1)->get();
        if ($categoryWithMaxID->count() != 1) { return; }  
        
        $this->link = '/catsadm/edit/'.($categoryWithMaxID[0]->id);

        $this->browse(function (Browser $browser) {
            $browser->visit($this->link);
            $browser
                ->type('title', '')
                ->press('Сохранить')
                ->assertSee('Поле')
                ->assertSee('обязательно для заполнения');
        });        
    }

}
