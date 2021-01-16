@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <form action=" {{route('posts') }} " method="post" class="mb-4">
                @csrf
                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="4" placeholder="Posts" class="bg-gray-100 boder-2 w-full p-4 rounded-lg @error('record')
                        border-red-500 @enderror"></textarea>
                    @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded front-medium">
                        Post
                    </button>
                </div>

            </form>

            @if ($posts->count())
                @foreach ($posts as $post)
                    <div class="mb-4">
                        <a href="" class="font-bold">
                            {{ $post->user->name }}
                            <span class="text-gray-600 text-sm">
                                {{ $post->created_at->diffForHumans()}}
                            </span>
                        </a>
                    </div>
                    <p class="mb-2"> {{$post->body}} </p>
                @endforeach

                {{ $posts->links() }}
            @else
                <p>There are no posts available</p>
            @endif
        </div>
    </div>
@endsection