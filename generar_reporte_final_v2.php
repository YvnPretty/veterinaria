<?php
/**
 * Generador de informe PDF — Sistema VetCare
 * Documenta el avance hasta dashboards de Administrador y Veterinario.
 * Incorpora los screenshots reales de los paneles y el enlace del repositorio.
 */

class MinimalPDF
{
    private string $output = '';
    private array $objects = [];
    private array $offsets = [];
    private array $pages = [];
    private string $currentPageContent = '';
    private int $pageNum = 0;
    private array $images = [];

    public function __construct()
    {
        $this->output = "%PDF-1.4\n";
        $this->objects = [1 => '', 2 => ''];
    }

    private function addObject(string $data): int
    {
        $id = count($this->objects) + 1;
        $this->objects[$id] = $data;
        return $id;
    }

    public function addPage(): void
    {
        if ($this->currentPageContent !== '') {
            $this->pages[] = $this->currentPageContent;
        }
        $this->pageNum++;
        $this->currentPageContent = "q\n";
    }

    public function footer(): void
    {
        $this->drawText('VetCare — Informe de avance con Screenshots | YvnPretty', 54, 45, 8, false, [150, 150, 150]);
        $this->drawText('Página ' . $this->pageNum, 500, 45, 8, false, [150, 150, 150]);
    }

    public function drawText(string $text, float $x, float $y, int $fontSize = 10, bool $isBold = false, array $color = [0, 0, 0]): void
    {
        $font = $isBold ? '/F2' : '/F1';
        $r = $color[0] / 255.0;
        $g = $color[1] / 255.0;
        $b = $color[2] / 255.0;
        if (mb_detect_encoding($text, 'UTF-8', true)) {
            $text = mb_convert_encoding($text, 'ISO-8859-1', 'UTF-8');
        }
        $escaped = str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $text);
        $this->currentPageContent .= "BT\n{$r} {$g} {$b} rg\n{$font} {$fontSize} Tf\n{$x} {$y} Td\n({$escaped}) Tj\nET\n";
    }

    public function drawLine(float $x1, float $y1, float $x2, float $y2, float $width = 1, array $color = [0, 0, 0]): void
    {
        $r = $color[0] / 255.0;
        $g = $color[1] / 255.0;
        $b = $color[2] / 255.0;
        $this->currentPageContent .= "q\n{$width} w\n{$r} {$g} {$b} RG\n{$x1} {$y1} m\n{$x2} {$y2} l\nS\nQ\n";
    }

    public function drawRect(float $x, float $y, float $w, float $h, ?array $fillColor = [240, 240, 240], ?array $strokeColor = null): void
    {
        $this->currentPageContent .= "q\n";
        if ($fillColor) {
            $r = $fillColor[0] / 255.0;
            $g = $fillColor[1] / 255.0;
            $b = $fillColor[2] / 255.0;
            $this->currentPageContent .= "{$r} {$g} {$b} rg\n";
        }
        if ($strokeColor) {
            $sr = $strokeColor[0] / 255.0;
            $sg = $strokeColor[1] / 255.0;
            $sb = $strokeColor[2] / 255.0;
            $this->currentPageContent .= "{$sr} {$sg} {$sb} RG\n";
        }
        $this->currentPageContent .= "{$x} {$y} {$w} {$h} re\n";
        $this->currentPageContent .= ($fillColor && $strokeColor) ? "B\n" : ($fillColor ? "f\n" : "S\n");
        $this->currentPageContent .= "Q\n";
    }

    public function addImage(string $alias, string $jpegPath): void
    {
        if (!file_exists($jpegPath)) {
            return;
        }
        $size = getimagesize($jpegPath);
        if (!$size) {
            return;
        }
        $width = $size[0];
        $height = $size[1];
        $data = file_get_contents($jpegPath);
        $imageObjId = $this->addObject("<< /Type /XObject /Subtype /Image /Width {$width} /Height {$height} /ColorSpace /DeviceRGB /BitsPerComponent 8 /Filter /DCTDecode /Length " . strlen($data) . " >>\nstream\n" . $data . "\nendstream");
        $this->images[$alias] = [
            'id' => $imageObjId,
            'w' => $width,
            'h' => $height
        ];
    }

    public function drawImage(string $alias, float $x, float $y, float $w, float $h): void
    {
        if (!isset($this->images[$alias])) {
            return;
        }
        $this->currentPageContent .= "q\n{$w} 0 0 {$h} {$x} {$y} cm\n/{$alias} Do\nQ\n";
    }

    public function sectionTitle(string $title, float $y = 690): float
    {
        $this->drawText($title, 54, $y, 14, true, [106, 58, 222]);
        $this->drawLine(54, $y - 10, 400, $y - 10, 1, [106, 58, 222]);
        return $y - 35;
    }

    public function bulletList(array $lines, float $startY, int $fontSize = 9): float
    {
        $y = $startY;
        foreach ($lines as $line) {
            $this->drawText('• ' . $line, 64, $y, $fontSize, false, [40, 40, 40]);
            $y -= 16;
        }
        return $y;
    }

    public function render(): string
    {
        if ($this->currentPageContent !== '') {
            $this->pages[] = $this->currentPageContent;
        }
        $fontNormalId = $this->addObject("<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica /Encoding /WinAnsiEncoding >>");
        $fontBoldId = $this->addObject("<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold /Encoding /WinAnsiEncoding >>");
        
        $xobjectsStr = '';
        foreach ($this->images as $alias => $info) {
            $xobjectsStr .= "/{$alias} {$info['id']} 0 R ";
        }
        $resourcesId = $this->addObject("<< /Font << /F1 {$fontNormalId} 0 R /F2 {$fontBoldId} 0 R >> >>" . ($xobjectsStr !== '' ? " /XObject << {$xobjectsStr} >>" : ''));

        $contentObjectIds = [];
        foreach ($this->pages as $pageData) {
            $pageData .= "Q\n";
            $contentObjectIds[] = $this->addObject("<< /Length " . strlen($pageData) . " >>\nstream\n" . $pageData . "endstream");
        }
        $pageObjectIds = [];
        foreach ($contentObjectIds as $contentObjId) {
            $pageObjectIds[] = $this->addObject("<< /Type /Page /Parent 2 0 R /Resources {$resourcesId} 0 R /MediaBox [0 0 612 792] /Contents {$contentObjId} 0 R >>");
        }
        $this->objects[1] = "<< /Type /Catalog /Pages 2 0 R >>";
        $this->objects[2] = "<< /Type /Pages /Kids [" . implode(' 0 R ', $pageObjectIds) . " 0 R] /Count " . count($this->pages) . " >>";
        ksort($this->objects);
        foreach ($this->objects as $id => $data) {
            $this->offsets[$id] = strlen($this->output);
            $this->output .= "{$id} 0 obj\n" . $data . "\nendobj\n";
        }
        $xrefOffset = strlen($this->output);
        $this->output .= "xref\n0 " . (count($this->objects) + 1) . "\n0000000000 65535 f \n";
        foreach ($this->offsets as $offset) {
            $this->output .= sprintf("%010d 00000 n \n", $offset);
        }
        $this->output .= "trailer\n<< /Size " . (count($this->objects) + 1) . " /Root 1 0 R >>\nstartxref\n" . $xrefOffset . "\n%%EOF\n";
        return $this->output;
    }
}

