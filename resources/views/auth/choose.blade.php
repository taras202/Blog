@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h4>Вибір дії</h4>
                </div>
                <div class="card-body text-center">
                    <p>Виберіть, що ви хочете зробити:</p>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Зареєструватися</a>
                    <a href="{{ route('login') }}" class="btn btn-secondary btn-lg">Увійти</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
