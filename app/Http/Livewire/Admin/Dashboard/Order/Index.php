<?php

namespace App\Http\Livewire\Admin\Dashboard\Order;

use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $year;

    public function mount(){
        $this->year = date('Y');
    }
    public function render(){
        $orders = Order::orderBy('id', 'desc')->get();
        $ordersRecent = $orders->take(10);
        $ordersProcesing = $orders->where('status', 'Procesando');
        $ordersCompleted = $orders->where('status', 'Completado');
        $ordersCancelled = $orders->where('status', 'Cancelado');
        return view('livewire.admin.dashboard.order.index', compact(
            'ordersRecent',
            'ordersProcesing',
            'ordersCompleted',
            'ordersCancelled'
        ));
    }
    public function getOrderTotalProperty(){
        $total = Order::query()->where('status', '<>', 'Cancelado')->sum('total');
        return '$'.number_format($total, 2);
    }
    public function getOrderTotalTodayProperty(){
        $total = Order::query()->where('status', '<>', 'Cancelado')->whereDate('created_at', today())->sum('total');
        return '$'.number_format($total, 2);
    }
    public function getOrderTotalMonthProperty(){
        $total = Order::query()->where('status', '<>', 'Cancelado')->whereMonth('created_at', date('m'))->whereYear('created_at', $this->year)->sum('total');
        return '$'.number_format($total, 2);
    }
    public function getOrderTotalYearProperty(){
        $total = Order::query()->where('status', '<>', 'Cancelado')->whereYear('created_at', $this->year)->sum('total');
        return number_format($total, 2);
    }
    public function getGrapihSalesProperty(){
        $sales = Order::select(
            DB::raw('DATE_FORMAT(created_at, "%m-%Y") AS month2'),
            DB::raw('DATE_FORMAT(created_at, "%b-%Y") AS month'), 
            DB::raw('SUM(total) AS sumSales')
        )
        ->whereYear('created_at', $this->year)
        ->orderBy('month2')
        ->groupBy('month', 'month2')
        ->get();
        $lineChartModel =  new LineChartModel();
        foreach($sales as $sale): $lineChartModel = $lineChartModel->addPoint($sale->month, $sale->sumSales); endforeach;
        return $lineChartModel;
    }
    public function getGrapihSalesByStatusProperty(){
        $sales = Order::select(
            DB::raw('status'), 
            DB::raw('COUNT(id) AS countSales')
        )
        ->whereYear('created_at', $this->year)
        ->groupBy('status')
        ->get();
        $pieChartModel =  new PieChartModel();
        foreach($sales as $sale): 
            if($sale->status == 'Procesando'):
                $color = '#50cd89';
            elseif($sale->status == 'Completado'):
                $color = '#009ef7';
            elseif($sale->status == 'Cancelado'):
                $color = '#f1416c';
            else:
                $color = '#918d8d';
            endif;
            $pieChartModel = $pieChartModel->addSlice($sale->status, $sale->countSales, $color); 
        endforeach;
        return $pieChartModel;
    }
    public function getMostViewedProductsProperty(){
        $products = Product::orderByUniqueViews()->take(10)->get();
        return $products;
    }
    public function getMostSelledProductsProperty(){
        $products = Product::has('orders')->with('orders')->get()->sortBy(function($query) {
            return $query->orders->sum('quantity');
        })->take(10);
        return $products;
    }
    public function getProductsLowStockProperty(){
        $products = Product::where('quantity', '<=', '5')->paginate(10, ['*'], 'productLows');
        return $products;
    }
    public function getProductsPublishedProperty(){
        return Product::where('status', 'Publicado')->orderBy('id', 'desc')->get();
    }
    public function getProductsNoPublishedProperty(){
        return Product::where('status', 'Borrador')->orderBy('id', 'desc')->get();
    }
    public function getCommentsApprovedProperty(){
        return Comment::where('commentable_type', Product::class)->where('approved', true)->get();
    }
    public function getCommentsNoApprovedProperty(){
        return Comment::where('commentable_type', Product::class)->where('approved', false)->get();
    }
}
