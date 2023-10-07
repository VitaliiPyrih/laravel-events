<x-profile-layout>
    <x-slot name="header">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{__('Підтвердження email')}}</h1>
                <div class="text-lg "><a
                        class="bg-gray-700 outline-2 outline-sky-300 focus:ring-2 rounded-2xl px-5 text-white py-1"
                        href="{{route('events.create')}}">{{__('Нова подія')}}</a></div>
            </div>
        </div>

    </x-slot>

    <x-slot name="content">
        <div class="py-12">
            <div class="shadow-xl flex flex-col inline-flex p-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <p>Вам потрібно підтвердити свою почту для подальших дій на сайті і перевірці чи ви не бот. Перевірте свою почту і перейдіть по посиланню a</p>
                <form action="{{route('verification.send')}}" method="POST">
                    @csrf
                    <button class="mt-2 text-sky-500" type="submit">Повторна відправка</button>
                </form>
            </div>
        </div>
    </x-slot>
</x-profile-layout>
