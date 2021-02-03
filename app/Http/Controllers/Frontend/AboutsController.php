<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Contact;

class AboutsController extends Controller
{
    public function sitemap() {
        return view('/frontend/abouts/sitemap');
    }

    public function contact() {
        return view('/frontend/abouts/contact');
    }

    public function contactPost(Request $request) {
        $contact = $request->all();
        $contact = Contact::create($contact);
        $request->session()->flash('alert-success', 'ส่งข้อความเรียบร้อยแล้วค่ะ');
        return back();
    }

    public function about_us() {
        return view('/frontend/abouts/about-us');
    }

    public function condition() {
        return view('/frontend/abouts/condition');
    }

    public function faqs() {
        return view('/frontend/abouts/faqs');
    }

    public function promotion() {
        return view('/frontend/abouts/promotion');
    }

    public function howto_regis() {
        return view('/frontend/abouts/howto-regis');
    }
}
