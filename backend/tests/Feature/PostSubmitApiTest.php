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
        $post = factory(Post::class)->create(['user_id' => $this->user->id]);
        $user2 = factory(User::class)->create();
        $this->login($user2);
        $this->delete('api/posts/'.$post->id.'/delete')
        ->assertStatus(403);
        $this->assertDatabaseHas('posts', ['id' => $post->id]);
    }
    /** @test delete */
    public function 自分の投稿は削除できる() {
        
        $post = factory(Post::class)->create(['user_id' => $this->user->id]);
        $this->login($post->user);
        $this->delete('api/posts/'.$post->id.'/delete')
        ->assertStatus(200);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
    /** @test edit */
    public function 他人の投稿は更新できない() {
        $validData = [
            'title' => '新タイトル',
            'content' => '新コンテント'
        ];

        $user2 = factory(User::class)->create();
        $post = factory(Post::class)->create(['user_id' => $user2->id]);
        $user = factory(User::class)->create();
        $this->login($user);
        $this->put('api/posts/'.$post->id.'/mypost', $validData)
        ->assertStatus(405);
    }
}
