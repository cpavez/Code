<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Note;

class PruebaTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListadoNotas()
    {
    		Note::create(['note' => 'My first note']);
    		Note::create(['note' => 'Second note']);


			$this->visit('notes')
				 ->see('My first note')
				 ->see('Second note');
    }
}
