<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body style="background-color: #719abf">
<br>
<div class="container border" style="width: 25% !important; padding-bottom: 2% !important; background-color: white !important;">
    <a>Compañia: {{$company->name}}</a>
    <br>
    <a>Contacto: {{$company->email}}</a>
</div>
<div class="container" style="padding-bottom: 1% !important; padding-top: 2% !important;">
    <div class="card" style="width: 100%; border: none !important; background-color: white">
        <img class="card-img-top" src="https://i.imgur.com/qMO6i6e.png" style="height: 100px !important; width: 80% !important; padding-left: 20% !important; padding-top: 1% !important;">
        <div class="card-body">
            <h4 class="card-title">Hola, ojala estes teniendo un gran día.</h4>
            <p class="card-text">En TrackCloud consideramos que podrías estar interesado en nuestra variedad de productos y servicios. Si algo llama tu atención, puedes contactarte inmediatamente con uno de nuestros ejecutivos de ventas.</p>
        </div>
    </div>
</div>

@php($i = 0)
@foreach ($items as $item)
    @if($i < 6)
        <div class="col-md-3" style="float: left; width: 33% !important; height: 40% !important;">
            <div class="container" style="border: solid; border-color: #f6f6f6; padding-top: 3% !important; background-color: #084c45">
                <img class="card-img-top" src="{{ url('uploads/inventory/' . $item->image) }}" height="220" width="100">
                <div class="card mb-2" style="background-color: #084c45">
                    <div class="card-body">
                        <div class="card-title" style="background-color: #216f0b; text-align: center; color: white"><strong>{{$item->name}}</strong></div>
                        <div class="card-body" style="background-color: #f3f3f3; text-align: center; color: #000000">{{$item->description}}. <br> <i>{{$item->stock}} disponibles</i></div>
                    </div>
                    <div class="card-footer" style="background-color: #216f0b; color: white; text-align: center">
                        <span style="top: -.5em; font-size: 12px !important;">$</span><strong>{{$item->price}}</strong><span style="top: -.5em; font-size: 12px !important;">.00 MXN</span>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="col-md-3" style="float: left; width: 33% !important; height: 30% !important; padding-top: 1% !important;">
            <div class="container" style="border: solid; border-color: #f6f6f6; padding-top: 3% !important; background-color: #084c45">
                <img class="card-img-top" src="{{ url('uploads/inventory/' . $item->image) }}" height="170" width="100">
                <div class="card mb-2" style="background-color: #084c45">
                    <div class="card-body">
                        <div class="card-title" style="background-color: #216f0b; text-align: center; color: white"><strong>{{$item->name}}</strong></div>
                        <div class="card-body" style="background-color: #f3f3f3; text-align: center; color: #000000">{{$item->description}}. <br> <i>{{$item->stock}} disponibles</i></div>
                    </div>
                    <div class="card-footer" style="background-color: #216f0b; color: white; text-align: center">
                        <span style="top: -.5em; font-size: 12px !important;">$</span><strong>{{$item->price}}</strong><span style="top: -.5em; font-size: 12px !important;">.00 MXN</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @php($i++)
@endforeach
</body>
</html>
