@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Студент</h6>
                    </div>
{{--                    <div class="card-body px-0 pt-0 pb-2">--}}
                        <form action="/admin/student/update/{{ $id }}" method="POST">
                            @csrf
                            @method('PUT')
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
                                                <td>
                                                    <input type="text" name="fullname" value="{{ $general['fullname'] }}" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Стать') }}</td>
                                                <td>
                                                    <select class="form-control" name="sex">
                                                        <option @if($general['sex'] === 'чоловіча') selected @endif>чоловіча</option>
                                                        <option @if($general['sex'] === 'жіноча') selected @endif>жіноча</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Дата народження') }}</td>
                                                <td>
                                                    <input type="date" class="form-control" name="birth" value="{{ $general['birth'] }}" pattern="\d{4}-\d{2}-\d{2}" placeholder="Рік-Місяць-День">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Роль') }}</td>
                                                <td>
                                                    <input type="text" class="form-control" name="role" value="{{ $general['role'] }}" readonly></input>
                                                </td>
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
                                                <td>
                                                    <select class="form-control" name="university" readonly>
                                                        @foreach($universities as $university)
                                                        <option @if ($university['name'] === $edu['university']) selected @endif> {{ $university['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Факультет') }}</td>
                                                <td>
                                                    <select class="form-control" name="faculty" readonly>
                                                        @foreach($faculties as $faculty)
                                                            <option @if ($faculty['name'] === $edu['faculty']) selected @endif>{{ $faculty['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Спеціальність') }}</td>
                                                <td>
                                                    <select class="form-control" name="specialty_code" readonly>
                                                        @foreach($specialties as $specialty)
                                                            <option @if ($specialty['code'] === $edu['specialty_code']) selected @endif>{{ $specialty['code'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Група') }}</td>
                                                <td>
                                                    <select class="form-control" name="group">
                                                        @foreach($groups as $group)
                                                            <option @if ($group['name'] === $edu['group']) selected @endif>{{ $group['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Курс') }}</td>
                                                <td>
                                                    <input type="number" class="form-control" value="{{ $edu['course'] }}" readonly></input>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Ступінь освіти') }}</td>
                                                <td>
                                                    <select class="form-control" name="educational_degree">
                                                        <option @if($edu['educational_degree'] === 'бакалавр') selected @endif>бакалавр</option>
                                                        <option @if($edu['educational_degree'] === 'магістр') selected @endif>магістр</option>
                                                        <option @if($edu['educational_degree'] === 'аспірант') selected @endif>аспірант</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Дата вступу') }}</td>
                                                <td>
                                                    <input type="date" class="form-control" name="entry_date" value="{{$edu['entry_date']}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Дата випуску') }}</td>
                                                <td>
                                                    <input type="date" class="form-control" name="graduation_date" value="{{ $edu['graduation_date'] }}">
                                                </td>
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
                                                    <select class="form-control" name="employment_status">
                                                        @if(!$ex)
                                                            <option value="" disabled selected>Виберіть зі списку</option>
                                                        @endif
                                                        <option @if($ex && $ex['employment_status'] === 0) selected @endif>Шукає роботу</option>
                                                        <option @if($ex && $ex['employment_status'] === 1) selected @endif>Працевлаштований</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Загальний досвід') }}</td>
                                                <td>
                                                    <input type="number" class="form-control" name="experience" @if($ex) value="{{ $ex['experience'] }}" @endif placeholder="Bведіть число">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Офіційний досвід') }}</td>
                                                <td>
                                                    <input type="number" class="form-control" name="off_experience" @if($ex) value="{{ $ex['off_experience'] }}" @endif placeholder="Введіть число">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Напрямок діяльності') }}</td>
                                                <td>
                                                    <input type="text" class="form-control" name="field" @if($ex) value="{{ $ex['field'] }}" @endif>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Посада') }}</td>
                                                <td>
                                                    <input type="text" class="form-control" name="position" @if($ex) value="{{ $ex['position'] }}" @endif>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Рівень') }}</td>
                                                <td>
                                                    <select class="form-control" name="level">
                                                        @if(!$ex)
                                                            <option value="" disabled selected>Виберіть зі списку</option>
                                                        @endif
                                                        <option @if($ex && $ex['level'] === 'intern') selected @endif>intern</option>
                                                        <option @if($ex && $ex['level'] === 'junior') selected @endif>junior</option>
                                                        <option @if($ex && $ex['level'] === 'strong junior') selected @endif>strong junior</option>
                                                        <option @if($ex && $ex['level'] === 'middle') selected @endif>middle</option>
                                                        <option @if($ex && $ex['level'] === 'strong middle') selected @endif>strong middle</option>
                                                        <option @if($ex && $ex['level'] === 'senior') selected @endif>senior</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Англ. мова') }}</td>
                                                <td>
                                                    <select class="form-control" name="eng_level">
                                                        @if(!$ex)
                                                            <option value="" disabled selected>Виберіть зі списку</option>
                                                        @endif
                                                        <option @if($ex && $ex['eng_level'] === 'A1') selected @endif>A1</option>
                                                        <option @if($ex && $ex['eng_level'] === 'A2') selected @endif>A2</option>
                                                        <option @if($ex && $ex['eng_level'] === 'B1') selected @endif>B1</option>
                                                        <option @if($ex && $ex['eng_level'] === 'B2') selected @endif>B2</option>
                                                        <option @if($ex && $ex['eng_level'] === 'C1') selected @endif>C1</option>
                                                        <option @if($ex && $ex['eng_level'] === 'C2') selected @endif>C2</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    @if (session('success'))
                                                        <div class="alert alert-success">
                                                            {{ session('success') }}
                                                        </div>
                                                    @endif

                                                    @if (session('error'))
                                                        <div class="alert alert-danger">
                                                            {{ session('error') }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="submit" class="w-100 btn" style="border-radius: 0; color: #ffffff; background-color: #5e72e4">
                                                        {{ __('Зберегти зміни') }}
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </form>

{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
