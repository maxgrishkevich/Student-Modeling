@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="d-flex justify-content-between">
                        <div class="card-header pb-0">
                            <h6>Заявки на реєстрацію</h6>
                        </div>
                    </div>

                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Студент</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Університет</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Факультет</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Спеціальність</th>
                                    <th class="text-secondary opacity-7"></th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if ($apps)
                                @foreach($apps as $row)
                                    <tr>
                                            <?php $id = $row['id']?>

                                        <td>
                                            <a href='{{ url("admin/application/view/$id") }}'>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                            <?php $img = $row['img'] ?>
                                                        <img src='{{ asset("storage/img/students/$img") }}' class="avatar avatar-sm me-3" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $row['fullname'] }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $row['email'] }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                        <td>
                                            <a href='{{ url("admin/application/view/$id") }}'>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row['university'] }}</p>
                                                <p class="text-xs text-secondary mb-0">НТУУ</p>
                                            </a>
                                        </td>
                                        <td>
                                            <a href='{{ url("admin/application/view/$id") }}'>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row['faculty'] }}</p>
                                            </a>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href='{{ url("admin/application/view/$id") }}'>
                                                <p class="text-xs font-weight-bold mb-0">{{ $row['specialty'] }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $row['specialty_full'] }}</p>
                                            </a>
                                        </td>

                                        <td class="align-middle">
                                            <form action="/admin/application/accept/{{ $row['id'] }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете схвалити цю заявку')">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Cхвалити заявку">
                                                    {{ __('Прийняти') }}
                                                </button>
{{--                                            <a href="/admin/application/accept/{{ $row['id'] }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Accept student">--}}
{{--                                                {{ __('Прийняти') }}--}}
{{--                                            </a>--}}
                                            </form>
                                        </td>
                                        <td class="align-middle">
                                            <form action="/admin/application/reject/{{ $row['id'] }}" method="POST" onsubmit="return confirm('Ви впевнені, що хочете відхилити цю заявку? Дані будуть безповоротно видалені!')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Видалити заявку">
                                                    {{ __('Відхилити') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    @if (session('info'))
                                        <div class="alert alert-info">
                                            {{ session('info') }}
                                        </div>
                                    @endif
                                @endif
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
@endsection

