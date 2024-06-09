<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\Site\SiteRepositoryInterface;

class SiteController extends Controller
{
    public function __construct(SiteRepositoryInterface $siteRepository)
    {
        $this->siteRepository =  $siteRepository;
    }


    public function index()
    {
        return view('welcome');
    }

    //checking user role and redirecting
    public function home()
    {
        $userId = auth()->id();
        $role = $this->siteRepository->getUserRole($userId);

        if ($role == 'Admin') {
            return redirect('/admin');
        }
        return redirect()->route('home.site');
    }

    public function site()
    {
        $products =  Product::with('attributeProducts.size', 'attributeProducts.color', 'attributeProducts.images')
            ->latest()->paginate(7);
        return view('site.userpage', compact('products'));
    }
}
