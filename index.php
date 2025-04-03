<?php
$xmlFile = 'xml/menu.xml';
if (file_exists($xmlFile)) {
    $xml = simplexml_load_file($xmlFile);
    if (!$xml) {
        die('Error: El archivo XML no se pudo cargar correctamente.');
    }
} else {
    die('Error: No se pudo encontrar el archivo XML en la ruta especificada.');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta del Restaurante</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" href="img/favicon.jpg">
</head>
<body>

    <h1>Carta del Restaurante</h1>
    <div class="menu">
        <?php if ($xml && $xml->plato): ?>
            <?php foreach ($xml->plato as $plato) : ?>
                <div class="plato">
                    <img src="img/<?= htmlspecialchars($plato->nombre); ?>.jpg" alt="<?= htmlspecialchars($plato->nombre); ?>" class="plato-img">
                    
                    <h2><?= htmlspecialchars($plato->nombre); ?> (<?= htmlspecialchars($plato['tipo']); ?>)</h2>
                    <p><strong>Precio:</strong> €<?= htmlspecialchars($plato->precio); ?></p>
                    <p><strong>Descripción:</strong> <?= htmlspecialchars($plato->descripcion); ?></p>
                    <p><strong>Calorías:</strong> <?= htmlspecialchars($plato->calorias); ?> kcal</p>
                    <p><strong>Características:</strong> 
                        <?php foreach ($plato->ingredientes->categoria as $categoria) : ?>
                            <span class="caracteristica"><?= htmlspecialchars($categoria); ?></span>
                        <?php endforeach; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay platos disponibles en el menú.</p>
        <?php endif; ?>
    </div>

</body>
</html>