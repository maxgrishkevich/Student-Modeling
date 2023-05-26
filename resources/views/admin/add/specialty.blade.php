@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>{{ __('Спеціальність') }}</h6>
                    </div>

                    <form action="{{ route('specialty.save') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>{{ __('Код') }}</td>
                                            <td>
                                                <input type="number" name="code" placeholder="введіть код(номер)" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Назва') }}</td>
                                            <td>
                                                <input type="text" name="name" placeholder="введіть повну назву" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Університет') }}</td>
                                            <td>
                                                <select class="form-control" name="university">
                                                    <option value="" disabled selected>{{ __('виберіть зі списку') }}</option>
                                                    @foreach($universities as $university)
                                                        <option value="{{$university['id']}}">{{ $university['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Факультет') }}</td>
                                            <td>
                                                <select class="form-control" name="faculty">
                                                    <option value="" disabled selected>{{ __('виберіть зі списку') }}</option>
                                                    @foreach($faculties as $faculty)
                                                        <option value="{{$faculty['id']}}">{{ $faculty['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
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

