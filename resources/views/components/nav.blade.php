@props(['page'])
@php
    $active = request()->routeIs($page) ? 'bg-gray-900': '';
@endphp
<a href="{{route($page)}}" class="{{$active}} text-white rounded-md px-3 py-2 text-sm font-medium">{{$slot}}</a>
