@if(Auth::user()->role_id == 3)
<a href="#" class="btn btn-success" data-toggle="modal" data-target="#validar_{{$id}}" title="Validar">
    <i class="fas fa-check"></i>
</a>
<div class="modal fade" id="validar_{{$id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Validar producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('saleProduct.validate',$id) }}" method="POST">
                <div class="modal-body">
                    ¿Esta seguro que desea realizar efectiva la compra este producto?

                    @csrf
                    <div class="form-group">
                        <input type="text" name="code" placeholder="Introduzca el código enviado a su correo" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Confirmar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endif
