@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col" style="overflow: auto; height: 300px;">
                <div class="card mb-4">
                    <div class="d-flex justify-content-between">
                        <div class="card-header pb-0">
                            <h6>{{ __('Групи') }}</h6>
                        </div>
                        <a href="{{ route('group.add') }}">
                            <div class="card-header pb-0">
                                <h6>Додати групу</h6>
                            </div>
                        </a>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Група</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Спеціальність</th>
                                    <th class="text-secondary opacity-7"></th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($groups as $group)
                                    <tr>
                                            <?php $id = $group['id']?>
                                        <td style="padding: 0.75rem 1.5rem;">
                                            <a href='{{ url("admin/group/view/$id") }}'>
                                                <p class="text-xs font-weight-bold mb-0">{{ $group['name'] }}</p>
                                            </a>
                                        </td>
                                        <td>
                                            <a href='{{ url("admin/group/view/$id") }}'>
                                                <p class="text-xs font-weight-bold mb-0">{{ $group['code'] }}</p>
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <a href="/admin/group/edit/{{ $group['id'] }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Редагувати групу">
                                                Редагувати
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <form action="/admin/group/delete/{{ $group['id'] }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цю групу?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Видалити групу">
                                                    Видалити
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col" style="overflow: auto; height: 300px;">
                <div class="card mb-4">
                    <div class="d-flex justify-content-between">
                        <div class="card-header pb-0">
                            <h6>{{ __('Університети') }}</h6>
                        </div>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">id</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Університет</th>
                                    <th class="text-secondary opacity-7"></th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($universities as $university)
                                    <tr>
                                        <?php $id = $university['id']?>
                                        <td style="padding: 0.75rem 1.5rem;">
                                            <a href='{{ url("admin/university/view/$id") }}'>
                                                <p class="text-xs font-weight-bold mb-0">{{ $university['id'] }}</p>
                                            </a>
                                        </td>
                                        <td>
                                            <a href='{{ url("admin/university/view/$id") }}'>
                                                <p class="text-xs font-weight-bold mb-0">{{ $university['name'] }}</p>
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <a href="/admin/university/edit/{{ $university['id'] }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                Редагувати
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <form action="/admin/university/delete/{{ $university['id'] }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цей ВНЗ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Видалити ВНЗ">
                                                    Видалити
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col" style="overflow: auto; height: 300px;">
                <div class="card mb-4">
                    <div class="d-flex justify-content-between">
                        <div class="card-header pb-0">
                            <h6>{{ __('Факультети') }}</h6>
                        </div>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Факультет</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Повна назва</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Університет</th>
                                    <th class="text-secondary opacity-7"></th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($faculties as $faculty)
                                    <tr>
                                            <?php $id = $faculty['id']?>
                                        <td style="padding: 0.75rem 1.5rem;">
                                            <a href='{{ url("admin/faculty/view/$id") }}'>
                                                <p class="text-xs font-weight-bold mb-0">{{ $faculty['name'] }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $faculty['university'] }}</p>
                                            </a>
                                        </td>
                                        <td>
                                            <a href='{{ url("admin/faculty/view/$id") }}'>
                                                <p class="text-xs font-weight-bold mb-0">{{ $faculty['fullname'] }}</p>
                                            </a>
                                        </td>
                                        <td>
                                            <a href='{{ url("admin/faculty/view/$id") }}'>
                                                <p class="text-xs font-weight-bold mb-0">{{ $faculty['university'] }}</p>
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <a href="/admin/faculty/edit/{{ $faculty['id'] }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                Редагувати
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <form action="/admin/faculty/delete/{{ $faculty['id'] }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цей факультет?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Видалити факультет">
                                                    Видалити
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col" style="overflow: auto; height: 300px;">
                <div class="card mb-4">
                    <div class="d-flex justify-content-between">
                        <div class="card-header pb-0">
                            <h6>{{ __('Спеціальності') }}</h6>
                        </div>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Спеціальність</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Назва</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Університет</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Факультет</th>
                                    <th class="text-secondary opacity-7"></th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($specialties as $specialty)
                                    <tr>
                                            <?php $id = $specialty['id']?>
                                        <td style="padding: 0.75rem 1.5rem;">
                                            <a href='{{ url("admin/specialty/view/$id") }}'>
                                                <p class="text-xs font-weight-bold mb-0">{{ $specialty['code'] }}</p>
                                                {{--                                                <p class="text-xs text-secondary mb-0">{{ $specialty['university'] }} / {{ $specialty['faculty'] }}</p>--}}
                                            </a>
                                        </td>
                                        <td>
                                            <a href='{{ url("admin/specialty/view/$id") }}'>
                                                <p class="text-xs font-weight-bold mb-0">{{ $specialty['name'] }}</p>
                                            </a>
                                        </td>
                                        <td>
                                            <a href='{{ url("admin/specialty/view/$id") }}'>
                                                <p class="text-xs font-weight-bold mb-0">{{ $specialty['university'] }}</p>
                                            </a>
                                        </td>
                                        <td>
                                            <a href='{{ url("admin/specialty/view/$id") }}'>
                                                <p class="text-xs font-weight-bold mb-0">{{ $specialty['faculty'] }}</p>
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <a href="/admin/specialty/edit/{{ $specialty['id'] }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                Редагувати
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <form action="/admin/specialty/delete/{{ $specialty['id'] }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете видалити цей факультет?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Видалити факультет">
                                                    Видалити
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
