<div class="content-header">
<h4>Populasi Penduduk</h4><small> Sumber : data.gov.my </small> 
</div>
<br>
<div class="form-group">
    <label>Kepadatan Penduduk</label>
    <select class="form-control" name="list-kepadatan" id="list-kepadatan">
    <option value="">--Pilih Daerah--</option>
    <option value="Gombak">Gombak</option>
    <option value="Sepang">Sepang</option>
    <option value="Sabak Bernam">Sabak Bernam</option>
    <option value="Kuala Selangor">Kuala Selangor</option>
    <option value="Kuala Langat">Kuala Langat</option>
    <option value="Hulu Selangor">Hulu Selangor</option>
    <option value="Petaling">Petaling</option>
    <option value="Hulu Langat">Hulu Langat</option>
    <option value="Klang">Klang</option>
    </select>
</div>
<div id="container-kepadatan" style="width:100%; height:400px;"></div>
<br>
<div class="form-group">
    <label>Taburan Penduduk Bandar dan Luar Bandar (%)</label>    
    <select class="form-control" name="list" id="list">
    <option value="">--Pilih Daerah--</option>
    <option value="Gombak">Gombak</option>
    <option value="Sepang">Sepang</option>
    <option value="Sabak Bernam">Sabak Bernam</option>
    <option value="Kuala Selangor">Kuala Selangor</option>
    <option value="Kuala Langat">Kuala Langat</option>
    <option value="Hulu Selangor">Hulu Selangor</option>
    <option value="Petaling">Petaling</option>
    <option value="Hulu Langat">Hulu Langat</option>
    <option value="Klang">Klang</option>
    </select>
</div>
<div id="container-bandar" style="width:100%; height:400px;"></div>


<script>
            $(document).ready(function() {
                //CHART BANDAR/LUAR BANDAR
                var options = {
	            chart: {
	                renderTo: 'container-bandar',
	                type: 'area',

	            },

	            title: {
	                text: 'Peratusan Taburan Penduduk Bandar vs Luar Bandar Mengikut Daerah',
	                x: -20 //center
	            },
	            subtitle: {
	                text: 'Sumber: data.gov.my',
	                x: -20
	            },
	            xAxis: {
	                categories: []
	            },
                yAxis: {
                        min : 0,
                        max : 100,
                        title: {
                            text: 'Peratus %'
                        },
                        labels: {
                            formatter: function () {
                                return this.value ;
                            }
                        }
                    },
	            tooltip: {
	                formatter: function() {
	                        return '<b>'+ this.series.name +'</b> '+
	                        this.x +': '+ this.y;
	                }
	            },
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            },

	            series: []
            }
            
            getAjaxData("");

            //on changing select option
            $('#list').change(function(){
            var val = $('#list').val();
            getAjaxData(val);
            });

            function getAjaxData(id){

                $.getJSON("<?= base_url('index.php/home/return_population_by_cat/') ?>", {id: id} ,function(json) {
                options.xAxis.categories = json[0]['data'];
                    options.series[0] = json[1];
                    options.series[1] = json[2];
                    
                    chart = new Highcharts.Chart(options);

                    console.log(chart);
                });
            }

            //CHART KEPADATAN
            var options_kepadatan = {
	            chart: {
	                renderTo: 'container-kepadatan',
	                type: 'area',

	            },

	            title: {
	                text: 'Maklumat Kepadatan Penduduk Mengikut Daerah',
	                x: -20 //center
	            },
	            subtitle: {
	                text: 'Sumber: data.gov.my',
	                x: -20
	            },
	            xAxis: {
	                categories: []
	            },
                yAxis: {
                        title: {
                            text: 'Ratus Ribu (\'000)'
                        },
                        labels: {
                            formatter: function () {
                                return this.value ;
                            }
                        }
                    },
	            tooltip: {
	                formatter: function() {
	                        return '<b>'+ this.series.name +'</b> '+
	                        this.x +': '+ this.y;
	                }
	            },
	            legend: {
	                layout: 'vertical',
	                align: 'right',
	                verticalAlign: 'top',
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            },

	            series: []
            }
            
            getAjaxData_kepadatan("");

            //on changing select option
            $('#list-kepadatan').change(function(){
            var val = $('#list-kepadatan').val();
            getAjaxData_kepadatan(val);
            });

            function getAjaxData_kepadatan(id){

                $.getJSON("<?= base_url('index.php/home/return_kepadatan_by_year/') ?>", {id: id} ,function(json) {
                    options_kepadatan.xAxis.categories = json[0]['data'];
                    options_kepadatan.series[0] = json[1];
                    
                    chart = new Highcharts.Chart(options_kepadatan);

                    console.log(chart);
                });
            }
        });
    </script>

