@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">DASHBOARD</div>

                <div class="card-body">
                    <center>

                        <div class="card col-md-6">
                            <div class="card-body">
                                <div id="hora" onload="time();" class="card-text"></div>


                                <h3>{{date('d/m/Y')}}</h3>
                            </div>


                        </div>




                    </center>
                    <div class="alert alert-success" role="alert">

                        <h2 class="card-text">RELATÓRIO DO DIA JÁ ENVIADO</h2>
                    </div>

                    <a href="{{route('relatorios')}}" class="btn btn-primary btn-block"> <i class="fa fa-eye"></i> VER RELATÓRIOS </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
function time() {
    var date = new Date();

    document.getElementById("hora").innerHTML = "<h2> " + date.getHours() +
        ":" + date.getMinutes() + ":" + date.getSeconds(); + " </h2>";

}
window.setInterval("time();", 1000);
</script>
@endpush