<?php
class Kejadian_siswa extends CI_Controller{
    function __construct(){
        parent::__construct();
        if(!$this->session->has_userdata('user_id')){
            redirect('admin/login');
        } 
        $this->load->model('kejadian_siswa_model');
        $this->load->library('form_validation');
    }

    function index(){
        $this->load->view('admin/kejadian_siswa/list');
    }
    function add(){
        $this->load->model('daftar_kejadian_model','daftar_kejadian');
        $this->load->model('siswa_model','siswa');
        $data["daftar_kejadian"] = $this->daftar_kejadian->getAllKejadianDropdownBK();
        $data["siswa"] = $this->siswa->getAllSiswaDropdownBK();
        $kejadiansw = $this->kejadian_siswa_model;
        $validation = $this->form_validation;
        $validation->set_rules($kejadiansw->rules());
        if($validation->run())
        {
            $kejadiansw->save();
            $this->session->set_flashdata('success','Berhasil Disimpan');
        }
        $this->load->view('admin/kejadian_siswa/new_form',$data);
    }
    function edit($id = null){
        $this->load->model('daftar_kejadian_model','daftar_kejadian');
        $this->load->model('siswa_model','siswa');
        if(!isset($id)) redirect('admin/kejadian_siswa'); 
        $kejadiansw = $this->kejadian_siswa_model;
        $validation = $this->form_validation;
        $validation->set_rules($kejadiansw->rules());
        if($validation->run()){
            $kejadiansw->update();
            $this->session->set_flashdata('success','Berhasil Diubah');
        }
        $data["daftar_kejadian"] = $this->daftar_kejadian->getAllKejadianDropdownBK();
        $data["siswa"] = $this->siswa->getAllSiswaDropdownBK();
        $data["kejadiansw"] = $kejadiansw->getById($id);
        $this->load->view('admin/kejadian_siswa/edit_form',$data);
    }
    function delete($id=null){
        if(!isset($id)) show_404();
        if($this->kejadian_siswa_model->delete($id)){
            $this->session->set_flashdata('delete_success','Hapus Sukses.');
            redirect(site_url('admin/kejadian_siswa'));
        } else {
            $this->session->set_flashdata('delete_fail','Hapus Gagal, kontak Admin Anda.');
            redirect(site_url('admin/kejadian_siswa'));
        }
    }
    function chat_bk($id = null){
        $this->load->model('forum_kejadian_model','forum_kejadian');
        if(!isset($id)) redirect('admin/kejadian_siswa'); 
        $kejadiansw = $this->kejadian_siswa_model;
        $validation = $this->form_validation;
        $validation->set_rules($kejadiansw->ruleschat());
        if($validation->run()){
            $this->forum_kejadian->chatsave();
            $this->session->set_flashdata('success','Berhasil Ditambahkan');
        }

        $data["kejadiansw"] = $kejadiansw->getByIdForChat($id);
        $data["forum_kejadian"] = $this->forum_kejadian->getAll($id);
        foreach($data["forum_kejadian"] as $fk){
            $fk->tanggal_chat = $this->convertdate($fk->tanggal_chat);
        }
        $data["kejadiansw"]->TANGGAL_KEJADIAN = $this->convertdate($data["kejadiansw"]->TANGGAL_KEJADIAN);
        $data["idchatbk"] = $id;
        $this->load->view('admin/kejadian_siswa/chat_bk',$data);
    }
    function deletechat($id=null,$redirid=null,$redirfromwali=null){
        if(!isset($id)) show_404();
        $this->load->model('forum_kejadian_model','forum_kejadian');
        if($this->forum_kejadian->delete($id)){
            echo "aa";
            $this->session->set_flashdata('delete_success','Hapus Sukses.');
        } else {
            echo "bb";
            $this->session->set_flashdata('delete_fail','Hapus Gagal, kontak Admin Anda.');
        }
        if($redirfromwali == null){
            redirect(site_url('admin/kejadian_siswa/chat_bk/'.$redirid));
        } else {
            redirect(site_url('wali/list_siswa/detail/'.$redirfromwali.'/komentar/'.$redirid));
        }
    }
    function score_list($secondparam=null,$id=null, $na=null){
        if($secondparam==null && $id==null && $na == null){
            $this->load->view('admin/kejadian_siswa/score_list');
        } else {
            if(!isset($id)) redirect('admin/kejadian_siswa/score_list'); 
            $this->load->model('siswa_model','siswa');
            $data["siswa"] = $this->siswa->getById($id);
            $data["score_det"] = $this->kejadian_siswa_model->getScoreDetail($id);
            foreach($data["score_det"] as $sd){
                $sd->TANGGAL_KEJADIAN = $this->convertdate($sd->TANGGAL_KEJADIAN);
            }
            $data["na"] = $na;
            $this->load->view('admin/kejadian_siswa/score_detail',$data);
        }
    }
    function expsub(){
        $mysub = $this->kejadian_siswa_model->subq();
        foreach ($mysub as $my){
            echo $my->poin_akhir."<br>";
        }
        print_r($this->db->last_query());
    }
    public function laporan_bk(){
        $this->load->model('kelas_model','kelas');
        $data["kelas"] = $this->kelas->getDropdownLaporan();
        $validation = $this->form_validation;
        $validation->set_rules($this->kejadian_siswa_model->rulesreport());
        if($validation->run()){
            $data["laporan"] = $this->kejadian_siswa_model->getLaporanDetail();
            foreach ($data["laporan"] as $lap){
                $lap->TANGGAL_KEJADIAN = $this->convertdate($lap->TANGGAL_KEJADIAN);
            }
            $post = $this->input->post();
            $data["dtpstart_b"] = $post["dtpstart"];
            $data["dtpend_b"] = $post["dtpend"];
            $data["id_kelas_b"] = $post["id_kelas"];
            $data["tipe_kejadian_b"] = $post["tipe_kejadian"];
        }
        
        $this->load->view('admin/kejadian_siswa/laporan_bk', $data);
        
    }
    public function printexcel(){
        $data["laporan"] = $this->kejadian_siswa_model->getLaporanDetail(TRUE);
        $this->load->view('admin/kejadian_siswa/laporan_excel', $data);
        
    }
    public function ajax_list()
    {
        
        $list = $this->kejadian_siswa_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $information) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $information->NO_INDUK;
            $row[] = $information->nama_siswa;
            $row[] = $information->nama_kejadian;
            $row[] = $information->poin_kejadian;
            $row[] = $this->convertdate($information->TANGGAL_KEJADIAN);
            if($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "guru" || $this->session->userdata('level') == "guru_bk" || $this->session->userdata('level') == "orang_tua"){
                $row[] = "
                <a href='".  site_url('admin/kejadian_siswa/chat_bk/'.$information->ID_KEJADIAN_SISWA) ."' class='btn btn-small'><i class='fas fa-comments'></i>&nbsp;Comment</a>
                "."
                <a href='".  site_url('admin/kejadian_siswa/edit/'.$information->ID_KEJADIAN_SISWA) ."' class='btn btn-small'><i class='fas fa-edit'></i>Edit</a>
                "."
                <a onclick='deleteConfirm(\"". (string)site_url('admin/kejadian_siswa/delete/'.$information->ID_KEJADIAN_SISWA) ."\")' href='#!'  class='btn btn-small text-danger'><i class='fas fa-trash'></i>Delete</a>
                ";
            }
            $data[] = $row;
        }
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->kejadian_siswa_model->count_all(),
                        "recordsFiltered" => $this->kejadian_siswa_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    public function ajax_list_score()
    {
        
        $list = $this->kejadian_siswa_model->get_datatables_score();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $information) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $information->noindukdistinct;
            $row[] = $information->namasiswa;
            $row[] = $information->poin_awal;
            if($this->session->userdata('fitur_reward') == 1){
                $row[] = $information->poin_reward;
            }
            $row[] = $information->poin_pelanggaran;
            $row[] = $information->poin_akhir;
            
                $row[] = "
                <a href='".  site_url('admin/kejadian_siswa/score_list/score_detail/'.$information->noindukdistinct.'/'.$information->poin_akhir) ."' class='btn btn-small'><i class='fas fa-list-ol'></i>&nbsp;Detail</a>
                "."
                <a target='_blank' href='".  site_url('admin/kejadian_siswa/printpdf/'.$information->noindukdistinct)."' class='btn btn-small'><i class='fas fa-file-pdf'></i>&nbsp;Cetak</a>
                ";
           
            $data[] = $row;
        }
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->kejadian_siswa_model->count_all_score(),
                        "recordsFiltered" => $this->kejadian_siswa_model->count_filtered_score(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
    function printpdf($id){
        $this->load->library('PDF_MC_Table');
        $this->load->model('siswa_model','siswa');
        $this->load->model('pengaturan_bk_model','pengaturan_bk');
        $this->load->model('guru_model','guru');
        $row1 = $this->siswa->getSiswaOrtuById($id);
        $row2 = $this->kejadian_siswa_model->getScoreDetail($id);
        //print_r( $row2[0]->NAMA_KEJADIAN);
        $arrpengaturan = $this->pengaturan_bk->getAll();
        $tglblnthn = $this->gettodaydate();
        $qttd3nama_guru = $this->guru->getById($arrpengaturan[7]->NILAI_PENGATURAN);
        $h_pertama = $arrpengaturan[0]->NILAI_PENGATURAN;

        $pdf = new PDF_MC_Table( 'P', 'mm', 'A4' );
        $pdf->AliasNbPages();
        $pdf->AddPage();

        //header awal

            $pdf->SetFont('Arial','B',15);
            // Move to the right
            //$this->Cell(100);
            // Title
            //nantiditambah
                    //$pdf->Image('../../imagesupload/logoparlaungan.jpg',10,8,20,20);
                    
                    //$pdf->Image('../../imagesupload/logoparlaungan.jpg',180,8,20,20);
            
            $pdf->Cell(0,5,''.$arrpengaturan[3]->NILAI_PENGATURAN,0,1,'C');
            $pdf->Cell(0,5,''.$arrpengaturan[4]->NILAI_PENGATURAN,0,1,'C');
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(0,5,''.$arrpengaturan[5]->NILAI_PENGATURAN,0,1,'C');
                $pdf->Cell(0,5,''.$arrpengaturan[6]->NILAI_PENGATURAN,0,1,'C');
                $pdf->Cell(0,5,'',0,1,'C');
            // Line break
            $pdf->SetFont('Arial','',11);
            $pdf->Line(5, 32, 210-5, 32);
            $pdf->Cell(0,5,'Lampiran    : 1(satu) lembar',0,1,'L');
            $pdf->Cell(0,5,'Hal              : Pemberitahuan Ke Orang Tua',0,1,'L');
            $pdf->Cell(0,5,'',0,1,'L');
            $pdf->Cell(0,5,'Kepada Yth.',0,1,'L');
            $pdf->Cell(0,5,'Bapak '.$row1->user_nama,0,1,'L');
            $pdf->Cell(0,5,'Di Tempat ',0,1,'L');
            $pdf->Ln(15);
        //header akhir

        $pdf->SetFont('Times','I',11);
        $pdf->Cell(0,5,'Bismillaahirrohmaanirrohiim',0,1,'C');
        $pdf->Cell(0,5,'',0,1,'C');
        $pdf->Cell(0,5,'Assalamu\'alaikum Wr.Wb',0,1,'L');
        $pdf->Cell(0,5,'',0,1,'C');
        $pdf->SetFont('Times','',11);
        $reportSubtitle = "            Alhamdulillah, segala puji hanya milik Allah S.W.T, sholawat serta salam semoga tetap tercurah kepada Rasulullah Muhammad SAW beserta keluarga, sahabat dan segenap pengikutnya sehingga kita tergolong pengikut beliau yang setia. Amin.";
        $reportSubtitle2 = "            Sehubungan dengan pelanggaran yang kerap dilakukan oleh siswa Bapak / Ibu atas nama : ";
        $namasiswa = "            ".$row1->nama_siswa."                       No Induk : ".$row1->no_induk;
        $reportSubtitle3 = "Maka kami memberitahukan hal ini kepada Bapak/ Ibu agar dapat diberi perhatian khusus kepada putra / putrinya";
        $reportSubtitle4 = "            Demikian surat pemberitahuan ini. Semoga Allah SWT meridhoi segala upaya kita. Amin.";
        $reportSubtitle5 = "Wassalamu'alaikum Wr.Wb";
        $tandatgn1="Sidoarjo, ".$tglblnthn;
        $tandatgn2="Kepala Sekolah";
        //$tandatgn3="SMP Islam Parlaungan";
        $tandatgn4="".$qttd3nama_guru->nama_guru;
        $pdf->MultiCell( 0, 5, $reportSubtitle, 0,1);
        $pdf->MultiCell( 0, 5, $reportSubtitle2, 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->SetFont('Times','B',11);
        $pdf->MultiCell( 0, 5, $namasiswa, 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->SetFont('Times','',11);
        $pdf->MultiCell( 0, 5, $reportSubtitle3, 0,1);
        $pdf->MultiCell( 0, 5, $reportSubtitle4, 0,1);
        $pdf->MultiCell( 0, 5, $reportSubtitle5, 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->cell(129);
        $pdf->MultiCell( 0, 5, $tandatgn1, 0);
        $pdf->cell(129);
        $pdf->MultiCell( 0, 5, $tandatgn2, 0);
        $pdf->cell(129);
        //$pdf->MultiCell( 0, 5, $tandatgn3, 0);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->MultiCell( 0, 5, '', 0,1);
        $pdf->SetFont('Times','BU',11);
        $pdf->cell(129);
        $pdf->MultiCell( 0, 5, $tandatgn4, 0);

        //footer awal

            $pdf->SetY(-38);

            $pdf->SetFont('Arial','',8);
        //	$pdf->Cell(0,5,'Islamic International School of Al Falah Darussalam',0,1,'C');
        //		$pdf->Cell(0,5,'Al Falah Darussalam Primary School',0,1,'C');
        //		$pdf->SetFont('Arial','I',8);
        //		$pdf->Cell(0,5,'Let\'s go to be Better for Excellent Future',0,1,'C');
        //		$pdf->SetFont('Arial','',8);

        //footer akhir


        $pdf->AddPage();
        $lamp1="LAMPIRAN";
        $lamp2="No Induk: ".$row1->no_induk;
        $lamp3="NAMA: ".$row1->nama_siswa;
        $pdf->MultiCell( 0, 5, '', 0);
        $pdf->Cell( 18, 5, $lamp1,1,1);
        $pdf->MultiCell( 0, 5, '', 0);
        $pdf->SetFont('Times','B',11);
        $pdf->MultiCell( 0, 5, $lamp2, 0);
        $pdf->MultiCell( 0, 5, $lamp3, 0);
        $pdf->MultiCell( 0, 5, '', 0);
        $pdf->MultiCell( 0, 5, '', 0);
        /*
        $pdf->SetFont('Arial','',12);
        $pdf->SetY(38);
        $pdf->SetX(10);
        $pdf->MultiCell(50,6,'Nama Kejadian',1);
        $pdf->SetY(38);
        $pdf->SetX(60);
        $pdf->MultiCell(80,6,'Tanggal Kejadian',1);
        $pdf->SetY(38);
        $pdf->SetX(140);
        $pdf->MultiCell(30,6,'Tipe Kejadian',1,'R');
        $pdf->SetY(38);
        $pdf->SetX(170);
        $pdf->MultiCell(30,6,'Poin ',1,'R');
        */

        $c_nama = "";
        $c_tanggal = "";
        $c_tipe = "";
        $c_poin = "";
        $awal = $h_pertama;
        $total=0;

        $pdf->SetY(44);
        $pdf->SetX(10);
        $pdf->MultiCell(80,6,'Poin Awal : '.$awal,0);
        $pdf->SetY(44);
        $pdf->SetX(90);
        $pdf->MultiCell(50,6,'',0);
        $pdf->SetY(44);
        $pdf->SetX(140);
        $pdf->MultiCell(30,6,'',0,'R');
        $pdf->SetY(44);
        $pdf->SetX(170);
        $pdf->MultiCell(30,6,'',0,'R');
        $pdf->MultiCell( 0, 5, '', 0,1);

        $pdf->SetFont('times','B',10);
        $pdf->SetWidths(array(80, 50, 30, 30));
        //$pdf->SetHeight(0.1);
        $pdf->Row(array("Nama kejadian", "Tanggal", "Tipe", "Poin"));
    
        //For each row, add the field to the corresponding column
        foreach($row2 as $r2){
            $poin2 = $r2->POIN_KEJADIAN;
            $newDate = $this->convertdate($r2->TANGGAL_KEJADIAN);

            if ($r2->TIPE_KEJADIAN=='reward'){
                if($this->session->userdata('fitur_reward') == 1){
                    $pdf->SetFont('times','',10);
                    if($this->session->userdata('operator_bk') == "kurang"){
                        $pdf->Row(array($r2->NAMA_KEJADIAN, $newDate, $r2->TIPE_KEJADIAN, '+'.$poin2));
                        $total = $total+($r2->POIN_KEJADIAN);
                    }
                    if($this->session->userdata('operator_bk') == "tambah"){
                        $pdf->Row(array($r2->NAMA_KEJADIAN, $newDate, $r2->TIPE_KEJADIAN, '-'.$poin2));
                        $total = $total-($r2->POIN_KEJADIAN);
                    }
                }
            } 
                else 
            {
                if($this->session->userdata('operator_bk') == "kurang"){
                    $pdf->SetFont('times','',10);
                    $pdf->Row(array($r2->NAMA_KEJADIAN, $newDate, $r2->TIPE_KEJADIAN, '-'.$poin2));
                    $total = $total-($r2->POIN_KEJADIAN);
                }
                if($this->session->userdata('operator_bk') == "tambah"){
                    $pdf->SetFont('times','',10);
                    $pdf->Row(array($r2->NAMA_KEJADIAN, $newDate, $r2->TIPE_KEJADIAN, '+'.$poin2));
                    $total = $total+($r2->POIN_KEJADIAN);
                }
            }

        }
        $hasilakhir = $awal+$total;
        $pdf->SetFont('Times','B',11);
        $pdf->MultiCell(0, 5, '', 0,1);
        $pdf->MultiCell(30,6,'TOTAL : '.$hasilakhir,0,'L');

        $pdf->Output();

    }
    
    public function convertdate($tanggal){
        $namatanggal=date("d",strtotime($tanggal)); 
        $bulan = date("n",strtotime($tanggal));
        $array_bln = array(1=>"Januari","Februari","Maret", "April", "Mei","Juni","Juli","Agustus","September","Oktober", "November","Desember");
        $namabulan = $array_bln[$bulan];
        $namatahun = date("Y",strtotime($tanggal));
        $namajam = date("H",strtotime($tanggal));
        $namamenit = date("i",strtotime($tanggal));
		return $namatanggal." ".$namabulan." ".$namatahun." ".$namajam.":".$namamenit;
    }

    public function gettodaydate(){
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

}