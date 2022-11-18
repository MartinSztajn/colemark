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
use Intervention\Image\ImageManagerStatic as Image;


class PublicacionController extends Controller
{
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function cargarCategoria($categoria){
        $id = Categoria::select('id')->where('titulo', $categoria)->get();
        $id = $id[0]->id;

        if ($id == 4){
            $sectores = Sector::all();
            return Inertia::render('Publicaciones/CrearInmueble', ['categoria' => $categoria, 'id' => $id, 'sectores' => $sectores]);
        }
        if($id == 12){
            return Inertia::render('Publicaciones/CrearServicio', ['categoria' => $categoria, 'id' => $id]);

        }
        else{
            return Inertia::render('Publicaciones/CrearProducto', ['categoria' => $categoria, 'id' => $id]);
        }
    }
    public function crearPublicacion()
    {
        $categorias = Categoria::all();
        return Inertia::render('Publicaciones/Crear', ['categorias' => $categorias]);
    }

    public function crearInmueble(Request $request){
        $publi = new Inmueble();
        $publi->id_usuario = Auth::user()->id;
        $publi->id_sector = $request->id_sector;
        $publi->titulo = $request->titulo;
        $publi->descripcion = $request->descripcion;
        $publi->lote = $request->lote;
        $publi->estado = $request->estado;
        $publi->pisos =  $request->pisos;
        $publi->dormitorios =  $request->dormitorios;
        $publi->ambientes =  $request->ambientes;
        $publi->baños =  $request->banos;
        $publi->superficie_total =  $request->superficie_total;
        $publi->pileta =  $request->pileta;
        $publi->parilla =  $request->parilla;
        $publi->jardin =  $request->jardin;
        $publi->precio =  $request->precio;

        $publi->save();


        if ($request->foto1)
        {
            $i = 0;
            foreach ($request->foto1 as $key => $foto)
            {
                $extension = 'jpg';
                $nombre = $this->generateRandomString(10);
                $myFileName = $nombre .'.'.$extension;
                Image::make($foto)->save(public_path('/market/' . $myFileName));
                $ima = new Imagen();
                $ima->id_publicacion = $publi->id;
                $ima->tipo = 1;
                $ima->path = $nombre;
                if ($i == 0){
                    $ima->principal = 1;
                    $i = 1;
                }
                $ima->save();
            }
        }
        return back();

    }
    public function crearServicio(Request $request){
        $publi = new Servicio();
        $publi->titulo = $request->titulo;
        $publi->nombre = $request->nombre;
        $publi->numero = $request->celular;
        $publi->comentarios = $request->descripcion;
        $publi->direccion = $request->direccion;
        $publi->id_usuario = Auth::user()->id;

        $publi->save();

        if ($request->foto1)
        {
            $i = 0;
            foreach ($request->foto1 as $key => $foto)
            {
                $extension = 'jpg';
                $nombre = $this->generateRandomString(10);
                $myFileName = $nombre .'.'.$extension;
                Image::make($foto)->save(public_path('/market/' . $myFileName));
                $ima = new Imagen();
                $ima->id_publicacion = $publi->id;
                $ima->tipo = 2;
                $ima->path = $nombre;
                if ($i == 0){
                    $ima->principal = 1;
                    $i = 1;
                }
                $ima->save();
            }
        }
        return back();

    }

    public function productos(Request $request){
        $publi = new Publicacion();
        $publi->id_usuario = Auth::user()->id;
        $publi->id_categoria = $request->id_categoria;
        $publi->titulo = $request->titulo;
        $publi->precio = $request->precio;
        $publi->estado = $request->estado;
        $publi->descripcion = $request->descripcion;
        $publi->stock =  $request->stock;
        $publi->save();

        if ($request->foto1)
        {
            $i = 0;
            foreach ($request->foto1 as $key => $foto)
            {
                $extension = 'jpg';
                $nombre = $this->generateRandomString(10);
                $myFileName = $nombre .'.'.$extension;
                Image::make($foto)->save(public_path('/market/' . $myFileName));
                $ima = new Imagen();
                $ima->id_publicacion = $publi->id;
                $ima->path = $nombre;
                $ima->tipo = 0;
                $ima->principal = 0;
                if ($i == 0){
                    $ima->principal = 1;
                    $i = 1;
                }
                $ima->save();
            }
        }
        return back();
    }

