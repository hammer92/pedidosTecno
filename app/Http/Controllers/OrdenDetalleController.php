<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrdenDetalleRequest;
use App\Http\Requests\UpdateOrdenDetalleRequest;
use App\Models\Orden;
use App\Repositories\OrdenDetalleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class OrdenDetalleController extends AppBaseController
{
    /** @var  OrdenDetalleRepository */
    private $ordenDetalleRepository;

    public function __construct(OrdenDetalleRepository $ordenDetalleRepo)
    {
        $this->ordenDetalleRepository = $ordenDetalleRepo;
    }

    /**
     * Display a listing of the OrdenDetalle.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->ordenDetalleRepository->pushCriteria(new RequestCriteria($request));
        $ordenDetalles = $this->ordenDetalleRepository->all();

        return view('orden_detalles.index')
            ->with('ordenDetalles', $ordenDetalles);
    }

    /**
     * Show the form for creating a new OrdenDetalle.
     *
     * @return Response
     */
    public function create()
    {
        return view('orden_detalles.create');
    }

    /**
     * Store a newly created OrdenDetalle in storage.
     *
     * @param CreateOrdenDetalleRequest $request
     *
     * @return Response
     */
    public function store(CreateOrdenDetalleRequest $request)
    {
        $input = $request->all();

        $total = $input['subtotal'] + $input['total_actual'];

        Orden::where('id', $input['orden_id'])->update(array('total' => $total));

        $ordenDetalle = $this->ordenDetalleRepository->create($input);

        Flash::success('Orden Detalle saved successfully.');

        //return redirect(route('ordenDetalles.index'));
        return redirect(route('ordens.edit',[$input['orden_id']]));

    }

    /**
     * Display the specified OrdenDetalle.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ordenDetalle = $this->ordenDetalleRepository->findWithoutFail($id);

        if (empty($ordenDetalle)) {
            Flash::error('Orden Detalle not found');

            return redirect(route('ordenDetalles.index'));
        }

        return view('orden_detalles.show')->with('ordenDetalle', $ordenDetalle);
    }

    /**
     * Show the form for editing the specified OrdenDetalle.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ordenDetalle = $this->ordenDetalleRepository->findWithoutFail($id);

        if (empty($ordenDetalle)) {
            Flash::error('Orden Detalle not found');

            return redirect(route('ordenDetalles.index'));
        }

        return view('orden_detalles.edit')->with('ordenDetalle', $ordenDetalle);
    }

    /**
     * Update the specified OrdenDetalle in storage.
     *
     * @param  int              $id
     * @param UpdateOrdenDetalleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrdenDetalleRequest $request)
    {
        $ordenDetalle = $this->ordenDetalleRepository->findWithoutFail($id);

        if (empty($ordenDetalle)) {
            Flash::error('Orden Detalle not found');

            return redirect(route('ordenDetalles.index'));
        }

        $ordenDetalle = $this->ordenDetalleRepository->update($request->all(), $id);

        Flash::success('Orden Detalle updated successfully.');

        return redirect(route('ordenDetalles.index'));
    }

    /**
     * Remove the specified OrdenDetalle from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ordenDetalle = $this->ordenDetalleRepository->findWithoutFail($id);

        if (empty($ordenDetalle)) {
            Flash::error('Orden Detalle not found');

            return redirect(route('ordenDetalles.index'));
        }

        $this->ordenDetalleRepository->delete($id);

        Flash::success('Orden Detalle deleted successfully.');

        return redirect(route('ordenDetalles.index'));
    }
}
