<!DOCTYPE html>
<html lang="en">
<?php
// perhitungan matriks metode spk smart
function PembentukanMatriks($koneksi)
{
  $query = mysqli_query($koneksi, "SELECT * FROM alternatif ORDER BY kode") or die(mysqli_error($koneksi));
  $matriks = array();
  $no = 0;
  while ($row = mysqli_fetch_array($query)) {
    $matriks[$no][] = $row['kode'];
    $matriks[$no][] = $row['nama'];
    $kriteria_query = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode") or die(mysqli_error($koneksi));
    while ($kriteria = mysqli_fetch_array($kriteria_query)) {
      $id_kriteria = $kriteria['id'];
      $id_alternatif = $row['id'];
      $nilai_query = mysqli_query($koneksi, "SELECT nilai_alternatif.*, subkriteria.skala_nilai FROM nilai_alternatif 
                          JOIN subkriteria ON nilai_alternatif.id_subkriteria = subkriteria.id 
                          WHERE nilai_alternatif.id_kriteria = $id_kriteria AND nilai_alternatif.id_alternatif = $id_alternatif") or die(mysqli_error($koneksi));
      $max_min_query = mysqli_query($koneksi, "SELECT MAX(skala_nilai) as skala_maksimum, MIN(skala_nilai) as skala_minimum FROM subkriteria WHERE id_kriteria = $id_kriteria") or die(mysqli_error($koneksi));
      $max_min = mysqli_fetch_array($max_min_query);
      while ($nilai = mysqli_fetch_array($nilai_query)) {
        $matriks[$no][] = array("skala_nilai" => $nilai['skala_nilai'], "jenis" => $kriteria['jenis'], "skala_maksimum" => $max_min['skala_maksimum'], "skala_minimum" => $max_min['skala_minimum']);
      }
    }
    $no++;
  }
  return $matriks;
}
function matriksNormalisasi($koneksi)
{
  $matriks = PembentukanMatriks($koneksi);
  $matriksNormalisasi = array();
  $no = 0;
  for ($i = 0; $i < count($matriks); $i++) {
    $matriksNormalisasi[$i][0] = $matriks[$i][0]; // kode
    $matriksNormalisasi[$i][1] = $matriks[$i][1]; // nama
    for ($j = 2; $j < count($matriks[$i]); $j++) {
      // Mencari nilai utility
      if ($matriks[$i][$j]['jenis'] == 'benefit') {
        $matriksNormalisasi[$i][$j] = array('skala_nilai' => (($matriks[$i][$j]['skala_nilai'] - $matriks[$i][$j]['skala_minimum']) / ($matriks[$i][$j]['skala_maksimum'] - $matriks[$i][$j]['skala_minimum'])), 'jenis' => $matriks[$i][$j]['jenis']);
      } else {
        $matriksNormalisasi[$i][$j] = array('skala_nilai' => (($matriks[$i][$j]['skala_maksimum'] - $matriks[$i][$j]['skala_nilai']) / ($matriks[$i][$j]['skala_maksimum'] - $matriks[$i][$j]['skala_minimum'])), 'jenis' => $matriks[$i][$j]['jenis']);
      }
      // ket : 5 dan 3 adalah skala nilai maksimal dan minimal
    }
  }
  return $matriksNormalisasi;
}
// perangkingan
function MatriksNormalisasiTerbobot($koneksi)
{
  // get bobot from kriteria table
  $query = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY kode") or die(mysqli_error($koneksi));
  $bobot = array();
  while ($row = mysqli_fetch_array($query)) {
    $bobot[] = (float)$row['bobot'];
  }
  $matriksNormalisasi = MatriksNormalisasi($koneksi);
  $matriksNormalisasiTerbobot = array();
  for ($i = 0; $i < count($matriksNormalisasi); $i++) {
    $matriksNormalisasiTerbobot[$i][0] = $matriksNormalisasi[$i][0]; // kode
    $matriksNormalisasiTerbobot[$i][1] = $matriksNormalisasi[$i][1]; // nama
    $bobotKe = 0;
    $nilaiAkhir = array();
    for ($j = 2; $j < count($matriksNormalisasi[$i]); $j++) {
      $matriksNormalisasiTerbobot[$i][$j]['skala_nilai'] = (float)$matriksNormalisasi[$i][$j]['skala_nilai'] * ($bobot[$bobotKe] / 100);
      $matriksNormalisasiTerbobot[$i][$j]['jenis'] = $matriksNormalisasi[$i][$j]['jenis'];
      $nilaiAkhir[] = $matriksNormalisasiTerbobot[$i][$j]['skala_nilai'];
      $bobotKe++;
    }
    $matriksNormalisasiTerbobot[$i][count($matriksNormalisasi[$i])]['skala_nilai'] = array_sum($nilaiAkhir);
    $matriksNormalisasiTerbobot[$i][count($matriksNormalisasi[$i])]['jenis'] = 'nilai_y';
  }

  return $matriksNormalisasiTerbobot;
}
function Perangkingan($koneksi)
{
  $perangkingan = MatriksNormalisasiTerbobot($koneksi);
  usort($perangkingan, function ($a, $b) {
    return $b[count($a) - 1]['skala_nilai'] <=> $a[count($a) - 1]['skala_nilai'];
  });
  return $perangkingan;
}
?>