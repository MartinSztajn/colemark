<?php


namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Imagen;
use App\Models\Inmueble;
use App\Models\Publicacion;
use App\Models\Sector;
use App\Models\Servicio;
use App\Models\User;
use App\Models\UsuarioGuardado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
Use Auth;

class CrearController extends Controller
{
    public function Admin(){
        if (Auth::user()->tipo == 1){
           return Inertia::render('Admin/Admin', []);
        }
    }
    public function verPublicaciones(){
        if (Auth::user()->tipo == 1) {

            $productos = Publicacion::select('publicaciones.*', 'users.name')
                ->leftJoin('users', 'users.id', 'publicaciones.id_usuario')
                ->get();

            $inmuebles = Inmueble::select('inmuebles.*', 'users.name')
                ->leftJoin('users', 'users.id', 'inmuebles.id_usuario')
                ->get();

            $servicios = Servicio::select('servicios.*', 'users.name')
                ->leftJoin('users', 'users.id', 'servicios.id_usuario')
                ->get();

            foreach ($productos as $pro) {
                $categoria = Categoria::select('titulo')->where('id', $pro->id_categoria)->get();
                $pro->nomCategoria = $categoria[0]->titulo;

                $fotos = Imagen::select('path')->where('id_publicacion', $pro->id)->where('tipo', 0)->get()->toArray();
                $pro->path2 = $fotos;
            }

            foreach ($inmuebles as $pro) {

                $sector = Sector::select('titulo')->where('id', $pro->id_sector)->get();
                $pro->nomSector = $sector[0]->titulo;

                $fotos = Imagen::select('path')->where('id_publicacion', $pro->id)->where('tipo', 1)->get()->toArray();
                $pro->path2 = $fotos;
            }

            foreach ($servicios as $pro) {
                $fotos = Imagen::select('path')->where('id_publicacion', $pro->id)->where('tipo', 2)->get()->toArray();
                $pro->path2 = $fotos;
            }
            return Inertia::render('Admin/Publicaciones', ['productos' => $productos, 'inmuebles' => $inmuebles, 'servicios' => $servicios]);
        }
    }
    public function verUsuarios(){
        if (Auth::user()->tipo == 1) {

            $usuarios = User::all()->toArray();
            $cantidad = count($usuarios);
            return Inertia::render('Admin/Usuarios', ['usuarios' => $usuarios, 'cant' => $cantidad]);
        }
    }
    public function eliminarUsuario($id){
        if (Auth::user()->tipo == 1) {

            $publi = Publicacion::select('id')->where('id_usuario', $id)->get()->toArray();
            $inmu = Inmueble::select('id')->where('id_usuario', $id)->get()->toArray();

            foreach ($publi as $pu) {
                $publicacion = Publicacion::find($pu['id']);
                $publicacion->delete();

                $guardado = UsuarioGuardado::select('id')->where('id_cate', 1)->where('id_publicacion', $pu['id'])->get()->toArray();
                foreach ($guardado as $guar) {
                    $gu = UsuarioGuardado::find($guar['id']);
                    $gu->delete();
                }
            }

            foreach ($inmu as $pu) {
                $publicacion = Publicacion::find($pu['id']);
                $publicacion->delete();

                $guardado = UsuarioGuardado::select('id')->where('id_cate', 1)->where('id_publicacion', $pu['id'])->get()->toArray();
                foreach ($guardado as $guar) {
                    $gu = UsuarioGuardado::find($guar['id']);
                    $gu->delete();
                }
            }

            $guardadas = UsuarioGuardado::select('id')->where('id_usuario', $id)->get()->toArray();
            foreach ($guardadas as $guar) {
                $gu = UsuarioGuardado::find($guar['id']);
                $gu->delete();
            }

            $usuario = User::find($id);
            $usuario->delete();

            return back();
        }

    }
    public function crearSector(){
        if (Auth::user()->tipo == 1){
            $sector = Sector::all();
             return Inertia::render('Crear/Sector', ['sector' => $sector]);
            }
    }
    public function crearCategoria(){
        if (Auth::user()->tipo == 1) {

            $categoria = Categoria::all();
            return Inertia::render('Crear/Categoria', ['categoria' => $categoria]);
        }
    }
    public function guardarSector($titulo){
        if (Auth::user()->tipo == 1) {

            $sector = new Sector();
            $sector->titulo = $titulo;
            $sector->save();
            return back();
        }
    }
    public function guardarCategoria($titulo){
        if (Auth::user()->tipo == 1) {

            $categoria = new Categoria();
            $categoria->titulo = $titulo;
            $categoria->save();
            return back();
        }
    }
    public function borrarCategoria($id){
        if (Auth::user()->tipo == 1) {

            $cate = Categoria::find($id);
            $cate->delete();
            return back();
        }
    }
    public function borrarSector($id){
        if (Auth::user()->tipo == 1) {
            $sec = Sector::find($id);
            $sec->delete();
            return back();
        }
    }
}
