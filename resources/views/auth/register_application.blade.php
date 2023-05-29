@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Реєстрація') }}</div>

                    <div class="card-body">
                        <form action="{{ route('application.save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="_method" value="PUT">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="photocard" class="col-form-label text-md-end">{{ __('Оберіть фотокартку') }}</label>
                                    <input style="border-radius: 0" type="file" class="form-control" name="photocard" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="fullname" class="col-form-label text-md-end">{{ __('ПІБ') }}</label>
                                    <input style="border-radius: 0" type="text" class="form-control" name="fullname" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="col-form-label text-md-end">{{ __('Email') }}</label>
                                    <input style="border-radius: 0" type="email" class="form-control" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="sex" class="col-form-label text-md-end">{{ __('Стать') }}</label>
                                    <select id="sex" class="form-control" name="sex">
                                        <option value="" disabled selected>{{ __('Виберіть зі списку') }}</option>
                                        <option value="чоловіча">{{ __('чоловіча') }}</option>
                                        <option value="жіноча">{{ __('жіноча')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="password" class="col-form-label text-md-end">{{ __('Пароль') }}</label>
                                    <input style="border-radius: 0" type="password" class="form-control" name="password" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="birth" class="col-form-label text-md-end">{{ __('Дата народження') }}</label>
                                    <input type="date" class="form-control" name="birth" pattern="\d{4}-\d{2}-\d{2}" placeholder="Рік-Місяць-День" required>
                                </div>
                            </div>


                            <div class="row mb-3 mt-5">
                                <div class="col-md-6">
                                    <label for="group" class="col-form-label text-md-end">{{ __('Група') }}</label>
                                    <select class="form-control" name="group" required>
                                        <option value="" disabled selected>{{ __('Виберіть зі списку') }}</option>
                                            @foreach($groups as $group)
                                                <option value="{{ $group['id'] }}">{{ $group['name'] }}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="employment_status" class="col-form-label text-md-end">{{ __('Статус зайнятості') }}</label>
                                    <select class="form-control" name="employment_status" required>
                                        <option value="" disabled selected>{{ __('Виберіть зі списку') }}</option>
                                        <option value="0">{{ __('Шукає роботу') }}</option>
                                        <option value="1">{{ __('Працевлаштований') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="educational_degree" class="col-form-label text-md-end">{{ __('Ступінь освіти') }}</label>
                                    <select class="form-control" name="educational_degree" required>
                                        <option value="" disabled selected>{{ __('Виберіть зі списку') }}</option>
                                        <option value="бакалавр">{{ __('бакалавр') }}</option>
                                        <option value="магістр">{{ __('магістр') }}</option>
                                        <option value="аспірант">{{ __('аспірант') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="experience" class="col-form-label text-md-end">{{ __('Загальний досвід') }}</label>
                                    <input type="number" class="form-control" name="experience" placeholder="Введіть число" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="entry_date" class="col-form-label text-md-end">{{ __('Дата вступу') }}</label>
                                    <input style="border-radius: 0" type="date" class="form-control" name="entry_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="off_experience" class="col-form-label text-md-end">{{ __('Офіційний досвід') }}</label>
                                    <input type="number" class="form-control" name="off_experience" placeholder="Введіть число" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="graduation_date" class="col-form-label text-md-end">{{ __('Дата випуску') }}</label>
                                    <input style="border-radius: 0" type="date" class="form-control" name="graduation_date" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="field" class="col-form-label text-md-end">{{ __('Напрямок діяльності') }}</label>
                                    <input style="border-radius: 0" type="text" class="form-control" name="field" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <label for="position" class="col-form-label text-md-end">{{ __('Посада') }}</label>
                                    <input style="border-radius: 0" type="text" class="form-control" name="position" required placeholder="поточна/бажана">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <label for="level" class="col-form-label text-md-end">{{ __('Рівень') }}</label>
                                    <select class="form-control" name="level" required>
                                        <option value="" disabled selected>{{ __('Виберіть зі списку') }}</option>
                                        <option value="intern">{{ __('intern') }}</option>
                                        <option value="junior">{{ __('junior') }}</option>
                                        <option value="strong junior">{{ __('strong junior') }}</option>
                                        <option value="middle">{{ __('middle') }}</option>
                                        <option value="strong middle">{{ __('strong middle') }}</option>
                                        <option value="senior">{{ __('senior') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <label for="eng_level" class="col-form-label text-md-end">{{ __('Рівень англійської') }}</label>
                                    <select class="form-control" name="eng_level" required>
                                        <option value="" disabled selected>Виберіть зі списку</option>
                                        <option value="A1">{{ __('A1') }}</option>
                                        <option value="A2">{{ __('A2') }}</option>
                                        <option value="B1">{{ __('B1') }}</option>
                                        <option value="B2">{{ __('B2') }}</option>
                                        <option value="C1">{{ __('C1') }}</option>
                                        <option value="C2">{{ __('C2') }}</option>
                                    </select>
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
                            <div class="row mb-5 mt-5">
                                <div class="col w-100">
                                    <button type="submit" class="btn btn-primary" style="background-color: #5e72e4;color: #ffffff; border-radius: 0; width: inherit;">
                                        {{ __('Подати на розгляд') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

