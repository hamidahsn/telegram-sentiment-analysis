<?php

header('Content-Type: text/plain; charset=utf-8');

// ===============================
// 1. KONEKSI DATABASE
// ===============================

$host = "localhost";
$user = "root";
$password = "";
$database = "telegram";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}


// ===============================
// 2. AMBIL PESAN USER
// ===============================

$pesan = isset($_POST['pesan'])
    ? strtolower(trim($_POST['pesan']))
    : '';

if ($pesan == '') {
    echo "Silakan masukkan pertanyaan.";
    exit;
}


// ===============================
// 3. HITUNG JUMLAH SELURUH DATA
// ===============================

if (
    strpos($pesan, 'berapa data') !== false ||
    strpos($pesan, 'jumlah data') !== false ||
    strpos($pesan, 'total data') !== false
) {

    $result = $conn->query(
        "SELECT COUNT(*) AS total FROM messages"
    );

    $row = $result->fetch_assoc();

    echo "Jumlah data Telegram yang tersedia adalah "
        . $row['total'] . " pesan.";

    exit;
}


// ===============================
// 4. HITUNG SENTIMEN NEGATIF
// ===============================

if (
    strpos($pesan, 'berapa pesan negatif') !== false ||
    strpos($pesan, 'jumlah pesan negatif') !== false ||
    strpos($pesan, 'data negatif') !== false
) {

    $result = $conn->query(
        "SELECT COUNT(*) AS total
         FROM messages
         WHERE sentimen = 'negatif'"
    );

    $row = $result->fetch_assoc();

    echo "Jumlah pesan dengan sentimen negatif adalah "
        . $row['total'] . " pesan.";

    exit;
}


// ===============================
// 5. HITUNG SENTIMEN POSITIF
// ===============================

if (
    strpos($pesan, 'berapa pesan positif') !== false ||
    strpos($pesan, 'jumlah pesan positif') !== false ||
    strpos($pesan, 'data positif') !== false
) {

    $result = $conn->query(
        "SELECT COUNT(*) AS total
         FROM messages
         WHERE sentimen = 'positif'"
    );

    $row = $result->fetch_assoc();

    echo "Jumlah pesan dengan sentimen positif adalah "
        . $row['total'] . " pesan.";

    exit;
}


// ===============================
// 6. ANALISIS SENTIMEN DENGAN SVM
// ===============================

// URL Flask API
$url = "http://127.0.0.1:5000/predict";

// Data yang dikirim ke Flask
$data = json_encode([
    "teks" => $pesan
]);

// Pengaturan request
$options = [
    "http" => [
        "method"  => "POST",
        "header"  => "Content-Type: application/json\r\n",
        "content" => $data,
        "timeout" => 10
    ]
];

$context = stream_context_create($options);

// Kirim pesan ke Flask
$response = @file_get_contents($url, false, $context);


// ===============================
// 7. CEK HASIL DARI FLASK
// ===============================

if ($response !== false) {

    $hasil = json_decode($response, true);

    if (
        isset($hasil['sentimen']) &&
        isset($hasil['teks'])
    ) {

        if ($hasil['sentimen'] == 'positif') {

            echo "🟢 Hasil analisis sentimen: POSITIF.\n\n"
               . "Pesan: " . $hasil['teks'];

        } elseif ($hasil['sentimen'] == 'negatif') {

            echo "🔴 Hasil analisis sentimen: NEGATIF.\n\n"
               . "Pesan: " . $hasil['teks'];

        } else {

            echo "Hasil analisis: "
               . $hasil['sentimen'];
        }

        exit;
    }
}


// ===============================
// 8. JIKA FLASK TIDAK TERHUBUNG
// ===============================

echo "Maaf, server analisis sentimen sedang tidak dapat dihubungi.";


$conn->close();

?>