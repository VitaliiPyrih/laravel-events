<x-profile-layout>
    <x-slot name="header">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">{{__('Галерея')}}</h1>
                <div class="text-lg"><a href="{{route('galleries.create')}}">{{__('Додати галерею')}}</a></div>
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
                                Зображення
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Підпис
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Дія
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($galleries as $gallery)
                            <tr class="bg-white border-b">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    <img src="{{ asset('/storage/' . $gallery->image) }}" class="w-40 " alt="">
                                </th>
                                <td class="px-6 py-4">
                                    {{ $gallery->caption }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('galleries.edit', $gallery) }}" title="Редагувати"
                                           class="text-green-400 hover:text-green-600"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 32 32" class="fill-sky-950">
                                                <path d="M 23.90625 3.96875 C 22.859375 3.96875 21.8125 4.375 21 5.1875 L 5.1875 21 L 5.125 21.3125 L 4.03125 26.8125 L 3.71875 28.28125 L 5.1875 27.96875 L 10.6875 26.875 L 11 26.8125 L 26.8125 11 C 28.4375 9.375 28.4375 6.8125 26.8125 5.1875 C 26 4.375 24.953125 3.96875 23.90625 3.96875 Z M 23.90625 5.875 C 24.410156 5.875 24.917969 6.105469 25.40625 6.59375 C 26.378906 7.566406 26.378906 8.621094 25.40625 9.59375 L 24.6875 10.28125 L 21.71875 7.3125 L 22.40625 6.59375 C 22.894531 6.105469 23.402344 5.875 23.90625 5.875 Z M 20.3125 8.71875 L 23.28125 11.6875 L 11.1875 23.78125 C 10.53125 22.5 9.5 21.46875 8.21875 20.8125 Z M 6.9375 22.4375 C 8.136719 22.921875 9.078125 23.863281 9.5625 25.0625 L 6.28125 25.71875 Z"></path>
                                            </svg></a>
                                        <form method="POST" class="text-red-400 hover:text-red-600"
                                              action="{{ route('galleries.destroy', $gallery) }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('galleries.destroy', $gallery) }}" title="Видалити"
                                               onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 16 16" class="fill-red-500">
                                                    <path d="M 6.496094 1 C 5.675781 1 5 1.675781 5 2.496094 L 5 3 L 2 3 L 2 4 L 3 4 L 3 12.5 C 3 13.328125 3.671875 14 4.5 14 L 10.5 14 C 11.328125 14 12 13.328125 12 12.5 L 12 4 L 13 4 L 13 3 L 10 3 L 10 2.496094 C 10 1.675781 9.324219 1 8.503906 1 Z M 6.496094 2 L 8.503906 2 C 8.785156 2 9 2.214844 9 2.496094 L 9 3 L 6 3 L 6 2.496094 C 6 2.214844 6.214844 2 6.496094 2 Z M 5 5 L 6 5 L 6 12 L 5 12 Z M 7 5 L 8 5 L 8 12 L 7 12 Z M 9 5 L 10 5 L 10 12 L 9 12 Z"></path>
                                                </svg>
                                            </a>
                                        </form>
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
