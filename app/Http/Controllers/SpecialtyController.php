<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use InvalidArgumentException;

class SpecialtyController extends Controller
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
        return view("specialties.index", ["specialties" => Specialty::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("specialties.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->editAndSaveSpecialty($request, new Specialty());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function show(Specialty $specialty)
    {
        return view("specialties.show", ["specialty" => $specialty]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialty $specialty)
    {
        return view("specialties.edit", ["specialty" => $specialty]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialty $specialty)
    {
        return $this->editAndSaveSpecialty($request, $specialty);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialty $specialty)
    {
        try{
            $specialty->delete();
        }catch(QueryException $e){
            return redirect()->route("specialties.index")->withErrors(new MessageBag(["erro" => "Não foi possivel remover, verifique os medicos associados"]));
        }

        return redirect()->route("specialties.index")->with("message", "Especialidade removida com sucesso!");
    }

    private function editAndSaveSpecialty(Request $request, Specialty $specialty){
        $action = $specialty->id ? "editada" : "criada";

        try {
            $specialty->setName($request->get("name"));
            $specialty->save();
        } catch (QueryException $e) {
            return redirect()->route("specialties.index")->withErrors(new MessageBag(["save" => "Erro ao gravar especialidade"]));
        } catch (InvalidArgumentException $e) {
            return redirect()->route("specialties.create")->withErrors(new MessageBag(["name" => $e->getMessage()]));
        } catch (Exception $e) {
            return redirect()->route("specialties.index")->withErrors(new MessageBag(["erro_desconhecido" => "Erro 500!"]));
        }

        return redirect()->route("specialties.index")->with("message", "Especialidade " . $specialty->name . " ". $action ." com sucesso.");
    }
}
