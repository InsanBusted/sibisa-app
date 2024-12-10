@extends("admin.layouts.app")

@section("content")

<div class="row">
    <!-- Top Report Start -->
    <div class="col-xlg-3 col-md-6 col-12 mb-30">
        <div class="top-report">

            <!-- Head -->
            <div class="head">
                <h4 class="text-white">Halo {{ Auth::user()->name }}</h4>
                
            </div>

            <!-- Content -->
            <div class="content">
                <p class="mt-1">Saat Ini anda berada di halaman Dashboard SIBISA, Ayo Atur jadwal Bimbingan Agar cepat Wisuda...</p>
            </div>

            <!-- Footer -->
            <div class="footer">
                {{-- <p>92% of unique visitor</p> --}}
            </div>

        </div>
    </div><!-- Top Report End -->
</div>
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
                            <tr>
                                <th class="selector"><label class="adomx-checkbox"><input type="checkbox"> <i class="icon"></i></label></th>
                                <!--<th class="selector h5"><button class="button-check"></button></th>-->
                                <th><span>Image</span></th>
                                <th><span>Product Name</span></th>
                                <th><span>ID</span></th>
                                <th><span>Quantity</span></th>
                                <th><span>Price</span></th>
                                <th><span>Status</span></th>
                                <th><span>Aksi</span></th>
                                <th></th>
                            </tr>
                        </thead><!-- Table Head End -->

                        <!-- Table Body Start -->
                        <tbody>
                            <tr>
                                <td class="selector"><label class="adomx-checkbox"><input type="checkbox"> <i class="icon"></i></label></td>
                                <td><img src="assets/images/product/list-product-1.jpg" alt="" class="table-product-image rounded-circle"></td>
                                <td><a href="#">Microsoft surface pro 4</a></td>
                                <td>#MSP40022</td>
                                <td>05 - Products</td>
                                <td>$60000000.00</td>
                                <td><span class="badge badge-success">Paid</span></td>
                                <td><a class="h3" href="#"><i class="zmdi zmdi-more"></i></a></td>
                            </tr>
                        </tbody><!-- Table Body End -->

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection