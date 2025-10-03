<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Galería</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS -->
  <link href="https://unpkg.com/leaflet/dist/leaflet.css" rel="stylesheet"/>
  <link href="views/css/header.css" rel="stylesheet">
  <link href="views/css/galeria.css" rel="stylesheet">

  <!-- Footer -->
  <link rel="stylesheet" href="views/css/footer.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Theme overrides last -->
    <link href="views/css/theme.css" rel="stylesheet">
  
</head>
<body class="bg-dark">

<?php include 'views/header.php'; ?>

<?php include 'views/galeria.php'; ?>

<?php include 'views/footer.php'; ?>


<!-- Leaflet Mapa -->
 <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- JS -->
<script src="views/js/header.js"></script>
<script src="views/js/galeria.js"></script>
<script src="views/js/footer.js"></script>

</body>
</html>