<?php

namespace app\components;

use Yii;
use app\components\enums\EnumTransaksi;
use app\models\Notifikasi;
use app\models\Pesan;
use app\modules\transaksi\models\NomorUrut;

class Generator extends \yii\base\Component
{
    public static function slug($name)
    {
        $name = trim($name);
        $spasi            = array(' ');
        $list_karakter    = array('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','’', "'", '”', '“');
        $name            = str_replace($list_karakter, '', $name);
        $name            = strtolower(str_replace($spasi, '-', $name));
        
        return $name;
    }

    public static function folder($name)
    {

        $folderDate = self::folderDate();
        if(!empty($folderDate)){
            $webroot = Yii::getAlias('@app').'/web/uploads/'.$folderDate.'/'.$name;
            if (!file_exists($webroot)) {
                  mkdir($webroot, 0755);
            }

            if (!is_readable($webroot)) {
                 chmod($webroot, 0755);
            }
            return $webroot;
        }

        return false;
    }

    public static function folderDate()
    {
        $webroot = Yii::getAlias('@app').'/web/uploads/'.date('Y-m');
        if (!file_exists($webroot)) {
              mkdir($webroot, 0755);
        }

        if (!is_readable($webroot)) {
             chmod($webroot, 0755);
        }
        return date('Y-m');
    }

    public function nomorTransaksi($tipe)
    {
        //  format : tipe,tanggal,jumlah transaksi
        $nomor = 0;
        $jumlahTranskasi = NomorUrut::getJumlah($tipe);
        switch ($tipe) {
            case EnumTransaksi::TIPE_PERMOHONAN_DATA_DIRI:
                $nomor = "01".date('Ymd').str_pad($jumlahTranskasi, 4, '0',STR_PAD_LEFT);
                break;
            case EnumTransaksi::TIPE_PERMOHONAN_ORANG_TUA:
                $nomor = "02".date('Ymd').str_pad($jumlahTranskasi, 4, '0',STR_PAD_LEFT);
                break;
            case EnumTransaksi::TIPE_PERMOHONAN_ANAK:
                $nomor = "03".date('Ymd').str_pad($jumlahTranskasi, 4, '0',STR_PAD_LEFT);
                break;
            case EnumTransaksi::TIPE_PERMOHONAN_SAUDARA:
                $nomor = "04".date('Ymd').str_pad($jumlahTranskasi, 4, '0',STR_PAD_LEFT);
                break;
            case EnumTransaksi::TIPE_PERMOHONAN_RIWAYAT_PENDIDIKAN:
                $nomor = "05".date('Ymd').str_pad($jumlahTranskasi, 4, '0',STR_PAD_LEFT);
                break;
            case EnumTransaksi::TIPE_PERMOHONAN_RIWAYAT_PANGKAT:
                $nomor = "06".date('Ymd').str_pad($jumlahTranskasi, 4, '0',STR_PAD_LEFT);
                break;
            case EnumTransaksi::TIPE_PERMOHONAN_PASANGAN:
                $nomor = "07".date('Ymd').str_pad($jumlahTranskasi, 4, '0',STR_PAD_LEFT);
                break;
            case EnumTransaksi::TIPE_PERMOHONAN_RIWAYAT_JABATAN:
                $nomor = "08".date('Ymd').str_pad($jumlahTranskasi, 4, '0',STR_PAD_LEFT);
                break;
            default:
                # code...
                break;
        }

        return $nomor;
    }

    public static function notifVerifikasi($model, $status, $tipe = null)
    {
        $pesan = "";
        if($status == 1){
            $pesan = "Selamat. Transaksi anda dengan nomor ".$model->nomor_transaksi." sudah terverifikasi.";
        }
        if($status == 2){
            $pesan = "Maaf. Transaksi anda dengan nomor ".$model->nomor_transaksi." ditolak. <br>Dengan alasan : <br>";
            $pesan .= $model->keterangan_verifikasi;
            $pesan .= "<br>Silahkan lakukan permohonan ulang kembali ";
            if(!empty($tipe) && $tipe == 'tolakDataDiri'){
                $pesan .= "Dengan data sebelumnya dengan mengklik tautan dibawah ini :<br>";
                $pesan .= '<a href="/transaksi/permohonan-data-pegawai/data-diri?id='.$model->id_transaksi_data_diri.'">Permohonan Ulang Data Diri</a>';
            }
        }


        return $pesan;
    }

    public static function randomAlphaNumeric($length)
    {
        $chars = array_merge(range(0,9), range('a','z'), range('A','Z'));
        shuffle($chars);
        $password = implode(array_slice($chars, 0, $length));

        return $password;
    }

}