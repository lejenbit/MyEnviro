<div class="content-header">
<h4>Kawasan Risiko Banjir</h4><small> Sumber : data.gov.my (Laporan Status Tahun 2017 Isu Banjir Kilat)</small> 
</div>


<br>
<div class="well well-sm">
      <ul>
      <li>Keutamaan 0 - Risiko yang telah diatasi</li> 
      <li>Keutamaan 1 - Kekerapan banjir kilat melebihi 5 kali setahun</li> 
      <li>Keutamaan 2 - Kekerapan banjir kilat 2 - 4 kali setahun</li> 
      <li>Keutamaan 3 - Kekerapan banjir kilat 1 kali setahun</li> 
      
</ul>
 </div>
<br>
<div class="table-responsive">
    <table class="table" data-sort="table">
      <thead>
        <tr>
          <th class="header">Bandar</th>
          <th class="header">Lokasi</th>
          <th class="header">Catatan</th>
          <th class="header headerSortUp">Keutamaan</th>
        </tr>
      </thead>
      <tbody>
        
        <?php $i = 0; foreach($banjir as $b) : ?>
        <tr class="
        <?php
            if($b->keutamaan == 1){
                echo 'bg-danger';
            } 
          //   if($b->keutamaan == 2){
          //     echo 'bg-success';
          // } 
        ?>
        ">
          <td><?= $b->bandar ?></td>
          <td><?= $b->lokasi ?></td>
          <td><?= $b->catatan ?></td>
          <?php 
          if($b->keutamaan == 0){
            $tooltip = 'Risiko yang telah diatasi';
          } else if($b->keutamaan == 1){
            $tooltip = 'Kekerapan banjir kilat melebihi 5 kali setahun';
          } else if($b->keutamaan == 2){
            $tooltip = 'Kekerapan banjir kilat 2 - 4 kali setahun';
          } else if($b->keutamaan == 3){
            $tooltip = 'Kekerapan banjir kilat 1 kali setahun';
          }
            
          ?>
          <td data-toggle="tooltip" title="<?= $tooltip ?>"><?= $b->keutamaan ?></td>
        </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
  </div>