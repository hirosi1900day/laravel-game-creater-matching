<?php

namespace Tests\Feature;

use App\User;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostSubmitApiTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function 投稿が新規登録ができる() {
        $validData = [
            'title' => 'postTitle',
            'content' => 'post内容',
        ];
        
        $this->login();
        $this->post('api/posts', $validData);
        $this->assertDatabaseHas('posts', $validData);
    }
    /** @test update */
    public function 自分の投稿は更新できる() {
        $this->withoutExceptionHandling();
        $validData = [
            'title' => '新タイトル',
            'content' => '新コンテント'
        ];
        $user = factory(User::class)->create();
        $this->login($user);
        $post = factory(Post::class)->create(['user_id' => $user->id]);
        $this->put('api/posts/'.$post->id.'/myupdate',$validData);
        $this->assertDatabaseHas('posts', $validData);
    }
    /** @test delete */
    public function 他人の投稿は削除できない() {
        //
    }
    /** @test edit */
    public function 他人の投稿は更新できる() {
        //
    }
}
