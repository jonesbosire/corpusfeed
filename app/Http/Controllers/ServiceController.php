<?php
namespace App\Http\Controllers;
use App\Models\Service;
class ServiceController extends Controller {
    public function index() {
        return view("pages.services.index", [
            "services" => Service::active()->paginate(12),
        ]);
    }
    public function show(Service $service) {
        abort_unless($service->status === "active", 404);
        $allServices = Service::active()->get();
        return view("pages.services.show", compact("service", "allServices"));
    }
}
