<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link crossorigin="anonymous" href="css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" rel="stylesheet">

    <title>Affiliates</title>
</head>
<body>
    <div class="container">
        <form role="form" method="POST" action="/">
            @csrf
            <div class="col-xs-12">
                @include('form')
            </div>
        </form>
        <hr>
        <h3>{{ $message }}</h3>
        <ul class="list-group">
        @foreach($foundAffiliates as $affiliate /** @var \App\Models\Affiliate $affiliate */)
            <li class="list-group-item"><strong>ID {{ $affiliate->getId() }}</strong> - {{ $affiliate->getName() }}</li>
        @endforeach
        </ul>
    </div>
</body>
</html>
