<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Video;
use LaravelLocalization;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use App\Http\Requests\offerRequest;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{

    use OfferTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function getOffers(){
        return Offer::get();
    }


    // public function store(){

        // Offer::create([
        // 'name' => 'offer3',
        // 'price' => '5000',
        // 'details' => 'offers details',
        // ]);
    // }
    public function create(){
        return view('offer.create');
    }


    public function store(offerRequest $request){



        // $rules  = $this -> getRules();
        // $messages = $this -> getMessages();
        // $validator = Validator::make($request->all(),$rules,$messages);

        // if($validator -> fails()){
        //      return redirect()->back()->withErrors($validator)->withInputs($request->all());

        // }

          //insert

        $file_name = $this -> saveImage($request -> photo ,'images/offers');

        Offer::create([
            'photo' => $file_name,
            'name_ar' => $request ->name_ar,
            'name_en' => $request ->name_en,
            'price' => $request ->price,
            'details_ar' => $request ->details_ar,
            'details_en' => $request ->details_en,

            ]);
            return redirect()->back()->with(['success' => 'this offer is submitted']);


    }

    // protected function getRules(){
        // return $rules = [
        //     'name' => 'required|max:100|unique:offers,name',
        //     'price' => 'required|numeric',
        //     'details' => 'required',
        // ];
    // }
    // protected function getMessages(){
        // return $messages = [

        //     'name.required' => __('messages.offer name required'),
        //     'name.unique' => __('messages.offer name must be unique'),
        //     'price.numeric' => 'اسم العرض يجب ان يكون ارقام',
        //     'details.required' => 'التفاصيل مطلوبه'
        // ];
    // }

    public function getAlloffers(){
        $offers = Offer::select('id', 'price' ,
         'name_'. LaravelLocalization::getCurrentLocale().' as name',
         'details_'.LaravelLocalization::getCurrentLocale().' as details'
         ) -> get(); //to retrive all data
        return view('offer.all',compact('offers'));//to connect offers data with view

    }
    public function editOffer($offer_id){
        //offer::findOrFail($offer_id);
        $offer = offer::find($offer_id);
        if(!$offer){
            return redirect() -> back();
        }

        $offer = offer::select('id','name_ar','name_en','details_ar','details_en','price') -> find($offer_id);
        return view('offer.edit',compact('offer'));

    }
    public function UpdateOffer(offerRequest $request, $offer_id){

        //1- validation
        //2- check if offer exists
        //3- update

        $offer = offer::find($offer_id);
        if(!$offer){
            return redirect() -> back();
        }

        $offer ->update($request -> all());
        return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);

        // $offer -> update([
        //     'name_ar' => $request -> name_ar,
        //     'name_en' => $request -> name_en,

        // ]);
    }

    public function getVideo(){

        $video = Video::first();
        return view('video') -> with('video',$video);
    }


}
