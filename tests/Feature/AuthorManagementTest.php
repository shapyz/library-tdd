<?php

namespace Tests\Feature;

use App\Author;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_author_can_be_created()
    {
       // Given
       $this->withoutExceptionHandling();
       $author = [
           'name'   =>  'Ashiraf',
           'dob'    =>  '12/09/1992'
       ];

       // When
       $this->post('/authors',$author);
       $author = Author::all();

       // Then
       $this->assertCount(1, $author);
       $this->assertInstanceOf(Carbon::class, $author->first()->dob);
    }
}
