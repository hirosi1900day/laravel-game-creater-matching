
@extends('layouts.app')
@section('content')
<section class="text-gray-600 body-font overflow-hidden">
  <div class="container px-5 py-24 mx-auto">
    <div class="lg:w-4/5 mx-auto flex flex-wrap">
      <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="https://dummyimage.com/400x400">
      <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
        <h2 class="text-sm title-font text-gray-500 tracking-widest">タイトル</h2>
        <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">ここにタイトルが入ります</h1>
        <div class="flex mb-4">
        </div>
        <div class="border-b-2 leading-snug">▽こんなことしたいです</div>
        <div class="text-xs text-grey-600 leading-normal md:text-sm lg:text-base xl:text:lg">{post.post.content}</div>
        <div class="border-b-2 leading-snug">▽こんな人を求めています</div>
        <div class="text-xs text-grey-600 leading-normal md:text-sm lg:text-base xl:text:lg">{post.post.resources_required}</div>
        <div class="border-b-2 leading-snug">▽応募資格</div>
        <div class="text-xs text-grey-600 leading-normal md:text-sm lg:text-base xl:text:lg">{post.post.qualification}</div>
        <div class="border-b-2 leading-snug">▽募集エリア</div>
        <div class="text-xs text-grey-600 leading-normal md:text-sm lg:text-base xl:text:lg">{post.post.area}</div>
        <div class="flex">
          <button class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">メッセージを送る</button>
          <button class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4">
            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
              <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

 @endsection