<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Repositories\CategoriaRepository;
use App\Repositories\ProductoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Storage;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProductoController extends AppBaseController
{
    /** @var  ProductoRepository */
    private $productoRepository;

    /** @var  CategoriaRepository */
    private $categoriaRepository;

    public function __construct(ProductoRepository $productoRepo,CategoriaRepository $categoriaRepo)
    {
        $this->productoRepository = $productoRepo;
        $this->categoriaRepository = $categoriaRepo;
    }

    /**
     * Display a listing of the Producto.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->productoRepository->pushCriteria(new RequestCriteria($request));
        $productos = $this->productoRepository->all();

        return view('productos.index')
            ->with('productos', $productos);
    }

    /**
     * Show the form for creating a new Producto.
     *
     * @return Response
     */
    public function create()
    {
        $categorias = $this->categoriaRepository->all(['id','titulo']);

        return view('productos.create',compact('categorias'));
    }

    /**
     * Store a newly created Producto in storage.
     *
     * @param CreateProductoRequest $request
     *
     * @return Response
     */
    public function store(CreateProductoRequest $request)
    {
        $input = $request->all();

        //obtenemos el campo file definido en el formulario
        $file = $request->file('imagen');
        if($file){
            $name = $file->getATime().'.'.$file->getClientOriginalExtension();
            $path = $file->storePubliclyAs('public/Productos',$name);
            $input['imagen'] = env('URL_STORAGE','/').'Productos/'.$name;
        }else{
            $input['imagen'] = env('URL_STORAGE','/').'logo.png';
        }


        $producto = $this->productoRepository->create($input);

        Flash::success('Producto guardado con exito.');

        return redirect(route('productos.index'));
    }

    /**
     * Display the specified Producto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $producto = $this->productoRepository->findWithoutFail($id);



        if (empty($producto)) {
            Flash::error('Producto no encontrado');

            return redirect(route('productos.index'));
        }

        return view('productos.show')->with('producto', $producto);
    }

    /**
     * Show the form for editing the specified Producto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $producto = $this->productoRepository->findWithoutFail($id);
        $categorias = $this->categoriaRepository->all(['id','titulo']);

        if (empty($producto)) {
            Flash::error('Producto no encontrado');

            return redirect(route('productos.index'));
        }



        return view('productos.edit')->with('producto', $producto)->with('categorias', $categorias);
    }

    /**
     * Update the specified Producto in storage.
     *
     * @param  int              $id
     * @param UpdateProductoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductoRequest $request)
    {
        $producto = $this->productoRepository->findWithoutFail($id);

        if (empty($producto)) {
            Flash::error('Producto no encontrado');

            return redirect(route('productos.index'));
        }
        $input = $request->all();

        //obtenemos el campo file definido en el formulario
        $file = $request->file('imagen');


        if(!is_null($file)){

            $name = $file->getATime().'.'.$file->getClientOriginalExtension();

            $path = $file->storePubliclyAs('public/Productos',$name);

            $input['imagen'] = env('URL_STORAGE','/').'Productos/'.$name;

        }



        $producto = $this->productoRepository->update($input, $id);

        Flash::success('Producto actualizado con exito.');

        return redirect(route('productos.index'));
    }

    /**
     * Remove the specified Producto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $producto = $this->productoRepository->findWithoutFail($id);

        if (empty($producto)) {
            Flash::error('Producto no encontrado');

            return redirect(route('productos.index'));
        }

        $this->productoRepository->delete($id);

        Flash::success('Producto eliminado con exito.');

        return redirect(route('productos.index'));
    }
}
