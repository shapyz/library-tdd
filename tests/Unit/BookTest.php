<?php

namespace Tests\Unit;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_author_id_is_create()
    {
       // Given
       $books = [
           'title'  =>  'A new relic',
           'author_id' =>  1
       ];

       // When
       Book::create($books);

       // Then
       $this->assertCount(1, Book::all());
    }
}
