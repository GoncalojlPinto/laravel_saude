<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("services.index", ["services" => Service::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("services.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->fillAndSave($request, new Service());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view("services.show", ["service" => $service]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view("services.edit", ["service" => $service]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        return $this->fillAndSave($request, $service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        try {
            $service->delete();
        } catch (QueryException $e) {
            return redirect()->route("services.index")->withErrors(new MessageBag(["erro" => "Não foi possivel remover serviço, verifique os medicos associados"]));
        }

        return redirect()->route("services.index")->with("message", "Serviço removido com sucesso!");
    }

    private function fillAndSave(Request $request, Service $service){

        $action = $service->id ? "edit" : "create";

        $input = $request->all();

        $validator = Service::validateData($input);

        if($validator->fails()){
            return redirect()->route('services.'.$action)->withErrors($validator->errors());
        }

        $service->name = $input['name'];

        try {
            $service->save();
        } catch (QueryException $e) {
            return redirect()->route("services.index")->withErrors(new MessageBag(["erro" => "Não foi possivel remover serviço, verifique os medicos associados"]));
        }

        return redirect()->route("services.index")->with("message", "Serviço " . $service->name . " criado com sucesso.");
    }
}
