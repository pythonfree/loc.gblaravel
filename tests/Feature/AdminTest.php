<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    public function test_admin_create_access()
    {
        $response = $this->get(route('admin.create'));
        $response->assertStatus(200);
    }

    public function test_admin_create_page()
    {
        $view = $this->view('admin.create', [
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
