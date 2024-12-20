<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TimTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tims')->insert([
            [
                'nama' => 'Prof. Dr. Helmi, S.H., M.H.',
                'foto' => 'fotoTim/SwYBPX3UFm6F7C9dpN3yrOXZE2bcXSkHdlfl1neb.jpg',
                'divisi_id' => 1,
                'jabatan' => 'Pengarah',
                'bidang_keahlian' => 'Hukum Administrasi Negara, Hukum Lingkungan',
            ],
            [
                'nama' => 'Dr. Ade Octavia, S.E., M.M.',
                'foto' => 'fotoTim/KDMlAPU5hH1sdAkaMv5os1Axa2mIyZGlc4IVfWVY.jpg',
                'divisi_id' => 1,
                'jabatan' => 'Penanggung Jawab',
                'bidang_keahlian' => 'Manajemen Industri',
            ],
            [
                'nama' => 'Dr. Lenny Marlinda, S.T., M.T.',
                'foto' => 'fotoTim/7RZhnlGSFsQkIGfPRW7peQGAU7Q0l0KDJEecvFQu.jpg',
                'divisi_id' => 1,
                'jabatan' => 'Ketua',
                'bidang_keahlian' => 'Teknologi Reaksi Kimia, Teknologi Bioenergi',
            ],
            [
                'nama' => 'D.M. Magdalena Ritonga, S.T., M.T. ',
                'foto' => 'fotoTim/JP1xxtH0jZPxASOnLvv5SswWhXRFHipTUzAcqnAB.jpg',
                'divisi_id' => 1,
                'jabatan' => 'Sekretaris',
                'bidang_keahlian' => 'Geologi, Geofisika, Ilmu Atmosfer, Meterologi dan Klimatologi',
            ],
            [
                'nama' => 'Niken Rarasati, S.Si., M.Si.',
                'foto' => 'fotoTim/fw6VapYWYUyfdII7YcqJTWmXuCt7JNBpS916D8D5.jpg',
                'divisi_id' => 1,
                'jabatan' => 'Bendahara',
                'bidang_keahlian' => 'Matematika Terapan',
            ],
            [
                'nama' => 'Prof. Drs. H. Sutrisno, M.Sc., Ph.D',
                'foto' => 'fotoTim/kYNftvhZ7kWhJPmhhxOwRGSkCoDnxNdFXsQVQUSP.jpg',
                'divisi_id' => 2,
                'jabatan' => 'Koordinator Divisi Bidang Penguatan Kapasitas Kelembagaan',
                'bidang_keahlian' => 'Kimia Analitik',
            ],
            [
                'nama' => 'Benedika Ferdian Hutabarat, S.Kom., M.Kom.',
                'foto' => 'fotoTim/U7WAH158WtDCndQM1pMk0COsmjrsacBmecBstedS.jpg',
                'divisi_id' => 2,
                'jabatan' => 'Anggota Divisi Bidang Penguatan Kapasitas Kelembagaan',
                'bidang_keahlian' => 'Ilmu Komputer',
            ],
            [
                'nama' => 'Hari Wiki Utama, S.T., M.Eng.',
                'foto' => 'fotoTim/c7efEuW9axwyaOWUZsyfk9AoRg10Rv0aftxph2Rk.jpg',
                'divisi_id' => 2,
                'jabatan' => 'Anggota Divisi Bidang Penguatan Kapasitas Kelembagaan',
                'bidang_keahlian' => 'Geologi',
            ],
            [
                'nama' => 'Aditya Denny Prabawa, S.T., M.T.',
                'foto' => 'fotoTim/KGDLtrYzXfmcwBAN1UtOxZTbxxCaIhTS06mCMgea.jpg',
                'divisi_id' => 2,
                'jabatan' => 'Anggota Divisi Bidang Penguatan Kapasitas Kelembagaan',
                'bidang_keahlian' => 'Teknik Sumberdaya Geologi',
            ],
            [
                'nama' => 'Dr. Drs. Jodion Siburian, M.Si.',
                'foto' => 'fotoTim/uQglFGiiK0gpOxLjYAITQTVzM2r3T5qgebmZgGXr.png',
                'divisi_id' => 3,
                'jabatan' => 'Koordinator Divisi Bidang Penguatan Edukasi dan Konservasi',
                'bidang_keahlian' => 'Studi Pengembangan, PPG, Genetika, Zoologi, Studi Kurikulum',
            ],
            [
                'nama' => 'Dawam Suprayogi, S.Pd., M.Sc.',
                'foto' => 'fotoTim/eWY3UMbepAqjCZthtuJjsmo8m7rJmxPcqOPz3lmY.jpg',
                'divisi_id' => 3,
                'jabatan' => 'Anggota Divisi  Bidang Penguatan Edukasi dan Konservasi',
                'bidang_keahlian' => 'Ekologi dan Evolusi, Ekologi Wilayah',
            ],
            [
                'nama' => 'Anggit Prima Nugraha, S.Si., M.Sc.',
                'foto' => 'fotoTim/Ckg1iQrKQWgUAdYUd23qIcgSpw1ZFAV008fkml2G.png',
                'divisi_id' => 3,
                'jabatan' => 'Anggota Divisi  Bidang Penguatan Edukasi dan Konservasi',
                'bidang_keahlian' => 'Zoologi',
            ],
            [
                'nama' => 'Ari Mukti Wardoyo Adi, M.A.',
                'foto' => 'fotoTim/qM59dgZJK1ofgSjf12ub2dM1N5uT8zt6BVeRxytP.jpg',
                'divisi_id' => 3,
                'jabatan' => 'Anggota Divisi  Bidang Penguatan Edukasi dan Konservasi',
                'bidang_keahlian' => 'Arkeologi Lingkungan, Geografi Budaya, Arkeologi Sejarah, Arkeologi Prasejarah',
            ],
            [
                'nama' => 'Ir. Yulia Morsa Said, M.T.',
                'foto' => 'fotoTim/Krh89lAtZOJ09flz2KZ8bNUZrGu4qfoOOUi6Mgdw.jpg',
                'divisi_id' => 4,
                'jabatan' => 'Koordinator Divisi Bidang Pengembangan dan Komersialisasi',
                'bidang_keahlian' => 'Geologi, Geomatika',
            ],
            [
                'nama' => 'Juventa, S.T., M.T.',
                'foto' => 'fotoTim/mVxqeVQdRtP6nIuU2TKujrUCnHgN9IFtbqcfqN7N.jpg',
                'divisi_id' => 4,
                'jabatan' => 'Anggota Divisi Bidang Pengembangan dan Komersialisasi',
                'bidang_keahlian' => 'Geologi, Geofisika, Teknik Sumberdaya Geologi',
            ],
            [
                'nama' => 'Anggi Deliana Siregar., S.T., M.T.',
                'foto' => 'fotoTim/z3oaX16k1TB2KZ5hkeXzTvpFj3IRxXObNKzNsZ53.jpg',
                'divisi_id' => 4,
                'jabatan' => 'Anggota Divisi Bidang Pengembangan dan Komersialisasi',
                'bidang_keahlian' => 'Geologi, Ilmu Atmosfer, Meterologi dan Klimatologi',
            ],
            [
                'nama' => 'Sarwo Sucitra Amin, M.T.',
                'foto' => 'fotoTim/519QC5NnRj6OTVfM4nOMau9BlJ39f9yzWCEna6lN.jpg',
                'divisi_id' => 4,
                'jabatan' => 'Anggota Divisi Bidang Pengembangan dan Komersialisasi',
                'bidang_keahlian' => 'Geologi, Geofisika, Geokimia, Teknik Sumberdaya Geologi',
            ],
        ]);
    }
}
