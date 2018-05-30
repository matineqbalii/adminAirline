@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="text-align: right">{{ __('ثبت نام') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-6 offset-md-2">
                                <input dir="rtl" id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label for="name" class="col-md-2 col-form-label text-md-right">نام</label>

                        </div>

                        <div class="form-group row">

                            <div class="col-md-6 offset-md-2">
                                <input dir="rtl" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('آدرس ایمیل') }}</label>

                        </div>

                        <div class="form-group row">

                            <div class="col-md-6 offset-md-2">
                                <input dir="rtl" id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('پسورد') }}</label>

                        </div>

                        <div class="form-group row">

                            <div class="col-md-6 offset-md-2">
                                <input dir="rtl" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>

                            <label for="password-confirm" class="col-md-2 col-form-label text-md-right">{{ __('تکرار پسورد') }}</label>

                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <input dir="rtl" id="tel" type="tel" class="form-control{{ $errors->has('tel') ? ' is-invalid' : '' }}" value="{{ old('tel') }}"  name="tel" required>

                                @if ($errors->has('tel'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('tel') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label for="tel" class="col-md-2 col-form-label text-md-right">{{ __('تلفن') }}</label>

                        </div>

                        <div class="form-group row">

                            <div class="col-md-6 offset-md-2">
                                <input dir="rtl" id="image" type="file" class="form-control" name="image">

                            </div>

                            <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('انتخاب تصویر') }}</label>

                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('ثبت نام') }}
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
