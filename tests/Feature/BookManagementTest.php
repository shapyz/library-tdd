<?php

namespace Tests\Feature;

use App\Book;
use App\Author;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookManagementTest extends TestCase
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
            'author_id'    =>  'ashiraf'
        ];

        //When
        $response = $this->post('/books', $this->data());
        $book = Book::first();

        //Then
        $response->assertRedirect('/books/'.$book->id);
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
        $books = $this->data();

        // When
        $response = $this->post(
            '/books',
            array_merge($books, ['author_id' =>  '']));

        //Then
        $response->assertSessionHasErrors('author_id');
    }

    /**
     * @test
     */
    public function a_book_can_be_updated()
    {
        // Given
        $this->withoutExceptionHandling();

        $books = $this->data();
        $bookToUpdate = array_merge($this->data(),[
            'title' =>  'Cool Book Title v2',
        ]);

        // When
        $this->post('/books', $books);
        $book = Book::first();

        $response = $this->patch('/books/'.$book->id, $bookToUpdate);

        // then
        $this->assertEquals('Cool Book Title v2', Book::first()->title);
        $response->assertRedirect('/books/'.$book->id);

    }

    /**
     * @test
     */
    public function a_book_can_be_deleted()
    {
        // Given
        $this->withoutExceptionHandling();

        $books = $this->data();

        // When
        $this->post('/books', $books);
        $book = Book::first();
        $response = $this->delete('/books/'.$book->id);

        // Then
        $this->assertCount(0, Book::all());
        $response->assertRedirect('/books');

    }

    /** @test */
    function a_new_author_is_automatically_added()
    {
        $this->withoutExceptionHandling();

       // Given
        $book = $this->data();

       // When
       $this->post('/books',$book);
       $book = Book::first();
       $author = Author::first();

       // Then
       $this->assertEquals($author->id, $book->author_id);
       $this->assertCount(1, Author::all());
    }

    private function data()
    {
        return [
            'title' =>  'Cool Book Title',
            'author_id' =>  'Ashiraf Hussein'
        ];
    }
}
