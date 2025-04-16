
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
</head>
<body>
    @foreach ( $mistakes as $item)
    <h2>
        {!! $item->question !!}
    </h2> 
    <br />
    @if( !empty($item->q_url) )
    <img src="{{asset('images/questions/' . $item->q_url)}}"  style="width: 100%" />
    @endif

 
    <hr />
    @endforeach
</body>
</html>