<x-app-layout>
    <x-slot name="header">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">{{__('Галерея')}}</h1>
        </div>
    </x-slot>

    <x-slot name="content">
        <section class="bg-white py-10 shadow-2xl">
            <div class="container px-6 mt-8 mx-auto">
                <div class="flex flex-wrap gap-2">
                    @foreach ($galleries as $gallery)
                        <div class="">
                            <img class="object-cover w-96 h-full rounded-lg"
                                 src="{{ asset('/storage/' . $gallery->image) }}" alt="{{ $gallery->caption }}">
                        </div>
                    @endforeach
                </div>
                {{ $galleries->links() }}
            </div>
        </section>
    </x-slot>
</x-app-layout>
