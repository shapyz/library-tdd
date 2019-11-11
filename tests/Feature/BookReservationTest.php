<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
    }
    /**
     *
     * @return void
     */
    /** @test */
    public function a_book_can_be_added_to_the_libray()
    {
        // Given
        $this->withoutExceptionHandling();
        $books = [
            'title' =>  'Coll book Title',
            'author'    =>  'ashiraf' 
        ];

        //When
        $response = $this->post('/books', $books);

        //Then
        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    /**
     * @test
     */
    public function a_title_is_required()
    {
        // Given 
        $books = [
            'title' =>  '',
            'author'    =>  'ashiraf' 
        ];

        // When
        $response = $this->post('/books', $books);

        //Then
        $response->assertSessionHasErrors('title');

    }

    /**
     * @test
     */
    public function an_author_is_required()
    {
        // Given 
        $books = [
            'title' =>  'Cool Book Title',
            'author'    =>  '' 
        ];

        // When
        $response = $this->post('/books', $books);

        //Then
        $response->assertSessionHasErrors('author');
    }

    /**
     * @test
     */
    public function a_book_can_be_updated()
    {
        // Given 
        $this->withoutExceptionHandling();

        $books = [
            'title' =>  'Cool Book Title',
            'author'    =>  'ashiraf' 
        ];
        $bookToUpdate = [
            'title' =>  'Cool Book Title v2',
            'author'    =>  'ashiraf' 
        ];

        // When
        $this->post('/books', $books);
        $book = Book::first();

        $response = $this->patch('/books/'.$book->id, $bookToUpdate);

        // then
        $this->assertEquals('Cool Book Title v2', Book::first()->title);


    }
}
