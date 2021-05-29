<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MyFirstTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_download_request_form_ok() // everything OK
    {
        $data = [
            'userName' => 'Automatic_test', 
            'phone' => '+43(123)1234567',
            'email' => 'test@test.com',
            'content' => 'test'
        ];
        $response = $this->post('/downlreq', $data);
        $response->assertStatus(200);
    }

    public function test_feedback_form_ok()
    {
        $data = [
            'userName' => 'Automatic_test',
            'feedbackTxt' => 'test'
        ];
        $response = $this->post('/feedback', $data);
        $response->assertStatus(200);
    }

    public function test_pages_accessibility()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response = $this->get('/cat');
        $response->assertStatus(200);
        $response = $this->get('/news/1');
        $response->assertStatus(200);
        $response = $this->get('/newscat/1');
        $response->assertStatus(200);
        $response = $this->get('/admnews');
        $response->assertStatus(200);
        $response = $this->get('/newsadd');
        $response->assertStatus(200);
        $response = $this->get('/feedback');
        $response->assertStatus(200);
        $response = $this->get('/downlreq');
        $response->assertStatus(200);
    }


}
