<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <style>
    .photo-box {
        display: flex;
        flex-wrap: wrap;
        justify-content: start;
        width: 80%;
        margin: 0 auto;
    }
    .photo {
        margin: 5px;
    }
    </style>
    <body>
    <h1>Properties</h1>
    @foreach ($properties as $property)
        <h2>{{ $property->name }}</h2>
        <div class="photo-box">
            @foreach($property->photos as $photo)
                <img src="{{ $photo->thumbnail }}" alt="" class="photo">
            @endforeach
        </div>
        <hr>
    @endforeach
    </body>
</html>
