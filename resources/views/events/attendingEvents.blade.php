<x-profile-layout>
    <x-slot name="header">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{__('Підписи')}}</h1>
                <div class="text-lg "><a class="bg-gray-700 outline-2 outline-sky-300 focus:ring-2 rounded-2xl px-5 text-white py-1" href="{{route('events.create')}}">{{__('Нова подія')}}</a></div>
            </div>
        </div>

    </x-slot>

    <x-slot name="content">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-lg text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Назва
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Початок
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Країна
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Дія
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($events as $event)
                            <tr class="border-b odd:bg-white even:bg-slate-100">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $event->title }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $event->start_date }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $event->country->name }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a class="font-semibold text-base text-green-400" href="{{route('eventShow',$event->id)}}">view</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    Нічого немає
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-slot>
</x-profile-layout>
