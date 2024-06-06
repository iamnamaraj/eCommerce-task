<?php

namespace App\Http\Controllers;

use App\Repositories\Site\SiteRepositoryInterface;
use Illuminate\Http\Request;

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
        return redirect('/');
    }
}
