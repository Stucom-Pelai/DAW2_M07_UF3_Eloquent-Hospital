<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PredictorController extends Controller
{
    public function index(Request $request)
    {
        // Verifica si hay una imagen en la solicitud
        if ($request->isMethod('post')) {
            // Accede al contenido de la solicitud y guarda la imagen temporalmente
            if ($request->hasFile('photo')) {
                $imagen = $request->file('photo');
                
                // Genera un nombre único para la imagen
                $nombreImagen = uniqid() . '.' . $imagen->getClientOriginalExtension();
                
                // Guarda la imagen en la carpeta public/storage/temp con el nombre único
                $rutaTemp = Storage::disk('public')->put('temp', $imagen);
                // Ejecutar el script Python
                // $scriptPath = storage_path('scripts\\'); // Ruta al directorio de scripts
                // $scriptPath = storage_path('app\\public\\scripts\\');
                $scriptPath = storage_path('app\\public\\scripts\\');
              
                $script = $scriptPath . 'hand_prediction.py'; // Nombre del script Python
                $command = "py $script $rutaTemp"; // Comando para ejecutar el script Python
                $output = shell_exec($command);
                dd($output);
                // Capturar la salida del script
                $porcentajes = explode("\n", trim($output)); // Divide la salida en un array por líneas
                $fracture_percentage = floatval(str_replace('Probabilidad de mano rota: ', '', $porcentajes[0]));
                
                // Utiliza los porcentajes como desees
                
                // Elimina la imagen temporal
                Storage::disk('public')->delete($rutaTemp);

                return response()->json(['mensaje' => 'Imagen recibida y procesada correctamente']);
            }
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
