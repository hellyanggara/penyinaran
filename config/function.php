<?php
    function newline($var, $arah, $jenis){
        if($arah == 'backward'){
            if($jenis == 'br'){
                return str_replace("^", "<br>", $var);
            }elseif($jenis == 'n'){
                return str_replace("^", "\n", $var);
            }elseif($jenis == '13'){
                return str_replace("^", "&#13;", $var);
            }
        }elseif($arah == 'forward'){
            if($jenis == 'br'){
                return str_replace("<br>", "^", $var);
            }elseif($jenis == 'n'){
                return preg_replace('/\n/', '^', (str_replace("'", "`", $var)));
            }elseif($jenis == '13'){
                return preg_replace("&#13;", '^', (str_replace("'", "`", $var)));
            }
        }
    }
    function cleaningtext($var){
        $varclean = str_replace("'", "`", $var);
        $varclean = str_replace('"', '`', $varclean);
        $varclean = str_replace('<=', '≤', $varclean);
        $varclean = str_replace('>=', '≥', $varclean);
        $varclean = str_replace('///', '/', $varclean);
        $varclean = str_replace('//', '/', $varclean);
        return $varclean;
    }
    
    function cleannominal($var){
        $varclean = str_replace(",", "", $var);
        $varclean = str_replace(".", "", $varclean);
        return $varclean;
    }
    function limit_chars($string, $length) {
        if(strlen($string) <= $length) {
            return $string;
        }else{
            $rtn=substr($string, 0, $length).'...';
            return $rtn;
        }
    }
    function namabulan($angkabulan){
        if($angkabulan == 1){
            return "Januari";
        }elseif($angkabulan == 2){
            return "Februari";
        }elseif($angkabulan == 3){
            return "Maret";
        }elseif($angkabulan == 4){
            return "April";
        }elseif($angkabulan == 5){
            return "Mei";
        }elseif($angkabulan == 6){
            return "Juni";
        }elseif($angkabulan == 7){
            return "Juli";
        }elseif($angkabulan == 8){
            return "Agustus";
        }elseif($angkabulan == 9){
            return "September";
        }elseif($angkabulan == 10){
            return "Oktober";
        }elseif($angkabulan == 11){
            return "November";
        }elseif($angkabulan == 12){
            return "Desember";
        }
    }
    function romawibulan($angkabulan){
        if($angkabulan == 1){
            return "I";
        }elseif($angkabulan == 2){
            return "II";
        }elseif($angkabulan == 3){
            return "III";
        }elseif($angkabulan == 4){
            return "IV";
        }elseif($angkabulan == 5){
            return "V";
        }elseif($angkabulan == 6){
            return "VI";
        }elseif($angkabulan == 7){
            return "VII";
        }elseif($angkabulan == 8){
            return "VIII";
        }elseif($angkabulan == 9){
            return "IX";
        }elseif($angkabulan == 10){
            return "X";
        }elseif($angkabulan == 11){
            return "XI";
        }elseif($angkabulan == 12){
            return "XII";
        }
    }
    function hurufbulan($angkabulan, $jenis){
        if($jenis == 'FK'){
            if($angkabulan == 1){
                return "A";
            }elseif($angkabulan == 2){
                return "B";
            }elseif($angkabulan == 3){
                return "C";
            }elseif($angkabulan == 4){
                return "D";
            }elseif($angkabulan == 5){
                return "E";
            }elseif($angkabulan == 6){
                return "F";
            }elseif($angkabulan == 7){
                return "G";
            }elseif($angkabulan == 8){
                return "H";
            }elseif($angkabulan == 9){
                return "I";
            }elseif($angkabulan == 10){
                return "J";
            }elseif($angkabulan == 11){
                return "K";
            }elseif($angkabulan == 12){
                return "L";
            }
        }elseif($jenis == 'Aduan'){
            if($angkabulan == 1){
                return "M";
            }elseif($angkabulan == 2){
                return "N";
            }elseif($angkabulan == 3){
                return "O";
            }elseif($angkabulan == 4){
                return "P";
            }elseif($angkabulan == 5){
                return "Q";
            }elseif($angkabulan == 6){
                return "R";
            }elseif($angkabulan == 7){
                return "S";
            }elseif($angkabulan == 8){
                return "T";
            }elseif($angkabulan == 9){
                return "U";
            }elseif($angkabulan == 10){
                return "V";
            }elseif($angkabulan == 11){
                return "W";
            }elseif($angkabulan == 12){
                return "X";
            }
        }
    }
    function jumlahharibulan($angkabulan, $tahun){
        return cal_days_in_month(CAL_GREGORIAN, $angkabulan, $tahun);
    }
    function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}
    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
    function indonesiandate($tanggal, $denganhari){
        if(date('m', strtotime($tanggal)) == '1'){
            $bulan = 'Januari';
        }elseif(date('m', strtotime($tanggal)) == '2'){
            $bulan = 'Februari';
        }elseif(date('m', strtotime($tanggal)) == '3'){
            $bulan = 'Maret';
        }elseif(date('m', strtotime($tanggal)) == '4'){
            $bulan = 'April';
        }elseif(date('m', strtotime($tanggal)) == '5'){
            $bulan = 'Mei';
        }elseif(date('m', strtotime($tanggal)) == '6'){
            $bulan = 'Juni';
        }elseif(date('m', strtotime($tanggal)) == '7'){
            $bulan = 'Juli';
        }elseif(date('m', strtotime($tanggal)) == '8'){
            $bulan = 'Agustus';
        }elseif(date('m', strtotime($tanggal)) == '9'){
            $bulan = 'September';
        }elseif(date('m', strtotime($tanggal)) == '10'){
            $bulan = 'Oktober';
        }elseif(date('m', strtotime($tanggal)) == '11'){
            $bulan = 'November';
        }elseif(date('m', strtotime($tanggal)) == '12'){
            $bulan = 'Desember';
        }
        if($denganhari == 1){
            if(date('l', strtotime($tanggal)) == 'Monday'){
                $hari = 'Senin, ';
            }elseif(date('l', strtotime($tanggal)) == 'Tuesday'){
                $hari = 'Selasa, ';
            }elseif(date('l', strtotime($tanggal)) == 'Wednesday'){
                $hari = 'Rabu, ';
            }elseif(date('l', strtotime($tanggal)) == 'Thursday'){
                $hari = 'Kamis, ';
            }elseif(date('l', strtotime($tanggal)) == 'Friday'){
                $hari = 'Jumat, ';
            }elseif(date('l', strtotime($tanggal)) == 'Saturday'){
                $hari = 'Sabtu, ';
            }elseif(date('l', strtotime($tanggal)) == 'Sunday'){
                $hari = 'Minggu, ';
            }
        }else{
            $hari = '';
        }
        return $hari.date('d', strtotime($tanggal)).' '.$bulan.' '.date('Y', strtotime($tanggal));
    }
?>