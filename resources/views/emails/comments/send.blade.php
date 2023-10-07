<x-mail::message>
# Новий коментар до вашого поста
{{$id}}
    хтось написав під вашою подією

<x-mail::button :url="route('eventShow',$id)">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
