<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-2 w-full">
            <div class="flex flex-right">
                <form action="{{ route('notification.read-all') }}" method="post">
                    @csrf
                    <button type='submit' class='btn btn-primary btn-sm'>Tandai Dibaca</button>
                </form>
            </div>
            @forelse ($notifications as $notification )
            <div class="card bg-white shadow-xl @if($notification->read_at == null) card-border border-blue-500
                @endif">
                <div class=" card w-full bg-base-100 shadow-xl">
                    <div class="card-body">
                        <p>{{ $notification->data['user']['name'] }} Mengomentari <a class='link text-blue' href='{{ route('tweets.show', $notification->data['tweet']['id']) }}'>Tweet km</a></p>
                    </div>
                </div>
                @empty
                <span>wlee kosong</span>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
