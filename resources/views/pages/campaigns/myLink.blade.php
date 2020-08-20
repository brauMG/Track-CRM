<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Vinculo De Esta Campaña</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label>Vinculo</label>
                            <textarea id="CopyURL" class="form-control" type="text" id="descripcion" name="descripcion">{{$url}}</textarea>
                            <div class="invalid-feedback" id="error_nombre" style="display: none;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a type="submit" class="btn btn-primary" onclick="copy(this);"><i class="fa fa-clipboard"></i> Copiar</a>
            </div>
    </div>
</div>
