<?php

namespace Database\Seeders;

use App\Models\Books;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([CategorySeeder::class, UserSeeder::class]);

        $judulPerKategori = [
            'Pemograman' => [
                'Logika Pemrograman Dasar' => 'Buku ini membahas konsep dasar algoritma, flowchart, dan logika berpikir untuk pemula sebelum terjun ke bahasa pemrograman yang lebih kompleks.',
                'Mahir Laravel 11' => 'Panduan lengkap membangun aplikasi web modern menggunakan fitur terbaru Laravel 11, mulai dari instalasi hingga integrasi API.',
                'Membangun API dengan Node.js' => 'Pelajari cara membuat RESTful API yang cepat dan scalable menggunakan Express.js dan Node.js untuk kebutuhan industri saat ini.',
                'Jago React Native dalam 30 Hari' => 'Langkah demi langkah membuat aplikasi mobile Android dan iOS dengan satu codebase menggunakan library JavaScript paling populer.',
                'Algoritma dan Struktur Data' => 'Optimasi kode program Anda dengan pemahaman mendalam tentang Array, Linked List, Tree, dan teknik pengurutan data yang efisien.',
                'Clean Code untuk Pemula' => 'Teknik menulis kode yang rapi, mudah dibaca, dan mudah dikelola oleh tim pengembang profesional.',
                'Panduan Menjadi Fullstack Developer' => 'Kuasai frontend dan backend sekaligus untuk menjadi developer yang kompetitif di pasar tenaga kerja IT.',
                'Sistem Informasi Berbasis Web' => 'Studi kasus perancangan sistem informasi mulai dari database hingga antarmuka pengguna yang fungsional.',
                'Dasar-Dasar Python' => 'Pengenalan sintaks Python untuk berbagai kebutuhan seperti automasi, data science, dan pengembangan backend web.',
                'Mastering SQL dan Database' => 'Teknik manipulasi data tingkat lanjut dan optimasi query pada sistem manajemen database relasional.',
                'Belajar Docker dan Kubernetes' => 'Implementasi containerization untuk deployment aplikasi yang lebih konsisten dan skalabilitas yang lebih baik.',
                'Keamanan Jaringan dengan Kali Linux' => 'Belajar etika hacking dan cara mengamankan infrastruktur jaringan dari serangan siber yang merugikan.',
                'Analisis Data dengan R' => 'Pengolahan data statistik kompleks dan teknik visualisasi data yang informatif menggunakan bahasa pemrograman R.',
                'Pemrograman C++ untuk Robotika' => 'Penerapan bahasa tingkat rendah C++ dalam mengontrol perangkat keras, sensor, dan aktuator pada sistem robotik.',
                'Mobile Apps dengan Flutter' => 'Membuat UI yang indah dan performa tinggi untuk aplikasi mobile dengan framework buatan Google.',
                'Desain UI/UX yang User Friendly' => 'Prinsip-prinsip desain antarmuka yang mengutamakan kenyamanan, kemudahan, dan pengalaman positif bagi pengguna.',
                'Pengenalan Artificial Intelligence' => 'Konsep dasar kecerdasan buatan, machine learning, dan pengolahan data besar untuk masa depan teknologi.',
                'Optimasi Website dengan SEO' => 'Strategi komprehensif untuk meningkatkan peringkat website Anda di mesin pencari agar lebih mudah ditemukan pengunjung.',
                'Membangun Microservices' => 'Arsitektur perangkat lunak dengan memecah sistem menjadi layanan-layanan kecil yang independen dan mudah dikelola.',
                'E-Commerce dengan PHP' => 'Membangun toko online lengkap dengan fitur keranjang belanja, manajemen produk, hingga sistem pembayaran terintegrasi.'
            ],
            'Pelajaran' => [
                'Matematika Diskrit' => 'Materi logika matematika, teori himpunan, dan graf yang menjadi dasar utama bagi mahasiswa teknik informatika.',
                'Fisika Kuantum Sederhana' => 'Penjelasan mengenai fenomena subatomik dan mekanika kuantum dengan gaya bahasa yang mudah dipahami oleh orang awam.',
                'Biologi Sel dan Molekuler' => 'Pembahasan mendalam tentang struktur sel terkecil, DNA, dan mekanisme kehidupan pada tingkat molekuler.',
                'Ekonomi Makro Terapan' => 'Analisis kebijakan ekonomi negara, penanganan inflasi, dan strategi pertumbuhan ekonomi nasional secara berkelanjutan.',
                'Sosiologi Masyarakat Modern' => 'Studi tentang perubahan perilaku sosial manusia di tengah gempuran era digital dan globalisasi yang pesat.',
                'Geografi Regional Indonesia' => 'Pemetaan potensi sumber daya alam dan karakteristik wilayah nusantara dari Sabang sampai Merauke.',
                'Kamus Bahasa Inggris Oxford' => 'Referensi kosakata terlengkap dan terbaru untuk meningkatkan kemampuan komunikasi bahasa Inggris Anda secara formal maupun kasual.',
                'Panduan TOEFL iBT' => 'Tips dan trik menjawab soal-soal TOEFL iBT untuk mencapai skor maksimal yang dibutuhkan untuk studi ke luar negeri.',
                'Pendidikan Kewarganegaraan' => 'Menumbuhkan rasa cinta tanah air dan pemahaman mendalam tentang hak serta kewajiban sebagai warga negara yang baik.',
                'Kimia Organik untuk SMA' => 'Penjelasan struktur senyawa karbon, reaksi kimia, dan aplikasinya dalam kehidupan sehari-hari sesuai kurikulum sekolah.',
                'Statistik Terapan untuk Penelitian' => 'Metode pengolahan data numerik untuk mendukung validitas dan reliabilitas suatu penelitian ilmiah.',
                'Bahasa Indonesia yang Benar' => 'Panduan penggunaan Ejaan Bahasa Indonesia (EBI) dan struktur kalimat yang tepat untuk karya tulis ilmiah maupun dinas.',
                'Sejarah Peradaban Manusia' => 'Menelusuri perkembangan kebudayaan manusia dari zaman batu hingga munculnya teknologi informasi modern.',
                'Psikologi Pendidikan Child-Centric' => 'Metode pengajaran yang berfokus pada kebutuhan mental dan tahapan perkembangan psikologis anak didik.',
                'Astronomi Dasar' => 'Mempelajari benda-benda langit, rasi bintang, dan rahasia alam semesta yang maha luas ini.',
                'Antropologi Budaya' => 'Studi tentang keberagaman budaya, tradisi, dan adat istiadat berbagai suku bangsa di seluruh belahan dunia.',
                'Akuntansi Dasar Perusahaan' => 'Pencatatan laporan keuangan, siklus akuntansi, hingga penyusunan neraca saldo untuk pelaku bisnis pemula.',
                'Filsafat Ilmu' => 'Landasan berpikir logis, kritis, dan metodis dalam mencari kebenaran ilmiah di balik sebuah fenomena.',
                'Teori Komunikasi Massal' => 'Analisis dampak media massa terhadap opini publik dan cara informasi tersebar di masyarakat luas.',
                'Metodologi Penelitian Kualitatif' => 'Teknik pengumpulan data melalui wawancara mendalam dan observasi untuk mendapatkan hasil penelitian yang komprehensif.'
            ],
            'Dongeng' => [
                'Kisah Kancil dan Harimau' => 'Petualangan seekor kancil yang cerdik saat berusaha mengelabui harimau lapar yang ingin memangsanya di tengah hutan.',
                'Legenda Danau Toba' => 'Kisah asal mula terbentuknya danau terbesar di Indonesia yang berawal dari pelanggaran janji seorang pemuda bernama Toba.',
                'Bawang Merah dan Bawang Putih' => 'Cerita klasik tentang ketulusan hati Bawang Putih yang selalu disia-siakan oleh saudara tiri dan ibu tirinya yang jahat.',
                'Timun Mas dan Raksasa' => 'Perjuangan seorang gadis kecil bernama Timun Mas yang harus melarikan diri dari kejaran raksasa jahat dengan bekal benda-benda ajaib.',
                'Asal Usul Nama Surabaya' => 'Kisah pertarungan sengit antara Ikan Sura dan Buaya yang memperebutkan wilayah kekuasaan di pinggir pantai.',
                'Legenda Gunung Tangkuban Perahu' => 'Kisah Sangkuriang yang gagal memenuhi syarat membangun perahu dalam semalam dan kemarahannya yang menciptakan sebuah gunung.',
                'Si Pitung dari Betawi' => 'Kisah pahlawan pemberani dari tanah Betawi yang merampas harta penjajah untuk dibagikan kepada rakyat yang kelaparan.',
                'Lutung Kasarung' => 'Pangeran tampan yang dikutuk menjadi seekor kera dan perjalanannya mencari cinta sejati untuk melepaskan kutukan tersebut.',
                'Kisah Malin Kundang' => 'Pelajaran moral yang sangat berharga tentang nasib seorang anak yang dikutuk menjadi batu karena durhaka kepada ibu kandungnya.',
                'Cerita Rakyat Nusantara' => 'Kumpulan cerita-cerita pilihan dari berbagai daerah di Indonesia yang kaya akan pesan moral dan nilai-nilai luhur.',
                'Putri Salju dan Tujuh Kurcaci' => 'Dongeng tentang kebaikan hati seorang putri yang tinggal bersama para kurcaci untuk menghindari kejaran ratu yang iri hati.',
                'Si Kura-Kura dan Kelinci' => 'Lomba lari yang membuktikan bahwa kesombongan akan dikalahkan oleh ketekunan dan kerja keras yang tak kenal menyerah.',
                'Petualangan Kancil di Hutan' => 'Kumpulan aksi-aksi cerdas kancil dalam membantu teman-temannya sesama penghuni hutan dari berbagai kesulitan.',
                'Misteri Kerajaan Tersembunyi' => 'Kisah seorang anak desa yang tidak sengaja menemukan pintu rahasia menuju kerajaan bawah tanah yang penuh dengan keajaiban.',
                'Hikayat Hang Tuah' => 'Kepahlawanan seorang laksamana perkasa dari tanah Melayu yang sangat setia kepada raja dan bangsanya.',
                'Cindelaras' => 'Anak laki-laki hebat dengan ayam jagonya yang sakti dalam perjuangan mencari keadilan dan mengakui jati dirinya.',
                'Kisah Seribu Satu Malam' => 'Kumpulan dongeng legendaris penuh sihir dan petualangan dari Timur Tengah yang diceritakan oleh Syahrazad.',
                'Dewi Sri dan Padi' => 'Mitos masyarakat agraris tentang asal-usul tanaman padi yang dianggap sebagai simbol kemakmuran dan keberkahan.',
                'Legenda Candi Prambanan' => 'Kisah cinta bertepuk sebelah tangan antara Bandung Bondowoso dan Roro Jonggrang yang berujung pada terciptanya seribu candi.',
                'Kisah Jaka Tarub' => 'Cerita tentang seorang pemuda yang mencuri selendang bidadari dari kayangan demi mendapatkan istri yang cantik jelita.'
            ],
            'Cerita' => [
                'Hujan di Balik Jendela' => 'Novel romantis yang menyayat hati tentang kerinduan mendalam yang hanya bisa disampaikan lewat rintik hujan.',
                'Senja di Kota Tua' => 'Sebuah catatan perjalanan tentang pertemuan dua sahabat lama di sudut kota yang penuh dengan memori masa lalu.',
                'Cinta di Musim Kemarau' => 'Keteguhan hati seorang wanita dalam mempertahankan cinta sejatinya di tengah berbagai cobaan hidup yang datang silih berganti.',
                'Misteri Rumah Tua di Desa' => 'Sekelompok pemuda mencoba mengungkap rahasia gelap di balik rumah kosong yang sudah puluhan tahun tidak berpenghuni.',
                'Sahabat Sejati Sampai Mati' => 'Kisah persahabatan yang melampaui batas waktu, diuji oleh rasa sakit, kehilangan, namun tetap bertahan hingga akhir hayat.',
                'Surat Kecil untuk Tuhan' => 'Kisah inspiratif berdasarkan kejadian nyata tentang seorang gadis remaja yang berjuang melawan kanker dengan senyuman.',
                'Negeri di Ujung Tanduk' => 'Thriller politik yang penuh dengan intrik, pengkhianatan, dan perjuangan mencari kebenaran di tengah konspirasi besar.',
                'Garis Waktu' => 'Kumpulan prosa yang menelusuri setiap detik kenangan tentang seseorang yang pernah menjadi pusat semesta bagi penulisnya.',
                'Tentang Kamu dan Kenangan' => 'Novel yang membawa pembaca berkeliling dunia demi mengejar satu jawaban tentang arti kehadiran seseorang dalam hidup.',
                'Rembulan Tenggelam di Wajahmu' => 'Pertanyaan-pertanyaan mendasar tentang nasib dan takdir hidup yang akhirnya menemukan jawabannya di akhir perjalanan.',
                'Pelangi Tanpa Warna' => 'Kisah penuh haru tentang seseorang yang mencoba menemukan kembali warna-warni hidupnya setelah mengalami kehilangan besar.',
                'Mengejar Mimpi ke New York' => 'Perjuangan keras seorang anak muda yang pantang menyerah untuk menaklukkan kota metropolitan dunia demi cita-citanya.',
                'Catatan Juang' => 'Inspirasi bagi mereka yang hampir menyerah untuk terus melangkah dan percaya bahwa setiap luka akan ada penyembuhnya.',
                'Dunia Tanpa Batas' => 'Fiksi ilmiah yang menceritakan penemuan teknologi canggih yang justru membawa manusia pada dilema moral yang sulit.',
                'Rahasia di Balik Kabut' => 'Novel detektif dengan latar pegunungan yang mencekam, mengungkap kasus hilangnya pendaki secara misterius.',
                'Sepatu Dahlan' => 'Novel biografi yang menceritakan masa kecil seorang tokoh besar dalam kemiskinan namun tetap memiliki mimpi setinggi langit.',
                'Laskar Pelangi' => 'Perjuangan sepuluh anak di Pulau Belitong untuk mendapatkan pendidikan layak meski berada dalam keterbatasan fasilitas.',
                'Sang Pemimpi' => 'Kisah tentang keberanian untuk memiliki mimpi yang mustahil dan usaha yang tak kenal lelah untuk mewujudkannya.',
                'Edensor' => 'Petualangan menakjubkan menyusuri daratan Eropa mencari jati diri dan menemukan makna cinta yang sesungguhnya.',
                'Maryam dan Cinta Pertama' => 'Cerita manis tentang kepolosan cinta di bangku sekolah yang meninggalkan bekas mendalam hingga usia dewasa.'
            ],
            'Sejarah' => [
                'Revolusi Kemerdekaan 1945' => 'Rekaman peristiwa-peristiwa penting yang terjadi di sekitar proklamasi kemerdekaan hingga perjuangan mempertahankan kedaulatan RI.',
                'Runtuhnya Kerajaan Majapahit' => 'Analisis mendalam mengenai faktor internal dan serangan luar yang menyebabkan kemunduran kerajaan terbesar di Nusantara.',
                'Biografi Bung Karno' => 'Perjalanan hidup Sang Proklamator, mulai dari masa pembuangan hingga menjadi orator ulung yang disegani dunia internasional.',
                'Perang Diponegoro' => 'Catatan strategis mengenai perang terbesar yang pernah dialami Belanda di tanah Jawa yang dipimpin oleh Pangeran Diponegoro.',
                'Jejak Kolonialisme Belanda' => 'Mempelajari dampak sistem tanam paksa dan kebijakan kolonial terhadap struktur sosial dan ekonomi bangsa Indonesia saat ini.',
                'Perang Dunia II di Asia' => 'Kronologi masuknya pasukan Jepang ke wilayah Asia Tenggara yang menjadi titik balik berakhirnya dominasi bangsa Barat di Asia.',
                'Sejarah Kerajaan Singasari' => 'Intrik politik, pengkhianatan, dan ambisi Ken Arok dalam mendirikan dinasti yang nantinya melahirkan raja-raja besar di Jawa.',
                'Tokoh Bangsa Indonesia' => 'Kumpulan profil inspiratif dari para pahlawan nasional yang telah menyumbangkan tenaga dan pikirannya untuk Indonesia.',
                'G30S PKI: Fakta dan Analisis' => 'Pembahasan kritis mengenai peristiwa kelam di tahun 1965 berdasarkan berbagai sumber sejarah dan dokumen yang tersedia.',
                'Perjalanan Jalur Sutra' => 'Sejarah jaringan perdagangan internasional kuno yang menghubungkan kebudayaan Timur dan Barat selama berabad-abad.',
                'Sejarah Peradaban Islam' => 'Menelusuri masa keemasan ilmu pengetahuan dan perkembangan Islam mulai dari Jazirah Arab hingga ke seluruh penjuru dunia.',
                'Kisah Para Pahlawan Nasional' => 'Biografi lengkap perjuangan para pahlawan dari berbagai daerah dalam mengusir penjajah dari bumi pertiwi.',
                'Indonesia di Masa Orde Baru' => 'Tinjauan terhadap dinamika politik, pembangunan ekonomi, dan stabilitas keamanan selama 32 tahun kepemimpinan Soeharto.',
                'Perlawanan Rakyat Maluku' => 'Kisah heroik Kapitan Pattimura dan Christina Martha Tiahahu dalam melawan monopoli perdagangan rempah-rempah oleh VOC.',
                'Reformasi 1998' => 'Kronologi gerakan mahasiswa dan rakyat dalam menuntut perubahan sistem pemerintahan menuju era demokrasi yang lebih terbuka.',
                'Sejarah Kerajaan Sriwijaya' => 'Mengkaji kejayaan kerajaan maritim di Sumatra sebagai pusat perdagangan dan penyebaran agama Buddha di Asia Tenggara.',
                'Penjelajahan Samudra' => 'Kisah para pelaut tangguh dari Eropa yang mengarungi samudra luas untuk mencari tanah baru dan rempah-rempah berharga.',
                'Tokoh-Tokoh Dunia Paling Berpengaruh' => 'Daftar individu yang melalui pemikiran, penemuan, atau tindakannya telah mengubah arah sejarah peradaban umat manusia.',
                'Sejarah Jakarta Tempo Dulu' => 'Transformasi Pelabuhan Sunda Kelapa menjadi kota Batavia hingga akhirnya menjadi ibu kota Jakarta yang metropolitan.',
                'Evolusi Manusia Modern' => 'Paparan hasil penelitian arkeologi dan genetika tentang asal-usul nenek moyang manusia dari Afrika hingga menyebar ke seluruh dunia.'
            ],
        ];

        foreach ($judulPerKategori as $categoryName => $books) {
            $category = Category::where('name', $categoryName)->first();

            $prefix = match($categoryName) {
                'Pemograman' => 'PG',
                'Pelajaran'  => 'PJ',
                'Dongeng'    => 'DG',
                'Cerita'     => 'CR',
                'Sejarah'    => 'SJ',
                default      => 'BK',
            };

            foreach ($books as $title => $summary) {
                // MEMBUAT BODY PANJANG (3 PARAGRAF)
                $para2 = "Buku ini tidak hanya menyajikan materi secara teoretis, tetapi juga dilengkapi dengan ilustrasi pendukung, tabel perbandingan, dan latihan mandiri yang disusun secara sistematis. Penulis berusaha membawa pembaca untuk memahami konteks secara mendalam agar ilmu yang didapat bisa langsung diterapkan dalam kehidupan sehari-hari maupun pekerjaan profesional.";
                
                $para3 = "Dengan penyajian bahasa yang ringan namun tetap berbobot, buku ini sangat direkomendasikan bagi siapa saja yang ingin memperluas wawasan di bidang " . strtolower($categoryName) . ". Segera miliki karya ini untuk menambah koleksi perpustakaan pribadi Anda dan raih pemahaman yang lebih baik tentang topik " . $title . " ini.";

                $fullBody = "$summary\n\n$para2\n\n$para3";

                Books::create([
                    'judul'        => $title,
                    'code'         => $prefix . '-' . strtoupper(Str::random(3)), 
                    'penulis'      => fake('id_ID')->name(),
                    'category_id'  => $category->id,
                    'body'         => $fullBody,
                    'tahun_terbit' => fake()->year(),
                ]);
            }
        }
    }
}