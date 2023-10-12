<x-mail::message>
# Новий коментар до вашого поста: {{$title}}
    хтось написав під вашою подією

<x-mail::button :url="route('eventShow',$id)">
Watching
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
