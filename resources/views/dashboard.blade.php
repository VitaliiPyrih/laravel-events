<x-profile-layout>
    <x-slot name="header">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{__('Панель керування')}}</h1>
                <div class="text-lg "><a
                        class="bg-gray-700 outline-2 outline-sky-300 focus:ring-2 rounded-2xl px-5 text-white py-1"
                        href="{{route('events.create')}}">{{__('Нова подія')}}</a></div>
            </div>
        </div>

    </x-slot>

    <x-slot name="content">
        <div class="py-12">
            <div class="shadow-xl  inline-flex p-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden">
                    <div class="text-gray-900 inline-flex font-semibold py-2  px-5">
                        <span>{{ __("Ви залогінені успішно :)") }}</span>
                    </div>
                </div>
            </div>

        </div>
    </x-slot>
</x-profile-layout>
