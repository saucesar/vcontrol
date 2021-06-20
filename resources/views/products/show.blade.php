@extends('layouts.app', ['active' => 'products', 'title' => 'Produtos'])

@section('content')
    @include('products.header', ['product' => $product])
    <div class="container-fluid mt--7 card card-body bg-secondary">
        @include('products.stats')
        <div class="d-flex justify-content-center">
            @include('components.alerts.error')
            @include('components.alerts.success')
        </div>
        <div class="row mb-4">
            <div class="col d-flex align-items-stretch">
                @include('dates.card', ['dates' => $product->dates, 'title' => 'Validades'])
            </div>
            <div class="col d-flex align-items-stretch">
                @include('dates.card', ['dates' => $product->historic(5), 'title' => 'Historico', 'noActions' => true])
            </div>
        </div>
        <div class="row">
            <div class="col">
            @foreach($product->dates as $date)

                <script type="text/javascript">
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var graphic = [
                            ['Dia', 'Quant.', {role:'style'}, {role:'annotation'}],
                        ];
                        var date = "<?= $date->date; ?>"
                        var graphicData = <?= $graphicData; ?>;
                        
                        for(i=0; i<graphicData[date].length; i++) {
                            graphic.push(graphicData[date][i]);
                        }

                        var data = google.visualization.arrayToDataTable(graphic);
                        
                        var options = {
                            'title': 'Evolução de venda : Validade {{ $date->date }}',
                            'width': 700,
                            'height': 500,
                        };

                        var chart = new google.visualization.ColumnChart(document.getElementById('chartDate{{ $date->id }}'));
                        chart.draw(data, options);
                    }
                </script>
            @endforeach
            </div>
        </div>
    </div>
@endsection

@push('head_scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endpush