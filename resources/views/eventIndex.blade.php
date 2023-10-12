<x-app-layout>
    <x-slot name="header">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">{{__('Усі подій')}}</h1>
        </div>
    </x-slot>

    <x-slot name="content">
        <section class="bg-white shadow-2xl">
            <div class="container px-6 py-10 mx-auto">

                <div class="grid grid-cols-1 gap-8 mt-8 md:mt-16 md:grid-cols-2">
                    @foreach ($events as $event)
                        <div class="lg:flex bg-slate-100 rounded-md">
                            <a class="w-1/2" href="{{ route('eventShow', $event->id) }}">
                                <img class="w-full md:h-full md:object-cover"  src="{{ asset('/storage/' . $event->image) }}" alt="{{ $event->title }}">
                            </a>
                            <div class="flex gap-2 flex-col justify-between py-6 lg:mx-6">
                                <a href="{{ route('eventShow', $event->id) }}"
                                   class="text-xl p-2 font-semibold text-gray-800 hover:underline">
                                    {{ $event->title }}
                                </a>
                                <span class="text-sm text-white bg-indigo-400 sm:rounded-none md:rounded-md p-2">{{ $event->country->name }}</span>
                                <span class="flex flex-wrap space-x-2 p-2">
                                @foreach ($event->tags as $tag)
                                        <p class="text-sm p-2 font-mono bg-slate-200 rounded-md">{{ $tag->name }}</p>
                                    @endforeach
                            </span>
                                <span class="flex items-center gap-1 p-2 font-medium"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>{{$event->humanFormat}}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $events->withQueryString()->links() }}
            </div>
        </section>
    </x-slot>
</x-app-layout>
