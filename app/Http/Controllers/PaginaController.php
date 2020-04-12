<?php

namespace App\Http\Controllers\Admin;

use App\Models\Auth\User\User;
use App\Repositories\Pagina;
use Arcanedev\LogViewer\Entities\Log;
use Arcanedev\LogViewer\Entities\LogEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use GuzzleHttp\Client;

class PaginaController extends Controller
{
    protected $pagina;

    public function __construct(Pagina $pagina)
    {
        $this->middleware('auth');
        $this->pagina = $pagina;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagina = new Pagina;
        return view('admin.pagina')->with('paginas', $pagina->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pagina_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pagina = new Pagina;
        $status = $pagina->guardar($request->input('name'),$request->input('description'),$request->input('status'));
        if ($status == 1) {
            // No se pudo guardar
        }else {
            return redirect()->action('Admin\PaginaController@index');
        }
        //$this->redirect()
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pagina_show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   // Buscar por id y enviarlo a la vista
        $pagina = new Pagina;
        $encontrado = $pagina->findOne($id);
        return view('admin.pagina_edit')->with('categoria',$encontrado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $categoria = new Pagina;
        $categoria->update($request->input('name'),$request->input('description'),$request->input('status'),$id);
        return redirect()->action('Admin\PaginaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = new Pagina;
        $categoria->borrar($id);
        return redirect()->action('Admin\PaginaController@index');
    }
}
