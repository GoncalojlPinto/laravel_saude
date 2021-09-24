<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Models\Service;
use App\Models\Specialty;
use App\Services\DownloadService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;

class MedicoController extends Controller
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
        return view('medicos.index', ["medicos" => Medico::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medicos.create', ["specialities" => Specialty::all(), "services" => Service::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $input['photo_perfil'] = $this->validateAndStoreFile($request);

        $validator = Medico::validateData($input);

        if($validator->fails()){
            return redirect()->route('medicos.create')->withErrors($validator->errors());
        }

        $medico = $this->fillMedico(new Medico(), $input);

        try{
            $medico->save();
        }catch(QueryException $e){
            return redirect()->route('medicos.index')->withErrors(new MessageBag(["erro", "Erro ao tentar gravar o médico"]));
        }

        return redirect(route('medicos.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show(Medico $medico)
    {
        return view('medicos.show', ['medico' => $medico]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function edit(Medico $medico)
    {
        return view('medicos.edit', ["medico" => $medico, "specialities" => Specialty::all(), "services" => Service::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medico $medico)
    {

        $input = $request->all();

        $input['photo_perfil'] = $this->validateAndStoreFile($request);

        $validator = Medico::validateData($input);

        if($validator->fails()){
            return redirect()->route('medicos.edit', $medico->id)->withErrors($validator->errors());
        }

        $medico = $this->fillMedico($medico, $input);

        try{
            $medico->save();
        }catch(QueryException $e){
            return redirect()->route('medicos.index')->withErrors(new MessageBag(["erro", $e->getMessage()]));
        }

        return redirect(route('medicos.index'))->with("message", "O médico ".$medico->id." foi atualizado com sucesso.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medico $medico)
    {
        Medico::destroy($medico->id);
        return redirect()->route('medicos.index')->with("message", "Médico  " .$medico->id. " eliminado com sucesso");
    }


    public function download(Request $request){
        $downloadService = new DownloadService;
        return $downloadService->dowloadAsCsv(Medico::all(), "medicos");
    }

    private function fillMedico(Medico $medico, array $input): Medico
    {
        $medico->name = $input['name'];
        $medico->address = $input['address'];
        $medico->phone = $input['phone'];
        $medico->specialty_id = $input['specialty'];
        $medico->service_id = $input['service'];

        if($input['photo_perfil']){
            $medico->photo = $input['photo_perfil'];
        }

        return $medico;
    }

    private function validateAndStoreFile(Request $request){

        $allowed_extensions = ['jpg', 'png', 'gif', 'jpeg'];

        if($request->hasFile('photo') && $request->file('photo')->isValid()){
            $file = $request->file('photo');
            $extension = $file->extension();

            if(in_array($extension, $allowed_extensions)){
                $fileName = uniqid() .".". $extension;
                return $file->storeAs('/', $fileName, "public_images");
            }

            return false;
        }

        return false;
    }
}
