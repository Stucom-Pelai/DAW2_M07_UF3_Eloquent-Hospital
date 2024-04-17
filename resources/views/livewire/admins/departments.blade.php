<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar foto a handPrediction</title>
</head>
<body>
    <h2>Enviar foto a handPrediction</h2>
    <form action="{{ route('getHandPrediction') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="photo">Selecciona una foto:</label><br>
        <input type="file" id="photo" name="photo" accept="image/*"><br><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>

