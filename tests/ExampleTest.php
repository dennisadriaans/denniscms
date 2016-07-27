<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{

    public function testIfAdminWorks()
    {
        $this->visit('/admin/1')
            ->see('nav');
    }

    public function testNew()
    {
        $this->action('GET', 'AdminController@pages');
    }
}
