<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home(){
        return view('front-end.home.index');
    }

    public function getListBus(){
        return view('front-end.list-bus.bus');
    }

    public function getChooseSeat() {
    	return view('front-end.payment.choose-seat');
    }

    public function getInfoCustomer() {
    	return view('front-end.payment.info-customer');
    }

    public function getPaymentMethod() {
        return view('front-end.payment.payment-method');
    }

    public function getChooseSeatFloor() {
        return view('front-end.payment.choose-seat-floor');
    }

    public function getRewardPoints() {
        return view('front-end.customer.reward-points');
    }

    public function getPersonalInformation() {
        return view('front-end.customer.personal-information');
    }

    public function getChangePassword() {
        return view('front-end.customer.change-password');
    }

    public function getTicketHistory() {
        return view('front-end.customer.ticket-history');
    }

    public function getRegistration() {
        return view('front-end.customer.registration');
    }

    public function getCustomerlogin() {
        return view('front-end.customer.login');
    }

    public function getForgotPassword() {
        return view('front-end.customer.forgot-password');
    }
}