    public function buscarCategoria($titulo){
        $categoria = Categoria::select('id')->where('titulo', $titulo)->get()->toArray();
        $id = $categoria[0]['id'];
        $tipo = 0;
        if($titulo == 'Inmuebles'){
            $productos = Inmueble::select('inmuebles.*','users.name','users.socio','users.celular','users.email')
                ->leftJoin('users','users.id','inmuebles.id_usuario')
                ->get();

            $tipo = 1;
            foreach ($productos as $pro) {
                $sector = Sector::select('titulo')->where('id', $pro->id_sector)->get();
                $pro->nomSector = $sector[0]->titulo;
            }

        }
        else if ($titulo == 'Servicios') {
            $productos = Servicio::select('servicios.*')->get();
            $tipo = 2;
        }
        else{
            $productos = Publicacion::select('publicaciones.*', 'users.name', 'users.socio', 'users.celular', 'users.email')
                ->leftJoin('users', 'users.id', 'publicaciones.id_usuario')
                ->where('id_categoria', $id)
                ->get();
        }
        $i = 0;
        foreach ($productos as $pro)
        {
            $pro->cantidad = 0;
            if ($i == count($productos) - 1){
                $pro->cantidad = 1;
            }
            $i = $i + 1;
            $fotos = Imagen::select('fotos.*')->where('id_publicacion', $pro->id)->where('tipo', $tipo)->get()->toArray();
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

        $productos = $productos->toArray();

        $categorias = Categoria::all();
        $sectores = Sector::all();
        return Inertia::render('Publicaciones/Publicaciones', ['categoria' => $titulo, 'productos' => $productos, 'categorias' => $categorias, 'sectores' => $sectores]);

    }

    public function buscarProductos(Request $request){
        $buscador = $request['texto'];
        $total = [];
        $categorias = Categoria::all();
        $tipo = 0;

        if ($buscador != '') {
            $productos = Publicacion::select('publicaciones.*', 'users.name', 'users.socio', 'users.celular', 'users.email')
                ->leftJoin('users', 'users.id', 'publicaciones.id_usuario')
                ->where('publicaciones.titulo', 'like', '%' . $buscador . '%')
                ->get();

                $inmuebles = Inmueble::select('inmuebles.*','users.name','users.socio','users.celular','users.email')
                    ->leftJoin('users','users.id','inmuebles.id_usuario')
                    ->where('inmuebles.titulo', 'like', '%' . $buscador . '%')
                    ->get();

                foreach ($inmuebles as $pro) {
                    $sector = Sector::select('titulo')->where('id', $pro->id_sector)->get();
                    $pro->nomSector = $sector[0]->titulo;
                }

                $servicios = Servicio::select('servicios.*')
                    ->where('servicios.titulo', 'like', '%' . $buscador . '%')
                    ->get();

            $a = 0;  $i = 0;
            foreach ($productos as $pro)
            {
            $pro->cantidad = 0;
            if ($i == count($productos) - 1){
                $pro->cantidad = 1;
                $i = -1;
            }
                $i = $i + 1;

                $pro->cate = 0;
            $fotos = Imagen::select('fotos.*')->where('id_publicacion', $pro->id)->where('tipo', 0)->get()->toArray();
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
            else {
                $pro->guardar = 1;
            }
            $total[$a] = $pro;
            $a = $a + 1;
        }
        foreach ($inmuebles as $pro)
        {

            $sector = Sector::select('titulo')->where('id', $pro->id_sector)->get();
            $pro->nomSector = $sector[0]->titulo;


            $pro->cantidad = 0;
            if ($i == count($inmuebles) - 1){
                $pro->cantidad = 1;
                $i = -1;
            }
            $i = $i + 1;

            $pro->cate = 1;

            $fotos = Imagen::select('fotos.*')->where('id_publicacion', $pro->id)->where('tipo', 1)->get()->toArray();
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
            $total[$a] = $pro;
            $a = $a + 1;
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

            $fotos = Imagen::select('fotos.*')->where('id_publicacion', $pro->id)->where('tipo', 2)->get()->toArray();
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
            $total[$a] = $pro;
            $a = $a + 1;
            }
        }
        return Inertia::render('Publicaciones/Buscar', ['categorias' => $categorias, 'total' => $total]);

    }

    public function quitarPublicacion(Request $request){
        $publi = UsuarioGuardado::select('id')->where('id_usuario', Auth::user()->id)
            ->where('id_publicacion', $request->id)
            ->where('id_cate', $request->cate)
            ->get()->toArray();
        if($publi != []){
            $id = $publi[0]['id'];
            $publi = UsuarioGuardado::find($id);
            $publi->delete();

            if ($request->cate == 1){
                $subir = Publicacion::find($request->id);
                $subir->cantidad = $subir->cantidad - 1;
                $subir->save();
            }
            else if($request->cate == 2){
                $subir = Inmueble::find($request->id);
                $subir->cantidad = $subir->cantidad - 1;
                $subir->save();
            }
        }
        return back();
    }

    public function guardarPublicacion(Request $request){
        $publi = new UsuarioGuardado();
        $publi->id_usuario = Auth::user()->id;
        $publi->id_publicacion = $request->id;
        $publi->id_cate = $request->cate;
        $publi->save();

        if ($request->cate == 1){
            $subir = Publicacion::find($request->id);
            $subir->cantidad = $subir->cantidad + 1;
            $subir->save();
        }
        else if($request->cate == 2){
            $subir = Inmueble::find($request->id);
            $subir->cantidad = $subir->cantidad + 1;
            $subir->save();
        }

        return back();
    }

    public function eliminarPublicacion(Request $request){
        if ($request->cate == 1){
            $publi = Publicacion::find($request->id);
        }
        else if($request->cate == 2){
            $publi = Inmueble::find($request->id);
        }
        else{
            $publi = Servicio::find($request->id);
        }
        $publi->delete();

        $guardados = UsuarioGuardado::select('usuario_guardar.*')->where('id_publicacion',  $request->id)->where('id_cate', $request->cate)->get()->toArray();
        foreach ($guardados as $guar){
            $gu = UsuarioGuardado::find($guar['id']);
            $gu->delete();
        }
        return back();
    }

    public function filtrarProductos(Request $request){
        $idCate = Categoria::select('id')->where('titulo', $request->cate)->get()->toArray();
        $productos = [];
        $ti = 0;
        if ($request->cate == "Inmuebles"){
            $ti = 1;
            if ($request->tipo == 1){
                $productos = Inmueble::select('inmuebles.*','users.name','users.socio','users.celular','users.email')
                    ->leftJoin('users','users.id','inmuebles.id_usuario')
                    ->where('inmuebles.estado', 0)
                    ->get();
            }
            else if($request->tipo == 2){
                $productos = Inmueble::select('inmuebles.*','users.name','users.socio','users.celular','users.email')
                    ->leftJoin('users','users.id','inmuebles.id_usuario')
                    ->where('inmuebles.estado', 1)
                    ->get();
            }
            else if($request->tipo == 3){
                $productos = Inmueble::select('inmuebles.*','users.name','users.socio','users.celular','users.email')
                    ->leftJoin('users','users.id','inmuebles.id_usuario')
                    ->orderBy('inmuebles.precio', 'DESC')
                    ->where('inmuebles.id_sector', $request->sector)
                    ->get();
            }

            foreach ($productos as $pro) {
                $sector = Sector::select('titulo')->where('id', $pro->id_sector)->get();
                $pro->nomSector = $sector[0]->titulo;
            }

        }
        else{
            if ($request->tipo == 1){
                $productos = Publicacion::select('publicaciones.*', 'users.name', 'users.socio', 'users.celular', 'users.email')
                    ->leftJoin('users', 'users.id', 'publicaciones.id_usuario')
                    ->where('id_categoria', $idCate)
                    ->orderBy('publicaciones.precio', 'ASC')
                    ->get();
            }
            else if($request->tipo == 2){
                $productos = Publicacion::select('publicaciones.*', 'users.name', 'users.socio', 'users.celular', 'users.email')
                    ->leftJoin('users', 'users.id', 'publicaciones.id_usuario')
                    ->where('id_categoria', $idCate)
                    ->orderBy('publicaciones.precio', 'DESC')
                    ->get();
            }
            else if($request->tipo == 3){
                $productos = Publicacion::select('publicaciones.*', 'users.name', 'users.socio', 'users.celular', 'users.email')
                    ->leftJoin('users', 'users.id', 'publicaciones.id_usuario')
                    ->where('id_categoria', $idCate)
                    ->where('publicaciones.estado', 0)
                    ->get();
            }
            else if($request->tipo == 4){
                $productos = Publicacion::select('publicaciones.*', 'users.name', 'users.socio', 'users.celular', 'users.email')
                    ->leftJoin('users', 'users.id', 'publicaciones.id_usuario')
                    ->where('id_categoria', $idCate)
                    ->where('publicaciones.estado', 1)
                    ->get();
            }
            else if($request->tipo == 5){
                $productos = Publicacion::select('publicaciones.*', 'users.name', 'users.socio', 'users.celular', 'users.email')
                    ->leftJoin('users', 'users.id', 'publicaciones.id_usuario')
                    ->where('id_categoria', $idCate)
                    ->orderBy('publicaciones.titulo', 'ASC')
                    ->get();
            }
        }
        $i = 0;
        foreach ($productos as $pro)
        {
            $pro->cantidad = 0;
            if ($i == count($productos) - 1){
                $pro->cantidad = 1;
            }

            $i = $i + 1;

            $fotos = Imagen::select('fotos.*')->where('id_publicacion', $pro->id)->where('tipo', $ti)->get()->toArray();
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

        $categorias = Categoria::all();
        return Inertia::render('Publicaciones/Publicaciones', ['categoria' => $request->cate, 'productos' => $productos, 'categorias' => $categorias]);
    }

    public function editarPublicacion(Request $request)
    {
        $publi = Publicacion::find($request->id);
        if($request->tipo == 'Titulo')
        {
            $publi->titulo = $request->valor;
        }
        else if($request->tipo == 'Descripcion')
        {
            $publi->descripcion   = $request->valor;
        }
        else if($request->tipo == 'Precio')
        {
            $publi->precio   = $request->valor;
        }
        else if($request->tipo == 'Estado')
        {
            $publi->estado   = $request->valor;
        }
        else if($request->tipo == 'Categoria')
        {
            $publi->id_categoria   = $request->valor;
        }
        $publi->save();

        return 'OK';

    }
    public function editarInmueble(Request $request)
    {
        $publi = Inmueble::find($request->id);
        if($request->tipo == 'Titulo')
        {
            $publi->titulo = $request->valor;
        }
        else if($request->tipo == 'Precio')
        {
            $publi->precio   = $request->valor;
        }
        else if($request->tipo == 'Estado')
        {
            $publi->estado   = $request->valor;
        }
        else if($request->tipo == 'Lote')
        {
            $publi->lote   = $request->valor;
        }
        else if($request->tipo == 'Dormitorios')
        {
            $publi->dormitorios   = $request->valor;
        }
        else if($request->tipo == 'Superficie')
        {
            $publi->superficie_total   = $request->valor;
        }
        else if($request->tipo == 'Pisos')
        {
            $publi->pisos   = $request->valor;
        }
        else if($request->tipo == 'Baños')
        {
            $publi->baños   = $request->valor;
        }
        else if($request->tipo == 'Ambientes')
        {
            $publi->ambientes   = $request->valor;
        }
        else if($request->tipo == 'Jardin')
        {
            $publi->jardin   = $request->valor;
        }
        else if($request->tipo == 'Pileta')
        {
            $publi->pileta   = $request->valor;
        }
        else if($request->tipo == 'Parilla')
        {
            $publi->parilla   = $request->valor;
        }
        $publi->save();

        return 'OK';

    }


}
