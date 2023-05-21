@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Студент</h6>
                    </div>
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
                                        <td>{{ __('Стать') }}</td>
                                        <td>{{ $general['sex'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Дата народження') }}</td>
                                        <td>{{ $general['birth'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Роль') }}</td>
                                        <td>{{ $general['role'] }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <table class="table table-striped table-hover table-responsive" style="--bs-table-striped-bg: rgba(98,114,216,0.5)">
                                    <thead>
                                    <tr>
                                        <th class="fw-bold">{{ __('Освіта') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ __('ВУЗ') }}</td>
                                        <td>{{ $edu['university'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Факультет') }}</td>
                                        <td>{{ $edu['faculty'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Спеціальність') }}</td>
                                        <td>{{ $edu['specialty_code'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Група') }}</td>
                                        <td>{{ $edu['group'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Курс') }}</td>
                                        <td>{{ $edu['course'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Ступінь освіти') }}</td>
                                        <td>{{ $edu['educational_degree'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Дата вступу') }}</td>
                                        <td>{{ $edu['entry_date'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Дата випуску') }}</td>
                                        <td>{{ $edu['graduation_date'] }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col">
                                <table class="table table-striped table-hover table-responsive" style="--bs-table-striped-bg: rgba(98,114,216,0.5)">
                                    <thead>
                                    <tr>
                                        <th class="fw-bold">{{ __('Досвід') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ __('Статус зайнятості') }}</td>
                                        <td>
                                            @if($ex)
                                                @if ($ex['employment_status'])
                                                    {{ __('Працевлаштований') }}
                                                @else
                                                    {{ __('Шукає роботу') }}
                                                @endif
                                            @else
                                                {{ __('no data') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Загальний досвід') }}</td>
                                        <td>
                                            @if($ex)
                                                {{ $ex['experience'] . ' рок(и/ів)' }}
                                            @else
                                                {{ __('no data') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Офіційний досвід') }}</td>
                                        <td>
                                            @if($ex)
                                                {{ $ex['off_experience'] . ' рок(и/ів)' }}
                                            @else
                                                {{ __('no data') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Напрямок діяльності') }}</td>
                                        <td>
                                            @if($ex)
                                                {{ $ex['field'] }}
                                            @else
                                                {{ __('no data') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Посада') }}</td>
                                        <td>
                                            @if($ex)
                                                {{ $ex['position'] }}
                                            @else
                                                {{ __('no data') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Рівень') }}</td>
                                        <td>
                                            @if($ex)
                                                {{ $ex['level'] }}
                                            @else
                                                {{ __('no data') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Англ. мова') }}</td>
                                        <td>
                                            @if($ex)
                                                {{ $ex['eng_level'] }}
                                            @else
                                                {{ __('no data') }}
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
