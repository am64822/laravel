<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DownlreqTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateDownloadRequestOK()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/downlreq')
                ->type('userName', 'Nikolay')
                ->type('phone', '+43(547)8987681')
                ->type('email', 'test@test.com')
                ->type('content', 'Please send me something')
                ->press('Отправить')
                ->assertSee('Заказ номер');
        });
    }

    public function testCreateDownloadRequestNOK()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/downlreq')
                ->type('userName', 'Nikolay')
                ->type('phone', '+7(999)00')
                ->type('email', 'test@test.com')
                ->type('content', 'Please send me something')
                ->press('Отправить')
                ->assertSee('Поле')
                ->assertSee('имеет ошибочный формат');
        });
    }

}
