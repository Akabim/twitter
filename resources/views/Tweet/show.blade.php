<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tweet
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card my-4 bg-white dark:bg-gray-800">
                <div class="card-body">
                    <h2 class="text-xl font-bold">{{ $tweet->user->name }}</h2>
                    <p>{{ $tweet->content }}</p>
                    <div class="text-end">
                        @can('update', $tweet)
                        <a href="{{ route('tweets.edit', $tweet->id) }}" class="link link-hover text-blue-400"> Edit
                        </a>
                        @endcan
                        @can('delete', $tweet)
                        <form action="{{ route('tweets.destroy', $tweet->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <input class="btn btn-danger" type="submit" value="Hapus">
                        </form>
                        @endcan
                        <span class="text-sm">{{ $tweet->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            <div class="card mt-4 mb-2 bg-white dark:bg-gray-800">
                <div class="card-body">
                    <div class="card-title">Komentar</div>
                    <form action="{{ route('comments.store', $tweet->id) }}" method="post">
                        @csrf
                        <textarea name="message" class="textarea textarea-bordered w-full" placeholder="tinggalkan komentar" rows="3"></textarea>
                        <input type="submit" value="Comments" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
    @foreach ($tweet->comments as $comment)
    <div class="py-1 pb-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="card card-side bg-base-100 shadow-xl my-3">
                <div class="card-body">
                    <h2 class="text-xl font-bold mb-2">{{ $comment->user->name }}</h2>
                    <p class='text-lg'>{{ $comment->message }}</p>
                    <div class="text-end">
                        <a class='text-blue-500 link link-hover' href="{{ route('comments.edit', [$tweet->id, $comment->id]) }}">Edit</a>
                        <span class='text-sm'>{{ $comment->created_at->diffforHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</x-app-layout>
