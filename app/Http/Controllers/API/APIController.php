<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\UpdateProductoAPIRequest;
use App\Models\Orden;
use App\Models\Producto;
use App\Repositories\OrdenDetalleRepository;
use App\Repositories\OrdenRepository;
use App\Repositories\ProductoRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Laracasts\Flash\Flash;
use Prettus\Repository\Criteria\RequestCriteria;
/**
 * Class ProductoController
 * @package App\Http\Controllers\API
 */

class APIController extends AppBaseController
{
    /** @var  ProductoRepository */
    private $productoRepository;

    /** @var  UserRepository */
    private $userRepository;

    /** @var  OrdenRepository */
    private $ordenRepository;

    /** @var  OrdenDetalleRepository */
    private $ordenDetalleRepository;

    public function __construct(ProductoRepository $productoRepo,UserRepository $userRepo,OrdenRepository $ordenRepo,OrdenDetalleRepository $ordenDetalleRepo)
    {
        $this->productoRepository = $productoRepo;
        $this->userRepository = $userRepo;
        $this->ordenRepository = $ordenRepo;
        $this->ordenDetalleRepository = $ordenDetalleRepo;
        $this->configFirebase();
    }

    public function getUsuarios(Request $request)
    {
        $this->userRepository->pushCriteria(new RequestCriteria($request));
        $this->userRepository->pushCriteria(new LimitOffsetCriteria($request));
        $users = $this->userRepository->all();

        return $this->sendResponse($users->toArray(), 'Users retrieved successfully');
    }


    public function getProductos(Request $request)
    {
        $this->productoRepository->pushCriteria(new RequestCriteria($request));
        $this->productoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $productos = $this->productoRepository->all();

        return $this->sendResponse($productos->toArray(), 'Productos retrieved successfully');
    }


    public function saveOrden(Request $request)
    {
        $input = $request->all();

        //crear usuario
        if(!$input['cliente_id']){

            $guarda = array(
                "name" => $input['name'],
                "email" => $input['email'],
                "telefono" => $input['telefono'],
                'password' => Hash::make($input['telefono']),
            );

            $user = $this->userRepository->create($guarda);

            $input['cliente_id']= $user->id;
        }


        //crear orden
        $inputOrden['cliente_id'] = $input['cliente_id'];
        $inputOrden['total'] = $input['total'];
        $inputOrden['direccion'] = $input['direccion'];

        $orden = $this->ordenRepository->create($inputOrden);


        //crear detalle
        $productos = $input['detalle'];
        $total = 0;

        foreach ($productos as $valor) {
            $inputDetalle['orden_id'] = $orden->id;
            $inputDetalle['producto_id'] = $valor['id'];
            $inputDetalle['precio'] = $valor['precio'];
            $inputDetalle['cantidad'] = $valor['cantidad'];
            $inputDetalle['subtotal'] = $valor['cantidad'] * $valor['precio'];

            $total += $inputDetalle['subtotal'];

            $ordenDetalle = $this->ordenDetalleRepository->create($inputDetalle);
        }

        Orden::where('id', $orden->id)->update(array('total' => $total));

        $this->firebase->push(env('APP_NAME', '').'/Ordenes', $orden->id);

        return $this->sendResponse('ok', 'Productos retrieved successfully');

       // $input = $request->all();
        //dd(Auth::user());
       /* $input = $request->all();

        $productos = $this->productoRepository->create($input);

        return $this->sendResponse($productos->toArray(), 'Producto saved successfully');*/
    }

    /**
     * Display the specified Producto.
     * GET|HEAD /productos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Producto $producto */
        $producto = $this->productoRepository->findWithoutFail($id);

        if (empty($producto)) {
            return $this->sendError('Producto not found');
        }

        return $this->sendResponse($producto->toArray(), 'Producto retrieved successfully');
    }

    /**
     * Update the specified Producto in storage.
     * PUT/PATCH /productos/{id}
     *
     * @param  int $id
     * @param UpdateProductoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProductoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Producto $producto */
        $producto = $this->productoRepository->findWithoutFail($id);

        if (empty($producto)) {
            return $this->sendError('Producto not found');
        }

        $producto = $this->productoRepository->update($input, $id);

        return $this->sendResponse($producto->toArray(), 'Producto updated successfully');
    }

    /**
     * Remove the specified Producto from storage.
     * DELETE /productos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Producto $producto */
        $producto = $this->productoRepository->findWithoutFail($id);

        if (empty($producto)) {
            return $this->sendError('Producto not found');
        }

        $producto->delete();

        return $this->sendResponse($id, 'Producto deleted successfully');
    }
}
