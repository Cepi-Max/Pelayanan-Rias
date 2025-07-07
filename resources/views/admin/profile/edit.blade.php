@extends('admin.layouts.app')
@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
            <i class="fas fa-user-cog text-blue-500 text-xl mr-3"></i>
            <h1 class="text-2xl font-semibold text-gray-800">Pengaturan Profile</h1>
        </div>
        
        <div class="flex items-center text-sm text-gray-500">
            <i class="fas fa-info-circle mr-2 text-blue-400"></i>
            Kelola informasi akun dan keamanan Anda
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Information Card -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow hover:shadow-md transition-all duration-200 overflow-hidden border-t-4 border-blue-500">
                <div class="p-6">
                    <!-- Header Card -->
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 bg-blue-50 p-3 rounded-lg">
                            <i class="fas fa-user-edit text-blue-500 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold text-gray-800">Informasi Profile</h2>
                            <p class="text-sm text-gray-600">Perbarui informasi profil dan alamat email akun Anda</p>
                        </div>
                    </div>

                    <!-- Form Content -->
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>
        </div>

        <!-- Password Update Card -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow hover:shadow-md transition-all duration-200 overflow-hidden border-t-4 border-green-500">
                <div class="p-6">
                    <!-- Header Card -->
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 bg-green-50 p-3 rounded-lg">
                            <i class="fas fa-lock text-green-500 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold text-gray-800">Ubah Password</h2>
                            <p class="text-sm text-gray-600">Pastikan akun Anda menggunakan password yang kuat dan aman</p>
                        </div>
                    </div>

                    <!-- Form Content -->
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Tips Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-yellow-50 rounded-lg p-6 border-t-4 border-yellow-500">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0 bg-yellow-100 p-2 rounded-full">
                        <i class="fas fa-shield-alt text-yellow-600"></i>
                    </div>
                    <h3 class="ml-3 text-lg font-medium text-yellow-800">Tips Keamanan</h3>
                </div>
                
                <div class="space-y-3 text-sm text-yellow-700">
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-yellow-600 mr-2 mt-1 flex-shrink-0"></i>
                        <span>Gunakan password minimal 8 karakter</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-yellow-600 mr-2 mt-1 flex-shrink-0"></i>
                        <span>Kombinasikan huruf besar, kecil, angka dan simbol</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-yellow-600 mr-2 mt-1 flex-shrink-0"></i>
                        <span>Jangan gunakan informasi pribadi</span>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-yellow-600 mr-2 mt-1 flex-shrink-0"></i>
                        <span>Ubah password secara berkala</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Information Banner -->
    <div class="mt-8 bg-blue-50 rounded-lg p-4 flex items-start">
        <div class="flex-shrink-0 bg-blue-100 p-2 rounded-full">
            <i class="fas fa-lightbulb text-blue-500"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-blue-800">Informasi Penting</h3>
            <p class="text-xs text-blue-600 mt-1">
                Perubahan pada profil akan mempengaruhi tampilan nama di seluruh sistem. 
                Pastikan informasi yang Anda masukkan akurat dan up-to-date.
            </p>
        </div>
    </div>
</div>
@endsection