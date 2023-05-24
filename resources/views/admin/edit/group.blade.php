@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>{{ __('Група') }}</h6>
                    </div>

                    <form action="/admin/group/update/{{ $group['id'] }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>{{ __('Група') }}</td>
                                            <td>
                                                <input type="text" name="group" value="{{ $group['name'] }}" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Спеціальність') }}</td>
                                            <td>
                                                <select class="form-control" name="specialty">
                                                    @foreach($specialties as $specialty)
                                                        <option value="{{$specialty['id']}}" @if ($group['specialty_row'] === $specialty['specialty_row']) selected @endif>{{ $specialty['specialty_row'] }}</option>
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
