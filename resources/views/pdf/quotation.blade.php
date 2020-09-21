<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<div class="container" style="padding-bottom: 2% !important;">
    <div class="card" style="width: 100%; border: none !important;">
        <img class="card-img-top" src="https://i.imgur.com/qMO6i6e.png" style="height: 100px !important; width: 80% !important; padding-left: 20% !important;">
        <div class="card-body">
            <h4 class="card-title">Estimado Cliente <strong>{{$name}}</strong>.</h4>
            <p class="card-text">En TrackCloud agradecemos su preferencia en adquisición de servicios y productos. La siguiente tabla es acerca de la cotización que nos solicitó.</p>
        </div>
    </div>
</div>
<table class="table table-bordered" style="padding-top: 3% !important;">
    <thead class="thead-light">
    <tr>
        <th scope="col" style="text-transform: uppercase">Código</th>
        <th scope="col" style="text-transform: uppercase">Nombre</th>
        <th scope="col" style="text-transform: uppercase">Adquiridos</th>
        <th scope="col" style="text-transform: uppercase">Precio Individual</th>
        <th scope="col" style="text-transform: uppercase">Suma de Cantidad</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($items_quotation as $item)
        <tr>
            <th scope="row" class="td td-center table-info">{{$item['id']}}</th>
            <td class="td td-center" style="text-align: left">{{$item['name']}}</td>
            <td class="td td-center" style="text-align: center">cant. {{$item['quantity']}}</td>
            <td class="td td-center" style="text-align: center">{{$item['individual_price']}}.00 MXN</td>
            <td class="td td-center" style="text-align: center">{{$item['total_price']}}.00 MXN</td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
    <div class="card-body">
        <h5 class="card-title">Total: {{$precio_total}}.00 MXN.</h5>
    </div>
</div>
</body>
</html>
