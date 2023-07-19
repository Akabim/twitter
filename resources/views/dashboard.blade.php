<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="w-full mb-8">
                        <form action="{{ route('tweets.store') }}" method="POST">
                            @csrf
                            <textarea name="content" id="" cols="30" rows="10" class='input input-bordered w-full' placeholder='Ketik sesuatu...'></textarea>
                            <input type="submit" class='btn btn-primary my-3' value='Submit'></form>
                    </div>
                    @foreach ($tweets as $t)
                    <div class="card card-side bg-base-100 shadow-xl my-3">
                        <div class="card-body">
                            <h2 class="card-title mb-2">{{ $t->user->name }}</h2>
                            <p class='text-lg'>{{ $t->content }}</p>
                            <div class="text-end">

                                @can('edit', $t)
                                <a href="{{ route('tweets.edit', $t) }}" class='link text-blue-400 '>Edit</a>
                                @endcan
                                <span class='text-end text-gray-500'>{{ $t->created_at->diffForHumans() }}</span>
                                @can('delete', $t)
                                <form action="{{ route('tweets.destroy', $t->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Hapus" class='btn btn-primary'>
                                </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
</x-app-layout>
