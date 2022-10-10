<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class AdminFunctionsTest extends DuskTestCase
{
    /**
     * @return void
     * @throws Throwable
     */
    public function testNewsAndCategories(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/categories')
                ->type('title', 'Категория для теста')
                ->click('@create-category')
                ->screenshot(date('Y-m-d H:i:s') . ' - create-category')
                ->assertSee('Категория для теста');
        });

        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/create')
                ->type('title', 'Заголовок новости для теста Dusk.')
                ->select('category_id', '1')
                ->type('text', 'Текст новости для теста Dusk.')
                ->click('@create-article')
                ->screenshot(date('Y-m-d H:i:s') . ' - create-article')
                ->assertSee('Новость успешно добавлена');
        });
    }
}
