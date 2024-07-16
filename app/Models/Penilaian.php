<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\Kelas;
use App\Models\Penilaian;
use Auth;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = ['siswa_id', 'kriteria_id', 'nilai'];

    /**
     * Get the siswa that owns the Penilaian
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    function storeNilai($siswa, $kriteria, $nilai)
    {
        $nilai_siswa = $this->where('siswa_id', $siswa)->where('kriteria_id', $kriteria)->first();
        if($nilai_siswa == null){
            $this->create([
                'siswa_id' => $siswa,
                'kriteria_id' => $kriteria,
                'nilai' => $nilai
            ]);
        }elseif($nilai_siswa->nilai != $nilai){
            $this->where('siswa_id', $siswa)->where('kriteria_id', $kriteria)->update([
                'nilai' => $nilai
            ]);
        }
        return 0;
        
    }

    protected function getSiswa($kelas = null)
    {
        return Siswa::filterSiswaPerkelas($kelas);
    }

    protected function normalisasi($kelas = null)
    {
        $normalisasi = [];
        foreach ($this->getSiswa() as $siswa) {
            foreach ($this->getKriteria() as $key => $kriteria) {
                $matrik = 0;
                $nilai_siswa = $this->getNilai($siswa->id, $kriteria->id);
                $matrik = 0;
                if ($nilai_siswa !== null) {
                    $nilai = $nilai_siswa->nilai;
                    foreach ($kriteria->subKriteria as $value) {
                        if ($nilai >= $value->batas_bawah && $nilai <= $value->batas_atas) {
                            $matrik = $value->nilai;
                        }
                        $dump[$kriteria->id] = $matrik;
                    }
                }
            }
            array_push($normalisasi, $dump);
        }
        return $normalisasi;
    }

    protected function getKriteria()
    {
        return Kriteria::orderBy('kode_kriteria', 'asc')->get();
    }
    protected function getNilai($siswa = null, $kriteria = null)
    {
        return Penilaian::where('siswa_id', $siswa)->where('kriteria_id', $kriteria)->first();
    }

    protected function matriksTernormalisasi($kelas = null)
    {
        $data = $this->normalisasi();
        $kriteria = $this->getKriteria();
        $dump = [];
        foreach ($kriteria as $key => $value) {
            $temp = [];
            foreach ($data as $index => $nilai) {
                foreach ($nilai as $p => $hasil) {
                    if ($value->id == $p) {
                        array_push($temp, $hasil);
                    }
                }
            }
            array_push($dump, $temp);
        }

        return $dump;
    }

    protected function hitungNilaiNormalisasi($kelas = null)
    {
        $data = $this->matriksTernormalisasi();
        $final = [];
        $dump = [];
        foreach ($data as $key => $value) {
            $temp = null;
            foreach ($value as $index => $hasil) {
                $tambah = pow($hasil, 2);
                $i = $temp + $tambah;
                $temp = $i;
            }
            array_push($dump, $temp);
        }
        foreach ($dump as $value) {
            array_push($final, floatval(number_format(sqrt($value), 3, '.')));
        }

        return $final;
    }

    protected function menormalisasikanMatriks($kelas = null)
    {
        $hasilNilaiNormalisasi = $this->hitungNilaiNormalisasi();
        $normalisasi = $this->normalisasi();
        $final = [];
        foreach ($normalisasi as $key => $value) {
            $temp = [];
            foreach ($value as $index => $hasil) {
                $dump = $hasil / $hasilNilaiNormalisasi[$index - 1];
                array_push($temp, floatval(number_format($dump, 3, '.')));
            }
            array_push($final, $temp);
        }

        return $final;
    }

    protected function hitungNilaiNormalisasiTerbobot($kelas = null)
    {
        $final = [];
        $data = $this->menormalisasikanMatriks();
        $kriteria = $this->getKriteria();
        foreach ($data as $key => $value) {
            $temp = [];
            foreach ($value as $index => $nilai) {
                $dump = $nilai * $kriteria[$index]->bobot;
                array_push($temp, $dump);
            }
            array_push($final, $temp);
        }
        return $final;
    }

    protected function normalisasiTerbobot($kelas = null)
    {
        $data = $this->hitungNilaiNormalisasiTerbobot();
        $kriteria = $this->getKriteria();
        $dump = [];
        foreach ($kriteria as $key => $value) {
            $temp = [];
            foreach ($data as $index => $nilai) {
                foreach ($nilai as $p => $hasil) {
                    if ($key == $p) {
                        array_push($temp, $hasil);
                    }
                }
            }
            array_push($dump, $temp);
        }

        return $dump;
    }

    protected function cariSolusiIdeal($tipe = null)
    {
        //tipe
        //0 berarti negatif angka pertama adalah yang terbesar sisanya yang terkecil
        //1 berarti positif angka pertama adalah yang terkecil sisanya yang terbesar

        $final = [];
        $data = $this->normalisasiTerbobot();

        foreach ($data as $key => $value) {
            $max = max($value);
            $min = min($value);
            if($tipe == 1){
                if(count($final) > 0){
                    array_push($final, $max);
                }else{
                    array_push($final, $min);
                }
            }else{
                if(count($final) > 0){
                    array_push($final, $min);
                }else{
                    array_push($final, $max);
                }
            }
        }

        return $final;
    }

    protected function hitungJarakSolusiIdeal($kelas = null)
    {
        $final = [];
        $positif = $this->cariSolusiIdeal(1);
        $negatif = $this->cariSolusiIdeal(0);
        $data = $this->hitungNilaiNormalisasiTerbobot();
        foreach ($data as $key => $value) {
            $idealPositif = null;
            $idealNegatif = null;
            for ($i=0; $i < count($value); $i++) { 
                $idealPositif += pow(($positif[$i] - $value[$i]), 2);
                $idealNegatif += pow(($negatif[$i] - $value[$i]), 2);
            }
            $hasilPositif = floatval(number_format(sqrt($idealPositif), 3, '.'));
            $hasilNegatif = floatval(number_format(sqrt($idealNegatif), 3, '.'));
            $hasilArray = [$hasilPositif, $hasilNegatif];
            array_push($final, $hasilArray);
        }

        return $final;
    }

    protected function hitungNilaiPreferensi($kelas = null)
    {
        $data = $this->hitungJarakSolusiIdeal();
        $final = [];
        foreach ($data as $key => $value) {
            $preferensi = $value[1] / ($value[0] + $value[1]);

            array_push($final, floatval(number_format(sqrt($preferensi), 3, '.')));
        }
        return $final;
    }

    protected function perankingan($kelas = null)
    {
        $data = $this->hitungNilaiPreferensi($kelas);
        if(count($this->getSiswa($kelas)) === count($data)){
            $data = array_combine($this->getSiswa($kelas)->pluck('id')->toArray(), $data);
            arsort($data);
        }else{
            $data = [];
        }
        return $data;
    }

}
