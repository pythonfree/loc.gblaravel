<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_home_page_access()
    {
        $response = $this->get(route('home'));
        $response->assertStatus(200);
    }

    public function test_home_page()
    {
        $view = $this->view('index');
        $view->assertSee('Приветствую на агрегаторе новостей!');
    }

    public function test_news_index_page_access()
    {
        $response = $this->get(route('news.index'));
        $response->assertStatus(200);
    }

    public function test_news_index_page()
    {
        $view = $this->view('news.index', [
            'news' => [
                [
                    'id' => 1,
                    'title' => 'Test article',
                    'text' => 'Test article text',
                    'category_id' => '1',
                    'category' => [
                        'slug' => 'sport'
                    ]
                ]
            ],
        ]);
        $view->assertSee('Test article');
    }

    public function test_categories_index_access()
    {
        $response = $this->get(route('news.categories.index'));
        $response->assertStatus(200);
    }

    public function test_categories_index_page()
    {
        $view = $this->view('categories.index', [
            'categories' => [
                [
                    'id' => 3,
                    'title' => 'Культура (из файла)',
                    'slug' => 'culture',
                ]
            ],
        ]);
        $view->assertSee('Культура (из файла)');
    }
}
