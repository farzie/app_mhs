<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LoginAkunMhsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Logika pembuatan akun: email adalah nama depan (lower) + @student.uns.ac.id
            ['nim' => 'K3523001', 'nama' => '\'AZZAM TSABITUL JAMIL', 'akun' => 'azzam@student.uns.ac.id'],
            ['nim' => 'K3523002', 'nama' => 'ADELLA PUTRI AYU', 'akun' => 'adella@student.uns.ac.id'],
            ['nim' => 'K3523003', 'nama' => 'ADIK ANUGRAHING GUSTI', 'akun' => 'adik@student.uns.ac.id'],
            ['nim' => 'K3523004', 'nama' => 'ADITYA SHEVA PRATAMA', 'akun' => 'aditya@student.uns.ac.id'],
            ['nim' => 'K3523005', 'nama' => 'AFIF NUR AZAM', 'akun' => 'afif@student.uns.ac.id'],
            ['nim' => 'K3523006', 'nama' => 'AHMAD BADAWI AL DALDIRI', 'akun' => 'ahmad@student.uns.ac.id'],
            ['nim' => 'K3523007', 'nama' => 'AISYAH FATIMATUZ ZAHRO', 'akun' => 'aisyah@student.uns.ac.id'],
            ['nim' => 'K3523008', 'nama' => 'ALBERT INDRA WIGUNA', 'akun' => 'albert@student.uns.ac.id'],
            ['nim' => 'K3523009', 'nama' => 'ALFIA NUR IHSANI', 'akun' => 'alfia@student.uns.ac.id'],
            ['nim' => 'K3523010', 'nama' => 'ALIFIAN SULTAN BASUNDARA', 'akun' => 'alifian@student.uns.ac.id'],
            ['nim' => 'K3523011', 'nama' => 'ANANDA OLGA KAWISWARA', 'akun' => 'ananda@student.uns.ac.id'],
            ['nim' => 'K3523012', 'nama' => 'ANDIEN AMALIA FITRI', 'akun' => 'andien@student.uns.ac.id'],
            ['nim' => 'K3523013', 'nama' => 'ANGGERTHA NURROSYID', 'akun' => 'anggertha@student.uns.ac.id'],
            ['nim' => 'K3523014', 'nama' => 'ANNISA INTAN SOFIYANTI', 'akun' => 'annisa@student.uns.ac.id'],
            ['nim' => 'K3523015', 'nama' => 'ANWAR SAIPUL ROHMI', 'akun' => 'anwar@student.uns.ac.id'],
            ['nim' => 'K3523016', 'nama' => 'ARDHIAN PURNOMO', 'akun' => 'ardhian@student.uns.ac.id'],
            ['nim' => 'K3523017', 'nama' => 'ARDIKA MUHAMMAD ISYAQ RAMADAN', 'akun' => 'ardika@student.uns.ac.id'],
            ['nim' => 'K3523018', 'nama' => 'ARDITA PUTRI CAHYANIA', 'akun' => 'ardita@student.uns.ac.id'],
            ['nim' => 'K3523019', 'nama' => 'ARINA AL HAQ', 'akun' => 'arina@student.uns.ac.id'],
            ['nim' => 'K3523020', 'nama' => 'ASQI SYAHRUL ANWAR', 'akun' => 'asqi@student.uns.ac.id'],
            ['nim' => 'K3523021', 'nama' => 'ASSHYARI INTAN PERMATA NINGRUM', 'akun' => 'asshyari@student.uns.ac.id'],
            ['nim' => 'K3523022', 'nama' => 'BAGUS SATYO NUGROHO', 'akun' => 'bagus@student.uns.ac.id'],
            ['nim' => 'K3523023', 'nama' => 'CONAN ZULKARNAIN', 'akun' => 'conan@student.uns.ac.id'],
            ['nim' => 'K3523024', 'nama' => 'DIANA NOVITASARI', 'akun' => 'diana@student.uns.ac.id'],
            ['nim' => 'K3523025', 'nama' => 'DYAH GALIH ANANIAS', 'akun' => 'dyah@student.uns.ac.id'],
            ['nim' => 'K3523026', 'nama' => 'FADHIL AULIA RAHMAN', 'akun' => 'fadhil@student.uns.ac.id'],
            ['nim' => 'K3523027', 'nama' => 'FAJAR SIDIQ TRI UTOMO', 'akun' => 'fajar@student.uns.ac.id'],
            ['nim' => 'K3523028', 'nama' => 'FAKHRU RIFQI MA\'ARIF', 'akun' => 'fakhru@student.uns.ac.id'],
            ['nim' => 'K3523029', 'nama' => 'FATHIIKA ARUM MAULIDA', 'akun' => 'fathiika@student.uns.ac.id'],
            ['nim' => 'K3523030', 'nama' => 'FATIRA SILVI', 'akun' => 'fatira@student.uns.ac.id'],
            ['nim' => 'K3523031', 'nama' => 'FAUZAN AHMAD CIPTAWAN', 'akun' => 'fauzan@student.uns.ac.id'],
            ['nim' => 'K3523032', 'nama' => 'FEBRIANI DWI PUTRI NUR ROHMAH', 'akun' => 'febriani@student.uns.ac.id'],
            ['nim' => 'K3523033', 'nama' => 'GLIDSI ISNAYNI NOVGIRL UMMAEROH', 'akun' => 'glidsi@student.uns.ac.id'],
            ['nim' => 'K3523034', 'nama' => 'GUSTAMA DILLO BESHIETO', 'akun' => 'gustama@student.uns.ac.id'],
            ['nim' => 'K3523035', 'nama' => 'HENDRA ADELIA HARYONO', 'akun' => 'hendra@student.uns.ac.id'],
            ['nim' => 'K3523036', 'nama' => 'HIFZHEDINE ZAHARES SAMTO', 'akun' => 'hifzhedine@student.uns.ac.id'],
            ['nim' => 'K3523037', 'nama' => 'ILHAM MUHAMMAD HAKIEM', 'akun' => 'ilham@student.uns.ac.id'],
            ['nim' => 'K3523038', 'nama' => 'ISA AULIA ALMADANI', 'akun' => 'isa@student.uns.ac.id'],
            ['nim' => 'K3523039', 'nama' => 'JULIUS ADHIATMA WIRA SULISTYO', 'akun' => 'julius@student.uns.ac.id'],
            ['nim' => 'K3523040', 'nama' => 'KHOIRUNNISA\'', 'akun' => 'khoirunnisa@student.uns.ac.id'],
            ['nim' => 'K3523041', 'nama' => 'LUCIA SHERINA NATALIA KRISTIANTI', 'akun' => 'lucia@student.uns.ac.id'],
            ['nim' => 'K3523042', 'nama' => 'LUTHFI HAPSARI', 'akun' => 'luthfi@student.uns.ac.id'],
            ['nim' => 'K3523043', 'nama' => 'M HAIDAR ARRAFI MAULANA SUYONO', 'akun' => 'm@student.uns.ac.id'], // Menggunakan nama depan yang sudah disederhanakan
            ['nim' => 'K3523044', 'nama' => 'MIKAEL FIRDAUS', 'akun' => 'mikael@student.uns.ac.id'],
            ['nim' => 'K3523045', 'nama' => 'MOHAMMAD HATIF SABIRI', 'akun' => 'mohammad@student.uns.ac.id'],
            // Kasus khusus
            ['nim' => 'K3523046', 'nama' => 'MUHAMMAD ABDUL AZIZ AL-AMIRI', 'akun' => 'aziz@student.uns.ac.id'],
            ['nim' => 'K3523047', 'nama' => 'MUHAMMAD FAHRY ALI', 'akun' => 'fahry@student.uns.ac.id'],
            ['nim' => 'K3523048', 'nama' => 'MUHAMMAD FATIHUL IHSAN', 'akun' => 'ihsan@student.uns.ac.id'],
            ['nim' => 'K3523049', 'nama' => 'MUHAMMAD IRFAN DWI PUTRA', 'akun' => 'irfan@student.uns.ac.id'],
            ['nim' => 'K3523050', 'nama' => 'MUHAMMAD RIZAL ALFARISYI', 'akun' => 'rizal@student.uns.ac.id'],
            ['nim' => 'K3523051', 'nama' => 'MUHAMMAD TAUFIKHURROHMAN ALI', 'akun' => 'taufikhurrohman@student.uns.ac.id'],
            // Lanjutan
            ['nim' => 'K3523052', 'nama' => 'NABIL SIRAJUDDIN FATH', 'akun' => 'nabil@student.uns.ac.id'],
            ['nim' => 'K3523053', 'nama' => 'NABILA OKTAVIANI', 'akun' => 'nabila@student.uns.ac.id'],
            ['nim' => 'K3523054', 'nama' => 'NABILLA KAYLA TSANI PUTRI', 'akun' => 'nabilla@student.uns.ac.id'],
            ['nim' => 'K3523055', 'nama' => 'NAJELA NAJWA ANJANI', 'akun' => 'najela@student.uns.ac.id'],
            ['nim' => 'K3523056', 'nama' => 'NANDA AGUNG PRATAMA', 'akun' => 'nanda@student.uns.ac.id'],
            ['nim' => 'K3523057', 'nama' => 'NEONARDO VIERRO', 'akun' => 'neonardo@student.uns.ac.id'],
            ['nim' => 'K3523058', 'nama' => 'NIZMA NABILA SHAFA SUSILO', 'akun' => 'nizma@student.uns.ac.id'],
            ['nim' => 'K3523059', 'nama' => 'RACHMAT AHZADEL', 'akun' => 'rachmat@student.uns.ac.id'],
            ['nim' => 'K3523060', 'nama' => 'RAHAYU ERIYANA', 'akun' => 'rahayu@student.uns.ac.id'],
            ['nim' => 'K3523062', 'nama' => 'RAYHAN ROSYAD', 'akun' => 'rayhan@student.uns.ac.id'],
            ['nim' => 'K3523063', 'nama' => 'REZA AHMAD FAHRURI', 'akun' => 'reza@student.uns.ac.id'],
            ['nim' => 'K3523064', 'nama' => 'RICHARD GILBERT', 'akun' => 'richard@student.uns.ac.id'],
            ['nim' => 'K3523065', 'nama' => 'RIDHWAN HAFIZH ALHADY', 'akun' => 'ridhwan@student.uns.ac.id'],
            ['nim' => 'K3523066', 'nama' => 'RIDWAN HAKIM MASHADI', 'akun' => 'ridwan@student.uns.ac.id'],
            ['nim' => 'K3523067', 'nama' => 'RIFALDY ILHAM NASRULLOH', 'akun' => 'rifaldy@student.uns.ac.id'],
            ['nim' => 'K3523068', 'nama' => 'RIFDAH HANUN ALFIYAH', 'akun' => 'rifdah@student.uns.ac.id'],
            ['nim' => 'K3523069', 'nama' => 'ROSYID HANAFITRI UTOMO', 'akun' => 'rosyid@student.uns.ac.id'],
            ['nim' => 'K3523070', 'nama' => 'SINDY EKA FATMAWATI', 'akun' => 'sindy@student.uns.ac.id'],
            ['nim' => 'K3523071', 'nama' => 'USMAN HASSAN ADAMU', 'akun' => 'usman@student.uns.ac.id'],
            ['nim' => 'K3523072', 'nama' => 'VANESHA BETHA LAKSANA', 'akun' => 'vanesha@student.uns.ac.id'],
            ['nim' => 'K3523073', 'nama' => 'VAREL EVAN HERIYAWAN', 'akun' => 'varel@student.uns.ac.id'],
            ['nim' => 'K3523074', 'nama' => 'VIDYA AYU NOVITA SARI', 'akun' => 'vidya@student.uns.ac.id'],
            ['nim' => 'K3523075', 'nama' => 'WIDHI SRI BHAWONO', 'akun' => 'widhi@student.uns.ac.id'],
            ['nim' => 'K3523076', 'nama' => 'WIJAYANING DEWI RAMADHANI', 'akun' => 'wijayaning@student.uns.ac.id'],
            ['nim' => 'K3523077', 'nama' => 'YATIN HARSU WINARTI', 'akun' => 'yatin@student.uns.ac.id'],
            ['nim' => 'K3523078', 'nama' => 'YUSUP C DERMAWAN', 'akun' => 'yusup@student.uns.ac.id'],
            ['nim' => 'K3523079', 'nama' => 'ZANJABIELA ADIL PERKASA', 'akun' => 'zanjabiela@student.uns.ac.id'],
            ['nim' => 'K3523080', 'nama' => 'JHON CRISWANDO SITUMORANG', 'akun' => 'jhon@student.uns.ac.id'],
            ['nim' => 'K3523081', 'nama' => 'MOHAMAD ANDIKA JUNIARTA SAPUTRA', 'akun' => 'mohamad@student.uns.ac.id'],
            ['nim' => 'K3523082', 'nama' => 'RATNA ANATA SARI', 'akun' => 'ratna@student.uns.ac.id'],
            ['nim' => 'K3523083', 'nama' => 'YUSHA\'U ABDULHAMID', 'akun' => 'yushau@student.uns.ac.id'],
        ];

        $now = Carbon::now();
        $records = [];

        foreach ($data as $item) {
            $records[] = [
                'nim' => $item['nim'],
                'nama' => $item['nama'],
                'akun' => $item['akun'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('login_akun_mhs')->insert($records);
    }
}