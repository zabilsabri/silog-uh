@extends('layouts.app')
@section('sidebar', 'True')
@section('title', 'Dashboard')

@section('content')
    <div class="m-3">
        <div class="d-flex justify-content-between align-items-center">
            <h3>Dashboard</h3>
        </div>

        <div class="row justify-content-around">
            <div class="col-md-5 border p-3 rounded-2 mb-1">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('image/asset/user_admin.png') }}" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3 d-flex justify-content-between">
                        <h6 class="m-0">Jumlah Mahasiswa</h6>
                        <h6 class="m-0">{{ $userCount }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-5 border p-3 rounded-2 mb-1">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('image/asset/project_admin.png') }}" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3 d-flex justify-content-between">
                        <h6 class="m-0">Jumlah Skripsi</h6>
                        <h6 class="m-0">{{ $thesisCount }}</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 g-4 mt-1">
            <div class="col-md-6">
                <canvas id="chartUser" width="400" height="300"></canvas>
            </div>
            <div class="col-md-6">
                <div class="border text-center p-3 rounded-2">
                    <h6>Aktivitas Terbaru</h6>
                    @foreach($newThesis as $newThesis_list)
                        <div class="card font-smaller mb-2">
                            <div class="card-body text-start">
                                @if($newThesis_list->created_at == $newThesis_list->updated_at)
                                    {{ $newThesis_list->user->first_name . ' ' . $newThesis_list->user->last_name }} mengupload pada
                                    - {{ \Carbon\Carbon::parse($newThesis_list->created_at)->locale('id')->translatedFormat('d F Y H:i') }}
                                @else
                                    {{ $newThesis_list->user->first_name . ' ' . $newThesis_list->user->last_name }} memperbarui data pada -
                                        {{ \Carbon\Carbon::parse($newThesis_list->updated_at)->locale('id')->translatedFormat('d F Y H:i') }}
                                @endif 
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('chartUser').getContext('2d');

            // Use static data passed from the controller
            const labels = @json($labelThesis); // Static date labels
            const data = @json($dataThesis); // Static data values

            const chartUser = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels, // Static date labels
                    datasets: [{
                        label: 'Total',
                        data: data, // Static data values
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Jumlah Upload Setiap Bulan', // The title of your chart
                            font: {
                                size: 18, // Adjust font size
                                weight: 'bold' // Make it bold
                            },
                            padding: {
                                top: 10,
                                bottom: 20
                            },
                            color: '#333' // Customize title color
                        }
                    },
                    scales: {
                        x: {
                            type: 'time', // Use time scale
                            time: {
                                unit: 'month',
                                displayFormats: {
                                    month: 'MMM' // Show only the month (e.g., "Jan", "Feb", "Mar")
                                } // Display by month // Display by month
                            },
                            title: {
                                display: true,
                                text: 'Bulan'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1, // Ensure Y-axis increments by 1
                                precision: 0 // Remove decimal places
                            },
                            title: {
                                display: true,
                                text: 'Total'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection