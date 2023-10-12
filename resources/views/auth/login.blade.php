<x-app-layout>
    <x-slot name="content">
        <div class="min-h-screen  flex flex-col justify-center sm:py-12">
            <div class="p-10 shadow xs:p-0 mx-auto md:w-full md:max-w-md">
                <h1 class="font-bold text-center text-2xl mb-5">Логін</h1>
                @if(session()->has('email_taken'))
                    <!-- component -->
                    <!-- This is an example component -->
                    <div class="max-w-lg mx-auto">
                        <div class="flex bg-yellow-100 rounded-lg p-4 mb-4 text-sm text-yellow-700" role="alert">
                            <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                      clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <span class="font-medium">Увага!</span> {{session('email_taken')}}
                            </div>
                        </div>
                    </div>
                @endif
                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="bg-white  w-full rounded-lg divide-y divide-gray-200">
                        <div class="px-5 py-7">
                            <label class="font-semibold text-sm text-gray-600 pb-1 block">E-mail</label>
                            <input type="email" name="email" required value="{{old('email')}}"
                                   class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full"/>
                            @error('email')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                            <label class="font-semibold text-sm text-gray-600 pb-1 block">Пароль</label>
                            <input type="password"  name="password"
                                   class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" required/>
                            @error('password')
                            <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                            <button type="submit"
                                    class="transition duration-200 bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                                <span class="inline-block mr-2">Логін</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" class="w-4 h-4 inline-block">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </button>
                            <span class="block mx-auto text-center mt-4">--- або ---</span>
                        </div>
                    </div>
                </form>
                <div class="p-2">
                    <div class="grid grid-cols-3 gap-1">
                        <a href="/auth/github/redirect">
                            <button type="button"
                                    class="transition flex gap-2 items-center justify-center duration-200 border border-gray-200 text-gray-500 w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-normal text-center">
                                <img class="w-6" src="{{asset('/assets/img/social/github.svg')}}" alt="">GitHub
                            </button>
                        </a>
                        <a href="/auth/facebook/redirect">
                            <button type="button"
                                    class="transition bg-blue-700 flex gap-2 items-center justify-center duration-200 border border-gray-200 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-normal text-center">
                                <img class="w-6" src="{{asset('/assets/img/social/facebook.svg')}}" alt="">Facebook
                            </button>
                        </a>
                        <a href="/auth/google/redirect">
                            <button type="button"
                                    class="transition flex gap-2 items-center justify-center duration-200 border border-gray-200 bg-blue-500 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-normal text-center">
                                <img class="w-6" src="{{asset('/assets/img/social/google.svg')}}" alt="">Google
                            </button>
                        </a>
                    </div>
                </div>
                <div class="py-2">
                    <div class="grid grid-cols-2 gap-1">
                        <div class="text-center sm:text-left whitespace-nowrap">
                            <a href="{{route('password.email')}}">
                                <button
                                    class="transition duration-200 mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor" class="w-4 h-4 inline-block align-text-top">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="inline-block ml-1">Забув пароль</span>
                                </button>
                            </a>
                        </div>
                        <div class="text-center sm:text-right whitespace-nowrap">
                            <button
                                class="transition duration-200 mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-200 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" class="w-4 h-4 inline-block align-text-bottom	">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <span class="inline-block line-through ml-1">Допомога</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="py-2">
                    <div class="grid grid-cols-2 gap-1">
                        <div class="text-center sm:text-left whitespace-nowrap">
                            <a href="{{route('register')}}"
                               class="transition duration-200 mx-5 px-5 py-4 cursor-pointer font-normal text-sm rounded-lg text-gray-500 hover:bg-gray-200 focus:outline-none focus:bg-gray-300 focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 ring-inset">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" class="w-4 h-4 inline-block align-text-top">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                <span class="inline-block ml-1">Реєстрація</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>

