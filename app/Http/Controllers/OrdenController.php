<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrdenRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateOrdenRequest;
use App\Repositories\OrdenRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;
use PDF;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Hash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Mail\OrdensReceived;

class OrdenController extends AppBaseController
{
    /** @var  OrdenRepository */
    private $ordenRepository;

    /** @var  OrdenRepository */
    private $userRepository;
    public function __construct(OrdenRepository $ordenRepo, UserRepository $userRepo)
    {
        $this->ordenRepository = $ordenRepo;
        $this->userRepository = $userRepo;
        $this->configFirebase();
    }

    /**
     * Display a listing of the Orden.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
       // dd($request);
        $this->ordenRepository->pushCriteria(new RequestCriteria($request));
        $ordens = $this->ordenRepository->scopeQuery(function($query){
            return $query->orderBy('id','desc');
        })->findWhere([
            'estado'=>'pendiente'
        ]);

        $this->firebase->delete(env('APP_NAME', '').'/Ordenes');
        return view('ordens.index')
            ->with('ordens', $ordens);
    }

    /**
     * Show the form for creating a new Orden.
     *
     * @return Response
     */
    public function create()
    {
        return view('ordens.create');
    }

    /**
     * Store a newly created Orden in storage.
     *
     * @param CreateOrdenRequest $request
     *
     * @return Response
     */
    public function store(CreateOrdenRequest $request)
    {
        $input = $request->all();
        $input['total'] = 0;

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


        $orden = $this->ordenRepository->create($input);

        Flash::success('Orden saved successfully.');

        return redirect(route('ordens.edit',[$orden->id]));
    }

    /**
     * Display the specified Orden.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orden = $this->ordenRepository->findWithoutFail($id);

        if (empty($orden)) {
            Flash::error('Orden not found');

            return redirect(route('ordens.index'));
        }

        return view('ordens.show')->with('orden', $orden);
    }

    /**
     * Show the form for editing the specified Orden.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orden = $this->ordenRepository->findWithoutFail($id);

        if (empty($orden)) {
            Flash::error('Orden not found');

            return redirect(route('ordens.index'));
        }

        return view('ordens.edit')->with('orden', $orden);
    }

    /**
     * Update the specified Orden in storage.
     *
     * @param  int              $id
     * @param UpdateOrdenRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrdenRequest $request)
    {
        $orden = $this->ordenRepository->findWithoutFail($id);

        if (empty($orden)) {
            Flash::error('Orden not found');

            return redirect(route('ordens.index'));
        }
        //dd($request->all());

        $orden = $this->ordenRepository->update($request->all(), $id);

        Flash::success('Orden '.$request->all()['estado'].' con exito.');

        return redirect(route('ordens.index'));
    }

    /**
     * Remove the specified Orden from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orden = $this->ordenRepository->findWithoutFail($id);

        if (empty($orden)) {
            Flash::error('Orden not found');

            return redirect(route('ordens.index'));
        }

        $this->ordenRepository->delete($id);

        Flash::success('Orden deleted successfully.');

        return redirect(route('ordens.index'));
    }


    public function pdf($id, Request $request){
        $orden = $this->ordenRepository->findWithoutFail($id);

        //Mail::to($request->user())->send(new OrdensReceived($orden));
        Mail::to("jjpb92@gmail.com")->send(new OrdensReceived($orden));

        $pdf = PDF::loadView('ordens.pdf', compact('orden'));
        $pdf->setPaper('a6', 'landscape');
        return $pdf->download('invoice.pdf');
    }
}
