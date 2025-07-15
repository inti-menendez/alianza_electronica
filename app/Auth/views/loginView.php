<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Alianza Electrónica</title>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen bg-[url('resources/images/bg-ae.jpg')] bg-cover bg-center">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8 opacity-90">
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Ingreso al Servicio Técnico</h1>
            <p class="text-gray-500">Por favor, ingresa tus credenciales</p>
        </div>
        <form action='login' method="POST" class="space-y-5" data-auto data-redirect="/home" data-alert="#login-alert">

            <div>
                <label for="username" class="block text-gray-700 mb-1">Nombre de usuario</label>
                <input type="username" id="username" name="username"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label for="password" class="block text-gray-700 mb-1">Contraseña</label>
                <input type="password" id="password" name="password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                Ingresar
            </button>
        </form>
        <div class="mt-4 text-center">
            <a href="#" class="text-sm text-blue-600 hover:underline">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</body>

</html>