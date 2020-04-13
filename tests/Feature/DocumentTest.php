<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DocumentTest extends TestCase
{
    public function testModelValidation()
    {
        $failures = [
            [],
            [ 'name' => 'this is missing a document uri' ],
            [ 'document_uri' => 'this is missing a name' ]
        ]

        foreach ($failures as $fail) {
            $doc = new App\Document();
            $this->assertFalse($doc->validate($fail))
        }

        $doc = new App\Document();
        $this->assertTrue($doc->validate([
            'name': 'A valid document',
            'document_uri': 'https://my-awesome.document'
        ]));
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
