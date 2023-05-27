@extends('dashboard')

@section('info-card')
    <div class="card">
        <div class="card-header">{{ __('Покращення знань') }}</div>
        <div class="card-body">
            <div class="row mb-5 mt-3">
                <div class="col d-flex">
                    <label class="align-self-center me-3" for="display">{{ __('Бібліотека матеріалів') }}</label>
{{--                    <select class="form-control w-50" name="display">--}}
{{--                        <option value="1">{{ __('ні') }}</option>--}}
{{--                        <option selected value="0">{{ __('так') }}</option>--}}
{{--                    </select>--}}
                </div>
                <div class="col">
                    <button onclick="window.location.href = '{{ route('dashboard.load_boost') }}';" class="w-75 btn float-end" style="border-radius: 0; color: #ffffff; background-color: #5e72e4">
                        {{ __('Завантажити ще') }}
                    </button>
                </div>
            </div>

            @foreach($boosts as $boost)
            <div class="row mb-3">
                <div class="toast w-100" style="display: block !important;" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header d-flex justify-content-between">
                        <div>
                            <img height="25" src="{{ asset('img/welcome/logo.png') }}" class="rounded mr-2" alt="...">
                            <strong class="mr-auto align-bottom">{{ $boost['subject'] }}</strong>
                        </div>
                        <div>
                            <small class="text-muted">{{ $boost['date'] }}</small>
                            <?php $id = $boost['id']?>
                            <button type="button" class="ml-2 mb-1 close"
                                    onclick="window.location.href = '{{ url("/dashboard/boost/change_status/$id") }}';"
                                    style="background: none; border: none">
                                <span style="font-size: 1.5rem" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="toast-body d-flex justify-content-between">
                        <p class="m-0">{{ $boost['title'] }}</p>
                        <button class="btn float-end" onclick="window.open('{{ $boost['link'] }}', '_blank');" style="border-radius: 0; color: #ffffff; background-color: #5e72e4">
                            {{ __('Переглянути') }}
                        </button>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
@endsection
