@extends('layouts.dashboard')

@section('content')
    <section>
        <h1>{{$post->title}}</h1>
        <div class="my-3">Slug: {{$post->slug}}</div>
        <div class="my-3">Category: {{$post->category ? $post->category->name : 'nessuna'}}</div>
        <div class="mb-2"><strong>Tags:</strong>
            @forelse ($post->tags as $tag)
                {{ $tag->name }}{{ $loop->last ? '' : ', ' }}
            @empty
                nessuno
            @endforelse
        </div>
        @if($post->cover)
            <img src="{{asset('storage/'. $post->cover)}}" alt="{{$post->title}}">            
        @endif
        <p>{{$post->content}}</p>
        <a href="{{route('admin.posts.edit', ['post'=>$post->id])}}">Edit</a>
        <div>
            <form action="{{route('admin.posts.destroy', ['post'=>$post->id])}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
    </section>
@endsection