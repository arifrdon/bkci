<?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=bk_laporan_siswa.xls");
?>
                            <table border='1' width="100%">
                <thead>
                <tr>
                    <th class="text-center"> No</th>
                    <th class="text-center"> No Induk</th>
                    <th  class="text-center"> Nama</th>
                    <th  class="text-center"> Nama Kejadian</th>
                    <th  class="text-center"> Poin</th>
                    <th class="text-center"> Tanggal Kejadian</th>
                    <th class="text-center"> Kelas</th>
                    <th class="text-center"> Tipe Kejadian</th>
                    
                </tr>
                </thead>
                <tbody>
                <?php
                  $i = 1;
                  foreach($laporan as $lap){
                ?>
                <tr class="">
                    <td><?php echo $i ?></td>
                    <td><?php  echo $lap->NO_INDUK ?></td>
                    <td><?php  echo $lap->nama_siswa ?></td>
                    <td><?php  echo $lap->NAMA_KEJADIAN ?></td>
                    <td><?php  echo $lap->POIN_KEJADIAN ?></td>
                    <td><?php  echo $lap->TANGGAL_KEJADIAN ?></td>
                    <td><?php  echo $lap->nama_kelas ?></td>
                    <td><?php  echo $lap->TIPE_KEJADIAN ?></td>

                </tr>
                
                <?php 
                   $i++; 
                    } 
                ?>
                
                                
                
                
                </tbody>
            </table>
                            