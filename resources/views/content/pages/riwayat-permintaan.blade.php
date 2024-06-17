@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')
    <h4>Home Page</h4>
    <div class="col-md mb-4 mb-md-2">
        <small class="text-light fw-medium">Accordion With Icon (Always Open)</small>
        <div class="accordion mt-3" id="accordionWithIcon">



            <div class="accordion-item">
                <h2 class="accordion-header d-flex align-items-center">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                        data-bs-target="#accordionWithIcon-3" aria-expanded="false">
                        <i class="mdi mdi-gift me-2"></i>
                        Header Option 3
                    </button>
                </h2>
                <div id="accordionWithIcon-3" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        Oat cake toffee chocolate bar jujubes. Marshmallow brownie lemon drops cheesecake. Bonbon
                        gingerbread
                        marshmallow
                        sweet jelly beans muffin. Sweet roll bear claw candy canes oat cake dragée caramels. Ice cream wafer
                        danish
                        cookie caramels muffin.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
