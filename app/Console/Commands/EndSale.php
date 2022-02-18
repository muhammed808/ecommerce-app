<?php

namespace App\Console\Commands;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class EndSale extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'end:sale';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'end sale date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        parent::__construct();
      
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $products = Product::all();
        
        foreach($products as $product){
            if($product->end_sale <= Carbon::now()->Timezone(config('app.timezone'))){
                $product->where('id' , $product->id)->update(['end_sale' => NULL]);
                $product->where('id' , $product->id)->update(['sale_price' => NULL]);
            }
        }
    }
}
