<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataKeragamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('data_keragamans')->insert([
            [
                'nama' => 'Contoh Stratigraphy 1',
                'foto_keragaman' => 'fotoDataKeragaman/EboyrQ1vSckjxZjuPYqvx2MnbkNer6w91IxspImf.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Air Batu, RT 05 Kab. Merangin',
                'umur' => '150 TH',
                'jenis_keragaman_id' => '2',
            ],
            [
                'nama' => 'Contoh Stratigraphy 2',
                'foto_keragaman' => 'fotoDataKeragaman/PCAgU9MAhWvjI1OLAo2ruYojN1EoiUA90RFCWIZl.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Kalingan, RT 05 Kab. Merangin',
                'umur' => '200 SM',
                'jenis_keragaman_id' => '2',
            ],
            [
                'nama' => 'Contoh Stratigraphy 3',
                'foto_keragaman' => 'fotoDataKeragaman/dOzkcCi895lZOc0pkTdBnlhgfb9iRs9rw2L4sY1V.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Batang Merangin, RT 01 Kab. Merangin',
                'umur' => '50 SM',
                'jenis_keragaman_id' => '2',
            ],
            [
                'nama' => 'Contoh Stratigraphy 4',
                'foto_keragaman' => 'fotoDataKeragaman/OfY7E0VM6j7q1fr6Ru2A4fI8CQxOgMpLGtc8DATA.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '2',
            ],








            [
                'nama' => 'fosil 1',
                'foto_keragaman' => 'fotoDataKeragaman/IQDis8HDwQxalCA4Td4gYgL4w2zHiUSCALUa0NHG.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '3',
            ],
            [
                'nama' => 'fosil 2',
                'foto_keragaman' => 'fotoDataKeragaman/1Kc7CZE3qF4TAawUjEru6MX48wPHji9Y07QSVxL0.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '3',
            ],
            [
                'nama' => 'fosil 3',
                'foto_keragaman' => 'fotoDataKeragaman/DJM6fEb6AZZSULcu8hJaMLR0PJ8CluGlprqRLnao.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '3',
            ],
            [
                'nama' => 'fosil 4',
                'foto_keragaman' => 'fotoDataKeragaman/SGyv5XtBXQiYTIPufFaKq3tBUJddOb4lwBmuHpNj.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '3',
            ],
            [
                'nama' => 'fosil 5',
                'foto_keragaman' => 'fotoDataKeragaman/xFzt9cKb7UQAye1TvxUNS9MaC8srn1ichdE7JUxZ.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '3',
            ],
            [
                'nama' => 'fosil 6',
                'foto_keragaman' => 'fotoDataKeragaman/35DaHKWLQkCO7jtfPBTL3rpuQlCUwp7jZ6ihUm0g.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '3',
            ],






            // kultur
            [
                'nama' => 'Adat Pangkalan Jambu',
                'foto_keragaman' => 'fotoDataKeragaman/XPPLAgVbKwNRa51fg7ub8fd0CQ93HEwlT6xR66K4.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '6',
            ],
            [
                'nama' => 'Erau Budayo',
                'foto_keragaman' => 'fotoDataKeragaman/3uNbKmrvOQxL2xBnBflY8IWacj3IxzRMZYRV86UW.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '6',
            ],
            [
                'nama' => 'Mampeh rumah',
                'foto_keragaman' => 'fotoDataKeragaman/AztNkXNJpET6E4TjgkZlRbGRqfLmcnJdLMXkXKSJ.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '6',
            ],
            [
                'nama' => 'Pameran Art',
                'foto_keragaman' => 'fotoDataKeragaman/fixqdZkuAG6eKBO6EW9zqOgwBSoCTMiqCzplTCGC.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '6',
            ],
            [
                'nama' => 'Tari',
                'foto_keragaman' => 'fotoDataKeragaman/cIh1WUwUtim5WuxiHPsmakOCFoXbaRFn4icKip3b.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '6',
            ],








            [
                'nama' => 'Beruk',
                'foto_keragaman' => 'fotoDataKeragaman/ig8OKW0lkO9RasY6Of1zHKoZQbteR45aeRdMP1sl.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '4',
            ],
            [
                'nama' => 'Rusa',
                'foto_keragaman' => 'fotoDataKeragaman/D88LC1VmcSFfpnwAWdgPANvNROn1FRxf3GyyOsAE.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '4',
            ],
            [
                'nama' => 'Tupai',
                'foto_keragaman' => 'fotoDataKeragaman/lGQvGCPdPTvZYW4L8bK3VQO1gYBRSo8j3zemI8bx.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '4',
            ],
            [
                'nama' => 'Burung',
                'foto_keragaman' => 'fotoDataKeragaman/YqSUUnR1x0fwWU05ofCDjpwVFAYlChc6wXn4nUlv.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '4',
            ],
            [
                'nama' => 'Gajah',
                'foto_keragaman' => 'fotoDataKeragaman/y9GbCK8pYRxajJzvzOqDQkujN8ORptzvwARte2Zd.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '4',
            ],
            [
                'nama' => 'Kera',
                'foto_keragaman' => 'fotoDataKeragaman/GOsMyb0jBSlEXqCrEOGONDEMAlbuDuJri0OkOIBT.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '4',
            ],
            [
                'nama' => 'Bekicot',
                'foto_keragaman' => 'fotoDataKeragaman/rNrURt1GW8ri1dpKmZNP76dkUz459mLrEHWcWJIY.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '4',
            ],
            [
                'nama' => 'Harimau Sumatera',
                'foto_keragaman' => 'fotoDataKeragaman/IYBs1eFnpnsa76orEt9AUkDZGMuy3RXDxJwfdAUf.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '4',
            ],
            [
                'nama' => 'Kalong',
                'foto_keragaman' => 'fotoDataKeragaman/fRQUw2H0eVrH0gFhZC05hlaT9PvG3jB1eKz7VJEP.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '4',
            ],
            [
                'nama' => 'Simpai',
                'foto_keragaman' => 'fotoDataKeragaman/bGufWDuTNOdDuaJfgGy5wfPIm3dhYG0lmLnB20q7.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '4',
            ],
            [
                'nama' => 'Tapir',
                'foto_keragaman' => 'fotoDataKeragaman/BDUOagYOhkV4MHE3Nox4MdqyKlVcyOyItV6z5AQx.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '4',
            ],









            [
                'nama' => 'Air terjun 2',
                'foto_keragaman' => 'fotoDataKeragaman/7rwyMTi0QuWlyfWHM61Qsw1DZqyrqeYgYXedTmTo.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '5',
            ],
            [
                'nama' => 'Air Terjun Segerincing',
                'foto_keragaman' => 'fotoDataKeragaman/HsEDz9urf9YxhZVDoCElkuB96lSHrgR1GdnS1EJa.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '5',
            ],
            [
                'nama' => 'Goa Gajah',
                'foto_keragaman' => 'fotoDataKeragaman/K1W0WATE4bNkzphZSVsuIkfERqiRvOcxJaWZBv7N.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '5',
            ],
            [
                'nama' => 'Hutan Adat Merangin',
                'foto_keragaman' => 'fotoDataKeragaman/aB3vmEzxxVIl8yQ9UQ7dqzZh9Yimr0kSH4inwSUA.png',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '5',
            ],
            [
                'nama' => 'Maya Ball',
                'foto_keragaman' => 'fotoDataKeragaman/RMX9nKdZVt8ZQPKguHfoZokMhloCKS6Rybya8OAm.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '5',
            ],
            [
                'nama' => 'Taman Geopark',
                'foto_keragaman' => 'fotoDataKeragaman/0MmXhfljma1JZRhSoHY8uIVVlqX8Hdkr5XdG6QY2.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '5',
            ],
            [
                'nama' => 'Wisata',
                'foto_keragaman' => 'fotoDataKeragaman/1VMLvbP81iDwnrCu3nivwm0uY39wMBlIehpdnFGJ.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '5',
            ],







            [
                'nama' => 'Kopi',
                'foto_keragaman' => 'fotoDataKeragaman/FTN86tjokeIicOuCiJ4tfBV9QudEULWLaksVIgHG.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '1',
            ],
            [
                'nama' => 'Bulian',
                'foto_keragaman' => 'fotoDataKeragaman/Qmgz9NqJqqtatpX43vbgzvGjgnQZOka4b8b9qfm3.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '1',
            ],
            [
                'nama' => 'Durian',
                'foto_keragaman' => 'fotoDataKeragaman/opiDB7TVUPra1FS6E4uYLMuFaZgAymDUZJgcPbh1.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '1',
            ],
            [
                'nama' => 'Kantong Semar',
                'foto_keragaman' => 'fotoDataKeragaman/wGcFAyvdBzANHy6RoNatFqfwLjEx9Q1I7mAEhEAX.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '1',
            ],
            [
                'nama' => 'Klampero',
                'foto_keragaman' => 'fotoDataKeragaman/fSCBlmk4TpbNO8Vio8nqPcKttiCa5iIvgAgSS31c.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '1',
            ],
            [
                'nama' => 'Mock Oisther Mushroom',
                'foto_keragaman' => 'fotoDataKeragaman/Xp5x37Np8TKFdfyTbE1xUNhzqglNEQsmMI8zghVW.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '1',
            ],
            [
                'nama' => 'Olena Flower',
                'foto_keragaman' => 'fotoDataKeragaman/6DNGDTnMIC8rFenPL0DxCIierw7DFaKXvmfo3sW5.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '1',
            ],
            [
                'nama' => 'Raflesia Arnoldi',
                'foto_keragaman' => 'fotoDataKeragaman/GpmJ1jhsmry0rab0hKCzLcDJDQcorthNheNh8sy6.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '1',
            ],
            [
                'nama' => 'Prosthacea',
                'foto_keragaman' => 'fotoDataKeragaman/d9BeGq3RjrBvaGjrkEytyu2jl95QVXX7eDA6zun9.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '1',
            ],
            [
                'nama' => 'Sialang',
                'foto_keragaman' => 'fotoDataKeragaman/JSAC5KpsA7S7OMJAk7SixXyB7gfvzJWANRwt3PJP.jpg',
                'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'lokasi' => 'Desa Guguk, Kab. Merangin',
                'umur' => '500 SM',
                'jenis_keragaman_id' => '1',
            ],
        ]);
    }
}
