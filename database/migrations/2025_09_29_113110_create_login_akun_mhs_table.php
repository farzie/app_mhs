<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('login_akun_mhs', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 15)->unique();
            $table->string('nama', 150);
            $table->string('akun', 100)->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('login_akun_mhs');
    }
};

/*
INSERT INTO login_akun_mhs (nim, nama, akun, created_at, updated_at) VALUES

('K3523001', UPPER('\'Azzam Tsabitul Jamil'), CONCAT(LOWER(SUBSTRING_INDEX('Azzam Tsabitul Jamil', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523002', UPPER('Adella putri ayu'), CONCAT(LOWER(SUBSTRING_INDEX('Adella putri ayu', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523003', UPPER('Adik Anugrahing Gusti'), CONCAT(LOWER(SUBSTRING_INDEX('Adik Anugrahing Gusti', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523004', UPPER('Aditya Sheva Pratama'), CONCAT(LOWER(SUBSTRING_INDEX('Aditya Sheva Pratama', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523005', UPPER('AFIF NUR AZAM'), CONCAT(LOWER(SUBSTRING_INDEX('AFIF NUR AZAM', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523006', UPPER('AHMAD BADAWI AL DALDIRI'), CONCAT(LOWER(SUBSTRING_INDEX('AHMAD BADAWI AL DALDIRI', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523007', UPPER('AISYAH FATIMATUZ ZAHRO'), CONCAT(LOWER(SUBSTRING_INDEX('AISYAH FATIMATUZ ZAHRO', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523008', UPPER('Albert Indra Wiguna'), CONCAT(LOWER(SUBSTRING_INDEX('Albert Indra Wiguna', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523009', UPPER('ALFIA NUR IHSANI'), CONCAT(LOWER(SUBSTRING_INDEX('ALFIA NUR IHSANI', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523010', UPPER('Alifian Sultan Basundara'), CONCAT(LOWER(SUBSTRING_INDEX('Alifian Sultan Basundara', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523011', UPPER('ANANDA OLGA KAWISWARA'), CONCAT(LOWER(SUBSTRING_INDEX('ANANDA OLGA KAWISWARA', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523012', UPPER('ANDIEN AMALIA FITRI'), CONCAT(LOWER(SUBSTRING_INDEX('ANDIEN AMALIA FITRI', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523013', UPPER('ANGGERTHA NURROSYID'), CONCAT(LOWER(SUBSTRING_INDEX('ANGGERTHA NURROSYID', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523014', UPPER('ANNISA INTAN SOFIYANTI'), CONCAT(LOWER(SUBSTRING_INDEX('ANNISA INTAN SOFIYANTI', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523015', UPPER('ANWAR SAIPUL ROHMI'), CONCAT(LOWER(SUBSTRING_INDEX('ANWAR SAIPUL ROHMI', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523016', UPPER('Ardhian Purnomo'), CONCAT(LOWER(SUBSTRING_INDEX('Ardhian Purnomo', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523017', UPPER('Ardika Muhammad Isyaq Ramadan'), CONCAT(LOWER(SUBSTRING_INDEX('Ardika Muhammad Isyaq Ramadan', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523018', UPPER('Ardita Putri Cahyania'), CONCAT(LOWER(SUBSTRING_INDEX('Ardita Putri Cahyania', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523019', UPPER('ARINA AL HAQ'), CONCAT(LOWER(SUBSTRING_INDEX('ARINA AL HAQ', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523020', UPPER('Asqi Syahrul Anwar'), CONCAT(LOWER(SUBSTRING_INDEX('Asqi Syahrul Anwar', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523021', UPPER('Asshyari Intan Permata Ningrum'), CONCAT(LOWER(SUBSTRING_INDEX('Asshyari Intan Permata Ningrum', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523022', UPPER('Bagus Satyo Nugroho'), CONCAT(LOWER(SUBSTRING_INDEX('Bagus Satyo Nugroho', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523023', UPPER('Conan Zulkarnain'), CONCAT(LOWER(SUBSTRING_INDEX('Conan Zulkarnain', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523024', UPPER('Diana Novitasari'), CONCAT(LOWER(SUBSTRING_INDEX('Diana Novitasari', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523025', UPPER('Dyah Galih Ananias'), CONCAT(LOWER(SUBSTRING_INDEX('Dyah Galih Ananias', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523026', UPPER('Fadhil Aulia Rahman'), CONCAT(LOWER(SUBSTRING_INDEX('Fadhil Aulia Rahman', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523027', UPPER('FAJAR SIDIQ TRI UTOMO'), CONCAT(LOWER(SUBSTRING_INDEX('FAJAR SIDIQ TRI UTOMO', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523028', UPPER('Fakhru Rifqi Ma\'arif'), CONCAT(LOWER(SUBSTRING_INDEX('Fakhru Rifqi Ma\'arif', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523029', UPPER('FATHIIKA ARUM MAULIDA'), CONCAT(LOWER(SUBSTRING_INDEX('FATHIIKA ARUM MAULIDA', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523030', UPPER('FATIRA SILVI'), CONCAT(LOWER(SUBSTRING_INDEX('FATIRA SILVI', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523031', UPPER('fauzan ahmad ciptawan'), CONCAT(LOWER(SUBSTRING_INDEX('fauzan ahmad ciptawan', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523032', UPPER('FEBRIANI DWI PUTRI NUR ROHMAH'), CONCAT(LOWER(SUBSTRING_INDEX('FEBRIANI DWI PUTRI NUR ROHMAH', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523033', UPPER('GLIDSI ISNAYNI NOVGIRL UMMAEROH'), CONCAT(LOWER(SUBSTRING_INDEX('GLIDSI ISNAYNI NOVGIRL UMMAEROH', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523034', UPPER('Gustama Dillo Beshieto'), CONCAT(LOWER(SUBSTRING_INDEX('Gustama Dillo Beshieto', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523035', UPPER('Hendra Adelia Haryono'), CONCAT(LOWER(SUBSTRING_INDEX('Hendra Adelia Haryono', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523036', UPPER('HIFZHEDINE ZAHARES SAMTO'), CONCAT(LOWER(SUBSTRING_INDEX('HIFZHEDINE ZAHARES SAMTO', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523037', UPPER('ILHAM MUHAMMAD HAKIEM'), CONCAT(LOWER(SUBSTRING_INDEX('ILHAM MUHAMMAD HAKIEM', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523038', UPPER('Isa Aulia Almadani'), CONCAT(LOWER(SUBSTRING_INDEX('Isa Aulia Almadani', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523039', UPPER('Julius Adhiatma Wira Sulistyo'), CONCAT(LOWER(SUBSTRING_INDEX('Julius Adhiatma Wira Sulistyo', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523040', UPPER('KHOIRUNNISA\''), CONCAT(LOWER(SUBSTRING_INDEX('KHOIRUNNISA\'', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523041', UPPER('LUCIA SHERINA NATALIA KRISTIANTI'), CONCAT(LOWER(SUBSTRING_INDEX('LUCIA SHERINA NATALIA KRISTIANTI', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523042', UPPER('LUTHFI HAPSARI'), CONCAT(LOWER(SUBSTRING_INDEX('LUTHFI HAPSARI', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523043', UPPER('M HAIDAR ARRAFI MAULANA SUYONO'), CONCAT(LOWER(SUBSTRING_INDEX('M HAIDAR ARRAFI MAULANA SUYONO', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523044', UPPER('MIKAEL FIRDAUS'), CONCAT(LOWER(SUBSTRING_INDEX('MIKAEL FIRDAUS', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523045', UPPER('Mohammad Hatif Sabiri'), CONCAT(LOWER(SUBSTRING_INDEX('Mohammad Hatif Sabiri', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523046', UPPER('Muhammad Abdul Aziz Al-Amiri'), 'aziz@student.uns.ac.id', NOW(), NOW()),

('K3523047', UPPER('MUHAMMAD FAHRY ALI'), 'fahry@student.uns.ac.id', NOW(), NOW()),

('K3523048', UPPER('Muhammad Fatihul Ihsan'), 'ihsan@student.uns.ac.id', NOW(), NOW()),

('K3523049', UPPER('Muhammad Irfan Dwi Putra'), 'irfan@student.uns.ac.id', NOW(), NOW()),

('K3523050', UPPER('Muhammad Rizal Alfarisyi'), 'rizal@student.uns.ac.id', NOW(), NOW()),

('K3523051', UPPER('MUHAMMAD TAUFIKHURROHMAN ALI'), 'taufikhurrohman@student.uns.ac.id', NOW(), NOW()),

('K3523052', UPPER('NABIL SIRAJUDDIN FATH'), CONCAT(LOWER(SUBSTRING_INDEX('NABIL SIRAJUDDIN FATH', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523053', UPPER('NABILA OKTAVIANI'), CONCAT(LOWER(SUBSTRING_INDEX('NABILA OKTAVIANI', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523054', UPPER('Nabilla Kayla Tsani Putri'), CONCAT(LOWER(SUBSTRING_INDEX('Nabilla Kayla Tsani Putri', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523055', UPPER('NAJELA NAJWA ANJANI'), CONCAT(LOWER(SUBSTRING_INDEX('NAJELA NAJWA ANJANI', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523056', UPPER('Nanda Agung Pratama'), CONCAT(LOWER(SUBSTRING_INDEX('Nanda Agung Pratama', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523057', UPPER('NEONARDO VIERRO'), CONCAT(LOWER(SUBSTRING_INDEX('NEONARDO VIERRO', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523058', UPPER('NIZMA NABILA SHAFA SUSILO'), CONCAT(LOWER(SUBSTRING_INDEX('NIZMA NABILA SHAFA SUSILO', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523059', UPPER('RACHMAT AHZADEL'), CONCAT(LOWER(SUBSTRING_INDEX('RACHMAT AHZADEL', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523060', UPPER('Rahayu Eriyana'), CONCAT(LOWER(SUBSTRING_INDEX('Rahayu Eriyana', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523062', UPPER('Rayhan Rosyad'), CONCAT(LOWER(SUBSTRING_INDEX('Rayhan Rosyad', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523063', UPPER('Reza Ahmad Fahruri'), CONCAT(LOWER(SUBSTRING_INDEX('Reza Ahmad Fahruri', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523064', UPPER('Richard Gilbert'), CONCAT(LOWER(SUBSTRING_INDEX('Richard Gilbert', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523065', UPPER('RIDHWAN HAFIZH ALHADY'), CONCAT(LOWER(SUBSTRING_INDEX('RIDHWAN HAFIZH ALHADY', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523066', UPPER('RIDWAN HAKIM MASHADI'), CONCAT(LOWER(SUBSTRING_INDEX('RIDWAN HAKIM MASHADI', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523067', UPPER('RIFALDY ILHAM NASRULLOH'), CONCAT(LOWER(SUBSTRING_INDEX('RIFALDY ILHAM NASRULLOH', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523068', UPPER('RIFDAH HANUN ALFIYAH'), CONCAT(LOWER(SUBSTRING_INDEX('RIFDAH HANUN ALFIYAH', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523069', UPPER('ROSYID HANAFITRI UTOMO'), CONCAT(LOWER(SUBSTRING_INDEX('ROSYID HANAFITRI UTOMO', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523070', UPPER('Sindy Eka Fatmawati'), CONCAT(LOWER(SUBSTRING_INDEX('Sindy Eka Fatmawati', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523071', UPPER('USMAN HASSAN ADAMU'), CONCAT(LOWER(SUBSTRING_INDEX('USMAN HASSAN ADAMU', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523072', UPPER('VANESHA BETHA LAKSANA'), CONCAT(LOWER(SUBSTRING_INDEX('VANESHA BETHA LAKSANA', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523073', UPPER('VAREL EVAN HERIYAWAN'), CONCAT(LOWER(SUBSTRING_INDEX('VAREL EVAN HERIYAWAN', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523074', UPPER('VIDYA AYU NOVITA SARI'), CONCAT(LOWER(SUBSTRING_INDEX('VIDYA AYU NOVITA SARI', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523075', UPPER('WIDHI SRI BHAWONO'), CONCAT(LOWER(SUBSTRING_INDEX('WIDHI SRI BHAWONO', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523076', UPPER('Wijayaning Dewi Ramadhani'), CONCAT(LOWER(SUBSTRING_INDEX('Wijayaning Dewi Ramadhani', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523077', UPPER('YATIN HARSU WINARTI'), CONCAT(LOWER(SUBSTRING_INDEX('YATIN HARSU WINARTI', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523078', UPPER('YUSUP C DERMAWAN'), CONCAT(LOWER(SUBSTRING_INDEX('YUSUP C DERMAWAN', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523079', UPPER('ZANJABIELA ADIL PERKASA'), CONCAT(LOWER(SUBSTRING_INDEX('ZANJABIELA ADIL PERKASA', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523080', UPPER('JHON CRISWANDO SITUMORANG'), CONCAT(LOWER(SUBSTRING_INDEX('JHON CRISWANDO SITUMORANG', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523081', UPPER('MOHAMAD ANDIKA JUNIARTA SAPUTRA'), CONCAT(LOWER(SUBSTRING_INDEX('MOHAMAD ANDIKA JUNIARTA SAPUTRA', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523082', UPPER('RATNA ANATA SARI'), CONCAT(LOWER(SUBSTRING_INDEX('RATNA ANATA SARI', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW()),

('K3523083', UPPER('Yusha\'u Abdulhamid'), CONCAT(LOWER(SUBSTRING_INDEX('Yusha\'u Abdulhamid', ' ', 1)), '@student.uns.ac.id'), NOW(), NOW());
*/