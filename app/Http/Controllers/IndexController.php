<?php


namespace App\Http\Controllers;


use App\Models\Categoria;
use App\Models\Imagen;
use App\Models\Publicacion;
use App\Models\Inmueble;
use App\Models\Sector;
use App\Models\Servicio;

use App\Models\User;
use App\Models\UsuarioGuardado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
Use Auth;

class IndexController extends Controller
{
    public function inicio(){
        $categorias = Categoria::all();
        return Inertia::render('Inicio/Inicio', ['categorias' => $categorias]);
    }

    public function publicadas(){
        $productos = Publicacion::select('publicaciones.*')->where('id_usuario', Auth::user()->id)->get();
        $inmuebles = Inmueble::select('inmuebles.*')->where('id_usuario', Auth::user()->id)->get()->toArray();
        $servicios = Servicio::select('servicios.*')->where('id_usuario',  Auth::user()->id)->get()->toArray();

        foreach ($productos as $pro)
        {
            $pro->cate = 0;

            $fotos = Imagen::select('path')->where('id_publicacion', $pro->id)->get(1)->toArray();
            foreach ($fotos as $key => $foti)
            {
                $pro->hola = $foti['path'];
            }
            $pro->path2 = $fotos;
        }

        $productos = $productos->toArray();

        $categorias = Categoria::all();
        return Inertia::render('Inicio/Publicadas', ['categorias' => $categorias, 'productos' => $productos, 'inmuebles' => $inmuebles, 'servicios' => $servicios]);

    }

    public function guardadas(){
            $productos = Publicacion::select('publicaciones.*')->leftJoin('usuario_guardar', 'usuario_guardar.id_publicacion', 'publicaciones.id')->where('usuario_guardar.id_usuario', Auth::user()->id)->get();
            $servicios = Servicio::select('servicios.*')->leftJoin('usuario_guardar', 'usuario_guardar.id_publicacion', 'servicios.id')->where('usuario_guardar.id_usuario', Auth::user()->id)->get();
            $inmuebles = Inmueble::select('inmuebles.*')->leftJoin('usuario_guardar', 'usuario_guardar.id_publicacion', 'inmuebles.id')->where('usuario_guardar.id_usuario', Auth::user()->id)->get();


            $i = 0;
            foreach ($productos as $pro)
            {
                $pro->cantidad = 0;
                if ($i == count($productos) - 1){
                    $pro->cantidad = 1;
                    $i = -1;
                }
                $i = $i + 1;

                $pro->cate = 0;

                $fotos = Imagen::select('path')->where('id_publicacion', $pro->id)->get(1)->toArray();
                foreach ($fotos as $key => $foti)
                {
                    $pro->hola = $foti['path'];
                }
                $pro->path2 = $fotos;
                $pro->miNombre = Auth::user()->name;
                $guardada = UsuarioGuardado::select('usuario_guardar.*')->where('id_usuario', Auth::user()->id)->where('id_publicacion', $pro->id)->get()->toArray();

                if ($guardada == [])
                {
                    $pro->guardar = 0;
                }
                else{
                    $pro->guardar = 1;
                }
            }
            foreach ($inmuebles as $pro)
            {
                $pro->cantidad = 0;
                if ($i == count($inmuebles) - 1){
                    $pro->cantidad = 1;
                    $i = -1;
                }
                $i = $i + 1;

                $pro->cate = 1;


                $sector = Sector::select('titulo')->where('id', $pro->id_sector)->get();
                $pro->nomSector = $sector[0]->titulo;

                $fotos = Imagen::select('path')->where('id_publicacion', $pro->id)->get(1)->toArray();
                foreach ($fotos as $key => $foti)
                {
                    $pro->hola = $foti['path'];
                }
                $pro->path2 = $fotos;
                $pro->miNombre = Auth::user()->name;
                $guardada = UsuarioGuardado::select('usuario_guardar.*')->where('id_usuario', Auth::user()->id)->where('id_publicacion', $pro->id)->get()->toArray();

                if ($guardada == [])
                {
                    $pro->guardar = 0;
                }
                else{
                    $pro->guardar = 1;
                }
            }
            foreach ($servicios as $pro)
            {
                $pro->cantidad = 0;
                if ($i == count($servicios) - 1){
                    $pro->cantidad = 1;
                    $i = -1;
                }
                $i = $i + 1;

                $pro->cate = 2;

                $fotos = Imagen::select('path')->where('id_publicacion', $pro->id)->get(1)->toArray();
                foreach ($fotos as $key => $foti)
                {
                    $pro->hola = $foti['path'];
                }
                $pro->path2 = $fotos;
                $pro->miNombre = Auth::user()->name;
                $guardada = UsuarioGuardado::select('usuario_guardar.*')->where('id_usuario', Auth::user()->id)->where('id_publicacion', $pro->id)->get()->toArray();

                if ($guardada == [])
                {
                    $pro->guardar = 0;
                }
                else{
                    $pro->guardar = 1;
                }
            }

            $productos = $productos->toArray();
            $inmuebles = $inmuebles->toArray();
            $servicios = $servicios->toArray();

            $categorias = Categoria::all();
            return Inertia::render('Inicio/Guardadas', ['categorias' => $categorias, 'productos' => $productos, 'inmuebles' => $inmuebles, 'servicios' => $servicios]);

        }