// Helper to convert uploaded PNGs to JPEGs for the PDF
function convertPngToJpeg(string $pngPath, string $jpegPath): bool
{
    if (!file_exists($pngPath)) {
        return false;
    }
    // Create output dir if needed
    $dir = dirname($jpegPath);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    if (function_exists('imagecreatefrompng')) {
        $img = imagecreatefrompng($pngPath);
        if ($img) {
            imagejpeg($img, $jpegPath, 85);
            imagedestroy($img);
            return true;
        }
    }
    if (shell_exec('which convert')) {
        shell_exec("convert " . escapeshellarg($pngPath) . " " . escapeshellarg($jpegPath));
        return file_exists($jpegPath);
    }
    return false;
}

// Convert uploaded screenshots
$convId = '899e8881-6655-4209-b478-a1fa5cd0be6c';
$srcVet = "/home/yvnsu/.gemini/antigravity/brain/{$convId}/media__1779144730431.png";
$srcAdmin = "/home/yvnsu/.gemini/antigravity/brain/{$convId}/media__1779144737726.png";

$dstVet = "/home/yvnsu/veterinaria/public/img/vet_dashboard.jpg";
$dstAdmin = "/home/yvnsu/veterinaria/public/img/admin_dashboard.jpg";

$hasVet = convertPngToJpeg($srcVet, $dstVet);
$hasAdmin = convertPngToJpeg($srcAdmin, $dstAdmin);

$pdf = new MinimalPDF();

// Load images into PDF builder
if ($hasVet) {
    $pdf->addImage('vetImg', $dstVet);
}
if ($hasAdmin) {
    $pdf->addImage('adminImg', $dstAdmin);
}

const REPO_URL = 'https://github.com/YvnPretty/veterinaria.git';
const PURPLE = [106, 58, 222];

// —— Página 1: Portada y repositorio ——
$pdf->addPage();
$pdf->drawRect(54, 720, 504, 18, PURPLE);
$pdf->drawRect(54, 715, 504, 3, [253, 186, 116]);
$pdf->drawText('INFORME DE AVANCE — SISTEMA VETCARE', 54, 670, 11, true, [100, 100, 100]);
$pdf->drawText('CAPTURA DE PANTALLA & REPOSITORIO', 54, 600, 22, true, PURPLE);
$pdf->drawText('Reporte técnico resumido', 54, 570, 12, false, [80, 80, 80]);
$pdf->drawText('Desarrollador: YvnPretty', 54, 535, 11, false, [50, 50, 50]);
$pdf->drawText('Alcance: Visualización de los dashboards reales y link del repositorio.', 54, 505, 10, false, [60, 60, 60]);

