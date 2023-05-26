@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>{{ __('Факультет') }}</h6>
                    </div>

                    <form action="/admin/faculty/update/{{ $faculty['id'] }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>{{ __('Факультет') }}</td>
                                            <td>
                                                <input type="text" name="name" value="{{ $faculty['name'] }}" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Повна назва') }}</td>
                                            <td>
                                                <input type="text" name="fullname" value="{{ $faculty['fullname'] }}" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Університет') }}</td>
                                            <td>
                                                <select class="form-control" name="university">
                                                    @foreach($universities as $university)
                                                        <option value="{{$university['id']}}" @if ($faculty['university_id'] === $university['id']) selected @endif>{{ $university['name'] }}</option>
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
