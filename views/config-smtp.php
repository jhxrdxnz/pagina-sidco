<?php
// Configuración centralizada de envío de correos
// Preparado para PaperCut SMTP en entorno local

// PaperCut SMTP suele escuchar en 127.0.0.1:25 en Windows
// Si usás otro puerto, cambiá smtp_port aquí.
ini_set('SMTP', '127.0.0.1');
ini_set('smtp_port', '25');
ini_set('sendmail_from', 'no-reply@constructorasidco.com');

// Dirección principal de recepción
$MAIL_TO = 'informate@constructorasidco.com';

// Remitente por defecto para los correos salientes desde el sitio
$MAIL_FROM = 'no-reply@constructorasidco.com';
$MAIL_FROM_NAME = 'SIDCO Website';

/**
 * Construye encabezados y cuerpo para un email multipart/mixed con adjuntos.
 * @param string $subject
 * @param string $textBody
 * @param array<int, array{path:string,name?:string,type?:string}> $attachments
 * @return array{headers:string, body:string, boundary:string}
 */
function build_multipart_message(string $subject, string $textBody, array $attachments = []) {
    $boundary = '==Multipart_Boundary_x' . md5((string)microtime()) . 'x';

    $headers = [];
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-Type: multipart/mixed; boundary="' . $boundary . '"';
    $headers[] = 'X-Mailer: PHP/' . phpversion();

    $body  = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $body .= $textBody . "\r\n";

    foreach ($attachments as $att) {
        if (!isset($att['path']) || !is_readable($att['path'])) continue;
        $filename = $att['name'] ?? basename($att['path']);
        $type = $att['type'] ?? 'application/octet-stream';
        $data = file_get_contents($att['path']);
        if ($data === false) continue;
        $data = chunk_split(base64_encode($data));

        $body .= "--$boundary\r\n";
        $body .= "Content-Type: $type; name=\"$filename\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n";
        $body .= "Content-Disposition: attachment; filename=\"$filename\"\r\n\r\n";
        $body .= $data . "\r\n";
    }

    $body .= "--$boundary--";

    return [
        'headers' => implode("\r\n", $headers),
        'body' => $body,
        'boundary' => $boundary,
    ];
}

