<?php
$conn = new mysqli("localhost", "root", "", "basedatos");
if ($conn->connect_error) die("Error: " . $conn->connect_error);

$sql = "SELECT id, titulo, resumen, contenido, imagen, imagen_secundaria, autor, fecha 
        FROM noticias 
        ORDER BY fecha DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestro Newsletter</title>

    <!-- ===== DEPENDENCIAS ===== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- ===== CSS PERSONALIZADO ===== -->
    <link href="views/css/index.css" rel="stylesheet">
    <link href="views/css/header.css" rel="stylesheet">
    <link href="views/css/footer.css" rel="stylesheet">
    <link href="views/css/theme.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
<?php include 'views/header.php'; ?>

<main class="container">
    <h1 class="section-title">Newsletter</h1>
    <p class="section-subtitle">Las noticias más relevantes sobre construcción de SIDCO</p>

    <section class="news-grid">
        <?php while ($n = $result->fetch_assoc()): ?>
            <article class="featured-article" itemscope itemtype="https://schema.org/NewsArticle">
                <meta itemprop="headline" content="<?php echo htmlspecialchars($n['titulo']); ?>">
                <meta itemprop="datePublished" content="<?php echo date("Y-m-d\TH:i:sP", strtotime($n['fecha'])); ?>">
                <meta itemprop="dateModified" content="<?php echo date("Y-m-d\TH:i:sP", strtotime($n['fecha'])); ?>">
                
                <div class="featured-image">
                    <img src="<?php echo $n['imagen']; ?>" alt="<?php echo htmlspecialchars($n['titulo']); ?>" itemprop="image">
                </div>
                
                <div class="article-content">
                    <h2 class="article-title" itemprop="name">
                        <a href="views/Noticias/noticia.php?id=<?php echo $n['id']; ?>">
                            <?php echo htmlspecialchars($n['titulo']); ?>
                        </a>
                    </h2>
                    <p class="article-summary" itemprop="description"><?php echo htmlspecialchars($n['resumen']); ?></p>

                    <div class="article-meta">
                        <span itemprop="author" itemscope itemtype="https://schema.org/Person">
                            <span itemprop="name">Por <?php echo htmlspecialchars($n['autor']); ?></span>
                        </span>
                        <time datetime="<?php echo date("Y-m-d H:i", strtotime($n['fecha'])); ?>">
                            <?php echo date("d/m/Y H:i", strtotime($n['fecha'])); ?>
                        </time>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
    </section>
</main>

<?php include 'views/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="views/js/header.js"></script>
<script src="views/js/footer.js"></script>
<script src="script.js" defer></script>
</body>
</html>

<?php $conn->close(); ?>
