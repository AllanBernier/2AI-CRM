<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>This is my first invoice</h1>

    {{$invoice_number}}
    <hr>

    <ul>
        @foreach ($trainings as $training)
            <li>DESCRIPTION: {{ $training['name'] }}, PRIX: {{ $training['tjm_client'] }}</li>
        @endforeach
    </ul>


</body>
</html>
