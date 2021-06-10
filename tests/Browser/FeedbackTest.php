<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FeedbackTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreateFeedbackOK()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/feedback')
                ->type('userName', 'Nikolay')
                ->type('feedbackTxt', 'My feedback')
                ->press('Отправить')
                ->assertSee('Сообщение отправлено. Спасибо за Вашу обратную связь!');
        });
    }

    public function testCreateFeedbackNOK()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/feedback')
                ->type('userName', '')
                ->type('feedbackTxt', 'My feedback')
                ->press('Отправить')
                ->assertSee('Поле')
                ->assertSee('обязательно для заполнения');
        });
    }
}
