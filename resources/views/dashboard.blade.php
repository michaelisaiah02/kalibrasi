@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-around my-5">
            <div class="col-md-auto">
                <a href="{{ route('input') }}">
                    <div class="card border-0" style="width: 30rem;">
                        <img src="{{ asset('icon/input.svg') }}" class="mx-auto my-5 icon" alt="Input" width="100">
                        <div class="card-body mx-auto w-100">
                            <button class="btn btn-primary py-3 px-5 w-100 rounded-4"
                                style="font-size: 3.5rem">INPUT</button>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-auto">
                <a href="{{ route('report') }}">
                    <div class="card border-0" style="width: 30rem;">
                        <img src="{{ asset('icon/report.svg') }}" class="mx-auto my-5 icon" alt="Report" width="100">
                        <div class="card-body mx-auto w-100">
                            <button class="btn btn-primary py-3 px-5 w-100 rounded-4"
                                style="font-size: 3.5rem">REPORT</button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="post" class="row justify-content-center">
            <div class="col-3">
                @csrf
                <button type="submit" class="btn btn-primary text-center mt-3 mx-auto fs-2 w-100">LOG OUT</button>
            </div>
        </form>
    </div>
    </div>
@endsection
