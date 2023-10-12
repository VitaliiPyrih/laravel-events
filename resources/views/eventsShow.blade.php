<x-app-layout>
    <x-slot name="content">
        <div class="py-2 flex justify-between">
            <h3 class="mb-4 text-2xl font-bold text-slate-800 border-slate-800 border-l-2 pl-2">{{ $event->title }}</h3>

            <div class="flex space-x-2">
                Коли:
                <span class="mx-2">{{$event->date('start_date')}}</span> | <span
                    class="mx-2">{{$event->date('end_date')}}</span>
            </div>
        </div>
        <div class="mb-16 flex flex-wrap">
            <div class="mb-6 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pr-6">
                <div class="flex flex-col">
                    <div
                        class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg dark:shadow-black/20"
                        data-te-ripple-init data-te-ripple-color="light">
                        <img src="{{ asset('/storage/' . $event->image) }}" class="w-full" alt="Louvre"/>
                        <a href="#">
                            <div
                                class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-[hsl(0,0%,98.4%,0.2)] bg-fixed opacity-0 transition duration-300 ease-in-out hover:opacity-100">
                            </div>
                        </a>
                    </div>
                    @auth
                        <div class="flex mt-2 justify-center" x-data="{
                        eventLike: @js($like),
                        savedEvent: @js($savedEvent),
                        attending: @js($attendings),
                        onHandleSavedEvent() {axios.post(`/events-save/{!! $event->id!!}`).then( res => {this.savedEvent = res.data})},
                        onHandleLike() {axios.post(`/events-like/{!! $event->id!!}`).then( res => {this.eventLike = res.data})},
                        onHandleAttending() {axios.post(`/events-attending/{!! $event->id!!}`).then( res => {this.attending = res.data})}
                        }">
                            <button type="button" x-on:click="onHandleLike"
                                    class="text-white  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 md:px-4 py-2.5 text-center inline-flex items-center mr-2 hover:bg-blue-700"
                                    :class="eventLike ? 'bg-red-500 hover:bg-red-700' : 'bg-blue-600'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-3.5 h3.5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z"/>
                                </svg>
                                Вподобати
                            </button>
                            <button type="button" title="Зберегти в мої закладки" x-on:click="onHandleSavedEvent"
                                    class="text-white  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 md:px-4 py-2.5 text-center inline-flex items-center mr-2 hover:bg-blue-700"
                                    :class="savedEvent ? 'bg-green-600 hover:bg-green-700' : 'bg-blue-600'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="w-3.5 h3.5 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z"/>
                                </svg>
                                Зберегти
                            </button>
                            <button type="button" title="Підписатись на зміни, коментарі, видалення, тощо"
                                    x-on:click="onHandleAttending"
                                    class="text-white  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 md:px-4 py-2.5 text-center inline-flex items-center mr-2 hover:bg-blue-700"
                                    :class="attending ? 'bg-purple-500 hover:bg-purple-700' : 'bg-blue-600'">
                                Підписатись
                                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                     fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                </svg>
                            </button>
                        </div>
                    @endauth
                    <div class="flex flex-col p-4">
                        <span class="text-indigo-600 font-semibold">Організатор</span>
                        <div class="flex space-x-4 mt-6 bg-slate-200 p-2 rounded-md">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg></span>
                            <div class="flex flex-col">
                                <span class="text-2xl">{{ $event->user->name }}</span>
                                <span class="text-2xl">{{ $event->user->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full shrink-0 grow-0 lg:w-6/12 lg:pl-6 bg-slate-50 rounded-md p-2">
                <p class="mb-6 text-sm text-yellow-600">
                    Старт:
                    <time>{{ $event->start_time }}</time>
                </p>
                <p>
                    @foreach ($event->tags as $tag)
                        <span class="p-1 m-1 bg-indigo-300 rounded">{{ $tag->name }}</span>
                    @endforeach
                </p>
                <p class="mb-6 mt-4 text-neutral-500">
                    {{ $event->description }}
                </p>
                <div class="flex justify-end">
                    <div class="flex flex-col">
                        <div class="mb-4 flex items-center text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-6 h-6 mr-2 text-indigo-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                            </svg>

                            <div class="text-yellow-700">{{ $event->country->name }}, {{ $event->city->name }}</div>
                        </div>
                        <div class="text-yellow-700">
                            {{ $event->address }}
                        </div>
                    </div>
                </div>
                @auth
                    <div
                        class="container d-flex justify-content-center align-items-center w-50 mt-6 bg-slate-200 p-4 rounded-md">
                        <div class="">
                            <form action="{{ route('events.comments', $event->id) }}"
                                  class="flex justify-between space-x-2"
                                  method="POST"
                                  x-data="{ isButtonDisabled: false }"
                                  x-on:submit="isButtonDisabled = true">
                                @csrf
                                <input type="text"
                                       class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       name="content"
                                       id="content"
                                       placeholder="Коментар">
                                <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        :disabled="isButtonDisabled">
                                    Публікація
                                </button>
                            </form>
                            @error('content')
                            <b class="text-red-500 md:text-sm p-4 text-md">{{$message}}</b>
                            @enderror
                        </div>
                        <div class="w-full">
                            @foreach ($eventWithComments->comments as $comment)
                                <div class="w-full p-4 duration-300 hover:scale-105">
                                    <div class="items-center rounded-lg bg-white p-4 shadow-md shadow-indigo-50">
                                        <div>
                                            <div class="flex space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                <h2 class="text-lg font-bold text-gray-900">{{ $comment->user->name }}</h2>
                                            </div>
                                            <p class="text-sm font-semibold text-gray-500">{{ $comment->content }}</p>
                                            @can('view', $comment)
                                                <form
                                                    action="{{ route('events.comments.destroy', [$event->id, $comment->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="flex justify-end" onclick="event.preventDefault();
                                                     this.closest('form').submit();" href="{{ route('events.comments.destroy', [$event->id, $comment->id]) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                                             width="24" height="24" viewBox="0 0 16 16"
                                                             class="fill-red-500">
                                                            <path
                                                                d="M 6.496094 1 C 5.675781 1 5 1.675781 5 2.496094 L 5 3 L 2 3 L 2 4 L 3 4 L 3 12.5 C 3 13.328125 3.671875 14 4.5 14 L 10.5 14 C 11.328125 14 12 13.328125 12 12.5 L 12 4 L 13 4 L 13 3 L 10 3 L 10 2.496094 C 10 1.675781 9.324219 1 8.503906 1 Z M 6.496094 2 L 8.503906 2 C 8.785156 2 9 2.214844 9 2.496094 L 9 3 L 6 3 L 6 2.496094 C 6 2.214844 6.214844 2 6.496094 2 Z M 5 5 L 6 5 L 6 12 L 5 12 Z M 7 5 L 8 5 L 8 12 L 7 12 Z M 9 5 L 10 5 L 10 12 L 9 12 Z"></path>
                                                        </svg>
                                                    </a>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endauth
            </div>

        </div>
    </x-slot>
</x-app-layout>
