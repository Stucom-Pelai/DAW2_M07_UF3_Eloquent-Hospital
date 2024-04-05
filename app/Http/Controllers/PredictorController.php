<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PredictorController extends Controller
{
    public function index(Request $request)
    {
        // Verifica si hay una imagen en la solicitud
        if ($request->isMethod('post') && $request->getContent()) {
            // Accede al contenido de la solicitud y guarda la imagen temporalmente
            $imagen = $request->getContent();
            $extension = $this->getExtension($request->header('content-type'));
            $nombreImagen = uniqid() . '.' . $extension; // Genera un nombre de archivo único
            $rutaTemp = 'public/storage/temp/' . $nombreImagen;

            // Guarda la imagen en storage
            Storage::put($rutaTemp, $imagen);

            // Ejecutar el script Python
            // Ejecutar el script Python
            // $scriptPath = storage_path('scripts\\'); // Ruta al directorio de scripts
            $scriptPath = '/storage/scripts/'; // Ruta al directorio de scripts
            $script = $scriptPath . 'hand_prediction.py'; // Nombre del script Python
            $command = "python3 $script $nombreImagen"; // Comando para ejecutar el script Python
            $output = shell_exec($command);
            dd($output);
            // Capturar la salida del script
            $porcentajes = explode("\n", trim($output)); // Divide la salida en un array por líneas
            $fracture_percentage = floatval(str_replace('Probabilidad de mano rota: ', '', $porcentajes[0]));
            // $not_fracture_percentage = floatval(str_replace('Probabilidad de mano no rota: ', '', $porcentajes[1]));

            // Utiliza los porcentajes como desees

            // Utiliza los porcentajes como desees

            // Elimina la imagen temporal
            Storage::delete($rutaTemp);

            return response()->json(['mensaje' => 'Imagen recibida y procesada correctamente']);
        } else {
            return response()->json(['error' => 'No se encontró ninguna imagen en la solicitud'], 400);
        }
    }

    private function getExtension($contentType)
    {
        switch ($contentType) {
            case 'image/jpeg':
                return 'jpg';
            case 'image/png':
                return 'png';
            case 'image/gif':
                return 'gif';
            case 'image/bmp':
                return 'bmp';
            default:
                return 'jpg'; // Extensión predeterminada en caso de tipo de imagen desconocido
        }
    }
}
