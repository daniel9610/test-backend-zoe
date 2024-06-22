<?php

namespace App\Jobs;

use App\Models\SecurityTypes;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\PricingData;
use App\Models\SecurityPrices;
use App\Models\Securities;
// use Mail;

class UpdatePricingData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try{
            $security_types = SecurityTypes::all();  
            foreach($security_types as $security_type){
                $data = new PricingData;
                // pass the id for each security type
                $pricing_data = json_decode($data->sampleData($security_type->id), false);
                foreach($pricing_data->results as $security_price){
                    $to_update = Securities::where('symbol', $security_price->symbol)->first();
                    if($to_update){
                        $new_sec_price = SecurityPrices::where('security_id', $to_update->id)->first();
                        if(!$new_sec_price){
                            $new_sec_price = new SecurityPrices;
                            $new_sec_price->security_id = $to_update->id;
                            $new_sec_price->last_price = $security_price->price;
                            $new_sec_price->as_of_date = $security_price->last_price_datetime;
                            $new_sec_price->save();
                        }else{
                            $new_sec_price->last_price = $security_price->price;
                            $new_sec_price->as_of_date = $security_price->last_price_datetime;
                            $new_sec_price->save();
                        }
                    }
                    else{ continue; }
                }
            }
            // print a message for test. Send an email if the job works
            print("The prices information was updated successfuly");
            // $user = User::where('email', 'zoe@admin.com')->first();
            // Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
            //     $m->from('zoe@app.com', 'Zoe Financial');
            //     $m->to($user->email, $user->name)->subject('The prices information was updated successfuly!');
            // });

        }catch(\Exception $e){
            // print other message if the job fails (only for test)
            $this->failed();
        }
    }

    public function failed()
    {
        print("something went wrong");
    }
}
