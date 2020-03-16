<?php

namespace App\Http\Controllers;

use App\Repositories\CategoriaRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;

class HomeController extends AppBaseController
{
    /** @var  CategoriaRepository */
    private $categoriaRepository;

    public function __construct(CategoriaRepository $categoriaRepo)
    {
        $this->categoriaRepository = $categoriaRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Display a listing of the Categoria.
     *
     * @param Request $request
     * @return Response
     */
    public function indexCliente(Request $request)
    {
        $this->categoriaRepository->pushCriteria(new RequestCriteria($request));
        $categorias = $this->categoriaRepository->all();

        return view('welcome')
            ->with('categorias', $categorias);
    }
}
