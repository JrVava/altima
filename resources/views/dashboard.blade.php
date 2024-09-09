@extends('layouts.app-layout')

@section('title', 'Dashboard')
<style>
    #north-america-chart {
        width: 600px;
        height: 600px;
    }
</style>
@section('content')
    <div class="row" style="display: flex; align-items: center;">

        <div class="row" style="display: flex; align-items: center;">
            <div class="col-md-3 grid-margin transparent">
                <div class="card card-tale">
                    <div class="card-body">
                        <h4 class="mb-4">Total Users</h4>
                        <p class="fs-30 mb-2">{{ isset($users) ? $users->count() : 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 grid-margin transparent">
                <div class="card card-dark-blue">
                    <div class="card-body">
                        <h4 class="mb-4">Total User with Poster</h4>
                        <p class="fs-30 mb-2">{{ isset($usersWithDetails) ? $usersWithDetails : 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 grid-margin transparent">
                <div class="card card-light-blue">
                    <div class="card-body">
                        <h4 class="mb-4">Total User without Poster</h4>
                        <p class="fs-30 mb-2">{{ isset($usersWithoutDetails) ? $usersWithoutDetails : 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 grid-margin transparent">
                <div class="card card-light-danger">
                    <div class="card-body">
                        <h4 class="mb-4">Downloaded Poster</h4>
                        <p class="fs-30 mb-2">{{ isset($downloaded) ? $downloaded : 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 grid-margin transparent">
                <div class="card card-light-green">
                    <div class="card-body">
                        <h4 class="mb-4">Frame 1</h4>
                        <p class="fs-30 mb-2">{{ isset($userDetailWithFrame1Count) ? $userDetailWithFrame1Count : 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 grid-margin transparent">
                <div class="card card-light-purple">
                    <div class="card-body">
                        <h4 class="mb-4">Frame 2</h4>
                        <p class="fs-30 mb-2">{{ isset($userDetailWithFrame2Count) ? $userDetailWithFrame2Count : 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 grid-margin transparent">
                <div class="card card-light-yellow">
                    <div class="card-body">
                        <h4 class="mb-4">Frame 3</h4>
                        <p class="fs-30 mb-2">{{ isset($userDetailWithFrame3Count) ? $userDetailWithFrame3Count : 0 }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="card-title">Users Report</p>
                    </div>
                    <div class="daoughnutchart-wrapper" style="width:100%; height:90%;">
                        <canvas id="north-america-chart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('script')
    <script>
        var xValues = [
            "Total User",
            "Total User with Poster",
            "Total User without Poster",
            "Downloaded Poster",
            "Frame 1",
            "Frame 2",
            "Frame 3",
        ];
        var yValues = [
            {{ isset($users) ? $users->count() : 0 }},
            {{ isset($usersWithDetails) ? $usersWithDetails : 0 }},
            {{ isset($usersWithoutDetails) ? $usersWithoutDetails : 0 }},
            {{ isset($downloaded) ? $downloaded : 0 }},
            {{ isset($userDetailWithFrame1Count) ? $userDetailWithFrame1Count : 0 }},
            {{ isset($userDetailWithFrame2Count) ? $userDetailWithFrame2Count : 0 }},
            {{ isset($userDetailWithFrame3Count) ? $userDetailWithFrame3Count : 0 }},
        ];
        var barColors = [
            "#b91d47",
            "#00aba9",
            "#2b5797",
            "#e8c3b9",
            "#248AFD",
            "#FFC100",
            "#4B49AC"
        ];

        new Chart("north-america-chart", {
            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "World Wide Wine Production 2018"
                }
            }
        });
    </script>
@endsection
@endsection
