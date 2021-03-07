<?php

namespace App;
use App\Billing;
use App\Lawsuit;

use Carbon\Carbon;
use App\Invoices\Bill;
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
    
    public $additional_attributes = ['name'];

    public function scopeCurrentUser($query)
    {
        $roleClient = Role::where('name', 'Client')->firstOrFail();
        if (Auth::user()->role_id == $roleClient->id) {
            return $query->whereIn('id', Auth::user()->lawsuits->billings->pluck('id'));
        }else{
            return $query;
        }
    }
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($billing){


            $paid_at=$billing->paid_at;

            $type=$billing->type;
            $tax=$billing->tax;
            $creance=$billing->creance;
            $ice=$billing->ice;

            $number=$billing->number;
            $date=$billing->date;
            $days=$billing->days;

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

            $note=$billing->note;
            $datfacture= $date ? Carbon::parse($date) : now();
            $site_LOGO = setting('site.logo', '');
            $logo= public_path('img/logo.png');
            


            $lawsuit=Lawsuit::where('id', $billing->lawsuit_id)->firstOrFail();
            $clientname=$lawsuit->client->name;

            $address=$lawsuit->client->adress;
            $cp=$lawsuit->client->cp;
            $city=$lawsuit->client->city;
            $country=$lawsuit->client->country;

            $phone=$lawsuit->client->phone;
            $adverseName=$lawsuit->opponent->name;
            $caseNum=$lawsuit->caseNum;
            
            // Make sure the invoice pdf file does not exist, if it does, DELETE IT! & create a new one!
            if(json_decode($billing->pdf) !== null){
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
                'Référence' => $caseNum,
            ];
            if($creance != null){
                $custom_fields = [
                    'Partie Adverse' => $adverseName,
                    'Référence' => $caseNum,
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

            $invoiceName = '';
            if($type=="option1"){
                $invoiceName = 'FACTURE';
            }elseif($type=="option2"){
                $invoiceName = 'NOTE D\'HONORAIRES';     
            }elseif($type=="option3"){
                $invoiceName = 'NOTE DE FRAIS';
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
            if (isset($billing->serie) && $billing->serie!=null) {
                $serie=$billing->serie;
            }elseif($billing->serie==null){
                $serie=date('Y');
            }

            $invoice = Bill::make($invoiceName)
                ->template('bill')
                ->buyer($invoiceClient)
                ->sequence($number)
                ->series($serie)
                ->date($datfacture)
                ->addItems($items)
                ->payUntilDays($days)
                ->logo($logo);
   
            if($note != null){
                $invoice->notes($note);
            }  
            if($tax != null){
                $invoice->taxRate($tax);
            }  

            $fileRealName = 'Facture' . ' ' . $number . '/' . $serie;
            $filename = Str::random(20);
            $path = Billing::FOLDER.DIRECTORY_SEPARATOR.now()->format('FY').DIRECTORY_SEPARATOR;
            
            // Make sure the filename does not exist, if it does, just regenerate
            while (Storage::disk(config('voyager.storage.disk'))->exists($path.$filename.'.pdf')) {
                $filename = Str::random(20);
            }
            

            $invoice->filename($path.$filename);
            // You should save generated invoice to configured disk before been able to access the $invoice->total_amount  
            $invoice->save(config('voyager.storage.disk'));

            $billing->total_amount=$invoice->total_amount;
            
            $invoicePdf=[
                'download_link' => $path.$filename.'.pdf',
                'original_name' => $fileRealName,
            ];
            $billing->pdf=json_encode(array($invoicePdf));

        });
    }
}
