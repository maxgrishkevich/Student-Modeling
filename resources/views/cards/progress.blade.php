@extends('dashboard')

@section('info-card')
    <div class="card">
        <div class="card-header">{{ __('Успішність') }}</div>

        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img class="w-100 img-thumbnail" src="{{ asset('img/students/student.png') }}" alt="student-img" style="min-width: 200px;">
                </div>
                <div class="col">
                    <table class="table table-borderless">
                        <tr>
                            <th>Загальне</th>
                        </tr>
                        <tr>
                            <td>ПІБ</td>
                            <td>Назаренко Лілія Вікторівна</td>
                        </tr>
                        <tr>
                            <td>Група</td>
                            <td>ТВ-91</td>
                        </tr>
                        <tr>
                            <td>Середній бал</td>
                            <td>91.3</td>
                        </tr>
                        <tr>
                            <td>Рейтинг групи</td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td>Рейтинг ВУЗу</td>
                            <td>31</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mt-5">
                <canvas id="lineChart"></canvas>
            </div>

        </div>
    </div>
@endsection
