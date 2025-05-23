@extends('layouts.site')

@section('content')
    <style>
        .booking-form-group {
            padding: 50px 0;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .booking-form-group i {
            font-size: 200px;
            color: #006d09;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease-out;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .booking-table th,
        .booking-table td {
            padding: 10px 20px;
            font-size: 18px;
        }

        .booking-table th {
            text-align: right;
            font-weight: 600;
            color: #333;
        }

        .booking-table td {
            text-align: left;
            color: #555;
        }

        @media (max-width: 576px) {

            .booking-table th,
            .booking-table td {
                font-size: 16px;
                padding: 8px 15px;
            }

            .booking-form-group i {
                font-size: 150px;
            }
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="booking-form-group col-md-12 text-center" style="padding: 50px 0 50px 0;">
                <i class="fas fa-check-circle" style="font-size: 200px; color: #006d09; margin-bottom: 20px;"></i>
                <div id="booking-details">
                    <table class="table booking-table">
                        <tbody>
                            <tr>
                                <th>Booking ID:</th>
                                <td>{{ $bookingId }}</td>
                            </tr>
                            <tr>
                                <th>Car Name:</th>
                                <td>{{ $paymentDetails[0]->car_name }}</td>
                            </tr>
                            <tr>
                                <th>Pickup Location:</th>
                                <td>{{ str_replace(',', ', ', $paymentDetails[0]->s_address) }}</td>
                            </tr>
                            <tr>
                                <th>Pickup Date:</th>
                                <td>{{ date('d-m-Y', strtotime($pickupdate)) }}</td>
                            </tr>
                            <tr>
                                <th>Pickup Time:</th>
                                <td>{{ $pickuptime }}</td>
                            </tr>

                            <tr>
                                <th>Dropoff Location:</th>
                                <td>{{ str_replace(',', ', ', $paymentDetails[0]->d_address) }}</td>
                            </tr>
                            <tr>
                                <th>Dropoff Date:</th>
                                <td>{{ date('d-m-Y', strtotime($returndate)) }}</td>
                            </tr>
                            <tr>
                                <th>Dropoff Time:</th>
                                <td>{{ $returntime }}</td>
                            </tr>

                            <tr>
                                <th>Rate:</th>
                                <td>{{ $paymentDetails[0]->rate }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center mt-3">
                        <a href="{{ route('signature.page') }}" class="btn btn-success btn-lg">
                            Sign Document
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
