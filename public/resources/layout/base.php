<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel | Alianza Electrónica</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="bg-gray-100">

  <?php include 'header.php'; ?>

  <div class="flex min-h-screen">
    <?php include 'sidebar.php'; ?>

    <main class="flex-1 p-6">
      <?php include $viewPath; ?>
    </main>
  </div>

  <?php include 'footer.php'; ?>

</body>
</html>