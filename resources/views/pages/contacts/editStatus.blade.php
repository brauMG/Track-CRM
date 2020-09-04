<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Actualizar Estado</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form class="form" id="from" method="POST" action="{{ route('UpdateStatusContact',[$contactoEstado['id']]) }}">
            @method('PUT')
            @csrf
            <div class="modal-body">
                <tr>
                    <th for="inputGroupSelect01" class="th-card">
                        <i class="fa fa-address-card"></i> Estado
                    </th>
                    <td class="td-card"> <select name="status" type="text" class="form-control  @error('status') is-invalid @enderror" required>
                        @foreach($estados as $item)
                                @if($item == 1)
                                    <option selected value="{{$item}}">Prospecto</option>
                                @elseif($item == 2)
                                    <option value="{{$item}}">Oportunidad</option>
                                @elseif($item == 3)
                                    <option value="{{$item}}">Cliente</option>
                                @elseif($item == 4)
                                    <option value="{{$item}}">Cerrado</option>
                                @endif
                            @endforeach
                        </select>
                    </td>
                </tr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>
            </div>
        </form>
    </div>
</div>
