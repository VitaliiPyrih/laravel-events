<x-profile-layout>
    <x-slot name="header">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">{{__('Збереження')}}</h1>
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
                                        <a class="font-semibold text-base text-green-400 fill-sky-500" href="{{route('eventShow',$event->id)}}"><?xml version="1.0" ?><svg enable-background="new 0 0 32 32" height="32px" id="svg2" version="1.1" viewBox="0 0 32 32" width="22px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:svg="http://www.w3.org/2000/svg"><g id="background"><rect fill="none" height="32" width="32"/></g><g id="view"><circle cx="16" cy="16" r="6"/><path d="M16,6C6,6,0,15.938,0,15.938S6,26,16,26s16-10,16-10S26,6,16,6z M16,24c-8.75,0-13.5-8-13.5-8S7.25,8,16,8s13.5,8,13.5,8   S24.75,24,16,24z"/></g></svg></a>
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
