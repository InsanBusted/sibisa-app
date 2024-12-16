<div class="row">
    <div class="col-12 mb-30">
        <div class="box">
            <div class="box-head">
                <h4 class="title">Jadwal Bimbingan</h4>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-vertical-middle table-selectable">

                        <!-- Table Head Start -->
                        <thead>
                            <tr class="text-white">
                                <th>No</th>
                                <!--<th class="selector h5"><button class="button-check"></button></th>-->
                                <th><span>Tanggal</span></th>
                                <th><span>Jam</span></th>
                                <th><span>Dosen Pembimbing</span></th>
                                <th><span>Status</span></th>
                                <th><span>Aksi</span></th>
                                <th></th>
                            </tr>
                        </thead><!-- Table Head End -->

                        <!-- Table Body Start -->
                        <tbody>
                            <tr class="text-white">
                                <td>1</td>
                                <td>{{ date('Y-m-d') }}</td>
                                <td>{{ now()->format('H:i') }}</td>
                                <td>Ahmad Rio</td>
                                <td><span class="badge badge-success">Disetujui</span></td>
                                <td>
                                    <button class="button button-success"><span>Edit</span></button>
                                    <button class="button button-danger"><span>Delete</span></button>
                                </td>
                            </tr>
                        </tbody><!-- Table Body End -->

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>