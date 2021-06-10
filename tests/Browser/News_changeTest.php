<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\News;


class News_changeTest extends DuskTestCase
{
    private $link;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testNewsChangeOK()
    {
        // get link to change a News with highest ID
        $newsWithMaxID = (new News())->orderBy('id', 'desc')->take(1)->get();
        if ($newsWithMaxID->count() != 1) { return; } 
        
        $this->link = '/newsadm/edit/'.($newsWithMaxID[0]->id);

        $this->browse(function (Browser $browser) {
            $browser->visit($this->link);
            $title = 'Changed by DUSK';
            $browser
                ->type('title', $title)
                ->type('content', $title)
                ->press('Сохранить')
                ->assertPathIs('/newsadm')
                ->assertSee('Changed by DUSK');
        });        
    }

    public function testNewsChangeNOK()
    {
        // get link to change a News with highest ID
        $newsWithMaxID = (new News())->orderBy('id', 'desc')->take(1)->get();
        if ($newsWithMaxID->count() != 1) { return; } 
        
        $this->link = '/newsadm/edit/'.($newsWithMaxID[0]->id);
        
        
        $this->browse(function (Browser $browser) {
            $browser->visit($this->link)
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
