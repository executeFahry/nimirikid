<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" class="block mt-1 w-full" name="role" required onchange="toggleFields()">
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="kurir" {{ old('role') == 'kurir' ? 'selected' : '' }}>Kurir</option>
                <option value="pelanggan" {{ old('role') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Fields for Kurir and Pelanggan -->
        <div id="kurir-fields" class="mt-4 hidden">
            <!-- No HP for Kurir -->
            <x-input-label for="no_hp_kurir" :value="__('No HP')" />
            <x-text-input id="no_hp_kurir" class="block mt-1 w-full" type="text" name="no_hp_kurir"
                :value="old('no_hp_kurir')" />
            <x-input-error :messages="$errors->get('no_hp_kurir')" class="mt-2" />
            <!-- Area Pengiriman for Kurir -->
            <x-input-label for="area_pengiriman" :value="__('Area Pengiriman')" />
            <x-text-input id="area_pengiriman" class="block mt-1 w-full" type="text" name="area_pengiriman"
                :value="old('area_pengiriman')" />
            <x-input-error :messages="$errors->get('area_pengiriman')" class="mt-2" />
        </div>

        <div id="pelanggan-fields" class="mt-4 hidden">
            <!-- No HP for Pelanggan -->
            <x-input-label for="no_hp_pelanggan" :value="__('No HP')" />
            <x-text-input id="no_hp_pelanggan" class="block mt-1 w-full" type="text" name="no_hp_pelanggan"
                :value="old('no_hp_pelanggan')" />
            <x-input-error :messages="$errors->get('no_hp_pelanggan')" class="mt-2" />
            <!-- Alamat for Pelanggan -->
            <x-input-label for="alamat" :value="__('Alamat')" />
            <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')" />
            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Sudah Punya Akun?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function toggleFields() {
            const role = document.getElementById('role').value;
            if (role === 'kurir') {
                document.getElementById('kurir-fields').classList.remove('hidden');
                document.getElementById('pelanggan-fields').classList.add('hidden');
            } else if (role === 'pelanggan') {
                document.getElementById('pelanggan-fields').classList.remove('hidden');
                document.getElementById('kurir-fields').classList.add('hidden');
            } else {
                document.getElementById('kurir-fields').classList.add('hidden');
                document.getElementById('pelanggan-fields').classList.add('hidden');
            }
        }

        window.onload = function() {
            toggleFields(); // Initialize visibility based on current selection
        }
    </script>
</x-guest-layout>
