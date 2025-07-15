<header class="bg-white shadow p-4 flex justify-between items-center">
  <h1 class="text-xl font-bold text-blue-600">Alianza Electrónica</h1>
  <nav>
    <span class="text-gray-600 mr-4">Bienvenido, <?= $_SESSION['user']['name'] ?? 'Invitado' ?></span>
    <a href="logout" class="text-red-500 font-semibold hover:underline">Salir</a>
  </nav>
</header>