
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
</head>
<body>
    @foreach ( $Questions as $item )
    <h2>
        <span class="text-primary">Q.No</span>
        ({{$item->q_num}})
        <span class="text-primary">Section</span>
        ({{$item->section}})
        @if ( isset($item->mcq[0]) )
            <span class="text-success">
                {{$item->mcq[0]['mcq_answers']}}
            </span>
        @elseif( isset($item->g_ans[0]) )
            <span class="text-success">
                {{$item->g_ans[0]['grid_ans']}}
            </span>
        @endif
        
    </h2> 
    @endforeach
</body>
</html>