<x-profile-layout>
    <x-slot name="header">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{__('Редагування події')}}</h1>
        </div>
    </x-slot>
    <x-slot name="content">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 shadow-2xl">
                <form method="POST" action="{{ route('events.update',$event->id) }}" x-data="{
                country: null,
                cityId: @js($event->city_id),
                cities: @js($event->country->cities),
                error: null,
                citiesLength: false,
                onCountryChange(event) {
                    axios.get(`/countries/${event.target.value}`).then(res => {
                        this.cities = res.data
                        this.citiesLength = this.cities.length > 0 ? true : false;


                    }).catch(error => {
                    this.cities = [];
                    this.citiesLength = 0;
                    })

                }
            }" enctype="multipart/form-data"
                      class="p-4 bg-white rounded-md">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-6 mb-6 md:grid-cols-2">

                        <div>
                            <label for="title"
                                   class="block mb-2 text-sm font-medium text-gray-900">Назва</label>
                            <input type="text" id="title" name="title"
                                   class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   value="{{old('title',$event->title)}}">
                            @error('title')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="country_id"
                                   class="block mb-2 text-sm font-medium text-gray-900">Виберіть Країну</label>
                            <select id="country_id" x-on:change="onCountryChange" name="country_id"
                                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option>Choose a country</option>
                                @foreach ($countries as $country)
                                    <option @selected($event->country_id === $country->id )  value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('country_id')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="city_id"
                                   class="block mb-2 text-sm font-medium text-gray-900">Виберіть місто</label>
                            <select id="city_id" name="city_id"
                                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <template x-if="!citiesLength">
                                    <option selected>Пусто (Виберіть країну)</option>
                                </template>
                                <template x-for="city in cities" :key="city.id">
                                    <option x-bind:selected="cityId === city.id" x-bind:value="city.id" x-text="city.name"></option>
                                </template>
                            </select>
                            @error('city_id')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="address"
                                   class="block mb-2 text-sm font-medium text-gray-900">Адреса</label>
                            <input type="text" id="address" name="address"
                                   class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   value="{{old('address',$event->address)}}">
                            @error('address')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 "
                                   for="file_input">Завантажити фото</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 cursor-pointer bg-gray-100"
                                id="file_input" type="file" name="image">
                            @error('image')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="start_date"
                                   class="block mb-2 text-sm font-medium text-gray-900">Дата початку</label>
                            <input type="date" id="start_date" name="start_date"
                                   class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   value="{{old('start_date',$event->start_date)}}">
                            @error('start_date')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">Дата закінчення</label>
                            <input type="date" id="end_date" name="end_date"
                                   class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   value="{{old('end_date',$event->end_date)}}">
                            @error('end_date')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="start_time"
                                   class="block mb-2 text-sm font-medium text-gray-900">Час початку</label>
                            <input type="time" id="start_time" name="start_time"
                                   class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   value="{{old('start_time',$event->start_time)}}">
                            @error('start_time')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="num_tickets"
                                   class="block mb-2 text-sm font-medium text-gray-900">№: Тікета</label>
                            <input type="number" id="num_tickets" name="num_ticket"
                                   class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                   value="{{old('num_ticket',$event->num_ticket)}}">
                            @error('num_tickets')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="description"
                                   class="block mb-2 text-sm font-medium text-gray-900">Опис</label>
                            <textarea id="description" name="description" rows="4"
                                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-100 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Опис вашої події...">{{old('description',$event->description)}}</textarea>
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
                                        <input id="vue-checkbox-list" @checked($event->hasTag($tag)) type="checkbox" name="tags[]"
                                               value="{{ $tag->id }}"
                                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
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
                                class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Оновити</button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>
</x-profile-layout>
