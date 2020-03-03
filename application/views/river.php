<div class="content-header">
<h4>Kualiti Sungai</h4><small> Sumber : data.gov.my </small> 
</div>

<br>
<div class="well well-sm">
      <ul>

      <li>Kelas 1 (Dalam keadaan semulajadi),</li> 
      <li>Kelas 2A (Air memerlukan rawatan konvensional),</li> 
      <li>Kelas 2B (Air boleh digunakan untuk rekreasi),</li> 
      <li>Kelas 3 (Air memerlukan rawatan intensif),</li> 
      <li>Kelas 4 (Hanya untuk tujuan pengairan)</li> 
      <li>Kelas 5 (Air yang tercemar teruk)</li> 
</ul>
 </div>
<br>
<div class="table-responsive">
    <table class="table" data-sort="table">
      <thead>
        <tr>
          <th class="header">#</th>
          <th class="header">Sungai</th>
          <th class="header">Bilangan Stesen Pengawasan</th>
          <th class="header">Indeks Kualiti Air</th>
          <!-- <th class="header">Kategori</th> -->
          <th class="header headerSortDown">Kelas</th>
        </tr>
      </thead>
      <tbody>
        
        <?php $i = 0; foreach($sungai as $s) : ?>
        <tr class="
        <?php
            if($s->class == 4){
                echo 'bg-orange';
            } 
            if($s->class == 5){
              echo 'bg-danger';
          } 
        ?>
        ">
          <td><?= ++$i ?></td>
          <td><?= $s->river ?></td>
          <td><?= $s->no_station ?></td>
          <td><?= $s->wqi ?></td>
          <!-- <td><?= $s->cat ?></td> -->
          <td><?= $s->class ?></td>
        </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
  </div>