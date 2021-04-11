<?php

namespace App;
use App\Billing;
use App\Lawsuit;

use Carbon\Carbon;
use App\Invoices\Bill;
use Spatie\Regex\Regex;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use LaravelDaily\Invoices\Classes\Party;
use Illuminate\Database\Eloquent\SoftDeletes;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class Billing extends Model
{
    use SoftDeletes;

    /**
     * folder to save invoices
     */
    public const FOLDER = 'factures';
    
    public $table = 'billings';
    
    protected $guarded = [];
    
    protected $dates = ['deleted_at'];


    public function lawsuit()
    {
        return $this->belongsTo('App\Lawsuit', 'lawsuit_id', 'id');
    }
        public function getNameAttribute()
    {
        return "Facture {$this->number}/{$this->serie}";
    }
    private function getLastBillingNumber()
    {
        return Billing::query()->max('number');
    }
    public $additional_attributes = ['name'];

    public function scopeCurrentUser($query)
    {
        $roleClient = Role::where('name', 'Client')->firstOrFail();
        if (Auth::user()->role_id == $roleClient->id) {
            return $query->whereIn('id', Auth::user()->lawsuits->billings->pluck('id'));
        } else {
            return $query;
        }
    }
    public function createPdf()
    {
        return Billing::query()->max('number');
    }
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($billing){
            if ($billing->lawsuit_id!=null) {
                $item1=$billing->item1;
                $unit1=$billing->unit1;
                $qty1=$billing->qty1;
                $price1=$billing->price1;
    
                $item2=$billing->item2;
                $unit2=$billing->unit2;
                $qty2=$billing->qty2;
                $price2=$billing->price2;
    
                $item3=$billing->item3;
                $unit3=$billing->unit3;
                $qty3=$billing->qty3;
                $price3=$billing->price3;
    
                $item4=$billing->item4;
                $unit4=$billing->unit4;
                $qty4=$billing->qty4;
                $price4=$billing->price4;

                $lawsuit=$billing->lawsuit;
                $clientname=$lawsuit->client->name;
                $address=$lawsuit->client->adress;
                $cp=$lawsuit->client->cp;
                $city=$lawsuit->client->city;
                $country=$lawsuit->client->country;
                $phone=$lawsuit->client->phone;
                $ice = $lawsuit->client->ice;
                $caseNum=$lawsuit->caseNum;
                $adverseName=$lawsuit->opponent->name;
                //String creance 
                $creance = $lawsuit->creance;          
                // Make sure the invoice pdf file does not exist(we are creating a new one), if it does(we are modifing an old one), DELETE IT! & create a new one!
                if(json_decode($billing->pdf) != null){
                    foreach(json_decode($billing->pdf) as $file){
                        if (Storage::disk(config('voyager.storage.disk'))->exists($file->download_link)) {
                            Storage::disk(config('voyager.storage.disk'))->delete($file->download_link);
                        }     
                    }
                }
                $client=[
                    'name' => $clientname,
                    'address' => $address." ".$cp." ".$city."-".$country,
                    
                ];
                if($phone != null){
                    $client=[
                        'name' => $clientname,
                        'address' => $address." ".$cp." ".$city."-".$country,
                        'phone' => $phone,
                        
                    ];
                }
                if($ice != null){
                    $client=[
                        'name' => $clientname,
                        'address' => $address." ".$cp." ".$city."-".$country,
                        'phone' => $phone,
                        'code' => $ice,
                    ];
                }
                $custom_fields = [
                    'Partie Adverse' => $adverseName,
                    'Référence ou Radicale' => $caseNum,
                ];
                if($creance != null){
                    $custom_fields = [
                        'Partie Adverse' => $adverseName,
                        'Référence ou Radicale' => $caseNum,
                        'Montant de la créance' => $creance,
                    ];
                }
                $client=[
                    'name' => $clientname,
                    'address' => $address." ".$cp." ".$city."-".$country,
                    'phone' => $phone,
                    'code' => $ice,
                    'custom_fields' => $custom_fields,
                ];
                $invoiceClient = new Party($client);
                if (isset($billing->type) && $billing->type!=null) {
                    if($billing->type=="option1"){
                        $invoiceName = 'FACTURE';
                    }elseif($billing->type=="option2"){
                        $invoiceName = 'NOTE D\'HONORAIRES';     
                    }elseif($billing->type=="option3"){
                        $invoiceName = 'NOTE DE FRAIS';
                    }       
                }elseif($billing->type==null){
                    $invoiceName = 'FACTURE';
                    $billing->type = 'option1';
                } 
                $items = array();
                if ($item1 != null && $price1 != null) {
                    $invoice_items1 = (new InvoiceItem())->title($item1)->pricePerUnit($price1);
                    if ($qty1 != null && $unit1 != null) {
                        $invoice_items1 = (new InvoiceItem())->title($item1)->pricePerUnit($price1)->quantity($qty1)->units($unit1);
                    }
                    if ($qty1 != null) {
                        $invoice_items1 =(new InvoiceItem())->title($item1)->pricePerUnit($price1)->quantity($qty1);
                    }
                    if ($unit1 != null) {
                        $invoice_items1 =(new InvoiceItem())->title($item1)->pricePerUnit($price1)->units($unit1);
                    }
                    array_push($items, $invoice_items1);
                }
                if ($item2 != null && $price2 != null) {
                    $invoice_items2 = (new InvoiceItem())->title($item2)->pricePerUnit($price2);
                    if ($qty2 != null && $unit2 != null) {
                        $invoice_items2 = (new InvoiceItem())->title($item2)->pricePerUnit($price2)->quantity($qty2)->units($unit2);
                    }
                    if ($qty2 != null) {
                        $invoice_items2 = (new InvoiceItem())->title($item2)->pricePerUnit($price2)->quantity($qty2);
                    }
                    if ($unit2 != null) {
                        $invoice_items2 = (new InvoiceItem())->title($item2)->pricePerUnit($price2)->units($unit2);
                    }
                    array_push($items, $invoice_items2);
                }
                if ($item3 != null && $price3 != null) {
                    $invoice_items3 = (new InvoiceItem())->title($item3)->pricePerUnit($price3);
                    if ($qty3 != null && $unit3 != null) {
                        $invoice_items3 = (new InvoiceItem())->title($item3)->pricePerUnit($price3)->quantity($qty3)->units($unit3);
                    }
                    if ($qty3 != null) {
                        $invoice_items3 = (new InvoiceItem())->title($item3)->pricePerUnit($price3)->quantity($qty3);
                    }
                    if ($unit3 != null) {
                        $invoice_items3 = (new InvoiceItem())->title($item3)->pricePerUnit($price3)->units($unit3);
                    }
                    array_push($items, $invoice_items3);
                }
                if ($item4 != null && $price4 != null) {
                    $invoice_items4 = (new InvoiceItem())->title($item4)->pricePerUnit($price4);
                    if ($qty4 != null && $unit4 != null) {
                        $invoice_items4 = (new InvoiceItem())->title($item4)->pricePerUnit($price4)->quantity($qty4)->units($unit4);
                    }
                    if ($qty4 != null) {
                        $invoice_items4 = (new InvoiceItem())->title($item4)->pricePerUnit($price4)->quantity($qty4);
                    }
                    if ($unit4 != null) {
                        $invoice_items4 = (new InvoiceItem())->title($item4)->pricePerUnit($price4)->units($unit4);
                    }
                    array_push($items, $invoice_items4);
                }
                if(isset($billing->days) && $billing->days != null){
                    $days = $billing->days;
                }elseif($billing->days==null){
                    $days=15;
                }
                if(isset($billing->date) && $billing->date != null){
                    $datfacture = Carbon::parse($billing->date);
                }elseif($billing->date==null){
                    $datfacture=now();
                }
                if(isset($billing->serie) && $billing->serie!=null) {
                    $serie = $billing->serie;
                }elseif($billing->serie==null) {
                    $lawsuitBillingSerie= Billing::where('lawsuit_id', $billing->lawsuit_id)->max('serie');
                    $previousSerie = Billing::where('date', '<=', $datfacture)->max('serie');
                    if($previousSerie!=null){
                        if (Regex::matchAll('/2021|2[0-2][0-9][0-9]/', (string)$previousSerie)->hasMatch()) {
                            $serie = date('Y');
                        }else {
                            $serie = $lawsuitBillingSerie;
                        }
                    }else{
                        $serie = date('Y');
                    }
                }
                if(isset($billing->number) && $billing->number!=null) {
                    $number = $billing->number;
                }elseif($billing->number==null){
                    if ($billing->getLastBillingNumber()==null) {
                        $number=1;
                    }elseif($billing->getLastBillingNumber()>0) {
                        $previousBills=Billing::where('serie',$serie)->max('number');
                        $nextBills=Billing::where('serie',$serie)->where('date','>=',now())->max('number');
                        $previousSerie=Billing::where('date','<=',$datfacture)->max('serie');
                        if (Regex::matchAll('/2021|2[0-2][0-9][0-9]/', (string)$serie)->hasMatch()) {
                            if (date('Y')>$previousSerie && $nextBills==null) {
                                $number = 1;
                            }elseif(date('Y')>$previousSerie && $nextBills!=null){
                                $number = $nextBills + 1;
                            }elseif(date('Y')<=$previousSerie && $nextBills==null){
                                $number = $previousBills + 1;
                            }elseif(date('Y')<=$previousSerie && $nextBills!=null){
                                $number = $nextBills + 1;
                            }
                        }else {
                            $number = $previousBills + 1;
                        }

                    }
                }
                // $site_LOGO = public_path(setting('site.logo', ''));
                $logo= public_path('img/logo.png');
                $invoice = Bill::make($invoiceName)
                    ->template('bill')
                    ->buyer($invoiceClient)
                    ->sequence($number)
                    ->series($serie)
                    ->date($datfacture)
                    ->payUntilDays($days)
                    ->addItems($items)
                ->logo($logo);


                if($billing->note != null){
                    $invoice->notes($billing->note);
                }  
                if(isset($billing->tax) && $billing->tax != null){
                    $invoice->taxRate($billing->tax);
                }
                $fileRealName = 'Facture' . ' ' . $number . '/' . $serie;
                $filename = Str::random(20);
                $path = Billing::FOLDER.DIRECTORY_SEPARATOR.now()->format('FY').DIRECTORY_SEPARATOR;
                //Make sure the filename does not exist, if it does, just regenerate
                while (Storage::disk(config('voyager.storage.disk'))->exists($path.$filename.'.pdf')) {
                    $filename = Str::random(20);
                }
                $invoice->filename($path.$filename);
                //The generated invoice should be saved to configured disk before been able to access the $invoice->total_amount  
                $invoice->save(config('voyager.storage.disk'));
                $billing->total_amount=$invoice->total_amount;
                $invoicePdf=[
                    'download_link' => $path.$filename.'.pdf',
                    'original_name' => $fileRealName,
                ];
                //Saving the auto generated fields to the DataBase
                $billing->pdf=json_encode(array($invoicePdf));
                $billing->serie=$serie;
                $billing->number=$number;
                $billing->date=$datfacture;
                $billing->days=$days;
            }

        });
        static::deleting(function ($billing) {
            if (json_decode($billing->pdf) != null) {
                foreach (json_decode($billing->pdf) as $file) {
                    if (Storage::disk(config('voyager.storage.disk'))->exists($file->download_link)) {
                        Storage::disk(config('voyager.storage.disk'))->delete($file->download_link);
                        $billing->pdf = null;
                    }
                }
            }
        });
        static::restoring(function ($billing) {
            $billing->withTrashed()->restore();
        });

    }
}