$pdf->drawText('REPOSITORIO DEL PROYECTO', 54, 440, 12, true, PURPLE);
$pdf->drawRect(54, 345, 504, 85, [245, 245, 250], [200, 200, 220]);
$pdf->drawText('GitHub (clonar):', 64, 405, 9, true, [80, 80, 80]);
$pdf->drawText(REPO_URL, 64, 385, 9, false, PURPLE);
$pdf->drawText('Rama principal: main', 64, 365, 9, false, [50, 50, 50]);
$pdf->drawText('El proyecto se encuentra versionado commit por commit en esta rama.', 64, 345, 8, false, [100, 100, 100]);

$pdf->drawText('Fecha del informe: ' . date('d/m/Y'), 54, 280, 10, true, [50, 50, 50]);
$pdf->footer();

// —— Página 2: Dashboard Administrador ——
$pdf->addPage();
$y = $pdf->sectionTitle('1. PANEL DE ADMINISTRACIÓN — GESTIÓN DE USUARIOS');
$pdf->drawText('Módulo: Gestión de Usuarios (Consola de Administración)', 54, $y, 10, true, [80, 80, 80]);
$y -= 25;

if ($hasAdmin) {
    $pdf->drawImage('adminImg', 76, $y - 258, 460, 258);
    $pdf->drawRect(76, $y - 258, 460, 258, null, [200, 200, 200]);
    $y -= 280;
} else {
    $pdf->drawRect(76, $y - 258, 460, 258, [245, 245, 245], [200, 0, 0]);
    $pdf->drawText('Screenshot no disponible (inicia sesión en local como admin y verifica)', 120, $y - 150, 10, true, [200, 0, 0]);
    $y -= 280;
}

$pdf->drawText('Explicación del Panel de Administración:', 54, $y, 11, true, PURPLE);
$y -= 20;
$pdf->drawText('Esta captura de pantalla muestra el Panel de Administración de VetCare (Gestión de Usuarios).', 54, $y, 9.5, false, [40, 40, 40]);
$y -= 15;
$pdf->drawText('En esta sección, el administrador del sistema tiene control completo de accesos (CRUD) para registrar,', 54, $y, 9.5, false, [40, 40, 40]);
$y -= 15;
$pdf->drawText('modificar o dar de baja cuentas de usuario. Los roles se identifican mediante distintivos de colores', 54, $y, 9.5, false, [40, 40, 40]);
$y -= 15;
$pdf->drawText('para una clara separación visual: el color celeste para "Veterinario", morado para "Administrador" y', 54, $y, 9.5, false, [40, 40, 40]);
$y -= 15;
$pdf->drawText('azul para el rol "Usuario", lo que facilita un control visual rápido, intuitivo y centralizado.', 54, $y, 9.5, false, [40, 40, 40]);

$pdf->footer();

// —— Página 3: Dashboard Veterinario ——
$pdf->addPage();
$y = $pdf->sectionTitle('2. DASHBOARD DEL VETERINARIO — PANEL CLÍNICO');
$pdf->drawText('Módulo: Dashboard del Veterinario (Pantalla de bienvenida)', 54, $y, 10, true, [80, 80, 80]);
$y -= 25;

if ($hasVet) {
    $pdf->drawImage('vetImg', 76, $y - 258, 460, 258);
    $pdf->drawRect(76, $y - 258, 460, 258, null, [200, 200, 200]);
    $y -= 280;
} else {
    $pdf->drawRect(76, $y - 258, 460, 258, [245, 245, 245], [200, 0, 0]);
    $pdf->drawText('Screenshot no disponible (inicia sesión en local como veterinario y verifica)', 120, $y - 150, 10, true, [200, 0, 0]);
    $y -= 280;
}

$pdf->drawText('Explicación del Dashboard de Veterinario:', 54, $y, 11, true, PURPLE);
$y -= 20;
$pdf->drawText('Esta captura de pantalla corresponde al Dashboard del Veterinario, el panel de bienvenida principal', 54, $y, 9.5, false, [40, 40, 40]);
$y -= 15;
$pdf->drawText('al iniciar sesión con el rol clínico en VetCare.', 54, $y, 9.5, false, [40, 40, 40]);
$y -= 15;
$pdf->drawText('Presenta un saludo personalizado ("¡Hola, juan!"), tarjetas dinámicas con métricas críticas diarias', 54, $y, 9.5, false, [40, 40, 40]);
$y -= 15;
$pdf->drawText('(citas del día, pacientes activos y facturaciones), un listado de las citas de hoy organizadas por horario', 54, $y, 9.5, false, [40, 40, 40]);
$y -= 15;
$pdf->drawText('y estado, y una columna lateral con recordatorios de vacunas pendientes y el calendario clínico.', 54, $y, 9.5, false, [40, 40, 40]);

$pdf->footer();

$outputPath = __DIR__ . '/REPORTE_FINAL_VETCARE.pdf';
file_put_contents($outputPath, $pdf->render());
echo "Reporte generado con screenshots y link del repo en: {$outputPath}\n";
