<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\News;


class News_deleteTest extends DuskTestCase
{
    private $id;
    private $dateTime;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testNewsDeleteOK()
    { 
        // first create new News with the given attributes
        $this->dateTime = date("d-m-y H:i:s");
        
        $this->browse(function (Browser $browser) {
            $browser->visit('/newsadm/add')
                ->select('category_id', 'Категория 2')
                ->type('title', 'Новость для удаления')
                ->type('content', 'Создана DUSK в ' . $this->dateTime)
                ->select('status', 'Проект')
                ->press('Сохранить')
                ->assertPathIs('/newsadm')
                ->assertSee('Создана DUSK в ' . $this->dateTime);
        });        
        
        // allow the DB to write data
        sleep(1);
        
        // get ID of the newest News
        $newsWithMaxID = (new News())->orderBy('id', 'desc')->take(1)->get();
        if ($newsWithMaxID->count() != 1) { return; } 
        $this->id = $newsWithMaxID[0]->id;

        // delete
        $this->browse(function (Browser $browser) {
            $browser->visit('/newsadm')
                ->click('#del' . $this->id)
                ->waitForDialog($seconds = null)
                ->acceptDialog()
                ->assertDontSee('Создана DUSK в ' . $this->dateTime);
        });        
    }

}
