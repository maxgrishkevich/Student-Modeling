@extends('dashboard')

@section('info-card')

    <div class="card">
        <div class="card-header">{{ __('Успішність') }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col text-center">
                    <img class="img-thumbnail rounded-0" src="{{ asset("storage/img/students/$img") }}" alt="student-img" style="max-height: 250px; min-width: 180px">
                </div>
                <div class="col">
                    <table class="table table-borderless">
                        <tr>
                            <th class="fw-bold">{{ __('Загальне') }}</th>
                        </tr>
                        <tr>
                            <td>{{ __('ПІБ') }}</td>
                            <td>{{ $general['fullname'] }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Група') }}</td>
                            <td>{{ $general['group'] }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Середній бал') }}</td>
                            <td>{{ $general['average'] }}</td>
                        </tr>
                        <tr>
                            <td>Рейтинг групи</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>Рейтинг ВУЗу</td>
                            <td>1</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mt-5 text-center">
                <h6 class="fw-bold">{{ __('Графік зміни середнього балу студента') }}</h6>
                <canvas id="lineChart"></canvas>
            </div>
            <script type="text/javascript">
                var ctxL = document.getElementById("lineChart").getContext('2d');
                var array = {{$chart}};
                var arrayLength = array.length;
                var labelsArray = [];

                var gradientStroke1 = ctxL.createLinearGradient(0, 230, 0, 50);
                gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
                gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
                gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');

                for (var i = 1; i <= arrayLength; i++) {
                    labelsArray.push(i.toString());
                }
                var myLineChart = new Chart(ctxL, {
                    type: 'line',
                    data: {
                        labels: labelsArray,
                        datasets: [{
                            label: null,
                            tension: 0.4,
                            data: {{$chart}},
                            borderColor: 'rgb(94, 114, 228)',
                            backgroundColor: gradientStroke1,
                            borderWidth: 3,
                            fill: true,
                            maxBarThickness: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            xAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'семестр'
                                }
                            }],
                            yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'бали'
                                }
                            }],

                            y: {
                                grid: {
                                    drawBorder: false,
                                    display: true,
                                    drawOnChartArea: true,
                                    drawTicks: false,
                                    borderDash: [5, 5]
                                },
                                ticks: {
                                    display: true,
                                    padding: 10,
                                    color: '#fbfbfb',
                                    font: {
                                        size: 11,
                                        family: "Open Sans",
                                        style: 'normal',
                                        lineHeight: 2
                                    },
                                }
                            },
                            x: {
                                grid: {
                                    drawBorder: false,
                                    display: false,
                                    drawOnChartArea: false,
                                    drawTicks: false,
                                    borderDash: [5, 5]
                                },
                                ticks: {
                                    display: true,
                                    color: '#ccc',
                                    padding: 20,
                                    font: {
                                        size: 11,
                                        family: "Open Sans",
                                        style: 'normal',
                                        lineHeight: 2
                                    },
                                }
                            },

                        },
                        legend: {
                            display: false
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    var semester = 'Семестр №' + (tooltipItem.index + 1);
                                    var average = 'Середній бал: ' + tooltipItem.yLabel;
                                    return semester + '\n' + average;
                                }
                            }
                        }
                    }
                });
            </script>


            <div class="row mt-5 text-center">
                <h6 class="fw-bold">{{ __('Діаграма результатів за семестром') }}</h6>
                <div class="col d-flex justify-content-center">
                    <label class="col-form-label pe-3" for="semester">{{ __('Семестр') }}</label>
                    <select class="form-control w-auto" id="semester" onchange="loadData()">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <canvas id="barChart"></canvas>
            </div>

            <script>
                function loadData() {
                    $.ajax({
                        url: "{{ route('progress.barchart') }}",
                        type: 'GET',
                        data: {semester: $('#semester').val()},
                        dataType: 'json',
                        success: function(data) {
                            drawChart(data);
                        },
                        error: function() {
                            alert('Помилка отримання даних!');
                        }
                    });
                }

                function drawChart(data) {
                    var ctx = document.getElementById('barChart').getContext('2d');
                    if (typeof chart !== 'undefined') {
                        chart.destroy();
                    }
                    var gradientStroke1 = ctx.createLinearGradient(0, 230, 0, 50);
                    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
                    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
                    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
                    chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: Object.keys(data),
                            datasets: [{
                                label: 'Результуючий бал',
                                tension: 0.4,
                                data: Object.values(data),
                                backgroundColor: gradientStroke1,
                                borderColor: 'rgb(94, 114, 228)',
                                borderWidth: 3,
                                fill: true,
                                maxBarThickness: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        min: 60,
                                        suggestedMax: 100
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        display: false
                                    }
                                }],
                                y: {
                                    grid: {
                                        drawBorder: false,
                                        display: true,
                                        drawOnChartArea: true,
                                        drawTicks: false,
                                        borderDash: [5, 5]
                                    },
                                    ticks: {
                                        display: true,
                                        padding: 10,
                                        color: '#fbfbfb',
                                        font: {
                                            size: 11,
                                            family: "Open Sans",
                                            style: 'normal',
                                            lineHeight: 2
                                        },
                                    }
                                },
                                x: {
                                    grid: {
                                        drawBorder: false,
                                        display: false,
                                        drawOnChartArea: false,
                                        drawTicks: false,
                                        borderDash: [5, 5]
                                    },
                                    ticks: {
                                        display: true,
                                        color: '#ccc',
                                        padding: 20,
                                        font: {
                                            size: 11,
                                            family: "Open Sans",
                                            style: 'normal',
                                            lineHeight: 2
                                        },
                                    }
                                },
                            },
                            legend: {
                                display: false
                            }
                        }
                    });
                }

                loadData();
            </script>

        </div>
    </div>

@endsection
