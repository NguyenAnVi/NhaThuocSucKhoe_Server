@extends('layouts.app')
@section('title', trans('main.home'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="   text-center p-0 mt-3 mb-2">
                <div class="card-c px-0 pt-4 pb-0 mt-3 mb-3">
                    <div class="check-logo">
                        <img src="./assets/images/logo_nne.png" alt="">
                        <p class="text-logo">@lang('main.order.sologan')</p>
                    </div>                        
                        <fieldset>
                            <div class="form-card">
                                <br><br>
                                <h2 class="purple-text text-center"><strong>@lang('main.order.order_thanks')</strong>
                                </h2> <br>
                                <div class="row justify-content-center">
                                    <div class="col-3"> <img
                                            src="https://icon-library.com/images/complete-icon-png/complete-icon-png-6.jpg"
                                            class="fit-image"> </div>
                                </div> <br>

                                <div class="row justify-content-center">
                                    <div class="col-7 text-center">
                                        <h4 class=" text-center">@lang('main.order.see_your_order') <a href="{{ route('order.history', Auth::user()->user_id) }}"
                                                style="color: rgb(243, 54, 54);">@lang('admin.action.here')</a></h4>
                                        <h4 class="purple-text text-center"><a href=""><i
                                                    class="fas fa-cart-arrow-down"></i>@lang('main.order.continue_shopping')</a></h4>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
@endsection
