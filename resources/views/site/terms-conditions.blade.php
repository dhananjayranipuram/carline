@extends('layouts.site')

@section('content')

<div class="page-fleets-single">
        <div class="container">
            <div class="row">
                

                <div class="col-lg-12">
                    <!-- Feets Single Content Start -->
                    <div class="fleets-single-content">

                        <!-- Rental Conditions Faqs Start -->
                        <div class="rental-conditions-faqs">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h2 class="text-anime-style-3" data-cursor="-opaque">Terms and Conditions</h2>
                            </div>
                            <!-- Section Title End -->
                                @foreach($policy as $key => $value)
                                <h3>{{$value->name}}</h3>
                                {!!html_entity_decode(nl2br(e($value->content)))!!}
                                <br>
                                @endforeach
                                <h3>Terms of Use and Payment Policy</h3>

                                <ul>
                                    <li><strong>Website Ownership:</strong> "CAR LINE CAR RENTAL LLC" maintains the <a target="_blank" style="color:#000080;" href="https://carlinerental.com">https://carlinerental.com</a> website.</li>
                                    <li><strong>Country of Domicile:</strong> The United Arab Emirates is our country of domicile, and the governing law is the local law.</li>
                                    <li><strong>Governing Law:</strong> Any purchase, dispute, or claim arising out of or in connection with this website shall be governed and construed in accordance with the laws of UAE.</li>
                                    <li><strong>Accepted Payment Methods:</strong> Visa or MasterCard debit and credit cards in AED will be accepted for payment.</li>
                                    <li><strong>Transaction Details:</strong> The displayed price and currency at the checkout page will be the same price and currency printed on the Transaction Receipt, and the amount charged to the card will be shown in your card currency.</li>
                                    <li><strong>Sanctioned Countries:</strong> We will not trade with or provide any services to OFAC and sanctioned countries.</li>
                                    <li><strong>Minors:</strong> Customers using the website who are minors (under the age of 18) shall not register as a User of the website and shall not transact on or use the website.</li>
                                    <li><strong>Transaction Records:</strong> Cardholders must retain a copy of transaction records and <a target="_blank" style="color:#000080;" href="https://carlinerental.com">https://carlinerental.com</a> policies and rules.</li>
                                    <li><strong>User Responsibility:</strong> Users are responsible for maintaining the confidentiality of their account.</li>
                                    <li><strong>Payment confirmation:</strong> Once the payment is made, the confirmation notice will be sent to the client via email within 24 hours of receipt.</li>
                                </ul>
                        </div>
                        <!-- Rental Conditions Faqs End -->

                    </div>
                    <!-- Feets Single Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Feets Single End -->




@endsection