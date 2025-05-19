@extends('admin.layouts.app')

@section('content')

<h1 class="text-3xl font-semibold text-gray-800 mb-6">Dashboard</h1>
<p>Welcome to your admin panel! Here you can manage your users and settings.</p>
 <!-- Dashboard Cards -->
                <section class="flex-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <!-- Card 1 -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h2 class="text-lg font-semibold text-gray-700">Total Pengguna</h2>
                        <p class="mt-2 text-3xl font-bold text-blue-600">1,245</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h2 class="text-lg font-semibold text-gray-700">Penjualan Hari Ini</h2>
                        <p class="mt-2 text-3xl font-bold text-green-600">Rp 4.200.000</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h2 class="text-lg font-semibold text-gray-700">Pesanan Baru</h2>
                        <p class="mt-2 text-3xl font-bold text-yellow-600">23</p>
                    </div>

                </section>
@endsection