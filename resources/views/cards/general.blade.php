@extends('dashboard')

@section('info-card')
    <div class="card">
        <div class="card-header">{{ __('Інформаційна картка') }}</div>

        <div class="card-body">

            <div class="row">
                <div class="col text-center">
                    <img class="img-thumbnail rounded-0" src="{{ asset("img/students/$img") }}" alt="student-img" style="max-height: 250px; min-width: 180px">
                </div>
                <div class="col">
                    <table class="table table-borderless">
                        <tr>
                            <th>{{ __('Загальне') }}</th>
                        </tr>
                        <tr>
                            <td>{{ __('ПІБ') }}</td>
                            <td>{{ __($general['fullname']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Стать') }}</td>
                            <td>{{ __($general['sex']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Дата народження') }}</td>
                            <td>{{ __($general['birth']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Роль') }}</td>
                            <td>{{ __($general['role']) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <table class="table table-striped table-hover table-responsive" style="--bs-table-striped-bg: rgba(98,114,216,0.5)">
                        <thead>
                        <tr>
                            <th>{{ __('Освіта') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ __('ВУЗ') }}</td>
                            <td>{{ __($edu['university']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Факультет') }}</td>
                            <td>{{ __($edu['faculty']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Спеціальність') }}</td>
                            <td>{{ __($edu['specialty_code']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Група') }}</td>
                            <td>{{ __($edu['group']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Курс') }}</td>
                            <td>{{ __($edu['course']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Ступінь освіти') }}</td>
                            <td>{{ __($edu['educational_degree']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Дата вступу') }}</td>
                            <td>{{ __($edu['entry_date']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Дата випуску') }}</td>
                            <td>{{ __($edu['graduation_date']) }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                    <table class="table table-striped table-hover table-responsive" style="--bs-table-striped-bg: rgba(98,114,216,0.5)">
                        <thead>
                        <tr>
                            <th>{{ __('Досвід') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ __('Статус') }}</td>
                            <td>{{ __($ex['employment_status']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Загальний досвід') }}</td>
                            <td>{{ __($ex['experience'] . ' рок(и/ів)') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Офіційний досвід') }}</td>
                            <td>{{ __($ex['off_experience'] . ' рок(и/ів)') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Напрямок діяльності') }}</td>
                            <td>{{ __($ex['field']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Посада') }}</td>
                            <td>{{ __($ex['position']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Рівень') }}</td>
                            <td>{{ __($ex['level']) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Англ. мова') }}</td>
                            <td>{{ __($ex['eng_level']) }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            {{--                    @if (session('status'))--}}
            {{--                        <div class="alert alert-success" role="alert">--}}
            {{--                            {{ session('status') }}--}}
            {{--                        </div>--}}
            {{--                    @endif--}}

            {{--                    {{ __('You are logged in!') }}--}}
        </div>
    </div>
@endsection
