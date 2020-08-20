<div class="container">
    <div class="text-center" style="margin-left: -4% !important;">
        <table class="table table-bordered">
            <thead class="table-header" style="font-size: 0.5em !important; background-color: #c6e2f5 !important; color: black !important; vertical-align: middle !important;">
            <tr>
                <th scope="col" style="text-transform: uppercase">Código del Artículo</th>
                <th scope="col" style="text-transform: uppercase">Nombre</th>
                <th scope="col" style="text-transform: uppercase">Cantidad Adquiridad</th>
                <th scope="col" style="text-transform: uppercase">Precio Individual</th>
                <th scope="col" style="text-transform: uppercase">Suma de Cantidad</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items_quotation as $item)
                <tr>
                    <td class="td td-center" style="font-size: 0.5em !important;">{{$item['id']}}</td>
                    <td class="td td-center" style="font-size: 0.5em !important;">{{$item['name']}}</td>
                    <td class="td td-center" style="font-size: 0.5em !important;">{{$item['quantity']}}</td>
                    <td class="td td-center" style="font-size: 0.5em !important;">{{$item['individual_price']}}</td>
                    <td class="td td-center" style="font-size: 0.5em !important;">{{$item['total_price']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="form-group text-center">
        <h3>Precio Total: {{$precio_total}} MXN</h3>
    </div>
</div>
