<?php namespace App\Http\Controllers;

use App\Entities\Payment\Payment;
use App\Entities\Payment\RepositoryInterface as PaymentRepository;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paymentRepository;

    public function __construct(PaymentRepository $paymentRepo) {
        $this->paymentRepository = $paymentRepo;
    }

    public function index(Request $request) {
        return $this->paymentRepository->getForCurrentUser(new SearchQuery($request));
    }

    public function store(Request $request) {}

    public function show(Request $request, string $paymentId)
    {
        return json_encode($this->paymentRepository->get($paymentId));
    }
}