    public function dashboard()
    {
            $categorias = Categoria::all();
            $produ = Publicacion::select('publicaciones.*', 'users.name', 'users.socio', 'users.celular', 'users.email')
            ->leftJoin('users', 'users.id', 'publicaciones.id_usuario')
            ->orderBy('cantidad','DESC')
            ->get();

          $produ2 = Publicacion::select('publicaciones.*', 'users.name', 'users.socio', 'users.celular', 'users.email')
            ->leftJoin('users', 'users.id', 'publicaciones.id_usuario')
            ->orderBy('updated_at','DESC')
            ->get();

             $inmu = Inmueble::select('inmuebles.*','users.name','users.socio','users.celular','users.email')
            ->leftJoin('users','users.id','inmuebles.id_usuario')
             ->orderBy('cantidad','DESC')
             ->get();

            $inmu2 = Inmueble::select('inmuebles.*','users.name','users.socio','users.celular','users.email')
            ->leftJoin('users','users.id','inmuebles.id_usuario')
            ->orderBy('updated_at','DESC')
            ->get();

             $i = 0;
            while($i < count($produ) && $i < 6){
                $productos[$i] = $produ[$i];
                $i = $i + 1;
            }
              $i = 0;
            while($i < count($inmu) && $i < 6){
                $inmuebles[$i] = $inmu[$i];
                $i = $i + 1;
        }
                $i = 0;
                while($i < count($inmu) && $i < 3){
                    $nuevosInmuebles[$i] = $inmu2[$i];
                    $i = $i + 1;
                }
                $i = 0;
                while($i < count($produ) && $i < 3){
                    $nuevosProductos[$i] = $produ2[$i];
                    $i = $i + 1;
                }


            foreach ($productos as $pro)
            {
                $fotos = Imagen::select('fotos.*')->where('id_publicacion', $pro->id)->where('tipo', 0)->get()->toArray();
                foreach ($fotos as $key => $foti)
                {
                    if ($foti['principal'] == 1) {
                        $pro->hola = $foti['path'];
                    }
                }
                $pro->path2 = $fotos;
                $pro->miNombre = Auth::user()->name;
                $guardada = UsuarioGuardado::select('usuario_guardar.*')->where('id_usuario', Auth::user()->id)->where('id_publicacion', $pro->id)->get()->toArray();

                if ($guardada == [])
                {
                    $pro->guardar = 0;
                }
                else{
                    $pro->guardar = 1;
                }
            }
            foreach ($inmuebles as $pro)
        {

            $sector = Sector::select('titulo')->where('id', $pro->id_sector)->get();
            $pro->nomSector = $sector[0]->titulo;


            $fotos = Imagen::select('fotos.*')->where('id_publicacion', $pro->id)->where('tipo', 1)->get()->toArray();
            foreach ($fotos as $key => $foti)
            {
                if ($foti['principal'] == 1) {
                    $pro->hola = $foti['path'];
                }
            }
            $pro->path2 = $fotos;
            $pro->miNombre = Auth::user()->name;
            $guardada = UsuarioGuardado::select('usuario_guardar.*')->where('id_usuario', Auth::user()->id)->where('id_publicacion', $pro->id)->get()->toArray();

            if ($guardada == [])
            {
                $pro->guardar = 0;
            }
            else{
                $pro->guardar = 1;
            }
        }
            foreach ($nuevosProductos as $pro)
            {
                $fotos = Imagen::select('fotos.*')->where('id_publicacion', $pro->id)->where('tipo', 0)->get()->toArray();
                foreach ($fotos as $key => $foti)
                {
                    if ($foti['principal'] == 1) {
                        $pro->hola = $foti['path'];
                    }
                }
                $pro->path2 = $fotos;
                $pro->miNombre = Auth::user()->name;
                $guardada = UsuarioGuardado::select('usuario_guardar.*')->where('id_usuario', Auth::user()->id)->where('id_publicacion', $pro->id)->get()->toArray();

                if ($guardada == [])
                {
                    $pro->guardar = 0;
                }
                else{
                    $pro->guardar = 1;
                }
            }
            foreach ($nuevosInmuebles as $pro)
            {


                    $sector = Sector::select('titulo')->where('id', $pro->id_sector)->get();
                    $pro->nomSector = $sector[0]->titulo;

                $fotos = Imagen::select('fotos.*')->where('id_publicacion', $pro->id)->where('tipo', 1)->get()->toArray();
                foreach ($fotos as $key => $foti)
                {
                    if ($foti['principal'] == 1) {
                        $pro->hola = $foti['path'];
                    }
                }
                $pro->path2 = $fotos;
                $pro->miNombre = Auth::user()->name;
                $guardada = UsuarioGuardado::select('usuario_guardar.*')->where('id_usuario', Auth::user()->id)->where('id_publicacion', $pro->id)->get()->toArray();

                if ($guardada == [])
                {
                    $pro->guardar = 0;
                }
                else{
                    $pro->guardar = 1;
                }
            }
        return Inertia::render('Inicio/Index', ['categorias' => $categorias, 'productos' => $productos, 'inmuebles' => $inmuebles, 'nuevosProductos' => $nuevosProductos, 'nuevosInmuebles' => $nuevosInmuebles]);
        }

}

