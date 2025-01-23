@extends('layouts.admin')

@section('content')
<style>
/* Container styling */
.input-container {
  position: relative;
  /* margin: 20px 0; */
}

/* Input styling */
input[type="text"] {
  width: 100%;
  padding: 10px 5px;
  font-size: 16px;
  border: 2px solid #ccc;
  border-radius: 4px;
  outline: none;
  background: none;
}

/* Change border color on focus */
input[type="text"]:focus {
  border-color: #007bff;
}

/* Label (placeholder text) styling */
.input-placeholder {
  position: absolute;
  top: 50%;
  left: 15px;
  transform: translateY(-50%);
  font-size: 16px;
  color: #999;
  background: white;
  padding: 0 5px;
  transition: all 0.3s ease;
  pointer-events: none; /* Prevent label from blocking input clicks */
}

/* Move the placeholder to the border when input is focused or contains text */
input[type="text"]:focus + .input-placeholder,
input[type="text"]:not(:placeholder-shown) + .input-placeholder {
  top: 10px;
  left: 15px;
  font-size: 12px;
  color: #007bff; /* Change color when active */
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">

            <form method="post" action="{{ url('/admin/add-car') }}" enctype="multipart/form-data">
                @csrf <!-- {{ csrf_field() }} -->
                <div class="card-header">
                    <div class="card-title">Add a Car</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($errors->any())
                            <div class="col-12 error-messages" style="color:red;">
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            </div>
                        @endif
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group input-container">
                                <input type="text" class="form-control" name="name" placeholder="" value="{{old('name')}}"/>
                                <label for="input-box" class="input-placeholder">Car Name</label>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="brand">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $value)
                                        <option value="{{$value->id}}" @if(old('brand') == $value->id) selected @endif>{{$value->name}}</option>
                                    @endforeach
                                </select>
                                @error('brand') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="model">
                                    <option value="">Select Model</option>
                                    @php 
                                    $year = date('Y');
                                    if(date('M')>10){
                                        $year = date('Y')+1;
                                    }
                                    @endphp
                                    @for ($i = $year; $i >= 1990; $i--)
                                        <option value="{{$i}}" @if(old('model') == $i) selected @endif>{{$i}}</option>
                                    @endfor
                                </select>
                                @error('model') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="form-group">
                                <select class="form-control" name="cartype">
                                    <option value="">Select Car Type</option>
                                    @foreach($type as $value)
                                        <option value="{{$value->id}}" @if(old('cartype') == $value->id) selected @endif>{{$value->name}}</option>
                                    @endforeach
                                </select>
                                @error('cartype') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Available Features</label><br>
                                <div class="selectgroup selectgroup-pills">
                                    @foreach($features as $value)
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="features[]" value="{{$value->id}}" checked class="selectgroup-input" 
                                               @if(is_array(old('features')) && in_array($value->id, old('features'))) checked @endif />
                                        <span class="selectgroup-button">{{$value->feature}}</span>
                                    </label>
                                    @endforeach
                                </div>
                                @error('features') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Images</h4>
                                </div>
                                <div class="card-body">
                                    <input type="file" name="carImages[]" multiple="multiple" accept="image/*">
                                    @error('carImages') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Rent per day in AED</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group input-container">
                                        <input type="text" name="rent" class="form-control" placeholder="" value="{{old('rent')}}">
                                        <label for="input-box" class="input-placeholder">Daily Rent (AED)</label>
                                        @error('rent') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group input-container">
                                        <input type="text" name="daily_mileage" placeholder="" class="form-control" value="{{old('daily_mileage')}}">
                                        <label for="input-box" class="input-placeholder">Daily Mileage (KM)</label>
                                        @error('daily_mileage')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <input class="form-check-input" type="checkbox" name="offerFlag" id="offerFlag"
                                               @if(old('offerFlag')) checked @endif>
                                        <label class="form-check-label" for="offerFlag">Avail special offers</label>
                                    </div>

                                    <div class="form-group special-offer" style="display: none;">
                                        <div class="form-group input-container">
                                            <input type="text" name="specialOffer" placeholder="" class="form-control" value="{{old('specialOffer')}}">
                                            <label for="input-box" class="input-placeholder">Offer price (AED)</label>
                                            @error('specialOffer') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Weekly rent in AED</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group input-container">
                                        <input type="text" name="weekly_rent" placeholder="" class="form-control" value="{{old('weekly_rent')}}">
                                        <label for="input-box" class="input-placeholder">Weekly Rent (AED)</label>
                                        @error('weekly_rent')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group input-container">
                                        <input type="text" name="weekly_mileage" placeholder="" class="form-control" value="{{old('weekly_mileage')}}">
                                        <label for="input-box" class="input-placeholder">Weekly Mileage (KM)</label>
                                        @error('weekly_mileage')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input class="form-check-input offer-flag" type="checkbox" name="offerFlagWeekly" id="offerFlagWeekly" 
                                            @if(old('offerFlagWeekly')) checked @endif>
                                        <label class="form-check-label">Avail special offers</label>
                                    </div>
                                    <div class="col-12 col-md-12 special-offer-weekly">
                                        <div class="form-group input-container">
                                            <input type="text" name="specialOfferWeekly" placeholder="" class="form-control" value="{{old('specialOfferWeekly')}}">
                                            <label for="input-box" class="input-placeholder">Offer Price (AED)</label>
                                            @error('specialOfferWeekly')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Monthly rent in AED</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group input-container">
                                        <input type="text" name="monthly_rent" placeholder="" class="form-control" value="{{old('monthly_rent')}}">
                                        <label for="input-box" class="input-placeholder">Monthly Rent (AED)</label>
                                        @error('monthly_rent')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group input-container">
                                        <input type="text" name="monthly_mileage" placeholder="" class="form-control" value="{{old('monthly_mileage')}}">
                                        <label for="input-box" class="input-placeholder">Monthly Mileage (KM)</label>
                                        @error('monthly_mileage')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input class="form-check-input offer-flag" type="checkbox" name="offerFlagMonthly" id="offerFlagMonthly" 
                                            @if(old('offerFlagMonthly')) checked @endif>
                                        <label class="form-check-label">Avail special offers</label>
                                    </div>
                                    <div class="col-12 col-md-12 special-offer-monthly">
                                        <div class="form-group input-container">
                                            <input type="text" name="specialOfferMonthly" placeholder="" class="form-control" value="{{old('specialOfferMonthly')}}">
                                            <label for="input-box" class="input-placeholder">Offer Price (AED)</label>
                                            @error('specialOfferMonthly')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Other Charges AED</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group input-container">
                                        <input type="text" name="deposit" placeholder="" class="form-control" value="{{old('deposit')}}">
                                        <label for="input-box" class="input-placeholder">Refundable Deposit Amount (AED)</label>
                                        @error('deposit') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-group input-container">
                                        <input type="text" name="toll" placeholder="" class="form-control" value="{{old('toll')}}">
                                        <label for="input-box" class="input-placeholder">Toll Amount (AED)</label>
                                        @error('toll')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group input-container">
                                        <input type="text" name="additionalCharge" placeholder="" class="form-control" value="{{old('additionalCharge')}}">
                                        <label for="input-box" class="input-placeholder">Additional rent per KM (AED)</label>
                                        @error('additionalCharge')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Quantity</h4>
                                </div>
                                <div class="card-body">
                                    <input type="text" name="qty" placeholder="Enter Quantity" class="form-control" value="{{old('qty')}}">
                                    @error('qty') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <!--<div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Kilometers Driven</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group input-container">
                                        <input type="text" name="kmeter" placeholder="" class="form-control" value="{{old('kmeter')}}">
                                        @error('kmeter') <span class="text-danger">{{ $message }}</span> @enderror
                                        <label for="input-box" class="input-placeholder">Kilometers Driven (KM)</label>
                                    </div>
                                </div>
                            </div>-->
                            
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Specifications</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5 col-md-4">
                                            <div class="nav flex-column nav-pills nav-secondary nav-pills-no-bd" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                @foreach($specification as $key => $value)
                                                <a class="nav-link @if($key == 0) active @endif" id="v-pills-{{$value->id}}-tab" data-bs-toggle="pill" href="#v-pills-{{$value->id}}" role="tab">{{$value->name}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-7 col-md-8">
                                            <div class="tab-content">
                                                @foreach($specification as $key => $value)
                                                <div class="tab-pane fade @if($key == 0) show active @endif" id="v-pills-{{$value->id}}" role="tabpanel">
                                                    <select class="form-control" name="specifications[]">
                                                        <option disabled selected>Select {{$value->name}}</option>
                                                        @foreach(explode('~', $value->options) as $option)
                                                        <option value="{{$value->id}}~{{$option}}">{{$option}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Others</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="general_info" @if(old('general_info')) checked @endif> Include general information
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Fuel Type</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-check">
                                        <select class="form-control" name="fuel_type">
                                            <option value="" disabled selected>Fuel Type</option>
                                            @foreach(['Petrol', 'Diesel', 'Electric', 'Hybrid'] as $fuelType)
                                                <option value="{{ strtolower($fuelType) }}" @if(old('fuel_type') == strtolower($fuelType)) selected @endif>{{ $fuelType }}</option>
                                            @endforeach
                                        </select>
                                        @error('fuel_type')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Booking Type</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="online_flag" @if(old('online_flag')) checked @endif> Book through online
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="whatsapp_flag" @if(old('whatsapp_flag')) checked @endif> Book through whatsapp
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-action">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" onclick="window.location.href='{{ url('/admin/cars') }}'">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript to toggle the special offer input field -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const offerFlag = document.getElementById('offerFlag');
        const specialOffer = document.querySelector('.special-offer');
        function toggleSpecialOffer() {
            specialOffer.style.display = offerFlag.checked ? 'block' : 'none';
        }
        offerFlag.addEventListener('change', toggleSpecialOffer);
        toggleSpecialOffer();

        const offerFlagWeekly = document.getElementById('offerFlagWeekly');
        const specialOfferWeekly = document.querySelector('.special-offer-weekly');
        function toggleSpecialOfferWeekly() {
            specialOfferWeekly.style.display = offerFlagWeekly.checked ? 'block' : 'none';
        }
        offerFlagWeekly.addEventListener('change', toggleSpecialOfferWeekly);
        toggleSpecialOfferWeekly();
        
        const offerFlagMonthly = document.getElementById('offerFlagMonthly');
        const specialOfferMonthly = document.querySelector('.special-offer-monthly');
        function toggleSpecialOfferMonthly() {
            specialOfferMonthly.style.display = offerFlagMonthly.checked ? 'block' : 'none';
        }
        offerFlagMonthly.addEventListener('change', toggleSpecialOfferMonthly);
        toggleSpecialOfferMonthly();
    });
</script>

@endsection
