@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Студент</h6>
                    </div>
                    <form action="{{ route('student.save') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">

                            <div class="row">
                                <div class="col">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>
                                                <input type="file" class="img-thumbnail rounded-0 form-control" id="image" name="image">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Нікнейм') }}</td>
                                            <td>
                                                <input type="text" name="nickname" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Email') }}</td>
                                            <td>
                                                <input type="email" name="email" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Пароль') }}</td>
                                            <td>
                                                <input type="password" name="password" class="form-control">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th class="fw-bold">{{ __('Загальне') }}</th>
                                        </tr>
                                        <tr>
                                            <td>{{ __('ПІБ') }}</td>
                                            <td>
                                                <input type="text" name="fullname" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Стать') }}</td>
                                            <td>
                                                <select class="form-control" name="sex">
                                                    <option value="" disabled selected>Виберіть зі списку</option>
                                                    <option>чоловіча</option>
                                                    <option>жіноча</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Дата народження') }}</td>
                                            <td>
                                                <input type="date" class="form-control" name="birth" pattern="\d{4}-\d{2}-\d{2}" placeholder="Рік-Місяць-День">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Роль') }}</td>
                                            <td>
                                                <input type="text" class="form-control" name="role" readonly>
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
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Факультет') }}</td>
                                            <td>
                                                <select class="form-control" name="faculty" readonly>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Спеціальність') }}</td>
                                            <td>
                                                <select class="form-control" name="specialty_code" readonly>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Група') }}</td>
                                            <td>
                                                <select class="form-control" name="group">
                                                    <option value="" disabled selected>Виберіть зі списку</option>
                                                    @foreach($groups as $group)
                                                        <option>{{ $group['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Курс') }}</td>
                                            <td>
                                                <input type="number" class="form-control" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Ступінь освіти') }}</td>
                                            <td>
                                                <select class="form-control" name="educational_degree">
                                                    <option value="" disabled selected>Виберіть зі списку</option>
                                                    <option>бакалавр</option>
                                                    <option>магістр</option>
                                                    <option>аспірант</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Дата вступу') }}</td>
                                            <td>
                                                <input type="date" class="form-control" name="entry_date" pattern="\d{4}-\d{2}-\d{2}" placeholder="Рік-Місяць-День">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Дата випуску') }}</td>
                                            <td>
                                                <input type="date" class="form-control" name="graduation_date" pattern="\d{4}-\d{2}-\d{2}" placeholder="Рік-Місяць-День">
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
                                                    <option value="" disabled selected>Виберіть зі списку</option>
                                                    <option>Шукає роботу</option>
                                                    <option>Працевлаштований</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Загальний досвід') }}</td>
                                            <td>
                                                <input type="number" class="form-control" name="experience">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Офіційний досвід') }}</td>
                                            <td>
                                                <input type="number" class="form-control" name="off_experience">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Напрямок діяльності') }}</td>
                                            <td>
                                                <input type="text" class="form-control" name="field">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Посада') }}</td>
                                            <td>
                                                <input type="text" class="form-control" name="position" placeholder="поточна/бажана">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Рівень') }}</td>
                                            <td>
                                                <select class="form-control" name="level">
                                                    <option value="" disabled selected>Виберіть зі списку</option>
                                                    <option>intern</option>
                                                    <option>junior</option>
                                                    <option>strong junior</option>
                                                    <option>middle</option>
                                                    <option>strong middle</option>
                                                    <option>senior</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Англ. мова') }}</td>
                                            <td>
                                                <select class="form-control" name="eng_level">
                                                    <option value="" disabled selected>Виберіть зі списку</option>
                                                    <option>A1</option>
                                                    <option>A2</option>
                                                    <option>B1</option>
                                                    <option>B2</option>
                                                    <option>C1</option>
                                                    <option>C2</option>
                                                </select>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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

                            <button type="submit" class="w-100 btn" style="border-radius: 0; color: #ffffff; background-color: #5e72e4">
                                {{ __('Зберегти зміни') }}
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

