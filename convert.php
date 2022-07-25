<?php
require './vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;
use League\HTMLToMarkdown\HtmlConverter;

$converter = new HtmlConverter();

$converter->getConfig()->setOption('italic_style', '_');
$converter->getConfig()->setOption('bold_style', '**');
$converter->getConfig()->setOption('header_style', 'atx');

$pdo = new PDO('mysql:host=localhost;dbname=letrag', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec('SET NAMES UTF8');

// Textos
$textos = $pdo->query("SELECT lugar, texto_gal, texto_cas FROM `textos` where activo = 1")->fetchAll(PDO::FETCH_ASSOC);
file_put_contents('./textos.yml', toYaml($textos));

// Glosarios
$result = $pdo->query("SELECT * FROM `glosario`");
foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $row) {
  $palabra = $pdo->query("SELECT * FROM `glosario_palabras` WHERE `id` = {$row['glosario_palabras']}")->fetch(PDO::FETCH_ASSOC);
  $texto = $pdo->query("SELECT * FROM `glosario_textos` WHERE `id` = {$row['glosario_textos']}")->fetch(PDO::FETCH_ASSOC);

  $page = [
    "id" => intval($palabra["id"]),
    "title.gl" => $palabra["nome_gal"],
    "title.es" => $palabra["nome_cas"],
    "section_id" => intval($row["seccions"]),
    "description.gl" => $texto ? $converter->convert($texto["texto_gal"]) : null,
    "description.es" => $texto ? $converter->convert($texto["texto_cas"]) : null,
  ];

  file_put_contents('./static/palabras/' . $page["id"] . '.yml', toYaml($page));
}

// Artigos
$result = $pdo->query("SELECT * FROM `artigos`");
foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $row) {
  $page = [
    "id" => intval($row["id"]),
    "title.gl" => $row["titulo_gal"],
    "title.es" => $row["titulo_cas"],
    "author" => $row["autor"],
    "intro.gl" => $converter->convert($row["intro_gal"]),
    "intro.es" => $converter->convert($row["intro_cas"]),
    "description.gl" => $converter->convert($row["descricion_gal"]),
    "description.es" => $converter->convert($row["descricion_cas"]),
    "body.gl" => $converter->convert($row["texto_gal"]),
    "body.es" => $converter->convert($row["texto_cas"]),
  ];

  file_put_contents('./static/artigos/' . $page["id"] . '.yml', toYaml($page));
}

// Seccións glosario
$result = $pdo->query("SELECT * FROM `seccions` WHERE taboa_relacion='glosario' AND activo=1");
foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $row) {
  $page = [
    "id" => intval($row["id"]),
    "section_id" => intval($row["seccion"]),
    "title.gl" => $row["nome_gal"],
    "title.es" => $row["nome_cas"],
    "description.gl" => $converter->convert($row["texto_gal"]),
    "description.es" => $converter->convert($row["texto_cas"]),
  ];

  file_put_contents('./static/glosario/' . $page["id"] . '.yml', toYaml($page));
}

// Seccións tipografías
$result = $pdo->query("SELECT * FROM `seccions` WHERE taboa_relacion='tipografias' AND activo=1");
foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $row) {
  $page = [
    "id" => intval($row["id"]),
    "section_id" => intval($row["seccion"]),
    "title.gl" => $row["nome_gal"],
    "title.es" => $row["nome_cas"],
    "description.gl" => $converter->convert($row["texto_gal"]),
    "description.es" => $converter->convert($row["texto_cas"]),
  ];

  file_put_contents('./static/clasificacion/' . $page["id"] . '.yml', toYaml($page));
}

// Etiquetas
$result = $pdo->query("SELECT * FROM `etiquetas`");
foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $page) {
  $page = [
    "id" => intval($page["id"]),
    "title.gl" => $page["nome_gal"],
    "title.es" => $page["nome_cas"],
  ];

  file_put_contents('./static/tag/' . $page["id"] . '.yml', toYaml($page));
}

// Tipógrafos
$result = $pdo->query("SELECT * FROM `desenadores`");
foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $page) {
  $page = [
    "id" => intval($page["id"]),
    "title" => $page["nome"],
  ];

  file_put_contents('./static/desenador/' . $page["id"] . '.yml', toYaml($page));
}

// Tipografías
$result = $pdo->query("SELECT * FROM `tipografias`");

foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $row) {
  $desenadores = $pdo->query("SELECT * FROM `relacions` WHERE taboa1='desenadores' AND taboa2='tipografias' AND `id2` = {$row['id']}")->fetchAll(PDO::FETCH_ASSOC);
  $seccions = $pdo->query("SELECT * FROM `relacions` WHERE taboa1='seccions' AND taboa2='tipografias' AND `id2` = {$row['id']}")->fetchAll(PDO::FETCH_ASSOC);
  $ligazons = $pdo->query("SELECT * FROM `relacions` WHERE taboa1='ligazons' AND taboa2='tipografias' AND `id2` = {$row['id']}")->fetchAll(PDO::FETCH_ASSOC);
  $tags = $pdo->query("SELECT * FROM `relacions` WHERE taboa1='etiquetas' AND taboa2='tipografias' AND `id2` = {$row['id']}")->fetchAll(PDO::FETCH_ASSOC);

  $page = [
    "id" => intval($row["id"]),
    "title" => $row["nome"],
    "year" => $row["ano"],
    "download" => $row["descargar"] ?: null,
    "description.gl" => $converter->convert($row["texto_gal"]),
    "description.es" => $converter->convert($row["texto_cas"]),
    "links" => [],
    "tags_ids" => [],
    "sections_ids" => [],
    "designers_ids" => [],
  ];

  foreach ($ligazons as $row) {
    $ligazon = $pdo->query("SELECT * FROM `ligazons` WHERE id={$row['id1']}")->fetch(PDO::FETCH_ASSOC);
    if (!$ligazon) {
      continue;
    }

    $languages = [
      "c" => "es",
      "i" => "en",
      "g" => "gl",
      "a" => "de",
    ];

    $page["links"][] = [
      "title.gl" => $ligazon["nome_gal"],
      "title.es" => $ligazon["nome_cas"],
      "description.gl" => $ligazon["texto_gal"],
      "description.es" => $ligazon["texto_cas"],
      "url" => $ligazon["url"],
      "language" => $languages[$ligazon["idioma"]],
      "source" => $ligazon["referencia"],
    ];
  }

  foreach ($seccions as $seccion) {
    $page["sections_ids"][] = intval($seccion["id1"]);
  }

  foreach ($tags as $tag) {
    $page["tags_ids"][] = intval($tag["id1"]);
  }

  foreach ($desenadores as $desenador) {
    $page["designers_ids"][] = intval($desenador["id1"]);
  }

  file_put_contents('./static/tipografia/' . $page["id"] . '.yml', toYaml($page));
}


function toYaml($data) {
  $content = Yaml::dump($data, 4, 2, Yaml::DUMP_OBJECT | Yaml::DUMP_OBJECT_AS_MAP | Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK);
  $content = str_replace("{  }", "[]", $content);
  $content = str_replace("http://letrag.com/", "/", $content);
  return $content;
}