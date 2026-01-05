<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class VulnerableUploadTest extends TestCase
{
    public function test_vulnerable_route_allows_invalid_file_with_placeholder_attribute()
    {
        $file = UploadedFile::fake()->create('payload.php', 1, 'text/plain');

        $response = $this->postJson('/vulnerable-upload', [
            'files' => [
                '__asterisk__' => $file,
            ],
        ]);

        $response
            ->assertOk()
            ->assertJson(fn (AssertableJson $json) => $json
                ->where('passes', true)
                ->etc());
    }
}
