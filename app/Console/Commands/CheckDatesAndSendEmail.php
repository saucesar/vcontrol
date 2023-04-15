<?php

namespace App\Console\Commands;

use App\Repositories\ProductRepository;
use App\Services\EmailService;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\View;

class CheckDatesAndSendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-dates:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pegar todas as datas de validades menores que 30 dias e envia aos respectivos emails';

    protected ProductRepository $productRepository;
    protected EmailService $emailService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->productRepository = new ProductRepository();
        $this->emailService = new EmailService();
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try{
            $date = Carbon::now()->addDays(30);
            $products = $this->productRepository->getProductsByDate($date);

            $agrouped = $this->agroupProductsByCategory($products);
            
            $products = $agrouped['products'];
            $categories = $agrouped['categories'];

            foreach(array_keys($products) as $category_name) {
                $emails = $categories[$category_name]->emails;
                $products = $products[$category_name];
                
                foreach($emails as $email) {
                    $this->emailService->sendEmail(
                        View::make('email_service.emails.product_dates', [
                            'name' => $email->name,
                            'products' => $products,
                            'category_name' => $category_name,
                        ])->render(),
                        [$email->email],
                        'Validades',
                    );
                }
            }
            
            return Command::SUCCESS;
        } catch(Exception $e) {
            dd($e);
            return Command::FAILURE;
        }
    }

    private function agroupProductsByCategory(Collection $products) : array
    {
        $items = [];
        $categories = [];
        $progress = $this->output->createProgressBar($products->count());
        $progress->start();

        foreach($products as $product) {
            $items[$product->category->name][] = $product;

            try{
                $categories[$product->category->name];
            } catch(Exception $e) {
                $categories[$product->category->name] = $product->category;
            }
            
            $progress->advance();
        }

        $progress->finish();
        print("\n");

        return [
            'products' => $items,
            'categories' => $categories,
        ];
    }
}
