<?php
  function convertdate($tanggal)
  {
      $namatanggal=date("d",strtotime($tanggal)); 
      $bulan = date("n",strtotime($tanggal));
      $array_bln = array(1=>"Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober", "November","Desember");
      $namabulan = $array_bln[$bulan];
      $namatahun = date("Y",strtotime($tanggal));
      $namajam = date("H",strtotime($tanggal));
      $namamenit = date("i",strtotime($tanggal));
      return $namatanggal." ".$namabulan." ".$namatahun." ".$namajam.":".$namamenit;
  }

  function convertdateonly($tanggal)
  {
      $namatanggal=date("d",strtotime($tanggal)); 
      $bulan = date("n",strtotime($tanggal));
      $array_bln = array(1=>"Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober", "November","Desember");
      $namabulan = $array_bln[$bulan];
      $namatahun = date("Y",strtotime($tanggal));
      return $namatanggal." ".$namabulan." ".$namatahun;
  }

  function gettodaydate(){
      //tanggal bulan tahun
      /* script menentukan hari */  
      $array_hr= array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
      $hr = $array_hr[date('N')];
      /* script menentukan tanggal */   
      $tgl= date('j');
      /* script menentukan bulan */
      $array_bln = array(1=>"Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober", "November","Desember");
      $bln = $array_bln[date('n')];
      /* script menentukan tahun */ 
      $thn = date('Y');
      return $tgl." ".$bln." ".$thn;
  }