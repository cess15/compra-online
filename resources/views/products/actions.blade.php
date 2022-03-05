@if(Auth::user()->role_id == 2)
<a href="#" class="btn btn-success" data-toggle="modal" data-target="#vender_{{$id}}" title="Vender">
    <i class="fas fa-money-bill"></i>
</a>
<div class="modal fade" id="vender_{{$id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Vender producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Esta seguro que desea poner en venta?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <form action="{{ route('saleProduct.sell',$id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Confirmar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@if(Auth::user()->role_id == 3)
<a href="#" class="btn btn-success" data-toggle="modal" data-target="#comprar_{{$id}}" title="Comprar">
    <i class="fas fa-money-bill"></i>
</a>
<div class="modal fade" id="comprar_{{$id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comprar producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Esta seguro que desea comprar este producto?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <form action="{{ route('saleProduct.buy',$id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Confirmar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
