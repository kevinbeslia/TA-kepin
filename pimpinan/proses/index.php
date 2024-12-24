<!DOCTYPE html>
<?php
include '../../config/koneksi.php';
include("style/header.php");
include("style/sidebar.php");
$idp = $_GET['idp'];

$sql = mysqli_query($konek, "SELECT * FROM tbl_hasil a LEFT JOIN tbl_alternatif b ON a.id_alternatif=b.id_alternatif WHERE a.id_periode = '$idp'");
$alternatif = array();
$nilai = array();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Chart</title>
    <script type="text/javascript" src="../../assets/vendor/chart.js/Chart.js"></script>
</head>

<body>
    <div class="wrapper">
        <section class="content-wrapper">
            <div class="container-fluid">
                <div class="row" style="justify-content: center;">
                    <div class="col-md-6">
                        <!-- Basic Card Example -->
                        <div class="card shadow mt-3 mb-3">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-olive">Grafik Hasil Kelayakan</h6>
                            </div>

                            <div class="card-body">
                                <div class="chart" style="align-self: center;">
                                    <canvas id="myChart" style=" height: 380px; width: 800px;"></canvas>
                                </div>
                            </div>

                            <script>
                                var ctx = document.getElementById("myChart").getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'pie',
                                    data: {
                                        labels: ["Diterima", "Ditolak"],
                                        datasets: [{
                                            label: '',
                                            data: [
                                                <?php
                                                $jumlah_diterima = mysqli_query($konek, "SELECT * FROM tbl_hasil a LEFT JOIN tbl_alternatif b ON a.id_alternatif=b.id_alternatif WHERE a.id_periode = '$idp' AND a.hasil > 0.64");
                                                echo mysqli_num_rows($jumlah_diterima);
                                                ?>,
                                                <?php
                                                $jumlah_ditolak = mysqli_query($konek, "SELECT * FROM tbl_hasil a LEFT JOIN tbl_alternatif b ON a.id_alternatif=b.id_alternatif  WHERE a.id_periode = '$idp' AND a.hasil <= 0.64");
                                                echo mysqli_num_rows($jumlah_ditolak);
                                                ?>
                                            ],
                                            backgroundColor: [
                                                'rgba(3, 111, 252, 1.0)',
                                                'rgba(255, 0, 0, 1)'
                                            ],
                                            borderColor: [
                                                'rgba(255,215,0,1)',
                                                'rgba(255,215,0, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {

                                    }
                                });
                            </script>


                        </div>
                    </div>

                </div>
            </div>
    </div>
    </section>

    <section class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- Basic Card Example -->
                    <div class="card shadow mt-3 mb-3">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-olive">Grafik Hasil Nilai Preferensi</h6>
                        </div>

                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart"></canvas>
                            </div>
                        </div>

                        <script>
                            var ctx = document.getElementById("barChart");
                            var data_nilai = [<?php while ($row = mysqli_fetch_array($sql)) {
                                                    echo '"' . $row['hasil'] . '",';
                                                } ?>];
                            var data_alternatif = [<?php mysqli_data_seek($sql, 0);
                                                    while ($row = mysqli_fetch_array($sql)) {
                                                        echo '"' . $row['nama'] . '",';
                                                    } ?>];
                            var barChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: data_alternatif,
                                    datasets: [{
                                        label: 'Hasil',
                                        data: data_nilai,
                                        backgroundColor: '#529dff',
                                        borderColor: '#355E3B',
                                        borderWidth: 3
                                    }]
                                },
                                options: {
                                    legend: {
                                        display: false
                                    },
                                    barValueSpacing: 10,
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                min: 0,
                                            }
                                        }],
                                        xAxes: [{
                                            gridLines: {
                                                color: "rgba(0,0,0,0)",
                                            }
                                        }]
                                    }
                                }

                            });
                        </script>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Basic Card Example -->
                    <div class="card shadow mt-3 mb-3">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-olive">Grafik Penilaian</h6>
                        </div>

                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart1"></canvas>
                            </div>
                        </div>
                        <?php

                        include('../../config/koneksi.php');
                        $no = 1;
                        $query = mysqli_query($konek, "SELECT DISTINCT * FROM tbl_penilaian a JOIN tbl_alternatif b ON a.id_alternatif = b.id_alternatif WHERE a.id_periode = '$idp' GROUP BY a.id_alternatif");

                        $kriteria_vis = $konek->query("SELECT * FROM tbl_kriteria WHERE id_periode = $idp");
                        $data_array = [];
                        $id = [];
                        if ($kriteria_vis->num_rows > 0) {
                            while ($row = $kriteria_vis->fetch_assoc()) {
                                $data_array[] = $row;
                            }
                        }
                        foreach ($data_array as $dataArray) {
                            $id[] = $data_array[0]['id_kriteria'];
                        }
                        ?>
                        <script>
                            var data_alternatif1 = [<?php mysqli_data_seek($query, 0);
                                                    while ($row = mysqli_fetch_array($query)) {
                                                        echo '"' . $row['nama'] . '",';
                                                    } ?>]
                            var c1 = [
                                <?php

                                $query2 = $konek->query("SELECT * FROM tbl_penilaian a JOIN tbl_subkriteria b ON a.id_subkriteria = b.id_subkriteria WHERE a.id_periode = '$idp' AND b.id_kriteria = $id[0] order by a.id_alternatif ASC");
                                while ($rowq2 = $query2->fetch_array()) {
                                    echo '"' . $rowq2['nbobot'] . '",';
                                }

                                ?>
                            ];
                            var c2 = [
                                <?php

                                $query2 = $konek->query("SELECT * FROM tbl_penilaian a JOIN tbl_subkriteria b ON a.id_subkriteria = b.id_subkriteria WHERE a.id_periode = '$idp' AND b.id_kriteria = $id[1] order by a.id_alternatif ASC");
                                while ($rowq2 = $query2->fetch_array()) {
                                    echo '"' . $rowq2['nbobot'] . '",';
                                }

                                ?>
                            ];
                            var c3 = [
                                <?php

                                $query2 = $konek->query("SELECT * FROM tbl_penilaian a JOIN tbl_subkriteria b ON a.id_subkriteria = b.id_subkriteria WHERE a.id_periode = '$idp' AND b.id_kriteria = $id[2] order by a.id_alternatif ASC");
                                while ($rowq2 = $query2->fetch_array()) {
                                    echo '"' . $rowq2['nbobot'] . '",';
                                }

                                ?>
                            ];
                            var c4 = [
                                <?php

                                $query2 = $konek->query("SELECT * FROM tbl_penilaian a JOIN tbl_subkriteria b ON a.id_subkriteria = b.id_subkriteria WHERE a.id_periode = '$idp' AND b.id_kriteria = $id[3] order by a.id_alternatif ASC");
                                while ($rowq2 = $query2->fetch_array()) {
                                    echo '"' . $rowq2['nbobot'] . '",';
                                }

                                ?>
                            ];
                            var c5 = [
                                <?php

                                $query2 = $konek->query("SELECT * FROM tbl_penilaian a JOIN tbl_subkriteria b ON a.id_subkriteria = b.id_subkriteria WHERE a.id_periode = '$idp' AND b.id_kriteria = $id[4] order by a.id_alternatif ASC");
                                while ($rowq2 = $query2->fetch_array()) {
                                    echo '"' . $rowq2['nbobot'] . '",';
                                }

                                ?>
                            ];

                            var ctx = document.getElementById("barChart1").getContext('2d');
                            var barChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: data_alternatif1,
                                    datasets: [{
                                            label: '<?= $data_array[0]['nama_kriteria'] ?>',
                                            backgroundColor: 'rgba(1, 4, 74 )',
                                            borderColor: '#355E3B',
                                            hoverBackgroundColor: 'rgba(1, 4, 74 )',
                                            hoverBorderColor: 'rgba(0, 100, 0, 1 )',
                                            data: c1
                                        },
                                        {
                                            label: '<?= $data_array[1]['nama_kriteria'] ?>',
                                            backgroundColor: 'rgba(33, 158, 188)',
                                            borderColor: 'rgba(200, 200, 200, 0.75)',
                                            hoverBackgroundColor: 'rgba(33, 158, 188)',
                                            hoverBorderColor: 'rgba(0, 128, 0, 1)',
                                            data: c2
                                        },
                                        {
                                            label: '<?= $data_array[2]['nama_kriteria'] ?>',
                                            backgroundColor: 'rgba(142, 202, 230)',
                                            borderColor: 'rgba(200, 200, 200, 0.75)',
                                            hoverBackgroundColor: 'rgba(142, 202, 230)',
                                            hoverBorderColor: 'rgba(50, 205, 50, 1)',
                                            data: c3
                                        },
                                        {
                                            label: '<?= $data_array[3]['nama_kriteria'] ?>',
                                            backgroundColor: 'rgba(255, 189, 105)',
                                            borderColor: 'rgba(200, 200, 200, 0.75)',
                                            hoverBackgroundColor: 'rgba(255, 189, 105)',
                                            hoverBorderColor: 'rgba(124, 252, 0, 1)',
                                            data: c4
                                        },
                                        {
                                            label: '<?= $data_array[4]['nama_kriteria'] ?>',
                                            backgroundColor: 'rgba(255, 99, 99)',
                                            borderColor: 'rgba(200, 200, 200, 0.75)',
                                            hoverBackgroundColor: 'rgba(255, 99, 99)',
                                            hoverBorderColor: 'rgba(0, 250, 154, 1)',
                                            data: c5
                                        }
                                    ]
                                },
                                options: {
                                    responsive: true,
                                    interaction: {
                                        intersect: false,
                                    },
                                    legend: {
                                        display: true
                                    },
                                    barValueSpacing: 20,
                                    scales: {
                                        xAxes: [{
                                            stacked: true
                                        }],
                                        yAxes: [{
                                            stacked: true
                                        }]
                                    }
                                }

                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    </div>
</body>

</html>

<?php
include('style/footer.php');
?>