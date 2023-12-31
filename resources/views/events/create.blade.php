<x-profile-layout>
    <x-slot name="header">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold tracking-tight text-gray-900">{{__('Створити подію')}}</h1>
        </div>
    </x-slot>
    <x-slot name="content">
        @csrf
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form method="POST" action="{{ route('events.store') }}" x-data="{
                country: null,
                city: null,
                cities: [],
                error: null,
                citiesLength: false,
                onCountryChange(event) {
                const val = isNaN(event) ? event.target.value : event;
                    axios.get(`/countries/${val}`).then(res => {
                        this.cities = res.data
                        this.citiesLength = this.cities.length > 0 ? true : false;


                    }).catch(error => {
                    this.cities = [];
                    this.citiesLength = 0;
                    })

                }
            }" enctype="multipart/form-data"
                          class="p-4 bg-white rounded-md shadow-2xl">
                    @csrf

                    <div class="grid gap-6 mb-6 md:grid-cols-2">

                        <div>
                            <label for="title"
                                   class="block mb-2 text-sm font-medium text-gray-900">Назва</label>
                            <input type="text" id="title" value="{{old('title')}}" name="title"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   placeholder="Laravel event">
                            @error('title')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="country_id"
                                   class="block mb-2 text-sm font-medium text-gray-900">Виберіть Країну</label>
                            <select id="country_id" x-data="{selected: @js(old('country_id') ?? 2)}" x-init="onCountryChange(selected)" x-on:change="onCountryChange" name="country_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="2" selected>Вибрати</option>
                                @foreach ($countries as $country)
                                    <option @selected(old('country_id') ? in_array($country->id, (array)old('country_id') ) : 2) value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('country_error')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="city_id"
                                   class="block mb-2 text-sm font-medium text-gray-900">Виберіть місто</label>
                            <select id="city_id" name="city_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <template x-if="!citiesLength">
                                    <option value="" selected>Пусто (Виберіть країну)</option>
                                </template>
                                <template x-for="city in cities" :key="city.id">
                                    <option x-bind:value="city.id" x-text="city.name"></option>
                                </template>
                            </select>
                            @error('city_id')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="address"
                                   class="block mb-2 text-sm font-medium text-gray-900">Адреса</label>
                            <input type="text" value="{{old('address')}}" id="address" name="address"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   placeholder="Laravel event">
                            @error('address')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900"
                                   for="file_input">Завантажити фото</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-50 focus:outline-none"
                                id="file_input" type="file" name="image">
                            @error('image')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="start_date"
                                   class="block mb-2 text-sm font-medium text-gray-900">Дата початку</label>
                            <input type="date" id="start_date" value="{{old('start_date')}}" name="start_date"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   placeholder="Laravel event">
                            @error('start_date')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">Дата закінчення</label>
                            <input type="date" id="end_date" value="{{old('end_date')}}" name="end_date"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   placeholder="Laravel event">
                            @error('end_date')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="start_time"
                                   class="block mb-2 text-sm font-medium text-gray-900">Час початку</label>
                            <input type="time" value="{{old('start_time')}}" id="start_time" name="start_time"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   placeholder="Laravel event">
                            @error('start_time')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="num_tickets"
                                   class="block mb-2 text-sm font-medium text-gray-900">№: Тікета</label>
                            <input type="number" id="num_tickets"value="{{old('num_ticket')}}" name="num_ticket"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   placeholder="1">
                            @error('num_tickets')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="description"
                                   class="block mb-2 text-sm font-medium text-gray-900">Опис</label>
                            <textarea id="description" name="description" rows="4"
                                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Опис вашої події...">{{old('description')}}</textarea>
                            @error('description')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <h3 class="mb-4 font-semibold text-gray-900">Теги</h3>
                        <ul
                            class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex">
                            @foreach ($tags as $tag)
                                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                                    <div class="flex items-center pl-3">
                                        <input id="vue-checkbox-list" type="checkbox" name="tags[]"
                                               value="{{ $tag->id }}"
                                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                        <label for="vue-checkbox-list"
                                               class="w-full py-3 ml-2 text-sm font-medium text-gray-900">{{ $tag->name }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        @error('tags')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit"
                                class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Створити</button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>
</x-profile-layout>
